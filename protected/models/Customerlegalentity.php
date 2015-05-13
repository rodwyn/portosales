<?php

/**
 * This is the model class for table "customerlegalentity".
 *
 * The followings are the available columns in table 'customerlegalentity':
 * @property integer $customerlegalentityid
 * @property string $legalentity
 * @property string $rfc
 * @property string $street
 * @property string $number
 * @property string $neighborhood
 * @property string $zipcode
 * @property string $cityid
 * @property integer $active
 * @property integer $customerid
 *
 * The followings are the available model relations:
 * @property City $city
 * @property Customer $customer
 */
class Customerlegalentity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customerlegalentity the static model class
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
		return 'customerlegalentity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('legalentity, rfc, street, number, neighborhood, zipcode, cityid, customerid', 'required'),
			array('active, customerid', 'numerical', 'integerOnly'=>true),
			array('legalentity', 'length', 'max'=>100),
			array('rfc', 'length', 'max'=>15),
			array('street, neighborhood', 'length', 'max'=>50),
			array('number', 'length', 'max'=>12),
			array('zipcode', 'length', 'max'=>5),
			array('cityid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customerlegalentityid, legalentity, rfc, street, number, neighborhood, zipcode, cityid, active, customerid', 'safe', 'on'=>'search'),
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
			'city' => array(self::BELONGS_TO, 'City', 'cityid'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customerid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customerlegalentityid' => 'Customerlegalentityid',
			'legalentity' => 'Legalentity',
			'rfc' => 'Rfc',
			'street' => 'Street',
			'number' => 'Number',
			'neighborhood' => 'Neighborhood',
			'zipcode' => 'Zipcode',
			'cityid' => 'Cityid',
			'active' => 'Active',
			'customerid' => 'Customerid',
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

		$criteria->compare('customerlegalentityid',$this->customerlegalentityid);
		$criteria->compare('legalentity',$this->legalentity,true);
		$criteria->compare('rfc',$this->rfc,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('neighborhood',$this->neighborhood,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('cityid',$this->cityid,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('customerid',$this->customerid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}