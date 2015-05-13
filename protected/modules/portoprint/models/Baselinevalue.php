<?php

/**
 * This is the model class for table "baselinevalue".
 *
 * The followings are the available columns in table 'baselinevalue':
 * @property string $baselinevalueid
 * @property string $baselineid
 * @property string $itemdetailvalueid
 *
 * The followings are the available model relations:
 * @property Baseline $baseline
 * @property Itemdetailvalue $itemdetailvalue
 */
class Baselinevalue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Baselinevalue the static model class
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
		return 'baselinevalue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('baselineid, itemdetailvalueid', 'required'),
			array('baselineid, itemdetailvalueid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('baselinevalueid, baselineid, itemdetailvalueid', 'safe', 'on'=>'search'),
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
			'baseline' => array(self::BELONGS_TO, 'Baseline', 'baselineid'),
			'itemdetailvalue' => array(self::BELONGS_TO, 'Itemdetailvalue', 'itemdetailvalueid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'baselinevalueid' => 'Baselinevalueid',
			'baselineid' => 'Baselineid',
			'itemdetailvalueid' => 'Itemdetailvalueid',
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

		$criteria->compare('baselinevalueid',$this->baselinevalueid,true);
		$criteria->compare('baselineid',$this->baselineid,true);
		$criteria->compare('itemdetailvalueid',$this->itemdetailvalueid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}