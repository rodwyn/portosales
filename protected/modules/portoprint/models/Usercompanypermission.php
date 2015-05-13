<?php

/**
 * This is the model class for table "usercompanypermission".
 *
 * The followings are the available columns in table 'usercompanypermission':
 * @property string $usercompanypermissionid
 * @property integer $companyid
 * @property integer $userid
 * @property integer $systemid
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Company $company
 */
class Usercompanypermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usercompanypermission the static model class
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
		return 'usercompanypermission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyid, userid, systemid', 'required'),
			array('companyid, userid, systemid, active', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('usercompanypermissionid, companyid, userid, systemid, active', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userid'),
			'company' => array(self::BELONGS_TO, 'Company', 'companyid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usercompanypermissionid' => 'Usercompanypermissionid',
			'companyid' => 'Companyid',
			'userid' => 'Userid',
			'systemid' => 'Systemid',
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

		$criteria->compare('usercompanypermissionid',$this->usercompanypermissionid,true);
		$criteria->compare('companyid',$this->companyid);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('systemid',$this->systemid);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function validar_campo1($lista){
            
            $criteria=new CDbCriteria;
            $cadena=" ";
            foreach ($lista as $valor => $descripcion){
                        if($cadena==" "){
                            $cadena=" t.".$valor." = ".  Utils::decrypt($descripcion, 'user');
                        }else{
                            $cadena=$cadena." and"." t.".$valor." = ".Utils::decrypt($descripcion, 'user');
                        }
                    }
            $condition = $cadena;
            return $this->find($condition);
        }
        
       public function validar_existencia($lista){
            
            $criteria=new CDbCriteria;
            $criteria->select = "t.usercompanypermissionid";
            $cadena=" ";
            foreach ($lista as $valor => $descripcion){
                        if($cadena==" "){
                            $cadena=" t.".$valor." = ".  Utils::decrypt($descripcion, 'user');
                        }else{
                            $cadena=$cadena." and "." t.".$valor." = ".Utils::decrypt($descripcion, 'user');
                        }
                    }
            $criteria->condition = $cadena;
            return $this->findAll($criteria);
        }
        
       public function getCompanyUser($company,$user){

		$criteria = new CDbCriteria ;
		$criteria->select = "t.usercompanypermissionid, t.active";
		$criteria->condition = " t.userid={$user} and t.companyid={$company}";
		return $this->findAll($criteria);
	}
        
}