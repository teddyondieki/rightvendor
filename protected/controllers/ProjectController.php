<?php

class ProjectController extends Controller {

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
                'actions' => array('permalink'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'updateInfo', 'updateGallery', 'uploadImages', 'setMainImage', 'deleteImage'),
                'roles' => array('vendor'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'index', 'view'),
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


        $ip = $_SERVER["REMOTE_ADDR"];
        $agent = $_SERVER["HTTP_USER_AGENT"];

        $view = ProjectView::model()->findByAttributes(array('ProjectID' => $model->ID, 'IPAddress' => $ip, 'UserID' => Yii::app()->user->id));


        if ($view == null) {
            $view = new ProjectView();
            $view->IPAddress = $ip;
            $view->UserAgent = $agent;
            $view->ProjectID = $model->ID;
            $view->UserID = Yii::app()->user->id;
            $view->save();
            $model->updateViewCount();
        } else {
            $view->UserAgent = $agent;
            $view->save();
        }

        $comment = $this->createComment($model);
        $message = $this->createMessage($model->vendorProfile);

        $this->render('view', array(
            'model' => $model,
            'comment' => $comment,
            'message' => $message,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Project;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Project'])) {
            $model->attributes = $_POST['Project'];

            if ($model->save()) {
                $images = CUploadedFile::getInstancesByName('images');
                $this->saveImages($images, $model->ID);

                $this->redirect(array('updateGallery', 'id' => $model->ID));
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
    public function actionUpdateInfo($id) {
        $model = $this->loadModel($id, true);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Project'])) {
            $model->attributes = $_POST['Project'];
            Project::model()->updateByPk($model->ID, array('Title' => $model->Title, 'Venue' => $model->Venue, 'Description' => $model->Description,));

            if ($model->save()) {
                $this->redirect(array('vendorProfile/projects'));
            }
        }

        $this->render('updateInfo', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id, true);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Project'])) {
            $model->attributes = $_POST['Project'];

            if ($model->save()) {
                $images = CUploadedFile::getInstancesByName('images');
                $this->saveImages($images, $model->ID);

                $this->redirect(array('view', 'id' => $model->ID));
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
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Project');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Project('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Project']))
            $model->attributes = $_GET['Project'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Project the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $checkUser = false) {
        $model = Project::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        if ($checkUser) {
            if ($model->UserID != Yii::app()->user->id) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Project $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'project-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function saveImages($images, $projectId) {
        if (!is_dir(Yii::getPathOfAlias('webroot') . '/images/' . $projectId)) {
            mkdir(Yii::getPathOfAlias('webroot') . '/images/' . $projectId);
            chmod(Yii::getPathOfAlias('webroot') . '/images/' . $projectId, 0755);
            mkdir(Yii::getPathOfAlias('webroot') . '/images/' . $projectId . '/thumbs');
            chmod(Yii::getPathOfAlias('webroot') . '/images/' . $projectId . '/thumbs', 0755);
            // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
        }
        if (isset($images) && count($images) > 0) {
            $dir = Yii::getPathOfAlias('webroot') . '/images/' . $projectId . '/';
            $thumbDir = Yii::getPathOfAlias('webroot') . '/images/' . $projectId . '/thumbs/';
            foreach ($images as $image => $pic) {

                $filename = $this->convertFilenameToMD5($pic->name);

                if ($pic->saveAs($dir . $filename)) {
                    Yii::import('ext.iwi.Iwi');

                    $picture = new Iwi($dir . $filename);
                    //resize all pictures to a consistent width
                    $picture->resize(800, NULL, Iwi::WIDTH);
                    $picture->save($dir . $filename);
                    //create thumbnails
                    $picture->resize(300, NULL, Iwi::WIDTH)->sharpen(20)->quality(75);
                    $picture->save($thumbDir . $filename);
                    $img_add = new GalleryImage();
                    $img_add->Name = $filename;
                    $img_add->ProjectID = $projectId;
                    $img_add->IsFeatured = GalleryImage::NOT_FEATURED;
                    $img_add->save();

                    include_once( 'colorsofimage.class.php' );

                    $colors_of_image = new ColorsOfImage($dir . $filename, 10, 5);
                    $colors = $colors_of_image->getProminentColors();
                    $img_add->ColorTags = implode(",", $colors);
                    $img_add->save();
                } else {
                    //show error not saved   
                }
            }
        }
    }

    private function convertFilenameToMD5($filename) {
        $filenameParts = explode('.', $filename);
        $count = count($filenameParts);
        if ($count > 1) {
            $ext = $filenameParts[$count - 1];
            unset($filenameParts[$count - 1]);
            $filenameToMD5 = implode('.', $filenameParts);
            $newName = md5($filenameToMD5 . time()) . '.' . $ext;
        } else {
            $newName = md5($filename . time());
        }
        return $newName;
    }

    protected function createComment($project) {
        $comment = new Comment;
        if (isset($_POST['Comment'])) {
            $comment->attributes = $_POST['Comment'];
            if ($project->addComment($comment)) {
                Yii::app()->user->setFlash('commentSubmitted', "Your comment has been added.");
                $this->refresh();
            }
        }
        return $comment;
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

    public function actionUpdateGallery($id) {
        $model = $this->loadModel($id, true);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $this->render('updateGallery', array(
            'model' => $model,
        ));
    }

//then show notification of deleted image
    public function actionSetMainImage($id) {
        $image = $this->loadImage($id);
        Project::model()->updateByPk($image->ProjectID, array('MainImage' => $image->ID));
        $this->redirect(array('updateGallery', 'id' => $image->ProjectID));
    }

    public function loadImage($id) {
        $model = GalleryImage::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionDeleteImage($id) {
        $image = $this->loadImage($id);
        if ($image->project->UserID == Yii::app()->user->id) {
            $project = Project::model()->findByAttributes(array('MainImage' => $image->ID));
            if ($project != NULL) {
                $project->MainImage = NULL;
                $project->save();
            }

            $dir = Yii::getPathOfAlias('webroot') . '/images/' . $image->ProjectID . '/';
            $thumbDir = Yii::getPathOfAlias('webroot') . '/images/' . $image->ProjectID . '/thumbs/';
            $image->delete();
            unlink($dir . $image->Name);
            unlink($thumbDir . $image->Name);
        } else {
            throw new CHttpException(403, 'You are not authorised to perform the action');
        }
        $this->redirect(array('updateGallery', 'id' => $image->ProjectID));
    }

    public function actionUploadImages($id) {
        $model = $this->loadModel($id, true);


        $images = CUploadedFile::getInstancesByName('images');
        if (!empty($images)) {
            $this->saveImages($images, $model->ID);
        }

        $this->redirect(array('updateGallery', 'id' => $model->ID));
    }

    public function loadModelByPermalink($permalink) {
        $model = Project::model()->findByAttributes(array('Permalink' => $permalink));
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionPermalink($permalink) {
        $model = $this->loadModelByPermalink($permalink);

        $ip = $_SERVER["REMOTE_ADDR"];
        $agent = $_SERVER["HTTP_USER_AGENT"];

        $view = ProjectView::model()->findByAttributes(array('ProjectID' => $model->ID, 'IPAddress' => $ip, 'UserID' => Yii::app()->user->id));


        if ($view == null) {
            $view = new ProjectView();
            $view->IPAddress = $ip;
            $view->UserAgent = $agent;
            $view->ProjectID = $model->ID;
            $view->UserID = Yii::app()->user->id;
            $view->save();
            $model->updateViewCount();
        } else {
            $view->UserAgent = $agent;
            $view->save();
        }

        $comment = $this->createComment($model);
        $message = $this->createMessage($model->vendorProfile);

        $this->render('view', array(
            'model' => $model,
            'comment' => $comment,
            'message' => $message,
        ));
    }

}
