<?php

Yii::import('ext.iwi.Iwi');

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                'actions' => array('confirmEmail', 'create', 'registerVendor'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'update', 'removePic', 'changePassword', 'updateProfilePic'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array('admin'),
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
    public function actionView($id) {
        $model = $this->loadModel($id);
        $message = $this->createMessage($model);

        $this->render('view', array(
            'model' => $model,
            'message' => $message
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $this->layout = '//layouts/column1';
        $model = new User;
        $model->setScenario('create');

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $userProfile = new UserProfile;
                $userProfile->UserID = $model->ID;
                $userProfile->save();
                $model->save();

                $accountConfirm = new AccountRecovery;
                $accountConfirm->UserID = $model->ID;
                $accountConfirm->Email = $model->Email;
                $accountConfirm->RecoveryCode = substr(md5(time() . rand(10000, 20000)), 0, 15);
                $accountConfirm->Status = AccountRecovery::STATUS_ACTIVE;
                $accountConfirm->save();
                $accountConfirm->sendRegistrationEmail();

                $this->redirect(array('site/login'));
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

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->ID));
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
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function createMessage($user) {
        $message = new Message;
        if (isset($_POST['Message'])) {
            $message->attributes = $_POST['Message'];

            $thread = MessageThread::model()->find(array(
                'select' => 'ID',
                'condition' => 'SubjectID LIKE :subject AND (User1 like :sender OR User1 like :recipient) AND (User2 like :sender OR User2 like :recipient)',
                'params' => array
                    (':subject' => $message->SubjectID, ':sender' => Yii::app()->user->id, ':recipient' => $user->ID))
            );

            if ($thread == NULL) {
                $thread = new MessageThread;
                $thread->SubjectID = $message->SubjectID;
                $thread->User1 = $user->ID;
                $thread->User2 = Yii::app()->user->id;
                $thread->save();
            }
            $message->ThreadID = $thread->ID;

            if ($user->sendMessage($message)) {
                Yii::app()->user->setFlash('messageSubmitted', "Your message has been sent.");
                $this->refresh();
            }
        }
        return $message;
    }

    public function actionChangePassword() {
        $model = $this->loadModel(Yii::app()->user->id);

        $model->setScenario('changePassword');

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $this->redirect(array('vendorProfile/profile'));
            }
        }

        $this->render('changePassword', array(
            'model' => $model,
        ));
    }

    /**
     * Updates logo of currently logged in vendor.
     * If update is successful, the browser will be redirected to the 'profile' page.
     */
    public function actionUpdateProfilePic() {
        $model = UserProfile::model()->findByPk(Yii::app()->user->id);
        if ($model == NULL) {
            $model = new UserProfile;
            $model->UserID = Yii::app()->user->id;
            $model->save();
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['UserProfile'])) {
            $model->attributes = $_POST['UserProfile'];

            $uploadedFile = CUploadedFile::getInstance($model, 'ProfilePic');
            if (!empty($uploadedFile)) {
                $model->ProfilePic = $this->convertFilenameToMD5($uploadedFile->name);
                if ($model->validate()) {
                    $this->saveImage($uploadedFile, $model->ProfilePic);
                    $model->save();
                }
                $this->refresh();
            }
        }

        $this->render('updateProfilePic', array(
            'model' => $model,
        ));
    }

    public function saveImage($uploadedFile, $filename) {

        if (!is_dir(Yii::getPathOfAlias('webroot') . '/images/profile/')) {
            mkdir(Yii::getPathOfAlias('webroot') . '/images/profile/');
            chmod(Yii::getPathOfAlias('webroot') . '/images/profile/', 0755);
            // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
        }

        $dir = Yii::getPathOfAlias('webroot') . '/images/profile/';



        if ($uploadedFile->saveAs($dir . $filename)) {
            $picture = new Iwi($dir . $filename);
            //resize all pictures to a consistent width
            $picture->resize(600, NULL, Iwi::HEIGHT)->crop(300, 300);
            $picture->save($dir . $filename);
        }
        return $filename;
    }

    //Hash the filename using MD5 and current timestamp
    private function convertFilenameToMD5($filename) {
        $filenameParts = explode('.', $filename);
        $count = count($filenameParts);
        if ($count > 1) {
            $ext = $filenameParts[$count - 1];
            unset($filenameParts[$count - 1]);
            $filenameToMD5 = implode('.', $filenameParts);
            $newName = md5($filenameToMD5 . time()) . '.' . $ext;
        } else {
            $newName = md5($filenameToMD5 . time());
        }
        return $newName;
    }

    public function actionRemovePic() {

        $model = UserProfile::model()->findByPk(Yii::app()->user->id);
        if ($model->ProfilePic != NULL) {
            $dir = Yii::getPathOfAlias('webroot') . '/images/profile/';
            unlink($dir . $model->ProfilePic);
            $model->ProfilePic = NULL;
            $model->save();
        }

        $this->redirect('updateProfilePic');
    }

    public function actionRegisterVendor() {
        $model = new User;
        $model->setScenario('create');
        if (Yii::app()->user->isGuest) {

            $this->performAjaxValidation($model);

            if (isset($_POST['User'])) {
                $model->attributes = $_POST['User'];

                $pass = $model->Password;
                if ($model->validate()) {
                    $tempUser = new TempUser();
                    $tempUser->attributes = $model->attributes;
                    $tempUser->Password = $pass;
                    $tempUser->ID = md5(time() . rand(10000, 20000));
                    $tempUser->save();

                    $this->redirect(array('vendorProfile/create', 'uid' => $tempUser->ID));
                }
            }
            $this->render('registerVendor', array(
                'model' => $model,
            ));
        } else {
            $this->redirect(array('vendorProfile/create'));
        }
    }

    public function actionConfirmEmail($confirmationCode) {
        $model = AccountRecovery::model()->findByPk($confirmationCode);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        if ($model->Status == AccountRecovery::STATUS_EXPIRED) {
            Yii::app()->user->setFlash('error', "The confirmation code is invalid. You may request a new one");
            $this->redirect(array('site/login'));
        } else {
            User::model()->updateByPk($model->UserID, array('Status' => User::STATUS_CONFIRMED));
            $model->sendConfirmationEmail();
            Yii::app()->user->setFlash('success', "You have successfully confirmed your account.");
            $model->Status = AccountRecovery::STATUS_EXPIRED;
            $model->save();
            $this->redirect(array('site/index'));
        }
    }

}
