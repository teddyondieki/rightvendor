<?php
/* @var $this VendorProfileController */
/* @var $model VendorProfile */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'vendor-profile-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => true,
    'htmlOptions' => array(
        'class' => 'form-signin'
    ),
        ));
?>


<?php // echo $form->errorSummary($model); ?>



<div class="form-group">
    <?php echo $form->labelEx($model, 'BusinessName'); ?>
    <?php echo $form->error($model, 'BusinessName', array('class' => 'text-danger')); ?>
    <?php echo $form->textField($model, 'BusinessName', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Business Name')); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'Category'); ?>
    <?php echo $form->error($model, 'Category', array('class' => 'text-danger')); ?>
    <?php echo $form->dropDownList($model, 'Category', ProjectCategory::read(), array('empty' => 'Select Business Category', 'class' => 'form-control')); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'City'); ?>
    <?php echo $form->error($model, 'City', array('class' => 'text-danger')); ?>
    <?php echo $form->dropDownList($model, 'City', City::read(), array('empty' => 'Select Business Location', 'class' => 'form-control')); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'Address'); ?>
    <?php echo $form->error($model, 'Address', array('class' => 'text-danger')); ?>
    <?php echo $form->textArea($model, 'Address', array('rows' => 3, 'maxlength' => 1000, 'class' => 'form-control', 'placeholder' => 'Business address')); ?>
</div>


<div class="form-group">
    <?php echo $form->labelEx($model, 'Phonenumber'); ?>
    <?php echo $form->error($model, 'Phonenumber', array('class' => 'text-danger')); ?>
    <?php echo $form->textField($model, 'Phonenumber', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Phonenumber')); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'Email'); ?>
    <?php echo $form->error($model, 'Email', array('class' => 'text-danger')); ?>
    <?php echo $form->textField($model, 'Email', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Business email')); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'Website'); ?>
    <?php echo $form->error($model, 'Website', array('class' => 'text-danger')); ?>
    <?php echo $form->textField($model, 'Website', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Website')); ?>
</div>

<?php echo $form->hiddenField($model, 'VendorID'); ?>

<?php echo CHtml::submitButton($model->isNewRecord ? 'Finish' : 'Save', array('class' => 'btn btn-lg btn-primary text-uppercase btn-block')); ?>

<?php $this->endWidget(); ?>
