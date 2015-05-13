<?php

/**
 * This is the model class for table "warehouse".
 *
 * The followings are the available columns in table 'warehouse':
 * @property string $warehouseid
 * @property integer $customerid
 * @property string $name
 * @property string $adress
 * @property string $neighborhood
 * @property string $schedule
 * @property string $contact
 * @property string $phone
 * @property string $email
 * @property string $special
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Ratewarehouse[] $ratewarehouses
 */
class Warehouse extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Warehouse the static model class
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
		return 'warehouse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customerid, name, adress', 'required'),
			array('customerid, active', 'numerical', 'integerOnly'=>true),
			array('name, neighborhood, schedule, contact, email', 'length', 'max'=>100),
			array('adress', 'length', 'max'=>200),
			array('phone', 'length', 'max'=>20),
			array('special', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('warehouseid, customerid, name, adress, neighborhood, schedule, contact, phone, email, special, active', 'safe', 'on'=>'search'),
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
			'ratewarehouses' => array(self::HAS_MANY, 'Ratewarehouse', 'warehouseid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'warehouseid' => 'Warehouseid',
			'customerid' => 'Customerid',
			'name' => 'Name',
			'adress' => 'Adress',
			'neighborhood' => 'Neighborhood',
			'schedule' => 'Schedule',
			'contact' => 'Contact',
			'phone' => 'Phone',
			'email' => 'Email',
			'special' => 'Special',
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

		$criteria->compare('warehouseid',$this->warehouseid,true);
		$criteria->compare('customerid',$this->customerid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('adress',$this->adress,true);
		$criteria->compare('neighborhood',$this->neighborhood,true);
		$criteria->compare('schedule',$this->schedule,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('special',$this->special,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}