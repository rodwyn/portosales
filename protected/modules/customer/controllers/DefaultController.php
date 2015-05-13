<?php

class DefaultController extends Controller
{   
    public function init() {
       $this->layout = "//layouts/customer"; 
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
        
	public function actionIndex()
	{       
          
                //$model=new Supplier();
		/*$datos=$model->getidSupplier();
                $cadena=" ";
        
                foreach($datos as $supplier){
			$cadena= $supplier->supplierdsc. ' - ' .$supplier->firstname.' '.$supplier->plastname;
		}*/
               
             // $model=new Rate();
		$this->render('index');
	}
	
        
	public function actionDashboard()
	{       $this->layout = false;
		$model=new Supplier();
                
		$this->render('dashboard',array('model'=>$model));
                
	}
	
	public function actionEvents()
	{
		$this->layout = false;
		$start = date('Y-m-d',$_GET['start']);
		$end = date('Y-m-d',$_GET['end']);
		$tracker = Ratetracker::model()->trackerByUser(Yii::app()->user->userid, $start, $end);
		$events = array();
		foreach($tracker as $event){
			$event = array("title"=>$event->rateid.": ".$event->statusdsc, "start"=>$event->statusdate, "className"=>"label label-info");
			array_push($events, $event);
		}
		echo json_encode($events);
		die();
		echo '[{
    "title": "Event4",
    "start": "2014-01-01",
	"className": "label label-info"
},{
    "title": "Event1",
    "start": "2014-01-01",
	"className": "label label-info"
},{
    "title": "Event2",
    "start": "2014-01-01",
	"className": "label label-info"
},{
    "title": "Event3",
    "start": "2014-01-01",
	"className": "label label-info"
}]';
	}
}