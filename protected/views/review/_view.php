<?php
/* @var $this ReviewController */
/* @var $data Review */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Content')); ?>:</b>
	<?php echo CHtml::encode($data->Content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Rating')); ?>:</b>
	<?php echo CHtml::encode($data->Rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VendorID')); ?>:</b>
	<?php echo CHtml::encode($data->VendorID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AuthorID')); ?>:</b>
	<?php echo CHtml::encode($data->AuthorID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreateTime')); ?>:</b>
	<?php echo CHtml::encode($data->CreateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdateTime')); ?>:</b>
	<?php echo CHtml::encode($data->UpdateTime); ?>
	<br />


</div>