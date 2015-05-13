<?php

/**
 * This is the model class for table "supplier".
 *
 * The followings are the available columns in table 'supplier':
 * @property string $supplierid
 * @property string $companyid
 * @property string $serviceid
 * @property string $corporatename
 * @property string $supplierdsc
 * @property string $contactname
 * @property string $website
 * @property string $phone
 * @property string $email
 * @property string $email2
 * @property string $email3
 * @property string $email4
 * @property string $email5
 * @property string $rfc
 * @property string $address
 * @property string $suburb
 * @property string $cp
 * @property string $cityid
 * @property string $validity
 * @property integer $doc
 * @property integer $isblocked
 * @property string $paymentterms
 * @property integer $exclusiveCCA
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Evaluation[] $evaluations
 * @property Rateodc[] $rateodcs
 * @property Rateodp[] $rateodps
 * @property Ratesupplier[] $ratesuppliers
 * @property Service $service
 * @property Supplierservice[] $supplierservices
 */
class Supplier extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Supplier the static model class
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
		return 'supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyid, corporatename, supplierdsc, contactname, website, phone, email, rfc, address, cityid', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('companyid, cityid', 'length', 'max'=>10),
			array('corporatename, supplierdsc, contactname, website, email, email2, email3, email4, email5, address, suburb, cp', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>30),
			array('rfc', 'length', 'max'=>15),
			array('paymentterms', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('supplierid, companyid, corporatename, supplierdsc, contactname, website, phone, email, email2, email3, email4, email5, rfc, address, suburb, cp, cityid, paymentterms, active', 'safe', 'on'=>'search'),
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
			'evaluations' => array(self::HAS_MANY, 'Evaluation', 'supplierid'),
			'rateodcs' => array(self::HAS_MANY, 'Rateodc', 'supplierid'),
			'rateodps' => array(self::HAS_MANY, 'Rateodp', 'supplierid'),
			'ratesuppliers' => array(self::HAS_MANY, 'Ratesupplier', 'supplierid'),
			'supplierservices' => array(self::HAS_MANY, 'Supplierservice', 'supplierid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'supplierid' => 'Provvedor ID',
			'companyid' => 'Compania',
			'corporatename' => 'Nombre Corporativo',
			'supplierdsc' => 'Proveedor',
			'contactname' => 'Nombre del Contacto',
			'website' => 'Sitio Web',
			'phone' => 'Telefono',
			'email' => 'Email',
			'email2' => 'Email 2',
			'email3' => 'Email 3',
			'email4' => 'Email 4',
			'email5' => 'Email 5',
			'rfc' => 'RFC',
			'address' => 'Dirección',
			'suburb' => 'Colonia',
			'cp' => 'CP',
			'cityid' => 'Ciudad',
			'paymentterms' => 'Condiciones de pago',
			'active' => 'Activo',
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

		$criteria->compare('supplierid',$this->supplierid);
		$criteria->compare('companyid',Yii::app()->user->companyid);
		$criteria->compare('corporatename',$this->corporatename,true);
		$criteria->compare('supplierdsc',$this->supplierdsc,true);
		$criteria->compare('contactname',$this->contactname,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('email2',$this->email2,true);
		$criteria->compare('email3',$this->email3,true);
		$criteria->compare('email4',$this->email4,true);
		$criteria->compare('email5',$this->email5,true);
		$criteria->compare('rfc',$this->rfc,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('suburb',$this->suburb,true);
		$criteria->compare('cp',$this->cp,true);
		$criteria->compare('cityid',$this->cityid,true);
		$criteria->compare('paymentterms',$this->paymentterms,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAllSupplier()
	{
		$criteria=new CDbCriteria;
		
		$companyid = Yii::app()->user->companyid;
		$criteria->condition = "t.companyid = {$companyid}";
		$criteria->compare('active',1);
		$criteria->order = 'supplierid desc';	
		
		return $this->findAll($criteria);
	}
        
        public function validar_campo1($lista){
            
            $criteria=new CDbCriteria;
            $cadena=" ";
            foreach ($lista as $valor => $descripcion){
                        if($cadena==" "&&$valor!="block"){
                            $cadena=" t.".$valor." = ".  $descripcion;
                        }else{
                           if($valor!="block"){
                                    $cadena=$cadena." and "." t.".$valor." = ".$descripcion;
                              }
                        }
                    }
            $condition = $cadena;
            return $this->find($condition);
        }
        
        public function validar_campo($lista){
            
        
            $criteria=new CDbCriteria;
            $cadena=" ";
            foreach ($lista as $valor => $descripcion){
                        if($cadena==" " && $valor!="email2" && $valor!="email3" && $valor!="email4" && $valor!="email5" && $valor!="suburb" && $valor!="cp"){
                            $cadena=" t.".$valor." = '".$descripcion."'";
                        }else if($valor!="email2" && $valor!="email3" && $valor!="email4" && $valor!="email5" && $valor!="suburb" && $valor!="cp"){
                            $cadena=$cadena."and"." t.".$valor." = '".$descripcion."'";
                        }
                    }
            $condition = $cadena;
            return $this->find($condition);
        
        }
        
         public function validar_existencia($lista){
            
            $criteria=new CDbCriteria;
            $criteria->select = "t.supplierid";
            $cadena=" ";
            foreach ($lista as $valor => $descripcion){
                        if($cadena==" " && $valor!="block"){
                            $cadena=" t.".$valor." = ".  $descripcion;
                        }else{
                              if($valor!="block"){
                                    $cadena=$cadena." and "." t.".$valor." = ".$descripcion;
                              }
                       }
                    }
            $criteria->condition = $cadena;
            return $this->findAll($criteria);
        }
       
}