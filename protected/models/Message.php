<?php

/**
 * This is the model class for table "rv_message".
 *
 * The followings are the available columns in table 'rv_message':
 * @property integer $ID
 * @property string $Content
 * @property integer $SenderID
 * @property integer $RecipientID
 * @property integer $ThreadID
 * @property integer $SubjectID
 * @property integer $Status
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class Message extends RVAR {

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
        return 'rv_message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Content, SenderID, RecipientID, ThreadID, SubjectID, Status, CreateTime, UpdateTime', 'required'),
            array('SenderID, RecipientID, ThreadID, SubjectID, Status', 'numerical', 'integerOnly' => true),
            array('Content', 'length', 'max' => 1000),
            array('CreateTime, UpdateTime', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, Content, SenderID, RecipientID, ThreadID, SubjectID, Status, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'thread' => array(self::BELONGS_TO, 'Thread', 'ThreadID'),
            'subject' => array(self::BELONGS_TO, 'Subject', 'SubjectID'),
            'sender' => array(self::BELONGS_TO, 'User', 'SenderID'),
            'recipient' => array(self::BELONGS_TO, 'User', 'RecipientID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Content' => 'Content',
            'SenderID' => 'Sender',
            'RecipientID' => 'Recipient',
            'ThreadID' => 'Thread',
            'SubjectID' => 'Subject',
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
        $criteria->compare('Content', $this->Content, true);
        $criteria->compare('SenderID', $this->SenderID);
        $criteria->compare('RecipientID', $this->RecipientID);
        $criteria->compare('ThreadID', $this->ThreadID);
        $criteria->compare('SubjectID', $this->SubjectID);
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
     * @return Message the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function afterSave() {
        MessageThread::model()->updateByPk($this->ThreadID, array('UpdateTime' => time()));

        return parent::afterSave();
    }

}
