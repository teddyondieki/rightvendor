<?php

/**
 * This is the model class for table "rv_notification".
 *
 * The followings are the available columns in table 'rv_notification':
 * @property integer $ID
 * @property integer $Type
 * @property integer $ImageID
 * @property integer $ProjectID
 * @property integer $GuestID
 * @property integer $VendorID
 * @property integer $Status
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class Notification extends RVAR {

    const TYPE_LIKE_IMAGE = 0;
    const TYPE_COMMENT_PROJECT = 1;
    const TYPE_SHARE_IMAGE = 2;
    const TYPE_SHARE_PROJECT = 3;
    const TYPE_REVIEW_VENDOR = 4;

    public function getTypeOptions() {
        return array(
            self::TYPE_LIKE_IMAGE => 'likes',
            self::TYPE_COMMENT_PROJECT => 'commented on',
            self::TYPE_SHARE_IMAGE => 'shared',
            self::TYPE_SHARE_PROJECT => 'shared',
        );
    }

    public function getTypeText() {
        $options = $this->typeOptions;
        return isset($options[$this->Type]) ?
                $options[$this->Type] : "unknown type ({$this->Type})";
    }

    const STATUS_UNSEEN = 0;
    const STATUS_SEEN = 1;

    public function getStatusOptions() {
        return array(
            self::STATUS_SEEN => 'Seen',
            self::STATUS_UNSEEN => 'UnSeen',
        );
    }

    public function getStatusText() {
        $options = $this->statusOptions;
        return isset($options[$this->Status]) ?
                $options[$this->Status] : "unknown status ({$this->Status})";
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rv_notification';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Type, VendorID, Status, CreateTime, UpdateTime', 'required'),
            array('Type, ImageID, ProjectID, GuestID, VendorID, Status', 'numerical', 'integerOnly' => true),
            array('CreateTime, UpdateTime', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, Type, ImageID, GuestID, VendorID, Status, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'guest' => array(self::BELONGS_TO, 'User', 'GuestID'),
            'vendor' => array(self::BELONGS_TO, 'User', 'VendorID'),
            'image' => array(self::BELONGS_TO, 'GalleryImage', 'ImageID'),
            'project' => array(self::BELONGS_TO, 'Project', 'ProjectID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Type' => 'Type',
            'ImageID' => 'Image',
            'ProjectID' => 'Image',
            'GuestID' => 'Guest',
            'VendorID' => 'Vendor',
            'Status' => 'Status',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
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
        $criteria->compare('Type', $this->Type);
        $criteria->compare('ImageID', $this->ImageID);
        $criteria->compare('ProjectID', $this->ProjectID);
        $criteria->compare('GuestID', $this->GuestID);
        $criteria->compare('VendorID', $this->VendorID);
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
     * @return Notification the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
