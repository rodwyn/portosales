<?php

/**
 * This is the model class for table "modules".
 *
 * The followings are the available columns in table 'modules':
 * @property integer $moduleid
 * @property string $modulename
 * @property string $moduledsc
 * @property string $moduleimage
 */
class Modules extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Modules the static model class
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
		return 'modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modulename, moduledsc, moduleimage', 'required'),
			array('modulename, moduledsc', 'length', 'max'=>60),
			array('moduleimage', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('moduleid, modulename, moduledsc, moduleimage', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'moduleid' => 'Moduleid',
			'modulename' => 'Modulename',
			'moduledsc' => 'Moduledsc',
			'moduleimage' => 'Moduleimage',
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

		$criteria->compare('moduleid',$this->moduleid);
		$criteria->compare('modulename',$this->modulename,true);
		$criteria->compare('moduledsc',$this->moduledsc,true);
		$criteria->compare('moduleimage',$this->moduleimage,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}