<?php $this->layout = '//layouts/blank'; ?>
<style type="text/css">
<!--
table
{
    width:  100%;
    border: solid 1px #ffffff;
    font-size: 11px;
}

th
{
    text-align: center;
    border: solid 1px #000000;
    background: #F0EDEE;
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

<table width="680px;" style="width:680px;">
	<tr>
	<td style="width: 70%; vertical-align: top;">
		<table>
			<tr><td><img src="http://localhost/sps/images/logo.jpg" style="width:220px;" /></td></tr>
			<tr><td>
				Bosque de Duraznos 65 Int 302A<br>	
				Bosques de las Lomas, Miguel Hidalgo<br>
				Mexico DF, CP 11700<br>
				2451-9210<br>
				impresos-procter@portoprint.mx<br><br>
			</td></tr>
			<tr><td>
				Emitido para:<br>
				Compañía Procter & Gamble S de RL de CV<br>
				Loma Florida #32<br>
				Lomas de Vista Hermosa, Cuajimalpa de Morelos<br>
				Mexico DF, CP 05100<br>
				5724-2000<br>
			</td></tr>
		</table>
	</td>
	<td style="width: 30%; vertical-align: top;">
		<div style="margin: 10px 0 5px; color: #5E5C5D; font-weight: bold;">COTIZACIÓN NO. <?php echo $bundleid; ?></div>
		<table cellpadding="0" cellspacing="0">
			<tr><td style="width:100%;" class="tborder"><strong>Fecha:</strong><br>
			<span style="margin-left: 20px;">21/08/13</span>
			</td></tr>
			<tr><td class="tborder"><strong>Autorizado por:</strong><br>
			<span style="margin-left: 20px;">Nicolas Douek</span>
			</td></tr>
			<tr><td class="tborder"><strong>A la atención de:</strong><br>
			<span style="margin-left: 20px;">Claudia Galvis</span>
			</td></tr>
			<tr><td class="tborder"><strong>Teléfono:</strong><br>
			<span style="margin-left: 20px;">5724-2000</span>
			</td></tr>
			<tr><td class="tborder"><strong>Vendor :</strong><br>
			<span style="margin-left: 20px;">15229680</span>
			</td></tr>
		</table>
	</td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" width="680px;" style="width:680px;">
	<thead>
		<tr>
			<th style="width: 30px;">ID</th>
			<th style="width: 50px;">CANTIDAD</th>
			<th style="width: 500px;">DESCRIPCION</th>
			<th style="width: 50px%;">PRECIO UNITARIO</th>
			<th style="width: 50px;">PRECIO TOTAL</th>
		</tr>
	</thead>
	<?php
	$subtotal=0;
	    foreach ($bundle as $rate) {
	    	$precio = 	$rate->quantity_1 * $rate->ppp_1;
	?>
		<tr>
			<td style="text-align: center;" class="tborder"><?php echo $rate->rateid; ?></td>
			<td style="text-align: center;" class="tborder"><?php echo $rate->quantity_1; ?></td>
			<td class="tborder"><?php echo $this->getDetaillite($rate->rateid, $rate->servicedsc, $rate->note); ?></td>
			<td style="text-align: right;" class="tborder">$ <?php echo number_format($rate->ppp_1, 2); ?></td>
			<td style="text-align: right;" class="tborder">$ <?php echo number_format($precio, 2); ?></td>
		</tr>
	<?php
		$subtotal+=$precio;
	    } 
	    $iva = $subtotal * 0.16;
	    $total = $subtotal + $iva;
	    ?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Subtotal</td>
			<td style="text-align: right;" class="tborder">$ <?php echo number_format($subtotal, 2); ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">IVA 16 %</td>
			<td style="text-align: right;" class="tborder">$ <?php echo number_format($iva, 2); ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="tborder" style="text-align: right;">Total</td>
			<td style="text-align: right;" class="tborder">$ <?php echo number_format($total, 2); ?></td>
		</tr>
</table>
<div style="margin-left: 50px; margin-right:10px; margin-top:30px; font-size: 11px; ">
Cualquier cambio o ajuste en la cotización esta sujeta a recotización
Vigencia de la cotizacion: 15 dias
Entrega en Area Metropolitana
</div>
