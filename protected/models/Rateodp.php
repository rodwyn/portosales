<?php

/**
 * This is the model class for table "rateodp".
 *
 * The followings are the available columns in table 'rateodp':
 * @property string $rateodpid
 * @property string $rateid
 * @property string $supplierid
 * @property integer $statusid
 * @property string $statustime
 * @property integer $statuscustomerid
 * @property string $statuscustomertime
 * @property integer $quantityselect
 * @property double $price
 * @property string $comments
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Rate $rate
 * @property Supplier $supplier
 * @property Status $status
 */
class Rateodp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rateodp the static model class
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
		return 'rateodp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, supplierid, statusid, statustime, statuscustomertime, quantityselect', 'required'),
			array('statusid, statuscustomerid, quantityselect, active', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('rateid', 'length', 'max'=>11),
			array('supplierid', 'length', 'max'=>10),
			array('comments', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rateodpid, rateid, supplierid, statusid, statustime, statuscustomerid, statuscustomertime, quantityselect, price, comments, active', 'safe', 'on'=>'search'),
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
			'rateodpid' => 'Rateodpid',
			'rateid' => 'Rateid',
			'supplierid' => 'Supplierid',
			'statusid' => 'Statusid',
			'statustime' => 'Statustime',
			'statuscustomerid' => 'Statuscustomerid',
			'statuscustomertime' => 'Statuscustomertime',
			'quantityselect' => 'Quantityselect',
			'price' => 'Price',
			'comments' => 'Comments',
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

		$criteria->compare('rateodpid',$this->rateodpid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('supplierid',$this->supplierid,true);
		$criteria->compare('statusid',$this->statusid);
		$criteria->compare('statustime',$this->statustime,true);
		$criteria->compare('statuscustomerid',$this->statuscustomerid);
		$criteria->compare('statuscustomertime',$this->statuscustomertime,true);
		$criteria->compare('quantityselect',$this->quantityselect);
		$criteria->compare('price',$this->price);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}