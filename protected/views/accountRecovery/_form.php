<?php
/* @var $this AccountRecoveryController */
/* @var $model AccountRecovery */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'account-recovery-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-signin'
        ),
    ));
    ?>

    <!--<h2 class="form-signin-heading">Account recovery</h2>-->
    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'Email'); ?>
        <?php echo $form->textField($model, 'Email', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control', 'placeholder' => 'Email address')); ?>
        <?php // echo $form->error($model, 'Email'); ?>
    </div>

    <?php echo CHtml::submitButton('Send recovery email', array('class' => 'btn btn-lg btn-primary btn-block')); ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->