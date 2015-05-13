<?php
$ogsm = $model->findAllbyAttributes(array('todoid' => $todoid));
?>
<input type="hidden" id="hadd" value="<?php echo $add; ?>">
<input type="hidden" id="hedt" value="<?php echo $edt; ?>">
<input type="hidden" id="hdel" value="<?php echo $del; ?>">
<input type="hidden" id="hmenu" value="<?php echo $menu; ?>">
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
            <!-- end widget div -->
            <div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" role="widget" style="">
                <header role="heading"><div class="jarviswidget-ctrls" role="menu">    <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-resize-full "></i></a> </div>
                    <span class="widget-icon"> <i class="glyphicon glyphicon-calendar"></i> </span>
                    <?php foreach ($ogsm as $fila) { ?>
                        <h2>OGSM <?php echo $fila->tododsc; ?></h2>
                        <input type="hidden" id="hareaid"   value="<?php echo $fila->areaid; ?>">
                        <input type="hidden" id="hparentid" value="<?php echo $fila->todoid; ?>">
                    <?php } ?>
                    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                </header>

                <!-- widget div-->
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="widget-body-toolbar">
                            <form novalidate="novalidate" class="smart-form" id="addtodo">
                                <fieldset style="background-color: #FAFAFA;">
                                    <div class="row">								
                                        <section class="col col-3">
                                            <div class="btn-group btn-group-sm">
                                                <a href="#newproject" class="btn btn-success" data-target="#newproject" data-toggle="modal">Nueva ToDo</a>
                                            </div>

                                        </section>
                                        <section class="col col-4">	
                                        </section>
                                        <section class="col col-5">

                                        </section>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <table id="example" class="items table table-condensed" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th colspan="3">Pendiente</th>
                                    <th colspan="3">En proceso</th>
                                    <th colspan="3">Terminado</th>
                                </tr>
                                <tr>
                                    <th class="pbaja">Baja</th>
                                    <th class="pmedia">Media</th>
                                    <th class="palta">Alta</th>
                                    <th class="pbaja">Baja</th>
                                    <th class="pmedia">Media</th>
                                    <th class="palta">Alta</th>
                                    <th class="pbaja">Baja</th>
                                    <th class="pmedia">Media</th>
                                    <th class="palta">Alta</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <table id="todos" class="items table table-condensed" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Prioridad</th>
                                    <th>Tarea</th>
                                    <th>Responsable</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>% Avance</th>
                                    <th>Área/Proyecto</th>
                                    <th class="botones"></th>
                                    <th class="botones"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </div>
    <!-- end widget -->
    <!-- WIDGET END -->
    <!-- end row -->

