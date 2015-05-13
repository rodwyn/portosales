    <header>
    <strong>Producción</strong>
</header>
<fieldset>
     <?php          
          
              $rateprod=  Rateproduction::model()->find("rateid=".$rateid);
              $list_menu= Permission::model()->findAllByAttributes(array('menuid'=>$menu,'permissiongroup'=>'Produccion'));
              
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
             
              if($rateprod){
                       $tabla= "<table id='produccionrate_list_{$rateid}' class='table table-striped '>
                          <thead>
                                <tr>
                                   <th colspan='2'>Informacion</th>
                                </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td>Se han llenado los detalles de produccion  </td> <td>";
                                        
                                         $tabla.="<div class='btn-group btn-group-sm'>
                                                        <a href='#DetailProduc_edit_{$rateid}' class='btn btn-success' onclick='cargar_id_{$rateid}({$rateprod->rateproductionid},{$rateid})' data-target='#DetailProduc_edit_{$rateid}'  data-toggle='modal'>Editar</a>
                                                    </div>";
                            $tabla.="</td></tr>
                          </tbody>
                       </table>";
                                                                                                
              }else{
                  $tabla="<table id='produccionrate_list_".$rateid."' class='table table-striped '>
                          <thead>
                                <tr>
                                   <th colspan='2'>Informacion</th>
                                </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td>Favor de completar detalles de produccion</td> <td>";
                                   if(count($agregar)>0 && $agregar[0]['active']==1){ 
                                       
                                    $tabla.="<div class='btn-group btn-group-sm'>
                                                        <a href='#DetailProduc_{$rateid}' class='btn btn-success' data-target='#DetailProduc_{$rateid}' name='DetailProduc_{$rateid}'  onclick='lista_selecst(this.name)'  data-toggle='modal'>Agregar</a>
                                                    </div>";
                                   }
                            $tabla.="</td></tr>
                          </tbody>
                       </table>";
              }
            
              echo $tabla;
          ?>
    
</fieldset>

