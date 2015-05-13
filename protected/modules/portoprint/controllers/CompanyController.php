<?php

class CompanyController extends Controller {

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

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new Company;
        $corporatesdb = Corporate::model()->findAllbyAttributes(array('active' => 1));
        $corporates = CHtml::listData($corporatesdb, 'corporateid', 'corporatedsc');
        if (isset($_POST['Company'])) {
            $model->attributes = $_POST['Company'];
            if ($model->save()) {
                $ucp = new Usercompanypermission();
                $ucp->userid = Yii::app()->user->userid;
                $ucp->companyid = $model->companyid;
                $ucp->systemid = 1;
                $ucp->save();
                $this->redirect(Yii::app()->createUrl('portoprint/company'));
            }
        }

        $this->render('create', array(
            'model' => $model, 'corporates' => $corporates
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $corporatesdb = Corporate::model()->findAllbyAttributes(array('active' => 1));
        $corporates = CHtml::listData($corporatesdb, 'corporateid', 'corporatedsc');

        if (isset($_POST['Company'])) {
            $model->attributes = $_POST['Company'];
            if ($model->save())
                $this->redirect(Yii::app()->createUrl('portoprint/company'));
        }

        $this->render('update', array(
            'model' => $model, 'corporates' => $corporates
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            $model->active = 0;
            $model->save();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionIndex() {
        $model = new Company('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Company']))
            $model->attributes = $_GET['Company'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionIndex2() {
        $this->layout = false;
        $model = new Company();

        $companies = $model->findAllbyAttributes(array('active' => 1));
        $read = explode('_', $_GET['read']);

        $this->render('index', array("model" => $companies, "add" => $read[1], "edt" => $read[2], "del" => $read[3]));
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

    public function actionUpdatecompany() {
        $this->layout = false;
        $company = $this->loadModel($_POST['id']);
        $company->$_POST['camp'] = $_POST['nue'];
        echo $company->update();
        $act = new Activity();
        $act->userid = Yii::app()->user->userid;
        $act->menuid = 0;
        $act->activity = 'Editó Compañia';
        $act->id = $company->companyid;
        $act->type = 'C';
        $act->insert();
    }

    public function actionCreatecompany() {
        $this->layout = false;

        $company = new Company();

        foreach ($_POST['arrai'] as $valor => $descripcion) {
            $company->$valor = $descripcion;
        }
        $company->corporateid = 1;
        $company->tax = 16;
        $company->duration = 2;
        $company->active = 1;
        if($company->insert()){
            $usercompany=new Usercompanypermission();
            $usercompany->companyid=$company->companyid;
            $usercompany->userid=Yii::app()->user->userid;
            $usercompany->systemid=1;
            $usercompany->active=1;
            $usercompany->insert();
            
            $act = new Activity();
            $act->userid = Yii::app()->user->userid;
            $act->menuid = 0;
            $act->activity = 'Agregó Compañia';
            $act->id = $company->companyid;
            $act->type = 'C';
            $act->insert();
             echo $company->companyid;
        }else{
            echo "0";
        }
        
   
    
       
    }

    public function actionDeltecompany() {
        $this->layout = false;

        $modelcompany = new Company();
         $companyid=$_POST['companyid'];
        $model = Company::model()->findByPk($companyid);
     

        if ($model != null) {
           
            $usercompany=  Usercompanypermission::model()->findbyAttributes(array("companyid"=>$_POST['companyid'],"userid"=>Yii::app()->user->userid));
            if($usercompany!=null){
                $usercompany1= Usercompanypermission::model()->findByPk($usercompany->usercompanypermissionid);
                $usercompany1->delete();
            }
            
            if ($model->delete()) {
                
                    $act = new Activity();
                    $act->userid = Yii::app()->user->userid;
                    $act->menuid = 0;
                    $act->activity = 'Eliminó Compañia';
                    $act->id = $model->companyid;
                    $act->type = 'C';
                    $act->insert();
                    echo $model->companyid; 
                
                
               
            }
        }
    }

}
