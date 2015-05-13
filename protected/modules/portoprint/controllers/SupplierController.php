<?php

class SupplierController extends Controller
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
		$model=new Supplier;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Supplier']))
		{
			$model->attributes=$_POST['Supplier'];
			$model->companyid = Yii::app()->user->companyid;
			$model->active = 1;
			if($model->save())
				$this->redirect(Yii::app()->createUrl('portoprint/supplier'));
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
		
		if(isset($_POST['Supplier']))
		{
			$model->attributes=$_POST['Supplier'];
			if($model->save())
				$this->redirect(Yii::app()->createUrl('portoprint/supplier'));
		}
		
		$this->render('update',array(
		'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model=$this->loadModel($id);
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
		$model= new Supplier();
                $country=new Country();
		//$model->unsetAttributes();  // clear any default values
		$supplierdata = $model->getAllSupplier();
                $data = array();
                $i = 0;
                foreach ($supplierdata as $value) {

                    foreach ($value as $k => $v) {
                        $data[$i][$k] = $v;
                    }
                    $data[$i]["services"] = $this->getSupplierService($value->supplierid);
                    $i++;
                }
                $listcountry = $country->findAll();
		if(isset($_GET['Supplier']))
			$model->attributes=$_GET['Supplier'];
                
                  $read= explode('_', $_GET['read']);
                  $permission=new Permission();
                  $supplierpermission = $permission->init_permission1(Yii::app()->user->userid,$read[0]);
                  
                  if($supplierpermission[0]['active']!=1){
                      $this->render('admin',array("model"=>$model,"supplierdata"=>$data,"listcountry"=>$listcountry,"add"=>$read[1],"edt"=>$read[2],"del"=>$read[3]));
                  }else{
                      $this->render('index',array("model"=>$model,"supplierdata"=>$data,"listcountry"=>$listcountry,"add"=>$read[1],"edt"=>$read[2],"del"=>$read[3]));
                  }
                      
                  }
        
        public function getSupplierService($id) {
            $model = new Service();
            $serviceData = $model->getSupplierService($id);
            $data = array();
            $i = 0;
            foreach ($serviceData as $value) {

                    $data[$i]["id"]=$value->serviceid;
                    $data[$i]["dsc"] = $value->servicedsc;
                    $data[$i]["asigned"] = (!isset($value->asigned)) ? false : $value->asigned;
                    $i++;
            }

            if($i === 0) 
                $data["status"] = false;
            else
                $data["status"] = true;

            return $data;
        }

	public function actionGetSupplierService($id = FALSE){
            $this ->layout = false;
		$model = new Service();
                $supplierid = (!$id)?$_POST["supplierid"]: $id ;
		$serviceData = $model->getSupplierService($supplierid);
		$data = array();
                $i = 0;
		foreach ($serviceData as $value) {

			$data[$i]["id"]=$value->serviceid;
			$data[$i]["dsc"] = $value->servicedsc;
			$data[$i]["asigned"] = (!isset($value->asigned)) ? false : $value->asigned;
                        $i++;
		}
                
                if($i === 0) 
                    $data["status"] = false;
                else
                    $data["status"] = true;
                
		echo(json_encode($data));

	}
        
        public function actionSetSupplierService(){
            
            $this->layout = false;
            $supplierservice = new Supplierservice();
            $serviceid = $_POST['serviceid'];
            $supplierid = $_POST['supplierid'];
       
            $supplierservice->supplierid = $supplierid;
            $supplierservice->serviceid = $serviceid;
            $status = $supplierservice->insert();
            
            echo json_encode(array('status'=>$status,'data'=>array('serviceid'=>$serviceid,'supplierid'=> $supplierid,'supplierservice'=>$supplierservice->supplierservice)));
        }

	public function actionRemoveSupplierService(){
        
            $this->layout = false;
            $id = $_POST['supplierservice'];
            
            $suppliersservice = $this->loadModelSupplierService($id);
            $result['data']['supplierservice'] = $id;
            $result['data']['supplierid'] = $suppliersservice->supplierid;
            $result['status'] = $suppliersservice->delete();
            echo json_encode($result);
        }
        
        public function actionAddSupplier(){
            $this->layout = false;
            
            $supplier = new Supplier();
            
            foreach ($_POST as $key => $value) {
                $supplier->$key = $value;
            }
            $supplier->companyid = Yii::app()->user->companyid;
            $result = array();
            
            $result['status'] = $supplier->insert();
            $result['data']['supplierid'] = $supplier->supplierid;
            echo json_encode($result);
        }
        
        public function actionEditSupplier(){
            $this->layout = false;
            
            $supplier = $this->loadModel($_POST['id']);
            $supplier->$_POST['camp']= $_POST['nue'];
            
            echo $supplier->update();
        }


        public function loadModelSupplierService($id)
	{
		$model=  Supplierservice::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function loadModel($id)
	{
		$model=Supplier::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='supplier-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
       public function actionBloqsupplier()
	{	
		$this->layout = false;
               
                    $model=new Supplier();
               
               if($model->validar_campo1($_POST['arrai'])){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_POST['arrai']);
                 $companyperm=$model->findByPk($id[0]["supplierid"]);
                        if($companyperm!=null){
                            $companyperm->block=$_POST['arrai']['block'];
                            $companyperm->update();
                            echo $companyperm->block;
                           }

                    }else{
                       foreach ($_POST['arrai'] as $valor => $descripcion){
                        $model->$valor = $descripcion;
                       }
                        $model->block=$_POST['arrai']['block'];
                       $model->insert();
                   echo $model->block;
                }
                  
               
	}
        
        public function actionUpdatesupplier()
	{	
		
	        $this->layout = false;
                    //print_r($_POST['arrai']); 
                   $customsleg =  Supplier::model()->findByPk($_POST['supplierid']);
                   
                  
                       foreach ($_POST['arrai'] as $valor => $descripcion){
                        $customsleg->$valor = $descripcion;
                       }
                      // $customsbrand->companyid=Yii::app()->user->companyid;
                       $customsleg->update();
                           echo $customsleg->supplierid;
                     
               
	}
        
        public function actionServiceselect() {
      
        $supplierlist = Supplierservice::model()->getSupplierServicelist($_POST['supplierid']);
        $cadena=' ';
            if(count($supplierlist)!=0){
            foreach ($supplierlist as $valor) {
               
                    if($cadena==' '){
                        $cadena= $valor->serviceid;
                    }else{
                        $cadena=$cadena.','.$valor->serviceid;
                    }
            }
            echo $cadena;
            }else{
                echo '-1';
            }
        }
        
        public function actionCreatesupplier()
	{	
		$this->layout = false;
                    //print_r($_POST['arrai']); 
                   $customsleg = new Supplier();
                   
                   if($customsleg->validar_campo($_POST['arrai'])){   // if the inputs are valid
                        echo "0";
                    }else{
                       foreach ($_POST['arrai'] as $valor => $descripcion){
                        $customsleg->$valor = $descripcion;
                       }
                      // $customsbrand->companyid=Yii::app()->user->companyid;
                       $customsleg->insert();
                           echo $customsleg->supplierid;
                     }
                    
                    
		
	}
        
         public function actionSupplieredit()
	{       
             $this->layout = false;
             $supplierid=$_POST['supplierid'];
                
                $list_details= Supplier::model()->findByAttributes(array("supplierid"=>$supplierid));
                 echo $cad='corporatename-'.$list_details['corporatename'].','.'supplierdsc-'.$list_details['supplierdsc'].
                        ','.'contactname-'.$list_details['contactname'].','.'website-'.$list_details['website'].
                        ','.'phone-'.$list_details['phone'].','.'email-'.$list_details['email'].','.'email2-'.$list_details['email2'].
                        ','.'email3-'.$list_details['email3'].','.'rfc-'.$list_details['rfc'].','.'address-'.$list_details['address']
                        .','.'suburb-'.$list_details['suburb'].','.'contryid-'.$list_details['contryid'].','.'stateid-'.$list_details['stateid'].','.'paymentterms-'.$list_details['paymentterms'].','.'cityid-'.$list_details['cityid']
                         ;
              
               
	}
        
         public function actionSaveservicesupplier()
	{       
             $this->layout = false;
             $lista=$_POST['arrai'];
             $palabra="s"; 
             if(strpos($lista, $palabra) !== false) { 
                 echo ' arrays ';
                $lista=  explode('s', $lista);
                $supplierid=$_POST['supplierid'];
                
                $cont=0;
                if(count($lista)!=0){
                    
                   for($i=0;$i<count($lista);$i++) {
                       
                        $lista_elimina= Supplierservice::model()->findbyAttributes(array("supplierid"=>$supplierid , "serviceid"=>$lista[$i]));
                       
                        if($lista_elimina!=null){
                           $ident[$cont]=$lista_elimina->supplierservice;
                           if($lista_elimina->delete()){
                               echo " se elimino el registro ".$ident[$cont];
                           }
                           
                        }else{
                            $ident[$cont]=0;
                        }
                       $cont++;
                       
                   }
                   for($o=0;$o<count($lista);$o++) {
                       
                       $ident[$o]= Supplierservice::model()->ultimo_identificador()+1;
                       $servicemodal=new Supplierservice();
                       $servicemodal->supplierservice=$ident[$o];
                        $servicemodal->serviceid=$lista[$o];
                        $servicemodal->supplierid=$supplierid;
                        if($servicemodal->insert()){
                               echo " inserto ".$ident[$o];
                           }
                   }
                   
                   
                }
             }else{
                 echo ' solo un dato ';
                $supplierid=$_POST['supplierid'];
                $servicemodal=new Supplierservice();
                $ident=0;
                $lista_elimina=  Supplierservice::model()->findbyAttributes(array("supplierid"=>$supplierid , "serviceid"=>$lista));
                if($lista_elimina!=null){
                    $ident=$lista_elimina->supplierservice;
                   if($lista_elimina->delete()){
                       echo " se elimino el registro ".$ident;
                   }
                }
                if($ident==0){
                   $ident= intval($servicemodal->ultimo_identificador())+1;
                }
                $servicemodal->supplierservice=$ident;
                $servicemodal->serviceid=$lista;
                $servicemodal->supplierid=$supplierid;
                if($servicemodal->insert()){
                       echo " inserto ".$ident;
                }
                   
             }
            
            
	}
        
}
