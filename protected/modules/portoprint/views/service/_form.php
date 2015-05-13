<?php
/* @var $this ServiceController */
/* @var $model Service */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'companyid'); ?>
		<?php echo $form->textField($model,'companyid'); ?>
		<?php echo $form->error($model,'companyid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'servicedsc'); ?>
		<?php echo $form->textField($model,'servicedsc',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'servicedsc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serviceparentid'); ?>
		<?php echo $form->textField($model,'serviceparentid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'serviceparentid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'level'); ?>
		<?php echo $form->textField($model,'level'); ?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->