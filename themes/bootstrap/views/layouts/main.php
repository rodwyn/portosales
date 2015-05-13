<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php
	$cs=Yii::app()->clientScript;
	$cs->scriptMap=array( 'jquery.js'=>Yii::app()->request->baseUrl.'/js/jquery-1.9.1.min.js',	
	                      'jquery-ui.min.js'=>Yii::app()->request->baseUrl.'/js/jquery-ui-1.10.2.custom.min.js' ,
						  );
	$cs->registerCoreScript('jquery.ui'); 
	$cs->registerCoreScript('bbq');
	
	
	?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vis.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js"></script>	
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datepicker.css" rel="stylesheet"></link>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar.min.js"></script>	
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fullcalendar.css" rel="stylesheet"></link>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/chosen.jquery.min.js" type="text/javascript"></script>
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/chosen.css" rel="stylesheet"></link>
	<style>
	#page {
	    padding-top: 60px;
	}
	
	</style>
	<script>
	function redondeo2decimales(numero)
	{
		var original=parseFloat(numero);
		var result=Math.round(original*100)/100 ;
		return result;
	}
	function addCommas(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
	</script>
</head>
<body>

<?php 
if(!isset(Yii::app()->user->companydsc)){
	$this->redirect(Yii::app()->request->baseUrl);
}
$this->widget('bootstrap.widgets.TbNavbar', array(
    //'type'=>'inverse', // null or 'inverse'

    //'brandUrl'=>'#',
    //'collapse'=>true,
    'items'=>array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
			                array('label'=>'Compania', 'url'=>'#', 'items'=>array(
			                    array('label'=>'Companias', 'url'=>Yii::app()->createUrl('portoprint/company')),
			                    array('label'=>'Servicios', 'url'=>Yii::app()->createUrl('portoprint/service')),
			                    array('label'=>'Clientes', 'url'=>Yii::app()->createUrl('portoprint/customer')),
			                    array('label'=>'Proveedores', 'url'=>Yii::app()->createUrl('portoprint/supplier')),
			                )),
			                array('label'=>'Reportes', 'url'=>'#', 'items'=>array(
			                    array('label'=>'Registro de Actividad', 'url'=>'#'),
			                    array('label'=>'Scorecard', 'url'=>'#')
			                )),
			                array('label'=>'Cotizaciones', 'url'=>Yii::app()->createAbsoluteUrl('/portoprint/rate') ),
			                array('label'=>'Usuarios', 'url'=>'#', 'items'=>array(
			                    array('label'=>'Portoprint', 'url'=>'#'),
			                    array('label'=>'Proveedores', 'url'=>'#')
			                ))
			            ),
			        ),       
			        array(
			            'class'=>'bootstrap.widgets.TbButtonGroup',
			            'htmlOptions'=>array('class'=>'pull-right'),
			        	'type'=>'primary',
			            'buttons'=>array(
					                array('label'=>Yii::app()->user->companydsc, 'url'=>'#', 
					                	'items'=>Yii::app()->user->items),
					            )
			        )
			    )
)); 
?>

<div class="container" id="page">

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer"></div><!-- footer -->

</div><!-- page -->

</body>
</html>
