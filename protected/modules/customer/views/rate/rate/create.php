<?php 
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript(CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl.'/js/bwizard.min.js');
$cs->registerScriptFile($baseUrl.'/js/chosen.jquery.min.js');
$cs->registerCssFile($baseUrl.'/css/bwizard.min.css');
$cs->registerCssFile($baseUrl.'/css/chosen.css');
?>
<script type="text/javascript">
var changeartid;
var nchangea = 0;
var ndistribution=0;
var ndistributionplace = "";
var ndistributionquantity = "";
var useroptions = "";


function addrowdistribution(){		
	ndistributionplace = $('#distributionplacef').val();
	ndistributionquantity = $('#distributionquantityf').val();
	if(ndistributionplace!='' && ndistributionquantity!=''){
		ndistribution++;
		var content = '<tr class="drdl" id="drd_'+ndistribution+'">';
		    content+= '<td>'+ndistributionplace+'<input type="hidden" name="ndpf_'+ndistribution+'" id="ndpf_'+ndistribution+'" value="'+ndistributionplace+'"></td>';
		    content+= '<td>'+ndistributionquantity+'<input type="hidden" name="ndcf_'+ndistribution+'" id="ndcf_'+ndistribution+'" value="'+ndistributionquantity+'"></td>';
		    content+= '<td><li class="btn btn-small btn-danger icon-trash" id="delrdistributionbtn_'+ndistribution+'" onclick="deletedistribution('+ndistribution+');"></li></td>';
			content+= '</tr>';
		$('#ratedistributiontable').append(content);		  	
		$('#distributionplacef, #distributionquantityf').val('');
	} else
		bootbox.alert("Los campos no pueden estar vacíos, por favor verifique", function() {});
}

function deletedistribution(nd){
	$('#drd_'+nd).remove();
}

function deletechangeart(idfix){
	$('#calr_'+idfix).remove();
}

function caclean(id){
	$("#cal_"+id+"_table").empty();

	if( $("#ca_"+id).val() != '' && $("#ca_"+id).val() > 0 ){
		 if(id < 6){
		   id++;
		   $("#ca_"+id).attr('disabled', false);
		 }
	} else {
		 id++;
		 while(id <= 6){
		   $("#ca_"+id).attr('disabled', true).val('0');
		   $("#cal_"+id+"_table").empty();
		   id++;		   
		 }
	}
}

function showchangeartform(id){
	changeartid = id;
	$("#changeartname").focus();
	$("#changeartname, #changeartquantity").val("");
	$('#ChangeArtD').modal();
}

function savechangeart() {
    var tot = 0;
    
    if( $("#changeartname").val()=='' || isNaN($("#changeartquantity").val()) ){
    	bootbox.alert("Los campos no pueden estar vacíos, por favor verifique", function() {});
    } else {
    	$('[id^="caqf_'+changeartid+'"]').each( function(){
            tot += Number($(this).val());
        });
        tot += eval($("#changeartquantity").val());
	    if( eval($("#ca_"+changeartid).val()) < tot ){
	 	  bootbox.alert("La suma de los cambios de arte ("+tot+") no puede ser mayor a la cantidad a cotizar ("+eval($("#ca_"+changeartid).val())+"), por favor verifique ", function() {});
	    } else{
	        nchangea++;
	        cacontent = '<tr id="calr_'+changeartid+'_'+nchangea+'">';
	        cacontent+= '<td>'+$("#changeartname").val()+'<input type="hidden" name="canf['+changeartid+']['+nchangea+']" id="canf_'+changeartid+'_'+nchangea+'" value="'+$("#changeartname").val()+'"></td>';
	        cacontent+= '<td>'+$("#changeartquantity").val()+'<input type="hidden" class="caqfc" name="caqf['+changeartid+']['+nchangea+']" id="caqf_'+changeartid+'_'+nchangea+'" value="'+$("#changeartquantity").val()+'"></td>';
	        cacontent+= '<td width="15"><li class="btn btn-mini btn-danger icon-trash" id="delcabtn_'+changeartid+'_'+nchangea+'" onclick="deletechangeart(\''+changeartid+'_'+nchangea+'\');"></li></td>';
	        cacontent+= '</tr>';
	        $('#cal_'+changeartid+'_table').append(cacontent);
	    }
    }
}

