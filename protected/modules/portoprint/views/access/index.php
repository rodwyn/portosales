<?php
$inicio = Ratetracker::model()->_data_first_month_day();
$fin = Ratetracker::model()->_data_last_month_day();
$activdad = Ratetracker::model()->activity($inicio, $fin);
?>
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget  jarviswidget-sortable" id="wid-id-43" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
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
                    <span class="widget-icon"> <i class="glyphicon glyphicon-list-alt"></i> </span>
                    <h2>Registro de actividad</h2>

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
                                        <!--<section class="col col-4">Usuario
                                            <select id="Rate_customerid" name="Rate_customerid" class="select2">
                                                <option value="0">Todos los clientes</option>
                                        <?php foreach ($customerlist as $customerid => $list) { ?>
                                                                <option value="<?php echo $customerid ?>" <?php if ($customerid == $customer) echo "selected='selected'" ?> ><?php echo $list; ?> </option>
                                        <?php } ?>
                                            </select>	

                                        </section>-->
                                        <section class="col col-5">
                                            <a class="btn btn-primary" id="pdf_activity" data-inicio="<?php echo $inicio ?>" data-fin="<?php echo $fin ?>">
                                                Descargar PDF
                                            </a>
                                        </section>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <br><br>
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Actividad</th>
                                    <th>Rate</th>
                                    <th>Responsable</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($activdad as $row) {
                                    echo '<tr>
                                        <td>' . $row->statusdate . '</td>
                                        <td>' . $row->statusdsc . '</td>
                                        <td>' . $row->detalle . '</td>
                                        <td>' . $row->responsable . '</td>
                                    </tr>';
                                }
                                ?>


                            </tbody>
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
<style>
    tr.group,
    tr.group:hover {
        background-color: #ddd !important;
    }
