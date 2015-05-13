<?php

/**
 * This is the model class for table "customercontact".
 *
 * The followings are the available columns in table 'customercontact':
 * @property integer $customerid
 * @property integer $contactid
 * @property string $name
 * @property string $plastname
 * @property string $mlastname
 * @property string $position
 * @property string $phone1
 * @property string $phone2
 * @property string $mobilephone
 * @property string $mail
 * @property string $birthday
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Usercontactpermission[] $usercontactpermissions
 */
class Customercontact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customercontact the static model class
	 */
        public $customerdsc;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customercontact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customerid, name, plastname', 'required'),
			array('customerid, active', 'numerical', 'integerOnly'=>true),
			array('name, plastname, mlastname', 'length', 'max'=>40),
			array('position', 'length', 'max'=>100),
			array('phone1, phone2, mobilephone', 'length', 'max'=>20),
			array('mail', 'length', 'max'=>50),
			array('birthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customerid, contactid, name, plastname, mlastname, position, phone1, phone2, mobilephone, mail, birthday, active', 'safe', 'on'=>'search'),
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
			'customer' => array(self::BELONGS_TO, 'Customer', 'customerid'),
			'usercontactpermissions' => array(self::HAS_MANY, 'Usercontactpermission', 'contactid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customerid' => 'Customerid',
			'contactid' => 'Contactid',
			'name' => 'Name',
			'plastname' => 'Plastname',
			'mlastname' => 'Mlastname',
			'position' => 'Position',
			'phone1' => 'Phone1',
			'phone2' => 'Phone2',
			'mobilephone' => 'Mobilephone',
			'mail' => 'Mail',
			'birthday' => 'Birthday',
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

		$criteria->compare('customerid',$this->customerid);
		$criteria->compare('contactid',$this->contactid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('plastname',$this->plastname,true);
		$criteria->compare('mlastname',$this->mlastname,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('phone1',$this->phone1,true);
		$criteria->compare('phone2',$this->phone2,true);
		$criteria->compare('mobilephone',$this->mobilephone,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCompleteName($customerid)
	{
		$criteria = new CDbCriteria;

		$criteria->select = " contactid, concat(name, ' ', plastname) as name  ";
		$criteria->condition = " t.customerid = {$customerid} ";
		return $this->findAll($criteria);
	}
        
        public function getAllcontact()
	{
		$criteria=new CDbCriteria;
		
                $criteria->select="t.contactid, c.customerdsc, t.name, t.plastname, t.mlastname, t.position, t.phone1, t.phone2, t.mobilephone, t.mail";
                $criteria->join="inner join customer c on c.customerid=t.customerid";
                $criteria->condition = 't.active=1 and c.companyid = '. Yii::app()->user->companyid;
                
		//$criteria->group = 'bundleid';	
		
		
		return $this->findAll($criteria);
	}
        
         public function getIdcontact($customerid){
             
                $criteria=new CDbCriteria;
		
                $criteria->select="t.contactid, c.customerdsc, t.name, t.plastname, t.mlastname, t.position, t.phone1, t.phone2, t.mobilephone, t.mail";
                $criteria->join="inner join customer c on c.customerid=t.customerid";
                $criteria->condition = 't.active=1 and t.customerid='.$customerid.' and c.companyid = '. Yii::app()->user->companyid;
		//$criteria->group = 'bundleid';	
		
		
		return $this->findAll($criteria);
         }
        
         public function validar_campo($lista){
            
            $criteria=new CDbCriteria;
            $cadena=" ";
            foreach ($lista as $valor => $descripcion){
                        if($cadena==" " && $valor!="position" && $valor!="phone1" && $valor!="phone2" && $valor!="mobilphone"){
                            $cadena=" t.".$valor." = '".$descripcion."'";
                        }else if($valor!="position" && $valor!="phone1" && $valor!="phone2" && $valor!="mobilphone"){
                            $cadena=$cadena."and"." t.".$valor." = '".$descripcion."'";
                        }
                    }
            $condition = $cadena;
            return $this->find($condition);
        }
	
}