<div>
<table id="quantitytable_<?php echo $item->serviceid ?>" class="quantitytable table table-striped table-condensed">
	<tbody>
		<tr>
			<td width="150"><input class="dqr" type="text" onkeyup="caclean(1);" onmouseup="js: $(this).select();" style="width:90%; text-align:right;" id="ca_1" name="ca[1]" value="0"/></td>
			<td width="150"><input class="dqr" type="text" onkeyup="caclean(2);" onmouseup="js: $(this).select();" style="width:90%; text-align:right;" id="ca_2" name="ca[2]"  disabled="disabled" value="0" /></td>
			<td width="150"><input class="dqr" type="text" onkeyup="caclean(3);" onmouseup="js: $(this).select();" style="width:90%; text-align:right;" id="ca_3" name="ca[3]" disabled="disabled" value="0" /></td>
			<td width="150"><input class="dqr" type="text" onkeyup="caclean(4);" onmouseup="js: $(this).select();" style="width:90%; text-align:right;" id="ca_4" name="ca[4]" disabled="disabled" value="0" /></td>
			<td width="150"><input class="dqr" type="text" onkeyup="caclean(5);" onmouseup="js: $(this).select();" style="width:90%; text-align:right;" id="ca_5" name="ca[5]" disabled="disabled" value="0" /></td>
			<td width="150"><input class="dqr" type="text" onkeyup="caclean(6);" onmouseup="js: $(this).select();" style="width:90%; text-align:right;" id="ca_6" name="ca[6]" disabled="disabled"  value="0" /></td>
		</tr>	
		<tr>
			<td style="text-align:center"><?php $this->widget('bootstrap.widgets.TbButton',array( 'label' => 'Cambios de Arte', 'size' => 'small', 'htmlOptions'=>array('onclick'=> 'js:showchangeartform(1);'))); ?></td>
			<td style="text-align:center"><?php $this->widget('bootstrap.widgets.TbButton',array( 'label' => 'Cambios de Arte', 'size' => 'small', 'htmlOptions'=>array('onclick'=> 'js:showchangeartform(2);'))); ?></td>
			<td style="text-align:center"><?php $this->widget('bootstrap.widgets.TbButton',array( 'label' => 'Cambios de Arte', 'size' => 'small', 'htmlOptions'=>array('onclick'=> 'js:showchangeartform(3);'))); ?></td>
			<td style="text-align:center"><?php $this->widget('bootstrap.widgets.TbButton',array( 'label' => 'Cambios de Arte', 'size' => 'small', 'htmlOptions'=>array('onclick'=> 'js:showchangeartform(4);'))); ?></td>
			<td style="text-align:center"><?php $this->widget('bootstrap.widgets.TbButton',array( 'label' => 'Cambios de Arte', 'size' => 'small', 'htmlOptions'=>array('onclick'=> 'js:showchangeartform(5);'))); ?></td>
			<td style="text-align:center"><?php $this->widget('bootstrap.widgets.TbButton',array( 'label' => 'Cambios de Arte', 'size' => 'small', 'htmlOptions'=>array('onclick'=> 'js:showchangeartform(6);'))); ?></td>
		</tr>
		<tr>
			<td valign="top"><table width="150" id="cal_1_table" style="font-size: 10px;" class="table table-condensed"></table></td>
			<td valign="top"><table width="150" id="cal_2_table" style="font-size: 10px;" class="table table-condensed"></table></td>
			<td valign="top"><table width="150" id="cal_3_table" style="font-size: 10px;" class="table table-condensed"></table></td>
			<td valign="top"><table width="150" id="cal_4_table" style="font-size: 10px;" class="table table-condensed"></table></td>
			<td valign="top"><table width="150" id="cal_5_table" style="font-size: 10px;" class="table table-condensed"></table></td>
			<td valign="top"><table width="150" id="cal_6_table" style="font-size: 10px;" class="table table-condensed"></table></td>
		</tr>
	</tbody>
</table>
</div>
<script>

</script>
