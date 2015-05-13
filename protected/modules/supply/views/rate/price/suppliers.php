<div>
<table id="supplierdetailtable_<?php echo $item->serviceid ?>" class="supplierdetailtable  table table-striped table-condensed">
<tbody>
<?php 
$entry = Service::model()->getEntrybyServiceId($item->serviceid); 
$supplier = Supplierservice::model()->getSupplierbyServiceid($entry->serviceid);
$rw = 1;
$close = true;
foreach($supplier as $row){
	$close = false;
	if($rw==1)
		echo '<tr class="odd">';
	
	echo '<th><input type="checkbox" id="supplier_'.$row->supplierid.'" name="RateSupplier[]" value="'.$row->supplierid.'"></th>'.
		 '<td><label for="supplier_'.$row->supplierid.'">'.$row->supplierdsc.'</td>';
	if($rw==2){
		echo '</tr>';
		$close = true;
	}
	($rw ==1)?$rw=2:$rw=1;
}
if(!$close)
	echo '<td colspan="2">&nbsp;</td></tr>';
?>
</tbody>
</table>
</div>
