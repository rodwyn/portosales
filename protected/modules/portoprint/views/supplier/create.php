<?php
$box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'Nuevo Proveedor',
   ));

 echo $this->renderPartial('_form', array('model'=>$model)); 
 
$this->endWidget();?>
<script>
$(document).ready( function(){
	$(".chzn-select").chosen({no_results_text: "No se encontraron coincidencias"});
	
});
</script>