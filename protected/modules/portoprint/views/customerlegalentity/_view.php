<?php
/* @var $this CustomerlegalentityController */
/* @var $data Customerlegalentity */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerlegalentityid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->customerlegalentityid), array('view', 'id'=>$data->customerlegalentityid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('legalentity')); ?>:</b>
	<?php echo CHtml::encode($data->legalentity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rfc')); ?>:</b>
	<?php echo CHtml::encode($data->rfc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street')); ?>:</b>
	<?php echo CHtml::encode($data->street); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo CHtml::encode($data->number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('neighborhood')); ?>:</b>
	<?php echo CHtml::encode($data->neighborhood); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zipcode')); ?>:</b>
	<?php echo CHtml::encode($data->zipcode); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cityid')); ?>:</b>
	<?php echo CHtml::encode($data->cityid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerid')); ?>:</b>
	<?php echo CHtml::encode($data->customerid); ?>
	<br />

	*/ ?>

</div>