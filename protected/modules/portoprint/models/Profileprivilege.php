<?php

/**
 * This is the model class for table "profileprivilege".
 *
 * The followings are the available columns in table 'profileprivilege':
 * @property string $profileprivilegeid
 * @property string $profileid
 * @property string $menuid
 * @property integer $menuread
 * @property integer $menuadd
 * @property integer $menuedit
 * @property integer $menudelete
 *
 * The followings are the available model relations:
 * @property Menu $menu
 * @property Profile $profile
 */
class Profileprivilege extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profileprivilege the static model class
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
		return 'profileprivilege';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profileid, menuid', 'required'),
			array('menuread, menuadd, menuedit, menudelete', 'numerical', 'integerOnly'=>true),
			array('profileid, menuid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('profileprivilegeid, profileid, menuid, menuread, menuadd, menuedit, menudelete', 'safe', 'on'=>'search'),
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
			'menu' => array(self::BELONGS_TO, 'Menu', 'menuid'),
			'profile' => array(self::BELONGS_TO, 'Profile', 'profileid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'profileprivilegeid' => 'Profileprivilegeid',
			'profileid' => 'Profileid',
			'menuid' => 'Menuid',
			'menuread' => 'Menuread',
			'menuadd' => 'Menuadd',
			'menuedit' => 'Menuedit',
			'menudelete' => 'Menudelete',
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

		$criteria->compare('profileprivilegeid',$this->profileprivilegeid,true);
		$criteria->compare('profileid',$this->profileid,true);
		$criteria->compare('menuid',$this->menuid,true);
		$criteria->compare('menuread',$this->menuread);
		$criteria->compare('menuadd',$this->menuadd);
		$criteria->compare('menuedit',$this->menuedit);
		$criteria->compare('menudelete',$this->menudelete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}