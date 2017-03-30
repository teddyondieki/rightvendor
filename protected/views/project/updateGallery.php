<?php
/* @var $this ProjectController */
/* @var $model Project */


$this->breadcrumbs = array(
    'Dashboard' => array('vendorProfile/profile'),
    'My Projects' => array('vendorProfile/projects'),
    'Update - ' . $model->Title,
);

Yii::app()->clientScript->registerCoreScript("jquery");
//Yii::app()->clientScript->registerScriptFile("http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/bootstrap.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/masonry.pkgd.js");
//Yii::app()->clientScript->registerScriptFile("js/jquery.isotope.min.js");
//Yii::app()->clientScript->registerScriptFile("js/mql.js");
//Yii::app()->clientScript->registerScriptFile("js/reddit.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/script.js");
?>
<div class="container">
    <div class="row">

        <div class="col-lg-5">
            <?php $this->renderPartial('/vendorProfile/_sidebar'); ?>
        </div> 
        <div class="col-lg-15">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Update project gallery
                    </h3>
                </div>

                <div class="panel-body">


                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'project-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                        'action' => Yii::app()->createUrl('project/uploadImages', array('id' => $model->ID)),
                    ));
                    ?>

                    <?php echo $form->errorSummary($model); ?>
                    <div class="form-group">

                        <label for="images">Add images...</label>
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

                    <?php echo CHtml::submitButton('Upload', array('class' => 'btn btn-primary btn-lg')); ?>


                    <?php $this->endWidget(); ?>
                    <hr/>

                    <div id="posts" class="isotope row">



                        <?php
                        foreach ($model->gallery as $image) {
                            ?>
                            <div class="item col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                <div class="thumbnail">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo $model->ID; ?>/<?php echo $image->Name; ?>"/>

                                    <div class="caption">
                                        <div class="projectActions text-uppercase">
                                            <?php if ($image->ID == $model->MainImage) { ?>
                                                <span class="btn btn-primary btn-sm btn-block"> Main Image</span>                                              
                                                <?php
                                            } else {
                                                echo CHtml::link('Make main image', array('project/setMainImage', 'id' => $image->ID), array('class' => 'btn btn-default btn-sm btn-block'));
                                            }
                                            ?>
                                            <?php
                                            echo CHtml::link('Remove', array('project/deleteImage', 'id' => $image->ID), array('class' => 'btn btn-default btn-sm btn-block'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>


                </div>
            </div>
        </div>       
    </div>
</div>