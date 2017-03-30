<?php
/* @var $this VendorProfileController */
/* @var $model VendorProfile */

$this->breadcrumbs = array(
    $model->BusinessName,
);

//$this->menu = array(
//    array('label' => 'List VendorProfile', 'url' => array('index')),
//    array('label' => 'Create VendorProfile', 'url' => array('create')),
//    array('label' => 'Update VendorProfile', 'url' => array('update', 'id' => $model->VendorID)),
//    array('label' => 'Delete VendorProfile', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->VendorID), 'confirm' => 'Are you sure you want to delete this item?')),
//    array('label' => 'Manage VendorProfile', 'url' => array('admin')),
//);


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
    <?php
    $this->renderPartial('_flash');
    ?>
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-10 col-xs-20" id="vendorSection">
            <?php
            $this->renderPartial('_profile', array(
                'model' => $model,
                'message' => $message,
            ));
            ?>
        </div>
        <div class="col-lg-15 col-md-15 col-sm-10 col-xs-20">

            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <?php echo CHtml::link('Projects <span class="badge">' . $model->projectCount . '</span>', array('vendorProfile/permalink', 'permalink' => $model->Permalink)); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Reviews <span class="badge">' . $model->reviewCount . '</span>', array('vendorProfile/reviews', 'id' => $model->VendorID)); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Price List / Offers', array('vendorProfile/priceList', 'id' => $model->VendorID)); ?>
                </li>

            </ul>

            <div class="tab-content">
                <div class="tab-pane active">

                    <div id="posts" class="isotope row">

                        <?php
                        foreach ($model->projects as $project) {
                            ?>
                            <div class="item col-lg-5 col-md-5 col-sm-10 col-xs-20">
                                <div class="thumbnail">

                                    <div class="imgSection">
                                        <?php
                                        $imgHtml = CHtml::image($project->MainImage == NULL ? Yii::app()->request->baseUrl . '/images/square.png' : Yii::app()->request->baseUrl . '/images/' . $project->ID . '/' . $project->imagePath, $project->Title);
                                        echo CHtml::link($imgHtml, array('project/permalink', 'permalink' => $project->Permalink));
                                        ?>



                                    </div>

                                    <div class="caption">
                                        <div class="projectDetails">
                                            <h2 class="captionHeader">
                                                <?php echo CHtml::link(CHtml::encode($project->Title), array('project/permalink', 'permalink' => $project->Permalink)); ?>
                                            </h2>
                                        </div>
                                        <div class="projectStats">
                                            <div class="likes">
                                                <span class="glyphicon glyphicon-heart">
                                                </span> <?php
                                                echo $project->TotalLikes;
                                                ?>

                                                | 

                                                <span class="glyphicon glyphicon-eye-open">
                                                </span> <?php
                                                echo $project->TotalViews;
                                                ?>

                                            </div>

                                            <!--<div class="text-right">-->


                                            <?php
//                                                echo CHtml::link('<span class="glyphicon glyphicon-share-alt"></span> Share', array('galleryimage/like', 'id' => $project->ID), array('class' => 'btn btn-default btn-xs'));
                                            ?>

                                            <!--</div>-->
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



