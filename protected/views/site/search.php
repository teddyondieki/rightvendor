<?php
/* @var $this SiteController */
/* @var $model VendorProfile */
/* @var $form CActiveForm */
?>
<div id="searchForm">
    <!--<div class="row">-->

        <div class="welcomeText">
            <strong>Welcome to <?php echo Yii::app()->name; ?></strong>, a vibrant community of wedding vendors, engaged and married couples.
        </div>
    <!--</div>-->
   
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => $this->createUrl('vendorProfile/index'),
        'method' => 'post',
        'htmlOptions' => array(
            'class' => 'form-inline',
            'role' => 'form'
    )));
    ?>
    <?php echo $form->dropDownList($model, 'Category', ProjectCategory::read(), array('empty' => 'All Categories', 'class' => 'form-control input-lg')); ?>

    <?php echo $form->dropDownList($model, 'City', City::read(), array('empty' => 'All Locations', 'class' => 'form-control input-lg')); ?>

    <?php echo CHtml::submitButton('Search Vendors', array('class' => 'btn btn-default btn-lg')); ?>


    <!--    REALLY NICE TO HAVE <div class="form-group">
            ( <input type="checkbox"> include projects )
        </div>-->

    <?php $this->endWidget(); ?>

</div>