
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header id="cabezera">
                    <span class="widget-icon">   </span>
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
                                            <?php if ($add == 1) { ?> <div class="btn-group btn-group-sm">
                                                    <a href="#newproject3" class="btn btn-success" id="btnusernew" data-target="#newproject3" onclick="onclin()" data-toggle="modal">Nuevo Usuario Proveedor</a>
                                                </div><?php } ?> 
                                        </section>
                                        <section class="col col-4" id="usertype_dv">


                                            </select>	
                                        </section>
                                        <section class="col col-5">

                                        </section>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <br><br>
                        <table id="user_list_table" class="table table-striped " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nombre Completo</th>
                                    <th>Usuario</th>
                                    <th>Password</th>
                                    <th>Compañia</th>
                                    <th>Proveedor</th>
                                    
                                    <?php if ($del == 1) { ?><th style="width:5%;">Borrar</th><?php } ?>
                                </tr>
                            </thead>
                            <tbody>

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




<div class="modal fade" id="newproject3" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="title-modal-crea">Nuevo Proveedor</h4>
            </div>
            <div class="modal-body no-padding" >
                <form method="post" action="#" id="nproyectnewuser" novalidate="novalidate" class="smart-form">	
                    <fieldset style="height: 400px; overflow-x: none; overflow-y: auto;" id="relista1">

                        <table class="table table-bordered" id="list-modal-newuser">
                            <tbody>
                                 
                                <tr>
                                    <td style="width:207px; " ><label for="NTproject">Nombre</label></td><td style="width:362px;" id="NT_firstnametd">
                                        <input type="text" id="NT_firstname_dsc" onblur="this.value = this.value.toUpperCase()" />
                                    </td>
                                </tr>

                                <tr>
                                    <td ><label for="NTproject">Apellido Paterno</label></td><td  id="NT_plastnametd">
                                        <input type="text" id="NT_plastname_dsc" onblur="this.value = this.value.toUpperCase()"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Apellido Materno</label></td><td  id="NT_mlastnametd">
                                        <input type="text" id="NT_mlastname_dsc" onblur="this.value = this.value.toUpperCase()" />
                                    </td>
                                </tr>

                                <tr>
                                    <td ><label for="NTproject">NickName</label></td>
                                    <td id="NT_usernametd">
                                        <input type="text" id="NT_username_use" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">Password</label></td><td id="NT_passwordtd">
                                        <input type="password" id="NT_password_passwo"  />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">E-mail</label></td><td id="NT_emailtd">
                                        <input type="text" id="NT_email_ema" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">Telefono </label></td><td id="NT_phonetd">
                                        <input type="text" id="NT_phone_enu" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">Compañia </label></td><td id="ES_user_companyidtd">
                                    <!--<input type="text" id="NTcliente" />-->

                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">Proveedor </label></td>
                                    <td id="ES_user_supplieridtd">
                                        
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </fieldset>
                 
                
                    
                    
                   

                    <footer>
                        
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject3"  type="button" onclick="next_form(1)"  >Guardar</button>
                        <button  class="btn btn-default" id="sendproject3_c"  type="button" onclick="next_form(2)"  >Cancelar</button>
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-'dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="newproject4" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="title-modal-crea">Editar Proveedor</h4>
            </div>
            <div class="modal-body no-padding" >
                <form method="post" action="#" id="nproyectedituser" novalidate="novalidate" class="smart-form">	
                    <fieldset style="height: 400px; overflow-x: none; overflow-y: auto;" id="relista1">

                        <table class="table table-bordered" id="list-modal-edituser">
                            <tbody>

                                <tr>
                                    <td style="width:207px; " ><label for="NTproject">Nombre</label></td><td style="width:362px;" id="ET_firstnametd">
                                        <input type="text" id="ET_firstname_dsc" onblur="this.value = this.value.toUpperCase()" />
                                    </td>
                                </tr>

                                <tr>
                                    <td ><label for="NTproject">Apellido Paterno</label></td><td  id="ET_plastnametd">
                                        <input type="text" id="ET_plastname_dsc" onblur="this.value = this.value.toUpperCase()"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Apellido Materno</label></td><td  id="ET_mlastnametd">
                                        <input type="text" id="ET_mlastname_dsc" onblur="this.value = this.value.toUpperCase()" />
                                    </td>
                                </tr>

                                <tr>
                                    <td ><label for="NTproject">NickName</label></td>
                                    <td id="NT_usernametd">
                                        <input type="text" id="ET_username_use" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">Password</label></td><td id="ET_passwordtd">
                                        <input type="password" id="ET_password_passwo"  />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">E-mail</label></td><td id="ET_emailtd">
                                        <input type="text" id="ET_email_ema" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">Telefono </label></td><td id="ET_phonetd">
                                        <input type="text" id="ET_phone_enu" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">Compañia </label></td><td id="edit_user_companyidtd">
                                    <!--<input type="text" id="NTcliente" />-->

                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">Proveedor </label></td><td id="edit_user_supplieridtd">

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject4_sg" onclick="edit_suppliernew()"  type="button" onclick="" >Aceptar</button>
                        <button  class="btn btn-default" id="sendproject4_c"  type="button"  data-dismiss="modal" >Cancelar</button>
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-'dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!
    pageSetUp();
    $("#cabezera").html('<span class="widget-icon"><i class="fa fa-th-large "></i></span><h2>Usuarios Proveedor</h2>');
    var global_identi = 1;
    var oTable_perm;
    $('#tbl_smodules').hide();
    
     oTable = $('#user_list_table').dataTable({
        "responsive": true,
        "sAjaxSource": "<?php echo Yii::app()->createUrl('/portoprint/user/supplierindex/usertype/' . Utils::encrypt($usertype, 'user') . '/edit/' . Utils::encrypt($edt, 'user') . '/del/' . Utils::encrypt($del, 'user')); ?>",
        "aoColumns": [
            { "mData": "namecomp", sDefaultContent: "", "sWidth": "20%", sClass :"edt_sup" },
            { "mData": "usuario", sDefaultContent: "",  "sWidth": "10%", sClass :"edt_sup" },
            { "mData": "password", sDefaultContent: "", "sWidth": "10%"},
            { "mData": "compania", sDefaultContent: "", "bSearchable": false, "sWidth": "30%"},
            { "mData": "proveedor", sDefaultContent: "", "sWidth": "15%", "sClass": "alignRight" }<?php if ($del == 1) { ?>,
            { "mData": "status", sDefaultContent: "", "sWidth": "5%", "sClass": "alignRight"}  <?php } ?>


         ],
        "bLengthChange":false,
        "oLanguage": {
            "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
            "sEmptyTable": "No hay registros.",
            "sInfoEmpty" : "No hay registros.",
            "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
            "sProcessing": "Procesando",
            "sSearch": "Buscar:",
            "sZeroRecords": "No hay registros",
        },
        "dom":'ftp' <?php if ($edt == 1) { ?>,
        
            "fnInitComplete": function(oSettings) {
            
            $('tbody .edt_supli').hover(function(){
            if ($(this).find('span.glyphicon').length > 0 || $(this).find('input').length > 0){

                return false

            } else{

                $(this).html('<span class="glyphicon glyphicon-pencil" style="float:left;">&nbsp;</span>' + $(this).html());
                var userid = $(this).attr("id");
             
                $("#" + userid).click(function(){
                     var id = userid.split('_');

                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/useredit'); ?>', { userid:id[0] }, function(response){

                        $("#list-modal-edituser").find('input').each(function() {
                            var elemento = this;
                            var cadena = response.split(',');
                            var div = elemento.id.split('_');
                            
                            if (div[0] == 'ET'){
                                for (i = 0; i < cadena.length; i++){
                                     var separa = cadena[i].split('-');
                                     if (separa[0] == div[1]){
                                            $("#list-modal-edituser").find("#" + elemento.id).val(separa[1]);
                                        } else{
                                             if (separa[0] == "userid"){
                                                $("#list-modal-edituser").attr("data-ids", separa[1]);
                                              }
                                        }
                                 }

                            }


                        });
                    });
                  

                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/companyselec'); ?>', {userid:id[0] }, function(response){
                        $("#edit_user_companyidtd").html('<select id="edit_user_companyid" name="user_companyid" style="width: 300px;"  ><option value="0">Seleccione una Compania</option>' + response + '</select>');
                        $("#edit_user_companyid").select2();
                    });
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/supplierselec'); ?>', {userid:id[0] }, function(response){
                        $("#edit_user_supplieridtd").html('<select id="edit_user_supplierid" name="usersupplierid" style="width: 300px;"><option value="0">Seleccione un Proveedor</option>' + response + '</select>');
                        $("#edit_user_supplierid").select2();
                    });
                    document.href = "#newproject4";
                });
            }
            }, function(){
            //  $(this).html();

            $(this).find('span.glyphicon').remove();
            });
            }<?php } ?>

    });
    
  $('.widget-body').find('input[type=search]').on( 'keyup', function () {
        $('.edt_supli').hover(function(){
            if ($(this).find('span.glyphicon').length > 0 || $(this).find('input').length > 0){

                return false

            } else{

                $(this).html('<span class="glyphicon glyphicon-pencil" style="float:left;">&nbsp;</span>' + $(this).html());
                var userid = $(this).attr("id");
               
                $("#" + userid).click(function(){
                     var id = userid.split('_');

                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/useredit'); ?>', { userid:id[0] }, function(response){

                        $("#list-modal-edituser").find('input').each(function() {
                            var elemento = this;
                            var cadena = response.split(',');
                            var div = elemento.id.split('_');
                            
                            if (div[0] == 'ET'){
                                for (i = 0; i < cadena.length; i++){
                                     var separa = cadena[i].split('-');
                                     if (separa[0] == div[1]){
                                            $("#list-modal-edituser").find("#" + elemento.id).val(separa[1]);
                                        } else{
                                             if (separa[0] == "userid"){
                                                $("#list-modal-edituser").attr("data-ids", separa[1]);
                                              }
                                        }
                                 }

                            }


                        });
                    });
                  

                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/companyselec'); ?>', {userid:id[0] }, function(response){
                        $("#edit_user_companyidtd").html('<select id="edit_user_companyid" name="user_companyid" style="width: 300px;"  ><option value="0">Seleccione una Compania</option>' + response + '</select>');
                        $("#edit_user_companyid").select2();
                    });
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/supplierselec'); ?>', {userid:id[0] }, function(response){
                        $("#edit_user_supplieridtd").html('<select id="edit_user_supplierid" name="usersupplierid" style="width: 300px;"><option value="0">Seleccione un Proveedor</option>' + response + '</select>');
                        $("#edit_user_supplierid").select2();
                    });
                    document.href = "#newproject4";
                });
            }
            }, function(){
            //  $(this).html();

            $(this).find('span.glyphicon').remove();
            });
    });

    
