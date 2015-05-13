<?php

/**
 * This is the model class for table "status".
 *
 * The followings are the available columns in table 'status':
 * @property integer $statusid
 * @property string $statusdsc
 * @property string $note
 * @property string $color
 * @property integer $statustype
 *
 * The followings are the available model relations:
 * @property Rate[] $rates
 * @property Rateodc[] $rateodcs
 * @property Rateodp[] $rateodps
 * @property Ratesupplier[] $ratesuppliers
 */
class Status extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Status the static model class
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
		return 'status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('statusdsc, statustype', 'required'),
			array('statustype', 'numerical', 'integerOnly'=>true),
			array('statusdsc, note', 'length', 'max'=>50),
			array('color', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('statusid, statusdsc, note, color, statustype', 'safe', 'on'=>'search'),
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
			'rates' => array(self::HAS_MANY, 'Rate', 'statusid'),
			'rateodcs' => array(self::HAS_MANY, 'Rateodc', 'statusid'),
			'rateodps' => array(self::HAS_MANY, 'Rateodp', 'statusid'),
			'ratesuppliers' => array(self::HAS_MANY, 'Ratesupplier', 'statusid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'statusid' => 'Statusid',
			'statusdsc' => 'Statusdsc',
			'note' => 'Note',
			'color' => 'Color',
			'statustype' => 'Statustype',
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

		$criteria->compare('statusid',$this->statusid);
		$criteria->compare('statusdsc',$this->statusdsc,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('statustype',$this->statustype);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}