<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<header>
					<span class="widget-icon"> <i class="glyphicon glyphicon-briefcase"></i> </span><h2>Compañias</h2>
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
                                                                    <?php if($add==1){ ?>
                                                                    <div class="btn-group btn-group-sm" >
									<a href="#newproject" class="btn btn-success" data-target="#newproject"  data-toggle="modal">Nueva compañia</a>
                                                                    </div>
                                                                        <?php } ?>    
                                                                </section>
							     <section class="col col-4">	
								</section>
								<section class="col col-5">
                                                                    
                                                                </section>
							</div>
							</fieldset>
							</form>
						</div>
						
						<table id="customer_list_table" class="table table-striped " cellspacing="0" width="100%">
							<thead>
								<tr>
                                                                    <th style="width:20%;">Compañia ID</th>
									<th style="width:40%;">Nombre</th>
									<th style="width:30%;">RFC</th>
                                                                        <?php if($del==1){?><th style="width:10%;">Borrar</th><?php } ?>
								</tr>
							</thead>
							<tbody>
							<?php 
                                                        //echo 'count_model'.count($model);
                                                        foreach($model as $valor){?>
									 	<tr>
                                                                                    <td><?php echo $valor->companyid ?> </td>
                                                                                    <td id="<?php echo $valor->companyid ?>_companydsc_dsc"  <?php if($edt==1){?> data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/company/updatecompany') ?>"  ondblclick="jq_edit_t(this.id)"<?php } ?> ><?php echo $valor->companydsc; ?></td>
                                                                                    <td id="<?php echo $valor->companyid ?>_rfc_rfc" <?php if($edt==1){?>data-url="<?php echo Yii::app()->createAbsoluteUrl('portoprint/company/updatecompany') ?>" ondblclick="jq_edit_t(this.id)" <?php } ?>><?php echo $valor->rfc; ?></td>
                                                                               <?php if($del==1){?><td><div id="divbtndelet_<?php echo Yii::app()->user->userid; ?>"><a  class="btn btn-danger" id="divbtndelet_<?php echo Yii::app()->user->userid; ?>_<?php echo $valor->companyid ?>" onclick="delet_user(this.id)" ><i class="glyphicon glyphicon-remove"></i></a></td> <?php } ?>
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
        <h4 class="modal-title">Agregar Nueva Compañia</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="#" id="nproyectcustm" novalidate="novalidate" class="smart-form">	
        <fieldset>
			<table class="table table-bordered">
			<tbody>
					<tr>
					<td><label for="NTproject">Nombre</label></td><td  id="NT_companydsctd">
					<input type="text" id="NT_companydsc_dsc" />
					</td></tr>
					<tr>
					<td><label for="NTproject">R.F.C.</label></td><td id="NT_rfctd">
					<input type="text" id="NT_rfc_rfc" />
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
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	pageSetUp();
	var oTable;
      //  var flag_dbclick=0;
        
            $("#customer_list_table").find("td").css("cursor","pointer");

            oTable = $('#customer_list_table').dataTable({
			 
                        "order": [ 0, 'desc' ],
                        "responsive": true,
                        "bLengthChange":false,
                        "dom": '<"#newssp"<><l><f>>tip',
                        "oLanguage": {
                                "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
                                "sEmptyTable": "No hay registros.",
                                "sInfoEmpty" : "No hay registros.",
                                "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
                                "sProcessing": "Procesando",
                                "sSearch": "Buscar:",
                                "sZeroRecords": "No hay registros",
                            }
			
		});


		$("#sendproject").click( function(){
			var valid=0;
                        var bandera=0;
                        var valueToPush=" ";
                        var integrador= { }; 
                        $("#nproyectcustm").find('input').each(function() {
                              var elemento= this;
                              var div=elemento.id.split('_');
                              if(div[0]=='NT'){
                                  //console.log(elemento.id);
                                    valid=valid_expresion_form(elemento.id);
                                    if(valid==1){
                                       bandera=1;
                                    }else{
                                       integrador[div[1]]=elemento.value;
                                    }
                               } 
                           });
			if(bandera==0){
				$.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/company/createcompany') ?>',{'arrai':integrador}, function(response){
                                            //console.log(response);
                                            if(response==0){
                                                    alert('El nombre que esta tratando de insertar ya existe.');
                                                }else{
                                                   alert('Se a realizado la insercion correctamente.');
                                                  $('#nproyectcustm').modal('hide');
                                                    location.reload();
                                                    
                                                }   
                                                  
			    });
			}else{
				alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
				
			}
				
			
		});
                
                function delet_user(id){
                
                    var sepa=id.split('_');
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/company/deltecompany') ?>',{'userid':sepa[1],'companyid':sepa[2]}, function(response){
                                       
                                        if(response!=0){
                                             alert('Se ha borrado correctamente.');
                                              location.reload();
                                        }  
                                                   


                                 });
                    
                
                }
</script>