<?php

/**
 * This is the model class for table "rateodc".
 *
 * The followings are the available columns in table 'rateodc':
 * @property string $rateodcid
 * @property string $rateid
 * @property string $supplierid
 * @property integer $statusid
 * @property string $statustime
 * @property integer $quantityselect
 * @property double $price
 * @property string $odcc
 * @property string $odccdate
 * @property integer $iva
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Status $status
 * @property Rate $rate
 * @property Supplier $supplier
 */
class Rateodc extends CActiveRecord
{
	public $corporatename;
	public $rfc;
	public $address;
	public $suburb;
	public $citydsc;
	public $phone;
	public $statedsc;
	public $cp;
	public $servicedsc;
	public $note;
	public $projectdsc;
	public $branddsc;
	public $bundleid;
	public $customerdsc;
	public $supplierdsc;
	public $dateodc;
	public $percent;
	public $total;
	public $cadena;
	public $sellprice;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rateodc the static model class
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
		return 'rateodc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, supplierid, statusid, statustime, quantityselect, odcc, odccdate', 'required'),
			array('statusid, quantityselect, iva, active', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('rateid', 'length', 'max'=>11),
			array('supplierid', 'length', 'max'=>10),
			array('odcc', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rateodcid, rateid, supplierid, statusid, statustime, quantityselect, price, odcc, odccdate, iva, active', 'safe', 'on'=>'search'),
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
			'status' => array(self::BELONGS_TO, 'Status', 'statusid'),
			'rate' => array(self::BELONGS_TO, 'Rate', 'rateid'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplierid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rateodcid' => 'Rateodcid',
			'rateid' => 'Rateid',
			'supplierid' => 'Supplierid',
			'statusid' => 'Statusid',
			'statustime' => 'Statustime',
			'quantityselect' => 'Quantityselect',
			'price' => 'Price',
			'odcc' => 'Odcc',
			'odccdate' => 'Odccdate',
			'iva' => 'Iva',
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

		$criteria->compare('rateodcid',$this->rateodcid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('supplierid',$this->supplierid,true);
		$criteria->compare('statusid',$this->statusid);
		$criteria->compare('statustime',$this->statustime,true);
		$criteria->compare('quantityselect',$this->quantityselect);
		$criteria->compare('price',$this->price);
		$criteria->compare('odcc',$this->odcc,true);
		$criteria->compare('odccdate',$this->odccdate,true);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function odcByUser($rateid,$userid)
	{
		$criteria = new CDbCriteria;
		$criteria->select = " LPAD(t.supplierid,8,0) as supplierid, LPAD(t.rateodcid,8,0) as rateodcid, LPAD(t.rateid,8,0) as rateid, r.version, sp.corporatename, sp.rfc, sp.address, sp.suburb, ct.citydsc, sp.phone, st.statedsc, ".
							" s.servicedsc, sp.cp, r.note, t.quantityselect, t.price, p.projectdsc, b.branddsc ";
		$criteria->join = "INNER JOIN rate r ON r.rateid = t.rateid
						   INNER JOIN supplier sp ON sp.supplierid = t.supplierid
						   INNER JOIN city ct ON ct.cityid = sp.cityid
						   INNER JOIN state st ON st.stateid = ct.stateid
						   INNER JOIN project p ON p.projectid = r.projectid
						   INNER JOIN brand b ON b.brandid = p.brandid
						   INNER JOIN customer c on c.customerid = b.customerid
						   INNER JOIN service s ON s.serviceid = r.serviceid
						   INNER JOIN service s2 on s2.serviceid = s.serviceparentid
						   INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
						   INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
						   INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
						   INNER JOIN userservice  ON userservice.serviceid = s5.serviceid
						   INNER JOIN usercustomerpermission ucp ON ucp.customerid = c.customerid";
		$criteria->condition = " t.rateid = {$rateid} AND ucp.userid = {$userid} and userservice.userid = {$userid} and t.active = 1";
		return $this->find($criteria);
		
	}
	
	public function getSearch($serviceid, $sdetailv)
	{
		$criteria = new CDbCriteria;
		$criteria->select = " LPAD(r.bundleid,8,0) as bundleid, 
							  LPAD(r.rateid,8,0) as rateid, 
                                    c.customerdsc, 
                                    s.supplierdsc, 
                                    DATE(t.statustime) as dateodc, 
                                    t.quantityselect, 
                                    t.price,                                  
                                    r.pprice as sellprice,
                                    sv.servicedsc,
									r.note,
                                    group_concat(rd.itemdetailvalueid) as cadena ";
		$criteria->join = " INNER JOIN rate r on r.rateid = t.rateid
							INNER JOIN project p on p.projectid = r.projectid
							INNER JOIN brand b on b.brandid = p.brandid
							INNER JOIN customer c on c.customerid = b.customerid
							INNER JOIN supplier s on s.supplierid = t.supplierid
							INNER JOIN ratesupplier rs on rs.rateid = t.rateid and rs.supplierid = t. supplierid
							INNER JOIN rateitemdetailvalue rd on rd.rateid = t.rateid 
							INNER JOIN service sv on sv.serviceid = r.serviceid";
		$criteria->condition = " r.serviceid = {$serviceid} ";
		$criteria->group = "rd.rateid ";
		$cont=0;
		
			foreach($sdetailv as $row){
				if($row!=''){
					if($cont==0)
						$criteria->having .= "  find_in_set('{$row}', cadena) ";
					else
						$criteria->having .= " and find_in_set('{$row}', cadena) ";
					$cont++;
				}
			}
	
		$criteria->order = "t.statustime desc, rd.itemdetailvalueid asc";		
		return $this->findAll($criteria);
		
	}
        
        public function getSearch_custom($serviceid, $sdetailv,$customerid)
	{
		$criteria = new CDbCriteria;
		$criteria->select = " LPAD(r.bundleid,8,0) as bundleid, 
							  LPAD(r.rateid,8,0) as rateid, 
                                    c.customerdsc, 
                                    s.supplierdsc, 
                                    DATE(t.statustime) as dateodc, 
                                    t.quantityselect, 
                                    t.price,                                  
                                    r.pprice as sellprice,
                                    
                                    group_concat(rd.itemdetailvalueid) as cadena ";
		$criteria->join = " INNER JOIN rate r on r.rateid = t.rateid
							INNER JOIN project p on p.projectid = r.projectid
							INNER JOIN brand b on b.brandid = p.brandid
							INNER JOIN customer c on c.customerid = b.customerid
							INNER JOIN supplier s on s.supplierid = t.supplierid
							INNER JOIN ratesupplier rs on rs.rateid = t.rateid and rs.supplierid = t. supplierid
							INNER JOIN rateitemdetailvalue rd on rd.rateid = t.rateid ";
		$condicion=' ';
                if($customerid!=0){
                    $condicion=" r.serviceid = {$serviceid}  and b.customerid= {$customerid}";
                }else{
                    $condicion=" r.serviceid = {$serviceid}";
                }
                $criteria->condition = $condicion;
		$criteria->group = "rd.rateid ";
		$cont=0;
		if($sdetailv!=-1){
			foreach($sdetailv as $row){
				if($row!=''){
					if($cont==0)
						$criteria->having .= "  find_in_set('{$row}', cadena) ";
					else
						$criteria->having .= " and find_in_set('{$row}', cadena) ";
					$cont++;
				}
			}
                }
		$criteria->order = "t.statustime desc, rd.itemdetailvalueid asc";		
		return $this->findAll($criteria);
		
	}
        public function getSearch_supp($serviceid, $sdetailv,$customerid,$supplierid)
	{
		$criteria = new CDbCriteria;
		$criteria->select = " LPAD(r.bundleid,8,0) as bundleid, 
							  LPAD(r.rateid,8,0) as rateid, 
                                    c.customerdsc, 
                                    s.supplierdsc, 
                                    DATE(t.statustime) as dateodc, 
                                    t.quantityselect, 
                                    t.price,                                  
                                    r.pprice as sellprice,
                                    
                                    group_concat(rd.itemdetailvalueid) as cadena ";
		$criteria->join = " INNER JOIN rate r on r.rateid = t.rateid
							INNER JOIN project p on p.projectid = r.projectid
							INNER JOIN brand b on b.brandid = p.brandid
							INNER JOIN customer c on c.customerid = b.customerid
							INNER JOIN supplier s on s.supplierid = t.supplierid
							INNER JOIN ratesupplier rs on rs.rateid = t.rateid and rs.supplierid = t. supplierid
							INNER JOIN rateitemdetailvalue rd on rd.rateid = t.rateid ";
		$condicion=' ';
                 $condicion=" r.serviceid = {$serviceid}";
                if($supplierid!=0 ){
                    $condicion.="  and s.supplierid= {$supplierid}";
                }
                    if($customerid!=0){
                        $condicion.=" and b.customerid= {$customerid}";
                    }
                
                $criteria->condition = $condicion;
		$criteria->group = "rd.rateid ";
		$cont=0;
		if($sdetailv!=-1){
			foreach($sdetailv as $row){
				if($row!=''){
					if($cont==0)
						$criteria->having .= "  find_in_set('{$row}', cadena) ";
					else
						$criteria->having .= " and find_in_set('{$row}', cadena) ";
					$cont++;
				}
			}
                }
		$criteria->order = "t.statustime desc, rd.itemdetailvalueid asc";		
		return $this->findAll($criteria);
		
	}
        
        
         public function getSearch_cuncos($serviceid, $sdetailv,$customerid,$supplierid,$min,$max)
	{
		$criteria = new CDbCriteria;
		$criteria->select = " LPAD(r.bundleid,8,0) as bundleid, 
							  LPAD(r.rateid,8,0) as rateid, 
                                    c.customerdsc, 
                                    s.supplierdsc, 
                                    DATE(t.statustime) as dateodc, 
                                    t.quantityselect, 
                                    t.price,                                  
                                    r.pprice as sellprice,
                                    
                                    group_concat(rd.itemdetailvalueid) as cadena ";
		$criteria->join = " INNER JOIN rate r on r.rateid = t.rateid
							INNER JOIN project p on p.projectid = r.projectid
							INNER JOIN brand b on b.brandid = p.brandid
							INNER JOIN customer c on c.customerid = b.customerid
							INNER JOIN supplier s on s.supplierid = t.supplierid
							INNER JOIN ratesupplier rs on rs.rateid = t.rateid and rs.supplierid = t. supplierid
							INNER JOIN rateitemdetailvalue rd on rd.rateid = t.rateid ";
		$condicion=' ';
                $condicion=" r.serviceid = {$serviceid}";
                if($supplierid!=0 ){
                    $condicion.=" and s.supplierid= {$supplierid}";
                }
                    if($customerid!=0){
                        $condicion.=" and b.customerid= {$customerid}";
                    }
                 if($min!=0 && $max!=0){
                        $condicion.=" and t.quantityselect BETWEEN {$min} and {$max}";
                    }    
                    
                
                $criteria->condition = $condicion;
		$criteria->group = "rd.rateid ";
		$cont=0;
		if($sdetailv!=-1){
			foreach($sdetailv as $row){
				if($row!=''){
					if($cont==0)
						$criteria->having .= "  find_in_set('{$row}', cadena) ";
					else
						$criteria->having .= " and find_in_set('{$row}', cadena) ";
					$cont++;
				}
			}
                }
		$criteria->order = "t.statustime desc, rd.itemdetailvalueid asc";		
		return $this->findAll($criteria);
		
	}
        
        
        public function getSearch_list($serviceid)
	{
		$criteria = new CDbCriteria;
		$criteria->select = "s.supplierid,
                                     s.supplierdsc ";
		$criteria->join = " INNER JOIN rate r on r.rateid = t.rateid
                                    INNER JOIN supplier s on s.supplierid = t.supplierid";
		$criteria->condition = " r.serviceid = {$serviceid} ";
               
                return $this->findAll($criteria);
        }
        public function getSearch_list2($serviceid,$customerid)
	{
		$criteria = new CDbCriteria;
		$criteria->select = "s.supplierid,
                                     s.supplierdsc ";
		$criteria->join = " INNER JOIN rate r on r.rateid = t.rateid
                                    INNER JOIN project p on p.projectid = r.projectid
                                    INNER JOIN brand b on b.brandid = p.brandid
                                    INNER JOIN customer c on c.customerid = b.customerid
                                    INNER JOIN supplier s on s.supplierid = t.supplierid
                                    ";
		$criteria->condition = " r.serviceid = {$serviceid} and b.customerid= {$customerid}";
               
                return $this->findAll($criteria);
        }
        
        
}