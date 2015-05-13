<?php
/* @var $this UserareaController */
/* @var $data Userarea */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userareaid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userareaid), array('view', 'id'=>$data->userareaid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo CHtml::encode($data->userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('areaid')); ?>:</b>
	<?php echo CHtml::encode($data->areaid); ?>
	<br />


</div>