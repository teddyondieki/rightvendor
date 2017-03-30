<?php
/* @var $this AccountRecoveryController */
/* @var $model AccountRecovery */

$this->breadcrumbs = array(
    'Account Recoveries' => array('index'),
    'Create',
);
?>


<div class="container">

    <div class="panel panel-default userForm">
        <div class="panel-heading">
            <h3 class="panel-title">
                Account Recovery
            </h3>
        </div>
        <div class="panel-body">
            <?php $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </div>

</div>