<?php

class PdfController extends Controller {

    public function init() {
        
    }

    public function actionRate($id) {
        $get = $_GET;
        $nid = Utils::decrypt($id, 'rate');
        $model = $this->loadModel($nid);
        if (!isset($get['id_pdf'])) {
            $this->redirect(array('price', 'id' => Utils::encrypt($model->bundleid, 'rate')));
        }


        $checked = $get['id_pdf'];
        $bundle = array();
        foreach ($checked as $row => $r) {
            $bundle[] = $this->loadModel(Utils::decrypt($r, 'rate'));
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
							<tr><td><img src="' . Yii::app()->params->imagePath . 'logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">COTIZACION NO. ' . $model->bundleid . '</div>
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
					' . $model->legalentity . '<br>
					' . $model->street . ' ' . $model->number . '<br>
					' . $model->neighborhood . ', ' . $model->citydsc . '<br>
					' . $model->statedsc . ', CP ' . $model->zipcode . '<br>
					' . $model->phone1 . '<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Fecha:</strong><br>
			<span style="margin-left: 20px;">' . Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'medium', false) . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>Autorizado por:</strong><br>
			<span style="margin-left: 20px;">Por definir</span>
			</td></tr>
			<tr><td class="tborder"><strong>A la atención de:</strong><br>
			<span style="margin-left: 20px;">' . $model->name . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>Telefono:</strong><br>
			<span style="margin-left: 20px;">' . $model->phone1 . '</span>
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
            $totalprice = $rate->quantityselect * $rate->getprice();
            $content .= '
			<tr>
				<td width="90" valign="top" style="text-align: center;" class="tborder">' . $model->idVersion() . '</td>
				<td width="90" valign="top" style="text-align: center;" class="tborder">' . $rate->quantityselect . '</td>
				<td width="300" valign="top" style="font-size:9px;" class="tborder">' . $this->getDetaillite($rate->rateid, $rate->servicedsc, $rate->note, $model->projectdsc, $model->branddsc) . '</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ ' . number_format($price, 2) . '</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ ' . number_format($totalprice, 2) . '</td>
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
			<td style="text-align: right;" class="tborder">$ ' . number_format($subtotal, 2) . '</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA ' . $model->iva . ' %</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($iva, 2) . '</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($total, 2) . '</td>
		</tr>
		</table>
ID Cotización: 00008384
Cliente: PROCTER & GAMBLE MEXICO
Marca: HAIR COLOR
Proyecto: CONDITIONING
		
		</page>
		';

        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('Cotizacion_' . $model->bundleid . '.pdf', 'D');
    }

    public function actionOdp() {
        $get = $_GET;
        $id = $_GET['id'];
        $bundleid = $_GET['bundle'];
        $nid = Utils::decrypt($_GET['id'], 'rate');
        $bundle = Utils::decrypt($_GET['bundle'], 'rate');
        $cantpar = $_GET['cantpar'];
        $cantot = $_GET['cantot'];
        $insremision = new Rateremision();
        $insremision->cantparcial = $cantpar;
        $insremision->rateid = $nid;
        $insremision->insert();

        $odp = $this->loadModelODP($nid);
        $model = $this->loadModel($nid);

        $lista = Rate::model()->bundle_pdf2($bundle, $nid);

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
							<tr><td><img src="' . Yii::app()->params->imagePath . 'logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">REMISION NO° ' . $model->idVersion() . '</div>
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
					30-88-43-00<br>
					impresos-procter@portoprint.mx<br><br>
				</td></tr>
				<tr><td>
					Emitido para:<br>
					' . $odp->corporatename . '<br>
					' . $odp->address . '<br>
					' . $odp->suburb . ', ' . $odp->citydsc . '<br>
					' . $odp->statedsc . '. CP: ' . $odp->cp . '<br>
					Tel: ' . $odp->phone . '<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Cotización:</strong><br>
				<span style="margin-left: 20px;">' . $model->idVersion() . '</span>
			</td></tr>
			<tr><td  width="180"  class="tborder"><strong>Fecha de Emisión:</strong><br>
			<span style="margin-left: 20px;">' . Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'medium', false) . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>Proveedor No:</strong><br>
			<span style="margin-left: 20px;">' . $odp->supplierid . '</span>
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
				<th width="300" colspan="3">DESCRIPCION</th>
				
			</tr>
		</thead>
		';

        $subtotal = 0;
        $totalprice = $odp->price * $odp->quantityselect;
        $content .= '<tr>
				<td width="90" valign="top" style="text-align: center;" class="tborder">' . $model->idVersion() . '</td>
				<td width="90" valign="top" style="text-align: center;" class="tborder">' . $cantpar . '</td>
				<td width="300" valign="top" class="tborder" colspan="3">' . $this->getDetaillite($odp->rateid, $odp->servicedsc, $odp->note, $model->projectdsc, $model->branddsc) . '</td>
				
			</tr>';

        $iva = $totalprice * ($model->iva / 100);
        $total = $totalprice + $iva;
        $content .= '
                <tr style="font-size:8px;">
                <td width="300" height="20" valign="top"  class="tborder" colspan="2" rowspan="4">
                            <strong>Observaciones:</strong><br>
                            Es requisito fundamental entregar pruebas Cero y/o muestras de la producción antes de realizar cualquier entrega, sin excepción.<br>
                            Los productos deben cumplir con las características presentadas en la propuesta entregada a Portoprint, de acuerdo a lo definido y aprobado por Portoprint en todo lo relacionado a colores, tonos,
                            textos, información y otros detalles. Los productos deberan ser entregados en su totalidad y en perfectas condiciones. Portoprint tendra derecho a rechazar cualquiera de los productos que no
                            cumplan con las especificaciones y/o Criterios de Éxito. En su caso, el proveedor se obliga a no cobrar los productos dañados y/o rechazados y a pagar cualquier contratiempo que se pudiera generar
                            debido a esta falla. En caso de que los materiales no se entraguen en la fecha establecida, se aplicara una penalización equivalente al 5% del total por en primer dia de retraso y un 1.5% por cada dia
                            posterior de retraso, durante los primeros 5 dias después de la fecha de entrega. A partir del 6to dia Portoprint no se hará responsable por el pago de material entregado fuera de tiempo. En todos los
                            documentos, facturas y remisiones debera de aparecer en numero de Orden de Compra y en ID del trabajo correspondiente.</td>
                         
                </tr>
		<tr>
			<td>&nbsp;</td>
			
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ </td>
		</tr>
		<tr>
			
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA ' . $model->iva . ' %</td>
			<td style="text-align: right;" class="tborder">$ </td>
		</tr>
		<tr>
			
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ </td>
		</tr>
		</table>
		
		</page>
		';

        $id = intval($nid);
        $id = Utils::encrypt($id, 'rate');

        $storeFolder = Yii::app()->params->imageUpload;
        $targetPath = $storeFolder . $id;
        $bandera = 0;
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);

        if (!file_exists($targetPath)) {
            chmod($storeFolder . '*', 0777);
            if (!mkdir($targetPath, 0777, true)) {
                $bandera = 1;
            }
        }

        if ($bandera == 0) {
            $html2pdf->Output($targetPath . "/REM" . $model->idVersion() . '_' . date('Y-m-d_H-i') . '.pdf', 'F');
            chmod($targetPath, 0777);
            chmod($targetPath . "/REM" . $model->idVersion() . '_' . date('Y-m-d_H-i') . '.pdf', 0777);


            $model1 = new Ratefile();
            $val = $model1->findAllByAttributes(array('rateid' => $nid, 'name' => "REM" . $nid . '_' . date('Y-m-d_H-i') . '.pdf'));
            if (count($val) == 0) {
                $model1->name = "REM" . $model->idVersion() . '_' . date('Y-m-d_H-i') . '.pdf';
                $model1->path = 'imageUpload/' . $id . "/REM" . $model->idVersion() . '_' . date('Y-m-d_H-i') . '.pdf';
                $model1->rateid = $nid;
                $model1->dateupload = date('Y-m-d H:i:s');
                $model1->insert();
            }

            $html2pdf->Output("REM" . $model->idVersion() . '_' . date('Y-m-d_H-i') . '.pdf', 'D');
        }




        //  $html2pdf->Output('ODP_' . $odp->rateid . '.pdf', 'D');
    }