function saveproject() {
	var brandid = $('#Rate_brandid').val();
    var projectdsc =  $("#newproject").val();
	if(brandid!='' && projectdsc!=''){
	    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/addproject') ?>',{brandid:brandid,projectdsc:projectdsc}, function(response){
	    	$('#Rate_projectid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/project') ?>/brandid/'+brandid , function(){
	    		$('#Rate_projectid').val(response).trigger("liszt:updated");
		    });
	    	
	    });
	} else {
		bootbox.alert("Seleccione una Marca y verfique el nombre del nuevo proyecto.", function() {});
	}
}

function newitemdatilvalue(idid){
	bootbox.prompt("Introduzca el nuevo valor", function(result) {
		if (result !== null) {
			$.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/additemdetailvalue') ?>',{itemdetailid:idid, value:result}, function(response){
		    	$('#itemdetail_'+idid).load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/itemdetailvalue') ?>/itemdetailid/'+idid , function(){
		    		$('#itemdetail_'+idid).val(response).trigger("liszt:updated");
			    });
		    	
		    });
	
		}
	});
}

$(document).ready( function(){
	$("#Rate_projectid").after('<span style="margin-left:5px;margin-bottom:16px;" class="btn btn-mini" data-target="#newprojectModal" data-toggle="modal">+</span>');
	$('#Rate_expiration').datepicker({format:'yyyy-mm-dd'});
	$(".chzn-select").chosen({no_results_text: "No se encontraron coincidencias"});
	$("#Ratewizard").bwizard({
					autoPlay: false, 
					backBtnText: "Regresar", 
					cache: false, 
					clickableSteps: false, 
					nextBtnText: "Siguiente",
					validating: function (e, ui) { 
						var customerid = $('#Rate_customerid').val();
						var customerdsc = $("#Rate_customerid  option:selected").text();
						var legalid = $('#Rate_legalentityid').val();
						var legaldsc = $("#Rate_legalentityid  option:selected").text();
						var brandid = $('#Rate_brandid').val();
						var branddsc = $("#Rate_brandid  option:selected").text();
						var projectid = $('#Rate_projectid').val();
						var projectdsc = $("#Rate_projectid  option:selected").text();
						var contactid = $('#Rate_customercontactid').val();
						var contactdsc = $("#Rate_customercontactid  option:selected").text();
						var warehouseid = $('#Rate_warehouseid').val();
						var warehousedsc = $("#Rate_warehouseid  option:selected").text();
						var designid = $('#Rate_designagencyid').val();
						var designdsc = $("#Rate_designagencyid  option:selected").text();

						var serviceid = $('#Rate_serviceid').val();
						var servicedsc = $("#Rate_serviceid  option:selected").text();
						var ratetype = $('#Rate_ratetype').val();
						var ratetypedsc = $("#Rate_ratetype  option:selected").text();
						var expiration = $('#Rate_expiration').val();
						var iva = $('#Rate_iva').val();
						var duration = $('#Rate_duration').val();
						
						$("#step1error, #step2error, #step3error, #step4error, #step5error, #step6error, #step7error, #step8error ").hide();

						if(ui.panel.id == 'step1'){
							if(customerid=='' || legalid == '' || brandid =='' || projectid == '' || contactid == '' || warehouseid == '' || designid == '' ){
							  	$("#step1error").show();
							  	return false;
							}
						} 

						else if(ui.panel.id == 'step2' && ui.nextIndex==2 ){											
							if(serviceid== null || serviceid=='' || ratetype == '' || expiration =='' || iva == '' || duration == '' ){
								$("#step2error").show();
								return false;
							} else{
								
								
							}
						} else if(ui.panel.id == 'step3' && ui.nextIndex==3){	
							var cantidad=0;
							$(".quantitytable  .dqr").each( function(a,b){
								cantidad+=eval($(this).val());
							});
															
							if(cantidad <= 0 ){
							  	$("#step3error").show();
							  	return false;
							} 
						} else if(ui.panel.id == 'step4' && ui.nextIndex==4){		
							var completo = true;
							$(".itemdetailtable  select").each( function(a,b){
								if( $(b).val()=='' && completo == true)
									completo = false
							});
															
							if(completo == false ){
							  	$("#step4error").show();
							  	return false;
							} 				
							
						} else if(ui.panel.id == 'step5' && ui.nextIndex==5){		
							var completo = false;
							$(".supplierdetailtable input:checked").each( function(a,b){
								completo = true;
							});
															
							if(completo == false ){
							  	$("#step5error").show();
								return false;
							} else{					
								
							}					
							
						} else if(ui.panel.id == 'step8' && ui.nextIndex==8){	

							var citems = eval($("#extraitemsnumber").val());
							var itms=0;
							var bys=0;
							$(".itemextrai").each( function(a,b){
								if($(b).val()!='')
								   itms++;
							});		

							$(".itemextrac").each( function(a,b){
								if($(b).val()!='')
								   bys++;
							});			  
							if(itms!=citems || bys!=citems){
								$("#step8error").show();
								return false;
							} else {
							
								$("#lcustomerdsc").html(customerdsc);
								$("#llegaldsc").html(legaldsc);	
								$("#lbranddsc").html(branddsc);	
								$("#lprojectdsc").html(projectdsc);	
								$("#lcontactdsc").html(contactdsc);	
								$("#lwarehousedsc").html(warehousedsc);	
								$("#ldesigndsc").html(designdsc);	
								$("#lservicedsc").html(servicedsc);	
								$("#lratetype").html(ratetype);	
								$("#lexpiration").html(expiration);	
								$("#lduration").html(duration);		
								$("#liva").html(iva);	
								$(".leitems").remove();
								$(".itemextrai").each( function(a,b){
								    var reli = $(b).attr('rel');
								    var itemi = $("#ei_"+reli+" option:selected").text(); 
								    var buyi =  $("#cei_"+reli+" option:selected").text();							    
								    $("#rategenerate").append('<tr class="leitems"><th>Item</th><td>'+itemi+'</td><th>Comprador</th><td>'+buyi+'</td></tr>');
								});
							}
							
						}
						
					} 
	 });

	$('#Rate_customerid').change( function(){
		var customerid = $(this).val();
		$('#Rate_legalentityid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/legal') ?>/customerid/'+customerid , function(){
			$('#Rate_legalentityid').trigger("liszt:updated");
		});
		$('#Rate_brandid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/brand') ?>/customerid/'+customerid , function(){
			$('#Rate_brandid').trigger("liszt:updated");
		});
		$('#Rate_projectid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/project') ?>/brandid/0' , function(){
			$('#Rate_projectid').trigger("liszt:updated");
		});
		$('#Rate_customercontactid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/contact') ?>/customerid/'+customerid, function(){
			$('#Rate_customercontactid').trigger("liszt:updated");
		});
		$('#Rate_warehouseid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/warehouse') ?>/customerid/'+customerid , function(){
			$('#Rate_warehouseid').trigger("liszt:updated");
		});
		$('#Rate_designagencyid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/design') ?>/customerid/'+customerid, function(){
			$('#Rate_designagencyid').trigger("liszt:updated");
		});
	});

	$('#Rate_serviceid').change( function(){
		var serviceid = $(this).val();
		$("#step3").load("<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/quantities') ?>",{ items:serviceid}, function(){ $("#ca_1").select();});
		$("#step4").load("<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/items') ?>",{ items:serviceid});
		$("#step5").load("<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/suppliers') ?>",{ items:serviceid});
		$("#step6").load("<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/distribution') ?>",{ items:serviceid});
	});
	

	$('#Rate_brandid').change( function(){
		var brandid = $(this).val();
		$('#Rate_projectid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/project') ?>/brandid/'+brandid, function(){
			$('#Rate_projectid').trigger("liszt:updated");
		});
	});

	$("#extraitemsbtn").click( function(){
		 if($(this).is(':checked')) 
	       $("#extraitemsdiv").show();  
	   	 else 
	   		$("#extraitemsdiv").hide(); 
	});

	$("#extraitemsnumber").change( function(){
		$("#itembody").html('');
		
		var customerid = $('#Rate_customerid').val();
		var nl = $("#extraitemsnumber").val();
		var opt = $("#Rate_serviceid").html();
		useroptions = $.ajax({ type: "GET", url: '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/user') ?>/customerid/'+customerid, async: false })
		               .responseText;
		for(x=1;x<=nl;x++){
		    $("#itembody").append('<tr><th>Item</th><td><select style="width:350px;" data-placeholder="Seleccione" class="chzn-select itemextrai" rel="'+x+'" name="ei['+x+']" id="ei_'+x+'"></select></td><th>Comprador</th><td><select style="width:350px;" data-placeholder="Seleccione" class="chzn-select itemextrac" name="cei['+x+']" id="cei_'+x+'"></select></td></tr>');
		    $("#ei_"+x).append(opt).chosen();
		    $("#cei_"+x).append(useroptions).chosen();
		}
	});
});


