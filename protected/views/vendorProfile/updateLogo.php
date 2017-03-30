<?php
/* @var $this VendorProfileController */
/* @var $model VendorProfile */

$this->breadcrumbs = array(
    $model->BusinessName,
);

?>

<div class="container">
    <div class="row">

        <div class="col-lg-3">
            <?php $this->renderPartial('_sidebar'); ?>
        </div> 
        <div class="col-lg-9">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update business logo</h3>
                </div>
                <div class="panel-body">


                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'vendor-profile-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>

                    <?php echo $form->errorSummary($model); ?>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'ProfileImage'); ?>
                        <?php echo CHtml::activeFileField($model, 'ProfileImage') ?>
                        <?php echo $form->error($model, 'ProfileImage'); ?>
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


