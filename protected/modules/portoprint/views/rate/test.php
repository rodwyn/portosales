<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript(CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl . '/js/jquery.bootstrap.wizard.min.js');
?>
<script type="text/javascript">
    var changeartid;
    var nchangea = 0;
    var ndistribution = 0;
    var ndistributionplace = "";
    var ndistributionquantity = "";
    var useroptions = "";
    var myDropzone = new Dropzone(".dropzone");


    function addrowdistribution() {
        ndistributionplace = $('#distributionplacef').val();
        ndistributionquantity = $('#distributionquantityf').val();
        if (ndistributionplace != '' && ndistributionquantity != '') {
            ndistribution++;
            var content = '<tr class="drdl" id="drd_' + ndistribution + '">';
            content += '<td>' + ndistributionplace + '<input type="hidden" name="ndpf_' + ndistribution + '" id="ndpf_' + ndistribution + '" value="' + ndistributionplace + '"></td>';
            content += '<td>' + ndistributionquantity + '<input type="hidden" name="ndcf_' + ndistribution + '" id="ndcf_' + ndistribution + '" value="' + ndistributionquantity + '"></td>';
            content += '<td><a href="javascript:deletedistribution(' + ndistribution + ');" class="btn btn-danger btn-xs" id="delrdistributionbtn_' + ndistribution + '" >X</a></td>';
            content += '</tr>';
            $('#ratedistributiontable').append(content);
            $('#distributionplacef, #distributionquantityf').val('');
        } else
            alert("Los campos no pueden estar vacíos, por favor verifique");
    }

    function deletedistribution(nd) {
        $('#drd_' + nd).remove();
    }

    function deletechangeart(idfix) {
        $('#calr_' + idfix).remove();
    }
    function caclean(id) {
        var old = $("#hca_" + id).val();
        var nwe = $("#ca_" + id).val();
        var odi = id;
        if (old != nwe) {
            $("#step1error").fadeOut();
            $("#cal_" + id + "_table").empty();

            if ($("#ca_" + id).val() != '' && $("#ca_" + id).val() > 0) {
                if (id < 6) {
                    id++;
                    $("#ca_" + id).attr('disabled', false);
                }
            } else {
                id++;
                while (id <= 6) {
                    $("#ca_" + id).attr('disabled', true).val('0');
                    $("#cal_" + id + "_table").empty();
                    id++;
                }
            }
        }
        $("#hca_" + odi).val($("#ca_" + odi).val());
    }

    function showchangeartform(id) {
        changeartid = id;
        $("#changeartname").focus();
        $("#changeartname, #changeartquantity").val("");
        $('#ChangeArtD').modal();
    }

    function savechangeart() {
        var tot = 0;

        if ($("#changeartname").val() == '' || isNaN($("#changeartquantity").val())) {
            alert("Los campos no pueden estar vacíos y solo pueden contener números, por favor verifique");
        } else {
            $('[id^="caqf_' + changeartid + '"]').each(function() {
                tot += Number($(this).val());
            });
            tot += eval($("#changeartquantity").val());
            if (eval($("#ca_" + changeartid).val()) < tot) {
                alert("La suma de los cambios de arte (" + tot + ") no puede ser mayor a la cantidad a cotizar (" + eval($("#ca_" + changeartid).val()) + "), por favor verifique ", function() {
                });
            } else {
                nchangea++;
                cacontent = '<tr id="calr_' + changeartid + '_' + nchangea + '">';
                cacontent += '<td>' + $("#changeartname").val() + '<input type="hidden" name="canf[' + changeartid + '][' + nchangea + ']" id="canf_' + changeartid + '_' + nchangea + '" value="' + $("#changeartname").val() + '"></td>';
                cacontent += '<td>' + $("#changeartquantity").val() + '<input type="hidden" class="caqfc" name="caqf[' + changeartid + '][' + nchangea + ']" id="caqf_' + changeartid + '_' + nchangea + '" value="' + $("#changeartquantity").val() + '"> <input type="hidden" name="changeartid[' + changeartid + '][' + nchangea + ']" id="chid_' + changeartid + '_' + nchangea + '" value="' + changeartid + '" > </td>';
                cacontent += '<td width="15"><a href="javascript:deletechangeart(\'' + changeartid + '_' + nchangea + '\');" class="btn btn-danger btn-xs" id="delcabtn_' + changeartid + '_' + nchangea + '" >X</a></td>';
                cacontent += '</tr>';
                $('#cal_' + changeartid + '_table').append(cacontent);
            }
        }
    }

    function newitemdatilvalue(idid) {
        var result = prompt("Introduzca el nuevo valor")
        if (result !== null) {
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/additemdetailvalue') ?>', {itemdetailid: idid, value: result}, function(response) {
                $('#itemdetail_' + idid).load('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/itemdetailvalue') ?>/itemdetailid/' + idid, function() {
                    $('#itemdetail_' + idid).val(response).select2("val", response);

                });

            });

        }

    }
    var completo2 = false;
    var completo3 = false;
    $(document).ready(function() {
        $('.dqr').each(function(i) {
            var id = i + 1;
            $("#hca_" + id).val($("#ca_" + id).val());
        });
        $(".dqr").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A
                            (e.keyCode == 65 && e.ctrlKey === true) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });

        $('#rootwizard').bootstrapWizard({
            onNext: function(tab, navigation, index) {

                if (index == 1) {
                    var cantidad = 0;
                    $(".dqr").each(function(a, b) {
                        if (!isNaN($(this).val())) {
                            cantidad += eval($(this).val());
                        }
                    });

                    if (cantidad <= 0) {
                        $("#step1error").fadeIn();
                        return false;
                    } else {
                        var ca1 = parseInt($("#ca_1").val());
                        var ca2 = parseInt($("#ca_2").val());
                        var ca3 = parseInt($("#ca_3").val());
                        var ca4 = parseInt($("#ca_4").val());
                        var ca5 = parseInt($("#ca_5").val());
                        var ca6 = parseInt($("#ca_6").val());

                        if ((ca1 >= ca2 && ca2) || (ca2 >= ca3 && ca3) || (ca3 >= ca4 && ca4) || (ca4 >= ca5 && ca5) || (ca5 >= ca6 && ca6)) {
                            $("#step1error").fadeIn();
                            return false;
                        }

                    }


                }
                if (index == 2) {
                    completo2 = true;
                    $(".itemdetailtable  select").each(function(a, b) {
                        if ($(b).val() == '' && completo2 == true)
                            completo2 = false
                    });

                    if (completo2 == false) {
                        $("#step2error").show();
                        completo2 = false;
                        return false;
                    }
                }
                if (index == 3) {
                    completo3 = false;
                    $(".supplierdetailtable input:checked").each(function(a, b) {
                        completo3 = true;
                    });

                    if (completo3 == false) {
                        $("#step3error").show();
                        completo3 = false;
                        return false;
                    }
                }

            }
            , onTabClick: function(tab, navigation, index) {
                return false;
            }
            , onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index;
                var $percent = ($current / $total) * 100;
                $('#wid-id-0').find('.bar').css({width: $percent + '%'});
                $('.bar').html(' ' + parseInt($percent) + '% completado');
            }});



        $("#extraitemsbtn").click(function() {
            if ($(this).is(':checked'))
                $("#extraitemsdiv").show();
            else
                $("#extraitemsdiv").hide();
        });

        $("#extraitemsnumber").change(function() {
            $("#itembody").html('');

            var customerid = $('#Rate_customerid').val();
            var nl = $("#extraitemsnumber").val();
            var opt = $("#Rate_serviceid").html();

            for (x = 1; x <= nl; x++) {

                $("#itembody").append('<tr><th>Item</th><td><select style="width:350px;" data-placeholder="Seleccione" class="chzn-select itemextrai" rel="' + x + '" name="ei[' + x + ']" id="ei_' + x + '"></select></td><th>Comprador</th><td><select style="width:350px;" data-placeholder="Seleccione" class="chzn-select itemextrac" name="cei[' + x + ']" id="cei_' + x + '" ></select></td></tr>');

                $("#ei_" + x).change(function() {
                    var entryid = $(this).val();
                    var numberrow = $(this).attr('rel')
                    $.get('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/userservice') ?>/customerid/' + customerid + '/entryid/' + entryid, function(data) {
                        $('#cei_' + numberrow).html(data).trigger("liszt:updated");
                    }, 'html');
                });
            }


        });
    });


