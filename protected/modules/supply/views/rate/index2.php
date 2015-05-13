<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
				Cotizaciones
		</h1>
	</div>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
		<ul id="sparks" class="">
			<li class="sparks-info">
				<h5> My Income <span class="txt-color-blue">$47,171</span></h5>
				<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
					1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
				</div>
			</li>
			<li class="sparks-info">
				<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
				<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
					110,150,300,130,400,240,220,310,220,300, 270, 210
				</div>
			</li>
			<li class="sparks-info">
				<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
				<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
					110,150,300,130,400,240,220,310,220,300, 270, 210
				</div>
			</li>
		</ul>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Cotizaciones</h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">
						<div style="padding: 0;">
							<div id="grid" class="grid"></div>
						</div>
						

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->

	</div>

	<!-- end row -->

	<!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">

	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	pageSetUp();
	jQuery(function ($) {

		  function DummyLinkFormatter(row, cell, value, columnDef, dataContext) {
		    return '<a href="#">' + value + '</a>';
		  }

		  function filter(item) {

			    for (var columnId in columnFilters) {
			      if (columnId !== undefined && columnFilters[columnId] !== "") {
			        var c = grid.getColumns()[grid.getColumnIndex(columnId)];
			        if (item[c.field] != columnFilters[columnId]) {
			          return false;
			        }
			      }
			    }
			    return true;
			  }
		  
		 var columnFilters = {};
		 var columns = [
		    {id: "rateid", name: "COTIZACIÓN ID", field: "rateid", sortable: true, formatter: DummyLinkFormatter},
		    {id: "ratedate", name: "FECHA", field: "ratedate", width: 100, sortable: true},
		    {id: "customerdsc", name: "CLIENTE", field: "customerdsc", width: 100, sortable: true},
		    {id: "branddsc", name: "MARCA", field: "branddsc", width: 100, sortable: true},
		    {id: "projectdsc", name: "PROYECTO", field: "projectdsc", width: 100, sortable: true},
		    {id: "items", name: "ITEMS", field: "items", width: 100, sortable: true}
		  ];
         var options = {
		      enableCellNavigation: true,
		      enableColumnReorder: true,
		      forceFitColumns: true,
		      rowHeight: 35,
		      showHeaderRow: true,
		      explicitInitialization: true
		    };
		  
		  <?php 
		  $data=array();
		  foreach($model as $row){
		  	$data[]=array(
		  	"id"=>$row->rateid,
		  	"rateid"=>$row->lrateid,
		    "ratedate"=>$row->ratedate,
		    "customerdsc"=>$row->customerdsc,
		    "branddsc"=>$row->branddsc,
		    "projectdsc"=>$row->projectdsc,
		    "items"=>$row->servicedsc
		    );
		  }
		  
		  ?>
        
		  var dataView = new Slick.Data.DataView();

			 
		  var dataFull=<?php echo json_encode($data); ?>;
		  var grid = new Slick.Grid("#grid", dataView, columns, options);
		  
		  var sortCol = options.sortCol;
		  var sortDir = options.sortDir;
		  
		  function comparer(a, b) {
		        var x = a[sortCol], y = b[sortCol];
		        return (x == y ? 0 : (x > y ? 1 : -1));
		  }
		      
		  grid.onSort.subscribe(function (e, args) {
	          sortDir = args.sortAsc;
	          sortCol = args.sortCol.field;
	          dataView.sort(comparer, sortDir);
	          grid.invalidateAllRows();
	          grid.render();
	      });

	      

	      dataView.onRowCountChanged.subscribe(function (e, args) {
	          grid.updateRowCount();
	          grid.render();
	        });

	        dataView.onRowsChanged.subscribe(function (e, args) {
	          grid.invalidateRows(args.rows);
	          grid.render();
	        });


	        $(grid.getHeaderRow()).delegate(":input", "change keyup", function (e) {
	          var columnId = $(this).data("columnId");
	  
	          if (columnId != null) {
	            columnFilters[columnId] = $.trim($(this).val());
	            dataView.refresh();
	          }
	        });

	        grid.onHeaderRowCellRendered.subscribe(function(e, args) {
	            $(args.node).empty();
	            $("<input type='text'>")
	               .data("columnId", args.column.id)
	               .val(columnFilters[args.column.id])
	               .appendTo(args.node);
	        });

	        grid.init();

	      dataView.beginUpdate();
	      dataView.setItems(dataFull);
	      dataView.setFilter(filter);
	      dataView.endUpdate();
	      
	      grid.resizeCanvas(); 




		});
	

	

</script>
