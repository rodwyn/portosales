<?php


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SPS - Smart Print Software',
	'language'=>'es',
    'sourceLanguage'=>'es',
	

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.EDataTables.*'
	),

	'modules'=>array(
		'portoprint'=>array(),
		 'supply'=>array(),
		  'customer'=>array(),
		/*'gii'=>array(
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
        ),*/
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'generatorPaths'=>array(
                'bootstrap.gii',
            ),
			'class'=>'system.gii.GiiModule',
			'password'=>'axsz',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		/*'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=porto_v2',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '1QA2WS',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'ePdf' => array(
	        'class'         => 'ext.yii-pdf.EYiiPdf',
	        'params'        => array(
	            'HTML2PDF' => array(
	                'librarySourcePath' => 'application.classes.html2pdf.*',
	                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
	                'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
	                    'orientation' => 'P', // landscape or portrait orientation
	                    'format'      => 'LETTER', // format A4, A5, ...
	                    'language'    => 'fr', // language: fr, en, it ...
	                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
	                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
	                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
	                )
	            )
	        ),
	    ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                
                'imagePath'=> 'images/',
                'logosPath2'=> '/srv/www/sps-portoprint.com/Portal/images/',
                'logosPath'=> '/var/www/sps-portoprint.com/Portal/images/',
                //Ruta para los artes/repositorio de archivos
                'imageUpload2'=> '/srv/www/imageUpload/',
                'imageUpload'=> '/var/www/sps-portoprint.com/Portal/imageUpload/'
            
	),
);