</script>
<!-- widget grid -->

<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2><strong>Completar Cotización </strong> </h2>				
                    <div class="widget-toolbar"> 
                        <div class="progress progress-striped active" rel="tooltip" data-placement="bottom">
                            <div class="bar progress-bar progress-bar-blue" role="progressbar" ></div>
                        </div>
                    </div>
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
                            <div class="row show-grid">
                                <div class="col-md-5"><strong>ID Cotización:</strong> <?php echo $rate->bundleid; ?></div>
                                <div class="col-md-5"><strong>Cliente:</strong> <?php echo $rate->customerdsc; ?></div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row show-grid">
                                <div class="col-md-5"><strong>ID Item-Cotización:</strong> <?php echo $rate->rateid; ?></div>
                                <div class="col-md-5"><strong>Marca:</strong> <?php echo $rate->branddsc; ?></div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row show-grid">
                                <div class="col-md-5"><strong>Item:</strong> <?php echo $rate->servicedsc; ?></div>
                                <div class="col-md-5"><strong>Proyecto:</strong> <?php echo $rate->projectdsc; ?></div>
                                <div class="col-md-2"></div>
                            </div>

                        </div>

                        <form novalidate="novalidate" class="smart-form" id="completerate-form" novalidate="novalidate" method="POST" action="?r=portoprint/rate/completed/id/<?php echo Utils::encrypt($rate->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>" >
                            <input type="hidden" id="h_rateid" name="h_rateid" value="<?php echo $rate->rateid; ?>" >
                            <div id="rootwizard" >
                                <div class="navbar">
                                    <div class="navbar-inner">
                                        <div class="container">
                                            <ul class="nav nav-pills">
                                                <li><a href="#tab1" data-toggle="tab">1 Cantidades</a></li>
                                                <li><a href="#tab2" data-toggle="tab">2 Atributos</a></li>
                                                <li><a href="#tab3" data-toggle="tab">3 Proveedores</a></li>	
                                                <li><a href="#tab4" data-toggle="tab">4 Distribución</a></li>
                                                <li><a href="#tab5" data-toggle="tab">5 Archivos</a></li>									
                                                <li><a href="#tab6" data-toggle="tab">6 Terminar</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <header><strong>1 Cantidades a cotizar</strong></header>
                                        <fieldset>

                                            <div id="step1error" class="alert alert-danger fade in" style="display:none;">											
                                                <strong>Introduzca al menos una cantidad a cotizar para poder continuar. Una nueva cantidad debe ser siempre mayor a la anterior.</strong>
                                            </div>

                                            <div class="row">								
                                                <section class="col col-2">									
                                                    <input type="text" value="0" name="ca[1]" id="ca_1"  onmouseup="js: $(this).select();" onkeyup="caclean(1);" class="dqr">
                                                    <input type="hidden" id="hca_1">
                                                </section>
                                                <section class="col col-2">
                                                    <input type="text" value="0" disabled="disabled" name="ca[2]" id="ca_2"  onmouseup="js: $(this).select();" onkeyup="caclean(2);" class="dqr">
                                                    <input type="hidden" id="hca_2">
                                                </section>	
                                                <section class="col col-2">
                                                    <input type="text" value="0" disabled="disabled" name="ca[3]" id="ca_3"  onmouseup="js: $(this).select();" onkeyup="caclean(3);" class="dqr">
                                                    <input type="hidden" id="hca_3">
                                                </section>	
                                                <section class="col col-2">
                                                    <input type="text" value="0" disabled="disabled" name="ca[4]" id="ca_4"  onmouseup="js: $(this).select();" onkeyup="caclean(4);" class="dqr">
                                                    <input type="hidden" id="hca_4">
                                                </section>	
                                                <section class="col col-2">
                                                    <input type="text" value="0" disabled="disabled" name="ca[5]" id="ca_5"  onmouseup="js: $(this).select();" onkeyup="caclean(5);" class="dqr">
                                                    <input type="hidden" id="hca_5">
                                                </section>	
                                                <section class="col col-2">
                                                    <input type="text" value="0" disabled="disabled" name="ca[6]" id="ca_6"  onmouseup="js: $(this).select();" onkeyup="caclean(6);" class="dqr">
                                                    <input type="hidden" id="hca_6">
                                                </section>								
                                            </div>
                                            <div class="row">								
                                                <section class="col col-2">																	
                                                    <a class="btn btn-default btn-xs" href="javascript:showchangeartform(1);">Cambios de Arte</a>
                                                    <table id="cal_1_table" style="width:100%;"></table>															
                                                </section>
                                                <section class="col col-2">									
                                                    <a class="btn btn-default btn-xs" href="javascript:showchangeartform(2);">Cambios de Arte</a>
                                                    <table id="cal_2_table" style="width:100%;"></table>
                                                </section>
                                                <section class="col col-2">									
                                                    <a class="btn btn-default btn-xs" href="javascript:showchangeartform(3);">Cambios de Arte</a>
                                                    <table id="cal_3_table" style="width:100%;"></table>
                                                </section>
                                                <section class="col col-2">									
                                                    <a class="btn btn-default btn-xs" href="javascript:showchangeartform(4);">Cambios de Arte</a>
                                                    <table id="cal_4_table" style="width:100%;"></table>
                                                </section>
                                                <section class="col col-2">									
                                                    <a class="btn btn-default btn-xs" href="javascript:showchangeartform(5);">Cambios de Arte</a>
                                                    <table id="cal_5_table" style="width:100%;"></table>
                                                </section>
                                                <section class="col col-2">									
                                                    <a class="btn btn-default btn-xs" href="javascript:showchangeartform(6);">Cambios de Arte</a>
                                                    <table id="cal_6_table" style="width:100%;"></table>
                                                </section>

                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <header><strong>2 Atributos</strong></header>
                                        <fieldset>
