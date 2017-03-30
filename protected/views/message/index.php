<?php
/* @var $this MessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Messages',
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
                    <h3 class="panel-title">Messages</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $dataProvider,
                        'itemView' => '_view',
                        'summaryText' => '',
                        'htmlOptions' => array(
                            'class' => 'list-group',
                        ),
                    ));
                    ?>   

                </div>
            </div>


        </div>
    </div>
</div>

