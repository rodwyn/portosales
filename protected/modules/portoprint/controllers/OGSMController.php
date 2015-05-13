<?php

class OGSMController extends Controller {

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
    public function actionIndex() {
        $this->layout = false;

        $model = new Todo();

        $read = explode('_', $_GET['read']);

        $this->render('index_1', array(
            'model' => $model, 'menu' => $read[0], "add" => $read[1], "edt" => $read[2], "del" => $read[3]
        ));
    }

    public function actionSavecomment() {
        $comment = new Todocomment();

        $comment->todoid = $_POST['todoid'];
        $comment->userid = Yii::app()->user->userid;
        $comment->comment = $_POST['comment'];
        $comment->cdate = date('Y-m-d H:i:s');

        if ($comment->insert()) {
            echo $comment->commentid;
        }
    }

    public function actionCreateogsm() {
        $this->layout = false;

        $ogsm = new Todo();

        foreach ($_POST['arrai'] as $valor => $descripcion) {
            $ogsm->$valor = $descripcion;
        }

        $ogsm->parentid = 0;
        $ogsm->rateid = 0;
        $ogsm->statusid = 0;
        $ogsm->usertype = 1;
        $ogsm->todotype = 'O';
        $ogsm->priority = 1;
        $ogsm->doit = 0;
        $ogsm->realstartdate = '0000-00-00 00:00:00';
        $ogsm->realenddate = '0000-00-00 00:00:00';
        $ogsm->usercreate = Yii::app()->user->userid;

        $ogsm->insert();
        echo $ogsm->todoid;
    }

    public function actionViewtodos() {
        $this->layout = false;

        $model = new Todo();

        $read = explode('_', $_GET['read']);

        $this->render('list', array(
            'model' => $model, 'menu' => $read[0], "add" => $read[1], "edt" => $read[2], "del" => $read[3], "todoid" => $_GET['todoid']
        ));
    }

    public function actionCreatetodo() {
        $this->layout = false;

        $todo = new Todo();

        foreach ($_POST['arrai'] as $valor => $descripcion) {
            $todo->$valor = $descripcion;
        }


        $todo->rateid = 0;
        $todo->statusid = 1;
        $todo->usertype = 0;
        //$todo->todotype = 'O';

        $todo->doit = 0;
        $todo->realstartdate = '0000-00-00 00:00:00';
        $todo->realenddate = '0000-00-00 00:00:00';
        $todo->usercreate = Yii::app()->user->userid;

        $todo->insert();
        echo $todo->todoid;
    }

    public function actionCreatetodocot() {
        $this->layout = false;

        $todo = new Todo();
        $rate = Todo::model()->findByAttributes(array('rateid' => $_POST['arrai']['rateid'], 'parentid' => 0));
        if (count($rate) != 0) {
            $todo->parentid = $rate->todoid;

            foreach ($_POST['arrai'] as $valor => $descripcion) {
                $todo->$valor = $descripcion;
            }
            $todo->todotype = 'C';
            $todo->statusid = 1;
            $todo->usertype = 0;
            //$todo->todotype = 'O';

            $todo->doit = 0;
            $todo->percent = 0;
            $todo->realstartdate = '0000-00-00 00:00:00';
            $todo->realenddate = '0000-00-00 00:00:00';
            $todo->usercreate = Yii::app()->user->userid;

            $todo->insert();
            echo $todo->todoid;
        } else {
            echo '-1';
        }
    }

    public function actionTable() {
        $tabla = Todo::model()->tabla($_GET['todoid']);
        $cont = 0;

        foreach ($tabla as $row) {
            $output[$cont]['pbaja'] = $row->pbaja;
            $output[$cont]['pmedia'] = $row->pmedia;
            $output[$cont]['palta'] = $row->palta;
            $output[$cont]['ebaja'] = $row->ebaja;
            $output[$cont]['emedia'] = $row->emedia;
            $output[$cont]['ealta'] = $row->ealta;
            $output[$cont]['tbaja'] = $row->tbaja;
            $output[$cont]['tmedia'] = $row->tmedia;
            $output[$cont]['talta'] = $row->talta;

            $cont++;
        }


        $output = array('aaData' => $output);
        echo json_encode($output);
    }

    public function actionFindtodos() {
        $todos = Todo::model()->getTodos($_GET['todoid']);
        $edt = $_GET['edt'];
        $cont = 0;

        foreach ($todos as $row) {
            $output[$cont]['pr'] = $row->prioridad;
            $output[$cont]['tr'] = $row->tododsc;
            $output[$cont]['rs'] = $row->responsable;
            $output[$cont]['fi'] = $row->startdate;
            $output[$cont]['ff'] = $row->enddate;
            $output[$cont]['av'] = $row->percent;

            $output[$cont]['ap'] = $row->areadsc;

            $output[$cont]['ma'] = ($edt == 1) ? '<button type="button" title="Modificar porcentaje de avance" 
                href="#mpercent"
                data-target="#mpercent" data-toggle="modal"
                class="btn btn-primary btn-sm bavance" onclick="set_htodoid(' . $row->todoid . ');">
                <span class="glyphicon glyphicon-stats"></span>
                </button>' : '<div style="width:0px;"></div>';
            $output[$cont]['cm'] = ($edt == 1) ? '<button type="button" title="Comentarios" 
                href="#mcoment"
                data-target="#mcoment" data-toggle="modal"
                class="btn btn-primary btn-sm" onclick="set_htodoid(' . $row->todoid . ');hcomment(' . $row->todoid . ');">
                <span class="glyphicon glyphicon-list-alt"></span>
                </button>' : '<div style="width:0px;"></div>';

            $cont++;
        }


        $output = array('aaData' => $output);
        echo json_encode($output);
    }

