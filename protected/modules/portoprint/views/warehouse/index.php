<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2>Bodegas</h2>
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
									<a href="#newproject" id="btnwa" class="btn btn-success" data-target="#newproject"  data-toggle="modal">Nueva Bodega</a>
                                                                    </div><?php } ?> 
							     </section>
							     <section class="col col-4">
                                                                  <select id="warehouse_warehouseid" name="warehouse_warehouseid" class="select2">
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
						<table id="warehouse_list_table" class="table table-striped " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Bodega ID</th>
                                                                        <th>Cliente</th>
                                                                        <th>Nombre</th>
									<th>Direccion</th>
                                                                        <th>Colonia</th>
									<th>Horarios</th>
									<th>Contacto</th>
                                                                        <th>Telefono</th>
									<th>Email</th>
                                                                         <?php if($del==1){?><th style="width:5%;">Borrar</th><?php } ?>
								</tr>
							</thead>
							<tbody>
                                                           <?php foreach($model as $valor){ ?>
                                                               
                                                               <tr >
                                                                   <td><?php echo $valor->warehouseid; ?></td>
                                                                    <td><?php echo $valor->customerdsc; ?></td>
                                                                   <td id="<?php echo $valor->warehouseid ?>_name_dsc" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/warehouse/updatewarehouse') ?>" ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->name; ?> </td>
                                                                   <td id="<?php echo $valor->warehouseid ?>_adress_dsc" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/warehouse/updatewarehouse') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->adress; ?></td>
                                                                   <td id="<?php echo $valor->warehouseid ?>_neighborhood_dsc" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/warehouse/updatewarehouse') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->neighborhood; ?></td>
                                                                   <td id="<?php echo $valor->warehouseid ?>_schedule_hrs" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/warehouse/updatewarehouse') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->schedule; ?></td>
                                                                   <td id="<?php echo $valor->warehouseid ?>_contact_dsc" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/warehouse/updatewarehouse') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->contact; ?></td>
                                                                   <td id="<?php echo $valor->warehouseid ?>_phone_enu" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/warehouse/updatewarehouse') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->phone; ?></td>
                                                                   <td id="<?php echo $valor->warehouseid ?>_email_ema" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/warehouse/updatewarehouse') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->email; ?></td>
                                                                   <?php if($del==1){?><td style="text-align:center;"><div id="divbtndelet_<?php echo Yii::app()->user->userid; ?>"><a  class="btn btn-danger" id="divbtndelet_<?php echo Yii::app()->user->userid; ?>_<?php echo $valor->warehouseid ?>" onclick="delet_warehouse(this.id)" ><i class="glyphicon glyphicon-remove"></i></a></td> <?php } ?>
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
        <h4 class="modal-title">Agregar Nueva Bodega</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="#" id="nproyectware" novalidate="novalidate" class="smart-form">	
        <fieldset>
			<table class="table table-bordered">
			<tbody>
					
					<tr>
					<td ><label for="NTproject">Nombre</label></td><td  id="NT_nametd">
					<input type="text" id="NT_name_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td ><label for="NTproject">Direccion </label></td><td id="NT_adresstd">
					<input type="text" id="NT_adress_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Colonia </label></td><td id="NT_neighborhoodtd">
					<input type="text" id="NT_neighborhood_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Horarios </label></td><td id="NT_scheduletd">
					  
                                           <input type="text" id="T1_schedule_d" />&nbsp; - &nbsp; <input type="text" id="T1_schedule_a" />
					</td>
                                        </tr>
					<tr>
					<td><label for="NTproject">Contacto </label></td><td id="NT_contacttd">
					<input type="text" id="NT_contact_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Telefono </label></td><td id="NT_phonetd">
					<input type="text" id="NT_phone_enu" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Email </label></td><td id="NT_emailtd">
					<input type="text" id="NT_email_ema" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Cliente </label></td><td id="NT_customer_bodg">
					<!--<input type="text" id="NTcliente" />-->
                                            <select id="customer_bodg" name="new_select" class="select2" >
                                             <option value="0">Seleccione un Cliente</option>
                                             <?php foreach($customerlist as $customerid => $list){?>
                                             <option value="<?php echo $customerid ?>" <?php if($customerid==$customer) echo "selected='selected'" ?> ><?php echo $list; ?> </option>
                                             <?php } ?>
                                            </select>
					</td>
                                        
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
      
	var oTable;
         $("#warehouse_list_table").find("td").css("cursor","pointer");
    
        $("#btnwa").click(function(){
              
              $('#T1_schedule_d').timepicker();
              $('#T1_schedule_a').timepicker();
              
          }); 
         
         $("#sendproject").click( function(){
			var valid=0;
                        var bandera=0;
                        var bandera1=0;
                        var valueToPush=" ";
                        var integrador= { }; 
                        $("#nproyectware").find('input').each(function() {
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
                          
                          if($("#customer_bodg").val()!=0){
                              $("#NT_customer_bodg").find(".error").remove();
                               integrador['customerid']=$("#customer_bodg").val();
                               bandera1=0;
                          }else{
                              $("#NT_customer_bodg").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar un cliente</label>').appendTo("#NT_customer_bodg");
                          }
                           
                          if(bandera==0&&bandera1==0){
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/warehouse/createwarehouse') ?>',{'arrai':integrador}, function(response){
                                                if(response==0){
                                                    alert('El nombre y contacto que esta tratando de insertar ya existen en este cliente.');
                                                }else{
                                                
                                                   alert('Se a realizado la insercion correctamente.');
                                                     $('#nproyectware').modal('hide');
                                                    location.reload();
                                                    
                                                }  

                               });
                          }else{
				alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
				
                         }
    
    
                });
           
            $('#warehouse_warehouseid').change( function(){
        	 var customerid = $(this).val();
        	 window.location = '?r=portoprint/default#index.php?r=portoprint/warehouse/index/customer/'+customerid;
            
              });             
         
        oTable = $('#warehouse_list_table').dataTable({
			"responsive": true,
                         "bLengthChange":false
		});
          function delet_warehouse(id){
                
                    var sepa=id.split('_');
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/warehouse/deltewarehouse') ?>',{'userid':sepa[1],'warehouseid':sepa[2]}, function(response){
                                       
                                        if(response!=0){
                                             alert('Se ha borrado correctamente.');
                                              location.reload();
                                        }  
                                                   


                                 });
                    
                
                }
</script>