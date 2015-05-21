<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property string $menuid
 * @property string $menudsc
 * @property integer $menuparentid
 * @property string $menulink
 * @property integer $menuorder
 * @property integer $active
 * @property integer $level
 * @property string $icon
 *
 * The followings are the available model relations:
 * @property Activity[] $activities
 * @property Profileprivilege[] $profileprivileges
 * @property Userprivilege[] $userprivileges
 */
class Menu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
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
		return 'menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level', 'required'),
			array('menuparentid, menuorder, active, level', 'numerical', 'integerOnly'=>true),
			array('menudsc', 'length', 'max'=>50),
			array('menulink', 'length', 'max'=>255),
			array('icon', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menuid, menudsc, menuparentid, menulink, menuorder, active, level, icon', 'safe', 'on'=>'search'),
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
			'activities' => array(self::HAS_MANY, 'Activity', 'menuid'),
			'profileprivileges' => array(self::HAS_MANY, 'Profileprivilege', 'menuid'),
			'userprivileges' => array(self::HAS_MANY, 'Userprivilege', 'menuid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'menuid' => 'Menuid',
			'menudsc' => 'Menudsc',
			'menuparentid' => 'Menuparentid',
			'menulink' => 'Menulink',
			'menuorder' => 'Menuorder',
			'active' => 'Active',
			'level' => 'Level',
			'icon' => 'Icon',
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

		$criteria->compare('menuid',$this->menuid,true);
		$criteria->compare('menudsc',$this->menudsc,true);
		$criteria->compare('menuparentid',$this->menuparentid);
		$criteria->compare('menulink',$this->menulink,true);
		$criteria->compare('menuorder',$this->menuorder);
		$criteria->compare('active',$this->active);
		$criteria->compare('level',$this->level);
		$criteria->compare('icon',$this->icon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
         public function qryMenu($data,$userid) {
            $criteria=new CDbCriteria;
            $criteria1=new CDbCriteria;
            
            $criteria->select = "t.*";
            $criteria->join = "INNER JOIN usertypemenu up on up.menuid=t.menuid 
                                INNER JOIN user u on up.usertype=u.usertype";
            $criteria->condition = "t.active = 1 AND t.level=0 AND u.userid={$userid} AND u.usertype = {$data}";
            $criteria->order = "t.menuorder ASC";
            
            
            $result= $this->findAll($criteria);
            $ml = 1;
                        $conta=0;
                        $flag=0;
                        $maynus=array();
                        foreach( $result as $row){
                            if($row->level==0){
                              
                               $maynus[0][$row->menudsc] = array(
                                            'url'=> $row->menulink,
                                            'menuid'=> $row->menuid,
                                            'level'=> $conta,
                                            'icon'=>$row->icon,
                                            'ml'=>$ml
                                        );
                               
                            }
                           $ml++; 
                        }
                 
            return $maynus;
            
        }
         public function qrySmenu($data) {
            $criteria=new CDbCriteria;
            
            $criteria->select = "t.*";
             $criteria->join = "INNER JOIN usertypemenu up on up.menuid=t.menuid 
                                INNER JOIN user u on up.usertype=u.usertype";
            $criteria->condition = 't.menuparentid = '.$data['menuparentid'].' AND t.active = 1 AND t.level = 1';
            $criteria->order = "menuorder ASC";
            return $this->findAll($criteria);
        }
        
}