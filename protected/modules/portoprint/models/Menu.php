<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property string $menuid
 * @property string $menudsc
 * @property integer $menuparentid
 * @property string $menulink
 * @property integer $menuorder
 * @property integer $usertype
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Menuprofile[] $menuprofiles
 * @property Permission[] $permissions
 * @property Profileprivilege[] $profileprivileges
 * @property Userprivilege[] $userprivileges
 */
class Menu extends CActiveRecord
{
    //Variables para menu
    public $menuread; 
    public $menuadd;
    public $menuedit;
    public $menudelete;
    public $userprivilegeid;
    public $permission;
    public $leer;
    public $countpermission;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menuparentid, menuorder, usertype, active', 'numerical', 'integerOnly'=>true),
			array('menudsc', 'length', 'max'=>50),
			array('menulink', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menuid, menudsc, menuparentid, menulink, menuorder, usertype, active', 'safe', 'on'=>'search'),
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
			'menuprofiles' => array(self::HAS_MANY, 'Menuprofile', 'menuid'),
			'permissions' => array(self::HAS_MANY, 'Permission', 'menuid'),
			'profileprivileges' => array(self::HAS_MANY, 'Profileprivilege', 'menuid'),
			'userprivileges' => array(self::HAS_MANY, 'Userprivilege', 'menuid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'menuid' => 'Menuid',
			'menudsc' => 'Menudsc',
			'menuparentid' => 'Menuparentid',
			'menulink' => 'Menulink',
			'menuorder' => 'Menuorder',
			'usertype' => 'Usertype',
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

		$criteria->compare('menuid',$this->menuid,true);
		$criteria->compare('menudsc',$this->menudsc,true);
		$criteria->compare('menuparentid',$this->menuparentid);
		$criteria->compare('menulink',$this->menulink,true);
		$criteria->compare('menuorder',$this->menuorder);
		$criteria->compare('usertype',$this->usertype);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function qryMenu($data) {
            $criteria=new CDbCriteria;
            
            $criteria->select = "t.*";
            $criteria->join = "INNER JOIN usertypemenu tm on tm.menuid = t.menuid";
            $criteria->condition = 'tm.usertype = '.$data['usertype'].' AND active = 1 AND t.level=0';
            $criteria->order = "t.menuorder ASC";
            return $this->findAll($criteria);
        }
         public function qryMenus($data,$userid) {
            $criteria=new CDbCriteria;
            
            $criteria->select = "t.*,CONCAT(up.menuid,'_',up.menuadd,'_',up.menuedit,'_',up.menudelete) as leer";
            $criteria->join = "INNER JOIN usertypemenu tm on tm.menuid = t.menuid"
                            . " INNER JOIN userprivilege up on up.menuid=t.menuid and up.menuread=1 and up.userid={$userid}";
            $criteria->condition = "tm.usertype = {$data} AND active = 1 AND t.menudsc='Cotizaciones' ";
            $criteria->order = "t.menuorder ASC";
            
            
            return $this->findAll($criteria);
        }
        
       public function qrySmenu($data) {
            $criteria=new CDbCriteria;
            
            $criteria->select = "t.*,CONCAT(up.menuid,'_',up.menuadd,'_',up.menuedit,'_',up.menudelete) as leer";
            $criteria->join = "INNER JOIN usertypemenu tm on t.menuid = tm.menuid"
                            . " INNER JOIN userprivilege up on up.menuid=t.menuid and up.menuread=1 and up.userid={$data['userid']}";
            $criteria->condition = 't.menuparentid = '.$data['menuparentid'].' AND tm.usertype = '.$data['usertype'].' AND t.active = 1 AND t.level = 1';
            $criteria->order = "menuorder ASC";
            return $this->findAll($criteria);
        }
         public function qrySmenu1($data) {
            $criteria=new CDbCriteria;
            
            $criteria->select = "t.*,if(up.menuid is null,t.menuid,up.menuid)as menuid,up.menuread,up.menuadd,up.menuedit,up.menudelete, 
                               (select count(p.permissionid) from permission p  where p.menuid=up.menuid)as countpermission";
            $criteria->join = "INNER JOIN usertypemenu tm on t.menuid = tm.menuid"
                            . " LEFT JOIN userprivilege up on up.menuid=t.menuid and up.userid={$data['userid']}";
            $criteria->condition = '(t.menuid = '.$data['menuparentid'].' OR t.menuparentid = '.$data['menuparentid'].') AND tm.usertype = '.$data['usertype'].' AND t.active = 1';
            $criteria->order = "menuorder ASC";
            return $this->findAll($criteria);
        }
        public function qrySmenumod($data) {
          $criteria=new CDbCriteria;
            
            $criteria->select = "t.*,up.menuread,up.menuadd,up.menuedit,up.menudelete, 
                               (select count(p.permissionid) from permission p  where p.menuid=t.menuid)as countpermission";
            $criteria->join = "INNER JOIN usertypemenu tm on t.menuid = tm.menuid"
                            . " LEFT JOIN userprivilege up on up.menuid=t.menuid and up.userid={$data['userid']}";
            $criteria->condition = '(t.menuid = '.$data['menuparentid'].' OR t.menuparentid = '.$data['menuparentid'].') AND tm.usertype = '.$data['usertype'].' AND t.active = 1';
            $criteria->order = "menuorder ASC";
            return $this->findAll($criteria);
        }
}