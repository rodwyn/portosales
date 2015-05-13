<div id="step3error" style="display:none;">
	<div class="alert alert-block alert-error fade in">
        <strong>Introduzca al menos una cantidad a cotizar para poder continuar.</strong>
    </div>
</div>	
<?php $this->widget('bootstrap.widgets.TbTabs', array(
	'id'=>'quantitiestabs',
	'placement'=>'above',
    'tabs'=>$tabs,
)); ?>
