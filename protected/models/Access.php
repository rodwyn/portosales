<?php

/**
 * This is the model class for table "access".
 *
 * The followings are the available columns in table 'access':
 * @property string $accessid
 * @property integer $userid
 * @property integer $menuid
 * @property string $oper
 * @property string $data
 * @property string $accessdate
 */
class Access extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Access the static model class
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
		return 'access';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, menuid, oper, data, accessdate', 'required'),
			array('userid, menuid', 'numerical', 'integerOnly'=>true),
			array('oper', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('accessid, userid, menuid, oper, data, accessdate', 'safe', 'on'=>'search'),
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
			'accessid' => 'Accessid',
			'userid' => 'Userid',
			'menuid' => 'Menuid',
			'oper' => 'Oper',
			'data' => 'Data',
			'accessdate' => 'Accessdate',
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

		$criteria->compare('accessid',$this->accessid,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('menuid',$this->menuid);
		$criteria->compare('oper',$this->oper,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('accessdate',$this->accessdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}