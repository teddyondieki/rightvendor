<?php
/* @var $this VendorProfileController */
/* @var $model VendorProfile */

$this->breadcrumbs = array(
    'Dashboard'
);
?>

<div class="container">
    <div class="row">

        <div class="col-lg-5">
            <?php $this->renderPartial('_sidebar'); ?>
        </div> 
        <div class="col-lg-15">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update business information</h3>
                </div>
                <div class="panel-body">


                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'vendor-profile-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => true,
                    ));
                    ?>

                    <?php echo $form->errorSummary($model); ?>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'BusinessName'); ?>
                        <?php echo $form->error($model, 'BusinessName', array('class' => 'text-danger')); ?>
                        <?php echo $form->textField($model, 'BusinessName', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Business Name')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'Website'); ?>
                        <?php echo $form->error($model, 'Website', array('class' => 'text-danger')); ?>
                        <?php echo $form->textField($model, 'Website', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Website')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'Email'); ?>
                        <?php echo $form->error($model, 'Email', array('class' => 'text-danger')); ?>
                        <?php echo $form->textField($model, 'Email', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Business email')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'Phonenumber'); ?>
                        <?php echo $form->error($model, 'Phonenumber', array('class' => 'text-danger')); ?>
                        <?php echo $form->textField($model, 'Phonenumber', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Phonenumber')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'Address'); ?>
                        <?php echo $form->error($model, 'Address', array('class' => 'text-danger')); ?>
                        <?php echo $form->textArea($model, 'Address', array('size' => 60, 'maxlength' => 1000, 'class' => 'form-control', 'placeholder' => 'Business address')); ?>
                    </div>

                    <?php echo $form->hiddenField($model, 'VendorID'); ?>

                    <div>
                        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-lg btn-primary')); ?>
                    </div>
                    <?php $this->endWidget(); ?>

                </div>
            </div>
        </div>       
    </div>
</div>


