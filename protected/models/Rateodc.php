<?php

/**
 * This is the model class for table "rateodc".
 *
 * The followings are the available columns in table 'rateodc':
 * @property string $rateodcid
 * @property string $rateid
 * @property string $supplierid
 * @property integer $statusid
 * @property string $statustime
 * @property integer $quantityselect
 * @property double $price
 * @property string $odcc
 * @property string $odccdate
 * @property integer $iva
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Rate $rate
 * @property Supplier $supplier
 * @property Status $status
 */
class Rateodc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rateodc the static model class
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
		return 'rateodc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, supplierid, statusid, statustime, quantityselect, odcc, odccdate', 'required'),
			array('statusid, quantityselect, iva, active', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('rateid', 'length', 'max'=>11),
			array('supplierid', 'length', 'max'=>10),
			array('odcc', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rateodcid, rateid, supplierid, statusid, statustime, quantityselect, price, odcc, odccdate, iva, active', 'safe', 'on'=>'search'),
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
			'rate' => array(self::BELONGS_TO, 'Rate', 'rateid'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplierid'),
			'status' => array(self::BELONGS_TO, 'Status', 'statusid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rateodcid' => 'Rateodcid',
			'rateid' => 'Rateid',
			'supplierid' => 'Supplierid',
			'statusid' => 'Statusid',
			'statustime' => 'Statustime',
			'quantityselect' => 'Quantityselect',
			'price' => 'Price',
			'odcc' => 'Odcc',
			'odccdate' => 'Odccdate',
			'iva' => 'Iva',
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

		$criteria->compare('rateodcid',$this->rateodcid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('supplierid',$this->supplierid,true);
		$criteria->compare('statusid',$this->statusid);
		$criteria->compare('statustime',$this->statustime,true);
		$criteria->compare('quantityselect',$this->quantityselect);
		$criteria->compare('price',$this->price);
		$criteria->compare('odcc',$this->odcc,true);
		$criteria->compare('odccdate',$this->odccdate,true);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}