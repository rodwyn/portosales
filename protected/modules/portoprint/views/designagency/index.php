
<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2>Agencias de Diseño </h2>
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
									<a href="#newproject" class="btn btn-success" data-target="#newproject"  data-toggle="modal">Nueva Agencia</a>
                                                                    </div><?php } ?> 
							     </section>
							     <section class="col col-4">
                                                                  <select id="designagency_designagencyid" name="designagency_designagencyid" class="select2">
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
						<table id="designagency_list_table" class="table table-striped " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Agencia ID</th>
									<th>Nombre</th>
									<th>Cliente</th>
                                                                        <?php if($del==1){?><th style="width:5%;">Borrar</th><?php } ?>
								</tr>
							</thead>
							<tbody>
                                                           <?php foreach($model as $valor){ ?>
                                                               
                                                               <tr >
                                                                   <td><?php echo $valor->designagencyid ?> </td>
                                                                   <td id="<?php echo $valor->designagencyid ?>_designagencydsc_dsc" class="td_edit_tb" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/designagency/updatedesignagency') ?>"  ondblclick="jq_edit_t(this.id)"<?php } ?> ><?php echo $valor->designagencydsc; ?></td>
                                                                   <td><?php echo $valor->customerdsc; ?></td>
                                                                   <?php if($del==1){?><td style="text-align:center;"><div id="divbtndelet_<?php echo Yii::app()->user->userid; ?>"><a  class="btn btn-danger" id="divbtndelet_<?php echo Yii::app()->user->userid; ?>_<?php echo $valor->designagencyid ?>" onclick="delet_designagency(this.id)" ><i class="glyphicon glyphicon-remove"></i></a></td> <?php } ?>
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
        <h4 class="modal-title">Agregar Nueva Agencia de Diseño</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="#" id="nproyectdesign" novalidate="novalidate" class="smart-form">	
        <fieldset>
			<table class="table table-bordered">
			<tbody>
					
					<tr>
					<td><label for="NTproject">Nueva Agencia </label></td><td id="NT_designagencydsctd">
					<input type="text" id="NT_designagencydsc_dsc" />
					</td>
                                        </tr>
					<tr>
					<td><label for="NTproject">Cliente </label></td><td id="NT_designagencyid">
					<!--<input type="text" id="NTcliente" />-->
                                        <select id="nue_designagencyid" name="new_select" class="select2">
                                            <option value="0">Todos los clientes</option>
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
         $("#designagency_list_table").find("td").css("cursor","pointer");
    
        //relistar los datos de la tabla de manera que solo muestre la seleccion del filtro de clientes
        $('#designagency_designagencyid').change( function(){
        	 var customerid = $(this).val();
        	 window.location = '?r=portoprint/default#index.php?r=portoprint/designagency/index/customer/'+customerid;
            
           });
        
        $("#sendproject").click( function(){
			var valid=0;
                        var bandera=0;
                        var bandera1=0;
                        var valueToPush=new Array();
                        var integrador= { }; 
                        $("#nproyectdesign").find('input').each(function() {
                              var elemento= this;
                              var div=elemento.id.split('_');
                              valid=valid_expresion_form(elemento.id);
                                if(valid==1){
                                   bandera=1;
                                }else if(div[0]=='NT'){
                                    
                                   integrador[div[1]]=elemento.value;
                                }
                           });
                           
                          if($("#nue_designagencyid").val()!=0){
                              $("#NT_designagencyid").find(".error").remove();
                               integrador['customerid']=$("#nue_designagencyid").val();
                               bandera1=0;
                          }else{
                              $("#NT_designagencyid").find(".error").remove();
                               bandera1=1;
                                $('<label class="error" generated="true">Debe seleccionar un cliente</label>').appendTo("#NT_designagencyid");
                          } 
                          
                          if(bandera==0&&bandera1==0){
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/designagency/createdesignagency') ?>',{'arrai':integrador}, function(response){
                                                if(response==0){
                                                    alert('El nombre que esta tratando de insertar ya existen en este cliente.');
                                                }else{
                                                
                                                   alert('Se a realizado la insercion correctamente.');
                                                     $('#nproyectdesign').modal('hide');
                                                    location.reload();
                                                    
                                                }  
                                                
			    });
			}else{
				alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
				
			}
				
			
		});
        
        
        oTable = $('#designagency_list_table').dataTable({
			"responsive": true,
                         "bLengthChange":false
			
		});
               
            function delet_designagency(id){
                
                    var sepa=id.split('_');
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/designagency/deltedesignagency') ?>',{'userid':sepa[1],'designagencyid':sepa[2]}, function(response){
                                       
                                        if(response!=0){
                                             alert('Se ha borrado correctamente.');
                                              location.reload();
                                        }  
                                                   


                                 });
                    
                
                }
</script>