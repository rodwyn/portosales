<table class="detail-view table table-striped table-condensed">
<tbody>
<?php 
foreach($details as $row){
	echo "<tr><th>".$row->itemdetaildsc."</th><td>".$row->itemdetailvaluedsc."</td></tr>";
} 
echo "<tr><th>Observaciones</th><td>".$note."</td></tr>";	
?>
</tbody>
</table>