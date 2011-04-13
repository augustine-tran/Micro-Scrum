<?php

class SiteController extends Controller
{
	//public $layout='newlayout';
	
	public $defaultAction = 'login';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
//		Yii::app()->language = 'rev';
		
		Yii::trace("The actionLogin() method is being requested", "application.controllers.SiteController");
		
		if(!Yii::app()->user->isGuest) 
		{
		     $this->redirect(Yii::app()->homeUrl);
		}
		
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				Yii::log("Successful login of user: " . Yii::app()->user->id, "info", "application.controllers.SiteController");
				$this->redirect(Yii::app()->user->returnUrl);
			}
			else
			{
				Yii::log("Failed login attempt", "warning", "application.controllers.SiteController");
			}
				
		}
		// display the login form
		//public string findLocalizedFile(string $srcFile, string $srcLanguage=NULL, string $language=NULL)
		$this->render('login',array('model'=>$model));
		
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionShowLog()
	{
		echo "Logged Messages:<br><br>";
		var_dump(Yii::getLogger()->getLogs());
	}
	
	public function actionFakeBackLog() {
		$total = 150;
		$limit = Yii::app()->request->getQuery('limit', 30);
		$start = Yii::app()->request->getQuery('start', 0);
		
		$limit = min(100 - $start, $limit);
		
		$data = array ('total' => $total, 'data' => FakeDataHelper::generateStories(0, $limit), 'success' => true);
		echo CJSON::encode($data);
	}
	
	public function actionFakeSprint() {
		$total = 100;
		$sprint = Yii::app()->request->getQuery('sprint', 1);
		$limit = Yii::app()->request->getQuery('limit', 20);
		$start = Yii::app()->request->getQuery('start', 0);
		
		$limit = min(100 - $start, $limit);
		
		$data = array ('total' => $total, 'data' => FakeDataHelper::generateStories($sprint, $limit), 'success' => true);
		echo CJSON::encode($data);
	}
	
	public function actionFakeMembers() {
		$total = 10;
		$limit = Yii::app()->request->getQuery('limit', 10);
		$start = Yii::app()->request->getQuery('start', 0);
		
		$limit = min(100 - $start, $limit);
		
		$data = array ('total' => $total, 'data' => FakeDataHelper::generateMembers($limit), 'success' => true);
		echo CJSON::encode($data);
	}
	
	public function actionFakeProjectMembers() {
		$total = 4;
		$limit = Yii::app()->request->getQuery('limit', 10);
		$start = Yii::app()->request->getQuery('start', 0);
		
		$limit = min(100 - $start, $limit);
		
		$data = array ('total' => $total, 'data' => FakeDataHelper::generateProjectMembers(1, $limit), 'success' => true);
		echo CJSON::encode($data);
	}
}