</script>
<style>
.well{background-color:#FCFCFC;}
.tab-content{}
</style>
<?php 

    $box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'Nueva Cotización',
    'headerButtons' => array(
				    array(
					    'class' => 'bootstrap.widgets.TbButtonGroup',
					    'type' => 'success',
					    'buttons' => array(
						    	array('label' => 'Nueva cotizacion', 'url'=>Yii::app()->createAbsoluteUrl('/portoprint/rate/create'))    
						    )
				    )
    )));
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

<div id="Ratewizard">
	<ol>
		<li>Cliente</li>
		<li>Cotización</li>
		<li>Cantidades</li>
		<li>Medidas</li>
		<li>Proveedores</li>		
		<li>Distribución</li>
		<li>Archivos</li>
		<li>Otros Items</li>
		<li>Generar</li>
	</ol>
	<div>
			<?php echo $form->errorSummary($model); ?>
			
			<div id="step1error" style="display:none;">
				<div class="alert alert-block alert-error fade in">		            
		            <strong>Todos los campos son obligatorios, por favor verifique.</strong>
		         </div>
			</div>			
		    <?php echo $form->dropDownListRow($model, 'customerid', $customerlist, array('data-placeholder'=>'Selecione', 'style'=>'width:350px;', 'class'=>'chzn-select')); ?>
		    <?php echo $form->dropDownListRow($model, 'legalentityid', array(''=>'Seleccione'), array('data-placeholder'=>'Selecione', 'style'=>'width:350px;', 'class'=>'chzn-select')); ?>
		    <?php echo $form->dropDownListRow($model, 'brandid',  array(''=>'Seleccione'), array('data-placeholder'=>'Selecione', 'style'=>'width:350px;', 'class'=>'chzn-select')); ?>
		    <?php echo $form->dropDownListRow($model, 'projectid', array(''=>'Seleccione'), array('data-placeholder'=>'Selecione', 'style'=>'width:350px;', 'class'=>'chzn-select')); ?>
		    <?php echo $form->dropDownListRow($model, 'customercontactid', array(''=>'Seleccione'), array('data-placeholder'=>'Selecione', 'style'=>'width:350px;', 'class'=>'chzn-select')); ?>
		    <?php echo $form->dropDownListRow($model, 'warehouseid', array(''=>'Seleccione'), array('data-placeholder'=>'Selecione', 'style'=>'width:350px;', 'class'=>'chzn-select')); ?>
		    <?php echo $form->dropDownListRow($model, 'designagencyid', array(''=>'Seleccione'), array('data-placeholder'=>'Selecione', 'style'=>'width:350px;', 'class'=>'chzn-select')); ?>
	</div>
	<div>
			<div id="step2error" style="display:none;">
				<div class="alert alert-block alert-error fade in">		            
		            <strong>Todos los campos son obligatorios, por favor verifique.</strong>
		         </div>
			</div>	
		    <?php echo $form->dropDownListRow($model, 'serviceid', $service, array('data-placeholder'=>'Selecione', 'style'=>'width:350px;', 'class'=>'chzn-select')); ?>
			<?php $model->expiration = date('Y-m-d'); ?>	
			<?php echo $form->dropDownListRow($model, 'ratetype', array('Normal'=>'Normal','Urgente'=>'Urgente','Inmediato'=>'Inmediato'), array('data-placeholder'=>'Selecione', 'style'=>'width:150px;', 'class'=>'chzn-select')); ?>
		    <?php echo $form->textFieldRow($model, 'expiration', array('style'=>'width:150px;') ); ?>
		    <?php echo $form->dropDownListRow($model, 'iva',  Yii::app()->user->tax, array('data-placeholder'=>'Selecione', 'style'=>'width:150px;', 'class'=>'chzn-select')); ?>
		    <?php echo $form->dropDownListRow($model, 'duration', Yii::app()->user->duration, array('data-placeholder'=>'Selecione', 'style'=>'width:150px;', 'class'=>'chzn-select')); ?>
			
	</div>
	<div><p>Cargando Cantidades, espere...</p></div>
	<div><p>Cargando Medidas, espere...</p></div>
	<div><p>Cargando Proveedores, espere...</p></div>	
	<div><p>Cargando Distribución, espere...</p></div>
	<div><p><?php echo $form->fileFieldRow($model, 'image'); ?></p></div>
	<div>
	    <div id="step8error" style="display:none;">
				<div class="alert alert-block alert-error fade in">		            
		            <strong>Seleccione los items y los compradores para poder continuar.</strong>
		         </div>
			</div>	
		<div id="extraitemsdiv" style="padding:10px;">
		   <div style="font-weight:bold; margin-bottom:30px;">Seleccione el numero de items que se van a agregar a la cotización 
		   	<select id="extraitemsnumber" style="margin-left:15px;width:80px;">
		   		<option value="0" selected></option>
		   		<option value="1">1</option>
		   		<option value="2">2</option>
		   		<option value="3">3</option>
		   		<option value="4">4</option>
		   		<option value="5">5</option>
		   		<option value="6">6</option>
		   		<option value="7">7</option>
		   		<option value="8">8</option>
		   		<option value="9">9</option>
		   	</select>
		   	</div>
		   	<table class="table table-striped table-condensed">
				<tbody id="itembody"></tbody>
		   	</table>
		</div>
	</div>
	<div>
	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
