<?php

class RateController extends Controller
{
	public function init() {
             $this->layout = "//layouts/supply"; 
        //date_default_timezone_set('America/Argentina/Buenos_Aires');
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
		$id = Utils::decrypt($id,'rate');
		
		if(isset($_POST['Rateart'])){
			$rateart = Rateart::model()->findByAttributes(array('rateid'=>$id));
			$rateart->attributes=$_POST['Rateart'];
			$rateart->save();			
		}
		
		if(isset($_POST['Ratecolortest'])){
			$ratecolor = Ratecolortest::model()->findByAttributes(array('rateid'=>$id));
			$ratecolor->attributes=$_POST['Ratecolortest'];
			$ratecolor->save();			
		}
		
		if(isset($_POST['Rateproduction'])){
			$rateproduction = Rateproduction::model()->findByAttributes(array('rateid'=>$id));
			$rateproduction->attributes=$_POST['Rateproduction'];
			$rateproduction->save();			
		}
		
		if(isset($_POST['Ratezerotest'])){
			$ratezerotest = Ratezerotest::model()->findByAttributes(array('rateid'=>$id));
			$ratezerotest->attributes=$_POST['Ratezerotest'];
			$ratezerotest->save();			
		}
		
		$modelart = Rateart::model()->findbyAttributes(array('rateid'=>$id));
		$modelcolortest = Ratecolortest::model()->findbyAttributes(array('rateid'=>$id,'active'=>1));
		$modelproduction = Rateproduction::model()->findbyAttributes(array('rateid'=>$id));
		$modelzerotest = Ratezerotest::model()->findbyAttributes(array('rateid'=>$id,'active'=>1));
		$details = Rateitemdetailvalue::model()->getDetail_su($id);
		$this->render('view',array(
			'model'=>$this->loadModel($id), 'modelart'=>$modelart, 'modelcolortest'=>$modelcolortest, 
			'details'=>$details, 'modelproduction'=>$modelproduction, 'modelzerotest'=>$modelzerotest
		));
	}

	public function actionIndex()
	{
		$this->layout = false;
		$model=new Rate();
		$service =CHtml::listData(Service::model()->getEntryItem( Yii::app()->user->userid ), 'serviceid', 'servicedsc', 'entrydsc');
		
		$end = (isset($_GET['end']))?$_GET['end']:date('Y-m-d');
		$start = (isset($_GET['start']))?$_GET['start']:date ( 'Y-m-d' ,strtotime ( '-30 day' , strtotime ( $end ) )) ;
		$status = (isset($_GET['status']))?$_GET['status']:0;
                
                
		
		$this->render('index',array(
			 "servicelist"=>$service, 'start'=>$start, 'end'=>$end, "status"=>$status
		));
              
	}
	
	public function actionRate(){
		$this->layout = null;
              
		$rates = Rate::model()->searchRates_supplier($_GET);
		
               echo json_encode($rates);		
	}
        
        public function actionprice_state(){
		$this->layout = null;
                 $current_time = date ("Y-m-d H:i:s");
                 $rate = $this->loadModelRateSupplier($_POST['arrai']['ratesupplierid']);
		//$rates = Rate::model()->searchRates3($_GET);
                  foreach ($_POST['arrai'] as $valor => $descripcion){
                        $rate->$valor = $descripcion;
                   }
                 $rate->statustime=$current_time;
                
		 $actu= $rate->update();
                 
                $ratetracker = new Ratetracker();
		$ratetracker->rateid = $rate->rateid;
		$ratetracker->statusid = 105 ;
                $ratetracker->supplierid = $rate->supplierid;
		$ratetracker->statusdate = $date;
		$ratetracker->userid = Yii::app()->user->userid;
		$ratetracker->insert();
                 echo $actu;
                //echo json_encode($rates);		
	}
        
        public function actionchan_state(){
		$this->layout = null;
                $current_time = date ("Y-m-d H:i:s");
                 $rate = $this->loadModelRateSupplier($_POST['id']);
		//$rates = Rate::model()->searchRates3($_GET);
                 $rate->ratesupplierid=$_POST['id'];
                 $rate->statusid=$_POST['stateid'];
                 $rate->statustime=$current_time;
                 $rate->declinereason=$_POST['txts'];
                
		 echo $rate->update();
                //echo json_encode($rates);		
	}
        
	
	static function getDetail($rateid, $servicedsc, $note, $version){
               
                $details=  Rateitemdetailvalue::model()->getDetail_su($rateid);
		//$details = Rateitemdetailvalue::model()->getDetail($rateid);
		$detail ="<span style='font-size:9.5px;'>";
		foreach($details as $row){
                    $dato1=str_replace('"', "'", $row->itemdetaildsc);
                    $dato2=str_replace('"', "'", $row->itemdetailvaluedsc);
			$detail.= "<b>".$dato1.":</b>".$dato2.", ";
		} 
                $dato3=str_replace('"', "'", $note);
		$detail .=" <b>Observaciones:</b> ".$dato3."</span>";
                return $detail; 
		//return '<i style="color:#0088CC; cursor:pointer;"  class="ratepop" data-placement="right" data-title="'.$servicedsc.'" data-content="'.$detail.'">'.$rateid.'</i>';
	
	}
        
        	public function actionchange_keys(){
                    $this->layout = null;
                     $cadena=  Utils::encrypt($_POST['rateid'], "document").','.Utils::encrypt($_POST['bundleid'], "document");
                     echo $cadena;
	
	}
        
        
        
        
	public static function idVersion($parentrateid, $version){
		$txt = $parentrateid;
		if($version!=0)
			$txt .= ' - '.$version;		
		return $txt;	
	}
	
	public function loadModel($id)
	{
		$model=Rate::model()->modelByUser_su($id, Yii::app()->user->userid);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadBundleModel($id)
	{
		$model=Rate::model()->bundleByUser_su($id, Yii::app()->user->userid);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelCustomerByProject($id)
	{
		$project = Project::model()->modelByUser($id,Yii::app()->user->userid);
		$model =  Customer::model()->findByPk($project->customerid);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelRateSupplier($id)
	{
		$model =  Ratesupplier::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelRateodp($id)
	{
		$model =  Rateodp::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='rate-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
