<?php
/* @var $this VendorProfileController */
/* @var $model VendorProfile */

$this->breadcrumbs=array(
	'Vendor Profiles'=>array('index'),
	$model->VendorID=>array('view','id'=>$model->VendorID),
	'Update',
);

$this->menu=array(
	array('label'=>'List VendorProfile', 'url'=>array('index')),
	array('label'=>'Create VendorProfile', 'url'=>array('create')),
	array('label'=>'View VendorProfile', 'url'=>array('view', 'id'=>$model->VendorID)),
	array('label'=>'Manage VendorProfile', 'url'=>array('admin')),
);
?>

<h1>Update VendorProfile <?php echo $model->VendorID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>