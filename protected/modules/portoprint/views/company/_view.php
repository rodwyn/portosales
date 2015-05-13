<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('companyid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->companyid),array('view','id'=>$data->companyid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('corporateid')); ?>:</b>
	<?php echo CHtml::encode($data->corporate->corporatedsc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companydsc')); ?>:</b>
	<?php echo CHtml::encode($data->companydsc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rfc')); ?>:</b>
	<?php echo CHtml::encode($data->rfc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />


</div>