</section>
<div class="modal fade" id="newproject" tabindex="-1" role="dialog" aria-labelledby="newproject" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agregar ToDo</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="#" id="nproyectcustm" novalidate="novalidate" class="smart-form">	
                    <fieldset>
                        <table class="table table-bordered">
                            <tbody>
                                <tr style="display: none;">
                                    <td ><label for="NTproject">parentid</label></td>
                                    <td  id="NT_parentidtd">
                                        <label class="input">
                                            <input type="text" id="NT_parentid_txt" />
                                        </label>
                                    </td>
                                </tr>
                                <tr style="display: none;">
                                    <td ><label for="NTproject">areaid</label></td>
                                    <td  id="NT_areaidtd">
                                        <label class="input">
                                            <input type="text" id="NT_areaid_txt" />
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Descripción</label></td>
                                    <td  id="NT_tododsctd">
                                        <label class="input">
                                            <input type="text" id="NT_tododsc_txt" />
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Responsable</label></td>
                                    <td  id="NT_useridtd">
                                        <select id="NT_userid_sel" name="NT_userid_sel" class="select2"><option value="">Seleccione</option></select>
                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Prioridad</label></td>
                                    <td  id="NT_prioritytd">
                                        <div class="btn-group">
                                            <button type="button" id="success" class="pr btn btn-success btn-sm" data-value="1" >Normal</button>
                                            <button type="button" id="warning" class="pr btn btn-warning btn-sm" data-value="2" >Media</button>
                                            <button type="button" id="danger"  class="pr btn btn-danger btn-sm"  data-value="3"  >Alta</button>
                                            <input type="hidden" id="NT_priority_sel">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Fecha Inicio</label></td>
                                    <td  id="NT_startdatetd">
                                        <label class="input"> 
                                            <i class="icon-append fa fa-calendar"></i>
                                            <input type="text"  id="NT_startdate_date" name="NT_startdate_date" readonly>
                                        </label>
                                    </td>    
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Fecha Fin</label></td>
                                    <td  id="NT_enddatetd">
                                        <label class="input"> 
                                            <i class="icon-append fa fa-calendar"></i>
                                            <input type="text"  id="NT_enddate_date" name="NT_enddate_date" readonly>
                                        </label>
                                    </td>    
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Objetivo</label></td>
                                    <td  id="NT_notestd">
                                        <textarea class="smart-form obj" id="NT_notes_area_256" name="NT_notes_area_256" rows="4" cols="30"></textarea>
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
<div class="modal fade" id="mpercent" tabindex="-1" role="dialog" aria-labelledby="mpercent" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modificar porcentaje de avance</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="#" id="nproyectcustm" novalidate="novalidate" class="smart-form">	
                    <fieldset>
                        <input type="hidden" id="htodoid">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="20%" style="padding-top: 25px;"><label for="NTproject">Porcentaje</label></td>
                                    <td width="80%" id="NT_tododsctd" style="padding-top: 25px;">
                                        <label class="input">
                                            <input type="range" id="rpercent" value="0" min="0" max="100" step="10" data-rangeslider>
                                            <output></output>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%" style="padding-top: 25px;"><label for="NTproject">Comentario</label></td>
                                    <td id="NT_commenttd">
                                        <textarea class="smart-form obj" id="NT_comment_area_140" rows="4" cols="30"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" class="btn btn-default" id="send_percent" type="button" ata-dismiss="modal">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new" >Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal porcentaje-->
<div class="modal fade" id="mcoment" tabindex="-1" role="dialog" aria-labelledby="mcoment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Comentarios</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="#" id="nproyectcustm" novalidate="novalidate" class="smart-form">	
                    <table id="tblcomment" class="items table table-condensed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Comentario</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <footer>
                        <button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new" >Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal comentarios-->
