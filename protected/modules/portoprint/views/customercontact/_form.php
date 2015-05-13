<?php
/* @var $this CustomercontactController */
/* @var $model Customercontact */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customercontact-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customerid'); ?>
		<?php echo $form->textField($model,'customerid'); ?>
		<?php echo $form->error($model,'customerid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'plastname'); ?>
		<?php echo $form->textField($model,'plastname',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'plastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mlastname'); ?>
		<?php echo $form->textField($model,'mlastname',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'mlastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone1'); ?>
		<?php echo $form->textField($model,'phone1',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone2'); ?>
		<?php echo $form->textField($model,'phone2',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobilephone'); ?>
		<?php echo $form->textField($model,'mobilephone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'mobilephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->textField($model,'mail',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
		<?php echo $form->error($model,'birthday'); ?>
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