    public function actionSetpercent() {
        $model = Todo::model()->findByPk($_POST['todoid']);
        $doit = ($_POST['percent'] == 100) ? 1 : 0;
        if ($_POST['percent'] == 100) {
            $status = 3;
        }
        if ($_POST['percent'] > 0 && $_POST['percent'] < 100) {
            $status = 2;
        }
        $model->doit = $doit;
        $model->percent = $_POST['percent'];
        $model->statusid = $status;

        if ($model->update()) {
            echo $model->todoid;
        }
    }

    public function actionGetpercent() {
        $model = Todo::model()->findByPk($_POST['todoid']);
        echo $model->percent;
    }

    public function actionHcomment() {
        $hst = Todocomment::model()->hcomment($_GET['todoid']);
        echo json_encode($hst);
    }

    public function actionGetodo() {
        $todos = Todo::model()->mytodos(Yii::app()->user->userid);

        $togsm = "";
        $trate = "";
        $tpers = "";
        $countogsm = 0;
        $countpers = 0;
        $countrate = 0;

        foreach ($todos as $fila) {
            $datetime1 = strtotime($fila->enddate);
            $datetime2 = strtotime(date('Y-m-d H:i:s'));
            $interval = $datetime1 - $datetime2;

            if ($interval <= 5400 && $interval > 1800) {
                $todo = Todo::model()->findByPk($fila->todoid);
                $todo->priority = 2;
                $todo->update();
            }
            if ($interval <= 1800) {
                $todo = Todo::model()->findByPk($fila->todoid);
                $todo->priority = 3;
                $todo->update();
            }
        }

        foreach ($todos as $fila) {
            switch ($fila->priority) {
                case 1:
                    $color = "#11766D";
                    break;
                case 2:
                    $color = "#FCD036";
                    break;
                case 3:
                    $color = "#CC333F";
                    break;
            }
            $countogsm += ($fila->todotype == 'O') ? 1 : 0;
            $countpers += ($fila->todotype == 'P') ? 1 : 0;
            $countrate += ($fila->todotype == 'C') ? 1 : 0;

            $togsm .= ($fila->todotype == 'O') ? '<li>
                                <span class="handle" style="background: ' . $color . ';">  </span>
                                <p>
                                    <strong>' . $fila->tododsc . '</strong> - ' . $fila->area . ' 
                                        <span class="text-muted"><strong>Avance: </strong>' . $fila->porcentaje . '%</span>
                                        <span class="text-muted"><strong>Prioridad: </strong>' . $fila->prioridad . '</span>
                                        <span class="text-muted"><strong>Objetivo: </strong>' . $fila->notes . '</span>    
                                    <span class="date"><strong>Fecha inicio: </strong>' . date("d-m-Y", strtotime($fila->startdate)) . '</span>
                                    <span class="date"><strong>Fecha fin: </strong>' . date("d-m-Y", strtotime($fila->enddate)) . '</span>    
                                </p>
                            </li>' : '';
            $tpers .= ($fila->todotype == 'P') ? '<li>
                                <span class="handle" style="background: ' . $color . ';"></span>
                                <p>
                                    <strong>' . $fila->tododsc . '</strong> - ' . $fila->area . '
                                        <span class="text-muted"><strong>Avance: </strong>' . $fila->porcentaje . '%</span>
                                        <span class="text-muted"><strong>Prioridad: </strong>' . $fila->prioridad . '</span>
                                        <span class="text-muted"><strong>Objetivo: </strong>' . $fila->notes . '</span>    
                                    <span class="date"><strong>Fecha inicio: </strong>' . date("d-m-Y", strtotime($fila->startdate)) . '</span>
                                    <span class="date"><strong>Fecha fin: </strong>' . date("d-m-Y", strtotime($fila->enddate)) . '</span>
                                    <div style="position: absolute; top: 10px; right: 5px;">    
                                    <button type="button" title="Modificar porcentaje de avance" href="#mpercent" data-target="#mpercent" data-toggle="modal" class="btn btn-primary btn-sm bavance" onclick="set_htodoid(' . $fila->todoid . ');" >
                                        <span class="glyphicon glyphicon-stats"></span>
                                    </button>
                                    </div>
                                </p>
                            </li>' : '';
            $trate .= ($fila->todotype == 'C') ? '<li>
                                <span class="handle" style="background: ' . $color . ';">  </span>
                                <p>
                                    <strong>' . $fila->tododsc . '</strong> - ' . $fila->area . '
                                        <span class="text-muted">Avance: ' . $fila->porcentaje . '%</span>
                                        <span class="text-muted">Prioridad: ' . $fila->prioridad . '</span>    
                                    <span class="date">Fecha inicio: ' . date("d-m-Y", strtotime($fila->startdate)) . '</span>
                                    <span class="date">Fecha fin: ' . date("d-m-Y", strtotime($fila->enddate)) . '</span>    
                                </p>
                            </li>' : '';
        }
        $data = $togsm . '|' . $trate . '|' . $tpers . '|' . $countogsm . '|' . $countpers . '|' . $countrate;
        echo $data;
    }

}
