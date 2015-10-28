<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	
	<?php 	
		//yiistrap stuff
		Yii::app()->bootstrap->register(); 
		$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/font-awesome.min.css');

	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="header">
	</div><!-- header -->

	<div id="mainmenu">

	<?php
		$this->widget('bootstrap.widgets.TbNavbar', array(
//		'color' => TbHtml::NAVBAR_COLOR_INVERSE,
        'items' => array(
				array(
					'class' => 'bootstrap.widgets.TbNav',
					'items' => array(
//						array('label'=>'<span class="glyphicon glyphicon-shopping-cart">', 'url'=>array('/site/index')),
//						array('label' => Html::tag('span','','class' => 'glyphicon glyphicon-lock')),
						array('label'=>'JVA', 'url'=>array('/jva/listJVAs'), 'icon' => 'glyphicon glyphicon-shopping-cart'),
						array('label'=>'Rechnungen', 'url'=>array('/document/enterNewDoc'), 'icon' => 'glyphicon glyphicon-file'),
						array('label'=>'Suchen', 'url'=>array('/search/search'), 'icon' => 'glyphicon glyphicon-search'),
//						array('label'=>'Contact', 'url'=>array('/site/contact')),
//						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
//						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),
				),
		)
		)); ?>

  
	</div><!-- mainmenu -->
	
	<?php echo $content; ?>

	<div class="clear"></div>

	<!--div id="footer hidden-print" media="screen">
		Copyright &copy; <?php //echo date('Y'); ?> by Stefan Stretz - Medientechnik<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>

</html>
