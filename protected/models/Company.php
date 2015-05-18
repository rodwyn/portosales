<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $companyid
 * @property integer $corporateid
 * @property string $companydsc
 * @property string $rfc
 * @property string $tax
 * @property string $duration
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Corporate $corporate
 * @property Customer[] $customers
 * @property Product[] $products
 */
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('corporateid, companydsc, rfc', 'required'),
			array('corporateid, active', 'numerical', 'integerOnly'=>true),
			array('companydsc', 'length', 'max'=>70),
			array('rfc', 'length', 'max'=>30),
			array('tax, duration', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('companyid, corporateid, companydsc, rfc, tax, duration, active', 'safe', 'on'=>'search'),
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
			'corporate' => array(self::BELONGS_TO, 'Corporate', 'corporateid'),
			'customers' => array(self::HAS_MANY, 'Customer', 'companyid'),
			'products' => array(self::MANY_MANY, 'Product', 'stock(companyid, productid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'companyid' => 'Companyid',
			'corporateid' => 'Corporateid',
			'companydsc' => 'Companydsc',
			'rfc' => 'Rfc',
			'tax' => 'Tax',
			'duration' => 'Duration',
			'active' => 'Active',
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

		$criteria->compare('companyid',$this->companyid);
		$criteria->compare('corporateid',$this->corporateid);
		$criteria->compare('companydsc',$this->companydsc,true);
		$criteria->compare('rfc',$this->rfc,true);
		$criteria->compare('tax',$this->tax,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}