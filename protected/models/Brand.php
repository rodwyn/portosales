<?php

/**
 * This is the model class for table "brand".
 *
 * The followings are the available columns in table 'brand':
 * @property string $brandid
 * @property integer $customerid
 * @property string $branddsc
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Project[] $projects
 * @property Userbrandpermission[] $userbrandpermissions
 */
class Brand extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Brand the static model class
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
		return 'brand';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customerid, branddsc', 'required'),
			array('customerid, active', 'numerical', 'integerOnly'=>true),
			array('branddsc', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('brandid, customerid, branddsc, active', 'safe', 'on'=>'search'),
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
			'projects' => array(self::HAS_MANY, 'Project', 'brandid'),
			'userbrandpermissions' => array(self::HAS_MANY, 'Userbrandpermission', 'brandid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'brandid' => 'Brandid',
			'customerid' => 'Customerid',
			'branddsc' => 'Branddsc',
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

		$criteria->compare('brandid',$this->brandid,true);
		$criteria->compare('customerid',$this->customerid);
		$criteria->compare('branddsc',$this->branddsc,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}