<?php 
$box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'TIME LINE EN ITEM-COTIZACION '.$model->idVersion(),
    'headerButtons' => array(
				    array(
					    'class' => 'bootstrap.widgets.TbButtonGroup',
					    'buttons' => array(
				    		array(
				    		'buttonType'=>'button', 
				    		'label' => 'Generar PDF Timeline', 
				    		'htmlOptions'=>array( 'id'=>'generaPDF')				    		
				    		)
				    	)
				    )
    )));
?>
<div  class="well well-small">
<strong>Cliente:</strong> <?php echo $model->customerdsc; ?><br />
<strong>Marca:</strong> <?php echo $model->branddsc; ?><br />
<strong>Proyecto:</strong> <?php echo $model->projectdsc; ?><br />
<strong>Item:</strong> <?php echo $model->servicedsc; ?>
</div>
<div  class="well">
	<div id="ratetimeline" style="font-size:12px;"></div>

<table class="detail-view table table-striped table-condensed">
<tbody>
<?php 
$cont = 1;
$data = array();
$data[]=array("id"=>$cont++, "content"=>'Creación<br>'.Yii::app()->dateFormatter->formatDateTime($model->ratedate, 'short', 'short'), "start"=>$model->ratedate );
	
foreach($ratetracker as $event){
	$data[] = array("id"=>$cont++, "content"=>$event->status->statusdsc."<br />".Yii::app()->dateFormatter->formatDateTime($event->statusdate, 'short', 'short'), "start"=>$event->statusdate );
	echo "<tr><th>".Yii::app()->dateFormatter->formatDateTime($event->statusdate, 'short', 'short')."</th><td>".$event->user->employeeuser->firstname." ".$event->user->employeeuser->plastname."</td><td>".$event->status->statusdsc."</td><td></td></tr>";
	
}
?>
</tbody>
</table>
</div>
<?php $this->endWidget();?>
<script type="text/javascript">
    var container = document.getElementById('ratetimeline');
    var data = <?php echo json_encode($data); ?>;
    var options = {};
    var timeline = new vis.Timeline(container, data, options);
</script>