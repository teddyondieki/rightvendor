<?php
/* @var $this VendorProfileController */
/* @var $model User */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'Vendor' => array('site/vendor'),
    '1: User Details'
);
?>

<div class="container">

    <div class="panel panel-default vendorSignUp">
        <div class="panel-heading">
            <h3 class="panel-title">
                <!--Step 1: Create account-->
                <ul class="nav nav-pills nav-justified">
                    <li class="active"><a>1: User Details</a></li>
                    <li><a>2: Business Details</a></li>
                </ul>
            </h3>
        </div>
        <div class="panel-body">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'user-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation' => true,
//    'clientOptions' => array(
//        'validateOnSubmit' => true,
//    ),
                'htmlOptions' => array(
                    'class' => 'form-signin'
                ),
            ));
            ?>

            <?php // echo $form->errorSummary($model);  ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'Name'); ?>
                <?php echo $form->error($model, 'Name', array('class' => 'text-danger')); ?>
                <?php echo $form->textField($model, 'Name', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Name')); ?>
            </div>


            <div class="form-group">  
                <?php echo $form->labelEx($model, 'Email'); ?>
                <?php echo $form->error($model, 'Email', array('class' => 'text-danger')); ?>
                <?php echo $form->textField($model, 'Email', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Email address')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'Password'); ?>
                <?php echo $form->error($model, 'Password', array('class' => 'text-danger')); ?>
                <?php echo $form->passwordField($model, 'Password', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Password', 'value' => '')); ?>
            </div>


            <div class="form-group">
                <?php echo $form->label($model, 'Password_repeat'); ?>
                <?php echo $form->error($model, 'Password', array('class' => 'text-danger')); ?>
                <?php echo $form->passwordField($model, 'Password_repeat', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Confirm password', 'value' => '')); ?>

            </div>

            <?php echo CHtml::submitButton('Next', array('class' => 'btn btn-lg btn-primary text-uppercase btn-block')); ?>

            <?php $this->endWidget(); ?>

        </div>
    </div>
</div>

