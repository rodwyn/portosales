<?php

class Ratetracker extends CActiveRecord {

    public $statusdsc;
    public $customerdsc;
    public $branddsc;
    public $projectdsc;
    public $detalle;
    public $statusdate;
    public $responsable;
    public $servicedsc;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ratetracker the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ratetracker';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('rateid, statusid, userid,statusdate', 'required'),
            array('statusid, userid', 'numerical', 'integerOnly' => true),
            array('rateid', 'length', 'max' => 11),
            array('userid', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ratetrackerid, rateid, statusid, statusdate, userid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'rate' => array(self::BELONGS_TO, 'Rate', 'rateid'),
            'status' => array(self::BELONGS_TO, 'Status', 'statusid'),
            'user' => array(self::BELONGS_TO, 'User', 'userid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ratetrackerid' => 'Ratetrackerid',
            'rateid' => 'Rateid',
            'statusid' => 'Statusid',
            'statusdate' => 'Statusdate',
            'active' => 'Active',
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

        $criteria->compare('ratetrackerid', $this->ratetrackerid, true);
        $criteria->compare('rateid', $this->rateid, true);
        $criteria->compare('statusid', $this->statusid);
        $criteria->compare('statusdate', $this->statusdate, true);
        $criteria->compare('active', $this->active, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function trackerByUser($userid, $start, $end) {
        $criteria = new CDbCriteria;
        $criteria->select = " t.ratetrackerid, st.statusdsc, t.statusid, t.rateid, date(t.statusdate) as statusdate, c.customerdsc, b.branddsc, p.projectdsc  ";
        $criteria->join = "INNER JOIN rate r ON r.rateid = t.rateid
							INNER JOIN project p ON p.projectid = r.projectid
							INNER JOIN brand b ON b.brandid = p.brandid
							INNER JOIN customer c on c.customerid = b.customerid
							INNER JOIN service s ON s.serviceid = r.serviceid
							INNER JOIN service s2 on s2.serviceid = s.serviceparentid
							INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
							INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
							INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
							INNER JOIN userservice  ON userservice.serviceid = s5.serviceid
							INNER JOIN usercustomerpermission ucp ON ucp.customerid = c.customerid
							INNER JOIN status st on st.statusid = t.statusid";
        $criteria->condition = " ucp.userid = {$userid} and userservice.userid = {$userid} and r.active = 1 and  t.userid = {$userid} and t.statusdate between '2014-08-10' and '2014-09-10'";
        return $this->findAll($criteria);
    }

    public function activity($inicio, $fin, $areaid, $userid) {
        $criteria = new CDbCriteria;
        
        $area = ($areaid>0)?' AND u.areaid = '.$areaid:'';
        $user = ($userid>0)?' AND t.userid = '.$userid:'';
        
        $criteria->select = "CONCAT(LPAD(t.rateid,8,0),' - ',se.servicedsc) as detalle,
                                t.rateid,t.statusdate, s.statusdsc,
                                CONCAT(
                                if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
                                if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
                                if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable";
        $criteria->join = "INNER JOIN status s on s.statusid = t.statusid
                                left join employeeuser eu on eu.userid = t.userid
                                left join customeruser cu on cu.userid = t.userid
                                left join supplieruser su on su.userid = t.userid
                                Inner join rate r on r.rateid = t.rateid
                                inner join service se on se.serviceid = r.serviceid 
                                inner join userarea u on u.userid = t.userid";
        $criteria->condition = "t.statusdate between '" . $inicio . "' and '" . $fin . "'".$area.$user;
        $criteria->order = "t.rateid, t.statusdate";

        return $this->findAll($criteria);
    }

    public function activityjson($inicio, $fin) {
        $criteria = new CDbCriteria;

        $criteria->select = "CONCAT(LPAD(t.rateid,8,0),' - ',se.servicedsc) as detalle,
                                t.rateid,t.statusdate, s.statusdsc,
                                CONCAT(
                                if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
                                if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
                                if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable";
        $criteria->join = "INNER JOIN status s on s.statusid = t.statusid
                                left join employeeuser eu on eu.userid = t.userid
                                left join customeruser cu on cu.userid = t.userid
                                left join supplieruser su on su.userid = t.userid
                                Inner join rate r on r.rateid = t.rateid
                                inner join service se on se.serviceid = r.serviceid ";
        $criteria->condition = "t.statusdate between '" . $inicio . "' and '" . $fin . "'";
        $criteria->order = "t.rateid, t.statusdate";

        $results = $this->findAll($criteria);
        $cont = 0;
        if (count($results) > 0) {
            foreach ($results as $row) {
                $output[$cont]['statusdate'] = $row->statusdate;
                $output[$cont]['statusdsc'] = $row->statusdsc;
                $output[$cont]['detalle'] = $row->detalle;
                $output[$cont]['responsable'] = $row->responsable;

                $cont = $cont + 1;
            }
        } else {
            $output = 0;
        }
        $output = array('aaData' => $output);

        return $output;
    }

    /** Actual month last day * */
    public function _data_last_month_day() {
        $month = date('m');
        $year = date('Y');
        $day = date("d", mktime(0, 0, 0, $month + 1, 0, $year));

        return date('Y-m-d H:i:s', mktime(23, 59, 59, $month, $day, $year));
    }

    /** Actual month first day * */
    public function _data_first_month_day() {
        $month = date('m');
        $year = date('Y');
        return date('Y-m-d H:i:s', mktime(0, 0, 0, $month, 1, $year));
    }

    public function activitybyrate($rateid,$tracker) {
        $criteria = new CDbCriteria;
        
        $con = ($tracker==="")?"":" AND t.ratetrackerid IN(".$tracker.") ";
        
        $criteria->select = "t.statusid,t.statusdate, t.ratetrackerid,
            IF(t.ratefilter = 0,s.statusdsc,sp.status_productiondsc) as statusdsc,
                                CONCAT(
                                if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
                                if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
                                if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable";
        $criteria->join = "INNER JOIN status s on s.statusid = t.statusid
                           inner join status_production sp on sp.status_productionid = t.statusid
                                left join employeeuser eu on eu.userid = t.userid
                                left join customeruser cu on cu.userid = t.userid
                                left join supplieruser su on su.userid = t.userid
                                Inner join rate r on r.rateid = t.rateid
                                inner join service se on se.serviceid = r.serviceid ";
        $criteria->condition = "t.rateid =".$rateid.$con;
        $criteria->order = "t.statusdate";

        return $this->findAll($criteria);
    }

}
