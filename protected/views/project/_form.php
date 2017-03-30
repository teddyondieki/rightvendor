<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'project-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
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

    <div class="form-group">

        <label for="images">Images</label>
        <?php
        $this->widget('CMultiFileUpload', array(
            'name' => 'images',
            'accept' => 'jpeg|jpg|png',
            'duplicate' => 'Duplicate file!',
            'denied' => 'Invalid file type',
            'htmlOptions' => array(
                'class' => 'btn btn-default btn-sm text-uppercase'
            ),
        ));
        ?>

    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->