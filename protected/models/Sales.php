<?php

/**
 * This is the model class for table "sales".
 *
 * The followings are the available columns in table 'sales':
 * @property integer $salesid
 * @property integer $userid
 * @property integer $customerid
 * @property string $amount
 * @property string $tax
 * @property string $total
 * @property integer $salestatusid
 *
 * The followings are the available model relations:
 * @property Product[] $products
 * @property Salestatus $salestatus
 * @property User $user
 * @property Customer $customer
 */
class Sales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sales the static model class
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
		return 'sales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, customerid, amount, tax, total, salestatusid', 'required'),
			array('userid, customerid, salestatusid', 'numerical', 'integerOnly'=>true),
			array('amount, tax, total', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('salesid, userid, customerid, amount, tax, total, salestatusid', 'safe', 'on'=>'search'),
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
			'products' => array(self::MANY_MANY, 'Product', 'saleproduct(salesid, productid)'),
			'salestatus' => array(self::BELONGS_TO, 'Salestatus', 'salestatusid'),
			'user' => array(self::BELONGS_TO, 'User', 'userid'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customerid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'salesid' => 'Salesid',
			'userid' => 'Userid',
			'customerid' => 'Customerid',
			'amount' => 'Amount',
			'tax' => 'Tax',
			'total' => 'Total',
			'salestatusid' => 'Salestatusid',
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

		$criteria->compare('salesid',$this->salesid);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('customerid',$this->customerid);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('tax',$this->tax,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('salestatusid',$this->salestatusid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}