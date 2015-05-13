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
        $("#files_<?php echo $model->rateid ?> tbody").append('<tr><td>' + data.name + '</td><td>' + data.dateupload + '</td><td>' + data.path + '</td></tr>');
        fileDropzone.removeFile(file);
    });
</script>
<?php
$rs = Ratesupplier::model()->findByAttributes(array('rateid' => $model->rateid, 'statusid' => 11));
$sp = Supplier::model()->findByPk($rs->supplierid);
$conta_odp=0;
if ($model->odctime != null) {
       $conta_odp=$conta_odp+9;
       
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
        // Restamos porcentaje de un numero entero
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

 
if($odp!=null){
     $servicedsc=  Rate::model()->getserviceid($model->rateid);
    
     if($servicedsc=='PRINT'){
        
        $estatusdb = StatusProduction::model()->findAllByAttributes(array('status_productiontype' => 1, "active"=>1),array('order'=>'status_productionorder ASC'));
        $statuso= HistProduction::model()->gethistprod($model->rateid, 1 );
        
 
         if( $statuso=='0'){
            $date = date('Y-m-d H:i:s');
            $ratetracker = new Ratetracker();
            $ratetracker->rateid =$model->rateid;
            $ratetracker->statusid = 9;
            $ratetracker->ratefilter = '1';
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();

            $histo= new HistProduction();
            $histo->rateid=$model->rateid;
            $histo->type=1;
            $histo->status_productionid=9;
            $histo->ratetrackerid=$ratetracker->ratetrackerid;
            $histo->insert();
            $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$histo->status_productionid));

        }else{
            $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$statuso));
        }
           
      //  $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$statuso ));

       
        
           $listhistodp=  HistProduction::model()->gethistprod_all($model->rateid,1);
      $contarhis=count($listhistodp);
        $contahisfor=1;
        $bandera=0;
         foreach ($listhistodp as $value) {
                if($contahisfor==1){
                    $obj = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));   
                    $obj_odp1=$obj->status_productionorder;
                }

                $obj_odp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));   
                if($obj_odp->status_productionporcent=='C'|| $obj_odp->status_productionporcent=='0'){
                     $conta_odp=0;
                     $bandera=1;
                }

                if($contahisfor==$contarhis && $bandera==0){
                    $obj = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));   
                    $obj_odp2=$obj->status_productionorder;

                    if($obj_odp1!=$obj_odp2){
                            $obj_odp3 = StatusProduction::model()->getstatusprod_all($obj_odp1,$obj_odp2,1);
                            $conta_odp=$conta_odp+$obj_odp3;
                        }else{
                            $obj_odp3 = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));
                            $conta_odp=$conta_odp+$obj_odp3->status_productionporcent;
                        }
                }

                $contahisfor++;
               
            }
        
    }
    if($servicedsc=='DISPLAYS'){
       
        $estatusdb = StatusProduction::model()->findAllByAttributes(array('status_productiontype' => 3 , "active"=>1),array('order'=>'status_productionorder ASC'));
      // print_r($estatusdb);
        $statuso= HistProduction::model()->gethistprod($model->rateid,3);
        //echo $statuso;
         if( $statuso=='0'){
            $date = date('Y-m-d H:i:s');
            $ratetracker = new Ratetracker();
            $ratetracker->rateid =$model->rateid;
            $ratetracker->statusid = 111;
             $ratetracker->ratefilter = '1';
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();

            $histo= new HistProduction();
            $histo->rateid=$model->rateid;
            $histo->type=3;
            $histo->status_productionid=111;
            $histo->ratetrackerid=$ratetracker->ratetrackerid;
            $histo->insert();
            $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$histo->status_productionid));
         
        }else{
             $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$statuso));
        }
          
        //$statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$statuso ));


       
        $listhistodp=  HistProduction::model()->gethistprod_all($model->rateid,3);
        $contarhis=count($listhistodp);
        $contahisfor=1;
        $bandera=0;
       
            foreach ($listhistodp as $value) {
                if($contahisfor==1){
                    $obj = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));   
                    $obj_odp1=$obj->status_productionorder;
                }

                $obj_odp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));   
                if($obj_odp->status_productionporcent=='C'|| $obj_odp->status_productionporcent=='0'){
                     $conta_odp=0;
                     $bandera=1;
                }

                if($contahisfor==$contarhis && $bandera==0){
                    $obj = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));   
                    $obj_odp2=$obj->status_productionorder;

                    if($obj_odp1!=$obj_odp2){
                            $obj_odp3 = StatusProduction::model()->getstatusprod_all($obj_odp1,$obj_odp2,3);
                            $conta_odp=$conta_odp+$obj_odp3;
                        }else{
                            $obj_odp3 = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));
                            $conta_odp=$conta_odp+$obj_odp3->status_productionporcent;
                        }
                }

                $contahisfor++;
               
            }
       
        
        
        
    }
    if($servicedsc=='PROMOCIONALES'){
        $estatusdb = StatusProduction::model()->findAllByAttributes(array('status_productiontype' => 2, "active"=>1),array('order'=>'status_productionorder ASC'));
        $statuso= HistProduction::model()->gethistprod( $model->rateid,2);
         if( $statuso=='0'){
            $date = date('Y-m-d H:i:s');
            $ratetracker = new Ratetracker();
            $ratetracker->rateid =$model->rateid;
            $ratetracker->statusid = 60;
            $ratetracker->statusdate = $date;
            $ratetracker->ratefilter = '1';
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();

            $histo= new HistProduction();
            $histo->rateid=$model->rateid;
            $histo->type=2;
            $histo->status_productionid=60;
            $histo->ratetrackerid=$ratetracker->ratetrackerid;
            $histo->insert();
           $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$histo->status_productionid));
        }else{
             $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$statuso));
        }
         
       // $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$statuso, "active"=>1));
         $listhistodp=  HistProduction::model()->gethistprod_all($model->rateid,2);
        $contarhis=count($listhistodp);
        $contahisfor=1;
        $bandera=0;
         foreach ($listhistodp as $value) {
                if($contahisfor==1){
                    $obj = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));   
                    $obj_odp1=$obj->status_productionorder;
                }

                $obj_odp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));   
                if($obj_odp->status_productionporcent=='C'|| $obj_odp->status_productionporcent=='0'){
                     $conta_odp=0;
                     $bandera=1;
                }

                if($contahisfor==$contarhis && $bandera==0){
                    $obj = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));   
                    $obj_odp2=$obj->status_productionorder;

                    if($obj_odp1!=$obj_odp2){
                            $obj_odp3 = StatusProduction::model()->getstatusprod_all($obj_odp1,$obj_odp2,2);
                            $conta_odp=$conta_odp+$obj_odp3;
                        }else{
                            $obj_odp3 = StatusProduction::model()->findByAttributes(array('status_productionid'=>$value->status_productionid));
                            $conta_odp=$conta_odp+$obj_odp3->status_productionporcent;
                        }
                }

                $contahisfor++;
             
            }
        
    }
       
      
     
     
    
}
    


