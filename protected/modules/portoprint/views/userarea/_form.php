<?php
/* @var $this UserareaController */
/* @var $model Userarea */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userarea-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'userid'); ?>
		<?php echo $form->textField($model,'userid'); ?>
		<?php echo $form->error($model,'userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'areaid'); ?>
		<?php echo $form->textField($model,'areaid'); ?>
		<?php echo $form->error($model,'areaid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->