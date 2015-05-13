<input type="hidden" id="hadd" value="<?php echo $add; ?>">
<input type="hidden" id="hedt" value="<?php echo $edt; ?>">
<input type="hidden" id="hdel" value="<?php echo $del; ?>">
<input type="hidden" id="hmenu" value="<?php echo $menu; ?>">
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="glyphicon glyphicon-calendar"></i>Action Plan</h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8"></div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->

    <div class="row">

        <?php
        $cnt = 1;
        $ogsm = $model->getOgsm();
        $area = Todoarea::model()->findAll();
        $st = "";
        $gauge = "";
        
        foreach ($ogsm as $fila) {
            $st .= ($st == "") ? '#gauge' . $cnt : ', #gauge' . $cnt;
            ?>
            <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">

                <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="" data-widget-editbutton="false" data-widget-colorbutton="false" role="widget" style="">

                    <!-- widget options:
                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                    data-widget-colorbutton="false"
                    data-widget-editbutton="false"
                    data-widget-togglebutton="false"
                    data-widget-deletebutton="false"
                    data-widget-fullscreenbutton="false"
                    data-widget-custombutton="false"
                    data-widget-collapsed="true"
                    data-widget-sortable="false"

                    -->

                    <header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="#" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-resize-full "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div>
                        <span class="widget-icon"> <i class="glyphicon glyphicon-calendar txt-color-white"></i> </span>
                        <button type="button" class="btn btn-link txt-color-white btn-ogsm" data-todoid="<?php echo $fila->todoid; ?>"><?php echo $fila->tododsc; ?></button>
                        <!-- <div class="widget-toolbar">
                        add: non-hidden - to disable auto hide

                        </div>-->

                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

                    <!-- widget div-->
                    <div role="content">
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <div>
                                <label>Title:</label>
                                <input type="text">
                            </div>
                        </div>
                        <!-- end widget edit box -->

                        <div class="widget-body no-padding smart-form">
                            <div style="display: table; width: 100%; background: #fafafa;">
                                <div style="float: left; width: 75%;">
                                    <h5 class="todo-group-title" style="font-size: 14px; color: #000;">Área: <?php echo $fila->areadsc; ?> </h5>
                                    <h5 class="todo-group-title" style="font-size: 14px; color: #000; text-transform: capitalize;">Responsable: <?php echo $fila->responsable; ?></h5>
                                    <h5 class="todo-group-title" style="font-size: 14px; color: #000;">Fecha Inicio: <?php echo $fila->startdate; ?></h5>
                                    <h5 class="todo-group-title" style="font-size: 14px; color: #000;">Fecha Fin: <?php echo $fila->enddate; ?></h5>
                                    <h5 class="todo-group-title" style="font-size: 14px; color: #000;">Objetivo: <?php echo $fila->notes; ?></h5>        
                                </div>
                                <div style="float: right; width: 25%;">
                                    <h5 class="todo-group-title porcentaje" style="font-size: 14px; color: #000; padding: 15px 0px; border: none;">
                                        <div id="gauge<?php echo $cnt; ?>"  ></div>   
                                    </h5>
                                </div>
                            </div>
                            <!-- content goes here -->


                            <!-- end content -->
                        </div>

                    </div>
                    <!-- end widget div -->
                </div></article>
        <script>
        var g<?php echo $cnt ;?> = new JustGage({
                id: 'gauge<?php echo $cnt ;?>',
                value: <?php echo $fila->porcentaje ;?>,
                min: 0,
                max: 100,
                title: '<?php echo $fila->tododsc ;?>'
            });
        </script>
            
        <?php
        $cnt++;
        } ?>
        <!-- Agregar nuevo ogsm -->
        <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable" id="addogsm">

            <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false" role="widget" style="">

                <header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="#" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-resize-full "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div>
                    <span class="widget-icon"> <i class="glyphicon glyphicon-calendar txt-color-white"></i> </span>
                    <h2><b>Agregar OGSM</b></h2>

                    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

                <!-- widget div-->
                <div role="content">
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <div>
                            <label>Title:</label>
                            <input type="text">
                        </div>
                    </div>
                    <!-- end widget edit box -->

                    <div class="widget-body no-padding smart-form">
                        <!-- content goes here -->
                        <form id="tabla">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td ><label for="NTproject">Descripción</label></td>
                                        <td  id="NT_tododsctd">
                                            <label class="input"> 
                                                <input type="text" id="NT_tododsc_txt" />
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label for="NTproject">Área</label></td>
                                        <td  id="NT_areaidtd">
                                            <select id="NT_areaid_sel" name="NT_areaid_sel" class="select2"><option value="">Seleccione</option></select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label for="NTproject">Responsable</label></td>
                                        <td  id="NT_useridtd">
                                            <select id="NT_userid_sel" name="NT_userid_sel" class="select2"><option value="">Seleccione</option></select>
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
                                            <textarea class="smart-form obj" id="NT_notes_txt" name="NT_notes_txt" rows="4" cols="30"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label for="NTproject"></label></td>
                                        <td  id="NT_legalentitytd">
                                            <button type="button" id="send_todo" class="btn btn-primary btn-lg" style="float: right;">Guardar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <!-- end content -->
                    </div>

                </div>
                <!-- end widget div -->
            </div></article>
    </div>

    <!-- end row -->

