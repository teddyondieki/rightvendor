<?php
/* @var $this GalleryImageController */
/* @var $model GalleryImage */

$this->breadcrumbs=array(
	'Gallery Images'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List GalleryImage', 'url'=>array('index')),
	array('label'=>'Create GalleryImage', 'url'=>array('create')),
	array('label'=>'View GalleryImage', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage GalleryImage', 'url'=>array('admin')),
);
?>

<h1>Update GalleryImage <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>