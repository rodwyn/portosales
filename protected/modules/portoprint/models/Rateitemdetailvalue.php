<?php

/**
 * This is the model class for table "rateitemdetailvalue".
 *
 * The followings are the available columns in table 'rateitemdetailvalue':
 * @property string $rateitemdetailvalueid
 * @property string $rateid
 * @property string $itemdetailvalueid
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Itemdetailvalue $itemdetailvalue
 * @property Rate $rate
 */
class Rateitemdetailvalue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rateitemdetailvalue the static model class
	 */
	public $itemdetaildsc;
	public $itemdetailvaluedsc;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rateitemdetailvalue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, itemdetailvalueid', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('rateid, itemdetailvalueid', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rateitemdetailvalueid, rateid, itemdetailvalueid, active', 'safe', 'on'=>'search'),
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
			'itemdetailvalue' => array(self::BELONGS_TO, 'Itemdetailvalue', 'itemdetailvalueid'),
			'rate' => array(self::BELONGS_TO, 'Rate', 'rateid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rateitemdetailvalueid' => 'Rateitemdetailvalueid',
			'rateid' => 'Rateid',
			'itemdetailvalueid' => 'Itemdetailvalueid',
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

		$criteria->compare('rateitemdetailvalueid',$this->rateitemdetailvalueid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('itemdetailvalueid',$this->itemdetailvalueid,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getDetail($rateid)
	{   
		$criteria = new CDbCriteria;

		$criteria->select = " id.itemdetailid, id.itemdetaildsc, GROUP_CONCAT(idv.itemdetailvaluedsc) as itemdetailvaluedsc ";
		$criteria->join = "INNER JOIN itemdetailvalue idv ON idv.itemdetailvalueid = t.itemdetailvalueid
						  INNER JOIN itemdetail id ON id.itemdetailid = idv.itemdetailid ";
		$criteria->condition = " t.rateid = {$rateid} ";
		$criteria->group = "id.itemdetailid";
		return $this->findAll($criteria);
		
	}
}