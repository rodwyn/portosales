<?php

/**
 * This is the model class for table "userbrandpermission".
 *
 * The followings are the available columns in table 'userbrandpermission':
 * @property string $userbrandpermissionid
 * @property integer $userid
 * @property string $brandid
 *
 * The followings are the available model relations:
 * @property Brand $brand
 * @property User $user
 */
class Userbrandpermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userbrandpermission the static model class
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
		return 'userbrandpermission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, brandid', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('brandid', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userbrandpermissionid, userid, brandid', 'safe', 'on'=>'search'),
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
			'brand' => array(self::BELONGS_TO, 'Brand', 'brandid'),
			'user' => array(self::BELONGS_TO, 'User', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userbrandpermissionid' => 'Userbrandpermissionid',
			'userid' => 'Userid',
			'brandid' => 'Brandid',
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

		$criteria->compare('userbrandpermissionid',$this->userbrandpermissionid,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('brandid',$this->brandid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}