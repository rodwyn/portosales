<?php

/**
 * This is the model class for table "ratesupplierinvoice".
 *
 * The followings are the available columns in table 'ratesupplierinvoice':
 * @property string $ratesupplierinvoiceid
 * @property string $rateid
 * @property string $receiptdate
 * @property string $invoicenumber
 * @property string $withholdingISR
 * @property string $amount
 * @property string $estimateddate
 * @property string $pieces
 * @property string $ivatax
 * @property string $withholdingIVA
 * @property string $total
 * @property string $realDate
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Rate $rate
 */
class Ratesupplierinvoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratesupplierinvoice the static model class
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
		return 'ratesupplierinvoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('rateid', 'length', 'max'=>11),
			array('invoicenumber, pieces', 'length', 'max'=>100),
			array('withholdingISR, amount, ivatax, withholdingIVA, total', 'length', 'max'=>20),
			array('receiptdate, estimateddate, realDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ratesupplierinvoiceid, rateid, receiptdate, invoicenumber, withholdingISR, amount, estimateddate, pieces, ivatax, withholdingIVA, total, realDate, active', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ratesupplierinvoiceid' => 'Ratesupplierinvoiceid',
			'rateid' => 'Rateid',
			'receiptdate' => 'Receiptdate',
			'invoicenumber' => 'Invoicenumber',
			'withholdingISR' => 'Withholding Isr',
			'amount' => 'Amount',
			'estimateddate' => 'Estimateddate',
			'pieces' => 'Pieces',
			'ivatax' => 'Ivatax',
			'withholdingIVA' => 'Withholding Iva',
			'total' => 'Total',
			'realDate' => 'Real Date',
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

		$criteria->compare('ratesupplierinvoiceid',$this->ratesupplierinvoiceid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('receiptdate',$this->receiptdate,true);
		$criteria->compare('invoicenumber',$this->invoicenumber,true);
		$criteria->compare('withholdingISR',$this->withholdingISR,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('estimateddate',$this->estimateddate,true);
		$criteria->compare('pieces',$this->pieces,true);
		$criteria->compare('ivatax',$this->ivatax,true);
		$criteria->compare('withholdingIVA',$this->withholdingIVA,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('realDate',$this->realDate,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}