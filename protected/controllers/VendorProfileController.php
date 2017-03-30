<?php

class VendorProfileController extends Controller {

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
                'actions' => array('index', 'view', 'permalink', 'search', 'featured', 'create', 'reviews', 'projects', 'priceList'),
                'users' => array('*'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('dashboard', 'profile', 'updateProfile'),
                'roles' => array('vendor'),
            ),
//            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                'actions' => array('update'),
//                'users' => array('@'),
//            ),
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
     * Lets user view his profile
     */
//    public function actionProfile() {
//        $model = VendorProfile::model()->findByPk(Yii::app()->user->id);
//
//        if ($model == null) {
//            $this->redirect(array('create'));
//        } else {
//            $this->render('profile', array(
//                'model' => $model,
//            ));
//        }
//    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($uid) {
        $tempUser = $this->loadUser($uid);
        $model = new VendorProfile;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);


        if (isset($_POST['VendorProfile'])) {
            $model->attributes = $_POST['VendorProfile'];
            $model->VendorID = -1;

            if ($model->validate()) {
                $user = new User;

                $user->attributes = $tempUser->attributes;
                $user->Password_repeat = $user->Password;
                $user->isNewRecord = true;

                if ($user->save()) {

                    $tempUser->delete();
                    $model->VendorID = $user->ID;
                    $model->Status = VendorProfile::NOT_APPROVED;
                    $model->IsFeatured = VendorProfile::NOT_FEATURED;
                    $model->save();

                    $auth = Yii::app()->authManager;
                    $auth->assign('vendor', $user->ID);

                    $userProfile = new UserProfile;
                    $userProfile->UserID = $user->ID;
                    $userProfile->save();

                    $accountConfirm = new AccountRecovery;
                    $accountConfirm->UserID = $user->ID;
                    $accountConfirm->Email = $user->Email;
                    $accountConfirm->RecoveryCode = substr(md5(time() . rand(10000, 20000)), 0, 15);
                    $accountConfirm->Status = AccountRecovery::STATUS_ACTIVE;
                    $accountConfirm->save();
                    $accountConfirm->sendRegistrationEmail();
                    $this->redirect(array('site/login'));
                }
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

        if (isset($_POST['VendorProfile'])) {
            $model->attributes = $_POST['VendorProfile'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->VendorID));
            }
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
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionFeatured() {
        $criteria = new CDbCriteria();

        $criteria->condition = 'IsFeatured = :isFeatured AND Status = :status';
        $criteria->params = array(':isFeatured' => VendorProfile::FEATURED, ':status' => VendorProfile::APPROVED);
        $criteria->limit = 20;

        $dataProvider = new CActiveDataProvider('VendorProfile', array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'CreateTime DESC',
                'attributes' => array('*'),
            ),
        ));
        $dataProvider->setPagination(false);
        $this->render('featured', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $model = new VendorProfile('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['VendorProfile'])) {
            $model->attributes = $_POST['VendorProfile'];
        }

        $model->Status = VendorProfile::APPROVED;
        $dataProvider = $model->search();
        $dataProvider->pagination = false;
        $this->render('index', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new VendorProfile('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['VendorProfile']))
            $model->attributes = $_GET['VendorProfile'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return VendorProfile the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = VendorProfile::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function loadUser($id) {
        $model = TempUser::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param VendorProfile $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'vendor-profile-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionRegister() {
        $user = new User;
        $user->setScenario('create');
        if (Yii::app()->user->isGuest) {

//            $this->performAjaxValidation($user);

            if (isset($_POST['User'])) {
                $user->attributes = $_POST['User'];

                $pass = $user->Password;
                if ($user->validate()) {
                    $tempUser = new TempUser();
                    $tempUser->attributes = $user->attributes;
                    $tempUser->Password = $pass;
                    $tempUser->save();

                    $this->redirect(array('create', 'uid' => $tempUser->ID));
                }
            }
            $this->render('registerUser', array(
                'model' => $user,
            ));
        } else {
            $this->redirect('create');
        }
    }

    public function actionSearch() {

        $model = new VendorProfile('search');
        $model->unsetAttributes();  // clear any default values
        $model->City = -1;
        if (isset($_POST['VendorProfile'])) {
            $model->attributes = $_POST['VendorProfile'];
        }
        $dataProvider = $model->search();
        $dataProvider->pagination->pageSize = 5;
        $this->render('index', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
    }

    protected function createMessage($vendorProfile) {
        $message = new Message;
        if (isset($_POST['Message'])) {
            if (!Yii::app()->user->isGuest) {
                $user = User::model()->findByPk($vendorProfile->VendorID);
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
            } else {
                Yii::app()->user->setFlash('messageFailed', '');
                $this->refresh();
            }
        }
        return $message;
    }

    public function saveImage($uploadedFile, $filename) {

        if (!is_dir(Yii::getPathOfAlias('webroot') . '/images/logos/')) {
            mkdir(Yii::getPathOfAlias('webroot') . '/images/logos/');
            chmod(Yii::getPathOfAlias('webroot') . '/images/logos/', 0755);
            // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
        }

        $dir = Yii::getPathOfAlias('webroot') . '/images/logos/';

        Yii::import('ext.iwi.Iwi');

        if ($uploadedFile->saveAs($dir . $filename)) {
            $picture = new Iwi($dir . $filename);
            //resize all pictures to a consistent width
            $picture->resize(600, NULL, Iwi::HEIGHT)->crop(300, 300);
            $picture->save($dir . $filename);
        }
        return $filename;
    }

    //Hash the filename using MD5 and current timestamp
//    private function convertFilenameToMD5($filename) {
//        $filenameParts = explode('.', $filename);
//        $count = count($filenameParts);
//        if ($count > 1) {
//            $ext = $filenameParts[$count - 1];
//            unset($filenameParts[$count - 1]);
//            $filenameToMD5 = implode('.', $filenameParts);
//            $newName = md5($filenameToMD5 . time()) . '.' . $ext;
//        } else {
//            $newName = md5($filenameToMD5 . time());
//        }
//        return $newName;
//    }

    public function loadVendorProfile($id) {
        $model = VendorProfile::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionPriceList($id) {
        $model = $this->loadModel($id);
        $message = $this->createMessage($model);

        $this->render('priceList', array(
            'model' => $model,
            'message' => $message
        ));
    }

    public function actionReviews($id) {
        $model = $this->loadModel($id);
        $review = $this->createReview($model);
        $message = $this->createMessage($model);

        $this->render('reviews', array(
            'model' => $model,
            'review' => $review,
            'message' => $message
        ));
    }

    protected function createReview($vendorProfile) {
        $review = new Review;
        if (isset($_POST['Review'])) {
            $review->attributes = $_POST['Review'];
            $review->Rating = $_POST['rating'];
            if ($vendorProfile->addReview($review)) {
                Yii::app()->user->setFlash('commentSubmitted', "Your comment has been added.");
                $this->refresh();
            }
        }
        return $review;
    }

    public function actionProjects() {
        $criteria = new CDbCriteria();

        $criteria->condition = 'UserID = ' . Yii::app()->user->id;
        $criteria->limit = 8;

        $dataProvider = new CActiveDataProvider('Project', array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'CreateTime DESC',
                'attributes' => array('*'),
            ),
        ));
        $dataProvider->setPagination(false);
        $this->render('projects', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Updates profile of currently logged in vendor.
     * If update is successful, the browser will be redirected to the 'profile' page.
     */
    public function actionProfile() {
        $model = $this->loadModel(Yii::app()->user->id);

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if (isset($_POST['VendorProfile'])) {
            $model->attributes = $_POST['VendorProfile'];
            if ($model->save()) {
                $this->redirect('profile');
            }
        }

        $this->render('profileUpdate', array(
            'model' => $model,
        ));
    }

    public function loadModelByPermalink($permalink) {
        $model = VendorProfile::model()->findByAttributes(array('Permalink' => $permalink));
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionPermalink($permalink) {
        $model = $this->loadModelByPermalink($permalink);
        $message = $this->createMessage($model);

        $this->render('view', array(
            'model' => $model,
            'message' => $message
        ));
    }

    public function actionDashboard() {
        $this->redirect('projects');
    }

}