    public function actionOdc() {
        $get = $_GET;
        $nid = $_GET['id'];

        $odc = $this->loadModelODC($nid);
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
							<tr><td><img src="' . Yii::app()->params->imagePath . 'logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">ORDEN DE COMPRA ' . $model->idVersion() . '</div>
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
					30-88-43-00<br>
					impresos-procter@portoprint.mx<br><br>
				</td></tr>
				<tr><td>
					Emitido para:<br>
					' . $odc->corporatename . '<br>
					' . $odc->address . '<br>
					' . $odc->suburb . ', ' . $odc->citydsc . '<br>
					' . $odc->statedsc . '. CP: ' . $odc->cp . '<br>
					Tel: ' . $odc->phone . '<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Cotización:</strong><br>
				<span style="margin-left: 20px;">' . $model->idVersion() . '</span>
			</td></tr>
			<tr><td  width="180"  class="tborder"><strong>Fecha de Emisión:</strong><br>
			<span style="margin-left: 20px;">' . Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'medium', false) . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>Proveedor No:</strong><br>
			<span style="margin-left: 20px;">' . $odc->supplierid . '</span>
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
				<td width="90" valign="top" style="text-align: center;" class="tborder">' . $model->idVersion() . '</td>
				<td width="90" valign="top" style="text-align: center;" class="tborder">' . $odc->quantityselect . '</td>
				<td width="300" valign="top" class="tborder">' . $this->getDetaillite($odc->rateid, $odc->servicedsc, $odc->note, $odc->projectdsc, $odc->branddsc) . '</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ ' . number_format($odc->price, 2) . '</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ ' . number_format($totalprice, 2) . '</td>
			</tr>';

        $iva = $totalprice * ($model->iva / 100);
        $total = $totalprice + $iva;

        $content .= '
            <tr style="font-size:8px;">
            <td width="300" height="20" valign="top"  class="tborder" colspan="3">
                        <strong>Observaciones:</strong><br>
                        Es requisito fundamental entregar pruebas Cero y/o muestras de la producción antes de realizar cualquier entrega, sin excepción.<br>
                        Los productos deben cumplir con las características presentadas en la propuesta entregada a Portoprint, de acuerdo a lo definido y aprobado por Portoprint en todo lo relacionado a colores, tonos,
                        textos, información y otros detalles. Los productos deberan ser entregados en su totalidad y en perfectas condiciones. Portoprint tendra derecho a rechazar cualquiera de los productos que no
                        cumplan con las especificaciones y/o Criterios de Éxito. En su caso, el proveedor se obliga a no cobrar los productos dañados y/o rechazados y a pagar cualquier contratiempo que se pudiera generar
                        debido a esta falla. En caso de que los materiales no se entraguen en la fecha establecida, se aplicara una penalización equivalente al 5% del total por en primer dia de retraso y un 1.5% por cada dia
                        posterior de retraso, durante los primeros 5 dias después de la fecha de entrega. A partir del 6to dia Portoprint no se hará responsable por el pago de material entregado fuera de tiempo. En todos los
                        documentos, facturas y remisiones debera de aparecer en numero de Orden de Compra y en ID del trabajo correspondiente.</td>
                        <td height="20" valign="top" class="tborder">&nbsp;</td>
			<td height="20" valign="top" class="tborder">&nbsp;</td>
            </tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($totalprice, 2) . '</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA ' . $model->iva . ' %</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($iva, 2) . '</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($total, 2) . '</td>
		</tr>
		</table>
		
		</page>
		';

        //  echo $content;
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        //echo $content.' - ss';

        $html2pdf->Output('ODC_' . $odc->rateid . '.pdf', 'D');
    }

