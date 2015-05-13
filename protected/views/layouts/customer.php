<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
		<title>SMART PRINT SOFTWARE 2.0 PORTOPRINT</title>
		<!-- Use the correct meta names below for your web application
			 Ref: http://davidbcalhoun.com/2010/viewport-metatag 
			 
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">-->
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/smartadmin-production_unminified.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/smartadmin-skins.css">

	

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/demo.css">
                <!-- Estilos personalizados  -->
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/style.css">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
		
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/components/slickgrid/slick.grid.css" type="text/css"/>
  		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/daterangepicker-bs3.css" type="text/css"/>
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/jquery.timepicker.css" type="text/css"/>
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/dataTables.bootstrap.css" type="text/css"/>

  		
  		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/jquery.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/jquery-ui.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/bootstrap/bootstrap.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/notification/SmartNotification.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/smartwidgets/jarvis.widget.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/sparkline/jquery.sparkline.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/select2/select2.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/smartclick/smartclick.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/bootstrap/bootstrap-slickgrid.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/jquery-form/jquery-form.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/jquery-validate/jquery.validate.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/moment.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/daterangepicker.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/x-editable/x-editable.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/dropzone/dropzone.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/vis.min.js"></script>
                <script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/bootstrap/dataTables.bootstrap.js"></script>
               <script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/jquery.timepicker.js"></script>
               <script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/jquery.timepicker.min.js"></script>
                <script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/plugin/datatables/DT_bootstrap.js"></script>
  		
	</head>
	<body class="">
		<!-- possible classes: minified, fixed-ribbon, fixed-header, fixed-width-->

		<!-- HEADER -->
		<header id="header">
			<div id="logo-group">

				<!-- PLACE YOUR LOGO HERE -->
				<span id="logo"><span style="letter-spacing: 2px; font-weight: 900;" id="Portoprintlogo">Porto Print</span></br>Smart Print Software </span>
				<!-- END LOGO PLACEHOLDER -->

				<!-- Note: The activity badge color changes when clicked and resets the number to 0
				Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
				<span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>

				<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
				<div class="ajax-dropdown">

					<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/mail.html">
							Msgs (14) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/notifications.html">
							notify (3) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/tasks.html">
							Tasks (4) </label>
					</div>

					<!-- notification content -->
					<div class="ajax-notifications custom-scroll">

						<div class="alert alert-transparent">
							<h4>Click a button to show messages here</h4>
							This blank page message helps protect your privacy, or you can show the first message here automatically.
						</div>

						<i class="fa fa-lock fa-4x fa-border"></i>

					</div>
					<!-- end notification content -->

					<!-- footer: refresh area -->
					<span> Last updated on: 12/12/2013 9:43AM
						<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
							<i class="fa fa-refresh"></i>
						</button> </span>
					<!-- end footer -->

				</div>
				<!-- END AJAX-DROPDOWN -->
			</div>

			<!-- projects dropdown -->
			<div id="project-context">
                                <span class="label">Clientes:  </span>
                                    <span class="label" ><?php echo Yii::app()->user->username; ?></span>
						
				<!-- end dropdown-menu-->

			</div>
			<!-- end projects dropdown -->

			<!-- pulled right: nav area -->
			<div class="pull-right">

				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->

				<!-- logout button -->
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/logout'); ?>" title="Sign Out"><i class="fa fa-sign-out"></i></a> </span>
				</div>
				<!-- end logout button -->

				<!-- search mobile button (this is hidden till mobile view port) -->
				<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
				</div>
				<!-- end search mobile button -->

				

				<!-- multiple lang dropdown : find all flags in the image folder -->
				
				<!-- end multiple lang -->

			</div>
			<!-- end pulled right: nav area -->

		</header>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/theme/img/avatars/sunny.png" alt="me" class="online" /> 
					<a href="javascript:void(0);" id="show-shortcut">
						<?php echo Yii::app()->user->username ?> <i class="fa fa-angle-down"></i>
					</a> 
				</span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional href="" links. See documentation for details.
				-->

				<ul>
					
					<li id="ml1" class="">
						<a href="<?php echo Yii::app()->createUrl('/customer/default/dashboard'); ?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					<li id="ml2" class="">
						<a href="<?php echo Yii::app()->createUrl('/customer/rate/create'); ?>" title="Cotizador"><i class="fa fa-lg fa-fw fa-asterisk"></i> <span class="menu-item-parent">Cotizador</span></a>
					</li>
					<li id="ml3" class="">
						<a href="<?php echo Yii::app()->createUrl('/customer/rate/index'); ?>" title="Cotizaciones"><i class="fa fa-lg fa-fw fa-tasks"></i> <span class="menu-item-parent">Cotizaciones</span></a>
					</li>
					<li id="ml4" class="">
						<a href="<?php echo Yii::app()->createUrl('/customer/rate/search'); ?>" title="Buscador de Precios"><i class="fa fa-lg fa-fw fa-search"></i> <span class="menu-item-parent">Buscador de Precios</span></a>
                                        </li>
					
				</ul>
			</nav>
			<span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<!-- This is auto generated -->
				</ol>
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->

		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
		<div id="shortcut">
			<ul>
				<li>
					<a href="#ajax/inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
				</li>
				<li>
					<a href="#ajax/calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
				</li>
				<li>
					<a href="#ajax/gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
				</li>
				<li>
					<a href="#ajax/invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
<!-- comentario prueba -->				</li>
				<li>
					<a href="#ajax/gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
				</li>
				<li>
					<a href="javascript:void(0);" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
				</li>
			</ul>
		</div>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/theme/js/app.js"></script>
		
	</body>

</html>
