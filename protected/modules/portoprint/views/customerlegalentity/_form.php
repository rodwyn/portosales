<?php
/* @var $this CustomerlegalentityController */
/* @var $model Customerlegalentity */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customerlegalentity-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'legalentity'); ?>
		<?php echo $form->textField($model,'legalentity',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'legalentity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rfc'); ?>
		<?php echo $form->textField($model,'rfc',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'rfc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'neighborhood'); ?>
		<?php echo $form->textField($model,'neighborhood',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'neighborhood'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zipcode'); ?>
		<?php echo $form->textField($model,'zipcode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'zipcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cityid'); ?>
		<?php echo $form->textField($model,'cityid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cityid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customerid'); ?>
		<?php echo $form->textField($model,'customerid'); ?>
		<?php echo $form->error($model,'customerid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->