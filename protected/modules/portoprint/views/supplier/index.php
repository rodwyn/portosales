<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Proveedores </h2>
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
						    <?php if($add==1){ ?><div class="widget-body-toolbar">
                                                        <a class="btn btn-success btn-ms" data-toggle="modal" id="addSupplier" data-target="#newsupplier" href="#newsupplier" onclick="limpiar_modal()">Nuevo Proveedor</a>
						</div>
						  <?php } ?> 
						<table id="ratelist_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th style="width:10%;">Proveedor ID</th>
									<th style="width:25%;">Proveedor</th>
									<th style="width:35%;">Servicios</th>
									<th style="width:25%;">Asignar</th>
                                                                        <th style="width:15%; text-align: center;" >Bloquear</th>
                                                                     
								</tr>
							</thead>
                            <tbody>
    							<?php 
    								foreach ($supplierdata as  $value) {
                                        $supplierservices = "";
                                        foreach ($value['services'] as $v) {
                                            $supplierservices .= ($v["asigned"])? '<span id="ss_'.$value['supplierid'].'_'.$v['asigned'].'">'.$v['dsc'].' |</span> ': '';
                                        }
                                        if($value['block']==0){
                                            $checked="background-color: #FA5858;";
                                        }else{
                                            $checked="";
                                        }
                                        $editar='';
                                        if($edt==1){ $editar="data-url=".Yii::app()->createAbsoluteUrl('portoprint/supplier/editsupplier')." ondblclick=\"jq_edit_t(this.id)\" "; }
                                        echo "<tr >
                                        <td style='".$checked." ' >".$value['supplierid']."</td>
                                        <td style='".$checked." cursor:pointer;' id=\"".$value['supplierid']."_corporatename_dsc\" class='edt_usu' ><div style='float:left;' id='".$value['supplierid']."_supplierid' class data-target='#newsupplier'  data-toggle='modal' >".$value['corporatename']."</td>
                                        <td style='".$checked."' class=\"edit_supplierservice\"><p class=\"supplierservices_".$value['supplierid']."\" >".$supplierservices."</p></td>
                                        <td style='text-align: center; ".$checked."'><a data-id=\"".$value['supplierid']."\" data-namesupplier=\"".$value['corporatename']."\" class=\"newsupplierservice btn btn-primary btn-ms\" data-toggle=\"modal\" data-nameSupplier=\"".$value['corporatename']."\" data-target=\"#newsupplierservice\" href=\"#newsupplierservice\" >Asignar Servicios</a></td>
                                        <td style='text-align: center; ".$checked."'><div id='divbtndelet_".$value['supplierid']."'><a  class='btn btn-danger' id='divbtndelet_".$value['supplierid']."_".$value['block']."' onclick='bloq_supplier(this.id)'  ><i class='glyphicon glyphicon-ban-circle'></i></a></td>
                                        </tr>";
    								}
    							 ?>                                
                            </tbody>

						</table>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->

	</div>

	<!-- end row -->

</section>

