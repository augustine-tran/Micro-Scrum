<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/new/main.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	<div id="wrapper">
		<div id="container">
			<div id="header">
				<div id="topnav">
					<h1 id="logo">Track Star</h1>
					<div id="secondmenu">Settings</div>
				</div>
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						//array('label'=>'Home', 'url'=>array('/site/index')),
						array('label'=>'Projects', 'url'=>array('/project')),
						array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
						array('label'=>'Contact', 'url'=>array('/site/contact')),
						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),
					'id' => 'mainmenu', 
					'htmlOptions' => array('class' => 'kkk')
				)); ?>
			</div>
			<div id="mainbody">
				<?php echo $content;?>
			</div>
			<div class="clearfix"></div>
			<div id="footer">Footer</div>
		</div>
	</div>
</body>
</html>
