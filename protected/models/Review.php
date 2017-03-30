<?php

/**
 * This is the model class for table "rv_review".
 *
 * The followings are the available columns in table 'rv_review':
 * @property integer $ID
 * @property string $Content
 * @property integer $Rating
 * @property integer $VendorID
 * @property integer $AuthorID
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class Review extends RVAR {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rv_review';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Content, Rating, VendorID, AuthorID, CreateTime, UpdateTime', 'required'),
            array('Rating, VendorID, AuthorID', 'numerical', 'integerOnly' => true),
            array('Content', 'length', 'max' => 1000),
            array('CreateTime, UpdateTime', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, Content, Rating, VendorID, AuthorID, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'author' => array(self::BELONGS_TO, 'User', 'AuthorID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Content' => 'Content',
            'Rating' => 'Rating',
            'VendorID' => 'Vendor',
            'AuthorID' => 'Author',
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
        $criteria->compare('Content', $this->Content, true);
        $criteria->compare('Rating', $this->Rating);
        $criteria->compare('VendorID', $this->VendorID);
        $criteria->compare('AuthorID', $this->AuthorID);
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
     * @return Review the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