?>


<div class="jarviswidget jarviswidget-color-greenDark jarviswidget-sortable" id="wid-id-<?php echo $model->rateid ?>"  data-widget-colorbutton="true" data-widget-togglebutton="true" data-widget-editbutton="true" data-widget-deletebutton="true" data-widget-custombutton="true">
    <header>
        <span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2><strong><?php echo $model->idVersion() . "  " . $model->servicedsc ?></strong> </h2>				
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

<?php
$permiss = Permission::model()->findAllByAttributes(array('menuid' => $menu, 'permissiongroup' => 'Renegociacion'));
$listperm = Specialpermission::model()->findAllByAttributes(array('userid' => Yii::app()->user->userid, 'permissionid' => $permiss[0]['permissionid']));

if ($listperm[0]["active"] != 0) {
    ?>
                        <li>
                            <a href="#renegotiation_<?php echo $model->rateid ?>"  data-target="#renegotiation_<?php echo $model->rateid ?>"  data-toggle="modal">Renegociaci&oacute;n</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a  href="#ToDop_<?php echo $model->rateid ?>" data-target="#ToDop_<?php echo $model->rateid ?>" name="<?php echo $model->rateid ?>" onclick="fechadores_todo_cp(this.name)"  data-toggle="modal" >ToDo</a>
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
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <td style="width:50%">
                                <strong>Item:</strong> <?php echo RateController::getDetail($model->rateid, $model->servicedsc, $model->note, $model->idVersion()) ?><br>
                                <strong>Comprador:</strong> <?php echo $model->firstname ?><br>
                                <strong>Creación:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'full', 'full'); ?><br />
                                <strong>Finalizó:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->statustime, 'full', 'full'); ?>
                                 <?php if ($model->odctime != null) { ?>
                                     <br /><strong>ODC: </strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->odctime, 'full', 'full'); ?> <a href="?r=portoprint/pdf/odc/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>">Descargar</a>
                                <?php } if ($model->odptime != null) { ?>
                                    <br /><strong>ODP: </strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->odptime, 'full', 'full'); ?> <a onclick="cantidad_parcial_odp('<?php echo $model->rateid; ?>')" style="cursor:pointer;">Descargar</a>
                                    <?php } ?>
                                    
                            </td>
                            <td style="width:23%">
                                <?php  if ($model->odptime != null) { ?>
                                 <strong>Estatus producción: </strong>  <a <?php if($statusodp->status_productionporcent!='0'){?>href="#estatus_list_odp_<?php echo $model->rateid; ?>" onclick="cambiar_st_rate_('<?php echo $model->rateid; ?>','<?php echo $statusodp->status_productionid;?>')"  data-target="#estatus_list_odp_<?php echo $model->rateid; ?>"  data-toggle="modal" <?php } ?> id="status_odp_dsc_<?php echo $model->rateid ?>"    ><?php echo $statusodp->status_productiondsc;?></a>
                                    <br /><strong>Orden de Pago: </strong> <a href="?r=portoprint/pdf/odpd/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>" >Descargar</a>

                                <?php } ?>

                            </td>
                            <td style="width:27%">
                                 <div data-dimension="200" data-type="half" data-text="<?php echo $conta_odp; ?>%" data-info=" " data-width="30" data-fontsize="38" data-percent="<?php echo $conta_odp; ?>" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-fill="#ddd" id="pie_<?php echo$model->rateid; ?>" style="width: 130px; height: 130px; margin: 20px auto 0 auto;" >
                                 </div>
                               <script>
                                      <?php if($conta_odp){
                                          
                                        }
                                             
                                      ?>
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
                        <a href="#s2_<?php echo $model->rateid ?>" data-toggle="tab" <?php if ($lectura['Arte'] == 0) {
                echo 'disabled';
            } ?>>Arte</a>
                    </li>
                    <li>
                        <a href="#s3_<?php echo $model->rateid ?>" data-toggle="tab" <?php if ($lectura['Prueba_de_color'] == 0) {
                echo 'disabled';
            } ?>>Prueba de color</a>
                    </li>

                    <li>
                        <a href="#s4_<?php echo $model->rateid ?>" data-toggle="tab" <?php if ($lectura['Produccion'] == 0) {
                echo 'disabled';
            } ?>>Producción</a>
                    </li>

                    <li>
                        <a href="#s5_<?php echo $model->rateid ?>" data-toggle="tab" <?php if ($lectura['Prueba_Cero'] == 0) {
                echo 'disabled';
            } ?>>Prueba Cero</a>
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

                                    <th>Proveedor</th>

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
                    $acum_1 = 0;
                    $acum1 = 0;
                    $min_1 = array();
                    $min1 = array();
                    $acum_2 = 0;
                    $acum2 = 0;
                    $min_2 = array();
                    $min2 = array();
                    $acum_3 = 0;
                    $acum3 = 0;
                    $min_3 = array();
                    $min3 = array();
                    $acum_4 = 0;
                    $acum4 = 0;
                    $min_4 = array();
                    $min4 = array();
                    $acum_5 = 0;
                    $acum5 = 0;
                    $min_5 = array();
                    $min5 = array();
                    $acum_6 = 0;
                    $acum6 = 0;
                    $min_6 = array();
                    $min6 = array();
                    foreach ($ratesuppliers as $supplier) {
                        $pricefee_1 = number_format($supplier->quantity_1 * (1 + ($supplier->percent / 100)), 2, '.', '');
                        $pricefee_2 = number_format($supplier->quantity_2 * (1 + ($supplier->percent / 100)), 2, '.', '');
                        $pricefee_3 = number_format($supplier->quantity_3 * (1 + ($supplier->percent / 100)), 2, '.', '');
                        $pricefee_4 = number_format($supplier->quantity_4 * (1 + ($supplier->percent / 100)), 2, '.', '');
                        $pricefee_5 = number_format($supplier->quantity_5 * (1 + ($supplier->percent / 100)), 2, '.', '');
                        $pricefee_6 = number_format($supplier->quantity_6 * (1 + ($supplier->percent / 100)), 2, '.', '');

                        if ($supplier->statusid == 11 || $supplier->statusid == 12) {
                            $acum_1 += $pricefee_1;
                            $acum1 += $supplier->quantity_1;
                            array_push($min_1, $pricefee_1);
                            array_push($min1, $supplier->quantity_1);

                            $acum_2 += $pricefee_2;
                            $acum2 += $supplier->quantity_2;
                            array_push($min_2, $pricefee_2);
                            array_push($min2, $supplier->quantity_2);

                            $acum_3 += $pricefee_3;
                            $acum3 += $supplier->quantity_3;
                            array_push($min_3, $pricefee_3);
                            array_push($min3, $supplier->quantity_3);

                            $acum_4 += $pricefee_4;
                            $acum4 += $supplier->quantity_4;
                            array_push($min_4, $pricefee_4);
                            array_push($min4, $supplier->quantity_4);

                            $acum_5 += $pricefee_5;
                            $acum5 += $supplier->quantity_5;
                            array_push($min_5, $pricefee_5);
                            array_push($min5, $supplier->quantity_5);

                            $acum_6 += $pricefee_6;
                            $acum6 += $supplier->quantity_6;
                            array_push($min_6, $pricefee_6);
                            array_push($min6, $supplier->quantity_6);
                        }
                        ?>
                                    <tr <?php echo $supplier->selectedrow(); ?> >						

                                        <td id="ssd_<?php echo $supplier->ratesupplierid; ?>"><?php echo $supplier->supplierdsc; ?></td>

                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_1, $supplier->selectedcell()) ?>" ><span><?php if (Yii::app()->user->specialpermission == 1) {
                                    echo $pricefee_1;
                                } else {
                                    if ($pricefee_1 != '0.00') {
                                        echo RateController::getDaysDetails($supplier->ratesupplierid, $pricefee_1, "1");
                                    } else {
                                        echo $pricefee_1;
                                    }
                                } ?></span></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_2, $supplier->selectedcell()) ?>" ><span><?php if (Yii::app()->user->specialpermission == 1) {
                                    echo $pricefee_2;
                                } else {
                                    if ($pricefee_2 != '0.00') {
                                        echo RateController::getDaysDetails($supplier->ratesupplierid, $pricefee_2, "2");
                                    } else {
                                        echo $pricefee_2;
                                    }
                                } ?></span></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_3, $supplier->selectedcell()) ?>" ><span><?php if (Yii::app()->user->specialpermission == 1) {
                                    echo $pricefee_3;
                                } else {
                                    if ($pricefee_3 != '0.00') {
                                        echo RateController::getDaysDetails($supplier->ratesupplierid, $pricefee_3, "3");
                                    } else {
                                        echo $pricefee_3;
                                    }
                                } ?></span></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_4, $supplier->selectedcell()) ?>" ><span><?php if (Yii::app()->user->specialpermission == 1) {
                                    echo $pricefee_4;
                                } else {
                                    if ($pricefee_4 != '0.00') {
                                        echo RateController::getDaysDetails($supplier->ratesupplierid, $pricefee_4, "4");
                                    } else {
                                        echo $pricefee_4;
                                    }
                                } ?></span></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_5, $supplier->selectedcell()) ?>" ><span><?php if (Yii::app()->user->specialpermission == 1) {
                                    echo $pricefee_5;
                                } else {
                                    if ($pricefee_5 != '0.00') {
                                        echo RateController::getDaysDetails($supplier->ratesupplierid, $pricefee_5, "5");
                                    } else {
                                        echo $pricefee_5;
                                    }
                                } ?></span></td>
                                        <td style="text-align:right; <?php echo $model->quantityselectedcell($model->quantity_6, $supplier->selectedcell()) ?>" ><span><?php if (Yii::app()->user->specialpermission == 1) {
                                    echo $pricefee_6;
                                } else {
                                    if ($pricefee_6 != '0.00') {
                                        echo RateController::getDaysDetails($supplier->ratesupplierid, $pricefee_6, "6");
                                    } else {
                                        echo $pricefee_6;
                                    }
                                } ?></span></td>
                                    </tr>
                                    <?php
                                }
                                $formula = $model->formula;
                                $formula1 = str_ireplace('pp', '$pp', $formula);
                                $formula2 = str_ireplace('min', '$min', $formula1);
                                $formula3 = str_ireplace('prom', '$prom', $formula2);
                                $formula4 = str_ireplace('save', '$save', $formula3);

                                $min = min($min1);
                                $prom = $acum1 / (count($min1));
                                $sprm1 = $prom;
                                eval($formula4);
                                $spp1 = number_format($pp, 2, '.', '');
                                $ssave1 = number_format($save, 2, '.', '');

                                $min = min($min2);
                                $prom = $acum2 / (count($min2));
                                $sprm2 = $prom;
                                eval($formula4);
                                $spp2 = number_format($pp, 2, '.', '');
                                $ssave2 = number_format($save, 2, '.', '');

                                $min = min($min3);
                                $prom = $acum3 / (count($min3));
                                $sprm3 = $prom;
                                eval($formula4);
                                $spp3 = number_format($pp, 2, '.', '');
                                $ssave3 = number_format($save, 2, '.', '');

                                $min = min($min4);
                                $prom = $acum4 / (count($min4));
                                $sprm4 = $prom;
                                eval($formula4);
                                $spp4 = number_format($pp, 2, '.', '');
                                $ssave4 = number_format($save, 2, '.', '');

                                $min = min($min5);
                                $prom = $acum5 / (count($min5));
                                $sprm5 = $prom;
                                eval($formula4);
                                $spp5 = number_format($pp, 2, '.', '');
                                $ssave5 = number_format($save, 2, '.', '');

                                $min = min($min6);
                                $prom = $acum6 / (count($min6));
                                $sprm6 = $prom;
                                eval($formula4);
                                $spp6 = number_format($pp, 2, '.', '');
                                $ssave6 = number_format($save, 2, '.', '');

                                $min = min($min_1);
                                $prom = $acum_1 / (count($min_1));
                                $prm1 = $prom;
                                eval($formula4);
                                $pp1 = number_format($pp, 2, '.', '');
                                $save1 = number_format($save, 2, '.', '');

                                $min = min($min_2);
                                $prom = $acum_2 / (count($min_2));
                                $prm2 = $prom;
                                eval($formula4);
                                $pp2 = number_format($pp, 2, '.', '');
                                $save2 = number_format($save, 2, '.', '');

                                $min = min($min_3);
                                $prom = $acum_3 / (count($min_3));
                                $prm3 = $prom;
                                eval($formula4);
                                $pp3 = number_format($pp, 2, '.', '');
                                $save3 = number_format($save, 2, '.', '');

                                $min = min($min_4);
                                $prom = $acum_4 / (count($min_4));
                                $prm4 = $prom;
                                eval($formula4);
                                $pp4 = number_format($pp, 2, '.', '');
                                $save4 = number_format($save, 2, '.', '');

                                $min = min($min_5);
                                $prom = $acum_5 / (count($min_5));
                                $prm5 = $prom;
                                eval($formula4);
                                $pp5 = number_format($pp, 2, '.', '');
                                $save5 = number_format($save, 2, '.', '');

                                $min = min($min_6);
                                $prom = $acum_6 / (count($min_6));
                                $prm6 = $prom;
                                eval($formula4);
                                $pp6 = number_format($pp, 2, '.', '');
                                $save6 = number_format($save, 2, '.', '');
                                ?>


                                <tr>


                                    <td style=" border-top: 1px black solid;">Promedio General </td>

                                    <td style="text-align:right; border-top: 1px black solid;"  ><?php echo number_format($prm1, 2); ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"  ><?php echo number_format($prm2, 2); ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"  ><?php echo number_format($prm3, 2); ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"  ><?php echo number_format($prm4, 2); ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"  ><?php echo number_format($prm5, 2); ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"  ><?php echo number_format($prm6, 2); ?></td>

                                </tr>
                                <tr>

                                    <td style=" border-top: 1px black solid;">Precio Portoprint $</td>

                                    <td style="text-align:right; border-top: 1px black solid;"><?php echo $pp1; ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"><?php echo $pp2; ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"><?php echo $pp3; ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"><?php echo $pp4; ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"><?php echo $pp5; ?></td>
                                    <td style="text-align:right; border-top: 1px black solid;"><?php echo $pp6; ?></td>
                                </tr>
                                <tr >

                                    <td>Ahorro $</td>

                                    <td style="text-align:right"><?php echo $save1; ?></td>
                                    <td style="text-align:right"><?php echo $save2; ?></td>
                                    <td style="text-align:right"><?php echo $save3; ?></td>
                                    <td style="text-align:right"><?php echo $save4; ?></td>
                                    <td style="text-align:right"><?php echo $save5; ?></td>
                                    <td style="text-align:right"><?php echo $save6; ?></td>

                                </tr>
                                <?php
                                    $ahorroextra = Ratesupplier::model()->getdata($model->rateid);
                                    $customerid = Rate::model()->getcustomerid($model->rateid);
                                    //obtener porcentaje
                                       switch ($customerid) {
                                           case 12:
                                               $xt=0.93;
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
                                    
                                    $pro_1 = $sum_1/(count($ahorroextra));
                                    $pro_2 = $sum_2/(count($ahorroextra));
                                    $pro_3 = $sum_3/(count($ahorroextra));
                                    $pro_4 = $sum_4/(count($ahorroextra));
                                    $pro_5 = $sum_5/(count($ahorroextra));
                                    $pro_6 = $sum_6/(count($ahorroextra));
                                    
                                    $pr_1 = $zum_1/(count($ahorroextra));
                                    $pr_2 = $zum_2/(count($ahorroextra));
                                    $pr_3 = $zum_3/(count($ahorroextra));
                                    $pr_4 = $zum_4/(count($ahorroextra));
                                    $pr_5 = $zum_5/(count($ahorroextra));
                                    $pr_6 = $zum_6/(count($ahorroextra));
                                    
                                    ?>
                                    <tr >
                                        
                                        <td>Ahorro Extra $</td>
                                       
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_1" ><?php echo number_format($pr_1-($pr_1*$xt), 2, '.', '') ?></td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_2" ><?php echo number_format($pr_2-($pr_2*$xt), 2, '.', '') ?></td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_3" ><?php echo number_format($pr_3-($pr_3*$xt), 2, '.', '') ?></td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_4" ><?php echo number_format($pr_4-($pr_4*$xt), 2, '.', '') ?></td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_5" ><?php echo number_format($pr_5-($pr_5*$xt), 2, '.', '') ?></td>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_6" ><?php echo number_format($pr_6-($pr_6*$xt), 2, '.', '') ?></td>
                                     
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
                        $activdad = Ratetracker::model()->activitybyrate($model->rateid,"");
                        
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
                                                <td><input type="checkbox" class="ratetracker_'.$model->rateid.'" data-tracker="' . $row->ratetrackerid . '" checked></td>
                                                <td>' . $row->statusdate . '</td>
                                                <td>' . $row->statusdsc . '</td>
                                                <td>' . $row->responsable . '</td>
                                                </tr>';
                                                if ($row->statusid == 100) {
                                                    $activity = Ratesupplier::model()->activitybyrate($model->rateid, "");
                                                    foreach ($activity as $row) {
                                                            echo '<tr>
                                                            <td><input type="checkbox" class="ratesupplier_'.$model->rateid.'" data-tracker="' . $row->ratesupplierid . '" checked></td>
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
                                    $('.pdf_activity_<?php echo $model->rateid ?>').click(function() {
                                            var rateid = $(this).data('rate');
                                                    var tracker = "";
                                                    var ratesupplier = "";
                                                    $(".ratetracker_<?php echo $model->rateid ?>").each(function() {
                                            if ($(this).is(':checked')){
                                            tracker += (tracker === "")?$(this).data('tracker'):',' + $(this).data('tracker');
                                            }
                                            });
                                                    $(".ratesupplier_<?php echo $model->rateid ?>").each(function(){
                                            if ($(this).is(':checked')){
                                            ratesupplier += (ratesupplier === "")?$(this).data('tracker'):',' + $(this).data('tracker');
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
                                "order": [[ 1, "asc" ]],
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
                                $("#ratingtable<?php echo $model->rateid ?>").find("td").css("cursor", "pointer");
                            </script>


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

                    <!-- <div class="modal-footer">
                                         <a class="btn btn-primary" href="?r=portoprint/pdf/report/id/<?php echo Utils::encrypt($bundleid, 'rate'); ?>/rateid/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>">
                                                 Descargar Reporte
                                              
                                         </a>
                                 </div>-->

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
                                    <th><input type="number" id="quantity" min="1" max="5" style="width: 10%;" pattern="[0-9]*"></th>
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

<div class="modal fade" id="ToDop_<?php echo $model->rateid ?>" tabindex="-1" role="dialog" aria-labelledby="ToDo_<?php echo $model->rateid ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agregar ToDo</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="#" id="ntcpToDos_<?php echo $model->rateid ?>" novalidate="novalidate" class="smart-form">	
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

                                        <select  id="NT_areaid_sel" onchange="selector_personal_cp(this.value, '<?php echo $model->rateid ?>')" style=" width: 165px;"></select>

                                    </td>
                                </tr>
                                <tr>
                                    <td ><label for="NTproject">Personal</label></td>
                                    <td  id="NT_userareaidtd">

                                        <select  id="NT_userareaid_sel"  style=" width: 165px;">
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
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject" type="button" onclick="save_todo_cot_cp('<?php echo $model->rateid ?>')" >Aceptar</button>
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
                                        <select id="estatus_selfor" name="estatus_selfor" onchange="actualizar_estatus_prod(this.value,'<?php echo $model->rateid; ?>')" >
                                                <?php  foreach ($estatusdb as $row) {
                                                    
                                                                if($statuso->status_productionid ==$row->status_productionid){
                                                                    echo "<option value='{$row->status_productionid}' selected='selected'>{$row->status_productiondsc}</option>";
                                                                }else{
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
                        <a class="btn btn-default"  onclick="save_parcial_odp('<?php echo $model->rateid; ?>','<?php echo Utils::encrypt($model->rateid, 'rate'); ?>','<?php echo Utils::encrypt($bundleid, 'rate'); ?>')" >Descargar</a>
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
    $data[] = array("id" => $cont++, "content" => $event->status->statusdsc . "<br />" . Yii::app()->dateFormatter->formatDateTime($event->statusdate, 'short', 'short'), "start" => $event->statusdate);
}
?>

<script>
            
        $("#fodcc_<?php echo $model->rateid; ?>").datepicker({
                                dateFormat : 'yy-mm-dd'

                        });


    var ban_tab = 0;

    function list_rating(rateid) {
        $('#ratingtable' + rateid + '').dataTable({
            "responsive": true,
            "sAjaxSource": "<?php echo Yii::app()->createUrl('rate/getrating'); ?>" + "/rateid/" + rateid,
            "aoColumns": [
                {"mData": "id", sDefaultContent: "", "sWidth": "10%"},
                {"mData": "fc", sDefaultContent: "", "bSearchable": false, "sWidth": "30%", "sClass": "alignRight"},
                {"mData": "pr", sDefaultContent: "", "sWidth": "30%", "sClass": "alignRight"},
                {"mData": "ca", sDefaultContent: "", "bSearchable": false, "sWidth": "30%", "sClass": "alignRight"}
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

    $(document).ready(function() {
    

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
            start: ' <?php echo $fechain; ?>',
            end: '<?php echo $fechafin; ?>',
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
                            console.log(data);
                            //window.reload;
                        });

                return false;
            },
            rules: {
                'ppp.pieces': {
                    required: true,
                    digits: true
                },
                /*'ppp.estimateddate':{
                 required: true,
                 date: true
                 },
                 'ppp.realDate':{
                 required: true,
                 date: true
                 },
                 'ppp.date_send_revision':{
                 required: true,
                 date: true
                 },*/
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
                            console.log(data);
                            //window.reload;
                        });

                return false;
            },
            rules: {
                'spp.pieces': {
                    required: true,
                    digits: true
                },
                /*'spp.estimateddate':{
                 required: true,
                 date: true
                 },
                 'spp.realDate':{
                 required: true,
                 date: true
                 },
                 'spp.date_send_revision':{
                 required: true,
                 date: true
                 },*/
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

    function pintartabla(idtbl) {
        $('#ratingtable' + idtbl + '').dataTable({
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

                // console.log(rateid+'-'+supplierid+'-'+bundleid+'-'+userid+'-'+cantidad+'-'+promedio);

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
                        $('#ratingtable' + rateid + ' tr:last').after(res[0]);
                        $(".rdo" + rateid + "").each(function() {
                            $(this).prop('checked', false);
                        });
                        $("#quantity").val('');
                        $("#spromedio" + rateid + "").html('');
                        var pendientes = $("#pendientes" + rateid + "").html() - cantidad;

                        $("#pendientes" + rateid + "").html(pendientes);


                        //Enviar mail
                        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/sendrating') ?>', {bundleid: bundleid, userid: userid, rateid: rateid, evaluationid: evaluationid, cantidad: cantidad}, function(response) {
                            console.log(response);
                        });


                    }
                });

            }


        }
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
</script>


