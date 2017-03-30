<?php

/**
 * This is the model class for table "rv_account_recovery".
 *
 * The followings are the available columns in table 'rv_account_recovery':
 * @property string $RecoveryCode
 * @property integer $UserID
 * @property string $Email
 * @property integer $Status
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class AccountRecovery extends RVAR {

    const STATUS_ACTIVE = 0;
    const STATUS_EXPIRED = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rv_account_recovery';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('CreateTime, UpdateTime', 'required'),
            array('Email', 'required', 'on' => 'sendEmail'),
            array('Email', 'email'),
            array('Email', 'findUserByEmail', 'on' => 'sendEmail'),
            array('UserID, Status', 'numerical', 'integerOnly' => true),
            array('RecoveryCode, CreateTime, UpdateTime', 'length', 'max' => 64),
            array('Email', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('RecoveryCode, UserID, Email, Status, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'UserID'),
            'vendorProfile' => array(self::BELONGS_TO, 'VendorProfile', 'UserID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'RecoveryCode' => 'Recovery Code',
            'UserID' => 'User',
            'Email' => 'Please enter your email address',
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

        $criteria->compare('RecoveryCode', $this->RecoveryCode, true);
        $criteria->compare('UserID', $this->UserID);
        $criteria->compare('Email', $this->Email, true);
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
     * @return AccountRecovery the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function findUserByEmail($attribute, $params) {
//        $user = NULL;
        $user = User::model()->findByAttributes(array('Email' => $this->Email));
        if ($user == NULL) {
            $this->addError($attribute, 'We could not find a user with that email');
        } else {
            $this->UserID = $user->ID;
            $this->Email = $user->Email;
        }
    }

    public function sendConfirmationEmail() {

        require("PHPMailer/class.phpmailer.php");

        $mail = new PHPMailer();

        $mail->IsSendmail();
        $mail->IsHTML(true);

        $mail->SetFrom('info@tamtam.co.ke', 'TamTam Kenya');
        $mail->AddReplyTo("info@tamtam.co.ke", "TamTam Kenya");

        $address = $this->Email;
        $mail->AddAddress($address, $this->user->Name);

        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = "<html><head><style>
                @import url(http://fonts.googleapis.com/css?family=Droid+Sans);
                </style>
                </head><body style=\"color: #333;font-family: 'Droid Sans', sans-serif; font-size: 16px;\">";
        $message .= "Dear " . $this->user->Name . ",
<p>
You have successfully confirmed your email. You will now receive all notifications regarding your account. </p>";

        $message .= "<br/><br/>Regards,<br/>TamTam Kenya";
        $message .= "<br/><img alt=\"Embedded Image\" src=\"" . Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . "/img/email_footer.png\"/><br/>";
        $message .= "</body></html>";

        $mail->Subject = "Email confimed - WeddingVibe";
        $mail->Body = $message;

        $mail->Send();
        $mail->ClearAddresses();
    }

    public function sendRegistrationEmail() {

        require("PHPMailer/class.phpmailer.php");

        $mail = new PHPMailer();

        $mail->IsSendmail();
        $mail->IsHTML(true);

        $mail->SetFrom('info@tamtam.co.ke', 'TamTam Kenya');
        $mail->AddReplyTo("info@tamtam.co.ke", "TamTam Kenya");

        $address = $this->Email;
        $mail->AddAddress($address, $this->user->Name);

        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = "<html><head><style>
                @import url(http://fonts.googleapis.com/css?family=Droid+Sans);
                </style>
                </head><body style=\"color: #333;font-family: 'Droid Sans', sans-serif; font-size: 16px;\">";
        $message .= "Dear " . $this->user->Name . ",
<p>
You successfully created a WeddingVibe account on " . date('F j, Y \a\t h:i a', strtotime($this->CreateTime)) . ". Click the following link to confirm 
    your email: " . Yii::app()->request->hostInfo . Yii::app()->createUrl('user/confirmEmail', array('confirmationCode' => $this->RecoveryCode)) . "
</p>            ";

        $message .= "<br/><br/>Regards,<br/>TamTam Kenya";
        $message .= "<br/><img alt=\"Embedded Image\" src=\"" . Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . "/img/email_footer.png\"/><br/>";
        $message .= "</body></html>";

        $mail->Subject = "Account created successfully - WeddingVibe";
        $mail->Body = $message;

        $mail->Send();
        $mail->ClearAddresses();
    }

}
