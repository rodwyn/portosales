<?php 
class UploadController extends Controller
{
	public function init() {
        
    }
    
    public function actionIndex()
	{ 
		
	}
	public function actionSaveFile($id,$rate){ 
		$ratefile = new Ratefile();
		$result = $ratefile->processFile($id,$rate);

		if($result['success']){
			$ratefile->name = $result['name'];
			$ratefile->rateid = Utils::decrypt($rate,'document');
			$ratefile->path = $result['path'];
                        $mysqldate = date( 'Y-m-d H:i:s');
			$ratefile->dateupload =  $mysqldate;
                       
			$ratefile->insert();
			$result['rateid'] = $rate;
			$result['ratefileid'] = $ratefile->ratefileid;
			$result['dateupload'] = $ratefile->dateupload;
                        $cad=$ratefile->path;
                        //$result['path'] = Utils::decrypt($cad,'document');
		}
		echo json_encode($result);
	}
        public function actionSaveFile_supplier($id,$rate){ 
               $id=Utils::encrypt($id,'document');
               $rate=Utils::encrypt($rate,'document');
		
                 $ratefile = new Ratefile();
		$result = $ratefile->processFile($id,$rate);
                
		if($result['success']){
			$ratefile->name = $result['name'];
			$ratefile->rateid = Utils::decrypt($rate,'document');
			$ratefile->path = $result['path'];
                        $mysqldate = date( 'Y-m-d H:i:s');
			$ratefile->dateupload =  $mysqldate;
                         $ratefile->ratefilesupplier =  1;
			$ratefile->insert();
			$result['rateid'] = $rate;
			$result['ratefileid'] = $ratefile->ratefileid;
			$result['dateupload'] = $ratefile->dateupload;
                        $cad=$ratefile->path;
                        //$result['path'] = Utils::decrypt($cad,'document');
		}
		echo json_encode($result);
	}
	public function listFiles($id,$rate){
		
	}
}