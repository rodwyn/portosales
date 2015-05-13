<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('customerid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->customerid),array('view','id'=>$data->customerid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyid')); ?>:</b>
	<?php echo CHtml::encode($data->companyid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerdsc')); ?>:</b>
	<?php echo CHtml::encode($data->customerdsc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formula')); ?>:</b>
	<?php echo CHtml::encode($data->formula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />


</div>