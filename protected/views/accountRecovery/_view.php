<?php
/* @var $this AccountRecoveryController */
/* @var $data AccountRecovery */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RecoveryCode')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RecoveryCode), array('view', 'id'=>$data->RecoveryCode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreateTime')); ?>:</b>
	<?php echo CHtml::encode($data->CreateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdateTime')); ?>:</b>
	<?php echo CHtml::encode($data->UpdateTime); ?>
	<br />


</div>