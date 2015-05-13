


<div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2><strong><?php echo $model->idVersion()."  ".$model->servicedsc ?></strong> </h2>				
					
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
								<table class="table table-condensed" >
									<thead>
										<tr>
											<td style="width:50%">
											<strong>Item:</strong> <?php echo RateController::getDetail($model->rateid,$model->servicedsc,$model->note, $model->idVersion())?><br>
											<strong>Comprador:</strong> <?php echo $model->firstname ?><br>
											<strong>Creación:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'full', 'full') ; ?>
											</td>
											<td>
											<strong>Estatus:</strong> <?php echo $model->statusdsc; ?><br>
											<strong>Finalización:</strong> N/A
											
											</td>
										</tr>
									</thead>
								</table>
							</div>
							<div>
								<div class="alert in alert-block fade alert-info">	
									<form method="post" action="?r=portoprint/rate/selsuppliers/id/<?php echo Utils::encrypt($model->rateid, 'rate'); ?>/add/<?php echo Utils::encrypt($add,'rate'); ?>/edt/<?php echo Utils::encrypt($edt,'rate'); ?>/del/<?php echo Utils::encrypt($del,'rate'); ?>/menu/<?php echo Utils::encrypt($menu,'rate'); ?>" id="<?php echo 'ratesupplier-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">            
						            <table class="items " width="100%" >
						            <tr><td width="80%">Para recotizar debe seleccionar proveedores.<br />
						             <?php 
							            
										$supplier = CHtml::listData(Supplierservice::model()->getSupplierbyServiceid($model->entryid),'supplierid','supplierdsc');
										 ?>
							            <select id="Rate_supplier" name="Rate_supplier[]" class="select2" style="width: 90%;" multiple><option value="">Seleccione</option>
										<?php foreach($supplier as $value=> $text){?>
											<option value="<?php echo $value; ?>"><?php echo $text; ?></option>
										<?php } ?>
										</select>
						            </td>
						            <td><button type="submit" class="btn btn-info btn-lg">Recotizar</button></td></tr>
						            </table>
						            </form>
						         </div>
							</div>	
						
				</div>
			</div>
		</div>	

<script>
$(document).ready(function(){
	$("#Rate_supplier").select2();
	
});
</script>

