<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comment-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

    <?php // echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php // echo $form->labelEx($model, 'Content'); ?>
        <?php echo $form->error($model, 'Content', array('class' => 'text-danger')); ?>
        <?php echo $form->textArea($model, 'Content', array('class' => 'form-control', 'cols' => 60, 'rows' => 3,'placeholder'=>'Add comment...', 'maxlength' => 1000)); ?>
    </div>

    <div class="text-right">
        <?php echo CHtml::submitButton('Post comment', array('class'=>'btn btn-default btn-md')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->