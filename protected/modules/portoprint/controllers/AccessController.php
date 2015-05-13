<?php

class AccessController extends Controller {

    public function init() {
        //date_default_timezone_set('America/Argentina/Buenos_Aires');
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
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
        $model = new Access;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Access'])) {
            $model->attributes = $_POST['Access'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->accessid));
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

        if (isset($_POST['Access'])) {
            $model->attributes = $_POST['Access'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->accessid));
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

        $model = new Access();

        $read = explode('_', $_GET['read']);



        $this->render('index', array(
            'model' => $model, 'menu' => $read[0], "add" => $read[1], "edt" => $read[2], "del" => $read[3]
        ));
    }

    public function actionSetgraph() {
        $actividad_uno = Ratetracker::model()->activity($_POST['startdt'], $_POST['enddt'], $_POST['areaid'], $_POST['userid']);
        $actividad_dos = Access::model()->activity($_POST['startdt'], $_POST['enddt'], $_POST['areaid'], $_POST['userid']);
        $actividad_trs = Activity::model()->get_activity($_POST['startdt'], $_POST['enddt'], $_POST['areaid'], $_POST['userid']);

        $total = 0;
        $activo = 0;
        $inactivo = 0;
        $output = array();
        $dif = 0;

        if (count($actividad_uno) > 0) {
            foreach ($actividad_uno as $row) {
                $output[] = $row->statusdate;
            }
        }
        if (count($actividad_dos) > 0) {
            foreach ($actividad_dos as $row) {
                $output[] = $row->accessdate;
            }
        }
        if (count($actividad_trs) > 0) {
            foreach ($actividad_trs as $row) {
                $output[] = $row->activitydate;
            }
        }
        rsort($output);
        if (count($output) > 0) {
            for ($i = 0; $i < count($output); $i++) {
                if (($i + 1) < count($output)) {
                    $dif = ceil((strtotime($output[$i]) - strtotime($output[$i + 1])));
                    if ($dif > 300) {
                        $activo += $dif;
                    } else {
                        $inactivo += $dif;
                    }
                    $total += $dif;
                }
            }
        }

        $pa = round(($activo * 100) / $total, 1);
        $pi = round(($inactivo * 100) / $total, 1);

        $ht = floor(($total / 3600));
        $mt = floor((fmod($total, 3600)) / 60);

        $ha = floor(($activo / 3600));
        $ma = floor((fmod($activo, 3600)) / 60);

        $hi = floor(($inactivo / 3600));
        $mi = floor((fmod($inactivo, 3600)) / 60);

        echo $salida = '
                   <div class="progress progress-striped active" rel="tooltip"  data-placement="bottom" aria-describedby="tooltip838079">
                   <div class="progress-bar progress-bar-success" role="progressbar" style="width: '.$pa.'%">'.(($ha > 0) ? $ha . ' hrs. ' : '') . (($ma > 0) ? $ma . ' mins.' : '').'</div>
                   <div class="progress-bar progress-bar-danger" role="progressbar" style="width: '.$pi.'%;position: relative;float: right;">'.(($hi > 0) ? $hi . ' hrs. ' : '') . (($mi > 0) ? $mi . ' mins.' : '').'</div>
                   </div><div class="tooltip fade bottom" role="tooltip" id="tooltip838079" style="top: 25px; left: 52.5px; display: block;"><div class="tooltip-arrow" style="left: 50%;"></div><div class="tooltip-inner">55%</div></div>';
    }

    public function actionGetactivity() {
        //$actividad = Ratetracker::model()->activityjson($_GET['startdt'], $_GET['enddt']);
        $actividad_uno = Ratetracker::model()->activity($_GET['startdt'], $_GET['enddt'], $_GET['areaid'], $_GET['userid']);
        $actividad_dos = Access::model()->activity($_GET['startdt'], $_GET['enddt'], $_GET['areaid'], $_GET['userid']);
        $actividad_trs = Activity::model()->get_activity($_GET['startdt'], $_GET['enddt'], $_GET['areaid'], $_GET['userid']);


        $cont = 0;
        if (count($actividad_uno) > 0) {
            foreach ($actividad_uno as $row) {
                $output[$cont]['cuando'] = $row->statusdate;
                $output[$cont]['que'] = $row->detalle . ' - ' . $row->statusdsc;
                $output[$cont]['quien'] = $row->responsable;


                $cont = $cont + 1;
            }
        }
        if (count($actividad_dos) > 0) {
            foreach ($actividad_dos as $row) {
                $output[$cont]['cuando'] = $row->accessdate;
                $output[$cont]['que'] = $row->operacion;
                $output[$cont]['quien'] = $row->responsable;


                $cont = $cont + 1;
            }
        }
        if (count($actividad_trs) > 0) {
            foreach ($actividad_trs as $row) {
                $output[$cont]['cuando'] = $row->activitydate;
                $output[$cont]['que'] = $row->actividad;
                $output[$cont]['quien'] = $row->responsable;


                $cont = $cont + 1;
            }
        }

        $output = array('aaData' => $output);
        echo json_encode($output);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Access('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Access']))
            $model->attributes = $_GET['Access'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Access the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Access::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Access $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'access-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
