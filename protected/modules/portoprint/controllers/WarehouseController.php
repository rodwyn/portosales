<?php

class WarehouseController extends Controller {

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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Warehouse;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Warehouse'])) {
            $model->attributes = $_POST['Warehouse'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->warehouseid));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Warehouse'])) {
            $model->attributes = $_POST['Warehouse'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->warehouseid));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->layout = false;
        $model = new Warehouse();
        $customerlist = CHtml::listData(Customer::model()->findAllByAttributes(array("companyid" => Yii::app()->user->companyid)), 'customerid', 'customerdsc');
        $read = explode('_', $_GET['read']);
        if (isset($_GET['customer'])) {
            $customer = $_GET['customer'];
        } else {
            $customer = 0;
        }

        if ($customer == 0) {
            $list_warehouse = $model->getAllwarehouse();
        } else {
            $list_warehouse = $model->getIdwarehouse($customer);
        }

        $this->render('index', array(
            'model' => $list_warehouse, "customerlist" => $customerlist, 'customer' => $customer, "add" => $read[1], "edt" => $read[2], "del" => $read[3]
        ));
    }

    public function actionUpdatewarehouse() {
        $this->layout = false;
        $customs = $this->loadModel($_POST['id']);
        $customs->$_POST['camp'] = $_POST['nue'];
        echo $customs->update();
        $act = new Activity();
        $act->userid = Yii::app()->user->userid;
        $act->menuid = 0;
        $act->activity = 'Editó bodega';
        $act->id = $customs->warehouseid;
        $act->type = 'W';
        $act->insert();
    }

    public function actionCreatewarehouse() {
        $this->layout = false;
        // print_r($_POST['arrai']); 
        $customswarehouse = new Warehouse();

        if ($customswarehouse->validar_campo($_POST['arrai'])) {   // if the inputs are valid
            echo "0";
        } else {
            foreach ($_POST['arrai'] as $valor => $descripcion) {
                $customswarehouse->$valor = $descripcion;
            }

            $customswarehouse->insert();
            echo $customswarehouse->warehouseid;
            $act = new Activity();
            $act->userid = Yii::app()->user->userid;
            $act->menuid = 0;
            $act->activity = 'Agregó bodega';
            $act->id = $customswarehouse->warehouseid;
            $act->type = 'W';
            $act->insert();
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Warehouse('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Warehouse']))
            $model->attributes = $_GET['Warehouse'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Warehouse the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Warehouse::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Warehouse $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'warehouse-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDeltewarehouse() {
        $this->layout = false;

        $modelcustomer = new Warehouse();
        $model = $modelcustomer->findByPk($_POST['warehouseid']);

        if ($model != null) {
            $model->active = 0;
            if ($model->update()) {
                echo $model->warehouseid;
                $act = new Activity();
                $act->userid = Yii::app()->user->userid;
                $act->menuid = 0;
                $act->activity = 'Eliminó bodega';
                $act->id = $model->warehouseid;
                $act->type = 'W';
                $act->insert();
            }
        }
    }

}
