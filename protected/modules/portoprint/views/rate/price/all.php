<script>

    function save_parcial_odp(rateid, rateid1, bundleid) {

        var cant = $("#cantidad_parcial_odp_" + rateid).find("#NT_candpar_dsc").val();
        var parcial = $("#cantidad_parcial_odp_" + rateid).find("#cant_par_odp").html();
        var total = $("#cantidad_parcial_odp_" + rateid).find("#cant_tol_odp").html();
        if (cant == '') {
            alert("El campo de cantidad parcial no puede permanecer vacio");
            return false;
        }

        cant = parseInt(cant);
        parcial = parseInt(total);
        if (cant > parcial) {
            alert("La cantidad ingresada debe ser menor a la restante");
            return false;
        }


        location.href = "?r=portoprint/pdf/odp/id/" + rateid1 + "/bundle/" + bundleid + "/cantpar/" + cant + "/cantot/" + total;
        window.setTimeout("location.reload()", 2600);

        //location.reload();

    }

    function cantidad_parcial_odp(rateid) {

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/cant_tol_odp') ?>', {'rateid': rateid}, function(response) {
            var div = response.split(',');
            $("#cantidad_parcial_odp_" + rateid).find('#cant_tol_odp').html(div[0]);
            $("#cantidad_parcial_odp_" + rateid).find('#cant_par_odp').html(div[1]);
            //$("#ntToDos_"+rateid).find('#NT_areaid_sel').select2();
        });

        $("#cantidad_parcial_odp_" + rateid).modal('show');

        //$("#cantidad_parcial_odp_"+rateid).
    }

    function cantidad_total_odc(rateid) {


        location.href = "?r=portoprint/pdf/odc/id/" + rateid;
        window.setTimeout("location.reload()", 2600);

        //$("#cantidad_parcial_odp_"+rateid).
    }


    function fechadores_todos(rateid) {

        $("#ntToDos_" + rateid).find('#NT_startdate_daty').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#ntToDos_" + rateid).find('#NT_enddate_daty').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/area') ?>', {}, function(response) {
            $("#ntToDos_" + rateid).find('#NT_areaid_sel').html(response);
            $("#ntToDos_" + rateid).find('#NT_areaid_sel').select2();
        });
        $("#ntToDos_" + rateid).find('#NT_userid_sel').hide();

    }
    function fechadores_todosp(rateid) {

        $("#ntToDosp_" + rateid).find('#NT_startdate_daty').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#ntToDosp_" + rateid).find('#NT_enddate_daty').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/area') ?>', {}, function(response) {
            $("#ntToDosp_" + rateid).find('#NT_areaid_sel').html(response);
            $("#ntToDosp_" + rateid).find('#NT_areaid_sel').select2();
        });
        $("#ntToDosp_" + rateid).find('#NT_userid_sel').hide();

    }

    function fechadores_todo_c(rateid) {

        $("#ntcToDos_" + rateid).find('#NT_startdate_daty').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#ntcToDos_" + rateid).find('#NT_enddate_daty').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/area') ?>', {}, function(response) {
            $("#ntcToDos_" + rateid).find('#NT_areaid_sel').html(response);
            $("#ntcToDos_" + rateid).find('#NT_areaid_sel').select2();
        });
        $("#ntcToDos_" + rateid).find('#NT_userid_sel').hide();


    }

    function fechadores_todo_cp(rateid) {

        $("#ntcpToDos_" + rateid).find('#NT_startdate_daty').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#ntcpToDos_" + rateid).find('#NT_enddate_daty').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/area') ?>', {}, function(response) {
            $("#ntcpToDos_" + rateid).find('#NT_areaid_sel').html(response);
            $("#ntcpToDos_" + rateid).find('#NT_areaid_sel').select2();
        });
        $("#ntcpToDos_" + rateid).find('#NT_userid_sel').hide();


    }



    function selector_personal(areaid, rateid) {

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/userarea') ?>', {'areaid': areaid}, function(response) {
            $("#ntToDos_" + rateid).find('#NT_userid_sel').html(response);
            $("#ntToDos_" + rateid).find('#NT_userid_sel').show();
            $("#ntToDos_" + rateid).find('#NT_userid_sel').select2();
            //
        });

    }
    function selector_personalp(areaid, rateid) {

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/userarea') ?>', {'areaid': areaid}, function(response) {
            $("#ntToDosp_" + rateid).find('#NT_userid_sel').html(response);
            $("#ntToDosp_" + rateid).find('#NT_userid_sel').show();
            $("#ntToDosp_" + rateid).find('#NT_userid_sel').select2();
            //
        });

    }
    function selector_personal_c(areaid, rateid) {

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/userarea') ?>', {'areaid': areaid}, function(response) {

            var result = response.toString();
            $("#ntcToDos_" + rateid).find('#NT_userid_sel').html(result);
            $("#ntcToDos_" + rateid).find('#NT_userid_sel').show();
            $("#ntcToDos_" + rateid).find('#NT_userid_sel').select2();
            //  
        });

    }

    function selector_personal_cp(areaid, rateid) {

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/userarea') ?>', {'areaid': areaid}, function(response) {

            var result = response.toString();
            $("#ntcpToDos_" + rateid).find('#NT_userid_sel').html(result);
            $("#ntcpToDos_" + rateid).find('#NT_userid_sel').show();
            $("#ntcpToDos_" + rateid).find('#NT_userid_sel').select2();
            //  
        });

    }

    function save_todo_cot(rateid) {

        var cadena = rateid;
        var valid = 0;
        var bandera = 0;
        var bandera1 = 0;
        var valueToPush = " ";
        var integrador = {};
        integrador['rateid'] = cadena;
        $("#ntToDos_" + cadena).find('input[type=text], input[type=hidden],textarea, select').each(function() {
            var elemento = this;

            var div = elemento.id.split('_');
            if (div[0] == 'NT') {
                valid = valid_expresion_form(elemento.id);
                if (valid == 1) {
                    bandera = 1;
                } else {

                    integrador[div[1]] = elemento.value;

                }
            }
        });



        if (bandera == 0) {
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/createtodocot') ?>', {'arrai': integrador}, function(response) {

                if (response == -1) {
                    alert('No se puede crear, no existe un ToDo padre para esta cotizacion, puede que la cotizacion sea del viejo sistema.');
                } else {

                    alert('Se a realizado la insercion correctamente.');
                    $('#ToDos_' + cadena).modal('hide');
                    location.reload();

                }


            });
        }

    }
    function save_todo_cotp(rateid) {

        var cadena = rateid;
        var valid = 0;
        var bandera = 0;
        var bandera1 = 0;
        var valueToPush = " ";
        var integrador = {};
        integrador['rateid'] = cadena;
        $("#ntToDosp_" + cadena).find('input[type=text], input[type=hidden],textarea, select').each(function() {
            var elemento = this;

            var div = elemento.id.split('_');
            if (div[0] == 'NT') {
                valid = valid_expresion_form(elemento.id);
                if (valid == 1) {
                    bandera = 1;
                } else {

                    integrador[div[1]] = elemento.value;

                }
            }
        });



        if (bandera == 0) {
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/createtodocot') ?>', {'arrai': integrador}, function(response) {

                if (response == -1) {
                    alert('No se puede crear, no existe un ToDo padre para esta cotizacion, puede que la cotizacion sea del viejo sistema.');
                } else {

                    alert('Se a realizado la insercion correctamente.');
                    $('#ToDosp_' + cadena).modal('hide');
                    location.reload();

                }


            });
        }

    }
    function save_todo_cot_c(rateid) {
        var cadena = rateid;
        var valid = 0;
        var bandera = 0;
        var bandera1 = 0;
        var valueToPush = " ";
        var integrador = {};
        integrador['rateid'] = cadena;
        $("#ntcToDos_" + cadena).find('input[type=text], input[type=hidden], textarea, select').each(function() {
            var elemento = this;

            var div = elemento.id.split('_');
            if (div[0] == 'NT') {
                valid = valid_expresion_form(elemento.id);
                if (valid == 1) {
                    bandera = 1;
                } else {

                    integrador[div[1]] = elemento.value;

                }
            }
        });


        if (bandera == 0) {
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/createtodocot') ?>', {'arrai': integrador}, function(response) {

                if (response == -1) {
                    alert('No se puede crear, no existe un ToDo padre para esta cotizacion, puede que la cotizacion sea del viejo sistema.');
                } else {

                    alert('Se a realizado la insercion correctamente.');
                    $('#ToDo_' + cadena).modal('hide');
                    location.reload();

                }


            });
        }


    }


    function save_todo_cot_cp(rateid) {
        var cadena = rateid;
        var valid = 0;
        var bandera = 0;
        var bandera1 = 0;
        var valueToPush = " ";
        var integrador = {};
        integrador['rateid'] = cadena;
        $("#ntcpToDos_" + cadena).find('input[type=text], input[type=hidden], textarea, select').each(function() {
            var elemento = this;

            var div = elemento.id.split('_');
            if (div[0] == 'NT') {
                valid = valid_expresion_form(elemento.id);
                if (valid == 1) {
                    bandera = 1;
                } else {

                    integrador[div[1]] = elemento.value;

                }
            }
        });


        if (bandera == 0) {
            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/OGSM/createtodocot') ?>', {'arrai': integrador}, function(response) {

                if (response == -1) {
                    alert('No se puede crear, no existe un ToDo padre para esta cotizacion, puede que la cotizacion sea del viejo sistema.');
                } else {

                    alert('Se a realizado la insercion correctamente.');
                    $('#ToDop_' + cadena).modal('hide');
                    location.reload();

                }


            });
        }


    }

    function actualizar_estatus_prod(id, rateid) {


        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/statusproduction_1') ?>', {id: rateid, value: id}, function(response) {

            if (response != 're') {
                $("#status_odp_dsc_" + rateid).html(response);
                location.reload();
            } else {
                location.reload();
            }
        });

    }

    function cambiar_st_rate_(rateid, id) {

        $("#estatus_list_odp_" + rateid).find("#estatus_selfor").select2();
        $("#estatus_list_odp_" + rateid).find("#estatus_selfor").select2("val", id);


    }

    function todo_cot_prio(x, id) {
        $("#" + id).find("#NT_priority_sel").attr("value", x);
    }

    function redondeo2decimales(numero)
    {
        var original = parseFloat(numero);
        var result = Math.round(original * 100) / 100;
        return result;
    }

    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    function extend(id, confirmed) {
        if (confirmed)
            window.location = "<?php echo Yii::app()->createAbsoluteUrl('/portoprint/rate/extend') ?>/id/" + id + '/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>';
    }

    function finalize(id, n) {
        var rs = $('#rateprice-' + n + '-form input[name="selectedsupplier"]:checked').val();
        var qx = $('#rateprice-' + n + '-form input[name="quantity_selected"]:checked').val();
        if (rs && qx) {
            window.location = "?r=portoprint/rate/finalize/id/" + id + "/rs/" + rs + "/qx/" + qx + '/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>';
        } else
            alert("Para poder liberar debes seleccionar primero cantidad a cotizar y proveedor.");
    }

    function saveprice(rateid) {



        // /add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>'

    }

    function finalize_odc(id, n, idc, vals) {

        if (vals == '0') {
            var idef = $("#ratecalculatetable_" + n).find('[style="background-color:#D9FAD9;"]').attr('id');
            var div = idef.split('_');
            var rs = div[1];
            var qx = $("#ratecalculatetable_" + n).find('[class="glyphicon glyphicon-ok"]').attr('name');

        } else {
            var rs = $('#rateprice-' + n + '-form input[name="selectedsupplier"]:checked').val();
            var qx = $('#rateprice-' + n + '-form input[name="quantity_selected"]:checked').val();
        }


        var ivaodc = $("#ODCModal_" + n).find('#ivaodc_' + n).val();
        var fodcc = $("#ODCModal_" + n).find('#fodcc_' + n).val();
        var nodcc = $("#ODCModal_" + n).find('#nodcc_' + n).val();

        if (rs && qx) {

            if (ivaodc != '' && fodcc != '' && nodcc != '') {
                $.post('<?php echo Yii::app()->createAbsoluteUrl('/portoprint/rate/generateodc1') ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>', {'id': id, 'rs': rs, 'qx': qx, 'ivaodc': ivaodc, 'fodcc': fodcc, 'nodcc': nodcc}, function(response) {

                                    if (response != 0) {
                                        location.reload();

                                    }

                                });
                            } else {
                                alert("Alguno de los campos solicitados en la emergente no a sido llenado.");
                            }
                            //window.location = "?r=portoprint/rate/generateodc/id/"+id+"/rs/"+rs+"/qx/"+qx+"/ivaodc/"+ivaodc+"/fodcc/"+fodcc+"/nodcc/"+nodcc+"/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>";

                        } else {
                            alert("Para poder liberar debes seleccionar primero cantidad a cotizar y proveedor.");
                            $("#ODCModal_" + n).modal('hide');
                        }
                    }

                    function finalize_odp(id, n, idp, vals) {

                        if (vals == '0') {
                            var idef = $("#ratecalculatetable_" + n).find('[style="background-color:#D9FAD9;"]').attr('id');
                            var div = idef.split('_');
                            var rs = div[1];
                            var qx = $("#ratecalculatetable_" + n).find('[class="glyphicon glyphicon-ok"]').attr('name');

                        } else {
                            var rs = $('#rateprice-' + n + '-form input[name="selectedsupplier"]:checked').val();
                            var qx = $('#rateprice-' + n + '-form input[name="quantity_selected"]:checked').val();
                        }

                        if (rs && qx) {
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('/portoprint/rate/generateodp1') ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>', {'id': id, 'rs': rs, 'qx': qx}, function(response) {

                                            if (response != 0) {
                                                location.reload();

                                            }

                                        });


                                    } else {
                                        alert("Para poder liberar debes seleccionar primero cantidad a cotizar y proveedor.");
                                        $("#ODPModal_" + n).modal('hide');
                                    }

                                }

                                function completetopdf(id, n) {
                                    var qx = $('#rateprice-' + n + '-form input[name="quantity_selected"]:checked').val();
                                    if (qx) {
                                        window.location = "?r=portoprint/rate/completetopdf/id/" + id + '/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>';
                                    } else
                                        alert("Para agregar a PDF debes seleccionar primero cantidad a cotizar.");
                                }
                                function removetopdf(id, n) {
                                    window.location = "?r=portoprint/rate/removetopdf/id/" + id + '/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>';
                                }

                                function table_arte_test_zero(st, op, rateid) {
                                    $('#art_color_' + rateid + '_' + st + '_' + op).dataTable({
                                        "order": [0, 'asc'],
                                        "responsive": true,
                                        "bLengthChange": false,
                                        "bFilter": false,
                                        "bSort": false,
                                        "info": false,
                                        "dom": '<"#newssp"<><l><f>>tip',
                                        "destroy": true,
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


                                function calculatesavepp(cnn, rateid, formula) {
                                    var acum = 0;
                                    var cont = 0;
                                    var prom = 0;
                                    var min = 0;
                                    var pp = 0;
                                    var save = 0;
                                    $('#ratecalculatetable_' + rateid + ' [id^="quantity_' + cnn + '_"]').each(function() {
                                        var supp = $(this).attr('title');
                                        if ($('#ratecalculatetable_' + rateid + ' #show_' + supp).attr('checked')) {
                                            var val = Number($(this).val());
                                            if (cont == 0)
                                                min = val;

                                            if (val < min)
                                                min = val;

                                            acum += val;
                                            cont++;
                                        }
                                    });
                                    prom = acum / cont;
                                    pp = min + ((prom - min) * 0.50);
                                    save = prom - pp;

                                    $('#ratecalculatetable_' + rateid + '  #' + rateid + '_pp_' + cnn).html(addCommas(redondeo2decimales(pp)));
                                    $('#ratecalculatetable_' + rateid + '  #' + rateid + '_save_' + cnn).html(addCommas(redondeo2decimales(save)));
                                }

                                var list = new Array();
                                var listaprom = new Array();
                                function calculatesave(cnn, rateid, formula) {
                                    var acum = 0;
                                    var cont = 0;
                                    var prom = 0;
                                    var min = 0;
                                    var pp = 0;
                                    var save = 0;
                                    var smin = null;


                                    $('#ratecalculatetable_' + rateid + ' [id^="calculate_' + cnn + '_"]').each(function() {
                                        var supp = $(this).attr('title');
                                        $('#ratecalculatetable_' + rateid + ' #c_' + cnn + '_' + supp).removeClass('notcalculate');
                                        $('#ratecalculatetable_' + rateid + ' #c_' + cnn + '_' + supp).removeClass('minorprice');

                                        if ($('#ratecalculatetable_' + rateid + ' #show_' + supp).is(':checked')) {

                                            var val = Number($(this).val());

                                            if (cont == 0) {
                                                min = val;
                                                smin = supp;
                                            }
                                            if (val < min) {
                                                min = val;
                                                if (val > 0)
                                                    smin = supp;
                                            }
                                            acum += val;
                                            cont++;
                                        } else {
                                            $('#ratecalculatetable_' + rateid + ' #c_' + cnn + '_' + supp).addClass('notcalculate');

                                        }


                                    });
                                    prom = acum / cont;

                                    //list[cnn]=prom;

                                    eval(formula);



                                    $('#ratecalculatetable_' + rateid + ' #ppp_' + cnn + '_' + rateid).val(redondeo2decimales(pp));
                                    $('#ratecalculatetable_' + rateid + ' #' + rateid + '_cpp_' + cnn).html(addCommas(redondeo2decimales(pp)));


                                    $('#ratecalculatetable_' + rateid + ' #' + rateid + '_csave_' + cnn).html(addCommas(redondeo2decimales(save)));
                                    $('#ratecalculatetable_' + rateid + ' #c_' + cnn + '_' + smin).addClass('minorprice');


                                }

                                function send_pdf_down() {
                                    var rates = "";

                                    $(".sel").each(function() {
                                        if ($(this).is(':checked')) {
                                            rates += (rates == "") ? $(this).val() : ',' + $(this).val();
                                        }
                                    });

                                    var vp = ($('#up').is(':checked')) ? 1 : 0;
                                    if (rates != "") {
                                        location.href = "?r=portoprint/pdf/bundle/id/<?php echo Utils::encrypt($bundleid, 'rate'); ?>/rates/" + rates + "/vp/" + vp;
                                    } else {
                                        alert("No tiene ninguna contizacion en resumen, seleccione una para continuar");
                                    }
                                }
                                function select_date_rate_mod(id) {
                                    $("#change_rateid_<?php echo $bundleid; ?>").find("#rate_sel_dif_rate").hide();
                                    var ratedate = $("#" + id).val();

                                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/listfordaterate') ?>', {'ratedate': ratedate}, function(response) {

                                        if (response != 0) {
                                            $("#rate_modif_rate").find("tbody").html(response);
                                        } else {
                                            $("#rate_modif_rate").find("tbody").html();
                                        }

                                    });
                                }
                                function selec_dif_ratedate(rateid) {

                                    $("#change_rateid_<?php echo $bundleid; ?>").find("#rate_sel_dif_rate").css("display", "inline");

                                    $("#botton_ratedate_save").attr("data-ratedate", rateid);

                                    /*     $("#change_rateid_<?php echo $bundleid; ?>").find('#change_rateid_datemodif_i').datetimepicker({
                                     format: 'Y-m-d H:i'
                                     });
                                     $("#change_rateid_<?php echo $bundleid; ?>").find('#change_rateid_datemodif_f').datetimepicker({
                                     format: 'Y-m-d H:i'
                                     });*/


                                }
                                function chang_ratedate_save() {

                                    var original_rateid = $("#ratedate_origin_chan").val();
                                    var original_bundleid = $("#bundleid_origin_chan").val();
                                    var rateidamodif = $("#botton_ratedate_save").data("ratedate");
                                    var newratedate_i = $("#change_rateid_datemodif_i").val();
                                    var newratedate_f = $("#change_rateid_datemodif_f").val();


                                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/change_save_newratedate') ?>', {'rateidamodif': rateidamodif, 'newratedate_i': newratedate_i, 'newratedate_f': newratedate_f, 'original_rateid': original_rateid, 'original_bundleid': original_bundleid}, function(response) {

                                        if (response != 0) {
                                            alert("Cambio Realizado con exito");

                                            $("#change_rateid_<?php echo $bundleid; ?>").modal('hide');

                                        } else {
                                            alert("No se pudo realizar el cambio");
                                        }

                                    });

                                }

                                $(function() {


                                    /*         $("#change_rateid_<?php echo $bundleid; ?>").find('#change_rateid_datespe').datetimepicker({
                                     format: 'Y-m-d H:i'
                                     });
                                     */
                                    $("#ml3").addClass('active');

                                    /**/

                                    $('.ratepop').popover({"trigger": "hover", "html": true, "container": "body"});

                                    $('#Rate_userid').select2();
                                    $('#Rate_serviceid').select2().change(function() {
                                        var entryid = $(this).val();
                                        $.get('index.php?r=portoprint/combos/userservice/customerid/<?php echo $customerid ?>/entryid/' + entryid, function(data) {
                                            $('#Rate_userid').html(data).select2();
                                        }, 'html');
                                    });

                                    $("#generaPDF").click(function() {
                                        var datapdf = '';
                                        $("input[name='id_pdf[]']:checked").each(function(a, b) {
                                            datapdf += 'id_pdf[]/' + $(b).val() + '/';
                                        });
                                        window.location = '<?php echo Yii::app()->createAbsoluteUrl('/portoprint/pdf/rate', array('id' => Utils::encrypt($bundleid, 'rate'))); ?>/' + datapdf
                                    });
                                    $("#regresar_cotiza").click(function() {
                                        //window.location = '?r=portoprint/default#index.php?r=portoprint/rate/retorn';
                                        window.location = '<?php echo Yii::app()->createAbsoluteUrl('?r=portoprint/default#index.php?r=portoprint/rate/index', array('start' => Utils::decrypt($start, 'rate'), 'end' => Utils::decrypt($end, 'rate'), 'customer' => $customer, 'read' => $menu . '_' . $add . '_' . $edt . '_' . $del)); ?>';


                                    });
                                });
</script>


<div class="jarviswidget  jarviswidget-sortable" id="wid-id-all" data-widget-fullscreenbutton="true" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
    <header>
        <span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2><strong>Detalle en cotización</strong> </h2>
        <div class="btn-group btn-group-xs" style="position: relative; left:50%; top:-6px; ">
            <a  class="btn btn-info" id="regresar_cotiza" ><i class="fa fa-repeat"></i> &nbsp;Regresar a Cotizaciones</a>
        </div>  

        <div class="widget-toolbar">

            <div class="btn-group">
                <a href="#newitem" class="btn btn btn-success" data-target="#newitem"  data-toggle="modal"><i class="fa fa-cog"></i> Agregar Nuevo Item</a>

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
                <div class="row">
                    <div class="col-md-5"><strong>ID Cotización:</strong> <?php echo $bundleid; ?></div>
                    <div class="col-md-5"><strong>Cliente:</strong> <?php echo $customer; ?></div>
                    <div class="col-md-2">  
                        <?php
                        $permiss = Permission::model()->findAllByAttributes(array('menuid' => $menu, 'permissiongroup' => 'ScreenShot'));
                        $listperm = Specialpermission::model()->findAllByAttributes(array('userid' => Yii::app()->user->userid, 'permissionid' => $permiss[0]['permissionid']));

                        if ($listperm[0]["active"] != 0) {
                            ?>
                            <div class="btn-group">
                                <a href="#change_rateid" class="btn btn btn-danger" data-target="#change_rateid"  data-toggle="modal"><i class="glyphicon glyphicon-screenshot"></i>&nbsp;&nbsp;Screenshot</a>
                            </div> 
                        <?php } ?>

                    </div>
                </div>
                <div class="row">

                    <div class="col-md-5"><strong>Marca:</strong> <?php echo $brand; ?></div>
                    <div class="col-md-5"><strong>Proyecto:</strong> <?php echo $project; ?></div>
                    <div class="col-md-2"> 
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-5"></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-2">


                    </div>

                </div>
                <div class="row">
                    <div class="col-md-8">
                        <?php
                        foreach ($model as $row) {
                            echo "<fieldset><br /><br />";
                            $rate = $row['rate'];


                            if ($rate->statusid != 35) {
                                $menulist = Permission::model()->findByAttributes(array('menuid' => $menu, 'permissiongroup' => 'Detalles'));
                                $menupermision = Specialpermission::model()->findByAttributes(array('userid' => Yii::app()->user->userid, 'permissionid' => $menulist->permissionid));
                                $view="";
                                if ($rate->statusid == 99)
                                    $view = 'price/porcompletar';
                                else if ($rate->statusid == 1)
                                    $view = 'price/sinenviar';
                                else if (in_array($rate->statusid, array(2, 3, 4)) && $rate->raterenegotiate == "1" && $menupermision != null) //|| $rate->statusid==5 && $rate->odctime== null
                                    $view = 'price/open_renego';
                                else if (in_array($rate->statusid, array(2, 3, 4)) && $rate->raterenegotiate == "0" && $menupermision != null || $rate->statusid == 5 && $rate->odctime == '' && $rate->odptime == '' && $menupermision != null) //|| $rate->statusid==5 && $rate->odctime== null
                                    $view = 'price/open';
                                else if (in_array($rate->statusid, array(2, 3, 4)) && $rate->raterenegotiate == "0" && $menupermision === null || $rate->statusid == 5 && $rate->odctime == null && $rate->odptime == null && $menupermision === null)
                                    $view = 'price/open_perm';
                                else if ($rate->statusid == 101)
                                    $view = 'price/requote';
                                else if ($rate->statusid == 5 && count($menupermision) != 0 && $rate->raterenegotiate == "0" && ( $rate->odctime!= '' || $rate->odptime!= '') ) //&& $rate->odctime!= null
                                    $view = 'price/close';
                                else if ($rate->statusid == 5 && count($menupermision) == 0 && $rate->raterenegotiate == "0" && ( $rate->odctime!= '' || $rate->odptime!= ''))
                                    $view = 'price/close_perm';
 
                                
                                  $this->renderPartial($view, array(
                                  'model' => $rate, 'ratesuppliers' => $row['ratesuppliers'], 'entry' => $row['entrydsc'], 'entryid' => $row['entryid'], 'manualratesupplier' => $manualratesupplier, 'bundleid' => $bundleid, 'rating' => $rating, "add" => $add, "edt" => $edt, "del" => $del, "menu" => $menu, 'ahorroextra' => $ahorroextra,'customerid' => $customerid
                                  ));
                                 

                            }

                            echo "</fieldset>";
                        }
                        ?>

                    </div>

                    <div class="col-md-4" id="resumens" style=" position: fixed; right: 0px; top: 110px; ">
                        <div class="modal-dialog demo-modal">
                            <div class="modal-content" style="height: 500px;">
                                <div class="modal-header" style="padding: 6px;" >
                                    <h6 class="modal-title" style="padding-left: 20px;">Resumen del Proyecto</h6>
                                </div>
                                <div class="modal-body" style="padding-top: 2px; height: 410px;">
                                    <table class="table table-bordered" style="font-size: 10px;">
                                        <thead>
                                            <tr><td colspan="5"><input type="checkbox" id="up">&nbsp;Market Price</td></tr>
                                        </thead>
                                    </table>
                                    <div class="panel-group" id="accordion" role="tablist"  aria-multiselectable="true">    
                                        <?php foreach ($ratescompleted as $entry => $services) { ?>
                                            <div class="panel panel-default" style=" height:340px;">
                                                <div class="panel-heading" role="tab" id="heading<?php echo $entry; ?>">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" onclick="collapse_general('collapse<?php echo $entry; ?>')" data-parent="#accordion" href="#collapse<?php echo $entry; ?>" aria-expanded="true" aria-controls="collapse<?php echo $entry; ?>">
                                                            <?php echo $entry; ?>
                                                        </a>
                                                    </h4>
                                                </div>
                                        <!--<table class="table table-bordered" style="font-size: 10px;">
                                            <thead>
                                                <tr><td colspan="5"><?php echo $entry; ?></td></tr>
                                                <tr>
                                                    <th style="width:05%"></th>
                                                    <th style="width:60%">ITEM</th>
                                                    <th style="width:15%">Cantidad</th>
                                                    <th style="width:20%">Precio</th>
                                                </tr>
                                            </thead>
                                        </table>  -->
                                                <div id="collapse<?php echo $entry; ?>" class="panel-collapse collapse"  role="tabpanel" style="  overflow-x: hidden; overflow-y: scroll; height: 200px !important; border: solid 0.1em #ddd ;" aria-labelledby="heading<?php echo $entry; ?>">
                                                    <div class="panel-body">
                                                        <table class="table table-bordered" style=" padding: 1px; font-size: 10px;">
                                                            <tr>
                                                                <th style="width:3%"></th>
                                                                <th style="width:50%">ITEM</th>
                                                                <th style="width:25%">Cant</th>
                                                                <th style="width:25%">Price</th>
                                                            </tr>
                                                            <tbody>
                                                                <?php
                                                                foreach ($services as $service => $qx) {
                                                                    foreach ($qx as $items => $row) {

                                                                        //<td style='text-align:center;padding:2px;'>" . $row[1] . "</td>
                                                                        //<td style='text-align:center;padding:2px;'>" . $row[1] . "</td>


                                                                        $rateid = substr($service, 0, 8);
                                                                        if ($row[1] > 0)
                                                                            echo "<tr   ><td><input type='checkbox' class='sel'  value='" . $rateid . "'></td><td style='padding:2px;'>" . $service . "</td><td style='text-align:center;padding:2px;'>" . $row[0] . "</td><td style='text-align:center;padding:2px;'>" . $row[1] . "</td></tr>";
                                                                        else
                                                                            echo "<tr  style='color:#FF0000;'><td><input type='checkbox'  class='sel' value='" . $rateid . "' disabled/></td><td style='padding:2px;'>" . $service . "</td><td style='text-align:center;padding:2px;'>" . $row[0] . "</td><td style='text-align:center;padding:2px;'>" . $row[1] . "</td></tr>";
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                            <?php } ?>
                                        </div> 
                                        <script >
                                            var collaps_gen = '';
                                            function collapse_general(x) {
                                                var elemento = x;
                                                    $("#" + x).css("height","250px", 'important');
                                                if (collaps_gen != '') {
                                                    $("#" + collaps_gen).collapse('hide');
                                                }
                                                //$(".panel-collapse").collapse('toggle');
                                                // $("#"+elemento).collapse('show');
                                                collaps_gen = elemento;
                                            }
                                        </script>
                                    </div>

                                </div>
                                <div class="modal-footer" style="position: relative; padding-top: 3px; padding-left: 5px; ">
                                    <a class="btn btn-primary" id="send_pdf_down"  onclick="send_pdf_down()" data-id="<?php echo $bundleid; ?>" >
                                        Descargar PDF
                                    </a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div>								
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="newitem" tabindex="-1" role="dialog" aria-labelledby="newitem" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agregar Nuevo Item</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="?r=portoprint/rate/additem/id/<?php echo Utils::encrypt($bundleid, 'rate'); ?>" id="<?php echo 'extend-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">
                    <fieldset>
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td colspan="2">
                                        <div>
                                            <strong>Cliente:</strong> <?php echo $customer; ?><br />
                                            <strong>Marca:</strong> <?php echo $brand; ?><br />
                                            <strong>Proyecto:</strong> <?php echo $project; ?>
                                        </div>
                                    </td></tr>
                                <tr><td><label for="Rate_serviceid">ITEM </label></td><td>
                                        <select id="Rate_serviceid" name="Rate[serviceid]" class="select2" style="width: 350px;" >
                                            <?php foreach ($servicelist as $group => $items) { ?>
                                                <optgroup label="<?php echo $group; ?>">
                                                    <?php foreach ($items as $id => $item) { ?>
                                                        <option value="<?php echo $id; ?>"><?php echo $item; ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                            <?php } ?>
                                        </select>
                                    </td></tr>
                                <tr><td>
                                        <label for="Rate_userid">Comprador </label>
                                    </td><td>
                                        <select id="Rate_userid" name="Rate[userid]" class="select2" style="width: 350px;" data-placeholder="Selecione"></select>
                                    </td></tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" type="submit">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="change_rateid" tabindex="-1" role="dialog" aria-labelledby="change_rateid" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 130%; height: 460px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cambiar Item por uno Anterior</h4>
            </div>
            <div class="modal-body no-padding" >
                <form method="post" action="" id="change_rateid_<?php echo $bundleid; ?>" novalidate="novalidate" class="smart-form">
                    <fieldset style="overflow-y: scroll; overflow-x: hidden; height: 450px;">
                        <table >
                            <tr>
                                <td style=" height: 150px;">
                                    <div >
                                        <table class="table table-bordered" style="width: 39%; position: absolute; top:0px; left: 10px;" >
                                            <thead>
                                                <tr><td >
                                                        <div>
                                                            <strong>Cliente:</strong> <?php echo $customer; ?><br />
                                                            <strong>Marca:</strong> <?php echo $brand; ?><br />
                                                            <strong>Proyecto:</strong> <?php echo $project; ?>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr><td>
                                                        <strong>ITEM </strong>
                                                    </td>

                                                </tr>
                                            </thead><tbody style=" overflow-y: ">     
                                                <?php
                                                $cadena_imp = " ";
                                                $list_items_proyect = Rate::model()->rate_pdf($bundleid);
                                                foreach ($list_items_proyect as $value) {
                                                    echo $lis_item_cad = "<tr><td>" . $value->rateid . " " . $value->servicedsc . " </td></tr>";
                                                    if ($cadena_imp == " ") {
                                                        $cadena_imp = $value->rateid;
                                                    } else {
                                                        $cadena_imp = $cadena_imp . ',' . $value->rateid;
                                                    }
                                                }
                                                echo "<tr><td><input type='hidden'value='{$cadena_imp}' id='ratedate_origin_chan' >"
                                                . "<input type='hidden'value='{$bundleid}' id='bundleid_origin_chan' >"
                                                . "</td></tr>";
                                                ?>




                                            </tbody>
                                        </table>
                                    </div>
                                </td><td rowspan="2">
                                    <table class="table table-bordered" id="rate_modif_rate" style="width: 60%;  position: absolute; top:0px; right: -10px;" >
                                        <thead>
                                            <tr><td colspan="6"><strong>Buscador por Fecha</strong></td></tr>
                                            <tr><td colspan="6">
                                                    <label class="input" > 
                                                        <i class="icon-append fa fa-calendar" title="Buscar" ></i>
                                                        <input type="text"  name="" id="change_rateid_datespe"  onchange="select_date_rate_mod(this.id)" size="40" >
                                                    </label>
                                                </td></tr>
                                            <tr><td colspan="6">
                                                    <strong>Lista de Items Disponibles</strong>
                                                </td></tr>
                                            <tr>
                                                <td></td>
                                                <td>Item</td>
                                                <td>#Cotizacion</td>
                                                <td>Proyecto</td>
                                                <td>Tipo</td>
                                                <td>Fecha Hora</td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 250px;"> 
                                    <table class="table table-bordered" id="rate_sel_dif_rate" style=" display:none; " >
                                        <thead>
                                            <tr><td colspan="2"><strong>Elija una fecha y hora</strong></td></tr>
                                            <tr><td colspan="2">
                                                    <label class="input" > 
                                                        <i class="icon-append fa fa-calendar"  ></i>
                                                        <input type="text"  name="" id="change_rateid_datemodif_i"  placeholder="Fecha-hora Creacion"  size="40" >
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr><td colspan="2">
                                                    <label class="input" > 
                                                        <i class="icon-append fa fa-calendar"  ></i>
                                                        <input type="text"  name="" id="change_rateid_datemodif_f"  placeholder="Fecha-hora Finalizacion"  size="40" >
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr> <td colspan="2 " style=" text-align: right;">
                                                    <div class="btn-group">
                                                        <a class="btn btn btn-success" id="botton_ratedate_save" onclick="chang_ratedate_save()" >&nbsp;<i class="glyphicon glyphicon-retweet"></i>&nbsp;&nbsp;Cambiar &nbsp;</a>

                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><p style=" font-size: 11px; "><i class="glyphicon glyphicon-warning-sign">&nbsp;&nbsp;Una vez realizado el cambio, la informacion sustituira al item seleccionado y el identificador principal se borrara </p></td>
                                            </tr>

                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <footer>

                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    @media (min-width: 992px){
        #resumens{float: right;
                  width: 280px;}
    }

</style>
