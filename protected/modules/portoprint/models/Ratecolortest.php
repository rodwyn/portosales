<?php

/**
 * This is the model class for table "ratecolortest".
 *
 * The followings are the available columns in table 'ratecolortest':
 * @property string $ratecolortestid
 * @property string $rateid
 * @property string $productiondate
 * @property string $testcolortype
 * @property string $production
 * @property string $courierdeliverydate
 * @property string $receivercourier
 * @property string $cutomerdeliverydate
 * @property string $receivercustomer
 * @property string $supplierdeliverydate
 * @property integer $authorizationtest
 * @property string $rejectreason
 * @property string $comments
 * @property string $authorizationdate
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Rate $rate
 */
class Ratecolortest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratecolortest the static model class
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
		return 'ratecolortest';
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
			array('authorizationtest, active', 'numerical', 'integerOnly'=>true),
			array('rateid', 'length', 'max'=>11),
			array('testcolortype, production, receivercourier, receivercustomer, rejectreason, comments', 'length', 'max'=>100),
			array('productiondate, courierdeliverydate, cutomerdeliverydate, supplierdeliverydate, authorizationdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ratecolortestid, rateid, productiondate, testcolortype, production, courierdeliverydate, receivercourier, cutomerdeliverydate, receivercustomer, supplierdeliverydate, authorizationtest, rejectreason, comments, authorizationdate, active', 'safe', 'on'=>'search'),
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
			'ratecolortestid' => 'Ratecolortestid',
			'rateid' => 'Rateid',
			'productiondate' => 'Fecha de elaboración',
			'testcolortype' => 'Tipo de prueba de color',
			'production' => 'Quién elaboró',
			'courierdeliverydate' => 'Fecha de entrega de mensajería',
			'receivercourier' => 'Quien recibe mensajería',
			'cutomerdeliverydate' => 'Fecha de entrega a cliente',
			'receivercustomer' => 'Quien recibe cliente',
			'supplierdeliverydate' => 'Fecha de entrega a proveedor',
			'authorizationtest' => 'La prueba fue autorizada ',
			'rejectreason' => 'Motivo de rechazo',
			'comments' => 'Observaciones',
			'authorizationdate' => 'Fecha de autorización de modificación',
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

		$criteria->compare('ratecolortestid',$this->ratecolortestid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('productiondate',$this->productiondate,true);
		$criteria->compare('testcolortype',$this->testcolortype,true);
		$criteria->compare('production',$this->production,true);
		$criteria->compare('courierdeliverydate',$this->courierdeliverydate,true);
		$criteria->compare('receivercourier',$this->receivercourier,true);
		$criteria->compare('cutomerdeliverydate',$this->cutomerdeliverydate,true);
		$criteria->compare('receivercustomer',$this->receivercustomer,true);
		$criteria->compare('supplierdeliverydate',$this->supplierdeliverydate,true);
		$criteria->compare('authorizationtest',$this->authorizationtest);
		$criteria->compare('rejectreason',$this->rejectreason,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('authorizationdate',$this->authorizationdate,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}