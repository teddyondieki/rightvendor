<?php
/* @var $this VendorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Projects',
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
  
    <div class="row">

        <div class="col-lg-5">
            <?php $this->renderPartial('_sidebar'); ?>
        </div>
        <div class="col-lg-15">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Manage your projects</h3>
                </div>
                <div class="panel-body">
                    <div id="posts" class="isotope row">
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $dataProvider,
                            'itemView' => '_projectView',
                            'summaryText'=>''
                        ));
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

