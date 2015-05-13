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

function extend(id, confirmed){
	if(confirmed)
		window.location = "<?php echo Yii::app()->createAbsoluteUrl('/portoprint/rate/extend') ?>/id/"+id;
}

function finalize(id, n){
		var rs = $('#rateprice-'+n+'-form input[name="selectedsupplier"]:checked').val();
		var qx = $('#rateprice-'+n+'-form input[name="quantity_selected"]:checked').val();
		if(rs && qx){
			window.location = "?r=portoprint/rate/finalize/id/"+id+"/rs/"+rs+"/qx/"+qx;
		}else 
			alert("Para poder liberar debes seleccionar primero cantidad a cotizar y proveedor.");
}

function completetopdf(id, n){
	var qx = $('#rateprice-'+n+'-form input[name="quantity_selected"]:checked').val();
	if(qx){
		window.location = "?r=portoprint/rate/completetopdf/id/"+id;
	}else 
		alert("Para agregar a PDF debes seleccionar primero cantidad a cotizar.");
}
function removetopdf(id, n){
	window.location = "?r=portoprint/rate/removetopdf/id/"+id;
}

function calculatesavepp(cnn, rateid, formula){
	var acum = 0;
	var cont = 0;
	var prom = 0;
	var min = 0;
	var pp = 0;
	var save = 0;
	$('#ratecalculatetable_'+rateid+' [id^="quantity_'+cnn+'_"]').each( function(){
		var supp = $(this).attr('title');
		if($('#ratecalculatetable_'+rateid+' #show_'+supp).attr('checked')){
				var val= Number($(this).val());
				 if(cont==0)
					 min = val;
				 
				 if(val < min)
					 min = val;
				 
				 acum += val;
				 cont++;
		} 
	});
	prom = acum / cont;	
	pp = min + ((prom - min) * 0.50);
	save = prom - pp;
	
	$('#ratecalculatetable_'+rateid+'  #'+rateid+'_pp_'+cnn).html(addCommas(redondeo2decimales(pp)));	
	$('#ratecalculatetable_'+rateid+'  #'+rateid+'_save_'+cnn).html(addCommas(redondeo2decimales(save)));
}


function calculatesave(cnn, rateid, formula){
	var acum = 0;
	var cont = 0;
	var prom = 0;
	var min = 0;
	var pp = 0;
	var save = 0;
	var smin = null;

	$('#ratecalculatetable_'+rateid+' [id^="calculate_'+cnn+'_"]').each( function(){
		var supp = $(this).attr('title');
		$('#ratecalculatetable_'+rateid+' #c_'+cnn+'_'+supp).removeClass('notcalculate');
		$('#ratecalculatetable_'+rateid+' #c_'+cnn+'_'+supp).removeClass('minorprice');
		
		if($('#ratecalculatetable_'+rateid+' #show_'+supp).is(':checked')){
			
			var val= Number($(this).val());
			
			 if(cont==0 ){
				 min = val;
				 smin = supp;
			 }
			 if(val< min){
				 min = val;
				 if(val>0)
				 	smin = supp;
			 }
			 acum += val;
			 cont++;
		} else{
			$('#ratecalculatetable_'+rateid+' #c_'+cnn+'_'+supp).addClass('notcalculate');
			
		}
	});
	prom = acum / cont;
	eval(formula);

	
	
	$('#ratecalculatetable_'+rateid+' #ppp_'+cnn+'_'+rateid).val(redondeo2decimales(pp));	
	$('#ratecalculatetable_'+rateid+' #'+rateid+'_cpp_'+cnn).html(addCommas(redondeo2decimales(pp)));	
	
	$('#ratecalculatetable_'+rateid+' #'+rateid+'_csave_'+cnn).html(addCommas(redondeo2decimales(save)));
	$('#ratecalculatetable_'+rateid+' #c_'+cnn+'_'+smin).addClass('minorprice');
	
}

