<?php

/**
 * This is the model class for table "rv_user".
 *
 * The followings are the available columns in table 'rv_user':
 * @property integer $ID
 * @property string $Name
 * @property string $Email
 * @property integer Status
 * @property string $Password
 * @property string $LastLoginTime
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class User extends RVAR {

    public $Password_repeat;
    public $Password_old;

    const STATUS_NOT_CONFIRMED = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_BANNED = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rv_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name, Email, Password, Password_repeat', 'required', 'on' => 'create, changePassword'),
            array('Password_repeat, Password', 'required', 'on' => 'newPassword'),
            array('Password_old', 'findPasswords', 'on' => 'changePassword'),
            array('Password', 'compare', 'message' => 'Passwords do not match.'),
            array('Email', 'email'),
            array('Email', 'unique'),
            array('Password_repeat', 'safe'),
            array('Name, Email', 'length', 'max' => 64),
            array('LastLoginTime', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, Name, Email, Password, Status, LastLoginTime, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'vendorProfile' => array(self::HAS_ONE, 'VendorProfile', 'VendorID'),
            'userProfile' => array(self::HAS_ONE, 'UserProfile', 'UserID'),
            'projectCount' => array(self::STAT, 'Project', 'UserID'),
            'unreadNotificationCount' => array(self::STAT, 'Notification', 'VendorID', 'condition' => 'Status=' . Notification::STATUS_UNSEEN),
            'unreadMessageCount' => array(self::STAT, 'Message', 'RecipientID', 'condition' => 'Status=' . Message::STATUS_UNSEEN),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Name' => 'Name',
            'Email' => 'Email',
            'Password' => 'Password',
            'Password_repeat' => 'Confirm password',
            'Password_old' => 'Old password',
            'LastLoginTime' => 'Last Login Time',
            'Status' => 'Status',
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
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('Password', $this->Password);
        $criteria->compare('LastLoginTime', $this->LastLoginTime, true);
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
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * perform one-way encryption on the password before we store it in
      the database
     */
    protected function afterValidate() {
        parent::afterValidate();
        $this->Password = $this->encrypt($this->Password);
    }

    public function encrypt($value) {
        return md5($value);
    }

    /**
     * Sends a message to user
     */
    public function sendMessage($message) {

        $message->RecipientID = $this->ID;
        $message->SenderID = Yii::app()->user->id;
        $message->Status = Message::STATUS_UNSEEN;
        return $message->save();
    }

    //matching the old password with your existing password.
    public function findPasswords($attribute, $params) {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if ($user->Password != md5($this->Password_old)) {
            $this->addError($attribute, 'Old password is incorrect.');
        }
    }

    public static function getUnreadNotifications() {
        if (!Yii::app()->user->isGuest) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $unreadNotificationCount = $user->unreadNotificationCount;
            if ($unreadNotificationCount > 0) {
                return '<span class="badge">' . $unreadNotificationCount . '</span>';
            }
        }
    }

    public static function getUnreadMessages() {
        if (!Yii::app()->user->isGuest) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $unreadMessageCount = $user->unreadMessageCount;
            if ($unreadMessageCount > 0) {
                return '<span class="badge">' . $unreadMessageCount . '</span>';
            }
        }
    }

    public static function getUserProjectCount() {
        if (!Yii::app()->user->isGuest) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            return '<span class="badge">' . $user->projectCount . '</span>';
        }
    }

}
