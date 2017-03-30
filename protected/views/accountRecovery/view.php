<?php
/* @var $this AccountRecoveryController */
/* @var $model AccountRecovery */

$this->breadcrumbs=array(
	'Account Recoveries'=>array('index'),
	$model->RecoveryCode,
);

$this->menu=array(
	array('label'=>'List AccountRecovery', 'url'=>array('index')),
	array('label'=>'Create AccountRecovery', 'url'=>array('create')),
	array('label'=>'Update AccountRecovery', 'url'=>array('update', 'id'=>$model->RecoveryCode)),
	array('label'=>'Delete AccountRecovery', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->RecoveryCode),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AccountRecovery', 'url'=>array('admin')),
);
?>

<h1>View AccountRecovery #<?php echo $model->RecoveryCode; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'RecoveryCode',
		'UserID',
		'Email',
		'Status',
		'CreateTime',
		'UpdateTime',
	),
)); ?>
