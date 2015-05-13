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
    var fileDropzone = new Dropzone("#sfdzone_<?php echo $model->rateid ?>", {
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
<div class="jarviswidget jarviswidget-sortable" id="wid-id-<?php echo $model->rateid ?>"  data-widget-colorbutton="true" data-widget-togglebutton="true" data-widget-editbutton="true" data-widget-deletebutton="true" data-widget-custombutton="true">
    <header>
        <span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2><strong><?php echo $model->rateid . "  " . $model->servicedsc ?></strong> </h2>				
        <div class="widget-toolbar">
            
            <div class="btn-group">
                <button class="btn dropdown-toggle btn-warning" data-toggle="dropdown">
                    Acción <i class="fa fa-caret-down"></i>
                </button>
                <ul class="dropdown-menu pull-right">
                    <?php if ($model->complete == 0) { ?>
                       <!-- <li>
                            <a href="#newpricemanualModal<?php echo $model->rateid ?>" data-target="#newpricemanualModal<?php echo $model->rateid ?>"  data-toggle="modal">Precio Manual</a>
                        </li>-->
                        <li>
                            <a href="#extendrate<?php echo $model->rateid ?>" data-target="#extendrate<?php echo $model->rateid ?>"  data-toggle="modal">Extender Evento</a>
                        </li>

                     <!--   <li>
                            <a href="#addpdf<?php echo $model->rateid ?>" data-target="#addpdf<?php echo $model->rateid ?>"  data-toggle="modal">Agregar al resumen</a>
                        </li> -->
                        <li>
                            <a  href="#ToDosp_<?php echo $model->rateid ?>" data-target="#ToDosp_<?php echo $model->rateid ?>" name="<?php echo $model->rateid ?>" data-toggle="modal" onclick="fechadores_todosp(this.name)" >ToDo</a>
                        </li>


                    <?php } else { ?>
                      <!--  <li>
                            <a href="#delpdf<?php echo $model->rateid ?>" data-target="#delpdf<?php echo $model->rateid ?>"  data-toggle="modal">Remover del resumen</a>
                        </li>
                        <li class="divider"></li> -->

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
                            <a  href="#ToDosp_<?php echo $model->rateid ?>" data-target="#ToDosp_<?php echo $model->rateid ?>" name="<?php echo $model->rateid ?>" onclick="fechadores_todosp(this.name)"  data-toggle="modal" >ToDo</a>
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
                                <strong>Item:</strong> <?php echo RateController::getDetail($model->rateid, $model->servicedsc, $model->note, $model->rateid) ?><br>
                                <strong>Comprador:</strong> <?php echo $model->firstname ?><br>
                                <strong>Creación:</strong> <?php
                                $datet = '';
                                echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'full', 'full');
                                $datet = $model->ratedate;
                                ?><br>										

                                <?php
                                $date2 = "";
                                if ($model->statusid == 2 || $model->statusid == 4) {
                                    ?>
                                    <strong>Finaliza:</strong> <?php
                                    echo Yii::app()->dateFormatter->formatDateTime($model->finalize, 'full', 'full');
                                    $date2 = $model->finalize;
                                    ?>
                                <?php } else { ?>
                                    <strong>Finalizó:</strong> <?php
                                    echo Yii::app()->dateFormatter->formatDateTime($model->statustime, 'full', 'full');
                                    $date2 = $model->statustime;
                                    ?>

                                <?php } ?>
                                <br>
                            </td>
                            <td>
                                <strong>Estatus:</strong> <?php echo $model->statusdsc; ?><br>

                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div style="margin-top:10px;">
                <ul id="myTab_<?php echo $model->rateid ?>" class="nav nav-tabs">
                    <li class="active">
                        <a href="#s1_<?php echo $model->rateid ?>" data-toggle="tab">Calculadora de precios</a>
                    </li>
                    <!--                    <li>
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
                                <a href="#s7_<?php echo $model->rateid ?>" onclick="recharlist_file_<?php echo $model->rateid ?>()" data-toggle="tab">Archivos</a>
                            </li>
                            <li>
                                <a href="#s8_<?php echo $model->rateid ?>" data-toggle="tab">TimeLine</a>
                            </li>
                            <li>
                                <a href="#s9<?php echo $model->rateid ?>" data-toggle="tab">Tracker</a>
                            </li>
                        </ul>
                    </li>

                </ul>

                <div id="myTabContent_<?php echo $model->rateid ?>" class="tab-content">
                    <div class="tab-pane fade in active" id="s1_<?php echo $model->rateid ?>">

                        <form method="post" action="?r=portoprint/rate/saveprice/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>" id="<?php echo 'rateprice-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
                            <table id="ratecalculatetable_<?php echo $model->rateid ?>" title="<?php echo $model->rateid ?>" class="table table-condensed">
                                <thead>
                                    <tr>

                                        <th>Proveedor</th>

                                        <th width="80" style="text-align:right">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_1; ?>" <?php echo $model->quantityselected($model->quantity_1); ?> />
                                                    <span><br /><?php echo $model->quantity_1; ?></span> 
                                                </label>
                                            </div>												
                                        </th>
                                        <th width="80" style="text-align:right">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_2; ?>" <?php echo $model->quantityselected($model->quantity_2); ?> />
                                                    <span><br /><?php echo $model->quantity_2; ?></span> 
                                                </label>
                                            </div>		
                                        </th>											
                                        <th width="80" style="text-align:right">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_3; ?>" <?php echo $model->quantityselected($model->quantity_3); ?> />
                                                    <span><br /><?php echo $model->quantity_3; ?></span> 
                                                </label>
                                            </div>	
                                        </th>
                                        <th width="80" style="text-align:right">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_4; ?>" <?php echo $model->quantityselected($model->quantity_4); ?> />
                                                    <span><br /><?php echo $model->quantity_4; ?></span> 
                                                </label>
                                            </div>	
                                        </th>
                                        <th width="80" style="text-align:right">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_5; ?>" <?php echo $model->quantityselected($model->quantity_5); ?> />
                                                    <span><br /><?php echo $model->quantity_5; ?></span> 
                                                </label>
                                            </div>	
                                        </th>
                                        <th width="80" style="text-align:right">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_6; ?>" <?php echo $model->quantityselected($model->quantity_6); ?> />
                                                    <span><br /><?php echo $model->quantity_6; ?></span> 
                                                </label>
                                            </div>	
                                        </th>

                                </tr>
                                </thead>
                                <tbody>		
                                    <?php 
                                         $promeds=array();
                                         $cants=array();
                                         $results=array();
                                         $prome=array();
                                         $ppt=array();
                                         $svpep=array();
                                         $svppt=array();
                                         $svtotal=array();
                                         $svex=array();
                                         $mins=  Ratesupplier::model()->getmins($model->rateid); 
                                        if($customerid==9){
                                             $formuls="0.93"; 
                                         }else{
                                             $formuls="0.90";
                                         }
                                     
                                         
                                       foreach ($ratesuppliers as $supplier) { ?>
                                        <tr id="trowid_<?php echo $supplier->ratesupplierid; ?>">						
                                          <td id="ssd_<?php echo $supplier->ratesupplierid; ?>"><?php echo $supplier->supplierdsc; ?></td>
                                            
                                            <?php 
                                              if($model->complete!=0){
                                                    if($supplier->showtable==1){
                                                         if($supplier->quantity_1!=''){
                                                             $cants[1]=$supplier->quantity_1;
                                                           
                                                         }else{
                                                                 $cants[1]=0;
                                                         }
                                                        if($supplier->quantity_2!=''){
                                                             $cants[2]=$supplier->quantity_2;
                                                            
                                                         }else{
                                                                 $cants[2]=0;
                                                         }
                                                         if($supplier->quantity_3!=''){
                                                             $cants[3]=$supplier->quantity_3;
                                                               
                                                         }else{
                                                                 $cants[3]=0;
                                                         }
                                                         if($supplier->quantity_4!=''){
                                                             $cants[4]=$supplier->quantity_4;
                                                           
                                                         }else{
                                                                 $cants[4]=0;
                                                         }
                                                         if($supplier->quantity_5!=''){
                                                             $cants[5]=$supplier->quantity_5;
                                                             
                                                         }else{
                                                                 $cants[5]=0;
                                                         }
                                                         if($supplier->quantity_6!=''){
                                                             $cants[6]=$supplier->quantity_6;
                                                            
                                                         }else{
                                                                 $cants[6]=0;
                                                         }
                                                    }else{
                                                        $cants[1]=0;
                                                        $cants[2]=0;
                                                        $cants[3]=0;
                                                        $cants[4]=0;
                                                        $cants[5]=0;
                                                        $cants[6]=0;
                                                    }
                                                    $percent=$supplier->percent/100; 

                                                      if($percent!=0){
                                                     
                                                        for($i=0;$i<6;$i++){   
                                                            $results[$i]=$cants[$i]*$percent;
                                                            $prome[$i]=$prome[$i]+ $results[$i];
                                                            eval("\$promeds[\$i] = \$prome[\$i]/count(\$ratesuppliers);");
                                                             
                                                         }   
                                                    
                                                     

                                                    }else{
                                                        for($i=1;$i<=6;$i++){   

                                                          $results[$i]=$cants[$i];
                                                          $prome[$i]=$prome[$i]+ $results[$i];
                                                            eval("\$promeds[\$i] = \$prome[\$i]/count(\$ratesuppliers);");
                                                        
                                                        }   
                                                       
                                                    
                                                   }
                                                  
                                              }else{
                                                  $results[1]=0;
                                                  $results[2]=0;
                                                  $results[3]=0;
                                                  $results[4]=0;
                                                  $results[5]=0;
                                                  $results[6]=0;
                                              }
                                                
                                            ?> 
                                          
                                          <?php for($i=1;$i<=6;$i++){  ?>
                                          <td style="text-align:right" ><input type="hidden" value="<?php echo $results[$i]; ?>" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_1_<?php echo $supplier->ratesupplierid; ?>"><span id="c_1_<?php echo $supplier->ratesupplierid; ?>" ><?php echo  $results[$i]; ?></span></td> 
                                              <?php }?>
                                           

                                        </tr>
                                    <?php } ?>
                                        
                                        <?php 
                                        if($percent!=0){
                                                     
                                            /*
                                                $promeds = es la variable donde se almacena el primedio general
                                             *  $svpep = variable que almacena el ahorro 7% del cliente, (ahorro)!
                                             *  $svtotal= vaiable que almacena el saving total
                                             *  $svppt = variable que almacena el ahorro de portoprint 10%
                                             *  $ppt = precio portoprint
                                             *  $svex = ahorro extra
                                             * \$promeds[\$i] = \$prome[\$i]/count(\$ratesuppliers);'
                                             *                                              */
                                            
                                                for($i=0;$i<6;$i++){   
                                                            
                                                            eval("\$svpep[\$i] = \$promeds[\$i]-((\$promeds[\$i]*\$formuls));");   // AHORRO O Saving PEP
                                                            eval("\$svtotal[\$i] =\$promeds[\$i]-\$mins[0]['quantity_'.\$i];");  //SAVING TOTAL
                                                            eval("\$svppt[\$i] = \$promeds[\$i]-((\$promeds[\$i]*0.9));");   // Saving PPT 
                                                            eval("\$svex[\$i] = \$svtotal[\$i]-\$svpep[\$i]-\$svppt[\$i];");   //Ahorro Extra
                                                            eval("\$ppt[\$i] = \$promeds[\$i]*\$formuls;"); // Precio PortoPrint sin ahorro extra
                                                          //  eval("\$ppt[\$i] = \$promeds[\$i]-\$svpep[\$i]-(\$svex[\$i]/2);"); // Precio Portoprint con Ahorro extra
                                                            
                                                            if($svex[$i]<0){
                                                                $svex[$i]=0;
                                                            }
                                                            
                                                         }   
                                                    
                                                    }else{
                                                        for($i=1;$i<=6;$i++){   

                                                        
                                                            eval("\$svpep[\$i] = \$promeds[\$i]-((\$promeds[\$i]*\$formuls));");   // AHORRO 
                                                            eval("\$svtotal[\$i] =\$promeds[\$i]-\$mins[0]['quantity_'.\$i];");  //SAVING TOTAL
                                                            eval("\$svppt[\$i] = \$promeds[\$i]-((\$promeds[\$i]*0.9));");   //Saving PPT 
                                                            eval("\$svex[\$i] = \$svtotal[\$i]-\$svpep[\$i]-\$svppt[\$i];");   //Ahorro Extra
                                                            eval("\$ppt[\$i] = \$promeds[\$i]*\$formuls;"); // Precio PortoPrint
                                                   //         eval("\$ppt[\$i] = \$promeds[\$i]-\$svpep[\$i]-(\$svex[\$i]/2);"); // Precio Portoprint con Ahorro extra
                                                           
                                                            if($svex[$i]<0){
                                                                $svex[$i]=0;
                                                            }
                                                            
                                                        
                                                        }   
                                                       
                                                    
                                                   }
                                        
                                        ?>
                                        
                                    <tr>
                                        <td colspan="7" >&nbsp;
                                            <input type="hidden" name="ppp[1]" id="ppp_1_<?php echo $model->rateid ?>" />
                                            <input type="hidden" name="ppp[2]" id="ppp_2_<?php echo $model->rateid ?>" />
                                            <input type="hidden" name="ppp[3]" id="ppp_3_<?php echo $model->rateid ?>" />
                                            <input type="hidden" name="ppp[4]" id="ppp_4_<?php echo $model->rateid ?>" />
                                            <input type="hidden" name="ppp[5]" id="ppp_5_<?php echo $model->rateid ?>" />
                                            <input type="hidden" name="ppp[6]" id="ppp_6_<?php echo $model->rateid ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style=" border-top: 1px black solid;" >Promedio General</td>
                                        <?php for($i=1;$i<=6;$i++){  ?>
                                        <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpg_<?php echo $i; ?>" ><?php echo round($promeds[$i],3); ?></td>
                                        <?php }?>
                                       

                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px black solid;">Precio Portoprint $</td>
                                       <?php for($i=1;$i<=6;$i++){  ?>
                                                <td style="text-align:right; border-top: 1px black solid;" id="<?php echo $model->rateid ?>_cpp_<?php echo $i; ?>" ><?php echo round($ppt[$i],3); ?> </td> 
                                            <?php }?>
                                        

                                    </tr>
                                    <tr >
                                        <td>Ahorro $</td>
                                         <?php for($i=1;$i<=6;$i++){  ?>
                                                <td style="text-align:right" id="<?php echo $model->rateid ?>_csave_<?php echo $i; ?>" ><?php echo round($svpep[$i],3); ?></td>
                                          <?php }?>
                                       

                                    </tr>
                                    <?php
                                  /*  $ahorroextra = Ratesupplier::model()->getdata($model->rateid);
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
                                    $pr_6 = $zum_6 / (count($ahorroextra)); */
                                    ?>
                                    <tr >
                                        <td>Ahorro Extra $</td>
                                        <?php for($i=1;$i<=6;$i++){  ?>
                                        <td style="text-align:right" id="<?php echo $model->rateid ?>_cxsave_<?php echo $i; ?>" ><?php  echo round($svex[$i],3); ?></td>
                                          <?php }?>
                                      

                                    </tr>


                                    <tr ><td colspan="7">&nbsp;</td></tr>		
                                </tbody>	
                            </table>
                        </form>	

                    </div>


                    <div class="tab-pane fade" id="s7_<?php echo $model->rateid ?>">
                        <form  class="smart-form" >
                            <header><strong>Archivos</strong></header>
                            <fieldset>


                                <table id="files_<?php echo $model->rateid ?>" class="table table-bordered" style="font-size: 10px;" >
                                    <thead>
                                        <tr>
                                            <th style="width:30%">Nombre</th>
                                            <th style="width:20%">Fecha de subida</th>
                                            <th style="width:50%">Url</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>   </fieldset>
                        </form>										
                        <form action="index.php?r=portoprint/upload/savefile/id/<?php echo Utils::encrypt($model->bundleid, 'document'); ?>/rate/<?php echo Utils::encrypt($model->rateid, 'document'); ?>" class="dropzone smart-form" id="sfdzone_<?php echo $model->rateid ?>" style="border-color:#FF0000;"></form>

                    </div>
                    <div class="tab-pane fade" id="s8_<?php echo $model->rateid ?>">
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
                </div>

            </div>	

        </div>
    </div>
</div>	



<div class="modal fade" id="newpricemanualModal<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="newpricemanualModal<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="newpricemanualModal<?php echo $model->rateid; ?>">Ingresar precio manual</h4>
            </div>
            <div class="modal-body no-padding">
                <?php
                $suppliersservice = CHtml::listData(Supplierservice::model()->getSupplierbyRateServiceid($entryid, $model->rateid), 'supplierid', 'supplierdsc');
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'manualprice' . $model->rateid . '-form',
                    'action' => '?r=portoprint/rate/savemanualprice/id/' . Utils::encrypt($model->rateid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'),
                    'enableAjaxValidation' => false,
                    'method' => 'POST',
                    'htmlOptions' => array("class" => "smart-form", "novalidate" => "novalidate")
                ));
                ?>
                <fieldset>
                    <div class="row">
                        <section class="col col-2">Proveedor</section>								
                        <section class="col col-10">
                            <?php echo $form->dropDownList($manualratesupplier, 'supplierid', $suppliersservice, array('data-placeholder' => 'Selecione', 'style' => 'width:100%', 'class' => 'select2')); ?>
                        </section>
                        <section class="col col-11" style="float:left;">

                        </section>
                    </div>
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
                                    <td id="NT_RatesupplierQuantity1td"><input type="text" class="data" id="NT_RatesupplierQuantity1_pric" name="Ratesupplier[quantity_1]"></td>
                                    <td id="NT_RatesupplierDaysproduction1td"><input type="text" class="data" id="NT_RatesupplierDaysproduction1_enu" name="Ratesupplier[daysproduction1]"></td>

                                </tr>

                            <?php } if ($model->quantity_2) { ?>
                                <tr>
                                    <td><?php echo $model->quantity_2; ?></td>
                                    <td id="NT_RatesupplierQuantity2td"><input type="text" class="data" id="NT_RatesupplierQuantity2_pric" name="Ratesupplier[quantity_2]"></td>
                                    <td id="NT_RatesupplierDaysproduction2td"><input type="text" class="data" id="NT_RatesupplierDaysproduction2_enu" name="Ratesupplier[daysproduction2]"></td>

                                </tr>

                            <?php } if ($model->quantity_3) { ?>
                                <tr>
                                    <td><?php echo $model->quantity_3; ?></td>
                                    <td id="NT_RatesupplierQuantity3td"><input type="text" class="data" id="NT_RatesupplierQuantity3_pric" name="Ratesupplier[quantity_3]"></td>
                                    <td id="NT_RatesupplierDaysproduction3td"><input type="text" class="data" id="NT_RatesupplierDaysproduction3_enu" name="Ratesupplier[daysproduction3]"></td>

                                </tr>

                            <?php } if ($model->quantity_4) { ?>
                                <tr>
                                    <td><?php echo $model->quantity_4; ?></td>
                                    <td id="NT_RatesupplierQuantity4td"><input type="text" class="data" id="NT_RatesupplierQuantity4_pric" name="Ratesupplier[quantity_4]"></td>
                                    <td id="NT_RatesupplierDaysproduction4td"><input type="text" class="data" id="NT_RatesupplierDaysproduction4_enu" name="Ratesupplier[daysproduction4]"></td>

                                </tr>

                            <?php } if ($model->quantity_5) { ?>
                                <tr>
                                    <td><?php echo $model->quantity_5; ?></td>
                                    <td id="NT_RatesupplierQuantity5td"><input type="text" class="data" id="NT_RatesupplierQuantity5_pric" name="Ratesupplier[quantity_5]"></td>
                                    <td id="NT_RatesupplierDaysproduction5td"><input type="text" class="data" id="NT_RatesupplierDaysproduction5_enu" name="Ratesupplier[daysproduction5]"></td>

                                </tr>

                            <?php } if ($model->quantity_6) { ?>
                                <tr>
                                    <td><?php echo $model->quantity_6; ?></td>
                                    <td id="NT_RatesupplierQuantity6td"><input type="text" class="data" id="NT_RatesupplierQuantity6_pric" name="Ratesupplier[quantity_6]"></td>
                                    <td id="NT_RatesupplierDaysproduction6td"><input type="text" class="data" id="NT_RatesupplierDaysproduction6_enu" name="Ratesupplier[daysproduction6]"></td>

                                </tr>

                            <?php } ?>
                        </tbody></table>


                </fieldset>
                <footer>
                    <button class="btn btn-primary" id="send_manual_price" type="submit">
                        Aceptar
                    </button>
                    <button data-dismiss="modal" class="btn btn-default" type="button">
                        Cancelar
                    </button>

                </footer>
                <?php $this->endWidget(); ?>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="extendrate<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="extendrate<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Extender Evento</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="?r=portoprint/rate/extend/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>" id="<?php echo 'extend-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
                    <fieldset><p>Confirma extender el evento <?php echo $model->duration; ?> hrs a partir de este momento?</p></fieldset>
                    <footer>
                        <button class="btn btn-primary" type="submit">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="freerate<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="freerate<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Liberar Cotización</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="?r=portoprint/rate/extend/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<?php echo 'extend-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
                    <fieldset><p>Confirma liberar cotización <?php echo $model->rateid; ?>?</p></fieldset>
                    <footer>
                        <button data-dismiss="modal" class="btn btn-primary" type="button" onclick="finalize('<?php echo Utils::encrypt($model->rateid, 'rate') ?>', '<?php echo $model->rateid ?>');">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="addpdf<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="addpdf<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agregar a Resumen</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="?r=portoprint/rate/extend/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<?php echo 'extend-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
                    <fieldset><p>Confirma agregar la cotización <?php echo $model->rateid; ?> al resumen?</p></fieldset>
                    <footer>
                        <button data-dismiss="modal" class="btn btn-primary" type="button" onclick="completetopdf('<?php echo Utils::encrypt($model->rateid, 'rate') ?>', '<?php echo $model->rateid ?>');">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="delpdf<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="delpdf<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Remover del Resumen</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="?r=portoprint/rate/extend/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<?php echo 'extend-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
                    <fieldset><p>Confirma remover la cotización <?php echo $model->rateid; ?> del resumen?</p></fieldset>
                    <footer>
                        <button data-dismiss="modal" class="btn btn-primary" type="button" onclick="removetopdf('<?php echo Utils::encrypt($model->rateid, 'rate') ?>', '<?php echo $model->rateid ?>');">Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="ToDosp_<?php echo $model->rateid ?>" tabindex="-1" role="dialog" aria-labelledby="ToDosp_<?php echo $model->rateid ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agregar ToDo</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="#" id="ntToDosp_<?php echo $model->rateid ?>" novalidate="novalidate" class="smart-form">	
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

                                        <select  id="NT_areaid_sel" onchange="selector_personalp(this.value, '<?php echo $model->rateid ?>')" style=" width: 165px;"></select>

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
                                        <div class="btn-group btn-group-lg">
                                            <button type="button" id="success" class="pr btn btn-success btn-sm" onclick="todo_cot_prio(1, 'ntToDos_<?php echo $model->rateid ?>')" data-value="1" >Normal</button>
                                            <button type="button" id="warning" class="pr btn btn-warning btn-sm" onclick="todo_cot_prio(2, 'ntToDos_<?php echo $model->rateid ?>')" data-value="2" >Media</button>
                                            <button type="button" id="danger"  class="pr btn btn-danger btn-sm" onclick="todo_cot_prio(3, 'ntToDos_<?php echo $model->rateid ?>')" data-value="3"  >Alta</button>
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
                        <button class="btn btn-primary" class="btn btn-default" id="sendproject" onclick="save_todo_cotp('<?php echo $model->rateid ?>')" type="button" >Aceptar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="but    ton" id="cancel_new" >Cancelar</button>			
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
                <form method="post" action="?r=portoprint/rate/generateodc/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>" id="<?php echo 'extendc-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
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
                        <button class="btn btn-primary" type="button" onclick="finalize_odc('<?php echo Utils::encrypt($model->rateid, 'rate') ?>', '<?php echo $model->rateid ?>', '<?php echo 'extendc-' . $model->rateid . '-form'; ?>','1');" >Generar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="ODPModal_<?php echo $model->rateid; ?>" tabindex="-1" role="dialog" aria-labelledby="ODPModal_<?php echo $model->rateid; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Generar Orden de Producción</h4>
            </div>
            <div class="modal-body no-padding">
                <form method="post" action="?r=portoprint/rate/generateodp/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add, 'rate'); ?>/edt/<?php echo Utils::encrypt($edt, 'rate'); ?>/del/<?php echo Utils::encrypt($del, 'rate'); ?>/menu/<?php echo Utils::encrypt($menu, 'rate'); ?>" id="<?php echo 'extendp-' . $model->rateid . '-form'; ?>" novalidate="novalidate" class="smart-form">	
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
                        <button class="btn btn-primary" type="button" onclick="finalize_odp('<?php echo Utils::encrypt($model->rateid, 'rate') ?>', '<?php echo $model->rateid ?>', '<?php echo 'extendp-' . $model->rateid . '-form'; ?>','1');" >Generar</button>
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
                    </footer>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $("#send_manual_price").click(function() {
        var bandera = 0;
        $(".data").each(function() {
            var elemento = this;
            bandera += valid_expresion_form(elemento.id);
        });
        if (bandera === 0) {
            $("#manualprice<?php echo $model->rateid; ?>-form").submit();
        }
    });

    $("#fodcc_<?php echo $model->rateid; ?>").datepicker({
        dateFormat: 'yy-mm-dd'

    });
    $('.pdf_activity').click(function() {
        var rateid = $(this).data('rate');
        var tracker = "";
        var ratesupplier = "";
        $(".ratetracker").each(function() {
            if ($(this).is(':checked')) {
                tracker += (tracker === "") ? $(this).data('tracker') : ',' + $(this).data('tracker');
            }
        });
        $(".ratesupplier").each(function() {
            if ($(this).is(':checked')) {
                ratesupplier += (ratesupplier === "") ? $(this).data('tracker') : ',' + $(this).data('tracker');
            }
        });

        location.href = "?r=portoprint/pdf/activityrate/rateid/" + rateid + "/tracker/" + tracker + "/ratesupplier/" + ratesupplier;
    });
