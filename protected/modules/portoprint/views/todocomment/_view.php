<?php
/* @var $this TodocommentController */
/* @var $data Todocomment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('commentid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->commentid), array('view', 'id'=>$data->commentid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('todoid')); ?>:</b>
	<?php echo CHtml::encode($data->todoid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo CHtml::encode($data->userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cdate')); ?>:</b>
	<?php echo CHtml::encode($data->cdate); ?>
	<br />


</div>