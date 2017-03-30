<?php
/* @var $this ProjectCategoryController */
/* @var $model ProjectCategory */

$this->breadcrumbs=array(
	'Project Categories'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProjectCategory', 'url'=>array('index')),
	array('label'=>'Create ProjectCategory', 'url'=>array('create')),
	array('label'=>'View ProjectCategory', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ProjectCategory', 'url'=>array('admin')),
);
?>

<h1>Update ProjectCategory <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>