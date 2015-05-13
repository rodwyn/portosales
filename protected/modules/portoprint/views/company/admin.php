

<?php 
$box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'Companias',
    'headerButtons' => array(
				    array(
					    'class' => 'bootstrap.widgets.TbButtonGroup',
					    'type' => 'success',
					    'buttons' => array(
						    	array('label' => 'Nueva Compania', 'url'=>Yii::app()->createAbsoluteUrl('/portoprint/company/create'))    
						    )
				    )
    )));

$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'company-grid',
		'dataProvider'=>$model->search(),
		'columns'=>array(
				'companyid',
				'corporate.corporatedsc',
				'companydsc',
				'rfc',
				'tax',
				'duration',
		array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
		),
		),
)); ?>

<?php $this->endWidget();?>
