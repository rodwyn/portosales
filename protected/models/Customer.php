<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $customerid
 * @property integer $companyid
 * @property string $customerdsc
 * @property string $email
 * @property string $formula
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property Customercontact[] $customercontacts
 * @property Customerinfo $customerinfo
 * @property Customerlegalentity[] $customerlegalentities
 * @property Sales[] $sales
 */
class Customer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
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
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyid, customerdsc, email', 'required'),
			array('companyid, active', 'numerical', 'integerOnly'=>true),
			array('customerdsc', 'length', 'max'=>70),
			array('email', 'length', 'max'=>100),
			array('formula', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customerid, companyid, customerdsc, email, formula, active', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'companyid'),
			'customercontacts' => array(self::HAS_MANY, 'Customercontact', 'customerid'),
			'customerinfo' => array(self::HAS_ONE, 'Customerinfo', 'customerid'),
			'customerlegalentities' => array(self::HAS_MANY, 'Customerlegalentity', 'customerid'),
			'sales' => array(self::HAS_MANY, 'Sales', 'customerid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customerid' => 'Customerid',
			'companyid' => 'Companyid',
			'customerdsc' => 'Customerdsc',
			'email' => 'Email',
			'formula' => 'Formula',
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

		$criteria->compare('customerid',$this->customerid);
		$criteria->compare('companyid',$this->companyid);
		$criteria->compare('customerdsc',$this->customerdsc,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('formula',$this->formula,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}