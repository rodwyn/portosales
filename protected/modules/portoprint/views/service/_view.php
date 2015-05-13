<?php
/* @var $this ServiceController */
/* @var $data Service */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('serviceid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->serviceid), array('view', 'id'=>$data->serviceid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyid')); ?>:</b>
	<?php echo CHtml::encode($data->companyid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servicedsc')); ?>:</b>
	<?php echo CHtml::encode($data->servicedsc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serviceparentid')); ?>:</b>
	<?php echo CHtml::encode($data->serviceparentid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />


</div>