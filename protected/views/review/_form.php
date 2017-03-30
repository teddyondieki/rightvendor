<?php
/* @var $this ReviewController */
/* @var $model Review */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'review-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>



    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">

        <?php
        $this->widget('CStarRating', array(
            'name' => 'rating',
            'value' => '4',
            'minRating' => 1,
            'maxRating' => 5,
//        'starCount' => 10,
        ));
        ?>      <br/>
        <?php // echo $form->labelEx($model, 'Content'); ?>
        <?php echo $form->error($model, 'Content'); ?>
        <?php echo $form->textArea($model, 'Content', array('rows' => 3, 'cols' => 50, 'class' => 'form-control', 'placeholder' => 'Type review here...', 'maxlength' => 1000)); ?>

    </div>

    <div class="text-right">
        <?php echo CHtml::submitButton('Post review', array('class' => 'btn btn-md btn-default')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->