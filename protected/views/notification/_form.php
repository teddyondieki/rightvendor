<?php
/* @var $this NotificationController */
/* @var $model Notification */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Type'); ?>
		<?php echo $form->textField($model,'Type'); ?>
		<?php echo $form->error($model,'Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ImageID'); ?>
		<?php echo $form->textField($model,'ImageID'); ?>
		<?php echo $form->error($model,'ImageID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'GuestID'); ?>
		<?php echo $form->textField($model,'GuestID'); ?>
		<?php echo $form->error($model,'GuestID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VendorID'); ?>
		<?php echo $form->textField($model,'VendorID'); ?>
		<?php echo $form->error($model,'VendorID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
		<?php echo $form->textField($model,'Status'); ?>
		<?php echo $form->error($model,'Status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreateTime'); ?>
		<?php echo $form->textField($model,'CreateTime',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'CreateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UpdateTime'); ?>
		<?php echo $form->textField($model,'UpdateTime',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'UpdateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->