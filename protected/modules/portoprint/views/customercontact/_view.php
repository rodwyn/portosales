<?php
/* @var $this CustomercontactController */
/* @var $data Customercontact */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('contactid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->contactid), array('view', 'id'=>$data->contactid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerid')); ?>:</b>
	<?php echo CHtml::encode($data->customerid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plastname')); ?>:</b>
	<?php echo CHtml::encode($data->plastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mlastname')); ?>:</b>
	<?php echo CHtml::encode($data->mlastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone1')); ?>:</b>
	<?php echo CHtml::encode($data->phone1); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('phone2')); ?>:</b>
	<?php echo CHtml::encode($data->phone2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobilephone')); ?>:</b>
	<?php echo CHtml::encode($data->mobilephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mail')); ?>:</b>
	<?php echo CHtml::encode($data->mail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthday')); ?>:</b>
	<?php echo CHtml::encode($data->birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	*/ ?>

</div>