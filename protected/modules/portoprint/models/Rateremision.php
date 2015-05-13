<?php

/**
 * This is the model class for table "rateremision".
 *
 * The followings are the available columns in table 'rateremision':
 * @property integer $rateremisionid
 * @property integer $cantparcial
 * @property integer $rateid
 * @property string $datecreate
 */
class Rateremision extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rateremision the static model class
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
		return 'rateremision';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantparcial, rateid', 'numerical', 'integerOnly'=>true),
			array('datecreate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rateremisionid, cantparcial, rateid, datecreate', 'safe', 'on'=>'search'),
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
			'rateremisionid' => 'Rateremisionid',
			'cantparcial' => 'Cantparcial',
			'rateid' => 'Rateid',
			'datecreate' => 'Datecreate',
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

		$criteria->compare('rateremisionid',$this->rateremisionid);
		$criteria->compare('cantparcial',$this->cantparcial);
		$criteria->compare('rateid',$this->rateid);
		$criteria->compare('datecreate',$this->datecreate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}