<?php $this->renderPartial('_item', array('item' => $item)); ?>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <header><strong>3 Proveedores</strong></header>
                                        <fieldset>
<?php $this->renderPartial('_supplier', array('item' => $item)); ?>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                        <header><strong>4 Distribución</strong></header>
                                        <fieldset>
<?php $this->renderPartial('_distribution', array('item' => $item)); ?>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        <header><strong>5 Archivos</strong></header>
                                        <fieldset>
<?php $this->renderPartial('_files', array('item' => $item, 'rate' => $rate)); ?>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="tab6">
                                        <header><strong>6 Terminar</strong></header>
                                        <fieldset>
                                            <div class="row">								
                                                <section class="col col-3">	</section>
                                                <section class="col col-6">
                                                    <div class="alert alert-info fade in">
                                                        <i class="fa-fw fa fa-check"></i>
                                                        <strong>Proceso finalizado, por favor confirme para guardar los datos.</strong>
                                                    </div>
                                                </section>
                                                <section class="col col-3">	</section>
                                            </div>
                                            <div class="row">								
                                                <section class="col col-4">	
                                                </section>
                                                <section class="col col-4">	

                                                </section>
                                                <section class="col col-4">	
                                                </section>
                                            </div>
                                        </fieldset>
                                        <footer>
                                            <div class="row">								
                                                <section class="col col-4">	
                                                </section>
                                                <section class="col col-4">	
                                                    <button class="btn btn-success btn-lg btn-block" type="submit">Confirmar</button>
                                                </section>
                                                <section class="col col-4">	
                                                </section>
                                            </div>

                                        </footer>



                                    </div>

                                    <ul class="pager wizard">
                                        <li class="previous"><a href="javascript:void(0);">Anterior</a></li>
                                        <li class="next"><a href="javascript:void(0);">Siguiente</a></li>
                                    </ul>
                                </div>	
                            </div>
                        </form>




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



<div class="modal fade" id="ChangeArtD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Cambios de Arte</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <div class="row">								
                        <section class="col col-12">
                            <label >Nombre</label>
                            <label class="input"> 
                                <input type="text" value="" style="width:400px" id="changeartname">
                            </label>
                        </section>
                        <section class="col col-12">
                            <label >Cantidad</label>
                            <label class="input"> 
                                <input type="text" value="" style="width:100px; text-align: right;" id="changeartquantity">
                            </label>
                        </section>
                    </div>

                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary"  onclick="javascript:savechangeart();" data-dismiss="modal" id="changeartok">
                    Aceptar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    pageSetUp();


</script>