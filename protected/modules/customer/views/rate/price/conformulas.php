
<?php 
$rs = Ratesupplier::model()->findByAttributes(array('rateid'=>$model->rateid, 'statusid'=>11));
$sp = Supplier::model()->findByPk($rs->supplierid);

	$butons=array(array('label' => 'Ver Detalles', 'url'=>Yii::app()->createAbsoluteUrl('/portoprint/rate/view',array('id'=>Utils::encrypt($model->rateid, 'rate')))));
	if($model->odptime==null)
		array_push($butons, array('label' => 'Generar ODP', 'url'=>'#'));
	if($model->odctime==null)
		array_push($butons,array('label' => 'Generar ODC', 'url'=>'#', 'htmlOptions'=>array("data-target"=>"#ODCModal".$model->rateid, "data-toggle"=>"modal")));

    $box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    	'title' => '<input type="checkbox" name="id_pdf[]" value="'.Utils::encrypt($model->rateid, 'rate').'" class="id_pdf" style="margin-bottom:6px; margin-right:10px;">[ '.strtoupper($entry).' ] COTIZACIÓN-ITEM ID '.$model->idVersion(),
    	'headerButtons' => array(
				    array(
					    'class' => 'bootstrap.widgets.TbButtonGroup',
				        'type' => 'success',
					    'buttons' => $butons
				    )
    	)
    ));
	?>
<div id="tcalculator" >
	<div class="well-small">
		<table class="table table-condensed" >
			<thead>
			<tr>
				<td style="width:50%">
				<strong>Item:</strong> <?php echo RateController::getDetail($model->rateid,$model->servicedsc,$model->note)?><br>
				<strong>Comprador:</strong> <?php echo $model->firstname ?><br>
				<strong>Creación:</strong> <?php echo Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'full', 'full') ; ?>
				</td>
				<td>
				<strong>Estatus:</strong> <?php echo $model->statusdsc; ?><br>
				<strong>Finalización:</strong> <?php  echo Yii::app()->dateFormatter->formatDateTime(date( "Y-m-d H:i:s", strtotime( $model->statustime." + ".$model->duration." hours" ) ), 'full', 'full')  ;?>
				
				</td>
			</tr>
			</thead>
		</table>
	</div>
	
	<table id="ratecalculatetable" class="items table table-striped table-bordered table-condensed">
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
				<th width="80" style="text-align:center"><?php echo $model->quantity_1; ?></th>
				<th width="80" style="text-align:center"><?php echo $model->quantity_2; ?></th>
				<th width="80" style="text-align:center"><?php echo $model->quantity_3; ?></th>
				<th width="80" style="text-align:center"><?php echo $model->quantity_4; ?></th>
				<th width="80" style="text-align:center"><?php echo $model->quantity_5; ?></th>
				<th width="80" style="text-align:center"><?php echo $model->quantity_6; ?></th>
				<th width="60" style="text-align:center">Seleccionar</th>
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
				$acum_1 += $pricefee_1;
				$acum1 += $supplier->quantity_1;
				array_push($min_1, $pricefee_1) ;
				array_push($min1, $supplier->quantity_1) ;
				$pricefee_2 = number_format($supplier->quantity_2 * (1+($supplier->percent/100)), 2, '.', '');
				$acum_2 += $pricefee_2;
				$acum2 += $supplier->quantity_2;
				array_push($min_2, $pricefee_2) ;
				array_push($min2, $supplier->quantity_2) ;
				$pricefee_3 = number_format($supplier->quantity_3 * (1+($supplier->percent/100)), 2, '.', '');
				$acum_3 += $pricefee_3;
				$acum3 += $supplier->quantity_3;
				array_push($min_3, $pricefee_3) ;
				array_push($min3, $supplier->quantity_3) ;
				$pricefee_4 = number_format($supplier->quantity_4 * (1+($supplier->percent/100)), 2, '.', '');
				$acum_4 += $pricefee_4;
				$acum4 += $supplier->quantity_4;
				array_push($min_4, $pricefee_4) ;
				array_push($min4, $supplier->quantity_4) ;
				$pricefee_5 = number_format($supplier->quantity_5 * (1+($supplier->percent/100)), 2, '.', '');
				$acum_5 += $pricefee_5;
				$acum5 += $supplier->quantity_5;
				array_push($min_5, $pricefee_5) ;
				array_push($min5, $supplier->quantity_5) ;
				$pricefee_6 = number_format($supplier->quantity_6 * (1+($supplier->percent/100)), 2, '.', '');
				$acum_6 += $pricefee_6;
				$acum6 += $supplier->quantity_6;
				array_push($min_6, $pricefee_6) ;
				array_push($min6, $supplier->quantity_6) ;
			?>
			<tr id="trowid_<?php echo $supplier->ratesupplierid; ?>" <?php echo $supplier->selectedrow(); ?> >						
				<td   style="text-align:center" ><input type="checkbox" <?php echo $supplier->checked(); ?>  title="<?php echo $supplier->ratesupplierid; ?>" value="<?php echo $supplier->ratesupplierid; ?>" id="show_<?php echo $supplier->ratesupplierid; ?>" disabled="disabled" /></td>	
				<td id="ssd_<?php echo $supplier->ratesupplierid; ?>"><?php echo $supplier->supplierdsc; ?></td>
				<td style="text-align:right" ><?php echo $supplier->quantity_1; ?></td>
				<td style="text-align:right" ><?php echo $supplier->quantity_2; ?></td>
				<td style="text-align:right" ><?php echo $supplier->quantity_3; ?></td>
				<td style="text-align:right" ><?php echo $supplier->quantity_4; ?></td>
				<td style="text-align:right" ><?php echo $supplier->quantity_5; ?></td>
				<td style="text-align:right" ><?php echo $supplier->quantity_6; ?></td>
				<td style="text-align:right" ><input value="<?php echo $supplier->percent; ?>" size="3" type="text" id="percent_<?php echo $supplier->ratesupplierid; ?>" style="width:80px;" disabled="disabled"/></td>
				<td style="text-align:right" ><span id="c_1_<?php echo $supplier->ratesupplierid; ?>"><?php echo $pricefee_1; ?></span></td>
				<td style="text-align:right" ><span id="c_2_<?php echo $supplier->ratesupplierid; ?>"><?php echo $pricefee_2; ?></span></td>
				<td style="text-align:right" ><span id="c_3_<?php echo $supplier->ratesupplierid; ?>"><?php echo $pricefee_3; ?></span></td>
				<td style="text-align:right" ><span id="c_4_<?php echo $supplier->ratesupplierid; ?>"><?php echo $pricefee_4; ?></span></td>
				<td style="text-align:right" ><span id="c_5_<?php echo $supplier->ratesupplierid; ?>"><?php echo $pricefee_5; ?></span></td>
				<td style="text-align:right" ><span id="c_6_<?php echo $supplier->ratesupplierid; ?>"><?php echo $pricefee_6; ?></span></td>
				<td style="text-align:center" ><?php echo $supplier->selectedicon(); ?></td>
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
				<td width="60">&nbsp;</td>
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
				<td width="60">&nbsp;</td>
			</tr>	
			<tr ><td colspan="17">&nbsp;</td></tr>
			
			<tr>
				<td colspan="8">&nbsp;</td>
				<td width="30"> 00000000</td>
				<td width="80" align="right">$ 0.0</td>
				<td width="80" align="right">$ 0.0</td>
				<td width="80" align="right">$ 0.0</td>
				<td width="80" align="right">$ 0.0</td>
				<td width="80" align="right">$ 0.0</td>
				<td width="80" align="right">$ 0.0</td>
				<td width="60">&nbsp;</td>
			</tr>			
			<tr ><td colspan="17">&nbsp;</td></tr>		
		</tbody>	
	</table>
