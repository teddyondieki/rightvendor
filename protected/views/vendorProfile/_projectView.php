<?php
/* @var $this ProjectController */
/* @var $data Project */
?>
<div class="item col-lg-5 col-md-5 col-sm-10 col-xs-20">
    <div class="thumbnail">

        <div class="imgSection">
            <?php
            $imgHtml = CHtml::image($data->MainImage == NULL ? Yii::app()->request->baseUrl . '/images/square.png' : Yii::app()->request->baseUrl . '/images/' . $data->ID . '/' . $data->imagePath, $data->Title, array('width' => '100%'));
            echo CHtml::link($imgHtml, array('project/updateInfo', 'id' => $data->ID));
            ?>
        </div>

        <div class="caption">

            <div class="projectDetails">
                <h2 class="captionHeader">
                    <?php echo CHtml::link(CHtml::encode($data->Title), array('project/updateInfo', 'id' => $data->ID)); ?>
                </h2>
            </div>



            <div class="projectStats">
                <div class="likes">
                    <span class="glyphicon glyphicon-heart">
                    </span> <?php
                    echo $data->TotalLikes;
                    ?>

                    | 

                    <span class="glyphicon glyphicon-eye-open">
                    </span> <?php
                    echo $data->TotalViews;
                    ?>

                </div>

            </div>
            <hr/>
            <div class="projectActions">

                <?php
                echo CHtml::link('Update information', array('project/updateInfo', 'id' => $data->ID));
                ?>  
                <hr/>

                <?php
                echo CHtml::link('Update images', array('project/updateGallery', 'id' => $data->ID));
                ?>    
                <hr/>

                <?php
                echo CHtml::link('View project', array('project/permalink', 'permalink' => $data->Permalink));
                ?> 
            </div>
        </div>


    </div>
</div>