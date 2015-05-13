<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-th-large "></i></span><h2> </h2>
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
							<form novalidate="novalidate" class="smart-form" >
							<fieldset style="background-color: #FAFAFA;">
							<div class="row">								
								<section class="col col-3">
                                                                     <?php if($add==1){ ?><div class="btn-group btn-group-sm">
									<a href="#newproject" id="btnag" class="btn btn-success" data-target="#newproject"  data-toggle="modal">Nueva Entidad</a>
                                                                    </div>
                                                                    <?php } ?> 
							     </section>
							     <section class="col col-4">
                                                                  <select id="customerlegalentity_customerlegalentityid" name="brand_brandid" class="select2">
										<option value="0">Todos los clientes</option>
										<?php foreach($customerlist as $customerid => $list){?>
										<option value="<?php echo $customerid ?>" <?php if($customerid==$customer) echo "selected='selected'" ?> ><?php echo $list; ?> </option>
										<?php } ?>
                                                                    </select>	
								</section>
								<section class="col col-5">
                                                                    
                                                                </section>
							</div>
							</fieldset>
							</form>
						</div>
						<br><br>
						<table id="customerlegalentity_list_table" class="table table-striped " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Entidad Legal ID</th>
                                                                        <th>Cliente</th>
                                                                        <th>Entidad Legal</th>
									<th>RFC</th>
                                                                        <th>Calle</th>
									<th>Numero</th>
									<th>Colonia</th>
                                                                        <th>C.P.</th>
									<th>Ciudad</th>
                                                                         <?php if($del==1){?><th style="width:5%;">Borrar</th><?php } ?>
								</tr>
							</thead>
							<tbody>
                                                           <?php foreach($model as $valor){ ?>
                                                               
                                                               <tr >
                                                                   <td><?php echo $valor->customerlegalentityid; ?></td>
                                                                   <td><?php echo $valor->customerdsc; ?></td>
                                                                   <td id="<?php echo $valor->customerlegalentityid ?>_legalentity_dsc" <?php if($edt==1){ ?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customerlegalentity/updatelegalentity') ?>" ondblclick="jq_edit_t(this.id)"<?php } ?> ><?php echo $valor->legalentity ?> </td>
                                                                   <td id="<?php echo $valor->customerlegalentityid ?>_rfc_rfc" <?php if($edt==1){ ?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customerlegalentity/updatelegalentity') ?>"  ondblclick="jq_edit_t(this.id)"<?php } ?> ><?php echo $valor->rfc; ?></td>
                                                                   <td id="<?php echo $valor->customerlegalentityid ?>_street_dsc" <?php if($edt==1){ ?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customerlegalentity/updatelegalentity') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->street; ?></td>
                                                                   <td id="<?php echo $valor->customerlegalentityid ?>_number_enu" <?php if($edt==1){ ?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customerlegalentity/updatelegalentity') ?>"  ondblclick="jq_edit_t(this.id)"<?php } ?> ><?php echo $valor->number; ?></td>
                                                                   <td id="<?php echo $valor->customerlegalentityid ?>_neighborhood_dsc" <?php if($edt==1){ ?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customerlegalentity/updatelegalentity') ?>"  ondblclick="jq_edit_t(this.id)"<?php } ?> ><?php echo $valor->neighborhood; ?></td>
                                                                   <td id="<?php echo $valor->customerlegalentityid ?>_zipcode_cp" <?php if($edt==1){ ?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customerlegalentity/updatelegalentity') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->zipcode; ?></td>
                                                                   <td><?php echo $valor->citydsc; ?></td>
                                                                   <?php if($del==1){?><td style="text-align:center;"><div id="divbtndelet_<?php echo Yii::app()->user->userid; ?>"><a  class="btn btn-danger" id="divbtndelet_<?php echo Yii::app()->user->userid; ?>_<?php echo $valor->customerlegalentityid ?>" onclick="delet_legalentity(this.id)" ><i class="glyphicon glyphicon-remove"></i></a></td> <?php } ?>
                                                               </tr>
                                                               
                                                          <?php } ?>
							</tbody>

						</table>


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
        <h4 class="modal-title">Agregar Nueva Razon Social</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="#" id="nproyectlegal" novalidate="novalidate" class="smart-form">	
        <fieldset>
			<table class="table table-bordered">
			<tbody>
					
					<tr>
					<td ><label for="NTproject">Entidad Legal</label></td>
                                        <td  id="NT_legalentitytd">
					<input type="text" id="NT_legalentity_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td ><label for="NTproject">RFC </label></td>
                                        <td id="NT_rfctd">
					<input type="text" id="NT_rfc_rfc" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Calle </label></td><td id="NT_streettd">
					<input type="text" id="NT_street_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Numero </label></td><td id="NT_numbertd">
					<input type="text" id="NT_number_enu" />
					</td>
                                        </tr>
					<tr>
					<td><label for="NTproject">Colonia </label></td><td id="NT_neighborhoodtd">
					<input type="text" id="NT_neighborhood_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">C.P. </label></td><td id="NT_zipcodetd">
					<input type="text" id="NT_zipcode_enu" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Cliente </label></td><td id="NT_customer_legal">
					<!--<input type="text" id="NTcliente" />-->
                                            <select id="customer_legal" name="new_select" class="select2" >
                                             <option value="0">Seleccione un Cliente</option>
                                             <?php foreach($customerlist as $customerid => $list){?>
                                             <option value="<?php echo $customerid ?>" <?php if($customerid==$customer) echo "selected='selected'" ?> ><?php echo $list; ?> </option>
                                             <?php } ?>
                                            </select>
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Pais </label></td><td>
					<!--<input type="text" id="NTcliente" />-->
                                        <select id="country_customerlegal" name="new_select" class="select2" data-live-search="true">
                                            <option value="0">Seleccione un Pais</option>
                                            <?php foreach($countrylist as $list){?>
                                            <option value="<?php echo $list->countryid ?>" ><?php echo $list->countrydsc; ?> </option>
                                            <?php } ?>
                                        </select>
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Estado </label></td><td>
					<!--<input type="text" id="NTcliente" />-->
                                        <select id="state_customerlegal" name="new_select" class="select2">
                                            <option value="0">Seleccione un Estado</option>
                                              
                                        </select>
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Ciudad </label></td><td id="NT_city_customerlegal">
					<!--<input type="text" id="NTcliente" />-->
                                            <select id="city_customerlegal" name="new_select" class="select2" >
                                            <option class="nodif" value="0">Seleccione una Ciudad</option>
                                            
                                        </select>
					</td>
                                        </tr>
				</tbody>
			</table>
		</fieldset>
        <footer>
            <button class="btn btn-primary" class="btn btn-default" id="sendproject" type="button" ata-dismiss="modal">Aceptar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new">Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-'dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	pageSetUp();
      $("header").find("h2").html("Razones Sociales");
	var oTable;
        $("#customerlegalentity_list_table").find("td").css("cursor","pointer");
             
           $("#sendproject").click( function(){
			var valid=0;
                        var bandera=0;
                        var bandera1=0;
                        var bandera2=0;
                        var valueToPush=" ";
                        var integrador= { }; 
                        $("#nproyectlegal").find('input').each(function() {
                              var elemento= this;
                              var div=elemento.id.split('_');
                              if(div[0]=='NT'){
                                    valid=valid_expresion_form(elemento.id);
                                    if(valid==1){
                                       bandera=1;
                                    }else{
                                       integrador[div[1]]=elemento.value;
                                    }
                               }else{ 
                                   if(div[0]=='T1'){
                                       if(valueToPush==" "){
                                           valueToPush= elemento.value;
                                       }else{
                                           valueToPush+=" a "+elemento.value;
                                           integrador[div[1]]=valueToPush;
                                       }
                                     }else if(div[0]=='T2'){
                                            
                                            
                                     }
                               } 
                           });
                           
                          if($("#customer_legal").val()!=0){
                              $("#NT_customer_legal").find(".error").remove();
                               integrador['customerid']=$("#customer_legal").val();
                               bandera1=0;
                          }else{
                              $("#NT_customer_legal").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar un cliente</label>').appendTo("#NT_customer_legal");
                          }  
                          
                          if($("#city_customerlegal").val()!=0){
                              $("#NT_city_customerlegal").find(".error").remove();
                               integrador['cityid']=$("#city_customerlegal").val();
                               bandera2=0;
                          }else{
                              $("#NT_city_customerlegal").find(".error").remove();
                               bandera2=1;
                                $('<label class="error" generated="true">Debe seleccionar una ciudad</label>').appendTo("#NT_city_customerlegal");
                          }  
                            
			 if(bandera==0&&bandera1==0&&bandera2==0){
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/customerlegalentity/createlegalentity') ?>',{'arrai':integrador}, function(response){
						
                                                if(response==0){
                                                    alert('El nombre y rfc que esta tratando de insertar ya existen en este cliente.');
                                                }else{
                                                
                                                   alert('Se a realizado la insercion correctamente.');
                                                     $('#nproyectlegal').modal('hide');
                                                    location.reload();
                                                    
                                                }   
                                                
                                                
			    });
			}else{
				alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
				
			}
				
			
		});
                
                
              
               //relistar los datos de la tabla de manera que solo muestre la seleccion del filtro de clientes
            $('#customerlegalentity_customerlegalentityid').change( function(){
        	 var customerid = $(this).val();
        	 window.location = '?r=portoprint/default#index.php?r=portoprint/customerlegalentity/index/customer/'+customerid;
            
                });
                
              // evento par alimpiar la lista de estados y ciudades y desabilitar el los selects    
              $("#btnag").click(function(){
                  
                    
                    $("#state_customerlegal").find(".smod").remove();
                    $("#city_customerlegal").find(".smod").remove();
                    $("#state_customerlegal").attr('disabled', true);
                    $("#city_customerlegal").attr('disabled', true);
                    
                });   
              
              //evento onchage cuando se selecciona un pais, se obtiene la lista de estados 
            $('#country_customerlegal').change( function(){
        	 var countryid = $(this).val();
                 $("#state_customerlegal").val(["0"]).trigger("change");
                 $("#city_customerlegal").val(["0"]).trigger("change");
                  $("#city_customerlegal").attr('disabled');
                 $("#state_customerlegal").find(".smod").remove();
                 
                 
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/countrystate') ?>',{countryid:countryid }, function(response){
						
						$(response).appendTo("#state_customerlegal");
                                                $("#state_customerlegal").attr('disabled', false);
			    });
            
                });
             //evento onchage cuando se selecciona un estado, se obtiene la lista de ciudades
             $('#state_customerlegal').change( function(){
        	 var stateid = $(this).val();
                 $("#city_customerlegal").find(".smod").remove();
                 $("#city_customerlegal").val(["0"]).trigger("change");
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/statecity') ?>',{stateid:stateid }, function(response){
						
						$(response).appendTo("#city_customerlegal");
                                                $("#city_customerlegal").attr('disabled', false);
			    });
                            
                });
        
                

            oTable = $('#customerlegalentity_list_table').dataTable({
			
		
                         "responsive": true,
                         "bLengthChange":false
			
		});
                
                function delet_legalentity(id){
                
                    var sepa=id.split('_');
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/customerlegalentity/deltelegalentity') ?>',{'userid':sepa[1],'customerlegalentityid':sepa[2]}, function(response){
                                       
                                        if(response!=0){
                                             alert('Se ha borrado correctamente.');
                                              location.reload();
                                        }  
                                                   


                                 });
                    
                
                }
               

</script>