    public function actionBundle($id, $rates, $vp) {
        $get = $_GET;

        $nid = Utils::decrypt($id, 'rate');
        $userid = Yii::app()->user->userid;

        $model = Rate::model()->bundle_pdf2($nid, $rates);

        $bundles = Rate::model()->rate_pdf2($nid, $rates);

        foreach ($model as $row) {
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
							<tr><td><img src="' . Yii::app()->params->imagePath . 'logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">COTIZACION NO. ' . $row->bundleid . '</div>
						
					</td>
					</tr>
				</table>
			</page_header>
			<page_footer >
				
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
					' . $row->legalentity . '<br>
					' . $row->street . ' ' . $row->number . '<br>
					' . $row->neighborhood . ', ' . $row->citydsc . '<br>
					' . $row->statedsc . ', CP ' . $row->zipcode . '<br>
					' . $row->phone1 . '<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
            <div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">' . $row->projectdsc . '</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Fecha:</strong><br>
			<span style="margin-left: 20px;">' . Yii::app()->dateFormatter->formatDateTime($row->ratedate, 'medium', false) . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>Autorizado por:</strong><br>
			<span style="margin-left: 20px;">' . $row->firstname . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>A la atención de:</strong><br>
			<span style="margin-left: 20px;">' . $row->name . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>Telefono:</strong><br>
			<span style="margin-left: 20px;">' . $row->phone1 . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>Vendor :</strong><br>
			<span style="margin-left: 20px;"></span>
			</td></tr>
		</table>
	</td>
	</tr>
	</table>
	<table cellpadding="0" cellspacing="0" >
		<thead>
			<tr>
				<th >ID</th>
				<th style="width:80px;">CANTIDAD</th>
				<th >DESCRIPCION</th>';
            $content .= ($vp == 1) ? '<th style="width:80px;">VENDOR P.</th>' : '';
            $content .= ($vp == 1) ? '<th style="width:80px;">BASE P.</th>' : '';
            $content .= '<th style="width:90px;">P. UNITARIO</th>
				<th style="width:90px;">PRECIO TOTAL</th>
			</tr>
		</thead>
		';
        }
        //echo $content;
        $subtotal = 0;
        foreach ($bundles as $row) {
            $rate = $this->loadModel($row->rateid);
            $price = $rate->getprice();
            $totalprice = $rate->quantityselect * $rate->getprice();
            $ratesup = Ratesupplier::model()->getRateSupplier_pdf($row->rateid);
            $div = explode('-', $ratesup);

            $content .= '
			<tr>
				<td  valign="top" style="text-align: center;" class="tborder">' . $rate->idVersion() . '</td>';
            $content .= '<td  valign="top" style="text-align: center; " class="tborder">' . $rate->quantityselect . '</td>';

            $content .= '<td  valign="top" style="text-align: left; font-size:9px; width:270px; " class="tborder">' . $this->getDetaillite($rate->rateid, $rate->servicedsc, $rate->note, $rate->projectdsc, $rate->branddsc) . '</td>';

            $content .= ($vp == 1) ? '<td  valign="top" style="text-align: center;  vertical-align: middle; " class="tborder">$ ' . $div[1] . '</td>' : '';

            $content .= ($vp == 1) ? '<td  valign="top" style="text-align: center;  vertical-align: middle; " class="tborder">$ ' . $div[0] . '</td>' : '';

            $content .= '<td  valign="top" style="text-align: center;  vertical-align: middle;  " class="tborder">$ ' . number_format($price, 2) . '</td>';

            $content .= '<td  valign="top" style="text-align: center;  vertical-align: middle;  " class="tborder">$ ' . number_format($totalprice, 2) . '</td>
			</tr>
		';
            $subtotal+=$totalprice;
        }
        //echo $content;
        $colspan = ($vp == 1) ? 5 : 3;
        $content .= '
		<tr> 
                    <td colspan="' . $colspan . '" valign="top" style="text-align: left; font-size:9px;" class="tborder"><b>TERMINOS Y CONDICIONES:</b> <br>
                        * Se considera la producción del proyecto de acuerdo a split compartido por P&G. <br>
                        Se considera la entrega y aprobación del 100% de los artes para inicio de producción. <br>
                        -Para poder comenzar con el proyecto, se requiere ODC o en su defecto esta cotización firmada por el responsable con nombre, <br>
                         fecha y firma en señal de aceptación del proyecto.  <br>
                        - No incluye fletes foraneos.  <br>
                        * En caso de cancelación o reducción del pedido, el cliente se obliga a presentar la cancelación por escrito y  <br>
                        se compromete a pagar el 100% de los costos devengados y comprometidos hasta la fecha de recepción del aviso.  <br> 
                        Por la naturaleza de los procesos de producción puede haber una variación en la cantidad de piezas +/- de un 10%.  <br> 
                        - Debido a especificaciones de nuestros proveedores de materia prima estos materiales podran llegar a tener una   <br>
                        tolerancia en espesores del material de un +/- 10% a 20%. - Vigencia de la cotización: 15 días. </td>';
        $content .= '<td valign="top" style="text-align: center;  border-top : 0px dashed white;  border-bottom : 0px dashed black; border-right : black solid thin;" class="tborder">&nbsp;</td>';
        $content .= '<td valign="top" style="text-align: center; border-top : 0px dashed white;  border-bottom : 0px dashed black;" class="tborder">&nbsp;</td>
                </tr>';
        $iva = $subtotal * ($rate->iva / 100);
        $total = $subtotal + $iva;
        $content .= '
		<tr>
			<td style="text-align: right; border-top : 1px solid black;">&nbsp;</td>
			<td style="text-align: right; border-top : 1px solid black;">&nbsp;</td>
			<td style="text-align: right; border-top : 1px solid black;">&nbsp;</td>';
        $content .= ($vp == 1) ? '<td style="text-align: right; border-top : 1px solid black;">&nbsp;</td>' : '';
        $content .= ($vp == 1) ? '<td style="text-align: right; border-top : 1px solid black;">&nbsp;</td>' : '';
        $content .= '<td  style="text-align: right; border-top : 1px solid black;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($subtotal, 2) . '</td>
		</tr>
                <tr>
			<td colspan="' . $colspan . '">&nbsp;Cualquier cambio en las especificaciones estará sujeta a re-cotización</td>
			
			<td  style="text-align: right;"></td>
			<td style="text-align: right;" class="tborder"></td>
		</tr>
		<tr>
			<td colspan="' . $colspan . '">&nbsp;Se considera una entrega en el Área Metropolitana.</td>
			<td  style="text-align: right;">IVA ' . $rate->iva . ' %</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($iva, 2) . '</td>
		</tr>
                 <tr>
			<td colspan="' . $colspan . '">&nbsp;Tiempo de entrega: 5 dias hábiles</td>
			<td  style="text-align: right;">Otros</td>
			<td style="text-align: right;" class="tborder"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>';
        $content .= ($vp == 1) ? '<td>&nbsp;</td>' : '';
        $content .= ($vp == 1) ? '<td>&nbsp;</td>' : '';
        $content .= '<td  style="text-align: right;"><b>Total</b></td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($total, 2) . '</td>
		</tr>
		</table>
		
		</page>
		';

        //echo $content;
        $id = intval($nid);
        $id = Utils::encrypt($id, 'rate');

        $storeFolder = Yii::app()->params->imageUpload;
        $targetPath = $storeFolder . $id;
        $bandera = 0;

        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        //     $html2pdf->Output('Cotizacion_'.$nid.'.pdf', 'D');

        if (!file_exists($targetPath)) {
            chmod($storeFolder . '*', 0777);
            if (!mkdir($targetPath, 0777, true)) {
                $bandera = 1;
            }
        }

        if ($bandera == 0) {
            $html2pdf->Output($targetPath . "/COT" . $nid . '_' . date('Y-m-d_H-i') . '.pdf', 'F');
            chmod($targetPath, 0777);
            chmod($targetPath . "/COT" . $nid . '_' . date('Y-m-d_H-i') . '.pdf', 0777);

            foreach ($bundles as $row) {
                $model = new Ratefile();
                $val = $model->findAllByAttributes(array('rateid' => $row->rateid, 'name' => "COT" . $nid . '_' . date('Y-m-d_H-i') . '.pdf'));
                if (count($val) < 1) {
                    $model->name = "COT" . $nid . '_' . date('Y-m-d_H-i') . '.pdf';
                    $model->path = 'imageUpload/' . $id . "/COT" . $nid . '_' . date('Y-m-d_H-i') . '.pdf';
                    $model->rateid = $row->rateid;
                    $model->dateupload = date('Y-m-d H:i:s');
                    $model->insert();
                }
            }
            $html2pdf->Output("COT" . $nid . '_' . date('Y-m-d_H-i') . '.pdf', 'D');
        }
        //   $html2pdf->Output("COT" . $nid . '_' . date('Y-m-d_H-i') . '.pdf', 'D');
    }

