<div class="row">
    <?php foreach ($this->getFeaturedImages() as $image): ?>

        <div class="col-xs-4 col-md-3">
            <div class="thumbnail">
                <?php
                $imgHtml = CHtml::image(Yii::app()->request->baseUrl . '/images/' . $image->project->ID . '/thumbs/' . $image->Name, "image", array('alt' => $image->project->Title, 'width' => '100%'));
                echo CHtml::link($imgHtml, array('project/view', 'id' => $image->project->ID));
                ?>
                <div class="caption">
                    <h2>
                        <?php echo CHtml::link(CHtml::encode($image->project->Title), array('project/view', 'id' => $image->project->ID), array('class' => 'whiteColor')); ?>
                    </h2>
                    <?php
                    echo CHtml::link('Like', array('galleryimage/like', 'id' => $image->ID));
                    ?>
                    <span class="glyphicon glyphicon-heart">
                    </span> <?php
                    echo $image->totalLikes;
                    ?>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

</div>