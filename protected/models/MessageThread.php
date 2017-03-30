<?php

/**
 * This is the model class for table "rv_message_thread".
 *
 * The followings are the available columns in table 'rv_message_thread':
 * @property integer $ID
 * @property integer $SubjectID
 * @property integer $User1
 * @property integer $User2
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class MessageThread extends RVAR {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rv_message_thread';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('SubjectID, User1, User2, CreateTime, UpdateTime', 'required'),
            array('SubjectID, User1, User2', 'numerical', 'integerOnly' => true),
            array('CreateTime, UpdateTime', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, SubjectID, User1, User2, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
//            'messages' => array(self::HAS_MANY, 'Message', 'ThreadID', 'order' => 'messages.ID DESC', 'limit' => 1),
            'messagesASC' => array(self::HAS_MANY, 'Message', 'ThreadID'),
            'subject' => array(self::BELONGS_TO, 'Subject', 'SubjectID'),
            'user1st' => array(self::BELONGS_TO, 'User', 'User1'),
            'user2nd' => array(self::BELONGS_TO, 'User', 'User2'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'SubjectID' => 'Subject',
            'User1' => 'User1',
            'User2' => 'User2',
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
        $criteria->compare('SubjectID', $this->SubjectID);
        $criteria->compare('User1', $this->User1);
        $criteria->compare('User2', $this->User2);
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
     * @return MessageThread the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getLatestMessage() {
        return Message::model()->find(array(
                    'condition' => 'ThreadID=:threadId',
                    'params' => array(':threadId' => $this->ID),
                    'order' => 'CreateTime DESC'
        ));
    }

}
