<?php

/**
 * This is the model class for table "todoarea".
 *
 * The followings are the available columns in table 'todoarea':
 * @property integer $areaid
 * @property string $areadsc
 * @property integer $userid
 *
 * The followings are the available model relations:
 * @property Todo[] $todos
 * @property User $user
 */
class Todoarea extends CActiveRecord {
    public $responsable;
    public $areaid;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Todoarea the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'todoarea';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('areadsc, userid', 'required'),
            array('userid', 'numerical', 'integerOnly' => true),
            array('areadsc', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('areaid, areadsc, userid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'todos' => array(self::HAS_MANY, 'Todo', 'areaid'),
            'user' => array(self::BELONGS_TO, 'User', 'userid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'areaid' => 'Areaid',
            'areadsc' => 'Areadsc',
            'userid' => 'Userid',
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

        $criteria->compare('areaid', $this->areaid);
        $criteria->compare('areadsc', $this->areadsc, true);
        $criteria->compare('userid', $this->userid);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getResponsable() {
        $criteria = new CDbCriteria;
        $criteria->select = "t.userid,
                            CONCAT(
                            if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
                            if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
                            if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable";
        $criteria->join = "left join employeeuser eu on eu.userid = t.userid
                          left join customeruser cu on cu.userid = t.userid
                          left join supplieruser su on su.userid = t.userid";
        return $this->findAll($criteria);
    }
}
