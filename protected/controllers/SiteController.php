<?php

class SiteController extends Controller
{
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
			)
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model=new Books;
		if(isset($_GET["search"])){
			$all = $model->searchB($_GET["title_b"], $_GET["author_b"]);
		}else{
			$all = $model->getAll();
		}
		$this->render('index', array('allBooks'=>$all));
	}
	
	public function actionBook()
	{
		$model=new Books;
		$book = $model->getBookByID($_GET['id']);
		$this->render('book', array('book'=>$book));
	}
	
	public function actionZakaz()
	{
		// var_dump($_POST);
		$zakazy = new Zakazy;
		if(isset($_POST['oform'])){
			$zakazy->oform($_POST['ids']);
			$this->redirect(array('zakaz')); 
		}
		if(isset($_POST['cancel'])){
			$zakazy->cancel($_POST['ids']);
			$this->redirect(array('zakaz')); 
		}
		if(isset($_POST['del'])){
			$zakazy->del($_POST['ids']);
			$this->redirect(array('zakaz')); 
		}
		if(isset($_POST['col_books'])){
			$zakazy->add($_POST['col_books']);
			$this->redirect(array('zakaz')); 
		}else{
			$zakazy = $zakazy->getAll();
			$this->render('zakazy', array('zakazy'=>$zakazy));
		};
		
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

	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}