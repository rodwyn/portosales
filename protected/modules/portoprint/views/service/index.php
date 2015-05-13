<style>
.service
{
   font-size:10px;
   width:100%; 
   height: 350px;
}
.service label
{
   font-size:10px;
   display: inline;
}
.detail
{
   overflow:auto;
   height: 400px;
   padding:1px;
   margin:0;
}
.listservice h3{
  font-size: 19px;
}
</style>

<?php
$box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'Servicios',
   )); 
 ?>
 <div class="row-fluid listservice">
     <div class="span2">
     <h3>Rubros <a class="btn btn-mini" data-target="#entryModal" data-toggle="modal" style="margin-left:40px;">Agregar</a></h3>
     <select class="service" id="entryid" size="30" style="" >
     <?php foreach($rubros as $rubro){
     	echo '<option value="'.$rubro->serviceid.'">'.$rubro->servicedsc.'</option>';
     	
     } ?>
     </select>
     </div>
     <div class="span2"><h3>Conceptos <a class="btn btn-mini" data-target="#conceptModal" data-toggle="modal" >Agregar</a></h3>
	<select class="service" id="conceptid" size="30" ></select></div>
     <div class="span2"><h3>Servicios<a class="btn btn-mini" data-target="#serviceModal" data-toggle="modal" style="margin-left:25px;">Agregar</a></h3>
	<select class="service" id="serviceid" size="30" ></select></div>
     <div class="span2"><h3>Productos<a class="btn btn-mini" data-target="#productModal" data-toggle="modal" style="margin-left:15px;">Agregar</a></h3>
	<select class="service" id="productid" size="30" ></select></div>
     <div class="span2"><h3>Items <a class="btn btn-mini" data-target="#itemModal" data-toggle="modal" style="margin-left:50px;">Agregar</a></h3>
	<select class="service" id="itemid" size="30" ></select></div>
     <div class="span2"><h3>Atributos<a class="btn btn-mini" data-target="#itemdetailModal" data-toggle="modal" style="margin-left:25px;">Agregar</a></h3>
	<div class="service detail bootstrap-widget-content" id="servicedetail"></div></div>
</div>
<?php $this->endWidget();

$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'entryModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Agregar Rubro</h4>
	</div>
	<div class="modal-body">
		<p>Cada nuevo rubro por linea.</p>
		<textarea id="listentry" style="width:100%; height:200px;"></textarea>
	</div>
	 
	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'type' => 'primary',
		'label' => 'Aceptar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal', 'onclick'=>'js:saveservice(0);'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label' => 'Cancelar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
		)); ?>
	</div>
<?php $this->endWidget(); 



$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'conceptModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Agregar Concepto</h4>
	</div>
	<div class="modal-body">
		<p>Cada nuevo concepto por linea.</p>
		<textarea id="listconcept" style="width:100%; height:200px;"></textarea>
	</div>
	 
	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'type' => 'primary',
		'label' => 'Aceptar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal', 'onclick'=>'js:saveservice(1);'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label' => 'Cancelar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
		)); ?>
	</div>
<?php $this->endWidget(); 

$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'serviceModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Agregar Servicio</h4>
	</div>
	<div class="modal-body">
		<p>Cada nuevo servicio por linea.</p>
		<textarea id="listservice" style="width:100%; height:200px;"></textarea>
	</div>
	 
	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'type' => 'primary',
		'label' => 'Aceptar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal', 'onclick'=>'js:saveservice(2);'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label' => 'Cancelar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
		)); ?>
	</div>
<?php $this->endWidget(); 

$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'productModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Agregar Producto</h4>
	</div>
	<div class="modal-body">
		<p>Cada nuevo producto por linea.</p>
		<textarea id="listproduct" style="width:100%; height:200px;"></textarea>
	</div>
	 
	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'type' => 'primary',
		'label' => 'Aceptar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal', 'onclick'=>'js:saveservice(3);'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label' => 'Cancelar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
		)); ?>
	</div>
<?php $this->endWidget(); 

$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'itemModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Agregar Item</h4>
	</div>
	<div class="modal-body">
		<p>Cada nuevo item por linea.</p>
		<textarea id="listitem" style="width:100%; height:200px;"></textarea>
	</div>
	 
	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'type' => 'primary',
		'label' => 'Aceptar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal', 'onclick'=>'js:saveservice(4);'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label' => 'Cancelar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
		)); ?>
	</div>
<?php $this->endWidget(); 

$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'itemdetailModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Agregar atributos al concepto</h4>
	</div>
	<div class="modal-body">
		<p>Cada atributo del concepto por linea.</p>
		<textarea id="listitemdetail" style="width:100%; height:200px;"></textarea>
	</div>
	 
	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'type' => 'primary',
		'label' => 'Aceptar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal', 'onclick'=>'js:saveitemdetail();'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label' => 'Cancelar',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
		)); ?>
	</div>
<?php $this->endWidget(); ?>

<script>
function saveservice(level){
	
	var parent = 0;
	var list = list = $("#listentry").val();;
	
	if(level==1){
		parent = $("#entryid").val();
		list = $("#listconcept").val();
	}else if(level==2){
		parent = $("#conceptid").val();
		list = $("#listservice").val();
	}else if(level==3){
		parent = $("#serviceid").val();
		list = $("#listproduct").val();
	}else if(level==4){
		parent = $("#productid").val();
		list = $("#listitem").val();
	}
	$.post('<?php echo Yii::app()->createUrl('portoprint/service/create'); ?>',{level:level, parent:parent, list:list}, function(response){
		if(level==0){
			$("#entryid").load("<?php echo Yii::app()->createUrl('portoprint/combos/service'); ?>/pid/0");
		}if(level==1)
			$("#entryid").trigger('change');
		else if(level==2)
			$("#conceptid").trigger('change');
		else if(level==3)
			$("#serviceid").trigger('change');
		else if(level==4)
			$("#productid").trigger('change');
		$(".modal textarea").val('');
	})
		 
	
}

function saveitemdetail(){
	
	var concept = $("#conceptid").val();
	var list = list = $("#listitemdetail").val();	
	$.post('<?php echo Yii::app()->createUrl('portoprint/service/create'); ?>',{concept:concept, list:list}, function(response){
			$("#itemid").trigger('change');
			$(".modal textarea").val('');
	});
		 
	
}

$(document).ready( function(){
	$("#entryid").change( function(){
		$("#conceptid").load("<?php echo Yii::app()->createUrl('portoprint/combos/service'); ?>/pid/"+this.value);
		$("#serviceid, #productid, #itemid, #servicedetail").html('');
	});
	$("#conceptid").change( function(){
		$("#serviceid").load("<?php echo Yii::app()->createUrl('portoprint/combos/service'); ?>/pid/"+this.value);
		$("#productid, #itemid, #servicedetail").html('');
	});
	$("#serviceid").change( function(){
		$("#productid").load("<?php echo Yii::app()->createUrl('portoprint/combos/service'); ?>/pid/"+this.value);
		$("#itemid, #servicedetail").html('');
	});
	$("#productid").change( function(){
		$("#itemid").load("<?php echo Yii::app()->createUrl('portoprint/combos/service'); ?>/pid/"+this.value);
		$("#servicedetail").html('');
	});
	$("#itemid").change( function(){
		var conceptid = $("#conceptid").val();
		$("#servicedetail").load("<?php echo Yii::app()->createUrl('portoprint/combos/servicedetail'); ?>/cid/"+conceptid+"/sid/"+this.value);
	});
	
});
</script>