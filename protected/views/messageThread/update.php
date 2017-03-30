<?php
/* @var $this MessageThreadController */
/* @var $model MessageThread */

$this->breadcrumbs=array(
	'Message Threads'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List MessageThread', 'url'=>array('index')),
	array('label'=>'Create MessageThread', 'url'=>array('create')),
	array('label'=>'View MessageThread', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage MessageThread', 'url'=>array('admin')),
);
?>

<h1>Update MessageThread <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>