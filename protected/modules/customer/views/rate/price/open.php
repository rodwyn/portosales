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
		<div class="jarviswidget jarviswidget-sortable" id="wid-id-<?php  echo $model->rateid ?>"  data-widget-colorbutton="true" data-widget-togglebutton="true" data-widget-editbutton="true" data-widget-deletebutton="true" data-widget-custombutton="true">
				<header>
					<span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2><strong><?php echo $model->idVersion()."  ".$model->servicedsc ?></strong> </h2>				
					<div class="widget-toolbar">
						
						<div class="btn-group">
							<button class="btn dropdown-toggle btn-warning" data-toggle="dropdown">
								Acción <i class="fa fa-caret-down"></i>
							</button>
							<ul class="dropdown-menu pull-right">
								<?php if($model->complete==0){?>
								<li>
									<a href="javascript:void(0);" data-target="#newpricemanualModal<?php  echo $model->rateid ?>"  data-toggle="modal">Precio Manual</a>
								</li>
								<li>
									<a href="javascript:void(0);" data-target="#extendrate<?php  echo $model->rateid ?>"  data-toggle="modal">Extender Evento</a>
								</li>
								
								<li>
									<a href="javascript:void(0);" data-target="#addpdf<?php  echo $model->rateid ?>"  data-toggle="modal">Agregar al resumen</a>
								</li>
								<?php } else { ?>
								<li>
									<a href="javascript:void(0);" data-target="#delpdf<?php  echo $model->rateid ?>"  data-toggle="modal">Remover del resumen</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="javascript:void(0);" data-target="#freerate<?php  echo $model->rateid ?>"  data-toggle="modal">Liberar</a>
								</li>
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
											<strong>Item:</strong> <?php echo RateController::getDetail($model->rateid,$model->servicedsc,$model->note, $model->idVersion())?><br>
											<strong>Comprador:</strong> <?php echo $model->firstname ?><br>
											<strong>Creación:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'full', 'full') ; ?><br>										
											
											<?php if($model->statusid==2 || $model->statusid==4){?>
											<strong>Finaliza:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->finalize, 'full', 'full') ; ?>
											<?php } else {?>
											<strong>Finalizó:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->statustime, 'full', 'full') ; ?>
											
											<?php } ?>
											<br>
											</td>
											<td>
											<strong>Estatus:</strong> <?php echo $model->statusdsc; ?><br>
											<strong>Probabilidad:</strong> <a href="#" id="probable_<?php echo $model->rateid ?>" data-type="select" data-pk="1" data-value="<?php echo $model->probability ?>" data-original-title="Probabilidad"></a><br>
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
									
								</ul>
		
								<div id="myTabContent_<?php echo $model->rateid ?>" class="tab-content">
									<div class="tab-pane fade in active" id="s1_<?php echo $model->rateid ?>">
										
										<form method="post" action="?r=portoprint/rate/saveprice/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'rateprice-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">	
											<table id="ratecalculatetable_<?php echo $model->rateid ?>" title="<?php echo $model->rateid ?>" class="table table-condensed">
											    <thead>
												    <tr>
														<th width="60">Mostrar</th>
														<th>Proveedor</th>
														<th width="80" style="text-align:center"><?php echo $model->quantity_1; ?></th>
														<th width="80" style="text-align:center"><?php echo $model->quantity_2; ?></th>
														<th width="80" style="text-align:center"><?php echo $model->quantity_3; ?></th>
														<th width="80" style="text-align:center"><?php echo $model->quantity_4; ?></th>
														<th width="80" style="text-align:center"><?php echo $model->quantity_5; ?></th>
														<th width="80" style="text-align:center"><?php echo $model->quantity_6; ?></th>
														<th width="30" style="text-align:center">%</th>
														<th width="80" style="text-align:center">
															<div class="radio">
																<label>
																	<input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_1; ?>" <?php echo $model->quantityselected( $model->quantity_1 ); ?> />
																	<span><br /><?php echo $model->quantity_1; ?></span> 
																</label>
															</div>												
														</th>
														<th width="80" style="text-align:center">
															<div class="radio">
																<label>
																	<input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_2; ?>" <?php echo $model->quantityselected( $model->quantity_2 ); ?> />
																	<span><br /><?php echo $model->quantity_2; ?></span> 
																</label>
															</div>		
														</th>											
														<th width="80" style="text-align:center">
															<div class="radio">
																<label>
																	<input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_3; ?>" <?php echo $model->quantityselected( $model->quantity_3 ); ?> />
																	<span><br /><?php echo $model->quantity_3; ?></span> 
																</label>
															</div>	
														</th>
														<th width="80" style="text-align:center">
															<div class="radio">
																<label>
																	<input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_4; ?>" <?php echo $model->quantityselected( $model->quantity_4 ); ?> />
																	<span><br /><?php echo $model->quantity_4; ?></span> 
																</label>
															</div>	
														</th>
														<th width="80" style="text-align:center">
															<div class="radio">
																<label>
																	<input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_5; ?>" <?php echo $model->quantityselected( $model->quantity_5 ); ?> />
																	<span><br /><?php echo $model->quantity_5; ?></span> 
																</label>
															</div>	
														</th>
														<th width="80" style="text-align:center">
															<div class="radio">
																<label>
																	<input type="radio" class="radiobox style-0" name="quantity_selected"  id="quantity_selected_<?php echo $model->rateid; ?>" value="<?php echo $model->quantity_6; ?>" <?php echo $model->quantityselected( $model->quantity_6 ); ?> />
																	<span><br /><?php echo $model->quantity_6; ?></span> 
																</label>
															</div>	
														</th>
														<th width="60" style="text-align:center">Seleccionar</th>
													</tr>
												</thead>
												<tbody>		
												<?php foreach( $ratesuppliers as $supplier ){ ?>
													<tr id="trowid_<?php echo $supplier->ratesupplierid; ?>">						
														<td   style="text-align:center" ><label class="toggle"><input class="selectsupplier" type="checkbox" <?php echo $supplier->checked(); ?> title="<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->ratesupplierid; ?>" name="show[<?php echo $supplier->ratesupplierid; ?>]"  id="show_<?php echo $supplier->ratesupplierid; ?>" /><i data-swchon-text="SI" data-swchoff-text="No"></i></label></td>	
														<td id="ssd_<?php echo $supplier->ratesupplierid; ?>"><?php echo $supplier->supplierdsc; ?></td>
														<td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_1_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_1; ?>" /><?php echo $supplier->quantity_1; ?></td>
														<td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_2_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_2; ?>" /><?php echo $supplier->quantity_2; ?></td>
														<td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_3_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_3; ?>" /><?php echo $supplier->quantity_3; ?></td>
														<td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_4_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_4; ?>" /><?php echo $supplier->quantity_4; ?></td>
														<td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_5_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_5; ?>" /><?php echo $supplier->quantity_5; ?></td>
														<td style="text-align:right" ><input type="hidden" title="<?php echo $supplier->ratesupplierid; ?>" id="quantity_6_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->quantity_6; ?>" /><?php echo $supplier->quantity_6; ?></td>
														<td style="text-align:right" ><input value="<?php echo $supplier->percent; ?>" size="3" class="percentcalc" type="text" title="<?php echo $supplier->ratesupplierid; ?>" name="percent[<?php echo $supplier->ratesupplierid; ?>]"  id="percent_<?php echo $supplier->ratesupplierid; ?>" style="width:40px;"/></td>
														<td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_1_<?php echo $supplier->ratesupplierid; ?>"><span id="c_1_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
														<td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_2_<?php echo $supplier->ratesupplierid; ?>"><span id="c_2_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
														<td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_3_<?php echo $supplier->ratesupplierid; ?>"><span id="c_3_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
														<td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_4_<?php echo $supplier->ratesupplierid; ?>"><span id="c_4_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
														<td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_5_<?php echo $supplier->ratesupplierid; ?>"><span id="c_5_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
														<td style="text-align:right" ><input type="hidden" value="0" title="<?php echo $supplier->ratesupplierid; ?>" id="calculate_6_<?php echo $supplier->ratesupplierid; ?>"><span id="c_6_<?php echo $supplier->ratesupplierid; ?>">-</span></td>
														<td style="text-align:center" >												
															<label class="radio">
																<input type="radio" name="selectedsupplier"  id="select_<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->ratesupplierid; ?>" <?php echo $supplier->selected(); ?> />
															<i></i></label>
														</td>
													</tr>
												<?php } ?>
													
													<tr>
														<td colspan="8">&nbsp;</td>
														<td>
															<?php if($model->complete==0){?>
															<button  type="submit" class="btn btn-success btn-xs">Guardar</button>
															<?php } ?>
														</td>
														<td colspan="8">&nbsp;</td>
													</tr>
													<tr>
														<td colspan="17" >&nbsp;
														<input type="hidden" name="ppp[1]" id="ppp_1_<?php echo $model->rateid ?>" />
														<input type="hidden" name="ppp[2]" id="ppp_2_<?php echo $model->rateid ?>" />
														<input type="hidden" name="ppp[3]" id="ppp_3_<?php echo $model->rateid ?>" />
														<input type="hidden" name="ppp[4]" id="ppp_4_<?php echo $model->rateid ?>" />
														<input type="hidden" name="ppp[5]" id="ppp_5_<?php echo $model->rateid ?>" />
														<input type="hidden" name="ppp[6]" id="ppp_6_<?php echo $model->rateid ?>" />
														</td>
													</tr>
													<tr>
														<td width="60">&nbsp;</td>
														<td>Precio Portoprint $</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_pp_1" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_pp_2" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_pp_3" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_pp_4" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_pp_5" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_pp_6" >0</td>
														<td >&nbsp;</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_cpp_1" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_cpp_2" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_cpp_3" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_cpp_4" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_cpp_5" >0</td>
														<td style="text-align:right" id="<?php echo $model->rateid ?>_cpp_6" >0</td>
														<td style="text-align:right" width="60">&nbsp;</td>
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
														<td style="text-align:right" width="60">&nbsp;</td>
													</tr>
													
														
													<tr ><td colspan="17">&nbsp;</td></tr>		
												</tbody>	
										</table>
										</form>	
										
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
									
								</div>
								
							</div>	
						
				</div>
			</div>
		</div>	



