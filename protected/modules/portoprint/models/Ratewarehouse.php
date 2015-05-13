<?php

/**
 * This is the model class for table "ratewarehouse".
 *
 * The followings are the available columns in table 'ratewarehouse':
 * @property string $ratewarehouseid
 * @property string $rateid
 * @property string $warehouseid
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Rate $rate
 * @property Warehouse $warehouse
 */
class Ratewarehouse extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratewarehouse the static model class
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
		return 'ratewarehouse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, warehouseid, active', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('rateid', 'length', 'max'=>11),
			array('warehouseid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ratewarehouseid, rateid, warehouseid, active', 'safe', 'on'=>'search'),
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
			'warehouse' => array(self::BELONGS_TO, 'Warehouse', 'warehouseid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ratewarehouseid' => 'Ratewarehouseid',
			'rateid' => 'Rateid',
			'warehouseid' => 'Warehouseid',
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

		$criteria->compare('ratewarehouseid',$this->ratewarehouseid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('warehouseid',$this->warehouseid,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}