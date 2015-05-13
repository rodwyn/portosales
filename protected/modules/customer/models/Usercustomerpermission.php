<?php

/**
 * This is the model class for table "usercustomerpermission".
 *
 * The followings are the available columns in table 'usercustomerpermission':
 * @property string $usercustomerpermissionid
 * @property integer $customerid
 * @property integer $userid
 * @property integer $systemid
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property User $user
 */
class Usercustomerpermission extends CActiveRecord
{
	public $customerdsc;
	public $usercompletename;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usercustomerpermission the static model class
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
		return 'usercustomerpermission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customerid, userid, systemid', 'required'),
			array('customerid, userid, systemid, active', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('usercustomerpermissionid, customerid, userid, systemid, active', 'safe', 'on'=>'search'),
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
			'customer' => array(self::BELONGS_TO, 'Customer', 'customerid'),
			'user' => array(self::BELONGS_TO, 'User', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usercustomerpermissionid' => 'Usercustomerpermissionid',
			'customerid' => 'Customerid',
			'userid' => 'Userid',
			'systemid' => 'Systemid',
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

		$criteria->compare('usercustomerpermissionid',$this->usercustomerpermissionid,true);
		$criteria->compare('customerid',$this->customerid);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('systemid',$this->systemid);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCustomerbyUser($userid,$customerid)	{
		$criteria = new CDbCriteria ;
        $criteria->select = " t.customerid, c.customerdsc  " ; 
        $criteria->join = "INNER JOIN customer c on c.customerid = t.customerid and c.active = 1 ";
        $criteria->condition = " t.userid = {$userid} and c.customerid= {$customerid}";
        $criteria->order = " c.customerdsc ASC ";
		return $this->findAll($criteria);
	}
	
	public function getuserbyCustomer($customerid, $userid)	{
		$criteria = new CDbCriteria ;
        $criteria->select = " t.userid, CONCAT(eu.firstname,' ',eu.plastname) as usercompletename  " ; 
        $criteria->join = "INNER JOIN employeeuser eu ON eu.userid = t.userid ";
        $criteria->condition = "  t.customerid = {$customerid} AND t.userid != {$userid} ";
        $criteria->order = " eu.firstname ASC, eu.plastname ASC ";
		return $this->findAll($criteria);
	}
	
	public function getuserservicebyCustomer($customerid, $entryid)	{
		$criteria = new CDbCriteria ;
        $criteria->select = " t.userid, CONCAT(eu.firstname,' ',eu.plastname) as usercompletename  " ; 
        $criteria->join = "INNER JOIN employeeuser eu ON eu.userid = t.userid 
        					INNER JOIN userservice us ON us.userid = t.userid
        					INNER JOIN service s on s.serviceid = us.serviceid 
							INNER JOIN service s2 on s2.serviceparentid = s.serviceid 
							INNER JOIN service s3 on s3.serviceparentid = s2.serviceid 
							INNER JOIN service s4 on s4.serviceparentid = s3.serviceid 
							INNER JOIN service s5 on s5.serviceparentid = s4.serviceid";
        $criteria->condition = "  t.customerid = {$customerid} AND s5.serviceid = {$entryid} ";
        $criteria->order = " eu.firstname ASC, eu.plastname ASC ";
		return $this->findAll($criteria);
	}
}