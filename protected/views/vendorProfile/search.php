<?php
/* @var $this SiteController */
/* @var $model VendorProfile */
/* @var $form CActiveForm */
?>
<div id="searchForm">
    
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => $this->createUrl('vendorProfile/index'),
        'method' => 'post',
        'htmlOptions' => array(
            'class' => 'form-inline',
            'role' => 'form'
    )));
    ?>
    <?php echo $form->dropDownList($model, 'Category', ProjectCategory::read(), array('empty' => 'All Categories', 'class' => 'form-control input-md')); ?>

    <?php echo $form->dropDownList($model, 'City', City::read(), array('empty' => 'All Locations', 'class' => 'form-control input-md')); ?>

    <?php echo CHtml::submitButton('Search Vendors', array('class' => 'btn btn-default btn-md')); ?>


    <!--    REALLY NICE TO HAVE <div class="form-group">
            ( <input type="checkbox"> include projects )
        </div>-->

    <?php $this->endWidget(); ?>

</div>