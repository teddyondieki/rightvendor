<?php
/* @var $this MessageThreadController */
/* @var $model MessageThread */
/* @var $message Message */

$this->breadcrumbs = array(
    'Message Threads' => array('index'),
    $model->ID,
);

$this->menu = array(
    array('label' => 'List MessageThread', 'url' => array('index')),
    array('label' => 'Create MessageThread', 'url' => array('create')),
    array('label' => 'Update MessageThread', 'url' => array('update', 'id' => $model->ID)),
    array('label' => 'Delete MessageThread', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage MessageThread', 'url' => array('admin')),
);
?>

<div class="container">

    <div class="row">

        <div class="col-lg-5">
            <?php $this->renderPartial('/vendorProfile/_sidebar'); ?>
        </div>
        <div class="col-lg-15">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Subject: <?php echo $model->subject->Name; ?>
                </div>
                <div class="panel-body">

                    <?php
                    foreach ($model->messagesASC as $previousMessage) {
                        ?>
                        <div class="media">
                            <div class="pull-left">
                                <?php
                                if ($previousMessage->sender->userProfile->ProfilePic != NULL) {
                                    echo CHtml::image(Yii::app()->request->baseUrl . '/images/profile/' . $previousMessage->sender->userProfile->ProfilePic, "image", array('class' => 'media-object', 'width' => '50px'));
                                } else {
                                    echo CHtml::image(Yii::app()->request->baseUrl . '/images/square.png', "image", array('class' => 'media-object', 'width' => '50px'));
                                }
                                ?>   
                            </div>
                            <div class="media-body">
                                <div class="row">
                                    <div class="col-lg-15">
                                        <h4 class="media-heading messageHeading">
                                            <?php
                                            if ($previousMessage->SenderID == Yii::app()->user->id) {
                                                echo 'You';
                                            } else {
                                                echo $previousMessage->sender->Name;
                                            }
                                            ?>     
                                        </h4>
                                        <p>
                                            <?php echo $previousMessage->Content; ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-5 text-right text-muted">
                                        <small>
                                            <?php echo date('F j, Y \a\t h:i a', strtotime($previousMessage->CreateTime)); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div><hr/>
                        <?php
                    }
                    ?>

                    <br/>

                    <?php
                    $this->renderPartial('/message/_reply', array(
                        'model' => $message,
                    ));
                    ?>
                </div>
            </div>



        </div>
    </div>


</div>


