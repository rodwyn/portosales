<?php

/**
 * This is the model class for table "itemdetailvalue".
 *
 * The followings are the available columns in table 'itemdetailvalue':
 * @property string $itemdetailvalueid
 * @property string $itemdetailid
 * @property string $itemdetailvaluedsc
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Baselinevalue[] $baselinevalues
 * @property Itemdetail $itemdetail
 * @property Rateitemdetailvalue[] $rateitemdetailvalues
 */
class Itemdetailvalue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Itemdetailvalue the static model class
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
		return 'itemdetailvalue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itemdetailid, itemdetailvaluedsc', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('itemdetailid', 'length', 'max'=>10),
			array('itemdetailvaluedsc', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('itemdetailvalueid, itemdetailid, itemdetailvaluedsc, active', 'safe', 'on'=>'search'),
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
			'baselinevalues' => array(self::HAS_MANY, 'Baselinevalue', 'itemdetailvalueid'),
			'itemdetail' => array(self::BELONGS_TO, 'Itemdetail', 'itemdetailid'),
			'rateitemdetailvalues' => array(self::HAS_MANY, 'Rateitemdetailvalue', 'itemdetailvalueid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'itemdetailvalueid' => 'Itemdetailvalueid',
			'itemdetailid' => 'Itemdetailid',
			'itemdetailvaluedsc' => 'Itemdetailvaluedsc',
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

		$criteria->compare('itemdetailvalueid',$this->itemdetailvalueid,true);
		$criteria->compare('itemdetailid',$this->itemdetailid,true);
		$criteria->compare('itemdetailvaluedsc',$this->itemdetailvaluedsc,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

}