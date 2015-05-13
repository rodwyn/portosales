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
    public $nuser;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
        /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function validate_user($data)
	{ //echo 'validate_user';
		// Warning: Please modify the following code to remove attributes that
		// should not bes searched.

		$criteria=new CDbCriteria;
                $criteria->select = "COUNT(t.userid) AS nuser";
                $criteria->join = "LEFT JOIN employeeuser e on e.userid = t.userid
                                   LEFT JOIN supplieruser su on su.userid = t.userid
                                   LEFT JOIN supplier  s on s.supplierid = su.supplierid
                                   LEFT JOIN customeruser cu on cu.userid=t.userid
                                   LEFT JOIN customer c on c.customerid=cu.customerid";
                $criteria->condition = "t.username = '".$data['username']."' AND (s.email = '".$data['email']."' OR e.email = '".$data['email']."' OR c.email = '".$data['email']."')";
                return $this->findAll($criteria);
		
	}
}