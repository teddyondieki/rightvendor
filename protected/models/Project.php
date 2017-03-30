<?php

/**
 * This is the model class for table "rv_project".
 *
 * The followings are the available columns in table 'rv_project':
 * @property integer $ID
 * @property string $Title
 * @property string $Venue
 * @property string $Description
 * @property integer $UserID
 * @property string $Permalink
 * @property integer $MainImage
 * @property integer $IsFeatured
 * @property integer $TotalLikes
 * @property integer $TotalViews
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class Project extends RVAR {

    const NOT_FEATURED = 0;
    const FEATURED = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rv_project';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Title, Venue, Description, UserID, CreateTime, UpdateTime', 'required'),
            array('UserID, TotalLikes, TotalViews, MainImage', 'numerical', 'integerOnly' => true),
            array('Title, Venue', 'length', 'max' => 64),
            array('Description', 'length', 'max' => 1000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, Title, Venue, Description, TotalLikes, MainImage, IsFeatured,TotalViews, Permalink, UserID, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'gallery' => array(self::HAS_MANY, 'GalleryImage', 'ProjectID', 'order' => 'gallery.ID DESC'),
            'vendor' => array(self::BELONGS_TO, 'User', 'UserID'),
            'comments' => array(self::HAS_MANY, 'Comment', 'ProjectID', 'order' => 'comments.ID DESC'),
            'commentCount' => array(self::STAT, 'Comment', 'ProjectID'),
            'vendorProfile' => array(self::BELONGS_TO, 'VendorProfile', 'UserID'),
            'userProfile' => array(self::BELONGS_TO, 'UserProfile', 'UserID'),
            'imageCount' => array(self::STAT, 'GalleryImage', 'ProjectID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Title' => 'Title',
            'Venue' => 'Venue',
            'Description' => 'Description',
            'UserID' => 'User',
            'Permalink' => 'Permalink',
            'MainImage' => 'Main Image',
            'TotalLikes' => 'Likes',
            'TotalViews' => 'Views',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID);
        $criteria->compare('Title', $this->Title, true);
        $criteria->compare('Venue', $this->Venue, true);
        $criteria->compare('Description', $this->Description, true);
        $criteria->compare('UserID', $this->UserID);
        $criteria->compare('TotalLikes', $this->TotalLikes);
        $criteria->compare('MainImage', $this->MainImage);
        $criteria->compare('IsFeatured', $this->IsFeatured);
        $criteria->compare('TotalViews', $this->TotalViews);
        $criteria->compare('Permalink', $this->Permalink, true);
        $criteria->compare('CreateTime', $this->CreateTime, true);
        $criteria->compare('UpdateTime', $this->UpdateTime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeValidate() {
        if ($this->isNewRecord) {
            $this->UserID = Yii::app()->user->id;
            $this->Permalink = $this->setPermalink();
        }
        return parent::beforeValidate();
    }

    /**
     * Adds a comment to this project
     */
    public function addComment($comment) {
        $comment->ProjectID = $this->ID;
        $comment->UserID = Yii::app()->user->id;

        $notification = new Notification;
        $notification->Type = Notification::TYPE_COMMENT_PROJECT;
        $notification->Status = Notification::STATUS_UNSEEN;
        $notification->ProjectID = $this->ID;
        $notification->VendorID = $this->UserID;
        $notification->GuestID = Yii::app()->user->id;

        $notification->save();

        return $comment->save();
    }

    private function setPermalink() {

        $str = $this->Title;
        if ($str !== mb_convert_encoding(mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32')) {
            $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
        }
        $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
        $str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
        $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
        $str = preg_replace(array('`[^a-z0-9]`i', '`[-]+`'), '-', $str);
        $str = strtolower(trim($str, '-'));

        $str = $this->generatePermalink($str);
        return $str;
    }

    private function permalinkExists($permalink) {

        $count = self::model()->count('Permalink = :permalink', array(':permalink' => $permalink));
        return ($count > 0 ? true : false);
    }

    private function generatePermalink($permalink) {
        $basePermalink = $permalink;
        $count = 1;
        while ($this->permalinkExists($permalink)) {
            $permalink = $basePermalink . '-' . $count++;
        }
        return $permalink;
    }

    public function updateLikes() {
        $this->saveCounters(array('TotalLikes' => '1'));
    }

    public function updateViewCount() {
        $this->saveCounters(array('TotalViews' => '1'));
    }

    public function getImagePath() {
        return GalleryImage::model()->findByPk($this->MainImage)->Name;
    }

    public static function findFeaturedProjects($limit = 20) {

        return self::model()->findAll(array(
                    'order' => 'ID DESC',
                    'limit' => $limit,
                    'condition' => 'IsFeatured = :isFeatured',
                    'params' => array(
                        ':isFeatured' => self::FEATURED,
                    ),
        ));
    }

}
