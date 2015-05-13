<div>
<div id="step2error" class="alert alert-danger fade in" style="display:none;">											
	 <strong>Todos los atributos son obligatorios, verifique para poder continuar.</strong>
</div>

<table id="itemdetailtable_<?php echo $item->serviceid ?>" class="itemdetailtable  table table-striped table-condensed">
<tbody>
<?php 
$detail = Servicedetail::model()->getDetailByServiceid($item->serviceid);
$rw = 1;
$close = true;
foreach($detail as $row){
	$close = false;
	$detailvalue = Itemdetailvalue::model()->findAllbyAttributes(array('itemdetailid'=>$row->itemdetailid));
	$multiple = ($row->selecttype==1)?" multiple size='3' ":"";
	if($rw==1)
	echo '<tr>';
	
	echo '<th width="22%"><label for="itemdetail_'.$row->itemdetailid.'">'.$row->itemdetaildsc.'</label></th><td width="22%">';
	echo '<select id="itemdetail_'.$row->itemdetailid.'" name="Rateitemdetailvalue[]" data-placeholder="Seleccione"  class="select2" '.$multiple.' >';
	echo '<option value=""  ></option>';
	foreach($detailvalue as $value){
		echo '<option value="'.$value->itemdetailvalueid.'" >'.$value->itemdetailvaluedsc.'</option>';
	}
	echo '</select></td><td width="6%"><a href="javascript:newitemdatilvalue('.$row->itemdetailid.');" class="btn btn-primary btn-xs">+</a> </td>';
	
	if($rw==2){
		echo '</tr>';
		$close = true;
	}
	($rw ==1)?$rw=2:$rw=1;
}
if(!$close)
	echo '<td colspan="2">&nbsp;</td></tr>';
?>
<tr>
<th><label for="Rate_note">Observaciones</label></th>
<td colspan="6">
<textarea id="Rate_note" name="Rate[note]" rows="5" style="width:90%;"></textarea>
</td>
</tbody>
</table>

</div>
