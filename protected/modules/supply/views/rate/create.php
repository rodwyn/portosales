
<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2>Generar Nueva Cotización</h2>
				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body">
						<div class="row">
						<form novalidate="novalidate" class="smart-form" id="rate-form" method="POST" action="index.php?r=portoprint/rate/created" >
						<input type="hidden" vaue="1" name="paso" />	
						<header>
								<strong>Datos del Evento</strong>
						</header>
										
						<fieldset>
							<div class="row">
								<section class="col col-6">
									<label class="label">Cliente</label>
									<label class="input"> 
									<select id="Rate_customerid" name="Rate_customerid" class="select2">
									<option value="">Seleccione</option>
									<?php foreach($customerlist as $customer => $list){?>
										<option value="<?php echo $customer ?>"><?php echo $list; ?></option>
									<?php } ?>
									</select>	
									</label>
								</section>
								<section class="col col-6">
									<label class="label">Razón Social</label>
									<label class="input"> 
									<select id="Rate_legalentityid" name="Rate_legalentityid" class="select2"><option value="">Seleccione</option></select>
									</label>
								</section>							
							</div>
							<div class="row">							
								<section class="col col-5">
									<label class="label">Marca</label>
									<label class="input"> 
									<select id="Rate_brandid" name="Rate_brandid" class="select2"><option value="">Seleccione</option></select>
									</label>
								</section>
								<section class="col col-6">
									<label class="label">Proyecto</label>
									<label class="input"> 
									<select id="Rate_projectid" name="Rate_projectid" class="select2"><option value="">Seleccione</option></select>									
									</label>
									
								</section>
								<section class="col col-1" style="padding-top:35px;">
									<a href="javascript:void(0);" class="btn btn-default btn-xs" data-target="#newproject"  data-toggle="modal">Nuevo</a>
								</section>
							</div>
							<div class="row">	
								<section class="col col-4">				
									<label class="label">Contacto Comercial</label>
									<label class="input"> 
									<select id="Rate_customercontactid" name="Rate_customercontactid" class="select2"><option value="">Seleccione</option></select>
									</label>
								</section>
								<section class="col col-4">
									<label class="label">Bodega</label>
									<label class="input"> 
									<select id="Rate_warehouseid" name="Rate_warehouseid" class="select2"><option value="">Seleccione</option></select>
									</label>
								</section>
								<section class="col col-4">
									<label class="label">Agencia de Diseño</label>
									<label class="input"> 
									<select id="Rate_designagencyid" name="Rate_designagencyid" class="select2"><option value="">Seleccione</option></select>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-3">
										<label class="label">Tipo de Cotización</label>
										<label class="input"> 
										<select id="Rate_ratetype" name="Rate_ratetype" class="select2"><option value="">Seleccione</option>
											<option value="Normal">Normal</option>
											<option value="Urgente">Urgente</option>
											<option value="Inmediato">Inmediato</option>
										</select>
										</label>
								</section>
								<section class="col col-3">
									<label class="label">Fecha de Entrega</label>
									<label class="input"> 
									<i class="icon-append fa fa-calendar"></i>
									<input type="text"  id="Rate_expiration" name="Rate_expiration">
									</label>
								</section>
								<section class="col col-2">
										<label class="label">IVA</label>
										<label class="input"> 
										<select id="Rate_iva" name="Rate_iva" class="select2"><option value="">Seleccione</option>
										<?php foreach(Yii::app()->user->tax as $value=> $text){?>
											<option value="<?php echo $value; ?>"><?php echo $text; ?></option>
										<?php } ?>
										</select>
										</label>
								</section>
								<section class="col col-2">
									<label class="label">Duración</label>
									<label class="input"> 
									<select id="Rate_duration" name="Rate_duration" class="select2"><option value="">Seleccione</option>
									<?php foreach(Yii::app()->user->duration as $value=> $text){?>
										<option value="<?php echo $value; ?>"><?php echo $text; ?></option>
									<?php } ?>
									</select>
									</label>
								</section>
								<section class="col col-2">
									<label class="label">Bureau Veritas</label>
										<label class="input"> 
										<select id="Rate_bureau" name="Rate_bureau" class="select2">
											<option value="1">SI</option>
											<option value="0">No</option>
										</select>
										</label>
								</section>
							</div>
							
						</fieldset>
						
						<header>
								<strong>Items</strong>
							</header>
							<fieldset>
								<div id="step0error" class="alert alert-danger fade in" style="display:none;">											
										 <strong>Seleccione todas las categorias .</strong>
									</div>
								<div class="row">
									<section class="col col-4">
										<label class="label">Seleccione el numero de items que se van a agregar a la cotización </label>
										<label class="input"> 
										<select id="extraitemsnumber" name="extraitemsnumber" class="select2">
											<option value="0" selected>Ninguno</option>
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
										</label>
									</section>
									
								</div>
								<div class="row">									
									<section class="col col-10">
										<table style="width:100%;" class="table table-striped table-condensed">
											<tbody id="itembody"></tbody>
									   	</table>
									</section>
									
								</div>
							</fieldset>						
								
							<footer>
								<button type="submit" class="btn btn-primary btn-lg">
									Crear Cotización
								</button>
								
							</footer>
						
					</form>
						</div>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->

		<!-- NEW WIDGET START -->
		
		<!-- WIDGET END -->

	</div>

	<!-- end row -->

</section>
<!-- end widget grid -->


