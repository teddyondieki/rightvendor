<?php

class GalleryImageController extends Controller {

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
                'actions' => array('view', 'like', 'color', 'share'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index',),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new GalleryImage;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['GalleryImage'])) {
            $model->attributes = $_POST['GalleryImage'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->ID));
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

        if (isset($_POST['GalleryImage'])) {
            $model->attributes = $_POST['GalleryImage'];
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
        $dataProvider = new CActiveDataProvider('GalleryImage');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new GalleryImage('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['GalleryImage']))
            $model->attributes = $_GET['GalleryImage'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return GalleryImage the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = GalleryImage::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param GalleryImage $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gallery-image-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLike($id) {
//        throw new CHttpException(404, 'Not reachable');
        $model = $this->loadModel($id);

        $ip = $_SERVER["REMOTE_ADDR"];
        $like = Like::model()->findByAttributes(array('ImageID' => $model->ID, 'IPAddress' => $ip, 'UserID' => Yii::app()->user->id));

        if ($like == null) {
            $like = new Like;
            $like->ImageID = $id;
            $like->UserID = Yii::app()->user->id;
            $like->ProjectID = $model->ProjectID;
            $like->IPAddress = $_SERVER["REMOTE_ADDR"];
            $like->save();
            $model->project->updateLikes();
            if ($model->project->UserID != Yii::app()->user->id) {
                $notification = new Notification;
                $notification->Type = Notification::TYPE_LIKE_IMAGE;
                $notification->Status = Notification::STATUS_UNSEEN;
                $notification->ImageID = $id;
                $notification->ProjectID = $model->project->ID;
                $notification->VendorID = $model->project->UserID;
                $notification->GuestID = Yii::app()->user->id;
                $notification->save();
            }
        }
        echo '<button type="button" class="btn btn-primary btn-xs active"><span class="glyphicon glyphicon-heart"></span> You like this</button>';


//        $this->redirect(array('site/index'));
    }

    public function actionColor($hex) {

        $criteria = new CDbCriteria();

        $criteria->condition = 'ColorTags LIKE :hex ';
        $criteria->params = array(':hex' => '%' . $hex . '%');
        $criteria->limit = 8;

        $dataProvider = new CActiveDataProvider('GalleryImage', array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'ID DESC',
                'attributes' => array('*'),
            ),
        ));
        $dataProvider->setPagination(false);
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionShare($id) {

        $this->layout = '//layouts/blank';

        $this->render('share', array(
            'model' => $this->loadModel($id),
        ));
    }

}
