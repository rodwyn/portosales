<?php

/**
 * This is the model class for table "corporate".
 *
 * The followings are the available columns in table 'corporate':
 * @property integer $corporateid
 * @property string $corporatedsc
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Category[] $categories
 * @property Company[] $companies
 * @property Product[] $products
 */
class Corporate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Corporate the static model class
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
		return 'corporate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('corporatedsc', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('corporatedsc', 'length', 'max'=>70),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('corporateid, corporatedsc, active', 'safe', 'on'=>'search'),
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
			'categories' => array(self::HAS_MANY, 'Category', 'corporateid'),
			'companies' => array(self::HAS_MANY, 'Company', 'corporateid'),
			'products' => array(self::HAS_MANY, 'Product', 'corporateid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'corporateid' => 'Corporateid',
			'corporatedsc' => 'Corporatedsc',
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

		$criteria->compare('corporateid',$this->corporateid);
		$criteria->compare('corporatedsc',$this->corporatedsc,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}