<div class="modal fade" id="newpricemanualModal<?php  echo $model->rateid ;?>" tabindex="-1" role="dialog" aria-labelledby="newpricemanualModal<?php  echo $model->rateid ;?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="newpricemanualModal<?php  echo $model->rateid ;?>">Ingresar precio manual</h4>
			</div>
			<div class="modal-body no-padding">
			<?php 
			$suppliersservice = CHtml::listData(Supplierservice::model()->getSupplierbyRateServiceid($entryid, $model->rateid) ,'supplierid','supplierdsc');
			$form=$this->beginWidget('CActiveForm', array(
					'id'=>'manualprice'.$model->rateid.'-form',
					'action'=>'?r=portoprint/rate/savemanualprice/id/'.Utils::encrypt($model->rateid, 'rate'),
					'enableAjaxValidation'=>false,
					'method'=>'POST',
					'htmlOptions'=>array("class"=>"smart-form", "novalidate"=>"novalidate")
				)); ?>
				<fieldset>
					<div class="row">
						<section class="col col-2">Proveedor</section>								
						<section class="col col-10">
							<?php echo $form->dropDownList($manualratesupplier, 'supplierid', $suppliersservice, array('data-placeholder'=>'Selecione', 'style'=>'width:100%', 'class'=>'select2')); ?>
						</section>
					</div>
					<div class="row">
						<section class="col col-2">
							Cantidad
						</section>
						<section class="col col-10">
							Precio
						</section>
					</div>				
					
					<?php if($model->quantity_1){ ?>
					<div class="row">						
						<section class="col col-2">
							<?php echo $model->quantity_1; ?>
						</section>
						<section class="col col-10">
							<input type="text" id="Ratesupplier_quantity_1" name="Ratesupplier[quantity_1]">
						</section>
					</div>
					<?php }  if($model->quantity_2){ ?>
					<div class="row">						
						<section class="col col-2">
							<?php echo $model->quantity_2; ?>
						</section>
						<section class="col col-10">
							<input type="text" id="Ratesupplier_quantity_2" name="Ratesupplier[quantity_2]">
						</section>
					</div>
					<?php }  if($model->quantity_3){ ?>
					<div class="row">						
						<section class="col col-2">
							<?php echo $model->quantity_3; ?>
						</section>
						<section class="col col-10">
							<input type="text" id="Ratesupplier_quantity_3" name="Ratesupplier[quantity_3]">
						</section>
					</div>
					<?php } if($model->quantity_4){ ?>
					<div class="row">						
						<section class="col col-2">
							<?php echo $model->quantity_4; ?>
						</section>
						<section class="col col-10">
							<input type="text" id="Ratesupplier_quantity_4" name="Ratesupplier[quantity_4]">
						</section>
					</div>
					<?php } if($model->quantity_5){ ?>
					<div class="row">						
						<section class="col col-2">
							<?php echo $model->quantity_5; ?>
						</section>
						<section class="col col-10">
							<input type="text" id="Ratesupplier_quantity_5" name="Ratesupplier[quantity_5]">
						</section>
					</div>
					<?php } if($model->quantity_6){ ?>
					<div class="row">						
						<section class="col col-2">
							<?php echo $model->quantity_6; ?>
						</section>
						<section class="col col-10">
							<input type="text" id="Ratesupplier_quantity_6" name="Ratesupplier[quantity_6]">
						</section>
					</div>
					<?php } ?>
						
				
					
				</fieldset>
				<footer>
					<button class="btn btn-primary" type="submit">
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

