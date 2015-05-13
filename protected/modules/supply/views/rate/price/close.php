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
<?php 
$rs = Ratesupplier::model()->findByAttributes(array('rateid'=>$model->rateid, 'statusid'=>11));
$sp = Supplier::model()->findByPk($rs->supplierid);
$odp = Rateodp::model()->findByAttributes(array('rateid'=>$model->rateid));
$statusodp = Status::model()->findByAttributes(array('statusid'=>$odp->statuscustomerid));
$estatusdb = Status::model()->findAllByAttributes(array('statustype'=>3));
foreach($estatusdb as $row){
	$estatus[] = array('value'=>$row->statusid, 'text'=>$row->statusdsc);
	
}
	
	

	?>
	
	<div class="jarviswidget jarviswidget-color-greenDark jarviswidget-sortable" id="wid-id-<?php  echo $model->rateid ?>"  data-widget-colorbutton="true" data-widget-togglebutton="true" data-widget-editbutton="true" data-widget-deletebutton="true" data-widget-custombutton="true">
			<header>
				<span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2><strong><?php echo $model->idVersion()."  ".$model->servicedsc ?></strong> </h2>				
				<div class="widget-toolbar">
					
					<div class="btn-group">
						<button class="btn dropdown-toggle btn-warning" data-toggle="dropdown">
							Acción <i class="fa fa-caret-down"></i>
						</button>
						<ul class="dropdown-menu pull-right">
							<?php if($model->odptime==null) {?>
							<li>
								<a href="javascript:void(0);" data-target="#ODPModal_<?php  echo $model->rateid ?>"  data-toggle="modal">Generar ODP</a>
							</li>
							<?php } if($model->odctime==null) {?>
							<li>
								<a href="javascript:void(0);" data-target="#ODCModal_<?php  echo $model->rateid ?>"  data-toggle="modal">Generar ODC</a>
							</li>
							<?php } ?>
							<li>
								<a href="?r=portoprint/rate/requote/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>">Recotizar</a>
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
									<strong>Item:</strong> <?php echo RateController::getDetail($model->rateid,$model->servicedsc,$model->note, $model->idVersion())?><br>
									<strong>Comprador:</strong> <?php echo $model->firstname ?><br>
									<strong>Creación:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'full', 'full') ; ?><br />
									<strong>Finalizó:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->statustime, 'full', 'full') ; ?>
									
									</td>
									<td>
									<?php if($model->odctime!=null){ ?>
									<strong>ODC: </strong> <?php  echo Yii::app()->dateFormatter->formatDateTime($model->odctime, 'full', 'full')  ;?> <a href="?r=portoprint/pdf/odc/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>">Descargar</a>
									<?php } if($model->odptime!=null){ ?>
									<br /><strong>ODP: </strong> <?php  echo Yii::app()->dateFormatter->formatDateTime($model->odptime, 'full', 'full')  ;?> <a href="?r=portoprint/pdf/odp/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>">Descargar</a>
									<br /><strong>Estatus producción: </strong> <a href="#" id="status_<?php echo $model->rateid ?>" data-type="select" data-pk="1" data-value="" ></a>
									<br /><strong>Orden de Pago: </strong> <a href="?r=portoprint/pdf/odpd/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>">Descargar</a>
									
									<?php } ?>
									
									</td>
								</tr>
							</thead>
						</table>
					</div>
					
					<div style="margin-top:3em;">
						<ul id="myTab_<?php echo $model->rateid ?>" class="nav nav-tabs">
							<li class="active">
								<a href="#s1_<?php echo $model->rateid ?>" data-toggle="tab">Calculadora de precios</a>
							</li>
							<li>
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
								</ul>
							</li>
							<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">Finanzas<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="#s9_<?php echo $model->rateid ?>" data-toggle="tab">Remisiones</a>
									</li>
									<li>
										<a href="#s10_<?php echo $model->rateid ?>" data-toggle="tab">Informe de Entrada</a>
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
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_1)." ".$model->quantity_1 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_2)." ".$model->quantity_2 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_3)." ".$model->quantity_3 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_4)." ".$model->quantity_4 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_5)." ".$model->quantity_5 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_6)." ".$model->quantity_6 ; ?></th>
											<th width="30" style="text-align:center">%</th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_1)." ".$model->quantity_1 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_2)." ".$model->quantity_2 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_3)." ".$model->quantity_3 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_4)." ".$model->quantity_4 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_5)." ".$model->quantity_5 ; ?></th>
											<th width="80" style="text-align:center"><?php echo $model->quantityselectedicon($model->quantity_6)." ".$model->quantity_6 ; ?></th>
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
										foreach( $ratesuppliers as $supplier ){ 
											$pricefee_1 = number_format($supplier->quantity_1 * (1+($supplier->percent/100)), 2, '.', '');
											$pricefee_2 = number_format($supplier->quantity_2 * (1+($supplier->percent/100)), 2, '.', '');
											$pricefee_3 = number_format($supplier->quantity_3 * (1+($supplier->percent/100)), 2, '.', '');
											$pricefee_4 = number_format($supplier->quantity_4 * (1+($supplier->percent/100)), 2, '.', '');
											$pricefee_5 = number_format($supplier->quantity_5 * (1+($supplier->percent/100)), 2, '.', '');
											$pricefee_6 = number_format($supplier->quantity_6 * (1+($supplier->percent/100)), 2, '.', '');
											
											if($supplier->statusid == 11 || $supplier->statusid == 12){
												$acum_1 += $pricefee_1;
												$acum1 += $supplier->quantity_1;
												array_push($min_1, $pricefee_1) ;
												array_push($min1, $supplier->quantity_1) ;
												
												$acum_2 += $pricefee_2;
												$acum2 += $supplier->quantity_2;
												array_push($min_2, $pricefee_2) ;
												array_push($min2, $supplier->quantity_2) ;
												
												$acum_3 += $pricefee_3;
												$acum3 += $supplier->quantity_3;
												array_push($min_3, $pricefee_3) ;
												array_push($min3, $supplier->quantity_3) ;
												
												$acum_4 += $pricefee_4;
												$acum4 += $supplier->quantity_4;
												array_push($min_4, $pricefee_4) ;
												array_push($min4, $supplier->quantity_4) ;
												
												$acum_5 += $pricefee_5;
												$acum5 += $supplier->quantity_5;
												array_push($min_5, $pricefee_5) ;
												array_push($min5, $supplier->quantity_5) ;
												
												$acum_6 += $pricefee_6;
												$acum6 += $supplier->quantity_6;
												array_push($min_6, $pricefee_6) ;
												array_push($min6, $supplier->quantity_6) ;
											}
											
											
										?>
										<tr <?php echo $supplier->selectedrow(); ?> >						
											<td style="text-align:center" ><input type="checkbox" <?php echo $supplier->checked(); ?>  title="<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->ratesupplierid; ?>" id="show_<?php echo $supplier->ratesupplierid; ?>" disabled="disabled" /></td>	
											<td id="ssd_<?php echo $supplier->ratesupplierid; ?>"><?php echo $supplier->supplierdsc; ?></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_1,$supplier->selectedcell()) ?>"><?php echo $supplier->quantity_1; ?></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_2,$supplier->selectedcell()) ?>"><?php echo $supplier->quantity_2; ?></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_3,$supplier->selectedcell()) ?>"><?php echo $supplier->quantity_3; ?></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_4,$supplier->selectedcell()) ?>"><?php echo $supplier->quantity_4; ?></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_5,$supplier->selectedcell()) ?>"><?php echo $supplier->quantity_5; ?></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_6,$supplier->selectedcell()) ?>"><?php echo $supplier->quantity_6; ?></td>
											<td style="text-align:right" ><?php echo $supplier->percent; ?></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_1,$supplier->selectedcell()) ?>" ><span><?php echo $pricefee_1; ?></span></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_2,$supplier->selectedcell()) ?>" ><span><?php echo $pricefee_2; ?></span></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_3,$supplier->selectedcell()) ?>" ><span><?php echo $pricefee_3; ?></span></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_4,$supplier->selectedcell()) ?>" ><span><?php echo $pricefee_4; ?></span></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_5,$supplier->selectedcell()) ?>" ><span><?php echo $pricefee_5; ?></span></td>
											<td style="text-align:right; <?php  echo $model->quantityselectedcell($model->quantity_6,$supplier->selectedcell()) ?>" ><span><?php echo $pricefee_6; ?></span></td>
										</tr>
									<?php 
										} 
										$formula = $model->formula;
										$formula1= str_ireplace('pp', '$pp', $formula);
										$formula2= str_ireplace('min', '$min', $formula1);
										$formula3= str_ireplace('prom', '$prom', $formula2);
										$formula4= str_ireplace('save', '$save', $formula3);
									 
										$min = min($min1); 
										$prom = $acum1 / (count($min1));
										eval($formula4);
									    $spp1= number_format($pp, 2, '.', ''); 
									    $ssave1 =  number_format($save, 2, '.', '');
							
										$min = min($min2); 
										$prom = $acum2 / (count($min2));
										eval($formula4);
									    $spp2= number_format($pp, 2, '.', ''); 
									    $ssave2 =  number_format($save, 2, '.', '');
									    
									    $min = min($min3); 
										$prom = $acum3 / (count($min3));
										eval($formula4);
									    $spp3= number_format($pp, 2, '.', ''); 
									    $ssave3 =  number_format($save, 2, '.', '');
									    
									    $min = min($min4); 
										$prom = $acum4 / (count($min4));
										eval($formula4);
									    $spp4= number_format($pp, 2, '.', ''); 
									    $ssave4 =  number_format($save, 2, '.', '');
									    
									    $min = min($min5); 
										$prom = $acum5 / (count($min5));
										eval($formula4);
									    $spp5= number_format($pp, 2, '.', ''); 
									    $ssave5 =  number_format($save, 2, '.', '');
									    
									    $min = min($min6); 
										$prom = $acum6 / (count($min6));
										eval($formula4);
									    $spp6= number_format($pp, 2, '.', ''); 
									    $ssave6 = number_format($save, 2, '.', '');
									    
									    $min = min($min_1); 
										$prom = $acum_1 / (count($min_1));
										eval($formula4);
									    $pp1= number_format($pp, 2, '.', ''); 
									    $save1 =  number_format($save, 2, '.', '');
							
										$min = min($min_2); 
										$prom = $acum_2 / (count($min_2));
										eval($formula4);
									    $pp2= number_format($pp, 2, '.', ''); 
									    $save2 =  number_format($save, 2, '.', '');
									    
									    $min = min($min_3); 
										$prom = $acum_3 / (count($min_3));
										eval($formula4);
									    $pp3= number_format($pp, 2, '.', ''); 
									    $save3 =  number_format($save, 2, '.', '');
									    
									    $min = min($min_4); 
										$prom = $acum_4 / (count($min_4));
										eval($formula4);
									    $pp4= number_format($pp, 2, '.', ''); 
									    $save4 =  number_format($save, 2, '.', '');
									    
									    $min = min($min_5); 
										$prom = $acum_5 / (count($min_5));
										eval($formula4);
									    $pp5= number_format($pp, 2, '.', ''); 
									    $save5 =  number_format($save, 2, '.', '');
									    
									    $min = min($min_6); 
										$prom = $acum_6 / (count($min_6));
										eval($formula4);
									    $pp6= number_format($pp, 2, '.', ''); 
									    $save6 = number_format($save, 2, '.', '');
									   ?>
										<tr>
											<td width="60">&nbsp;</td>
											<td>Precio Portoprint $</td>
											<td style="text-align:right"><?php echo $spp1; ?></td>
											<td style="text-align:right"><?php echo $spp2; ?></td>
											<td style="text-align:right"><?php echo $spp3; ?></td>
											<td style="text-align:right"><?php echo $spp4; ?></td>
											<td style="text-align:right"><?php echo $spp5; ?></td>
											<td style="text-align:right"><?php echo $spp6; ?></td>
											<td >&nbsp;</td>
											<td style="text-align:right"><?php echo $pp1; ?></td>
											<td style="text-align:right"><?php echo $pp2; ?></td>
											<td style="text-align:right"><?php echo $pp3; ?></td>
											<td style="text-align:right"><?php echo $pp4; ?></td>
											<td style="text-align:right"><?php echo $pp5; ?></td>
											<td style="text-align:right"><?php echo $pp6; ?></td>
										</tr>
										<tr >
											<td width="60">&nbsp;</td>
											<td>Ahorro $</td>
											<td style="text-align:right"><?php echo $ssave1; ?></td>
											<td style="text-align:right"><?php echo $ssave2; ?></td>
											<td style="text-align:right"><?php echo $ssave3; ?></td>
											<td style="text-align:right"><?php echo $ssave4; ?></td>
											<td style="text-align:right"><?php echo $ssave5; ?></td>
											<td style="text-align:right"><?php echo $ssave6; ?></td>
											<td >&nbsp;</td>
											<td style="text-align:right"><?php echo $save1; ?></td>
											<td style="text-align:right"><?php echo $save2; ?></td>
											<td style="text-align:right"><?php echo $save3; ?></td>
											<td style="text-align:right"><?php echo $save4; ?></td>
											<td style="text-align:right"><?php echo $save5; ?></td>
											<td style="text-align:right"><?php echo $save6; ?></td>

										</tr>	
										<tr ><td colspan="16">&nbsp;</td></tr>
										<tr ><td colspan="16">&nbsp;</td></tr>		
									</tbody>	
								</table>
							</div>
							<div class="tab-pane fade" id="s2_<?php echo $model->rateid ?>">
								<p>
									<?php
										$modelart = Rateart::model()->findbyAttributes(array('rateid'=>$model->rateid)); 
										 $this->renderPartial('rate/art', array("model"=>$modelart)) ;
									?>
								</p>
							</div>
							<div class="tab-pane fade" id="s3_<?php echo $model->rateid ?>">
								<p>
									<?php
										$modelcolortest = Ratecolortest::model()->findbyAttributes(array('rateid'=>$model->rateid,'active'=>1));
										$this->renderPartial('rate/color', array("model"=>$modelcolortest)) ;
									?>
								</p>
							</div>
							<div class="tab-pane fade" id="s4_<?php echo $model->rateid ?>">
								<p>
									<?php
										$modelproduction = Rateproduction::model()->findbyAttributes(array('rateid'=>$model->rateid));
										$this->renderPartial('rate/production', array("model"=>$modelproduction)) ;
									?>
								</p>
							</div>
							<div class="tab-pane fade" id="s5_<?php echo $model->rateid ?>">
								<p>
									<?php
										$modelzerotest = Ratezerotest::model()->findbyAttributes(array('rateid'=>$model->rateid,'active'=>1));
										$this->renderPartial('rate/zero', array("model"=>$modelzerotest)) ;
									?>
								</p>
							</div>
							<div class="tab-pane fade" id="s7_<?php echo $model->rateid ?>">
								<form class="smart-form">
								<header><strong>Archivos</strong></header>
								</form>										
								<form action="index.php?r=portoprint/upload/index/id/<?php echo $model->rateid ?>" class="dropzone smart-form" id="dzone_<?php echo $model->rateid ?>"></form>
							
							</div>
							<div class="tab-pane fade" id="s8_<?php echo $model->rateid ?>">
							<form class="smart-form">
								<header><strong>Time Line</strong></header>
								<fieldset>
									<div id="ratetimeline_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;"></div>
								</fieldset>
							</form>
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
								<header><strong>Informe de Entrada</strong></header>
								</form>		
								<p>
									<div id="rateinvoicesupplier_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;"></div>
								</p>
							</div>
							
							<div class="tab-pane fade" id="s11_<?php echo $model->rateid ?>">
								<form class="smart-form">
								<header><strong>Facturación Portoprint</strong></header>
								</form>		
								<p>
									<div id="rateinvoiceporto_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;"></div>
								</p>
							</div>
							<div class="tab-pane fade" id="s12_<?php echo $model->rateid ?>">
								<form class="smart-form">
								<header><strong>Facturación Proveedor</strong></header>
								</form>		
								<p>
									<div id="rateinvoicesupplier_<?php echo $model->rateid ?>" style="font-size:12px; height:400px;"></div>
								</p>
							</div>
						</div>
						
					</div>	
				</div>
			</div>
	</div>


