<div class="row">

</div>	

<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
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
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Cotizaciones </h2>

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
                                        <section class="col col-4">Cliente
                                            <select id="Rate_customerid" name="Rate_customerid" class="select2">
                                                <option value="0">Todos los clientes</option>
                                                <?php foreach ($customerlist as $customerid => $list) { ?>
                                                    <option value="<?php echo $customerid ?>" <?php if ($customerid == $customer) echo "selected='selected'" ?> ><?php echo $list; ?> </option>
                                                <?php } ?>
                                            </select>	

                                        </section>
                                        <section class="col col-5">&nbsp;</section>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <br><br>
                        <table id="ratelist_table" class="table table-striped " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Cotización ID</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Marca</th>
                                    <th>Proyecto</th>
                                    <th>Item</th>
                                </tr>
                            </thead>
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

<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    var oTable;
    pageSetUp();

    // PAGE RELATED SCRIPT

    var startdt = '<?php echo $start; ?>';
    var enddt = '<?php echo $end; ?>';
    var startt = moment(" <?php echo $start; ?>");
    var endt = moment(" <?php echo $end; ?>");

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
            startdt = start.format('YYYY-MM-DD');
            enddt = end.format('YYYY-MM-DD');
            customerid = $("#Rate_customerid").val();
            window.location = '?r=portoprint/default#index.php?r=portoprint/rate/index/start/' + startdt + '/end/' + enddt + '/customer/' + customerid + '/read/<?php echo $cadena = $menu . '_' . $add . '_' . $edt . '_' . $del; ?>';

        }
        );
        $('#Rate_customerid').change(function() {
            customerid = $(this).val();
            window.location = '?r=portoprint/default#index.php?r=portoprint/rate/index/start/' + startdt + '/end/' + enddt + '/customer/' + customerid + '/read/<?php echo $cadena = $menu . '_' . $add . '_' . $edt . '_' . $del; ?>';
        });

        $('#ratesrange span').html(startt.format('D MMMM YYYY') + " al " + endt.format('D MMMM D YYYY'));

        var oTable = $('#ratelist_table').dataTable({
            //"sAjaxSource":  "<?php echo Yii::app()->createUrl('/portoprint/rate/rate', array('customer' => $customer, 'add' => $add, 'edt' => $edt, 'del' => $del, 'menu' => $menu)); ?>"+"&start="+startdt+"&end="+enddt,
            "ajax": {
                "url": "<?php echo Yii::app()->createUrl('/portoprint/rate/rate', array('customer' => $customer, 'add' => $add, 'edt' => $edt, 'del' => $del, 'menu' => $menu)); ?>" + "&start=" + startdt + "&end=" + enddt,
                "type": "POST"
            },
            "destroy": true,
            "columnDefs": [
                {"visible": false, "targets": 5},
                { "sClass": "my_class", "aTargets": [ 0 ] },
                { "sClass": "my_class", "aTargets": [ 1 ] },
                { "sClass": "my_class", "aTargets": [ 2 ] },
                { "sClass": "my_class", "aTargets": [ 3 ] },
                { "sClass": "my_class", "aTargets": [ 4 ] }
            ],
            "order": [[0, 'dsc']],
            "displayLength": 25,
            "aoColumns": [
                {"mData": "bundleid", sDefaultContent: ""},
                {"mData": "ratedate", sDefaultContent: "", "bSearchable": false},
                {"mData": "customerdsc", sDefaultContent: ""},
                {"mData": "branddsc", sDefaultContent: ""},
                {"mData": "projectdsc", sDefaultContent: ""},
                {"mData": "servicedsc", sDefaultContent: ""}
            ],
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
                //console.log(rows);
                var cols = api.columns({page: 'current'}).data();

                api.column(5, {page: 'current'}).data().each(function(group, i) {
                    if (last !== group) {
                        var tl = '<tr class="header_hijo"><td colspan="2">Item</td><td>Estatus</td><td>ODP</td><td>ODC</td></tr>';
                        var tr = '';
                        var a = group.split("¬");
                        for (x = 0; x < a.length; x++) {
                            var b = a[x].split("|");
                            tr += '<tr><td class="tr_white" style="font-weight: bolder; font-size: 12px;" colspan="2">' + b[0]
                                    + '</td><td class="tr_white"><i>' + b[1]
                                    + '</i></td><td class="tr_white"><i>' + b[2]
                                    + '</i></td><td class="tr_white"><i>' + b[3]
                                    + '</i></td></tr>';
                        }

                        $(rows).eq(i).after(tl+tr);    
                        last = group;
                        //console.log(last);
                    }
                });
            }
        });
        /*oTable = $('#ratelist_table').dataTable({
         "order": [ 0, 'desc' ],
         "sAjaxSource":  "<?php echo Yii::app()->createUrl('/portoprint/rate/rate', array('customer' => $customer, 'add' => $add, 'edt' => $edt, 'del' => $del, 'menu' => $menu)); ?>"+"&start="+startdt+"&end="+enddt,
         "aoColumns": [
         { "mData": "bundleid", sDefaultContent: "" },
         { "mData": "ratedate", sDefaultContent: "","bSearchable": false },
         { "mData": "customerdsc", sDefaultContent: ""},
         { "mData": "branddsc", sDefaultContent: ""},
         { "mData": "projectdsc", sDefaultContent: ""},
         { "mData": "servicedsc", sDefaultContent: "" }
         ] ,
         "oLanguage": {
         "sLengthMenu": "Mostrar _MENU_ registros",
         "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
         "sEmptyTable": "No hay registros.",
         "sInfoEmpty" : "No hay registros.",
         "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
         "sProcessing": "Procesando",
         "sSearch": "Buscar:",
         "sZeroRecords": "No hay registros"
         }
         
         });*/

    });

</script>
<style>
.header_hijo{background-color: #eeeeee;
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f2f2f2), to(#fafafa));
background-image: -webkit-linear-gradient(top, #f2f2f2 0, #fafafa 100%);
background-image: -moz-linear-gradient(top, #f2f2f2 0, #fafafa 100%);
background-image: -ms-linear-gradient(top, #f2f2f2 0, #fafafa 100%);
background-image: -o-linear-gradient(top, #f2f2f2 0, #fafafa 100%);
background-image: -linear-gradient(top, #f2f2f2 0, #fafafa 100%);
font-size: 12px;
font-weight: bolder;
}
.table-striped>tbody>tr>td, .table-striped>tbody>tr>th {background-color: #f9f9f9;}
.tr_white{background-color: #fff !important;}
.my_class {
background-color: #AAB4CA !important;
}
.table>thead:first-child>tr:first-child>th {
background-color: #384C7A !important;
color: #fff;
}
</style>