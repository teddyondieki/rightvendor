<div id="posts" class="isotope row">
    <?php foreach ($this->getFeaturedImages() as $image): ?>

        <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="thumbnail">
                <div class="imgSection">
                    <?php
                    $imgHtml = CHtml::image(Yii::app()->request->baseUrl . '/images/' . $image->project->ID . '/thumbs/' . $image->Name, "image", array('alt' => $image->project->Title, 'width' => '100%'));
                    echo CHtml::link($imgHtml, array('project/view', 'id' => $image->project->ID));
                    ?>
                    <div class="projectDetails">
                        <h2 class="captionHeader">
                            <?php echo CHtml::link(CHtml::encode($image->project->Title), array('project/view', 'id' => $image->project->ID)); ?>
                        </h2>
                        <h3>
                            <span class="glyphicon glyphicon-pushpin"></span>  <?php echo CHtml::encode($image->project->vendorProfile->category->Name); ?>
                        </h3>
                    </div>
                </div>
                <div class="caption">

                    <div class="projectStats row">
                        <div class="col-xs-4 likes">
                            <span class="glyphicon glyphicon-heart">
                            </span> <?php
                            echo $image->project->TotalLikes;
                            ?>

                            | 

                            <span class="glyphicon glyphicon-eye-open">
                            </span> <?php
                            echo $image->project->TotalViews;
                            ?>

                        </div>
                        <div class="col-xs-8 text-right">

                            <?php
                            if (GalleryImage::isLikedByCurrentUser($image->ID)) {
                                ?>
                                <button type="button" class="btn btn-primary btn-xs active"><span class="glyphicon glyphicon-heart"></span> You like this</button>
                                <?php
                            } else {

                                echo CHtml::link('<span class="glyphicon glyphicon-heart"></span> Like', array('galleryimage/like', 'id' => $image->ID), array('class' => 'btn btn-default btn-xs like'));
                            }
                            ?>

                            <?php
                            echo CHtml::link('<span class="glyphicon glyphicon-share-alt"></span> Share', array('galleryimage/share', 'id' => $image->ID), array('class' => 'btn btn-default btn-xs', 'onClick' => 'MyWindow = window.open("' . Yii::app()->createUrl('galleryImage/share', array('id' => $image->ID)) . '", "MyWindow", width = 400, height = 300); return false;'));
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

</div>