<div class="modal fade" id="DetailProduc_<?php  echo $rateid;?>"  tabindex="-1" role="dialog" aria-labelledby="DetailProduc_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de Producción</h4>
      </div>
      <div class="modal-body no-padding" >
        <form method="post" action="#"  id="rateproduction_<?php echo $rateid; ?>" novalidate="novalidate" class="smart-form">
		<fieldset>
                <table cellspacing="2" border="0"   class="table table-bordered">
                <tbody><tr>
                    <td ><label for="NTproject">Fecha de autorización</label></td>
                    <td >
                    <label class="input" id="NT_authorizationdatetd"> 
                        <i class="icon-append fa fa-calendar"></i>
                        <input type="text"  name="authorizationdate" id="NT_authorizationdate_daty" value="" >
                    </label>
                    </td>
                    <td ><label for="NTproject">Quien autoriza</label></td>
                    <td id="NT_authorizedtd"><input type="text"  name="authorized" id="NT_authorized_dsc" value=""></td>
                </tr>
                <tr>
                        <td><label for="NTproject">Fecha y hora de entrada a maquina</label></td>
                        <td id="NT_datetimeproductiontd" class="container" >
                            <label class="input" style=" width: 165px;  float: left;" > 
                           
                                <input type='text' size="11" class="form-control" placeholder="Fecha" name="dateTimeProduction"  id="NT_datetimeproduction_daty" value="" <?php echo $editable;?>>
                                <i class="icon-append fa fa-calendar"></i>
                            </label>
                            
                            <label class="input" style=" width: 160px;  float: right;"  > 
                                <select id="lis_hora"  style="width: 70px;" ></select>:
                                <select id="lis_min" style="width: 70px;" ></select>
                               
                           </label>
                            
                          
                            
                        </td>
                        <td><label for="NTproject">Tipo de archivo / versión</label></td>
                        <td id="NT_filetypetd"><input type="text"  name="fileType"  id="NT_filetype_dsc" value=""></td>
                </tr>
                <tr>
                    <td colspan="2">Color <input type="checkbox" value="TRUE" id="color" name="color">&nbsp;&nbsp;&nbsp;
                                         Registro <input type="checkbox" value="TRUE" id="record" name="record">&nbsp; &nbsp;&nbsp;
                                         Piojos <input type="checkbox" value="TRUE" id="piojos" name="piojos">&nbsp; &nbsp;&nbsp;
                                         Bandeado <input type="checkbox" value="TRUE" id="banded" name="banded">&nbsp; &nbsp;&nbsp;
                        </td>
                        <td>Cantidad y empaque</td>
                        <td id="NT_quantitytd"><input type="text" name="quantity" id="NT_quantity_enu" ></td>
                </tr>
	<tr>
		<td colspan="4">&nbsp;<strong>Acabados</strong></td>
	</tr>
	<tr>
            <td colspan="4" style=" border-bottom : 0px dashed white;">
		Fuentes <input type="checkbox" value="TRUE" name="font" id="font">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Textos <input type="checkbox" value="TRUE" name="text" id="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Uv Registro <input type="checkbox" value="TRUE" name="uvrecord" id="uvrecord">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Uv Plasta <input type="checkbox" value="TRUE" name="uvcake" id="uvcake">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Empalme <input type="checkbox" value="TRUE" name="splice" id="splice">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Laminado  <input type="checkbox" value="TRUE" name="laminate" id="laminate">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
            <td colspan="4" style="border-top : 0px dashed white;  border-bottom : 0px dashed black;">
		Medidas <input type="checkbox" value="TRUE" name="measures" id="measures">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Resbases <input type="checkbox" value="TRUE" name="reline" id="reline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Suaje <input type="checkbox" value="TRUE" name="suaje" id="suaje">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Pegue <input type="checkbox" value="TRUE" name="paste" id="paste">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Refine <input type="checkbox" value="TRUE" name="refine" id="refine">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Doblez  <input type="checkbox" value="TRUE" name="fold" id="fold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>	
	<tr>
            <td colspan="4" style="border-top : 0px dashed white;  border-bottom : 0px dashed black;">
		Imagenes <input type="checkbox" value="TRUE" name="images" id="images">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tintas <input type="checkbox" value="TRUE" name="inks" id="inks">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Engrapados <input type="checkbox" value="TRUE" name="staple" id="staple">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Hot Melt <input type="checkbox" value="TRUE" name="hotmelt" id="hotmelt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Maquilas <input type="checkbox" value="TRUE" name="maquilas" id="maquilas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		</td>
	</tr>	
	<tr>
		<td>Tiraje</td>
                <td id="NT_printingtd"><input type="text" size="10" name="printing" id="NT_printing_enu" value=""> pliegos</td>
		<td>Muestras revisadas</td>
		<td id="NT_revisedSamplestd"><input type="text"  name="revisedSamples"  id="NT_revisedsamples_enu" value=""></td>
	</tr>		
	<tr>
		<td>Autorizó producción</td>
		<td id="NT_authorizationproducciontd" ><input type="text"  name="authorizationProduccion" id="NT_authorizationproduccion_dsc" value=""></td>
		<td>Fecha de autorización</td>
		<td id="NT_authorizationdate2td">
                 <label class="input"> 
                        <i class="icon-append fa fa-calendar"></i>
                        <input type="text"  name="authorizationDate2"  id="NT_authorizationdate2_daty" value="" >
                 </label>
                </td>
	</tr>	
	<tr>
		<td>Observaciones</td>
		<td id="NT_commentstd"><input type="text"  name="comments" id="NT_comments_dsc" value=""></td>
		<td colspan="2">&nbsp;</td>
                
	</tr>									
	<tr>
		<td colspan="4" align="center">&nbsp;<input type="hidden" name="rateid" value="<?php echo $rateid;?>"></td>
	</tr>
</tbody></table>
		</fieldset>
        <footer>
	      	<button class="btn btn-primary" type="button" onclick="char_producci_<?php echo $rateid;?>('<?php echo $rateid; ?>')">Generar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
