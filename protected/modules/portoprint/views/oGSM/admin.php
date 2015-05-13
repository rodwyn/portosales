
<?php 
$box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'Clientes',
    'headerButtons' => array(
				    array(
					    'class' => 'bootstrap.widgets.TbButtonGroup',
					    'type' => 'success',
					    'buttons' => array(
						    	array('label' => 'Nuevo Cliente', 'url'=>Yii::app()->createAbsoluteUrl('/portoprint/customer/create'))    
						    )
				    )
    )));

$this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'customer-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
					'customerid',
					'customerdsc',
					'email',
					'formula',
					'active',
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				),
			),
));

$this->endWidget();?>