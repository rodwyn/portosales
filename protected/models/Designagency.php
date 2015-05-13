<?php

/**
 * This is the model class for table "designagency".
 *
 * The followings are the available columns in table 'designagency':
 * @property string $designagencyid
 * @property string $customerid
 * @property string $designagencydsc
 * @property integer $active
 */
class Designagency extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Designagency the static model class
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
		return 'designagency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customerid, designagencydsc', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('customerid', 'length', 'max'=>10),
			array('designagencydsc', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('designagencyid, customerid, designagencydsc, active', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'designagencyid' => 'Designagencyid',
			'customerid' => 'Customerid',
			'designagencydsc' => 'Designagencydsc',
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

		$criteria->compare('designagencyid',$this->designagencyid,true);
		$criteria->compare('customerid',$this->customerid,true);
		$criteria->compare('designagencydsc',$this->designagencydsc,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}