<?php
$cont = 1;
$data = array();
$data[] = array("id" => $cont++, "content" => 'Creación<br>' . Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'short', 'short'), "start" => $model->ratedate);
$ratetracker = Ratetracker::model()->findAllByAttributes(array("rateid" => $model->rateid));
foreach ($ratetracker as $event) {
    $data[] = array("id" => $cont++, "content" => $event->status->statusdsc . "<br />" . Yii::app()->dateFormatter->formatDateTime($event->statusdate, 'short', 'short'), "start" => $event->statusdate);
}
?>

    var items_<?php echo $model->rateid ?> = new vis.DataSet();

<?php for ($i = 0; $i < count($data); $i++) { ?>
        items_<?php echo $model->rateid ?>.add([{id: '<?php echo $data[$i]['id']; ?>', content: '<?php echo $data[$i]['content']; ?>', start: '<?php echo $data[$i]['start']; ?>'}]);
        console.log('<?php echo $data[$i]['content'] . '------' . $model->rateid; ?>');
<?php } ?>

    var container_<?php echo $model->rateid ?> = document.getElementById('ratetimelines_<?php echo $model->rateid ?>');

<?php
$nuevafecha = strtotime('-20 day', strtotime($datet));
$fechain = date('Y-m-j', $nuevafecha);
$div = explode("-", $fechain);
if (count($div[0]) > 1 && count($div[1]) > 1 && count($div[2]) > 1) {
    $fechain = $fechain;
} else {
    if (count($div[1]) == 1) {
        $uno = $div[1];
    }
    if (count($div[2]) == 1) {
        $dos = '0' . $div[2];
    }
    $fechain = $div[0] . '-' . $uno . '-' . $dos;
}


