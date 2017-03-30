<?php
/* @var $this PriceListController */
/* @var $model PriceList */

$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
);
?>

<h1>Create PriceList</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>