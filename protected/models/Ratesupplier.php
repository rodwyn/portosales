<?php

/**
 * This is the model class for table "ratesupplier".
 *
 * The followings are the available columns in table 'ratesupplier':
 * @property string $ratesupplierid
 * @property string $rateid
 * @property string $supplierid
 * @property double $quantity_1
 * @property double $quantity_2
 * @property double $quantity_3
 * @property double $quantity_4
 * @property double $quantity_5
 * @property double $quantity_6
 * @property string $declinereason
 * @property integer $statusid
 * @property string $statustime
 * @property double $percent
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Supplier $supplier
 * @property Rate $rate
 * @property Status $status
 */
class Ratesupplier extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratesupplier the static model class
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
		return 'ratesupplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, supplierid, statusid', 'required'),
			array('statusid, active', 'numerical', 'integerOnly'=>true),
			array('quantity_1, quantity_2, quantity_3, quantity_4, quantity_5, quantity_6, percent', 'numerical'),
			array('rateid', 'length', 'max'=>11),
			array('supplierid', 'length', 'max'=>10),
			array('declinereason, statustime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ratesupplierid, rateid, supplierid, quantity_1, quantity_2, quantity_3, quantity_4, quantity_5, quantity_6, declinereason, statusid, statustime, percent, active', 'safe', 'on'=>'search'),
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
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplierid'),
			'rate' => array(self::BELONGS_TO, 'Rate', 'rateid'),
			'status' => array(self::BELONGS_TO, 'Status', 'statusid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ratesupplierid' => 'Ratesupplierid',
			'rateid' => 'Rateid',
			'supplierid' => 'Supplierid',
			'quantity_1' => 'Quantity 1',
			'quantity_2' => 'Quantity 2',
			'quantity_3' => 'Quantity 3',
			'quantity_4' => 'Quantity 4',
			'quantity_5' => 'Quantity 5',
			'quantity_6' => 'Quantity 6',
			'declinereason' => 'Declinereason',
			'statusid' => 'Statusid',
			'statustime' => 'Statustime',
			'percent' => 'Percent',
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

		$criteria->compare('ratesupplierid',$this->ratesupplierid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('supplierid',$this->supplierid,true);
		$criteria->compare('quantity_1',$this->quantity_1);
		$criteria->compare('quantity_2',$this->quantity_2);
		$criteria->compare('quantity_3',$this->quantity_3);
		$criteria->compare('quantity_4',$this->quantity_4);
		$criteria->compare('quantity_5',$this->quantity_5);
		$criteria->compare('quantity_6',$this->quantity_6);
		$criteria->compare('declinereason',$this->declinereason,true);
		$criteria->compare('statusid',$this->statusid);
		$criteria->compare('statustime',$this->statustime,true);
		$criteria->compare('percent',$this->percent);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}