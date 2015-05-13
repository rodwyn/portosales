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
 * @property string $key
 * @property integer $flag
 *
 * The followings are the available model relations:
 * @property Activity[] $activities
 * @property Category[] $categories
 * @property Category[] $categories1
 * @property Customeruser $customeruser
 * @property Employeeuser $employeeuser
 * @property Product[] $products
 * @property Product[] $products1
 * @property Sales[] $sales
 * @property Specialpermission[] $specialpermissions
 * @property Usertype $usertype0
 * @property Userprivilege[] $userprivileges
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
			array('usertype, profileid, flag', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>50),
			array('active', 'length', 'max'=>1),
			array('key', 'length', 'max'=>35),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, username, password, usertype, profileid, active, key, flag', 'safe', 'on'=>'search'),
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
			'activities' => array(self::HAS_MANY, 'Activity', 'userid'),
			'categories' => array(self::HAS_MANY, 'Category', 'creator'),
			'categories1' => array(self::HAS_MANY, 'Category', 'editor'),
			'customeruser' => array(self::HAS_ONE, 'Customeruser', 'userid'),
			'employeeuser' => array(self::HAS_ONE, 'Employeeuser', 'userid'),
			'products' => array(self::HAS_MANY, 'Product', 'editor'),
			'products1' => array(self::HAS_MANY, 'Product', 'creator'),
			'sales' => array(self::HAS_MANY, 'Sales', 'userid'),
			'specialpermissions' => array(self::HAS_MANY, 'Specialpermission', 'userid'),
			'usertype0' => array(self::BELONGS_TO, 'Usertype', 'usertype'),
			'userprivileges' => array(self::HAS_MANY, 'Userprivilege', 'userid'),
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
			'key' => 'Key',
			'flag' => 'Flag',
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
		$criteria->compare('key',$this->key,true);
		$criteria->compare('flag',$this->flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}