'title' => 'Generar cotización',
'headerIcon' => 'icon-th-list',
// when displaying a table, if we include bootstra-widget-table class
// the table will be 0-padding to the box
'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>
		<br /><br />
		<table id="rategenerate" class="table">
			<tbody>
				<tr><th>Cliente</th><td><span id="lcustomerdsc"></span></td><th>Razon social</th><td><span id="llegaldsc"></span></td></tr>
				<tr><th>Marca</th><td><span id="lbranddsc"></span></td><th>Proyecto</th><td><span id="lprojectdsc"></span></td></tr>
				<tr><th>Contacto comercial</th><td><span id="lcontactdsc"></span></td><th>Bodega</th><td><span id="lwarehousedsc"></span></td></tr>
				<tr><th>Agencia de diseño</th><td><span id="ldesigndsc"></span></td><th>Tipo de cotización</th><td><span id="lratetype"></span></td></tr>
				<tr><th>Fecha de entrega</th><td><span id="lexpiration"></span></td><th>IVA</th><td><span id="liva"></span>%</td></tr>
				<tr><th>Duración</th><td><span id="lduration"></span>Hr</td><th>&nbsp;</th><td>&nbsp;</td></tr>
				<tr><th>&nbsp;</th><td>&nbsp;</td><th>&nbsp;</th><td>&nbsp;</td></tr>
				<tr><th>Item</th><td><span id="lservicedsc"></span></td><th>Comprador</th><td><?php echo Yii::app()->user->username ?></td></tr>
				
			</tbody>
		</table>
		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
	            'buttonType'=>'submit',
	            'type'=>'primary',
	            'label'=>'Generar Nueva Cotización',
				'size' => 'large'
	        )); ?>
		</div>
	</div>
	<?php $this->endWidget(); ?>	
</div>
<?php $this->endWidget(); ?>

<?php $this->endWidget();?>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'ChangeArtD')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Cambios de Arte</h4>
</div>
<div class="modal-body">
	<div><label for="changeartname" class="control-label required" style="display:inline;">Nombre </label><span class="required">*</span> <input type="text" id="changeartname" style="width:400px" value=""/></div>
	<div><label for="changeartname" class="control-label required" style="display:inline;">Cantidad </label><span class="required">*</span> <input type="text" id="changeartquantity" style="width:100px; text-align: right;" value=""/></div>
</div> 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Aceptar',
   	    'url'=>'#',
        'htmlOptions'=>array('id'=>'changeartok', 'data-dismiss'=>'modal', 'onclick'=>'js:savechangeart();'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cancelar',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'newprojectModal')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Agregar Proyecto</h4>
</div>
<div class="modal-body">
	<div><label for="newproject" class="control-label required" style="display:inline;">Nombre del proyecto </label><span class="required">*</span> <input type="text" id="newproject" style="width:400px" value=""/></div>
</div> 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Aceptar',
   	    'url'=>'#',
        'htmlOptions'=>array('id'=>'newprojectok', 'data-dismiss'=>'modal', 'onclick'=>'js:saveproject();'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cancelar',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>
