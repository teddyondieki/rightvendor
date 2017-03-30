<!--<ul class="nav nav-pills nav-stacked">

<?php // echo CHtml::link('Profile', array('vendorProfile/profile')); ?>
    <li class="active"><a href="#">Profile</a></li>
    <li><a href="#">Projects</a></li>
    <li><a href="#">Notifications</a></li>
    <li><a href="#">Messages</a></li>
    <li><a href="#">Change Password</a></li>
</ul>-->

<div class='panel panel-default'>
    <div class='panel-body'>
        <?php
// Use badges to indicate unread count

        $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Add a new project', 'url' => array('/project/create'), 'visible' => Yii::app()->authManager->checkAccess("vendor", Yii::app()->user->id)),
                array('label' => 'My projects ' . User::getUserProjectCount(), 'url' => array('/vendorProfile/projects'), 'visible' => Yii::app()->authManager->checkAccess("vendor", Yii::app()->user->id)),
                array('label' => 'Notifications ' . User::getUnreadNotifications(), 'url' => array('/notification/index')),
                array('label' => 'Messages ' . User::getUnreadMessages(), 'url' => array('/message/index')),
                array('label' => 'Update business information', 'url' => array('/vendorProfile/profile'), 'visible' => Yii::app()->authManager->checkAccess("vendor", Yii::app()->user->id)),
                array('label' => 'Change profile picture', 'url' => array('/user/updateProfilePic')),
                array('label' => 'Change password', 'url' => array('/user/changePassword')),
                array('label' => 'View public profile', 'url' => array('/vendorProfile/view', 'id' => Yii::app()->user->id), 'visible' => Yii::app()->authManager->checkAccess("vendor", Yii::app()->user->id)),
            ),
            'htmlOptions' => array(
                'class' => 'nav nav-pills nav-stacked',
            ),
            'encodeLabel' => false,
        ));
        ?>

    </div>
</div>
