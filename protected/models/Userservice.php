<?php

/**
 * This is the model class for table "userservice".
 *
 * The followings are the available columns in table 'userservice':
 * @property string $userserviceid
 * @property integer $userid
 * @property string $serviceid
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property User $user
 */
class Userservice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userservice the static model class
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
		return 'userservice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, serviceid', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('serviceid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userserviceid, userid, serviceid', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'Service', 'serviceid'),
			'user' => array(self::BELONGS_TO, 'User', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userserviceid' => 'Userserviceid',
			'userid' => 'Userid',
			'serviceid' => 'Serviceid',
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

		$criteria->compare('userserviceid',$this->userserviceid,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('serviceid',$this->serviceid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}