<?php
/* @var $this AccessController */
/* @var $data Access */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('accessid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->accessid), array('view', 'id'=>$data->accessid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo CHtml::encode($data->userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menuid')); ?>:</b>
	<?php echo CHtml::encode($data->menuid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oper')); ?>:</b>
	<?php echo CHtml::encode($data->oper); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accessdate')); ?>:</b>
	<?php echo CHtml::encode($data->accessdate); ?>
	<br />


</div>