<?php
/* @var $this GalleryImageController */
/* @var $model GalleryImage */
?>

<html>
    <head>
        <title>Share - <?php echo $model->project->Title; ?></title>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/share.css"/>
    </head>

    <body>
        <h4>Share on: </h4>
       
            <ul class="shareLinks">
                <li>
                    <a href="http://facebook.com/sharer.php?p[url]=<?php echo urlencode(Yii::app()->request->hostInfo . Yii::app()->createUrl('project/permalink', array('permalink' => $model->project->Permalink))); ?>&p[title]=<?php echo urlencode(CHtml::encode($model->project->Title) . ' by ' . CHtml::encode($model->project->vendorProfile->BusinessName)); ?>">
                        <img src="<?php echo Yii::app()->request->baseUrl ?>/images/social/facebook.png" alt="Share <?php echo $model->project->Title ?> on Facebook"/>
                    </a>
                </li>

                <li>
                    <a href="http://twitter.com/share?url=<?php echo urlencode(Yii::app()->request->hostInfo . Yii::app()->createUrl('project/permalink', array('permalink' => $model->project->Permalink))); ?>&text=<?php echo urlencode(CHtml::encode($model->project->Title) . ' by ' . CHtml::encode($model->project->vendorProfile->BusinessName)); ?>">
                        <img src="<?php echo Yii::app()->request->baseUrl ?>/images/social/twitter.png" alt="Share <?php echo $model->project->Title ?> on Twitter"/>
                    </a>
                </li>

                <li>
                    <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(Yii::app()->request->hostInfo . Yii::app()->createUrl('project/permalink', array('permalink' => $model->project->Permalink))); ?>&description=<?php echo urlencode(CHtml::encode($model->project->Title) . ' by ' . CHtml::encode($model->project->vendorProfile->BusinessName)); ?>&media=<?php echo Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . '/images/' . $model->ProjectID . '/' . $model->Name ?>">
                        <img src="<?php echo Yii::app()->request->baseUrl ?>/images/social/pinterest.png" alt="Share <?php echo $model->project->Title ?> on Pinterest"/>
                    </a>
                </li>
            </ul>
     
    </body>

</html>