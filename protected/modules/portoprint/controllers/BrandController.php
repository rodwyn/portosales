<?php

class BrandController extends Controller
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
		$model=new Brand;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Brand']))
		{
			$model->attributes=$_POST['Brand'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->brandid));
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

		if(isset($_POST['Brand']))
		{
			$model->attributes=$_POST['Brand'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->brandid));
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
		$model=new Brand();
                $customerlist = CHtml::listData(Customer::model()->findAllByAttributes(array("companyid"=>Yii::app()->user->companyid)), 'customerid', 'customerdsc');
                $service = CHtml::listData(Service::model()->getEntryItem(Yii::app()->user->companyid, Yii::app()->user->userid), 'serviceid', 'servicedsc', 'entrydsc');
                $read= explode('_', $_GET['read']);
                if(isset($_GET['customer'])){ 
                    $customer = $_GET['customer']; 
                  }else{ 
                      $customer = 0;
                  }
                 
                if($customer==0){
                    $list_marcas=$model->getAllBrand();
                }else{
                    $list_marcas=$model->getIdBrand($customer);
                }
                $this->render('index',array(
                    'model'=>$list_marcas , "customerlist"=>$customerlist, 'customer'=>$customer,"add"=>$read[1],"edt"=>$read[2],"del"=>$read[3]
		));
		
	}
        
       public function actionUpdatebrand()
	{	
		$this->layout = false;
	         $tab = $this->loadModel($_POST['id']);
                 $tab->$_POST['camp']= $_POST['nue'];
                 echo $tab->update();
               
	}
        
        public function actionCreatebrand()
	{	
		$this->layout = false;
                   // print_r($_POST['arrai']); 
                   $customsbrand = new Brand();
                   
                   if($customsbrand->validar_campo($_POST['arrai'])){   // if the inputs are valid
                        echo "0";
                    }else{
                       foreach ($_POST['arrai'] as $valor => $descripcion){
                        $customsbrand->$valor = $descripcion;
                       }
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $customsbrand->insert();
                           echo $customsbrand->brandid;
                     }
		
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Brand('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Brand']))
			$model->attributes=$_GET['Brand'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Brand the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Brand::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Brand $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='brand-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionDeltebrand()
	{	
		$this->layout = false;
               
                    $modelcustomer=new Brand();
                    $model = $modelcustomer->findByPk($_POST['brandid']);
                    
                    if($model!=null){
                       $model->active = 0;
                        if($model->update()){
                            echo $model->customerid;
                          }
                     }
                  
               
	}
}
