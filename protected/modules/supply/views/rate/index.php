<div class="row">
	
</div>	

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
					<h2>Cotizaciones </h2>

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
								<section class="col col-3"><div>Rango de Fechas</div>
									<div id="ratesrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
							             <i class="glyphicon glyphicon-calendar icon-calendar icon-large"></i>
							             <span></span> <b class="caret"></b>
							        </div>
							     </section>
							     <section class="col col-4"><div>Tipo de Cotizacion</div>
								  <select id="type_cotizacion" name="type_cotizacion" class="select2">
                                                                      <option value="0" <?php if($status==0) echo "selected='selected'" ?> >Todos</option>
                                                                      <option value="14" <?php if($status==14) echo "selected='selected'" ?> >ODC</option>
                                                                      <option value="15" <?php if($status==15) echo "selected='selected'" ?> >ODP</option>
                                                                      <option value="16" <?php if($status==16) echo "selected='selected'" ?> >ODC Cancelada</option>
                                                                      <option value="17" <?php if($status==17) echo "selected='selected'" ?> >ODP Cancelada</option>
                                                                      
                                                                  </select>
                                                             </section>
								<section class="col col-5">&nbsp;</section>
							</div>
							</fieldset>
							</form>
						</div>
						<br><br>
						<table id="ratelist_table" class="table table-striped " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Cotización ID</th>
									<th>Fecha</th>
									<th>Item</th>
									<th>Cantidades</th>
									<th>Comprador</th>
									<th>Contato</th>
                                                                        <th>Marca</th>
                                                                        <th>Proyecto</th>
                                                                        <th>Tipo</th>
                                                                        <th>Estatus</th>
                                                                        <th>Accion</th>
								</tr>
							</thead>
                                                        
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

	<!-- end row -->

</section>
<!-- end widget grid -->

<div class="modal fade bs-example-modal-lg" id="newproject" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content" style="width:900px; height: 500px; ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de la Cotizacion</h4>
      </div>
        <ul id="myTab" class="nav nav-tabs">
							<li class="active">
								<a href="#s1" data-toggle="tab" onclick="$('#botonera').show();">Informacion General</a>
							</li>
							<li>
								<a href="#s2" data-toggle="tab" onclick="$('#botonera').hide();">Distribucion</a>
							</li>
                                                        <!--<li>
								<a href="#s3" data-toggle="tab" onclick="$('#botonera').hide();">Cambios de Arte</a>
							</li>-->
                                                        <li>
                                                            <a href="#s4" data-toggle="tab" onclick="$('#botonera').hide();">Subir Cotizacion</a>
							</li>
        </ul>
          <div  id="nproyect_pric" novalidate="novalidate" class="smart-form">	
        <div id="myTabContent" class="tab-content">
       
	<div class="tab-pane fade in active" id="s1">
            
      
            <fieldset style="height:280px;">
			<table class="table table-bordered" id="nproyect_pric_tb">
			<tbody>
					
					<tr>
					<td ><label for="NTproject">Cantidad</label></td>
                                        <td  id="NT_nametd"><label for="NTproject">Precio</label></td>
                                        <td ><label for="NTproject">Dias de Produccion</label></td>
                                        
                                        </tr>
                        </tbody>
			</table>
		</fieldset>
       
	     <!--</form>-->
           
     </div>
            <div class="tab-pane fade" id="s2">
                <div class="modal-body no-padding">
      <!--	<form method="post" action="#" id="nproyect_distribu" novalidate="novalidate" class="smart-form">-->	
        <fieldset style="height:280px;">
			<table class="table table-bordered" id="nproyect_distribu_tb">
			<tbody>
					
					<tr>
					<td ><label for="NTproject">Lugar</label></td>
                                        <td  id="NT_nametd"><label for="NTproject">Precio</label></td>
                                        
                                        
                                        </tr>
                        </tbody>
			</table>
		</fieldset>
       
	   <!-- </form>-->
            </div>
                
            </div>
           <!-- <div class="tab-pane fade" id="s3">
                <div class="modal-body no-padding">
                  
                    <fieldset style="height:280px;">
                                    <table class="table table-bordered" id="nproyect_chanart_tb">
                                    <tbody>

                                                   
                                    </tbody>
                                    </table>
                            </fieldset>
                  
                         
            </div>
            </div>-->
            <div class="tab-pane fade" id="s4"> 
             <div class="modal-body no-padding">
                     <fieldset style="height:380px;">
                        <header id="head_s"><strong>Ya se a cargado un archivo de cotizacion</strong></header>
                            <form  class="dropzone smart-form" id="sdzone_listageneral" style="border-color:#FF0000; height: 100px;"></form>
                   <!--  <header><strong>Arrastra o da click en esta zona para cargar Archivo</strong></header>-->
                     </fieldset>
             </div>
            </div>
           
           
     </div>
              <footer id="botonera" style="position:inherit;  bottom: -30px;">
                            <button class="btn btn-primary" class="btn btn-default" id="sendproject" type="button" ata-dismiss="modal">Aceptar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new" >Cancelar</button>			
	     </footer>
          </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-'dialog -->
