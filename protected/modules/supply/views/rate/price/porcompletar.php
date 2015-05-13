<?php var_dump($model->idVersion()); ?>
<div class="jarviswidget jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
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
								<div class="alert in alert-block fade alert-danger">		            
						            <table class="items " width="100%" >
						            <tr><td width="80%">La cotización debe ser completada.</td>
						            <td><a href="#index.php?r=portoprint/rate/created2/id/<?php echo Utils::encrypt($model->rateid,'rate'); ?>" class="btn btn-danger btn-lg">Completar</a></td></tr>
						            </table>
						         </div>
							</div>	
						
				</div>
			</div>
		</div>	






