<?php

/**
 * This is the model class for table "ratechangeart".
 *
 * The followings are the available columns in table 'ratechangeart':
 * @property string $ratechangeartid
 * @property string $rateid
 * @property integer $quantitynumber
 * @property string $ratechangeartname
 * @property integer $ratechangeartnumber
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Rate $rate
 */
class Ratechangeart extends CActiveRecord
{
        public $testcolortype;
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratechangeart the static model class
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
		return 'ratechangeart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, quantitynumber, ratechangeartname, ratechangeartnumber', 'required'),
			array('quantitynumber, ratechangeartnumber, active', 'numerical', 'integerOnly'=>true),
			array('rateid', 'length', 'max'=>11),
			array('ratechangeartname', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ratechangeartid, rateid, quantitynumber, ratechangeartname, ratechangeartnumber, active', 'safe', 'on'=>'search'),
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
			'ratechangeartid' => 'Ratechangeartid',
			'rateid' => 'Rateid',
			'quantitynumber' => 'Quantitynumber',
			'ratechangeartname' => 'Ratechangeartname',
			'ratechangeartnumber' => 'Ratechangeartnumber',
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

		$criteria->compare('ratechangeartid',$this->ratechangeartid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('quantitynumber',$this->quantitynumber);
		$criteria->compare('ratechangeartname',$this->ratechangeartname,true);
		$criteria->compare('ratechangeartnumber',$this->ratechangeartnumber);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function getTestcolor($rateid){
            $criteria=new CDbCriteria;
            
            $criteria->select="rct.testcolortype, t.ratechangeartnumber";
            $criteria->join = "LEFT JOIN ratecolortest rct on rct.ratechangeartid = t.ratechangeartid";
            $criteria->condition ="t.rateid = ".$rateid;
            
            return $this->findAll($criteria);
        }
}