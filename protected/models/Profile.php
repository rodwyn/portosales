<?php

/**
 * This is the model class for table "profile".
 *
 * The followings are the available columns in table 'profile':
 * @property string $profileid
 * @property string $profiledsc
 * @property integer $usertypeid
 * @property integer $active
 * @property integer $specialpermission
 *
 * The followings are the available model relations:
 * @property Profileprivilege[] $profileprivileges
 */
class Profile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return 'profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profiledsc', 'required'),
			array('usertypeid, active, specialpermission', 'numerical', 'integerOnly'=>true),
			array('profiledsc', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('profileid, profiledsc, usertypeid, active, specialpermission', 'safe', 'on'=>'search'),
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
			'profileprivileges' => array(self::HAS_MANY, 'Profileprivilege', 'profileid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'profileid' => 'Profileid',
			'profiledsc' => 'Profiledsc',
			'usertypeid' => 'Usertypeid',
			'active' => 'Active',
			'specialpermission' => 'Specialpermission',
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

		$criteria->compare('profileid',$this->profileid,true);
		$criteria->compare('profiledsc',$this->profiledsc,true);
		$criteria->compare('usertypeid',$this->usertypeid);
		$criteria->compare('active',$this->active);
		$criteria->compare('specialpermission',$this->specialpermission);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}