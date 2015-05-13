<?php
/* @var $this AccessController */
/* @var $model Access */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'access-form',
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
		<?php echo $form->labelEx($model,'menuid'); ?>
		<?php echo $form->textField($model,'menuid'); ?>
		<?php echo $form->error($model,'menuid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oper'); ?>
		<?php echo $form->textField($model,'oper',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'oper'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textArea($model,'data',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accessdate'); ?>
		<?php echo $form->textField($model,'accessdate'); ?>
		<?php echo $form->error($model,'accessdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->