<div class="modal fade" id="extendrate<?php  echo $model->rateid ;?>" tabindex="-1" role="dialog" aria-labelledby="extendrate<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Extender Evento</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="?r=portoprint/rate/extend/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'extend-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">	
        <fieldset><p>Confirma extender el evento <?php  echo $model->duration ;?> hrs a partir de este momento?</p></fieldset>
        <footer>
	      	<button class="btn btn-primary" type="submit">Aceptar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="freerate<?php  echo $model->rateid ;?>" tabindex="-1" role="dialog" aria-labelledby="freerate<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Liberar Cotización</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="?r=portoprint/rate/extend/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'extend-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">	
        <fieldset><p>Confirma liberar cotización <?php  echo $model->rateid ;?>?</p></fieldset>
        <footer>
	      	<button data-dismiss="modal" class="btn btn-primary" type="button" onclick="finalize('<?php echo Utils::encrypt($model->rateid, 'rate') ?>','<?php echo $model->rateid ?>');">Aceptar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="addpdf<?php  echo $model->rateid ;?>" tabindex="-1" role="dialog" aria-labelledby="addpdf<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar a Resumen</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="?r=portoprint/rate/extend/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'extend-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">	
        <fieldset><p>Confirma agregar la cotización <?php  echo $model->rateid ;?> al resumen?</p></fieldset>
        <footer>
	      	<button data-dismiss="modal" class="btn btn-primary" type="button" onclick="completetopdf('<?php echo Utils::encrypt($model->rateid, 'rate') ?>','<?php echo $model->rateid ?>');">Aceptar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="delpdf<?php  echo $model->rateid ;?>" tabindex="-1" role="dialog" aria-labelledby="delpdf<?php  echo $model->rateid ;?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Remover del Resumen</h4>
      </div>
      <div class="modal-body no-padding">
      	<form method="post" action="?r=portoprint/rate/extend/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'extend-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">	
        <fieldset><p>Confirma remover la cotización <?php  echo $model->rateid ;?> del resumen?</p></fieldset>
        <footer>
	      	<button data-dismiss="modal" class="btn btn-primary" type="button" onclick="removetopdf('<?php echo Utils::encrypt($model->rateid, 'rate') ?>','<?php echo $model->rateid ?>');">Aceptar</button>
			<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>			
	     </footer>
	     </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
