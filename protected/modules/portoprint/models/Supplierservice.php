<?php

/**
 * This is the model class for table "supplierservice".
 *
 * The followings are the available columns in table 'supplierservice':
 * @property string $supplierservice
 * @property string $supplierid
 * @property string $serviceid
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property Supplier $supplier
 */
class Supplierservice extends CActiveRecord
{
	public $supplierdsc;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Supplierservice the static model class
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
		return 'supplierservice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supplierid, serviceid', 'required'),
			array('supplierid, serviceid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('supplierservice, supplierid, serviceid', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'Service', 'serviceid'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplierid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'supplierservice' => 'Supplierservice',
			'supplierid' => 'Proveedor',
			'serviceid' => 'Rubro',
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

		$criteria->compare('supplierservice',$this->supplierservice,true);
		$criteria->compare('supplierid',$this->supplierid,true);
		$criteria->compare('serviceid',$this->serviceid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getSupplierbyServiceid($serviceid)	{
		$criteria = new CDbCriteria ;
        $criteria->select = " t.supplierid, CONCAT(s.supplierdsc,' [ ', cn.countrydsc, ' ]') as supplierdsc   " ; 
        $criteria->join = "inner join supplier s on s.supplierid = t.supplierid and s.active=1 ".
        				  "inner join city c on c.cityid = s.cityid ".
        				  "inner join country cn on cn.countryid = c.countryid";
        $criteria->condition = " t.serviceid = {$serviceid} ";
		return $this->findAll($criteria);
	}
	
	public function getSupplierbyRateServiceid($serviceid, $rateid)	{
		$criteria = new CDbCriteria ;
        $criteria->select = " t.supplierid, CONCAT(s.supplierdsc,' [ ', cn.countrydsc, ' ]') as supplierdsc   " ; 
        $criteria->join = "inner join supplier s on s.supplierid = t.supplierid and s.active=1 ".
        				  "inner join city c on c.cityid = s.cityid ".
        				  "inner join country cn on cn.countryid = c.countryid";
        $criteria->condition = " t.serviceid = {$serviceid} and t.supplierid not in (select supplierid from ratesupplier where rateid = {$rateid})";
		return $this->findAll($criteria);
	}
        
             public function getSupplierServicelist($serviceid){

		$criteria = new CDbCriteria ;
		$criteria->select = "t.* ";
		
		$criteria->condition = "t.supplierid={$serviceid} ";
		return $this->findAll($criteria);
	}
        
          public function ultimo_identificador(){
            
            $criteria=new CDbCriteria;
            $criteria->select = "t.supplierservice";
            $criteria->order = "t.supplierservice DESC";
            $criteria->limit = 1;
            $result= $this->find($criteria);
            return $result->supplierservice;
        }
        
}