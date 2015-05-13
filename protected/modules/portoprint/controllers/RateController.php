<?php

class RateController extends Controller {

    public function init() {
        //date_default_timezone_set('America/Argentina/Buenos_Aires');
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
        $id = Utils::decrypt($id, 'rate');

        if (isset($_POST['Rateart'])) {
            $rateart = Rateart::model()->findByAttributes(array('rateid' => $id));
            $rateart->attributes = $_POST['Rateart'];
            $rateart->save();
        }

        if (isset($_POST['Ratecolortest'])) {
            $ratecolor = Ratecolortest::model()->findByAttributes(array('rateid' => $id));
            $ratecolor->attributes = $_POST['Ratecolortest'];
            $ratecolor->save();
        }

        if (isset($_POST['Rateproduction'])) {
            $rateproduction = Rateproduction::model()->findByAttributes(array('rateid' => $id));
            $rateproduction->attributes = $_POST['Rateproduction'];
            $rateproduction->save();
        }

        if (isset($_POST['Ratezerotest'])) {
            $ratezerotest = Ratezerotest::model()->findByAttributes(array('rateid' => $id));
            $ratezerotest->attributes = $_POST['Ratezerotest'];
            $ratezerotest->save();
        }

        $modelart = Rateart::model()->findbyAttributes(array('rateid' => $id));
        $modelcolortest = Ratecolortest::model()->findbyAttributes(array('rateid' => $id, 'active' => 1));
        $modelproduction = Rateproduction::model()->findbyAttributes(array('rateid' => $id));
        $modelzerotest = Ratezerotest::model()->findbyAttributes(array('rateid' => $id, 'active' => 1));
        $details = Rateitemdetailvalue::model()->getDetail($id);
        $this->render('view', array(
            'model' => $this->loadModel($id), 'modelart' => $modelart, 'modelcolortest' => $modelcolortest,
            'details' => $details, 'modelproduction' => $modelproduction, 'modelzerotest' => $modelzerotest
        ));
    }

