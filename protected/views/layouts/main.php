<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - Ace Admin</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/css/font-awesome.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
                
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../assets/js/html5shiv.js"></script>
		<script src="../assets/js/respond.js"></script>
		<![endif]-->
                
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/css/jquery.dataTables.min.css" type="text/css"/>
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/old/css/dataTables.responsive.css" type="text/css"/>
                
</head>

<body class="no-skin">
     <div style="display:none;">
            <script>
                  
                    var session_menu= JSON.parse('<?php echo json_encode (Yii::app()->user->menu);?>');
                    console.log(session_menu);
                 
            </script>
        </div>
	  <!-- #section:basics/navbar.layout -->
	  <div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar">
	      <script type="text/javascript">
		  try {
		      ace.settings.check('navbar', 'fixed')
		  } catch (e) {
		  }
	      </script>

	      <div class="navbar-container" id="navbar-container">
		  <div class="navbar-header pull-left">
		      <!-- #section:basics/navbar.layout.brand -->
		      <a href="#" class="navbar-brand">
			  <small>
			      <i class="fa fa-leaf"></i>
			      Ace Admin - <?php echo Yii::app()->user->companydsc ?>
			  </small>
		      </a>

		      <!-- /section:basics/navbar.layout.brand -->

		      <!-- #section:basics/navbar.toggle -->
		      <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
			  <span class="sr-only">Toggle user menu</span>

			  <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/avatars/male.png" alt="Jason's Photo" />
		      </button>

		      <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
			  <span class="sr-only">Toggle sidebar</span>

			  <span class="icon-bar"></span>

			  <span class="icon-bar"></span>

			  <span class="icon-bar"></span>
		      </button><!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
		</script>

		      <!-- /section:basics/navbar.toggle -->
		  </div>

		  <!-- #section:basics/navbar.dropdown -->
		  <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
		      <ul class="nav ace-nav">
			  <!-- #section:basics/navbar.user_menu -->
			  <li class="light-blue ">
			      <a  href="#" >
				  <img class="nav-user-photo" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/avatars/male.png" alt="Jason's Photo" />
				  <span class="user-info">
				      <small>Bienvenido,</small>
				      	<?php echo Yii::app()->user->username ?>

				  </span>
			      </a>
			  </li>
			  <li class="light-blue user-min">
			      <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/logout'); ?>">
				  <i class="ace-icon fa fa-power-off"></i>

			      </a>
			  </li>

			  <!-- /section:basics/navbar.user_menu -->
		      </ul>
		  </div>

		  <!-- /section:basics/navbar.dropdown -->

	      </div><!-- /.navbar-container -->
	  </div>

	  <!-- /section:basics/navbar.layout -->
	  <div class="main-container" id="main-container">
	      <script type="text/javascript">
		  try {
		      ace.settings.check('main-container', 'fixed')
		  } catch (e) {
		  }
	      </script>

	      <!-- #section:basics/sidebar.horizontal -->
	      <div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse">
		  <script type="text/javascript">
		      try {
			  ace.settings.check('sidebar', 'fixed')
		      } catch (e) {
		      }
		  </script>
		  
                  
                  <ul class="nav nav-list" id="SessMenuResp">
		     
		  </ul><!-- /.nav-list -->
                  
                         
                <script>

                   $( document ).ready(function() {
                     var menu_session=session_menu;
                     console.log(menu_session);
                     var cad='';
                    $.each(menu_session, function( key,  val ) {

                       
                            cad+=' <li class="hover" id="ml'+val['ml']+'"> <a href="'+val['url']+'" data-menuid ="'+val['menuid']+'" title="'+key+'" ><i class="menu-icon'+val['icon']+'"></i>'+
                              '<span class="menu-text" >'+key+'</span></a><b class="arrow"></b></li>';
                         
                     });

                     $("#SessMenuResp").html(cad);


                    });

                   
                </script>
                  
                  
		  <!-- #section:basics/sidebar.layout.minimize -->

		  <!-- /section:basics/sidebar.layout.minimize -->
		  <script type="text/javascript">
		      try {
			  ace.settings.check('sidebar', 'collapsed')
		      } catch (e) {
		      }
		  </script>
	      </div>

              
         
              
              
	      <!-- /section:basics/sidebar.horizontal -->
	      <div class="main-content" id="main" role="main" >
		  <div class="main-content-inner" id="content">
		      <div class="page-content" >
                          <?php echo $content; ?>
                          
		  </div>
	      </div><!-- /.main-content -->

	      <div class="footer">
		  <div class="footer-inner">
		      <!-- #section:basics/footer -->
		      <div class="footer-content">
			  <span class="bigger-120">
			      <span class="blue bolder">Portoprint </span>
			      Punto de venta &copy; 2015
			  </span>
		      </div>
		      <!-- /section:basics/footer -->
		  </div>
	      </div>

	      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		  <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
	      </a>
	  </div><!-- /.main-container -->

	  <!-- basic scripts -->

	  <!--[if !IE]> -->
	  <script type="text/javascript">
	      window.jQuery || document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/jquery.js'>" + "<" + "/script>");
              
              
              
              
	  </script>

	  <!-- <![endif]-->

	  <!--[if IE]>
  <script type="text/javascript">
  window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
  </script>
  <![endif]-->
	  <script type="text/javascript">
	      if ('ontouchstart' in document.documentElement)
		  document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
	  </script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/bootstrap.js"></script>

	  <!-- page specific plugin scripts -->

	  <!-- ace scripts -->
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/elements.scroller.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/elements.colorpicker.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/elements.fileinput.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/elements.typeahead.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/elements.wysiwyg.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/elements.spinner.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/elements.treeview.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/elements.wizard.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/elements.aside.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.ajax-content.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.touch-drag.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.sidebar.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.sidebar-scroll-1.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.submenu-hover.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.widget-box.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.settings.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.settings-rtl.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.settings-skin.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.widget-on-reload.js"></script>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/ace/ace.searchbox-autocomplete.js"></script>
          <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/assets/js/jquery.dataTables.min.js"></script>
          <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/old/js/dataTables.responsive.js"></script>
          <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/old/js/app.js"></script>
	  <!-- inline scripts related to this page -->
	  <script type="text/javascript">
	      jQuery(function($) {
		  var $sidebar = $('.sidebar').eq(0);
		  if (!$sidebar.hasClass('h-sidebar'))
		      return;

		  $(document).on('settings.ace.top_menu', function(ev, event_name, fixed) {
		      if (event_name !== 'sidebar_fixed')
			  return;

		      var sidebar = $sidebar.get(0);
		      var $window = $(window);

		      //return if sidebar is not fixed or in mobile view mode
		      var sidebar_vars = $sidebar.ace_sidebar('vars');
		      if (!fixed || (sidebar_vars['mobile_view'] || sidebar_vars['collapsible'])) {
			  $sidebar.removeClass('lower-highlight');
			  //restore original, default marginTop
			  sidebar.style.marginTop = '';

			  $window.off('scroll.ace.top_menu')
			  return;
		      }


		      var done = false;
		      $window.on('scroll.ace.top_menu', function(e) {

			  var scroll = $window.scrollTop();
			  scroll = parseInt(scroll / 4);//move the menu up 1px for every 4px of document scrolling
			  if (scroll > 17)
			      scroll = 17;


			  if (scroll > 16) {
			      if (!done) {
				  $sidebar.addClass('lower-highlight');
				  done = true;
			      }
			  }
			  else {
			      if (done) {
				  $sidebar.removeClass('lower-highlight');
				  done = false;
			      }
			  }

			  sidebar.style['marginTop'] = (17 - scroll) + 'px';
		      }).triggerHandler('scroll.ace.top_menu');

		  }).triggerHandler('settings.ace.top_menu', ['sidebar_fixed', $sidebar.hasClass('sidebar-fixed')]);

		  $(window).on('resize.ace.top_menu', function() {
		      $(document).triggerHandler('settings.ace.top_menu', ['sidebar_fixed', $sidebar.hasClass('sidebar-fixed')]);
		  });


	      });
	  </script>
      </body>
</html>
