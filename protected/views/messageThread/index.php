<?php
/* @var $this MessageThreadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Message Threads',
);

$this->menu = array(
    array('label' => 'Create MessageThread', 'url' => array('create')),
    array('label' => 'Manage MessageThread', 'url' => array('admin')),
);
?>

<div class="container">

    <div class="row">

        <div class="col-lg-3">
            <?php $this->renderPartial('/vendorProfile/_sidebar'); ?>
        </div>
        <div class="col-lg-9">

            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
            ));
            ?>
        </div>
    </div>
</div>

