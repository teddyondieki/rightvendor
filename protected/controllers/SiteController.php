<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
       
        $model = new VendorProfile;

        $hex = NULL;
        if (isset($_GET['hex'])) {
            $hex = $_GET['hex'];

            $criteria = new CDbCriteria();
            $criteria->condition = 'ColorTags LIKE :hex ';
            $criteria->params = array(':hex' => '%' . trim($hex) . '%');
            $dataProvider = new CActiveDataProvider('GalleryImage', array(
                'criteria' => $criteria,
                'sort' => array(
                    'defaultOrder' => 'ID DESC',
                    'attributes' => array('*'),
                ),
            ));
            $dataProvider->setPagination(FALSE);

            $this->render('index', array(
                'dataProvider' => $dataProvider,
                'colorTag' => $hex,
                'model' => $model
            ));
        } else {

            $this->render('index', array(
//                'dataProvider' => $dataProvider,
                'colorTag' => $hex,
                'model' => $model
            ));
        }





//        $this->render('index', array(
//            'model' => $model,
//        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionVendor() {
        $this->render('vendor');
    }

    public function actionSearch() {
        if (isset($_GET['q']) && (strlen(trim($_GET['q'])) > 0)) {
            $query = '%' . trim($_GET['q']) . '%';
            $projectCriteria = new CDbCriteria();
            $projectCriteria->condition = 'Title like :query OR Description like :query OR Venue like :query';
            $projectCriteria->params = array(':query' => $query);
            $projectDataProvider = new CActiveDataProvider('Project', array(
                'criteria' => $projectCriteria,
                'sort' => array(
                    'defaultOrder' => 'TotalLikes DESC',
                    'attributes' => array('*'),
                ),
//                'pagination' => array(
//                    'pageSize' => 5,
//                ),
            ));
//            $projectDataProvider->setPagination(5);

            $vendorCriteria = new CDbCriteria();
            $vendorCriteria->condition = '(BusinessName like :query OR Address like :query) AND Status = :status';
            $vendorCriteria->params = array(':query' => $query, ':status' => VendorProfile::APPROVED);
            $vendorDataProvider = new CActiveDataProvider('VendorProfile', array(
                'criteria' => $vendorCriteria,
                'sort' => array(
                    'defaultOrder' => 'VendorID ASC',
                    'attributes' => array('*'),
                ),
            ));
//            $vendorDataProvider->setPagination(FALSE);

            $this->render('searchResult', array(
                'projectDataProvider' => $projectDataProvider,
                'vendorDataProvider' => $vendorDataProvider,
                'query' => $_GET['q'],
            ));
        } else {
            $this->redirect(array('index'));
        }
    }

}
