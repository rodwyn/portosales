<?php

class ServiceController extends Controller {

    public $defaultAction = 'index2';

    public function init() {
        
    }

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->layout = false;
        $rubros = Service::model()->findAllbyAttributes(array("companyid" => Yii::app()->user->companyid, "serviceparentid" => 0, "active" => 1));

        $this->render('index', array('rubro'=>$rubros));
    }

    public function actionIndex2() {
        $this->layout = false;
        $model = new Service();
        $company=Yii::app()->user->companydsc;
        $read= explode('_', $_GET['read']);
        $this->render('index_1', array( 'company'=> $company,"add"=>$read[1],"edt"=>$read[2],"del"=>$read[3]));
    }

    public function actionGetServicesByCompany() {
        $this->layout = false;
        $model = new Service();
        $company=Yii::app()->user->companydsc;
        $ServiceList = $model->getServicesByCompanytree();
        $json = '{ "id" : "1", "parent" : "#", "text": "'.$company.'" }';
        
        if(count($ServiceList)!=0){
            foreach ($ServiceList as $Service) {
                $paren="";
                //$paren="0";
               if($Service->serviceparentid == 0){ $paren="1"; }else{$paren=$Service->serviceparentid+1;}
                if($json==" "){
                    $json .= '{ "id" : "'.($Service->serviceid+1).'", "parent" : "'.$paren.'", "text": "'.$Service->servicedsc.'" }';
                    $json = $json.$this->actionGetrecursive($Service->serviceid);
                }else{
                   $json = $json.',{ "id" : "'.($Service->serviceid+1).'", "parent" : "'.$paren.'", "text": "'.$Service->servicedsc.'" }';
                   $json = $json.$this->actionGetrecursive($Service->serviceid);
                }

            }
        }
        $json='['.$json.']';
        echo json_encode($json);
    }
    public function actionGetrecursive($id,$level) {
        $this->layout = false;
        $model = new Service();

        $ServiceList = $model->getServicesByCompanytreesub($id);
        $json = " ";
        if(count($ServiceList)!=0){
            foreach ($ServiceList as $Service) {
                    if($Service->level==4){ $cadena=', "icon": "glyphicon glyphicon-certificate" '; }else{ $cadena=''; }
                    if($Service->level==1){ $cadena1=', "data-atrib": "'.$Service->serviceid.'"'; $vari=$Service->serviceid; }else{ $cadena1=', "data-atrib": "'.$level.'"'; $vari=$level; }
                    
                    $json = $json.',{ "id" : "'.($Service->serviceid+1).'", "parent" : "'.($Service->serviceparentid+1).'", "text": "'.$Service->servicedsc.'",  "li_attr": {  "data-level": "'.$Service->level.'" '.$cadena1.' } '.$cadena.' }';
                    
                    $json = $json.$this->actionGetrecursive($Service->serviceid,$vari);
                }
        }
        return $json;
    }
    public function actionGetdetails() {
        $this->layout = false;
      
        $detailist =  Itemdetail::model()->findAllByAttributes(array("serviceid"=>$_POST['serviceid']));
        $json = " ";
        if(count($detailist)!=0){
            foreach ($detailist as $row) {
                 
                    $json = $json.'<tr><td><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="btnitemdetail_'.$row->itemdetailid.'" onclick="valid_itemdetail(this.id)"  value="'.$row->itemdetailid.','.$_POST['idparent'].'"  ></span><label class="form-control">'.$row->itemdetaildsc.'</label></div></td></tr>';
                  
                }
                 echo $json;
        }else{
            echo "0";
        }
       
    }
    
    public function actionGetdetailscheck() {
        $this->layout = false;
      
        $detailist = Servicedetail::model()->findAllByAttributes(array("serviceid"=>$_POST['serviceid']));
        $json = " ";
        if(count($detailist)!=0){
            foreach ($detailist as $row) {
                 if($json==" "){
                    $json =$row->itemdetailid;
                 }else{
                     $json = $json.','.$row->itemdetailid;
                 }
                }
                 echo $json;
        }else{
            echo "0";
        }
       
    }
    
    public function actionCreateservice()
	{	
		$this->layout = false;
                   // print_r($_POST['arrai']); 
                   $service = new Service();
                    $cont=0; 
                   $model=$service->findAllByAttributes(array("serviceid"=>$_POST['parent']));
                      foreach ($model as $detail) {
                          $cont=$detail->level+1;
                      }
                      $valida= $service->findAllByAttributes(array("servicedsc"=>$_POST['servicedsc']));
                     if(count($valida)==0){ 
                      $service->companyid=Yii::app()->user->companyid;
                      $service->servicedsc=$_POST['servicedsc'];
                      $service->serviceparentid=$_POST['parent'];
                      $service->level=$cont;
                      $service->active=1;
                       
                       $service->insert();
                      
                       echo $service->serviceid;
                     }else{
                         echo  "0";
                     }	
	}
        
        public function actionUpdateservice()
	{	
		$this->layout = false;
                   //$service = new Service();
                   $valida= Service::model()->findAllByAttributes(array("servicedsc"=>$_POST['servicedsc']));
                   if(count($valida)==0){ 
                        $service=Service::model()->findByPk($_POST['parent']);
                        
                        $service->servicedsc=$_POST['servicedsc'];
                        
                        $service->update();
                      
                       echo $service->serviceid;
                     }else{
                         echo  "0";
                     }
                      	
	}
        public function actionDeleteservice()
	{	
		$this->layout = false;
                   // print_r($_POST['arrai']); 
               $service=Service::model()->findByPk($_POST['parent']);
               if($service->delete()){
                   
                   echo  "1";
               }else{
                   echo  "0";
               }
        }
       public function actionCreateatrib()
	{	
		$this->layout = false;
                   // print_r($_POST['arrai']); 
               $service=  Servicedetail::model()->findAllByAttributes(array('serviceid'=>$_POST['serviceid'],'itemdetailid'=>$_POST['itemdetailid']));
                    if(count($service)==0){
                        $model= new  Servicedetail();
                        $model->serviceid=$_POST['serviceid'];
                        $model->itemdetailid=$_POST['itemdetailid'];
                        $model->active=1;
                        if($model->insert()){
                            echo  $model->servicedetailid;
                        }else{
                            echo  "0";
                        }
                    
                    }
        }
       public function actionDeleteatrib()
	{	
		$this->layout = false;
               
               $service=Servicedetail::model()->findAllByAttributes(array('serviceid'=>$_POST['serviceid'],'itemdetailid'=>$_POST['itemdetailid']));
               $model=new Servicedetail();
                    if($model->deleteByPk($service[0]['servicedetailid'])){
                       echo "1";
                     }else{
                       echo  "0";
                     }
                    
        }
        
        
    public function actionCreate() {

        if (isset($_POST['level'])) {
            $lista = nl2br($_POST['list']);
            $services = explode("<br />", $lista);
            foreach ($services as $service) {
                $model = new Service;
                $model->companyid = Yii::app()->user->companyid;
                $model->servicedsc = trim($service);
                $model->serviceparentid = $_POST['parent'];
                $model->level = $_POST['level'];
                $model->active = 1;
                $model->save();
            }
        } else if (isset($_POST['concept'])) {
            $lista = nl2br($_POST['list']);
            $details = explode("<br />", $lista);
            $cont = 1;
            foreach ($details as $detail) {
                $model = new Itemdetail();
                $model->serviceid = $_POST['concept'];
                $model->itemdetaildsc = trim($detail);
                $model->selecttype = 0;
                $model->order = $cont;
                $model->save();
                $cont++;
            }
        }
    }

    public function loadModel($id) {
        $model = Company::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'company-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
