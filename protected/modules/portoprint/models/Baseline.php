<?php

/**
 * This is the model class for table "baseline".
 *
 * The followings are the available columns in table 'baseline':
 * @property string $baselineid
 * @property string $conceptid
 * @property string $itemid
 * @property string $quantity
 * @property double $price
 *
 * The followings are the available model relations:
 * @property Baselinevalue[] $baselinevalues
 */
class Baseline extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Baseline the static model class
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
		return 'baseline';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('conceptid, itemid, quantity', 'required'),
			array('price', 'numerical'),
			array('conceptid, itemid', 'length', 'max'=>10),
			array('quantity', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('baselineid, conceptid, itemid, quantity, price', 'safe', 'on'=>'search'),
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
			'baselinevalues' => array(self::HAS_MANY, 'Baselinevalue', 'baselineid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'baselineid' => 'Baselineid',
			'conceptid' => 'Conceptid',
			'itemid' => 'Itemid',
			'quantity' => 'Quantity',
			'price' => 'Price',
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

		$criteria->compare('baselineid',$this->baselineid,true);
		$criteria->compare('conceptid',$this->conceptid,true);
		$criteria->compare('itemid',$this->itemid,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('price',$this->price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}