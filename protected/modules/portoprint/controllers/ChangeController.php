<?php

class ChangeController extends Controller
{
	
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
	

	public function actionCompany()
	{    
		$this->layout=false;
		$companies = Yii::app()->user->companies;
		Yii::app()->user->companyid = $_GET['id'];
		Yii::app()->user->companydsc = $companies[ $_GET['id'] ]['companydsc'];
		Yii::app()->user->tax = $companies[ $_GET['id'] ]['tax'];
		Yii::app()->user->duration =  $companies[ $_GET['id'] ]['duration'];
		$this->redirect(Yii::app()->createUrl('portoprint'));
	}
	
}