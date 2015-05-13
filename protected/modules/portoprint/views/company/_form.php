<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Los campos marcados con <span class="required">*</span> son obligatorios.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model, 'corporateid', $corporates, array('data-placeholder'=>'Selecione', 'style'=>'width:350px;', 'class'=>'chzn-select')); ?>

	<?php echo $form->textFieldRow($model,'companydsc',array('maxlength'=>70)); ?>

	<?php echo $form->textFieldRow($model,'rfc',array('maxlength'=>30)); ?>
	
	<?php echo $form->textFieldRow($model,'tax',array('maxlength'=>30)); ?>
	<span class="hint">
		Todos los impuestos separados por comas.
	</span>
	
	<?php echo $form->dropDownListRow($model, 'duration', array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7',), array('data-placeholder'=>'Selecione', 'style'=>'width:70px;', 'class'=>'chzn-select')); ?>

<div style="text-align: center; width:100%;">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Agregar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
