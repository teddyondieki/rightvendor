<?php
/* @var $this GalleryImageController */
/* @var $model GalleryImage */

$this->breadcrumbs=array(
	'Gallery Images'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List GalleryImage', 'url'=>array('index')),
	array('label'=>'Create GalleryImage', 'url'=>array('create')),
	array('label'=>'Update GalleryImage', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete GalleryImage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GalleryImage', 'url'=>array('admin')),
);
?>

<h1>View GalleryImage #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Name',
		'ProjectID',
		'IsFeatured',
	),
)); ?>
