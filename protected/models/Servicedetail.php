<?php

/**
 * This is the model class for table "servicedetail".
 *
 * The followings are the available columns in table 'servicedetail':
 * @property string $servicedetailid
 * @property string $serviceid
 * @property string $itemdetailid
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Itemdetail $itemdetail
 * @property Service $service
 */
class Servicedetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Servicedetail the static model class
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
		return 'servicedetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serviceid, itemdetailid', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('serviceid', 'length', 'max'=>11),
			array('itemdetailid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('servicedetailid, serviceid, itemdetailid, active', 'safe', 'on'=>'search'),
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
			'itemdetail' => array(self::BELONGS_TO, 'Itemdetail', 'itemdetailid'),
			'service' => array(self::BELONGS_TO, 'Service', 'serviceid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servicedetailid' => 'Servicedetailid',
			'serviceid' => 'Serviceid',
			'itemdetailid' => 'Itemdetailid',
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

		$criteria->compare('servicedetailid',$this->servicedetailid,true);
		$criteria->compare('serviceid',$this->serviceid,true);
		$criteria->compare('itemdetailid',$this->itemdetailid,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}