<div class="modal fade" id="newproject" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Nuevo Proyecto</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="#" id="nproyect" novalidate="novalidate" class="smart-form">	
        <fieldset>
			<table class="table table-bordered">
			<tbody>
					
					<tr><td><label for="NTproject">Nombre del Proyecto </label></td><td>
					<input type="text" id="NTproject" />
					</td></tr>
					<tr>
				</tbody>
			</table>
		</fieldset>
        <footer>
	      	<button class="btn btn-primary" class="btn btn-default" id="sendproject" type="button" ata-dismiss="modal">Aceptar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	

<script type="text/javascript">
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	pageSetUp();
	runFormValidation();
	function sendnewproyect(){
		var brandid = $("#Rate_brandid").val();
        var proyectdsc = $("#NTproject").val();
		$.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/addproyect') ?>',{brandid:brandid, projectdsc:projectdsc}, function(response){
			$('#Rate_projectid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/project') ?>/brandid/'+brandid).select2("val", response);	
	    	
	    });

	}

	$(document).ready( function(){
		$('#Rate_customerid').change( function(){
			var customerid = $(this).val();
			$("#extraitemsnumber").select2("val", '0');
			$("#itembody").html('');
			$('#Rate_legalentityid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/legal') ?>/customerid/'+customerid).select2("val", '');
			$('#Rate_brandid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/brand') ?>/customerid/'+customerid).select2("val", '');
			$('#Rate_projectid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/project') ?>/brandid/0').select2("val", '');
			$('#Rate_customercontactid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/contact') ?>/customerid/'+customerid).select2("val", '');
			$('#Rate_warehouseid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/warehouse') ?>/customerid/'+customerid).select2("val", '');
			$('#Rate_designagencyid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/design') ?>/customerid/'+customerid).select2("val", '');
		});

		$('#Rate_brandid').change( function(){
			var brandid = $(this).val();
			$('#Rate_projectid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/project') ?>/brandid/'+brandid).select2("val", '');
		});

		$('#Rate_expiration').datepicker({
			dateFormat : 'yy-mm-dd'
			
		});

		$("#extraitemsnumber").change( function(){
			$("#itembody").html('');
			
			var customerid = $('#Rate_customerid').val();
			if(customerid!=''){
				var nl = $("#extraitemsnumber").val();
				var opt = '<?php foreach($servicelist as $group => $items){?><optgroup label="<?php echo $group; ?>"><?php foreach($items as $id=> $item){?><option value="<?php echo $id; ?>"><?php echo $item; ?></option><?php } ?></optgroup><?php } ?>';
				
				for(x=1;x<=nl;x++){
					
				    $("#itembody").append('<tr><th style="width:10%;">Item</th><td style="width:40%;"><select style="width:100%;" class="select2 itemextrai" rel="'+x+'" name="ei['+x+']" id="ei_'+x+'"></select></td><th style="width:10%;">Comprador</th><td style="width:40%;"><select style="width:100%;" class="select2 itemextrac" name="cei['+x+']" id="cei_'+x+'" ></select></td></tr>');
				    $("#ei_"+x).append(opt).select2();
				    $("#cei_"+x).select2();
				    
				    $("#ei_"+x).change( function(){
					    var entryid = $(this).val();
					    var numberrow = $(this).attr('rel')
				    	$.get( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/userservice') ?>/customerid/'+customerid+'/entryid/'+entryid , function(data){
							$('#cei_'+numberrow).html(data).select2("val", '');
						}, 'html');
					});
				}
			
			} else {
				alert('Selecccione Cliente');
				$("#extraitemsnumber").select2("val", '0');
			}
		});

		$("#sendproject").click( function(){
			var brandid = $("#Rate_brandid").val();
			if(brandid!=''){
		        var projectdsc = $("#NTproject").val();
				$.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/addproject') ?>',{brandid:brandid, projectdsc:projectdsc}, function(response){
					$('#Rate_projectid').load( '<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/project') ?>/brandid/'+brandid).select2("val", response);	
					$('#newproject').modal('hide');
			    });
			} else {
				alert('Selecciona una Marca para poder agregar un Proyecto.');
				$('#newproject').modal('hide');
			}
		});
		
	});

	function runFormValidation() {
		

		var $checkoutForm = $('#rate-form').validate({
			 submitHandler: function(form) {
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
					if((itms<citems || bys<citems) && citems!=0){
						$("#step0error").show();
						return false;
					} else {
						 form.submit();
					}
			},
			rules : {
				Rate_customerid : {	required : true },
				Rate_legalentityid : {	required : true },
				Rate_customercontactid : {	required : true },
				Rate_brandid : {	required : true },
				Rate_projectid : {	required : true },				
				Rate_ratetype : {	required : true },
				Rate_expiration : {	required : true },
				Rate_iva : {	required : true },
				Rate_duration : {	required : true }
			},
	
			// Messages for form validation
			messages : {
				Rate_customerid : {	required : 'El campo Cliente es obligatorio por favor seleccione' },
				Rate_legalentityid : {	required : 'El campo Razón Social es obligatorio por favor seleccione' },
				Rate_customercontactid : {	required : 'El campo Contacto Comercial es obligatorio por favor seleccione' },
				Rate_brandid : {	required : 'El campo Marca es obligatorio por favor seleccione' },
				Rate_projectid : {	required : 'El campo Projecto es obligatorio por favor seleccione' },
				Rate_ratetype : {	required : 'El campo Tipo de Cotización es obligatorio por favor seleccione' },
				Rate_expiration : {	required : 'El campo Fecha de Entrega es obligatorio por favor seleccione' },
				Rate_iva : {	required : 'El campo IVA es obligatorio por favor seleccione' },
				Rate_duration : {	required : 'El campo Duración es obligatorio por favor seleccione' }
			},
	
			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	}
</script>
