<?php

class UserController extends Controller
{
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
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->userid));
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->userid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

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
	{       $this->layout = false;
		$model=new User();
                if(isset($_GET['usertype'])){
                    $dat=Utils::decrypt($_GET['usertype'], 'user');
                }else{
                    $dat=1;
                }
                $read= explode('_', $_GET['read']);
                $this->render('index',array(
                    'model'=>$list_users , 'usertype'=>$dat,"add"=>$read[1],"edt"=>$read[2],"del"=>$read[3]
		));
	}
        public function actionSupplier()
	{       $this->layout = false;
		$model=new User();
                if(isset($_GET['usertype'])){
                    $dat=Utils::decrypt($_GET['usertype'], 'user');
                }else{
                    $dat=1;
                }
                $read= explode('_', $_GET['read']);
                $this->render('supplier',array(
                    'model'=>$list_users , 'usertype'=>$dat,"add"=>$read[1],"edt"=>$read[2],"del"=>$read[3]
		));
	}
        public function actionUseredit()
	{       
             
		$model=new User();
                $modelsupplier=new Supplieruser();
                $userid=$_POST['userid'];
                $list_users=$model->findAllByAttributes(array("userid"=>$userid));
                $list_details=$modelsupplier->findAllByAttributes(array("userid"=>$userid));
                
                echo $cad='firstname-'.$list_details[0]['firstname'].','.'plastname-'.$list_details[0]['plastname'].
                        ','.'mlastname-'.$list_details[0]['mlastname'].','.'username-'.$list_users[0]['username'].
                        ','.'password-'.$list_users[0]['password'].','.'phone-'.$list_details[0]['phone'].','.'email-'.$list_details[0]['email'].
                        ','.'userid-'.$list_details[0]['userid'];
              
               
	}
        
        public function actionUpdateuser()
	{	
		$this->layout = false;
               
                    $modeluser=new User();
                    $modelempl = new Employeeuser();
                    $model = $modeluser->findByPk($_POST['arrai']['userid']);
                    
                    if($model!=null){
                        //echo $model->userid;
                        $model->username=   $_POST['arrai'][username];
                        $model->password  = $_POST['arrai'][password];
                        $model->usertype = 1;
                        $model->active = 1;
                        $model->profileid =$_POST['arrai'][profileid]; 
                        
                        if($model->update()){
                        
                            $cargemp=$modelempl->findByPk($model->userid);       // userid =$model->userid;
                            $cargemp->firstname = $_POST['arrai'][firstname];
                            $cargemp->plastname = $_POST['arrai'][plastname];
                            $cargemp->mlastname = $_POST['arrai'][mlastname];
                            $cargemp->email = $_POST['arrai'][email];
                            $cargemp->phone = $_POST['arrai'][phone];
                            $cargemp->update();
                            echo $cargemp->userid;

                        }
                     }
                  
               
	}
        public function actionDelteuser()
	{	
		$this->layout = false;
               
                    $modeluser=new User();
                    $model = $modeluser->findByPk($_POST['userid']);
                    
                    if($model!=null){
                       $model->active = 0;
                        if($model->update()){
                            echo $model->userid;
                          }
                     }
                  
               
	}
        public function actionUsers()
	{       
             
		$model=new User();
                $usertype= Utils::decrypt($_GET['usertype'], 'user');
                $edit= Utils::decrypt($_GET['edit'], 'user');
                 $del= Utils::decrypt($_GET['del'], 'user');
                $list_users=$model->getAllusers($usertype,$edit,$del);
                echo json_encode($list_users);
               
	}
        
         public function actionSupplierindex()
	{       
             
		$model=new User();
                $usertype= Utils::decrypt($_GET['usertype'], 'user');
                $edit= Utils::decrypt($_GET['edit'], 'user');
                 $del= Utils::decrypt($_GET['del'], 'user');
                $list_users=$model->getAllsupplierusr($usertype,$edit,$del);
                echo json_encode($list_users);
               
	}
        public function actionAddcompany()
	{       
             
		$model=new Usercompanypermission();
               
               if($model->validar_campo1($_GET['arrai'])){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_GET['arrai']);
                 $companyperm=$model->findByPk($id[0]["usercompanypermissionid"]);
                        if($companyperm!=null){
                            $companyperm->active=1;
                            $companyperm->update();
                            echo $companyperm->usercompanypermissionid;
                           }

                    }else{
                       foreach ($_GET['arrai'] as $valor => $descripcion){
                        $model->$valor = Utils::decrypt($descripcion, 'user');
                       }
                        $model->systemid=1;
                        $model->active=1;
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $model->insert();
                   echo $model->usercompanypermissionid;
                }
               
               
	}
        
         public function actionInactivecompany()
	{       
             
		$model=new Usercompanypermission();
              
                $companyperm=$model->findByPk($_GET['usercompanypermissionid']);
                if($companyperm!=null){
                 $companyperm->active=0;
                 $companyperm->update();
                 echo $companyperm->usercompanypermissionid;
                }
	}
        
         public function actionAddservice()
	{       
             
		$model=new Userservice();
               
               if($model->validar_campo1($_GET['arrai'])){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_GET['arrai']);
                 
                 $companyperm=$model->findByPk($id[0]["userserviceid"]);
                        if($companyperm!=null){
                            $companyperm->active=1;
                            $companyperm->update();
                            echo $companyperm->userserviceid;
                           }

                    }else{
                       foreach ($_GET['arrai'] as $valor => $descripcion){
                        $model->$valor = $descripcion;
                       }
                        $model->active=1;
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $model->insert();
                   echo $model->userserviceid;
                }
               
               
	}
        
          public function actionInactiveservice()
	{       
             
		$model=new Userservice();
              
                $companyperm=$model->findByPk($_GET['userserviceid']);
                if($companyperm!=null){
                    $companyperm->active=0;
                    $companyperm->update();
                    echo $companyperm->userserviceid;
                }
	}
        
             public function actionAddcustomer()
	{       
             
		$model=new Usercustomerpermission();
              
               if($model->validar_campo1($_GET['arrai'])){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_GET['arrai']);
                 
                 $companyperm=$model->findByPk($id[0]["usercustomerpermissionid"]);
                        if($companyperm!=null){
                            $companyperm->active=1;
                            $companyperm->update();
                            echo $companyperm->usercustomerpermissionid;
                           }

                    }else{
                       foreach ($_GET['arrai'] as $valor => $descripcion){
                        $model->$valor = $descripcion;
                       }
                       $model->systemid=1;
                        $model->active=1;
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $model->insert();
                   echo $model->usercustomerpermissionid;
                }
               
               
	}
        
          public function actionInactivecustomer()
	{       
             
		$model=new Usercustomerpermission();
              
                $companyperm=$model->findByPk($_GET['usercustomerpermissionid']);
                if($companyperm!=null){
                    $companyperm->active=0;
                    $companyperm->update();
                    echo $companyperm->usercustomerpermissionid;
                }
	}
        
         public function actionValnick()
	{       
             
		$model=new User();
              
                if($model->validar_username($_POST['username'])){
                    echo "0";
                    }  else {
                        echo "username_".$_POST['username'];
                    }
	}
        
        public function actionCreatenewuser()
	{	
		$this->layout = false;
                    //print_r($_POST['arrai']); 
                   $model = new User();
                   $modelempl = new Employeeuser();
                   $modelcompany = new Usercompanypermission();
                   $area = new Userarea();
                          
                    $model->username=   $_POST['arrai'][username];
                    $model->password  = $_POST['arrai'][password];
                    $model->usertype = 1;
                    $model->active = 1;
                    $model->profileid =$_POST['arrai'][profileid];
                    $model->insert();
                    
                    if($model->userid!=0){
                        
                        #agregar relación usuario-área
                        $area->userid = $model->userid;
                        $area->areaid = $_POST['areaid'];
                        $area->insert();
                        
                        $modelempl->userid =$model->userid;
                        $modelempl->firstname = $_POST['arrai'][firstname];
                        $modelempl->plastname = $_POST['arrai'][plastname];
                        $modelempl->mlastname = $_POST['arrai'][mlastname];
                        $modelempl->email = $_POST['arrai'][email];
                        $modelempl->phone = $_POST['arrai'][phone];
                        $modelempl->insert();
                        $modelcompany->companyid=$_POST['arrai'][companyid];
                        $modelcompany->userid=$model->userid;
                        $modelcompany->systemid=1;       
                        $modelcompany->active=1;         
                        $modelcompany->insert();
                        $modelserv=new Service();
                        $cad=' ';
                        $cad1=' ';
                        $list=$modelserv->getSupplierService1($_POST['arrai'][companyid]);
                            foreach($list as $row1){
                                    if($cad==' '){
                                        $cad='<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="newcat_'.$row1->serviceid.'_'.$modelempl->userid.'"  onclick="valid_categ_new(this.id)"    value="'.$modelempl->userid.'"  ></span><label class="form-control">&nbsp;'.$row1->servicedsc.'</label></div></td></tr>';
                                    }else{
                                        $cad=$cad.'<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="newcat_'.$row1->serviceid.'_'.$modelempl->userid.'"  onclick="valid_categ_new(this.id)"    value="'.$modelempl->userid.'"  ></span><label class="form-control">&nbsp;'.$row1->servicedsc.'</label></div></td></tr>';
                                    }
                                }
                         $fullcustomer = Customer::model()->findAllByAttributes(array("companyid"=>$_POST['arrai'][companyid],"active"=>1));
                                foreach($fullcustomer as $row){
                                    if($cad1==' '){
                                        $cad1='<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="newcustom_'.$row->customerid.'_'.$modelempl->userid.'"  onclick="valid_custom_ew(this.id)"    value="'.$modelempl->userid.'"  ></span><label class="form-control">&nbsp;'.$row->customerdsc.'</label></div></td></tr>';
                                    }else{
                                        $cad1=$cad1.'<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="newcustom_'.$row->customerid.'_'.$modelempl->userid.'"  onclick="valid_custom_ew(this.id)"    value="'.$modelempl->userid.'"  ></span><label class="form-control">&nbsp;'.$row->customerdsc.'</label></div></td></tr>';
                                    }
                                }
                                
                                
                            echo $modelempl->userid.','.$cad.','.$cad1;
                      }
                    
                    
		
	}

        
         public function actionCreatenewsupplier()
	{	
		$this->layout = false;
                    //print_r($_POST['arrai']); 
                   $model = new User();
                   $modelempl = new Supplieruser();
                
                          
                    $model->username=   $_POST['arrai'][username];
                    $model->password  = $_POST['arrai'][password];
                    $model->usertype = 2;
                    $model->active = 1;
                    $model->profileid =7;
                    $model->insert();
                    
                    if($model->userid!=0){
                         
                        $modelempl->userid =$model->userid;
                        $modelempl->supplierid =$_POST['arrai'][supplierid];
                        $modelempl->firstname = $_POST['arrai'][firstname];
                        $modelempl->plastname = $_POST['arrai'][plastname];
                        $modelempl->mlastname = $_POST['arrai'][mlastname];
                        $modelempl->email = $_POST['arrai'][email];
                        $modelempl->phone = $_POST['arrai'][phone];
                        $modelempl->insert();
                        
                         echo $modelempl->userid.','.$cad.','.$cad1;
                      }else{
                          echo "0";
                      }
                    
                    
		
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
      
	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionSaveprivilege()
	{
            $this->layout = false;
            
            $model = new Userprivilege();
            
            
            $permisos = $model->findAllByAttributes(array("userid"=>$_POST[userid],"menuid"=>$_POST[menuid]));
            
            $menuop = $_POST[menuop];
            
            $valor = $_POST[valor];
            
            $idp = $model->validar_userprivilegeid($_POST[userid], $_POST[menuid]);
            
            
            
            if($idp[0]['userprivilegeid']===NULL){
                $model->userid   = $_POST[userid];
                $model->menuid   = $_POST[menuid];
                $model->menuread = ($menuop=="menuread")?$valor:0;
                $model->menuadd  = ($menuop=="menuadd")?$valor:0;
                $model->menuedit = ($menuop=="menuedit")?$valor:0;
                $model->menudelete = ($menuop=="menudelete")?$valor:0;
                
                if($model->insert()){
                    echo $model->userprivilegeid;
                }
            }
            else{
               //echo $idp[0]['userprivilegeid'];
                $upid = $model->findByPk($idp[0]['userprivilegeid']);
                if($upid!=null){
                    $upid->$menuop = $valor;
                    if($upid->update()){
                        echo 'actualizo'.$upid->userprivilegeid;
                    }
                    //$upid->update();
                }
            }
            
         
                    
		
	}
        
        public function actionSavespecialpermission()
	{
            $this->layout = false;
            
            $model = new Specialpermission();
            
            $permisos = $model->findAllByAttributes(array("userid"=>$_POST[userid],"permissionid"=>$_POST[permissionid]));
            
            //$menuop = $_POST[menuop];
            
            //$valor = $_POST[valor];

           $nper = count($permisos);
            
            $specialpermissionid = $_POST[specialpermissionid];
            
            if($nper==0 && $_POST[valor]==1){
                $model->userid = $_POST[userid];
                $model->permissionid = $_POST[permissionid];
                $model->active=1;
                $model->insert();
            }
            else{
                echo $specialpermissionid;
                
                $pk = $model->findByPk($specialpermissionid);
                if($pk!=null){
                    $pk->active = $_POST[valor];
                    $pk->update();
                }
            }
            
         
                    
		
	}
        
        public function actionAddserviceposi()
	{       
             
		$model=new Userservice();
               
               if($model->validar_campo1($_GET['arrai'])){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_GET['arrai']);
                 
                 $companyperm=$model->findByPk($id[0]["userserviceid"]);
                        if($companyperm!=null){
                            $companyperm->active=1;
                            $companyperm->update();
                            echo $companyperm->userserviceid;
                           }

                    }else{
                       foreach ($_GET['arrai'] as $valor => $descripcion){
                        $model->$valor = $descripcion;
                       }
                        $model->active=1;
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $model->insert();
                   echo $model->userserviceid;
                }
               
               
	}
        
         public function actionAddservicenega()
	{       
             
		$model=new Userservice();
               
               if($model->validar_campo1($_GET['arrai'])){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_GET['arrai']);
                 
                 $companyperm=$model->findByPk($id[0]["userserviceid"]);
                        if($companyperm!=null){
                            $companyperm->active=0;
                            $companyperm->update();
                            echo $companyperm->userserviceid;
                           }

                    }else{
                       foreach ($_GET['arrai'] as $valor => $descripcion){
                        $model->$valor = $descripcion;
                       }
                        $model->active=0;
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $model->insert();
                   echo $model->userserviceid;
                }
               
               
	}
        
            public function actionAddcustomerposi()
	{       
             
		$model=new Usercustomerpermission();
              
               if($model->validar_campo1($_GET['arrai'])){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_GET['arrai']);
                 
                 $companyperm=$model->findByPk($id[0]["usercustomerpermissionid"]);
                        if($companyperm!=null){
                            $companyperm->active=1;
                            $companyperm->update();
                            echo $companyperm->usercustomerpermissionid;
                           }

                    }else{
                       foreach ($_GET['arrai'] as $valor => $descripcion){
                        $model->$valor = $descripcion;
                       }
                       $model->systemid=1;
                        $model->active=1;
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $model->insert();
                   echo $model->usercustomerpermissionid;
                }
               
               
	}
            public function actionAddcustomernega()
	{       
             
		$model=new Usercustomerpermission();
              
               if($model->validar_campo1($_GET['arrai'])){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_GET['arrai']);
                 
                 $companyperm=$model->findByPk($id[0]["usercustomerpermissionid"]);
                        if($companyperm!=null){
                            $companyperm->active=0;
                            $companyperm->update();
                            echo $companyperm->usercustomerpermissionid;
                           }

                    }else{
                       foreach ($_GET['arrai'] as $valor => $descripcion){
                        $model->$valor = $descripcion;
                       }
                       $model->systemid=1;
                        $model->active=0;
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $model->insert();
                   echo $model->usercustomerpermissionid;
                }
               
               
	}
        
        
        ///-------------------------------------
              public function actionAddspecialaff()
	{       
             
		$model=new Specialpermission();
              
               if($model->validar_campo1($_POST)){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_POST);
                 
                 $companyperm=$model->findByPk($id[0]["specialpermissionid"]);
                        if($companyperm!=null){
                            $companyperm->active=1;
                            $companyperm->update();
                            echo $companyperm->specialpermissionid;
                           }

                    }else{
                       foreach ($_POST as $valor => $descripcion){
                        $model->$valor = $descripcion;
                       }
                      
                        $model->active=1;
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $model->insert();
                   echo $model->specialpermissionid;
                }
               
               
	}
            public function actionAddspecialnega()
	{       
             
		$model=new Specialpermission();
              
               if($model->validar_campo1($_POST)){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_POST);
                 
                 $companyperm=$model->findByPk($id[0]["specialpermissionid"]);
                        if($companyperm!=null){
                            $companyperm->active=0;
                            $companyperm->update();
                            echo $companyperm->specialpermissionid;
                           }

                    }else{
                       foreach ($_POST as $valor => $descripcion){
                        $model->$valor = $descripcion;
                       }
                    
                        $model->active=0;
                       //$customsbrand->companyid=Yii::app()->user->companyid;
                       $model->insert();
                   echo $model->specialpermissionid;
                }
               
               
	}
        
        public function actionSaveprivilegeposi()
	{
            $this->layout = false;
            
            $model = new Userprivilege();
            $menuop = $_POST[menuop];
         
            
           if($model->validar_campo1($_POST)){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_POST);
                 
                 $companyperm=$model->findByPk($id[0]["userprivilegeid"]);
                        if($companyperm!=null){
                         if($menuop=="menuread"){$companyperm->menuread =1;}
                         if($menuop=="menuadd"){$companyperm->menuadd =1;}
                         if($menuop=="menuedit"){$companyperm->menuedit =1;}
                         if($menuop=="menudelete"){$companyperm->menudelete =1;}
                          $companyperm->update();
                           echo $companyperm->userprivilegeid;
                                 //print_r($companyperm);
                           }

                    }else{
                        $model->userid   = $_POST[userid];
                        $model->menuid   = $_POST[menuid];
                         if($menuop=="menuread"){$model->menuread =1;}else{$model->menuread =0;}
                         if($menuop=="menuadd"){$model->menuadd =1;}else{$model->menuadd =0;}
                         if($menuop=="menuedit"){$model->menuedit =1;}else{$model->menuedit =0;}
                         if($menuop=="menudelete"){$model->menudelete =1;}else{$model->menudelete =0;}
                   
                       $model->insert();
                       // print_r($model); 
                       echo $model->userprivilegeid;
                } 
                    
		
	}
        
         public function actionSaveprivilegenega()
	{
            $this->layout = false;
            
            $model = new Userprivilege();
            $menuop = $_POST[menuop];
         
            
           if($model->validar_campo1($_POST)){   // if the inputs are valid
                       
                 $id=$model->validar_existencia($_POST);
                 
                 $companyperm=$model->findByPk($id[0]["userprivilegeid"]);
                        if($companyperm!=null){
                         if($menuop=="menuread"){$companyperm->menuread =0;}
                         if($menuop=="menuadd"){$companyperm->menuadd =0;}
                         if($menuop=="menuedit"){$companyperm->menuedit =0;}
                         if($menuop=="menudelete"){$companyperm->menudelete =0;}
                          //  $companyperm->update();
                           echo $companyperm->userprivilegeid;
                          //       print_r($companyperm);
                           }

                    }
                    
		
	}
        
          public function actionUpdatesupplier()
	{	
		$this->layout = false;
               
                    $modeluser=new User();
                    $modelempl = new Supplieruser();
                    $model = $modeluser->findByPk($_POST['arrai']['userid']);
                    
                    if($model!=null){
                        //echo $model->userid;
                        $model->username=   $_POST['arrai'][username];
                        $model->password  = $_POST['arrai'][password];
                        $model->usertype = 2;
                        $model->active = 1;
                        $model->profileid =7; 
                        
                        if($model->update()){
                        
                            $cargemp=$modelempl->findByPk($model->userid);  
                            $cargemp->supplierid = $_POST['arrai'][supplierid];
                            $cargemp->firstname = $_POST['arrai'][firstname];
                            $cargemp->plastname = $_POST['arrai'][plastname];
                            $cargemp->mlastname = $_POST['arrai'][mlastname];
                            $cargemp->email = $_POST['arrai'][email];
                            $cargemp->phone = $_POST['arrai'][phone];
                            $cargemp->update();
                            echo $cargemp->userid;

                        }
                     }
                  
               
	}
        
}
