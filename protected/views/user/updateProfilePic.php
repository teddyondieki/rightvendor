<?php
/* @var $this UserController */
/* @var $model UserProfile */

$this->breadcrumbs = array(
    'Dashboard' => array('profile'),
    'Change Profile Picture',
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
                    <h3 class="panel-title">Change profile picture</h3>
                </div>
                <div class="panel-body">

                    <div class="row">

                        <div class="col-lg-10">

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
                                <?php echo CHtml::activeFileField($model, 'ProfilePic', array('class' => 'btn btn-default btn-sm text-uppercase')) ?>
                                <?php echo $form->error($model, 'ProfilePic'); ?>
                            </div>

                            <div>


                                <?php
                                echo CHtml::submitButton('Upload', array('class' => 'btn btn-lg btn-primary'));
                                ?> 
                                <?php if ($model->ProfilePic != NULL) { ?>
                                    <span class="text-muted"> (will replace current profile picture)</span>
                                    <?php
                                }
                                ?>  



                            </div>
                            <?php $this->endWidget(); ?>
                        </div>
                        <div class="col-lg-10">
                            <div class="thumbnail">
                                <?php
                                if ($model->ProfilePic != NULL) {
                                    echo CHtml::image(Yii::app()->request->baseUrl . '/images/profile/' . $model->ProfilePic, "image", array('width' => '100%'));
                                } else {
                                    echo CHtml::image(Yii::app()->request->baseUrl . '/images/square.png', "image", array('width' => '100%'));
                                }
                                ?>   

                                <div class="caption">
                                    <?php echo CHtml::link('Remove Profile Picture', array('user/removePic'), array('class' => 'btn btn-primary btn-block btn-sm text-uppercase')); ?>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>