$nuevafecha = strtotime('+20 day', strtotime($date2));
$fechafin = date('Y-m-j', $nuevafecha);
?>
    var options_<?php echo $model->rateid ?> = {
   
        orientation: 'top',
        height: '400px',
        moveable: false
    };



    var timelines_<?php echo $model->rateid ?> = new vis.Timeline(container_<?php echo $model->rateid ?>, items_<?php echo $model->rateid ?>, options_<?php echo $model->rateid ?>);
    console.log('timelines_<?php echo $model->rateid ?>');

    $('#zoomIn_<?php echo $model->rateid ?>').click(function() {
        zoom_<?php echo $model->rateid ?>(-0.2);
    });
    $('#zoomOut_<?php echo $model->rateid ?>').click(function() {
        zoom_<?php echo $model->rateid ?>(0.2);
    });
    $('#moveLeft_<?php echo $model->rateid ?>').click(function() {
        move_<?php echo $model->rateid ?>(0.2);
    });
    $('#moveRight_<?php echo $model->rateid ?>').click(function() {
        move_<?php echo $model->rateid ?>(-0.2);
    });




    $(function() {

        $('#probable_<?php echo $model->rateid ?>').editable({
            url: '?r=portoprint/rate/probability/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>',
            name: 'probability',
            source: [{
                    value: 0,
                    text: '0% - Nula'
                }, {
                    value: .25,
                    text: '25% Baja'
                },
                {
                    value: .50,
                    text: '50% Media'
                },
                {
                    value: .75,
                    text: '75% Alta'
                },
                {
                    value: 1,
                    text: '100% Segura'
                }]
        });

        $("#<?php echo 'manualprice' . $model->rateid . '-form' ?> .select2").select2();
        var constsupp = new Array();
        var constsupp1 = new Array();
        var constpp = new Array();
        var constpp1 = new Array();
        var constsppresul = new Array();
        var constppresul = new Array();
        var limite = 0;
        var cont1 = 0;
        var contx = 0;
        var cont = 0;


        $('#ratecalculatetable_<?php echo $model->rateid ?> .percentcalc').each(function() {
            var supplierid = $(this).attr('title');
            for (cn = 1; cn <= 6; cn++) {
                var ovalue = Number($('#quantity_' + cn + '_' + supplierid).val());
                var percent = Number(1 + ($(this).val() / 100));
                var cvalueh = redondeo2decimales(ovalue * percent);
                var cvalue = addCommas(cvalueh);
                if (cvalue != 0) {
                    if (constsppresul[cn] == null) {
                        constsppresul[cn] = 0;
                    }
                    var suma = ovalue;
                    constsppresul[cn] = constsppresul[cn] + suma;


                    if (constppresul[cn] == null) {
                        constppresul[cn] = 0;
                    }
                    var suma = cvalueh.toFixed(2);
                    constppresul[cn] = constppresul[cn] + parseFloat(suma);
                    cont++;

                    // construct1[cont][cn]=ovalue;

                }
                if (cn == 6) {

                    for (i = 1; i <= 6; i++) {
                        if (constppresul[i] != null) {
                            var ssprompp = constppresul[i] / cont;
                            $("#ratecalculatetable_<?php echo $model->rateid ?>").find("#<?php echo $model->rateid ?>_cpg_" + i).html(ssprompp.toFixed(2));
                            console.log(constppresul[i] + '    ' + cont + '   ' + ssprompp);
                        } else {
                            $("#ratecalculatetable_<?php echo $model->rateid ?>").find("#<?php echo $model->rateid ?>_cpg_" + i).html('0');
                        }


                    }


                }
                $('#ratecalculatetable_<?php echo $model->rateid ?> #calculate_' + cn + '_' + supplierid).val(cvalueh);
                $('#ratecalculatetable_<?php echo $model->rateid ?> #c_' + cn + '_' + supplierid).html(cvalue);
                calculatesave(cn, '<?php echo $model->rateid ?>', '<?php echo $model->formula; ?>');
            }

        });

        $('#ratecalculatetable_<?php echo $model->rateid ?> .percentcalc').keyup(function() {
            var supplierid = $(this).attr('title');

            for (cn = 1; cn <= 6; cn++) {
                var ovalue = Number($('#quantity_' + cn + '_' + supplierid).val());
                var percent = Number(1 + ($(this).val() / 100));
                var cvalueh = redondeo2decimales(ovalue * percent);
                var cvalue = addCommas(cvalueh);
                if (cvalue != 0) {
                    if (constsppresul[cn] == null) {
                        constsppresul[cn] = 0;
                    }
                    var suma = ovalue;
                    constsppresul[cn] = constsppresul[cn] + suma;


                    if (constppresul[cn] == null) {
                        constppresul[cn] = 0;
                    }
                    var suma = cvalueh.toFixed(2);
                    constppresul[cn] = constppresul[cn] + parseFloat(suma);
                    cont++;

                    // construct1[cont][cn]=ovalue;

                }
                if (cn == 6) {

                    for (i = 1; i <= 6; i++) {
                        if (constppresul[i] != null) {
                            var ssprompp = constppresul[i] / cont;
                            $("#ratecalculatetable_<?php echo $model->rateid ?>").find("#<?php echo $model->rateid ?>_cpg_" + i).html(ssprompp.toFixed(2));
                            console.log(constppresul[i] + '    ' + cont + '   ' + ssprompp);
                        } else {
                            $("#ratecalculatetable_<?php echo $model->rateid ?>").find("#<?php echo $model->rateid ?>_cpg_" + i).html('0');
                        }



                    }


                }
                $('#ratecalculatetable_<?php echo $model->rateid ?> #calculate_' + cn + '_' + supplierid).val(cvalueh);
                $('#ratecalculatetable_<?php echo $model->rateid ?> #c_' + cn + '_' + supplierid).html(cvalue);
                calculatesave(cn, '<?php echo $model->rateid ?>', '<?php echo $model->formula; ?>');

            }
        });

        $('#ratecalculatetable_<?php echo $model->rateid ?> .selectsupplier').each(function() {
            var supplierid = $(this).attr('title');
            if ($(this).is(':checked')) {
                $('#ratecalculatetable_<?php echo $model->rateid ?> #select_' + supplierid).attr('disabled', false).show();
            } else {
                $('#ratecalculatetable_<?php echo $model->rateid ?> #select_' + supplierid).attr('disabled', true).prop('checked', false).hide();
            }

        });

        for (cn = 1; cn <= 6; cn++)
            calculatesavepp(cn, '<?php echo $model->rateid ?>', '<?php echo $model->formula; ?>');

        if ($("#ratecalculatetable_<?php echo $model->rateid ?> input[name='selectedsupplier']:checked").val() != null) {

            $("#ratecalculatetable_<?php echo $model->rateid ?> input[name='selectedsupplier']").attr('disabled', true);

        }

        $('#ratecalculatetable_<?php echo $model->rateid ?> .selectsupplier').click(function() {
            var supplierid = $(this).attr('title');
            for (cn = 1; cn <= 6; cn++) {
                var ovalue = Number($('#quantity_' + cn + '_' + supplierid).val());
                var percent = Number(1 + ($('#percent_' + supplierid).val() / 100));
                var cvalueh = redondeo2decimales(ovalue * percent);
                var cvalue = addCommas(cvalueh);
                $('#ratecalculatetable_<?php echo $model->rateid ?> #calculate_' + cn + '_' + supplierid).val(cvalueh);
                $('#ratecalculatetable_<?php echo $model->rateid ?> #c_' + cn + '_' + supplierid).html(cvalue);
                calculatesave(cn, '<?php echo $model->rateid ?>', '<?php echo $model->formula; ?>');
            }
            if ($(this).is(':checked')) {
                console.debug('si' + supplierid);
                $('#ratecalculatetable_<?php echo $model->rateid ?> #select_' + supplierid).attr('disabled', false);
            } else {
                console.debug('no' + supplierid);
                $('#ratecalculatetable_<?php echo $model->rateid ?> #select_' + supplierid).attr('disabled', true).attr('checked', false);
            }
            for (cn = 1; cn <= 6; cn++)
                calculatesavepp(cn, '<?php echo $model->rateid ?>', '<?php echo $model->formula; ?>');
        });

        for (cn = 1; cn <= 6; cn++)
            calculatesavepp(cn, '<?php echo $model->rateid ?>', '<?php echo $model->formula; ?>');

        if ($("#ratecalculatetable_<?php echo $model->rateid ?> input[name='selectedsupplier']:checked").val() != null) {

            $("#ratecalculatetable_<?php echo $model->rateid ?> input[name='selectedsupplier']").attr('disabled', true);

        }

        /*  var container_<?php echo $model->rateid ?> = document.getElementById('ratetimeline_<?php echo $model->rateid ?>');
         var data_<?php echo $model->rateid ?> = <?php echo json_encode($data); ?>;
         var options_<?php echo $model->rateid ?> = {height: '100%', orientation: 'top', showCurrentTime: true, min: new Date(2014, 0, 1) }; //,   start: '<?php //echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'short', null)     ?>'
         var timeline_<?php echo $model->rateid ?> = new vis.Timeline(container_<?php echo $model->rateid ?>,
         data_<?php echo $model->rateid ?>,
         options_<?php echo $model->rateid ?>);*/




    });

    function move_<?php echo $model->rateid ?>(percentage) {

        var range = timelines_<?php echo $model->rateid ?>.getWindow();
        var interval = range.end - range.start;

        timelines_<?php echo $model->rateid ?>.setWindow({
            start: range.start.valueOf() - interval * percentage,
            end: range.end.valueOf() - interval * percentage
        });
    }

    /**
     * Zoom the timeline a given percentage in or out
     * @param {Number} percentage   For example 0.1 (zoom out) or -0.1 (zoom in)
     */
    function zoom_<?php echo $model->rateid ?>(percentage) {
        var range = timelines_<?php echo $model->rateid ?>.getWindow();
        var interval = range.end - range.start;

        timelines_<?php echo $model->rateid ?>.setWindow({
            start: range.start.valueOf() - interval * percentage,
            end: range.end.valueOf() + interval * percentage
        });
    }



    function new_file() {


        var cad = "<td><input type='text' class='form-control' id='name_file' placeholder='Nombre'></td>" +
                "<td colspan='2' align='center'>" +
                "<div class='btn-group btn-group-sm'><form id='dzone_' action='' enctype='multipart/form-data' method='post'><input type='file' name='file' id='file' title='Buscar' data-filename-placement='inside' ></input></form>" +
                "<a onclick='acept_file()' class='btn btn-success'><i class='glyphicon glyphicon-ok'></i></a>" +
                "<a onclick='canc_file()'  class='btn btn-danger' ><i class='glyphicon glyphicon-remove'></i></a>" +
                "</div></div></td>";
        $("#new_upload").html(cad);
        //  $('input[type=file]').bootstrapFileInput();
        var path = $("#files").data("urls");
        $("#dzone_").attr("action", path);


    }
    function acept_file() {

        var nombre = $("#name_file").val();
        var ruta = $("#file").val();
        var bandera = 0;
        if (nombre == "") {
            alert("No a asignado un nombre al archivo");
            bandera = 1;
        }
        if (ruta == "") {
            alert("No a asignado una ruta del archivo");
            bandera = 1;
        }

        if (bandera == 0) {
            document.forms["dzone_"].submit();
            //$("#dzone_").submit();
        }
    }

    function canc_file() {

        var cad = "<td colspan='3' align='center' id='new_upload'>" +
                "<a onclick='new_file()' style='cursor:pointer; text-decoration:none;' >" +
                "<i class='fa fa-lg fa-fw fa-plus'></i><span class='menu-item-parent' style=' font-size:15;'>Cargar Nuevo Archivo</span>" +
                "</a></td>";
        $("#new_upload").html(cad);

    }
    function recharlist_file_<?php echo $model->rateid ?>() {

        var cad = "<?php echo $model->rateid ?>";

        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/rate/getlistfiles') ?>', {'rateid': cad}, function(response) {

            $("#files_" + cad).find("tbody").html(response);

        });

    }
</script>