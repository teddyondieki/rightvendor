<?php
/* @var $this GalleryImageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Gallery Images',
);

$this->menu = array(
    array('label' => 'Create GalleryImage', 'url' => array('create')),
    array('label' => 'Manage GalleryImage', 'url' => array('admin')),
);

Yii::app()->clientScript->registerCoreScript("jquery");
//Yii::app()->clientScript->registerScriptFile("http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/bootstrap.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/masonry.pkgd.js");
//Yii::app()->clientScript->registerScriptFile("js/jquery.isotope.min.js");
//Yii::app()->clientScript->registerScriptFile("js/mql.js");
//Yii::app()->clientScript->registerScriptFile("js/reddit.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/script.js");
?>
<div class="container">


    <div id="posts" class="row isotope">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'summaryText' => ''
        ));
        ?>
    </div>

</div>