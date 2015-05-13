<?php

/**
 * This is the model class for table "stock".
 *
 * The followings are the available columns in table 'stock':
 * @property integer $productid
 * @property integer $companyid
 * @property integer $stock
 * @property string $listprice
 * @property string $auctionprice
 */
class Stock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stock the static model class
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
		return 'stock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productid, companyid', 'required'),
			array('productid, companyid, stock', 'numerical', 'integerOnly'=>true),
			array('listprice, auctionprice', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productid, companyid, stock, listprice, auctionprice', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productid' => 'Productid',
			'companyid' => 'Companyid',
			'stock' => 'Stock',
			'listprice' => 'Listprice',
			'auctionprice' => 'Auctionprice',
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

		$criteria->compare('productid',$this->productid);
		$criteria->compare('companyid',$this->companyid);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('listprice',$this->listprice,true);
		$criteria->compare('auctionprice',$this->auctionprice,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}