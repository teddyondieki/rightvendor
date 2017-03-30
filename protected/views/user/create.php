<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
//    'Users' => array('index'),
    'Register',
);

//$this->menu = array(
//    array('label' => 'List User', 'url' => array('index')),
//    array('label' => 'Manage User', 'url' => array('admin')),
//);
?>
<div class="container">


    <div class="panel panel-default userForm">
        <div class="panel-heading">
            <h3 class="panel-title">
                Create Account
            </h3>
        </div>
        <div class="panel-body">


            <?php $this->renderPartial('_form', array('model' =>  $model)); ?>                    
        </div>
    </div>

</div>