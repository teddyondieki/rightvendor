<?php
/* @var $this AccountRecoveryController */
/* @var $model User */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'New Password',
);
?>

<div class="container">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'class' => 'form-signin'
        ),
    ));
    ?>

    <h2 class="form-signin-heading">New password</h2>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'Password'); ?>
        <?php echo $form->passwordField($model, 'Password', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Password', 'value' => '')); ?>
        <?php echo $form->error($model, 'Password'); ?>
    </div>


    <div class="form-group">
        <?php echo $form->label($model, 'Password_repeat'); ?>
        <?php echo $form->passwordField($model, 'Password_repeat', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Confirm password', 'value' => '')); ?>
        <?php echo $form->error($model, 'Password_repeat'); ?>
    </div>

    <?php echo CHtml::submitButton('Change password', array('class' => 'btn btn-lg btn-primary')); ?>

    <?php $this->endWidget(); ?>



</div> <!-- /container -->
