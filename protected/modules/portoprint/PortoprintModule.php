<?php

class PortoprintModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'portoprint.models.*',
			'portoprint.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$sql="update rate set statustime=ADDTIME(statustime,duration), statusid = 3 where NOW()>ADDTIME(statustime,duration)  and statusid in (2,4)";
			$command=Yii::app()->db->createCommand($sql);
			$command->execute();
			return true;
		}
		else
			return false;
	}
}
