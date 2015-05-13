<?php

/**
 * This is the model class for table "usercontactpermission".
 *
 * The followings are the available columns in table 'usercontactpermission':
 * @property string $usercontactpermissionid
 * @property integer $userid
 * @property integer $contactid
 *
 * The followings are the available model relations:
 * @property Customercontact $contact
 * @property User $user
 */
class Usercontactpermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usercontactpermission the static model class
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
		return 'usercontactpermission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, contactid', 'required'),
			array('userid, contactid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('usercontactpermissionid, userid, contactid', 'safe', 'on'=>'search'),
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
			'contact' => array(self::BELONGS_TO, 'Customercontact', 'contactid'),
			'user' => array(self::BELONGS_TO, 'User', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usercontactpermissionid' => 'Usercontactpermissionid',
			'userid' => 'Userid',
			'contactid' => 'Contactid',
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

		$criteria->compare('usercontactpermissionid',$this->usercontactpermissionid,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('contactid',$this->contactid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}