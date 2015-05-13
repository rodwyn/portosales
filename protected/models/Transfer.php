<?php

/**
 * This is the model class for table "transfer".
 *
 * The followings are the available columns in table 'transfer':
 * @property integer $transferid
 * @property integer $origincompanyid
 * @property integer $targetcompanyid
 * @property integer $sendinguserid
 * @property integer $receivinguserid
 * @property string $shippingdate
 * @property string $arrivaldate
 * @property integer $statustransid
 *
 * The followings are the available model relations:
 * @property Statustrans $statustrans
 * @property Product[] $products
 */
class Transfer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transfer the static model class
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
		return 'transfer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('origincompanyid, targetcompanyid, sendinguserid, receivinguserid, statustransid', 'required'),
			array('origincompanyid, targetcompanyid, sendinguserid, receivinguserid, statustransid', 'numerical', 'integerOnly'=>true),
			array('shippingdate, arrivaldate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('transferid, origincompanyid, targetcompanyid, sendinguserid, receivinguserid, shippingdate, arrivaldate, statustransid', 'safe', 'on'=>'search'),
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
			'statustrans' => array(self::BELONGS_TO, 'Statustrans', 'statustransid'),
			'products' => array(self::MANY_MANY, 'Product', 'transferproduct(transferid, productid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'transferid' => 'Transferid',
			'origincompanyid' => 'Origincompanyid',
			'targetcompanyid' => 'Targetcompanyid',
			'sendinguserid' => 'Sendinguserid',
			'receivinguserid' => 'Receivinguserid',
			'shippingdate' => 'Shippingdate',
			'arrivaldate' => 'Arrivaldate',
			'statustransid' => 'Statustransid',
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

		$criteria->compare('transferid',$this->transferid);
		$criteria->compare('origincompanyid',$this->origincompanyid);
		$criteria->compare('targetcompanyid',$this->targetcompanyid);
		$criteria->compare('sendinguserid',$this->sendinguserid);
		$criteria->compare('receivinguserid',$this->receivinguserid);
		$criteria->compare('shippingdate',$this->shippingdate,true);
		$criteria->compare('arrivaldate',$this->arrivaldate,true);
		$criteria->compare('statustransid',$this->statustransid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}