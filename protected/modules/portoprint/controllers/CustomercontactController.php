<?php

class CustomercontactController extends Controller
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Customercontact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customercontact']))
		{
			$model->attributes=$_POST['Customercontact'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->contactid));
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

		if(isset($_POST['Customercontact']))
		{
			$model->attributes=$_POST['Customercontact'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->contactid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout = false;
		$model=new Customercontact();
                $customerlist = CHtml::listData(Customer::model()->findAllByAttributes(array("companyid"=>Yii::app()->user->companyid)), 'customerid', 'customerdsc');
                 $read= explode('_', $_GET['read']);
                if(isset($_GET['customer'])){ 
                    $customer = $_GET['customer']; 
                  }else{ 
                      $customer = 0;
                  }
                  
                if($customer==0){
                    $list_contact=$model->getAllcontact();
                }else{
                    $list_contact=$model->getIdcontact($customer);
                }
                
                $this->render('index',array(
                    'model'=>$list_contact , "customerlist"=>$customerlist, 'customer'=>$customer,"add"=>$read[1],"edt"=>$read[2],"del"=>$read[3]
		));
                
                
	}
        public function actionUpdatecontact()
	{	
		$this->layout = false;
	         $customs = $this->loadModel($_POST['id']);
                 $customs->$_POST['camp']= $_POST['nue'];
                 echo $customs->update();
               
	}
         public function actionCreatecontact()
	{	
		$this->layout = false;
                   // print_r($_POST['arrai']); 
                   $customscontac = new Customercontact();
                    
                   if($customscontac->validar_campo($_POST['arrai'])){   // if the inputs are valid
                        echo "0";
                    }else{
                       foreach ($_POST['arrai'] as $valor => $descripcion){
                        $customscontac->$valor = $descripcion;
                       }
                       
                       $customscontac->insert();
                           echo $customscontac->contactid;
                     } 
		
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customercontact('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customercontact']))
			$model->attributes=$_GET['Customercontact'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Customercontact the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Customercontact::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Customercontact $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customercontact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionDeltecontact()
	{	
		$this->layout = false;
               
                    $modelcustomer=new Customercontact();
                    $model = $modelcustomer->findByPk($_POST['contactid']);
                    
                    if($model!=null){
                       $model->active = 0;
                        if($model->update()){
                            echo $model->contactid;
                          }
                     }
                  
               
	}
}
