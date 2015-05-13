<?php
    $title = "Prueba Cero";
    
?>

<script>
   
     function nuevo_zerotest_<?php  echo $model->rateid;?>(x){
     
        var cadena=x;
        var ratechangeartid=$("#rate_zerotest_"+cadena).find("#creat_zerotest_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#rate_zerotest_"+cadena).find("#creat_zerotest_"+cadena).data("ratechangeartnumber");
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
        $("#rate_zerotest_"+cadena).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#rate_zerotest_"+cadena).find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena||div[0]==cadena+'zetet'){
                                        
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                     if ( $("#rate_zerotest_"+cadena).find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.name]=1;
                                       
                                    } else{
                                          integrador[elemento.name]=0;
                                    }
                                   
                               }else{
                                 if( $("#rate_zerotest_"+cadena).find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#rate_zerotest_"+cadena).find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                          
                      
                           
                              
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/createzerotestregis') ?>', {'arrai':integrador}, function(response){
                                        
                                        if(response != 0){
                                            var response1=response.split(',');
                                            var line= ' <a href="#Hist_zerotest_'+cadena+'" class="btn btn-sm btn-success" id="lis2_zerotest_'+cadena+'_'+ratechangeartid+'" data-ratezerotestid="'+response1[0]+'" onclick="modal_lista_zerotest_'+cadena+'('+ratechangeartid+','+ratechangeartnumber+','+cadena+',1)"  data-target="#Hist_zerotest_'+cadena+'"  data-toggle="modal" >'
                                                        + '<span class="glyphicon glyphicon-ok"></span>'
                                                        + '</a>';
                                                $("#zerotest_color_<?php echo $model->rateid.'_'.$st.'_'.$op ?>").find("#boton_artes_iden_"+cadena).html(line);
                                                alert('Se guardo la informacion correctamente.');
                                                limpiar_modal_zerotest_<?php echo $model->rateid;?>(cadena);
                                              $('#rate_zerotest_'+cadena).modal('hide');
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                          
        
    }
   
     function actualizar_arte_<?php  echo $model->rateid;?>(x){
        var cadena=x;
        var ratechangeartid=$("#rate_zerotest_"+cadena).find("#creat_zerotest_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#rate_zerotest_"+cadena).find("#creat_zerotest_"+cadena).data("ratechangeartnumber");
        var ratezerotestid=$("#lis2_zerotest_"+cadena+"_"+ratechangeartid).data("ratezerotestid");
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
            integrador['ratezerotestid']=ratezerotestid;
            
        $("#rate_zerotest_"+cadena).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#rate_zerotest_"+cadena).find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena || div[0]==cadena+'zetet' ){
                                       
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                     if ( $("#rate_zerotest_"+cadena).find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.id]=1;
                                       
                                    } else{
                                          integrador[elemento.id]=0;
                                    }
                                   
                               }else{
                                 if( $("#rate_zerotest_"+cadena).find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#rate_zerotest_"+cadena).find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                         
                         
                                
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/updatezerotestregis') ?>', {'arrai':integrador}, function(response){
                                      
                                        if(response != 0){
                                         
                                                 alert('Se actualizo la informacion correctamente');
                                                   limpiar_modal_zerotest_<?php echo $model->rateid;?>(cadena);
                                              $('#rate_zerotest_'+cadena).modal('hide');
                                           
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
    <table id="zerotest_color_<?php echo $model->rateid.'_'.$st.'_'.$op ?>" class="items table table-condensed rating_table">
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
           
             $list_menu= Permission::model()->findAllByAttributes(array('menuid'=>$menu,'permissiongroup'=>'Artes'));
              
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
                if($op==4){
                    if (count($changeart) > 0) {
                        foreach ($changeart as $fila) {
                             $rateartes= Ratezerotest::model()->findAllByAttributes(array('rateid' => $model->rateid,'ratechangeartid' => $fila->ratechangeartid));
                                $cadena= '<tr>'
                                . '<td style="text-align:left">' . $fila->ratechangeartname . '</td>'
                                . '<td style="text-align:center">' . $fila->ratechangeartnumber . '</td>'
                                . '<td style="text-align:center" id="boton_artes_iden_'.$model->rateid.'">';
                              if(count($rateartes)==0){
                                 if(count($agregar)>0 && $agregar[0]['active']==1){   
                                    $cadena.= ' <a href="#Detailzerotest_'.$model->rateid.'" class="btn btn-sm btn-primary" id="lisd_zerotest_'.$model->rateid.'_'.$fila->ratechangeartid.'"  onclick="modal_alt_zerotest_'.$model->rateid.'('.$fila->ratechangeartid.','.$fila->ratechangeartnumber.','.$model->rateid.',0)"  data-target="#Detailzerotest_'.$model->rateid.'"  data-toggle="modal" >'
                                    . '<span class="glyphicon glyphicon-cog"></span>'
                                    . '</a>';
                                 }
                                
                              }else{
                                   $cadena.= ' <a href="#Hist_zerotest_'.$model->rateid.'" class="btn btn-sm btn-success" data-ratezerotestid="'.$rateartes[0]['ratezerotestid'].'"  id="lis2_zerotest_'.$model->rateid.'_'.$fila->ratechangeartid.'" onclick="modal_lista_zerotest_'.$model->rateid.'('.$fila->ratechangeartid.','.$fila->ratechangeartnumber.','.$model->rateid.',1)"  data-target="#Hist_zerotest_'.$model->rateid.'"  data-toggle="modal" >'
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
                              $rateartes= Ratezerotest::model()->findAllByAttributes(array('rateid' => $model->rateid,'ratechangeartid' => 0));
                              
                            if ($fila->quantityselect > 0) {
                               $cadena= '<tr>'
                                . '<td style="text-align:left">Cantidad Total</td>'
                                . '<td style="text-align:center">' . $fila->quantityselect . '</td>'
                                . '<td style="text-align:center" id="boton_artes_iden_'.$model->rateid.'">';
                                if(count($rateartes)==0){
                                      if(count($agregar)>0 && $agregar[0]['active']==1){   
                                            $cadena.= '<a href="#Detailzerotest_'.$model->rateid.'" class="btn btn-sm btn-primary"  id="lisd_zerotest_'.$model->rateid.'_0"  onclick="modal_alt_zerotest_'.$model->rateid.'(0,'.$fila->quantityselect.','.$model->rateid.',0)"  data-target="#Detailzerotest_'.$model->rateid.'"  data-toggle="modal"   >'
                                            . '<span class="glyphicon glyphicon-cog"></span>'
                                            . '</a>';
                                      }
                                 }else{
                                       $cadena.= ' <a href="#Hist_zerotest_'.$model->rateid.'" class="btn btn-sm btn-success" id="lis2_zerotest_'.$model->rateid.'_0" data-ratezerotestid="'.$rateartes[0]['ratezerotestid'].'" onclick="modal_lista_zerotest_'.$model->rateid.'(0,'.$fila->quantityselect.','.$model->rateid.',1)"  data-target="#Hist_zerotest_'.$model->rateid.'"  data-toggle="modal" >'
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


<div class="modal fade" id="Detailzerotest_<?php  echo $model->rateid;?>"  tabindex="-1" role="dialog" aria-labelledby="Detailzerotest_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de Prueba de Color</h4>
      </div>
      <div class="modal-body no-padding" >
        <form method="post" action="#"  id="rate_zerotest_<?php echo $model->rateid; ?>" novalidate="novalidate" class="smart-form">
		<fieldset>
            <table cellspacing="2" border="0"   class="table table-bordered">
		<tbody><tr>
			<td width="120">Fecha de entrega mensajería</td>
			<td width="200">
                            <label class="input" > 
                           <i class="icon-append fa fa-calendar"></i>
                            <input type="text" name="courierdeliverydate" id="<?php echo $model->rateid; ?>zetet_courierdeliverydate_daty" value="" >
                            </label>
                            </td>
			<td width="120">Fecha de entrega cliente</td>
			<td width="200">
                            <label class="input" > 
                           <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="customerdeliverydate" id="<?php echo $model->rateid; ?>zetet_customerdeliverydate_daty" value="" >
                            </label>
                            </td>
		</tr>
		<tr>
			<td>Quién recibe cliente</td>
			<td><input type="text"  name="receivercustomer" id="<?php echo $model->rateid; ?>zetet_receivercustomer_dsc" value=""></td>
			<td>Cantidad de pruebas entregadas</td>
			<td><input type="text"  name="deliverytestnumber" id="<?php echo $model->rateid; ?>zetet_deliverytestnumber_dsc" value=""></td>
		</tr>
		<tr>
			<td>Autorizó </td>
			<td>Si <input type="radio" name="authorization" id="authorization_1" value="1">&nbsp;&nbsp;&nbsp; No <input type="radio" name="authorization" id="authorization_2" value="0" checked="'checked'"></td>
			<td>Motivo de rechazo</td>
			<td><input type="text"  name="rejectreason" id="<?php echo $model->rateid; ?>zetet_rejectreason_dsc" value=""></td>
		</tr>
		<tr>
			<td>Prueba cero autorizada por </td>
			<td><input type="text"  name="zerotestauthorization" id="<?php echo $model->rateid; ?>zetet_zerotestauthorization_dsc" value=""></td>
			<td>Fecha de autorización</td>
			<td>
                            <label class="input" > 
                           <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="authorizationtest" id="<?php echo $model->rateid; ?>zetet_authorizationtest_daty" value="" >
                            </label>
                            </td>
		</tr>
		<tr>
			<td>Entrega Programada</td>
			<td><input type="text"  name="scheduleddelivery" id="<?php echo $model->rateid; ?>zetet_scheduleddelivery_dsc" value=""></td>
			<td>Entrega Real</td>
			<td><input type="text"  name="realdelivery" id="<?php echo $model->rateid; ?>zetet_realdelivery_dsc" value=""></td>
		</tr>												
		<tr>
			<td colspan="4" align="center">&nbsp;
			<input type="hidden" name="rateid" >
			<input type="hidden" name="ratezerotestid" >
			</td>
		</tr>
	</tbody>
            </table>
        </fieldset>
        <footer>
                        <button class="btn btn-primary" type="button" data-dismiss="modal" id="creat_zerotest_<?php  echo $model->rateid;?>" onclick="nuevo_zerotest_<?php echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Generar</button>
                        <!--<button class="btn btn-primary" type="button" data-dismiss="modal" id="update_zerotest_<?php  echo $model->rateid;?>" onclick="actualizar_arte_<?php  echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Actualizar</button>-->
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
</form>

 </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!------------------------------------------------ LISTA HISTORICOS ----------------------------------------------------------------------->


<div class="modal fade" id="Hist_zerotest_<?php  echo $model->rateid;?>"  tabindex="-1" role="dialog" aria-labelledby="Hist_zerotest_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de Prueba de Color</h4>
      </div>
      <div class="modal-body no-padding" >
        <div  id="hist_zerotest_for<?php echo $model->rateid; ?>" novalidate="novalidate" class="smart-form" style=" height: 250px;">
            
            <h3><i class='glyphicon glyphicon-chevron-right'></i>&nbsp;Historial  <button class="btn btn-sm btn-primary" style=" position: inherit; left: 500px;" type="button"  id="new_zerotest_<?php  echo $model->rateid;?>" onclick="limpiar_modal_edit_zerotest_<?php echo $model->rateid;?>('<?php  echo $model->rateid;?>')"><i class='glyphicon glyphicon-plus-sign'></i>&nbsp;Nuevo</button></h3>
            <div id="Detal_zerotest_h<?php  echo $model->rateid;?>_1" style=" ">	
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
            <div id="Detal_zerotest_h<?php  echo $model->rateid;?>_2" style="">

                   <table cellspacing="2" border="0"   class="table table-bordered">
		<tbody><tr>
			<td width="120">Fecha de entrega mensajería</td>
			<td width="200">
                            <label class="input" > 
                           <i class="icon-append fa fa-calendar"></i>
                            <input type="text" name="courierdeliverydate" id="<?php echo $model->rateid; ?>zero_courierdeliverydate_daty" value="" >
                            </label>
                            </td>
			<td width="120">Fecha de entrega cliente</td>
			<td width="200">
                            <label class="input" > 
                           <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="customerdeliverydate" id="<?php echo $model->rateid; ?>zero_customerdeliverydate_daty" value="" >
                            </label>
                            </td>
		</tr>
		<tr>
			<td>Quién recibe cliente</td>
			<td><input type="text"  name="receivercustomer" id="<?php echo $model->rateid; ?>zero_receivercustomer_dsc" value=""></td>
			<td>Cantidad de pruebas entregadas</td>
			<td><input type="text"  name="deliverytestnumber" id="<?php echo $model->rateid; ?>zero_deliverytestnumber_dsc" value=""></td>
		</tr>
		<tr>
			<td>Autorizó </td>
			<td>Si <input type="radio" name="authorization" id="authorization_1" value="1">&nbsp;&nbsp;&nbsp; No <input type="radio" name="authorization" id="authorization_2" value="0" checked="'checked'"></td>
			<td>Motivo de rechazo</td>
			<td><input type="text"  name="rejectreason" id="<?php echo $model->rateid; ?>zero_rejectreason_dsc" value=""></td>
		</tr>
		<tr>
			<td>Prueba cero autorizada por </td>
			<td><input type="text"  name="zerotestauthorization" id="<?php echo $model->rateid; ?>zero_zerotestauthorization_dsc" value=""></td>
			<td>Fecha de autorización</td>
			<td>
                            <label class="input" > 
                           <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="authorizationtest" id="<?php echo $model->rateid; ?>zero_authorizationtest_daty" value="" >
                            </label>
                            </td>
		</tr>
		<tr>
			<td>Entrega Programada</td>
			<td><input type="text"  name="scheduleddelivery" id="<?php echo $model->rateid; ?>zero_scheduleddelivery_dsc" value=""></td>
			<td>Entrega Real</td>
			<td><input type="text"  name="realdelivery" id="<?php echo $model->rateid; ?>zero_realdelivery_dsc" value=""></td>
		</tr>												
		<tr>
			<td colspan="4" align="center">&nbsp;
			<input type="hidden" name="rateid" >
			<input type="hidden" name="ratezerotestid" >
			</td>
		</tr>
	</tbody>
            </table>
                <input type="hidden" name="ratezerotestid" value="">
            <footer>
                        <button class="btn btn-primary" type="button"  id="creat_zerotest_edit_<?php  echo $model->rateid;?>" onclick="nuevo_zerotest_edit_<?php echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Generar</button>
                	<button class="btn btn-primary" type="button"  id="update_zerotest_edit_<?php  echo $model->rateid;?>" onclick="actualizar_arte_edit_<?php  echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Actualizar</button>
			<button  class="btn btn-default" type="button" onclick="limpiar_modal_cancel_zerotest_<?php  echo $model->rateid;?>('<?php  echo $model->rateid;?>')" >Cancelar</button>			
	     </footer>
</div>
        
</div>

 </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    
                    
     function modal_alt_zerotest_<?php echo $model->rateid;?>(ratechangeartid,ratechangeartnumber,rateid,exists){
         
                   
                    $("#rate_zerotest_<?php echo $model->rateid; ?>").find("#creat_zerotest_"+rateid).hide();
                    $("#rate_zerotest_<?php echo $model->rateid; ?>").find("#update_zerotest_"+rateid).hide();

                    $("#rate_zerotest_<?php echo $model->rateid; ?>").find('#<?php echo $model->rateid; ?>zetet_courierdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#rate_zerotest_<?php echo $model->rateid; ?>").find('#<?php echo $model->rateid; ?>zetet_customerdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#rate_zerotest_<?php echo $model->rateid; ?>").find('#<?php echo $model->rateid; ?>zetet_authorizationtest_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                   
                        if(exists==1){
                            $("#rate_zerotest_"+rateid).find("#creat_zerotest_"+rateid).hide();
                            $("#rate_zerotest_"+rateid).find("#update_zerotest_"+rateid).show();
                           
                            var ratezerotestid=$("#lis2_zerotest_"+rateid+"_"+ratechangeartid).data("ratezerotestid");
                            
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listazerotest') ?>', {'ratezerotestid':ratezerotestid}, function(response){
                                          var obj = JSON.parse(response);
                                        
                                         $("#rate_zerotest_"+rateid).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                                                 var elemento= this;
                                                  var tipo= $("#rate_zerotest_"+rateid).find("#"+elemento.id).attr("type");
                                                  
                                                    if(tipo=="text"||tipo=="number"){
                                                         var div=elemento.id.split('_');
                                                            $.each(obj, function (ind, elem) { 
                                                                 if(div[1]==ind){
                                                                     if(div[2]!="enu"){
                                                                         $("#rate_zerotest_"+rateid).find("#"+elemento.id).attr("value",elem);
                                                                     }else{
                                                                          $("#rate_zerotest_"+rateid).find("#"+elemento.id).attr("value",parseInt(elem));
                                                                     }

                                                                }
                                                            }); 
                                                     }else if(tipo=="checkbox"){
                                                         $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                   
                                                                      $("#rate_zerotest_"+rateid).find("#"+elemento.id).prop("checked", true);

                                                                     } 
                                                            }); 
                                                       }else{
                                                            
                                                           $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                   
                                                                      $("#rate_zerotest_"+rateid).find("#authorization_1").prop("checked", true);
                                                                       $("#rate_zerotest_"+rateid).find("#authorization_2").prop("checked", false);
                                                               }else if(ind == elemento.name && elem == 0){
                                                                   $("#rate_zerotest_"+rateid).find("#authorization_1").prop("checked", false);
                                                                   $("#rate_zerotest_"+rateid).find("#authorization_2").prop("checked", true); 
                                                               }
                                                            }); 
                                                           
                                                       }

                                               });


                                 });
                            
                            
                        }else{
                            $("#rate_zerotest_"+rateid).find("#creat_zerotest_"+rateid).show();
                            $("#rate_zerotest_"+rateid).find("#update_zerotest_"+rateid).hide();
                        }
                    
                $("#rate_zerotest_"+rateid).find("#creat_zerotest_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#rate_zerotest_"+rateid).find("#update_zerotest_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#rate_zerotest_"+rateid).find("#creat_zerotest_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);
                $("#rate_zerotest_"+rateid).find("#update_zerotest_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);   
              
         
     }
 
     function modal_lista_zerotest_<?php echo $model->rateid;?>(ratechangeartid,ratechangeartnumber,rateid,exists){
                    
                    $("#hist_zerotest_for"+rateid ).accordion();
                      $("#hist_zerotest_for"+rateid ).find("#Detal_zerotest_h"+rateid+"_1").css("height","190px");
                       $("#hist_zerotest_for"+rateid ).find("#Detal_zerotest_h"+rateid+"_1").css("over-flow-y","auto");
                        $("#hist_zerotest_for"+rateid ).find("#Detal_zerotest_h"+rateid+"_2").css("height","430px");
                   
                  
                    $("#Hist_zerotest_"+rateid).find("#Detal_zerotest_h"+rateid+"_2").hide();    
                    $("#Hist_zerotest_"+rateid).find("#creat_zerotest_"+rateid).hide();
                    $("#Hist_zerotest_"+rateid).find("#update_zerotest_"+rateid).hide();
                    
                    
                        $("#Hist_zerotest_"+rateid).find('#<?php echo $model->rateid; ?>zero_courierdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#Hist_zerotest_"+rateid).find('#<?php echo $model->rateid; ?>zero_customerdeliverydate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#Hist_zerotest_"+rateid).find('#<?php echo $model->rateid; ?>zero_authorizationtest_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                       
                    
                    

                 
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listahistozerotest') ?>', {'ratechangeartid':ratechangeartid, 'rateid':rateid }, function(response){
                                
                                if(response!=0){
                                      $("#Hist_zerotest_"+rateid).find("#Detal_zerotest_h"+rateid+"_1").find("table tbody").html(response);    
                                }
                            
                            });
                            
                       
                    
                $("#Detal_zerotest_h"+rateid+"_2").find("#creat_zerotest_edit_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#Detal_zerotest_h"+rateid+"_2").find("#update_zerotest_edit_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#Detal_zerotest_h"+rateid+"_2").find("#creat_zerotest_edit_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);
                $("#Detal_zerotest_h"+rateid+"_2").find("#update_zerotest_edit_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);   
              
         
     }
     
    function selec_hist_zerotest(ratezerotestid,rateid){
        
        $("#Detal_zerotest_h"+rateid+"_1").hide();
        $("#Detal_zerotest_h"+rateid+"_2").show();
        $("#Hist_zerotest_"+rateid).find("#creat_zerotest_edit_"+rateid).hide();
         $("#Hist_zerotest_"+rateid).find("#update_zerotest_edit_"+rateid).show();
         $("#Hist_zerotest_"+rateid).find("#update_zerotest_edit_"+rateid).attr("data-ratezerotestid",ratezerotestid);
        
          $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listazerotest') ?>', {'ratezerotestid':ratezerotestid}, function(response){
                                          var obj = JSON.parse(response);
                                        
                                         $("#Detal_zerotest_h"+rateid+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                                                 var elemento= this;
                                                  var tipo= $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).attr("type");
                                                  
                                                    if(tipo=="text"||tipo=="number"){
                                                        
                                                         var div=elemento.id.split('_');
                                                            $.each(obj, function (ind, elem) { 
                                                                 if(div[1]==ind){
                                                                     
                                                                
                                                                     if(div[2]!="enu"){
                                                                     
                                                                         $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).attr("value",elem);
                                                                         $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).val(elem);
                                                                     }else{
                                                                         
                                                                          $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).attr("value",parseInt(elem));
                                                                          $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).val(parseInt(elem));
                                                                     }

                                                                }
                                                            }); 
                                                     }else if(tipo=="checkbox"){
                                                         $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                    
                                                                      $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).prop("checked", true);

                                                                     } 
                                                            }); 
                                                       }else{
                                                            
                                                           $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                   
                                                                      $("#Detal_zerotest_h"+rateid+"_2").find("#authorization_1").prop("checked", true);
                                                                       $("#Detal_zerotest_h"+rateid+"_2").find("#authorization_2").prop("checked", false);
                                                               }else if(ind == elemento.name && elem == 0){
                                                                   $("#Detal_zerotest_h"+rateid+"_2").find("#authorization_1").prop("checked", false);
                                                                   $("#Detal_zerotest_h"+rateid+"_2").find("#authorization_2").prop("checked", true); 
                                                               }
                                                            }); 
                                                           
                                                       }

                                               });


                                 });    
        
    }
     
     function limpiar_modal_zerotest_<?php echo $model->rateid;?>(rateid){
     
            $("#rate_zerotest_"+rateid).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                    var elemento= this;
                    var tipo= $("#rate_zerotest_"+rateid).find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                       $("#rate_zerotest_"+rateid).find("#"+elemento.id).attr("value","");
                           
                     }else if(tipo=="checkbox"){
                         $("#rate_zerotest_"+rateid).find("#"+elemento.id).prop("checked", false);
                       }else{
                          if(elemento.id=="authorization_1"){
                                $("#rate_zerotest_"+rateid).find("#"+elemento.id).prop("checked", false);
                          }else  if(elemento.id=="authorization_2"){
                              $("#rate_zerotest_"+rateid).find("#"+elemento.id).prop("checked", true);
                          } 
                         
                       }
                    
            });
     
     }
     
     function limpiar_modal_edit_zerotest_<?php echo $model->rateid;?>(rateid){
     
            $("#Detal_zerotest_h"+rateid+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                    var elemento= this;
                    var tipo= $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                       $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).attr("value","");
                           
                     }else if(tipo=="checkbox"){
                         $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                       }else{
                          if(elemento.id=="authorization_1"){
                                $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                          }else  if(elemento.id=="authorization_2"){
                              $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).prop("checked", true);
                          } 
                         
                       }
                    
            });
            $("#Detal_zerotest_h"+rateid+"_1").hide();
            $("#Detal_zerotest_h"+rateid+"_2").show(); 
            $("#Detal_zerotest_h"+rateid+"_2").find("#creat_zerotest_edit_"+rateid).show();
            $("#Detal_zerotest_h"+rateid+"_2").find("#update_zerotest_edit_"+rateid).hide();
     
     }
     
      function limpiar_modal_cancel_zerotest_<?php echo $model->rateid;?>(rateid){
     
            $("#Detal_zerotest_h"+rateid+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                    var elemento= this;
                    var tipo= $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                        
                       $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).attr("value","");
                         $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).val("");
                           
                     }else if(tipo=="checkbox"){
                         $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                       }else{
                          if(elemento.id=="authorization_1"){
                                $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                          }else  if(elemento.id=="authorization_2"){
                              $("#Detal_zerotest_h"+rateid+"_2").find("#"+elemento.id).prop("checked", true);
                          } 
                         
                       }
                    
            });
            $("#Detal_zerotest_h"+rateid+"_1").show();
            $("#Detal_zerotest_h"+rateid+"_2").hide(); 
            $("#Detal_zerotest_h"+rateid+"_2").find("#creat_zerotest_edit_"+rateid).hide();
            $("#Detal_zerotest_h"+rateid+"_2").find("#update_zerotest_edit_"+rateid).hide();
     
     }
     
     
     function nuevo_zerotest_edit_<?php  echo $model->rateid;?>(x){
     
        var cadena=x;
        var ratechangeartid=$("#Detal_zerotest_h"+cadena+"_2").find("#creat_zerotest_edit_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#Detal_zerotest_h"+cadena+"_2").find("#creat_zerotest_edit_"+cadena).data("ratechangeartnumber");
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
       
        $("#Detal_zerotest_h"+cadena+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#Detal_zerotest_h"+cadena+"_2").find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena ||div[0]==cadena+'zero'  ){
                                       // valid=valid_expresion_form(elemento.id);
                                       
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                   
                                     if ( $("#Detal_zerotest_h"+cadena+"_2").find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.name]=1;
                                       
                                    } else{
                                          integrador[elemento.name]=0;
                                    }
                                   
                               }else{
                                 if( $("#Detal_zerotest_h"+cadena+"_2").find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#Detal_zerotest_h"+cadena+"_2").find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                       
                          
                       
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/createzerotestregis') ?>', {'arrai':integrador}, function(response){
                                        
                                        if(response != 0){
                                            
                                             $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listahistozerotest') ?>', {'ratechangeartid':ratechangeartid, 'rateid':cadena }, function(result){

                                                    if(result!=0){
                                                          $("#Hist_zerotest_"+cadena).find("#Detal_zerotest_h"+cadena+"_1").find("table tbody").html(result);    
                                                    }

                                                });
                                           
                                           
                                                alert('Se guardo la informacion correctamente.');
                                                limpiar_modal_cancel_zerotest_<?php echo $model->rateid;?>(cadena);
                                                 $("#Hist_zerotest_"+cadena).find("#Detal_zerotest_h"+cadena+"_1").show();  
                                                $("#Hist_zerotest_"+cadena).find("#Detal_zerotest_h"+cadena+"_2").hide();    
                                              //$('#rate_zerotest_'+cadena).modal('hide');
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                           
        
    }
   
     function actualizar_arte_edit_<?php  echo $model->rateid;?>(x){
        var cadena=x;
        var ratechangeartid=$("#Detal_zerotest_h"+cadena+"_2").find("#update_zerotest_edit_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#Detal_zerotest_h"+cadena+"_2").find("#update_zerotest_edit_"+cadena).data("ratechangeartnumber");
        var ratezerotestid=$("#Detal_zerotest_h"+cadena+"_2").find("#update_zerotest_edit_"+cadena).data("ratezerotestid")
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
            integrador['ratezerotestid']=ratezerotestid;
            
        $("#Detal_zerotest_h"+cadena+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#Detal_zerotest_h"+cadena+"_2").find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena||div[0]==cadena+'zero'){
                                      
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                     if ( $("#Detal_zerotest_h"+cadena+"_2").find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.name]=1;
                                       
                                    } else{
                                          integrador[elemento.name]=0;
                                    }
                                   
                               }else{
                                 if( $("#Detal_zerotest_h"+cadena+"_2").find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#Detal_zerotest_h"+cadena+"_2").find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                        
                          
                      
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/updatezerotestregis') ?>', {'arrai':integrador}, function(response){
                                      
                                        if(response != 0){
                                                    
                                                     $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listahistozerotest') ?>', {'ratechangeartid':ratechangeartid, 'rateid':cadena }, function(result){

                                                          if(result!=0){
                                                                $("#Hist_zerotest_"+cadena).find("#Detal_zerotest_h"+cadena+"_1").find("table tbody").html(result);    
                                                          }

                                                      });
                                         
                                                 alert('Se actualizo la informacion correctamente');
                                                 limpiar_modal_cancel_zerotest_<?php echo $model->rateid;?>(cadena);
                                                 $("#Hist_zerotest_"+cadena).find("#Detal_zerotest_h"+cadena+"_1").show();  
                                                $("#Hist_zerotest_"+cadena).find("#Detal_zerotest_h"+cadena+"_2").hide();    
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                          
        
    } 
     
     
</script>