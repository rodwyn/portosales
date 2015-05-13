<?php

$box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'Detalle Cotización ID '.$model->bundleid,
   ));

   $tabs = array(
   			array(
   				'active'=>'1',
	            'label'=>'Generales',
	            'content'=> $this->renderPartial('rate/detail', array("model"=>$model), true),
	        ),
			 array(
	            'label'=>'Item',
	            'content'=> $this->renderPartial('rate/item', array("details"=>$details,"note"=>$model->note), true),
	        ),
	        array(
	            'label'=>'Arte',
	            'content'=> $this->renderPartial('rate/art', array("model"=>$modelart), true),
	        ),
	        array(
	            'label'=>'Prueba de color',
	            'content'=> $this->renderPartial('rate/color', array("model"=>$modelcolortest), true),
	        ),array(
	            'label'=>'Produccion',
	            'content'=> $this->renderPartial('rate/production', array("model"=>$modelproduction), true),
	        ),array(
	            'label'=>'Prueba Cero',
	            'content'=> $this->renderPartial('rate/zero', array("model"=>$modelzerotest), true),
	        ));
   $this->widget('bootstrap.widgets.TbTabs', array(
	'id'=>'itemstabs',
	'placement'=>'above',
    'tabs'=>$tabs,
));


$this->endWidget();?>