<div class="modal fade" id="newsupplierservice" tabindex="-1" role="dialog" aria-labelledby="newsupplierservice" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Asignar Servicios a <span id="ssname"></span></h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="#" id="nservice" novalidate="novalidate" class="smart-form">	
            <fieldset>
                 <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><label for="categolist">Categoria</label> </td>
                            <td id="NT_categotd"> <select id="catego_list" name="catego_list" style="width: 170px;"  >
                                    <option value="">Seleccione un Categoria</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label for="servicelist">Seleccione Servicios</label> </td>
                            <td id="NT_servicelistd"><select id="serviceid_list" name="serviceid_list"  class="select2 select2-multiple" multiple="multiple" style="width: 250px; overflow-y: scroll; height: 250px" onchange="select_id_service()" >
                                 
                                </select></td>
                        </tr>
                    </tbody>
                 </table>
                
            </fieldset>
        <footer>
	      	
            <button data-dismiss="modal" class="btn btn-default" onclick="location.reload();" type="button">Cerrar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="newsupplier" tabindex="-1" role="dialog" aria-labelledby="newsupplier" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Nuevo Proveedor</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" id="nsupplier" class="smart-form">	
            <fieldset>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><label for="corporatename">Proveedor *</label> </td>
                            <td id="NT_corporatenametd"><input type="text" name="NT_corporatename_dsc" id="NT_corporatename_dsc"></td>
                        </tr>
                        <tr>
                            <td><label for="spplierdsc">Descripción *</label></td>
                            <td id="NT_supplierdsctd"><input type="text" name="NT_supplierdsc_dsc" id="NT_supplierdsc_dsc"></td>
                        </tr>
                        <tr>
                            <td><label for="contactname">Nombre de contacto *</label></td>
                            <td id="NT_contactnametd"><input type="text" name="NT_contactname_dsc" id="NT_contactname_dsc"></td>
                        </tr>
                        <tr>
                            <td><label for="website">Sitio web *</label></td>
                            <td id="NT_websitetd"><input type="text" name="NT_website_dsc" id="NT_website_dsc"></td>
                        </tr>
                        <tr>
                            <td><label for="phone">Telefono *</label></td>
                            <td id="NT_phonetd"><input type="text" name="NT_phone_enu" id="NT_phone_enu"></input></td>
                        </tr>
                        <tr>
                            <td><label for="email">E mail *</label></td>
                            <td id="NT_emailtd"><input type="text" name="NT_email_ema" id="NT_email_ema"></td>
                        </tr>
                        <tr>
                            <td><label for="email2">E mail 2</label></td>
                            <td id="ES_email2td"><input type="text" name="ES_email2_ema" id="ES_email2_ema"></td>
                        </tr>
                        <tr>
                            <td><label for="email3">E mail 3</label></td>
                            <td id="ES_email3td"><input type="text" name="ES_email3_ema" id="ES_email3_ema"></td>
                        </tr> 
                        <tr>
                            <td><label for="rfc">R.F.C *</label></td>
                            <td id="NT_rfctd"><input type="text" name="NT_rfc_rfc" id="NT_rfc_rfc"></td>
                        </tr>
                        <tr>
                            <td><label for="address">Dirección *</label></td>
                            <td id="NT_addresstd"><input type="text" name="NT_address_dsc" id="NT_address_dsc"></td>
                        </tr>
                        <tr>
                            <td><label for="suburb">Colonia</label></td>
                            <td id="ES_suburbtd"><input type="text" name="ES_suburb_dsc" id="ES_suburb_dsc"></td>
                        </tr>
                        <tr>
                            <td><label for="temp_country">Pais *</label></td>
                            <td id="SEL_country">
                                <select id="temp_country" name="temp_country" class="select2">
                                    <option value="-1">Seleccione un Pais</option>
                                    <?php foreach($listcountry as $list){?>
                                    <option value="<?php echo $list->countryid ?>" ><?php echo $list->countrydsc; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="temp_state">Estado *</label></td>
                            <td id="SEL_state">
                                <select id="temp_state" name="temp_state" >
                                    <option value="">Seleccione un Estado</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="cityid">Ciudad *</label></td>
                            <td id="SEL_cityidtd">
                                <select id="cityid" name="cityid" >
                                    <option value="">Seleccione una Ciudad</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="paymentterms">Tiempo de pago *</label></td>
                            <td><input type="text" name="NT_paymentterms_enu" id="NT_paymentterms_enu"></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        <footer>
                <button class="btn btn-primary" class="btn btn-default" id="sendnewsupplier" type="button" ata-dismiss="modal">Aceptar</button>
                <button class="btn btn-primary" class="btn btn-default" id="sendnewsupplier1" type="button" ata-dismiss="modal">Aceptar</button>
		<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- end widget grid -->
<script type="text/javascript">

	$(function(){
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		var oTable;
		pageSetUp();

		// PAGE RELATED SCRIPT
		
                $("#sendnewsupplier").click( function(){
			var valid=0;
                        var bandera=0;
                        var bandera1=0;
                        var bandera2=0;
                        var valueToPush=" ";
                        var integrador= { }; 
                        $("#nsupplier").find('input').each(function() {
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
                                   if(div[0]=='ES'){
                                  
                                       integrador[div[1]]=elemento.value;
                                    
                                    }
                               }
                           });
                           
                          if($("#nsupplier").find("#cityid").val()!=0){
                              $("#SEL_cityidtd").find(".error").remove();
                               integrador['cityid']=$("#cityid").val();
                               bandera1=0;
                          }else{
                              $("#SEL_cityidtd").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar una ciudad</label>').appendTo("#SEL_cityidtd");
                          }  
                          
                          if($("#nsupplier").find("#temp_country").val()!=0){
                              $("#SEL_country").find(".error").remove();
                               integrador['contryid']=$("#temp_country").val();
                               bandera1=0;
                          }else{
                              $("#SEL_country").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar una Pais</label>').appendTo("#SEL_country");
                          }  
                          
                          if($("#nsupplier").find("#temp_state").val()!=0){
                              $("#SEL_state").find(".error").remove();
                               integrador['stateid']=$("#temp_state").val();
                               bandera1=0;
                          }else{
                              $("#SEL_state").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar una Estado</label>').appendTo("#SEL_state");
                          }  
                          
                          
                              integrador['companyid']= "<?php echo Yii::app()->user->companyid;?>";
                              integrador['active']=1;
                              
			 if(bandera==0&&bandera1==0){
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/supplier/createsupplier') ?>',{'arrai':integrador}, function(response){
						
                                                if(response==0){
                                                    alert('Los datos de nuevo proveedor ya existen.');
                                                }else{
                                                
                                                   alert('Se a realizado la insercion correctamente.');
                                                     $('#newsupplier').modal('hide');
                                                    location.reload();
                                                    
                                                }   
                                                
                                                
			    });
			}else{
				alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
				
			}
				
			
		});
                
                
     
                
                
                 $("#sendnewsupplier1").click( function(){
			var valid=0;
                        var bandera=0;
                        var bandera1=0;
                        var bandera2=0;
                        var valueToPush=" ";
                        var integrador= { }; 
                        $("#nsupplier").find('input').each(function() {
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
                                   if(div[0]=='ES'){
                                  
                                       integrador[div[1]]=elemento.value;
                                    
                                    }
                               }
                           });
                           
                          if($("#nsupplier").find("#cityid").val()!=0){
                              $("#SEL_cityidtd").find(".error").remove();
                               integrador['cityid']=$("#cityid").val();
                               bandera1=0;
                          }else{
                              $("#SEL_cityidtd").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar una ciudad</label>').appendTo("#SEL_cityidtd");
                          }  
                          
                          if($("#nsupplier").find("#temp_country").val()!=0){
                              $("#SEL_country").find(".error").remove();
                               integrador['contryid']=$("#temp_country").val();
                               bandera1=0;
                          }else{
                              $("#SEL_country").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar una Pais</label>').appendTo("#SEL_country");
                          }  
                          
                          if($("#nsupplier").find("#temp_state").val()!=0){
                              $("#SEL_state").find(".error").remove();
                               integrador['stateid']=$("#temp_state").val();
                               bandera1=0;
                          }else{
                              $("#SEL_state").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar una Estado</label>').appendTo("#SEL_state");
                          }  
                          
                          
                              integrador['companyid']= "<?php echo Yii::app()->user->companyid;?>";
                              integrador['active']=1;
                              
			 if(bandera==0&&bandera1==0){
                             var supplierid=$("#sendnewsupplier1").data("supplierid");
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/supplier/updatesupplier') ?>',{'arrai':integrador, 'supplierid':supplierid }, function(response){
						
                                                if(response==0){
                                                    alert('Los datos de nuevo proveedor ya existen.');
                                                }else{
                                                
                                                   alert('Se a realizado la actualizacion correctamente.');
                                                     $('#newsupplier').modal('hide');
                                                    location.reload();
                                                    
                                                }   
                                                
                                                
			    });
			}else{
				alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
				
			}
				
			
		});
                
                

        $('#temp_country').change( function(){
            var countryid = $(this).val();
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/countrystate') ?>',{countryid:countryid }, function(response){
                
                $("#temp_state").html(response);
                $("#temp_state").select2()
                
                //evento onchage cuando se selecciona un estado, se obtiene la lista de ciudades
                .change( function(){
                    
                     var stateid = $(this).val();
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/statecity') ?>',{stateid:stateid }, function(response){
                        
                        $("#cityid").html(response);
                        $("#cityid").select2();
                    });
        
                });
            })
        
        });
        
        $('.edit_supplierservice').css({'cursor':'pointer'}).on('dblclick',function(){
            $(this).next().find('a').trigger('click');
            return false;
        });
        
        $('.newsupplierservice').on("click",function(){//asignas el evento al boton para hacer la peticion y llenar los fatos
            supplierid = $(this).data("id"); //Obtenemos el id del supplier
             
            $("#serviceid_list").val(null).trigger("change");
            var nameSupplier = $(this).data('namesupplier');
            $("#ssname").html(nameSupplier);
             $("#ssname").attr('data-supplierid',supplierid);
             $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/servicecatego') ?>',{ }, function(response){

                   $("#catego_list").html(response);
                   $("#catego_list").select2()
                     .change( function(){

                       var serviceid = $("#catego_list").val();
                        
                       $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/servicecategoservi') ?>',{serviceid:serviceid }, function(response){

                           $("#serviceid_list").html(response);
                           $("#serviceid_list").select2({
                                 placeholder: "Seleccionar servicio"
                           });
                           $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/supplier/serviceselect') ?>',{supplierid:supplierid }, function(response){
                                if(response!='-1'){
                                 var div=response.split(',');
                                 
                                 $("#serviceid_list").val(div).trigger("change");
                                }
                            });
                        });
        
                     });
                });
            
        });

         
        oTable = $('#ratelist_table').DataTable({
               
                  "order": [ 0, 'desc' ],
                  "bLengthChange":false,
                  "dom":'ftp'<?php if ($edt == 1) { ?>,
                "fnInitComplete": function(oSettings) {
               
                $('tbody .edt_usu').hover(function(){
                    if ($(this).find('span.glyphicon').length > 0 || $(this).find('input').length > 0){
                        return false
                    } else{

                            $(this).html('<span class="glyphicon glyphicon-pencil" style="float:left;">&nbsp;</span>' + $(this).html());
                            var supplier = $(this).find('div').attr("id");
                            $("#" + supplier).click(function(){
                                    $("#sendnewsupplier1").show();
                                    $("#sendnewsupplier").hide();
                                    var id = supplier.split('_');
                                    $("#sendnewsupplier1").attr('data-supplierid',id[0]);
                                    
                                        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/supplier/supplieredit'); ?>', {supplierid:id[0] }, function(response){
                                              var cadena = response.split(','); 
                                                $("#nsupplier").find('input').each(function() {
                                                    var elemento = this;
                                                    var div = elemento.id.split('_');
                                                    if (div[0] == 'NT' || div[0] == 'ES'){
                                                        for (i = 0; i < cadena.length; i++){
                                                            var separa = cadena[i].split('-');
                                                            if (separa[0] == div[1]){
                                                                    $("#nsupplier").find("#" + elemento.id).val(separa[1]);
                                                            }

                                                        }

                                                    }
                                                });
                                               
                                                for (i = 0; i < cadena.length; i++){
                                                       var separa = cadena[i].split('-');
                                                        if(separa[0] == 'contryid'){
                                                            var countryid = separa[1];
                                                           
                                                            $("#temp_country").select2('val',separa[1]);
                                                           
                                                        }
                                                        
                                                    }
                                                    
                                                    for (i = 0; i < cadena.length; i++){
                                                     var separa = cadena[i].split('-');
                                                        if(separa[0] == 'stateid'){
                                                                var stateid = separa[1];
                                                                 var countryid = $("#temp_country").val();
                                                                
                                                                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/countrystate1') ?>',{countryid:countryid, stateid:stateid }, function(response){
                                                                        
                                                                        $("#temp_state").html(response);
                                                                         
                                                                         for (i = 0; i < cadena.length; i++){
                                                                                var separa = cadena[i].split('-');
                                                                                  if(separa[0] == 'cityid'){
                                                                                        var cityid = separa[1];
                                                                                        var stateid = $("#temp_state").val();
                                                                                       $("#nsupplier").find("#temp_state").select2();
                                                                                       
                                                                                               $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/statecity1') ?>',{stateid:stateid, cityid:cityid }, function(response){
                                                                                                     
                                                                                                       $("#nsupplier").find("#cityid").html(response);
                                                                                                       $("#nsupplier").find("#cityid").select2();
                                                                                               });
                                                                                         }

                                                                               }
                                                                         
                                                                  
                                                                    });
                                                                    
                                                            }
                                                        
                                                    }
                                                    
                                                   
                                        });
                                     
                                        //document.href = "#newproject4";
                            });
                }
                }, function(){
                //  $(this).html();

                    $(this).find('span.glyphicon').remove();
                });
                }<?php } ?>
		});

      $('.widget-body').find('input[type=search]').on( 'keyup', function () {
        $('.edt_usu').hover(function(){
            if ($(this).find('span.glyphicon').length > 0 || $(this).find('input').length > 0){

                return false

            } else{

                            $(this).html('<span class="glyphicon glyphicon-pencil" style="float:left;">&nbsp;</span>' + $(this).html());
                            var supplier = $(this).find('div').attr("id");
                            $("#" + supplier).click(function(){
                                    $("#sendnewsupplier1").show();
                                    $("#sendnewsupplier").hide();
                                    var id = supplier.split('_');
                                    $("#sendnewsupplier1").attr('data-supplierid',id[0]);
                                      console.log(supplier);
                                        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/supplier/supplieredit'); ?>', {supplierid:id[0] }, function(response){
                                              var cadena = response.split(','); 
                                                $("#nsupplier").find('input').each(function() {
                                                    var elemento = this;
                                                    var div = elemento.id.split('_');
                                                    if (div[0] == 'NT' || div[0] == 'ES'){
                                                        for (i = 0; i < cadena.length; i++){
                                                            var separa = cadena[i].split('-');
                                                            if (separa[0] == div[1]){
                                                                    $("#nsupplier").find("#" + elemento.id).val(separa[1]);
                                                            }

                                                        }

                                                    }
                                                });
                                               
                                                for (i = 0; i < cadena.length; i++){
                                                       var separa = cadena[i].split('-');
                                                        if(separa[0] == 'contryid'){
                                                            var countryid = separa[1];
                                                             console.log(countryid);
                                                            $("#temp_country").select2('val',separa[1]);
                                                           
                                                        }
                                                        
                                                    }
                                                    
                                                    for (i = 0; i < cadena.length; i++){
                                                     var separa = cadena[i].split('-');
                                                        if(separa[0] == 'stateid'){
                                                                var stateid = separa[1];
                                                                 var countryid = $("#temp_country").val();
                                                                
                                                                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/countrystate1') ?>',{countryid:countryid, stateid:stateid }, function(response){
                                                                        
                                                                        $("#temp_state").html(response);
                                                                         
                                                                         for (i = 0; i < cadena.length; i++){
                                                                                var separa = cadena[i].split('-');
                                                                                  if(separa[0] == 'cityid'){
                                                                                        var cityid = separa[1];
                                                                                        var stateid = $("#temp_state").val();
                                                                                       $("#nsupplier").find("#temp_state").select2();
                                                                                       
                                                                                               $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/statecity1') ?>',{stateid:stateid, cityid:cityid }, function(response){
                                                                                                     
                                                                                                       $("#nsupplier").find("#cityid").html(response);
                                                                                                       $("#nsupplier").find("#cityid").select2();
                                                                                               });
                                                                                         }

                                                                               }
                                                                         
                                                                  
                                                                    });
                                                                    
                                                            }
                                                        
                                                    }
                                                    
                                                   
                                        });
                                     
                                        //document.href = "#newproject4";
                            });
                            
                            }
            }, function(){
            //  $(this).html();

            $(this).find('span.glyphicon').remove();
            });
    });
                
               

         $("#nsupplier").validate({
        	rules:{
        		corporatename:'required',
        		supplierdsc:'required',
                        contactname:'required',
                        website:{
                                required:true,
                                url:true
                        },
                        phone:{
                                required:true,
                                number: true
                        },
                        email:{
                                required:true,
                                email:true
                        },
                        rfc:{
                                required:true,
                                maxlength:13,
                                minlength:10
                        },
                        address:'required',
                        temp_country:'required',
                        temp_state:'required',
                        cityid:'required',
                        paymentterms:'required'

        	},
        	submitHandler: function(form){
        		var $form = $(form).find('input').not(":hidden, .select2-offscreen"),data = {};

        		$form.each(function(index, el) {
        			data[el.id] = $(el).val();
        		});
                data['cityid'] = $("#cityid").val();
                        
        		$.post('<?php echo Yii::app()->createUrl("portoprint/supplier/addsupplier"); ?>',data, function(data, textStatus, xhr) {
        			if(data.status){
        				location.reload();
        			}
        		},'json');
        		return false;
        	},
        	messages:{
        		corporatename:'Ingrese el nombre del proveedor',
        		supplierdsc:'Ingrese la descripción',
                        contactname:'Ingrese un nombre de contacto',
                        website:{
                                required:'Ingrese el sitio web del proveedor',
                                url:'Ingrese una url valida (http://www.example.com)'
                        },
                        phone:{
                                required:'Ingrese el numero de telefono del proveedor',
                                number: 'Ingrese solo numeros'
                        },
                        email:{
                                required:'Ingrese un correo electronico',
                                email:'Ingrese un correo electronico valido (mail@example.com)'
                        },
                        rfc:'Ingrese el RFC del proveedor',
                        address:'Ingrese la dirrección postal del proveedor',
                        temp_country:'Selecciona un pais',
                        temp_state:'Selecciona un estado',
                        cityid:'Selecciona una ciudad',
                        paymentterms:'Ingrese el tiempo de pago'
        
        
                }

        });
	});
        
         function limpiar_modal(){
     
            $("#nsupplier").find('input[type=text]').each(function() {
                    var elemento= this;
                    
                    var tipo= $("#nsupplier").find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                       $("#nsupplier").find("#"+elemento.id).attr("value","");
                        $("#nsupplier").find("#"+elemento.id).val("");   
                     }
                    
            });
              $("#temp_country").val("-1").trigger("change");
              $("#temp_state").select2("destroy"); 
               $("#cityid").select2("destroy"); 
                 $("#temp_state").html(''); 
                $("#cityid").html(''); 
               $("#temp_state").select2(); 
               $("#cityid").select2(); 
               $("#sendnewsupplier").show();
                 $("#sendnewsupplier1").hide();
                
           //   
     
     }
        function bloq_supplier(id){
                
                    var sepa=id.split('_');
                    var integrador= { }; 
                    
                    integrador["supplierid"]=sepa[1];
                    if(sepa[2]==1){
                        integrador["block"]=0;
                    }else{
                        integrador["block"]=1;
                    }
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/supplier/bloqsupplier') ?>',{'arrai':integrador}, function(response){
                                       
                                        if(response!=0){
                                             alert('Proveedor bloqueado exitosamente .');
                                              location.reload();
                                        }  else{
                                             alert('Proveedor Desbloqueado exitosamente .');
                                              location.reload(); 
                                        }
                                                   


                                 });
                    
                
                }
                
                function select_id_service(){
                   var dat= $("#serviceid_list").val();
                       
                   var supplierid= $("#ssname").data("supplierid");
                    if(dat!=null){
                        dat=dat.toString();
                        var dat = dat.replace(/,/g, "s");
                     
                        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/supplier/saveservicesupplier') ?>',{'arrai': dat, 'supplierid':supplierid}, function(response){
                                      
                                        console.log(response);
                                        
                                 });
                   }
                }

</script>

