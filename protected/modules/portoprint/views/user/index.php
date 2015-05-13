
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2>Usuarios </h2>
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
                                                    <a href="#newproject3" class="btn btn-success" id="btnusernew" data-target="#newproject3" onclick="onclin()" data-toggle="modal">Nuevo Usuario</a>
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
                                    <th>Categorias</th>
                                    <th>Clientes</th>
                                    <th>Permisos</th>
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


<div class="modal fade" id="newproject" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="title-modal-crea"></h4>
                <h6 class="modal-title" id="title-modal-nom"></h6>
            </div>
            <div class="modal-body no-padding" >
                <form method="post" action="#" id="nproyectcatego" novalidate="novalidate" class="smart-form">	
                    <fieldset style="overflow-x:scroll; overflow-x: hidden; height: 200px;">
                        <table class="table table-bordered" id="list-modal-categ">
                            <tbody>



                            </tbody>
                        </table>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject" type="button" onclick="ocultar_model('nproyectcatego')"  data-dismiss="modal">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new">Cerrar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-'dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="newproject1" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="title-modal-crea"></h4>
                <h6 class="modal-title" id="title-modal-nom"></h6>
            </div>
            <div class="modal-body no-padding" >
                <form method="post" action="#" id="nproyectclient" novalidate="novalidate" class="smart-form">	
                    <fieldset style="overflow-x:scroll; overflow-x: hidden; height: 200px;">

                        <table class="table table-bordered" id="list-modal-custom">
                            <tbody>



                            </tbody>
                        </table>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject1" type="button" onclick="ocultar_model('nproyectclient')"  data-dismiss="modal">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new">Cerrar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-'dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="newproject2" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
    <div class="modal-dialog" style="width: 40%; height:500px;" >
        <div class="modal-content" style=" height:90%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="title-modal-crea"></h4>
                <h6 class="modal-title" id="title-modal-nom"></h6>
            </div>
            <div class="modal-body no-padding"   >
                <form method="post" action="#" id="nproyectperm" novalidate="novalidate" class="smart-form">	
                    <fieldset id="fld_permission" style="overflow-x:scroll; overflow-x: hidden; height: 300px;">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><label for="NTproject">Modulos</label></td>
                                    <td id="list_modulestd"></td>
                                </tr>                    
                            </tbody>
                        </table>
                        <h3>Permisos</h3>
                        <table id="tbl_smodules" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50%">Submodulos</th>
                                    <th width="10%"><button type="button" data-chk="0" id="ver_smodules" class="btn btn-link thall">Ver</button></th>
                                    <th width="10%"><button type="button" data-chk="0" id="add_smodules" class="btn btn-link thall">Agregar</button></th>
                                    <th width="10%"><button type="button" data-chk="0" id="upd_smodules" class="btn btn-link thall">Editar</button></th>
                                    <th width="10%"><button type="button" data-chk="0" id="del_smodules" class="btn btn-link thall">Eliminar</button></th>
                                    <th width="10%">Especiales</th>
                                </tr>
                            </thead>
                        </table>
                    </fieldset>
                    <fieldset id="fld_special_permission" style="overflow-x:scroll; overflow-x: hidden; height: 300px;">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><label for="NTproject">Permisos </label></td>
                                    <td id="list_permissiontd"></td>
                                </tr>                    
                            </tbody>
                        </table>
                        <table id="tbl_permission" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Permisos</th>
                                </tr>
                            </thead>
                        </table>
                    </fieldset>    
                    <footer>
                        <!--<button class="btn btn-primary" class="btn btn-default" id="sendproject2" type="button" onclick="ocultar_model('nproyectperm')" data-dismiss="modal">Aceptar</button>-->
                        <button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new">Cerrar</button>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject2_at" type="button" onclick="bck_fld()" ><i class="glyphicon glyphicon-chevron-left"></i>Atras</button>
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-'dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="newproject3" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="title-modal-crea">Nuevo Usuario</h4>
            </div>
            <div class="modal-body no-padding" >
                <form method="post" action="#" id="nproyectnewuser" novalidate="novalidate" class="smart-form">	
                    <fieldset style="height: 500px; overflow-x: none; overflow-y: auto;" id="relista1">

                        <table class="table table-bordered" id="list-modal-newuser">
                            <tbody>
                                    <!--<tr>
                                    <td><label for="NTproject">Usuario </label></td>
                                    <td id="ES_user_usertypetd">
                                        
                                    </td>
                                    </tr>-->
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
                                    <td><label for="NTproject">Perfil </label></td>
                                    <td id="ES_user_profileidtd"></td>
                                </tr>
                                <tr>
                                    <td><label for="NTproject">Área </label></td>
                                    <td id="ES_user_areaidtd"></td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <fieldset style="height: 500px; width: 565px; display:none; " id="relista2" >

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 95%;"><h6><b>Categorias</b></h6></th>
                            <th style="width: 5%;"><input type="checkbox" id="allcatego"  onclick="select_allservices(this.id)"></th>
                            </tr>
                            </thead>
                        </table>
                        <div style="height: 500px; width: 565px; overflow-x: none; overflow-y: auto;" >
                            <table class="table table-bordered" id="list-modal-cat" >

                                <tbody >

                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset style="height: 500px; width: 565px; display:none; " id="relista3" >
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th style="width: 95%;"><h6><b>Clientes</b></h6></th>
                            <th style="width: 5%;"><input type="checkbox" id="allcustoms"  onclick="select_allcustomer(this.id)"></th> 
                            </tr>
                            </thead>
                        </table>
                        <div style="height: 500px; width: 565px; overflow-x: none; overflow-y: auto;" >
                            <table class="table table-bordered" id="list-modal-cust" >


                                <tbody >
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset style="height: 500px; width: 565px; display:none; " id="relista4" >
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th ><h6><b>Permisos</b></h6></th>

                            </tr>
                            </thead>
                        </table>
                        <div style="height: 500px; width: 565px; overflow-x: none; overflow-y: auto;" >
                            <table class="table table-bordered" id="list-modal-perm" >
                                <thead>

                                    <tr>
                                        <th ><label for="NTproject">Modulos</label></th>
                                        <th id="list_modulestd" colspan="5"></th>
                                    </tr>                    
                                    <tr>
                                        <th width="50%">Submodulos</th>
                                        <th width="10%">Ver</th>
                                        <th width="10%">Agregar</th>
                                        <th width="10%">Editar</th>
                                        <th width="10%">Eliminar</th>
                                        <th width="10%">Especiales</th>
                                    </tr>
                                </thead>
                                <tbody>




                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset id="fld_special_permission_1" style=" display:none;  height: 400px;">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><label for="NTproject">Permisos </label></td>
                                    <td id="list_permissiontd"></td>
                                </tr>                    
                            </tbody>
                        </table>
                        <table id="tbl_permission_1" class="table table-bordered">
                            <thead>
                                <tr>

                                    <th style="width: 95%;">Permisos</th>
                                    <th style="width: 5%;"><input type="checkbox" id="allspecial"  onclick="select_allspecial(this.id)"></th> 
                                </tr>
                            </thead>

                        </table>
                        <div style="height: 400px; width: 565px; overflow-x: none; overflow-y: auto;" >
                            <table class="table table-bordered" id="list-modal-specper" >


                                <tbody >
                                </tbody>
                            </table>
                        </div>
                    </fieldset>  

                    <footer>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject3spec" style="display:none;" type="button" onclick="bck_fld_new()" ><i class="glyphicon glyphicon-chevron-left"></i>Atras</button>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject3" style="display:none;" type="button" onclick="next_form('1')" data-dismiss="modal" >Finalizar</button>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject3_sg"  type="button" onclick="next_form('1')" >Siguiente<i class="glyphicon glyphicon-chevron-right"></i></button>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject3_at" style="display:none;" type="button" onclick="next_form('-1')" ><i class="glyphicon glyphicon-chevron-left"></i>Atras</button>
                        <button  class="btn btn-default" id="sendproject3_c"  type="button" onclick="next_form('6')" data-dismiss="modal" >Cancelar</button>
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
                <h4 class="modal-title" id="title-modal-crea">Nuevo Usuario</h4>
            </div>
            <div class="modal-body no-padding" >
                <form method="post" action="#" id="nproyectedituser" novalidate="novalidate" class="smart-form">	
                    <fieldset style="height: 500px; overflow-x: none; overflow-y: auto;" id="relista1">

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
                                    <td><label for="NTproject">Perfil </label></td><td id="edit_user_profileidtd">

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject4_sg" onclick="edit_usernew()"  type="button" onclick="" >Aceptar</button>
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
            var global_identi = 1;
            var oTable_perm;
            /* $.post('<?php //echo Yii::app()->createAbsoluteUrl('portoprint/combos/user1/usertype/'.Utils::encrypt($usertype, 'user'));      ?>', function(response){
             
             
             $("#usertype_dv").html('Tipo de Usuario&nbsp;&nbsp;<select id="usertype_usertypeid" name="usertype_usertypeid" style="width: 150px;" >'+response+'</select>');
             $("#usertype_usertypeid").select2();
             
             $('#usertype_dv').find('#usertype_usertypeid').change( function(){
             var usertype = $(this).val();
             window.location = '?r=portoprint/default#index.php?r=portoprint/user/index/usertype/'+usertype;
             
             
             });
             
             
             });*/




            $('#tbl_smodules').hide();
            oTable = $('#user_list_table').dataTable({
    "responsive": true,
            "sAjaxSource": "<?php echo Yii::app()->createUrl('/portoprint/user/users/usertype/' . Utils::encrypt($usertype, 'user') . '/edit/' . Utils::encrypt($edt, 'user') . '/del/' . Utils::encrypt($del, 'user')); ?>",
            "aoColumns": [
            { "mData": "namecomp", sDefaultContent: "", "sWidth": "20%", sClass :"edt_usu" },
            { "mData": "usuario", sDefaultContent: "", "bSearchable": false, "sWidth": "10%", sClass :"edt_usu" },
            { "mData": "password", sDefaultContent: "", "sWidth": "10%"},
            { "mData": "compania", sDefaultContent: "", "bSearchable": false, "sWidth": "30%"},
            { "mData": "categoria", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight" },
            { "mData": "clientes", sDefaultContent: "", "sWidth": "5%", "sClass": "alignRight"},
            { "mData": "permisos", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight"} <?php if ($del == 1) { ?>,
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
                // $('#user_list_table').find("#user_list_table_filter").find("label").css("float","left")
                $('tbody .edt_usu').hover(function(){
                if ($(this).find('span.glyphicon').length > 0 || $(this).find('input').length > 0){
                return false
                } else{

                $(this).html('<span class="glyphicon glyphicon-pencil" style="float:left;">&nbsp;</span>' + $(this).html());
                        var userid = $(this).find('div').attr("id");
                        $("#" + userid).click(function(){
                var id = userid.split('_');
                        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/useredit'); ?>', {userid:id[0] }, function(response){

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
                        // $("#"+elemento.id).prop("checked", true);

                        });
                        });
                        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/companyselec'); ?>', {userid:id[0] }, function(response){
                        $("#edit_user_companyidtd").html('<select id="edit_user_companyid" name="user_companyid" style="width: 300px;"  ><option value="0">Seleccione una Compania</option>' + response + '</select>');
                                $("#edit_user_companyid").select2();
                        });
                        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/profileselec'); ?>', {userid:id[0] }, function(response){
                        $("#edit_user_profileidtd").html('<select id="edit_user_profileid" name="user_profileid" style="width: 300px;"><option value="0">Seleccione un Perfil</option>' + response + '</select>');
                                $("#edit_user_profileid").select2();
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
            function list_categor(id){

            var cad = $("#" + id).data("ids");
                    var div = cad.split(",");
                    var cadena = ' ';
                    var activado = "";
<?php if ($edt == 0) { ?>
                activado = "disabled";
<?php } ?>

            for (i = 0; i < div.length; i++){
            var div2 = div[i].split('-');
                    if (div2[2] == 1){

            cadena = cadena + '<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="check_' + div2[0] + '_' + div2[4] + '" data-newid="' + div2[3] + '" onclick="valid_categ(this.id)"  value="' + div2[4] + '" ' + activado + '  checked> </span><label class="form-control">' + div2[1] + '</label></div></td></tr>';
            } else{

            cadena = cadena + '<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="check_' + div2[0] + '_' + div2[4] + '"  onclick="valid_categ(this.id)" value="' + div2[4] + '" ' + activado + '></span><label class="form-control">' + div2[1] + '</label></div></td></tr>';
            }

            }
            $("#newproject").find("#title-modal-crea").html("Categorias Disponibles");
                    $("#newproject").find("#list-modal-categ").html(cadena);
                    $("#newproject").find("#title-modal-nom").html($("#" + id).data("nam"));
                    $("#nproyectcatego").find(".bor").remove();
                    $("<input type='hidden' id='" + id + "' class='bor' >").appendTo("#nproyectcatego");
                    $("#newproject").find("#sendproject").attr('data-tip', id);
            }

    function list_permision(id){
    $("#tbl_smodules").hide();
            $("#fld_permission").show();
            $("#tbl_permission").hide();
            var res = id.split("_");
            var userid = res[1];
            $("#newproject2").find("#title-modal-crea").html("Permisos Generales");
            $("#newproject2").find("#title-modal-nom").html($("#" + id).data("nam"));
            $("#nproyectperm").find(".borre").remove();
            $("<input type='hidden' id='" + id + "' class='borre' >").appendTo("#nproyectperm");
            $("#newproject2").find("#sendproject2").attr('data-tip', id);
            $("#fld_special_permission").hide();
            $("#sendproject2_at").hide();
            //var usertype=$("#usertype_usertypeid").val();
            var usertype = 1;
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/menu'); ?>', {usertype:usertype }, function(response){
            $("#list_modulestd").html('<select onchange="list_submodules(' + usertype + ',this.value,' + userid + ')" id="list_modules" name="list_modules" class="form-control"><option value="0">Seleccione un Modulo</option>' + response + '</select>');
                    //$("#list_modules").select2();
            });
    }
    function savepermission(id, userid){

    var menuid = $("#" + id + "").data("menuid");
            var menuop = $("#" + id + "").data("menuop");
            var valor = ($("#" + id + "").is(':checked'))?1:0;
            var userprivilegeid = $("#" + id + "").data("idp");
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/Saveprivilege'); ?>', {menuid:menuid, userid:userid, menuop:menuop, valor:valor, userprivilegeid:userprivilegeid}, function(response){
            //alert(response);
            });
    }
    function savespecialpermission(id, userid, permissionid, specialpermissionid){

    var valor = ($("#" + id + "").is(':checked'))?1:0;
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/Savespecialpermission'); ?>', {userid:userid, permissionid:permissionid, valor:valor, specialpermissionid:specialpermissionid}, function(response){
            //alert(response);
            });
    }
    function list_submodules(usertype, menuparentid, userid){
    $('#tbl_smodules').show();
            oTable_perm = $('#tbl_smodules').dataTable({
    // "responsive": true,
    "sAjaxSource": "<?php echo Yii::app()->createUrl('portoprint/combos/smenu' . '/edit/' . Utils::encrypt($edt, 'user') . '/del/' . Utils::encrypt($del, 'user')); ?>" + "/usertype/" + usertype + "/menuparentid/" + menuparentid + "/userid/" + userid,
            "aoColumns": [
            { "mData": "dsc", sDefaultContent: "", "sWidth": "50%" },
            { "mData": "ver", sDefaultContent: "", "bSearchable": false, "sWidth": "10%", "sClass": "alignRight"},
            { "mData": "agr", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight"},
            { "mData": "edi", sDefaultContent: "", "bSearchable": false, "sWidth": "10%", "sClass": "alignRight"},
            { "mData": "eli", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight" },
            { "mData": "btn", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight" }
            ],
            "destroy": true,
            "paging":   false,
            "ordering": false,
            "info":     false,
            "bFilter": false,
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
    }

    function list_submodules_1(usertype, menuparentid, userid){
        $('#tbl_smodules').show();
            oTable = $('#tbl_smodules').dataTable({
             "responsive": true,
            "sAjaxSource": "<?php echo Yii::app()->createUrl('portoprint/combos/smenu1' . '/edit/' . Utils::encrypt($edt, 'user') . '/del/' . Utils::encrypt($del, 'user')); ?>" + "/usertype/" + usertype + "/menuparentid/" + menuparentid + "/userid/" + userid,
            "aoColumns": [
            { "mData": "dsc", sDefaultContent: "", "sWidth": "50%" },
            { "mData": "ver", sDefaultContent: "", "bSearchable": false, "sWidth": "10%", "sClass": "alignRight"},
            { "mData": "agr", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight"},
            { "mData": "edi", sDefaultContent: "", "bSearchable": false, "sWidth": "10%", "sClass": "alignRight"},
            { "mData": "eli", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight" },
            { "mData": "btn", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight" }
            ],
            "destroy": true,
            "paging":   false,
            "ordering": false,
            "info":     false,
            "bFilter": false,
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
    }



    function specialpermission(menuid, userid){
    $("#fld_permission").hide();
            $("#fld_special_permission").show("fast");
            $("#sendproject2_at").show('slow', 'swing');
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/permissiongroup'); ?>', {menuid:menuid, userid:userid}, function(response){
            $("#list_permissiontd").html('<select onchange="listpermission(this.value)" id="list_permission" name="list_modules" class="form-control"><option value="0">Seleccione un Permiso</option>' + response + '</select>');
                    //$("#list_permission").select2();
            });
    }
    function listpermission(menuid){
    $("#tbl_permission").show();
            var group = $("#list_permission option:selected").text();
            var userid = $("#list_permission option:selected").data("userid");
            oTable = $('#tbl_permission').dataTable({
    "responsive": true,
            "sAjaxSource": "<?php echo Yii::app()->createUrl('portoprint/combos/permissions'); ?>" + "/menuid/" + menuid + "/group/" + group + "/userid/" + userid,
            "aoColumns": [
            { "mData": "dsc", sDefaultContent: "" }
            ],
            "destroy": true,
            "paging":   false,
            "ordering": false,
            "info":     false,
            "bFilter": false,
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
    }

    function list_customer(id){

    var cad = $("#" + id).data("ids");
            var div = cad.split(",");
            var cadena = ' ';
            var num = 0;
            var num1 = 1;
            var activado = "";
<?php if ($edt == 0) { ?>
        activado = "disabled";
<?php } ?>

    for (i = 0; i < div.length; i++){
    var div2 = div[i].split('-');
            if (div2[2] == 1){

    cadena = cadena + '<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="cust_' + div2[0] + '_' + div2[4] + '"  onclick="valid_custom(this.id)" data-newid="' + div2[3] + '"   value="' + div2[4] + '" ' + activado + ' checked></span><label class="form-control">' + div2[1] + '</label></div></td></tr>';
    } else{

    cadena = cadena + '<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox"id="cust_' + div2[0] + '_' + div2[4] + '" onclick="valid_custom(this.id)"  value="' + div2[4] + '" ' + activado + ' ></span><label class="form-control">' + div2[1] + '</label></div></td></tr>';
    }

    }
    $("#newproject1").find("#title-modal-crea").html("Clientes Disponibles");
            $("#newproject1").find("#list-modal-custom").html(cadena);
            $("#newproject1").find("#title-modal-nom").html($("#" + id).data("nam"));
            $("#nproyectclient").find(".borr").remove();
            $("<input type='hidden' id='" + id + "' class='borr' >").appendTo("#nproyectclient");
            $("#sendproject1").attr('data-tip', id);
    }

    function valid_categ(id){

    if ($("#" + id).is(':checked')) {
    var div = id.split('_');
            var userid = $("#" + id).val();
            var integrador = { };
            integrador['userid'] = userid;
            integrador['serviceid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/addservice'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador
                    },
                    success: function(data) {
                    var result = data;
                            if (result != 0){
                    $("#" + id).data("newid", result);
                            var parentid = $("#nproyectcatego").find(".bor").attr("id");
                            var cadena = $("#" + parentid).data("ids");
                            var sep_cad = cadena.split(",");
                            var cadena1 = ' ';
                            for (i = 0; i < sep_cad.length; i++){
                            var sep_cad1 = sep_cad[i].split('-');
                            if (div[1] == sep_cad1[0]){

                    if (cadena1 == " "){
                    cadena1 = sep_cad1[0] + '-' + sep_cad1[1] + '-1-' + result + '-' + sep_cad1[4];
                    } else{
                    cadena1 = cadena1 + ',' + sep_cad1[0] + '-' + sep_cad1[1] + '-1-' + result + '-' + sep_cad1[4];
                    }


                    } else{
                    if (cadena1 == " "){
                    cadena1 = sep_cad[i];
                    } else{
                    cadena1 = cadena1 + ',' + sep_cad[i];
                    }
                    }

                    }
                    var boton = '<a href="#newproject" class="btn btn-primary" id="' + parentid + '" data-ids="' + cadena1 + '" onclick="list_categor(this.id)" data-target="#newproject"  data-toggle="modal" >Categorias</a>';
                            $("#div" + parentid).html(boton);
                    }
                    }
            });
    } else {

    var div = id.split('_');
            var userid = $("#" + id).val();
            var integrador = { };
            var newid = $("#" + id).data("newid");
            integrador['userid'] = userid;
            integrador['serviceid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/inactiveservice'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador,
                            'userserviceid':newid
                    },
                    success: function(data) {
                    var result = data;
                            if (result != 0){
                    $("#" + id).data("newid", " ");
                            var parentid = $("#nproyectcatego").find(".bor").attr("id");
                            var cadena = $("#" + parentid).data("ids");
                            var sep_cad = cadena.split(",");
                            var cadena1 = ' ';
                            for (i = 0; i < sep_cad.length; i++){
                    var sep_cad1 = sep_cad[i].split('-');
                            if (div[1] == sep_cad1[0]){

                    if (cadena1 == " "){
                    cadena1 = sep_cad1[0] + '-' + sep_cad1[1] + '-0--' + sep_cad1[4];
                    } else{
                    cadena1 = cadena1 + ',' + sep_cad1[0] + '-' + sep_cad1[1] + '-0--' + sep_cad1[4];
                    }


                    } else{
                    if (cadena1 == " "){
                    cadena1 = sep_cad[i];
                    } else{
                    cadena1 = cadena1 + ',' + sep_cad[i];
                    }
                    }

                    }

                    var boton = '<a href="#newproject" class="btn btn-primary" id="' + parentid + '" data-ids="' + cadena1 + '" onclick="list_categor(this.id)" data-target="#newproject"  data-toggle="modal" >Categorias</a>';
                            $("#div" + parentid).html(boton);
                    }

                    }
            });
    }

    }

    function valid_categ_new(id){

    if ($("#" + id).is(':checked')) {
    var div = id.split('_');
            var userid = $("#" + id).val();
            var integrador = { };
            integrador['userid'] = userid;
            integrador['serviceid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/addservice'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador
                    },
                    success: function(data) {
                    var result = data;
                    }
            });
    } else {

    var div = id.split('_');
            var userid = $("#" + id).val();
            var integrador = { };
            var newid = $("#" + id).data("newid");
            integrador['userid'] = userid;
            integrador['serviceid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/inactiveservice'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador,
                            'userserviceid':newid
                    },
                    success: function(data) {
                    var result = data;
                    }
            });
    }

    }


    function valid_custom(id){

    if ($("#" + id).is(':checked')) {
    var div = id.split('_');
            var userid = $("#" + id).val();
            var integrador = { };
            integrador['userid'] = userid;
            integrador['customerid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/addcustomer'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador
                    },
                    success: function(data) {
                    var result = data;
                            if (result != 0){
                    $("#" + id).data("newid", result);
                            var parentid = $("#nproyectclient").find(".borr").attr("id");
                            var cadena = $("#" + parentid).data("ids");
                            var sep_cad = cadena.split(",");
                            var cadena1 = ' ';
                            for (i = 0; i < sep_cad.length; i++){
                    var sep_cad1 = sep_cad[i].split('-');
                            if (div[1] == sep_cad1[0]){

                    if (cadena1 == " "){
                    cadena1 = sep_cad1[0] + '-' + sep_cad1[1] + '-1-' + result + '-' + sep_cad1[4];
                    } else{
                    cadena1 = cadena1 + ',' + sep_cad1[0] + '-' + sep_cad1[1] + '-1-' + result + '-' + sep_cad1[4];
                    }


                    } else{
                    if (cadena1 == " "){
                    cadena1 = sep_cad[i];
                    } else{
                    cadena1 = cadena1 + ',' + sep_cad[i];
                    }
                    }

                    }
                    var boton = '<a href="#newproject" class="btn btn-primary" id="' + parentid + '" data-ids="' + cadena1 + '" onclick="list_customer(this.id)" data-target="#newproject1"  data-toggle="modal" >Clientes</a>';
                            $("#div" + parentid).html(boton);
                    }
                    }
            });
    } else {

    var div = id.split('_');
            var userid = $("#" + id).val();
            var integrador = { };
            var newid = $("#" + id).data("newid");
            integrador['userid'] = userid;
            integrador['customerid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/inactivecustomer'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador,
                            'usercustomerpermissionid':newid
                    },
                    success: function(data) {
                    var result = data;
                            
                            if (result != 0){

                    $("#" + id).data("newid", " ");
                            var parentid = $("#nproyectclient").find(".borr").attr("id");
                            var cadena = $("#" + parentid).data("ids");
                            var sep_cad = cadena.split(",");
                            var cadena1 = ' ';
                            for (i = 0; i < sep_cad.length; i++){
                    var sep_cad1 = sep_cad[i].split('-');
                            if (div[1] == sep_cad1[0]){

                    if (cadena1 == " "){
                    cadena1 = sep_cad1[0] + '-' + sep_cad1[1] + '-0--' + sep_cad1[4];
                    } else{
                    cadena1 = cadena1 + ',' + sep_cad1[0] + '-' + sep_cad1[1] + '-0--' + sep_cad1[4];
                    }


                    } else{
                    if (cadena1 == " "){
                    cadena1 = sep_cad[i];
                    } else{
                    cadena1 = cadena1 + ',' + sep_cad[i];
                    }
                    }

                    }
                    var boton = '<a href="#newproject" class="btn btn-primary" id="' + parentid + '" data-ids="' + cadena1 + '" onclick="list_customer(this.id)" data-target="#newproject1"  data-toggle="modal" >Clientes</a>';
                            $("#div" + parentid).html(boton);
                    }

                    }
            });
    }

    }



    function valid_custom_ew(id){

    if ($("#" + id).is(':checked')) {
    var div = id.split('_');
            var userid = $("#" + id).val();
            var integrador = { };
            integrador['userid'] = userid;
            integrador['customerid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/addcustomer'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador
                    },
                    success: function(data) {
                    var result = data;
                    }
            });
    } else {

    var div = id.split('_');
            var userid = $("#" + id).val();
            var integrador = { };
            var newid = $("#" + id).data("newid");
            integrador['userid'] = userid;
            integrador['customerid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/inactivecustomer'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador,
                            'usercustomerpermissionid':newid
                    },
                    success: function(data) {
                    var result = data;
                    }
            });
    }

    }

    function valid_compan(id){

    if ($("#" + id).is(':checked')) {

    var userid = $("#" + id).data("ids");
            var data = $("#" + id).val();
            var div = data.split(",");
            $("#btncatego_" + userid).removeAttr("disabled");
            $("#btncustomer_" + userid).removeAttr("disabled");
            $("#btnpermis_" + userid).removeAttr("disabled");
            var integrador = { };
            integrador['userid'] = div[0];
            integrador['companyid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/addcompany'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador
                    },
                    success: function(data) {
                    var result = data;
                            if (result != 0){
                    $("#" + id).data("newid", result);
                    }
                    }
            });
    } else {
    var userid = $("#" + id).data("ids");
            var data = $("#" + id).val();
            var div = data.split(",");
            $("#btncatego_" + userid).attr("disabled", true);
            $("#btncustomer_" + userid).attr("disabled", true);
            $("#btnpermis_" + userid).attr("disabled", true);
            var integrador = { };
            var newid = $("#" + id).data("newid");
            integrador['userid'] = div[0];
            integrador['companyid'] = div[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/inactivecompany'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador,
                            'usercompanypermissionid':newid
                    },
                    success: function(data) {
                    var result = data;
                            if (result != 0){
                    $("#" + id).data("newid", '');
                    }

                    }
            });
    }

    }

    function ocultar_model(id){

    $('#' + id).modal('hide');
    }

    function next_form(x){

    var resta = parseInt(x);
            if (resta != 6){
    global_identi = global_identi + resta;
    } else{
    global_identi = resta;
    }
    var valid = 0;
            var bandera = 0;
            var bandera1 = 0;
            var bandera2 = 0;
            var bandera3 = 0;
            var valueToPush = new Array();
            var integrador = { };
            switch (global_identi){

    case 1:


            $("#newproject3").find("#relista2").css("display", "none");
            $("#newproject3").find("#relista1").css("display", "inline");
            $("#newproject3").find("#relista3").css("display", "none");
            $("#newproject3").find("#relista4").css("display", "none");
            $("#newproject3").find("#sendproject3").css("display", "none");
            $("#newproject3").find("#sendproject3_sg").css("display", "inline");
            $("#newproject3").find("#sendproject3_at").css("display", "none");
            break;
            case 2:

            $("#nproyectnewuser").find('input').each(function() {
    var elemento = this;
            var div = elemento.id.split('_');
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
            /*   if($("#user_usertype").val()!=0){
             $("#ES_user_usertypetd").find(".error").remove();
             integrador['usertype']=$("#user_usertype").val();
             bandera1=0;
             }else{
             $("#ES_user_usertypetd").find(".error").remove();
             bandera1=1;
             $('<label class="error" generated="true">Debe seleccionar un tipo de usuario</label>').appendTo("#ES_user_usertypetd");
             }  */

            if ($("#user_companyid").val() != 0){
    $("#ES_user_companyidtd").find(".error").remove();
            integrador['companyid'] = $("#user_companyid").val();
            bandera2 = 0;
    } else{
    $("#ES_user_companyidtd").find(".error").remove();
            bandera2 = 1;
            $('<label class="error" generated="true">Debe seleccionar una compañia</label>').appendTo("#ES_user_companyidtd");
    }

    if ($("#user_profileid").val() != 0){
    $("#ES_user_profileidtd").find(".error").remove();
            integrador['profileid'] = $("#user_profileid").val();
            bandera3 = 0;
    } else{
    $("#ES_user_profileidtd").find(".error").remove();
            bandera3 = 1;
            $('<label class="error" generated="true">Debe seleccionar una perfil</label>').appendTo("#ES_user_profileidtd");
    }
    if ($("#user_areaid").val() != ''){
    $("#ES_user_areaidtd").find(".error").remove();
            bandera3 = 0;
            var areaid = $("#user_areaid").val();
    } else{
    $("#ES_user_areaidtd").find(".error").remove();
            bandera3 = 1;
            $('<label class="error" generated="true">Debe seleccionar una área</label>').appendTo("#ES_user_areaidtd");
    }

    if (bandera == 0 && bandera2 == 0 && bandera3 == 0){

    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/createnewuser') ?>', {'arrai':integrador,'areaid':areaid}, function(response){
    console.log(response);
            if (response != 0){
    var sep = response.split(',');
            $("#list-modal-newuser").attr('data-exis', sep[0]);
            $("#list-modal-cat").find("tbody").html(sep[1]);
            $("#list-modal-cust").find("tbody").html(sep[2]);
            $("#newproject3").find("#relista2").css("display", "inline");
            $("#newproject3").find("#relista1").css("display", "none");
            $("#newproject3").find("#relista3").css("display", "none");
            $("#newproject3").find("#relista4").css("display", "none");
            $("#newproject3").find("#sendproject3").css("display", "none");
            $("#newproject3").find("#sendproject3_sg").css("display", "inline");
            $("#newproject3").find("#sendproject3_at").css("display", "inline");
    }



    });
    } else{
    alert('Hay errores al tratar de insertar el el nuevo registro, vuelva a intentarlo.');
            global_identi = global_identi - 1;
    }

    // global_identi=4;
    break;
            case 3:

            $("#list-modal-cat").find('input[type="checkbox"]').each(function() {
    var elemento = this;
            if ($("#" + elemento.id).is(':checked')) {


    var sep = elemento.id.split("_");
            var integrador = { };
            integrador['userid'] = sep[2];
            integrador['serviceid'] = sep[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/addserviceposi'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador
                    },
                    success: function(data) {

                    }
            });
    } else{
    var sep = elemento.id.split("_");
            var integrador = { };
            integrador['userid'] = sep[2];
            integrador['serviceid'] = sep[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/addservicenega'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador
                    },
                    success: function(data) {

                    }
            });
    }

    });
            $("#newproject3").find("#relista2").css("display", "none");
            $("#newproject3").find("#relista1").css("display", "none");
            $("#newproject3").find("#relista3").css("display", "inline");
            $("#newproject3").find("#relista4").css("display", "none");
            $("#newproject3").find("#sendproject3").css("display", "none");
            $("#newproject3").find("#sendproject3_sg").css("display", "inline");
            $("#newproject3").find("#sendproject3_at").css("display", "inline");
            break;
            case 4:
            $("#list-modal-cust").find('input[type="checkbox"]').each(function() {
    var elemento = this;
            if ($("#" + elemento.id).is(':checked')) {


    var sep = elemento.id.split("_");
            var integrador = { };
            integrador['userid'] = sep[2];
            integrador['customerid'] = sep[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/addcustomerposi'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador
                    },
                    success: function(data) {

                    }
            });
    } else{
    var sep = elemento.id.split("_");
            var integrador = { };
            integrador['userid'] = sep[2];
            integrador['customerid'] = sep[1];
            $.ajax({
            url: "<?php echo Yii::app()->createUrl('/portoprint/user/addcustomernega'); ?>",
                    type: "GET",
                    data: {
                    'arrai':integrador
                    },
                    success: function(data) {

                    }
            });
    }

    });
            var userid = $("#list-modal-newuser").data("exis");
            var usertype = 1;
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/menu'); ?>', {usertype:usertype }, function(response){
            $("#list-modal-perm").find("#list_modulestd").html('<select onchange="list_submodules_modal(' + usertype + ',this.value,' + userid + ')" id="list_modules_new" name="list_modules_new" class="form-control"><option value="0">Seleccione un Modulo</option>' + response + '</select>');
                    $("#list_modules_new").select2();
            });
            $("#newproject3").find("#relista2").css("display", "none");
            $("#newproject3").find("#relista1").css("display", "none");
            $("#newproject3").find("#relista3").css("display", "none");
            $("#newproject3").find("#relista4").css("display", "inline");
            $("#newproject3").find("#sendproject3_sg").css("display", "none");
            $("#newproject3").find("#sendproject3").css("display", "inline");
            break;
            case 5:

            $("#list-modal-newuser").find('td').each(function() {
    var elemento = this;
            var div = elemento.id.split("_");
            if (div[0] == 'NT' || div[0] == 'ES'){
    $("#" + elemento.id).find("label").remove();
    }

    });
            $("#list-modal-newuser").find('input[type="text"]').each(function() {
    var elemento = this;
            $("#" + elemento.id).val("");
    });
            $("#newproject3").find('#nproyectnewuser').modal('hide');
            global_identi = 1;
            $("#newproject3").find("#relista2").css("display", "none");
            $("#newproject3").find("#relista1").css("display", "inline");
            $("#newproject3").find("#relista3").css("display", "none");
            $("#newproject3").find("#relista4").css("display", "none");
            $("#newproject3").find("#sendproject3").css("display", "none");
            $("#newproject3").find("#sendproject3_sg").css("display", "inline");
            $("#newproject3").find("#sendproject3_at").css("display", "none");
            location.reload();
            break;
            case 6:

            $("#newproject3").find('#nproyectnewuser').modal('hide');
            global_identi = 1;
            $("#newproject3").find("#relista2").css("display", "none");
            $("#newproject3").find("#relista1").css("display", "inline");
            $("#newproject3").find("#relista3").css("display", "none");
            $("#newproject3").find("#relista4").css("display", "none");
            $("#newproject3").find("#sendproject3").css("display", "none");
            $("#newproject3").find("#sendproject3_sg").css("display", "inline");
            $("#newproject3").find("#sendproject3_at").css("display", "none");
            $("#list-modal-newuser").find('td').each(function() {
    var elemento = this;
            var div = elemento.id.split("_");
            if (div[0] == 'NT' || div[0] == 'ES'){
    $("#" + elemento.id).find("label").remove();
    }

    });
            $("#list-modal-newuser").find('input[type="text"]').each(function() {
    var elemento = this;
            $("#" + elemento.id).val("");
    });
            break;
    }
    }

    function onclin(){

    /* $.post('<?php //echo Yii::app()->createAbsoluteUrl('portoprint/combos/user2');      ?>', function(response){
     $("#ES_user_usertypetd").html('<select id="user_usertype" name="user_usertype" style="width: 300px;"  ><option value="0">Seleccione un Tipo de Usuario</option>'+response+'</select>');
     $("#user_usertype").select2();
     });*/

    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/company'); ?>', function(response){
    $("#ES_user_companyidtd").html('<select id="user_companyid" name="user_companyid" style="width: 300px;"  ><option value="0">Seleccione una Compania</option>' + response + '</select>');
            $("#user_companyid").select2();
    });
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/profile'); ?>', function(response){
            $("#ES_user_profileidtd").html('<select id="user_profileid" name="user_profileid" style="width: 300px;"><option value="0">Seleccione un Perfil</option>' + response + '</select>');
                    $("#user_profileid").select2();
            });
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/area'); ?>', function(response){
            $("#ES_user_areaidtd").html('<select id="user_areaid" name="user_areaid" style="width: 300px;">' + response + '</select>');
                    $("#user_areaid").select2();
            });
    }

    function select_allcustomer(x){

    if ($("#" + x).is(':checked')) {
    $("#list-modal-cust").find('input[type="checkbox"]').each(function() {
    var elemento = this;
            $("#" + elemento.id).prop("checked", true);
            valid_custom_ew(elemento.id);
    });
    } else{
    $("#list-modal-cust").find('input[type="checkbox"]').each(function() {
    var elemento = this;
            $("#" + elemento.id).prop("checked", false);
            valid_custom_ew(elemento.id);
    });
    }

    }

    function select_allservices(x){
    if ($("#" + x).is(':checked')) {
    $("#list-modal-cat").find('input[type="checkbox"]').each(function() {
    var elemento = this;
            $("#" + elemento.id).prop("checked", true);
            valid_categ_new(elemento.id);
    });
    } else{

    $("#list-modal-cat").find('input[type="checkbox"]').each(function() {
    var elemento = this;
            $("#" + elemento.id).prop("checked", false);
            valid_categ_new(elemento.id);
    });
    }

    }

    function list_submodules_modal(usertype, menuparentid, userid){
    $('#list-modal-perm').dataTable({

    "sAjaxSource": "<?php echo Yii::app()->createUrl('portoprint/combos/smenumodal' . '/edit/' . Utils::encrypt($edt, 'user') . '/del/' . Utils::encrypt($del, 'user')); ?>" + "/usertype/" + usertype + "/menuparentid/" + menuparentid + "/userid/" + userid,
            "aoColumns": [
            { "mData": "dsc", sDefaultContent: "", "sWidth": "60%" },
            { "mData": "ver", sDefaultContent: "", "bSearchable": false, "sWidth": "10%", "sClass": "alignRight"},
            { "mData": "agr", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight"},
            { "mData": "edi", sDefaultContent: "", "bSearchable": false, "sWidth": "10%", "sClass": "alignRight"},
            { "mData": "eli", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight" },
            { "mData": "spe", sDefaultContent: "", "sWidth": "10%", "sClass": "alignRight" }
            ],
            "destroy": true,
            "paging":   false,
            "ordering": false,
            "info":     false,
            "bFilter": false,
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
    }

    function specialpermission_1(menuid, x){

    if (x == 1){

    $("#newproject3").find("#fld_special_permission_1").css("display", 'inline');
            $("#newproject3").find("#relista4").css("display", "none");
            $("#newproject3").find("#sendproject3").css("display", "none");
            $("#newproject3").find("#sendproject3_at").css("display", "none");
            $("#newproject3").find("#sendproject3_c").css("display", "none");
            $("#newproject3").find("#sendproject3spec").css("display", "inline");
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/permissiongroupmodal'); ?>', {menuid:menuid}, function(response){
            $("#fld_special_permission_1").find("#list_permissiontd").html('<select onchange="listpermissionmodel(this.value)" id="list_permissionmodel" name="list_modulesmodel" class="form-control"><option value="0">Seleccione un Permiso</option>' + response + '</select>');
            });
    }

    }

    function listpermissionmodel(x){

    var dsc = $("#list_permissionmodel").find("#df_" + x).data("listdsc");
            var id = $("#list_permissionmodel").find("#df_" + x).data("listid");
            var userid = $("#list-modal-newuser").data("exis");
            var busca = dsc.indexOf(",");
            if (busca != - 1){
    var div = id.split(',');
            var div2 = dsc.split(',');
            var dib = ' ';
            for (i = 0; i < div.length; i++){
    if (dib == ' '){
    dib = '<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox"id="speperms_' + div[i] + '_' + userid + '" onclick="save_spec_1(' + div[i] + ',' + userid + ',this.id)"  value="speperms_' + div[i] + '_' + userid + '" ></span><label class="form-control">' + div2[i] + '</label></div></td></tr>';
    } else{
    dib = dib + '<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox"id="speperms_' + div[i] + '_' + userid + '" onclick="save_spec_1(' + div[i] + ',' + userid + ',this.id)"  value="speperms_' + div[i] + '_' + userid + '" ></span><label class="form-control">' + div2[i] + '</label></div></td></tr>';
    }
    }
    $("#list-modal-specper").find("tbody").html(dib);
    } else{
    var dib = '<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox"id="speperms_' + id + '_' + userid + '" onclick="save_spec_1(' + id + ',' + userid + ',this.id)"  value="speperms_' + id + '_' + userid + '" ></span><label class="form-control">' + dsc + '</label></div></td></tr>';
            $("#list-modal-specper").find("tbody").html(dib);
    }



    }

    function select_allspecial(x){

    if ($("#" + x).is(':checked')) {
    $("#list-modal-specper").find('input[type="checkbox"]').each(function() {
    var elemento = this;
            var sepa = elemento.value.split('_');
            $("#" + elemento.id).prop("checked", true);
            save_spec_1(sepa[1], sepa[2], elemento.id);
    });
    } else{
    $("#list-modal-specper").find('input[type="checkbox"]').each(function() {
    var elemento = this;
            var sepa = elemento.value.split('_');
            $("#" + elemento.id).prop("checked", false);
            save_spec_1(sepa[1], sepa[2], elemento.id);
    });
    }

    }

    function save_spec_1(permissionid, userid, tp){


    if ($("#" + tp).is(':checked')) {

    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/addspecialaff'); ?>', {'userid':userid, 'permissionid': permissionid}, function(response){

    });
    } else{

    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/addspecialnega'); ?>', {'userid':userid, 'permissionid': permissionid}, function(response){

    });
    }


    }

    function bck_fld(){
    $('#tbl_permission tbody').remove();
            $("#fld_permission").show();
            $("#fld_special_permission").hide();
            $("#sendproject2_at").hide();
    }
    function bck_fld_new(){
    $("#newproject3").find('#list-modal-specper tbody').empty();
            $("#newproject3").find("#relista4").css("display", "inline");
            $("#newproject3").find("#fld_special_permission_1").css("display", "none");
            $("#newproject3").find("#sendproject3").css("display", "inline");
            $("#newproject3").find("#sendproject3_at").css("display", "inline");
            $("#newproject3").find("#sendproject3_c").css("display", "inline");
            $("#newproject3").find("#sendproject3spec").css("display", "none");
    }


    $("#ver_smodules").click(function() {
    var chk = ($("#ver_smodules").data("chk") === 0)?1:0;
            $("#ver_smodules").data("chk", chk);
            $(".ver_smodules").each(function(indice, elemento) {
    if (chk == 1){
    $(elemento).prop('checked', true);
    } else{
    $(elemento).prop('checked', false);
    }
    savepermission(this.id, $(elemento).data('userid'));
    });
    });
            $("#add_smodules").click(function() {
    var chk = ($("#add_smodules").data("chk") === 0)?1:0;
            $("#add_smodules").data("chk", chk);
            $(".add_smodules").each(function(indice, elemento) {
    if (chk == 1){
    $(elemento).prop('checked', true);
    } else{
    $(elemento).prop('checked', false);
    }
    savepermission(this.id, $(elemento).data('userid'));
    });
    });
            $("#upd_smodules").click(function() {
    var chk = ($("#upd_smodules").data("chk") === 0)?1:0;
            $("#upd_smodules").data("chk", chk);
            $(".upd_smodules").each(function(indice, elemento) {
    if (chk == 1){
    $(elemento).prop('checked', true);
    } else{
    $(elemento).prop('checked', false);
    }
    savepermission(this.id, $(elemento).data('userid'));
    });
    });
            $("#del_smodules").click(function() {
    var chk = ($("#del_smodules").data("chk") === 0)?1:0;
            $("#del_smodules").data("chk", chk);
            $(".del_smodules").each(function(indice, elemento) {
    if (chk == 1){
    $(elemento).prop('checked', true);
    } else{
    $(elemento).prop('checked', false);
    }
    savepermission(this.id, $(elemento).data('userid'));
    });
    });
            function savepermission_1(menu, userid, menuid, ids){
            var menuid = menuid;
                    var menuop = menu;
                    var userid = userid;
                    if ($("#" + ids).is(':checked')) {
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/saveprivilegeposi'); ?>', {menuid:menuid, userid:userid, menuop:menuop}, function(response){
            console.log(response);
            });
            } else{
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/saveprivilegenega'); ?>', {menuid:menuid, userid:userid, menuop:menuop}, function(response){
            console.log(response);
            });
            }
            }

    function edit_usernew(){
    var valid = 0;
            var bandera = 0;
            var bandera3 = 0;
            var integrador = { };
            $("#list-modal-edituser").find('input').each(function() {
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
            if ($("#edit_user_profileid").val() != 0){
    $("#edit_user_profileidtd").find(".error").remove();
            integrador['profileid'] = $("#edit_user_profileid").val();
            bandera3 = 0;
    } else{
    $("#edit_user_profileidtd").find(".error").remove();
            bandera3 = 1;
            $('<label class="error" generated="true">Debe seleccionar una perfil</label>').appendTo("#edit_user_profileidtd");
    }

    if (bandera == 0 && bandera3 == 0){

    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/user/updateuser') ?>', {'arrai':integrador}, function(response){
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

    function delet_user(id){
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