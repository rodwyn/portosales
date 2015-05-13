<?php

/**
 * This is the model class for table "itemdetail".
 *
 * The followings are the available columns in table 'itemdetail':
 * @property string $itemdetailid
 * @property string $serviceid
 * @property string $itemdetaildsc
 * @property string $selecttype
 * @property string $order
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property Itemdetailvalue[] $itemdetailvalues
 * @property Servicedetail[] $servicedetails
 */
class Itemdetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Itemdetail the static model class
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
		return 'itemdetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serviceid, itemdetaildsc, order', 'required'),
			array('serviceid, order', 'length', 'max'=>10),
			array('itemdetaildsc', 'length', 'max'=>100),
			array('selecttype', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('itemdetailid, serviceid, itemdetaildsc, selecttype, order', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'Service', 'serviceid'),
			'itemdetailvalues' => array(self::HAS_MANY, 'Itemdetailvalue', 'itemdetailid'),
			'servicedetails' => array(self::HAS_MANY, 'Servicedetail', 'itemdetailid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'itemdetailid' => 'Itemdetailid',
			'serviceid' => 'Serviceid',
			'itemdetaildsc' => 'Itemdetaildsc',
			'selecttype' => 'Selecttype',
			'order' => 'Order',
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

		$criteria->compare('itemdetailid',$this->itemdetailid,true);
		$criteria->compare('serviceid',$this->serviceid,true);
		$criteria->compare('itemdetaildsc',$this->itemdetaildsc,true);
		$criteria->compare('selecttype',$this->selecttype,true);
		$criteria->compare('order',$this->order,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}