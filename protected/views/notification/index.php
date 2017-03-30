<?php
/* @var $this NotificationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Notifications',
);

//$this->menu = array(
//    array('label' => 'Create Notification', 'url' => array('create')),
//    array('label' => 'Manage Notification', 'url' => array('admin')),
//);
?>
<div class="container">

    <div class="row">

        <div class="col-lg-5">
            <?php $this->renderPartial('/vendorProfile/_sidebar'); ?>
        </div>
        <div class="col-lg-15">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Notifications</h3>
                </div>
                <div class="panel-body">

                    <ul class="list-group">
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $dataProvider,
                            'itemView' => '_view',
                            'summaryText' => ''
                        ));
                        ?>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>

