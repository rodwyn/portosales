<?php

/**
 * This is the model class for table "ratezerotest".
 *
 * The followings are the available columns in table 'ratezerotest':
 * @property string $ratezerotestid
 * @property string $rateid
 * @property string $courierdeliverydate
 * @property string $customerdeliverydate
 * @property string $receivercustomer
 * @property string $deliverytestnumber
 * @property integer $authorization
 * @property string $rejectreason
 * @property string $zerotestauthorization
 * @property string $authorizationtest
 * @property string $scheduleddelivery
 * @property string $realdelivery
 * @property integer $active
 * @property string $supplierdelivery
 *
 * The followings are the available model relations:
 * @property Rate $rate
 */
class Ratezerotest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratezerotest the static model class
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
		return 'ratezerotest';
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
			array('authorization, active', 'numerical', 'integerOnly'=>true),
			array('rateid', 'length', 'max'=>11),
			array('receivercustomer, deliverytestnumber, rejectreason, zerotestauthorization, authorizationtest, scheduleddelivery, realdelivery, supplierdelivery', 'length', 'max'=>100),
			array('courierdeliverydate, customerdeliverydate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ratezerotestid, rateid, courierdeliverydate, customerdeliverydate, receivercustomer, deliverytestnumber, authorization, rejectreason, zerotestauthorization, authorizationtest, scheduleddelivery, realdelivery, active, supplierdelivery', 'safe', 'on'=>'search'),
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
			'ratezerotestid' => 'Ratezerotestid',
			'rateid' => 'Rateid',
			'courierdeliverydate' => 'Courierdeliverydate',
			'customerdeliverydate' => 'Customerdeliverydate',
			'receivercustomer' => 'Receivercustomer',
			'deliverytestnumber' => 'Deliverytestnumber',
			'authorization' => 'Authorization',
			'rejectreason' => 'Rejectreason',
			'zerotestauthorization' => 'Zerotestauthorization',
			'authorizationtest' => 'Authorizationtest',
			'scheduleddelivery' => 'Scheduleddelivery',
			'realdelivery' => 'Realdelivery',
			'active' => 'Active',
			'supplierdelivery' => 'Supplierdelivery',
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

		$criteria->compare('ratezerotestid',$this->ratezerotestid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('courierdeliverydate',$this->courierdeliverydate,true);
		$criteria->compare('customerdeliverydate',$this->customerdeliverydate,true);
		$criteria->compare('receivercustomer',$this->receivercustomer,true);
		$criteria->compare('deliverytestnumber',$this->deliverytestnumber,true);
		$criteria->compare('authorization',$this->authorization);
		$criteria->compare('rejectreason',$this->rejectreason,true);
		$criteria->compare('zerotestauthorization',$this->zerotestauthorization,true);
		$criteria->compare('authorizationtest',$this->authorizationtest,true);
		$criteria->compare('scheduleddelivery',$this->scheduleddelivery,true);
		$criteria->compare('realdelivery',$this->realdelivery,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('supplierdelivery',$this->supplierdelivery,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}