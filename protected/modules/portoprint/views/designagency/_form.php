<?php
/* @var $this DesignagencyController */
/* @var $model Designagency */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'designagency-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customerid'); ?>
		<?php echo $form->textField($model,'customerid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'customerid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'designagencydsc'); ?>
		<?php echo $form->textField($model,'designagencydsc',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'designagencydsc'); ?>
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