$(document).ready( function(){
   $("#ml3").addClass('active');
	
	$('.ratepop').popover({"trigger":"hover", "html" : true, "container":"body"});
	
	$('#Rate_userid').select2();
	$('#Rate_serviceid').select2().change( function(){
		 var entryid = $(this).val();
	     $.get( 'index.php?r=portoprint/combos/userservice/customerid/<?php echo $customerid ?>/entryid/'+entryid , function(data){
				$('#Rate_userid').html(data).select2();
		 }, 'html');
	});
	
	$("#generaPDF").click( function(){
		var datapdf = '';
		$("input[name='id_pdf[]']:checked").each(function(a,b){
		    datapdf += 'id_pdf[]/'+$(b).val()+'/';
		});
		window.location = '<?php echo Yii::app()->createAbsoluteUrl('/portoprint/pdf/rate',array('id'=>Utils::encrypt($bundleid, 'rate'))); ?>/'+datapdf
	});
	
});
</script>


		<div class="jarviswidget  jarviswidget-sortable" id="wid-id-all" data-widget-fullscreenbutton="true" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2><strong>Detalle en cotización</strong> </h2>				
					<div class="widget-toolbar">
						
						<div class="btn-group">
							<a href="javascript:void(0);" class="btn btn btn-success" data-target="#newitem"  data-toggle="modal"><i class="fa fa-cog"></i> Agregar Nuevo Item</a>
							
						</div>
					</div>
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
						<div class="widget-body-toolbar">
							<div class="row">
								<div class="col-md-5"><strong>ID Cotización:</strong> <?php echo $bundleid; ?></div>
								<div class="col-md-5"><strong>Cliente:</strong> <?php echo $customer; ?></div>
								<div class="col-md-2"></div>
							</div>
							<div class="row">
		
								<div class="col-md-5"><strong>Marca:</strong> <?php echo $brand; ?></div>
								<div class="col-md-5"><strong>Proyecto:</strong> <?php echo $project; ?></div>
								<div class="col-md-2"></div>
							</div>
							<div class="row">
								
								<div class="col-md-12">&nbsp;</div>
							</div>
								<div class="row">
									<div class="col-md-8">
									<?php 
								foreach($model as  $row){
									echo "<fieldset><br /><br />";
									$rate = $row['rate'];
									if($rate->statusid!=35){
										if($rate->statusid==99)
											$view = 'price/porcompletar' ;
										else if($rate->statusid==1)
											$view = 'price/sinenviar' ;
										else if(in_array($rate->statusid, array(2,3,4)))
											$view = 'price/open' ;
										else if($rate->statusid==101)
											$view = 'price/requote' ;
										else if($rate->statusid==5)
											$view = 'price/close' ;
										$this->renderPartial($view, array(
												'model'=>$rate,'ratesuppliers'=>$row['ratesuppliers'], 'entry'=>$row['entrydsc'], 'entryid'=>$row['entryid'], 'manualratesupplier'=>$manualratesupplier
											));
									}				
									echo "</fieldset>";
								}
								?>
									</div>
									<div class="col-md-4">
										<div class="modal-dialog demo-modal">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Resumen del Proyecto</h4>
												</div>
												<div class="modal-body">							
													<?php 
													foreach($ratescompleted as $entry => $services){ ?>
													<table class="table table-bordered" style="font-size: 10px;">
														<thead>
															<tr><td colspan="4"><?php echo $entry; ?></td></tr>
															<tr>
																<th style="width:70%">ITEM</th>
																<th style="width:15%">Cantidad</th>
																<th style="width:15%">Precio</th>
															</tr>
														</thead>
														<tbody>
															<?php 
															  foreach($services as $service => $qx){
															  	foreach($qx as $items => $row){	
		
															  	  if($row[1]>0 )
															  	  	echo "<tr><td style='padding:2px;'>".$service."</td><td style='text-align:center;padding:2px;'>".$row[0]."</td><td style='text-align:center;padding:2px;'>".$row[1]."</td></tr>";	
															  	  else
															  	    echo "<tr style='color:#FF0000;'><td style='padding:2px;'>".$service."</td><td style='text-align:center;padding:2px;'>".$row[0]."</td><td style='text-align:center;padding:2px;'>".$row[1]."</td></tr>";
															  	}												  	
															  }
															?>
														</tbody>
													</table>
													<?php  } ?>
												</div>
												<div class="modal-footer">
													<a class="btn btn-primary" href="?r=portoprint/pdf/bundle/id/<? echo Utils::encrypt($bundleid, 'rate'); ?>">
														Descargar PDF
													</a>
												</div>
											</div><!-- /.modal-content -->
										</div>								
									</div>
								</div>

						</div>
					</div>
				</div>
			</div>
						

	<div class="modal fade" id="newitem" tabindex="-1" role="dialog" aria-labelledby="newitem" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Agregar Nuevo Item</h4>
	      </div>
	      <div class="modal-body no-padding">
	      	<form method="post" action="?r=portoprint/rate/additem/id/<? echo Utils::encrypt($bundleid, 'rate'); ?>" id="<? echo 'extend-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">	
	        <fieldset>
				<table class="table table-bordered">
				<tbody>
						<tr><td colspan="2">
							<div>
								<strong>Cliente:</strong> <?php echo $customer; ?><br />
								<strong>Marca:</strong> <?php echo $brand; ?><br />
								<strong>Proyecto:</strong> <?php echo $project; ?>
							</div>
						</td></tr>
						<tr><td><label for="Rate_serviceid">ITEM </label></td><td>
						<select id="Rate_serviceid" name="Rate[serviceid]" class="select2" style="width: 350px;" >
							<?php foreach($servicelist as $group => $items){?>
								<optgroup label="<?php echo $group; ?>">
									<?php foreach($items as $id=> $item){?>
										<option value="<?php echo $id; ?>"><?php echo $item; ?></option>
									<?php } ?>
								</optgroup>
							<?php } ?>
							</select>
						</td></tr>
						<tr><td>
							<label for="Rate_userid">Comprador </label>
							</td><td>
							<select id="Rate_userid" name="Rate[userid]" class="select2" style="width: 350px;" data-placeholder="Selecione"></select>
						</td></tr>
					</tbody>
				</table>
			</fieldset>
	        <footer>
		      	<button class="btn btn-primary" type="submit">Aceptar</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
		     </footer>
		     </form>
	      </div>
	      
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->



