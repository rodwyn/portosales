<?php

/**
 * This is the model class for table "generalform".
 *
 * The followings are the available columns in table 'generalform':
 * @property integer $general_formid
 * @property string $general_form
 * @property string $general_form_type
 */
class Generalform extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Generalform the static model class
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
		return 'generalform';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('general_form, general_form_type', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('general_formid, general_form, general_form_type', 'safe', 'on'=>'search'),
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
			'general_formid' => 'General Formid',
			'general_form' => 'General Form',
			'general_form_type' => 'General Form Type',
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

		$criteria->compare('general_formid',$this->general_formid);
		$criteria->compare('general_form',$this->general_form,true);
		$criteria->compare('general_form_type',$this->general_form_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
       
        public function get_forms($customerid) {
            $criteria = new CDbCriteria;

            $criteria->select = "t.*";
            $criteria->join = "inner join formcustomer f on f.general_formid=t.general_formid ";
            $criteria->condition = "t.companyid=".Yii::app()->user->companyid." and f.customerid=".$customerid;

            return $this->findAll($criteria);
        }
        
        
}