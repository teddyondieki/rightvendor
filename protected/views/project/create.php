<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs = array(
    'Dashboard',
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
                    <h3 class="panel-title">Add project</h3>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>
        </div>       
    </div>
</div>