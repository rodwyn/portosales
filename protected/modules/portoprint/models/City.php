<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property string $cityid
 * @property string $stateid
 * @property string $countryid
 * @property string $citydsc
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property State $state
 * @property Customerlegalentity[] $customerlegalentities
 */
class City extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
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
		return 'city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stateid, countryid, citydsc', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('stateid, countryid', 'length', 'max'=>10),
			array('citydsc', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cityid, stateid, countryid, citydsc, active', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'Country', 'countryid'),
			'state' => array(self::BELONGS_TO, 'State', 'stateid'),
			'customerlegalentities' => array(self::HAS_MANY, 'Customerlegalentity', 'cityid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cityid' => 'Cityid',
			'stateid' => 'Stateid',
			'countryid' => 'Countryid',
			'citydsc' => 'Citydsc',
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

		$criteria->compare('cityid',$this->cityid,true);
		$criteria->compare('stateid',$this->stateid,true);
		$criteria->compare('countryid',$this->countryid,true);
		$criteria->compare('citydsc',$this->citydsc,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}