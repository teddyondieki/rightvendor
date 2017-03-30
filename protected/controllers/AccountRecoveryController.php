<?php

class AccountRecoveryController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('create', 'result', 'newPassword'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'index', 'view', 'create', 'update'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($recoveryId) {
        $this->render('view', array(
            'model' => $this->loadModel($recoveryId),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new AccountRecovery;

        $model->setScenario('sendEmail');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AccountRecovery'])) {
            $model->attributes = $_POST['AccountRecovery'];

            if ($model->validate()) {
                $model->RecoveryCode = substr(md5(time() . rand(10000, 20000)), 0, 15);
                $model->Status = AccountRecovery::STATUS_ACTIVE;
                $model->save();
                $this->sendRecoveryEmail($model);
                $this->redirect(array('result'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AccountRecovery'])) {
            $model->attributes = $_POST['AccountRecovery'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->RecoveryCode));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('AccountRecovery');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new AccountRecovery('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AccountRecovery']))
            $model->attributes = $_GET['AccountRecovery'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return AccountRecovery the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = AccountRecovery::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param AccountRecovery $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'account-recovery-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function sendRecoveryEmail($accountRecovery) {

        require("PHPMailer/class.phpmailer.php");

        $mail = new PHPMailer();

        $mail->IsSendmail();
        $mail->IsHTML(true);

        $mail->SetFrom('info@tamtam.co.ke', 'TamTam Kenya');
        $mail->AddReplyTo("info@tamtam.co.ke", "TamTam Kenya");

        $address = $accountRecovery->Email;
        $mail->AddAddress($address, $accountRecovery->user->Name);

        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = "<html><head><style>
                @import url(http://fonts.googleapis.com/css?family=Droid+Sans);
                </style>
                </head><body style=\"color: #333;font-family: 'Droid Sans', sans-serif; font-size: 16px;\">";
        $message .= "Dear " . $accountRecovery->user->Name . ",
<p>
You requested for a new passoword on " . date('F j, Y \a\t h:i a', strtotime($accountRecovery->CreateTime)) . ". Click the following link to create 
    a new password: " . Yii::app()->request->hostInfo . Yii::app()->createUrl('accountRecovery/newPassword', array('recoveryCode' => $accountRecovery->RecoveryCode)) . "
</p>            ";


        $message .= "<br/><br/>Regards,<br/>TamTam Kenya";
        $message .= "<br/><img alt=\"Embedded Image\" src=\"" . Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . "/img/email_footer.png\"/><br/>";
        $message .= "</body></html>";

        $mail->Subject = "Reset password for Wedding Vibe";
        $mail->Body = $message;

        if ($mail->Send()) {
            Yii::app()->user->setFlash('success', "Recovery information has been sent to your email.");
        } else {
            Yii::app()->user->setFlash('error', "The email could not be sent. Please try again.");
        }
        $mail->ClearAddresses();
    }

    public function actionResult() {
        if (Yii::app()->user->hasFlash('success') || Yii::app()->user->hasFlash('error')) {
            $this->render('result');
        } else {
            $this->redirect(array('site/login'));
        }
    }

    public function actionNewPassword($recoveryCode) {
        $model = $this->loadModel($recoveryCode);

        if ($model->Status == AccountRecovery::STATUS_EXPIRED) {
            Yii::app()->user->setFlash('error', "The recovery code is invalid. You may request a new one.");
            $this->redirect(array('site/login'));
        }

        $user = new User();
        $user->setScenario('newPassword');

        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];

            if ($user->validate()) {
                User::model()->updateByPk($model->UserID, array('Password' => $user->Password));
                $model->Status = AccountRecovery::STATUS_EXPIRED;
                $model->save();
                Yii::app()->user->setFlash('success', "You have successfully created a new password. You may now log in.");
                $this->redirect(array('site/login'));
            }
        }

        $this->render('newPassword', array(
            'model' => $user,
        ));
    }

}
