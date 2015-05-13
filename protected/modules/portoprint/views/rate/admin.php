<?php 

    $box = $this->beginWidget('bootstrap.widgets.TbBox',array(
    'title' => 'COTIZACIONES',
    'headerButtons' => array(
				    array(
					    'class' => 'bootstrap.widgets.TbButtonGroup',
					    
					    'buttons' => array(
				    			array('label' => 'Buscar', 'url'=>'#', 'icon'=>'icon-search', 'htmlOptions'=>array('id'=>'searchratebtn')), 
						    	array('label' => 'Nueva Cotización', 'type' => 'success', 'url'=>Yii::app()->createAbsoluteUrl('/portoprint/rate/create'))    
						    )
				    )
    ))); ?>
 	<div id="searchratediv" style="display:none;">
    <?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	    'id'=>'rate',
	    'type'=>'horizontal',
		'action'=>Yii::app()->createAbsoluteUrl('/portoprint/rate'),
		'method'=>'GET',
	    'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'well well-small'),
	)); ?> 	 
	<div class="row-fluid">
     <div id="sidebar" class="span12" style="padding-left:10px;"><strong>BÚSQUEDA AVANZADA</strong></div>
    </div>
	<div class="row-fluid">
     <div id="sidebar" class="span4"><label for="Rate_rateid" class="control-label">Cotización Item ID </label> <input id="Rate_rateid" type="text" value="<?php echo $model->rateid ?>" name="Rate[rateid]" style="margin-left:5px;width:170px;"></div>
     <div id="sidebar" class="span4"><label for="Rate_ratedate" class="control-label">Fecha </label> <input type="text" value="<?php echo $model->ratedate ?>" id="Rate_ratedate" name="Rate[ratedate]" style="margin-left:5px;width:170px;"></div>
     <div id="sidebar" class="span4"><label class="control-label" for="Rate_entry">Rubro </label> <select id="Rate_entry" name="Rate[entry]" style="margin-left:5px;width:170px;">
		<?php 
		foreach($service as $id => $value){
			$selected = ($id==$model->entry)?" Selected ":"";
			echo '<option value="'.$id.'" '.$selected.'>'.$value.'</option>';
			
		}
			
		?>
		</select>
	 </div>
    </div>
    <div class="row-fluid">
     <div id="sidebar" class="span12" style="padding-left:10px;">&nbsp;</div>
    </div>
    <div class="row-fluid">
     <div id="sidebar" class="span4"><label class="control-label" for="Rate_customerdsc">Cliente </label> <select id="Rate_customerid" name="Rate[customerid]" style="margin-left:5px;width:170px;">
     	<?php 
		foreach($customer as $id => $value){
			$selected = ($id==$model->customerid)?" Selected ":"";
			echo '<option value="'.$id.'" '.$selected.'>'.$value.'</option>';
			
		}
			
		?>
     </select></div>
     <div id="sidebar" class="span4"><label class="control-label" for="Rate_branddsc">Marca </label> <input id="Rate_branddsc" type="text" name="Rate[branddsc]" style="margin-left:5px;width:170px;" value="<?php echo $model->branddsc ?>"></div>
     <div id="sidebar" class="span4"><label class="control-label" for="Rate_projectdsc">Proyecto </label> <input id="Rate_projectdsc" type="text" name="Rate[projectdsc]" style="margin-left:5px;width:170px;" value="<?php echo $model->projectdsc ?>"></div>
    </div>
    <div class="row-fluid">
     <div id="sidebar" class="span12" style="padding-left:10px;">&nbsp;</div>
    </div>
    <div class="row-fluid">
     <div id="sidebar" class="span12" style="text-align: center;"><?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Buscar',
        )); ?></div>
     </div>
	<?php $this->endWidget(); ?>
	</div>
	<?php 
    $this->widget('bootstrap.widgets.TbGroupGridView',array(
	'id'=>'rate-grid',
	//'fixedHeader' => true,
	//'headerOffset' => 40,
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'type'=>'striped bordered condensed',
	//'mergeColumns' => array('bundleid'),
	'extraRowColumns'=> array('bundleid'),
	'extraRowExpression' => '"<b>Cotización ID: </b><a href=\"".Yii::app()->createUrl("portoprint/rate/price",array("id"=>Utils::encrypt($data->bundleid,"rate")))."\">".$data->bundleid."</a><br>"
							."<b>Cliente / Marca / Proyecto: </b>".$data->customerdsc." / "
							.$data->branddsc." / ".$data->projectdsc.""',
	'extraRowHtmlOptions' => array('style'=>'padding:10px'),

	'afterAjaxUpdate'=>'function(){ $(".ratepop").popover({"trigger":"hover", "html" : true}) ;}',
	'columns'=>array(
		array(
			'name'=>'rateid',
			'value'=>'RateController::idVersion($data->parentrateid,$data->version)',  
			'htmlOptions'=>array('style'=>'width: 100px;'),
		),
		array(
            'name' => 'ratedate' ,
            'htmlOptions'=>array('style'=>'width: 50px;'),       
        ),
        array(
            'name' => 'customerdsc',
            'value'=>'$data->customerdsc',   
            'htmlOptions'=>array('style'=>'width: 230px;'),         
        ),
        array(
            'name' => 'branddsc',
            'value'=>'$data->branddsc',
        	'htmlOptions'=>array('style'=>'width: 230px;'),               
        ),
        array(
            'name' => 'projectdsc',
            'value'=>'$data->projectdsc'  ,
        	'htmlOptions'=>array('style'=>'width: 230px;'),                 
        ),
		array(
			'type' => 'raw',
            'name' => 'servicedsc',
			//'htmlOptions'=>array('style'=>'width: 400px;'),
            //'value'=>'RateController::getDetail($data->rateid,$data->servicedsc,$data->note)',
		    'value'=>'$data->servicedsc',       
        ),		
        array(
            'name' => 'firstname',
            'value'=>'$data->firstname' ,
        	'htmlOptions'=>array('style'=>'width: 80px;'),            
        ),
		'statusdsc',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => "{Detalles}  ",
            'htmlOptions'=>array('style'=>'width: 40px;'),
        	'buttons'=>array(
				'Detalles' => array(
		        	'options' => array('title'=>'Detalles','class'=>'btn btn-info btn-small'),
					'url'=>'Yii::app()->createUrl("portoprint/rate/view",array("id"=>Utils::encrypt($data->rateid,"rate")))',
					'icon'=>'table')
		    )       
        ) 
	),
)); ?>



<?php $this->endWidget();?>
<script>
$(function(){
	$('#Rate_ratedate').datepicker({format:'yyyy-mm-dd'});
	$('#searchratebtn').click( function(){
		$('#searchratediv').slideToggle("slow");
	});
	$('.ratepop').popover({"trigger":"hover", "html" : true, "container":"body"})
	
});

</script>
<br><br><br><br><br>
