<?php

/**
 * This is the model class for table "state".
 *
 * The followings are the available columns in table 'state':
 * @property string $stateid
 * @property string $countryid
 * @property string $statedsc
 * @property string $shortname
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property City[] $cities
 * @property Country $country
 */
class state extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return state the static model class
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
		return 'state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('countryid, statedsc', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('countryid', 'length', 'max'=>10),
			array('statedsc', 'length', 'max'=>50),
			array('shortname', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('stateid, countryid, statedsc, shortname, active', 'safe', 'on'=>'search'),
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
			'cities' => array(self::HAS_MANY, 'City', 'stateid'),
			'country' => array(self::BELONGS_TO, 'Country', 'countryid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stateid' => 'Stateid',
			'countryid' => 'Countryid',
			'statedsc' => 'Statedsc',
			'shortname' => 'Shortname',
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

		$criteria->compare('stateid',$this->stateid,true);
		$criteria->compare('countryid',$this->countryid,true);
		$criteria->compare('statedsc',$this->statedsc,true);
		$criteria->compare('shortname',$this->shortname,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}