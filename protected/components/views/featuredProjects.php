<div id="posts" class="isotope row">
    <?php foreach ($this->getFeaturedProjects() as $project): ?>

        <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-4">

            <div class="thumbnail">

                <div class="imgSection">
                    <?php
                    $imgHtml = CHtml::image($project->MainImage == NULL ? Yii::app()->request->baseUrl . '/images/square.png' : Yii::app()->request->baseUrl . '/images/' . $project->ID . '/' . $project->imagePath, $project->Title, array('width' => '100%'));
                    echo CHtml::link($imgHtml, array('project/permalink', 'permalink' => $project->Permalink));
                    ?>
                </div>
                <div class="caption">
                    <div class="projectDetails">
                        <h2 class="captionHeader">
                            <?php echo CHtml::link(CHtml::encode($project->Title), array('project/permalink', 'permalink' => $project->Permalink)); ?>
                        </h2>
                        <h3>
                            <?php echo CHtml::encode($project->vendorProfile->category->Name); ?>
                        </h3>
                    </div>                    
                    <div class="projectStats">

                        <div class="row">
                            <div class="col-lg-10">
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
                            <div class="col-lg-10 text-right">
                                <span class="glyphicon glyphicon-camera"></span>                               
                                <?php
                                echo $project->imageCount;
                                ?> 
                            </div>
                        </div>

                        <!--<div class="col-xs-8 text-right">-->
                        <hr/>
                        <div class="clearfix">
                            <?php
                            if (GalleryImage::isLikedByCurrentUser($project->MainImage)) {
                                ?>
                                <button type="button" class="btn btn-primary btn-xs active"><span class="glyphicon glyphicon-heart"></span> You like this</button>
                                <?php
                            } else {

                                echo CHtml::link('<span class="glyphicon glyphicon-heart"></span> Like', array('galleryimage/like', 'id' => $project->MainImage), array('class' => 'btn btn-default btn-xs like'));
                            }
                            ?>

                            <?php
                            echo CHtml::link('<span class="glyphicon glyphicon-share-alt"></span> Share', array('galleryimage/share', 'id' => $project->MainImage), array('class' => 'btn btn-default btn-xs pull-right', 'onClick' => 'MyWindow = window.open(\'' . Yii::app()->createUrl('galleryImage/share', array('id' => $project->MainImage)) . '\', \'MyWindow\', \'width = 400, height = 300\'); return false;'));
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

</div>