    public function actionReport($id, $rateid) {
        $get = $_GET;
        $nid = Utils::decrypt($id, 'rate');
        $nid1 = Utils::decrypt($rateid, 'rate');

        $model = $this->loadModel($nid1);
        $bundleid = Bundleproject::model()->findAllByAttributes(array("bundleid" => $nid));
        $ratetracker = Rate::model()->findAllByAttributes(array("rateid" => $nid1, "statusid" => $nid1));

        //$model=$this->loadBundleModel($nid);



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
							<tr><td><img src="' . Yii::app()->params->imagePath . 'logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">Reporte Historico. ' . $model->bundleid . '</div>
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
					' . $model->legalentity . '<br>
					' . $model->street . ' ' . $model->number . '<br>
					' . $model->neighborhood . ', ' . $model->citydsc . '<br>
					' . $model->statedsc . ', CP ' . $model->zipcode . '<br>
					' . $model->phone1 . '<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Cotización:</strong><br>
				<span style="margin-left: 20px;">' . $nid . '</span>
			</td></tr>
			<tr><td  width="180"  class="tborder"><strong>Fecha de Creacion:</strong><br>
			<span style="margin-left: 20px;">' . $model->ratedate . '</span>
			</td></tr>
                        <tr><td  width="180"  class="tborder"><strong>Fecha de Finalizacion:</strong><br>
			<span style="margin-left: 20px;">' . $model->statustime . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>Item No:</strong><br>
			<span style="margin-left: 20px;">' . $nid1 . '</span>
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


        $content .= '
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($subtotal, 2) . '</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA ' . $rate->iva . ' %</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($iva, 2) . '</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($total, 2) . '</td>
		</tr>
		</table>
		
		</page>
		';

        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('Cotizacion_' . $rate->bundleid . '.pdf', 'D');
    }