</style>
<script type="text/javascript">
    $('#pdf_activity').click(function(){
        var inicio = $(this).data('inicio');
        var fin = $(this).data('fin');
        location.href="?r=portoprint/pdf/activity/inicio/"+inicio+"/fin/"+fin;
    });
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "destroy": true,
            "columnDefs": [
                {"visible": false, "targets": 2}
            ],
            "order": [[2, 'asc']],
            "displayLength": 25,
            "oLanguage": {
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
                "sEmptyTable": "No hay registros.",
                "sInfoEmpty": "No hay registros.",
                "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
                "sProcessing": "Procesando",
                "sSearch": "Buscar:",
                "sZeroRecords": "No hay registros",
                "oPaginate": {
                    "sPrevious": "Anterior",
                    "sNext": "Siguiente"
                }
            },
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;

                api.column(2, {page: 'current'}).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                                '<tr class="group"><td colspan="3">' + group + '</td></tr>'
                                );

                        last = group;
                    }
                });
            }
        });


    });

    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    var oTable;
    pageSetUp();

    // PAGE RELATED SCRIPT

    var startdt = '<?php echo $inicio; ?>';
    var enddt = '<?php echo $fin; ?>';
    var startt = moment(" <?php echo $inicio; ?>");
    var endt = moment(" <?php echo $fin; ?>");

    var customerid = 0;
    $(document).ready(function runDataTables() {

        moment.lang('es', {
            months: "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split("_"),
            monthsShort: function(m, format) {
                if (/-MMM-/.test(format)) {
                    return monthsShort[m.month()];
                } else {
                    return monthsShortDot[m.month()];
                }
            },
            weekdays: "domingo_lunes_martes_miércoles_jueves_viernes_sábado".split("_"),
            weekdaysShort: "dom._lun._mar._mié._jue._vie._sáb.".split("_"),
            weekdaysMin: "Do_Lu_Ma_Mi_Ju_Vi_Sá".split("_"),
            longDateFormat: {
                LT: "H:mm",
                L: "DD/MM/YYYY",
                LL: "D [de] MMMM [del] YYYY",
                LLL: "D [de] MMMM [del] YYYY LT",
                LLLL: "dddd, D [de] MMMM [del] YYYY LT"
            },
            calendar: {
                sameDay: function() {
                    return '[hoy a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
                },
                nextDay: function() {
                    return '[mañana a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
                },
                nextWeek: function() {
                    return 'dddd [a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
                },
                lastDay: function() {
                    return '[ayer a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
                },
                lastWeek: function() {
                    return '[el] dddd [pasado a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
                },
                sameElse: 'L'
            },
            relativeTime: {
                future: "en %s",
                past: "hace %s",
                s: "unos segundos",
                m: "un minuto",
                mm: "%d minutos",
                h: "una hora",
                hh: "%d horas",
                d: "un día",
                dd: "%d días",
                M: "un mes",
                MM: "%d meses",
                y: "un año",
                yy: "%d años"
            },
            ordinal: '%dº',
            week: {
                dow: 1, // Monday is the first day of the week.
                doy: 4 // The week that contains Jan 4th is the first week of the year.
            }
        });

        $('#ratesrange').daterangepicker(
                {
                    startDate: startdt,
                    endDate: enddt,
                    minDate: '14-03-2011',
                    maxDate: moment(),
                    dateLimit: {days: 90},
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
                        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        firstDay: 1
                    }
                },
        function(start, end) {
            startdt = start.format('YYYY-MM-DD HH:mm:ss');
            enddt = end.format('YYYY-MM-DD HH:mm:ss');
            customerid = $("#Rate_customerid").val();
            $('#pdf_activity').data('inicio',startdt);
            $('#pdf_activity').data('fin',enddt);
            alert(startdt+'/'+enddt);
            //window.location = '?r=portoprint/default#index.php?r=portoprint/access/index/inicio/' + startdt + '/fin/' + enddt + '/customer/' + customerid + '/read/<?php echo $cadena = $menu . '_' . $add . '_' . $edt . '_' . $del; ?>';
            //$.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/access/getactivity') ?>',{startdt:startdt, enddt:enddt }, function(response){	
            //	alert(response);
            //});
            table = $('#example').DataTable({
                "destroy": true,
                "sAjaxSource": "<?php echo Yii::app()->createUrl('portoprint/access/getactivity'); ?>" + "/startdt/" + startdt + "/enddt/" + enddt,
                "aoColumns": [
                    {"mData": "statusdate", sDefaultContent: ""},
                    {"mData": "statusdsc", sDefaultContent: ""},
                    {"mData": "detalle", sDefaultContent: ""},
                    {"mData": "responsable", sDefaultContent: ""}
                ],
                "columnDefs": [
                    {"visible": false, "targets": 2}
                ],
                "order": [[2, 'asc']],
                "displayLength": 25,
                "oLanguage": {
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
                    "sEmptyTable": "No hay registros.",
                    "sInfoEmpty": "No hay registros.",
                    "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
                    "sProcessing": "Procesando",
                    "sSearch": "Buscar:",
                    "sZeroRecords": "No hay registros",
                    "oPaginate": {
                        "sPrevious": "Anterior",
                        "sNext": "Siguiente"
                    }
                },
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({page: 'current'}).nodes();
                    var last = null;

                    api.column(2, {page: 'current'}).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="3">' + group + '</td></tr>'
                                    );

                            last = group;
                        }
                    });
                }
            });

        }
        );
        $('#Rate_customerid').change(function() {
            customerid = $(this).val();
            window.location = '?r=portoprint/default#index.php?r=portoprint/rate/index/start/' + startdt + '/end/' + enddt + '/customer/' + customerid + '/read/<?php echo $cadena = $menu . '_' . $add . '_' . $edt . '_' . $del; ?>';
        });

        $('#ratesrange span').html(startt.format('D MMMM YYYY') + " al " + endt.format('D MMMM D YYYY'));




    });

</script>
