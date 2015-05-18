<?php

/**
 * This is the model class for table "usercompany".
 *
 * The followings are the available columns in table 'usercompany':
 * @property integer $usercompanyid
 * @property integer $companyid
 * @property integer $active
 * @property integer $userid
 *
 * The followings are the available model relations:
 * @property Company $company
 */
class Usercompany extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usercompany the static model class
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
		return 'usercompany';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usercompanyid, companyid', 'required'),
			array('usercompanyid, companyid, active, userid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('usercompanyid, companyid, active, userid', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'companyid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usercompanyid' => 'Usercompanyid',
			'companyid' => 'Companyid',
			'active' => 'Active',
			'userid' => 'Userid',
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

		$criteria->compare('usercompanyid',$this->usercompanyid);
		$criteria->compare('companyid',$this->companyid);
		$criteria->compare('active',$this->active);
		$criteria->compare('userid',$this->userid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}