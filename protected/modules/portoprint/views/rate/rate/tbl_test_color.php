<?php
    $title = ($op==1)?"Cambios de arte.":"Prueba de color.";
    
?>

<script>
   
     function nuevo_testcolor_<?php  echo $model->rateid;?>(x){
     
        var cadena=x;
        var ratechangeartid=$("#rate_testcolor_"+cadena).find("#creat_testcolor_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#rate_testcolor_"+cadena).find("#creat_testcolor_"+cadena).data("ratechangeartnumber");
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
        $("#rate_testcolor_"+cadena).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#rate_testcolor_"+cadena).find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena||div[0]==cadena+'tstc'){
                                        
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                     if ( $("#rate_testcolor_"+cadena).find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.name]=1;
                                       
                                    } else{
                                          integrador[elemento.name]=0;
                                    }
                                   
                               }else{
                                 if( $("#rate_testcolor_"+cadena).find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#rate_testcolor_"+cadena).find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                          
                      
                             
                              
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/createtestcolorregis') ?>', {'arrai':integrador}, function(response){
                                        
                                        if(response != 0){
                                            var response1=response.split(',');
                                            var line= ' <a href="#Hist_testcolor_'+cadena+'" class="btn btn-sm btn-success" id="lis2_testcolor_'+cadena+'_'+ratechangeartid+'" data-ratecolortestid="'+response1[0]+'" onclick="modal_lista_testcolor_'+cadena+'('+ratechangeartid+','+ratechangeartnumber+','+cadena+',1)"  data-target="#Hist_testcolor_'+cadena+'"  data-toggle="modal" >'
                                                        + '<span class="glyphicon glyphicon-ok"></span>'
                                                        + '</a>';
                                                $("#testcolor_color_<?php echo $model->rateid.'_'.$st.'_'.$op ?>").find("#boton_artes_iden_"+cadena).html(line);
                                                alert('Se guardo la informacion correctamente.');
                                                limpiar_modal_testcolor_<?php echo $model->rateid;?>(cadena);
                                              $('#rate_testcolor_'+cadena).modal('hide');
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                          
        
    }
   
     function actualizar_arte_<?php  echo $model->rateid;?>(x){
        var cadena=x;
        var ratechangeartid=$("#rate_testcolor_"+cadena).find("#creat_testcolor_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#rate_testcolor_"+cadena).find("#creat_testcolor_"+cadena).data("ratechangeartnumber");
        var ratecolortestid=$("#lis2_testcolor_"+cadena+"_"+ratechangeartid).data("ratecolortestid");
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
            integrador['ratecolortestid']=ratecolortestid;
            
        $("#rate_testcolor_"+cadena).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#rate_testcolor_"+cadena).find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena || div[0]==cadena+'tstc' ){
                                       
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                     if ( $("#rate_testcolor_"+cadena).find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.id]=1;
                                       
                                    } else{
                                          integrador[elemento.id]=0;
                                    }
                                   
                               }else{
                                 if( $("#rate_testcolor_"+cadena).find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#rate_testcolor_"+cadena).find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                         
                         
                                
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/updatetestcolorregis') ?>', {'arrai':integrador}, function(response){
                                      
                                        if(response != 0){
                                         
                                                 alert('Se actualizo la informacion correctamente');
                                                   limpiar_modal_testcolor_<?php echo $model->rateid;?>(cadena);
                                              $('#rate_testcolor_'+cadena).modal('hide');
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                          
        
    } 
 
    
    </script>

<section class="smart-form">
    <header>
        <strong><?php echo $title; ?></strong>
    </header>
    <table id="testcolor_color_<?php echo $model->rateid.'_'.$st.'_'.$op ?>" class="items table table-condensed rating_table">
        <thead>
            <tr>
                <th width="40%"><?php echo $title; ?></th>
                <th width="30%" style="text-align:center">Cantidad</th>
                <th width="30%" style="text-align:center">Detalles</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $changeart = Ratechangeart::model()->findAllByAttributes(array('rateid' => $model->rateid));
           
             $list_menu= Permission::model()->findAllByAttributes(array('menuid'=>$menu,'permissiongroup'=>'Prueba_de_color'));
              
              foreach($list_menu as $row){
                            if($row->permissiondsc=="Agregar"){
                                $agregar= Specialpermission::model()->findAllByAttributes(array('userid'=>Yii::app()->user->userid, 'permissionid'=>$row->permissionid ));
                                
                            }
                             if($row->permissiondsc=="Editar"){
                                $editar= Specialpermission::model()->findAllByAttributes(array('userid'=>Yii::app()->user->userid, 'permissionid'=>$row->permissionid));
                                
                            }
                           
                      }
                
                   
              if(count($editar)!=0 &&  $editar[0]['active']==1){
                  $editable="";
              }else{
                   $editable="disabled";
              }
            
            
            if($st=='close'){
                if($op==2){
                    if (count($changeart) > 0) {
                        foreach ($changeart as $fila) {
                             $rateartes= Ratecolortest::model()->findAllByAttributes(array('rateid' => $model->rateid,'ratechangeartid' => $fila->ratechangeartid));
                                $cadena= '<tr>'
                                . '<td style="text-align:left">' . $fila->ratechangeartname . '</td>'
                                . '<td style="text-align:center">' . $fila->ratechangeartnumber . '</td>'
                                . '<td style="text-align:center" id="boton_artes_iden_'.$model->rateid.'">';
                              if(count($rateartes)==0){
                                 if(count($agregar)>0 && $agregar[0]['active']==1){   
                                    $cadena.= ' <a href="#Detailtestcolor_'.$model->rateid.'" class="btn btn-sm btn-primary" id="lisd_testcolor_'.$model->rateid.'_'.$fila->ratechangeartid.'"  onclick="modal_alt_testcolor_'.$model->rateid.'('.$fila->ratechangeartid.','.$fila->ratechangeartnumber.','.$model->rateid.',0)"  data-target="#Detailtestcolor_'.$model->rateid.'"  data-toggle="modal" >'
                                    . '<span class="glyphicon glyphicon-cog"></span>'
                                    . '</a>';
                                 }
                                
                              }else{
                                   $cadena.= ' <a href="#Hist_testcolor_'.$model->rateid.'" class="btn btn-sm btn-success" data-ratecolortestid="'.$rateartes[0]['ratecolortestid'].'"  id="lis2_testcolor_'.$model->rateid.'_'.$fila->ratechangeartid.'" onclick="modal_lista_testcolor_'.$model->rateid.'('.$fila->ratechangeartid.','.$fila->ratechangeartnumber.','.$model->rateid.',1)"  data-target="#Hist_testcolor_'.$model->rateid.'"  data-toggle="modal" >'
                                . '<span class="glyphicon glyphicon-ok"></span>'
                                . '</a>';
                              }
                                $cadena.= '</td>'
                                . '</tr>';
                            
                        }
                         echo $cadena;
                    } else 

                     {
                        $rate = Rate::model()->findAllByAttributes(array('rateid' => $model->rateid));

                        foreach ($rate as $fila) {
                              $rateartes= Ratecolortest::model()->findAllByAttributes(array('rateid' => $model->rateid,'ratechangeartid' => 0));
                              
                            if ($fila->quantityselect > 0) {
                               $cadena= '<tr>'
                                . '<td style="text-align:left">Cantidad Total</td>'
                                . '<td style="text-align:center">' . $fila->quantityselect . '</td>'
                                . '<td style="text-align:center" id="boton_artes_iden_'.$model->rateid.'">';
                                if(count($rateartes)==0){
                                      if(count($agregar)>0 && $agregar[0]['active']==1){   
                                            $cadena.= '<a href="#Detailtestcolor_'.$model->rateid.'" class="btn btn-sm btn-primary"  id="lisd_testcolor_'.$model->rateid.'_0"  onclick="modal_alt_testcolor_'.$model->rateid.'(0,'.$fila->quantityselect.','.$model->rateid.',0)"  data-target="#Detailtestcolor_'.$model->rateid.'"  data-toggle="modal"   >'
                                            . '<span class="glyphicon glyphicon-cog"></span>'
                                            . '</a>';
                                      }
                                 }else{
                                       $cadena.= ' <a href="#Hist_testcolor_'.$model->rateid.'" class="btn btn-sm btn-success" id="lis2_testcolor_'.$model->rateid.'_0" data-ratecolortestid="'.$rateartes[0]['ratecolortestid'].'" onclick="modal_lista_testcolor_'.$model->rateid.'(0,'.$fila->quantityselect.','.$model->rateid.',1)"  data-target="#Hist_testcolor_'.$model->rateid.'"  data-toggle="modal" >'
                                    . '<span class="glyphicon glyphicon-ok"></span>'
                                    . '</a>';
                                }
                               $cadena.= '</td>'
                                . '</tr>';
                            }
                        }
                          echo $cadena;
                    }
                }
               
              }
       
            ?>
        </tbody>
    </table>
</section>


<div class="modal fade" id="Detailtestcolor_<?php  echo $model->rateid;?>"  tabindex="-1" role="dialog" aria-labelledby="Detailtestcolor_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de Prueba de Color</h4>
      </div>
      <div class="modal-body no-padding" >
        <form method="post" action="#"  id="rate_testcolor_<?php echo $model->rateid; ?>" novalidate="novalidate" class="smart-form">
		<fieldset>
            <table cellspacing="2" border="0"   class="table table-bordered">
			<tbody><tr>
				<td width="120">Fecha de elaboración</td>
				<td width="200">
                                  <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>
                                     <input type="text" name="<?php  echo $rateid;?>_productiondate_daty" id="<?php  echo $rateid;?>tstc_productiondate_daty"  value="" >
                                  </label>
                                </td>
				<td width="120">Tipo de prueba de color</td>
				<td width="200"><input type="text" id="<?php  echo $rateid;?>tstc_testcolortype_dsc" value=""></td>
			</tr>
			<tr>
				<td>Quién elaboró</td>
				<td><input type="text" id="<?php  echo $rateid;?>tstc_production_dsc" value=""></td>
				<td>Fecha de entrega de mensajería</td>
				<td>
                                  <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>  
                                    <input type="text" name="<?php  echo $rateid;?>_courierdeliverydate_daty" id="<?php  echo $rateid;?>tstc_courierdeliverydate_daty"  value="" >
                                  </label>
                                </td>
			</tr>
			<tr>
				<td>Quien recibe mensajería</td>
				<td><input type="text" id="<?php  echo $rateid;?>tstc_receivercourier_dsc"  value=""></td>
				<td>Fecha de entrega a cliente</td>
				<td>
                                    <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="cutomerDeliveryDate" id="<?php  echo $rateid;?>tstc_cutomerdeliverydate_daty"  value="" >
                                    </label>
                                </td>
			</tr>
			<tr>
				<td>Quien recibe cliente</td>
				<td><input type="text"  id="<?php  echo $rateid;?>tstc_receivercustomer_dsc" value=""></td>
				<td>Fecha de entrega a proveedor</td>
				<td>
                                   <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="supplierDeliveryDate" id="<?php  echo $rateid;?>tstc_supplierdeliverydate_daty"  value="" >
                                   </label>
                                </td>
			</tr>
			<tr>
				<td>La prueba fue autorizada </td>
				<td>Si <input type="radio" name="authorizationtest" id="authorizationtest_1" value="1"> &nbsp;&nbsp;&nbsp; No <input type="radio" id="authorizationtest_2" name="authorizationtest" value="0" checked="'checked'"></td>
				<td>Motivo de rechazo</td>
				<td><input type="text"  id="<?php  echo $rateid;?>tstc_rejectreason_dsc" value=""></td>
			</tr>
			<tr>
				<td>Observaciones</td>
				<td><input type="text"  id="<?php  echo $rateid;?>tstc_comments_dsc" value=""></td>
				<td>Fecha de autorización de modificación</td>
				<td>
                                  <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" id="<?php  echo $rateid;?>tstc_authorizationdate_daty" name="authorizationDate"  value="" >
                                  </label>
                                </td>
			</tr>											
			<tr>
				<td colspan="4" align="center">&nbsp;
				<input type="hidden" name="rateid" value="">
				<input type="hidden" name="ratecolortestid" value="">
				</td>
			</tr>
		</tbody>
            </table>
        </fieldset>
        <footer>
                        <button class="btn btn-primary" type="button" data-dismiss="modal" id="creat_testcolor_<?php  echo $model->rateid;?>" onclick="nuevo_testcolor_<?php echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Generar</button>
                        <!--<button class="btn btn-primary" type="button" data-dismiss="modal" id="update_testcolor_<?php  echo $model->rateid;?>" onclick="actualizar_arte_<?php  echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Actualizar</button>-->
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
</form>

 </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!------------------------------------------------ LISTA HISTORICOS ----------------------------------------------------------------------->


<div class="modal fade" id="Hist_testcolor_<?php  echo $model->rateid;?>"  tabindex="-1" role="dialog" aria-labelledby="Hist_testcolor_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de Prueba de Color</h4>
      </div>
      <div class="modal-body no-padding" >
        <div  id="hist_testcolor_for<?php echo $model->rateid; ?>" novalidate="novalidate" class="smart-form" style=" height: 250px;">
            
            <h3><i class='glyphicon glyphicon-chevron-right'></i>&nbsp;Historial  <button class="btn btn-sm btn-primary" style=" position: inherit; left: 500px;" type="button"  id="new_testcolor_<?php  echo $model->rateid;?>" onclick="limpiar_modal_edit_testcolor_<?php echo $model->rateid;?>('<?php  echo $model->rateid;?>')"><i class='glyphicon glyphicon-plus-sign'></i>&nbsp;Nuevo</button></h3>
            <div id="Detal_testcolor_h<?php  echo $model->rateid;?>_1" style=" ">	
                <table cellspacing="2" border="0"   class="items table table-condensed rating_table" style="width: 50%;">
                    <thead>
                        <th style=" width: 20px; text-align: center;">ID</th>
                         <th style=" width: 90px; text-align: center;">Descripcion Cambio/Total</th>
                         <th style=" width: 20px; text-align: center;">Cantidad</th>
                        <th style=" width: 90px; text-align: center;">Fecha</th>
                        <th style=" width: 20px; text-align: center;">Detalle</th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            
            <h3><i class='glyphicon glyphicon-chevron-right'></i>&nbsp;Formulario</h3>
            <div id="Detal_testcolor_h<?php  echo $model->rateid;?>_2" style="">

                 <table cellspacing="2" border="0"   class="table table-bordered">
			<tbody><tr>
				<td width="120">Fecha de elaboración</td>
				<td width="200">
                                    <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="productionDate" id="<?php  echo $rateid;?>test_productiondate_daty"  value="" >
                                    </label>
                                </td>
				<td width="120">Tipo de prueba de color</td>
				<td width="200"><input type="text" id="<?php  echo $rateid;?>test_testcolortype_dsc" value=""></td>
			</tr>
			<tr>
				<td>Quién elaboró</td>
				<td><input type="text" id="<?php  echo $rateid;?>test_production_dsc" value=""></td>
				<td>Fecha de entrega de mensajería</td>
				<td>
                                  <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="courierDeliveryDate" id="<?php  echo $rateid;?>test_courierdeliverydate_daty"  value="" >
                                  </label>
                                </td>
			</tr>
			<tr>
				<td>Quien recibe mensajería</td>
				<td><input type="text" id="<?php  echo $rateid;?>test_receivercourier_dsc"  value=""></td>
				<td>Fecha de entrega a cliente</td>
				<td>
                                  <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="cutomerDeliveryDate" id="<?php  echo $rateid;?>test_cutomerdeliverydate_daty"  value="" >
                                    </label>
                                    </td>
			</tr>
			<tr>
				<td>Quien recibe cliente</td>
				<td><input type="text"  id="<?php  echo $rateid;?>test_receivercustomer_dsc" value=""></td>
				<td>Fecha de entrega a proveedor</td>
				<td>
                                    <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="supplierDeliveryDate" id="<?php  echo $rateid;?>test_supplierdeliverydate_daty"  value="" >
                                    </label>
                                </td>
			</tr>
			<tr>
				<td>La prueba fue autorizada </td>
				<td>Si <input type="radio" name="authorizationtest" id="authorizationtest_1" value="TRUE"> &nbsp;&nbsp;&nbsp; No <input type="radio" id="authorizationtest_2" name="authorizationtest" value="FALSE" checked="'checked'"></td>
				<td>Motivo de rechazo</td>
				<td><input type="text"  id="<?php  echo $rateid;?>test_rejectreason_dsc" value=""></td>
			</tr>
			<tr>
				<td>Observaciones</td>
				<td><input type="text"  id="<?php  echo $rateid;?>test_comments_dsc" value=""></td>
				<td>Fecha de autorización de modificación</td>
				<td>
                                  <label class="input" > 
                                   <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" id="<?php  echo $rateid;?>test_authorizationdate_daty" name="authorizationDate"  value="" >
                                  </label>
                                </td>
			</tr>											
			<tr>
				<td colspan="4" align="center">&nbsp;
				<input type="hidden" name="rateid" value="">
				<input type="hidden" name="ratecolortestid" value="">
				</td>
			</tr>
		</tbody>
            </table>
                <input type="hidden" name="ratecolortestid" value="">
            <footer>
                        <button class="btn btn-primary" type="button"  id="creat_testcolor_edit_<?php  echo $model->rateid;?>" onclick="nuevo_testcolor_edit_<?php echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Generar</button>
                	<button class="btn btn-primary" type="button"  id="update_testcolor_edit_<?php  echo $model->rateid;?>" onclick="actualizar_arte_edit_<?php  echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Actualizar</button>
			<button  class="btn btn-default" type="button" onclick="limpiar_modal_cancel_testcolor_<?php  echo $model->rateid;?>('<?php  echo $model->rateid;?>')" >Cancelar</button>			
	     </footer>
</div>
        
</div>

 </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    
                    
     function modal_alt_testcolor_<?php echo $model->rateid;?>(ratechangeartid,ratechangeartnumber,rateid,exists){
         
                   
                    $("#rate_testcolor_<?php echo $model->rateid; ?>").find("#creat_testcolor_"+rateid).hide();
                    $("#rate_testcolor_<?php echo $model->rateid; ?>").find("#update_testcolor_"+rateid).hide();

                    $("#rate_testcolor_<?php echo $model->rateid; ?>").find('#<?php echo $model->rateid; ?>tstc_productiondate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#rate_testcolor_<?php echo $model->rateid; ?>").find('#<?php echo $model->rateid; ?>tstc_courierdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#rate_testcolor_<?php echo $model->rateid; ?>").find('#<?php echo $model->rateid; ?>tstc_cutomerdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                        $("#rate_testcolor_<?php echo $model->rateid; ?>").find('#<?php echo $model->rateid; ?>tstc_supplierdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                        $("#rate_testcolor_<?php echo $model->rateid; ?>").find('#<?php echo $model->rateid; ?>tstc_authorizationdate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });

                        if(exists==1){
                            $("#rate_testcolor_"+rateid).find("#creat_testcolor_"+rateid).hide();
                            $("#rate_testcolor_"+rateid).find("#update_testcolor_"+rateid).show();
                           
                            var ratecolortestid=$("#lis2_testcolor_"+rateid+"_"+ratechangeartid).data("ratecolortestid");
                            
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listatestcolor') ?>', {'ratecolortestid':ratecolortestid}, function(response){
                                          var obj = JSON.parse(response);
                                        
                                         $("#rate_testcolor_"+rateid).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                                                 var elemento= this;
                                                  var tipo= $("#rate_testcolor_"+rateid).find("#"+elemento.id).attr("type");
                                                  
                                                    if(tipo=="text"||tipo=="number"){
                                                         var div=elemento.id.split('_');
                                                            $.each(obj, function (ind, elem) { 
                                                                 if(div[1]==ind){
                                                                     if(div[2]!="enu"){
                                                                         $("#rate_testcolor_"+rateid).find("#"+elemento.id).attr("value",elem);
                                                                     }else{
                                                                          $("#rate_testcolor_"+rateid).find("#"+elemento.id).attr("value",parseInt(elem));
                                                                     }

                                                                }
                                                            }); 
                                                     }else if(tipo=="checkbox"){
                                                         $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                   
                                                                      $("#rate_testcolor_"+rateid).find("#"+elemento.id).prop("checked", true);

                                                                     } 
                                                            }); 
                                                       }else{
                                                            
                                                           $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                   
                                                                      $("#rate_testcolor_"+rateid).find("#authorizationtest_1").prop("checked", true);
                                                                       $("#rate_testcolor_"+rateid).find("#authorizationtest_2").prop("checked", false);
                                                               }else if(ind == elemento.name && elem == 0){
                                                                   $("#rate_testcolor_"+rateid).find("#authorizationtest_1").prop("checked", false);
                                                                   $("#rate_testcolor_"+rateid).find("#authorizationtest_2").prop("checked", true); 
                                                               }
                                                            }); 
                                                           
                                                       }

                                               });


                                 });
                            
                            
                        }else{
                            $("#rate_testcolor_"+rateid).find("#creat_testcolor_"+rateid).show();
                            $("#rate_testcolor_"+rateid).find("#update_testcolor_"+rateid).hide();
                        }
                    
                $("#rate_testcolor_"+rateid).find("#creat_testcolor_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#rate_testcolor_"+rateid).find("#update_testcolor_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#rate_testcolor_"+rateid).find("#creat_testcolor_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);
                $("#rate_testcolor_"+rateid).find("#update_testcolor_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);   
              
         
     }
 
     function modal_lista_testcolor_<?php echo $model->rateid;?>(ratechangeartid,ratechangeartnumber,rateid,exists){
                    
                    $("#hist_testcolor_for"+rateid ).accordion();
                      $("#hist_testcolor_for"+rateid ).find("#Detal_testcolor_h"+rateid+"_1").css("height","190px");
                       $("#hist_testcolor_for"+rateid ).find("#Detal_testcolor_h"+rateid+"_1").css("over-flow-y","auto");
                        $("#hist_testcolor_for"+rateid ).find("#Detal_testcolor_h"+rateid+"_2").css("height","430px");
                   
                  
                    $("#Hist_testcolor_"+rateid).find("#Detal_testcolor_h"+rateid+"_2").hide();    
                    $("#Hist_testcolor_"+rateid).find("#creat_testcolor_"+rateid).hide();
                    $("#Hist_testcolor_"+rateid).find("#update_testcolor_"+rateid).hide();
                    
                    
                        $("#Hist_testcolor_"+rateid).find('#<?php echo $model->rateid; ?>test_productiondate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#Hist_testcolor_"+rateid).find('#<?php echo $model->rateid; ?>test_courierdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#Hist_testcolor_"+rateid).find('#<?php echo $model->rateid; ?>test_cutomerdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                        $("#Hist_testcolor_"+rateid).find('#<?php echo $model->rateid; ?>test_supplierdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                       $("#Hist_testcolor_"+rateid).find('#<?php echo $model->rateid; ?>test_authorizationdate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                    
                    

                 
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listahistotestcolor') ?>', {'ratechangeartid':ratechangeartid, 'rateid':rateid }, function(response){
                                
                                if(response!=0){
                                      $("#Hist_testcolor_"+rateid).find("#Detal_testcolor_h"+rateid+"_1").find("table tbody").html(response);    
                                }
                            
                            });
                            
                       
                    
                $("#Detal_testcolor_h"+rateid+"_2").find("#creat_testcolor_edit_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#Detal_testcolor_h"+rateid+"_2").find("#update_testcolor_edit_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#Detal_testcolor_h"+rateid+"_2").find("#creat_testcolor_edit_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);
                $("#Detal_testcolor_h"+rateid+"_2").find("#update_testcolor_edit_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);   
              
         
     }
     
    function selec_hist_testcolor(ratecolortestid,rateid){
        
        $("#Detal_testcolor_h"+rateid+"_1").hide();
        $("#Detal_testcolor_h"+rateid+"_2").show();
        $("#Hist_testcolor_"+rateid).find("#creat_testcolor_edit_"+rateid).hide();
         $("#Hist_testcolor_"+rateid).find("#update_testcolor_edit_"+rateid).show();
         $("#Hist_testcolor_"+rateid).find("#update_testcolor_edit_"+rateid).attr("data-ratecolortestid",ratecolortestid);
        
          $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listatestcolor') ?>', {'ratecolortestid':ratecolortestid}, function(response){
                                          var obj = JSON.parse(response);
                                        
                                         $("#Detal_testcolor_h"+rateid+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                                                 var elemento= this;
                                                  var tipo= $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).attr("type");
                                                  
                                                    if(tipo=="text"||tipo=="number"){
                                                        
                                                         var div=elemento.id.split('_');
                                                            $.each(obj, function (ind, elem) { 
                                                                 if(div[1]==ind){
                                                                     
                                                                
                                                                     if(div[2]!="enu"){
                                                                     
                                                                         $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).attr("value",elem);
                                                                         $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).val(elem);
                                                                     }else{
                                                                         
                                                                          $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).attr("value",parseInt(elem));
                                                                          $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).val(parseInt(elem));
                                                                     }

                                                                }
                                                            }); 
                                                     }else if(tipo=="checkbox"){
                                                         $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                    
                                                                      $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).prop("checked", true);

                                                                     } 
                                                            }); 
                                                       }else{
                                                            
                                                           $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                   
                                                                      $("#Detal_testcolor_h"+rateid+"_2").find("#authorizationtest_1").prop("checked", true);
                                                                       $("#Detal_testcolor_h"+rateid+"_2").find("#authorizationtest_2").prop("checked", false);
                                                               }else if(ind == elemento.name && elem == 0){
                                                                   $("#Detal_testcolor_h"+rateid+"_2").find("#authorizationtest_1").prop("checked", false);
                                                                   $("#Detal_testcolor_h"+rateid+"_2").find("#authorizationtest_2").prop("checked", true); 
                                                               }
                                                            }); 
                                                           
                                                       }

                                               });


                                 });    
        
    }
     
     function limpiar_modal_testcolor_<?php echo $model->rateid;?>(rateid){
     
            $("#rate_testcolor_"+rateid).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                    var elemento= this;
                    var tipo= $("#rate_testcolor_"+rateid).find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                       $("#rate_testcolor_"+rateid).find("#"+elemento.id).attr("value","");
                           
                     }else if(tipo=="checkbox"){
                         $("#rate_testcolor_"+rateid).find("#"+elemento.id).prop("checked", false);
                       }else{
                          if(elemento.id=="authorizationtest_1"){
                                $("#rate_testcolor_"+rateid).find("#"+elemento.id).prop("checked", false);
                          }else  if(elemento.id=="authorizationtest_2"){
                              $("#rate_testcolor_"+rateid).find("#"+elemento.id).prop("checked", true);
                          } 
                         
                       }
                    
            });
     
     }
     
     function limpiar_modal_edit_testcolor_<?php echo $model->rateid;?>(rateid){
     
            $("#Detal_testcolor_h"+rateid+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                    var elemento= this;
                    var tipo= $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                       $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).attr("value","");
                           
                     }else if(tipo=="checkbox"){
                         $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                       }else{
                          if(elemento.id=="authorizationtest_1"){
                                $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                          }else  if(elemento.id=="authorizationtest_2"){
                              $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).prop("checked", true);
                          } 
                         
                       }
                    
            });
            $("#Detal_testcolor_h"+rateid+"_1").hide();
            $("#Detal_testcolor_h"+rateid+"_2").show(); 
            $("#Detal_testcolor_h"+rateid+"_2").find("#creat_testcolor_edit_"+rateid).show();
            $("#Detal_testcolor_h"+rateid+"_2").find("#update_testcolor_edit_"+rateid).hide();
     
     }
     
      function limpiar_modal_cancel_testcolor_<?php echo $model->rateid;?>(rateid){
     
            $("#Detal_testcolor_h"+rateid+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                    var elemento= this;
                    var tipo= $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                        
                       $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).attr("value","");
                         $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).val("");
                           
                     }else if(tipo=="checkbox"){
                         $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                       }else{
                          if(elemento.id=="authorizationtest_1"){
                                $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                          }else  if(elemento.id=="authorizationtest_2"){
                              $("#Detal_testcolor_h"+rateid+"_2").find("#"+elemento.id).prop("checked", true);
                          } 
                         
                       }
                    
            });
            $("#Detal_testcolor_h"+rateid+"_1").show();
            $("#Detal_testcolor_h"+rateid+"_2").hide(); 
            $("#Detal_testcolor_h"+rateid+"_2").find("#creat_testcolor_edit_"+rateid).hide();
            $("#Detal_testcolor_h"+rateid+"_2").find("#update_testcolor_edit_"+rateid).hide();
     
     }
     
     
     function nuevo_testcolor_edit_<?php  echo $model->rateid;?>(x){
     
        var cadena=x;
        var ratechangeartid=$("#Detal_testcolor_h"+cadena+"_2").find("#creat_testcolor_edit_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#Detal_testcolor_h"+cadena+"_2").find("#creat_testcolor_edit_"+cadena).data("ratechangeartnumber");
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
       
        $("#Detal_testcolor_h"+cadena+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#Detal_testcolor_h"+cadena+"_2").find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena ||div[0]==cadena+'test'  ){
                                       // valid=valid_expresion_form(elemento.id);
                                       
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                   
                                     if ( $("#Detal_testcolor_h"+cadena+"_2").find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.name]=1;
                                       
                                    } else{
                                          integrador[elemento.name]=0;
                                    }
                                   
                               }else{
                                 if( $("#Detal_testcolor_h"+cadena+"_2").find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#Detal_testcolor_h"+cadena+"_2").find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                       
                          
                       
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/createtestcolorregis') ?>', {'arrai':integrador}, function(response){
                                        
                                        if(response != 0){
                                            
                                             $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listahistotestcolor') ?>', {'ratechangeartid':ratechangeartid, 'rateid':cadena }, function(result){

                                                    if(result!=0){
                                                          $("#Hist_testcolor_"+cadena).find("#Detal_testcolor_h"+cadena+"_1").find("table tbody").html(result);    
                                                    }

                                                });
                                           
                                           
                                                alert('Se guardo la informacion correctamente.');
                                                limpiar_modal_cancel_testcolor_<?php echo $model->rateid;?>(cadena);
                                                 $("#Hist_testcolor_"+cadena).find("#Detal_testcolor_h"+cadena+"_1").show();  
                                                $("#Hist_testcolor_"+cadena).find("#Detal_testcolor_h"+cadena+"_2").hide();    
                                              //$('#rate_testcolor_'+cadena).modal('hide');
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                           
        
    }
   
     function actualizar_arte_edit_<?php  echo $model->rateid;?>(x){
        var cadena=x;
        var ratechangeartid=$("#Detal_testcolor_h"+cadena+"_2").find("#update_testcolor_edit_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#Detal_testcolor_h"+cadena+"_2").find("#update_testcolor_edit_"+cadena).data("ratechangeartnumber");
        var ratecolortestid=$("#Detal_testcolor_h"+cadena+"_2").find("#update_testcolor_edit_"+cadena).data("ratecolortestid")
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
            integrador['ratecolortestid']=ratecolortestid;
            
        $("#Detal_testcolor_h"+cadena+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#Detal_testcolor_h"+cadena+"_2").find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena||div[0]==cadena+'test'){
                                      
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                     if ( $("#Detal_testcolor_h"+cadena+"_2").find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.name]=1;
                                       
                                    } else{
                                          integrador[elemento.name]=0;
                                    }
                                   
                               }else{
                                 if( $("#Detal_testcolor_h"+cadena+"_2").find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#Detal_testcolor_h"+cadena+"_2").find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                        
                          
                      
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/updatetestcolorregis') ?>', {'arrai':integrador}, function(response){
                                      
                                        if(response != 0){
                                                    
                                                     $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listahistotestcolor') ?>', {'ratechangeartid':ratechangeartid, 'rateid':cadena }, function(result){

                                                          if(result!=0){
                                                                $("#Hist_testcolor_"+cadena).find("#Detal_testcolor_h"+cadena+"_1").find("table tbody").html(result);    
                                                          }

                                                      });
                                         
                                                 alert('Se actualizo la informacion correctamente');
                                                 limpiar_modal_cancel_testcolor_<?php echo $model->rateid;?>(cadena);
                                                 $("#Hist_testcolor_"+cadena).find("#Detal_testcolor_h"+cadena+"_1").show();  
                                                $("#Hist_testcolor_"+cadena).find("#Detal_testcolor_h"+cadena+"_2").hide();    
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                          
        
    } 
     
     
</script>