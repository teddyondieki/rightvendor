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

    <?php echo $form->errorSummary($model); ?>
    <div class="form-group">
        <?php echo $form->textArea($model, 'Content', array('rows' => 6, 'cols' => 50, 'maxlength' => 1000, 'class' => 'form-control')); ?>

    </div>
    <div class="text-right">
        <?php echo CHtml::submitButton('Send', array('class' => 'btn btn-lg btn-primary')); ?>

    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->