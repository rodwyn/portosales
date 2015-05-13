<?php

/**
 * This is the model class for table "specialpermission".
 *
 * The followings are the available columns in table 'specialpermission':
 * @property string $specialpermissionid
 * @property integer $userid
 * @property integer $permissionid
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Permission $permission
 */
class Specialpermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Specialpermission the static model class
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
		return 'specialpermission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, permissionid', 'required'),
			array('userid, permissionid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('specialpermissionid, userid, permissionid', 'safe', 'on'=>'search'),
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
			'permission' => array(self::BELONGS_TO, 'Permission', 'permissionid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'specialpermissionid' => 'Specialpermissionid',
			'userid' => 'Userid',
			'permissionid' => 'Permissionid',
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

		$criteria->compare('specialpermissionid',$this->specialpermissionid,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('permissionid',$this->permissionid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}