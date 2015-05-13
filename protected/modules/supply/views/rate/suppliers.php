<div id="step5error" style="display:none;">
	<div class="alert alert-block alert-error fade in">
         <strong>Seleccione al menos un proveedor para poder continuar.</strong>
   </div>
</div>	
<?php $this->widget('bootstrap.widgets.TbTabs', array(
	'id'=>'suppliertabs',
	'placement'=>'above',
    'tabs'=>$tabs,
)); ?>
