<?php

class SprintController extends Controller
{
	protected $_project;
	
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'projectContext +admin planning assignTask', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','planning','assignTask'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Sprint;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sprint']))
		{
			$model->attributes=$_POST['Sprint'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sprint']))
		{
			$model->attributes=$_POST['Sprint'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Sprint');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Sprint('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Sprint']))
			$model->attributes=$_GET['Sprint'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Sprint::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				//throw new CHttpException(404,'The requested page does not exist.');
				throw new CException('The is an example of throwing a CException');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sprint-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
/**
	 * In-class defined filter method, configured for use in the above filters() method
	 * It is called before the actionCreate() action method is run in order to ensure a proper project context
	 */
	public function filterProjectContext($filterChain)
	{   
	     //set the project identifier based on either the GET or POST input request variables, since we allow both types for our actions   
	     $projectId = null;
	     if(isset($_GET['pid'])) 
	          $projectId = $_GET['pid'];
	     else
	          if(isset($_POST['pid'])) 
			       $projectId = $_POST['pid'];

		 $this->loadProject($projectId);   

	     //complete the running of other filters and execute the requested action
	     $filterChain->run(); 
	}
	
	/**
	 * Protected method to load the associated Project model class
	 * @project_id the primary identifier of the associated Project
	 * @return object the Project data model based on the primary key 
	 */
	protected function loadProject($project_id)
	{
		 //if the project property is null, create it based on input id
		 if($this->_project===null)
		 {
			$this->_project=Project::model()->findbyPk($project_id);
			if($this->_project===null)
            {
				throw new CHttpException(404,'The requested project does not exist.'); 
			}
		 }

		 return $this->_project; 
	}
	
	public function actionPlanning() {
		$this->layout = 'column1';
		$cs=Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery.ui');
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/main.js', CClientScript::POS_END);
		$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/task.css');
		$this->render('planning', array(
			'project' => $this->_project
		));
	}
	
	public function actionAssignTask() {
		$this->loadModel();
		if (isset($_POST['SprintIssueForm'])) {
			$form = new SprintIssueForm();
			$form->attributes=$_POST['SprintIssueForm'];
			$form->project = $this->_project;
			$form->sprint = $this->_model;
			if ($form->validate()) {
				Yii::app()->user->setFlash('success', $form->itemId . " has been added to the sprint." ); 
			}
		}
	}
}
