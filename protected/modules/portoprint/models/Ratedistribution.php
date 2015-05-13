<?php

/**
 * This is the model class for table "ratedistribution".
 *
 * The followings are the available columns in table 'ratedistribution':
 * @property string $ratedistributionid
 * @property string $rateid
 * @property string $ratedistributionplace
 * @property string $ratedistributionquantity
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Rate $rate
 */
class Ratedistribution extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratedistribution the static model class
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
		return 'ratedistribution';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, ratedistributionplace, ratedistributionquantity', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('rateid', 'length', 'max'=>11),
			array('ratedistributionplace, ratedistributionquantity', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ratedistributionid, rateid, ratedistributionplace, ratedistributionquantity, active', 'safe', 'on'=>'search'),
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
			'ratedistributionid' => 'Ratedistributionid',
			'rateid' => 'Rateid',
			'ratedistributionplace' => 'Ratedistributionplace',
			'ratedistributionquantity' => 'Ratedistributionquantity',
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

		$criteria->compare('ratedistributionid',$this->ratedistributionid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('ratedistributionplace',$this->ratedistributionplace,true);
		$criteria->compare('ratedistributionquantity',$this->ratedistributionquantity,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}