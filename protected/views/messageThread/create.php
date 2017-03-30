<?php
/* @var $this MessageThreadController */
/* @var $model MessageThread */

$this->breadcrumbs=array(
	'Message Threads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MessageThread', 'url'=>array('index')),
	array('label'=>'Manage MessageThread', 'url'=>array('admin')),
);
?>

<h1>Create MessageThread</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>