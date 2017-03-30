<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;

Yii::app()->clientScript->registerCoreScript("jquery");
//Yii::app()->clientScript->registerScriptFile("http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/bootstrap.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/masonry.pkgd.js");
//Yii::app()->clientScript->registerScriptFile("js/jquery.isotope.min.js");
//Yii::app()->clientScript->registerScriptFile("js/mql.js");
//Yii::app()->clientScript->registerScriptFile("js/reddit.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/script.js");

$this->breadcrumbs = array(
    'Search Results for: "' . $query . '"',
);
?>

<div class="container">


    <h3>Vendors:</h3>
    <div class="row">

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $vendorDataProvider,
            'itemView' => '/vendorProfile/_view',
            'summaryText' => '',
        ));
        ?>
    </div>

    <div class="container">

        <h3>Projects:</h3>

        <div id="posts" class="row isotope">


            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $projectDataProvider,
                'itemView' => '_searchItem',
                'summaryText' => '',
            ));
            ?>
        </div>
    </div>
</div>