    public function actionOdpd($id) {
        $get = $_GET;
        $nid = Utils::decrypt($id, 'rate');
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
							<tr><td><img src="' . Yii::app()->params->imagePath . 'logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">ORDEN DE PAGO ' . $model->idVersion() . '</div>
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
					' . $odp->corporatename . '<br>
					' . $odp->address . '<br>
					' . $odp->suburb . ', ' . $odp->citydsc . '<br>
					' . $odp->statedsc . '. CP: ' . $odp->cp . '<br>
					Tel: ' . $odp->phone . '<br>
				</td></tr>
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Cotización:</strong><br>
				<span style="margin-left: 20px;">' . $model->idVersion() . '</span>
			</td></tr>
			<tr><td  width="180"  class="tborder"><strong>Fecha de Emisión:</strong><br>
			<span style="margin-left: 20px;">' . Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'medium', false) . '</span>
			</td></tr>
			<tr><td class="tborder"><strong>Proveedor No:</strong><br>
			<span style="margin-left: 20px;">' . $odp->supplierid . '</span>
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
				<td width="90" valign="top" style="text-align: center;" class="tborder">' . $model->idVersion() . '</td>
				<td width="90" valign="top" style="text-align: center;" class="tborder">' . $odp->quantityselect . '</td>
				<td width="300" valign="top" class="tborder">' . $this->getDetaillite($odp->rateid, $odp->servicedsc, $odp->note, $model->projectdsc, $model->branddsc) . '</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ ' . number_format($odp->price, 2) . '</td>
				<td width="100" valign="top" style="text-align: right;" class="tborder">$ ' . number_format($totalprice, 2) . '</td>
			</tr>';

        $iva = $totalprice * ($model->iva / 100);
        $total = $totalprice + $iva;
        $content .= '
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($totalprice, 2) . '</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA ' . $model->iva . ' %</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($iva, 2) . '</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ ' . number_format($total, 2) . '</td>
		</tr>
		</table>
		
		</page>
		';

        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('ODP_' . $odp->rateid . '.pdf', 'D');
    }

