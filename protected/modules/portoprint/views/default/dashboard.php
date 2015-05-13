<?php
$coti = Todo::model()->percent('C', Yii::app()->user->userid);
$pers = Todo::model()->percent('P', Yii::app()->user->userid);
$ogsm = Todo::model()->getOgsm();

$cnt = 1;
$gauge = "";
$div_gauge = "";
$st = "";
foreach ($ogsm as $value) {
    $st .= ($st == "") ? '#gauge' . $cnt : ', #gauge' . $cnt;
    $div_gauge .= '<div id="gauge' . $cnt . '" class="200x160px" ></div>';
    $gauge .= "
        var g" . $cnt . " = new JustGage({
        id: 'gauge" . $cnt . "',
        value: " . $value->porcentaje . ",
        min: 0,
        max: 100,
        title: '" . $value->tododsc . "'
    });";
    $cnt++;
}
foreach ($pers as $value) {
    $porcentaje = ($value->porcentaje=="")?0:$value->porcentaje;
    $st .= ($st == "") ? '#gauge' . $cnt : ', #gauge' . $cnt;
    $div_gauge .= '<div id="gauge' . $cnt . '" class="200x160px" ></div>';
    $gauge .= "
        var g" . $cnt . " = new JustGage({
        id: 'gauge" . $cnt . "',
        value: " .$porcentaje. ",
        min: 0,
        max: 100,
        title: 'Personales'
    });";
    $cnt++;
}
foreach ($coti as $value) {
    $porcentaje = ($value->porcentaje=="")?0:$value->porcentaje;
    $st .= ($st == "") ? '#gauge' . $cnt : ', #gauge' . $cnt;
    $div_gauge .= '<div id="gauge' . $cnt . '" class="200x160px" ></div>';
    $gauge .= "
        var g" . $cnt . " = new JustGage({
        id: 'gauge" . $cnt . "',
        value: " . $porcentaje . ",
        min: 0,
        max: 100,
        title: 'Cotizaciones'
    });";
    $cnt++;
}
?>
<div class="row">
   <!-- <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span><?php echo Yii::app()->user->companydsc; ?></span></h1>
    </div> -->
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

    </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">
        <article class="col-sm-12">
            <!-- new widget -->
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-colorbutton="false" >

                <header>

                    <h2 id="evalua"> Evalución del Sistema </h2>
                </header>	

                <div>
                    <?php echo $div_gauge; ?>

                </div>

            </div>
            <!-- end widget -->

        </article>
    </div>

    <!-- end row -->

    <!-- row -->

    <div class="row">

        <article class="col-sm-12 col-md-12 col-lg-6">


            <!-- new widget -->

            <!-- end widget -->

            <!-- new widget -->
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-colorbutton="false">

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
                <header>
                    <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                    <h2 id="titl"> Eventos </h2>
                    <div class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <div class="btn-group">
                            <button class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown">
                                Mostrar <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu js-status-update pull-right">
                                <li>
                                    <a href="javascript:void(0);" id="mt">Mes</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" id="ag">Agenda</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" id="td">Hoy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>

                <!-- widget div-->
                <div>
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">

                        <input class="form-control" type="text">

                    </div>
                    <!-- end widget edit box -->

                    <div class="widget-body no-padding">
                        <!-- content goes here -->
                        <div class="widget-body-toolbar">

                        </div>
                        <div id="calendar"> </div>

                        <!-- end content -->
                    </div>

                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->

        </article>
        <?php
        $todos = Todo::model()->mytodos(Yii::app()->user->userid);
        $togsm = "";
        $tpers = "";
        $trate = "";
        $countogsm = 0;
        $countpers = 0;
        $countrate = 0;

        foreach ($todos as $fila) {
            switch ($fila->priority) {
                case 1:
                    $color = "#11766D";
                    break;
                case 2:
                    $color = "#FCD036";
                    break;
                case 3:
                    $color = "#CC333F";
                    break;
            }
            $countogsm += ($fila->todotype == 'O') ? 1 : 0;
            $countpers += ($fila->todotype == 'P') ? 1 : 0;
            $countrate += ($fila->todotype == 'C') ? 1 : 0;

            $togsm .= ($fila->todotype == 'O') ? '<li>
                                <span class="handle" style="background: ' . $color . ';">  </span>
                                <p>
                                    <strong>' . $fila->tododsc . '</strong> - ' . $fila->area . ' 
                                        <span class="text-muted"><strong>Avance: </strong>' . $fila->porcentaje . '%</span>
                                        <span class="text-muted"><strong>Prioridad: </strong>' . $fila->prioridad . '</span>
                                        <span class="text-muted"><strong>Objetivo: </strong>' . $fila->notes . '</span>    
                                    <span class="date"><strong>Fecha inicio: </strong>' . date("d-m-Y", strtotime($fila->startdate)) . '</span>
                                    <span class="date"><strong>Fecha fin: </strong>' . date("d-m-Y", strtotime($fila->enddate)) . '</span>    
                                </p>
                            </li>' : '';
            $tpers .= ($fila->todotype == 'P') ? '<li>
                                <span class="handle" style="background: ' . $color . ';"></span>
                                <p>
                                    <strong>' . $fila->tododsc . '</strong> - ' . $fila->area . ' 
                                        <span class="text-muted"><strong>Avance: </strong>' . $fila->porcentaje . '%</span>
                                        <span class="text-muted"><strong>Prioridad: </strong>' . $fila->prioridad . '</span>
                                        <span class="text-muted"><strong>Objetivo: </strong>' . $fila->notes . '</span>    
                                    <span class="date"><strong>Fecha inicio: </strong>' . date("d-m-Y", strtotime($fila->startdate)) . '</span>
                                    <span class="date"><strong>Fecha fin: </strong>' . date("d-m-Y", strtotime($fila->enddate)) . '</span>
                                    <div style="position: absolute; top: 10px; right: 5px;">    
                                    <button type="button" title="Modificar porcentaje de avance" href="#mpercent" data-target="#mpercent" data-toggle="modal" class="btn btn-primary btn-sm bavance" onclick="set_htodoid('.$fila->todoid.');" >
                                        <span class="glyphicon glyphicon-stats"></span>
                                    </button>
                                    </div>
                                </p>
                            </li>' : '';
            $trate .= ($fila->todotype == 'C') ? '<li>
                                <span class="handle" style="background: ' . $color . ';">  </span>
                                <p>
                                    <strong>' . $fila->tododsc . '</strong> - ' . $fila->area . '
                                        <span class="text-muted">Avance: ' . $fila->porcentaje . '%</span>
                                        <span class="text-muted">Prioridad: ' . $fila->prioridad . '</span>
                                        <span class="text-muted"><strong>Objetivo: </strong>' . $fila->notes . '</span>    
                                    <span class="date">Fecha inicio: ' . date("d-m-Y", strtotime($fila->startdate)) . '</span>
                                    <span class="date">Fecha fin: ' . date("d-m-Y", strtotime($fila->enddate)) . '</span>    
                                    <div style="position: absolute; top: 10px; right: 5px;">    
                                    <button type="button" title="Modificar porcentaje de avance" href="#mpercent" data-target="#mpercent" data-toggle="modal" class="btn btn-primary btn-sm bavance" onclick="set_htodoid('.$fila->todoid.');" >
                                        <span class="glyphicon glyphicon-stats"></span>
                                    </button>
                                    </div>    
                                </p>
                            </li>' : '';
        }
        ?>
        <article class="col-sm-12 col-md-12 col-lg-6">


            <!-- new widget -->
            <div class="jarviswidget jarviswidget-color-blue" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">

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

                <header>
                    <span class="widget-icon"> <i class="fa fa-check txt-color-white"></i> </span>
                    <h2> ToDo's </h2>
                    <!-- <div class="widget-toolbar">
                    add: non-hidden - to disable auto hide

                    </div>-->
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <div>
                            <label>Title:</label>
                            <input type="text" />
                        </div>
                    </div>
                    <!-- end widget edit box -->
                    <div class="widget-body no-padding smart-form">
                        <!-- content goes here -->
                        <h5 class="todo-group-title"><i class="glyphicon glyphicon-calendar"></i> ToDo's OGSM (<small class="num-of-tasks"><?php echo $countogsm; ?></small>)</h5>
                        <ul id="sortable1" class="todo ui-sortable">
                            <?php echo $togsm; ?>
                        </ul>
                        <h5 class="todo-group-title"><i class="glyphicon glyphicon-calendar"></i> ToDo's Personales (<small class="num-of-tasks"><?php echo $countpers; ?></small>)
                            <div style="display: -webkit-inline-box; float: right; padding: 0px 5px;">
                                <button type="button" class="btn btn-primary btn-xs" href="#newproject" data-target="#newproject" data-toggle="modal">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </div>

                        </h5>
                        <ul id="sortable2" class="todo ui-sortable">
                            <?php echo $tpers; ?>
                        </ul>

                        <h5 class="todo-group-title"><i class="glyphicon glyphicon-calendar"></i> ToDo's Cotización (<small class="num-of-tasks"><?php echo $countrate; ?></small>)</h5>
                        <ul id="sortable3" class="todo">
                            <?php echo $trate; ?>
                        </ul>

                        <!-- end content -->
                    </div>

                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->

        </article>

    </div>

    <!-- end row -->

