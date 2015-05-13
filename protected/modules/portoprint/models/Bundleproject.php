<?php

/**
 * This is the model class for table "bundleproject".
 *
 * The followings are the available columns in table 'bundleproject':
 * @property string $bundleid
 * @property string $projectid
 * @property integer $customerid
 * @property integer $customercontactid
 * @property integer $legalentityid
 * @property integer $userid
 * @property integer $statusid
 * @property string $bundledate
 *
 * The followings are the available model relations:
 * @property Customercontact $customercontact
 * @property Project $project
 * @property Customer $customer
 * @property Status $status
 * @property User $user
 * @property Customerlegalentity $legalentity
 */
class Bundleproject extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Bundleproject the static model class
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
        return 'bundleproject';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('projectid, customerid, customercontactid, legalentityid, userid, statusid, bundledate', 'required'),
            array('customerid, customercontactid, legalentityid, userid, statusid', 'numerical', 'integerOnly'=>true),
            array('projectid', 'length', 'max'=>11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('bundleid, projectid, customerid, customercontactid, legalentityid, userid, statusid, bundledate', 'safe', 'on'=>'search'),
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
            'customercontact' => array(self::BELONGS_TO, 'Customercontact', 'customercontactid'),
            'project' => array(self::BELONGS_TO, 'Project', 'projectid'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customerid'),
            'status' => array(self::BELONGS_TO, 'Status', 'statusid'),
            'user' => array(self::BELONGS_TO, 'User', 'userid'),
            'legalentity' => array(self::BELONGS_TO, 'Customerlegalentity', 'legalentityid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'bundleid' => 'Bundleid',
            'projectid' => 'Projectid',
            'customerid' => 'Customerid',
            'customercontactid' => 'Customercontactid',
            'legalentityid' => 'Legalentityid',
            'userid' => 'Userid',
            'statusid' => 'Statusid',
            'bundledate' => 'Bundledate',
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

        $criteria->compare('bundleid',$this->bundleid,true);
        $criteria->compare('projectid',$this->projectid,true);
        $criteria->compare('customerid',$this->customerid);
        $criteria->compare('customercontactid',$this->customercontactid);
        $criteria->compare('legalentityid',$this->legalentityid);
        $criteria->compare('userid',$this->userid);
        $criteria->compare('statusid',$this->statusid);
        $criteria->compare('bundledate',$this->bundledate,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
  
    
    
} 