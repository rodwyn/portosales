<?php

/**
 * This is the model class for table "rateservice".
 *
 * The followings are the available columns in table 'rateservice':
 * @property string $rateserviceid
 * @property string $rateid
 * @property string $serviceid
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Rate $rate
 * @property Service $service
 */
class Rateservice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rateservice the static model class
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
		return 'rateservice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, serviceid', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('rateid', 'length', 'max'=>11),
			array('serviceid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rateserviceid, rateid, serviceid, active', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'Service', 'serviceid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rateserviceid' => 'Rateserviceid',
			'rateid' => 'Rateid',
			'serviceid' => 'Serviceid',
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

		$criteria->compare('rateserviceid',$this->rateserviceid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('serviceid',$this->serviceid,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}