<?php

/**
 * This is the model class for table "userprivilege".
 *
 * The followings are the available columns in table 'userprivilege':
 * @property string $userprivilegeid
 * @property integer $userid
 * @property string $menuid
 * @property integer $menuread
 * @property integer $menuadd
 * @property integer $menuedit
 * @property integer $menudelete
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Menu $menu
 */
class Userprivilege extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userprivilege the static model class
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
		return 'userprivilege';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, menuid', 'required'),
			array('userid, menuread, menuadd, menuedit, menudelete', 'numerical', 'integerOnly'=>true),
			array('menuid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userprivilegeid, userid, menuid, menuread, menuadd, menuedit, menudelete', 'safe', 'on'=>'search'),
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
			'menu' => array(self::BELONGS_TO, 'Menu', 'menuid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userprivilegeid' => 'Userprivilegeid',
			'userid' => 'Userid',
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

		$criteria->compare('userprivilegeid',$this->userprivilegeid,true);
		$criteria->compare('userid',$this->userid);
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