<?php

class CustomerController extends Controller
{
	public function init() {
	        
	}
	    
		
	public function filters()
	{
		return array(
			'accessControl',
		);
	}


	public function accessRules()
	{
		return array(
			array('allow', 
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$this->render('view',array(
		'model'=>$this->loadModel($id),
		));
	}
	
	public function actionCreate()
	{
		$model=new Customer;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Customer']))
		{
			$model->attributes=$_POST['Customer'];
			$model->companyid = Yii::app()->user->companyid;
			$model->active = 1;
			if($model->save())
				$this->redirect(Yii::app()->createUrl('portoprint/customer'));
		}
		
		$this->render('create',array(
		'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Customer']))
		{
			$model->attributes=$_POST['Customer'];
			if($model->save())
				$this->redirect(Yii::app()->createUrl('portoprint/customer'));
		}
		
		$this->render('update',array(
		'model'=>$model,
		));
	}


	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);
			$model->active = 0;
			$model->save();
		
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


	public function actionIndex()
	{
		$this->layout = false;
		$model=new Customer();

		$customerlist = CHtml::listData(Usercustomerpermission::model()->getCustomerbyUser(Yii::app()->user->userid , Yii::app()->user->companyid), 'customerid', 'customerdsc');
		$service =CHtml::listData(Service::model()->getEntryItem( Yii::app()->user->companyid, Yii::app()->user->userid ), 'serviceid', 'servicedsc', 'entrydsc');
		

		$customer = (isset($_GET['customer']))?$_GET['customer']:0;
		$validor= $model->getAllCustomer();
		$read= explode('_', $_GET['read']);

		$this->render('index',array(
		'model'=>$model->findAllByAttributes(array('companyid'=>Yii::app()->user->companyid)), "customerlist"=>$customerlist, 'customer'=>$customer,"add"=>$read[1],"edt"=>$read[2],"del"=>$read[3]
		));
	}

	public function actionCreatecustomer()
	{	
		$this->layout = false;
                   // print_r($_POST['arrai']); 
                   $customs = new Customer();
                  
                    if($customs->validar_campo($_POST['arrai'])){   // if the inputs are valid
                        echo "0";
                    }else{
                       foreach ($_POST['arrai'] as $valor => $descripcion){
                        $customs->$valor = $descripcion;
                       }
                       $customs->companyid=Yii::app()->user->companyid;
                       $customs->insert();
                           echo $customs->customerid;
                     }
	}
        
        public function actionUpdatecustomer()
	{	
		$this->layout = false;
	         $customs = $this->loadModel($_POST['id']);
                 $customs->$_POST['camp']= $_POST['nue'];
                 echo $customs->update();
               
	}
        
       

	public function actionCustomer(){
		$this->layout = null;
		//$rates = Rate::model()->searchRates($_POST);
		$custom = Customer::model()->getAllCustomer();
		$res = ($custom)?$custom:array();
		echo json_encode($res);		
	}


	public function loadModel($id)
	{
		$model=Customer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionDeltecustomer()
	{	
		$this->layout = false;
               
                    $modelcustomer=new Customer();
                    $model = $modelcustomer->findByPk($_POST['customerid']);
                    
                    if($model!=null){
                       $model->active = 0;
                        if($model->update()){
                            echo $model->customerid;
                          }
                     }
                  
               
	}
}
