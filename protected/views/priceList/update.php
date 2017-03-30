<?php
/* @var $this PriceListController */
/* @var $model PriceList */

$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'View PriceList', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
);
?>

<h1>Update PriceList <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>