
<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2>Clientes </h2>
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
							     </section>
							     <section class="col col-4">	
								</section>
								<section class="col col-5">
									<a href="javascript:void(0);" class="btn btn-default btn-xs" data-target="#newproject"  data-toggle="modal">Nuevo Cliente</a>
								</section>
							</div>
							</fieldset>
							</form>
						</div>
						<br><br>
						<table id="customerlist_table" class="table table-striped " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Clientes ID</th>
									<th>Nombre</th>
									<th>Email</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($model as $valor){?>
									 	<tr >
                                                                                    <td><?php echo $valor->customerid ?> </td><td id="<?php echo $valor->customerid ?>_dsc"  ondblclick="obtener_campo(this.id,'<?php echo $valor->customerdsc ?>')"><?php echo $valor->customerdsc; ?></td><td id="<?php echo $valor->customerid ?>_email"  ondblclick="obtener_campo(this.id,'<?php echo $valor->email ?>')"><?php echo $valor->email; ?></td></tr>
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
        <h4 class="modal-title">Agregar Nuevo Cliente</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="#" id="nproyect" novalidate="novalidate" class="smart-form">	
        <fieldset>
			<table class="table table-bordered">
			<tbody>
					
					<tr>
					<td><label for="NTproject">Nuevo Cliente </label></td><td>
					<input type="text" id="NTcliente" />
					</td></tr>
					<tr>
					<td><label for="NTproject">Email </label></td><td>
					<input type="text" id="NTemail" />
					</td>
					</tr>
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
	var oTable;
        var flag_dbclick=0;
        
            $("#customerlist_table").find("td").css("cursor","pointer");

	oTable = $('#customerlist_table').dataTable({
			
			 "bFilter": false
			
		});


		$("#sendproject").click( function(){
			var clientedes = $("#NTcliente").val(); //obtiene el valor del nuevo cliente que se desea insertar
			var emailcl = $("#NTemail").val(); //obtiene el valor del nuevo cliente que se desea insertar
                        var valid=0; //Bandera para verificar si se realiza o no el insert
                        if(!$("#NTcliente").val().match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/)){ //uso de expresiones regulares para validar campo ingresado
                            alert("Este campo no admite alguno de los caracteres que esta intentando introducir");
                            $("#NTcliente").select();
                            valid=1;
                          }
                         
                        if(!$("#NTemail").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)){ //uso de expresiones regulares para validar campo ingresado
                            alert("La direccion de correo que esta intentando ingresar no tiene el formato adecuado");
                            $("#NTemail").select();
                            valid=1; 
                         }
                        
			if(valid==0){
				$.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/customer/createcustomer') ?>',{customerdsc:clientedes, emailsc:emailcl}, function(response){
						$('#newproject').modal('hide');
						//console.log(response);
						location.reload();
			    });
			}else{
				alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
				$('#newproject').modal('hide');
			}
				
			
		});
	/*var editor;
	    editor = new $.fn.dataTable.Editor( {
	        //ajax: "../php/staff.php",
	        table: "#customerlist_table"
	       
	    });

		$('#customerlist_table').on( 'click', 'tbody td:not(:first-child)', function (e) {
        	editor.inline( this );
    	});*/

        function obtener_campo(id,contenido){ //funcion para activar cambio en celda
          if(flag_dbclick==0){  //validacion para tener solo una modificacion por vez
                var iden="'"+id+"'";
                $("#customerlist_table").find("#"+id).html('<input type="text" id="temp_cel" value="'+contenido+'" onkeyup="update_cel('+iden+',event)"/>');
                $("#temp_cel").select();
                flag_dbclick=1; //bandera comprobar modificacion activa o no
            }else{
                 alert("No se puede modificar el dato, se esta modificando otro campo actualmente, pulse Enter y vuelva a intentarlo");
                 $("#temp_cel").select();
            }
        }
        
        function update_cel(id,e){ //realizar la accion de update
            var tecla=(document.all) ? e.keyCode : e.which;
            if(tecla == 13){ //Validar tecla Enter
                
               var nuevo_dato=$("#temp_cel").val(); //obtenemos el nuevo dato ingresado
               var valid=0; //bandera para validar que el campo tenga el formato adecuado
               var ident=id.split('_'); //identificador id del dato que se esta modificando (incluye que tipo de campo se esta tratando de modificar)
                if(ident[1]=='dsc'){ //verifica que tipo de campo es el que se trata de actualizar para validar que los datos sean adecuados
                    
                         if(!$("#temp_cel").val().match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/)){ //uso de expresiones regulares para validar campo ingresado
                            alert("Este campo no admite alguno de los caracteres que esta intentando introducir");
                            $("#temp_cel").select();
                            valid=1;
                          }
                 }else{
                    
                    if(!$("#temp_cel").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)){ //uso de expresiones regulares para validar campo ingresado
                         alert("La direccion de correo que esta intentando ingresar no tiene el formato adecuado");
                         $("#temp_cel").select();
                            valid=1; 
                    }
                }
                if(valid==0){  //valida bandera para ver si se puede realizar el update
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/customer/updatecustomer') ?>',{customernd:nuevo_dato, customerid:ident[0], customerval:ident[1]}, function(response){
                        //console.log(response);
                        if(response==1){
                            location.reload();
                        }else{
                            alert("No se a podido realizar la modificacion, consulte con el Administrador");
                            location.reload();
                        }
                     });
                    
                    }
                }
            
        }


</script>
	
