<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'supplier-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Los campos marcados con <span class="required">*</span> son obligatorios.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row-fluid">
     <div class="span6">
		<?php echo $form->textFieldRow($model,'corporatename',array('maxlength'=>100)); ?>
	</div>
	<div class="span6">
	<?php echo $form->textFieldRow($model,'supplierdsc',array('maxlength'=>100)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
	<?php echo $form->textFieldRow($model,'contactname',array('maxlength'=>100)); ?>
	</div>
	<div class="span6">
	<?php echo $form->textFieldRow($model,'website',array('maxlength'=>100)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
	<?php echo $form->textFieldRow($model,'phone',array('maxlength'=>30)); ?>
	</div>
	<div class="span6">
	<?php echo $form->textFieldRow($model,'email',array('maxlength'=>100)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
	<?php echo $form->textFieldRow($model,'email2',array('maxlength'=>100)); ?>
	</div>
	<div class="span6">
	<?php echo $form->textFieldRow($model,'email3',array('maxlength'=>100)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
	<?php echo $form->textFieldRow($model,'email4',array('maxlength'=>100)); ?>
	</div>
	<div class="span6">
	<?php echo $form->textFieldRow($model,'email5',array('maxlength'=>100)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
	<?php echo $form->textFieldRow($model,'rfc',array('maxlength'=>15)); ?>
	</div>
	<div class="span6">
	<?php echo $form->textFieldRow($model,'address',array('maxlength'=>100)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
	<?php echo $form->textFieldRow($model,'suburb',array('maxlength'=>100)); ?>
	</div>
	<div class="span6">
	<?php echo $form->textFieldRow($model,'cp',array('maxlength'=>100)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
	<?php echo $form->textFieldRow($model,'cityid',array('maxlength'=>10)); ?>
	</div>
	<div class="span6">
	<?php echo $form->textFieldRow($model,'paymentterms',array('maxlength'=>50)); ?>
	</div>
</div>

<div class="row-fluid">
	<div class="span12" style="text-align:center;">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Agregar' : 'Guardar',
		)); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
