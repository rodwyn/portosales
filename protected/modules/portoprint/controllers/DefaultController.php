<?php

class DefaultController extends Controller
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
	
	public function actionIndex()
	{
		
		$model=new Rate('search');
		$this->render('index',array('model'=>$model));
	}
	
	public function actionDashboard()
	{
		$this->layout = false;
                
		$this->render('dashboard');
	}
	
	public function actionEvents()
	{
		$this->layout = false;
		$start = date('Y-m-d',$_GET['start']);
		$end = date('Y-m-d',$_GET['end']);
		$tracker = Ratetracker::model()->trackerByUser(Yii::app()->user->userid, $start, $end);
		$events = array();
		foreach($tracker as $event){
                        $events[] = array("title"=>$event->rateid.": ".$event->statusdsc, "start"=>$event->statusdate, "className"=>"label label-info");
			//array_push($events, $event);
		}
		echo json_encode($events);
		//die();
		
	}
}