<?php
/* @var $this MessageController */
/* @var $data MessageThread */
?>

<a class="list-group-item <?php if (($data->latestMessage->RecipientID == Yii::app()->user->id) && ($data->latestMessage->Status == Message::STATUS_UNSEEN)) echo 'alert alert-info' ?>" href="<?php echo Yii::app()->createUrl('messageThread/view', array('id' => $data->ID)); ?>">

    <h4 class="list-group-item-heading">
        <?php
        echo $data->User1 == Yii::app()->user->id ? $data->user2nd->Name : $data->user1st->Name;
        ?>
        <small>
            on
            <?php
            echo CHtml::encode($data->subject->Name);
            ?>
        </small>
    </h4>
    <div class="row">
        <div class="col-lg-15">
            <p class="list-group-item-text">
                
                <?php
                if ($data->latestMessage->SenderID == Yii::app()->user->id) {
                    echo '<span class="text-muted">You:</span>';
                }
                ?>

                <?php
                if (strlen($data->latestMessage->Content) > 150) {
                    echo CHtml::encode(substr($data->latestMessage->Content, 0, 150)) . '...';
                } else {
                    echo CHtml::encode($data->latestMessage->Content);
                }
                ?>
            </p>
        </div>
        <div class="col-lg-5 text-right">

            <p class="list-group-item-text">
                <small>
                    <?php echo date('F j, Y \a\t h:i a', strtotime($data->CreateTime)); ?>
                </small>
            </p>
        </div>
    </div>


</a>

