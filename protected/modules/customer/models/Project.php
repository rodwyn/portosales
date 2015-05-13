<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property string $projectid
 * @property string $brandid
 * @property string $projectdsc
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Brand $brand
 * @property Rate[] $rates
 */
class Project extends CActiveRecord
{
	public $customerid;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
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
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brandid, projectdsc', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('brandid', 'length', 'max'=>11),
			array('projectdsc', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('projectid, brandid, projectdsc, active', 'safe', 'on'=>'search'),
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
			'brand' => array(self::BELONGS_TO, 'Brand', 'brandid'),
			'rates' => array(self::HAS_MANY, 'Rate', 'projectid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'projectid' => 'Projectid',
			'brandid' => 'Brandid',
			'projectdsc' => 'Projectdsc',
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

		$criteria->compare('projectid',$this->projectid,true);
		$criteria->compare('brandid',$this->brandid,true);
		$criteria->compare('projectdsc',$this->projectdsc,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function modelByUser($id,$userid)
	{
		$criteria = new CDbCriteria;
		$criteria->select = " t.*, b.customerid ";
		$criteria->join = "INNER JOIN brand b ON b.brandid = t.brandid 
							INNER JOIN usercustomerpermission ucp ON ucp.customerid = b.customerid";
		$criteria->condition = " t.projectid = {$id} AND ucp.userid = {$userid} and ucp.active = 1";
		return $this->find($criteria);
		
	}
}