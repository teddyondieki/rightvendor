<?php
/* @var $this GalleryImageController */
/* @var $data GalleryImage */
?>


<div class="item col-xs-20 col-sm-10 col-md-5 col-lg-4">
    <div class="thumbnail">
        <div class="imgSection">
            <?php
            $imgHtml = CHtml::image(Yii::app()->request->baseUrl . '/images/' . $data->project->ID . '/thumbs/' . $data->Name, "image", array('alt' => $data->project->Title, 'width' => '100%'));
            echo CHtml::link($imgHtml, array('project/permalink', 'permalink' => $data->project->Permalink));
            ?>

        </div>
        <div class="caption">
            <div class="projectDetails">
                <h2 class="captionHeader">
                    <?php echo CHtml::link(CHtml::encode($data->project->Title), array('project/permalink', 'permalink' => $data->project->Permalink)); ?>
                </h2>
                <h3>
                    <?php echo CHtml::encode($data->project->vendorProfile->category->Name); ?>
                </h3>
            </div>
            <div class="projectStats">
                <!--<div class="label label-default">-->

                <!--</div>-->

                <div class="row">
                    <div class="col-lg-10">
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
                    <div class="col-lg-10 text-right">
                        <span class="glyphicon glyphicon-camera"></span>
                        <?php
                        echo $data->project->imageCount;
                        ?> 
                    </div>
                </div>


                <hr/>
                <div class="clearfix">

                    <?php
                    if (GalleryImage::isLikedByCurrentUser($data->ID)) {
                        ?>
                        <button type="button" class="btn btn-primary btn-xs active"><span class="glyphicon glyphicon-heart"></span> You like this</button>
                        <?php
                    } else {

                        echo CHtml::link('<span class="glyphicon glyphicon-heart"></span> Like', array('galleryimage/like', 'id' => $data->ID), array('class' => 'btn btn-default btn-xs like'));
                    }
                    ?>                   
                    <?php
                    echo CHtml::link('<span class="glyphicon glyphicon-share-alt"></span> Share', array('galleryimage/share', 'id' => $data->ID), array('class' => 'btn btn-default btn-xs pull-right', 'onClick' => 'MyWindow = window.open(\'' . Yii::app()->createUrl('galleryImage/share', array('id' => $data->ID)) . '\', \'MyWindow\', \'width = 400, height = 300, left=20, top=20\'); return false;'));
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