<style>
    .obj{width: 100%;}
    .obj:hover{border-color: #5D98CC;}
    .palta{background:#CC333F; color: #FAFAFA;}
    .pmedia{background: #FCD036; color: #FAFAFA;}
    .pbaja{background: #11766D; color: #FAFAFA;}
</style>
<script type="text/javascript">
    pageSetUp();
    var add = $('#hadd').val();
    var edt = $('#hedt').val();
    var del = $('#hdel').val();
    var menu = $('#hmenu').val();
    if (add == 0) {
        $('#addtodo').hide();
    }
    if (edt == 0) {
        $('.botones').width('0px');
        $('.botones').hide();
    }
    $('#send_comment').click(function() {

    });
    function hcomment(todoid) {
        $('#tblcomment').DataTable({
            "sAjaxSource": "<?php echo Yii::app()->createUrl('portoprint/OGSM/hcomment'); ?>" + "/todoid/" + todoid,
            "aoColumns": [
                {"mData": "dat", sDefaultContent: ""},
                {"mData": "usr", sDefaultContent: ""},
                {"mData": "com", sDefaultContent: ""}
            ],
            "columnDefs": [
                {"width": "40%", "targets": 0},
                {"width": "30%", "targets": 1},
                {"width": "30%", "targets": 2}
            ],
            "destroy": true,
            "paging": false,
            "ordering": false,
            "info": false,
            "bFilter": false,
            "oLanguage": {
                "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
                "sEmptyTable": "No hay registros.",
                "sInfoEmpty": "No hay registros.",
                "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
                "sProcessing": "Procesando",
                "sSearch": "Buscar:",
                "sZeroRecords": "No hay registros",
            }
        });
    }
    function set_htodoid(todoid) {
        $('#htodoid').val(todoid);
        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/getpercent') ?>', {'todoid': todoid}, function(response) {
            var percent = response;
            $('#rpercent').val(percent).change();
            colorpercent(percent);
        });
    }
    var todoid = $('#hparentid').val();
    $('#example').DataTable({
        "responsive": true,
        "sAjaxSource": "<?php echo Yii::app()->createUrl('portoprint/OGSM/table'); ?>" + "/todoid/" + todoid,
        "aoColumns": [
            {"mData": "pbaja", sDefaultContent: ""},
            {"mData": "pmedia", sDefaultContent: "", "bSearchable": false, "sClass": "alignRight"},
            {"mData": "palta", sDefaultContent: "", "sClass": "alignRight"},
            {"mData": "ebaja", sDefaultContent: "", "bSearchable": false, "sClass": "alignRight"},
            {"mData": "emedia", sDefaultContent: ""},
            {"mData": "ealta", sDefaultContent: "", "bSearchable": false, "sClass": "alignRight"},
            {"mData": "tbaja", sDefaultContent: "", "sClass": "alignRight"},
            {"mData": "tmedia", sDefaultContent: "", "bSearchable": false, "sClass": "alignRight"},
            {"mData": "talta", sDefaultContent: "", "bSearchable": false, "sClass": "alignRight"}
        ],
        "destroy": true,
        "paging": false,
        "ordering": false,
        "info": false,
        "bFilter": false,
        "oLanguage": {
            "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
            "sEmptyTable": "No hay registros.",
            "sInfoEmpty": "No hay registros.",
            "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
            "sProcessing": "Procesando",
            "sSearch": "Buscar:",
            "sZeroRecords": "No hay registros",
        }

    });

    $('#todos').DataTable({
        "sAjaxSource": "<?php echo Yii::app()->createUrl('portoprint/OGSM/findtodos'); ?>" + "/todoid/" + todoid + "/edt/" + edt,
        "aoColumns": [
            {"mData": "pr", sDefaultContent: ""},
            {"mData": "tr", sDefaultContent: "", "bSearchable": false},
            {"mData": "rs", sDefaultContent: ""},
            {"mData": "fi", sDefaultContent: "", "bSearchable": false},
            {"mData": "ff", sDefaultContent: "", "bSearchable": false},
            {"mData": "av", sDefaultContent: ""},
            {"mData": "ap", sDefaultContent: "", "bSearchable": false},
            {"mData": "ma", sDefaultContent: "", "bSearchable": false},
            {"mData": "cm", sDefaultContent: "", "bSearchable": false}
        ],
        //"responsive": true,
        "destroy": true,
        "paging": false,
        "ordering": false,
        "info": false,
        //"bFilter": false,
        "oLanguage": {
            "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
            "sEmptyTable": "No hay registros.",
            "sInfoEmpty": "No hay registros.",
            "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
            "sProcessing": "Procesando",
            "sSearch": "Buscar:",
            "sZeroRecords": "No hay registros",
        }
    });

    var parentid = $('#hparentid').val();
    $('#NT_parentid_txt').val(parentid);
    $('#NT_startdate_date').datepicker({format: 'yyyy-mm-dd'});
    $('#NT_enddate_date').datepicker({format: 'yyyy-mm-dd'});
    var areaid = $("#hareaid").val();
    $('#NT_areaid_txt').val(areaid);
    $('#NT_userid_sel').load('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/userarea') ?>', {'areaid': areaid}).select2("val", '');
    $('.pr').click(function() {
        if (this.id === 'success') {
            $(this).css({'color': '#000'});
            $('#warning').css({'color': '#FFF'});
            $('#danger').css({'color': '#FFF'});
        }
        if (this.id === 'warning') {
            $(this).css({'color': '#000'});
            $('#danger').css({'color': '#FFF'});
            $('#success').css({'color': '#FFF'});
        }
        if (this.id === 'danger') {
            $(this).css({'color': '#000'});
            $('#success').css({'color': '#FFF'});
            $('#warning').css({'color': '#FFF'});
        }

        $('#NT_priority_sel').val($(this).data('value'));
    });
    $('#sendproject').click(function() {
        var valid = 0;
        var bandera = 0;
        var valueToPush = " ";
        var integrador = {};
        $("#nproyectcustm").find('input').each(function() {
            var elemento = this;
            var div = elemento.id.split('_');
            if (div[0] == 'NT') {
                console.log(div[0] + '|' + div[1] + '|' + div[2]);
                valid = valid_expresion_form(elemento.id);
                if (valid == 1) {
                    bandera = 1;
                } else {
                    if (div[2] == 'date') {
                        var f = elemento.value.split("/");
                        var fecha = f[2] + '-' + f[0] + '-' + f[1] + ' 00:00:00';
                        integrador[div[1]] = fecha;
                    }
                    else {
                        integrador[div[1]] = elemento.value;
                    }

                }
            }
        });
        if (valid_expresion_form('NT_notes_area_256') == 1) {
            bandera = 1;
        } else {
            integrador['notes'] = $("#NT_notes_area_256").val();
        }
        if (valid_expresion_form('NT_userid_sel') == 1) {
            bandera = 1;
        } else {
            integrador['userid'] = $("#NT_userid_sel").val();
        }
        integrador['todotype'] = 'O';
        console.log(integrador);
        if (bandera === 0) {
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/createtodo') ?>', {'arrai': integrador}, function(response) {
                if (response > 0) {
                    alert('Se a realizado la insercion correctamente.');
                    location.reload();
                }
            });
        }
    });
    $('#send_percent').click(function() {
        var todoid = $('#htodoid').val();
        var percent = $('#rpercent').val();
        var ok = valid_expresion_form('NT_comment_area_140');
        if (ok == 0) {
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/setpercent') ?>', {'todoid': todoid, 'percent': percent}, function(response) {
                if (response > 0) {
                    var comment = $('#NT_comment_area_140').val();
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/savecomment') ?>', {'todoid': todoid, 'comment': comment}, function(response) {
                        if (response > 0) {
                            alert('Se a realizado la actualización correctamente.');
                            location.reload();
                        }
                    });

                }
            });
        }
    });
    function colorpercent(value) {
        if (value <= 30) {
            $('.rangeslider__fill').css('background', '#CC333F');
        }
        if (value > 30 && value <= 60) {
            $('.rangeslider__fill').css('background', '#FCD036');
        }
        if (value > 60) {
            $('.rangeslider__fill').css('background', '#11766D');
        }
    }

    $(function() {
        var $document = $(document),
                selector = '[data-rangeslider]',
                $element = $(selector);
        // Example functionality to demonstrate a value feedback
        function valueOutput(element) {
            var value = element.value,
                    output = element.parentNode.getElementsByTagName('output')[0];
            output.innerHTML = value;
        }
        for (var i = $element.length - 1; i >= 0; i--) {
            valueOutput($element[i]);
        }
        ;
        $document.on('change', 'input[type="range"]', function(e) {
            valueOutput(e.target);
        });
        // Example functionality to demonstrate disabled functionality
        $document.on('click', '#js-example-disabled button[data-behaviour="toggle"]', function(e) {
            var $inputRange = $('input[type="range"]', e.target.parentNode);
            if ($inputRange[0].disabled) {
                $inputRange.prop("disabled", false);
            }
            else {
                $inputRange.prop("disabled", true);
            }
            $inputRange.rangeslider('update');
        });
        // Example functionality to demonstrate programmatic value changes
        $document.on('click', '#js-example-change-value button', function(e) {
            var $inputRange = $('input[type="range"]', e.target.parentNode),
                    value = $('input[type="number"]', e.target.parentNode)[0].value;
            $inputRange.val(value).change();
        });
        // Example functionality to demonstrate destroy functionality
        $document
                .on('click', '#js-example-destroy button[data-behaviour="destroy"]', function(e) {
                    $('input[type="range"]', e.target.parentNode).rangeslider('destroy');
                })
                .on('click', '#js-example-destroy button[data-behaviour="initialize"]', function(e) {
                    $('input[type="range"]', e.target.parentNode).rangeslider({polyfill: false});
                });
        // Example functionality to test initialisation on hidden elements
        $document
                .on('click', '#js-example-hidden button[data-behaviour="toggle"]', function(e) {
                    var $container = $(e.target.previousElementSibling);
                    $container.toggle();
                });
        // Basic rangeslider initialization
        $element.rangeslider({
            // Deactivate the feature detection
            polyfill: false,
            // Callback function
            onInit: function() {
            },
            // Callback function
            onSlide: function(position, value) {
                //console.log('onSlide');
                //console.log('position: ' + position, 'value: ' + value);
            },
            // Callback function
            onSlideEnd: function(position, value) {
                colorpercent(value);
            }
        });
    });
</script>    