function next_form(x){

   
    var valid = 0;
    var bandera = 0;
    var bandera1 = 0;
    var bandera2 = 0;
    var bandera3 = 0;
    var valueToPush = new Array();
    var integrador = { };
    
    switch (x){

        case 1:
           
            $("#nproyectnewuser").find('input[type=text],input[type=password]').each(function() {
                    var elemento = this;
                    var div=elemento.id.split('_');
                    if (div[0] == 'NT'){
                      
                        valid = valid_expresion_form(elemento.id);
                        if (valid == 1){
                            bandera = 1;
                        } else{
                            if (div[1] == 'username'){
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/valnick') ?>', {'username':elemento.value}, function(response){
                                    if (response == 0){
                                        $("#NT_usernametd").find(".error").remove();
                                        bandera = 1;
                                        $('<label class="error" generated="true">El nickname de usuario ya existe, escriba otro</label>').appendTo("#NT_usernametd");
                                    } else{
                                            var div1 = response.split('_');
                                            $("#nproyectnewuser").attr("data-username", div1[0] + '_' + div1[1]);
                                            integrador[div1[1]] = div1[1];
                                    }
                                });
                                if (bandera == 0){
                                    integrador[div[1]] = elemento.value;
                                }

                            } else{
                            integrador[div[1]] = elemento.value;
                            }
                        }
                   }



              });
              
    if ($("#user_companyid").val() != 0){
            $("#ES_user_companyidtd").find(".error").remove();
            integrador['companyid'] = $("#user_companyid").val();
            bandera2 = 0;
    } else{
            $("#ES_user_companyidtd").find(".error").remove();
            bandera2 = 1;
            $('<label class="error" generated="true">Debe seleccionar una compañia</label>').appendTo("#ES_user_companyidtd");
    }
        
    if ($("#user_supplierid").val() != 0){
            $("#ES_user_supplieridtd").find(".error").remove();
            integrador['supplierid'] = $("#ES_user_supplierid").val();
            bandera3 = 0;
    } else{
            $("#ES_user_supplieridtd").find(".error").remove();
            bandera3 = 1;
            $('<label class="error" generated="true">Debe seleccionar una Proveedor</label>').appendTo("#ES_user_supplieridtd");
    }
    
    console.log(integrador);
       
       if (bandera == 0 && bandera2 == 0 && bandera3 == 0){
      
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/createnewsupplier') ?>', {'arrai':integrador}, function(response){

                      if (response != 0){
                            alert('Se a realizado la insercion correctamente.');
                            $('#nproyectnewuser').modal('hide');
                            var sep = response.split(',');
                               location.reload();
                        }else{
                            alert('No se a podido guardar el registro.');
                        }
             });
         }else{
             alert('Hay errores en los campos que desea guardar');
         }
        break;
        
        case 2:
            
            $("#nproyectnewuser").find('input[type=text]').each(function() {
                    var elemento= this;
                   $("#nproyectnewuser").find("#"+elemento.id).attr("value","");
                   $("#nproyectnewuser").find("#"+elemento.id).val("");
            });
           onclin1();
        break;
       }
    }

    function onclin(){


    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/company'); ?>', function(response){
            $("#ES_user_companyidtd").html('<select id="user_companyid" name="user_companyid" style="width: 300px;" onchange="select_supplier(this.value)"  ><option value="0">Seleccione una Compania</option>' + response + '</select>');
             $("#user_companyid").select2();
       });
          
    }
    
     function onclin1(){


    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/company'); ?>', function(response){
            $("#ES_user_companyidtd").html('<select id="user_companyid" name="user_companyid" style="width: 300px;"  ><option value="0">Seleccione una Compania</option>' + response + '</select>');
             $("#user_companyid").select2();
       });
            
        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/supplier'); ?>', {userid:<?php echo Yii::app()->user->userid; ?> }, function(response){
                $("#ES_user_supplieridtd").html('<select id="ES_user_supplierid" name="usersupplierid" style="width: 300px;"><option value="0">Seleccione un Proveedor</option>' + response + '</select>');
                $("#ES_user_supplierid").select2();
         });
          
          
          
    }
    
    function select_supplier(id){
    
        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/supplier'); ?>', {companyid:id }, function(response){
                $("#ES_user_supplieridtd").html('<select id="ES_user_supplierid" name="usersupplierid" style="width: 300px;"><option value="0">Seleccione un Proveedor</option>' + response + '</select>');
                $("#ES_user_supplierid").select2();
         });
    
    }

