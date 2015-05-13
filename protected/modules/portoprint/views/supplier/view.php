<?php

$box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'Detalle Proveedor ID '.$model->supplierid,
   ));
   
$this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'supplierid',
		'corporatename',
		'supplierdsc',
		'contactname',
		'website',
		'phone',
		'email',
		'email2',
		'email3',
		'email4',
		'email5',
		'rfc',
		'address',
		'suburb',
		'cp',
		'cityid',
		'paymentterms',
		'active',
),
));

$this->endWidget();?>

