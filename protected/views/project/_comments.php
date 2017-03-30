<?php foreach ($comments as $comment): ?>

    <div class="media">
        <div class="pull-left">

            <?php
            if ($comment->author->userProfile->ProfilePic != NULL) {
                echo CHtml::image(Yii::app()->request->baseUrl . '/images/profile/' . $comment->author->userProfile->ProfilePic, "image", array('class' => 'media-object', 'width' => '75px'));
            } else {
                echo CHtml::image(Yii::app()->request->baseUrl . '/images/square.png', "image", array('class' => 'media-object', 'width' => '75px'));
            }
            ?> 
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <?php echo $comment->author->Name; ?> <small> says:<br/> <?php echo date('F j, Y \- h:i a', strtotime($comment->CreateTime)); ?></small> 
            </h4>
            <p>
                <?php echo nl2br(CHtml::encode($comment->Content)); ?>
            </p>
        </div>
    </div>
<hr/>
<?php endforeach; ?>