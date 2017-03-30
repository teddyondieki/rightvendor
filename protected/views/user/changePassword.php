<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    $model->Name,
);
?>

<div class="container">
    <div class="row">

        <div class="col-lg-5">
            <?php $this->renderPartial('/vendorProfile/_sidebar'); ?>
        </div> 
        <div class="col-lg-15">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Change password</h3>
                </div>
                <div class="panel-body">

                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'user-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,));
                    ?>

                    <?php // echo $form->errorSummary($model); ?>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'Password_old'); ?>
                        <?php echo $form->error($model, 'Password_old', array('class' => 'text-danger')); ?>
                        <?php echo $form->passwordField($model, 'Password_old', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Password', 'value' => '')); ?>
                    </div>
                    <hr/>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'Password'); ?>
                        <?php echo $form->error($model, 'Password', array('class' => 'text-danger')); ?>
                        <?php echo $form->passwordField($model, 'Password', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Password', 'value' => '')); ?>
                    </div>


                    <div class="form-group">
                        <?php echo $form->label($model, 'Password_repeat'); ?>
                        <?php echo $form->error($model, 'Password_repeat', array('class' => 'text-danger')); ?>
                        <?php echo $form->passwordField($model, 'Password_repeat', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Confirm password', 'value' => '')); ?>
                    </div>


                    <?php echo CHtml::submitButton('Change password', array('class' => 'btn btn-lg btn-primary')); ?>

                    <?php $this->endWidget(); ?>

                </div>
            </div>
        </div>       
    </div>
</div>

