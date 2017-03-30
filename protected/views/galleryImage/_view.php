<?php
/* @var $this GalleryImageController */
/* @var $data GalleryImage */
?>


<div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="thumbnail">
        <div class="imgSection">
            <?php
            $imgHtml = CHtml::image(Yii::app()->request->baseUrl . '/images/' . $data->project->ID . '/thumbs/' . $data->Name, "image", array('alt' => $data->project->Title, 'width' => '100%'));
            echo CHtml::link($imgHtml, array('project/view', 'id' => $data->project->ID));
            ?>
            <div class="projectDetails">
                <h2 class="captionHeader">
                    <?php echo CHtml::link(CHtml::encode($data->project->Title), array('project/view', 'id' => $data->project->ID)); ?>
                </h2>
                <h3>
                    <?php echo CHtml::encode($data->project->vendorProfile->category->Name); ?>
                </h3>
            </div>
        </div>
        <div class="caption">

            <div class="projectStats row">
                <div class="col-xs-5 likes">
                    <span class="glyphicon glyphicon-heart">
                    </span> <?php
                    echo $data->project->TotalLikes;
                    ?>

                    | 

                    <span class="glyphicon glyphicon-eye-open">
                    </span> <?php
                    echo $data->project->TotalViews;
                    ?>

                </div>
                <div class="col-xs-7 text-right">

                    <?php
                    echo CHtml::link('<span class="glyphicon glyphicon-heart"></span> Like', array('galleryimage/like', 'id' => $data->ID), array('class' => 'btn btn-default btn-xs'));
                    ?>

                    <?php
                    echo CHtml::link('<span class="glyphicon glyphicon-share-alt"></span> Share', array('galleryimage/like', 'id' => $data->ID), array('class' => 'btn btn-default btn-xs'));
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
