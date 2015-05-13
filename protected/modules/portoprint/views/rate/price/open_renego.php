<?php if ($model->ratetype == 'R') { ?>
    <style>
        .minorprice{
            color:#5BB75B;
        }

        .notcalculate{
            color:#A0A0A0;
            text-decoration: line-through;
        }
        table{
            font-size: 12px;
        }
        .jarviswidget-color-darken .nav-tabs li:not(.active) a, .jarviswidget-color-darken > header > .jarviswidget-ctrls a {
            color: #000000 !important;
        }
    </style>
    <script>
        var fileDropzone = new Dropzone("#sfdzone2_<?php echo $model->rateid ?>", {
            addRemoveLinks: false,
            maxFilesize: 200,
            dictResponseError: 'Error uploading file!',
            dictDefaultMessage: 'Arrastre sus archivos aqui (o de click)'
        }); //Inicializamos el dropzone

        fileDropzone.on('success', function(file, data) {

            var data = JSON.parse(data);
            $("#files_<?php echo $model->rateid ?> tbody").append('<tr><td>' + data.name + '</td><td><div class="btn-group btn-group-xs "><a class="btn btn-primary" id="send_fil_down" href="' + data.path + '"  ><i class="glyphicon glyphicon-download"></i>&nbsp;Descargar</a></div></td></tr>');
            fileDropzone.removeFile(file);
        });
    </script>
    <div class="jarviswidget jarviswidget-sortable" id="wid2-id-<?php echo $model->rateid ?>"  data-widget-colorbutton="true" data-widget-togglebutton="true" data-widget-editbutton="true" data-widget-deletebutton="true" data-widget-custombutton="true">
        <header>
            <?php $rtype = ($model->ratetype == 'R') ? '/' . $model->ratetype : ''; ?>
            <span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2><strong><?php echo $model->idVersion() . $rtype . "  " . $model->servicedsc ?></strong> </h2>				
            <div class="widget-toolbar">

                <div class="btn-group">
                    <button class="btn dropdown-toggle btn-warning" data-toggle="dropdown">
                        Acción <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <?php if ($model->complete == 0) { ?>
                            <li>
                                <a href="#newpricemanualModal<?php echo $model->rateid ?>" data-target="#newpricemanualModal<?php echo $model->rateid ?>"  data-toggle="modal">Precio Manual</a>
                            </li>
                            <li>
                                <a href="#extendrate<?php echo $model->rateid ?>" data-target="#extendrate<?php echo $model->rateid ?>"  data-toggle="modal">Extender Evento</a>
                            </li>

                            <li>
                                <a href="#addpdf<?php echo $model->rateid ?>" data-target="#addpdf<?php echo $model->rateid ?>"  data-toggle="modal">Agregar al resumen</a>
                            </li>
                            <li>
                                <a  href="#ToDos_<?php echo $model->rateid ?>" data-target="#ToDos_<?php echo $model->rateid ?>" name="<?php echo $model->rateid ?>" data-toggle="modal" onclick="fechadores_todos(this.name)" >ToDo</a>
                            </li>


                        <?php } else { ?>
                            <li>
                                <a href="#delpdf<?php echo $model->rateid ?>" data-target="#delpdf<?php echo $model->rateid ?>"  data-toggle="modal">Remover del resumen</a>
                            </li>
                            <li class="divider"></li>

                            <?php if ($model->odptime == null) { ?>
                                <li>
                                    <a href="#ODPModal_<?php echo $model->rateid ?>" data-target="#ODPModal_<?php echo $model->rateid ?>"  data-toggle="modal">Generar ODP</a>
                                </li>
                            <?php } if ($model->odctime == null) { ?>
                                <li>
                                    <a href="#ODCModal_<?php echo $model->rateid ?>" data-target="#ODCModal_<?php echo $model->rateid ?>"  data-toggle="modal">Generar ODC</a>
                                </li>
                            <?php } ?>
                            <li>

                                <a  href="#ToDos_<?php echo $model->rateid ?>" data-target="#ToDos_<?php echo $model->rateid ?>" name="<?php echo $model->rateid ?>" onclick="fechadores_todos(this.name)"  data-toggle="modal" >ToDo</a>

                            </li>
                            <!-- <li>
                                 <a href="#freerate<?php echo $model->rateid ?>" data-target="#freerate<?php echo $model->rateid ?>"  data-toggle="modal">Liberar</a>
                             </li>  -->
                        <?php } ?>

                    </ul>
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


                <div class="well-small">
                    <table style="width:100%;">
                        <thead>
                            <tr>
                                <td style="width:50%">
                                    <strong>Items:</strong> <?php echo RateController::getDetail($model->rateid, $model->servicedsc, $model->note, $model->idVersion()) ?><br>
                                    <strong>Comprador:</strong> <?php echo $model->firstname ?><br>
                                    <strong>Creación:</strong> <?php
                                    $datet = '';
                                    echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'full', 'full');
                                    $datet = Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'short', 'short');
                                    ?><br>										

                                    <?php
                                    $date2 = "";
                                    if ($model->statusid == 2 || $model->statusid == 4) {
                                        ?>
                                        <strong>Finaliza:</strong> <?php
                                        echo Yii::app()->dateFormatter->formatDateTime($model->finalize, 'full', 'full');
                                        $date2 = Yii::app()->dateFormatter->formatDateTime($model->finalize, 'short', 'short');
                                        ?>
                                    <?php } else { ?>
                                        <strong>Finalizó:</strong> <?php
                                        echo Yii::app()->dateFormatter->formatDateTime($model->statustime, 'full', 'full');
                                        $date2 = Yii::app()->dateFormatter->formatDateTime($model->statustime, 'short', 'short');
                                        ?>

                                    <?php } ?>
                                    <br>
                                </td>
                                <td>
                                    <strong>Estatus:</strong> <?php
                                    echo $model->statusdsc;
                                    $statusos = HistProduction::model()->gethistprod_1($model->rateid);
                                    $statusodps = StatusProduction::model()->findByAttributes(array('status_productionid' => $statusos));
                                    if ($statusodps->status_productionporcent == 'C') {
                                        echo ' - ' . $statusodps->status_productiondsc;
                                    }
                                    ?><br>
                                    <strong>Probabilidad:</strong> <a href="#" id="probable_<?php echo $model->rateid ?>" data-type="select" data-pk="1" data-value="<?php echo $model->probability ?>" data-original-title="Probabilidad"></a><br>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div style="margin-top:10px;">
                    <ul id="myTab2_<?php echo $model->rateid ?>" class="nav nav-tabs">
                        <li class="active">
                            <a href="#s1_2_<?php echo $model->rateid ?>" data-toggle="tab">Calculadora de precios</a>
                        </li>
                        <!--<li>
                            <a href="#s2_<?php echo $model->rateid ?>" data-toggle="tab">Arte</a>
                        </li>
                        <li>
                            <a href="#s3_<?php echo $model->rateid ?>" data-toggle="tab">Prueba de color</a>
                        </li>
                        <li>
                            <a href="#s4_<?php echo $model->rateid ?>" data-toggle="tab">Producción</a>
                        </li>
                        <li>
                            <a href="#s5_<?php echo $model->rateid ?>" data-toggle="tab">Prueba Cero</a>
                        </li>-->

                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">Extra<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#s7_2_<?php echo $model->rateid ?>" onclick="recharlist_file_<?php echo $model->rateid ?>()" data-toggle="tab">Archivos</a>
                                </li>
                                <li>
                                    <a href="#s8_2_<?php echo $model->rateid ?>" data-toggle="tab">TimeLine</a>
                                </li>
                                <li>
                                    <a href="#s9_2_<?php echo $model->rateid ?>" data-toggle="tab">Tracker</a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                    <div id="myTabContent2_<?php echo $model->rateid ?>" class="tab-content">
                        <div class="tab-pane fade in active" id="s1_2_<?php echo $model->rateid ?>">

                            <form method="post" action="?r=portoprint/rate/saveprice/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>" id="<?php echo 'rateprice-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
                                <table id="ratecalculatetable2_<?php echo $model->rateid ?>" title="<?php echo $model->rateid ?>" class="table table-condensed">
                                    <thead>
                                        <tr>

                                            <th width="60">Mostrar</th>

                                            <th>Proveedor</th>

                                            <th width="80" style="text-align:center" <?php if ($model->quantity_1 > 0) { ?>class="th_editable"<?php } ?> ><a class="eqnt" href="#setquantityModal<?php echo $model->rateid ?>" data-target="#setquantityModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>" data-rateid = "<?php echo $model->rateid ?>"  data-toggle="modal"><?php echo $model->quantity_1; ?></a></th>
                                            <th width="80" style="text-align:center" <?php if ($model->quantity_2 > 0) { ?>class="th_editable"<?php } ?> ><a class="eqnt" href="#setquantityModal<?php echo $model->rateid ?>" data-target="#setquantityModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>" data-rateid = "<?php echo $model->rateid ?>" data-toggle="modal"><?php echo $model->quantity_2; ?></a></th>
                                            <th width="80" style="text-align:center" <?php if ($model->quantity_3 > 0) { ?>class="th_editable"<?php } ?> ><a class="eqnt" href="#setquantityModal<?php echo $model->rateid ?>" data-target="#setquantityModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>" data-rateid = "<?php echo $model->rateid ?>" data-toggle="modal"><?php echo $model->quantity_3; ?></a></th>
                                            <th width="80" style="text-align:center" <?php if ($model->quantity_4 > 0) { ?>class="th_editable"<?php } ?> ><a class="eqnt" href="#setquantityModal<?php echo $model->rateid ?>" data-target="#setquantityModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>" data-rateid = "<?php echo $model->rateid ?>" data-toggle="modal"><?php echo $model->quantity_4; ?></a></th>
                                            <th width="80" style="text-align:center" <?php if ($model->quantity_5 > 0) { ?>class="th_editable"<?php } ?> ><a class="eqnt" href="#setquantityModal<?php echo $model->rateid ?>" data-target="#setquantityModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>" data-rateid = "<?php echo $model->rateid ?>" data-toggle="modal"><?php echo $model->quantity_5; ?></a></th>
                                            <th width="80" style="text-align:center" <?php if ($model->quantity_6 > 0) { ?>class="th_editable"<?php } ?> ><a class="eqnt" href="#setquantityModal<?php echo $model->rateid ?>" data-target="#setquantityModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>" data-rateid = "<?php echo $model->rateid ?>" data-toggle="modal"><?php echo $model->quantity_6; ?></a></th>
                                            <th width="30" style="text-align:center">%</th>
                                            <th width="80" style="text-align:center">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected2_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_1; ?>" <?php echo $model->quantityselected($model->quantity_1); ?> />
                                            <span><br /><?php echo $model->quantity_1; ?></span> 
                                        </label>
                                    </div>												
                                    </th>
                                    <th width="80" style="text-align:center">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected2_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_2; ?>" <?php echo $model->quantityselected($model->quantity_2); ?> />
                                            <span><br /><?php echo $model->quantity_2; ?></span> 
                                        </label>
                                    </div>		
                                    </th>											
                                    <th width="80" style="text-align:center">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected2_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_3; ?>" <?php echo $model->quantityselected($model->quantity_3); ?> />
                                            <span><br /><?php echo $model->quantity_3; ?></span> 
                                        </label>
                                    </div>	
                                    </th>
                                    <th width="80" style="text-align:center">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected2_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_4; ?>" <?php echo $model->quantityselected($model->quantity_4); ?> />
                                            <span><br /><?php echo $model->quantity_4; ?></span> 
                                        </label>
                                    </div>	
                                    </th>
                                    <th width="80" style="text-align:center">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected2_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_5; ?>" <?php echo $model->quantityselected($model->quantity_5); ?> />
                                            <span><br /><?php echo $model->quantity_5; ?></span> 
                                        </label>
                                    </div>	
                                    </th>
                                    <th width="80" style="text-align:center">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected2_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_6; ?>" <?php echo $model->quantityselected($model->quantity_6); ?> />
                                            <span><br /><?php echo $model->quantity_6; ?></span> 
                                        </label>
                                    </div>	
                                    </th>

                                    <th width="60" style="text-align:center">Seleccionar</th>

                                    </tr>
                                    </thead>
                                    <tbody>		
                                        <?php foreach ($ratesuppliers as $supplier) { ?>
                                            <tr id="trowid2_<?php echo $supplier->ratesupplierid; ?>">						

                                                <td   style="text-align:center" ><label class="toggle">
                                                        <input class="selectsupplier" type="checkbox" <?php echo $supplier->checked(); ?> title="<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->ratesupplierid; ?>" name="show[<?php echo $supplier->ratesupplierid; ?>]"  id="show2_<?php echo $supplier->ratesupplierid; ?>" /><i data-swchon-text="SI" data-swchoff-text="No"></i></label></td>	
                                                <td id="ssd2_<?php echo $supplier->ratesupplierid; ?>"><?php echo $supplier->supplierdsc; ?></td>
                                                <td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="Quantity_1_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_1; ?>" /><a class="eqnt" href="#setpriceModal<?php echo $model->rateid ?>" data-target="#setpriceModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>"  data-toggle="modal"><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_1, "1") ?></a></td>
                                                <td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="Quantity_2_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_2; ?>" /><a class="eqnt" href="#setpriceModal<?php echo $model->rateid ?>" data-target="#setpriceModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>"  data-toggle="modal"><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_2, "2") ?></a></td>
                                                <td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="Quantity_3_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_3; ?>" /><a class="eqnt" href="#setpriceModal<?php echo $model->rateid ?>" data-target="#setpriceModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>"  data-toggle="modal"><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_3, "3") ?></a></td>
                                                <td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="Quantity_4_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_4; ?>" /><a class="eqnt" href="#setpriceModal<?php echo $model->rateid ?>" data-target="#setpriceModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>"  data-toggle="modal"><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_4, "4") ?></a></td>
                                                <td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="Quantity_5_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_5; ?>" /><a class="eqnt" href="#setpriceModal<?php echo $model->rateid ?>" data-target="#setpriceModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>"  data-toggle="modal"><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_5, "5") ?></a></td>
                                                <td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="Quantity_6_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_6; ?>" /><a class="eqnt" href="#setpriceModal<?php echo $model->rateid ?>" data-target="#setpriceModal<?php echo $model->rateid ?>" data-ratesupplierid="<?php echo $supplier->ratesupplierid; ?>"  data-toggle="modal"><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_6, "6") ?></a></td>
                                                <td style="text-align:right" ><input value="<?php echo $supplier->percent; ?>" size="3" class="percentcalc" type="text" title="<?php echo $supplier->ratesupplierid; ?>" name="percent[<?php echo $supplier->ratesupplierid; ?>]"  id="Percent_<?php echo $supplier->ratesupplierid; ?>" style="width:40px;"/></td>

                                                <td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="Calculate_1_<?php echo $supplier->ratesupplierid; ?>"><span id="C_1_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
                                                <td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="Calculate_2_<?php echo $supplier->ratesupplierid; ?>"><span id="C_2_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
                                                <td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="Calculate_3_<?php echo $supplier->ratesupplierid; ?>"><span id="C_3_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
                                                <td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="Calculate_4_<?php echo $supplier->ratesupplierid; ?>"><span id="C_4_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
                                                <td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="Calculate_5_<?php echo $supplier->ratesupplierid; ?>"><span id="C_5_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
                                                <td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="Calculate_6_<?php echo $supplier->ratesupplierid; ?>"><span id="C_6_<?php echo $supplier->ratesupplierid; ?>">-</span></td>

                                                <td style="text-align:center" >

                                                    <label class="radio">
                                                        <input type="radio" name="selectedsupplier"  id="Select_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->ratesupplierid; ?>" <?php echo $supplier->selected(); ?> />
                                                        <i></i></label>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                        <?php if ($model->complete == 0) { ?>
                                            <tr>

                                                <td colspan="8">&nbsp;</td>
                                                <td>

                                                    <button  type="submit" class="btn btn-success btn-xs" >Guardar</button>

                                                </td>
                                                <td colspan="8">&nbsp;</td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="17" >&nbsp;
                                                <input type="hidden" name="ppp[1]" id="Ppp_1_<?php echo $model->rateid ?>" />
                                                <input type="hidden" name="ppp[2]" id="Ppp_2_<?php echo $model->rateid ?>" />
                                                <input type="hidden" name="ppp[3]" id="Ppp_3_<?php echo $model->rateid ?>" />
                                                <input type="hidden" name="ppp[4]" id="Ppp_4_<?php echo $model->rateid ?>" />
                                                <input type="hidden" name="ppp[5]" id="Ppp_5_<?php echo $model->rateid ?>" />
                                                <input type="hidden" name="ppp[6]" id="Ppp_6_<?php echo $model->rateid ?>" />
                                            </td>
                                        </tr>
                                        <tr>

                                            <td width="60">&nbsp;</td>
                                            <td style=" border-top: 1px black solid;">Promedio General </td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pg_1" ></td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pg_2" ></td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pg_3" ></td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pg_4" ></td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pg_5" ></td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pg_6" ></td>

                                            <td >&nbsp;</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpg_1" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpg_2" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpg_3" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpg_4" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpg_5" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpg_6" >0</td>
                                            <td style="text-align:right; " width="60">&nbsp;</td>
                                        </tr>
                                        <tr>

                                            <td width="60">&nbsp;</td>
                                            <td style=" border-top: 1px black solid;">Precio Portoprint $</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pp_1" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pp_2" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pp_3" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pp_4" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pp_5" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Pp_6" >0</td>

                                            <td >&nbsp;</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpp_1" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpp_2" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpp_3" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpp_4" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpp_5" >0</td>
                                            <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_Cpp_6" >0</td>
                                            <td style="text-align:right;" width="60">&nbsp;</td>
                                        </tr>



                                        <tr >

                                            <td width="60">&nbsp;</td>
                                            <td>Ahorro $</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Save_1" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Save_2" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Save_3" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Save_4" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Save_5" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Save_6" >0</td>
                                            <td >&nbsp;</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Csave_1" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Csave_2" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Csave_3" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Csave_4" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Csave_5" >0</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Csave_6" >0</td>
                                            <td style="text-align:right" width="60">&nbsp;</td>
                                        </tr>
                                        <tr>

                                            <?php
                                            $ahorroextra = Ratesupplier::model()->getdata($model->rateid);
                                            $customerid = Rate::model()->getcustomerid($model->rateid);
                                            //obtener porcentaje
                                            switch ($customerid) {
                                                case 12:
                                                    $xt = 0.93;
                                                    break;
                                                case 45:
                                                    $xt = 0.90;
                                                    break;
                                                default:
                                                    $xt = 1;
                                            }
                                            //obtener promedio
                                            $sum_1 = $sum_2 = $sum_3 = $sum_4 = $sum_5 = $sum_6 = 0;
                                            $zum_1 = $zum_2 = $zum_3 = $zum_4 = $zum_5 = $zum_6 = 0;

                                            foreach ($ahorroextra as $value) {
                                                $sum_1 += $value->quantity_1;
                                                $sum_2 += $value->quantity_2;
                                                $sum_3 += $value->quantity_3;
                                                $sum_4 += $value->quantity_4;
                                                $sum_5 += $value->quantity_5;
                                                $sum_6 += $value->quantity_6;

                                                $zum_1 += $value->Q1;
                                                $zum_2 += $value->Q2;
                                                $zum_3 += $value->Q3;
                                                $zum_4 += $value->Q4;
                                                $zum_5 += $value->Q5;
                                                $zum_6 += $value->Q6;
                                            }

                                            $pro_1 = $sum_1 / (count($ahorroextra));
                                            $pro_2 = $sum_2 / (count($ahorroextra));
                                            $pro_3 = $sum_3 / (count($ahorroextra));
                                            $pro_4 = $sum_4 / (count($ahorroextra));
                                            $pro_5 = $sum_5 / (count($ahorroextra));
                                            $pro_6 = $sum_6 / (count($ahorroextra));

                                            $pr_1 = $zum_1 / (count($ahorroextra));
                                            $pr_2 = $zum_2 / (count($ahorroextra));
                                            $pr_3 = $zum_3 / (count($ahorroextra));
                                            $pr_4 = $zum_4 / (count($ahorroextra));
                                            $pr_5 = $zum_5 / (count($ahorroextra));
                                            $pr_6 = $zum_6 / (count($ahorroextra));
                                            ?>
                                        <tr >

                                            <td width="60">&nbsp;</td>
                                            <td>Ahorro Extra $</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Xsave_1" ><?php echo number_format($pro_1 - ($pro_1 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Xsave_2" ><?php echo number_format($pro_2 - ($pro_2 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Xsave_3" ><?php echo number_format($pro_3 - ($pro_3 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Xsave_4" ><?php echo number_format($pro_4 - ($pro_4 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Xsave_5" ><?php echo number_format($pro_5 - ($pro_5 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Xsave_6" ><?php echo number_format($pro_6 - ($pro_6 * $xt), 2, '.', '') ?></td>
                                            <td >&nbsp;</td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Cxsave_1" ><?php echo number_format($pr_1 - ($pr_1 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Cxsave_2" ><?php echo number_format($pr_2 - ($pr_2 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Cxsave_3" ><?php echo number_format($pr_3 - ($pr_3 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Cxsave_4" ><?php echo number_format($pr_4 - ($pr_4 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Cxsave_5" ><?php echo number_format($pr_5 - ($pr_5 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" id="<?php echo $model->rateid ?>_Cxsave_6" ><?php echo number_format($pr_6 - ($pr_6 * $xt), 2, '.', '') ?></td>
                                            <td style="text-align:right" width="60">&nbsp;</td>
                                        </tr>


                                        <tr ><td colspan="17">&nbsp;</td></tr>		
                                    </tbody>	
                                </table>
                            </form>	

                        </div>


                        <div class="tab-pane fade" id="s7_2_<?php echo $model->rateid ?>">
                            <form  class="smart-form" >
                                <header><strong>Archivos</strong></header>
                                <fieldset>


                                    <table id="Files_<?php echo $model->rateid ?>" class="table table-bordered" style="font-size: 10px;" >
                                        <thead>
                                            <tr>
                                                <th style="width:30%">Nombre</th>

                                                <th style="width:50%">Url</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>   </fieldset>
                            </form>										
                            <form action="index.php?r=portoprint/upload/savefile/id/<?php echo Utils::encrypt($model->bundleid, 'document'); ?>/rate/<?php echo Utils::encrypt($model->rateid, 'document'); ?>" class="dropzone smart-form" id="sfdzone2_<?php echo $model->rateid ?>" style="border-color:#FF0000;"></form>

                        </div>
                        <div class="tab-pane fade" id="s8_2_<?php echo $model->rateid ?>">
                            <form class="smart-form">
                                <header><strong>Time Line</strong></header>
                                <fieldset>
                                    <div id="ratetimelines_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;">
                                        <div class='movs' style='border:1px solid #2c699d; background-color: #3276b1; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; position: absolute; bottom:7px; z-index: 1; left:17px; height: 33px; width: 132px;'>
                                            <table style="position: relative; left:5px;"><tr>
                                                    <td><button type="button" class="btn btn-default btn-xs" id="moveLeft_<?php echo $model->rateid ?>" value="Move left"><span class="glyphicon glyphicon-chevron-left"></span></button></td>
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td><button type="button" class="btn btn-default btn-xs" id="zoomIn_<?php echo $model->rateid ?>" value="Zoom in"><span class="glyphicon glyphicon-zoom-in"></span></button></td>
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td><button type="button" class="btn btn-default btn-xs" id="zoomOut_<?php echo $model->rateid ?>" value="Zoom out"><span class="glyphicon glyphicon-zoom-out"></span></button></td>
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td><button type="button" class="btn btn-default btn-xs" id="moveRight_<?php echo $model->rateid ?>" value="Move right"><span class="glyphicon glyphicon-chevron-right"></span></button></td>
                                                <tr></table>
                                        </div>
                                    </div>

                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="s9_2_<?php echo $model->rateid ?>">
                            <?php
                            $activdad = Ratetracker::model()->activitybyrate($model->rateid, "");
                            ?>
                            <form class="smart-form">
                                <header><strong>Tracker</strong></header>
                                <fieldset>
                                    <div id="tracker_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;">
                                        <table id="tracker_table_<?php echo $model->rateid ?>" class="items table table-condensed" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th colspan="4"> 
                                                        <a data-rate ="<?php echo $model->rateid ?>" class="pdf_activity_<?php echo $model->rateid ?> btn btn-primary" style="padding: 6px 12px; float: right;">
                                                            Descargar PDF
                                                        </a>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="checkbox" class="check_key_<?php echo $model->rateid ?>" checked></th>
                                                    <th>Fecha</th>
                                                    <th>Actividad</th>
                                                    <th>Responsable</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($activdad as $row) {
                                                    echo '<tr>
                                                <td><input type="checkbox" class="ratetracker_' . $model->rateid . '" data-tracker="' . $row->ratetrackerid . '" checked></td>    
                                                <td>' . $row->statusdate . '</td>
                                                <td>' . $row->statusdsc . '</td>
                                                <td>' . $row->responsable . '</td>
                                                </tr>';
                                                    if ($row->statusid == 100) {
                                                        $activity = Ratesupplier::model()->activitybyrate($model->rateid, "");
                                                        foreach ($activity as $row) {
                                                            echo '<tr>
                                                            <td><input type="checkbox" class="ratesupplier_' . $model->rateid . '" data-tracker="' . $row->ratesupplierid . '" checked></td>
                                                            <td>' . $row->statustime . '</td>
                                                            <td>' . $row->statusdsc . '</td>
                                                            <td>' . $row->corporatename . '</td>
                                                            </tr>';
                                                        }
                                                    }
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>

                                </fieldset>
                            </form>
                            <script>
                                $('.th_editable').hover(function() {
                                    if ($(this).find('span.glyphicon').length > 0 || $(this).find('input').length > 0) {
                                        return false
                                    } else {

                                        $(this).html('<span class="glyphicon glyphicon-pencil" style="float:left;">&nbsp;</span>' + $(this).html());

                                    }
                                }, function() {
                                    $(this).find('span.glyphicon').remove();
                                });
                                $(".eqnt").click(function() {
                                    console.log($(this).data('ratesupplierid'));
                                    var ratesupplierid = $(this).data('ratesupplierid');
                                    $("#ratesupplierid").val(ratesupplierid);
                                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/datareneg') ?>', {ratesupplierid: ratesupplierid}, function(response) {
                                        console.log(response);
                                        var data = response.split("|");
                                        $('#NT_RatesupplierQuantity1M_pric').val(data[0]);
                                        $('#NT_RatesupplierDaysproduction1M_enu').val(data[1]);

                                        $('#NT_RatesupplierQuantity2M_pric').val(data[2]);
                                        $('#NT_RatesupplierDaysproduction2M_enu').val(data[3]);

                                        $('#NT_RatesupplierQuantity3M_pric').val(data[4]);
                                        $('#NT_RatesupplierDaysproduction3M_enu').val(data[5]);

                                        $('#NT_RatesupplierQuantity4M_pric').val(data[6]);
                                        $('#NT_RatesupplierDaysproduction4M_enu').val(data[7]);

                                        $('#NT_RatesupplierQuantity5M_pric').val(data[8]);
                                        $('#NT_RatesupplierDaysproduction5M_enu').val(data[9]);

                                        $('#NT_RatesupplierQuantity6M_pric').val(data[10]);
                                        $('#NT_RatesupplierDaysproduction6M_enu').val(data[11]);

                                        $("#supplierdsc").html(data[12]);
                                    });



                                });
                                $('.pdf_activity_<?php echo $model->rateid ?>').click(function() {
                                    var rateid = $(this).data('rate');
                                    var tracker = "";
                                    var ratesupplier = "";
                                    $(".ratetracker_<?php echo $model->rateid ?>").each(function() {
                                        if ($(this).is(':checked')) {
                                            tracker += (tracker === "") ? $(this).data('tracker') : ',' + $(this).data('tracker');
                                        }
                                    });
                                    $(".ratesupplier_<?php echo $model->rateid ?>").each(function() {
                                        if ($(this).is(':checked')) {
                                            ratesupplier += (ratesupplier === "") ? $(this).data('tracker') : ',' + $(this).data('tracker');
                                        }
                                    });
                                    //console.log(rateid+','+tracker+','+ratesupplier);
                                    location.href = "?r=portoprint/pdf/activityrate/rateid/" + rateid + "/tracker/" + tracker + "/ratesupplier/" + ratesupplier;
                                });
                                $('.ratetracker_<?php echo $model->rateid ?>,.ratesupplier_<?php echo $model->rateid ?>').click(function() {
                                    var n = $('.ratetracker_<?php echo $model->rateid ?>,.ratesupplier_<?php echo $model->rateid ?>').filter(":checked").length;
                                    var x = $('.ratetracker_<?php echo $model->rateid ?>,.ratesupplier_<?php echo $model->rateid ?>').length;
                                    if (x == n) {
                                        $('.check_key_<?php echo $model->rateid ?>').prop('checked', true);
                                    }
                                    else {
                                        $('.check_key_<?php echo $model->rateid ?>').prop('checked', false);
                                    }
                                    console.log(n + ',' + x);
                                });
                                $('.check_key_<?php echo $model->rateid ?>').click(function() {
                                    var ch = ($(this).is(':checked')) ? 1 : 0;

                                    $('.ratetracker_<?php echo $model->rateid ?>,.ratesupplier_<?php echo $model->rateid ?>').each(function() {
                                        if (ch == 1) {
                                            $(this).prop('checked', true);
                                        }
                                        else {
                                            $(this).prop('checked', false);
                                        }
                                    });
                                });
                                var table_<?php echo $model->rateid ?> = $('#tracker_table_<?php echo $model->rateid ?>').DataTable({
                                    "order": [[1, "asc"]],
                                    "destroy": true,
                                    "displayLength": 25,
                                    "bLengthChange": false,
                                    "bFilter": false,
                                    "bSort": true,
                                    "info": false,
                                    "dom": '<"#newssp"<><l><f>>tip',
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
                                    }
                                });
                            </script>
                        </div>
                    </div>

                </div>	

            </div>
        </div>
    </div>	

    <div class="modal fade" id="setquantityModal<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="setquantityModal<?php echo $model->rateid; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="newpricemanualModal<?php echo $model->rateid; ?>">Editar cantidad</h4>
                </div>
                <div class="modal-body no-padding">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'quantity' . $model->rateid . '-form',
                        'action' => '?r=portoprint/rate/setquantity/id/' . Utils::encrypt($model->rateid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'),
                        'enableAjaxValidation' => false,
                        'method' => 'POST',
                        'htmlOptions' => array("class" => "smart-form", "novalidate" => "novalidate")
                    ));
                    ?>
                    <fieldset>

                        <table id="quantity_table" class="table table-striped " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Cantidad</th>


                                </tr>
                            </thead>			
                            <tbody>
                                <?php if ($model->quantity_1) { ?>
                                    <tr>
                                        <td>1</td>
                                        <td id="NT_quantity1td">
                                            <input type="text" class="price" id="NT_quantity1_enu" name="Rate[quantity_1]" value="<?php echo $model->quantity_1; ?>"></td>
                                    </tr>
                                <?php } if ($model->quantity_2) { ?>
                                    <tr>
                                        <td>2</td>
                                        <td id="NT_quantity2td">
                                            <input type="text" class="price" id="NT_quantity2_enu" name="Rate[quantity_2]" value="<?php echo $model->quantity_2; ?>"></td>
                                    </tr>
                                <?php } if ($model->quantity_3) { ?>
                                    <tr>
                                        <td>3</td>
                                        <td id="NT_quantity3td">
                                            <input type="text" class="price" id="NT_quantity3_enu" name="Rate[quantity_3]" value="<?php echo $model->quantity_3; ?>"></td>
                                    </tr>
                                <?php } if ($model->quantity_4) { ?>
                                    <tr>
                                        <td>4</td>
                                        <td id="NT_quantity4td">
                                            <input type="text" class="price" id="NT_quantity4_enu" name="Rate[quantity_4]" value="<?php echo $model->quantity_4; ?>"></td>
                                    </tr>
                                <?php } if ($model->quantity_5) { ?>
                                    <tr>
                                        <td>5</td>
                                        <td id="NT_quantity5td">
                                            <input type="text" class="price" id="NT_quantity5_enu" name="Rate[quantity_5]" value="<?php echo $model->quantity_5; ?>"></td>
                                    </tr>
                                <?php } if ($model->quantity_6) { ?>
                                    <tr>
                                        <td>6</td>
                                        <td id="NT_quantity6td">
                                            <input type="text" class="price" id="NT_quantity6_enu" name="Rate[quantity_6]" value="<?php echo $model->quantity_6; ?>"></td>
                                    </tr>
                                <?php } ?>
                            </tbody></table>
                    </fieldset>
                    <footer>
                        <a class="btn btn-primary" type="submit" id="send_quantity">
                            Aceptar
                        </a>
                        <button data-dismiss="modal" class="btn btn-default" type="button">
                            Cancelar
                        </button>

                    </footer>
                    <?php $this->endWidget(); ?>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="setpriceModal<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="setpriceModal<?php echo $model->rateid; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="newpricemanualModal<?php echo $model->rateid; ?>">Editar precio <span id="supplierdsc"></span></h4>
                </div>
                <div class="modal-body no-padding">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'price' . $model->rateid . '-form',
                        'action' => '?r=portoprint/rate/setprice/id/' . Utils::encrypt($model->rateid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'),
                        'enableAjaxValidation' => false,
                        'method' => 'POST',
                        'htmlOptions' => array("class" => "smart-form", "novalidate" => "novalidate")
                    ));
                    ?>
                    <fieldset>

                        <table id="ratelist_table" class="table table-striped " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Dias de Produccion</th>

                                </tr>
                            </thead>			
                            <tbody>
                                <?php if ($model->quantity_1) { ?>
                                    <tr>
                                        <td><?php echo $model->quantity_1; ?></td>
                                        <td id="NT_RatesupplierQuantity1Mtd">
                                            <input type="hidden" id="ratesupplierid" name="ratesupplierid">
                                            <input type="text" class="price" id="NT_RatesupplierQuantity1M_pric" name="Ratesupplier[quantity_1]" value="<?php //echo $model->ppp_1;    ?>"></td>
                                        <td id="NT_RatesupplierDaysproduction1td"><input type="text" class="price" id="NT_RatesupplierDaysproduction1M_enu" name="Ratesupplier[daysproduction1]" value="<?php //echo $model->daysproduction1;    ?>"></td>

                                    </tr>

                                <?php } if ($model->quantity_2) { ?>
                                    <tr>
                                        <td><?php echo $model->quantity_2; ?></td>
                                        <td id="NT_RatesupplierQuantity2Mtd"><input type="text" class="price" id="NT_RatesupplierQuantity2M_pric" name="Ratesupplier[quantity_2]" value="<?php //echo $model->ppp_2;    ?>"></td>
                                        <td id="NT_RatesupplierDaysproduction2td"><input type="text" class="price" id="NT_RatesupplierDaysproduction2M_enu" name="Ratesupplier[daysproduction2]" value="<?php //echo $model->daysproduction2;    ?>"></td>

                                    </tr>

                                <?php } if ($model->quantity_3) { ?>
                                    <tr>
                                        <td><?php echo $model->quantity_3; ?></td>
                                        <td id="NT_RatesupplierQuantity3Mtd"><input type="text" class="price" id="NT_RatesupplierQuantity3M_pric" name="Ratesupplier[quantity_3]" value="<?php //echo $model->ppp_3;    ?>"></td>
                                        <td id="NT_RatesupplierDaysproduction3td"><input type="text" class="price" id="NT_RatesupplierDaysproduction3M_enu" name="Ratesupplier[daysproduction3]" value="<?php //echo $model->daysproduction3;    ?>"></td>

                                    </tr>

                                <?php } if ($model->quantity_4) { ?>
                                    <tr>
                                        <td><?php echo $model->quantity_4; ?></td>
                                        <td id="NT_RatesupplierQuantity4Mtd"><input type="text" class="price" id="NT_RatesupplierQuantity4M_pric" name="Ratesupplier[quantity_4]" value="<?php //echo $model->ppp_4;    ?>"></td>
                                        <td id="NT_RatesupplierDaysproduction4td"><input type="text" class="price" id="NT_RatesupplierDaysproduction4M_enu" name="Ratesupplier[daysproduction4]" value="<?php //echo $model->daysproduction4;    ?>"></td>

                                    </tr>

                                <?php } if ($model->quantity_5) { ?>
                                    <tr>
                                        <td><?php echo $model->quantity_5; ?></td>
                                        <td id="NT_RatesupplierQuantity5Mtd"><input type="text" class="price" id="NT_RatesupplierQuantity5M_pric" name="Ratesupplier[quantity_5]" value="<?php //echo $model->ppp_5;    ?>"></td>
                                        <td id="NT_RatesupplierDaysproduction5td"><input type="text" class="price" id="NT_RatesupplierDaysproduction5M_enu" name="Ratesupplier[daysproduction5]" value="<?php //echo $model->daysproduction5;    ?>"></td>

                                    </tr>

                                <?php } if ($model->quantity_6) { ?>
                                    <tr>
                                        <td><?php echo $model->quantity_6; ?></td>
                                        <td id="NT_RatesupplierQuantity6Mtd"><input type="text" class="price" id="NT_RatesupplierQuantity6M_pric" name="Ratesupplier[quantity_6]" value="<?php //echo $model->ppp_6;    ?>"></td>
                                        <td id="NT_RatesupplierDaysproduction6td"><input type="text" class="price" id="NT_RatesupplierDaysproduction6M_enu" name="Ratesupplier[daysproduction6]" value="<?php //echo $model->daysproduction6;    ?>"></td>

                                    </tr>

                                <?php } ?>
                            </tbody></table>


                    </fieldset>
                    <footer>
                        <a class="btn btn-primary" type="submit" id="send_price">
                            Aceptar
                        </a>
                        <button data-dismiss="modal" class="btn btn-default" type="button">
                            Cancelar
                        </button>

                    </footer>
                    <?php $this->endWidget(); ?>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $("#send_quantity").click(function() {
            var bandera = 0;
            $("table#quantity_table :input[type=text]").each(function() {
                var elemento = this;
                bandera += valid_expresion_form(elemento.id);
            });
            if (bandera === 0) {
                $("#quantity<?php echo $model->rateid; ?>-form").submit();
            }
        });
        $("#send_price").click(function() {
            var bandera = 0;
            $(".price").each(function() {
                var elemento = this;

                bandera += valid_expresion_form(elemento.id);
            });
            if (bandera === 0) {
                $("#price<?php echo $model->rateid; ?>-form").submit();

            }
        });
    </script>    
<?php
} 