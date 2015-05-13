<?php

/**
 * This is the model class for table "permission".
 *
 * The followings are the available columns in table 'permission':
 * @property integer $permissionid
 * @property string $menuid
 * @property string $permissiondsc
 * @property string $permissiongroup
 *
 * The followings are the available model relations:
 * @property Menu $menu
 * @property Specialpermission[] $specialpermissions
 */
class Permission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Permission the static model class
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
		return 'permission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menuid, permissiondsc, permissiongroup', 'required'),
			array('menuid', 'length', 'max'=>10),
			array('permissiondsc', 'length', 'max'=>100),
			array('permissiongroup', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('permissionid, menuid, permissiondsc, permissiongroup', 'safe', 'on'=>'search'),
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
			'specialpermissions' => array(self::HAS_MANY, 'Specialpermission', 'permissionid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'permissionid' => 'Permissionid',
			'menuid' => 'Menuid',
			'permissiondsc' => 'Permissiondsc',
			'permissiongroup' => 'Permissiongroup',
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

		$criteria->compare('permissionid',$this->permissionid);
		$criteria->compare('menuid',$this->menuid,true);
		$criteria->compare('permissiondsc',$this->permissiondsc,true);
		$criteria->compare('permissiongroup',$this->permissiongroup,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}