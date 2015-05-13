<?php

/**
 * This is the model class for table "hist_production".
 *
 * The followings are the available columns in table 'hist_production':
 * @property integer $hist_productionid
 * @property integer $rateid
 * @property string $type
 * @property integer $status_productionid
 */
class HistProduction extends CActiveRecord
{
    
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HistProduction the static model class
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
		return 'hist_production';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hist_productionid', 'required'),
			array('hist_productionid, rateid, status_productionid', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('hist_productionid, rateid, type, status_productionid', 'safe', 'on'=>'search'),
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
			'hist_productionid' => 'Hist Productionid',
			'rateid' => 'Rateid',
			'type' => 'Type',
			'status_productionid' => 'Status Productionid',
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

		$criteria->compare('hist_productionid',$this->hist_productionid);
		$criteria->compare('rateid',$this->rateid);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status_productionid',$this->status_productionid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function gethistprod($rateid,$type) {
        $criteria = new CDbCriteria;
        
        $criteria->select = "t.status_productionid";
     
        $criteria->condition ="t.rateid = ".$rateid." and t.type = ".$type;
         $criteria->order = 't.hist_productionid desc';
           $criteria->limit = '1';
        $result = $this->findAll($criteria);
         if(count($result)!=0){
            foreach ($result as $row) {
                $servicedsc = $row->status_productionid;
            }
        }else{
            $servicedsc ='0';
        }
        return $servicedsc;
    }
     public function gethistprod_1($rateid) {
        $criteria = new CDbCriteria;
        
        $criteria->select = "t.hist_productionid";
     
        $criteria->condition ="t.rateid = ".$rateid;
         $criteria->order = 't.hist_productionid desc';
           $criteria->limit = '1';
        $result = $this->findAll($criteria);
        
        foreach ($result as $row) {
            $servicedsc = $row->status_productionid;
        }
        return $servicedsc;
    }
    
    public function gethistprod_all($rateid,$type) {
        $criteria = new CDbCriteria;
        
        $criteria->select = "t.*";
     
        $criteria->condition ="t.rateid = ".$rateid." and t.type = ".$type;
         $criteria->order = 't.hist_productionid';
           
        return $result = $this->findAll($criteria);
        
    }
}