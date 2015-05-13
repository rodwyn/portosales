<?php

/**
 * This is the model class for table "ratesupplier".
 *
 * The followings are the available columns in table 'ratesupplier':
 * @property string $ratesupplierid
 * @property string $rateid
 * @property string $supplierid
 * @property double $quantity_1
 * @property double $quantity_2
 * @property double $quantity_3
 * @property double $quantity_4
 * @property double $quantity_5
 * @property double $quantity_6
 * @property string $declinereason
 * @property integer $statusid
 * @property string $statustime
 * @property double $percent
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Supplier $supplier
 * @property Rate $rate
 * @property Status $status
 */
class Ratesupplier extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratesupplier the static model class
	 */
	public $supplierdsc; 
        public $price;
        public $dias;
        public $statusdsc;
        public $corporatename;
        public $Q1;
        public $Q2;
        public $Q3;
        public $Q4;
        public $Q5;
        public $Q6;
        
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ratesupplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, supplierid, statusid', 'required'),
			array('statusid, active', 'numerical', 'integerOnly'=>true),
			array('quantity_1, quantity_2, quantity_3, quantity_4, quantity_5, quantity_6, percent', 'numerical'),
			array('rateid', 'length', 'max'=>11),
			array('supplierid', 'length', 'max'=>10),
			array('declinereason, statustime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ratesupplierid, rateid, supplierid, quantity_1, quantity_2, quantity_3, quantity_4, quantity_5, quantity_6, declinereason, statusid, statustime, percent, active', 'safe', 'on'=>'search'),
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
			'supplier' => array(self::BELONGS_TO, 'supplier', 'supplierid'),
			'rate' => array(self::BELONGS_TO, 'rate', 'rateid'),
			'status' => array(self::BELONGS_TO, 'status', 'statusid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ratesupplierid' => 'Ratesupplierid',
			'rateid' => 'Rateid',
			'supplierid' => 'Proveedor',
			'quantity_1' => 'Quantity 1',
			'quantity_2' => 'Quantity 2',
			'quantity_3' => 'Quantity 3',
			'quantity_4' => 'Quantity 4',
			'quantity_5' => 'Quantity 5',
			'quantity_6' => 'Quantity 6',
			'declinereason' => 'Declinereason',
			'statusid' => 'Statusid',
			'statustime' => 'Statustime',
			'percent' => 'Percent',
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

		$criteria->compare('ratesupplierid',$this->ratesupplierid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('supplierid',$this->supplierid,true);
		$criteria->compare('quantity_1',$this->quantity_1);
		$criteria->compare('quantity_2',$this->quantity_2);
		$criteria->compare('quantity_3',$this->quantity_3);
		$criteria->compare('quantity_4',$this->quantity_4);
		$criteria->compare('quantity_5',$this->quantity_5);
		$criteria->compare('quantity_6',$this->quantity_6);
		$criteria->compare('declinereason',$this->declinereason,true);
		$criteria->compare('statusid',$this->statusid);
		$criteria->compare('statustime',$this->statustime,true);
		$criteria->compare('percent',$this->percent);
		$criteria->compare('showtable',$this->showtable);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getRateSupplier($rateid){
		$criteria = new CDbCriteria;
		$criteria->select = "t.statusid, t.ratesupplierid, s.supplierid, s.supplierdsc, quantity_1, quantity_2, quantity_3, quantity_4, quantity_5, quantity_6, percent, showtable ";
		$criteria->join = "INNER JOIN supplier s on s.supplierid = t.supplierid";
		$criteria->condition = " t.rateid = {$rateid} and t.statusid IN (10,11,12,13) ";
		return $this->findAll($criteria);
		
	}
        public function getRateSupplierById($ratesupplierid) {
            $criteria = new CDbCriteria;
		$criteria->select = "s.supplierdsc";
		$criteria->join = "INNER JOIN supplier s on s.supplierid = t.supplierid";
		$criteria->condition = " t.ratesupplierid = {$ratesupplierid} ";
		return $this->findAll($criteria);
            
        }
         public function quantityselectprod($rateid,$typ){
             $criteria->select=" IF(t.quantity_{$typ} is not null,GROUP_CONCAT(t.quantity_{$typ} separator '-'),'0') as quantity_{$typ} ";
               $criteria->condition ="t.rateid={$rateid} 
                        and t.statusid<>6";
               $criteria->group = 't.rateid';	
		
		$results =  $this->findAll($criteria);
		
		
		return $results;
	}
        public function getRateSupplier_pdf($bundleid){
		$criteria = new CDbCriteria;
		$criteria->select = "t.rateid,
                                    t.statusid, 
                                    t.ratesupplierid, 
                                    CASE r.quantityselect
                                    WHEN r.quantity_1 THEN t.quantity_1
                                    WHEN r.quantity_2 THEN t.quantity_2
                                    WHEN r.quantity_3 THEN t.quantity_3
                                    WHEN r.quantity_4 THEN t.quantity_4
                                    WHEN r.quantity_5 THEN t.quantity_5
                                    WHEN r.quantity_6 THEN t.quantity_6
                                    END AS price,
                                    CASE r.quantityselect
                                    WHEN r.quantity_1 THEN t.daysproduction1
                                    WHEN r.quantity_2 THEN t.daysproduction2
                                    WHEN r.quantity_3 THEN t.daysproduction3
                                    WHEN r.quantity_4 THEN t.daysproduction4
                                    WHEN r.quantity_5 THEN t.daysproduction5
                                    WHEN r.quantity_6 THEN t.daysproduction6
                                    END AS dias,                                    

                                    percent, showtable ";
		$criteria->join = "INNER JOIN rate r on r.rateid = t.rateid";
		$criteria->condition = " t.rateid = {$bundleid}  and r.complete=1 and r.active = 1 and t.statusid IN (10,11,12,13)";
		$return=$this->findAll($criteria);
               $minpri=0;
              
               $b=0;
               $band=0;
               $dias=0;
                foreach ($return as $row) {
                    $porcent=number_format($row->price*$row->percent/100 ,2);
                    $dias=$row->dias;
                     //$a=$row->price;
                      $a=$row->price+$porcent;
                      $prom=$prom+$a;
                      
                    if($a < $b){
                        $b=$a;
                    }else{
                        if($band==0){
                            $band=1;
                            $b=$a;
                            //echo $b.'----';
                        }
                    }
                }
                 $prom=$prom/count($return);
                $prom= number_format($prom,2);
		return $prom.'-'.$b.'-'.$dias;
	}
        public function getRateSupplierid($ratesupplierid){
		$criteria = new CDbCriteria;
		$criteria->select = 'IF(t.daysproduction1 IS NULL,"Sin Asignar",t.daysproduction1 ) as daysproduction1, 
                                    IF(t.daysproduction2 IS NULL,"Sin Asignar",t.daysproduction2 ) as daysproduction2, 
                                    IF(t.daysproduction3 IS NULL,"Sin Asignar",t.daysproduction3 ) as daysproduction3, 
                                    IF(t.daysproduction4 IS NULL,"Sin Asignar",t.daysproduction4 ) as daysproduction4, 
                                    IF(t.daysproduction5 IS NULL,"Sin Asignar",t.daysproduction5 ) as daysproduction5, 
                                    IF(t.daysproduction6 IS NULL,"Sin Asignar",t.daysproduction6 ) as daysproduction6, t.showtable ';
		
		$criteria->condition = " t.ratesupplierid = {$ratesupplierid}  ";
		return $this->findAll($criteria);
		
	}
	
	public function checked(){
		$checked = ($this->showtable==1)?' checked="checked" ':'';		
		return $checked;
	}
	
	public function selected(){
		$checked = ($this->statusid==11)?' checked ':'';		
		return $checked;
	}
	
	public function selectedicon(){
		$checked = ($this->statusid==11)?' <i class="icon-ok"></i> ':'';		
		return $checked;
	}
	
	public function selectedrow(){
		$row = ($this->statusid==11)?' style="background-color:#D9FAD9;" ':'';		
		return $row;
	}
	
	public function selectedcell(){
		$row = ($this->statusid==11)?true:false;		
		return $row;
	}
	public function activitybyrate($rateid,$ratesupplierid) {
        $criteria = new CDbCriteria;
        
        $con = ($ratesupplierid==="")?"":" AND t.ratesupplierid IN(".$ratesupplierid.") ";
        
        $criteria->select = "t.ratesupplierid, t.statustime, st.statusdsc, s.corporatename";
        $criteria->join = "INNER JOIN supplier s on s.supplierid = t.supplierid
                           INNER JOIN status st on st.statusid = t.statusid";
        $criteria->condition = "t.rateid =".$rateid.$con;
        $criteria->order = "t.statustime";

        return $this->findAll($criteria);
    }
    public function getdata($rateid) {
        $criteria = new CDbCriteria;
        
        $criteria->select = "t.*, IFNULL(t.quantity_1+(t.quantity_1*t.percent/100),0) AS Q1,
                            IFNULL(t.quantity_2+(t.quantity_2*t.percent/100),0) AS Q2,
                            IFNULL(t.quantity_3+(t.quantity_3*t.percent/100),0) AS Q3,
                            IFNULL(t.quantity_4+(t.quantity_4*t.percent/100),0) AS Q4,
                            IFNULL(t.quantity_5+(t.quantity_5*t.percent/100),0) AS Q5,
                            IFNULL(t.quantity_6+(t.quantity_6*t.percent/100),0) AS Q6";
        
        $criteria->condition = "t.showtable=1 AND t.statusid=10 AND t.rateid =".$rateid;

        return $this->findAll($criteria);
    }
    
    public function getmins($rateid) {
        $criteria = new CDbCriteria;
        
        $criteria->select = "min(t.quantity_1) as quantity_1,
                                min(t.quantity_2) as quantity_2,
                                min(t.quantity_3) as quantity_3,
                                min(t.quantity_4) as quantity_4,
                                min(t.quantity_5) as quantity_5,
                                min(t.quantity_6) as quantity_6";

        $criteria->condition = "t.statusid<>7 AND t.showtable=1  AND t.rateid =".$rateid;

        return $this->findAll($criteria);
    }
    
}