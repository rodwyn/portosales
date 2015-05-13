<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Los campos marcados con <span class="required">*</span> son obligatorios.</p>

<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldRow($model,'customerdsc',array('class'=>'span5','maxlength'=>70)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'formula',array('class'=>'span5','maxlength'=>250)); ?>

<div style="text-align: center; width:100%;">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Agregar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
