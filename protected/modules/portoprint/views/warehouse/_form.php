<?php
/* @var $this WarehouseController */
/* @var $model Warehouse */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'warehouse-form',
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
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adress'); ?>
		<?php echo $form->textField($model,'adress',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'adress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'neighborhood'); ?>
		<?php echo $form->textField($model,'neighborhood',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'neighborhood'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'schedule'); ?>
		<?php echo $form->textField($model,'schedule',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'schedule'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'special'); ?>
		<?php echo $form->textArea($model,'special',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'special'); ?>
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