    static function getDetail($rateid, $servicedsc, $note) {
        $details = Rateitemdetailvalue::model()->getDetail($rateid);
        $detail = "<span style='font-size:8.5px;'>";
        foreach ($details as $row) {
            $detail.= "<b>" . $row->itemdetaildsc . ":</b>" . $row->itemdetailvaluedsc . ", ";
        }
        $detail .=" <b>Observaciones:</b> " . $note . "</span>";
        return '<i style="color:#0088CC; cursor:pointer;"  class="ratepop" data-placement="right" data-title="' . $servicedsc . '" data-content="' . $detail . '">' . $servicedsc . '</i>';
    }

    static function getDetaillite($rateid, $servicedsc, $note, $projectdsc, $branddsc) {
        $details = Rateitemdetailvalue::model()->getDetail($rateid);
        $detail = "<b>Item: " . $servicedsc . "</b><br /><b>Marca: " . $branddsc . "</b><br /><b>Campaña / Proyecto: " . $projectdsc . "</b><br /><p>";
        foreach ($details as $row) {
            $contador = strlen($row->itemdetaildsc);

            $concatenar = '';
            if ($contador > 40) {
                $concatenar = '<br />';
            } else {
                $concatenar = "";
            }


            $detail.= $row->itemdetaildsc . ":" . $concatenar . $row->itemdetailvaluedsc . "<br />";
        }
        $note = wordwrap($note, 40, "<br/>");
        $detail .=" <br>Observaciones: " . $note . "</p><br /><br /><br />";
        return $detail;
    }

