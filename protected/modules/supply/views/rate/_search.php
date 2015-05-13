<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'rateid',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'parentrateid',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'version',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'projectid',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'serviceid',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'userid',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statusid',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statustime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'warehouseid',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'designagencyid',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'customercontactid',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'legalentityid',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ratedate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'expiration',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'note',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'ratetype',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'quantity_1',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantity_2',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantity_3',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantity_4',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantity_5',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantity_6',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'odptime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'odctime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantityselect',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ppp_1',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ppp_2',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ppp_3',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ppp_4',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ppp_5',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ppp_6',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pprice',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'saving',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'iva',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'currency',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textAreaRow($model,'duration',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'send',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
