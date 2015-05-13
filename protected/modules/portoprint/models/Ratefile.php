<?php

/**
 * This is the model class for table "ratefile".
 *
 * The followings are the available columns in table 'ratefile':
 * @property integer $ratefileid
 * @property integer $rateid
 * @property string $name
 */
class Ratefile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratefile the static model class
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
		return 'ratefile';
	}
        public $dateupload;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid', 'required'),
			array('rateid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ratefileid, rateid, name', 'safe', 'on'=>'search'),
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
			'ratefileid' => 'Ratefileid',
			'rateid' => 'Rateid',
			'name' => 'Name',
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

		$criteria->compare('ratefileid',$this->ratefileid);
		$criteria->compare('rateid',$this->rateid);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function recoverFile($id){

		$criteria=new CDbCriteria;
		$criteria->select="t.rateid, t.name, t.path, t.dateupload";
		$criteria->condition = "t.rateid = {$id}";
		$criteria->order = 'ratefileid desc';	
		
		return $this->findAll($criteria);
	}

	public function processFile($id,$rate){
		$storeFolder = Yii::app()->params->imageUpload; 
                $targetPath = $storeFolder.$id.'/'.$rate.'/';
		$result = array('success'=>false);
				
		if(!file_exists($targetPath)){
                    chmod("/var/www/*", 0777);
			if(!mkdir($targetPath,0777,true)){
				return $result;
                                
			}
                }

		if (!empty($_FILES)) {
		    $tempFile = $_FILES['file']['tmp_name'];
		    $targetFile =  $targetPath.'/'. $_FILES['file']['name'];
		    if(move_uploaded_file($tempFile,$targetFile)){
		    	$result['success'] = true;
		    	$result['name'] = $_FILES['file']['name'];
		    	$result['path'] = 'imageUpload/'.$id.'/'.$rate.'/'.$_FILES['file']['name'];
		    }
		}
	    return $result;
	}
        
        public function processFile_pdf($id,$rate){
		$storeFolder = Yii::app()->params->imageUpload; 
                $targetPath = "/srv".$storeFolder.$id.'/';
		$result = array('success'=>false);
				
		if(!file_exists($targetPath)){
                    chmod("/srv".$storeFolder, 0777);
			if(!mkdir($targetPath,0777,true)){
				return $result;
                                
			}
                }

		/*if (!empty($_FILES)) {
		    $tempFile = $rate;
		    $targetFile =  $targetPath.'/'. $rate;
		    if(move_uploaded_file($tempFile,$targetFile)){
		    	$result['success'] = true;
		    	$result['name'] = $_FILES['file']['name'];
		    	$result['path'] = "srv/www/imageUpload/".$id.'/'.$rate.'/'.$_FILES['file']['name'];
		    }
		}*/
	    return $result;
	}
        
     
        
}