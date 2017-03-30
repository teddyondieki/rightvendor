<?php

/**
 * This is the model class for table "rv_vendor_profile".
 *
 * The followings are the available columns in table 'rv_vendor_profile':
 * @property integer $VendorID
 * @property integer $City
 * @property integer $Category
 * @property string $Website
 * @property string $Permalink
 * @property string $Email
 * @property string $BusinessName
 * @property string $Phonenumber
 * @property string $Address
 * @property integer $IsFeatured
 * @property integer $Status
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class VendorProfile extends CActiveRecord {

    const NOT_FEATURED = 0;
    const FEATURED = 1;
    const NOT_APPROVED = 0;
    const APPROVED = 1;
    const BANNED = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rv_vendor_profile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Email', 'email'),
            array('VendorID, City, Category, BusinessName, Phonenumber, Email, Status', 'required'),
            array('VendorID, City, Category', 'numerical', 'integerOnly' => true),
            array('Website, Email, Phonenumber, BusinessName', 'length', 'max' => 64),
            array('Address', 'length', 'max' => 1000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('VendorID, City, Category, Website, Permalink, IsFeatured, CreateTime, UpdateTime, BusinessName, Email, Phonenumber, Address', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'city' => array(self::BELONGS_TO, 'City', 'City'),
            'category' => array(self::BELONGS_TO, 'ProjectCategory', 'Category'),
            'userProfile' => array(self::HAS_ONE, 'UserProfile', 'UserID'),
            'projects' => array(self::HAS_MANY, 'Project', 'UserID'),
            'projectCount' => array(self::STAT, 'Project', 'UserID'),
            'priceList' => array(self::HAS_MANY, 'PriceList', 'UserID'),
            'reviews' => array(self::HAS_MANY, 'Review', 'VendorID'),
            'reviewCount' => array(self::STAT, 'Review', 'VendorID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'VendorID' => 'Vendor',
            'City' => 'Business Location',
            'BusinessName' => 'Business Name',
            'Category' => 'Business Category',
            'Website' => 'Website',
            'Email' => 'Business Email',
            'Phonenumber' => 'Business Phonenumber',
            'Address' => 'Business Address',
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

        $criteria->compare('VendorID', $this->VendorID);
        $criteria->compare('City', $this->City);
        $criteria->compare('Category', $this->Category);
        $criteria->compare('Website', $this->Website, true);
        $criteria->compare('Permalink', $this->Permalink, true);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('BusinessName', $this->BusinessName, true);
        $criteria->compare('Phonenumber', $this->Phonenumber, true);
        $criteria->compare('Address', $this->Address, true);
        $criteria->compare('IsFeatured', $this->IsFeatured);
        $criteria->compare('Status', $this->Status);
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
     * @return VendorProfile the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Adds a review to this project
     */
    public function addReview($review) {
        $review->VendorID = $this->VendorID;
        $review->AuthorID = Yii::app()->user->id;

        $notification = new Notification;
        $notification->Type = Notification::TYPE_REVIEW_VENDOR;
        $notification->Status = Notification::STATUS_UNSEEN;
        $notification->ProjectID = NULL;
        $notification->VendorID = $this->VendorID;
        $notification->GuestID = Yii::app()->user->id;

        $notification->save();

        return $review->save();
    }

    protected function beforeValidate() {
        if ($this->isNewRecord) {
//            $this->UserID = Yii::app()->user->id;
            $this->Permalink = $this->setPermalink();
        }
        return parent::beforeValidate();
    }

    private function setPermalink() {

        $str = $this->BusinessName;
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

}
