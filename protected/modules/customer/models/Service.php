<?php

/**
 * This is the model class for table "service".
 *
 * The followings are the available columns in table 'service':
 * @property string $serviceid
 * @property integer $companyid
 * @property string $servicedsc
 * @property string $serviceparentid
 * @property integer $level
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Itemdetail[] $itemdetails
 * @property Rate[] $rates
 * @property Servicedetail[] $servicedetails
 * @property Supplier[] $suppliers
 * @property Supplierservice[] $supplierservices
 * @property Userservice[] $userservices
 */
class Service extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Service the static model class
	 */
	public $entrydsc;
	public $asigned;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyid, servicedsc, serviceparentid, level', 'required'),
			array('companyid, level, active', 'numerical', 'integerOnly'=>true),
			array('servicedsc', 'length', 'max'=>100),
			array('serviceparentid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('serviceid, companyid, servicedsc, serviceparentid, level, active', 'safe', 'on'=>'search'),
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
			'itemdetails' => array(self::HAS_MANY, 'Itemdetail', 'serviceid'),
			'rates' => array(self::HAS_MANY, 'Rate', 'serviceid'),
			'servicedetails' => array(self::HAS_MANY, 'Servicedetail', 'serviceid'),
			'suppliers' => array(self::HAS_MANY, 'Supplier', 'serviceid'),
			'supplierservices' => array(self::HAS_MANY, 'Supplierservice', 'serviceid'),
			'userservices' => array(self::HAS_MANY, 'Userservice', 'serviceid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'serviceid' => 'Serviceid',
			'companyid' => 'Companyid',
			'servicedsc' => 'Servicedsc',
			'serviceparentid' => 'Serviceparentid',
			'level' => 'Level',
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

		$criteria->compare('serviceid',$this->serviceid,true);
		$criteria->compare('companyid',$this->companyid);
		$criteria->compare('servicedsc',$this->servicedsc,true);
		$criteria->compare('serviceparentid',$this->serviceparentid,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getEntryItem($userid)	{
		$criteria = new CDbCriteria ;
        $criteria->select = " t.serviceid, t.servicedsc, s5.servicedsc as entrydsc " ; 
        $criteria->join = "inner join service s2 on s2.serviceid = t.serviceparentid and s2.active = 1
							inner join service s3 on s3.serviceid = s2.serviceparentid and s3.active = 1
							inner join service s4 on s4.serviceid = s3.serviceparentid and s4.active = 1
							inner join service s5 on s5.serviceid = s4.serviceparentid and s5.active = 1 
							inner join userservice us on us.serviceid = s5.serviceid
							";
        $criteria->condition = " us.userid = {$userid} and t.active = 1 and t.level = 4 ";
        $criteria->order = " s5.servicedsc, s4.servicedsc, s3.servicedsc, s2.servicedsc, t.servicedsc ";
		return $this->findAll($criteria);
	}
	
	public function getEntrybyServiceId($serviceid)	{
		$criteria = new CDbCriteria ;
        $criteria->select = " s4.serviceid,s4.servicedsc  " ; 
        $criteria->join = "inner join service s2 on s2.serviceid = t.serviceparentid and s2.active = 1
							inner join service s3 on s3.serviceid = s2.serviceparentid and s3.active = 1
							inner join service s4 on s4.serviceid = s3.serviceparentid and s4.active = 1";
        $criteria->condition = " t.serviceid = {$serviceid} ";
		return $this->find($criteria);
	}
	
	public function getREntrybyServiceId($serviceid)	{
		$criteria = new CDbCriteria ;
        $criteria->select = " s4.serviceid,s4.servicedsc  " ; 
        $criteria->join = "inner join service s2 on s2.serviceid = t.serviceparentid and s2.active = 1
							inner join service s3 on s3.serviceid = s2.serviceparentid and s3.active = 1
							inner join service s4 on s4.serviceid = s3.serviceparentid and s4.active = 1";
        $criteria->condition = " t.serviceid = {$serviceid} ";
		return $this->find($criteria);
	}

	public function getSupplierService($supplierid){

		
		$criteria = new CDbCriteria ;
		$criteria->select = "t.serviceid, t.servicedsc, supplierservice.supplierservice as asigned ";
		$criteria->join = "LEFT JOIN supplierservice ON  t.serviceid = supplierservice.serviceid and  supplierservice.supplierid= {$supplierid}";
		$criteria->condition = "t.companyid = {$companyid} AND t.level = 1 ";
		return $this->findAll($criteria);
	}
}