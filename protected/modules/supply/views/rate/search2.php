<div class="inbox-nav-bar no-content-padding">

	<h1 class="page-title txt-color-blueDark hidden-tablet">Filtros de Búsqueda</h1>
</div>

<div id="inbox-content" class="inbox-body no-content-padding">

	<div class="inbox-side-bar " style="overflow: auto; width:300px; font-size:10px;  ">
		<ul class="inbox-menu-lg">
			<li>ITEM
				<select id="Search_serviceid" name="Search[serviceid]" class="select2" style="width: 250px;" >
				<option value=""></option>
				<?php foreach($servicelist as $group => $items){?>
					<optgroup label="<?php echo $group; ?>">
						<?php foreach($items as $id=> $item){?>
							<option value="<?php echo $id; ?>"><?php echo $item; ?></option>
						<?php } ?>
					</optgroup>
				<?php } ?>
				</select>
			</li>
		</ul>
		<ul class="inbox-menu-lg" id="search--results">
			
		</ul>
	</div>

	<div class="table-wrap custom-scroll animated fast fadeInRight" style="margin-left:305px;">
		<table style="font-size: 10px;" class="table table-bordered">
			<thead>
				<tr>
					<th style="width:10%">Cotización ID</th>
					<th style="width:30%">Cliente</th>
					<th style="width:30%">Proveedor</th>
					<th style="width:10%">Fecha ODC</th>
					<th style="width:10%">Cantidad</th>
					<th style="width:10%">Precio</th>
				</tr>
			</thead>
			<tbody id="bodyresults"></tbody>
		</table>
	</div>

</div>

<script type="text/javascript">
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	pageSetUp();

	
	tableHeightSize()
	$(window).resize(function() {
		tableHeightSize()
	})
	
	function tableHeightSize() {
		var tableHeight = $(window).height() - 180;
		$('.table-wrap').css('height', tableHeight + 'px');
	}
	
	$(document).ready(function (){
		$("#Search_serviceid").change( function(){
			var serviceid = $(this).val();
			var sdetailv = '' ;
			$("#search--results").load('?r=portoprint/rate/searchfilters/id/'+serviceid, function(){
				$('.sresult').select2().change(function(){
					sdetailv = '' ;
					$('.sresult').each(function(){
						if($(this).val()!=null && $(this).val()!=''){
							sdetailv+= $(this).val()+',';
						}
					});

					sdetailv = sdetailv.substr(0,sdetailv.length-1)
					$("#bodyresults").load('?r=portoprint/rate/searchresults/id/'+serviceid+'/sdetailv/'+sdetailv);
					
					
				});
			});
			$("#bodyresults").load('?r=portoprint/rate/searchresults/id/'+serviceid+'/sdetailv/'+sdetailv);
			
		});
	});
	
	

</script>
