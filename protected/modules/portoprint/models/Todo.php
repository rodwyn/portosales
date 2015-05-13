<?php

/**
 * This is the model class for table "todo".
 *
 * The followings are the available columns in table 'todo':
 * @property integer $todoid
 * @property integer $parentid
 * @property integer $areaid
 * @property integer $userid
 * @property integer $rateid
 * @property integer $statusid
 * @property integer $usertype
 * @property string $tododsc
 * @property string $todotype
 * @property string $priority
 * @property string $doit
 * @property string $notes
 * @property string $startdate
 * @property string $enddate
 * @property string $realstartdate;
 * @property string $realenddate
 * @property string $percent
 * @property integer $usercreate
 *
 * The followings are the available model relations:
 * @property Todoarea $area
 * @property User $user
 * @property Todocomment[] $todocomments
 * @property Todohist[] $todohists
 */
class Todo extends CActiveRecord {
    public $area;
    public $areadsc;
    public $responsable;
    public $prioridad;
    public $pbaja;
    public $pmedia;
    public $palta;
    public $ebaja;
    public $emedia;
    public $ealta;
    public $tbaja;
    public $tmedia;
    public $talta;
    public $porcentaje;
    

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Todo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'todo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parentid, areaid, userid, rateid, statusid, usertype, tododsc, todotype, startdate, enddate', 'required'),
            array('parentid, areaid, userid, rateid, statusid, usertype, usercreate', 'numerical', 'integerOnly' => true),
            array('tododsc', 'length', 'max' => 45),
            array('todotype, priority, doit', 'length', 'max' => 1),
            array('notes', 'length', 'max' => 256),
            array('percent', 'length', 'max' => 5),
            array('realstartdate, realenddate', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('todoid, parentid, areaid, userid, rateid, statusid, usertype, tododsc, todotype, priority, doit, notes, startdate, enddate, realstartdate, realenddate, percent, usercreate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'area' => array(self::BELONGS_TO, 'Todoarea', 'areaid'),
            'user' => array(self::BELONGS_TO, 'User', 'userid'),
            'todocomments' => array(self::HAS_MANY, 'Todocomment', 'todoid'),
            'todohists' => array(self::HAS_MANY, 'Todohist', 'todoid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'todoid' => 'Todoid',
            'parentid' => 'Parentid',
            'areaid' => 'Areaid',
            'userid' => 'Userid',
            'rateid' => 'Rateid',
            'statusid' => 'Statusid',
            'usertype' => 'Usertype',
            'tododsc' => 'Tododsc',
            'todotype' => 'Todotype',
            'priority' => 'Priority',
            'doit' => 'Doit',
            'notes' => 'Notes',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'realstartdate' => 'Realstartdate',
            'realenddate' => 'Realenddate',
            'percent' => 'Percent',
            'usercreate' => 'Usercreate',
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

        $criteria->compare('todoid', $this->todoid);
        $criteria->compare('parentid', $this->parentid);
        $criteria->compare('areaid', $this->areaid);
        $criteria->compare('userid', $this->userid);
        $criteria->compare('rateid', $this->rateid);
        $criteria->compare('statusid', $this->statusid);
        $criteria->compare('usertype', $this->usertype);
        $criteria->compare('tododsc', $this->tododsc, true);
        $criteria->compare('todotype', $this->todotype, true);
        $criteria->compare('priority', $this->priority, true);
        $criteria->compare('doit', $this->doit, true);
        $criteria->compare('notes', $this->notes, true);
        $criteria->compare('startdate', $this->startdate, true);
        $criteria->compare('enddate', $this->enddate, true);
        $criteria->compare('realstartdate', $this->realstartdate, true);
        $criteria->compare('realenddate', $this->realenddate, true);
        $criteria->compare('percent', $this->percent, true);
        $criteria->compare('usercreate', $this->usercreate);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getOgsm() {
        $criteria = new CDbCriteria;

        $criteria->select = "t.todoid, t.tododsc, a.areadsc,
                            CONCAT(
                            if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
                            if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
                            if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable,
                            t.notes, t.startdate, t.enddate,
                            IFNULL((select (TRUNCATE(sum(IF(doit = '1',1,0))*100/count(todoid),0)) from todo where parentid=t.todoid),0) as porcentaje";
        $criteria->join = "INNER JOIN todoarea a on a.areaid = t.areaid
                            left join employeeuser eu on eu.userid = t.userid
                            left join customeruser cu on cu.userid = t.userid
                            left join supplieruser su on su.userid = t.userid";
        $criteria->condition = "t.parentid = 0 AND t.todotype='O'";

        return $this->findAll($criteria);
    }

    public function getTodos($todoid) {
        $criteria = new CDbCriteria();

        $criteria->select = "t.todoid,
            CASE t.priority
            WHEN '1' THEN 'Baja'
            WHEN '2' THEN 'Media'
            WHEN '3' THEN 'Alta'
            END AS prioridad,
            t.tododsc,
            CONCAT(
            if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
            if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
            if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable,
            t.startdate, t.enddate, t.percent, a.areadsc";
        $criteria->join = "inner join todoarea a on a.areaid = t.areaid
            left join employeeuser eu on eu.userid = t.userid
            left join customeruser cu on cu.userid = t.userid
            left join supplieruser su on su.userid = t.userid";
        $criteria->condition = "t.parentid = " . $todoid;

        return $this->findAll($criteria);
    }

    public function tabla($todoid) {
        $criteria = new CDbCriteria();

        $criteria->select = "sum(IF(t.priority = '1' AND  t.statusid = 1,1,0)) as pbaja,
        sum(IF(t.priority = '2' AND  t.statusid = 1,1,0)) as pmedia,
        sum(IF(t.priority = '3' AND  t.statusid = 1,1,0)) as palta,

        sum(IF(t.priority = '1' AND  t.statusid = 2,1,0)) as ebaja,
        sum(IF(t.priority = '2' AND  t.statusid = 2,1,0)) as emedia,
        sum(IF(t.priority = '3' AND  t.statusid = 2,1,0)) as ealta,

        sum(IF(t.priority = '1' AND  t.statusid = 3,1,0)) as tbaja,
        sum(IF(t.priority = '2' AND  t.statusid = 3,1,0)) as tmedia,
        sum(IF(t.priority = '3' AND  t.statusid = 3,1,0)) as talta";

        $criteria->condition = "t.parentid = " . $todoid;

        return $this->findAll($criteria);
    }
    
    public function percent($todotype,$userid) {
        $criteria = new CDbCriteria();
        
        $criteria->select = "TRUNCATE(sum(IF(t.doit = '1',1,0))*100/count(t.todoid),0) as porcentaje";
        $criteria->condition = "todotype= '".$todotype."' AND userid = " . $userid;

        return $this->findAll($criteria);
    }
    
    public function mytodos($userid) {
        $criteria = new CDbCriteria();

        $criteria->select = "t.todoid,
        t.tododsc,
        a.areadsc,
        IFNULL(a.areadsc,IFNULL(s.servicedsc,'Personal')) as area,
        ROUND(t.percent,0) as porcentaje,
        t.priority,
        CASE t.priority
            WHEN '1' THEN 'Baja'
                WHEN '2' THEN 'Media'
                WHEN '3' THEN 'Alta'
        END AS prioridad,
        t.statusid,
        t.todotype,
        t.notes,
        t.startdate, t.enddate";
        
        $criteria->join = "left join todoarea a on a.areaid = t.areaid "
                . "LEFT JOIN rate r on r.rateid = t.rateid "
                . "LEFT JOIN service s on s.serviceid = r.serviceid ";
        
        $criteria->condition = "t.statusid != 0 AND t.userid = " . $userid;

        return $this->findAll($criteria);
    }

}
