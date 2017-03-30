<?php
/* @var $this MessageThreadController */
/* @var $data MessageThread */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubjectID')); ?>:</b>
	<?php echo CHtml::encode($data->SubjectID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User1')); ?>:</b>
	<?php echo CHtml::encode($data->User1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User2')); ?>:</b>
	<?php echo CHtml::encode($data->User2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreateTime')); ?>:</b>
	<?php echo CHtml::encode($data->CreateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdateTime')); ?>:</b>
	<?php echo CHtml::encode($data->UpdateTime); ?>
	<br />


</div>