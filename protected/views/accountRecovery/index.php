<?php
/* @var $this AccountRecoveryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Account Recoveries',
);

$this->menu=array(
	array('label'=>'Create AccountRecovery', 'url'=>array('create')),
	array('label'=>'Manage AccountRecovery', 'url'=>array('admin')),
);
?>

<h1>Account Recoveries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
