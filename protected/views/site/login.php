<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>


<?php
//echo Yii::app()->request->hostInfo . Yii::app()->createUrl('accountRecovery/newPassword', array('recoveryCode'=>'jhoiuviyf'));
?>
<div class="container">

    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php elseif (Yii::app()->user->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>

    <div class="panel panel-default userForm">
        
        <div class="panel-body">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array(
                    'class' => 'form-signin'
                ),
            ));
            ?>

            <!--<h2 class="form-signin-heading">Please sign in</h2>-->

            <?php // echo $form->errorSummary($model); ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'Email'); ?>
                <?php echo $form->error($model, 'Email', array('class' => 'text-danger')); ?>
                <?php echo $form->textField($model, 'Email', array('class' => 'form-control', 'placeholder' => 'Email')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'Password'); ?>
                <?php echo $form->error($model, 'Password', array('class' => 'text-danger')); ?>
                <?php echo $form->passwordField($model, 'Password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
            </div>

            <div class="checkbox">
                <!--        <label for="LoginForm[rememberMe]">
                            Remember me
                        </label>-->
                <?php echo $form->checkBox($model, 'rememberMe'); ?>

                <?php // echo $form->error($model, 'rememberMe'); ?>
                <?php echo $form->label($model, 'rememberMe'); ?>
            </div>

            <?php echo CHtml::submitButton('Sign In', array('class' => 'btn btn-lg btn-primary btn-block')); ?>


            <?php
            echo CHtml::link('Forgot password?', array('accountRecovery/create'), array('class' => 'btn btn-lg btn-default btn-block'));
            ?>

            <?php $this->endWidget(); ?>

        </div>
    </div>

</div> <!-- /container -->
