<?php

/**
 * This is the model class for table "rv_price_list".
 *
 * The followings are the available columns in table 'rv_price_list':
 * @property integer $ID
 * @property string $Service
 * @property string $Description
 * @property string $Budget
 * @property integer $UserID
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class PriceList extends RVAR {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rv_price_list';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Service, Description, Budget, UserID, CreateTime, UpdateTime', 'required'),
            array('UserID', 'numerical', 'integerOnly' => true),
            array('Service', 'length', 'max' => 256),
            array('Budget, CreateTime, UpdateTime', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, Service, Description, Budget, UserID, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Service' => 'Service',
            'Description' => 'Description',
            'Budget' => 'Budget',
            'UserID' => 'User',
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
        $criteria->compare('Service', $this->Service, true);
        $criteria->compare('Description', $this->Description, true);
        $criteria->compare('Budget', $this->Budget, true);
        $criteria->compare('UserID', $this->UserID);
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
     * @return PriceList the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
