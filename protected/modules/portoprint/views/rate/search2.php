<div class="inbox-nav-bar no-content-padding">

	
    <section class="col col-1">
    <h1 class="page-title txt-color-blueDark hidden-tablet" style="  float: left;">Filtros de Búsqueda</h1>
    <table style="  float: left; position:relative; left: 30%;">
        <tr>
            <td style="width: 200px; ">
                <select id="search_customerid" name="search_customerid" class="select2" >
                    <option value="0">Todos los clientes</option>
                  
                </select>
            </td>
            <td style="width: 20px; "></td>
            <td style="width: 200px; ">
                <select id="search_supplierid" name="search_supplierid" class="select2" >
                    <option value="0">Todos los Proveedores</option>
                    
                </select>
            </td>
            <td style="width: 20px; "></td>
            <td style="width: 200px; ">
                <input type="text" id="search_quantity" placeholder="Cantidad" onkeyup="cal_porcent(this.value)" />
            </td>
        </tr>
    </table>
    </section>
	
							
        
</div>

<div id="inbox-content" class="inbox-body no-content-padding">

	<div class="inbox-side-bar " style="overflow: auto; width:300px; font-size:10px;  ">
		<ul class="inbox-menu-lg">
			<li>ITEM
				<select id="Search_serviceid" name="Search[serviceid]" class="select2" style="width: 250px;" >
				<option value="">Seleccione un Item</option>
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
					<th style="width:5%">CotizaciónID</th>
					<th style="width:5%">ItemID</th>
					<th style="width:20%">Cliente</th>
					<th style="width:20%">Proveedor</th>
					<th style="width:5%">Fecha ODC</th>
					<th style="width:5%">Cantidad</th>
                                        <?php if (Yii::app()->user->specialpermission == 1) { ?>
					<th style="width:20%">Precio Compra</th>
                                        <?php } ?>
                    <th style="width:20%">Precio Venta</th>
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
                $("#search_customerid").attr('disabled', true);
                $("#search_supplierid").attr('disabled', true);
                $("#search_quantity").attr('disabled', true);
	}
	
	$(document).ready(function (){
		$("#Search_serviceid").change( function(){
                        
			var serviceid = $(this).val();
			var sdetailv = '' ;
                        $("#search_customerid").attr('disabled',false);
                        $("#search_supplierid").attr('disabled',false);
                         $("#search_quantity").attr('disabled',false);
                         $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/customers') ?>', function(response){
						
						$(response).appendTo("#search_customerid");
                                               
			    });
                            $("#search_supplierid").find(".clear_shr").remove();
                            $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/supplybyservices') ?>', {serviceid:serviceid }, function(response){
                                    $(response).appendTo("#search_supplierid");
                                               
			    });
                        
			$("#search--results").load('?r=portoprint/rate/searchfilters/id/'+serviceid, function(){
				$('.sresult').select2().change(function(){
                                    
                                     var text=$("#search_quantity").val();
                                     if(text==''){
                                          sdetailv = '' ;
                                            $('.sresult').each(function(){
                                                    if($(this).val()!=null && $(this).val()!='' && $(this).val()!=0){
                                                            sdetailv+= $(this).val()+',';
                                                    }
                                            });

                                            sdetailv = sdetailv.substr(0,sdetailv.length-1);
                                            
                                           var customerid= $("#search_customerid").val();
                                            var supplierid=$("#search_supplierid").val();
                                        if (customerid!=0){
                                            if(sdetailv!=''){sdetailv=-1;}
                                              $("#bodyresults").load('?r=portoprint/rate/searchresults3/id/'+serviceid+'/sdetailv/'+sdetailv+'/customerid/'+customerid+'/supplierid/'+supplierid, function(){ $('.ratepop').popover({"trigger":"hover", "html" : true, "container":"body"}); });    
                                             
                                        }else{
                                           
                                            $("#bodyresults").load('?r=portoprint/rate/searchresults/id/'+serviceid+'/sdetailv/'+sdetailv, function(){ $('.ratepop').popover({"trigger":"hover", "html" : true, "container":"body"}); });
                                        }
                                        
                                    }else{
              
                                        cal_porcent(text); 
                                     } 
					
				});
			});
			$("#bodyresults").load('?r=portoprint/rate/searchresults/id/'+serviceid+'/sdetailv/'+sdetailv, function(){ $('.ratepop').popover({"trigger":"hover", "html" : true, "container":"body"}); });
			
		});
	});
        
        
        function cal_porcent(price){
            
            
                var porcent=(parseInt('20')*parseInt(price))/100;

                var ran_minis=parseInt(price)-porcent;
                var ran_mayus=parseInt(price)+porcent;
                var serviceid = $("#Search_serviceid").val();
                var customerid = $("#search_customerid").val();
                var sdetailv = '' ;
                var supplierid=$("#search_supplierid").val();
              
                
                $('.sresult').each(function(){
						if($(this).val()!=null && $(this).val()!='' && $(this).val()!=0){
							sdetailv+= $(this).val()+',';
						}
		});
                  sdetailv = sdetailv.substr(0,sdetailv.length-1);
                                        //console.log(sdetailv);
                                       if(sdetailv!=''){sdetailv=-1;}
                                       if(ran_minis==''){ran_minis=0;
                                           ran_mayus=0;
                                       }
              $("#bodyresults").load('?r=portoprint/rate/searchresults4/id/'+serviceid+'/sdetailv/'+sdetailv+'/customerid/'+customerid+'/supplierid/'+supplierid+'/min/'+ran_minis+'/max/'+ran_mayus, function(){ $('.ratepop').popover({"trigger":"hover", "html" : true, "container":"body"}); });     
                
            
            
            
        }
	
        $("#search_customerid").change( function(){
           var text=$("#search_quantity").val();
            if(text==''){
            var serviceid = $("#Search_serviceid").val();
            var customerid = $(this).val();
            var sdetailv = '' ;
                        
                       
                        $("#search_supplierid").find(".clear_shr").remove();
                        if(customerid!=0){
                         $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/supplybyservices2') ?>', {serviceid:serviceid , customerid:customerid  }, function(response){
                                    $(response).appendTo("#search_supplierid");
                                               
			    });
                        }else{
                          $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/combos/supplybyservices') ?>', {serviceid:serviceid }, function(response){
                                    $(response).appendTo("#search_supplierid");
                                               
			    });  
                            
                        }
					$('.sresult').each(function(){
						if($(this).val()!=null && $(this).val()!='' && $(this).val()!=0){
							sdetailv+= $(this).val()+',';
						}
					});

					sdetailv = sdetailv.substr(0,sdetailv.length-1);
                                        //console.log(sdetailv);
                                       if(sdetailv!=''){sdetailv=-1;}
                        
                            $("#bodyresults").load('?r=portoprint/rate/searchresults2/id/'+serviceid+'/sdetailv/'+sdetailv+'/customerid/'+customerid, function(){ $('.ratepop').popover({"trigger":"hover", "html" : true, "container":"body"}); });
                            }else{
                             cal_porcent(text); 
                            
                            }  
                       
        });
        
        $("#search_supplierid").change( function(){
            var text=$("#search_quantity").val();
            if(text==''){
            
            var serviceid = $("#Search_serviceid").val();
            var customerid = $("#search_customerid").val();
            var sdetailv = '' ;
            var supplierid=$(this).val();
            
                             $('.sresult').each(function(){
						if($(this).val()!=null && $(this).val()!='' && $(this).val()!=0){
							sdetailv+= $(this).val()+',';
						}
					});
                                        sdetailv = sdetailv.substr(0,sdetailv.length-1);
                                        //console.log(sdetailv);
                                       if(sdetailv!=''){sdetailv=-1;}
              $("#bodyresults").load('?r=portoprint/rate/searchresults3/id/'+serviceid+'/sdetailv/'+sdetailv+'/customerid/'+customerid+'/supplierid/'+supplierid, function(){ $('.ratepop').popover({"trigger":"hover", "html" : true, "container":"body"}); });    
          }else{
              
             cal_porcent(text); 
          } 
        });
</script>