</div>


<div id="requotediv" style="display: none; margin:30px; width:400px; ">
	<div class="ui-jqgrid-titlebar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
		<span class="ui-jqgrid-title" style="padding:10px;">Recotizar</span>
	</div>
	<div  class="ui-widget-content" style="padding:5px;" >	    	
		<form id="rqform" action="/purchasing/RateAction.do" >
		<table id="rqtable" cellspacing="0" border="0" cellpadding="1" width="350">
			<tr><td>&nbsp;
				Seleccione los proveedores que participaron con nuevo precio en la recotización, los proveedores no selecionados mantrendrán el mismo precio que tuvieron para ésta cotización.
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



<?php $this->endWidget();?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'ODCModal'.$model->rateid)); ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'manualprice'.$model->rateid.'-form',
		'action'=>Yii::app()->createAbsoluteUrl('/portoprint/rate/generateodc', array('id'=>Utils::encrypt($model->rateid, 'rate'))),
		'enableAjaxValidation'=>false,
	)); ?> 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Orden de Compra</h4>
</div>
<div class="modal-body">
	<table class="table table-condensed">
			<thead>
			<tr>
				<th style="width:160px;"><strong>COTIZACION-ITEM:</strong></th><td><?php echo $model->rateid; ?></td>
			</tr>
			<tr>
				<th ><strong>ITEM:</strong></th><td><?php echo $model->servicedsc; ?></td>
			</tr>
			<tr>
				<th><strong>PROVEEDOR:</strong></th><td><?php echo $sp->supplierdsc; ?></td>
			</tr>
			<tr>
				<th><strong>IVA:</strong></th><td><input type="text" name="ivaodc" id="ivaodc_<?php echo $model->rateid; ?>" value="16" size="2" maxlength="2" style="width: 50px;"></input>%</td>
			</tr>
			<tr>
				<th><strong>No. ODC Cliente:</strong></th><td><input type="text" id="nodcc_<?php echo $model->rateid; ?>" name="nodcc" size="15" /></td>
			</tr>
			<tr>
				<th><strong>Fecha ODC Cliente:</strong></th><td><input type="text" id="fodcc_<?php echo $model->rateid; ?>" name="fodcc" class="calend" size="15" /></td>
			</tr>
			</thead>
		</table>
</div> 
<div class="modal-footer">
      <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Aceptar',
    	'buttonType'=>'submit',
   	    'url'=>'#'
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cancelar',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
<?php $this->endWidget(); ?> 
<?php $this->endWidget(); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'ODPModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Orden de Produccion</h4>
</div>
<div class="modal-body">
	COTIZACION:  <strong>00014255 </strong><br />
	ITEM: <strong>CENEFA</strong><br />
	PROVEEDOR: <strong><span id="ssnodp"></span></strong><br />
	<input type="hidden" name="pq_sel" id="pq_sel" value="720000" />
</div> 
<div class="modal-footer">
     <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Aceptar',
    	'buttonType'=>'submit',
   	    'url'=>'#'
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cancelar',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>
<script>
$(document).ready( function(){
	$("#fodcc_<?php echo $model->rateid; ?>").datepicker({format:'yyyy-mm-dd'});
	
});
</script>