<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2>Contactos </h2>
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
									<a href="#newproject" id="btnag" class="btn btn-success" data-target="#newproject"  data-toggle="modal">Nueva Contacto</a>
                                                                    </div>  <?php } ?> 
							     </section>
							     <section class="col col-4">
                                                                  <select id="customercontact_contactid" name="customercontact_contactid" class="select2">
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
						<table id="customercontact_list_table" class="table table-striped " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Contacto ID</th>
                                                                        <th>Cliente</th>
									<th>Nombre</th>
                                                                        <th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Posición</th>
                                                                        <th>Telefono</th>
                                                                        <th>Celular</th>
									<th>Email</th>
                                                                        <?php if($del==1){?><th style="width:5%;">Borrar</th><?php } ?>
								</tr>
							</thead>
							<tbody>
                                                           <?php foreach($model as $valor){ ?>
                                                               
                                                               <tr >
                                                                   <td><?php echo $valor->contactid ?></td>
                                                                   <td><?php echo $valor->customerdsc; ?></td>
                                                                   <td id="<?php echo $valor->contactid ?>_name_dsc" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customercontact/updatecontact') ?>" ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->name ?> </td>
                                                                   <td id="<?php echo $valor->contactid ?>_plastname_dsc" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customercontact/updatecontact') ?>"  ondblclick="jq_edit_t(this.id)"<?php } ?> ><?php echo $valor->plastname; ?></td>
                                                                   <td id="<?php echo $valor->contactid ?>_mlastname_dsc" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customercontact/updatecontact') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->mlastname; ?></td>
                                                                   <td id="<?php echo $valor->contactid ?>_position_dsc" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customercontact/updatecontact') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->position; ?></td>
                                                                   <td id="<?php echo $valor->contactid ?>_phone1_enu" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customercontact/updatecontact') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->phone1; ?></td>
                                                                   <td id="<?php echo $valor->contactid ?>_mobilephone_enu" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customercontact/updatecontact') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->mobilephone; ?></td>
                                                                   <td id="<?php echo $valor->contactid ?>_mail_ema" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/customercontact/updatecontact') ?>"  ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->mail; ?></td>
                                                                   <?php if($del==1){?><td style="text-align:center;"><div id="divbtndelet_<?php echo Yii::app()->user->userid; ?>"><a  class="btn btn-danger" id="divbtndelet_<?php echo Yii::app()->user->userid; ?>_<?php echo $valor->contactid ?>" onclick="delet_contact(this.id)" ><i class="glyphicon glyphicon-remove"></i></a></td> <?php } ?>
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
        <h4 class="modal-title">Agregar Nuevo Contacto</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="#" id="nproyect_contact" novalidate="novalidate" class="smart-form">	
        <fieldset>
			<table class="table table-bordered">
			<tbody>
					
					<tr>
					<td ><label for="NTproject">Nombre</label></td><td  id="NT_nametd">
					<input type="text" id="NT_name_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td ><label for="NTproject">Apellido Paterno </label></td><td id="NT_plastnametd">
					<input type="text" id="NT_plastname_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Apellido Materno </label></td><td id="NT_mlastnametd">
					<input type="text" id="NT_mlastname_dsc" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Posición </label></td><td id="NT_positiontd">
					<input type="text" id="NT_position_dsc" />
					</td>
                                        </tr>
					<tr>
					<td><label for="NTproject">Telefono 1 </label></td><td id="NT_phone1td">
					<input type="text" id="NT_phone1_enu" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Telefono 2 </label></td><td id="NT_phone2td">
					<input type="text" id="NT_phone2_enu" />
					</td>
                                        </tr>
                                        <tr>
					<td><label for="NTproject">Celular </label></td><td id="NT_mobilephonetd">
					<input type="text" id="NT_mobilephone_enu" />
					</td>
                                        </tr>
                                        <tr>
                                        <tr>
					<td><label for="NTproject">Email </label></td><td id="NT_mailtd">
					<input type="text" id="NT_mail_ema" />
					</td>
                                        </tr>
                                        <tr>    
					<td><label for="NTproject">Cliente </label></td><td id="NT_customer_contact">
					<!--<input type="text" id="NTcliente" />-->
                                            <select id="customer_contact" name="new_select" class="select2" >
                                             <option value="0">Seleccione un Cliente</option>
                                             <?php foreach($customerlist as $customerid => $list){?>
                                             <option value="<?php echo $customerid ?>" <?php if($customerid==$customer) echo "selected='selected'" ?> ><?php echo $list; ?> </option>
                                             <?php } ?>
                                            </select>
					</td>
                                        </tr>
                                        
				</tbody>
			</table>
		</fieldset>
        <footer>
            <button class="btn btn-primary" class="btn btn-default" id="sendproject" type="button" ata-dismiss="modal">Aceptar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new" >Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-'dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	pageSetUp();
       $("#customercontact_list_table").find("td").css("cursor","pointer");
	var oTable;
        //relistar los datos de la tabla de manera que solo muestre la seleccion del filtro de clientes
        $('#customercontact_contactid').change( function(){
        	 var customerid = $(this).val();
        	 window.location = '?r=portoprint/default#index.php?r=portoprint/customercontact/index/customer/'+customerid;
            
           });
         oTable = $('#customercontact_list_table').dataTable({
			
		
                        "responsive": true,
                         "bLengthChange":false
			
            });
        
            $("#sendproject").click( function(){
                
			var valid=0;
                        var bandera=0;
                        var bandera1=0;
                        var valueToPush=new Array();
                        var integrador= { }; 
                        $("#nproyect_contact").find('input').each(function() {
                              var elemento= this;
                              var div=elemento.id.split('_');
                              valid=valid_expresion_form(elemento.id);
                                if(valid==1){
                                   bandera=1;
                                }else if(div[0]=='NT'){
                                    
                                   integrador[div[1]]=elemento.value;
                                }
                           });
                           
                          if($("#customer_contact").val()!=0){
                              $("#NT_customer_contact").find(".error").remove();
                               integrador['customerid']=$("#customer_contact").val();
                               bandera1=0;
                          }else{
                              $("#NT_customer_contact").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar un cliente</label>').appendTo("#NT_customer_contact");
                          } 
                          
                          if(bandera==0&&bandera1==0){
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/customercontact/createcontact') ?>',{'arrai':integrador}, function(response){
                                               if(response==0){
                                                    alert('El nombre y correo que esta tratando de insertar ya existen en este cliente.');
                                                }else{
                                                
                                                   alert('Se a realizado la insercion correctamente.');
                                                     $('#nproyect_contact').modal('hide');
                                                    location.reload();
                                                    
                                                }  
                                                
			    });
			}else{
				alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
				
			}
				
			
		});         
            function delet_contact(id){
                
                    var sepa=id.split('_');
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/customercontact/deltecontact') ?>',{'userid':sepa[1],'contactid':sepa[2]}, function(response){
                                       
                                        if(response!=0){
                                             alert('Se ha borrado correctamente.');
                                              location.reload();
                                        }  
                                                   


                                 });
                    
                
                }

</script>