<?php

/**
 * This is the model class for table "menuprofile".
 *
 * The followings are the available columns in table 'menuprofile':
 * @property integer $menuprofileid
 * @property string $profileid
 * @property string $menuid
 * @property integer $read
 * @property integer $add
 * @property integer $edit
 * @property integer $delete
 *
 * The followings are the available model relations:
 * @property Menu $menu
 * @property Profile $profile
 */
class Menuprofile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menuprofile the static model class
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
		return 'menuprofile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('read, add, edit, delete', 'numerical', 'integerOnly'=>true),
			array('profileid, menuid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menuprofileid, profileid, menuid, read, add, edit, delete', 'safe', 'on'=>'search'),
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
			'menuprofileid' => 'Menuprofileid',
			'profileid' => 'Profileid',
			'menuid' => 'Menuid',
			'read' => 'Read',
			'add' => 'Add',
			'edit' => 'Edit',
			'delete' => 'Delete',
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

		$criteria->compare('menuprofileid',$this->menuprofileid);
		$criteria->compare('profileid',$this->profileid,true);
		$criteria->compare('menuid',$this->menuid,true);
		$criteria->compare('read',$this->read);
		$criteria->compare('add',$this->add);
		$criteria->compare('edit',$this->edit);
		$criteria->compare('delete',$this->delete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}