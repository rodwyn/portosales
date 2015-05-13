<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				

				<!-- widget div-->
				<div>
					<!-- widget content -->
					<div class="widget-body">
						<div class="row">
						<form novalidate="novalidate" class="smart-form" id="rate-form" method="POST" action="?r=portoprint/rate/search" >
							<input type="hidden" vaue="1" name="paso" />	
							<header>
									<strong>Buscar Precio de Item en Históricos</strong>
							</header>
											
							<fieldset>
								<div class="row">
									<section class="col col-4">
										<div>
										<label class="label">Item</label>
										<label class="input"> 
										<select id="Search_serviceid" name="Search[serviceid]" class="select2" style="width: 350px;" >
										<?php foreach($servicelist as $group => $items){?>
											<optgroup label="<?php echo $group; ?>">
												<?php foreach($items as $id=> $item){?>
													<option value="<?php echo $id; ?>"><?php echo $item; ?></option>
												<?php } ?>
											</optgroup>
										<?php } ?>
										</select>
										</label>
										</div>
										<div id="search--results">
										</div>
									</section>
									<section class="col col-8">
										<div id="result--search">
											<table id="ratelist_table" class="table table-striped table-hover">
														<thead>
															<tr>
																<th>Cotización ID</th>
																<th>Fecha</th>
																<th>Cliente</th>
																<th>Marca</th>
																<th>Proyecto</th>
																<th>Item</th>
															</tr>
															
														</thead>
														<tbody>
															
															
														</tbody>
													</table>
										</div>
									</section>							
								</div>							
								
							</fieldset>
							
						</form>
						</div>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->

		<!-- NEW WIDGET START -->
		
		<!-- WIDGET END -->

	</div>

	<!-- end row -->

</section>
<script type="text/javascript">
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	pageSetUp();
	$(document).ready(function (){
		$("#Search_serviceid").change( function(){
			var serviceid = $(this).val();
			
			$("#search--results").load('?r=portoprint/rate/searchresults/id/'+serviceid, function(){
				$('.sresult').select2().change(function(){
					var sdetailv = '' ;
					$('.sresult').each(function(){
						if($(this).val()!=null && $(this).val()!=''){
							sdetailv+= $(this).val()+',';
						}
					});
					console.debug(sdetailv.substr(0,sdetailv.length-1));
				});
			});
			
		});
	});
	// PAGE RELATED SCRIPTS

</script>