function edit_suppliernew(){
    var valid = 0;
    var bandera = 0;
    var bandera3 = 0;
    var integrador = { };
    $("#list-modal-edituser").find('input[type=text],input[type=password]').each(function() {
        var elemento = this;
        var div = elemento.id.split('_');
        if (div[0] == 'ET'){
                valid = valid_expresion_form(elemento.id);
                if (valid == 1){
                    bandera = 1;
                } else{

                    integrador[div[1]] = elemento.value;
                }
         }
    });
    integrador['userid'] = $("#list-modal-edituser").data("ids");

    if ($("#edit_user_companyid").val() != 0){
            $("#edit_user_companyidtd").find(".error").remove();
            integrador['companyid'] = $("#edit_user_companyid").val();
            bandera2 = 0;
    } else{
            $("#edit_user_companyidtd").find(".error").remove();
            bandera2 = 1;
            $('<label class="error" generated="true">Debe seleccionar una compañia</label>').appendTo("#edit_user_companyidtd");
    }
        
    if ($("#edit_user_supplierid").val() != 0){
            $("#edit_user_supplieridtd").find(".error").remove();
            integrador['supplierid'] = $("#edit_user_supplierid").val();
            bandera3 = 0;
    } else{
            $("#edit_user_supplieridtd").find(".error").remove();
            bandera3 = 1;
            $('<label class="error" generated="true">Debe seleccionar una Proveedor</label>').appendTo("#edit_user_supplieridtd");
    }
   // console.log(integrador);
      
       if (bandera == 0 && bandera2 == 0 && bandera3 == 0){

            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/updatesupplier') ?>', {'arrai':integrador}, function(response){
                // console.log(response);
                if (response != 0){
                    alert('Se actualizado correctamente.');
                        location.reload();
                }
            });
        } else{
          alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
        }
}

    function delet_supplier(id){
    var usuarioid = id.split('_');
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/delteuser') ?>', {'userid':usuarioid[1]}, function(response){

            if (response != 0){
                alert('Se borrado correctamente.');
                    location.reload();
            }



            });
    }


</script>
<style media="all" type="text/css">
    .alignRight { text-align: center; }
    .edt_usu {cursor: pointer; flex-flow:row nowrap;}
</style>    