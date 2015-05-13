<?php
/* @var $this DesignagencyController */
/* @var $data Designagency */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('designagencyid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->designagencyid), array('view', 'id'=>$data->designagencyid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerid')); ?>:</b>
	<?php echo CHtml::encode($data->customerid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('designagencydsc')); ?>:</b>
	<?php echo CHtml::encode($data->designagencydsc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />


</div>