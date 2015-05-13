<?php

/**
 * This is the model class for table "status_production".
 *
 * The followings are the available columns in table 'status_production':
 * @property integer $status_productionid
 * @property string $status_productiondsc
 * @property string $status_productionporcent
 * @property integer $status_productionorder
 * @property string $status_productiontype
 */
class StatusProduction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StatusProduction the static model class
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
		return 'status_production';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status_productiondsc', 'required'),
			array('status_productionorder', 'numerical', 'integerOnly'=>true),
			array('status_productiondsc', 'length', 'max'=>120),
			array('status_productionporcent, status_productiontype', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('status_productionid, status_productiondsc, status_productionporcent, status_productionorder, status_productiontype', 'safe', 'on'=>'search'),
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
			'status_productionid' => 'Status Productionid',
			'status_productiondsc' => 'Status Productiondsc',
			'status_productionporcent' => 'Status Productionporcent',
			'status_productionorder' => 'Status Productionorder',
			'status_productiontype' => 'Status Productiontype',
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

		$criteria->compare('status_productionid',$this->status_productionid);
		$criteria->compare('status_productiondsc',$this->status_productiondsc,true);
		$criteria->compare('status_productionporcent',$this->status_productionporcent,true);
		$criteria->compare('status_productionorder',$this->status_productionorder);
		$criteria->compare('status_productiontype',$this->status_productiontype,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
           public function getstatusprod_all($ini,$fin,$type) {
           $criteria = new CDbCriteria;
            $criteria->select = "t.*";
          
            $criteria->condition ="t.status_productiontype=".$type." and t.active=1 and  t.status_productionorder BETWEEN ".$ini." and ".$fin ;

            $result = $this->findAll($criteria);
            foreach ($result as $row) {
                if( $row->status_productionporcent!='N' && $row->status_productionporcent!='0' && $row->status_productionporcent!='C'){
                    $porcent = $porcent + $row->status_productionporcent;
                }
            }
            return $porcent;
    }
}