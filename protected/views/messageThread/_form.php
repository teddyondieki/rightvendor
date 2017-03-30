<?php
/* @var $this MessageThreadController */
/* @var $model MessageThread */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-thread-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'SubjectID'); ?>
		<?php echo $form->textField($model,'SubjectID'); ?>
		<?php echo $form->error($model,'SubjectID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'User1'); ?>
		<?php echo $form->textField($model,'User1'); ?>
		<?php echo $form->error($model,'User1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'User2'); ?>
		<?php echo $form->textField($model,'User2'); ?>
		<?php echo $form->error($model,'User2'); ?>
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