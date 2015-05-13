<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $userid
 * @property string $username
 * @property string $password
 * @property integer $usertype
 * @property integer $profileid
 * @property string $active
 *
 * The followings are the available model relations:
 * @property Customeruser $customeruser
 * @property Employeeuser $employeeuser
 * @property Rate[] $rates
 * @property Specialpermission[] $specialpermissions
 * @property Supplieruser $supplieruser
 * @property Usertype $usertype0
 * @property Userbrandpermission[] $userbrandpermissions
 * @property Usercompanypermission[] $usercompanypermissions
 * @property Usercontactpermission[] $usercontactpermissions
 * @property Usercustomerpermission[] $usercustomerpermissions
 * @property Userprivilege[] $userprivileges
 * @property Userservice[] $userservices
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
            public $firstname;
            public $mlastname;
            public $plastname;
            public $companydsc;
            public $companyid;
            public $usercompanypermissionid;
            public $corporatename;
             
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usertype', 'required'),
			array('usertype, profileid', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>50),
			array('active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, username, password, usertype, profileid, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customeruser' => array(self::HAS_ONE, 'Customeruser', 'userid'),
			'employeeuser' => array(self::HAS_ONE, 'Employeeuser', 'userid'),
			'rates' => array(self::HAS_MANY, 'Rate', 'userid'),
			'specialpermissions' => array(self::HAS_MANY, 'Specialpermission', 'userid'),
			'supplieruser' => array(self::HAS_ONE, 'Supplieruser', 'userid'),
			'usertype0' => array(self::BELONGS_TO, 'Usertype', 'usertype'),
			'userbrandpermissions' => array(self::HAS_MANY, 'Userbrandpermission', 'userid'),
			'usercompanypermissions' => array(self::HAS_MANY, 'Usercompanypermission', 'userid'),
			'usercontactpermissions' => array(self::HAS_MANY, 'Usercontactpermission', 'userid'),
			'usercustomerpermissions' => array(self::HAS_MANY, 'Usercustomerpermission', 'userid'),
			'userprivileges' => array(self::HAS_MANY, 'Userprivilege', 'userid'),
			'userservices' => array(self::HAS_MANY, 'Userservice', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => 'Userid',
			'username' => 'Username',
			'password' => 'Password',
			'usertype' => 'Usertype',
			'profileid' => 'Profileid',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('userid',$this->userid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('usertype',$this->usertype);
		$criteria->compare('profileid',$this->profileid);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getAllusers( $usertype, $edit, $del)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                
		$criteria=new CDbCriteria;
                $criteria->select="t.userid, t.username, t.password,t.key, t.profileid,
                    if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname)as firstname,
                    if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname)as plastname,
                    if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname)as mlastname,
                    GROUP_CONCAT(c.companyid SEPARATOR '-') as companyid,
                    
                    GROUP_CONCAT(c.companydsc SEPARATOR '-') as companydsc";
                $criteria->join="left join employeeuser eu on eu.userid=t.userid
                            left join customeruser cu on cu.userid=t.userid
                            left join supplieruser su on su.userid=t.userid
                            left join usercompanypermission ucp on ucp.userid=t.userid 
                            left join company c on c.companyid=ucp.companyid";
		$criteria->condition = "t.active = 1 and t.usertype=".$usertype;
		$criteria->group = 't.userid';	
		
		$cont=0;
		 $results =  $this->findAll($criteria);
                 $flag_active=0;
               if(count($results)>0){
                    foreach($results as $row)
                    {
                         
                         if($edit==1){ $output[$cont]['namecomp'] = "<div style='float:left;' id='".$row->userid."_name' data-target='#newproject4'  data-toggle='modal' >".$row->firstname.' '.$row->plastname.' '.$row->mlastname."</div>";
                                        $output[$cont]['usuario'] = "<div style='float:left;' id='".$row->userid."_username' data-target='#newproject4'  data-toggle='modal' >".$row->username."</div>";
                                        
                          }else{
                                           $output[$cont]['namecomp'] = $row->firstname.' '.$row->plastname.' '.$row->mlastname; 
                                            $output[$cont]['usuario'] = $row->username;
                                        }
                          
                         
                          $output[$cont]['password'] =$row->password;
                        //$output[$cont]['password'] ='<a href="#newproject" class="btn btn-danger" id="btnreset" data-target="#newproject"  data-toggle="modal"><i class="glyphicon glyphicon-off"></i>&nbsp;Resetear</a>';
                          $output[$cont]['usertype'] =$row->username;
                          
                          $compani= Yii::app()->user->companyid;
                          $evt=explode("-",$row->companyid);
                          $usercompany=  Usercompanypermission::model()->getCompanyUser($compani,$row->userid);
                         $activado = "";
                            if ($edit == 0) {
                                $activado = "disabled";
                            }
                          if(in_array($compani, $evt) && $usercompany[0]['active']==1 ){
                            
                              
                                $output[$cont]['compania'] ='<div class="input-group"><span class="input-group-addon"><input type="checkbox" id="btncompania_'.$row->userid.'" onclick="valid_compan(this.id)" data-newid="'.$usercompany[0]['usercompanypermissionid'].'" data-ids="'.$row->userid.'" value="'.Utils::encrypt($row->userid,"user").','.Utils::encrypt(Yii::app()->user->companyid,"user").'" '.$activado.' checked></span><label class="form-control">'.Yii::app()->user->companydsc.'</label></div>';
                                $flag_active=0;
                                
                             }else{
                              
                              $output[$cont]['compania'] ='<div class="input-group"><span class="input-group-addon"><input type="checkbox" id="btncompania_'.$row->userid.'" onclick="valid_compan(this.id)" data-ids="'.$row->userid.'" value="'.Utils::encrypt($row->userid,"user").','.Utils::encrypt(Yii::app()->user->companyid,"user").'" '.$activado.' ></span><label class="form-control">'.Yii::app()->user->companydsc.'</label></div>';
                               $flag_active=1;
                          }
                         $checked="";
                          if($flag_active==1){
                              $checked='disabled';
                          }else{
                              $checked="";
                          }
                          
                          $model=new Service();
                          $num=array();
                          $num1=array();
                          $cont1=0;
                          $num2='';
                         $list=$model->getSupplierService1(Yii::app()->user->companyid);
                            foreach($list as $row1){
                                      $num1[]=$row1->serviceid;
                                      $num[$cont1][0]= $row1->serviceid;
                                      $num[$cont1][1]=$row1->servicedsc;
                                      $num[$cont1][2]='0';
                                      $num[$cont1][3]='';
                                      $cont1=$cont1+1;
                                 }
                           $list2=$model->getSupplierService2($row->userid);
                           foreach($list2 as $row2){
                                if(in_array($row2->serviceid, $num1)){
                                        $clave=array_search($row2->serviceid, $num1);
                                        $num[$clave][2]='1';
                                        $num[$clave][3]=$row2->userserviceid;
                                    }
                                 }
                            $cadena=' ';     
                           for($i=0;$i<count($num);$i++){
                               if($cadena==' '){
                                   $cadena= $num[$i][0].'-'.$num[$i][1].'-'.$num[$i][2].'-'.$num[$i][3].'-'.$row->userid;
                               }else{
                                   $cadena=$cadena.','.$num[$i][0].'-'.$num[$i][1].'-'.$num[$i][2].'-'.$num[$i][3].'-'.$row->userid;
                               }
                               
                           } 
                                 
                          $output[$cont]['categoria'] ='<div id="divbtncatego_'.$row->userid.'"><a href="#newproject" class="btn btn-primary" id="btncatego_'.$row->userid.'" data-ids="'.$cadena.'" onclick="list_categor(this.id)" data-nam="'.$row->firstname.' '.$row->plastname.'" data-target="#newproject"  data-toggle="modal" '.$checked.'>Categorias</a></div>';
                          
                           
                          $num3=' ';
                          $lt=array();
                          $lt1=array();
                          $cont2=0;
                          $fullcustomer = Customer::model()->findAllByAttributes(array("companyid"=>Yii::app()->user->companyid,"active"=>1));
                          $list_custom=  Usercustomerpermission::model()->findAllByAttributes(array("userid"=>$row->userid,"active"=>1));
                          
                           for($i=0; $i < count($list_custom);$i++){
                               $lt[$cont2]=$list_custom[$i]['customerid'];
                               $lt1[$cont2]=$list_custom[$i]['usercustomerpermissionid'];
                                $cont2= $cont2+1;
                           }
                          
                          
                          for($i=0; $i < count($fullcustomer);$i++){
                              if($num3==' '){
                                     $num3=$fullcustomer[$i]['customerid'];
                                     $num3=$num3.'-'.$fullcustomer[$i]['customerdsc'];
                                   if(in_array($fullcustomer[$i]['customerid'], $lt)){
                                        $clave=array_search($fullcustomer[$i]['customerid'], $lt);
                                        $num3=$num3.'-'.'1'.'-'.$lt1[$clave].'-'.$row->userid;
                                    }else{
                                        $num3=$num3.'-'.'0'.'--'.$row->userid;
                                    }
                              }else{
                                   $num3=$num3.','.$fullcustomer[$i]['customerid'];
                                     $num3=$num3.'-'.$fullcustomer[$i]['customerdsc'];
                                   if(in_array($fullcustomer[$i]['customerid'], $lt)){
                                        $clave=array_search($fullcustomer[$i]['customerid'], $lt);
                                        $num3=$num3.'-'.'1'.'-'.$lt1[$clave].'-'.$row->userid;
                                    }else{
                                        $num3=$num3.'-'.'0'.'--'.$row->userid;
                                    }
                              }
                                    
                        }
                                 
                       
                          $output[$cont]['clientes'] ='<div id="divbtncustomer_'.$row->userid.'"><a href="#newproject1" class="btn btn-primary" id="btncustomer_'.$row->userid.'" data-ids="'.$num3.'" data-nam="'.$row->firstname.' '.$row->plastname.'" onclick="list_customer(this.id)" data-target="#newproject1"  data-toggle="modal" '.$checked.'>Clientes</a></div>';
                          $output[$cont]['permisos'] ='<div id="divbtnpermis_'.$row->userid.'"><a href="#newproject2" class="btn btn-primary" id="btnpermis_'.$row->userid.'" data-target="#newproject2" data-nam="'.$row->firstname.' '.$row->plastname.'" onclick="list_permision(this.id)"  data-toggle="modal" '.$checked.'>Permisos</a>';
                          
                          if($del==1){ $output[$cont]['status'] ='<div id="divbtndelet_'.$row->userid.'"><a  class="btn btn-danger" id="divbtndelet_'.$row->userid.'" onclick="delet_user(this.id)"  '.$checked.'><i class="glyphicon glyphicon-remove"></i></a>';}
                          $cont=$cont+1;
                    }
                }else{
                    
                     $output = 0;
                }
                $output = array('aaData'=>$output ) ;
		return $output;

	}
        
        
        
          public function getAllsupplierusr( $usertype, $edit, $del)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                
		$criteria=new CDbCriteria;
                $criteria->select="t.userid,t.username,t.password, su.firstname, su.plastname, s.supplierdsc, s.companyid,s.corporatename";
                $criteria->join="inner join supplieruser su on su.userid=t.userid
                                inner join supplier s on s.supplierid=su.supplierid
                                left join company c on c.companyid=s.companyid";
		$criteria->condition = "t.usertype=2 ";
		//$criteria->group = 't.userid';	
		
		$cont=0;
		 $results =  $this->findAll($criteria);
                 $flag_active=0;
               if(count($results)>0){
                    foreach($results as $row)
                    {
                         if($edit==1){ 
                             $output[$cont]['namecomp'] = "<div style='float:left; cursor:pointer;' id='".$row->userid."_name' class='edt_supli' data-target='#newproject4'  data-toggle='modal' >".$row->firstname.' '.$row->plastname.' '.$row->mlastname."</div>";
                             $output[$cont]['usuario'] = "<div style='float:left; cursor:pointer;' id='".$row->userid."_username' class='edt_supli' data-target='#newproject4'  data-toggle='modal' >".$row->username."</div>";
                                        
                          }else{
                            $output[$cont]['namecomp'] = $row->firstname.' '.$row->plastname.' '.$row->mlastname; 
                            $output[$cont]['usuario'] = $row->username;
                          }
                          
                         
                          $output[$cont]['password'] =$row->password;
                          
                          $compani= Yii::app()->user->companyid;
                          $activado = "";
                            if ($edit == 0) {
                                $activado = "disabled";
                            }
                        
                              if($compani==$row->companyid){
                                 $output[$cont]['compania'] ='<div class="input-group"><span class="input-group-addon"><input type="checkbox" id="btncompania_'.$row->userid.'_'.Yii::app()->user->companyid.'" onclick="valid_compan_supplier(this.id)"  data-ids="'.$row->userid.'" value="'.Utils::encrypt($row->userid,"user").','.Utils::encrypt(Yii::app()->user->companyid,"user").'" '.$activado.' checked></span><label class="form-control">'.Yii::app()->user->companydsc.'</label></div>';
                              }else{
                                 $output[$cont]['compania'] ='<div class="input-group"><span class="input-group-addon"><input type="checkbox" id="btncompania_'.$row->userid.'_'.Yii::app()->user->companyid.'" onclick="valid_compan_supplier(this.id)"  data-ids="'.$row->userid.'" value="'.Utils::encrypt($row->userid,"user").','.Utils::encrypt(Yii::app()->user->companyid,"user").'" '.$activado.' ></span><label class="form-control">'.Yii::app()->user->companydsc.'</label></div>';
                              }
                              
                             $output[$cont]['proveedor'] =$row->corporatename;
                                
                         
                         
                          if($del==1){ 
                              $output[$cont]['status'] ='<div id="divbtndelet_'.$row->userid.'"><a  class="btn btn-danger" id="divbtndelet_'.$row->userid.'" onclick="delet_user(this.id)"  '.$activado.'><i class="glyphicon glyphicon-remove"></i></a>';
                              
                            }
                                $cont=$cont+1;
                            }
                }else{
                    
                     $output = 0;
                }
                $output = array('aaData'=>$output ) ;
		return $output;

	}
        
        
        
        
        public function Validar_user() {
            $criteria=new CDbCriteria;
            $criteria->select="userid, username";
            
        }
        
         public function validar_campo($lista){
            
            $criteria=new CDbCriteria;
            $cadena=" ";
            foreach ($lista as $valor => $descripcion){
                        if($cadena==" "){
                            $cadena=" t.".$valor." = '".  Utils::decrypt($descripcion, 'user')."'";
                        }else{
                            $cadena=$cadena."and"." t.".$valor." = '".Utils::decrypt($descripcion, 'user')."'";
                        }
                    }
            $condition = $cadena;
            return $this->find($condition);
        }
        
        public function validar_username($valor){
            
            $criteria=new CDbCriteria;
            $cadena=" t.username = '".$valor."'";
                        
                   
            $condition = $cadena;
            return $this->find($condition);
        }
        public function getResponsable($areaid) {
        $criteria = new CDbCriteria;
        $criteria->select = "t.userid,
                            CONCAT(
                            if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
                            if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
                            if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable";
        $criteria->join = "left join employeeuser eu on eu.userid = t.userid
                          left join customeruser cu on cu.userid = t.userid
                          left join supplieruser su on su.userid = t.userid
                          INNER JOIN userarea a on a.userid = t.userid";
        $criteria->condition ="a.areaid = ".$areaid;
        $criteria->order ="responsable";
        return $this->findAll($criteria);
     //return 'areaid'.$areaid;
    }
}