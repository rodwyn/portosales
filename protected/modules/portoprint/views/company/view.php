<?php

$box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'Detalle Compania ID '.$model->companyid,
   ));
   
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
			'companyid',
			'corporateid',
			'companydsc',
			'rfc',
			'active',
	),
)); 

$this->endWidget();?>
