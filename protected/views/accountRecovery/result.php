<?php
/* @var $this AccountRecoveryController */
/* @var $model AccountRecovery */

$this->breadcrumbs = array(
    'Account Recoveries' => array('index'),
    'Results',
);
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
</div>
