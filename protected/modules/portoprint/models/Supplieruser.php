<?php

/**
 * This is the model class for table "supplieruser".
 *
 * The followings are the available columns in table 'supplieruser':
 * @property integer $userid
 * @property string $supplierid
 * @property string $firstname
 * @property string $plastname
 * @property string $mlastname
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Supplieruser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Supplieruser the static model class
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
		return 'supplieruser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, supplierid', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('supplierid', 'length', 'max'=>10),
			array('firstname, plastname, mlastname', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, supplierid, firstname, plastname, mlastname', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => 'Userid',
			'supplierid' => 'Supplierid',
			'firstname' => 'Firstname',
			'plastname' => 'Plastname',
			'mlastname' => 'Mlastname',
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

		$criteria->compare('userid',$this->userid);
		$criteria->compare('supplierid',$this->supplierid,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('plastname',$this->plastname,true);
		$criteria->compare('mlastname',$this->mlastname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}