</form>

 </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="DetailProduc_edit_<?php  echo $rateid;?>"  tabindex="-1" role="dialog" aria-labelledby="DetailProduc_edit_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de Producción</h4>
      </div>
      <div class="modal-body no-padding" >
        <form method="post" action="#"  id="rateproduction_edit_<?php echo $rateid; ?>" novalidate="novalidate" class="smart-form">
		
            
            
            
            
            <fieldset>
                       
                              
                
                <table cellspacing="2" border="0"   class="table table-bordered" style="">
                <tbody><tr>
                    <td ><label for="NTproject">Fecha de autorización</label></td>
                    <td >
                    <label class="input" style=" width: 165px;"  id="EDT_authorizationdatetd"> 
                        <i class="icon-append fa fa-calendar"></i>
                        <input type="text"  name="authorizationDate" id="EDT_authorizationdate_daty" value="" <?php echo $editable;?> >
                    </label>
                    </td>
                    <td ><label for="NTproject">Quien autoriza</label></td>
                    <td id="EDT_authorizedtd"><input type="text"  name="authorized" id="EDT_authorized_dsc" value="" <?php echo $editable;?>></td>
                </tr>
                <tr>
                        <td><label for="NTproject">Fecha y hora de entrada a maquina</label></td>
                        <td id="EDT_datetimeproductiontd"  class="container" >
                           
                            
                            <label class="input" style=" width: 165px;  float: left;" > 
                           
                                <input type='text' size="11" class="form-control" placeholder="Fecha" name="datetimeproduction"  id="EDT_datetimeproduction_daty" value="" <?php echo $editable;?>>
                                <i class="icon-append fa fa-calendar"></i>
                            </label>
                            
                            <label class="input" style=" width: 160px;  float: right;"  > 
                                <select id="lis_hora"  style="width: 70px;" ></select>:
                                <select id="lis_min" style="width: 70px;" ></select>
                               
                           </label>
                            
                            
                           

                            
                        </td>
                        <td><label for="NTproject">Tipo de archivo / versión</label></td>
                        <td  id="EDT_filetypetd"><input class="input" type="text"  name="fileType"  id="EDT_filetype_dsc" value="" <?php echo $editable;?>></td>
                </tr>
                <tr>
                    <td colspan="2">Color <input type="checkbox" value="TRUE" id="color" name="color" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;
                                         Registro <input type="checkbox" value="TRUE" id="record" name="record" <?php echo $editable;?>>&nbsp; &nbsp;&nbsp;
                                         Piojos <input type="checkbox" value="TRUE" id="piojos" name="piojos" <?php echo $editable;?>>&nbsp; &nbsp;&nbsp;
                                         Bandeado <input type="checkbox" value="TRUE" id="banded" name="banded" <?php echo $editable;?>>&nbsp; &nbsp;&nbsp;
                        </td>
                        <td>Cantidad y empaque</td>
                        <td id="EDT_quantitytd"><input type="number" name="quantity" id="EDT_quantity_enu" <?php echo $editable;?>></td>
                </tr>
	<tr>
		<td colspan="4">&nbsp;<strong>Acabados</strong></td>
	</tr>
	<tr>
            <td colspan="4" style=" border-bottom : 0px dashed white;">
		Fuentes <input type="checkbox" value="TRUE" name="font" id="font" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Textos <input type="checkbox" value="TRUE" name="text" id="text" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Uv Registro <input type="checkbox" value="TRUE" name="uvrecord" id="uvrecord" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Uv Plasta <input type="checkbox" value="TRUE" name="uvcake" id="uvcake" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Empalme <input type="checkbox" value="TRUE" name="splice" id="splice" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Laminado  <input type="checkbox" value="TRUE" name="laminate" id="laminate" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
            <td colspan="4" style="border-top : 0px dashed white;  border-bottom : 0px dashed black;">
		Medidas <input type="checkbox" value="TRUE" name="measures" id="measures" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Resbases <input type="checkbox" value="TRUE" name="reline" id="reline" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Suaje <input type="checkbox" value="TRUE" name="suaje" id="suaje" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Pegue <input type="checkbox" value="TRUE" name="paste" id="paste" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Refine <input type="checkbox" value="TRUE" name="refine" id="refine" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Doblez  <input type="checkbox" value="TRUE" name="fold" id="fold" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>	
	<tr>
            <td colspan="4" style="border-top : 0px dashed white;  border-bottom : 0px dashed black;">
		Imagenes <input type="checkbox" value="TRUE" name="images" id="images" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tintas <input type="checkbox" value="TRUE" name="inks" id="inks" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Engrapados <input type="checkbox" value="TRUE" name="staple" id="staple" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Hot Melt <input type="checkbox" value="TRUE" name="hotmelt" id="hotmelt" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Maquilas <input type="checkbox" value="TRUE" name="maquilas" id="maquilas" <?php echo $editable;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		</td>
	</tr>	
	<tr>
		<td>Tiraje</td>
                <td id="EDT_printingtd"><input type="number" size="10" name="printing" id="EDT_printing_enu" value="" <?php echo $editable;?>> pliegos</td>
		<td>Muestras revisadas</td>
		<td id="EDT_revisedsamplestd"><input type="number"  name="revisedSamples"  id="EDT_revisedsamples_enu" value="" <?php echo $editable;?>></td>
	</tr>		
	<tr>
		<td>Autorizó producción</td>
		<td id="EDT_authorizationproducciontd" ><input type="text"  name="authorizationProduccion" id="EDT_authorizationproduccion_dsc" value="" <?php echo $editable;?>></td>
		<td>Fecha de autorización</td>
		<td id="EDT_authorizationdate2td">
                 <label class="input"> 
                        <i class="icon-append fa fa-calendar"></i>
                        <input type="text"  name="authorizationDate2"  id="EDT_authorizationdate2_daty" value=""<?php echo $editable;?> >
                 </label>
                </td>
	</tr>	
	<tr>
		<td>Observaciones</td>
		<td id="EDT_commentstd"><input type="text"  name="comments" id="EDT_comments_dsc" value="" <?php echo $editable;?>></td>
		<td colspan="2">&nbsp;</td>
                
	</tr>									
	<tr>
		<td colspan="4" align="center">&nbsp;<input type="hidden" name="rateid" value="<?php echo $rateid;?>"></td>
	</tr>
            </tbody>
     </table>
		
            </fieldset>
                 <footer>
                        <button class="btn btn-primary" type="button"  id="edit_prod_<?php echo $rateid;?>" onclick="edit_producci_<?php echo $rateid;?>('<?php echo $rateid; ?>')">Actualizar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
