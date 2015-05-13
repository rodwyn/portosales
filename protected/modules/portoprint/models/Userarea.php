<?php

/**
 * This is the model class for table "userarea".
 *
 * The followings are the available columns in table 'userarea':
 * @property integer $userareaid
 * @property integer $userid
 * @property integer $areaid
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Todoarea $area
 */
class Userarea extends CActiveRecord {
    public $responsable;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Userarea the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'userarea';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userid, areaid', 'required'),
            array('userid, areaid', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('userareaid, userid, areaid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'userid'),
            'area' => array(self::BELONGS_TO, 'Todoarea', 'areaid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'userareaid' => 'Userareaid',
            'userid' => 'Userid',
            'areaid' => 'Areaid',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('userareaid', $this->userareaid);
        $criteria->compare('userid', $this->userid);
        $criteria->compare('areaid', $this->areaid);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getResponsable($areaid) {
        $criteria = new CDbCriteria;
        $criteria->select = "t.userid,
                            CONCAT(
                            if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
                            if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
                            if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable";
        $criteria->join = "left join employeeuser eu on eu.userid = t.userid
                          left join customeruser cu on cu.userid = t.userid
                          left join supplieruser su on su.userid = t.userid";
        $criteria->condition ="t.areaid = ".$areaid['areaid'];
        $criteria->order ="responsable";
        return $this->findAll($criteria);
     //return 'areaid'.$areaid;
    }

}