    public function actionSaveart($id) {
        $nid = Utils::decrypt($id, 'rate');
        $rate = $this->loadModel($nid);


        if (isset($_POST['Rateart'])) {
            $rateart = Rateart::model()->findByAttributes(array('rateid' => $nid));
            if (is_null($rateart)) {
                $rateart = new Rateart;
                $rateart->rateid = $nid;
            }
            foreach ($_POST['Rateart'] as $key => $value) {
                $rateart->$key = $value;
            }
            $rateart->senddate = $rateart->senddate === "" ? null : $rateart->senddate;
            $rateart->authorizationdate = $rateart->authorizationdate === "" ? null : $rateart->authorizationdate;
            $rateart->save();
            $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($rate->bundleid, 'rate'));
        }
    }

    public function actionSavecolor($id) {
        $nid = Utils::decrypt($id, 'rate');
        $rate = $this->loadModel($nid);

        if (isset($_POST['Ratecolortest'])) {
            $ratecolor = Ratecolortest::model()->findByAttributes(array('rateid' => $rate->rateid));
            $ratecolor->attributes = $_POST['Ratecolortest'];
            $ratecolor->save();
        }
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($rate->bundleid, 'rate'));
    }

    public function actionSaveproduction($id) {
        $nid = Utils::decrypt($_GET['id'], 'rate');
        $rate = $this->loadModel($nid);
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        if (isset($_POST['Rateproduction'])) {
            $rateproduction = Rateproduction::model()->findByAttributes(array('rateid' => $rate->rateid));
            $rateproduction->attributes = $_POST['Rateproduction'];
            $rateproduction->save();
        }
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($rate->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionSavezero($id) {
        $nid = Utils::decrypt($id, 'rate');
        $rate = $this->loadModel($nid);

        if (isset($_POST['Ratezerotest'])) {
            $ratezerotest = Ratezerotest::model()->findByAttributes(array('rateid' => $rate->rateid));
            $ratezerotest->attributes = $_POST['Ratezerotest'];
            $ratezerotest->save();
        }
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($rate->bundleid, 'rate'));
    }

    public function actionCreate() {
        $this->layout = false;
        $model = new Rate();
        $customerlist = CHtml::listData(Usercustomerpermission::model()->getCustomerbyUser(Yii::app()->user->userid, Yii::app()->user->companyid), 'customerid', 'customerdsc');
        $service = CHtml::listData(Service::model()->getEntryItem(Yii::app()->user->companyid, Yii::app()->user->userid), 'serviceid', 'servicedsc', 'entrydsc');
        $read = explode('_', $_GET['read']);
        $this->render('create', array(
            'model' => $model, 'customerlist' => $customerlist, 'servicelist' => $service, "add" => $read[1], "edt" => $read[2], "del" => $read[3]
        ));
    }

    public function actionCreated() {
        $this->layout = false;
        $date = date('Y-m-d');
        $menu_model = new Menu();
        $type = Yii::app()->user->usertype;
        $useri = Yii::app()->user->userid;
        $menu = $menu_model->qryMenus($type, $useri);

        if (isset($_POST['paso'])) {
            $statustime = date('Y-m-d H:i:s');
            $bundle = new Bundleproject();
            $bundle->projectid = $_POST['Rate_projectid'];
            $bundle->customerid = $_POST['Rate_customerid'];
            $bundle->customercontactid = $_POST['Rate_customercontactid'];
            $bundle->legalentityid = $_POST['Rate_legalentityid'];
            $bundle->userid = Yii::app()->user->userid;
            $bundle->statusid = 103;
            $bundle->bundledate = $statustime;
            $bundle->comments = '';
            $bundle->insert();


            $ei = $_POST['ei'];
            $cei = $_POST['cei'];
            $customer = $this->loadModelCustomerByProject($bundle->projectid);
            $formula = $customer->formula;
            $ratebidsheet = $_POST['NT_bitsheet_daty'] . ' ' . $_POST['lis_hora_sheet'] . ':' . $_POST['lis_min_sheet'];
            for ($x = 1; $x <= count($ei); $x++) {

                $entry = Service::model()->getEntrybyServiceId($ei[$x]);
                $model = new Rate();
                $model->ratedate = $statustime;
                $model->customercontactid = $_POST['Rate_customercontactid'];
                $model->designagencyid = $_POST['Rate_designagencyid'];
                $model->duration = '0 ' . $_POST['Rate_duration'] . ':0:0';
                $model->expiration = $_POST['Rate_expiration'];
                $model->iva = $_POST['Rate_iva'];
                $model->legalentityid = $_POST['Rate_legalentityid'];
                $model->projectid = $_POST['Rate_projectid'];
                $model->ratetype = $_POST['Rate_ratetype'];
                $model->serviceid = $_POST['Rate_serviceid'];
                $model->warehouseid = $_POST['Rate_warehouseid'];
                $model->bureau = $_POST['Rate_bureau'];
                $model->quantity_1 = 0;
                $model->quantity_2 = 0;
                $model->quantity_3 = 0;
                $model->quantity_4 = 0;
                $model->quantity_5 = 0;
                $model->quantity_6 = 0;
                $model->version = 0;
                $model->bundleid = $bundle->bundleid;
                $model->parentrateid = 0;
                $model->entryid = $entry->serviceid;
                $model->serviceid = $ei[$x];
                $model->userid = $cei[$x];
                $model->statusid = 99;
                $model->statustime = $statustime;
                $model->ratedate = $statustime;
                $model->version = 0;
                $model->note = null;
                $model->formula = $formula;
                $model->ratebidsheet = $ratebidsheet;
                $model->insert();

                $ratetracker = new Ratetracker();
                $ratetracker->rateid = $model->rateid;
                $ratetracker->statusid = 1;
                $ratetracker->statusdate = date('Y-m-d H:i:s');
                $ratetracker->userid = Yii::app()->user->userid;
                $ratetracker->insert();

                $ratlist = Status::model()->findByAttributes(array('note' => 'RBS'));
                $ratetracker = new Ratetracker();
                $ratetracker->rateid = $model->rateid;
                $ratetracker->statusid = $ratlist->statusid;
                $ratetracker->statusdate = $_POST['NT_bitsheet_daty'] . ' ' . $_POST['lis_hora_sheet'] . ':' . $_POST['lis_min_sheet'];
                $ratetracker->userid = Yii::app()->user->userid;
                $ratetracker->insert();

                $parentrateid = $model->rateid;
                $model->parentrateid = $parentrateid;
                $model->update();
            }
            $marcas = explode('_', $menu[0]['leer']);
            $id = Utils::encrypt($model->bundleid, 'rate');
            $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . $id . '/add/' . Utils::encrypt($marcas[1], 'rate') . '/edt/' . Utils::encrypt($marcas[2], 'rate') . '/del/' . Utils::encrypt($marcas[3], 'rate') . '/menu/' . Utils::encrypt($marcas[0], 'rate'));
        }
    }

    public function actionCreated2() {
        $this->layout = false;
        $id = Utils::decrypt($_GET['id'], 'rate');
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        $rate = $this->loadModel($id);
        $item = Service::model()->findByAttributes(array('serviceid' => $rate->serviceid));
        $this->render('test', array('rate' => $rate, 'item' => $item, "add" => $add, "edt" => $edt, "del" => $del, "menu" => $menu));
    }

    public function actionTest() {
        $this->layout = false;
        echo "test";
    }

    public function actionCompleted($id) {
        $this->layout = false;
        $id = Utils::decrypt($_GET['id'], 'rate');
        $ca = $_POST['ca'];
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        $statustime = date('Y-m-d H:i:s');
        $model = $this->loadModel($id);
        $model->statusid = 1;
        $model->statustime = $statustime;
        $model->quantityselect = $ca[1];
        $model->quantity_1 = $ca[1];
        $model->quantity_2 = (isset($ca[2])) ? $ca[2] : 0;
        $model->quantity_3 = (isset($ca[3])) ? $ca[3] : 0;
        $model->quantity_4 = (isset($ca[4])) ? $ca[4] : 0;
        $model->quantity_5 = (isset($ca[5])) ? $ca[5] : 0;
        $model->quantity_6 = (isset($ca[6])) ? $ca[6] : 0;
        $model->save();

        $areaid = Rate::model()->getareaid($id);
        $managerid = Todoarea::model()->findByAttributes(array('areaid' => $areaid));

        $todo = new Todo();
        //Crear TODO padre
        $todo->parentid = 0;
        $todo->areaid = $areaid;
        $todo->userid = Yii::app()->user->userid;
        $todo->rateid = $id;
        $todo->statusid = 0;
        $todo->usertype = 0;
        $todo->tododsc = $model->rateid . ' ' . $model->servicedsc;
        $todo->todotype = 'C';
        $todo->priority = 2;
        $todo->doit = 0;
        $todo->notes = $model->note;
        $todo->startdate = date('Y-m-d H:i:s');
        $todo->enddate = date('Y-m-d h:i:s', time() + 7200);
        $todo->realstartdate = '0000-00-00 00:00:00';
        $todo->realenddate = '0000-00-00 00:00:00';
        $todo->percent = 0;
        $todo->usercreate = Yii::app()->user->userid;
        $todo->managerid = $managerid->userid;
        $todo->save();

        $parentid = $todo->todoid;

        //Crear primer TODO
        $todoh = new Todo();

        $todoh->parentid = $parentid;
        $todoh->areaid = $areaid;
        $todoh->userid = Yii::app()->user->userid;
        $todoh->rateid = $id;
        $todoh->statusid = 1;
        $todoh->usertype = 0;
        $todoh->tododsc = 'Nueva cotización - ' . $model->rateid . ' ' . $model->servicedsc;
        $todoh->todotype = 'C';
        $todoh->priority = 2;
        $todoh->doit = 0;
        $todoh->notes = 'Revisar las especificaciones del item.';
        $todoh->startdate = date('Y-m-d H:i:s');
        $todoh->enddate = date('Y-m-d h:i:s', time() + 7200);
        $todoh->realstartdate = '0000-00-00 00:00:00';
        $todoh->realenddate = '0000-00-00 00:00:00';
        $todoh->percent = 0;
        $todoh->usercreate = Yii::app()->user->userid;
        $todoh->managerid = $managerid->userid;
        $todoh->save();

        $ratetracker = new Ratetracker();
        $ratetracker->rateid = $model->rateid;
        $ratetracker->statusid = 2;
        $ratetracker->statusdate = date('Y-m-d H:i:s');
        $ratetracker->userid = Yii::app()->user->userid;
        $ratetracker->insert();


        $ratesupplier = (isset($_POST['RateSupplier'])) ? $_POST['RateSupplier'] : array();
        foreach ($ratesupplier as $rs) {
            $rsupplier = new Ratesupplier();
            $rsupplier->rateid = $model->rateid;
            $rsupplier->supplierid = $rs;
            $rsupplier->statusid = 6;
            $rsupplier->statustime = $statustime;
            $rsupplier->save();
        }

        $rateitemdetailvalue = (isset($_POST['Rateitemdetailvalue'])) ? $_POST['Rateitemdetailvalue'] : array();
        foreach ($rateitemdetailvalue as $ri) {
            $ritemdetailvalue = new Rateitemdetailvalue();
            $ritemdetailvalue->rateid = $model->rateid;
            $ritemdetailvalue->itemdetailvalueid = $ri;
            $ritemdetailvalue->active = 1;
            $ritemdetailvalue->insert();
        }
        $canf = $_POST['canf'];
        $caqf = $_POST['caqf'];
        $h_rateid = $_POST['h_rateid'];
        $changeartid = $_POST['changeartid'];

        $cnt_x = 0;
        $cnt_y = 0;



        //Insertar cambios de arte
        for ($i = 1; $i <= count($canf); $i++) {
            $cnt_y ++;
            for ($j = 1; $j <= count($canf[$i]); $j++) {
                $cnt_x++;
            }
        }

        for ($i = 1; $i <= $cnt_y; $i++) {
            for ($j = 1; $j <= $cnt_x; $j++) {
                if ($canf[$i][$j] != '' && $caqf[$i][$j] != '') {
                    $change = new Ratechangeart();
                    $change->rateid = $h_rateid;
                    $change->quantitynumber = $changeartid[$i][$j];
                    $change->ratechangeartname = $canf[$i][$j];
                    $change->ratechangeartnumber = $caqf[$i][$j];
                    $change->active = 1;

                    $change->save();
                }
            }
        }
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionCreated3() {
        $this->layout = false;
        $id = Utils::decrypt($_GET['id'], 'rate');
        $rate = $this->loadModel($id);

        $this->render('test', array('rate' => $rate, 'item' => $item));
    }

    public function actionItems() {
        $this->layout = false;
        $itemid = $_REQUEST['items'];
        $item = Service::model()->findByAttributes(array('serviceid' => $itemid));
        $tabs[] = array(
            'active' => '1',
            'label' => $item->servicedsc,
            'content' => $this->renderPartial('_item', array('item' => $item), true),
        );

        $this->renderPartial('items', array('tabs' => $tabs));
    }

    public function actionSuppliers() {
        $this->layout = false;
        $itemid = $_REQUEST['items'];
        $item = Service::model()->findByAttributes(array('serviceid' => $itemid));
        $tabs[] = array(
            'active' => '1',
            'label' => $item->servicedsc,
            'content' => $this->renderPartial('_supplier', array('item' => $item), true),
        );

        $this->renderPartial('suppliers', array('tabs' => $tabs));
    }

    public function actionQuantities() {
        $this->layout = false;
        $itemid = $_REQUEST['items'];
        $item = Service::model()->findByAttributes(array('serviceid' => $itemid));
        $tabs[] = array(
            'active' => '1',
            'label' => $item->servicedsc,
            'content' => $this->renderPartial('_quantity', array('item' => $item), true),
        );
        $this->renderPartial('quantities', array('tabs' => $tabs));
    }

    public function actionDistribution() {
        $this->layout = false;
        $itemid = $_REQUEST['items'];
        $item = Service::model()->findByAttributes(array('serviceid' => $itemid));
        $tabs[] = array(
            'active' => '1',
            'label' => $item->servicedsc,
            'content' => $this->renderPartial('_distribution', array('item' => $item), true),
        );
        $this->renderPartial('distribution', array('tabs' => $tabs));
    }

    public function actionFiles() {
        $this->layout = false;
        $model = new Rate;
        $itemid = $_POST['items'];
        $item = Service::model()->findByAttributes(array('serviceid' => $itemid));
        $tabs[] = array(
            'active' => '1',
            'label' => $item->servicedsc,
            'content' => $this->renderPartial('_files', array('item' => $item, 'model' => $model), true),
        );
        $this->renderPartial('files', array('tabs' => $tabs));
    }

    public function actionAddproject() {
        if (Yii::app()->request->isPostRequest) {
            $project = new Project();
            $project->brandid = $_POST['brandid'];
            $project->projectdsc = $_POST['projectdsc'];
            $project->active = 1;
            $project->save();
            echo $project->projectid;
        }
    }

    public function actionAdditemdetailvalue() {
        if (Yii::app()->request->isPostRequest) {
            $idvalue = new Itemdetailvalue();
            $idvalue->itemdetailid = $_POST['itemdetailid'];
            $idvalue->itemdetailvaluedsc = $_POST['value'];
            $idvalue->active = 1;
            $idvalue->save();
            echo $idvalue->itemdetailvalueid;
        }
    }

    public function actionAdditem($id) {
        $idn = Utils::decrypt($id, 'rate');
        $old = Rate::model()->findByAttributes(array('bundleid' => $idn));
        $model = new Rate();

        $model->attributes = $old->attributes;
        $statustime = date('Y-m-d H:i:s');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Rate'])) {
            unset($model->rateid);
            $model->attributes = $_POST['Rate'];
            $entry = Service::model()->getEntrybyServiceId($model->serviceid);
            $model->entryid = $entry->serviceid;
            $model->statusid = 99;
            $model->statustime = $statustime;
            $model->ratedate = $statustime;
            $model->quantity_1 = 0;
            $model->quantity_2 = 0;
            $model->quantity_3 = 0;
            $model->quantity_4 = 0;
            $model->quantity_5 = 0;
            $model->quantity_6 = 0;
            $model->ppp_1 = 0;
            $model->ppp_2 = 0;
            $model->ppp_3 = 0;
            $model->ppp_4 = 0;
            $model->ppp_5 = 0;
            $model->ppp_6 = 0;
            $model->version = 0;
            $model->note = null;
            $model->odctime = null;
            $model->odptime = null;
            $model->quantityselect = 0;
            $model->formula = $old->formula;
            $model->send = 0;
            $model->insert();
            $parentrateid = $model->rateid;
            $model->parentrateid = $parentrateid;
            $model->save();
            $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . $id);
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionPdfhtml($id) {
        //$this->layout = '//layouts/blank';
        $nid = Utils::decrypt($id, 'rate');
        $model = $this->loadModel($nid);
        $get = $_GET;
        $checked = $get['id_pdf'];
        $bundle = array();
        foreach ($checked as $row => $r) {
            $bundle[] = $this->loadModel(Utils::decrypt($r, 'rate'));
        }
        $this->render('pdf/ratehtml', array('bundle' => $bundle, 'bundleid' => $model->bundleid));
    }

    public function actionTimeline($id) {
        $nid = Utils::decrypt($id, 'rate');
        $model = $this->loadModel($nid);
        $ratetracker = Ratetracker::model()->findAllByAttributes(array("rateid" => $model->rateid));
        $this->render('price/timeline', array('model' => $model, 'ratetracker' => $ratetracker));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Rate'])) {
            $model->attributes = $_POST['Rate'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->rateid));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {

            $this->loadModel($id)->delete();


            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionIndex() {
        $this->layout = false;
        $model = new Rate();
        $customerlist = CHtml::listData(Usercustomerpermission::model()->getCustomerbyUser(Yii::app()->user->userid, Yii::app()->user->companyid), 'customerid', 'customerdsc');
        $service = CHtml::listData(Service::model()->getEntryItem(Yii::app()->user->companyid, Yii::app()->user->userid), 'serviceid', 'servicedsc', 'entrydsc');

        if (isset($_GET['end'])) {
            $end = $_GET['end'];
        } else {
            $end = date('Y-m-d');
        }


        if (isset($_GET['start'])) {
            $start = $_GET['start'];
        } else {
            $start = date('Y-m-d', strtotime('-30 day', strtotime($end)));
        }

        $customer = (isset($_GET['customer'])) ? $_GET['customer'] : 0;

        $read = explode('_', $_GET['read']);
        $this->render('index', array(
            'model' => $model->getAllRates(), "customerlist" => $customerlist, "servicelist" => $service, 'start' => $start, 'end' => $end, 'customer' => $customer, "add" => $read[1], "edt" => $read[2], "del" => $read[3], "menu" => $read[0]
        ));
    }

    public function actionRate() {
        $this->layout = null;

        $rates = Rate::model()->searchRates2($_GET);


        echo json_encode($rates);
    }

    static function getDetail($rateid, $servicedsc, $note, $version) {
        $details = Rateitemdetailvalue::model()->getDetail($rateid);
        $detail = "<span style='font-size:8.5px;'>";
        foreach ($details as $row) {
            $detail.= "<b>" . $row->itemdetaildsc . ":</b>" . $row->itemdetailvaluedsc . ", ";
        }
        $detail .=" <b>Observaciones:</b> " . $note . "</span>";
        $detail = htmlspecialchars($detail);
        return '<i style="color:#0088CC; cursor:pointer;"  class="ratepop" data-placement="right" data-title="' . $servicedsc . '" data-content="' . $detail . '">' . $version . ' ' . $servicedsc . '</i>';
    }

    static function getDaysDetail($ratesupplierid, $price, $typ) {
        $details = Ratesupplier::model()->getRateSupplierid($ratesupplierid);

        $detail = "<span style='font-size:13px;' >";
        foreach ($details as $row) {
            switch ($typ) {
              
                case "1":
                    $detail.=$row->daysproduction1;
                    
                    //$detail.=$details->daysproduction1;
                    break;
                case "2":
                    $detail.=$row->daysproduction2;
                    //$detail.=$details->daysproduction1;
                    break;
                case "3":
                    $detail.=$row->daysproduction3;
                    //$detail.=$details->daysproduction1;
                    break;
                case "4":
                    $detail.=$row->daysproduction4;
                    //$detail.=$details->daysproduction1;
                    break;
                case "5":
                    $detail.=$row->daysproduction5;
                    //$detail.=$details->daysproduction1;
                    break;
                case "6":
                    $detail.=$row->daysproduction6;
                    //$detail.=$details->daysproduction1;
                    break;
            }
        }

        $detail = htmlspecialchars($detail);
        if($price==''){
            $price='0';
        }
        return '<i style="color:#0088CC; cursor:pointer;"  class="ratepop" data-placement="right" data-title="Dias de Produccion" data-content="' . $detail . '">' . $price . '</i>';
    }

    public function actionGetPromDetail($rateid, $typ) {
        $details = Ratesupplier::model()->quantityselectprod($rateid, $typ);

        $cadena = " ";
        foreach ($details as $row) {
            if ($row->quantity_ . $typ != 0) {
                $cadena = $row->quantity_ . $typ;
            }
        }
        $lista = explode('-', $cadena);
        for ($i = 0; $i < count($lista); $i++) {
            $suma = $suma + $lista[$i];
        }
        $suma = $suma / count($lista);
        return $suma;
    }

    static function getDaysDetails($ratesupplierid, $price, $typ) {
        $details = Ratesupplier::model()->getRateSupplierid($ratesupplierid);

        $detail = "<span style='font-size:13px;'>";
        foreach ($details as $row) {
            switch ($typ) {
                
                case "1":
                    $detail.=$row->daysproduction1;
                    //$detail.=$details->daysproduction1;
                    break;
                case "2":
                    $detail.=$row->daysproduction2;
                    //$detail.=$details->daysproduction1;
                    break;
                case "3":
                    $detail.=$row->daysproduction3;
                    //$detail.=$details->daysproduction1;
                    break;
                case "4":
                    $detail.=$row->daysproduction4;
                    //$detail.=$details->daysproduction1;
                    break;
                case "5":
                    $detail.=$row->daysproduction5;
                    //$detail.=$details->daysproduction1;
                    break;
                case "6":
                    $detail.=$row->daysproduction6;
                    //$detail.=$details->daysproduction1;
                    break;
            }
        }
         if($price==''){
            $price='0';
        }
        $detail = htmlspecialchars($detail);
        return '<i style="color:#0088CC; cursor:pointer;"  class="ratepop" data-placement="right" data-title="Dias de Produccion" data-content="' . $detail . '">' . $price . '</i>';
    }

    static function getDetaillite($rateid, $servicedsc, $note) {
        $details = Rateitemdetailvalue::model()->getDetail($rateid);
        $detail = "<b>" . $servicedsc . "</b><br /><p>";
        foreach ($details as $row) {
            $detail.= $row->itemdetaildsc . ":" . $row->itemdetailvaluedsc . "<br />";
        }
        $detail .=" <br>Observaciones: " . $note . "</p><br /><br /><br />";
        return $detail;
    }

    public function actionPrice() {
        $this->layout = false;
        $idold = $_GET['id'];
        $id = Utils::decrypt($_GET['id'], 'rate');

        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');

        $end = (isset($_GET['end'])) ? $_GET['end'] : date('Y-m-d');
        $start = (isset($_GET['start'])) ? $_GET['start'] : date('Y-m-d', strtotime('-30 day', strtotime($end)));


        $rates = $this->loadBundleModel($id);

        $ratescompleteddb = Rate::model()->getRatesCompleted($id);

        $manualratesupplier = new Ratesupplier();
        $service = CHtml::listData(Service::model()->getEntryItem(Yii::app()->user->companyid, Yii::app()->user->userid), 'serviceid', 'servicedsc', 'entrydsc');


        $bundleid = $id;
        $newitem = new Rate();
        $project = null;
        $items = array();
        $cont = 1;
        foreach ($rates as $row) {
            $customerid = $row->customerid;
            $customerdsc = $row->customerdsc;
            $branddsc = $row->branddsc;
            $project = $row->projectdsc;
            $items[$cont]['rate'] = $row;
            $items[$cont]['ratesuppliers'] = Ratesupplier::model()->getRateSupplier($row->rateid);
            $entry = Service::model()->getEntrybyServiceId($row->serviceid);
            $items[$cont]['entrydsc'] = $entry->servicedsc;
            $items[$cont]['entryid'] = $entry->serviceid;
            $cont++;
        }
        $ratescompleted = array();
        foreach ($ratescompleteddb as $row) {

            $ratescompleted[$row->entry][$row->servicedsc][$row->quantityselect] = array($row->quantityselect, $row->pprice, $row->iva);
        }



        $this->render('price/all', array(
            'model' => $items, 'start' => $start, 'end' => $end, 'customer' => $customer, 'ratescompleted' => $ratescompleted, 'newitem' => $newitem, 'servicelist' => $service, 'customerid' => $customerid, 'customer' => strtoupper($customerdsc), 'brand' => strtoupper($branddsc), 'project' => strtoupper($project), 'bundleid' => $bundleid, 'manualratesupplier' => $manualratesupplier, 'add' => $add, 'edt' => $edt, 'del' => $del, 'menu' => $menu
        ));
    }

    public function actionPrice2($id, $start, $end, $customer) {
        $this->layout = false;
        $idold = $_GET['id'];
        $id = Utils::decrypt($_GET['id'], 'rate');

        $start = Utils::decrypt($_GET['start'], 'rate');
        $end = Utils::decrypt($_GET['end'], 'rate');
        $customer = Utils::decrypt($_GET['customer'], 'rate');
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        $rates = $this->loadBundleModel($id);
        $ratescompleteddb = Rate::model()->getRatesCompleted($id);
        $manualratesupplier = new Ratesupplier();
        $service = CHtml::listData(Service::model()->getEntryItem(Yii::app()->user->companyid, Yii::app()->user->userid), 'serviceid', 'servicedsc', 'entrydsc');


        $newitem = new Rate();
        $project = null;
        $items = array();
        $cont = 1;
        foreach ($rates as $row) {
            $customerid = $row->customerid;
            $customerdsc = $row->customerdsc;
            $branddsc = $row->branddsc;
            $project = $row->projectdsc;
            $bundleid = $row->bundleid;
            $items[$cont]['rate'] = $row;
            $items[$cont]['ratesuppliers'] = Ratesupplier::model()->getRateSupplier($row->rateid);
            $entry = Service::model()->getEntrybyServiceId($row->serviceid);
            $items[$cont]['entrydsc'] = $entry->servicedsc;
            $items[$cont]['entryid'] = $entry->serviceid;

            $cont++;
        }
        $ratescompleted = array();
        foreach ($ratescompleteddb as $row) {

            $ratescompleted[$row->entry][$row->servicedsc][$row->quantityselect] = array($row->quantityselect, $row->pprice, $row->iva);
        }



        $this->render('price/all', array(
            'model' => $items, 'start' => $start, 'end' => $end, 'customer' => $customer, 'ratescompleted' => $ratescompleted, 'newitem' => $newitem, 'servicelist' => $service, 'customerid' => $customerid, 'customer' => strtoupper($customerdsc), 'brand' => strtoupper($branddsc), 'project' => strtoupper($project), 'bundleid' => $bundleid, 'manualratesupplier' => $manualratesupplier, 'add' => $add, 'edt' => $edt, 'del' => $del, 'menu' => $menu
        ));
    }

    public function actionSavePrice($id) {
        $nid = Utils::decrypt($id, 'rate');
        $model = $this->loadModel($nid);
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        $post = $_POST;

        if (!empty($post['percent'])) {
            foreach ($post['percent'] as $rsid => $percent) {
                $ratesupplier = $this->loadModelRateSupplier($rsid);
                $ratesupplier->percent = $percent;
                $ratesupplier->showtable = (isset($post['show'][$rsid])) ? 1 : 0;

                $ratesupplier->save();
            }

            $qx = $_POST['ppp'];
            $model->ppp_1 = $qx[1];
            $model->ppp_2 = $qx[2];
            $model->ppp_3 = $qx[3];
            $model->ppp_4 = $qx[4];
            $model->ppp_5 = $qx[5];
            $model->ppp_6 = $qx[6];
            $model->quantityselect = (isset($_POST['quantity_selected'])) ? $_POST['quantity_selected'] : 0;
            $model->pprice = $model->getprice();
            $model->save();
        }
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionFinalize($id) {
        $date = date('Y-m-d H:i:s');
        $nid = Utils::decrypt($id, 'rate');
        $model = $this->loadModel($nid);
        $rs = $this->loadModelRateSupplier($_GET['rs']);
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        $rss = Ratesupplier::model()->findAllByAttributes(array('rateid' => $nid, 'statusid' => 10));
        foreach ($rss as $row) {
            $row->statusid = ($row->showtable == 1) ? 12 : 13;
            $row->statustime = $date;
            $row->save();
        }

        $ratetracker = new Ratetracker();
        $ratetracker->rateid = $model->rateid;
        $ratetracker->statusid = 5;
        $ratetracker->statusdate = $date;
        $ratetracker->userid = Yii::app()->user->userid;
        $ratetracker->insert();
        $model->quantityselect = (isset($_GET['qx'])) ? $_GET['qx'] : 0;
        $model->statustime = $date;
        $model->statusid = 5;
        $model->save();

        $rs->statusid = 11;
        $rs->statustime = date('Y-m-d H:i:s');
        $rs->save();
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionCompletetopdf($id) {
        $date = date('Y-m-d H:i:s');
        $nid = Utils::decrypt($id, 'rate');
        $model = $this->loadModel($nid);
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        $model->complete = 1;
        $model->save();
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionRemovetopdf($id) {
        $date = date('Y-m-d H:i:s');
        $nid = Utils::decrypt($id, 'rate');
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        $model = $this->loadModel($nid);
        $model->complete = 0;
        $model->save();
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionSend($id) {
        $this->layout = false;
        $rateid = Utils::decrypt($_GET['id'], 'rate');
        $model = Rate::model()->findbyAttributes(array('rateid' => $rateid));
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        if ($model->statusid == 1) {
            $date = date('Y-m-d H:i:s');
            $ratetracker = new Ratetracker();
            $ratetracker->rateid = $model->rateid;
            $ratetracker->statusid = 100;
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();


            $model->statusid = 2;
            $model->statustime = $date;
            $model->update();

            $ratesuppliers = Ratesupplier::model()->findAllByAttributes(array('rateid' => $model->rateid));
            $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
            $message = messages::getMessagesSupplierSend($rateid, $supplier->supplier->corporatename);

            foreach ($ratesuppliers as $supplier) {
                $mrsupplier = Ratesupplier::model()->findByPk($supplier->ratesupplierid);
                $mrsupplier->statusid = 7;
                $mrsupplier->update();
                $array = array();
                $supplierlist = Supplier::model()->findByPk($supplier->supplierid);
                $mailer->Host = 'mail.portoprint.mx';
                $mailer->IsSMTP();
                $mailer->Port = 587;
                $mailer->SMTPSecure = 'tls';
                $mailer->SMTPAuth = true;
                $mailer->Username = "sistema@portoprint.mx";
                $mailer->Password = "portoprint";
                $mailer->From = 'sistema@portoprint.mx';
                $mailer->AddReplyTo('sistema@portoprint.mx');
                $mailer->AddAddress('info@portoprint.mx');
                $lisupplieruser = Supplieruser::model()->findAllByAttributes(array('supplierid' => $supplier->supplierid));
                foreach ($lisupplieruser as $val) {
                    if ($val->email != '') {
                        if (!in_array($val->email, $array)) {
                            $array[] = $val->email;
                            $mailer->AddAddress($val->email);
                        }
                    }
                }

                if ($supplierlist->email != '') {

                    if (!in_array($supplierlist->email, $array)) {
                        $array[] = $supplierlist->email;
                        $mailer->AddAddress($supplierlist->email);
                    }
                }
                if ($supplierlist->email2 != '') {

                    if (!in_array($supplierlist->email2, $array)) {
                        $array[] = $supplierlist->email2;
                        $mailer->AddAddress($supplierlist->email2);
                    }
                }
                if ($supplierlist->email3 != '') {

                    if (!in_array($supplierlist->email3, $array)) {
                        $array[] = $supplierlist->email3;
                        $mailer->AddAddress($supplierlist->email3);
                    }
                }
                
                $mailer->FromName = 'Administrador de Smart Print Software Portoprint';
                $mailer->CharSet = 'UTF-8';
                $mailer->Subject = 'Solicitud de Cotización';
                $mailer->Body = $message;
                $mailer->IsHTML(true);

                
                
            }
            if(count($array)!=0){

                    $mailer->Send();
                }


        }

        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionComplete($id) {
        $nid = Utils::decrypt($id, 'rate');
        $model = $this->loadModel($nid);
        $contactsdb = Customercontact::model()->getCompleteName($model->customerid);
        $contacts = CHtml::listData($contactsdb, 'contactid', 'name');
        if (isset($_POST['Rate'])) {

            $ca = $_POST['ca'];
            $statustime = date('Y-m-d H:i:s');
            $model->attributes = $_POST['Rate'];
            $model->statusid = 1;
            $model->statustime = $statustime;
            $model->ratedate = $statustime;
            $model->quantity_1 = $ca[1];
            $model->quantity_2 = (isset($ca[2])) ? $ca[2] : 0;
            $model->quantity_3 = (isset($ca[3])) ? $ca[3] : 0;
            $model->quantity_4 = (isset($ca[4])) ? $ca[4] : 0;
            $model->quantity_5 = (isset($ca[5])) ? $ca[5] : 0;
            $model->quantity_6 = (isset($ca[6])) ? $ca[6] : 0;

            if ($model->save()) {

                $ratesupplier = (isset($_POST['RateSupplier'])) ? $_POST['RateSupplier'] : array();
                foreach ($ratesupplier as $rs) {
                    $rsupplier = new Ratesupplier();
                    $rsupplier->rateid = $model->rateid;
                    $rsupplier->supplierid = $rs;
                    $rsupplier->statusid = 6;
                    $rsupplier->statustime = $statustime;
                    $rsupplier->save();
                }
                $rateitemdetailvalue = (isset($_POST['Rateitemdetailvalue'])) ? $_POST['Rateitemdetailvalue'] : array();
                foreach ($rateitemdetailvalue as $ri) {
                    $ritemdetailvalue = new Rateitemdetailvalue();
                    $ritemdetailvalue->rateid = $model->rateid;
                    $ritemdetailvalue->itemdetailvalueid = $ri;
                    $ritemdetailvalue->active = 1;
                    $ritemdetailvalue->insert();
                }
                $ratetracker = new Ratetracker();
                $ratetracker->rateid = $model->rateid;
                $ratetracker->statusid = 2;
                $ratetracker->statusdate = $statustime;
                $ratetracker->userid = Yii::app()->user->userid;
                $ratetracker->insert();

                $this->redirect(array('price', 'id' => Utils::encrypt($model->bundleid, 'rate')));
            }
        }

        $this->render('complete', array(
            'model' => $model, 'contacts' => $contacts
        ));
    }

    public function actionSavemanualprice($id) {
        $nid = Utils::decrypt($id, 'rate');
        $rate = $this->loadModel($nid);
        $model = new Ratesupplier();
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');

        if (isset($_POST['Ratesupplier'])) {

            // print_r($_POST['Ratesupplier']);
            $statustime = date('Y-m-d H:i:s');
            $model->rateid = $rate->rateid;
            $model->attributes = $_POST['Ratesupplier'];
            $model->statusid = 10;
            $model->statustime = $statustime;
            $model->active = 1;
            $model->daysproduction1 = $_POST['Ratesupplier'][daysproduction1];
            $model->daysproduction2 = $_POST['Ratesupplier'][daysproduction2];
            $model->daysproduction3 = $_POST['Ratesupplier'][daysproduction3];
            $model->daysproduction4 = $_POST['Ratesupplier'][daysproduction4];
            $model->daysproduction5 = $_POST['Ratesupplier'][daysproduction5];
            $model->daysproduction6 = $_POST['Ratesupplier'][daysproduction6];
            //print_r($model->attributes);

            $supplier = Ratesupplier::model()->findByAttributes(array('rateid' => $rate->rateid, 'supplierid' => $model->supplierid));
            if ($supplier === null)
                $model->insert();
        }
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($rate->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionExtend($id) {
        $model = $this->loadModel(Utils::decrypt($id, 'rate'));
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        if ($model->statusid == 2 || $model->statusid == 3 || $model->statusid == 4) {
            $date = date('Y-m-d H:i:s');
            $ratetracker = new Ratetracker();
            $ratetracker->rateid = $model->rateid;
            $ratetracker->statusid = 2;
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();

            $model->statusid = 4;
            $model->statustime = $date;
            $model->update();
        } else
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionRequote($id) {
        $old = $this->loadModel(Utils::decrypt($_GET['id'], 'rate'));
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        if ($old->statusid == 5) {
            $date = date('Y-m-d H:i:s');
            $ratetracker = new Ratetracker();
            $ratetracker->rateid = $old->rateid;
            $ratetracker->statusid = 35;
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();

            $old->statusid = 35;
            $old->statustime = $date;
            $old->active = 0;
            $old->update();
            $model = new Rate();
            $model->attributes = $old->attributes;
            $model->entryid = $old->entryid;
            $model->statusid = 101;
            $model->statustime = $date;
            $model->parentrateid = $old->rateid;
            $model->ratedate = $date;
            $model->quantity_1 = $old->quantity_1;
            $model->quantity_2 = $old->quantity_2;
            $model->quantity_3 = $old->quantity_3;
            $model->quantity_4 = $old->quantity_4;
            ;
            $model->quantity_5 = $old->quantity_5;
            $model->quantity_6 = $old->quantity_6;
            $model->ppp_1 = 0;
            $model->ppp_2 = 0;
            $model->ppp_3 = 0;
            $model->ppp_4 = 0;
            $model->ppp_5 = 0;
            $model->ppp_6 = 0;
            $model->version = ($old->version == 0) ? 2 : $old->version + 1;
            $model->odctime = null;
            $model->odptime = null;
            $model->quantityselect = $old->quantity_1;
            $model->formula = $old->formula;
            $model->send = 0;
            $model->active = 1;
            $model->formula = $old->formula;
            $model->insert();

            $rateart = new Rateart();
            $rateart->rateid = $model->rateid;
            $rateart->insert();

            $ratecolor = new Ratecolortest();
            $ratecolor->rateid = $model->rateid;

            $ratecolor->insert();

            $ratezero = new Ratezerotest();
            $ratezero->rateid = $model->rateid;
            $ratezero->insert();

            $rateproduction = new Rateproduction();
            $rateproduction->rateid = $model->rateid;
            $rateproduction->insert();

            Yii::app()->db->createCommand('insert into rateitemdetailvalue select null, ridt.rateid, ridt.itemdetailvalueid, 1 from rateitemdetailvalue ridt where ridt.rateid = ' . $model->rateid)->query();


            //Rate::model()->duplicate($old->rateid, $model->rateid);
        } else
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($old->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionGenerateODC($id) {
        $nid = Utils::decrypt($id, 'rate');
        $rate = $this->loadModel($nid);
        $rs = Ratesupplier::model()->findByAttributes(array('rateid' => $rate->rateid, 'statusid' => 11));
        $rateodc = new Rateodc();
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');

        if (isset($_POST['ivaodc']) && isset($_POST['nodcc']) && isset($_POST['fodcc'])) {
            $date = date('Y-m-d H:i:s');
            $testr = $rate->getquantityselected();
            $rate->odctime = date('Y-m-d H:i:s');
            $rate->save();
            $rateodc->rateid = $rate->rateid;
            $rateodc->supplierid = $rs->supplierid;
            $rateodc->statusid = 16;
            $rateodc->statustime = $date;
            $rateodc->quantityselect = $rate->quantityselect;
            $rateodc->price = $rs->$testr;
            $rateodc->odcc = $_POST['nodcc'];
            $rateodc->odccdate = $_POST['fodcc'];
            $rateodc->iva = $_POST['ivaodc'];
            $rateodc->save();


            $ratetracker = new Ratetracker();
            $ratetracker->rateid = $rate->rateid;
            $ratetracker->statusid = 16;
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();
        }
        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($rate->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionGenerateODC1() {
        $nid = Utils::decrypt($_POST['id'], 'rate');
        $model = $this->loadModel($nid);
        //$rate=$this->loadModel($nid);

        $rateodc = new Rateodc();
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        $rssa = $_POST['rs'];
        $qx = $_POST['qx'];

        $date = date('Y-m-d H:i:s');


        $rss = Ratesupplier::model()->findAllByAttributes(array('rateid' => $nid, 'statusid' => 10));
        foreach ($rss as $row) {
            $row->statusid = ($row->showtable == 1) ? 12 : 13;
            $row->statustime = $date;
            $row->save();
        }

        $rs = $this->loadModelRateSupplier($rssa);
        $model->quantityselect = (isset($qx)) ? $qx : 0;
        $model->statustime = $date;
        $model->statusid = 5;
        $model->save();

        $rs->statusid = 11;
        $rs->statustime = date('Y-m-d H:i:s');
        $rs->update();


        $rs1 = Ratesupplier::model()->findByAttributes(array('rateid' => $model->rateid, 'statusid' => 11));
        //  if (isset($_POST['ivaodc']) && isset($_POST['nodcc']) && isset($_POST['fodcc'])) {
        $date = date('Y-m-d H:i:s');
        $testr = $model->getquantityselected();
        $model->odctime = date('Y-m-d H:i:s');

        $model->save();

        $rateodc->rateid = $model->rateid;
        $rateodc->supplierid = $rs->supplierid;
        $rateodc->statusid = 16;
        $rateodc->statustime = $date;
        $rateodc->active = 1;
        $rateodc->quantityselect = $model->quantityselect;
        $rateodc->price = $rs1->$testr;
        $rateodc->odcc = $_POST['nodcc'];
        $rateodc->odccdate = $_POST['fodcc'];
        $rateodc->iva = $_POST['ivaodc'];
        //  echo $model->rateid.' - '.$rs->supplierid.' - '. $date.' - '.$model->quantityselect. ' - '.$rs1->$testr;
        if ($rateodc->insert()) {


            $ratetracker = new Ratetracker();
            $ratetracker->rateid = $model->rateid;
            $ratetracker->statusid = 16;
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();
            echo '1';
        } else {
            echo '0';
        }

        // } else {
        //   echo '0';
        // }
        //$this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/'.Utils::encrypt($rate->bundleid,'rate').'/add/'.Utils::encrypt($add,'rate').'/edt/'.Utils::encrypt($edt,'rate').'/del/'.Utils::encrypt($del,'rate').'/menu/'. Utils::encrypt($menu,'rate'));	
    }

    public function actionGenerateODP($id) {
        $nid = Utils::decrypt($id, 'rate');
        $date = date('Y-m-d H:i:s');
        $rate = $this->loadModel($nid);
        $rs = Ratesupplier::model()->findByAttributes(array('rateid' => $rate->rateid, 'statusid' => 11));
        $rateodp = new Rateodp();
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');

        $testr = $rate->getquantityselected();
        $rate->odptime = date('Y-m-d H:i:s');
        $rate->save();
        
        $rateodp->rateid = $rate->rateid;
        $rateodp->supplierid = $rs->supplierid;
        $rateodp->statusid = 14;
        $rateodp->statustime = $date;
        $rateodp->statuscustomerid = 67;
        $rateodp->statuscustomertime = $date;
        $rateodp->quantityselect = $rate->quantityselect;
        $rateodp->price = $rs->$testr;
        $rateodp->save();

        $ratetracker = new Ratetracker();
        $ratetracker->rateid = $rate->rateid;
        $ratetracker->statusid = 67;
        $ratetracker->statusdate = $date;
        $ratetracker->userid = Yii::app()->user->userid;
        $ratetracker->insert();

        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($rate->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionGenerateODP1() {
        $nid = Utils::decrypt($_POST['id'], 'rate');
        $date = date('Y-m-d H:i:s');
        $rate = $this->loadModel($nid);
        $rs = Ratesupplier::model()->findByAttributes(array('rateid' => $rate->rateid, 'statusid' => 11));
        $rateodp = new Rateodp();
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        $rssa = $_POST['rs'];
        $qx = $_POST['qx'];

        $rss = Ratesupplier::model()->findAllByAttributes(array('rateid' => $nid, 'statusid' => 10));
        foreach ($rss as $row) {
            $row->statusid = ($row->showtable == 1) ? 12 : 13;
            $row->statustime = $date;
            $row->save();
        }

        $rs = $this->loadModelRateSupplier($rssa);
        $rate->quantityselect = (isset($qx)) ? $qx : 0;
        $rate->statustime = $date;
        $rate->statusid = 5;
        $rate->save();

        $rs->statusid = 11;
        $rs->statustime = date('Y-m-d H:i:s');
        $rs->save();


        $testr = $rate->getquantityselected();
        $rate->odptime = date('Y-m-d H:i:s');
        $rate->save();
        $rateodp->rateid = $rate->rateid;
        $rateodp->supplierid = $rs->supplierid;
        $rateodp->statusid = 14;
        $rateodp->statustime = $date;
        $rateodp->statuscustomerid = 67;
        $rateodp->statuscustomertime = $date;
        $rateodp->quantityselect = $rate->quantityselect;
        $rateodp->price = $rs->$testr;
        $rateodp->save();

        $ratetracker = new Ratetracker();
        $ratetracker->rateid = $rate->rateid;
        $ratetracker->statusid = 67;
        $ratetracker->statusdate = $date;
        $ratetracker->userid = Yii::app()->user->userid;
        if ($ratetracker->insert()) {
            echo "1";
        }
        //$this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/'.Utils::encrypt($rate->bundleid,'rate').'/add/'.Utils::encrypt($add,'rate').'/edt/'.Utils::encrypt($edt,'rate').'/del/'.Utils::encrypt($del,'rate').'/menu/'. Utils::encrypt($menu,'rate'));	
    }

    public function actionStatusproduction($id) {
        $this->layout = false;
        $nid = Utils::decrypt($id, 'odp');
        $date = date('Y-m-d H:i:s');
        $odp = $this->loadModelRateodp($nid);
        $odp->statuscustomerid = $_POST['value'];
        $odp->statuscustomertime = $date;
        $odp->save();

        $ratetracker = new Ratetracker();
        $ratetracker->rateid = $odp->rateid;
        $ratetracker->statusid = $_POST['value'];
        $ratetracker->statusdate = $date;
        $ratetracker->userid = Yii::app()->user->userid;
        $ratetracker->insert();
    }

    public function actionStatusproduction_1() {
        $this->layout = false;
        $nid = $_POST['id'];
        $valu= $_POST['value'];
        $date = date('Y-m-d H:i:s');
        $odp = new HistProduction();
        $servicedsc = Rate::model()->getserviceid($nid);

        if ($servicedsc == 'PRINT') {
            $estatusdb = 1;
        }
        if ($servicedsc == 'DISPLAYS') {
            $estatusdb = 3;
        }
        if ($servicedsc == 'PROMOCIONALES') {
            $estatusdb = 2;
        }

        $ratetracker = new Ratetracker();
        $ratetracker->rateid = $nid;
        $ratetracker->statusid = $_POST['value'];
        $ratetracker->statusdate = $date;
        $ratetracker->ratefilter = '1';
        $ratetracker->userid = Yii::app()->user->userid;
        $ratetracker->insert();

        $odp->rateid = $nid;
        $odp->type = $estatusdb;
        $odp->status_productionid = $_POST['value'];
        $odp->ratetrackerid = $ratetracker->ratetrackerid;
        $odp->insert();

        
       // $statusodp = StatusProduction::model()->findByAttributes(array('status_productionid'=>$odp->status_productionid));
         $comprobar= StatusProduction::model()->findByAttributes(array("status_productionid"=>$valu));
        if($comprobar->status_productionporcent=='C'){
          
            
            $bodp=  Rateodp::model()->findByAttributes(array("rateid"=>$nid));
            $bodc= Rateodc::model()->findByAttributes(array("rateid"=>$nid));
            
            if(count($bodc)!=0){
                $bodc1=Rateodc::model()->findByPk($bodc->rateodcid);
                $bodc1->active=0;
                $bodc1->update();
            }
            if(count($bodp)!=0){ 
                $bodp1=Rateodp::model()->findByPk($bodp->rateodpid);
                $bodp1->active=0;
            $bodp1->update();
            }
            $rs = Ratesupplier::model()->findAllByAttributes(array('rateid' => $nid));
            foreach($rs as $valor){
                if($valor->statusid!=7 && $valor->statusid!=9 ){
                    $rsvolar=  Ratesupplier::model()->findByPk($valor->ratesupplierid);
                     $rsvolar->statusid=10;
                     $rsvolar->update();
                
                }
                  
              }
             
            $seahist=  HistProduction::model()->findAllByAttributes(array("rateid"=>$nid));
            
            if(count($seahist)!=0){
                foreach($seahist as $valor){
                    $odp1 = HistProduction::model()->findByPk($valor->hist_productionid);
                    $odp1->delete();
                }
                   
            }
            
            $chanc_stat=  Rate::model()->findByPk($nid);
            $chanc_stat->statusid=2;
            $chanc_stat->odptime=null;
            $chanc_stat->odctime=null;
            $chanc_stat->update();
            echo 're';
        
          
         }else if ($comprobar->status_productionporcent=='0'){

            echo 're';
        } else {
            echo $comprobar->status_productiondsc;
        }
    }

    public function actionProbability($id) {
        $this->layout = false;
        $nid = Utils::decrypt($id, 'rate');
        $rate = $this->loadModel($nid);
        $rate->probability = $_POST['value'];
        $rate->save();
    }

    public function actionSelsuppliers($id) {
        $date = date('Y-m-d H:i:s');
        $nid = Utils::decrypt($id, 'rate');
        $model = $this->loadModel($nid);
        $post = $_POST['Rate_supplier'];
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        if ($post != null) {
            foreach ($post as $rs) {
                $rsupplier = new Ratesupplier();
                $rsupplier->rateid = $model->rateid;
                $rsupplier->supplierid = $rs;
                $rsupplier->statusid = 6;
                $rsupplier->statustime = $date;
                $rsupplier->save();
                $model->statusid = 1;
                $model->statustime = $date;
                $model->save();
            }
            $ratetracker = new Ratetracker();
            $ratetracker->rateid = $model->rateid;
            $ratetracker->statusid = 100;
            $ratetracker->statusdate = $date;
            $ratetracker->userid = Yii::app()->user->userid;
            $ratetracker->insert();
        }

        $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
    }

    public function actionSearch() {
        $this->layout = false;
        $model = new Rate();
        $supplys = new Supplier();
        $supplyslist = $supplys->findAllByAttributes(array("companyid" => Yii::app()->user->companyid));
        // $supplys=  CHtml::::listData(Supplier::model()->findAllByAttributes(array("companyid"=> Yii::app()->user->companyid)));
        $customerlist = CHtml::listData(Usercustomerpermission::model()->getCustomerbyUser(Yii::app()->user->userid, Yii::app()->user->companyid), 'customerid', 'customerdsc');
        $service = CHtml::listData(Service::model()->getEntryItem(Yii::app()->user->companyid, Yii::app()->user->userid), 'serviceid', 'servicedsc', 'entrydsc');

        $this->render('search2', array(
            'model' => $model, 'customerlist' => $customerlist, 'servicelist' => $service, 'supplylist' => $supplyslist
        ));
    }

    public function actionSearchfilters() {
        $serviceid = $_GET['id'];
        $detail = Servicedetail::model()->getDetailByServiceid($serviceid);
        $rw = 1;
        $close = true;

        foreach ($detail as $row) {
            $close = false;
            $detailvalue = Itemdetailvalue::model()->findAllbyAttributes(array('itemdetailid' => $row->itemdetailid));
            $multiple = ($row->selecttype == 1) ? " multiple size='3' " : "";

            echo '<li>' . $row->itemdetaildsc . '<br />';
            echo '<select style="width: 250px;" id="itemdetail_' . $row->itemdetailid . '" name="Rateitemdetailvalue[]" data-placeholder="Seleccione"  class="sresult select2" ' . $multiple . ' >';
            echo '<option value="0"  >Todos</option>';
            foreach ($detailvalue as $value) {
                echo '<option value="' . $value->itemdetailvalueid . '" >' . $value->itemdetailvaluedsc . '</option>';
            }
            echo '</select></li>';
        }
    }

    public function actionSearchResults() {
        $serviceid = $_GET['id'];
        $sdetailv = explode(",", $_GET['sdetailv']);

        $detail = Rateodc::model()->getSearch($serviceid, $sdetailv);

        foreach ($detail as $row) {
            if (Yii::app()->user->specialpermission == 1) {
                echo '<tr><td>' . $row->bundleid . '</td><td>' . RateController::getDetail($row->rateid, $row->servicedsc, $row->note, "") . '</td><td>' . $row->customerdsc . '</td><td>' . $row->supplierdsc . '</td><td>' . $row->dateodc . '</td><td>' . $row->quantityselect . '</td><td>' . round($row->price, 2) . '</td><td>' . round($row->sellprice, 2) . '</td></tr>';
            } else {

                echo '<tr><td>' . $row->bundleid . '</td><td>' . RateController::getDetail($row->rateid, $row->servicedsc, $row->note, "") . '</td><td>' . $row->customerdsc . '</td><td>' . $row->supplierdsc . '</td><td>' . $row->dateodc . '</td><td>' . $row->quantityselect . '</td><td>' . round($row->sellprice, 2) . '</td></tr>';
            }
        }
        //echo RateController::getDetail($row->rateid,$row->servicedsc,$row->note, "")
    }

    public function actionSearchResults2() {
        $serviceid = $_GET['id'];
        if ($_GET['sdetailv'] != -1) {
            $sdetailv = explode(",", $_GET['sdetailv']);
        } else {
            $sdetailv = -1;
        }
        $customerid = $_GET['customerid'];

        $detail = Rateodc::model()->getSearch_custom($serviceid, $sdetailv, $customerid);

        foreach ($detail as $row) {
            if (Yii::app()->user->specialpermission == 1) {
                echo '<tr><td>' . $row->bundleid . '</td><td>' . $row->rateid . '</td><td>' . $row->customerdsc . '</td><td>' . $row->supplierdsc . '</td><td>' . $row->dateodc . '</td><td>' . $row->quantityselect . '</td><td>' . round($row->price, 2) . '</td><td>' . round($row->sellprice, 2) . '</td></tr>';
            } else {
                echo '<tr><td>' . $row->bundleid . '</td><td>' . $row->rateid . '</td><td>' . $row->customerdsc . '</td><td>' . $row->supplierdsc . '</td><td>' . $row->dateodc . '</td><td>' . $row->quantityselect . '</td><td>' . round($row->sellprice, 2) . '</td></tr>';
            }
        }
    }

    public function actionSearchResults3() {
        $serviceid = $_GET['id'];
        if ($_GET['sdetailv'] != -1) {
            $sdetailv = explode(",", $_GET['sdetailv']);
        } else {
            $sdetailv = -1;
        }
        $customerid = $_GET['customerid'];
        $supplierid = $_GET['supplierid'];

        $detail = Rateodc::model()->getSearch_supp($serviceid, $sdetailv, $customerid, $supplierid);

        foreach ($detail as $row) {
            if (Yii::app()->user->specialpermission == 1) {
                echo '<tr><td>' . $row->bundleid . '</td><td>' . $row->rateid . '</td><td>' . $row->customerdsc . '</td><td>' . $row->supplierdsc . '</td><td>' . $row->dateodc . '</td><td>' . $row->quantityselect . '</td><td>' . round($row->price, 2) . '</td><td>' . round($row->sellprice, 2) . '</td></tr>';
            } else {
                echo '<tr><td>' . $row->bundleid . '</td><td>' . $row->rateid . '</td><td>' . $row->customerdsc . '</td><td>' . $row->supplierdsc . '</td><td>' . $row->dateodc . '</td><td>' . $row->quantityselect . '</td><td>' . round($row->sellprice, 2) . '</td></tr>';
            }
        }
    }

    public function actionSearchResults4() {
        $serviceid = $_GET['id'];
        if ($_GET['sdetailv'] != -1) {
            $sdetailv = explode(",", $_GET['sdetailv']);
        } else {
            $sdetailv = -1;
        }
        $customerid = $_GET['customerid'];
        $supplierid = $_GET['supplierid'];
        $min = $_GET['min'];
        $max = $_GET['max'];

        $detail = Rateodc::model()->getSearch_cuncos($serviceid, $sdetailv, $customerid, $supplierid, $min, $max);

        foreach ($detail as $row) {
            if (Yii::app()->user->specialpermission == 1) {
                echo '<tr><td>' . $row->bundleid . '</td><td>' . $row->rateid . '</td><td>' . $row->customerdsc . '</td><td>' . $row->supplierdsc . '</td><td>' . $row->dateodc . '</td><td>' . $row->quantityselect . '</td><td>' . round($row->price, 2) . '</td><td>' . round($row->sellprice, 2) . '</td></tr>';
            } else {
                echo '<tr><td>' . $row->bundleid . '</td><td>' . $row->rateid . '</td><td>' . $row->customerdsc . '</td><td>' . $row->supplierdsc . '</td><td>' . $row->dateodc . '</td><td>' . $row->quantityselect . '</td><td>' . round($row->sellprice, 2) . '</td></tr>';
            }
        }
    }

    public function actionSavePortoprintInvoice($id) {
        $total = (($_POST['amout'] * $_POST['impuestoivatax'] / 100) + $_POST['amout']);
        $invoice = new Rateportoprintinvoice();
        #unset($_POST['date_send_revision'],$_POST['estimateddate'],$_POST['GR'],$_POST['realDate']);
        var_dump($_POST);
        exit();
        $_POST['total'] = $total;
        $_POST['rateid'] = Utils::decrypt($id, 'rate');
        $invoice->attributes = $_POST;
        $resut = array('status' => $invoice->save());
        echo json_encode($resut);
    }

    public function actionSaveSupplierInvoice($id) {
        $total = (($_POST['amout'] * $_POST['impuestoivatax'] / 100) + $_POST['amout']);
        $invoice = new Rateportoprintinvoice();
        #unset($_POST['date_send_revision'],$_POST['estimateddate'],$_POST['GR'],$_POST['realDate']);
        var_dump($_POST);
        exit();
        $_POST['total'] = $total;
        $_POST['rateid'] = Utils::decrypt($id, 'rate');
        $invoice->attributes = $_POST;
        $resut = array('status' => $invoice->save());
        echo json_encode($resut);
    }

    public static function idVersion($parentrateid, $version) {
        $txt = $parentrateid;
        if ($version != 0)
            $txt .= ' - ' . $version;
        return $txt;
    }

    public function loadModel($id) {
        $model = Rate::model()->modelByUser($id, Yii::app()->user->userid);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadBundleModel($id) {
        $model = Rate::model()->bundleByUser($id, Yii::app()->user->userid);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelCustomerByProject($id) {
        $project = Project::model()->modelByUser($id, Yii::app()->user->userid);
        $model = Customer::model()->findByPk($project->customerid);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelRateSupplier($id) {
        $model = Ratesupplier::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelRateodp($id) {
        $model = Rateodp::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'rate-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSaverating() {
        $calificaciones = explode(',', $_POST['calificaciones']);

        $model = new Evaluation();

        $model->rateid = $_POST['rateid'];
        $model->supplierid = $_POST['supplierid'];
        $model->cotizacion = $calificaciones[0];
        $model->resolucionproblemas = $calificaciones[1];
        $model->impresion = $calificaciones[2];
        $model->acabados = $calificaciones[3];
        $model->empaque = $calificaciones[4];
        $model->distribucion = $calificaciones[5];
        $model->cumplimiento = $calificaciones[6];
        $model->enviodocumentacion = $calificaciones[7];
        $model->enviomuestras = $calificaciones[8];
        $model->comunicacion = $calificaciones[9];
        $model->disponibilidad = $calificaciones[10];
        $model->status = $calificaciones[11];
        $model->promedioservicio = $_POST['promedio'];
        $model->cantidad = $_POST['cantidad'];
        $model->fecha = date('Y-m-d H:i:s');

        if ($model->insert()) {
            echo '<tr role="row" class="tdr">'
            . '<td style="text-align: left; cursor: pointer;" class="sorting_1">' . $model->evaluationid . '</td>'
            . '<td style="text-align: left;">' . $model->fecha . '</td>'
            . '<td style="text-align: center; cursor: pointer;">' . $model->promedioservicio . '</td>'
            . '<td style="text-align: center; cursor: pointer;">' . $model->cantidad . '</td>'
            . '</tr>|' . $model->evaluationid . '|' . $model->cantidad;
        } else {
            echo 0;
        }

        /* $model=new Ratesupplier();

          $statustime = date('Y-m-d H:i:s');
          $model->rateid = $rate->rateid;
          $model->attributes=$_POST['Ratesupplier'];
          $model->statusid = 10;
          $model->statustime = $statustime;
          $model->active = 1;
          $model->daysproduction1=$_POST['Ratesupplier'][daysproduction1];
          $model->daysproduction2=$_POST['Ratesupplier'][daysproduction2];
          $model->daysproduction3=$_POST['Ratesupplier'][daysproduction3];
          $model->daysproduction4=$_POST['Ratesupplier'][daysproduction4];
          $model->daysproduction5=$_POST['Ratesupplier'][daysproduction5];
          $model->daysproduction6=$_POST['Ratesupplier'][daysproduction6];


          $supplier = Ratesupplier::model()->findByAttributes(array('rateid'=>$rate->rateid,'supplierid'=>$model->supplierid));
          if($supplier===null)
          $model->insert();


          $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/'.Utils::encrypt($rate->bundleid,'rate') ); */
    }

    public function actionSendrating() {
        $this->layout = false;
        /* $model = $this->loadModel(Utils::decrypt($id,'rate'));

          if($model->statusid==1){
          $date = date('Y-m-d H:i:s');
          $ratetracker = new Ratetracker();
          $ratetracker->rateid = $model->rateid;
          $ratetracker->statusid = 2;
          $ratetracker->statusdate = $date;
          $ratetracker->userid = Yii::app()->user->userid;
          $ratetracker->insert();
          //print_r($ratetracker->attributes);
          $ratesuppliers = Ratesupplier::model()->findAllByAttributes(array('rateid'=>$model->rateid));
          $model->statusid = 2;
          $model->statustime = $date;
          //print_r($model->attributes);
          $model->update(); */


        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');



        $message = messages::getMessagerating($_POST['bundleid'], $_POST['userid'], $_POST['rateid'], $_POST['evaluationid'], $_POST['cantidad']);
        $mailer->Host = 'mail.portoprint.mx';
        $mailer->IsSMTP();
        $mailer->Port = 587;
        //$mailer->SMTPSecure = 'tls';
        $mailer->SMTPAuth = true;
        $mailer->Username = "sistema@portoprint.mx";
        $mailer->Password = "portoprint";
        $mailer->From = 'sistema@portoprint.mx';
        $mailer->AddReplyTo('sistema@portoprint.mx');
        $mailer->AddAddress('rmoreno@portoprint.mx');
        //$mailer->AddAddress($supplier->supplier->email);
        $mailer->FromName = 'Administrador de Smart Print Software Portoprint';
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = 'Número de confirmación ';
        $mailer->Body = $message;
        $mailer->IsHTML(true);
        $mailer->Send();
        /* if($mailer->Send()){
          echo 1;
          }
          else{
          echo 0;
          } */
    }

    public function actionGetrating() {
        $rating = Evaluation::model()->findAllByAttributes(array('rateid' => $_GET['rateid']));
        $cont = 0;

        foreach ($rating as $row) {

            $output[$cont]['id'] = $row->evaluationid;
            $output[$cont]['fc'] = $row->fecha;
            $output[$cont]['pr'] = $row->promedioservicio;
            $output[$cont]['ca'] = $row->cantidad;

            $cont++;
        }
        $output = array('aaData' => $output);
        echo json_encode($output);
    }

    public function actionGetlistfiles() {

        $files = new Ratefile();


        $rating = $files->recoverFile($_POST['rateid']);
        $cont = 0;

        $cadena = ' ';
        foreach ($rating as $value) {
            if ($cadena == ' ') {
                $cadena = "<tr><td>" . $value['name'] . "</td><td><div class='btn-group btn-group-xs '><a class='btn btn-primary' id='send_fil_down' target='_blank' href=' " . $value['path'] . "'  ><i class='glyphicon glyphicon-download'></i>&nbsp;Descargar</a></div></td></tr>";
            } else {
                $cadena.="<tr><td>" . $value['name'] . "</td><td><div class='btn-group btn-group-xs '><a class='btn btn-primary' id='send_fil_down' target='_blank' href=' " . $value['path'] . "'  ><i class='glyphicon glyphicon-download'></i>&nbsp;Descargar</a></div></td></tr>";
            }
        }
        echo $cadena;
    }

    public function actionCreateproduccionregis() {
        $this->layout = false;
        //print_r($_POST['arrai']); 
        $customsleg = new Rateproduction();


        foreach ($_POST['arrai'] as $valor => $descripcion) {
            $customsleg->$valor = $descripcion;
        }

        if ($customsleg->insert()) {
            echo $customsleg->rateproductionid;
        } else {
            echo "0";
        }
    }

    public function actionUpdateproduccionregis() {
        $this->layout = false;
        $rateproductionid = $_POST['arrai']['rateproductionid'];
        $customsleg = Rateproduction::model()->findByPk($rateproductionid);


        foreach ($_POST['arrai'] as $valor => $descripcion) {
            if ($valor != 'rateproductionid') {
                $customsleg->$valor = $descripcion;
            }
        }

        if ($customsleg->update()) {
            echo $customsleg->rateproductionid;
        } else {
            echo "0";
        }
    }

    public function actionListaproducc() {
        $this->layout = false;
        //print_r($_POST['arrai']); 
        $rateproductionid = $_POST['rateproductionid'];
        $model = Rateproduction::model()->findByPk($rateproductionid);

        foreach ($model as $valor => $descripcion) {
            $output[$valor] = $descripcion;
        }

        echo json_encode($output);
    }

    public function actionCreateartregis() {
        $this->layout = false;

        $customsleg = new Rateart();
        $relas = Rateart::model()->findAllByAttributes(array('rateid' => $_POST['arrai']['rateid']));
        $ultimo = 0;
        if (count($relas) != 0) {
            foreach ($relas as $val) {
                $ultimo = $val->version_hist;
            }
        } else {
            $ultimo = 0;
        }
        $customsleg->version_hist = $ultimo + 1;
        foreach ($_POST['arrai'] as $valor => $descripcion) {
            $customsleg->$valor = $descripcion;
        }

        if ($customsleg->insert()) {
            echo $customsleg->rateartid . ',' . $customsleg->version_hist;
        } else {
            echo "0";
        }
    }

    public function actionUpdateartregis() {
        $this->layout = false;
        $rateartid = $_POST['arrai']['rateartid'];
        $customsleg = Rateart::model()->findByPk($rateartid);


        foreach ($_POST['arrai'] as $valor => $descripcion) {
            if ($valor != 'rateartid') {
                $customsleg->$valor = $descripcion;
            }
        }

        if ($customsleg->update()) {
            echo $customsleg->rateartid;
        } else {
            echo "0";
        }
    }

    public function actionListaartes() {
        $this->layout = false;
        //print_r($_POST['arrai']); 
        $rateartid = $_POST['rateartid'];
        $model = Rateart::model()->findByPk($rateartid);

        foreach ($model as $valor => $descripcion) {
            $output[$valor] = $descripcion;
        }

        echo json_encode($output);
    }

    public function actionListfordaterate() {
        $this->layout = false;
        //print_r($_POST['arrai']); 
        $ratedate = $_POST['ratedate'];

        $list_items_modif = Rate::model()->getAllRatesbyDate($ratedate);
        foreach ($list_items_modif as $value) {
            $list_items_date.="<tr> <td>"
                    . "<div class='btn-group'>"
                    . "<a href='#nw_ratedate_sel' class='btn btn btn-primary' onclick='selec_dif_ratedate(" . $value->rateid . ")' data-target='#change_rateid'  data-toggle='modal'>&nbsp;<i class='glyphicon glyphicon-transfer'></i>&nbsp;</a>"
                    . "</div></td> <td>" . $value->rateid . "</td> <td>" . $value->bundleid . "</td> <td>" . $value->projectdsc . "</td><td>" . $value->servicedsc . "</td><td>" . $value->ratedate . "</td></tr>";
        }

        echo $list_items_date;
    }

    public function actionChange_save_newratedate() {
        $this->layout = false;

        $rateidamodif = $_POST['rateidamodif']; //IDENTIFICADOR A MODIFICAR (AVERIGUAR BUDLEID)
        $newratedate_i = $_POST['newratedate_i'];  //FECHA NUEVA A ASIGNAR
        $newratedate_f = $_POST['newratedate_f'];  //FECHA NUEVA A ASIGNAR
        $original_rateid = $_POST['original_rateid']; // RATEIDS IDENTIFICADOR RAIZ QUE SERA BORRADO
        $list_ids_nuevos = explode(',', $original_rateid);

        $original_bundleid = $_POST['original_bundleid']; //BUNDLEID PROJECT
        $array_rateids_viejos = array();
        /* ----------- AVERIGUANDO BUDLEID DE IDENTIFICADOR RATE A MODIFICAR---- */
        $bundleidamodif = 0;
        $listabun = Rate::model()->findAllByAttributes(array('rateid' => $rateidamodif));
        $bundleidamodif = $listabun[0]['bundleid'];

        $con_rat = 0;
        $lista_rates = Rate::model()->findAllByAttributes(array('bundleid' => $bundleidamodif));

        $bandera = 0;
        /////////////--------------------------------------------------------------------------------ELIMINANDO DETALLES DE RATES VIEJOS
        foreach ($lista_rates as $row) {


            $ratezero = Ratezerotest::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratezero as $value) {
                $ratezero1 = Ratezerotest::model()->findByPk($value->ratezerotestid);
                $ratezero1->delete();
            }

            $ratewa = Ratewarehouse::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratewa as $value) {
                $ratewa1 = Ratewarehouse::model()->findByPk($value->ratewarehouseid);

                $ratewa1->delete();
            }

            $ratesu = Ratesupplierinvoice::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratesu as $value) {
                $ratesu1 = Ratesupplierinvoice::model()->findByPk($value->ratesupplierinvoiceid);
                $ratesu1->delete();
            }

            $ratesup = Ratesupplier::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratesup as $value) {
                $ratesup1 = Ratesupplier::model()->findByPk($value->ratesupplierid);
                $ratesup1->delete();
            }

            $rateprd = Rateproduction::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($rateprd as $value) {
                $rateprd1 = Rateproduction::model()->findByPk($value->rateproductionid);
                $rateprd1->delete();
            }

            $ratepor = Rateportoprintinvoice::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratepor as $value) {
                $ratepor1 = Rateportoprintinvoice::model()->findByPk($value->rateportoprintinvoiceid);
                $ratepor1->delete();
            }

            $rateodp = Rateodp::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($rateodp as $value) {
                $rateodp1 = Rateodp::model()->findByPk($value->rateodpid);
                $rateodp1->delete();
            }

            $rateodc = Rateodc::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($rateodc as $value) {
                $rateodc1 = Rateodc::model()->findByPk($value->rateodcid);
                $rateodc1->delete();
            }

            $rateitemd = Rateitemdetailvalue::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($rateitemd as $value) {
                $rateitemd1 = Rateitemdetailvalue::model()->findByPk($value->rateitemdetailvalueid);
                $rateitemd1->delete();
            }


            $ratefile = Ratefile::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratefile as $value) {
                $ratefile1 = Ratefile::model()->findByPk($value->ratefileid);
                $ratefile1->delete();
            }

            $ratedis = Ratedistribution::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratedis as $value) {
                $ratedis1 = Ratedistribution::model()->findByPk($value->ratedistributionid);
                $ratedis1->delete();
            }

            $ratecolor = Ratecolortest::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratecolor as $value) {
                $ratecolor1 = Ratecolortest::model()->findByPk($value->ratecolortestid);
                $ratecolor1->delete();
            }


            $ratechange = Ratechangeart::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratechange as $value) {
                $ratechan1 = Ratechangeart::model()->findByPk($value->ratechangeartid);
                $ratechan1->delete();
            }

            $rateart = Rateart::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($rateart as $value) {
                $rateart1 = Rateart::model()->findByPk($value->rateartid);
                $rateart1->delete();
            }
            $ratetra = Ratetracker::model()->findAllByAttributes(array('rateid' => $row->rateid));
            foreach ($ratetra as $value) {
                $ratetra = Ratetracker::model()->findByPk($value->ratetrackerid);
                $ratetra->delete();
            }

            $array_rateids_viejos[$con_rat] = $row->rateid; //lista de rates viejos DISPONIBLES

            $con_rat++;
        }


        /////////////--------------------------------------------------------------------------------ELIMINANDO RATES VIEJOS
        foreach ($lista_rates as $row1) {

            $rate = Rate::model()->findByPk($row1->rateid);
            $rate->delete();
        }

        /////////////--------------------------------------------------------------------------------ELIMINANDO BUNDLE VIEJO
        $bundle = Bundleproject::model()->findByPk($bundleidamodif);
        $bundle->delete();


        /////////////------------------------------------------------------------------------------GENERAR INSERT DE BUNDLEID
        $bundle1 = Bundleproject::model()->findByPk($original_bundleid);
        $nuevobundle = new Bundleproject();
        $nuevobundle->attributes = $bundle1->attributes;
        $nuevobundle->bundleid = $bundleidamodif;
        $nuevobundle->bundledate = $newratedate_i;
        if ($nuevobundle->insert()) {
            echo "se inserto el projecto principals";
            $bandera = 1;
        } else {
            $bandera = 0;
        }




        if (count($array_rateids_viejos) < count($list_ids_nuevos)) {
            $nuevorate = new Rate();
            $contador = 1;
            for ($i = 0; $i < count($array_rateids_viejos); $i++) {
                $rate1 = Rate::model()->findByPk($list_ids_nuevos[$i]);

                $nuevorate->attributes = $rate1->attributes;
                $nuevorate->entryid = $rate1->serviceid;
                $nuevorate->version = $rate1->version;
                $nuevorate->rateid = $array_rateids_viejos[$i];
                $nuevorate->bundleid = $bundleidamodif;
                $nuevorate->entryid = $rate1->entryid;
                $nuevorate->statustime = $newratedate_f;
                $nuevorate->odctime = $newratedate_f;
                $nuevorate->odptime = $newratedate_f;
                $nuevorate->ratedate = $newratedate_i;
                $nuevorate->raterenegotiate = "S";
                $nuevorate->parentrateid = $array_rateids_viejos[$i];
                if ($nuevorate->insert()) {
                    echo "se inserto el rate";
                    $bandera = 1;
                } else {
                    $bandera = 0;
                }



                $ratetracker = Ratetracker::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratetracker as $value) {
                    $ratetracker1 = Ratetracker::model()->findByPk($value->ratetrackerid);
                    $ratetracker1->rateid = $array_rateids_viejos[$i];
                    $ratetracker1->update();
                }



                $ratezero = Ratezerotest::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratezero as $value) {
                    $ratezero1 = Ratezerotest::model()->findByPk($value->ratezerotestid);
                    $ratezero1->rateid = $array_rateids_viejos[$i];
                    $ratezero1->update();
                }



                $rateware = Ratewarehouse::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateware as $value) {
                    $rateware1 = Ratewarehouse::model()->findBYPk($value->ratewarehouseid);
                    $rateware1->rateid = $array_rateids_viejos[$i];
                    $rateware1->update();
                }

                $ratesupv = Ratesupplierinvoice::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratesupv as $value) {
                    $ratesupv1 = Ratesupplierinvoice::model()->findBYPk($value->ratesupplierinvoiceid);
                    $ratesupv1->rateid = $array_rateids_viejos[$i];
                    $ratesupv1->update();
                }

                $ratesup = Ratesupplier::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratesup as $value) {
                    $ratesup1 = Ratesupplier::model()->findBYPk($value->ratesupplierid);
                    $ratesup1->rateid = $array_rateids_viejos[$i];
                    $ratesup1->update();
                }



                $rateprod = Rateproduction::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateprod as $value) {
                    $rateprod1 = Rateproduction::model()->findBYPk($value->rateproductionid);
                    $rateprod1->rateid = $array_rateids_viejos[$i];
                    $rateprod1->update();
                }

                $rateprin = Rateportoprintinvoice::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateprin as $value) {
                    $rateprin1 = Rateportoprintinvoice::model()->findBYPk($value->rateportoprintinvoiceid);
                    $rateprin1->rateid = $array_rateids_viejos[$i];
                    $rateprin1->update();
                }


                $rateodp = Rateodp::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateodp as $value) {
                    $rateodp1 = Rateodp::model() - findBYPk($value->rateodpid);
                    $rateodp1->rateid = $array_rateids_viejos[$i];
                    $rateodp1->statustime = $newratedate_f;
                    $rateodp1->update();
                }


                $rateodc = Rateodc::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateodc as $value) {
                    $rateodc1 = Rateodc::model()->findBYPk($value->rateodcid);
                    $rateodc1->rateid = $array_rateids_viejos[$i];
                    $rateodp1->statustime = $newratedate_f;
                    $rateodp1->odccdate = date("Y-m-d", $newratedate_f);
                    $rateodc1->update();
                }

                $rateitem = Rateitemdetailvalue::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateitem as $value) {
                    $rateitem1 = Rateitemdetailvalue::model()->findBYPk($value->rateitemdetailvalueid);
                    $rateitem1->rateid = $array_rateids_viejos[$i];
                    $rateitem1->update();
                }

                $ratefile = Ratefile::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratefile as $value) {
                    $ratefile1 = Ratefile::model()->findBYPk($value->ratefileid);
                    $ratefile1->rateid = $array_rateids_viejos[$i];
                    $ratefile1->update();
                }

                $ratedisf = Ratedistribution::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratedisf as $value) {
                    $ratedisf1 = Ratedistribution::model()->findBYPk($value->ratedistributionid);
                    $ratedisf1->rateid = $array_rateids_viejos[$i];
                    $ratedisf1->update();
                }

                $ratecolors = Ratecolortest::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratecolors as $value) {
                    $ratecolors1 = Ratecolortest::model()->findBYPk($value->ratecolortestid);
                    $ratecolors1->rateid = $array_rateids_viejos[$i];
                    $ratecolors1->update();
                }

                $ratecha = Ratechangeart::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratecha as $value) {
                    $ratecha1 = Ratechangeart::model()->findBYPk($value->ratechangeartid);
                    $ratecha1->rateid = $array_rateids_viejos[$i];
                    $ratecha1->update();
                }

                $rateart = Rateart::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateart as $value) {
                    $rateart1 = Rateart::model()->findBYPk($value->rateartid);
                    $rateart1->rateid = $array_rateids_viejos[$i];
                    $rateart1->update();
                }
            }

            for ($i = count($array_rateids_viejos); $i < count($list_ids_nuevos); $i++) {
                $nuevorate = Rate::model()->findByPk($list_ids_nuevos[$i]);
                $nuevorate->attributes = $rate1->attributes;
                $nuevorate->parentrateid = $array_rateids_viejos[0];
                $nuevorate->raterenegotiate = "S";
                $nuevorate->statustime = $newratedate_f;
                $nuevorate->odctime = $newratedate_f;
                $nuevorate->odptime = $newratedate_f;
                $nuevorate->ratedate = $newratedate_i;
                $nuevorate->bundleid = $bundleidamodif;
                $nuevorate->version = $contador;
                $nuevorate->update();


                $contador++;
            }
        } else if (count($array_rateids_viejos) == count($list_ids_nuevos)) {

            $nuevorate = new Rate();
            for ($i = 0; $i < count($array_rateids_viejos); $i++) {

                $rate1 = Rate::model()->findByPk($list_ids_nuevos[$i]);
                $nuevorate->attributes = $rate1->attributes;
                $nuevorate->raterenegotiate = "S";
                $nuevorate->parentrateid = $array_rateids_viejos[$i];
                $nuevorate->bundleid = $bundleidamodif;
                $nuevorate->entryid = $rate1->entryid;
                $nuevorate->ratedate = $newratedate_i;
                $nuevorate->odctime = $newratedate_f;
                $nuevorate->odptime = $newratedate_f;
                $nuevorate->statustime = $newratedate_f;
                $nuevorate->rateid = $array_rateids_viejos[$i];
                if ($nuevorate->insert()) {
                    echo "se inserto el rate";
                    $bandera = 1;
                } else {
                    $bandera = 0;
                }

                $ratetracker = Ratetracker::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratetracker as $value) {
                    $ratetracker1 = Ratetracker::model()->findByPk($value->ratetrackerid);
                    $ratetracker1->rateid = $array_rateids_viejos[$i];
                    $ratetracker1->update();
                }

                $ratezero = Ratezerotest::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratezero as $value) {
                    $ratezero1 = Ratezerotest::model()->findByPk($value->ratezerotestid);
                    $ratezero1->rateid = $array_rateids_viejos[$i];
                    $ratezero1->update();
                }



                $rateware = Ratewarehouse::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateware as $value) {
                    $rateware1 = Ratewarehouse::model()->findBYPk($value->ratewarehouseid);
                    $rateware1->rateid = $array_rateids_viejos[$i];
                    $rateware1->update();
                }

                $ratesupv = Ratesupplierinvoice::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratesupv as $value) {
                    $ratesupv1 = Ratesupplierinvoice::model()->findBYPk($value->ratesupplierinvoiceid);
                    $ratesupv1->rateid = $array_rateids_viejos[$i];
                    $ratesupv1->update();
                }

                $ratesup = Ratesupplier::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratesup as $value) {
                    $ratesup1 = Ratesupplier::model()->findBYPk($value->ratesupplierid);
                    $ratesup1->rateid = $array_rateids_viejos[$i];
                    $ratesup1->update();
                }



                $rateprod = Rateproduction::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateprod as $value) {
                    $rateprod1 = Rateproduction::model()->findBYPk($value->rateproductionid);
                    $rateprod1->rateid = $array_rateids_viejos[$i];
                    $rateprod1->update();
                }

                $rateprin = Rateportoprintinvoice::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateprin as $value) {
                    $rateprin1 = Rateportoprintinvoice::model()->findBYPk($value->rateportoprintinvoiceid);
                    $rateprin1->rateid = $array_rateids_viejos[$i];
                    $rateprin1->update();
                }


                $rateodp = Rateodp::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateodp as $value) {
                    $rateodp1 = Rateodp::model() - findBYPk($value->rateodpid);
                    $rateodp1->rateid = $array_rateids_viejos[$i];
                    $rateodp1->statustime = $newratedate_f;
                    $rateodp1->update();
                }


                $rateodc = Rateodc::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateodc as $value) {
                    $rateodc1 = Rateodc::model()->findBYPk($value->rateodcid);
                    $rateodc1->rateid = $array_rateids_viejos[$i];
                    $rateodp1->statustime = $newratedate_f;
                    $rateodp1->odccdate = date("Y-m-d", $newratedate_f);
                    $rateodc1->update();
                }

                $rateitem = Rateitemdetailvalue::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateitem as $value) {
                    $rateitem1 = Rateitemdetailvalue::model()->findBYPk($value->rateitemdetailvalueid);
                    $rateitem1->rateid = $array_rateids_viejos[$i];
                    $rateitem1->update();
                }

                $ratefile = Ratefile::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratefile as $value) {
                    $ratefile1 = Ratefile::model()->findBYPk($value->ratefileid);
                    $ratefile1->rateid = $array_rateids_viejos[$i];
                    $ratefile1->update();
                }

                $ratedisf = Ratedistribution::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratedisf as $value) {
                    $ratedisf1 = Ratedistribution::model()->findBYPk($value->ratedistributionid);
                    $ratedisf1->rateid = $array_rateids_viejos[$i];
                    $ratedisf1->update();
                }

                $ratecolors = Ratecolortest::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratecolors as $value) {
                    $ratecolors1 = Ratecolortest::model()->findBYPk($value->ratecolortestid);
                    $ratecolors1->rateid = $array_rateids_viejos[$i];
                    $ratecolors1->update();
                }

                $ratecha = Ratechangeart::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratecha as $value) {
                    $ratecha1 = Ratechangeart::model()->findBYPk($value->ratechangeartid);
                    $ratecha1->rateid = $array_rateids_viejos[$i];
                    $ratecha1->update();
                }

                $rateart = Rateart::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateart as $value) {
                    $rateart1 = Rateart::model()->findBYPk($value->rateartid);
                    $rateart1->rateid = $array_rateids_viejos[$i];
                    $rateart1->update();
                }
            }
        } else {

            $nuevorate = new Rate();

            for ($i = 0; $i < count($list_ids_nuevos); $i++) {

                $rate1 = Rate::model()->findByPk($list_ids_nuevos[$i]);
                $nuevorate->attributes = $rate1->attributes;
                $nuevorate->raterenegotiate = "S";
                $nuevorate->parentrateid = $array_rateids_viejos[$i];
                $nuevorate->bundleid = $bundleidamodif;
                $nuevorate->ratedate = $newratedate_i;
                $nuevorate->odctime = $newratedate_f;
                $nuevorate->entryid = $rate1->entryid;
                $nuevorate->odptime = $newratedate_f;
                $nuevorate->statustime = $newratedate_f;
                $nuevorate->rateid = $array_rateids_viejos[$i];
                if ($nuevorate->insert()) {
                    echo "se inserto el rate ";
                    $bandera = 1;
                } else {
                    $bandera = 0;
                }

                $ratetracker = Ratetracker::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratetracker as $value) {
                    $ratetracker1 = Ratetracker::model()->findByPk($value->ratetrackerid);
                    $ratetracker1->rateid = $array_rateids_viejos[$i];
                    $ratetracker1->update();
                }

                $ratezero = Ratezerotest::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratezero as $value) {
                    $ratezero1 = Ratezerotest::model()->findByPk($value->ratezerotestid);
                    $ratezero1->rateid = $array_rateids_viejos[$i];
                    $ratezero1->update();
                }



                $rateware = Ratewarehouse::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateware as $value) {
                    $rateware1 = Ratewarehouse::model()->findBYPk($value->ratewarehouseid);
                    $rateware1->rateid = $array_rateids_viejos[$i];
                    $rateware1->update();
                }

                $ratesupv = Ratesupplierinvoice::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratesupv as $value) {
                    $ratesupv1 = Ratesupplierinvoice::model()->findBYPk($value->ratesupplierinvoiceid);
                    $ratesupv1->rateid = $array_rateids_viejos[$i];
                    $ratesupv1->update();
                }

                $ratesup = Ratesupplier::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratesup as $value) {
                    $ratesup1 = Ratesupplier::model()->findBYPk($value->ratesupplierid);
                    $ratesup1->rateid = $array_rateids_viejos[$i];
                    $ratesup1->update();
                }



                $rateprod = Rateproduction::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateprod as $value) {
                    $rateprod1 = Rateproduction::model()->findBYPk($value->rateproductionid);
                    $rateprod1->rateid = $array_rateids_viejos[$i];
                    $rateprod1->update();
                }

                $rateprin = Rateportoprintinvoice::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateprin as $value) {
                    $rateprin1 = Rateportoprintinvoice::model()->findBYPk($value->rateportoprintinvoiceid);
                    $rateprin1->rateid = $array_rateids_viejos[$i];
                    $rateprin1->update();
                }


                $rateodp = Rateodp::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateodp as $value) {
                    $rateodp1 = Rateodp::model() - findBYPk($value->rateodpid);
                    $rateodp1->rateid = $array_rateids_viejos[$i];
                    $rateodp1->statustime = $newratedate_f;
                    $rateodp1->update();
                }


                $rateodc = Rateodc::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateodc as $value) {
                    $rateodc1 = Rateodc::model()->findBYPk($value->rateodcid);
                    $rateodc1->rateid = $array_rateids_viejos[$i];
                    $rateodp1->statustime = $newratedate_f;
                    $rateodp1->odccdate = date("Y-m-d", $newratedate_f);
                    $rateodc1->update();
                }

                $rateitem = Rateitemdetailvalue::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateitem as $value) {
                    $rateitem1 = Rateitemdetailvalue::model()->findBYPk($value->rateitemdetailvalueid);
                    $rateitem1->rateid = $array_rateids_viejos[$i];
                    $rateitem1->update();
                }


                $ratefile = Ratefile::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratefile as $value) {

                    $ratefile1 = Ratefile::model()->findBYPk($value->ratefileid);
                    $ratefile1->rateid = $array_rateids_viejos[$i];
                    $ratefile1->update();
                }

                $ratedisf = Ratedistribution::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratedisf as $value) {
                    $ratedisf1 = Ratedistribution::model()->findBYPk($value->ratedistributionid);
                    $ratedisf1->rateid = $array_rateids_viejos[$i];
                    $ratedisf1->update();
                }

                $ratecolors = Ratecolortest::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratecolors as $value) {
                    $ratecolors1 = Ratecolortest::model()->findBYPk($value->ratecolortestid);
                    $ratecolors1->rateid = $array_rateids_viejos[$i];
                    $ratecolors1->update();
                }

                $ratecha = Ratechangeart::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($ratecha as $value) {
                    $ratecha1 = Ratechangeart::model()->findBYPk($value->ratechangeartid);
                    $ratecha1->rateid = $array_rateids_viejos[$i];
                    $ratecha1->update();
                }

                $rateart = Rateart::model()->findAllByAttributes(array('rateid' => $list_ids_nuevos[$i]));
                foreach ($rateart as $value) {
                    $rateart1 = Rateart::model()->findBYPk($value->rateartid);
                    $rateart1->rateid = $array_rateids_viejos[$i];
                    $rateart1->update();
                }

                /*   */
            }
        }

        if ($bandera == 1) {
            for ($i = 0; $i < count($list_ids_nuevos); $i++) {
                $ratedel = Rate::model()->findByPk($list_ids_nuevos[$i]);
                $ratedel->delete();
            }
            if ($bundle1->delete()) {

                echo "1";
            }
        } else {
            echo "0";
        }
    }

    public function actionListahistoarts() {
        $this->layout = false;

        $ratechangeartid = $_POST['ratechangeartid'];
        $rateid = $_POST['rateid'];

        $list_items_modif = Rateart::model()->findAllByAttributes(array('rateid' => $rateid, 'ratechangeartid' => $ratechangeartid));
        $cadena = '';
        $cadena1 = '';
        if ($ratechangeartid != 0) {
            $list_charges_modif = Ratechangeart::model()->findAllByAttributes(array('rateid' => $rateid, 'ratechangeartid' => $ratechangeartid));
            $cadena = $list_charges_modif[0]['ratechangeartname'];
            $cadena1 = $list_charges_modif[0]['ratechangeartnumber'];
        } else {
            $cadena = "Total";
            $rate_lis_quant = Rate::model()->findAllByAttributes(array('rateid' => $rateid));
            $cadena1 = $rate_lis_quant[0]['quantityselect'];
        }
        foreach ($list_items_modif as $value) {

            $list_items_date.="<tr> <td>" . $value->version_hist . "</td><td>" . $cadena . "</td><td>" . $cadena1 . "</td><td>" . $value->date_histo . "</td> <td>"
                    . "<div class='btn-group  '>"
                    . "<a href='' class='btn btn-sm btn-default' onclick='selec_hist_ar(" . $value->rateartid . "," . $rateid . ")' data-target='#'  data-toggle='modal'>&nbsp;<i class='glyphicon glyphicon-pencil'></i>&nbsp;</a>"
                    . "</div></td> </tr>";
        }

        echo $list_items_date;
    }

    public function actionListahistotestcolor() {
        $this->layout = false;

        $ratechangeartid = $_POST['ratechangeartid'];
        $rateid = $_POST['rateid'];

        $list_items_modif = Ratecolortest::model()->findAllByAttributes(array('rateid' => $rateid, 'ratechangeartid' => $ratechangeartid));
        $cadena = '';
        $cadena1 = '';
        if ($ratechangeartid != 0) {
            $list_charges_modif = Ratechangeart::model()->findAllByAttributes(array('rateid' => $rateid, 'ratechangeartid' => $ratechangeartid));
            $cadena = $list_charges_modif[0]['ratechangeartname'];
            $cadena1 = $list_charges_modif[0]['ratechangeartnumber'];
        } else {
            $cadena = "Total";
            $rate_lis_quant = Rate::model()->findAllByAttributes(array('rateid' => $rateid));
            $cadena1 = $rate_lis_quant[0]['quantityselect'];
        }
        foreach ($list_items_modif as $value) {

            $list_items_date.="<tr> <td>" . $value->version_hist . "</td><td>" . $cadena . "</td><td>" . $cadena1 . "</td><td>" . $value->date_histo . "</td> <td>"
                    . "<div class='btn-group  '>"
                    . "<a href='' class='btn btn-sm btn-default' onclick='selec_hist_testcolor(" . $value->ratecolortestid . "," . $rateid . ")' data-target='#'  data-toggle='modal'>&nbsp;<i class='glyphicon glyphicon-pencil'></i>&nbsp;</a>"
                    . "</div></td> </tr>";
        }

        echo $list_items_date;
    }

    public function actionCreatetestcolorregis() {
        $this->layout = false;

        $customsleg = new Ratecolortest();
        $relas = Ratecolortest::model()->findAllByAttributes(array('rateid' => $_POST['arrai']['rateid']));
        $ultimo = 0;
        if (count($relas) != 0) {
            foreach ($relas as $val) {
                $ultimo = $val->version_hist;
            }
        } else {
            $ultimo = 0;
        }
        $customsleg->version_hist = $ultimo + 1;
        foreach ($_POST['arrai'] as $valor => $descripcion) {
            $customsleg->$valor = $descripcion;
        }

        if ($customsleg->insert()) {
            echo $customsleg->ratecolortestid . ',' . $customsleg->version_hist;
        } else {
            echo "0";
        }
    }

    public function actionUpdatetestcolorregis() {
        $this->layout = false;
        $ratecolortestid = $_POST['arrai']['ratecolortestid'];
        $customsleg = Ratecolortest::model()->findByPk($ratecolortestid);


        foreach ($_POST['arrai'] as $valor => $descripcion) {
            if ($valor != 'ratecolortestid') {
                $customsleg->$valor = $descripcion;
            }
        }

        if ($customsleg->update()) {
            echo $customsleg->ratecolortestid;
        } else {
            echo "0";
        }
    }

    public function actionListatestcolor() {
        $this->layout = false;
        //print_r($_POST['arrai']); 
        $ratecolortestid = $_POST['ratecolortestid'];
        $model = Ratecolortest::model()->findByPk($ratecolortestid);

        foreach ($model as $valor => $descripcion) {
            $output[$valor] = $descripcion;
        }

        echo json_encode($output);
    }

    ///*******************----------------------------------TEST ZERO


    public function actionListahistozerotest() {
        $this->layout = false;

        $ratechangeartid = $_POST['ratechangeartid'];
        $rateid = $_POST['rateid'];

        $list_items_modif = Ratezerotest::model()->findAllByAttributes(array('rateid' => $rateid, 'ratechangeartid' => $ratechangeartid));
        $cadena = '';
        $cadena1 = '';
        if ($ratechangeartid != 0) {
            $list_charges_modif = Ratechangeart::model()->findAllByAttributes(array('rateid' => $rateid, 'ratechangeartid' => $ratechangeartid));
            $cadena = $list_charges_modif[0]['ratechangeartname'];
            $cadena1 = $list_charges_modif[0]['ratechangeartnumber'];
        } else {
            $cadena = "Total";
            $rate_lis_quant = Rate::model()->findAllByAttributes(array('rateid' => $rateid));
            $cadena1 = $rate_lis_quant[0]['quantityselect'];
        }
        foreach ($list_items_modif as $value) {

            $list_items_date.="<tr> <td>" . $value->version_hist . "</td><td>" . $cadena . "</td><td>" . $cadena1 . "</td><td>" . $value->date_histo . "</td> <td>"
                    . "<div class='btn-group  '>"
                    . "<a href='' class='btn btn-sm btn-default' onclick='selec_hist_zerotest(" . $value->ratezerotestid . "," . $rateid . ")' data-target='#'  data-toggle='modal'>&nbsp;<i class='glyphicon glyphicon-pencil'></i>&nbsp;</a>"
                    . "</div></td> </tr>";
        }

        echo $list_items_date;
    }

    public function actionCreatezerotestregis() {
        $this->layout = false;

        $customsleg = new Ratezerotest();
        $relas = Ratezerotest::model()->findAllByAttributes(array('rateid' => $_POST['arrai']['rateid']));
        $ultimo = 0;
        if (count($relas) != 0) {
            foreach ($relas as $val) {
                $ultimo = $val->version_hist;
            }
        } else {
            $ultimo = 0;
        }
        $customsleg->version_hist = $ultimo + 1;
        foreach ($_POST['arrai'] as $valor => $descripcion) {
            $customsleg->$valor = $descripcion;
        }

        if ($customsleg->insert()) {
            echo $customsleg->ratezerotestid . ',' . $customsleg->version_hist;
        } else {
            echo "0";
        }
    }

    public function actionUpdatezerotestregis() {
        $this->layout = false;
        $ratezerotestid = $_POST['arrai']['ratezerotestid'];
        $customsleg = Ratezerotest::model()->findByPk($ratezerotestid);


        foreach ($_POST['arrai'] as $valor => $descripcion) {
            if ($valor != 'ratezerotestid') {
                $customsleg->$valor = $descripcion;
            }
        }

        if ($customsleg->update()) {
            echo $customsleg->ratezerotestid;
        } else {
            echo "0";
        }
    }

    public function actionListazerotest() {
        $this->layout = false;
        //print_r($_POST['arrai']); 
        $ratezerotestid = $_POST['ratezerotestid'];
        $model = Ratezerotest::model()->findByPk($ratezerotestid);

        foreach ($model as $valor => $descripcion) {
            $output[$valor] = $descripcion;
        }

        echo json_encode($output);
    }

    public function actionFiles_char() {
        $this->layout = false;
        //print_r($_POST['arrai']); 

        $model = Ratefile::model()->findByAttributes(array("rateid" => $_POST['rateid'], "ratefilesupplier" => 1));

        if ($model != null) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function actionCant_tol_odp() {
        $this->layout = false;
        //print_r($_POST['arrai']); 
        $contador = 0;
        $remision = Rateremision::model()->findAllByAttributes(array("rateid" => $_POST['rateid']));
        $modal = Rate::model()->findByAttributes(array("rateid" => $_POST['rateid']));

        if (count($remision) != 0) {
            foreach ($remision as $value) {
                $contador = $contador + $value->cantparcial;
            }
            $total = $modal->quantityselect;
            $result = $total - $contador;
            echo $total . ',' . $result;
        } else {
            echo $total = $modal->quantityselect . ',' . $modal->quantityselect;
        }
    }

    public function actionSetquantity($id) {
        $nid = Utils::decrypt($id, 'rate');
        
        $model = Rate::model()->findByPk($nid);
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        
        $model->quantityselect = 0;
        
        if($_POST[Rate][quantity_1]){
            $model->quantity_1 = $_POST[Rate][quantity_1];
        }
        if($_POST[Rate][quantity_2]){
            $model->quantity_2 = $_POST[Rate][quantity_2];
        }
        if($_POST[Rate][quantity_3]){
            $model->quantity_3 = $_POST[Rate][quantity_3];
        }
        if($_POST[Rate][quantity_4]){
            $model->quantity_4 = $_POST[Rate][quantity_4];
        }
        if($_POST[Rate][quantity_5]){
            $model->quantity_5 = $_POST[Rate][quantity_5];
        }
        if($_POST[Rate][quantity_6]){
            $model->quantity_6 = $_POST[Rate][quantity_6];
        }
        if($model->update()){
            //echo 1;
            $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
        }
        
        
        
    }

    public function actionAddreneg() {
        $this->layout = false;

        $rate = Rate::model()->findByPk($_POST['rateid']);
        $newr = new Rate();

        //Duplicar Rate
        $newr->parentrateid = $_POST['rateid'];
        $newr->projectid = $rate->projectid;
        $newr->entryid = $rate->entryid;
        $newr->serviceid = $rate->serviceid;
        $newr->bundleid = $rate->bundleid;
        $newr->userid = $rate->userid;
        $newr->statusid = 2;
        $newr->statustime = date('Y-m-d H:i:s');
        $newr->warehouseid = $rate->warehouseid;
        $newr->designagencyid = $rate->designagencyid;
        $newr->customercontactid = $rate->customercontactid;
        $newr->legalentityid = $rate->legalentityid;
        $newr->ratedate = date('Y-m-d H:i:s');
        $newr->expiration = $rate->expiration;
        $newr->note = $rate->note;
        $newr->ratetype = 'R';
        $newr->image = $rate->image;
        $newr->quantity_1 = $rate->quantity_1;
        $newr->quantity_2 = $rate->quantity_2;
        $newr->quantity_3 = $rate->quantity_3;
        $newr->quantity_4 = $rate->quantity_4;
        $newr->quantity_5 = $rate->quantity_5;
        $newr->quantity_6 = $rate->quantity_6;
        $newr->ppp_1 = $rate->ppp_1;
        $newr->ppp_2 = $rate->ppp_2;
        $newr->ppp_3 = $rate->ppp_3;
        $newr->ppp_4 = $rate->ppp_4;
        $newr->ppp_5 = $rate->ppp_5;
        $newr->ppp_6 = $rate->ppp_6;
        $newr->pprice = $rate->pprice;
        $newr->quantityselect = $rate->quantityselect;
        $newr->iva = $rate->iva;
        $newr->duration = $rate->duration;
        $newr->send = $rate->send;
        $newr->formula = $rate->formula;
        $newr->complete = $rate->complete;
        $newr->bureau = $rate->bureau;

        $newr->insert();


        echo $rateid = $newr->rateid;

        //duplicar rateart
        $arte = Rateart::model()->findByPk($_POST['rateid']);
        $nart = new Rateart();

        $nart->rateid = $rateid;
        $nart->receptiondate = $arte->receptiondate;
        $nart->filerevision1 = $arte->filerevision1;
        $nart->filerevision2 = $arte->filerevision2;
        $nart->filerevision3 = $arte->filerevision3;
        $nart->filerevision4 = $arte->filerevision4;
        $nart->changes = $arte->changes;
        $nart->specifiedobservation = $arte->specifiedobservation;
        $nart->receivemethod = $arte->receivemethod;
        $nart->authorization = $arte->authorization;
        $nart->designhead = $arte->designhead;
        $nart->receipt = $arte->receipt;
        $nart->filetype = $arte->filetype;
        $nart->changestype = $arte->changestype;
        $nart->senddate = $arte->senddate;
        $nart->authorizationdate = $arte->authorizationdate;
        $nart->authorizationmethod = $arte->authorizationmethod;
        $nart->sendmethod = $arte->sendmethod;
        $nart->ratechangeartid = $arte->ratechangeartid;
        $nart->version_hist = $arte->version_hist;
        $nart->date_histo = $arte->date_histo;

        $nart->insert();

        //duplicar ratechangeart
        $chan = Ratechangeart::model()->findByPk($_POST['rateid']);
        $chrt = new Ratechangeart();
        if ($chrt->rateid !== NULL) {
            $chrt->rateid = $rateid;
            $chrt->quantitynumber = $chan->quantitynumber;
            $chrt->ratechangeartname = $chan->ratechangeartname;
            $chrt->ratechangeartnumber = $chan->ratechangeartnumber;
            $chrt->active = $chan->active;

            $chrt->insert();
        }

        //duplicar ratecolortest
        $colr = Ratecolortest::model()->findByPk($_POST['rateid']);
        $cclr = new Ratecolortest();
        $cclr->rateid = $rateid;
        $cclr->ratechangeartid = $colr->ratechangeartid;
        $cclr->productiondate = $colr->productiondate;
        $cclr->testcolortype = $colr->testcolortype;
        $cclr->production = $colr->production;
        $cclr->courierdeliverydate = $colr->courierdeliverydate;
        $cclr->receivercourier = $colr->receivercourier;
        $cclr->cutomerdeliverydate = $colr->cutomerdeliverydate;
        $cclr->receivercustomer = $colr->receivercustomer;
        $cclr->supplierdeliverydate = $colr->supplierdeliverydate;
        $cclr->authorizationtest = $colr->authorizationtest;
        $cclr->rejectreason = $colr->rejectreason;
        $cclr->comments = $colr->comments;
        $cclr->authorizationdate = $colr->authorizationdate;
        $cclr->active = $colr->active;
        $cclr->version_hist = $colr->version_hist;
        $cclr->date_histo = $colr->date_histo;

        $cclr->insert();


        //duplica ratedistribution
        $rdis = Ratedistribution::model()->findByPk($_POST['rateid']);
        $ndis = new Ratedistribution();
        if ($rdis->rateid !== NULL) {
            $ndis->rateid = $rateid;
            $ndis->ratedistributionplace = $rdis->ratedistributionplace;
            $ndis->ratedistributionquantity = $rdis->ratedistributionquantity;
            $ndis->active = $rdis->active;

            $ndis->insert();
        }



        //duplica ratefile
        $rfile = Ratefile::model()->findByPk($_POST['rateid']);
        $nfile = new Ratefile();
        if ($rfile->rateid !== NULL) {
            $nfile->rateid = $rateid;
            $nfile->name = $rfile->name;
            $nfile->path = $rfile->path;
            $nfile->dateupload = $rfile->dateupload;
            $nfile->ratefilesupplier = $rfile->ratefilesupplier;

            $nfile->insert();
            echo $rfile->ratefileid;
        }

        $ritem = Rateitemdetailvalue::model()->findAllbyAttributes(array('rateid' => $_POST['rateid']));

        if (count($ritem) > 0) {
            foreach ($ritem as $row) {
                $nitem = new Rateitemdetailvalue();
                $nitem->rateid = $rateid;
                $nitem->itemdetailvalueid = $row->itemdetailvalueid;
                $nitem->active = $row->active;
                $nitem->insert();
            }
        }

        //duplicar rateportoprintinvoice  

        $rvoice = Rateportoprintinvoice::model()->findByPk($_POST['rateid']);
        $nvoice = new Rateportoprintinvoice();
        if ($rvoice->rateid !== NULL) {
            $nvoice->rateid = $rateid;
            $nvoice->createdate = $rvoice->createdate;
            $nvoice->invoicenumber = $rvoice->invoicenumber;
            $nvoice->amount = $rvoice->amount;
            $nvoice->estimateddate = $rvoice->estimateddate;
            $nvoice->pieces = $rvoice->pieces;
            $nvoice->ivatax = $rvoice->ivatax;
            $nvoice->total = $rvoice->total;
            $nvoice->realDate = $rvoice->realDate;
            $nvoice->active = $rvoice->active;

            $nvoice->insert();
        }
        //Duplicar ratesupplier
        $rsupp = Ratesupplier::model()->findAllbyAttributes(array('rateid' => $_POST['rateid']));
        
        if (count($rsupp) > 0) {
            foreach ($rsupp as $row) {
                
                $nsupp = new Ratesupplier();
                $nsupp->rateid = $rateid;
                $nsupp->supplierid = $row->supplierid;
                $nsupp->quantity_1 = $row->quantity_1;
                $nsupp->quantity_2 = $row->quantity_2;
                $nsupp->quantity_3 = $row->quantity_3;
                $nsupp->quantity_4 = $row->quantity_4;
                $nsupp->quantity_5 = $row->quantity_5;
                $nsupp->quantity_6 = $row->quantity_6;
                $nsupp->declinereason = $row->declinereason;
                $nsupp->statusid = $row->statusid;
                $nsupp->statustime = $row->statustime;
                $nsupp->percent = $row->percent;
                $nsupp->showtable = $row->showtable;
                $nsupp->active = $row->active;
                $nsupp->daysproduction1 = $row->daysproduction1;
                $nsupp->daysproduction2 = $row->daysproduction2;
                $nsupp->daysproduction3 = $row->daysproduction3;
                $nsupp->daysproduction4 = $row->daysproduction4;
                $nsupp->daysproduction5 = $row->daysproduction5;
                $nsupp->daysproduction6 = $row->daysproduction6;
                $nsupp->showtable = $row->showtable;


                $nsupp->insert();
            }
        }
        //Duplicar ratesupplierinvoice
        $rsupi = Ratesupplierinvoice::model()->findByPk($_POST['rateid']);
        $nsupi = new Ratesupplierinvoice();
        if ($rsupi->rateid !== NULL) {
            $nsupi->rateid = $rateid;
            $nsupi->receiptdate = $rsupi->receiptdate;
            $nsupi->invoicenumber = $rsupi->invoicenumber;
            $nsupi->withholdingISR = $rsupi->withholdingISR;
            $nsupi->amount = $rsupi->amount;
            $nsupi->estimateddate = $rsupi->estimateddate;
            $nsupi->pieces = $rsupi->pieces;
            $nsupi->ivatax = $rsupi->ivatax;
            $nsupi->withholdingIVA = $rsupi->withholdingIVA;
            $nsupi->total = $rsupi->total;
            $nsupi->realDate = $rsupi->realDate;
            $nsupi->active = $rsupi->active;

            $nsupi->insert();
        }
        //Duplicar ratezerotest
        $rzero = Ratezerotest::model()->findByPk($_POST['rateid']);
        $nzero = new Ratezerotest();
        if ($rzero->rateid !== NULL) {
            $nzero->rateid = $rateid;
            $nzero->courierdeliverydate = $rzero->courierdeliverydate;
            $nzero->customerdeliverydate = $rzero->customerdeliverydate;
            $nzero->receivercustomer = $rzero->receivercustomer;
            $nzero->deliverytestnumber = $rzero->deliverytestnumber;
            $nzero->authorization = $rzero->authorization;
            $nzero->rejectreason = $rzero->rejectreason;
            $nzero->zerotestauthorization = $rzero->zerotestauthorization;
            $nzero->authorizationtest = $rzero->authorizationtest;
            $nzero->scheduleddelivery = $rzero->scheduleddelivery;
            $nzero->realdelivery = $rzero->realdelivery;
            $nzero->active = $rzero->active;
            $nzero->supplierdelivery = $rzero->supplierdelivery;
            $nzero->version_hist = $rzero->version_hist;
            $nzero->date_histo = $rzero->date_histo;
            $nzero->ratechangeartid = $rzero->ratechangeartid;

            $nzero->insert();
        }
    }

    public function actionDatareneg() {
        $supplier_data = Ratesupplier::model()->findByPk($_POST['ratesupplierid']);
        $supp = Ratesupplier::model()->getRateSupplierById($_POST['ratesupplierid']);
        foreach ($supp as $row) {
            $supplierdsc = $row->supplierdsc;
        }
        
        echo $supplier_data->quantity_1."|".$supplier_data->daysproduction1."|".$supplier_data->quantity_2."|".$supplier_data->daysproduction2."|".$supplier_data->quantity_3."|".$supplier_data->daysproduction3."|".$supplier_data->quantity_4."|".$supplier_data->daysproduction4."|".$supplier_data->quantity_5."|".$supplier_data->daysproduction5."|".$supplier_data->quantity_6."|".$supplier_data->daysproduction6."|".$supplierdsc;
    }
    public function actionSetprice($id) {
        
        $nid = Utils::decrypt($id, 'rate');
        
        $model = Rate::model()->findByPk($nid);
        $menu = Utils::decrypt($_GET['menu'], 'rate');
        $add = Utils::decrypt($_GET['add'], 'rate');
        $edt = Utils::decrypt($_GET['edt'], 'rate');
        $del = Utils::decrypt($_GET['del'], 'rate');
        
        $supplier_data = Ratesupplier::model()->findByPk($_POST['ratesupplierid']);
        
        if($_POST['Ratesupplier'][quantity_1]){
            $supplier_data->quantity_1 = $_POST['Ratesupplier'][quantity_1];
        }
        if($_POST['Ratesupplier'][daysproduction1]){
            $supplier_data->daysproduction1 = $_POST['Ratesupplier'][daysproduction1];
        }
        
        if($_POST['Ratesupplier'][quantity_2]){
            $supplier_data->quantity_2 = $_POST['Ratesupplier'][quantity_2];
        }
        if($_POST['Ratesupplier'][daysproduction2]){
            $supplier_data->daysproduction2 = $_POST['Ratesupplier'][daysproduction2];
        }
        
        if($_POST['Ratesupplier'][quantity_3]){
            $supplier_data->quantity_3 = $_POST['Ratesupplier'][quantity_3];
        }
        if($_POST['Ratesupplier'][daysproduction3]){
            $supplier_data->daysproduction3 = $_POST['Ratesupplier'][daysproduction3];
        }
        
        if($_POST['Ratesupplier'][quantity_4]){
            $supplier_data->quantity_4 = $_POST['Ratesupplier'][quantity_4];
        }
        if($_POST['Ratesupplier'][daysproduction4]){
            $supplier_data->daysproduction4 = $_POST['Ratesupplier'][daysproduction4];
        }
        
        if($_POST['Ratesupplier'][quantity_5]){
            $supplier_data->quantity_5 = $_POST['Ratesupplier'][quantity_5];
        }
        if($_POST['Ratesupplier'][daysproduction5]){
            $supplier_data->daysproduction5 = $_POST['Ratesupplier'][daysproduction5];
        }
        
        if($_POST['Ratesupplier'][quantity_6]){
            $supplier_data->quantity_6 = $_POST['Ratesupplier'][quantity_6];
        }
        if($_POST['Ratesupplier'][daysproduction6]){
            $supplier_data->daysproduction6 = $_POST['Ratesupplier'][daysproduction6];
        }
        
        if($supplier_data->update()){
            $this->redirect('?r=portoprint/default#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($model->bundleid, 'rate') . '/add/' . Utils::encrypt($add, 'rate') . '/edt/' . Utils::encrypt($edt, 'rate') . '/del/' . Utils::encrypt($del, 'rate') . '/menu/' . Utils::encrypt($menu, 'rate'));
        }
    }
      public function actionSavexts() {
        $this->layout = false;

        $modelrate = Rate::model()->findByPk($_POST['rateid']);
        
        $modelrate->rateid;
        $modelrate->rateext=$_POST['rateext'];

        if ($modelrate->update()) {
            echo $modelrate->rateid ;
        } else {
            echo "0";
        }
       
    }
    
     public function actionVisiblesupplier() {
        $this->layout = false;

        $modelsupplier= Ratesupplier::model()->findByPk($_POST['ratesupplierid']);
        
        $modelsupplier->showtable=$_POST['showtable'];

        if ($modelsupplier->update()) {
            echo $modelsupplier->ratesupplierid ;
        } else {
            echo "0";
        }
       
    }
}