<?php
/* @var $this AccountRecoveryController */
/* @var $model AccountRecovery */

$this->breadcrumbs=array(
	'Account Recoveries'=>array('index'),
	$model->RecoveryCode=>array('view','id'=>$model->RecoveryCode),
	'Update',
);

$this->menu=array(
	array('label'=>'List AccountRecovery', 'url'=>array('index')),
	array('label'=>'Create AccountRecovery', 'url'=>array('create')),
	array('label'=>'View AccountRecovery', 'url'=>array('view', 'id'=>$model->RecoveryCode)),
	array('label'=>'Manage AccountRecovery', 'url'=>array('admin')),
);
?>

<h1>Update AccountRecovery <?php echo $model->RecoveryCode; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>