<?php
/* @var $this PriceListController */
/* @var $model PriceList */

$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Update PriceList', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete PriceList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
);
?>

<h1>View PriceList #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Service',
		'Description',
		'Budget',
		'UserID',
		'CreateTime',
		'UpdateTime',
	),
)); ?>
