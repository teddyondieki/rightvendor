<?php

/**
 * This is the model class for table "rv_gallery_image".
 *
 * The followings are the available columns in table 'rv_gallery_image':
 * @property integer $ID
 * @property string $Name
 * @property integer $ProjectID
 * @property integer $IsFeatured
 * @property string $ColorTags
 */
class GalleryImage extends CActiveRecord {

    const NOT_FEATURED = 0;
    const FEATURED = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rv_gallery_image';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name, ProjectID, IsFeatured', 'required'),
            array('ProjectID, IsFeatured', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 64),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, Name, ProjectID, ColorTags, IsFeatured', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'project' => array(self::BELONGS_TO, 'Project', 'ProjectID'),
            'totalLikes' => array(self::STAT, 'Like', 'ImageID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Name' => 'Name',
            'ProjectID' => 'Project',
            'IsFeatured' => 'Is Featured',
            'ColorTags' => 'Color Tags',
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
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('ColorTags', $this->ColorTags, true);
        $criteria->compare('ProjectID', $this->ProjectID);
        $criteria->compare('IsFeatured', $this->IsFeatured);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return GalleryImage the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function isLikedByCurrentUser($imageID) {
        $ip = $_SERVER["REMOTE_ADDR"];
        $like = Like::model()->findByAttributes(array('ImageID' => $imageID, 'IPAddress' => $ip, 'UserID' => Yii::app()->user->id));
        return ($like == null ? false : true);
    }

}