</div><!-- /.modal -->
<!-- end widget grid -->

<div class="modal fade" id="newproj" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Motivo de Rechazo</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="#" id="nproyect_recha" novalidate="novalidate" class="smart-form">	
        <fieldset>
			<table class="table table-bordered" id="nproyect_recha_tb">
			<tbody>
					
					<tr>
					<td ><label for="NTproject">Motivo</label></td>
                                        <td  id="NT_nametd">
					<textarea class="form-control" id="declinereason" rows="3"></textarea>
					</td>
                                        </tr>
                        </tbody>
			</table>
		</fieldset>
        <footer>
            <button class="btn btn-primary" class="btn btn-default" id="sendrecha" type="button" ata-dismiss="modal">Aceptar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new" >Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-'dialog -->
</div><!-- /.modal -->

<script type="text/javascript">

	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	var oTable;
	 pageSetUp();
         $("#newproject").find("#sendproject").hide();
          $("#newproject").find("#sdzone_listageneral").hide();
          $("#newproject").find("#head_s").hide();
          
	// PAGE RELATED SCRIPT
	
	var startdt = '<?php echo $start; ?>';
	var enddt = '<?php echo $end; ?>';
	var startt = moment(" <?php echo $start; ?>");
	var endt = moment(" <?php echo $end; ?>");
	
        
        
	var customerid = 0;
	$(document).ready(function runDataTables() {
		
		 moment.lang('es', {
		        months : "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split("_"),
		        monthsShort : function (m, format) {
		            if (/-MMM-/.test(format)) {
		                return monthsShort[m.month()];
		            } else {
		                return monthsShortDot[m.month()];
		            }
		        },
		        weekdays : "domingo_lunes_martes_miércoles_jueves_viernes_sábado".split("_"),
		        weekdaysShort : "dom._lun._mar._mié._jue._vie._sáb.".split("_"),
		        weekdaysMin : "Do_Lu_Ma_Mi_Ju_Vi_Sá".split("_"),
		        longDateFormat : {
		            LT : "H:mm",
		            L : "DD/MM/YYYY",
		            LL : "D [de] MMMM [del] YYYY",
		            LLL : "D [de] MMMM [del] YYYY LT",
		            LLLL : "dddd, D [de] MMMM [del] YYYY LT"
		        },
		        calendar : {
		            sameDay : function () {
		                return '[hoy a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
		            },
		            nextDay : function () {
		                return '[mañana a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
		            },
		            nextWeek : function () {
		                return 'dddd [a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
		            },
		            lastDay : function () {
		                return '[ayer a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
		            },
		            lastWeek : function () {
		                return '[el] dddd [pasado a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
		            },
		            sameElse : 'L'
		        },
		        relativeTime : {
		            future : "en %s",
		            past : "hace %s",
		            s : "unos segundos",
		            m : "un minuto",
		            mm : "%d minutos",
		            h : "una hora",
		            hh : "%d horas",
		            d : "un día",
		            dd : "%d días",
		            M : "un mes",
		            MM : "%d meses",
		            y : "un año",
		            yy : "%d años"
		        },
		        ordinal : '%dº',
		        week : {
		            dow : 1, // Monday is the first day of the week.
		            doy : 4 // The week that contains Jan 4th is the first week of the year.
		        }
		    });
		
		 $('#ratesrange').daterangepicker(
                 {
                    startDate: startdt,
                    endDate: enddt,
                    minDate: '14-03-2011',
                    maxDate: moment(),
                    dateLimit: { days: 90 },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    ranges: {
                       'Hoy': [moment(), moment()],
                       'Ultimos 7 días': [moment().subtract('days', 7), moment()],
                       'Ultimos 30 días': [moment().subtract('days', 30), moment()],
                       'Ultimos 60 días': [moment().subtract('days', 60), moment()],
                       'Ultimos 90 días': [moment().subtract('days', 90), moment()],
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary',
                    cancelClass: 'btn-small',
                    format: 'YYYY-MM-DD',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Buscar',
                        fromLabel: 'Desde',
                        toLabel: 'Hasta',
                        customRangeLabel: 'Perzonalizado',
                        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi','Sa'],
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        firstDay: 1
                    }
                 },
                 function(start, end) {
                	 startdt = start.format('YYYY-MM-DD');
                     enddt = end.format('YYYY-MM-DD');
                     customerid = $("#Rate_customerid").val();
                     window.location = '?r=supply/default#index.php?r=supply/rate/index/start/'+startdt+'/end/'+enddt;
                    
                 }
              );
        
		 $('#ratesrange span').html(startt.format('D MMMM YYYY')+" al "+endt.format('D MMMM D YYYY'));
                // var status = $("#type_cotizacion").val();
                
                console.log("Esta cargando");
		oTable = $('#ratelist_table').dataTable({
			"sAjaxSource": "<?php echo Yii::app()->createUrl('/supply/rate/rate',array('start'=>$start,'end'=>$end,'status'=> $status )); ?>",
                        "aoColumns": [
                              { "mData": "bundleid", sDefaultContent: "" },
                              { "mData": "ratedate", sDefaultContent: "","bSearchable": false },
                              { "mData": "servicedsc", sDefaultContent: ""},
                              { "mData": "quantity", sDefaultContent: "","bSearchable": false},
                              { "mData": "comprador", sDefaultContent: ""},
                              { "mData": "contacto", sDefaultContent: "" },
                              { "mData": "marca", sDefaultContent: ""},
                              { "mData": "projectdsc", sDefaultContent: "" },
                              { "mData": "tipo", sDefaultContent: "" },
                              { "mData": "statusdsc", sDefaultContent: "","bSearchable": false },
                              { "mData": "accion", sDefaultContent: "","bSearchable": false }
                              //{ "mData": "quantity1", sDefaultContent: "","bSearchable": false, "bVisible":    false }
                               
                        ] ,
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
                
               
            

	});
           $('#ratelist_table').on( 'draw.dt', function () {
                 $('.ratepop').popover({"trigger":"hover", "html" : true, "container":"body"});
            });
            
            $('#type_cotizacion').change( function(){
        	 var status = $(this).val();
        	 window.location = '?r=supply/default#index.php?r=supply/rate/index/status/'+status;
            
           });
           var chargin_file_supply=0;
          var temp_var_qual=0;
           function respon_cotizacion(id){
               $("#nproyect_pric_tb").find(".quel_cot").remove();
               $("#nproyect_chanart_tb").find(".quel_cot").remove();
               var data= $("#"+id).data("price");
               var status= $("#"+id).data("status");
               var ids= $("#"+id).data("id");
                //console.log(data);
                var data=data.toString();
                var n = data.indexOf("_");
                var cadena=" ";
                var cadena1="<tr class='quel_cot'>";
                var corta=id.split("cot");
                var details=$("#ratelist_table").find("#itemid_"+corta[1]).data("content");
                var tit=$("#ratelist_table").find("#itemid_"+corta[1]).data("tit");
                   
                if(n==-1){ 
                      temp_var_qual=1;
                      cadena="<tr class='quel_cot'><td id='NTcant'><label>"+data+"</label></td><td id='quantity_1td'><input  type='number' value='0' step='0.01' min='0' id='quantity_1_pric' data-id='"+ids+"' data-status='"+status+"' /></td><td  id='NT_daysproduction1td'><input type='number' value='0' step='1' min='0' id='NT_daysproduction1_enu' /></td></tr><tr class='quel_cot'><td colspan='3' align='center'><label for='NTproject'>Detalle <b>"+tit+"</b></label></td></tr><tr class='quel_cot'><td id='NTdets' colspan='3'><label>"+details+"</label></td></tr>";
                      cadena1=cadena1+"<td id='NTcant'><label>"+data+"</label></td>";
                    }else{
                        var div=data.split("_");
                         //console.log(div.length);
                        temp_var_qual=div.length;
                    for(i=0;i<div.length;i++){
                        console.log(div[i]);
                        if(cadena==""){
                                cadena="<tr class='quel_cot'><td id='NTcant'><label>"+div[i]+"</label></td><td id='quantity_"+(i+1)+"td'><input type='number' value='0' step='0.01' min='0' id='quantity_"+(i+1)+"_pric' data-id='"+ids+"' data-status='"+status+"' /></td> <td  id='NT_daysproduction"+i+"td'><input type='number' value='0' step='1' min='0' id='NT_daysproduction"+(i+1)+"_enu' /></td></tr>";
                                 cadena1=cadena1+"<td id='NTcant'><label>"+data+"</label></td>";
                            }else{
                                cadena=cadena+"<tr class='quel_cot'><td id='NTcant'><label>"+div[i]+"</label></td><td id='quantity_"+(i+1)+"td'><input type='number' value='0' step='0.01' min='0' id='quantity_"+(i+1)+"_pric' /></td> <td  id='NT_daysproduction"+i+"td'><input type='number' value='0' step='1' min='0' id='NT_daysproduction"+(i+1)+"_enu' /></td></tr>";
                                 cadena1=cadena1+"<td id='NTcant'><label>"+data+"</label></td>";
                            }
                      

                     }
                     cadena=cadena+"<tr class='quel_cot'><td colspan='3' align='center'><label for='NTproject'>Detalle <b>"+tit+"</b></label></td></tr><tr class='quel_cot'><td id='NTdets' colspan='3'><label>"+details+"</label></td></tr>";
                }
                cadena1=cadena1+"</tr>";
                
                $(cadena).appendTo("#nproyect_pric_tb");
                $(cadena1).appendTo("#nproyect_chanart_tb");
                var bundleid=$("#"+id).data('bundleid');
                var rateid=corta[1];
                
                $("#sdzone_listageneral").attr("action","index.php?r=portoprint/upload/savefile_supplier/id/"+bundleid+"/rate/"+rateid);
               // var urls="<?php echo Yii::app()->createAbsoluteUrl('supply/upload/savefile_suppier') ?>/id/"+bundleid+"/rate/"+corta[1];
               
                
                var fileDropzone = new Dropzone("#sdzone_listageneral",{
                        addRemoveLinks : false,
                        maxFilesize: 200,
                        dictResponseError: 'Error uploading file!',
                        dictDefaultMessage : 'Arrastre sus archivos aqui (o de click)'
                    }); //Inicializamos el dropzone

                   fileDropzone.on('success',function(file,data){

                        var data = JSON.parse(data);
                        alert("Archivo Cargado Correctamente");
                         chargin_file_supply=1;
                          $("#newproject").find("#sendproject").show();
                            $("#newproject").find("#sdzone_listageneral").hide();
                           $("#newproject").find("#head_s").find("strong").html( "Archivo de Cotizacion cargado correctamente");
                           $("#newproject").find("#head_s").show();
                        fileDropzone.removeFile(file);
                   });
                 $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/files_char') ?>',{'rateid':rateid }, function(response){
					
					 if(response==1){
                                              $("#newproject").find("#head_s").find("strong").html( "Ya se a cargado un archivo de cotizacion");
                                              $("#newproject").find("#head_s").show();
                                              $("#newproject").find("#sendproject").show();
                                                  $("#newproject").find("#sdzone_listageneral").hide();
                                                }else{
                                                $("#newproject").find("#sdzone_listageneral").show();
                                                 
                                                }   
                 });
                   
                
                //action="index.php?r=supply/upload/savefile/id/<?php //echo Utils::encrypt($model->bundleid, 'document'); ?>/rate/<?php //echo Utils::encrypt($model->rateid, 'document'); ?>"
        
            }      
         
            $("#sendproject").click( function(){   
                var bandera=0;
                var bandera1=0;
                var valid=0;
                var valid1=0;
                var integrador= { }; 
              
                for(i=1;i<temp_var_qual+1;i++){
                        valid=valid_expresion_form("quantity_"+i+"_pric");
                        if(valid==1){
                                bandera=1;
                            }else{
                                
                               integrador["quantity_"+i]= $("#nproyect_pric_tb").find("#quantity_"+i+"_pric").val();  
                         }
                          valid1=valid_expresion_form("NT_daysproduction"+i+"_enu");
                         if(valid1==1){
                                bandera1=1;
                            }else{
                                
                               integrador["daysproduction"+i]= $("#nproyect_pric_tb").find("#NT_daysproduction"+i+"_enu").val();  
                         }
                         
                }
              
                integrador["statusid"]= $("#nproyect_pric_tb").find("#quantity_1_pric").data("status");
                integrador["ratesupplierid"]= $("#nproyect_pric_tb").find("#quantity_1_pric").data("id"); 
                	
            if(bandera==0 && bandera1==0){
                 $.post('<?php echo Yii::app()->createAbsoluteUrl('supply/rate/price_state') ?>',{'arrai':integrador }, function(response){
					
					 if(response==0){
                                                    alert('No se a podido cambiar el estatus.');
                                                }else{
                                                
                                                   alert('Se a ingresado el precio correctamente.');
                                                     $('#nproyect_pric').modal('hide');
                                                    location.reload();
                                                    
                                                }   
                 });
             }else{
				alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
				
            }
               
            });   
            
            function respon_cot(id){
              
               var status= $("#"+id).data("status");
               var ids= $("#"+id).data("id");
            
               
              
                $("#nproyect_recha").find("#declinereason").data("status",status);
                $("#nproyect_recha").find("#declinereason").data("supplierid",ids);
            }  
            
            $("#sendrecha").click( function(){
                var status= $("#nproyect_recha").find("#declinereason").data("status");
                var ids= $("#nproyect_recha").find("#declinereason").data("supplierid");
                var txt= $("#nproyect_recha").find("#declinereason").val();
             if(txt!=''){
               $.post('<?php echo Yii::app()->createAbsoluteUrl('supply/rate/chan_state') ?>',{stateid:status, id:ids, txts:txt  }, function(response){
						
			if(response==0){
                            alert('No se a podido cambiar el estatus.');
                        }else{
                            alert('Se cambiado el estatus correctamente.');
                            $('#nproyect_pric').modal('hide');
                            location.reload();
                        }   
                });
                
             }else{
				alert('El campo Motivo es obligatorio');
				
                }
               
              
           
           });
        function create_pdf(id){
        	  var ids= $("#"+id).data("rate");
                  var tipo= $("#"+id).data("tipo");
                  if(tipo==1){
                     window.location = "?r=supply/pdf/odc/id/"+ids;
                  }else{
                    window.location = "?r=supply/pdf/odp/id/"+ids;
                  }
           }

</script>