<?php 
		$cont = 1;
		$data = array();
		$data[]=array("id"=>$cont++, "content"=>'Creación<br>'.Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'short', 'short'), "start"=>$model->ratedate );
		$ratetracker =  Ratetracker::model()->findAllByAttributes(array("rateid"=>$model->rateid));
		foreach($ratetracker as $event)
			$data[] = array("id"=>$cont++, "content"=>$event->status->statusdsc."<br />".Yii::app()->dateFormatter->formatDateTime($event->statusdate, 'short', 'short'), "start"=>$event->statusdate );
		
		?>
		// PAGE RELATED SCRIPTS
		
		
		
			
			
		
$(document).ready( function(){
	Dropzone.autoDiscover = false;

	 $('#probable_<?php echo $model->rateid ?>').editable({
		 	url:'?r=portoprint/rate/probability/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>',
			name:'probability',
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
	    
	$("#dzone_<?php echo $model->rateid ?>").dropzone({
		//url: "/file/post",
		addRemoveLinks : false,
		maxFilesize: 200,
		dictResponseError: 'Error uploading file!'
	});

	$("#<?php echo 'manualprice'.$model->rateid.'-form' ?> .select2").select2();
 	
	
	
	$('#ratecalculatetable_<?php echo $model->rateid ?> .percentcalc').each( function(){
		var supplierid = $(this).attr('title');
		for(cn=1; cn<=6;cn++){
			var ovalue = Number( $('#quantity_'+cn+'_'+supplierid).val());
			var percent = Number (1 + ($(this).val() / 100));
			var cvalueh = redondeo2decimales(ovalue * percent);
			var cvalue = addCommas(cvalueh);
			$('#ratecalculatetable_<?php echo $model->rateid ?> #calculate_'+cn+'_'+supplierid).val(cvalueh);
			$('#ratecalculatetable_<?php echo $model->rateid ?> #c_'+cn+'_'+supplierid).html(cvalue);	
			calculatesave(cn, '<?php echo $model->rateid ?>','<?php echo $model->formula; ?>');			
		}	
		
	});
	
	$('#ratecalculatetable_<?php echo $model->rateid ?> .percentcalc').keyup( function(){
		var supplierid = $(this).attr('title');
		
		for(cn=1; cn<=6;cn++){
			var ovalue = Number( $('#quantity_'+cn+'_'+supplierid).val());			
			var percent = Number (1 + ($(this).val() / 100));			
			var cvalueh = redondeo2decimales(ovalue * percent);
			var cvalue = addCommas(cvalueh);
			$('#ratecalculatetable_<?php echo $model->rateid ?> #calculate_'+cn+'_'+supplierid).val(cvalueh);
			$('#ratecalculatetable_<?php echo $model->rateid ?> #c_'+cn+'_'+supplierid).html(cvalue);	
			calculatesave(cn, '<?php echo $model->rateid ?>','<?php echo $model->formula; ?>');
				
		}		
	});

	$('#ratecalculatetable_<?php echo $model->rateid ?> .selectsupplier').each( function(){
		var supplierid = $(this).attr('title');
		if($(this).is(':checked')){
			$('#ratecalculatetable_<?php echo $model->rateid ?> #select_'+supplierid).attr('disabled',false).show();
		} else{
			$('#ratecalculatetable_<?php echo $model->rateid ?> #select_'+supplierid).attr('disabled',true).prop('checked',false).hide();
		}
		
	});

	for(cn=1; cn<=6;cn++)
		 calculatesavepp(cn, '<?php echo $model->rateid ?>','<?php echo $model->formula; ?>');	

	if($("#ratecalculatetable_<?php echo $model->rateid ?> input[name='selectedsupplier']:checked").val() != null){
		
		$("#ratecalculatetable_<?php echo $model->rateid ?> input[name='selectedsupplier']").attr('disabled',true);

	}

	$('#ratecalculatetable_<?php echo $model->rateid ?> .selectsupplier').click( function(){
		var supplierid = $(this).attr('title');
		for(cn=1; cn<=6;cn++){
			var ovalue = Number( $('#quantity_'+cn+'_'+supplierid).val());
			var percent = Number (1 + ($('#percent_'+supplierid).val() / 100));
			var cvalueh = redondeo2decimales(ovalue * percent);
			var cvalue = addCommas(cvalueh);
			$('#ratecalculatetable_<?php echo $model->rateid ?> #calculate_'+cn+'_'+supplierid).val(cvalueh);
			$('#ratecalculatetable_<?php echo $model->rateid ?> #c_'+cn+'_'+supplierid).html(cvalue);	
			calculatesave(cn, '<?php echo $model->rateid ?>','<?php echo $model->formula; ?>');			
		}	
		if($(this).is(':checked')){
			console.debug('si'+supplierid);
			$('#ratecalculatetable_<?php echo $model->rateid ?> #select_'+supplierid).attr('disabled',false);
		} else{
			console.debug('no'+supplierid);
			$('#ratecalculatetable_<?php echo $model->rateid ?> #select_'+supplierid).attr('disabled',true).attr('checked',false);
		}
		for(cn=1; cn<=6;cn++)
			 calculatesavepp(cn,'<?php echo $model->rateid ?>', '<?php echo $model->formula; ?>');	
	});

	for(cn=1; cn<=6;cn++)
		 calculatesavepp(cn, '<?php echo $model->rateid ?>','<?php echo $model->formula; ?>');	

	if($("#ratecalculatetable_<?php echo $model->rateid ?> input[name='selectedsupplier']:checked").val() != null){
		
		$("#ratecalculatetable_<?php echo $model->rateid ?> input[name='selectedsupplier']").attr('disabled',true);

	}

	var container_<?php echo $model->rateid ?> = document.getElementById('ratetimeline_<?php echo $model->rateid ?>');
    var data_<?php echo $model->rateid ?> = <?php echo json_encode($data); ?>;
    var options_<?php echo $model->rateid ?> = {height: '100%', orientation: 'top', showCurrentTime: true, start:'<?php echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'short', null) ?>'};
    var timeline_<?php echo $model->rateid ?> = new vis.Timeline(container_<?php echo $model->rateid ?>, data_<?php echo $model->rateid ?>, options_<?php echo $model->rateid ?>);

});



</script>