<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>


<div class="panel panel-default userForm">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="glyphicon glyphicon-comment"></span> Talk To Us
        </h3>
    </div>
    <div class="panel-body">
        <?php if (Yii::app()->user->hasFlash('contact')): ?>

            <div class="flash-success">
                <?php echo Yii::app()->user->getFlash('contact'); ?>
            </div>

        <?php else: ?>

            <p>
                If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
            </p>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'contact-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>

            <?php // echo $form->errorSummary($model); ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'name'); ?>
                <?php echo $form->error($model, 'name', array('class' => 'text-danger')); ?>
                <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => 'Name')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->error($model, 'email', array('class' => 'text-danger')); ?>
                <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Email')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'subject'); ?>
                <?php echo $form->error($model, 'subject', array('class' => 'text-danger')); ?>
                <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control', 'placeholder' => 'Subject')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'body'); ?>
                <?php echo $form->error($model, 'body', array('class' => 'text-danger')); ?>
                <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50, 'class' => 'form-control', 'placeholder' => 'Message')); ?>
            </div>

            <?php if (CCaptcha::checkRequirements()): ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'verifyCode'); ?>

                    <div>
                        <?php $this->widget('CCaptcha'); ?>
                        <?php echo $form->error($model, 'verifyCode', array('class' => 'text-danger')); ?>
                        <?php echo $form->textField($model, 'verifyCode', array('class' => 'form-control', 'placeholder' => 'Enter verification code')); ?>
                    </div>

                    <p class="help-block">              
                        Please enter the letters as they are shown in the image above.
                        <br/>Letters are not case-sensitive.
                    </p>


                </div>
            <?php endif; ?>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-default btn-block')); ?>
            </div>

            <?php $this->endWidget(); ?>



        <?php endif; ?>

    </div>
</div>