<div id="requotediv" style="display: none; margin:30px; width:400px; ">
	<div class="ui-jqgrid-titlebar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
		<span class="ui-jqgrid-title" style="padding:10px;">Recotizar</span>
	</div>
	<div  class="ui-widget-content" style="padding:5px;" >	    	
		<form id="rqform" action="/purchasing/RateAction.do" >
		<table id="rqtable" cellspacing="0" border="0" cellpadding="1" width="350">
			<tr><td>&nbsp;
				Seleccione los proveedores que participarán con nuevo precio en la recotización, los proveedores no selecionados mantrendrán el mismo precio que tuvieron para está cotización.
			</td></tr>	
		    <tr><td>
			 	<input type="checkbox" class="rdsupp" id="srq_192" name="srq_192" value="192"/> 11ce 
			 </td></tr>
			<tr><td>&nbsp;</td></tr>						
		</table>
		</form>
		<div style="width:400px; ">
			<button class="tablebtn" id="requotecancel" style="width:150px;padding:2px;">Cancelar</button>
			<button class="tablebtn" id="requoteaccept" style="width:150px;padding:2px;">Aceptar</button>
		</div>
	</div>	
</div>

<div class="modal fade" id="ODPModal_<?php  echo $model->rateid ;?>" tabindex="-1" role="dialog" aria-labelledby="ODPModal_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Generar Orden de Producción</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="?r=portoprint/rate/generateodp/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'extend-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">	
        <fieldset>
			<div class="row">
				<section>
					<section class="col col-3"><strong>COTIZACION-ITEM:</strong></section>
					<section class="col col-9"><?php echo $model->rateid; ?></section>
				</section>
				<section>
					<section class="col col-3"><strong>ITEM:</strong></section>
					<section class="col col-9"><?php echo $model->servicedsc; ?></section>
				</section>
				<section>
					<section class="col col-3"><strong>PROVEEDOR:</strong></section>
					<section class="col col-9"><?php echo $sp->supplierdsc; ?></section>
				</section>
			</div>
		</fieldset>
        <footer>
	      	<button class="btn btn-primary" type="submit">Generar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="ODCModal_<?php  echo $model->rateid ;?>" tabindex="-1" role="dialog" aria-labelledby="ODCModal_<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Generar Orden de Compra</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="?r=portoprint/rate/generateodc/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'extend-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">	
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
	      	<button class="btn btn-primary" type="submit">Generar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<?php 
		$cont = 1;
		$data = array();
		$data[]=array("id"=>$cont++, "content"=>'Creación<br>'.Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'short', 'short'), "start"=>$model->ratedate );
		$ratetracker =  Ratetracker::model()->findAllByAttributes(array("rateid"=>$model->rateid));
		foreach($ratetracker as $event)
			$data[] = array("id"=>$cont++, "content"=>$event->status->statusdsc."<br />".Yii::app()->dateFormatter->formatDateTime($event->statusdate, 'short', 'short'), "start"=>$event->statusdate );
		
		?>
		
<script>
$(document).ready( function(){
	$('#status_<?php echo $model->rateid ?>').editable({
		url:'?r=portoprint/rate/statusproduction/id/<? echo Utils::encrypt($odp->rateodpid, 'odp'); ?>',
		name:'statuscustomerid',
        prepend: "<?php echo $statusodp->statusdsc." ".Yii::app()->dateFormatter->formatDateTime($odp->statuscustomertime, 'medium', 'short'); ?>",
        source: <?php echo json_encode($estatus)?>
    });
    
	var container_<?php echo $model->rateid ?> = document.getElementById('ratetimeline_<?php echo $model->rateid ?>');
	var data_<?php echo $model->rateid ?> = <?php echo json_encode($data); ?>;
	var options_<?php echo $model->rateid ?> = {height: '100%', orientation: 'top', showCurrentTime: true, start:'<?php echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'short', null) ?>'};
	var timeline_<?php echo $model->rateid ?> = new vis.Timeline(container_<?php echo $model->rateid ?>, data_<?php echo $model->rateid ?>, options_<?php echo $model->rateid ?>);
});
</script>


