<?php

$box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'Detalle Cliente ID '.$model->customerid,
   ));
   
$this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'customerid',
		'customerdsc',
		'email',
		'formula',
		'active',
),
));

$this->endWidget();?>
