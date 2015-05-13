<?php

/**
 * This is the model class for table "downloadablereport".
 *
 * The followings are the available columns in table 'downloadablereport':
 * @property string $downloadablereportid
 * @property integer $companyid
 * @property integer $customerid
 * @property string $categoryid
 * @property string $fileName
 * @property string $loaddate
 *
 * The followings are the available model relations:
 * @property Categoryset $category
 * @property Company $company
 * @property Customer $customer
 */
class Downloadablereport extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Downloadablereport the static model class
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
		return 'downloadablereport';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyid, customerid, categoryid, fileName', 'required'),
			array('companyid, customerid', 'numerical', 'integerOnly'=>true),
			array('categoryid', 'length', 'max'=>11),
			array('fileName', 'length', 'max'=>200),
			array('loaddate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('downloadablereportid, companyid, customerid, categoryid, fileName, loaddate', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Categoryset', 'categoryid'),
			'company' => array(self::BELONGS_TO, 'Company', 'companyid'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customerid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'downloadablereportid' => 'Downloadablereportid',
			'companyid' => 'Companyid',
			'customerid' => 'Customerid',
			'categoryid' => 'Categoryid',
			'fileName' => 'File Name',
			'loaddate' => 'Loaddate',
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

		$criteria->compare('downloadablereportid',$this->downloadablereportid,true);
		$criteria->compare('companyid',$this->companyid);
		$criteria->compare('customerid',$this->customerid);
		$criteria->compare('categoryid',$this->categoryid,true);
		$criteria->compare('fileName',$this->fileName,true);
		$criteria->compare('loaddate',$this->loaddate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}