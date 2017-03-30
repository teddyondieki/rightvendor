<?php
/* @var $this VendorProfileController */
/* @var $data VendorProfile */
?>

<div class="col-lg-5 col-md-5 col-sm-10 col-xs-20">
    <div class="thumbnail">
        <?php
        $imgHtml = CHtml::image($data->userProfile->ProfilePic == NULL ? Yii::app()->request->baseUrl . '/images/square.png' : Yii::app()->request->baseUrl . '/images/profile/' . $data->userProfile->ProfilePic, $data->BusinessName, array('class' => 'thumbImg'));
        echo CHtml::link($imgHtml, array('vendorProfile/permalink', 'permalink' => $data->Permalink), array('class' => 'thumbImg'));
        ?>

        <div class="caption">
            <!--<div class="vendorDetails">-->

            <h2 class="captionHeader">
                <?php echo CHtml::link(CHtml::encode($data->BusinessName), array('vendorProfile/permalink', 'permalink' => $data->Permalink)); ?>
            </h2>
            <h3>
                <span class="glyphicon glyphicon-pushpin">
                </span> 
                <?php echo CHtml::encode($data->category->Name); ?>
                |
                <span class="glyphicon glyphicon-map-marker">
                </span> 
                <?php echo CHtml::encode($data->city->Name); ?>
            </h3>    
            <!--</div>-->

        </div>
    </div>

</div>