    public function loadModel($id) {
        $model = Rate::model()->modelByRateid($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelODP($id) {
        $model = Rateodp::model()->odpByUser($id, Yii::app()->user->userid);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelODC($id) {
        $model = Rateodc::model()->odcByUser($id, Yii::app()->user->userid);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadBundleModel($id) {
        $model = Bundleproject::model()->bundle($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionActivity($inicio, $fin, $areaid, $userid) {
        $get = $_GET;

        $actividad_uno = Ratetracker::model()->activity($inicio, $fin, $areaid, $userid);
        $actividad_dos = Access::model()->activity($inicio, $fin, $areaid, $userid);
        $actividad_trs = Activity::model()->get_activity($inicio, $fin, $areaid, $userid);

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
		    padding-top: 5px;
		    padding-bottom: 5px;
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
		tr.group{
                    background: #ddd;
                }
		-->
		</style>
		<page backtop="70px" backbottom="5mm">
			<page_header >
				<table width="680">
					<tr>
					<td width="500" style="vertical-align: top;">
						<table>
							<tr><td><img src="' . Yii::app()->params->imagePath . 'logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; font-weight: bold; font-size:14px;">Reporte de actividad</div>
						<div style="width: 100%;color: #5E5C5D; font-size:11px;">Pagina [[page_cu]]/[[page_nb]]</div>
					</td>
					</tr>
				</table>
			</page_header>
			<page_footer >
				<div style="margin-left: 50px; margin-right:10px; margin-top:30px; font-size: 11px; ">
					Reporte de actividad
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
		</table>
	</td>
	<td style="vertical-align: top;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td  width="180"  class="tborder"><strong>Fecha de Emisión:</strong><br>
			<span style="margin-left: 20px;">' . date('Y-m-d H:i') . '</span>
			</td></tr>
		</table>
	</td>
	</tr>
	</table>
	<table cellpadding="0" cellspacing="0" width="718">
		<thead>
			<tr>
				<th width="240">FECHA</th>
				<th width="240">ACTIVIDAD</th>
				<th width="238">RESPONSABLE</th>
			</tr>
		</thead>';
        $output = array();
        $cont = 0;
        
        if (count($actividad_uno) > 0) {
            foreach ($actividad_uno as $row) {
                $output[$cont]['cuando'] = $row->statusdate;
                $output[$cont]['que'] = $row->detalle . ' - ' . $row->statusdsc;
                $output[$cont]['quien'] = $row->responsable;


                $cont = $cont + 1;
            }
        }
        if (count($actividad_dos) > 0) {
            foreach ($actividad_dos as $row) {
                $output[$cont]['cuando'] = $row->accessdate;
                $output[$cont]['que'] = $row->operacion;
                $output[$cont]['quien'] = $row->responsable;


                $cont = $cont + 1;
            }
        }
        if (count($actividad_trs) > 0) {
            foreach ($actividad_trs as $row) {
                $output[$cont]['cuando'] = $row->activitydate;
                $output[$cont]['que'] = $row->actividad;
                $output[$cont]['quien'] = $row->responsable;


                $cont = $cont + 1;
            }
        }
        rsort($output);
        
        
        for($i=0; $i<count($output); $i++){
            $content .= '
                <tr>
                    <td>' . $output[$i]['cuando'] . '</td>
                    <td>' . $output[$i]['que']. '</td>
                    <td>' . $output[$i]['quien'] . '</td>
                </tr>';
        }
        
        
        $content .= '</table></page>';





        $storeFolder = Yii::app()->params->imageUpload;
        $targetPath = $storeFolder;
        $bandera = 0;

        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('Actividad' . date('Y-m-d_H-i') . '.pdf', 'D');

        /* if (!file_exists($targetPath)) {
          chmod($storeFolder . '*', 0777);
          if (!mkdir($targetPath, 0777, true)) {
          $bandera = 1;
          }
          }

          if ($bandera == 0) {
          $html2pdf->Output($targetPath . 'Actividad' . date('Y-m-d_H-i') . '.pdf', 'F');
          chmod($targetPath, 0777);
          chmod($targetPath . 'Actividad' . date('Y-m-d_H-i') . '.pdf', 0777);


          $html2pdf->Output('Actividad' . date('Y-m-d_H-i') . '.pdf', 'D');
          } */
    }

    public function actionActivityrate($rateid, $tracker, $ratesupplier) {
        $get = $_GET;

        $actividad = Ratetracker::model()->activitybyrate($rateid, $tracker);
        $activity = Ratesupplier::model()->activitybyrate($rateid, $ratesupplier);
        $ratedata = Rate::model()->modelByRateid($rateid);



        $content = '
	    <style type="text/css">
		
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
		    padding-top: 5px;
		    padding-bottom: 5px;
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
		tr.group{
                    background: #ddd;
                }
		.trb {
                    background-color: #eeeeee;
                    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f2f2f2), to(#fafafa));
                    background-image: -webkit-linear-gradient(top, #f2f2f2 0, #fafafa 100%);
                    background-image: -moz-linear-gradient(top, #f2f2f2 0, #fafafa 100%);
                    background-image: -ms-linear-gradient(top, #f2f2f2 0, #fafafa 100%);
                    background-image: -o-linear-gradient(top, #f2f2f2 0, #fafafa 100%);
                    background-image: -linear-gradient(top, #f2f2f2 0, #fafafa 100%);
                    font-size: 12px;
                    }
		</style>
		<page backtop="70px" backbottom="5mm">
			<page_header >
				<table width="680">
					<tr>
					<td width="500" style="vertical-align: top;">
						<table>
							<tr><td><img src="' . Yii::app()->params->imagePath . 'logo.jpg" style="width:220px;" /></td></tr>
						</table>
					</td>
					<td  width="180" style="vertical-align: middle;">
						<div style="width: 100%;color: #5E5C5D; text-align: right; font-weight: bold; font-size:14px;">Reporte de actividad</div>
                                                <div style="width: 100%;color: #5E5C5D; text-align: right; font-weight: bold; font-size:14px;">' . $ratedata->rateid . ' - ' . $ratedata->servicedsc . '</div>
						<div style="width: 100%;color: #5E5C5D; text-align: right; font-size:11px;">Pagina [[page_cu]]/[[page_nb]]</div>
					</td>
					</tr>
				</table>
			</page_header>
			<page_footer >
				<div style="margin-left: 50px; margin-right:10px; margin-top:30px; font-size: 11px; ">
					Reporte de actividad
				</div>
		</page_footer >
                <table width="680" style="margin-top:20px;">
		<tr>
		<td width="500" style="vertical-align: top;">
			<table>
				<tr><td>
					Item: ' . $ratedata->rateid . ' - ' . $ratedata->servicedsc . '<br>	
					Comprador: ' . $ratedata->firstname . ' <br>
					Creación: ' . Yii::app()->dateFormatter->formatDateTime($ratedata->ratedate, 'full', 'full') . '<br>';
        if ($ratedata->statusid == 2 || $ratedata->statusid == 4) {
            $content .= 'Finalizó: ' . Yii::app()->dateFormatter->formatDateTime($ratedata->finalize, 'full', 'full');
        } else {
            $content .= 'Finalizó: ' . Yii::app()->dateFormatter->formatDateTime($ratedata->statustime, 'full', 'full');
        }
        $content .= '<br>Estatus: ' . $ratedata->statusdsc .
                '<br>Fecha de Emisión:' . date('d-m-y H:m') .
                '</td></tr>
		</table>
	</td>
	
	</tr>
	</table>
	<table cellpadding="0" cellspacing="0" width="718">
		<thead>
			<tr>
				<th width="240">FECHA</th>
				<th width="240">ACTIVIDAD</th>
				<th width="238">RESPONSABLE</th>
			</tr>
		</thead>';
        $tr = 1;
        $i = 0;
        $arreglo = array();
        foreach ($actividad as $value) {
            $arreglo [$i][0] = $value->statusdate;
            $arreglo [$i][1] = $value->statusdsc;
            $arreglo [$i][2] = $value->responsable;
            $i++;
            if ($value->statusid == 100) {
                foreach ($activity as $valor) {
                    $arreglo [$i][0] = $valor->statustime;
                    $arreglo [$i][1] = $valor->statusdsc;
                    $arreglo [$i][2] = $valor->corporatename;
                    $i++;
                }
            }
        }
        array_multisort($arreglo);

        for ($i = 0; $i < count($arreglo); $i++) {
            //echo $arreglo[$i][0] . ' - ' . $arreglo[$i][1] . ' - ' . $arreglo[$i][2] . '<br>';
            $class = ($tr % 2 === 0) ? 'class="trb"' : '';
            $content .= '
                      <tr ' . $class . '>
                      <td>' . $arreglo[$i][0] . '</td>
                      <td>' . $arreglo[$i][1] . '</td>
                      <td>' . $arreglo[$i][2] . '</td>
                      </tr>';
            $tr++;
        }

        $content .= '</table></page>';





        $storeFolder = Yii::app()->params->imageUpload;
        $targetPath = $storeFolder;
        $bandera = 0;

        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('Actividad' . date('Y-m-d_H-i') . '.pdf', 'D');

        /* if (!file_exists($targetPath)) {
          chmod($storeFolder . '*', 0777);
          if (!mkdir($targetPath, 0777, true)) {
          $bandera = 1;
          }
          }

          if ($bandera == 0) {
          $html2pdf->Output($targetPath . 'Actividad' . date('Y-m-d_H-i') . '.pdf', 'F');
          chmod($targetPath, 0777);
          chmod($targetPath . 'Actividad' . date('Y-m-d_H-i') . '.pdf', 0777);


          $html2pdf->Output('Actividad' . date('Y-m-d_H-i') . '.pdf', 'D');
          } */
    }

}
