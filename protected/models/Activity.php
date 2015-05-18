<?php

/**
 * This is the model class for table "activity".
 *
 * The followings are the available columns in table 'activity':
 * @property string $activityid
 * @property integer $userid
 * @property string $menuid
 * @property string $activity
 * @property string $activitydate
 * @property string $type
 * @property integer $id
 *
 * The followings are the available model relations:
 * @property Menu $menu
 * @property User $user
 */
class Activity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Activity the static model class
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
		return 'activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, menuid, activity, activitydate', 'required'),
			array('userid, id', 'numerical', 'integerOnly'=>true),
			array('menuid', 'length', 'max'=>10),
			array('activity', 'length', 'max'=>140),
			array('type', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('activityid, userid, menuid, activity, activitydate, type, id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'activityid' => 'Activityid',
			'userid' => 'Userid',
			'menuid' => 'Menuid',
			'activity' => 'Activity',
			'activitydate' => 'Activitydate',
			'type' => 'Type',
			'id' => 'ID',
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

		$criteria->compare('activityid',$this->activityid,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('menuid',$this->menuid,true);
		$criteria->compare('activity',$this->activity,true);
		$criteria->compare('activitydate',$this->activitydate,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('id',$this->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}