</form>

 </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    var cad="<?php echo $rateid;?>";
   
    $("#rateproduction_<?php  echo $rateid;?>").find('#NT_authorizationdate_daty').datepicker({
			dateFormat : 'yy-mm-dd'
			
		});
     $("#rateproduction_<?php  echo $rateid;?>").find('#NT_authorizationdate2_daty').datepicker({
			dateFormat : 'yy-mm-dd'
			
		});
   $("#rateproduction_<?php  echo $rateid;?>").find('#NT_datetimeproduction_daty').datepicker({
                        dateFormat : 'yy-mm-dd'
                     });  
                     
                     
    
    $("#rateproduction_edit_<?php  echo $rateid;?>").find('#EDT_authorizationdate_daty').datepicker({
			dateFormat : 'yy-mm-dd'
			
		});
     $("#rateproduction_edit_<?php  echo $rateid;?>").find('#EDT_authorizationdate2_daty').datepicker({
			dateFormat : 'yy-mm-dd'
			
		});
    
               $("#rateproduction_edit_<?php  echo $rateid;?>").find('#EDT_datetimeproduction_daty').datepicker({
                       dateFormat : 'yy-mm-dd'
                     });
                
                
          
                    
    function cargar_id_<?php echo $rateid;?>(id,rateid){
        var str='';
        var str1='';
        var str2='';
        for(i=0;i<=23;i++){
            var cadsa='';
            if(i<10){
                cadsa='0';
            }else{
                cadsa='';
            }
                str+="<option value='"+cadsa+i+"'>"+cadsa+i+"</option>";
               
            }
             $("#rateproduction_edit_"+rateid).find('#lis_hora').html(str); 
            
                
            for(i=0;i<60;i++){
            var cadsa='';
            if(i<10){
                cadsa='0';
            }else{
                cadsa='';
            }
                str1+="<option value='"+cadsa+i+"'>"+cadsa+i+"</option>";
           
            }
            $("#rateproduction_edit_"+rateid).find('#lis_min').html(str1); 
             $("#rateproduction_edit_"+rateid).find('#lis_hora').select2();
            $("#rateproduction_edit_"+rateid).find('#lis_min').select2();
            
           
       
       
        $("#rateproduction_edit_"+rateid).find("#edit_prod_"+rateid).attr("data-producctid",id);
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listaproducc') ?>', {'rateproductionid':id}, function(response){
                
                      var obj = JSON.parse(response);
                 
                    
                    $("#rateproduction_edit_"+rateid).find('input[type=text],input[type=checkbox],input[type=number]').each(function() {
                             var elemento= this;
                              var tipo=$("#rateproduction_edit_"+rateid).find("#"+elemento.id).attr("type");
                               if(tipo=="text"||tipo=="number"){
                                   
                                   var sep=elemento.id.split('_');
                                   
                                   if(sep[1]=='datetimeproduction'){
                                      
                                       $.each(obj, function (ind, elem) { 
                                             if(sep[1]==ind){
                                               
                                                 if(elem!=null){
                                                      
                                                  var ele=elem.split(' ');
                                                  var ele1=ele[1].split(':');
                                                  
                                                  $("#rateproduction_edit_"+rateid).find("#"+elemento.id).attr("value",ele[0]);
                                                        
                                                    
                                                   $("#e8").select2("val", ele1[0]);
                                                   
                                                  $("#rateproduction_edit_"+rateid).find("#lis_hora").select2("val", ele1[0]);
                                                  $("#rateproduction_edit_"+rateid).find("#lis_min").select2("val", ele1[1]);
                                              }
                                            }
                                        });
                                          
                                          
                                   }else{
                                     var div=elemento.id.split('_');
                                        $.each(obj, function (ind, elem) { 
                                             if(div[1]==ind){
                                                 if(div[2]!="enu"){
                                                     $("#rateproduction_edit_"+rateid).find("#"+elemento.id).attr("value",elem);
                                                 }else{
                                                      $("#rateproduction_edit_"+rateid).find("#"+elemento.id).attr("value",parseInt(elem));
                                                 }
                                             
                                            }
                                        });
                                        
                                        }
                                 }else{
                                     
                                     $.each(obj, function (ind, elem) { 
                                         if (ind == elemento.id && elem == 1) {
                                          
                                                    $("#rateproduction_edit_"+rateid).find("#"+elemento.id).prop("checked", true);
                                       
                                                 } 
                                        }); 
                               }
                               
                           });
                                        

             });
          
        
           
    }
    
   // action="?r=portoprint/rate/saveproduction/id/<?php echo Utils::encrypt($rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>"
    function char_producci_<?php echo $rateid;?>(x){
        var cadena=x;
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateid']=cadena;
        $("#rateproduction_"+cadena).find('input[type=text],input[type=checkbox]').each(function() {
                              var elemento= this;
                              var tipo=$("#rateproduction_"+cadena).find("#"+elemento.id).attr("type");
                               if(tipo=="text"){
                                   var div=elemento.id.split('_');
                                  if(div[0]=='NT'){
                                        valid=valid_expresion_form(elemento.id);
                                        if(valid==1){
                                           bandera=1;
                                        }else{
                                          if(div[1]=='datetimeproduction'){
                                              
                                                var hora=$("#rateproduction_"+cadena).find("#lis_hora").val()+':'+$("#rateproduction_"+cadena).find("#lis_min").val()+':'+'00';
                                                 
                                                integrador[div[1]]=elemento.value+' '+hora;
                                                
                                              
                                          }else{  
                                                integrador[div[1]]=elemento.value;
                                            }
                                        }
                                   }
                               }else{
                                     if ($("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.id]=1;
                                       
                                    } else{
                                          integrador[elemento.id]=0;
                                    }
                                   
                               }
                               
                           });
                          
                           
                       if (bandera == 0 ){

                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/createproduccionregis') ?>', {'arrai':integrador}, function(response){
                                      
                                        if(response != 0){
                                            var line="<tr><td>Se han llenado los detalles de produccion  </td> <td><div class='btn-group btn-group-sm'><a href='#DetailProduc_edit_"+cadena+"' class='btn btn-success' onclick='cargar_id_"+cadena+"("+response+","+cadena+")' data-target='#DetailProduc_edit_"+cadena+"'  data-toggle='modal'>Editar</a>"+
                                             "</td></tr>";
                                               $("#produccionrate_list_"+cadena).find("tbody").html(line);
                                              $('#DetailProduc_'+cadena).modal('hide');
                                           
                                        }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                            } else{
                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                            }
        
    }
   
     function edit_producci_<?php echo $rateid;?>(rateid){
        var prod=$("#rateproduction_edit_"+rateid).find("#edit_prod_"+rateid).data("producctid");
        var cadena=rateid;
        var valid=0;
        var bandera=0;
        var valueToPush=" ";
        var integrador= { }; 
            integrador['rateproductionid']=prod;
             integrador['rateid']=cadena;
        $("#rateproduction_edit_"+cadena).find('input[type=text],input[type=checkbox],input[type=number]').each(function() {
                              var elemento= this;
                              var tipo=$("#rateproduction_edit_"+cadena).find("#"+elemento.id).attr("type");
                               if(tipo=="text"||tipo=="number"){
                                  
                                        var div=elemento.id.split('_');
                                         
                                            if(div[0]=='EDT'){
                                             
                                               valid=valid_expresion_form(elemento.id);
                                                if(valid==1){
                                                   bandera=1;
                                                }else{
                                                    
                                                    if(div[1]=='datetimeproduction'){
                                              
                                                            var hora=$("#rateproduction_edit_"+cadena).find("#lis_hora").val()+':'+$("#rateproduction_edit_"+cadena).find("#lis_min").val()+':'+'00';

                                                            integrador[div[1]]=elemento.value+' '+hora;


                                                      }else{  
                                                            integrador[div[1]]=elemento.value;
                                                        }
                                                    
                                                    
                                                   //integrador[div[1]]=elemento.value;
                                                }
                                             
                                        }
                               }else{
                                     if ($("#rateproduction_edit_"+cadena).find("#" + elemento.id).is(':checked')) {
                                          
                                           integrador[elemento.id]=1;
                                       
                                    } else{
                                          integrador[elemento.id]=0;
                                    }
                                   
                               }
                               
                           });
                           
                          
                           
                         if (bandera == 0 ){
                                
                                   $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/updateproduccionregis') ?>', {'arrai':integrador}, function(response){
                                       
                                        if(response != 0){
                                            
                                            alert('Se guardo con exito.');
                                                
                                              $('#DetailProduc_edit_'+cadena).modal('hide');
                                           
                                        }else{
                                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                                            }

                                });
                                
                                
                            } else{
                                alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');

                            }
        
    }
  
  
   function  lista_selecst(rateid){
             
          var rate=rateid.split('_');
          var rateid=rate[1];
         var str='';
        var str1='';
        var str2='';
        for(i=0;i<=23;i++){
            var cadsa='';
            if(i<10){
                cadsa='0';
            }else{
                cadsa='';
            }
                str+="<option value='"+cadsa+i+"'>"+cadsa+i+"</option>";
               
            }
            $("#rateproduction_"+rateid).find('#lis_hora').html(str); 
                $("#rateproduction_"+rateid).find('#lis_hora').select2();
                
            for(i=0;i<60;i++){
            var cadsa='';
            if(i<10){
                cadsa='0';
            }else{
                cadsa='';
            }
                str1+="<option value='"+cadsa+i+"'>"+cadsa+i+"</option>";
           
            }
            $("#rateproduction_"+rateid).find('#lis_min').html(str1); 
            $("#rateproduction_"+rateid).find('#lis_min').select2();
   }
  
  
    </script>