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
 * @property Rateservice[] $rateservices
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
			'rateservices' => array(self::HAS_MANY, 'Rateservice', 'serviceid'),
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
}