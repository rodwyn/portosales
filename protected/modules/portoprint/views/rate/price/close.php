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
    .jarviswidget-color-greenDark .nav-tabs li:not(.active) a, .jarviswidget-color-greenDark > header > .jarviswidget-ctrls a {
        color: #000000 !important;
    }
    .rating_table td {text-align: center;}
</style>
<script>
    var fileDropzone = new Dropzone("#sdzone_<?php echo $model->rateid ?>", {
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
<?php
$rs = Ratesupplier::model()->findByAttributes(array('rateid' => $model->rateid, 'statusid' => 11));
$sp = Supplier::model()->findByPk($rs->supplierid);
$conta_odp = 0;
if ($model->odctime != null) {
    $conta_odp = $conta_odp + 9;
}

$odp = Rateodp::model()->findByAttributes(array('rateid' => $model->rateid));

if($odp===null && $model->odptime!=null){
   
    $lismodp=new Rateodp();
   
    $rodpsupplier=  Ratesupplier::model()->findByAttributes(array('rateid'=>$model->rateid,'statusid'=>11 ));
        
        if($model->quantity_1==$model->quantityselect){
           $lismodp->price= $rodpsupplier->quantity_1;
        }
        if($model->quantity_2==$model->quantityselect){
           $lismodp->price= $rodpsupplier->quantity_2;
        }
        if($model->quantity_3==$model->quantityselect){
           $lismodp->price= $rodpsupplier->quantity_3;
        }
        if($model->quantity_4==$model->quantityselect){
            $lismodp->price=$rodpsupplier->quantity_4;
        }
        if($model->quantity_5==$model->quantityselect){
            $lismodp->price=$rodpsupplier->quantity_5;
        }
        if($model->quantity_6==$model->quantityselect){
            $lismodp->price=$rodpsupplier->quantity_6;
        }
     
        $lismodp->comments=" ";
        $lismodp->active=1;
     
     $lismodp->rateid=$model->rateid;
     $lismodp->statustime=$model->odptime;
   
   $lismodp->supplierid=$rodpsupplier->supplierid;
     $lismodp->statuscustomertime=$model->odptime;
      $lismodp->quantityselect=$model->quantityselect;
    $lismodp->statusid=14;
    $lismodp->statuscustomerid=67;
    

    $lismodp->insert();
    $odp = Rateodp::model()->findByAttributes(array('rateid' => $model->rateid));
}


if ($odp != null) {
    $servicedsc = Rate::model()->getserviceid($model->rateid);

    if ($servicedsc == 'PRINT') {

        $estatusdb = StatusProduction::model()->findAllByAttributes(array('status_productiontype' => 1, "active" => 1), array('order' => 'status_productionorder ASC'));
        $statuso = HistProduction::model()->gethistprod($model->rateid, 1);


        if ($statuso == '0') {
            $date = date('Y-m-d H:i:s');
            $ratetracker = new Ratetracker();
            $ratetracker->rateid = $model->rateid;
            $ratetracker->statusid = 9;
            $ratetracker->ratefilter = '1';
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();

            $histo = new HistProduction();
            $histo->rateid = $model->rateid;
            $histo->type = 1;
            $histo->status_productionid = 9;
            $histo->ratetrackerid = $ratetracker->ratetrackerid;
            $histo->insert();
            $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid' => $histo->status_productionid));
        } else {
            $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid' => $statuso));
        }

        $listhistodp = HistProduction::model()->gethistprod_all($model->rateid, 1);
        $contarhis = count($listhistodp);
        $contahisfor = 1;
        $bandera = 0;
        foreach ($listhistodp as $value) {
            if ($contahisfor == 1) {
                $obj = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
                $obj_odp1 = $obj->status_productionorder;
            }

            $obj_odp = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
            if ($obj_odp->status_productionporcent == 'C' || $obj_odp->status_productionporcent == '0') {
                $conta_odp = 0;
                $bandera = 1;
            }

            if ($contahisfor == $contarhis && $bandera == 0) {
                $obj = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
                $obj_odp2 = $obj->status_productionorder;

                if ($obj_odp1 != $obj_odp2) {
                    $obj_odp3 = StatusProduction::model()->getstatusprod_all($obj_odp1, $obj_odp2, 1);
                    $conta_odp = $conta_odp + $obj_odp3;
                } else {
                    $obj_odp3 = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
                    $conta_odp = $conta_odp + $obj_odp3->status_productionporcent;
                }
            }

                $contahisfor++;
                
            }
        
    }

    if($servicedsc=='DISPLAYS'){
       
        $estatusdb = StatusProduction::model()->findAllByAttributes(array('status_productiontype' => 3 , "active"=>1),array('order'=>'status_productionorder ASC'));
   
        $statuso= HistProduction::model()->gethistprod($model->rateid,3);

    
        if ($statuso == '0') {
            $date = date('Y-m-d H:i:s');
            $ratetracker = new Ratetracker();
            $ratetracker->rateid = $model->rateid;
            $ratetracker->statusid = 111;
            $ratetracker->ratefilter = '1';
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();

            $histo = new HistProduction();
            $histo->rateid = $model->rateid;
            $histo->type = 3;
            $histo->status_productionid = 111;
            $histo->ratetrackerid = $ratetracker->ratetrackerid;
            $histo->insert();
            $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid' => $histo->status_productionid));
        } else {
            $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid' => $statuso));
        }
        
        $listhistodp = HistProduction::model()->gethistprod_all($model->rateid, 3);
        $contarhis = count($listhistodp);
        $contahisfor = 1;
        $bandera = 0;

        foreach ($listhistodp as $value) {
            if ($contahisfor == 1) {
                $obj = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
                $obj_odp1 = $obj->status_productionorder;
            }

            $obj_odp = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
            if ($obj_odp->status_productionporcent == 'C' || $obj_odp->status_productionporcent == '0') {
                $conta_odp = 0;
                $bandera = 1;
            }

            if ($contahisfor == $contarhis && $bandera == 0) {
                $obj = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
                $obj_odp2 = $obj->status_productionorder;

                if ($obj_odp1 != $obj_odp2) {
                    $obj_odp3 = StatusProduction::model()->getstatusprod_all($obj_odp1, $obj_odp2, 3);
                    $conta_odp = $conta_odp + $obj_odp3;
                } else {
                    $obj_odp3 = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
                    $conta_odp = $conta_odp + $obj_odp3->status_productionporcent;
                }
            }

                $contahisfor++;
               
            }

    }
    if ($servicedsc == 'PROMOCIONALES') {
        $estatusdb = StatusProduction::model()->findAllByAttributes(array('status_productiontype' => 2, "active" => 1), array('order' => 'status_productionorder ASC'));
        $statuso = HistProduction::model()->gethistprod($model->rateid, 2);
        if ($statuso == '0') {
            $date = date('Y-m-d H:i:s');
            $ratetracker = new Ratetracker();
            $ratetracker->rateid = $model->rateid;
            $ratetracker->statusid = 60;
            $ratetracker->statusdate = $date;
            $ratetracker->ratefilter = '1';
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();

            $histo = new HistProduction();
            $histo->rateid = $model->rateid;
            $histo->type = 2;
            $histo->status_productionid = 60;
            $histo->ratetrackerid = $ratetracker->ratetrackerid;
            $histo->insert();
            $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid' => $histo->status_productionid));
        } else {
            $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid' => $statuso));
        }

       $listhistodp = HistProduction::model()->gethistprod_all($model->rateid, 2);
        $contarhis = count($listhistodp);
        $contahisfor = 1;
        $bandera = 0;
        foreach ($listhistodp as $value) {
            if ($contahisfor == 1) {
                $obj = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
                $obj_odp1 = $obj->status_productionorder;
            }

            $obj_odp = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
            if ($obj_odp->status_productionporcent == 'C' || $obj_odp->status_productionporcent == '0') {
                $conta_odp = 0;
                $bandera = 1;
            }

            if ($contahisfor == $contarhis && $bandera == 0) {
                $obj = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
                $obj_odp2 = $obj->status_productionorder;

                if ($obj_odp1 != $obj_odp2) {
                    $obj_odp3 = StatusProduction::model()->getstatusprod_all($obj_odp1, $obj_odp2, 2);
                    $conta_odp = $conta_odp + $obj_odp3;
                } else {
                    $obj_odp3 = StatusProduction::model()->findByAttributes(array('status_productionid' => $value->status_productionid));
                    $conta_odp = $conta_odp + $obj_odp3->status_productionporcent;
                }
            }


                $contahisfor++;
               
            }
        

    }
}
?>

<div class="jarviswidget jarviswidget-color-greenDark jarviswidget-sortable" id="wid-id-<?php echo $model->rateid ?>"  data-widget-colorbutton="true" data-widget-togglebutton="true" data-widget-editbutton="true" data-widget-deletebutton="true" data-widget-custombutton="true">
    <header>
        <?php $rtype = ($model->ratetype == 'R')?'/'.$model->ratetype:''; ?>
        <span class="widget-icon"> <i class="fa fa-th-large ">  </i> </span><h2><strong><?php echo $model->idVersion() .$rtype. "  " . $model->servicedsc ?></strong> </h2>				
        <div class="widget-toolbar">

            <div class="btn-group">
                <button class="btn dropdown-toggle btn-warning" data-toggle="dropdown">
                    Acción <i class="fa fa-caret-down"></i>
                </button>
                <ul class="dropdown-menu pull-right">
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
                        <a href="?r=portoprint/rate/requote/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>">Recotizar</a>
                    </li>

                    <?php
                    $permiss = Permission::model()->findAllByAttributes(array('menuid' => $menu, 'permissiongroup' => 'Renegociacion'));
                    $listperm = Specialpermission::model()->findAllByAttributes(array('userid' => Yii::app()->user->userid, 'permissionid' => $permiss[0]['permissionid']));

                    //if ($listperm[0]["active"] != 0) {
                    ?>
                    <li>
                        <a id="breneg_<?php echo $model->rateid ?>" href="#" data-rateid="<?php echo $model->rateid ?>" >Renegociaci&oacute;n</a>
                    </li>
                    <?php //}  ?>

                    <li>
                        <a  href="#ToDo_<?php echo $model->rateid ?>" data-target="#ToDo_<?php echo $model->rateid ?>" name="<?php echo $model->rateid ?>" onclick="fechadores_todo_c(this.name)"  data-toggle="modal" >ToDo</a>
                    </li>

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
                <table style="width:100%;" id="head_<?php echo$model->rateid; ?>">
                    <thead>
                        <tr>
                            <td style="width:50%">
                                <strong>Item:</strong> <?php echo RateController::getDetail($model->rateid, $model->servicedsc, $model->note, $model->idVersion()) ?><br>
                                <strong>Comprador:</strong> <?php echo $model->firstname ?><br>
                                <strong>Creación:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'full', 'full'); ?><br />
                                <strong>Finalizó:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->statustime, 'full', 'full'); ?>
                                <?php if ($model->odctime != null) { ?>
                                    <br /><strong>ODC: </strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->odctime, 'full', 'full'); ?> <a onclick="cantidad_total_odc('<?php echo $model->rateid; ?>')" style="cursor:pointer;">Descargar</a>
                                <?php } if ($model->odptime != null) { ?>
                                    <br /><strong>ODP: </strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->odptime, 'full', 'full'); ?> <a onclick="cantidad_parcial_odp('<?php echo $model->rateid; ?>')" style="cursor:pointer;">Descargar</a>
                                <?php } ?>  
                            </td>
                            <td style="width:23%">
                                <?php if ($model->odptime != null) { ?>
                                    <strong>Estatus producción: </strong>  <a <?php if ($statusodp->status_productionporcent != '0') { ?>href="#estatus_list_odp_<?php echo $model->rateid; ?>" onclick="cambiar_st_rate_('<?php echo $model->rateid; ?>', '<?php echo $statusodp->status_productionid; ?>')"  data-target="#estatus_list_odp_<?php echo $model->rateid; ?>"  data-toggle="modal" <?php } ?> id="status_odp_dsc_<?php echo $model->rateid ?>"    ><?php echo $statusodp->status_productiondsc; ?></a>
                                    <br /><strong>Orden de Pago: </strong> <a href="?r=portoprint/pdf/odpd/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>" >Descargar</a>

                                <?php } ?>

                            </td>
                            <td style="width:27%">
                                <div data-dimension="200" data-type="half" data-text="<?php echo $conta_odp; ?>%" data-info=" " data-width="30" data-fontsize="38" data-percent="<?php echo $conta_odp; ?>" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-fill="#ddd" id="pie_<?php echo$model->rateid; ?>" style="width: 130px; height: 130px; margin: 20px auto 0 auto;" >

                                </div>



                                <script>

                                    $('#pie_<?php echo$model->rateid; ?>').circliful();



                                </script>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <?php
            $list_perm_rate = Permission::model()->findAllByAttributes(array('menuid' => $menu, 'permissiondsc' => 'Leer'));
            $lectura = array();
            foreach ($list_perm_rate as $row) {

                $spel = Specialpermission::model()->findAllByAttributes(array('userid' => Yii::app()->user->userid, 'permissionid' => $row->permissionid));
                if (count($spel) > 0) {
                    foreach ($spel as $row1) {
                        if ($row1->active == 1) {
                            $lectura[$row->permissiongroup] = 1;
                        } else {
                            $lectura[$row->permissiongroup] = 0;
                        }
                    }
                } else {
                    $lectura[$row->permissiongroup] = 0;
                }
            }
            ?>

            <div style="margin-top:3em;">
                <ul id="myTab_<?php echo $model->rateid ?>" class="nav nav-tabs">
                    <li class="active">
                        <a href="#s1_<?php echo $model->rateid ?>" data-toggle="tab">Calculadora de precios</a>
                    </li>
                    <li>
                        <a href="#s2_<?php echo $model->rateid ?>" data-toggle="tab" <?php if ($lectura['Artes'] != 0) { ?> onclick="table_arte_test_zero('close', 1, '<?php echo $model->rateid ?>')" <?php } ?> <?php
                        if ($lectura['Artes'] == 0) {
                            echo 'style="display:none;" ';
                        }
                        ?>>Arte</a>
                    </li>
                    <li>
                        <a href="#s3_<?php echo $model->rateid ?>" data-toggle="tab" <?php if ($lectura['Prueba_de_color'] != 0) { ?> onclick="table_arte_test_zero('close', 2, '<?php echo $model->rateid ?>')"<?php } ?>  <?php
                        if ($lectura['Prueba_de_color'] == 0) {
                            echo 'style="display:none;" ';
                        }
                        ?>>Prueba de color</a>
                    </li>

                    <li>
                        <a href="#s4_<?php echo $model->rateid ?>" data-toggle="tab" <?php
                        if ($lectura['Produccion'] == 0) {
                            echo 'style="display:none;" ';
                        }
                        ?>>Producción</a>
                    </li>

                    <li>
                        <a href="#s5_<?php echo $model->rateid ?>" data-toggle="tab" <?php if ($lectura['Prueba_Cero'] != 0) { ?> onclick="table_arte_test_zero('close', 3, '<?php echo $model->rateid ?>')"<?php } ?> <?php
                        if ($lectura['Prueba_Cero'] == 0) {
                            echo 'style="display:none;" ';
                        }
                        ?>>Prueba Cero</a>
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">Extra<b class="caret"></b></a>
                        <ul class="dropdown-menu">									
                            <li>
                                <a href="#s7_<?php echo $model->rateid ?>" data-toggle="tab">Archivos</a>
                            </li>
                            <li>
                                <a href="#s8_<?php echo $model->rateid ?>" data-toggle="tab">TimeLine</a>
                            </li>
                            <li>
                                <a href="#s9<?php echo $model->rateid ?>" data-toggle="tab">Tracker</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">Finanzas<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#s9_<?php echo $model->rateid ?>" data-toggle="tab">Remisiones</a>
                            </li>
                            <li>
                                <a href="#s10_<?php echo $model->rateid ?>" id="<?php echo $model->rateid ?>" style="display: <?php echo ($model->rateodpid > 0) ? 'block' : 'none'; ?>" data-toggle="tab" onclick="pintartabla(this.id);">Calificación</a> 
                            </li>
                            <li>
                                <a href="#s11_<?php echo $model->rateid ?>" data-toggle="tab">Facturación Portoprint</a>
                            </li>
                            <li>
                                <a href="#s12_<?php echo $model->rateid ?>" data-toggle="tab">Facturación Proveedor</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div id="myTabContent_<?php echo $model->rateid ?>" class="tab-content">
                    <div class="tab-pane fade in active" id="s1_<?php echo $model->rateid ?>">
                        
                        <table id="ratecalculatetable_<?php echo $model->rateid ?>" class="items table table-condensed">
                            <thead>
                                <tr>

                                    <th width="60">Mostrar</th>

                                    <th>Proveedor</th>

                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_1) . " " . $model->quantity_1; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_2) . " " . $model->quantity_2; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_3) . " " . $model->quantity_3; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_4) . " " . $model->quantity_4; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_5) . " " . $model->quantity_5; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_6) . " " . $model->quantity_6; ?></th>
                                    
                                    <th width="30" style="text-align:center">%</th>

                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_1) . " " . $model->quantity_1; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_2) . " " . $model->quantity_2; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_3) . " " . $model->quantity_3; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_4) . " " . $model->quantity_4; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_5) . " " . $model->quantity_5; ?></th>
                                    <th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_6) . " " . $model->quantity_6; ?></th>
                                </tr>
                            </thead>
                            <tbody>		
                                <?php
                            
                                 foreach ($ratesuppliers as $supplier) {
                                      
                                    ?>
                                    <tr id="crowid_<?php echo $supplier->ratesupplierid; ?>" <?php echo $supplier->selectedrow(); ?> class="list-suppliers"  >						

                                        <td style="text-align:center" >
                                            
                                            <input type="checkbox" <?php echo $supplier->checked(); ?>  title="<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->ratesupplierid; ?>" id="show_<?php echo $supplier->ratesupplierid; ?>" disabled="disabled" /></td>	

                                        <td id="ssd_<?php echo $supplier->ratesupplierid; ?>"><?php echo $supplier->supplierdsc; ?></td>

                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_1, $supplier->selectedcell()) ?>"><input type="hidden" class="prec" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_1-<?php echo $supplier->ratesupplierid; ?>" value="<?php if($supplier->quantity_1!=''){ echo $supplier->quantity_1; }else{ echo '0.00'; } ?>" /><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_1, "1") ?></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_2, $supplier->selectedcell()) ?>"><input type="hidden" class="prec" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_2-<?php echo $supplier->ratesupplierid; ?>" value="<?php if($supplier->quantity_2!=''){ echo $supplier->quantity_2; }else{ echo '0.00'; }  ?>" /><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_2, "2") ?></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_3, $supplier->selectedcell()) ?>"><input type="hidden" class="prec" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_3-<?php echo $supplier->ratesupplierid; ?>" value="<?php if($supplier->quantity_3!=''){ echo $supplier->quantity_3; }else{ echo '0.00'; }  ?>" /><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_3, "3") ?></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_4, $supplier->selectedcell()) ?>"><input type="hidden" class="prec" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_4-<?php echo $supplier->ratesupplierid; ?>" value="<?php if($supplier->quantity_4!=''){ echo $supplier->quantity_4; }else{ echo '0.00'; }  ?>" /><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_4, "4") ?></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_5, $supplier->selectedcell()) ?>"><input type="hidden" class="prec" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_5-<?php echo $supplier->ratesupplierid; ?>" value="<?php if($supplier->quantity_5!=''){ echo $supplier->quantity_5; }else{ echo '0.00'; }  ?>" /><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_5, "5") ?></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_6, $supplier->selectedcell()) ?>"><input type="hidden" class="prec" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_6-<?php echo $supplier->ratesupplierid; ?>" value="<?php if($supplier->quantity_6!=''){ echo $supplier->quantity_6; }else{ echo '0.00'; }  ?>" /><?php echo RateController::getDaysDetail($supplier->ratesupplierid, $supplier->quantity_6, "6") ?></td>
                                        <td style="text-align:right" ><input value="<?php echo $supplier->percent; ?>" size="3" class="percentcalc" type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" name="percent[<?php echo $supplier->ratesupplierid; ?>]"  id="percent_<?php echo $supplier->ratesupplierid; ?>" /><?php echo $supplier->percent; ?></td>

                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_1, $supplier->selectedcell()) ?>" >
                                                  <input type="hidden" class="prec1" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_1-<?php echo $supplier->ratesupplierid; ?>">
                                                  <span  id="c_1-<?php echo $supplier->ratesupplierid; ?>"></span>
                                        </td>
                                        
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_2, $supplier->selectedcell()) ?>" >
                                                  <input type="hidden" class="prec1" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_2-<?php echo $supplier->ratesupplierid; ?>">
                                                 <span  id="c_2-<?php echo $supplier->ratesupplierid; ?>" >
                                                 </span>
                                        </td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_3, $supplier->selectedcell()) ?>" >
                                               <input type="hidden" class="prec1" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_3-<?php echo $supplier->ratesupplierid; ?>">
                                                <span  id="c_3-<?php echo $supplier->ratesupplierid; ?>"></span>
                                        </td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_4, $supplier->selectedcell()) ?>" >
                                             <input type="hidden" class="prec1" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_4-<?php echo $supplier->ratesupplierid; ?>">
                                                 <span  id="c_4-<?php echo $supplier->ratesupplierid; ?>"></span>
                                        </td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_5, $supplier->selectedcell()) ?>" >
                                             <input type="hidden" class="prec1" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_5-<?php echo $supplier->ratesupplierid; ?>">
                                            <span  id="c_5-<?php echo $supplier->ratesupplierid; ?>"></span>
                                        </td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_6, $supplier->selectedcell()) ?>" >
                                              <input type="hidden" class="prec1" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_6-<?php echo $supplier->ratesupplierid; ?>">
                                            
                                                <span  id="c_6-<?php echo $supplier->ratesupplierid; ?>"></span>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                     ?>

                                <tr>

                                    <td style=" border-top: 1px black solid;" width="60">&nbsp;</td>
                                    <td style=" border-top: 1px black solid;">Promedio General </td>
                                     <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pg_1" ></td>
                                     <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pg_2" ></td>
                                     <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pg_3" ></td>
                                     <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pg_4" ></td>
                                     <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pg_5" ></td>
                                     <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pg_6" ></td>

                                    <td >&nbsp;</td>
                                      <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpg_1" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpg_2" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpg_3" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpg_4" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpg_5" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpg_6" >0</td>
                                    <td style="text-align:right; " width="60">&nbsp;</td>
                                </tr>
                                <tr>

                                    <td  style=" border-top: 1px black solid;" width="60">&nbsp;</td>

                                    <td style=" border-top: 1px black solid;">Precio Portoprint $</td>

                                   <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pp_1" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pp_2" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pp_3" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pp_4" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pp_5" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_pp_6" >0</td>

                                        <td >&nbsp;</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpp_1" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpp_2" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpp_3" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpp_4" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpp_5" >0</td>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpp_6" >0</td>
                                        
                                </tr>
                                <tr >

                                    <td width="60">&nbsp;</td> 

                                    <td>Ahorro $</td>

                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_save_1" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_save_2" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_save_3" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_save_4" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_save_5" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_save_6" >0</td>
                                        <td >&nbsp;</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_csave_1" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_csave_2" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_csave_3" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_csave_4" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_csave_5" >0</td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_csave_6" >0</td>

                                </tr>
                           
                                <tr >

                                    <td width="60">&nbsp;</td>
                                    <td>Ahorro Extra $</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_xsave_1" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_xsave_2" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_xsave_3" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_xsave_4" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_xsave_5" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_xsave_6" >0</td>
                                    <td >&nbsp;</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_1" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_2" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_3" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_4" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_5" >0</td>
                                    <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_6" >0</td>
                                    <td style="text-align:right" width="60">&nbsp;</td>
                                </tr>
                                <tr ><td colspan="16">&nbsp;</td></tr>
                                <tr ><td colspan="16">&nbsp;</td></tr>		
                            </tbody>	
                        </table>
                    </div>
                    <div class="tab-pane fade" id="s2_<?php echo $model->rateid ?>"  >
                        <p>
                            <?php
                            $listpermission = Permission::model()->findAllByAttributes(array());

                            $modelrate = Rate::model()->findbyAttributes(array('rateid' => $model->rateid));
                            $this->renderPartial('rate/tbl_art_color', array("op" => 1, "st" => 'close', "model" => $modelrate, 'rateid' => (is_null($modelrate)) ? $model->rateid : $modelrate->rateid, 'menu' => $menu, "add" => $add, "edt" => $edt, "del" => $del));
                            ?>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="s3_<?php echo $model->rateid ?>">
                        <p>
                            <?php
                            $modelrate = Rate::model()->findbyAttributes(array('rateid' => $model->rateid));
                            $this->renderPartial('rate/tbl_test_color', array("op" => 2, "st" => 'close', "model" => $modelrate, 'rateid' => (is_null($modelrate)) ? $model->rateid : $modelrate->rateid, 'menu' => $menu, "add" => $add, "edt" => $edt, "del" => $del));
                            ?>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="s4_<?php echo $model->rateid ?>">
                        <p>
                            <?php
                            $modelproduction = Rateproduction::model()->findbyAttributes(array('rateid' => $model->rateid));

                            $this->renderPartial('rate/production', array("model" => $modelproduction, 'rateid' => (is_null($modelproduction)) ? $model->rateid : $modelproduction->rateid, 'menu' => $menu, "add" => $add, "edt" => $edt, "del" => $del));
                            ?>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="s5_<?php echo $model->rateid ?>">
                        <p>
                            <?php
                            $listpermission = Permission::model()->findAllByAttributes(array());

                            $modelrate = Rate::model()->findbyAttributes(array('rateid' => $model->rateid));
                            $this->renderPartial('rate/tbl_zero_color', array("op" => 4, "st" => 'close', "model" => $modelrate, 'rateid' => (is_null($modelrate)) ? $model->rateid : $modelrate->rateid, 'menu' => $menu, "add" => $add, "edt" => $edt, "del" => $del));
                            ?>




                        </p>
                    </div>
                    <div class="tab-pane fade" id="s7_<?php echo $model->rateid ?>">
                        <form class="smart-form">
                            <header><strong>Archivos</strong></header>
                            <fieldset>


                                <table id="files_<?php echo $model->rateid ?>" class="table table-bordered" style="font-size: 10px;" >
                                    <thead>
                                        <tr>
                                            <th style="width:30%">Nombre</th>

                                            <th style="width:50%">Url</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $files = new Ratefile();
                                        $data = $files->recoverFile($model->rateid);
                                        $cadena = ' ';
                                        foreach ($data as $value) {
                                            if ($cadena == ' ') {
                                                $cadena = "<tr><td>" . $value['name'] . "</td><td><div class='btn-group btn-group-xs '><a class='btn btn-primary' id='send_fil_down' target='_blank' href=' " . $value['path'] . "'  ><i class='glyphicon glyphicon-download'></i>&nbsp;Descargar</a></div></td></tr>";
                                            } else {
                                                $cadena.="<tr><td>" . $value['name'] . "</td><td><div class='btn-group btn-group-xs '><a class='btn btn-primary' id='send_fil_down' target='_blank' href=' " . $value['path'] . "'  ><i class='glyphicon glyphicon-download'></i>&nbsp;Descargar</a></div></td></tr>";
                                            }
                                        }
                                        echo $cadena;
                                        ?>
                                    </tbody>
                                </table>   </fieldset>
                        </form>	

                        <form action="index.php?r=portoprint/upload/savefile/id/<?php echo Utils::encrypt($model->bundleid, 'document'); ?>/rate/<?php echo Utils::encrypt($model->rateid, 'document'); ?>" class="dropzone smart-form" id="sdzone_<?php echo $model->rateid ?>" style="border-color:#FF0000;"></form>
                        <header><strong>Arrastra o da click en esta zona para cargar Archivo</strong></header>
                    </div>
                    <div class="tab-pane fade" id="s8_<?php echo $model->rateid ?>">
                        <form class="smart-form"> 
                            <header><strong>Time Line</strong></header>
                            <fieldset>
                                <div id="ratetimeline_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;">
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


                    <div class="tab-pane fade" id="s9<?php echo $model->rateid ?>">
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
 
                                   
                            $('#breneg_<?php echo $model->rateid ?>').click(function() {
                                var rateid = $(this).data('rateid');
                                console.log(rateid);
                                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/addreneg') ?>', {rateid: rateid}, function(response) {
                                    console.log(response);
                                    location.reload();
                                    /*var nrateid = response;
                                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/datareneg') ?>', {rateid: nrateid}, function(response) {
                                        
                                        $('#fld_<?php echo $model->rateid ?>').html(response);
                                    });*/
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
                    <div class="tab-pane fade" id="s9_<?php echo $model->rateid ?>">
                        <form class="smart-form">
                            <header><strong>Remisiones</strong></header>
                        </form>		
                        <p>
                        <div id="rateinvoiceporto_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;"></div>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="s10_<?php echo $model->rateid ?>">
                        <form class="smart-form">
                            <header><strong>Calificación</strong></header>
                        </form>		
                        <p>
                        <div id="raterating_<?php echo $model->rateid ?>" style="font-size:12px; height:300px;">
                            <div class="btn-group btn-group-sm">
                                <a href="#formrating" id="btn_calificar_<?php echo $model->rateid ?>" class="btn btn-success formrating" data-rateid="<?php echo $model->rateid ?>" data-resto="<?php echo $model->resto ?>" data-supplier="<?php echo $model->supplierid ?>" data-bundle="<?php echo $model->bundleid ?>" data-userid="<?php echo $model->userid ?>" data-target="#formrating"  data-toggle="modal" style="display: <?php echo ($model->resto == 0) ? 'none' : 'block'; ?>">Calificar</a>
                            </div>
                            <div style="display: table; float: right;">
                                <div id="pendientes<?php echo $model->rateid ?>" style="display: table-row; text-align: center; font-size: 24px; font-weight: bold;"><?php echo $model->resto ?></div>
                                <div style="display: table-row; font-size: 12px; ">Pendiente por calificar </div>
                            </div>
                            <table id="ratingtable<?php echo $model->rateid ?>" class="items table table-condensed rating_table">
                                <thead>
                                    <tr>
                                        <th width="10%">ID</th>
                                        <th width="30%">Fecha</th>
                                        <th width="30%" style="text-align:center">Promedio</th>
                                        <th width="30%" style="text-align:center">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $rating = Evaluation::model()->findAllByAttributes(array('rateid' => $model->rateid));


                                    foreach ($rating as $fila) {
                                        echo '<tr>'
                                        . '<td style="text-align:left">' . $fila->evaluationid . '</td>'
                                        . '<td style="text-align:left">' . $fila->fecha . '</td>'
                                        . '<td style="text-align:center">' . $fila->promedioservicio . '</td>'
                                        . '<td style="text-align:center">' . $fila->cantidad . '</td>'
                                        . '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>




                            <script>
                                $("#ratingtable<?php echo $model->rateid ?>").find("td").css("cursor", "pointer");</script>


                        </div>

                        </p>
                    </div>

                    <div class="tab-pane fade" id="s11_<?php echo $model->rateid ?>">
                        <form class="smart-form" id="facturacion_porto" action="index.php?r=portoprint/rate/savePortoprintInvoice/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>" method="post">
                            <header><strong>Facturación Portoprint</strong></header>
                            <div class="factura_p">
                                <div class="line">
                                    <a href="#" class="btn btn-primary">Nueva Factura</a>
                                    <a href="#" class="btn btn-primary">Cobro</a>
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="ppp.createdate"> FECHA DE ELABORACION</label>
                                        <input value="" type="text" name="ppp.createdate" size="9" id="ppp.createdate" class="date">
                                    </span>
                                    <span>
                                        <label for="ppp.pieces">CANTIDAD PIEZAS</label>
                                        <input value="" type="text" name="ppp.pieces" id="ppp.pieces" size="5">
                                    </span>
                                    <span>
                                        <label for="ppp.invoicenumber">NUMERO DE FACTURA</label>
                                        <input value="" type="text" name="ppp.invoicenumber" id="ppp.invoicenumber" size="9">
                                    </span>
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="ppp.amount">SUB TOTAL</label>
                                        <input value="" type="text" name="ppp.amount" id="ppp.amount" size="5">
                                    </span>
                                    <span>
                                        <label for="ppp.ivatax">IMPUESTO</label>
                                        <input value="" type="text" name="ppp.ivatax" id="ppp.ivatax" size="3">%
                                    </span>
                                    <!--span>
                                            <label for="ppp.total">TOTAL</label>
                                            <input type="text" name="ppp.total" size="5" id="ppp.total">
                                    </span-->
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="ppp.vendor">VENDOR</label>
                                        <input value="" type="text" name="ppp.vendor" id="ppp.vendor" size="15">
                                    </span>
                                    <span>
                                        <label for="ppp.pago">CONDICIONES DE PAGO</label>
                                        <input value="" type="text" name="ppp.pago" id="ppp.pago" size="15">
                                    </span>
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="ppp.estimateddate">FECHA ESTIMADA DE COBRO</label>
                                        <input value="" type="text" name="ppp.estimateddate" id="ppp.estimateddate" size="9" class="date">
                                    </span>
                                    <span>
                                        <label for="ppp.realDate">FECHA REAL DE COBRO</label>
                                        <input value="" type="text" name="ppp.realDate" id="ppp.realDate" size="10" class="date">
                                    </span>
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="ppp.date_send_revision">FECHA DE ENVIO A REVISION</label>
                                        <input value="" type="text" name="ppp.date_send_revision" id="ppp.date_send_revision" size="9" class="date">
                                    </span>
                                    <span>
                                        <label for="ppp.GR">GR</label>
                                        <input value="" type="text" name="ppp.GR" id="ppp.GR" size="10">
                                    </span>
                                    <span>
                                        <label for="ppp.rateportoprintinvoiceid">NUMERO DE CONFIRMACION / TICKET</label>
                                        <input value="" type="text" name="ppp.rateportoprintinvoiceid" id="ppp.rateportoprintinvoiceid" size="10">
                                    </span>
                                </div>
                                <div class="line">
                                    <button type="reset" class="btn btn-primary">CANCELAR</button>
                                    <button type="submit" class="btn btn-primary">ACEPTAR</button>
                                </div>
                            </div>
                        </form>

                        <div class="div_cobro" id="invoice_portoprint">
                            <a href="#" class="btn btn-primary">COBRO</a><br />
                            <table>
                                <thead>
                                    <tr>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>&nbsp;</td>
                                        <td>IMPUESTO</td>
                                        <td>&nbsp;</td>
                                        <td>TOTAL</td>
                                        <td>&nbsp;</td>
                                        <td>FECHA</td>
                                        <td>&nbsp;</td>
                                        <td>NUMERO FACTURA</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input id="subtotal" name="subtotal" type="text" size="5"></td>
                                        <td class="small">&nbsp;</td>
                                        <td><input id="impuesto" name="impuesto" type="text" size="5"></td>
                                        <td class="small">&nbsp;</td>
                                        <td><input id="total" name="total" type="text" size="5"></td>
                                        <td class="small">&nbsp;</td>
                                        <td><input id="date" name="date" type="text" size="9"></td>
                                        <td class="small">&nbsp;</td>
                                        <td><input id="factura_id" name="factura_id" type="text" size="9"></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: solid 1px #000; padding-text-align:left;" colspan="10">HISTORIAL DE MOVIMIENTOS</td>
                                    </tr>
                                    <tr>
                                        <td>1-</td>
                                        <td>$500,000.00</td>
                                        <td class="small">/</td>
                                        <td>16%</td>
                                        <td class="small">/</td>
                                        <td>$580,000.00</td>
                                        <td class="small">/</td>
                                        <td>13-MARZO-2014</td>
                                        <td class="small">/</td>
                                        <td>PORT-12345</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <p>
                        <div id="rateinvoiceporto_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;"></div>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="s12_<?php echo $model->rateid ?>">
                        <form class="smart-form" id="facturacion_supplier" action="index.php?r=portoprint/rate/saveSupplierInvoice/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>" method="post">
                            <header><strong>Facturación Proveedor</strong></header>
                            <div class="factura_p">
                                <div class="line">
                                    <a href="#" class="btn btn-primary">Nueva Factura</a>
                                    <a href="#" class="btn btn-primary">Cobro</a>
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="spp.createdate"> FECHA DE ELABORACION</label>
                                        <input value="" type="text" name="spp.createdate" size="9" id="spp.createdate" class="date">
                                    </span>
                                    <span>
                                        <label for="spp.pieces">CANTIDAD PIEZAS</label>
                                        <input value="" type="text" name="spp.pieces" id="spp.pieces" size="5">
                                    </span>
                                    <span>
                                        <label for="spp.invoicenumber">NUMERO DE FACTURA</label>
                                        <input value="" type="text" name="spp.invoicenumber" id="spp.invoicenumber" size="9">
                                    </span>
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="spp.amount">SUB TOTAL</label>
                                        <input value="" type="text" name="spp.amount" id="spp.amount" size="5">
                                    </span>
                                    <span>
                                        <label for="spp.ivatax">IMPUESTO</label>
                                        <input value="" type="spp.text" name="spp.ivatax" id="spp.ivatax" size="3">%
                                    </span>
                                    <!--span>
                                            <label for="spp.total">TOTAL</label>
                                            <input type="text" name="spp.total" size="5" id="spp.total">
                                    </span-->
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="spp.vendor">VENDOR</label>
                                        <input value="" type="text" name="spp.vendor" id="spp.vendor" size="15">
                                    </span>
                                    <span>
                                        <label for="spp.pago">CONDICIONES DE PAGO</label>
                                        <input value="" type="text" name="spp.pago" id="spp.pago" size="15">
                                    </span>
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="spp.estimateddate">FECHA ESTIMADA DE COBRO</label>
                                        <input value="" type="text" name="spp.estimateddate" id="spp.estimateddate" size="9" class="date">
                                    </span>
                                    <span>
                                        <label for="spp.realDate">FECHA REAL DE COBRO</label>
                                        <input value="" type="text" name="spp.realDate" id="spp.realDate" size="10" class="date">
                                    </span>
                                    <span>
                                        <label for="spp.odc">ODC / ODP </label>
                                        <input value="" type="text" name="spp.odc" id="odc" size="10">
                                    </span>
                                </div>
                                <div class="line">
                                    <span>
                                        <label for="spp.date_send_revision">FECHA DE ENVIO A REVISION</label>
                                        <input value="" type="text" name="spp.date_send_revision" id="spp.date_send_revision" size="9" class="date">
                                    </span>
                                    <span>
                                        <label for="spp.GR">GR</label>
                                        <input value="" type="text" name="spp.GR" id="spp.GR" size="10">
                                    </span>
                                    <span>
                                        <label for="spp.rateportoprintinvoiceid">NUMERO DE CONFIRMACION / TICKET</label>
                                        <input value="" type="text" name="spp.ratesupplierinvoiceid" id="spp.rateportoprintinvoiceid" size="10">
                                    </span>
                                </div>
                                <div class="line">
                                    <button type="reset" class="btn btn-primary">CANCELAR</button>
                                    <button type="submit" class="btn btn-primary">ACEPTAR</button>
                                </div>
                            </div>
                        </form>
                        <div class="div_cobro" id="invoice_supplier">
                            <a href="#" class="btn btn-primary">COBRO</a><br />
                            <table>
                                <thead>
                                    <tr>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>&nbsp;</td>
                                        <td>IMPUESTO</td>
                                        <td>&nbsp;</td>
                                        <td>TOTAL</td>
                                        <td>&nbsp;</td>
                                        <td>FECHA</td>
                                        <td>&nbsp;</td>
                                        <td>NUMERO FACTURA</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input id="subtotal" name="subtotal" type="text" size="5"></td>
                                        <td class="small">&nbsp;</td>
                                        <td><input id="impuesto" name="impuesto" type="text" size="5"></td>
                                        <td class="small">&nbsp;</td>
                                        <td><input id="total" name="total" type="text" size="5"></td>
                                        <td class="small">&nbsp;</td>
                                        <td><input id="date" name="date" type="text" size="9"></td>
                                        <td class="small">&nbsp;</td>
                                        <td><input id="factura_id" name="factura_id" type="text" size="9"></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: solid 1px #000; padding-text-align:left;" colspan="10">HISTORIAL DE MOVIMIENTOS</td>
                                    </tr>
                                    <tr>
                                        <td>1-</td>
                                        <td>$500,000.00</td>
                                        <td class="small">/</td>
                                        <td>16%</td>
                                        <td class="small">/</td>
                                        <td>$580,000.00</td>
                                        <td class="small">/</td>
                                        <td>13-MARZO-2014</td>
                                        <td class="small">/</td>
                                        <td>PORT-12345</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <p>
                        <div id="rateinvoicesupplier_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;"></div>
                        </p>
                    </div>


                </div>

            </div>



        </div>
    </div>
</div>




<div class="modal fade" id="ODPModal_<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="ODPModal_<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Generar Orden de Producción</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="?r=portoprint/rate/generateodp/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>" id="<?php echo 'extend-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
                    <fieldset>
                        <div class="row">

                            <section class="col col-3"><strong>COTIZACION-ITEM:</strong></section>
                            <section class="col col-9"><?php echo $model->rateid; ?></section>
                        </div>
                        <div class="row">

                            <section class="col col-3"><strong>ITEM:</strong></section>
                            <section class="col col-9"><?php echo $model->servicedsc; ?></section>
                        </div>
                        <div class="row"> 
                            <section class="col col-3"><strong>PROVEEDOR:</strong></section>
                            <section class="col col-9"><?php echo $sp->supplierdsc; ?></section>
                        </div>

                    </fieldset>
                    <footer>
                           <button class="btn btn-primary" type="button" onclick="finalize_odp('<?php echo Utils::encrypt($model->rateid, 'rate') ?>', '<?php echo $model->rateid ?>', '<?php echo 'extendp-' . $model->rateid . '-form'; ?>','0');" >Generar</button>
                           <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>				
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="ODCModal_<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="ODCModal_<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Generar Orden de Compra</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="?r=portoprint/rate/generateodc/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>" id="<?php echo 'extend-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
                    <fieldset>
                        <div class="row">
                            <section class="col col-3"><strong>COTIZACION-ITEM:</strong></section>
                            <section class="col col-9"><?php echo $model->rateid; ?></section>
                        </div>
                        <div class="row">
                            <section class="col col-3"><strong>ITEM:</strong></section>
                            <section class="col col-9"><?php echo $model->servicedsc; ?></section>
                        </div>
                        <div class="row">
                            <section class="col col-3"><strong>PROVEEDOR:</strong></section>
                            <section class="col col-9"><?php echo $sp->supplierdsc; ?></section>
                        </div>
                        <div class="row">
                            <section class="col col-3"><strong>IVA:</strong></section>
                            <section class="col col-2"><label class="input"><input type="text" class="input-xs" name="ivaodc" id="ivaodc_<?php echo $model->rateid; ?>" value="<?php echo $model->iva; ?>" size="2" maxlength="2" /></label></section>
                            <section class="col col-1">%</section>
                        </div>

                        <div class="row">
                            <section class="col col-3">
                                <label class="label">Fecha ODC Cliente</label>
                                <label class="input"><input type="text" id="fodcc_<?php echo $model->rateid; ?>" name="fodcc" class="date" size="10" /> </label>
                            </section>
                            <section class="col col-4">
                                <label class="label">No. ODC cliente</label>
                                <label class="input"><input type="text" id="nodcc_<?php echo $model->rateid; ?>" name="nodcc" size="15" /> </label>
                            </section>

                        </div>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" type="button" onclick="finalize_odc('<?php echo Utils::encrypt($model->rateid, 'rate') ?>', '<?php echo $model->rateid ?>', '<?php echo 'extendc-' . $model->rateid . '-form'; ?>','0');">Generar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="formrating" tabindex="-1" role="dialog" aria-labelledby="formrating" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Calificar</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="#" id="nproyectcustm" novalidate="novalidate" class="smart-form">	
                    <fieldset>
                        <input type="hidden" id="parent_rateid">
                        <input type="hidden" id="hiddenresto">
                        <input type="hidden" id="hiddensupplierid">
                        <input type="hidden" id="hiddenbundleid">
                        <input type="hidden" id="hiddenuserid">
                        <table class="items table table-condensed">
                            <thead>
                                <tr>
                                    <th width="10%">Cantidad</th>
                                    <th><input type="number" id="quantity" min="1" max="5" pattern="[0-9]*"></th>
                                </tr>
                            </thead>
                        </table>
                        <table class="items table table-condensed">
                            <thead>
                                <tr>
                                    <th width="60%"></th>
                                    <th width="20%" style="text-align:center">0</th>
                                    <th width="20%" style="text-align:center">5</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color:#D9FAD9;">
                                    <td style="text-align:left;" colspan="3"><b>Tiempo de respuesta</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Cotización</td>
                                    <td style="text-align:center"><input type="radio" name="cotizacion" value="0" class="cotizacion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="cotizacion" value="5" class="cotizacion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Resolución de problemas</td>
                                    <td style="text-align:center"><input type="radio" name="resolucion" value="0" class="resolucion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="resolucion" value="5" class="resolucion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr style="background-color:#D9FAD9;">
                                    <td style="text-align:left;" colspan="3"><b>Calidad</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Impresión</td>
                                    <td style="text-align:center"><input type="radio" name="impresion" value="0" class="impresion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="Impresion" value="5" class="impresion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Acabados</td>
                                    <td style="text-align:center"><input type="radio" name="acabados" value="0" class="acabados rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="acabados" value="5" class="acabados rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Empaque</td>
                                    <td style="text-align:center"><input type="radio" name="empaque" value="0" class="empaque rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="empaque" value="5" class="empaque rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Distribución</td>
                                    <td style="text-align:center"><input type="radio" name="distribucion" value="0" class="distribucion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="distribucion" value="5" class="distribucion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr style="background-color:#D9FAD9;">
                                    <td style="text-align:left;" colspan="3"><b>Entrega</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Cumplimiento</td>
                                    <td style="text-align:center"><input type="radio" name="cumplimiento" value="0" class="cumplimiento rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="cumplimiento" value="5" class="cumplimiento rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Envío de documentación</td>
                                    <td style="text-align:center"><input type="radio" name="edocumentacion" value="0" class="edocumentacion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="edocumentacion" value="5" class="edocumentacion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Envío de muestras</td>
                                    <td style="text-align:center"><input type="radio" name="emuestras" value="0" class="emuestras rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="emuestras" value="5" class="emuestras rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr style="background-color:#D9FAD9;">
                                    <td style="text-align:left;" colspan="3"><b>Servicio al cliente</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Comunicación</td>
                                    <td style="text-align:center"><input type="radio" name="comunicacion" value="0" class="comunicacion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="comunicacion" value="5" class="comunicacion rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Disponibilidad</td>
                                    <td style="text-align:center"><input type="radio" name="disponibilidad" value="0" class="disponibilidad rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="disponibilidad" value="5" class="disponibilidad rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Status</td>
                                    <td style="text-align:center"><input type="radio" name="status" value="0" class="status rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                    <td style="text-align:center"><input type="radio" name="status" value="5" class="status rdo<?php echo $model->rateid; ?>" id="<?php echo $model->rateid; ?>" onchange="promedio(this.id)"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Promedio Servicio</td>
                                    <td style="text-align:center" colspan="2" id="spromedio<?php echo $model->rateid; ?>"></td>
                                </tr>
                            </tbody>	
                        </table>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" class="btn btn-default" id="sendrating" onclick="send_rating();" type="button" ata-dismiss="modal">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new" >Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="ToDo_<?php echo $model->rateid ?>" tabindex="-1" role="dialog" aria-labelledby="ToDo_<?php echo $model->rateid ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agregar ToDo</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="#" id="ntcToDos_<?php echo $model->rateid ?>" novalidate="novalidate" class="smart-form">	
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
                                    <td ><label for="NTproject">Area</label></td>
                                    <td  id="NT_areaidtd">

                                        <select  id="NT_areaid_sel" onchange="selector_personal_c(this.value, '<?php echo $model->rateid ?>')" style=" width: 165px;"></select>

                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Personal</label></td>
                                    <td  id="NT_userareaidtd">

                                        <select  id="NT_userid_sel"  style=" width: 165px;">
                                            <option value=""></option>
                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Prioridad</label></td>
                                    <td  id="NT_prioritytd">
                                        <div class="btn-group">
                                            <button type="button" id="success" class="pr btn btn-success btn-sm" onclick="todo_cot_prio(1, 'ntcToDos_<?php echo $model->rateid ?>')" data-value="1" >Normal</button>
                                            <button type="button" id="warning" class="pr btn btn-warning btn-sm" onclick="todo_cot_prio(2, 'ntcToDos_<?php echo $model->rateid ?>')" data-value="2" >Media</button>
                                            <button type="button" id="danger"  class="pr btn btn-danger btn-sm"  onclick="todo_cot_prio(3, 'ntcToDos_<?php echo $model->rateid ?>')" data-value="3"  >Alta</button>
                                            <input type="hidden" id="NT_priority_sel">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Fecha Inicio</label></td>
                                    <td  id="NT_startdatetd">
                                        <label class="input"> 
                                            <i class="icon-append fa fa-calendar"></i>
                                            <input type="text"  id="NT_startdate_daty" name="NT_startdate_daty" readonly>
                                        </label>
                                    </td>    
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Fecha Fin</label></td>
                                    <td  id="NT_enddatetd">
                                        <label class="input"> 
                                            <i class="icon-append fa fa-calendar"></i>
                                            <input type="text"  id="NT_enddate_daty" name="NT_enddate_daty" readonly>
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
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject" type="button" onclick="save_todo_cot_c('<?php echo $model->rateid ?>')" >Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="but    ton" id="cancel_new" >Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<div class="modal fade" id="estatus_list_odp_<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="estatus_list_odp_<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 90%; height: 200px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Estatus de Produccion</h4>
            </div>
            <div class="modal-body no-padding" >
                <form method="post" action="" id="estatus_form_odp_<?php echo $model->rateid; ?>" novalidate="novalidate" class="smart-form">
                    <fieldset>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td ><label for="NTproject">Estatus Produccion:</label></td>
                                    <td  id="NT_tododsctd">
                                        <select id="estatus_selfor" name="estatus_selfor" onchange="actualizar_estatus_prod(this.value, '<?php echo $model->rateid; ?>')" >
                                            <?php
                                            foreach ($estatusdb as $row) {

                                                if ($statuso->status_productionid == $row->status_productionid) {
                                                    echo "<option value='{$row->status_productionid}' selected='selected'>{$row->status_productiondsc}</option>";
                                                } else {
                                                    echo "<option value='{$row->status_productionid}' >{$row->status_productiondsc}</option>";
                                                }
                                            }
                                            ?>
                                        </select>	
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <footer>

                        <button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new" >Cerrar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="cantidad_parcial_odp_<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="cantidad_parcial_odp_<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 90%; height: 200px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Remision</h4>
            </div>
            <div class="modal-body no-padding" >
                <form method="post" action="" id="cantidad_prfor_odp_<?php echo $model->rateid; ?>" novalidate="novalidate" class="smart-form">
                    <fieldset>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td ><label for="NTproject">Cantidad Parcial:</label></td>
                                    <td  id="NT_candpartd">
                                        <input type="text"  id="NT_candpar_dsc" name="NT_startdate_daty" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <strong>Cantidad Total:  <label id="cant_tol_odp" style=" font-size: 15px;" ></label> </strong> 

                        </br><strong>Cantidad Restante:  <label id="cant_par_odp" style=" font-size: 15px;" ></label> </strong> 
                    </fieldset>
                    <footer>
                        <a class="btn btn-default"  onclick="save_parcial_odp('<?php echo $model->rateid; ?>', '<?php echo Utils::encrypt($model->rateid, 'rate'); ?>', '<?php echo Utils::encrypt($bundleid, 'rate'); ?>')" >Descargar</a>
                        <button data-dismiss="modal" class="btn btn-default" type="button" id="cancel_new" >Cerrar</button>			
                    </footer>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<?php
$cont = 1;
$data = array();
$data[] = array("id" => $cont++, "content" => 'Creación<br>' . Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'short', 'short'), "start" => $model->ratedate);
$ratetracker = Ratetracker::model()->findAllByAttributes(array("rateid" => $model->rateid));

foreach ($ratetracker as $event) {

    $data[] = array("id" => $cont++, "content" => $event->status->statusdsc . "<br />" . Yii::app()->dateFormatter->formatDateTime($event->statusdate, 'short', 'short'), "start" => date($event->statusdate));
}
?>

<script>

    $("#fodcc_<?php echo $model->rateid; ?>").datepicker({
        dateFormat: 'yy-mm-dd'

    });
    function send_rating() {
        {

            var errores = 0;
            var calificaciones = "";
            var ncalif = 0;
            if ($.isNumeric($("#quantity").val()) === false) {
                errores++;
                alert('Debe ingresar la cantidad de producto a calificar.');
                return false;
            }

            if (parseInt($("#quantity").val()) > parseInt($("#hiddenresto").val())) {
                errores++;
                alert('La cantidad de producto a calificar debe ser menor a ' + $("#hiddenresto").val() + '.');
                return false;
            }

            if (!$('.cotizacion:eq(0)').is(':checked') && !$('.cotizacion:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico cotización.');
                return false;
            }
            else {
                calificaciones += $(".cotizacion:checked").val();
                ncalif += parseInt($(".cotizacion:checked").val());
            }

            if (!$('.resolucion:eq(0)').is(':checked') && !$('.resolucion:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico resolución.');
                return false;
            }
            else {
                calificaciones += ',' + $(".resolucion:checked").val();
                ncalif += parseInt($(".resolucion:checked").val());
            }

            if (!$('.impresion:eq(0)').is(':checked') && !$('.impresion:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico impresión.');
                return false;
            }
            else {
                calificaciones += ',' + $(".impresion:checked").val();
                ncalif += parseInt($(".impresion:checked").val());
            }

            if (!$('.acabados:eq(0)').is(':checked') && !$('.acabados:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico acabados.');
                return false;
            }
            else {
                calificaciones += ',' + $(".acabados:checked").val();
                ncalif += parseInt($(".acabados:checked").val());
            }

            if (!$('.empaque:eq(0)').is(':checked') && !$('.empaque:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico empaque.');
                return false;
            }
            else {
                calificaciones += ',' + $(".empaque:checked").val();
                ncalif += parseInt($(".empaque:checked").val());
            }

            if (!$('.distribucion:eq(0)').is(':checked') && !$('.distribucion:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico distribución.');
                return false;
            }
            else {
                calificaciones += ',' + $(".distribucion:checked").val();
                ncalif += parseInt($(".distribucion:checked").val());
            }

            if (!$('.cumplimiento:eq(0)').is(':checked') && !$('.cumplimiento:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico cumplimiento.');
                return false;
            }
            else {
                calificaciones += ',' + $(".cumplimiento:checked").val();
                ncalif += parseInt($(".cumplimiento:checked").val());
            }

            if (!$('.edocumentacion:eq(0)').is(':checked') && !$('.edocumentacion:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico envió de documentación.');
                return false;
            }
            else {
                calificaciones += ',' + $(".edocumentacion:checked").val();
                ncalif += parseInt($(".edocumentacion:checked").val());
            }

            if (!$('.emuestras:eq(0)').is(':checked') && !$('.emuestras:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico envió de muestras.');
                return false;
            }
            else {
                calificaciones += ',' + $(".emuestras:checked").val();
                ncalif += parseInt($(".emuestras:checked").val());
            }

            if (!$('.comunicacion:eq(0)').is(':checked') && !$('.comunicacion:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico comunicación.');
                return false;
            }
            else {
                calificaciones += ',' + $(".comunicacion:checked").val();
                ncalif += parseInt($(".comunicacion:checked").val());
            }

            if (!$('.disponibilidad:eq(0)').is(':checked') && !$('.disponibilidad:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico disponibilidad.');
                return false;
            }
            else {
                calificaciones += ',' + $(".disponibilidad:checked").val();
                ncalif += parseInt($(".disponibilidad:checked").val());
            }

            if (!$('.status:eq(0)').is(':checked') && !$('.status:eq(1)').is(':checked')) {
                errores++;
                alert('Debe seleccionar una calificación para el tópico status.');
                return false;
            }
            else {
                calificaciones += ',' + $(".status:checked").val();
                ncalif += parseInt($(".status:checked").val());
            }


            if (errores == 0) {
                var rateid = $("#parent_rateid").val();
                var supplierid = $("#hiddensupplierid").val();
                var bundleid = $("#hiddenbundleid").val();
                var userid = $("#hiddenuserid").val();
                var cantidad = $("#quantity").val();
                var promedio = (ncalif === 0) ? 0 : (ncalif / 12).toFixed(2);
                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/saverating') ?>', {rateid: rateid, supplierid: supplierid, calificaciones: calificaciones, cantidad: cantidad, promedio: promedio, bundleid: bundleid, userid: userid}, function(response) {


                    if (response == 0) {
                        alert('Error al insertar la calificación.');
                    }
                    else {
                        alert('La calificación ha sido almacenada correctamente.');
                        var res = response.split("|");
                        var evaluationid = res[1];
                        var cantidad = res[2];
                        $("#formrating").modal('hide');
                        list_rating(rateid);
                        $(".rdo" + rateid + "").each(function() {
                            $(this).prop('checked', false);
                        });
                        $("#quantity").val('');
                        $("#spromedio" + rateid + "").html('');
                        var pendientes = $("#pendientes" + rateid + "").html() - cantidad;
                        $("#pendientes" + rateid + "").html(pendientes);
                        //Enviar mail

                        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/sendrating') ?>', {bundleid: bundleid, userid: userid, rateid: rateid, evaluationid: evaluationid, cantidad: cantidad}, function(response) {

                        });
                    }
                });
            }


        }
    }




    function list_rating(rateid) {
        $('#ratingtable' + rateid + '').dataTable({
            "order": [0, 'asc'],
            "responsive": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "info": false,
            "dom": '<"#newssp"<><l><f>>tip',
            "destroy": true,
            "sAjaxSource": "<?php echo Yii::app()->createUrl('portoprint/rate/getrating'); ?>" + "/rateid/" + rateid,
            "aoColumns": [
                {"mData": "id", sDefaultContent: "", "sWidth": "10%"},
                {"mData": "fc", sDefaultContent: "", "sWidth": "30%"},
                {"mData": "pr", sDefaultContent: "", "sWidth": "30%"},
                {"mData": "ca", sDefaultContent: "", "sWidth": "30%"}
            ],
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
    function pintartabla(idtbl) {
        oTable_<?php echo $model->rateid ?> = $('#ratingtable' + idtbl + '').dataTable({
            "order": [0, 'asc'],
            "responsive": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "info": false,
            "dom": '<"#newssp"<><l><f>>tip',
            "oLanguage": {
                "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
                "sEmptyTable": "No hay registros.",
                "sInfoEmpty": "No hay registros.",
                "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
                "sProcessing": "Procesando",
                "sSearch": "Buscar:",
                "sZeroRecords": "No hay registros"
            }
        });
    }
    function promedio(id) {
        var calificaciones = 0;
        var promedio = 0;
        $(".rdo" + id + "").each(function() {
            if ($(this).is(':checked')) {
                calificaciones += parseInt($(this).val());
            }
        });
        promedio = (calificaciones / 12).toFixed(2);
        $("#spromedio" + id + "").html(promedio);
        if (promedio < 2) {
            $("#spromedio" + id + "").css('color', '#FF0000');
        }
        if (promedio >= 2 && promedio < 3) {
            $("#spromedio" + id + "").css('color', '#FF9900');
        }
        if (promedio >= 3 && promedio <= 5) {
            $("#spromedio" + id + "").css('color', '#009900');
        }
        $("#spromedio" + id + "").css('font-weight', 'bold');
    }



    $(document).ready(function() {
        
        var cants=new Array();
     var cants1=0;
     var cants2=0;
     var cants3=0;
     var cants4=0;
     var cants5=0;
     var cants6=0;
     var ppts=new Array();
     var ppts1=0;
     var ppts2=0;
     var ppts3=0;
     var ppts4=0;
     var ppts5=0;
     var ppts6=0;
     var results=new Array();
     var results1=new Array();
      <?php $mins = Ratesupplier::model()->getmins($model->rateid);  ?> 
     var mins1='<?php echo $mins[0]['quantity_1']; ?>';
     var mins2='<?php echo $mins[0]['quantity_2']; ?>';
     var mins3='<?php echo $mins[0]['quantity_3']; ?>';
     var mins4='<?php echo $mins[0]['quantity_4']; ?>';
     var mins5='<?php echo $mins[0]['quantity_5']; ?>';
     var mins6='<?php echo $mins[0]['quantity_6']; ?>';
     var mins_1=0;
     var mins_2=0;
     var mins_3=0;
     var mins_4=0;
     var mins_5=0;
     var mins_6=0;
     var svpep=new Array();
     var svpep1=new Array();
     var svtotal=new Array();
     var svtotal1=new Array();
     var svppt=new Array();
     var svppt1=new Array();
     var svex=new Array();
     var svex1=new Array();
     var ppt=new Array();
     var ppt1=new Array();
     var formuls=0;
     var percent=new Array(); 
    if('<?php echo $customerid; ?>'=='9'){
         formuls="0.93"; 
     }else{
         formuls="0.90";
     }
    var supplierslist=new Array();
 
            
     /***************************************   OBTIENE LAS CANTIDADES Y CALCULA EL PORCENTAJE DE CADA CANTIDAD  *********/

       $('#ratecalculatetable_<?php echo $model->rateid ?> .list-suppliers').each(function() {
            
            var id = $(this).attr('id');
            var divi=id.split('_');     
            var percent_=$("#percent_"+divi[1]).val(); 
            var post=supplierslist.indexOf(divi[1]);
                if(post==-1){
                    supplierslist.push(divi[1]);
                    percent.push(percent_);
                } 
              
           
              if( $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#show_'+divi[1]).is(':checked')){
                 
                    for(x=1;x<=6;x++){
                        var valor = $('#ratecalculatetable_<?php echo $model->rateid ?>').find("#quantity_"+x+"-"+divi[1]).val();
                          
                                if(percent_=='0.00'){
                                 
                                    if(valor=='0.00'){
                                      eval('cants'+x+'= 0');
                                      var calculo='0'; 
                                    }else{  
                                        
                                        var calculo=valor;
                                        eval('cants'+x+' = valor');
                                       
                                    }
                                }else{
                                    
                                    if(valor=='0.00'){
                                      eval('cants'+x+'= 0');
                                      var calculo='0'; 
                                    }else{  
                                       var calculo=parseFloat(((percent_*valor)/100).toFixed(3))+parseFloat(valor);
                                        eval('cants'+x+' = valor');
                                       
                                    }

                                }   

                                 eval('ppts'+x+'= calculo');
                               $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#calculate_'+x+'-'+divi[1]).attr('value',calculo); 
                               $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#c_'+x+'-'+divi[1]).html(calculo); 
                          

                            if(x==6){
                                    cants.push([cants1,cants2,cants3,cants4,cants5,cants6]);
                                 
                                    ppts.push([ppts1,ppts2,ppts3,ppts4,ppts5,ppts6]); 
                          }
                    }    
                  
                    
               

            }else{
              for(x=1;x<=6;x++){
                    
                var valor = $('#ratecalculatetable_<?php echo $model->rateid ?>').find("#quantity_"+x+"-"+divi[1]).val();
                    if(percent_=='0.00'){
                        if(valor=='0.00'){ var calculo=0; }else{  var calculo=valor; }
                    }else{
                         var calculo=parseFloat(((percent_*valor)/100).toFixed(3))+parseFloat(valor);
                    }  
                
                   $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#calculate_'+x+'-'+divi[1]).attr('value',calculo); 
                   $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#c_'+x+'-'+divi[1]).html(calculo);
                   $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#c_'+x+'-'+divi[1]).addClass("notcalculate");
                
              }
            
            }
           
        });
        
        /********************** VALIDAR VALOR MINIMO DE LA COTIZACION ***////
         for(x=1;x<=6;x++){
            var acum = 0;
            var cont = 0;
            var prom = 0;
            var min = 0;
            var pp = 0;
            var save = 0;
            var smin = null;
           $('#ratecalculatetable_<?php echo $model->rateid ?> [id^="calculate_' + x + '-"]').each(function() {
                var supp = $(this).attr('title');
                $('#ratecalculatetable_<?php echo $model->rateid ?>  #c_' + x + '-' + supp).removeClass('notcalculate');
                $('#ratecalculatetable_<?php echo $model->rateid ?> #c_' + x + '-' + supp).removeClass('minorprice');

                if ($('#ratecalculatetable_<?php echo $model->rateid ?> #show_' + supp).is(':checked')) {

                    var val = Number($(this).val());

                    if (cont == 0) {
                        min = val;
                       eval('mins_'+x+' = val;') 
                        smin = supp;
                    }
                    if (val < min) {
                        min = val;
                        eval('mins_'+x+' = val;') 
                        if (val > 0)
                            smin = supp;
                    }
                    acum += val;
                    cont++;
                } else {
                    $('#ratecalculatetable_<?php echo $model->rateid ?> #c_' + x + '-' + supp).addClass('notcalculate');

                }


            });
          $('#ratecalculatetable_<?php echo $model->rateid ?> #c_' + x + '-' + smin).addClass('minorprice');
        }
        
        /********************************************* calculando el promedio General de los activos ********///
     
   <?php $cheext= Rate::model()->findByAttributes(array("rateid"=>$model->rateid)); 
  
    if($cheext->rateext==0){
    ?>
    
        svpep=new Array();
        svpep1=new Array();
        svtotal=new Array();
        svtotal1=new Array();
        svppt=new Array();
        svppt1=new Array();
        svex=new Array();
        svex1=new Array();
        ppt=new Array();
        ppt1=new Array();
        
        if(cants.length!=0){
            for(i=0;i<cants.length;i++){   
                 for(x=1;x<=6;x++){
                    if(typeof(results[x]) === "undefined"){
                            
                             results[x]=parseFloat(cants[i][x-1]);
                             results1[x]=parseFloat(ppts[i][x-1]);
                              
                        }else{

                            results[x]=results[x]+parseFloat(cants[i][x-1]);
                            results1[x]=results1[x]+parseFloat(ppts[i][x-1]);

                        }
                    }
                    if(i==cants.length-1){
                        for(y=1;y<=6;y++){
                                if(results[y]!=0){
                                    results[y]=results[y].toFixed(3)/cants.length;
                                    results[y]=results[y].toFixed(3);
                                     if(results[y]<=0.000){
                                                results[y]=0;
                                            }
                                    
                                     $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_pg_'+y).html(results[y]);
                                }else{
                                    results[y]=0;
                                     $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_pg_'+y).html(results[y]);
                                }

                               if(results1[y]!=0){
                                    results1[y]=results1[y].toFixed(3)/ppts.length;
                                    results1[y]=results1[y].toFixed(3);
                                    if(results1[y]<=0.000){
                                                results1[y]=0;
                                            }
                                    $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_cpg_'+y).html(results1[y]);
                                }else{
                                    results1[y]=0;
                                    $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_cpg_'+y).html(results1[y]);
                                }
                    }     
                  }
                      

              }
       

                               
                for(i=1;i<=6;i++){   
                           // console.log('');
                            eval("svpep["+i+"] = parseFloat((results["+i+"]-((results["+i+"]*formuls))).toFixed(3)) ;");   // AHORRO O Saving PEP Proveedores
                       
                            eval("svpep1["+i+"] = parseFloat((results1["+i+"]-((results1["+i+"]*formuls))).toFixed(3));");   // AHORRO O Saving PEP Portoprint
                            
                            eval("svtotal["+i+"] =(results["+i+"]-mins"+i+").toFixed(3);");
                         
                            eval("svtotal1["+i+"] =(results1["+i+"]-mins_"+i+").toFixed(3);");
                            
                            eval("svppt["+i+"] = results["+i+"]-((results["+i+"]*0.9));");   // Saving PPT 
                            eval("svppt1["+i+"] = results1["+i+"]-((results1["+i+"]*0.9));");   // Saving PPT 
                            eval("svex["+i+"] = (svtotal["+i+"]-svpep["+i+"]-svppt["+i+"]).toFixed(3);");   //Ahorro Extra
                            eval("svex1["+i+"] = (svtotal1["+i+"]-svpep1["+i+"]-svppt1["+i+"]).toFixed(3);");   //Ahorro Extra
                            eval("ppt["+i+"] = (results["+i+"]*formuls).toFixed(3);"); // Precio PortoPrint sin ahorro extra
                            eval("ppt1["+i+"] = (results1["+i+"]*formuls).toFixed(3);"); // Precio PortoPrint sin ahorro extra
                           
                           
                            if(svex[i]<=0.000){
                                svex[i]=0;
                            }
                            if(svex1[i]<=0.000){
                                svex1[i]=0;
                            }
                             if(ppt[i]<=0.000){
                                    ppt[i]=0;
                                }
                                if(ppt1[i]<=0.000){
                                    ppt1[i]=0;
                                }
                                
                                 $("#ppp_"+i+"_<?php echo $model->rateid ?>").attr('value',ppt1[i]);
                                $("#<?php echo $model->rateid ?>_pp_" + i).html(ppt[i]);
                                $("#<?php echo $model->rateid ?>_cpp_" + i).html(ppt1[i]);
                           
                            $("#<?php echo $model->rateid ?>_save_" + i).html(svpep[i]);
                            $("#<?php echo $model->rateid ?>_csave_" + i).html(svpep1[i]);
                            
                            $("#<?php echo $model->rateid ?>_xsave_" + i).html(svex[i]);
                            $("#<?php echo $model->rateid ?>_cxsave_" + i).html(svex1[i]);
                            

                  } 
              
              
          }else{
          for(x=1;x<=6;x++){
                $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_pg_'+x).html('0');
                $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_cpg_'+x).html('0');
                
            }
          
          } 
        
        
        
    <?php } else{?>
       
        svpep=new Array();
        svpep1=new Array();
        svtotal=new Array();
        svtotal1=new Array();
        svppt=new Array();
        svppt1=new Array();
        svex=new Array();
        svex1=new Array();
        ppt=new Array();
        ppt1=new Array();
       if(cants.length!=0){
            for(i=0;i<cants.length;i++){   
                 for(x=1;x<=6;x++){
                    if(typeof(results[x]) === "undefined"){
                            
                             results[x]=parseFloat(cants[i][x-1]);
                             results1[x]=parseFloat(ppts[i][x-1]);
                              
                        }else{

                            results[x]=results[x]+parseFloat(cants[i][x-1]);
                            results1[x]=results1[x]+parseFloat(ppts[i][x-1]);

                        }
                    }
                    if(i==cants.length-1){
                        for(y=1;y<=6;y++){
                                if(results[y]!=0){
                                    results[y]=results[y].toFixed(3)/cants.length;
                                     results[y]=results[y].toFixed(3);
                                     if(results[y]<=0.000){
                                                results[y]=0;
                                            }
                                             $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_pg_'+y).html(results[y]);
                                        }else{
                                            results[y]=0;
                                             $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_pg_'+y).html(results[y]);
                                        }

                               if(results1[y]!=0){
                                    results1[y]=results1[y].toFixed(3)/ppts.length;
                                    results1[y]=results1[y].toFixed(3);
                                     if(results1[y]<=0.000){
                                                results1[y]=0;
                                            }
                                    $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_cpg_'+y).html(results1[y]);
                                }else{
                                    results1[y]=0;
                                    $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_cpg_'+y).html(results1[y]);
                                }
                    }     
                  }
                      

              }

                               
                for(i=1;i<=6;i++){   
                           // console.log('');
                            eval("svpep["+i+"] = parseFloat((results["+i+"]-((results["+i+"]*formuls))).toFixed(3)) ;");   // AHORRO O Saving PEP Proveedores
                            eval("svpep1["+i+"] = parseFloat((results1["+i+"]-((results1["+i+"]*formuls))).toFixed(3));");   // AHORRO O Saving PEP Portoprint
                            eval("svtotal["+i+"] =(results["+i+"]-mins"+i+").toFixed(3);");
                            eval("svtotal1["+i+"] =(results1["+i+"]-mins_"+i+").toFixed(3);");
                            eval("svppt["+i+"] = results["+i+"]-((results["+i+"]*0.9));");   // Saving PPT 
                            eval("svppt1["+i+"] = results1["+i+"]-((results1["+i+"]*0.9));");   // Saving PPT 
                            eval("svex["+i+"] = (svtotal["+i+"]-svpep["+i+"]-svppt["+i+"]).toFixed(3);");   //Ahorro Extra
                            eval("svex1["+i+"] = (svtotal1["+i+"]-svpep1["+i+"]-svppt1["+i+"]).toFixed(3);");   //Ahorro Extra
                            eval("ppt["+i+"] = (results["+i+"]-svpep["+i+"]-(svex["+i+"]/2)).toFixed(3);"); // Precio Portoprint con Ahorro extra
                            eval("ppt1["+i+"] = (results1["+i+"]-svpep1["+i+"]-(svex["+i+"]/2)).toFixed(3);"); // Precio Portoprint con Ahorro extra 
                           
                            if(svex[i]<=0.000){
                                svex[i]=0;
                            }
                            if(svex1[i]<=0.000){
                                svex1[i]=0;
                            }
                             if(ppt[i]<=0.000){
                                    ppt[i]=0;
                                }
                                if(ppt1[i]<=0.000){
                                    ppt1[i]=0;
                                }
                                
                                 $("#ppp_"+i+"_<?php echo $model->rateid ?>").attr('value',ppt1[i]);
                                $("#<?php echo $model->rateid ?>_pp_" + i).html(ppt[i]);
                                $("#<?php echo $model->rateid ?>_cpp_" + i).html(ppt1[i]);
                           
                            $("#<?php echo $model->rateid ?>_save_" + i).html(svpep[i]);
                            $("#<?php echo $model->rateid ?>_csave_" + i).html(svpep1[i]);
                            
                            
                            $("#<?php echo $model->rateid ?>_xsave_" + i).html(svex[i]);
                            $("#<?php echo $model->rateid ?>_cxsave_" + i).html(svex1[i]);
                            

                  } 
              
              
          }else{
          for(x=1;x<=6;x++){
                $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_pg_'+x).html('0');
                $('#ratecalculatetable_<?php echo $model->rateid ?>').find('#<?php echo $model->rateid ?>_cpg_'+x).html('0');
                
            }
          
          } 
        
       
   <?php }?>  
        
        
        

        $("#quantity").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A
                            (e.keyCode == 65 && e.ctrlKey === true) ||
                            // Allow: home, end, left, right
                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
        var numero = 2;
        /*  $('#head_<?php echo$model->rateid; ?>').find('#status_<?php echo $model->rateid ?>').editable({
         url: '?r=portoprint/rate/statusproduction/id/<?php echo Utils::encrypt($odp->rateodpid, 'odp'); ?>',
         name: 'status_productiondsc',
         source: <?php echo json_encode($estatus) ?>,
         display: function(value, sourceData) {
         //display checklist as comma-separated values
         
         
         }
         });*/






        var items_<?php echo $model->rateid ?> = new vis.DataSet();
<?php for ($i = 0; $i < count($data); $i++) { ?>

            items_<?php echo $model->rateid ?>.add([{id: '<?php echo $data[$i]['id']; ?>', content: '<?php echo $data[$i]['content']; ?>', start: '<?php echo $data[$i]['start']; ?>'}]);
<?php } ?>

        var container_<?php echo $model->rateid ?> = document.getElementById('ratetimeline_<?php echo $model->rateid ?>');
<?php
$datet = $model->ratedate;
$nuevafecha = strtotime('-20 day', strtotime($datet));
$fechain = date('Y-m-j', $nuevafecha);

$date2 = $model->statustime;
$nuevafecha = strtotime('+20 day', strtotime($date2));
$fechafin = date('Y-m-j', $nuevafecha);
?>

        var options_<?php echo $model->rateid ?> = {
            orientation: 'top',
            height: '400px',
            moveable: false
        };
        var timeline_<?php echo $model->rateid ?> = new vis.Timeline(container_<?php echo $model->rateid ?>, items_<?php echo $model->rateid ?>, options_<?php echo $model->rateid ?>);
        $('#zoomIn_<?php echo $model->rateid ?>').click(function() {
            zoom(-0.2);
        });
        $('#zoomOut_<?php echo $model->rateid ?>').click(function() {
            zoom(0.2);
        });
        $('#moveLeft_<?php echo $model->rateid ?>').click(function() {
            move(0.2);
        });
        $('#moveRight_<?php echo $model->rateid ?>').click(function() {
            move(-0.2);
        });
        function move(percentage) {
            var range = timeline_<?php echo $model->rateid ?>.getWindow();
            var interval = range.end - range.start;
            timeline_<?php echo $model->rateid ?>.setWindow({
                start: range.start.valueOf() - interval * percentage,
                end: range.end.valueOf() - interval * percentage
            });
        }

        /**
         * Zoom the timeline a given percentage in or out
         * @param {Number} percentage   For example 0.1 (zoom out) or -0.1 (zoom in)
         */
        function zoom(percentage) {
            var range = timeline_<?php echo $model->rateid ?>.getWindow();
            var interval = range.end - range.start;
            timeline_<?php echo $model->rateid ?>.setWindow({
                start: range.start.valueOf() - interval * percentage,
                end: range.end.valueOf() + interval * percentage
            });
        }



        $("#facturacion_porto").validate({
            //debug:true,
            submitHandler: function(form) {
                var data = {};
                $(form).find('input').each(function(index, el) {
                    var id = el.id.split('.').pop();
                    data[id] = $(el).val();
                });
                $.ajax({
                    url: form.action,
                    type: 'POST',
                    dataType: 'json',
                    data: data
                })
                        .done(function(data) {

                            //window.reload;
                        });
                return false;
            },
            rules: {
                'ppp.pieces': {
                    required: true,
                    digits: true
                },
                'ppp.createdate': {
                    required: true,
                    date: true
                },
                'ppp.total': "required",
                'ppp.vendor': "required",
                //'ppp.GR': "required",
                'ppp.invoicenumber': "required",
                'ppp.amout': "required",
                'ppp.impuestoivatax': "required"
            },
            messages: {
                'ppp.pieces': 'Campo Requerido',
                'ppp.estimateddate': 'Campo Requerido',
                'ppp.realDate': 'Campo Requerido',
                'ppp.date_send_revision': 'Campo Requerido',
                'ppp.createdate': 'Campo Requerido',
                'ppp.vendor': "Campo Requerido",
                //'ppp.GR': "Campo Requerido",
                'ppp.invoicenumber': "Campo Requerido",
                'ppp.amout': "Campo Requerido",
                'ppp.impuestoivatax': "Campo Requerido"
            }
        });
        $("#facturacion_supplier").validate({
            //debug:true,
            submitHandler: function(form) {
                var data = {};
                $(form).find('input').each(function(index, el) {
                    var id = el.id.split('.').pop();
                    data[id] = $(el).val();
                });
                $.ajax({
                    url: form.action,
                    type: 'POST',
                    dataType: 'json',
                    data: data
                })
                        .done(function(data) {

                            //window.reload;
                        });
                return false;
            },
            rules: {
                'spp.pieces': {
                    required: true,
                    digits: true
                },
                'spp.createdate': {
                    required: true,
                    date: true
                },
                'spp.total': "required",
                'spp.vendor': "required",
                //'spp.GR': "required",
                'spp.invoicenumber': "required",
                'spp.amout': "required",
                'spp.impuestoivatax': "required"
            },
            messages: {
                'spp.pieces': 'Campo Requerido',
                'spp.estimateddate': 'Campo Requerido',
                'spp.realDate': 'Campo Requerido',
                'spp.date_send_revision': 'Campo Requerido',
                'spp.createdate': 'Campo Requerido',
                'spp.vendor': "Campo Requerido",
                //'spp.GR': "Campo Requerido",
                'spp.invoicenumber': "Campo Requerido",
                'spp.amout': "Campo Requerido",
                'spp.impuestoivatax': "Campo Requerido"
            }
        });
        $(".formrating").click(function() {
            $("#parent_rateid").val($(this).data('rateid'));
            $("#hiddenresto").val($(this).data('resto'));
            $("#hiddensupplierid").val($(this).data('supplier'));
            $("#hiddenbundleid").val($(this).data('bundle'));
            $("#hiddenuserid").val($(this).data('userid'));
            $("#quantity").attr('max', $(this).data('resto'));
        });
        
        
        
        
    });
</script>


