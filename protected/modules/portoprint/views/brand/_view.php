<?php
/* @var $this BrandController */
/* @var $data Brand */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('brandid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->brandid), array('view', 'id'=>$data->brandid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerid')); ?>:</b>
	<?php echo CHtml::encode($data->customerid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branddsc')); ?>:</b>
	<?php echo CHtml::encode($data->branddsc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />


</div>