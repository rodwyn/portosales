<?php

class CustomerlegalentityController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public function init() {
            //date_default_timezone_set('America/Argentina/Buenos_Aires');
        }

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			
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
                         array('allow', 
				'users'=>array('@'),
			),
			array('deny', 
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
		$model=new Customerlegalentity;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customerlegalentity']))
		{
			$model->attributes=$_POST['Customerlegalentity'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->customerlegalentityid));
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

		if(isset($_POST['Customerlegalentity']))
		{
			$model->attributes=$_POST['Customerlegalentity'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->customerlegalentityid));
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
		$model=new Customerlegalentity();
                $country=new Country();
             
                $customerlist = CHtml::listData(Customer::model()->findAllByAttributes(array("companyid"=>Yii::app()->user->companyid)), 'customerid', 'customerdsc');
                $service = CHtml::listData(Service::model()->getEntryItem(Yii::app()->user->companyid, Yii::app()->user->userid), 'serviceid', 'servicedsc', 'entrydsc');
                $read= explode('_', $_GET['read']);
                
                if(isset($_GET['customer'])){ 
                    $customer = $_GET['customer']; 
                  }else{ 
                      $customer = 0;
                  }
                  
                if($customer==0){
                    $list_marcas=$model->getAlllegalentity();
                }else{
                    $list_marcas=$model->getIdlegalentity($customer);
                }
                $list_country=$country->findAll();//$model->getAllcity();
        
                
                $this->render('index',array(
                    'model'=>$list_marcas , "customerlist"=>$customerlist, 'customer'=>$customer,  'countrylist'=>$list_country,"add"=>$read[1],"edt"=>$read[2],"del"=>$read[3] 
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customerlegalentity('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customerlegalentity']))
			$model->attributes=$_GET['Customerlegalentity'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        public function actionUpdatelegalentity()
	{	
		$this->layout = false;
	         $tab = $this->loadModel($_POST['id']);
                 $tab->$_POST['camp']= $_POST['nue'];
                 echo $tab->update();
               
	}
        
        public function actionCreatelegalentity()
	{	
		$this->layout = false;
                    //print_r($_POST['arrai']); 
                   $customsleg = new Customerlegalentity();
                   
                   if($customsleg->validar_campo($_POST['arrai'])){   // if the inputs are valid
                        echo "0";
                    }else{
                       foreach ($_POST['arrai'] as $valor => $descripcion){
                        $customsleg->$valor = $descripcion;
                       }
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $customsleg->insert();
                           echo $customsleg->customerlegalentityid;
                     }
                    
                    
		
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Customerlegalentity the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Customerlegalentity::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Customerlegalentity $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customerlegalentity-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
                public function actionDeltelegalentity()
	{	
		$this->layout = false;
               
                    $modelcustomer=new Customerlegalentity();
                    $model = $modelcustomer->findByPk($_POST['customerlegalentityid']);
                    
                    if($model!=null){
                       $model->active = 0;
                        if($model->update()){
                            echo $model->customerlegalentityid;
                          }
                     }
                  
               
	}
}
