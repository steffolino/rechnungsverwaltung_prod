<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
//	'YII_DEBUG' => false,
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'*Rechnungstool*',
	'defaultController' => 'site/index',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'booster',
	),
	

	//added by stef
	/*Requires a User to Log-In for viewing pages
	'behaviors' => array(
		'onBeginRequest' => array(
			'class' => 'application.components.RequireLogin'
		)
	),
	*/
	//yiistrap stuff
    // path aliases
    'aliases' => array(
        // yiistrap configuration
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change if necessary
		'booster' => realpath (__DIR__ . '/../extensions/yiibooster'),
        // yiiwheels configuration
        //'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'), // change if necessary		
		'vendor.twbs.bootstrap.dist' => realpath(__DIR__ . '/../extensions/bootstrap'),
    ),

	
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//yiistrap
        'bootstrap.helpers.TbHtml',
        //'bootstrap.helpers.TbApi',
        'bootstrap.helpers.TbArray',
		//'bootstrap.helpers.*',
		//'bootstrap.components.*',
		//'bootstrap.widgets.TbBreadcrumb',
		'bootstrap.behaviors.TbWidget',
		'bootstrap.widgets.TbActiveForm',
		'bootstrap.assets.css.*',
		'bootstrap.assets.js.*',
	),
	
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'test123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
		),
		
		//yiistrap
		// 'gii' => array(
            // 'generatorPaths' => array('bootstrap.gii'),
        // ),
	),

	// application components
	'components'=>array(
	
	    // yiistrap configuration
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
		'booster' => array(
			'class' => 'booster.components.booster',
		),
        // yiiwheels configuration
        /*'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',   
        ),
		*/
		
		/* PDF EXTENSION BELOW */
        'ePdf' => array(
            'class'         => 'ext.yii-pdf.EYiiPdf',
            'params'        => array(
                'mpdf'     => array(
                    'librarySourcePath' => 'application.extensions.vendors.mpdf.*',
                    'constants'         => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder.
                    'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode'              => '', //  This parameter specifies the mode of the new document.
                        'format'            => 'A4', // format A4, A5, ...
                        'default_font_size' => 12, // Sets the default document font size in points (pt)
                        'default_font'      => 'Arial', // Sets the default font-family for the new document.
                        'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                        'mgr'               => 15, // margin_right
                        'mgt'               => 16, // margin_top
                        'mgb'               => 16, // margin_bottom
                        'mgh'               => 9, // margin_header
                        'mgf'               => 9, // margin_footer
                        'orientation'       => 'P', // landscape or portrait orientation
                    )
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.extensions.vendors.html2pdf.*',
                    'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                    'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format'      => 'A4', // format A4, A5, ...
                        'language'    => 'en', // language: fr, en, it ...
                        'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )
                )
            ),
        ),
		
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

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
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'error, warning,trace,info,debug',
				),
				
				
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
