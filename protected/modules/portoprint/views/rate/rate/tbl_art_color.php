<?php
    $title = ($op==1)?"Cambios de arte.":"Prueba de color.";
    
?>
<script>
   
     function nuevo_ar_<?php  echo $model->rateid;?>(x){
     
        var cadena=x;
        var ratechangeartid=$("#rate_art_"+cadena).find("#creat_art_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#rate_art_"+cadena).find("#creat_art_"+cadena).data("ratechangeartnumber");
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
        $("#rate_art_"+cadena).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#rate_art_"+cadena).find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena){
                                       
                                        
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                     if ( $("#rate_art_"+cadena).find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.name]=1;
                                       
                                    } else{
                                          integrador[elemento.name]=0;
                                    }
                                   
                               }else{
                                 if( $("#rate_art_"+cadena).find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#rate_art_"+cadena).find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                          
                         
                                
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/createartregis') ?>', {'arrai':integrador}, function(response){
                                        
                                        if(response != 0){
                                            var response1=response.split(',');
                                            var line= ' <a href="#Hist_art_'+cadena+'" class="btn btn-sm btn-success" id="lis2_art_'+cadena+'_'+ratechangeartid+'" data-rateartid="'+response1[0]+'" onclick="modal_lista_art_'+cadena+'('+ratechangeartid+','+ratechangeartnumber+','+cadena+',1)"  data-target="#Hist_art_'+cadena+'"  data-toggle="modal" >'
                                                        + '<span class="glyphicon glyphicon-ok"></span>'
                                                        + '</a>';
                                                $("#art_color_<?php echo $model->rateid.'_'.$st.'_'.$op ?>").find("#boton_artes_iden_"+cadena).html(line);
                                                alert('Se guardo la informacion correctamente.');
                                                limpiar_modal_art_<?php echo $model->rateid;?>(cadena);
                                              $('#rate_art_'+cadena).modal('hide');
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                        
        
    }
   
     function actualizar_arte_<?php  echo $model->rateid;?>(x){
        var cadena=x;
        var ratechangeartid=$("#rate_art_"+cadena).find("#creat_art_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#rate_art_"+cadena).find("#creat_art_"+cadena).data("ratechangeartnumber");
        var rateartid=$("#lis2_art_"+cadena+"_"+ratechangeartid).data("rateartid");
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
            integrador['rateartid']=rateartid;
            
        $("#rate_art_"+cadena).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#rate_art_"+cadena).find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena){
                                     
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                     if ( $("#rate_art_"+cadena).find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.id]=1;
                                       
                                    } else{
                                          integrador[elemento.id]=0;
                                    }
                                   
                               }else{
                                 if( $("#rate_art_"+cadena).find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#rate_art_"+cadena).find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                        
                     
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/updateartregis') ?>', {'arrai':integrador}, function(response){
                                      
                                        if(response != 0){
                                         
                                                 alert('Se actualizo la informacion correctamente');
                                                   limpiar_modal_art_<?php echo $model->rateid;?>(cadena);
                                              $('#rate_art_'+cadena).modal('hide');
                                           
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
    <table id="art_color_<?php echo $model->rateid.'_'.$st.'_'.$op ?>" class="items table table-condensed rating_table">
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
                if($op==1){
                    if (count($changeart) > 0) {
                        foreach ($changeart as $fila) {
                             $rateartes= Rateart::model()->findAllByAttributes(array('rateid' => $model->rateid,'ratechangeartid' => $fila->ratechangeartid));
                                $cadena= '<tr>'
                                . '<td style="text-align:left">' . $fila->ratechangeartname . '</td>'
                                . '<td style="text-align:center">' . $fila->ratechangeartnumber . '</td>'
                                . '<td style="text-align:center" id="boton_artes_iden_'.$model->rateid.'">';
                              if(count($rateartes)==0){
                                 if(count($agregar)>0 && $agregar[0]['active']==1){   
                                    $cadena.= ' <a href="#Detailart_'.$model->rateid.'" class="btn btn-sm btn-primary" id="lisd_art_'.$model->rateid.'_'.$fila->ratechangeartid.'"  onclick="modal_alt_art_'.$model->rateid.'('.$fila->ratechangeartid.','.$fila->ratechangeartnumber.','.$model->rateid.',0)"  data-target="#Detailart_'.$model->rateid.'"  data-toggle="modal" >'
                                    . '<span class="glyphicon glyphicon-cog"></span>'
                                    . '</a>';
                                 }
                                
                              }else{
                                   $cadena.= ' <a href="#Hist_art_'.$model->rateid.'" class="btn btn-sm btn-success" data-rateartid="'.$rateartes[0]['rateartid'].'"  id="lis2_art_'.$model->rateid.'_'.$fila->ratechangeartid.'" onclick="modal_lista_art_'.$model->rateid.'('.$fila->ratechangeartid.','.$fila->ratechangeartnumber.','.$model->rateid.',1)"  data-target="#Hist_art_'.$model->rateid.'"  data-toggle="modal" >'
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
                              $rateartes= Rateart::model()->findAllByAttributes(array('rateid' => $model->rateid,'ratechangeartid' => 0));
                              
                            if ($fila->quantityselect > 0) {
                               $cadena= '<tr>'
                                . '<td style="text-align:left">Cantidad Total</td>'
                                . '<td style="text-align:center">' . $fila->quantityselect . '</td>'
                                . '<td style="text-align:center" id="boton_artes_iden_'.$model->rateid.'">';
                                if(count($rateartes)==0){
                                      if(count($agregar)>0 && $agregar[0]['active']==1){   
                                            $cadena.= '<a href="#Detailart_'.$model->rateid.'" class="btn btn-sm btn-primary"  id="lisd_art_'.$model->rateid.'_0"  onclick="modal_alt_art_'.$model->rateid.'(0,'.$fila->quantityselect.','.$model->rateid.',0)"  data-target="#Detailart_'.$model->rateid.'"  data-toggle="modal"   >'
                                            . '<span class="glyphicon glyphicon-cog"></span>'
                                            . '</a>';
                                      }
                                 }else{
                                       $cadena.= ' <a href="#Hist_art_'.$model->rateid.'" class="btn btn-sm btn-success" id="lis2_art_'.$model->rateid.'_0" data-rateartid="'.$rateartes[0]['rateartid'].'" onclick="modal_lista_art_'.$model->rateid.'(0,'.$fila->quantityselect.','.$model->rateid.',1)"  data-target="#Hist_art_'.$model->rateid.'"  data-toggle="modal" >'
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


<div class="modal fade" id="Detailart_<?php  echo $model->rateid;?>"  tabindex="-1" role="dialog" aria-labelledby="Detailart_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de Arte</h4>
      </div>
      <div class="modal-body no-padding" >
        <form method="post" action="#"  id="rate_art_<?php echo $model->rateid; ?>" novalidate="novalidate" class="smart-form">
		<fieldset>

                <table cellspacing="2" border="0"   class="table table-bordered">
		<tbody><tr>
			<td width="120">Fecha de Recepción</td>
			<td width="200" id="<?php echo $model->rateid; ?>_receptiondatetd">
                            <label class="input" > 
                                <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="<?php echo $model->rateid; ?>_receptiondate_daty" id="<?php echo $model->rateid; ?>_receptiondate_daty" value="" <?php echo $editable;?> >
                            </label>
                        </td>
			<td width="120">Recibido de</td>
			<td width="200" id="<?php echo $model->rateid; ?>_receipttd"><input type="text"  name="NT_receipt_dsc" id="<?php echo $model->rateid; ?>_receipt_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Método de Recepción</td>
			<td id="<?php echo $model->rateid; ?>_receivemethodtd"><input type="text"  name="NT_receivemethod_dsc" id="<?php echo $model->rateid; ?>_receivemethod_dsc" value="" <?php echo $editable;?>></td>
			<td>Tipo de archivo / versión</td>
			<td id="<?php echo $model->rateid; ?>_filetypetd"><input type="text"  name="NT_filetype_dsc" id="<?php echo $model->rateid; ?>_filetype_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Revision archivo</td>
			<td colspan="3">Overprint <input type="checkbox" name="filerevision1" id="<?php echo $model->rateid; ?>_filerevision1" value="TRUE" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp; Fuentes <input type="checkbox" name="filerevision2" id="<?php echo $model->rateid; ?>_filerevision2" value="TRUE" <?php echo $editable;?>> &nbsp;&nbsp;&nbsp;Imagenes CMYK <input type="checkbox" name="filerevision3" id="<?php echo $model->rateid; ?>_filerevision3" value="TRUE" <?php echo $editable;?>> &nbsp;&nbsp;&nbsp;Resolución <input type="checkbox" name="filerevision4" id="<?php echo $model->rateid; ?>_filerevision4" value="TRUE" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Modificaciones</td>
			<td>Si <input type="radio" id="changes_1" name="changes" value="1" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp; No <input type="radio" id="changes_2" name="changes" value="0" checked="'checked'" <?php echo $editable;?>></td>
			<td>Tipo de modificaciones</td>
			<td  id="<?php echo $model->rateid; ?>_changestypetd"><input type="text"  id="<?php echo $model->rateid; ?>_changestype_dsc" name="NT_changestype_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Observación especifica</td>
			<td id="<?php echo $model->rateid; ?>_specifiedobservationtd"><input type="text"  id="<?php echo $model->rateid; ?>_specifiedobservation_dsc" name="NT_specifiedobservation_dsc" value="" <?php echo $editable;?>></td>
			<td>Fecha de envio de modificación</td>
			<td id="<?php echo $model->rateid; ?>_senddatetd">
                           <label class="input" > 
                                <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="sendDate" id="<?php echo $model->rateid; ?>_senddate_daty" name="NT_senddate_daty" value="" <?php echo $editable;?>>
                             </label>
                        </td>
		</tr>
		<tr>
			<td>Método de envío</td>
			<td id="<?php echo $model->rateid; ?>_sendmethodtd"><input type="text"  id="<?php echo $model->rateid; ?>_sendmethod_dsc" name="NT_sendmethod_dsc" value="" <?php echo $editable;?>></td>
			<td>Fecha de autorización de modificación</td>
			<td id="<?php echo $model->rateid; ?>_authorizationdatetd">
                            <label class="input" > 
                                <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="NT_authorizationdate_daty" id="<?php echo $model->rateid; ?>_authorizationdate_daty" value="" <?php echo $editable;?> >
                            </label>
                        </td>
		</tr>
		<tr>
			<td>Quien autoriza la modificación</td>
			<td id="<?php echo $model->rateid; ?>_authorizationtd"><input type="text" id="<?php echo $model->rateid; ?>_authorization_dsc" name="NT_authorization_dsc" value=""></td>
			<td>Metodo de autorización</td>
			<td id="<?php echo $model->rateid; ?>_authorizationmethodtd"><input type="text" id="<?php echo $model->rateid; ?>_authorizationmethod_dsc" name="NT_authorizationmethod_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Responsable de diseño</td>
			<td colspan="3"  id="<?php echo $model->rateid; ?>_designheadtd" ><input type="text" id="<?php echo $model->rateid; ?>_designhead_dsc" name="NT_designhead_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td colspan="4" align="center">&nbsp;<input type="hidden" name="rateartid" value=""></td>
		</tr>
                </tbody>
               </table>


</fieldset>
        <footer>
                        <button class="btn btn-primary" type="button" data-dismiss="modal" id="creat_art_<?php  echo $model->rateid;?>" onclick="nuevo_ar_<?php echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Generar</button>
                        <!--<button class="btn btn-primary" type="button" data-dismiss="modal" id="update_art_<?php  echo $model->rateid;?>" onclick="actualizar_arte_<?php  echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Actualizar</button>-->
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
</form>

 </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!------------------------------------------------ LISTA HISTORICOS ----------------------------------------------------------------------->


<div class="modal fade" id="Hist_art_<?php  echo $model->rateid;?>"  tabindex="-1" role="dialog" aria-labelledby="Hist_art_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de Arte</h4>
      </div>
      <div class="modal-body no-padding" >
        <div  id="hist_art_for<?php echo $model->rateid; ?>" novalidate="novalidate" class="smart-form" style=" height: 250px;">
            
            <h3><i class='glyphicon glyphicon-chevron-right'></i>&nbsp;Historial  <button class="btn btn-sm btn-primary" style=" position: inherit; left: 500px;" type="button"  id="new_art_<?php  echo $model->rateid;?>" onclick="limpiar_modal_edit_art_<?php echo $model->rateid;?>('<?php  echo $model->rateid;?>')"><i class='glyphicon glyphicon-plus-sign'></i>&nbsp;Nuevo</button></h3>
            <div id="Detal_art_h<?php  echo $model->rateid;?>_1" style=" ">	
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
            <div id="Detal_art_h<?php  echo $model->rateid;?>_2" style="">

                <table cellspacing="2" border="0"   class="table table-bordered">
		<tbody><tr>
			<td width="120">Fecha de Recepción</td>
			<td width="200" id="<?php echo $model->rateid; ?>_receptiondatetd">
                            <label class="input" > 
                                <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="<?php echo $model->rateid; ?>_receptiondate_daty" id="<?php echo $model->rateid; ?>edt_receptiondate_daty" value="" <?php echo $editable;?> >
                            </label>
                        </td>
			<td width="120">Recibido de</td>
			<td width="200" id="<?php echo $model->rateid; ?>_receipttd"><input type="text"  name="NT_receipt_dsc" id="<?php echo $model->rateid; ?>_receipt_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Método de Recepción</td>
			<td id="<?php echo $model->rateid; ?>_receivemethodtd"><input type="text"  name="NT_receivemethod_dsc" id="<?php echo $model->rateid; ?>_receivemethod_dsc" value="" <?php echo $editable;?>></td>
			<td>Tipo de archivo / versión</td>
			<td id="<?php echo $model->rateid; ?>_filetypetd"><input type="text"  name="NT_filetype_dsc" id="<?php echo $model->rateid; ?>_filetype_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Revision archivo</td>
			<td colspan="3">Overprint <input type="checkbox" name="filerevision1" id="<?php echo $model->rateid; ?>_filerevision1" value="TRUE" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp; Fuentes <input type="checkbox" name="filerevision2" id="<?php echo $model->rateid; ?>_filerevision2" value="TRUE" <?php echo $editable;?>> &nbsp;&nbsp;&nbsp;Imagenes CMYK <input type="checkbox" name="filerevision3" id="<?php echo $model->rateid; ?>_filerevision3" value="TRUE" <?php echo $editable;?>> &nbsp;&nbsp;&nbsp;Resolución <input type="checkbox" name="filerevision4" id="<?php echo $model->rateid; ?>_filerevision4" value="TRUE" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Modificaciones</td>
			<td>Si <input type="radio" id="changes_1" name="changes" value="1" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp; No <input type="radio" id="changes_2" name="changes" value="0" checked="'checked'" <?php echo $editable;?>></td>
			<td>Tipo de modificaciones</td>
			<td  id="<?php echo $model->rateid; ?>_changestypetd"><input type="text"  id="<?php echo $model->rateid; ?>_changestype_dsc" name="NT_changestype_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Observación especifica</td>
			<td id="<?php echo $model->rateid; ?>_specifiedobservationtd"><input type="text"  id="<?php echo $model->rateid; ?>_specifiedobservation_dsc" name="NT_specifiedobservation_dsc" value="" <?php echo $editable;?>></td>
			<td>Fecha de envio de modificación</td>
			<td id="<?php echo $model->rateid; ?>edt_senddatetd">
                           <label class="input" > 
                                <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="sendDate" id="<?php echo $model->rateid; ?>edt_senddate_daty" name="NT_senddate_daty" value="" <?php echo $editable;?>>
                             </label>
                        </td>
		</tr>
		<tr>
			<td>Método de envío</td>
			<td id="<?php echo $model->rateid; ?>_sendmethodtd"><input type="text"  id="<?php echo $model->rateid; ?>_sendmethod_dsc" name="NT_sendmethod_dsc" value="" <?php echo $editable;?>></td>
			<td>Fecha de autorización de modificación</td>
			<td id="<?php echo $model->rateid; ?>edt_authorizationdatetd">
                            <label class="input" > 
                                <i class="icon-append fa fa-calendar"></i>
                            <input type="text"  name="NT_authorizationdate_daty" id="<?php echo $model->rateid; ?>edt_authorizationdate_daty" value="" <?php echo $editable;?> >
                            </label>
                        </td>
		</tr>
		<tr>
			<td>Quien autoriza la modificación</td>
			<td id="<?php echo $model->rateid; ?>_authorizationtd"><input type="text" id="<?php echo $model->rateid; ?>_authorization_dsc" name="NT_authorization_dsc" value=""></td>
			<td>Metodo de autorización</td>
			<td id="<?php echo $model->rateid; ?>_authorizationmethodtd"><input type="text" id="<?php echo $model->rateid; ?>_authorizationmethod_dsc" name="NT_authorizationmethod_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		<tr>
			<td>Responsable de diseño</td>
			<td colspan="3"  id="<?php echo $model->rateid; ?>_designheadtd" ><input type="text" id="<?php echo $model->rateid; ?>_designhead_dsc" name="NT_designhead_dsc" value="" <?php echo $editable;?>></td>
		</tr>
		
                </tbody>
               </table>
                <input type="hidden" name="rateartid" value="">
            <footer>
                        <button class="btn btn-primary" type="button"  id="creat_art_edit_<?php  echo $model->rateid;?>" onclick="nuevo_art_edit_<?php echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Generar</button>
                	<button class="btn btn-primary" type="button"  id="update_art_edit_<?php  echo $model->rateid;?>" onclick="actualizar_arte_edit_<?php  echo $model->rateid;?>('<?php  echo $model->rateid;?>')">Actualizar</button>
			<button  class="btn btn-default" type="button" onclick="limpiar_modal_cancel_art_<?php  echo $model->rateid;?>('<?php  echo $model->rateid;?>')" >Cancelar</button>			
	     </footer>
</div>
        
</div>

 </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    
                    
     function modal_alt_art_<?php echo $model->rateid;?>(ratechangeartid,ratechangeartnumber,rateid,exists){
         
                    
                    $("#rate_art_"+rateid).find("#creat_art_"+rateid).hide();
                    $("#rate_art_"+rateid).find("#update_art_"+rateid).hide();

                    $("#rate_art_"+rateid).find('#<?php echo $model->rateid; ?>_receptiondate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#rate_art_"+rateid).find('#<?php echo $model->rateid; ?>_senddate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#rate_art_"+rateid).find('#<?php echo $model->rateid; ?>_authorizationdate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });

                        if(exists==1){
                            $("#rate_art_"+rateid).find("#creat_art_"+rateid).hide();
                            $("#rate_art_"+rateid).find("#update_art_"+rateid).show();
                           
                            var rateartid=$("#lis2_art_"+rateid+"_"+ratechangeartid).data("rateartid");
                            
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listaartes') ?>', {'rateartid':rateartid}, function(response){
                                          var obj = JSON.parse(response);
                                        
                                         $("#rate_art_"+rateid).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                                                 var elemento= this;
                                                  var tipo= $("#rate_art_"+rateid).find("#"+elemento.id).attr("type");
                                                  
                                                    if(tipo=="text"||tipo=="number"){
                                                         var div=elemento.id.split('_');
                                                            $.each(obj, function (ind, elem) { 
                                                                 if(div[1]==ind){
                                                                     if(div[2]!="enu"){
                                                                         $("#rate_art_"+rateid).find("#"+elemento.id).attr("value",elem);
                                                                     }else{
                                                                          $("#rate_art_"+rateid).find("#"+elemento.id).attr("value",parseInt(elem));
                                                                     }

                                                                }
                                                            }); 
                                                     }else if(tipo=="checkbox"){
                                                         $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                   
                                                                      $("#rate_art_"+rateid).find("#"+elemento.id).prop("checked", true);

                                                                     } 
                                                            }); 
                                                       }else{
                                                            
                                                           $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                   
                                                                      $("#rate_art_"+rateid).find("#changes_1").prop("checked", true);
                                                                       $("#rate_art_"+rateid).find("#changes_2").prop("checked", false);
                                                               }else if(ind == elemento.name && elem == 0){
                                                                   $("#rate_art_"+rateid).find("#changes_1").prop("checked", false);
                                                                   $("#rate_art_"+rateid).find("#changes_2").prop("checked", true); 
                                                               }
                                                            }); 
                                                           
                                                       }

                                               });


                                 });
                            
                            
                        }else{
                            $("#rate_art_"+rateid).find("#creat_art_"+rateid).show();
                            $("#rate_art_"+rateid).find("#update_art_"+rateid).hide();
                        }
                    
                $("#rate_art_"+rateid).find("#creat_art_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#rate_art_"+rateid).find("#update_art_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#rate_art_"+rateid).find("#creat_art_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);
                $("#rate_art_"+rateid).find("#update_art_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);   
              
         
     }
     var acodions;
     
     function modal_lista_art_<?php echo $model->rateid;?>(ratechangeartid,ratechangeartnumber,rateid,exists){
                    
                     acodions= $("#hist_art_for"+rateid ).accordion();
                      $("#hist_art_for"+rateid ).find("#Detal_art_h"+rateid+"_1").css("height","190px");
                       $("#hist_art_for"+rateid ).find("#Detal_art_h"+rateid+"_1").css("over-flow-y","auto");
                        $("#hist_art_for"+rateid ).find("#Detal_art_h"+rateid+"_2").css("height","430px");
                   
                  
                    $("#Hist_art_"+rateid).find("#Detal_art_h"+rateid+"_2").hide();    
                    $("#Hist_art_"+rateid).find("#creat_art_"+rateid).hide();
                    $("#Hist_art_"+rateid).find("#update_art_"+rateid).hide();

                        $("#Hist_art_"+rateid).find('#<?php echo $model->rateid; ?>edt_receptiondate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#Hist_art_"+rateid).find('#<?php echo $model->rateid; ?>edt_senddate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });
                         $("#Hist_art_"+rateid).find('#<?php echo $model->rateid; ?>edt_authorizationdate_daty').datepicker({
                                dateFormat : 'yy-mm-dd'

                        });

                 
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listahistoarts') ?>', {'ratechangeartid':ratechangeartid, 'rateid':rateid }, function(response){
                                
                                if(response!=0){
                                      $("#Hist_art_"+rateid).find("#Detal_art_h"+rateid+"_1").find("table tbody").html(response);    
                                }
                            
                            });
                            
                       
                    
                $("#Detal_art_h"+rateid+"_2").find("#creat_art_edit_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#Detal_art_h"+rateid+"_2").find("#update_art_edit_"+rateid).attr("data-ratechangeartid",ratechangeartid);
                $("#Detal_art_h"+rateid+"_2").find("#creat_art_edit_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);
                $("#Detal_art_h"+rateid+"_2").find("#update_art_edit_"+rateid).attr("data-ratechangeartnumber",ratechangeartnumber);   
              
         
     }
     
    function selec_hist_ar(rateartid,rateid){
        
        $("#Detal_art_h"+rateid+"_1").hide();
        $("#Detal_art_h"+rateid+"_2").show();
        $("#Hist_art_"+rateid).find("#creat_art_edit_"+rateid).hide();
         $("#Hist_art_"+rateid).find("#update_art_edit_"+rateid).show();
         $("#Hist_art_"+rateid).find("#update_art_edit_"+rateid).attr("data-rateartid",rateartid);
        
          $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listaartes') ?>', {'rateartid':rateartid}, function(response){
                                          var obj = JSON.parse(response);
                                          
                                        
                                         $("#Detal_art_h"+rateid+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                                                 var elemento= this;
                                                  var tipo= $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).attr("type");
                                                  
                                                    if(tipo=="text"||tipo=="number"){
                                                        
                                                         var div=elemento.id.split('_');
                                                            $.each(obj, function (ind, elem) { 
                                                                 if(div[1]==ind){
                                                                     
                                                                
                                                                     if(div[2]!="enu"){
                                                                     
                                                                         $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).attr("value",elem);
                                                                         $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).val(elem);
                                                                     }else{
                                                                         
                                                                          $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).attr("value",parseInt(elem));
                                                                          $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).val(parseInt(elem));
                                                                     }

                                                                }
                                                            }); 
                                                     }else if(tipo=="checkbox"){
                                                         $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                    
                                                                      $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).prop("checked", true);

                                                                     } 
                                                            }); 
                                                       }else{
                                                            
                                                           $.each(obj, function (ind, elem) { 
                                                             if (ind == elemento.name && elem == 1) {
                                                                   
                                                                      $("#Detal_art_h"+rateid+"_2").find("#changes_1").prop("checked", true);
                                                                       $("#Detal_art_h"+rateid+"_2").find("#changes_2").prop("checked", false);
                                                               }else if(ind == elemento.name && elem == 0){
                                                                   $("#Detal_art_h"+rateid+"_2").find("#changes_1").prop("checked", false);
                                                                   $("#Detal_art_h"+rateid+"_2").find("#changes_2").prop("checked", true); 
                                                               }
                                                            }); 
                                                           
                                                       }

                                               });


                                 });    
        
    }
     
     function limpiar_modal_art_<?php echo $model->rateid;?>(rateid){
     
            $("#rate_art_"+rateid).find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                    var elemento= this;
                    var tipo= $("#rate_art_"+rateid).find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                       $("#rate_art_"+rateid).find("#"+elemento.id).attr("value","");
                           
                     }else if(tipo=="checkbox"){
                         $("#rate_art_"+rateid).find("#"+elemento.id).prop("checked", false);
                       }else{
                          if(elemento.id=="change_1"){
                                $("#rate_art_"+rateid).find("#"+elemento.id).prop("checked", false);
                          }else  if(elemento.id=="change_2"){
                              $("#rate_art_"+rateid).find("#"+elemento.id).prop("checked", true);
                          } 
                         
                       }
                    
            });
     
     }
     
     function limpiar_modal_edit_art_<?php echo $model->rateid;?>(rateid){
     
            $("#Detal_art_h"+rateid+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                    var elemento= this;
                    var tipo= $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                       $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).attr("value","");
                           
                     }else if(tipo=="checkbox"){
                         $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                       }else{
                          if(elemento.id=="change_1"){
                                $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                          }else  if(elemento.id=="change_2"){
                              $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).prop("checked", true);
                          } 
                         
                       }
                    
            });
            $("#Detal_art_h"+rateid+"_1").hide();
            $("#Detal_art_h"+rateid+"_2").show(); 
            $("#Detal_art_h"+rateid+"_2").find("#creat_art_edit_"+rateid).show();
            $("#Detal_art_h"+rateid+"_2").find("#update_art_edit_"+rateid).hide();
     
     }
     
      function limpiar_modal_cancel_art_<?php echo $model->rateid;?>(rateid){
     
            $("#Detal_art_h"+rateid+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                    var elemento= this;
                    var tipo= $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).attr("type");
                    if(tipo=="text"||tipo=="number"){
                        
                       $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).attr("value","");
                         $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).val("");
                           
                     }else if(tipo=="checkbox"){
                         $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                       }else{
                          if(elemento.id=="change_1"){
                                $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).prop("checked", false);
                          }else  if(elemento.id=="change_2"){
                              $("#Detal_art_h"+rateid+"_2").find("#"+elemento.id).prop("checked", true);
                          } 
                         
                       }
                    
            });
            $("#Detal_art_h"+rateid+"_1").show();
            $("#Detal_art_h"+rateid+"_2").hide(); 
            $("#Detal_art_h"+rateid+"_2").find("#creat_art_edit_"+rateid).hide();
            $("#Detal_art_h"+rateid+"_2").find("#update_art_edit_"+rateid).hide();
     
     }
     
     
     function nuevo_art_edit_<?php  echo $model->rateid;?>(x){
     
        var cadena=x;
        var ratechangeartid=$("#Detal_art_h"+cadena+"_2").find("#creat_art_edit_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#Detal_art_h"+cadena+"_2").find("#creat_art_edit_"+cadena).data("ratechangeartnumber");
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
       
        $("#Detal_art_h"+cadena+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#Detal_art_h"+cadena+"_2").find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena ||div[0]==cadena+'edt'  ){
                                       // valid=valid_expresion_form(elemento.id);
                                       
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                   
                                     if ( $("#Detal_art_h"+cadena+"_2").find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.name]=1;
                                       
                                    } else{
                                          integrador[elemento.name]=0;
                                    }
                                   
                               }else{
                                 if( $("#Detal_art_h"+cadena+"_2").find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#Detal_art_h"+cadena+"_2").find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                       
                          
                       
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/createartregis') ?>', {'arrai':integrador}, function(response){
                                        
                                        if(response != 0){
                                            
                                             $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listahistoarts') ?>', {'ratechangeartid':ratechangeartid, 'rateid':cadena }, function(result){

                                                    if(result!=0){
                                                          $("#Hist_art_"+cadena).find("#Detal_art_h"+cadena+"_1").find("table tbody").html(result);    
                                                    }

                                                });
                                           
                                           
                                                alert('Se guardo la informacion correctamente.');
                                                limpiar_modal_cancel_art_<?php echo $model->rateid;?>(cadena);
                                                 $("#Hist_art_"+cadena).find("#Detal_art_h"+cadena+"_1").show();  
                                                $("#Hist_art_"+cadena).find("#Detal_art_h"+cadena+"_2").hide();    
                                              //$('#rate_art_'+cadena).modal('hide');
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                           
        
    }
   
     function actualizar_arte_edit_<?php  echo $model->rateid;?>(x){
        var cadena=x;
        var ratechangeartid=$("#Detal_art_h"+cadena+"_2").find("#update_art_edit_"+cadena).data("ratechangeartid");
        var ratechangeartnumber=$("#Detal_art_h"+cadena+"_2").find("#update_art_edit_"+cadena).data("ratechangeartnumber");
        var rateartid=$("#Detal_art_h"+cadena+"_2").find("#update_art_edit_"+cadena).data("rateartid")
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
            integrador['ratechangeartid']=ratechangeartid;
            integrador['rateartid']=rateartid;
            
        $("#Detal_art_h"+cadena+"_2").find('input[type=text],input[type=checkbox],input[type=radio]').each(function() {
                              var elemento= this;
                              var tipo=$("#Detal_art_h"+cadena+"_2").find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]==cadena||div[0]==cadena+'edt'){
                                      
                                           integrador[div[1]]=elemento.value;
                                        
                                   }
                               }else if(tipo=="checkbox"){
                                     if ( $("#Detal_art_h"+cadena+"_2").find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.name]=1;
                                       
                                    } else{
                                          integrador[elemento.name]=0;
                                    }
                                   
                               }else{
                                 if( $("#Detal_art_h"+cadena+"_2").find("#" + elemento.id).is(':checked')){
                                   var si_no= $("#Detal_art_h"+cadena+"_2").find("#" + elemento.id).val();
                                  
                                   integrador[elemento.name]=si_no;
                                 }
                               
                               }
                               
                           });
                        
                          
                      
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/updateartregis') ?>', {'arrai':integrador}, function(response){
                                      
                                        if(response != 0){
                                                    
                                                     $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listahistoarts') ?>', {'ratechangeartid':ratechangeartid, 'rateid':cadena }, function(result){

                                                          if(result!=0){
                                                                $("#Hist_art_"+cadena).find("#Detal_art_h"+cadena+"_1").find("table tbody").html(result);    
                                                          }

                                                      });
                                         
                                                 alert('Se actualizo la informacion correctamente');
                                                 limpiar_modal_cancel_art_<?php echo $model->rateid;?>(cadena);
                                                 $("#Hist_art_"+cadena).find("#Detal_art_h"+cadena+"_1").show();  
                                                $("#Hist_art_"+cadena).find("#Detal_art_h"+cadena+"_2").hide();    
                                           
                                    }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                          
        
    } 
     
     
</script>