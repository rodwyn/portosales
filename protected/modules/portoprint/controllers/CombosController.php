<?php

class CombosController extends Controller {

    public $stateid;
    public $statedsc;

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

    public function actionLegal() {
        $customerid = $_GET['customerid'];
        $legal = CHtml::listData(Customerlegalentity::model()->findAllbyAttributes(array('customerid' => $customerid)), 'customerlegalentityid', 'legalentity');
        echo CHtml::tag('option', array('value' => '-1'), 'Seleccione', true);

        foreach ($legal as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionBrand() {
        $customerid = $_GET['customerid'];
        $legal = CHtml::listData(Brand::model()->findAllbyAttributes(array('customerid' => $customerid)), 'brandid', 'branddsc');
        echo CHtml::tag('option', array('value' => '-1'), 'Seleccione', true);

        foreach ($legal as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionProject() {
        $brandid = $_GET['brandid'];
        $project = CHtml::listData(Project::model()->findAllbyAttributes(array('brandid' => $brandid)), 'projectid', 'projectdsc');
        echo CHtml::tag('option', array('value' => '-1'), 'Seleccione', true);

        foreach ($project as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionContact() {
        $customerid = $_GET['customerid'];
        $contact = CHtml::listData(Customercontact::model()->getCompleteName($customerid), 'contactid', 'name');
        echo CHtml::tag('option', array('value' => '-1'), 'Seleccione', true);

        foreach ($contact as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionWarehouse() {
        $customerid = $_GET['customerid'];
        $warehouse = CHtml::listData(Warehouse::model()->findAllbyAttributes(array('customerid' => $customerid)), 'warehouseid', 'name');
        echo CHtml::tag('option', array('value' => '-1'), 'Seleccione', true);

        foreach ($warehouse as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionDesign() {
        $customerid = $_GET['customerid'];
        $design = CHtml::listData(Designagency::model()->findAllbyAttributes(array('customerid' => $customerid)), 'designagencyid', 'designagencydsc');
        echo CHtml::tag('option', array('value' => '-1'), 'Seleccione', true);

        foreach ($design as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionUser() {
        $customerid = $_GET['customerid'];
        $user = CHtml::listData(Usercustomerpermission::model()->getuserbyCustomer($customerid, Yii::app()->user->userid), 'userid', 'usercompletename');
        echo CHtml::tag('option', array('value' => ''), 'Seleccione', true);

        foreach ($user as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionUserService() {
        $customerid = $_GET['customerid'];
        $entry = $_GET['entryid'];
        $user = CHtml::listData(Usercustomerpermission::model()->getuserservicebyCustomer($customerid, $entry), 'userid', 'usercompletename');
        echo CHtml::tag('option', array('value' => ''), 'Seleccione', true);

        foreach ($user as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionItemdetailvalue() {
        $detailvalue = CHtml::listData(Itemdetailvalue::model()->findAllbyAttributes(array('itemdetailid' => $_GET['itemdetailid'])), 'itemdetailvalueid', 'itemdetailvaluedsc');
        echo CHtml::tag('option', array('value' => ''), '', true);

        foreach ($detailvalue as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionService() {
        $service = CHtml::listData(Service::model()->findAllbyAttributes(array("companyid" => Yii::app()->user->companyid, "serviceparentid" => $_GET['pid'], "active" => 1)), 'serviceid', 'servicedsc');
        foreach ($service as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionUser1() {
        $users = Utils::decrypt($_GET['usertype'], 'user');
        $usertype = CHtml::listData(Usertype::model()->getalltype(), 'usertype', 'usertypedsc');
        foreach ($usertype as $valor => $descripcion) {
            if ($valor == $users && $valor != 4) {
                echo CHtml::tag('option', array('value' => $valor, 'selected' => 'selected'), CHtml::encode($descripcion), true);
            } else {
                if ($valor != 4) {
                    echo CHtml::tag('option', array('value' => Utils::encrypt($valor, 'user')), CHtml::encode($descripcion), true);
                }
            }
        }
    }

    public function actionUser2() {

        $usertype = CHtml::listData(Usertype::model()->getalltype(), 'usertype', 'usertypedsc');
        foreach ($usertype as $valor => $descripcion) {
            if ($valor != 4) {
                echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
            }
        }
    }

    public function actionCountrystate() {

        $countrylist = CHtml::listData(State::model()->findAllbyAttributes(array("countryid" => $_POST['countryid'])), 'stateid', 'statedsc');

        foreach ($countrylist as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor, 'class' => 'smod'), CHtml::encode($descripcion), true);
        }
    }
    
     public function actionCountrystate1() {

        $countrylist = CHtml::listData(State::model()->findAllbyAttributes(array("countryid" => $_POST['countryid'])), 'stateid', 'statedsc');

        foreach ($countrylist as $valor => $descripcion) {
            
              if ($valor == $_POST['stateid']) {
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'smod', 'selected' => 'selected'), CHtml::encode($descripcion), true);
            } else {
            
                 echo CHtml::tag('option', array('value' => $valor, 'class' => 'smod'), CHtml::encode($descripcion), true);
            }
        }
    }


    public function actionStatecity() {

        $citylist = CHtml::listData(City::model()->findAllbyAttributes(array("stateid" => $_POST['stateid'])), 'cityid', 'citydsc');

        foreach ($citylist as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor, 'class' => 'smod'), CHtml::encode($descripcion), true);
        }
    }
    
    public function actionStatecity1() {

        $citylist = CHtml::listData(City::model()->findAllbyAttributes(array("stateid" => $_POST['stateid'])), 'cityid', 'citydsc');

        foreach ($citylist as $valor => $descripcion) {
             if ($valor == $_POST['cityid']) {
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'smod', 'selected' => 'selected'), CHtml::encode($descripcion), true);
            } else {
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'smod'), CHtml::encode($descripcion), true);
            }
        }
    }

    public function actionCustomers() {

        $citylist = CHtml::listData(Usercustomerpermission::model()->getCustomerbyUser(Yii::app()->user->userid, Yii::app()->user->companyid), 'customerid', 'customerdsc');

        foreach ($citylist as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
        }
    }

    public function actionProfile() {

        $profilelist = CHtml::listData(Profile::model()->findAllbyAttributes(array("active" => 1)), 'profileid', 'profiledsc');

        foreach ($profilelist as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
        }
    }

    public function actionCompany() {

        $companylist = CHtml::listData(Company::model()->findAllbyAttributes(array("active" => 1)), 'companyid', 'companydsc');

        foreach ($companylist as $valor => $descripcion) {

            echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
        }
    }
    
    public function actionSupplier() {

       $supplierlist = CHtml::listData(Supplier::model()->findAllbyAttributes(array("active" => 1, "companyid"=>$_POST['companyid'])), 'supplierid', 'supplierdsc');

        foreach ($supplierlist as $valor => $descripcion) {

            echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
        }
    }

    public function actionProfileselec() {
        $usr = User::model()->findAllbyAttributes(array("active" => 1, "userid" => $_POST['userid']));
        $profilelist = CHtml::listData(Profile::model()->findAllbyAttributes(array("active" => 1)), 'profileid', 'profiledsc');

        foreach ($profilelist as $valor => $descripcion) {
            if ($valor == $usr[0]['profileid']) {
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr', 'selected' => 'selected'), CHtml::encode($descripcion), true);
            } else {
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
            }
        }
    }

    public function actionCompanyselec() {
        $sup = Supplieruser::model()->findAllByAttributes(array( "userid" => $_POST['userid']));
        
        $comp=  Supplier::model()->findAllByAttributes(array("supplierid"=>$sup[0]['supplierid']));
        
        $companylist = CHtml::listData(Company::model()->findAllbyAttributes(array("active" => 1)), 'companyid', 'companydsc');

        foreach ($companylist as $valor => $descripcion) {
            if ($valor == $comp[0]['companyid']) {
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr', 'selected' => 'selected'), CHtml::encode($descripcion), true);
            } else {
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
            }
        }
    }
    
    public function actionServicecatego() {
      
        $supplierlist = CHtml::listData(Service::model()->getSupplierService3(Yii::app()->user->companyid,Yii::app()->user->userid), 'serviceid', 'servicedsc');
        echo '<option value="-1">Seleccione un Categoria</option>';
        foreach ($supplierlist as $valor => $descripcion) {
                 
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
            
        }
    }
    
    public function actionServicecategoservi() {
      
        $supplierlist = CHtml::listData(Service::model()->getSupplierService4(Yii::app()->user->companyid,Yii::app()->user->userid,$_POST['serviceid']), 'serviceid', 'servicedsc');

        foreach ($supplierlist as $valor => $descripcion) {
            
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
            
        }
    }
    
    public function actionSupplierselec() {
        $sup = Supplieruser::model()->findAllByAttributes(array( "userid" => $_POST['userid']));
        $supplierlist = CHtml::listData(Supplier::model()->findAllbyAttributes(array("active" => 1)), 'supplierid', 'supplierdsc');

        foreach ($supplierlist as $valor => $descripcion) {
            if ($valor == $sup[0]['supplierid']) {
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr', 'selected' => 'selected'), CHtml::encode($descripcion), true);
            } else {
                echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
            }
        }
    }

    public function actionSupplybyServices() {
        $serviceid = $_POST['serviceid'];
        $supplylist = CHtml::listData(Rateodc::model()->getSearch_list($serviceid), 'supplierid', 'supplierdsc');

        foreach ($supplylist as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
        }
    }

    public function actionSupplybyServices2() {
        $serviceid = $_POST['serviceid'];
        $customerid = $_POST['customerid'];
        $supplylist = CHtml::listData(Rateodc::model()->getSearch_list2($serviceid, $customerid), 'supplierid', 'supplierdsc');

        foreach ($supplylist as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor, 'class' => 'clear_shr'), CHtml::encode($descripcion), true);
        }
    }

    public function actionServicedetail() {
        $servicedetail = Itemdetail::model()->getServiceDetail($_GET['sid'], $_GET['cid']);

        foreach ($servicedetail as $sd) {
            $checked = ($sd->servicedetailid != null) ? " checked " : "";
            echo '<div><input type="checkbox" id="id_' . $sd->itemdetailid . '" ' . $checked . ' ><label for="id_' . $sd->itemdetailid . '" > ' . $sd->itemdetaildsc . '</label></div>';
        }
        echo '<div style="text-align:center; margin-top:10px; margin-bottom:10px;"><button type="submit" id="addservicedetail" class="btn btn-primary">Asignar Atributos</button></div>';
    }

    public function actionMenu() {
        $menu_model = new Menu();
        $smenudb = $menu_model->qryMenu(array('usertype' => $_POST['usertype']));
        foreach ($smenudb as $row) {
            echo CHtml::tag('option', array('value' => $row->menuid), CHtml::encode($row->menudsc), true);
        }
    }

    public function actionSmenu() {
        $menu_model = new Menu();
        $smenudb = $menu_model->qrySmenu1(array('usertype' => $_GET['usertype'], 'menuparentid' => $_GET['menuparentid'], 'userid' => $_GET['userid']));
        $cont = 0;
        $userid = $_GET['userid'];
        foreach ($smenudb as $row) {
            $chk_read = ($row->menuread == 1) ? 'checked' : '';
            $chk_add = ($row->menuadd == 1) ? 'checked' : '';
            $chk_edit = ($row->menuedit == 1) ? 'checked' : '';
            $chk_dlt = ($row->menudelete == 1) ? 'checked' : '';
            $btn = ($row->countpermission > 0) ? '<button type="button" onclick="specialpermission(' . $row->menuid . ',' . $userid . ');" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-circle-arrow-right"></span></button>' : '';

            $output[$cont]['dsc'] = $row->menudsc;
            $output[$cont]['ver'] = '<input onchange="savepermission(this.id,' . $userid . ');" type="checkbox" ' . $chk_read . ' data-userid="' . $userid . '" data-menuop="menuread" data-menuparentid="' . $row->menuparentid . '" data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="ver_' . $row->menuid . '" class="ver_smodules">';
            $output[$cont]['agr'] = '<input onchange="savepermission(this.id,' . $userid . ');" type="checkbox" ' . $chk_add . '  data-userid="' . $userid . '" data-menuop="menuadd" data-menuparentid="' . $row->menuparentid . '"  data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="agr_' . $row->menuid . '" class="add_smodules">';
            $output[$cont]['edi'] = '<input onchange="savepermission(this.id,' . $userid . ');" type="checkbox" ' . $chk_edit . ' data-userid="' . $userid . '" data-menuop="menuedit" data-menuparentid="' . $row->menuparentid . '" data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="edi_' . $row->menuid . '" class="upd_smodules">';
            $output[$cont]['eli'] = '<input onchange="savepermission(this.id,' . $userid . ');" type="checkbox" ' . $chk_dlt . '  data-userid="' . $userid . '" data-menuop="menudelete" data-menuparentid="' . $row->menuparentid . '" data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="eli_' . $row->menuid . '" class="del_smodules">';
            $output[$cont]['btn'] = $btn;
            $cont++;
        }
        $output = array('aaData' => $output);
        echo json_encode($output);
    }

    public function actionSmenu1() {
        $menu_model = new Menu();
        $smenudb = $menu_model->qrySmenu(array('usertype' => $_GET['usertype'], 'menuparentid' => $_GET['menuparentid'], 'userid' => $_GET['userid']));
        $cont = 0;
        $userid = $_GET['userid'];
         $edit= Utils::decrypt($_GET['edit'], 'user');
        $activado = "";
        if ($edit == 0) {
            $activado = "disabled";
        }

        foreach ($smenudb as $row) {
            
            $chk_read = ($row->menuread == 1) ? 'checked' : '';
            $chk_add = ($row->menuadd == 1) ? 'checked' : '';
            $chk_edit = ($row->menuedit == 1) ? 'checked' : '';
            $chk_dlt = ($row->menudelete == 1) ? 'checked' : '';
            $btn = ($row->countpermission > 0) ? '<button type="button" onclick="specialpermission(' . $row->menuid . ',' . $userid . ');" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-circle-arrow-right"></span></button>' : '';

            $output[$cont]['dsc'] = $row->menudsc;
            $output[$cont]['ver'] = '<input onchange="savepermission(this.id,' . $userid . ');" '.$activado.' type="checkbox" ' . $chk_read . ' data-userid="' . $userid . '" data-menuop="menuread" data-menuparentid="' . $row->menuparentid . '" data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="ver_' . $row->menuid . '" class="ver_smodules">';
            $output[$cont]['agr'] = '<input onchange="savepermission(this.id,' . $userid . ');" '.$activado.' type="checkbox" ' . $chk_add . '  data-userid="' . $userid . '" data-menuop="menuadd" data-menuparentid="' . $row->menuparentid . '"  data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="agr_' . $row->menuid . '" class="add_smodules">';
            $output[$cont]['edi'] = '<input onchange="savepermission(this.id,' . $userid . ');" '.$activado.' type="checkbox" ' . $chk_edit . ' data-userid="' . $userid . '" data-menuop="menuedit" data-menuparentid="' . $row->menuparentid . '" data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="edi_' . $row->menuid . '" class="upd_smodules">';
            $output[$cont]['eli'] = '<input onchange="savepermission(this.id,' . $userid . ');" '.$activado.' type="checkbox" ' . $chk_dlt . '  data-userid="' . $userid . '" data-menuop="menudelete" data-menuparentid="' . $row->menuparentid . '" data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="eli_' . $row->menuid . '" class="del_smodules">';
            $output[$cont]['btn'] = $btn;
            $cont++;
        }
        $output = array('aaData' => $output);
        echo json_encode($output);
    }

    public function actionPermissiongroup() {
        $model = new Permission();
        $permisos = $model->permissiongroup(array('menuid' => $_POST['menuid']));
        foreach ($permisos as $row) {
            echo CHtml::tag('option', array('value' => $row->menuid, 'data-userid' => $_POST['userid']), CHtml::encode($row->permissiongroup), true);
        }
    }

    public function actionPermissions() {
        $model = new Permission();
        $permiso = $model->permissions(array('menuid' => $_GET[menuid], 'group' => $_GET[group], 'userid' => $_GET[userid]));

        $cont = 0;
        foreach ($permiso as $row) {
            $chk = ($row->active == 1) ? 'checked' : '';
            $output[$cont]['dsc'] = '<input onchange="savespecialpermission(this.id,' . $_GET[userid] . ',' . $row->permissionid . ',' . $row->specialpermissionid . ');" type="checkbox" ' . $chk . ' id="per_' . $row->permissionid . '"><label>' . $row->permissiondsc . '</label>';
            $cont++;
        }
        $output = array('aaData' => $output);
        echo json_encode($output);
    }

    public function actionSmenumodal() {
        $menu_model = new Menu();
        $smenudb = $menu_model->qrySmenumod(array('usertype' => $_GET['usertype'], 'menuparentid' => $_GET['menuparentid'], 'userid' => $_GET['userid']));
        $cont = 0;
        $userid = $_GET['userid'];
         $edit= Utils::decrypt($_GET['edit'], 'user');
        $activado = "";
        if ($edit == 0) {
            $activado = "disabled";
        }
        
        foreach ($smenudb as $row) {
            $chk_read = ($row->menuread == 1) ? 'checked' : '';
            $chk_add = ($row->menuadd == 1) ? 'checked' : '';
            $chk_edit = ($row->menuedit == 1) ? 'checked' : '';
            $chk_dlt = ($row->menudelete == 1) ? 'checked' : '';
            $btn = ($row->countpermission > 0) ? '<button type="button" onclick="specialpermission_1(' . $row->menuid . ',1)" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-circle-arrow-right"></span></button>' : '';

            $output[$cont]['dsc'] = $row->menudsc;
            $output[$cont]['ver'] = '<input onchange="savepermission_1(\'menuread\',' . $userid . ',' . $row->menuid . ',this.id);" type="checkbox" ' . $chk_read . ' data-userid="' . $userid . '" data-menuop="menuread" data-menuparentid="' . $row->menuparentid . '" data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="ver_' . $row->menuid . '" class="ver_smodules">';
            $output[$cont]['agr'] = '<input onchange="savepermission_1(\'menuadd\',' . $userid . ',' . $row->menuid . ',this.id);" type="checkbox" ' . $chk_add . '  data-userid="' . $userid . '" data-menuop="menuadd" data-menuparentid="' . $row->menuparentid . '"  data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="agr_' . $row->menuid . '" class="add_smodules">';
            $output[$cont]['edi'] = '<input onchange="savepermission_1(\'menuedit\',' . $userid . ',' . $row->menuid . ',this.id);" type="checkbox" ' . $chk_edit . ' data-userid="' . $userid . '" data-menuop="menuedit" data-menuparentid="' . $row->menuparentid . '" data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="edi_' . $row->menuid . '" class="upd_smodules">';
            $output[$cont]['eli'] = '<input onchange="savepermission_1(\'menudelete\',' . $userid . ',' . $row->menuid . ',this.id);" type="checkbox" ' . $chk_dlt . '  data-userid="' . $userid . '" data-menuop="menudelete" data-menuparentid="' . $row->menuparentid . '" data-menuid="' . $row->menuid . '" data-idp="' . $row->userprivilegeid . '" id="eli_' . $row->menuid . '" class="del_smodules">';
            $output[$cont]['spe'] = $btn;
            $cont++;
        }
        $output = array('aaData' => $output);
        echo json_encode($output);
    }

    public function actionPermissiongroupmodal() {
        $model = new Permission();
        $permisos = $model->permissiongroupmodel(array('menuid' => $_POST['menuid']));
        $cont = 1;
        foreach ($permisos as $row) {
            echo CHtml::tag('option', array('id' => "df_" . $cont, 'value' => $cont, 'data-listdsc' => $row->permissiondsc, 'data-listid' => $row->permissionid), CHtml::encode($row->permissiongroup), true);
            $cont = $cont + 1;
        }
    }
    public function actionArea() {
        $area = CHtml::listData(Todoarea::model()->findAllByAttributes(array('active'=>'1')), 'areaid', 'areadsc');
        
        echo CHtml::tag('option', array('value' => '-1', 'selected' => 'selected'), 'Seleccione', true);

        foreach ($area as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }
    public function actionResponsable() {
        $responsable = CHtml::listData(Todoarea::model()->getResponsable(), 'userid', 'responsable');
        
        echo CHtml::tag('option', array('value' => ''), 'Seleccione', true);

        foreach ($responsable as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }
    public function actionUserarea() {
     $model= new Userarea();    
        $areaid = $_POST['areaid'];
        $responsable = $model->getResponsable(array('areaid' => $areaid));
        //echo count($responsable);
        echo '<option value="">Seleccione</option>';
        //echo '<option value"">'.count($responsable).'</option>';
        
        

        foreach ($responsable as $fila) {
            echo '<option value="'.$fila->userid.'">'.$fila->responsable.'</option>';
            //echo '<option value="'.$fila->userid.'">'.$fila->responsable.'</option>';
            //echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }
}
