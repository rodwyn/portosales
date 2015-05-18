<?php

/**
 * This is the model class for table "customerinfo".
 *
 * The followings are the available columns in table 'customerinfo':
 * @property integer $customerid
 * @property integer $iscustomer
 * @property double $admincosts
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Customer $customer
 */
class Customerinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customerinfo the static model class
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
		return 'customerinfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customerid, iscustomer', 'required'),
			array('customerid, iscustomer, active', 'numerical', 'integerOnly'=>true),
			array('admincosts', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customerid, iscustomer, admincosts, active', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customerid' => 'Customerid',
			'iscustomer' => 'Iscustomer',
			'admincosts' => 'Admincosts',
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
		$criteria->compare('iscustomer',$this->iscustomer);
		$criteria->compare('admincosts',$this->admincosts);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}