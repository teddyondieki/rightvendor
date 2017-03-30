<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'message-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>


    <?php // echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->error($model, 'SubjectID', array('class' => 'text-danger')); ?>
        <?php echo $form->dropDownList($model, 'SubjectID', Subject::read(), array('class' => 'form-control', 'empty' => 'Select Subject')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->error($model, 'Content', array('class' => 'text-danger')); ?>      
        <?php echo $form->textArea($model, 'Content', array('size' => 60, 'maxlength' => 1000, 'placeholder' => 'Type question...', 'class' => 'form-control')); ?>
    </div>


    <div class="text-right">
        <?php echo CHtml::submitButton('Send message', array('class' => 'btn btn-default')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->