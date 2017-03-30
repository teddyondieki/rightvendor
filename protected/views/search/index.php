<?php
/* @var $this SearchController */
/* @var $model VendorProfile */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'vendor-profile-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'City'); ?>
        <?php echo $form->dropDownList($model, 'City', City::read(), array('empty' => '-City-')); ?>
        <?php echo $form->error($model, 'City'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Category'); ?>
        <?php echo $form->dropDownList($model, 'Category', ProjectCategory::read(), array('empty' => '-Category-')); ?>
        <?php echo $form->error($model, 'Category'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search Vendor'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '/vendorProfile/_view',
));
?>