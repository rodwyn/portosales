<!--<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
				Proveedores
		</h1>
	</div>
</div>	-->

<!-- widget grid -->
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
						<div class="widget-body-toolbar">
							<a class="btn btn-success btn-ms" data-toggle="modal" id="addSupplier" data-target="#newsupplier" href="#newsupplier">Nuevo Proveedor</a>
						</div>
						
						<table id="ratelist_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th style="width:10%;">Proveedor ID</th>
									<th style="width:30%;">Proveedor</th>
									<th style="width:30%;">Servicios</th>
									<th style="width:30%;">Asignar</th
                                                                       
								</tr>
							</thead>
                            <tbody>
    							<?php 
    								foreach ($supplierdata as  $value) {
                                        $supplierservices = "";
                                        foreach ($value['services'] as $v) {
                                            $supplierservices .= ($v["asigned"])? '<span id="ss_'.$value['supplierid'].'_'.$v['asigned'].'">'.$v['dsc'].' |</span> ': '';
                                        }
                                        
                                        echo "<tr>
                                        <td>".$value['supplierid']."</td>
                                        <td id=\"".$value['supplierid']."_corporatename_dsc\" data-url=".Yii::app()->createAbsoluteUrl('portoprint/supplier/editsupplier')." ondblclick=\"jq_edit_t(this.id)\">".$value['corporatename']."</td>
                                        <td class=\"edit_supplierservice\"><p class=\"supplierservices_".$value['supplierid']."\" >".$supplierservices."</p></td>
                                        <td><a data-id=\"".$value['supplierid']."\" data-namesupplier=\"".$value['corporatename']."\" class=\"newsupplierservice btn btn-primary btn-ms\" data-toggle=\"modal\" data-nameSupplier=\"".$value['corporatename']."\" data-target=\"#newsupplierservice\" href=\"#newsupplierservice\" >Asignar Servicios</a></td>
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
                            <td><input type="text" name="corporatename" id="corporatename"></td>
                        </tr>
                        <tr>
                            <td><label for="spplierdsc">Descripción *</label></td>
                            <td><input type="text" name="supplierdsc" id="supplierdsc"></td>
                        </tr>
                        <tr>
                            <td><label for="contactname">Nombre de contacto *</label></td>
                            <td><input type="text" name="contactname" id="contactname"></td>
                        </tr>
                        <tr>
                            <td><label for="website">Sitio web *</label></td>
                            <td><input type="text" name="website" id="website"></td>
                        </tr>
                        <tr>
                            <td><label for="phone">Telefono *</label></td>
                            <td><input type="text" name="phone" id="phone"></input></td>
                        </tr>
                        <tr>
                            <td><label for="email">E mail *</label></td>
                            <td><input type="text" name="email" id="email"></td>
                        </tr>
                        <tr>
                            <td><label for="email2">E mail 2</label></td>
                            <td><input type="text" name="email2" id="email2"></td>
                        </tr>
                        <tr>
                            <td><label for="email3">E mail 3</label></td>
                            <td><input type="text" name="email3" id="email3"></td>
                        </tr>
                        <!-- <tr>
                            <td><label for="email4">E mail 4</label></td>
                            <td><input type="text" name="email4" id="email4"></td>
                        </tr>
                        <tr>
                            <td><label for="email5">E mail 5</label></td>
                            <td><input type="text" name="email5" id="email5"></td>
                        </tr>--> 
                        <tr>
                            <td><label for="rfc">R.F.C *</label></td>
                            <td><input type="text" name="rfc" id="rfc"></td>
                        </tr>
                        <tr>
                            <td><label for="address">Dirrección *</label></td>
                            <td><input type="text" name="address" id="address"></td>
                        </tr>
                        <tr>
                            <td><label for="suburb">Colonia</label></td>
                            <td><input type="text" name="suburb" id="suburb"></td>
                        </tr>
                        <tr>
                            <td><label for="temp_country">Pais *</label></td>
                            <td>
                                <select id="temp_country" name="temp_country" class="select2">
                                    <option value="">Seleccione un Pais</option>
                                    <?php foreach($listcountry as $list){?>
                                    <option value="<?php echo $list->countryid ?>" ><?php echo $list->countrydsc; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="temp_state">Estado *</label></td>
                            <td>
                                <select id="temp_state" name="temp_state" class="select2">
                                    <option value="">Seleccione un Estado</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="cityid">Ciudad *</label></td>
                            <td>
                                <select id="cityid" name="cityid" class="select2">
                                    <option value="">Seleccione una Ciudad</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="paymentterms">Tiempo de pago *</label></td>
                            <td><input type="text" name="paymentterms" id="paymentterms"></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        <footer>
	      	<button class="btn btn-primary" class="btn btn-default" id="sendnewsupplier" type="submit" ata-dismiss="modal">Aceptar</button>
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
		

        $('#temp_country').change( function(){
            var countryid = $(this).val();
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/countrystate') ?>',{countryid:countryid }, function(response){
                
                $("#temp_state").html(response)
                
                //evento onchage cuando se selecciona un estado, se obtiene la lista de ciudades
                .change( function(){
                     var stateid = $(this).val();
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/statecity') ?>',{stateid:stateid }, function(response){
                        
                        $("#cityid").html(response);
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
            var nameSupplier = $(this).data('namesupplier');
            $("#ssname").html(nameSupplier);
            $.ajax({
                url:"<?php echo Yii::app()->createUrl('portoprint/supplier/getsupplierservice') ?>",
                type:'post',
                dataType: 'JSON',
                data:{'supplierid':supplierid},
                success:function(data){
                                                
                    var xhtml = '<table id="dataSupplierService" class="table table-bordered"><tbody><tr><td>'//construimos la cabecera de la tabla
                    xhtml += '<select id="supplierservices" name="supplierservices" multiple="true">'; //Construimos el select multiple 
                    $.each(data,function(i,v){//Recorres el JSON del resultado y se generan los elementos option
                        if(i === "status"){
                            xhtml += "";
                        }else{
                            var asigned = v.asigned ?' selected ':'',// si asigned llega con algo diferente a false te pinta selected
                            supplierid = v.asigned ?' data-supplierservice="'+v.asigned+'" ':'';//agrega la propiedad en caso de estar aignado
                            xhtml += '<option '+asigned+supplierid+'value="'+v.id+'">'+v.dsc+'</option>';
                        }                            
                    });
                    xhtml += '</select> <button id="open" class="btn btn-sm btn-default glyphicon glyphicon-plus" type="button" >Agregar</button> <button data-dismiss="modal" class="btn btn-default btn-sm glyphicon glyphicon-remove" type="button">Cerrar </button></td></tr></tbody></table>';
                    
                    $("#nservice").html(xhtml);//Insertamos el html
                    
                    $("#supplierservices").select2({ //Instanciamos select2 
                        width:"70%" // ocupa el 70% del elemento que lo contiene
                    }).on("select2-selecting", function(e){ //Al seleccional un elemento
                        $.post("<?php echo Yii::app()->createUrl('portoprint/supplier/setsupplierservice') ?>",//hace una peticion para asignar el servicio
                            {'serviceid':e.val ,'supplierid':supplierid},
                            function(data){//Agrega el texto a la descripcion
                                $(e.object.element[0]).data('supplierservice',data.data.supplierservice);
                                $(".supplierservices_"+supplierid).append('<span id="ss_'+data.data.supplierid+'_'+data.data.supplierservice+'" >'+e.object.text+' |</span> ');
                            },
                            "json"
                        );
                    }).on("select2-removed", function(e){ //Al eliminar un elemento
                        var supplierservice = $(e.choice.element).data("supplierservice"); //Obtiene del elemento original el atributo data-supplierservice
                        $.post("<?php echo Yii::app()->createUrl('portoprint/supplier/removesupplierservice') ?>",
                            {'supplierservice':supplierservice},
                            function(data){
                                $('#ss_'+data.data.supplierid+'_'+data.data.supplierservice).remove();
                            },
                            "json"
                        );
                    });
                    
                    $("#open").click(function(){ 
                         $("#supplierservices").select2("open");//Abre el menu
                         return false;
                    })
                }
            });
        });

         
        oTable = $('#ratelist_table').DataTable({
                  "order": [ 0, 'desc' ],
                  "bLengthChange":false,
                  "dom":'ftp',
		});

       // $("#newssp div:first").append('');

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
       
        function delet_supplier(id){
                
                    var sepa=id.split('_');
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/company/deltecompany') ?>',{'userid':sepa[1],'companyid':sepa[2]}, function(response){
                                       
                                        if(response!=0){
                                             alert('Se ha borrado correctamente.');
                                              location.reload();
                                        }  
                                                   


                                 });
                    
                
                }

</script>

