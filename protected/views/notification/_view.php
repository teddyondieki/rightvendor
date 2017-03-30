<?php
/* @var $this NotificationController */
/* @var $data Notification */
?>




<li class="list-group-item">

    <?php
    if ($data->Type == Notification::TYPE_LIKE_IMAGE) {
        if ($data->GuestID == NULL) {
            echo 'A guest  likes a ' . CHtml::link('photo', array('gallery/view', 'id' => $data->ImageID)) . ' from ' . CHtml::link(CHtml::encode($data->project->Title), array('project/view', 'id' => $data->ImageID));
        } else {
            echo CHtml::link(CHtml::encode($data->guest->Name), array('user/view', 'id' => $data->GuestID)) . ' likes a ' . CHtml::link('photo', array('galleryImages/view', 'id' => $data->ImageID)) . ' from ' . CHtml::link(CHtml::encode($data->image->project->Title), array('project/permalink', 'permalink' => $data->project->Permalink));
        }
    } elseif ($data->Type == Notification::TYPE_COMMENT_PROJECT) {
        echo CHtml::link(CHtml::encode($data->guest->Name), array('user/view', 'id' => $data->GuestID)) . ' posted a comment on ' . CHtml::link(CHtml::encode($data->project->Title), array('project/permalink', 'permalink' => $data->project->Permalink));
    } elseif ($data->Type == Notification::TYPE_SHARE_IMAGE) {
        echo CHtml::link(CHtml::encode($data->guest->Name), array('user/view', 'id' => $data->GuestID)) . ' shared a ' . CHtml::link('photo', array('gallery/view', 'id' => $data->ImageID)) . ' from ' . CHtml::link(CHtml::encode($data->project->Title), array('project/permalink', 'permalink' => $data->project->Permalink));
    } elseif ($data->Type == Notification::TYPE_SHARE_PROJECT) {
        echo CHtml::link(CHtml::encode($data->guest->Name), array('user/view', 'id' => $data->GuestID)) . ' shared ' . CHtml::link(CHtml::encode($data->project->Title), array('project/permalinnk', 'permalink' => $data->project->Permalink));
    } elseif ($data->Type == Notification::TYPE_REVIEW_VENDOR) {
//        echo 'review';
        echo CHtml::link(CHtml::encode($data->guest->Name), array('user/view', 'id' => $data->GuestID)) . ' posted a ' . CHtml::link('review', array('vendorProfile/reviews', 'id' => $data->VendorID)) . ' for you';
    }
    ?>

    <span class="pull-right">
        <small>
            <?php echo date('F j, Y \a\t h:i a', strtotime($data->CreateTime)); ?>
        </small>
    </span>

    <?php
    $data->Status = Notification::STATUS_SEEN;
    $data->save();
    ?>
</li>