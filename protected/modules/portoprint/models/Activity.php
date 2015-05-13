<?php

/**
 * This is the model class for table "activity".
 *
 * The followings are the available columns in table 'activity':
 * @property string $activityid
 * @property integer $userid
 * @property string $menuid
 * @property string $activity
 * @property string $activitydate
 *
 * The followings are the available model relations:
 * @property Menu $menu
 * @property User $user
 */
class Activity extends CActiveRecord {
    public $actividad;
    public $responsable;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Activity the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'activity';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userid, menuid, activity, activitydate', 'required'),
            array('userid', 'numerical', 'integerOnly' => true),
            array('menuid', 'length', 'max' => 10),
            array('activity', 'length', 'max' => 140),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('activityid, userid, menuid, activity, activitydate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'menu' => array(self::BELONGS_TO, 'Menu', 'menuid'),
            'user' => array(self::BELONGS_TO, 'User', 'userid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'activityid' => 'Activityid',
            'userid' => 'Userid',
            'menuid' => 'Menuid',
            'activity' => 'Activity',
            'activitydate' => 'Activitydate',
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

        $criteria->compare('activityid', $this->activityid, true);
        $criteria->compare('userid', $this->userid);
        $criteria->compare('menuid', $this->menuid, true);
        $criteria->compare('activity', $this->activity, true);
        $criteria->compare('activitydate', $this->activitydate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function get_activity($inicio, $fin, $areaid, $userid) {
        $criteria = new CDbCriteria;

        $area = ($areaid > 0) ? ' AND u.areaid = ' . $areaid : '';
        $user = ($userid > 0) ? ' AND t.userid = ' . $userid : '';

        $criteria->select = "t.activitydate, CONCAT(t.activity,IF(t.menuid>0 AND t.type = 'N',CONCAT(' al modulo ',m.menudsc),
                            CONCAT(' - ',
                            CASE t.type 
                                  WHEN 'T' THEN (SELECT tododsc from todo where todoid = t.id)
                                  WHEN 'C' THEN (SELECT companydsc from company where companyid = t.id)
                                  WHEN 'S' THEN (SELECT IFNULL(servicedsc,'Elimino servicio') from service where serviceid = t.id)
                                      WHEN 'M' THEN (SELECT customerdsc from customer where customerid = t.id)
                                      WHEN 'B' THEN (SELECT branddsc from brand where brandid = t.id)
                                      WHEN 'L' THEN (SELECT legalentity from customerlegalentity where customerlegalentityid = t.id)
                                      WHEN 'K' THEN (SELECT concat(name,' ',plastname) as contact  from customercontact where contactid = t.id)
                                  WHEN 'W' THEN (SELECT name  from warehouse where warehouseid = t.id)
                                      WHEN 'D' THEN (SELECT designagencydsc  from designagency where designagencyid = t.id)
                                      WHEN 'U' THEN (SELECT username  from user where userid = t.id)
                                  END
                            ))) as actividad,
                            CONCAT(
                            if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
                            if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
                            if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable";
        $criteria->join = "INNER JOIN menu m on m.menuid=t.menuid
                            left join employeeuser eu on eu.userid = t.userid
                            left join customeruser cu on cu.userid = t.userid
                            left join supplieruser su on su.userid = t.userid
                            inner join userarea u on u.userid = t.userid";
        $criteria->condition = "t.activitydate between '" . $inicio . "' and '" . $fin . "'" . $area . $user;
        //$criteria->order = "t.rateid, t.statusdate";

        return $this->findAll($criteria);
    }

}