</section>
<!-- end widget grid -->
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
                                <tr>
                                    <td ><label for="NTproject">Descripción</label></td>
                                    <td  id="NT_tododsctd">
                                        <label class="input">
                                            <input type="text" id="NT_tododsc_txt" />
                                        </label>
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
                                        <textarea class="smart-form obj" id="NT_notes_area_140" name="NT_notes_area_140" rows="4" cols="30"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject" type="button" ata-dismiss="modal">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="but    ton" id="cancel_new" >Cancelar</button>			
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
<style>
    .obj{width: 100%;}
    .obj:hover{border-color: #5D98CC;}
    <?php echo $st; ?>{
        width: 200px;
        height: 160px;
        display: inline-block;
        margin: 1em;
    }
</style>
<script type="text/javascript">
    pageSetUp();
    setupCalendar();
    <?php echo $gauge; ?>
    setInterval(function(){
        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/getodo') ?>', {'userid': <?php echo Yii::app()->user->userid; ?>}, function(response) {
            console.log('cambio');
            var data = response.split("|");
            $('#sortable1').html(data[0]);
            $('#sortable2').html(data[2]);
            $('#sortable3').html(data[1]);
        });
    }, 120000);    
    function set_htodoid(todoid) {
        $('#htodoid').val(todoid);
        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/getpercent') ?>', {'todoid': todoid}, function(response) {
            var percent = response;
            $('#rpercent').val(percent).change();
            colorpercent(percent);
        });
    }
    var todoid = $('#hparentid').val();
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
                colorpercent(value);
                //console.log('onSlide');
                //console.log('position: ' + position, 'value: ' + value);
            },
            // Callback function
            onSlideEnd: function(position, value) {
                colorpercent(value);
            }
        });
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
    $("#titl").html("Eventos");
    $("#evalua").html("<b>Evaluación del Sistema</b>");
    $('#NT_startdate_date').datepicker({format: 'yyyy-mm-dd'});
    $('#NT_enddate_date').datepicker({format: 'yyyy-mm-dd'});
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
        var integrador = {};
        $("#nproyectcustm").find('input').each(function() {
            var elemento = this;
            var div = elemento.id.split('_');
            if (div[0] == 'NT') {
                //console.log(div[0] + '|' + div[1] + '|' + div[2]);
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
        if (valid_expresion_form('NT_notes_area_140') == 1) {
            bandera = 1;
        } else {
            integrador['notes'] = $("#NT_notes_area_140").val();
        }
        integrador['todotype'] = 'P';
        integrador['parentid'] = 0;
        integrador['areaid'] = 0;
        integrador['userid'] = '<?php echo Yii::app()->user->userid; ?>';
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



    function setupCalendar() {

        if ($("#calendar").length) {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var calendar = $('#calendar').fullCalendar({
                editable: false,
                draggable: false,
                selectable: false,
                selectHelper: true,
                unselectAuto: true,
                disableResizing: false,
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                buttonText: {
                    today: 'hoy',
                    month: 'mes',
                    week: 'semana',
                    day: 'día'
                },
                events: '<?php echo Yii::app()->createAbsoluteUrl('/portoprint/default/events'); ?>',
                eventClick: function(calEvent, jsEvent, view) {

                    alert('Event: ' + calEvent.title);
                    alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                    alert('View: ' + view.name);

                    // change the border color just for fun
                    $(this).css('border-color', 'red');

                }

            });

        }
        ;



    }
    /*
     // calendar prev
     $('#calendar-buttons #btn-prev').click(function () {
     $('.fc-button-prev').click();
     return false;
     });
     
     // calendar next
     $('#calendar-buttons #btn-next').click(function () {
     $('.fc-button-next').click();
     return false;
     });*/

    // calendar today
    $('#calendar-buttons #btn-today').click(function() {
        $('.fc-button-today').click();
        return false;
    });

    // calendar month
    $('#mt').click(function() {
        $('#calendar').fullCalendar('changeView', 'month');
    });

    // calendar agenda week
    $('#ag').click(function() {
        $('#calendar').fullCalendar('changeView', 'agendaWeek');
    });

    // calendar agenda day
    $('#td').click(function() {
        $('#calendar').fullCalendar('changeView', 'agendaDay');
    });

    $("#calendar").find(".fc-header").css("position", "relative");
    $("#calendar").find(".fc-header").css("top", "-19px");

    $("#calendar").find(".fc-header-title").css("position", "relative");
    $("#calendar").find(".fc-header-title").css("top", "15px");



    pageSetUp();

    /*
     * PAGE RELATED SCRIPTS
     */

    // pagefunction

    var pagefunction = function() {



        /*
         * TODO: add a way to add more todo's to list
         */

        // initialize sortable

        $("#sortable1, #sortable2, #sortable3").sortable({
            handle: '.handle',
            //connectWith: ".todo",
            update: countTasks
        }).disableSelection();


        // check and uncheck
        /*$('.todo .checkbox > input[type="checkbox"]').click(function() {
         var $this = $(this).parent().parent().parent();
         
         if ($(this).prop('checked')) {
         $this.addClass("complete");
         
         // remove this if you want to undo a check list once checked
         //$(this).attr("disabled", true);
         $(this).parent().hide();
         
         // once clicked - add class, copy to memory then remove and add to sortable3
         $this.slideUp(500, function() {
         $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
         $this.remove();
         countTasks();
         });
         } else {
         // insert undo code here...
         }
         
         });*/
        // count tasks
        function countTasks() {

            $('.todo-group-title').each(function() {
                var $this = $(this);
                $this.find(".num-of-tasks").text($this.next().find("li").size());
            });

        }

















    };

    // end pagefunction

    // destroy generated instances 
    // pagedestroy is called automatically before loading a new page
    // only usable in AJAX version!



    // end destroy

    // run pagefunction on load
    pagefunction();

</script>
