<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs = array(
    'Projects' => array('index'),
    $model->Title => array('view', 'id' => $model->ID),
    'Update',
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
                    <h3 class="panel-title">Update Project information</h3>
                </div>
                <div class="panel-body">
                    <div class="form">

                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'project-form',
                            // Please note: When you enable ajax validation, make sure the corresponding
                            // controller action is handling ajax validation correctly.
                            // There is a call to performAjaxValidation() commented in generated controller code.
                            // See class documentation of CActiveForm for details on this.
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                        ));
                        ?>

                        <?php // echo $form->errorSummary($model); ?>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'Title'); ?>
                            <?php echo $form->error($model, 'Title', array('class' => 'text-danger')); ?>
                            <?php echo $form->textField($model, 'Title', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Title')); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'Venue'); ?>
                            <?php echo $form->error($model, 'Venue', array('class' => 'text-danger')); ?>
                            <?php echo $form->textField($model, 'Venue', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => 'Venue')); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'Description'); ?>
                            <?php echo $form->error($model, 'Description', array('class' => 'text-danger')); ?>
                            <?php echo $form->textArea($model, 'Description', array('rows' => 6, 'cols' => 50, 'maxlength' => 1000, 'class' => 'form-control', 'placeholder' => 'Details')); ?>
                        </div>

                    


                        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-lg btn-primary')); ?>

                        <?php $this->endWidget(); ?>

                    </div><!-- form -->

                </div>
            </div>
        </div>       
    </div>
</div>