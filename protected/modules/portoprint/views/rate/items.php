<div id="step4error" style="display:none;">
	<div class="alert alert-block alert-error fade in">
         <strong>Todos los campos son obligatorios, por favor verifique.</strong>
   </div>
</div>	
<?php $this->widget('bootstrap.widgets.TbTabs', array(
	'id'=>'itemstabs',
	'placement'=>'above',
    'tabs'=>$tabs,
)); ?>