</section>
<!-- end widget grid -->
<style>
    <?php echo $st; ?>{
        width: 130px;
        height: 100px;
        display: inline-block;
        
    }
    .tabla{display: table;  width: 100%; border-collapse: separate; border-spacing: 5px;}
    .fila{display: table-row;  width: 100%;}
    .column_a{display: table-cell;  width: 30%; padding: 0 0 0 10px; font-size: 14px; color: #000;}
    .column_b{display: table-cell;  width: 70%;}
    .obj{width: 100%;}
    .obj:hover{border-color: #5D98CC;}
    .btn-ogsm{font-weight: bold;}
    .porcentaje{text-align: right; padding: 7px 15px;}
</style>
<script type="text/javascript">
    pageSetUp();
    var add = $('#hadd').val();
    var edt = $('#hedt').val();
    var del = $('#hdel').val();
    var menu = $('#hmenu').val();

    var read = menu + "_" + add + "_" + edt + "_" + del;


    $('#NT_areaid_sel').load('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/area') ?>').select2("val", '');
    $('#NT_userid_sel').load('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/responsable') ?>').select2("val", '');
    $('#NT_startdate_date').datepicker({format: 'yyyy-mm-dd'});
    $('#NT_enddate_date').datepicker({format: 'yyyy-mm-dd'});
    $('#send_todo').click(function() {
        //console.log($("#NT_areaid").val());
        var valid = 0;
        var bandera = 0;
        var bandera1 = 0;
        var bandera2 = 0;
        var valueToPush = " ";
        var integrador = {};
        $("#tabla").find('input').each(function() {
            var elemento = this;

            var div = elemento.id.split('_');
            if (div[0] == 'NT') {
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
            } else {
                if (div[0] == 'T1') {
                    if (valueToPush == " ") {
                        valueToPush = elemento.value;
                    } else {
                        valueToPush += " a " + elemento.value;
                        integrador[div[1]] = valueToPush;
                    }
                } else if (div[0] == 'T2') {


                }
            }
        });
        if (valid_expresion_form('NT_notes_txt') == 1) {
            bandera = 1;
        } else {
            integrador['notes'] = $("#NT_notes_txt").val();
        }
        if (valid_expresion_form('NT_areaid_sel') == 1) {
            bandera = 1;
        } else {
            integrador['areaid'] = $("#NT_areaid_sel").val();
        }
        if (valid_expresion_form('NT_userid_sel') == 1) {
            bandera = 1;
        } else {
            integrador['userid'] = $("#NT_userid_sel").val();
        }

        console.log(integrador);
        console.log(bandera + ' ' + bandera1 + ' ' + bandera2);
        if (bandera == 0 && bandera1 == 0 && bandera2 == 0) {
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/createogsm') ?>', {'arrai': integrador}, function(response) {
                if (response > 0) {
                    alert('Se a realizado la insercion correctamente.');
                    location.reload();
                }
            });
        }
    });
    $('.btn-ogsm').click(function() {
        location.href = "?r=portoprint/default#index.php?r=portoprint/OGSM/viewtodos/todoid/" + $(this).data('todoid') + "/read/" + read;
    });
    if (add == 0) {
        $('#addogsm').hide();
    }

</script>