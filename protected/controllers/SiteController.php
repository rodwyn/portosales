<?php

class SiteController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('login','error'),
				'users'=>array('*'),				
			),
			array('allow', 
				'users'=>array('@'),
				'actions'=>array('index','logout'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		if( Yii::app()->user->usertype == 1 ){
			$this->redirect('index.php?r=portoprint/default');			
                } else if(Yii::app()->user->usertype == 2 ){
                        //echo "arranca ptm"; 
                        $this->redirect('index.php?r=supply/default');
                }  else if(Yii::app()->user->usertype == 3 ){
                      //  echo "arranca ptm"; 
                        $this->redirect('index.php?r=customer/default');
                }  else 
                 $this->render('index');
	}

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

	public function actionLogin()
	{
		$this->layout = 'login';
		$model=new LoginForm;

		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
                           
                
			if($model->validate() && $model->login())
                            $this->redirect(Yii::app()->user->returnUrl);
		}

		$this->render('login',array('model'=>$model));
	}


	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}