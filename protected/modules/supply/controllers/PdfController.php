<?php

class PdfController extends Controller
{
	public function init() {
        
    }
    
	public function actionRate($id)
	{ 
		$get = $_GET;
		$nid = Utils::decrypt($id,'rate');
		$model=$this->loadModel($nid);
		if(!isset($get['id_pdf'])){
			$this->redirect(array('price','id'=>Utils::encrypt($model->bundleid, 'rate')));
		}
		
		
		$checked = $get['id_pdf'];
		$bundle = array();
		foreach($checked as $row => $r){
			$bundle[] = $this->loadModel(Utils::decrypt($r,'rate'));
		}
		$content = '
	    <style type="text/css">
		<!--
		table
		{
		
		    border: solid 1px #ffffff;
		    font-size: 11px;
		}
		
		th
		{
		    text-align: center;
		    border: solid 1px #000000;
		    background: #F0EDEE;
		    padding-top: 10px;
		    padding-bottom: 10px;
		}
		
		td
		{
		    text-align: left;
		    border-left: solid 1px #ffffff;
		}
		td.tborder
		{
		    border: solid 1px #000000;
		    padding:4px;
		}
		
		-->
		</style>
		<page backtop="70px" backbottom="5mm">
			<page_header >
				<table width="680">
					<tr>
					<td width="500" style="vertical-align: top;">
						<table>
							<tr><td><img src="http://localhost/sps/images/logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">COTIZACION NO. '.$model->bundleid.'</div>
						<div style="width: 100%;color: #5E5C5D; font-size:11px;">Pagina [[page_cu]]/[[page_nb]]</div>
					</td>
					</tr>
				</table>
			</page_header>
			<page_footer >
				<div style="margin-left: 50px; margin-right:10px; margin-top:30px; font-size: 11px; ">
					Cualquier cambio o ajuste en la cotización esta sujeta a recotización
					Vigencia de la cotizacion: 15 dias Entrega en Area Metropolitana
				</div>
		</page_footer >
		<table width="680" style="margin-top:20px;">
		<tr>
		<td width="500" style="vertical-align: top;">
			<table>
				<tr><td>
					Bosque de Duraznos 65 Int 302A<br>	
					Bosques de las Lomas, Miguel Hidalgo<br>
					Mexico DF, CP 11700<br>
					2451-9210<br>
					impresos-procter@portoprint.mx<br><br>
				</td></tr>
				<tr><td>
					Emitido para:<br>
					'.$model->legalentity.'<br>
					'.$model->street.' '.$model->number.'<br>
					'.$model->neighborhood.', '.$model->citydsc.'<br>
					'.$model->statedsc.', CP '.$model->zipcode.'<br>
					'.$model->phone1.'<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Fecha:</strong><br>
			<span style="margin-left: 20px;">'.Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'medium', false).'</span>
			</td></tr>
			<tr><td class="tborder"><strong>Autorizado por:</strong><br>
			<span style="margin-left: 20px;">Por definir</span>
			</td></tr>
			<tr><td class="tborder"><strong>A la atención de:</strong><br>
			<span style="margin-left: 20px;">'.$model->name.'</span>
			</td></tr>
			<tr><td class="tborder"><strong>Telefono:</strong><br>
			<span style="margin-left: 20px;">'.$model->phone1.'</span>
			</td></tr>
			<tr><td class="tborder"><strong>Vendor :</strong><br>
			<span style="margin-left: 20px;">Por definir</span>
			</td></tr>
		</table>
	</td>
	</tr>
	</table>
	<table cellpadding="0" cellspacing="0" width="680" style="width:680px;">
		<thead>
			<tr>
				<th width="90">ID</th>
				<th width="90">CANTIDAD</th>
				<th width="300">DESCRIPCION</th>
				<th width="100">PRECIO UNITARIO</th>
				<th width="100">PRECIO TOTAL</th>
			</tr>
		</thead>
		';

	$subtotal = 0;
	foreach ($bundle as $rate) {
		$price = $rate->getprice();
		$totalprice = 	$rate->quantityselect * $rate->getprice();
		$content .= '
			<tr>
				<td width="90" valign="top" style="text-align: center;" class="tborder">'.$model->idVersion().'</td>
				<td width="90" valign="top" style="text-align: center;" class="tborder">'.$rate->quantityselect.'</td>
				<td width="300" valign="top" class="tborder">'.$this->getDetaillite($rate->rateid, $rate->servicedsc, $rate->note, $model->projectdsc, $model->branddsc).'</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($price, 2).'</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($totalprice, 2).'</td>
			</tr>
		';
		$subtotal+=$totalprice;
	} 
	$iva = $subtotal * ($model->iva / 100);
	$total = $subtotal + $iva;
	$content .= '
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($subtotal, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA '.$model->iva.' %</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($iva, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($total, 2).'</td>
		</tr>
		</table>
		
		</page>
		';

		$html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('Cotizacion_'.$model->bundleid.'.pdf', 'D');
        
	}
	
	public function actionOdp($id)
	{ 
		$get = $_GET;
		//$nid = Utils::decrypt($id,'rate');
		$odp = $this->loadModelODP($id);
		$model = $this->loadModel($id);
		
		$content = '
	    <style type="text/css">
		<!--
		table
		{
		
		    border: solid 1px #ffffff;
		    font-size: 11px;
		}
		
		th
		{
		    text-align: center;
		    border: solid 1px #000000;
		    background: #F0EDEE;
		    padding-top: 10px;
		    padding-bottom: 10px;
		}
		
		td
		{
		    text-align: left;
		    border-left: solid 1px #ffffff;
		}
		td.tborder
		{
		    border: solid 1px #000000;
		    padding:4px;
		}
		
		-->
		</style>
		<page backtop="70px" backbottom="5mm">
			<page_header >
				<table width="680">
					<tr>
					<td width="500" style="vertical-align: top;">
						<table>
							<tr><td><img src="http://localhost/'. yii::app()->request->baseUrl.'/images/logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">ORDEN DE PRODUCCIÓN '.$model->idVersion().'</div>
						<div style="width: 100%;color: #5E5C5D; font-size:11px;">Pagina [[page_cu]]/[[page_nb]]</div>
					</td>
					</tr>
				</table>
			</page_header>
			<page_footer >
				<div style="margin-left: 50px; margin-right:10px; margin-top:30px; font-size: 11px; ">
					Cualquier cambio o ajuste en la cotización esta sujeta a recotización
					Vigencia de la cotizacion: 15 dias Entrega en Area Metropolitana
				</div>
		</page_footer >
		<table width="680" style="margin-top:20px;">
		<tr>
		<td width="500" style="vertical-align: top;">
			<table>
				<tr><td>
					Bosque de Duraznos 65 Int 302A<br>	
					Bosques de las Lomas, Miguel Hidalgo<br>
					Mexico DF, CP 11700<br>
					2451-9210<br>
					impresos-procter@portoprint.mx<br><br>
				</td></tr>
				<tr><td>
					Emitido para:<br>
					'.$odp->corporatename.'<br>
					'.$odp->address.'<br>
					'.$odp->suburb.', '.$odp->citydsc.'<br>
					'.$odp->statedsc.'. CP: '.$odp->cp.'<br>
					Tel: '.$odp->phone.'<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Cotización:</strong><br>
				<span style="margin-left: 20px;">'.$model->idVersion().'</span>
			</td></tr>
			<tr><td  width="180"  class="tborder"><strong>Fecha de Emisión:</strong><br>
			<span style="margin-left: 20px;">'.Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'medium', false).'</span>
			</td></tr>
			<tr><td class="tborder"><strong>Proveedor No:</strong><br>
			<span style="margin-left: 20px;">'.$odp->supplierid.'</span>
			</td></tr>
		</table>
	</td>
	</tr>
	</table>
	<table cellpadding="0" cellspacing="0" width="680" style="width:680px;">
		<thead>
			<tr>
				<th width="90">ID</th>
				<th width="90">CANTIDAD</th>
				<th width="300">DESCRIPCION</th>
				<th width="100">PRECIO UNITARIO</th>
				<th width="100">PRECIO TOTAL</th>
			</tr>
		</thead>
		';

	$subtotal = 0;
	$totalprice = $odp->price * $odp->quantityselect;
	$content .= '<tr>
				<td width="90" valign="top" style="text-align: center;" class="tborder">'.$model->idVersion().'</td>
				<td width="90" valign="top" style="text-align: center;" class="tborder">'.$odp->quantityselect.'</td>
				<td width="300" valign="top" class="tborder">'.$this->getDetaillite($odp->rateid, $odp->servicedsc, $odp->note, $model->projectdsc, $model->branddsc).'</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($odp->price, 2).'</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($totalprice, 2).'</td>
			</tr>';
	
	$iva = $totalprice * ($model->iva / 100);
	$total = $totalprice + $iva;
	$content .= '
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($totalprice, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA '.$model->iva.' %</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($iva, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($total, 2).'</td>
		</tr>
		</table>
		
		</page>
		';

		$html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('ODP_'.$odp->rateid.'.pdf', 'D');
        
	}
	
	
	public function actionOdc($id)
	{ 
		//$get = $_GET;
               
		//$nid = Utils::decrypt($id,'rate');
		$odc = $this->loadModelODC($id);
		$model = $this->loadModel($id);
		// echo $id; 
	$content = '
	    <style type="text/css">
		<!--
		table
		{
		
		    border: solid 1px #ffffff;
		    font-size: 11px;
		}
		
		th
		{
		    text-align: center;
		    border: solid 1px #000000;
		    background: #F0EDEE;
		    padding-top: 10px;
		    padding-bottom: 10px;
		}
		
		td
		{
		    text-align: left;
		    border-left: solid 1px #ffffff;
		}
		td.tborder
		{
		    border: solid 1px #000000;
		    padding:4px;
		}
		
		-->
		</style>
		<page backtop="70px" backbottom="5mm">
			<page_header >
				<table width="680">
					<tr>
					<td width="500" style="vertical-align: top;">
						<table> 
							<tr><td><img src="http://localhost/'. yii::app()->request->baseUrl.'/images/logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">ORDEN DE COMPRA '.$model->idVersion().'</div>
						<div style="width: 100%;color: #5E5C5D; font-size:11px;">Pagina [[page_cu]]/[[page_nb]]</div>
					</td>
					</tr>
				</table>
			</page_header>
			<page_footer >
				<div style="margin-left: 50px; margin-right:10px; margin-top:30px; font-size: 11px; ">
					Cualquier cambio o ajuste en la cotización esta sujeta a recotización
					Vigencia de la cotizacion: 15 dias Entrega en Area Metropolitana
				</div>
		</page_footer >
		<table width="680" style="margin-top:20px;">
		<tr>
		<td width="500" style="vertical-align: top;">
			<table>
				<tr><td>
					Bosque de Duraznos 65 Int 302A<br>	
					Bosques de las Lomas, Miguel Hidalgo<br>
					Mexico DF, CP 11700<br>
					2451-9210<br>
					impresos-procter@portoprint.mx<br><br>
				</td></tr>
				<tr><td>
					Emitido para:<br>
					'.$odc->corporatename.'<br>
					'.$odc->address.'<br>
					'.$odc->suburb.', '.$odc->citydsc.'<br>
					'.$odc->statedsc.'. CP: '.$odc->cp.'<br>
					Tel: '.$odc->phone.'<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Cotización:</strong><br>
				<span style="margin-left: 20px;">'.$model->idVersion().'</span>
			</td></tr>
			<tr><td  width="180"  class="tborder"><strong>Fecha de Emisión:</strong><br>
			<span style="margin-left: 20px;">'.Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'medium', false).'</span>
			</td></tr>
			<tr><td class="tborder"><strong>Proveedor No:</strong><br>
			<span style="margin-left: 20px;">'.$odc->supplierid.'</span>
			</td></tr>
		</table>
	</td>
	</tr>
	</table>
	<table cellpadding="0" cellspacing="0" width="680" style="width:680px;">
		<thead>
			<tr>
				<th width="90">ID</th>
				<th width="90">CANTIDAD</th>
				<th width="300">DESCRIPCION</th>
				<th width="100">PRECIO UNITARIO</th>
				<th width="100">PRECIO TOTAL</th>
			</tr>
		</thead>
		';

	$subtotal = 0;
	$totalprice = $odc->price * $odc->quantityselect;
	$content .= '<tr>
				<td width="90" valign="top" style="text-align: center;" class="tborder">'.$model->idVersion().'</td>
				<td width="90" valign="top" style="text-align: center;" class="tborder">'.$odc->quantityselect.'</td>
				<td width="300" valign="top" class="tborder">'.$this->getDetaillite($odc->rateid, $odc->servicedsc, $odc->note, $odc->projectdsc, $odc->branddsc).'</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($odc->price, 2).'</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($totalprice, 2).'</td>
			</tr>';
	
	$iva = $totalprice * ($model->iva / 100);
	$total = $totalprice + $iva;
	$content .= '
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($totalprice, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA '.$model->iva.' %</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($iva, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($total, 2).'</td>
		</tr>
		</table>
		
		</page>
		';
        
	$html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('ODC_'.$odc->rateid.'.pdf', 'D');
        
        
	}
	
	public function actionBundle($id)
	{ 
		$get = $_GET;
		$nid = Utils::decrypt($id,'rate');
		$model=$this->loadBundleModel($nid);
		
		$bundles = Rate::model()->findAllByAttributes(array('bundleid'=>$nid,'complete'=>1,'active'=>1));
		

		$content = '
	    <style type="text/css">
		<!--
		table
		{
		
		    border: solid 1px #ffffff;
		    font-size: 11px;
		}
		
		th
		{
		    text-align: center;
		    border: solid 1px #000000;
		    background: #F0EDEE;
		    padding-top: 10px;
		    padding-bottom: 10px;
		}
		
		td
		{
		    text-align: left;
		    border-left: solid 1px #ffffff;
		}
		td.tborder
		{
		    border: solid 1px #000000;
		    padding:4px;
		}
		
		-->
		</style>
		<page backtop="70px" backbottom="5mm">
			<page_header >
				<table width="680">
					<tr>
					<td width="500" style="vertical-align: top;">
						<table>
							<tr><td><img src="http://localhost/sps/images/logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">COTIZACION NO. '.$model->bundleid.'</div>
						<div style="width: 100%;color: #5E5C5D; font-size:11px;">Pagina [[page_cu]]/[[page_nb]]</div>
					</td>
					</tr>
				</table>
			</page_header>
			<page_footer >
				<div style="margin-left: 50px; margin-right:10px; margin-top:30px; font-size: 11px; ">
					Cualquier cambio o ajuste en la cotización esta sujeta a recotización
					Vigencia de la cotizacion: 15 dias Entrega en Area Metropolitana
				</div>
		</page_footer >
		<table width="680" style="margin-top:20px;">
		<tr>
		<td width="500" style="vertical-align: top;">
			<table>
				<tr><td>
					Bosque de Duraznos 65 Int 302A<br>	
					Bosques de las Lomas, Miguel Hidalgo<br>
					Mexico DF, CP 11700<br>
					2451-9210<br>
					impresos-procter@portoprint.mx<br><br>
				</td></tr>
				<tr><td>
					Emitido para:<br>
					'.$model->legalentity.'<br>
					'.$model->street.' '.$model->number.'<br>
					'.$model->neighborhood.', '.$model->citydsc.'<br>
					'.$model->statedsc.', CP '.$model->zipcode.'<br>
					'.$model->phone1.'<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Fecha:</strong><br>
			<span style="margin-left: 20px;">'.Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'medium', false).'</span>
			</td></tr>
			<tr><td class="tborder"><strong>Autorizado por:</strong><br>
			<span style="margin-left: 20px;">Por definir</span>
			</td></tr>
			<tr><td class="tborder"><strong>A la atención de:</strong><br>
			<span style="margin-left: 20px;">'.$model->name.'</span>
			</td></tr>
			<tr><td class="tborder"><strong>Telefono:</strong><br>
			<span style="margin-left: 20px;">'.$model->phone1.'</span>
			</td></tr>
			<tr><td class="tborder"><strong>Vendor :</strong><br>
			<span style="margin-left: 20px;">Por definir</span>
			</td></tr>
		</table>
	</td>
	</tr>
	</table>
	<table cellpadding="0" cellspacing="0" width="680" style="width:680px;">
		<thead>
			<tr>
				<th width="90">ID</th>
				<th width="90">CANTIDAD</th>
				<th width="300">DESCRIPCION</th>
				<th width="100">PRECIO UNITARIO</th>
				<th width="100">PRECIO TOTAL</th>
			</tr>
		</thead>
		';

	$subtotal = 0;
	foreach ($bundles as $row) {
		$rate = $this->loadModel($row->rateid);
		$price = $rate->getprice();
		$totalprice = 	$rate->quantityselect * $rate->getprice();
		$content .= '
			<tr>
				<td width="90" valign="top" style="text-align: center;" class="tborder">'.$rate->idVersion().'</td>';
		$content .= '<td width="90" valign="top" style="text-align: center;" class="tborder">'.$rate->quantityselect.'</td>';
		
		$content .= '<td width="300" valign="top" class="tborder">'.$this->getDetaillite($rate->rateid, $rate->servicedsc, $rate->note, $rate->projectdsc, $rate->branddsc).'</td>';
		$content .=	'<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($price, 2).'</td>';
		
		$content .=	'<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($totalprice, 2).'</td>
			</tr>
		';
		$subtotal+=$totalprice;
	} 
	$iva = $subtotal * ($rate->iva / 100);
	$total = $subtotal + $iva;
	$content .= '
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($subtotal, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA '.$rate->iva.' %</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($iva, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($total, 2).'</td>
		</tr>
		</table>
		
		</page>
		';

		$html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('Cotizacion_'.$rate->bundleid.'.pdf', 'D');
        
	}
	
	public function actionOdpd($id)
	{ 
		$get = $_GET;
		$nid = Utils::decrypt($id,'rate');
		$odp = $this->loadModelODP($nid);
		$model = $this->loadModel($nid);
		
		$content = '
	    <style type="text/css">
		<!--
		table
		{
		
		    border: solid 1px #ffffff;
		    font-size: 11px;
		}
		
		th
		{
		    text-align: center;
		    border: solid 1px #000000;
		    background: #F0EDEE;
		    padding-top: 10px;
		    padding-bottom: 10px;
		}
		
		td
		{
		    text-align: left;
		    border-left: solid 1px #ffffff;
		}
		td.tborder
		{
		    border: solid 1px #000000;
		    padding:4px;
		}
		
		-->
		</style>
		<page backtop="70px" backbottom="5mm">
			<page_header >
				<table width="680">
					<tr>
					<td width="500" style="vertical-align: top;">
						<table>
							<tr><td><img src="http://localhost/sps/images/logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">ORDEN DE PAGO '.$model->idVersion().'</div>
						<div style="width: 100%;color: #5E5C5D; font-size:11px;">Pagina [[page_cu]]/[[page_nb]]</div>
					</td>
					</tr>
				</table>
			</page_header>
			<page_footer >
				<div style="margin-left: 50px; margin-right:10px; margin-top:30px; font-size: 11px; ">
					Cualquier cambio o ajuste en la cotización esta sujeta a recotización
					Vigencia de la cotizacion: 15 dias Entrega en Area Metropolitana
				</div>
		</page_footer >
		<table width="680" style="margin-top:20px;">
		<tr>
		<td width="500" style="vertical-align: top;">
			<table>
				<tr><td>
					Bosque de Duraznos 65 Int 302A<br>	
					Bosques de las Lomas, Miguel Hidalgo<br>
					Mexico DF, CP 11700<br>
					2451-9210<br>
					impresos-procter@portoprint.mx<br><br>
				</td></tr>
				<tr><td>
					Emitido para:<br>
					'.$odp->corporatename.'<br>
					'.$odp->address.'<br>
					'.$odp->suburb.', '.$odp->citydsc.'<br>
					'.$odp->statedsc.'. CP: '.$odp->cp.'<br>
					Tel: '.$odp->phone.'<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Cotización:</strong><br>
				<span style="margin-left: 20px;">'.$model->idVersion().'</span>
			</td></tr>
			<tr><td  width="180"  class="tborder"><strong>Fecha de Emisión:</strong><br>
			<span style="margin-left: 20px;">'.Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'medium', false).'</span>
			</td></tr>
			<tr><td class="tborder"><strong>Proveedor No:</strong><br>
			<span style="margin-left: 20px;">'.$odp->supplierid.'</span>
			</td></tr>
		</table>
	</td>
	</tr>
	</table>
	<table cellpadding="0" cellspacing="0" width="680" style="width:680px;">
		<thead>
			<tr>
				<th width="90">ID</th>
				<th width="90">CANTIDAD</th>
				<th width="300">DESCRIPCION</th>
				<th width="100">PRECIO UNITARIO</th>
				<th width="100">PRECIO TOTAL</th>
			</tr>
		</thead>
		';

	$subtotal = 0;
	$totalprice = $odp->price * $odp->quantityselect;
	$content .= '<tr>
				<td width="90" valign="top" style="text-align: center;" class="tborder">'.$model->idVersion().'</td>
				<td width="90" valign="top" style="text-align: center;" class="tborder">'.$odp->quantityselect.'</td>
				<td width="300" valign="top" class="tborder">'.$this->getDetaillite($odp->rateid, $odp->servicedsc, $odp->note, $model->projectdsc, $model->branddsc).'</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($odp->price, 2).'</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ '.number_format($totalprice, 2).'</td>
			</tr>';
	
	$iva = $totalprice * ($model->iva / 100);
	$total = $totalprice + $iva;
	$content .= '
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($totalprice, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA '.$model->iva.' %</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($iva, 2).'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ '.number_format($total, 2).'</td>
		</tr>
		</table>
		
		</page>
		';

		$html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('ODP_'.$odp->rateid.'.pdf', 'D');
        
	}
	
	static function getDetail($rateid, $servicedsc, $note){
		$details = Rateitemdetailvalue::model()->getDetail_su($rateid);
		$detail ="<span style='font-size:8.5px;'>";
		foreach($details as $row){
			$detail.= "<b>".$row->itemdetaildsc.":</b>".$row->itemdetailvaluedsc.", ";
		} 
		$detail .=" <b>Observaciones:</b> ".$note."</span>";
		return '<i style="color:#0088CC; cursor:pointer;"  class="ratepop" data-placement="right" data-title="'.$servicedsc.'" data-content="'.$detail.'">'.$servicedsc.'</i>';
	
	}
	
	static function getDetaillite($rateid, $servicedsc, $note, $projectdsc, $branddsc){
		$details = Rateitemdetailvalue::model()->getDetail_su($rateid);
		$detail = "<b>Item: ".$servicedsc."</b><br /><b>Marca: ".$branddsc."</b><br /><b>Campaña / Proyecto: ".$projectdsc."</b><br /><p>";
		foreach($details as $row){
			$detail.= $row->itemdetaildsc.":".$row->itemdetailvaluedsc."<br />";
		} 
		$detail .=" <br>Observaciones: ".$note."</p><br /><br /><br />";
		return $detail;
	
	}
	
	public function loadModel($id)
	{
		$model= Rate::model()->modelByRateid_su($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelODP($id)
	{
		$model= Rateodp::model()->odpByUser_sup($id, Yii::app()->user->userid);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelODC($id)
	{
		$model= Rateodc::model()->odcByUser_sup($id, Yii::app()->user->userid);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadBundleModel($id)
	{
		$model=Rate::model()->bundle_su($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}