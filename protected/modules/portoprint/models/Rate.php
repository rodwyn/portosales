<?php

/**
 * This is the model class for table "rate".
 *
 * The followings are the available columns in table 'rate':
 * @property string $rateid
 * @property integer $parentrateid
 * @property integer $version
 * @property string $projectid
 * @property string $serviceid
 * @property integer $userid
 * @property integer $statusid
 * @property string $statustime
 * @property string $warehouseid
 * @property string $designagencyid
 * @property integer $customercontactid
 * @property integer $legalentityid
 * @property string $ratedate
 * @property string $expiration
 * @property string $note
 * @property string $ratetype
 * @property string $image
 * @property integer $quantity_1
 * @property integer $quantity_2
 * @property integer $quantity_3
 * @property integer $quantity_4
 * @property integer $quantity_5
 * @property integer $quantity_6
 * @property string $odptime
 * @property string $odctime
 * @property integer $quantityselect
 * @property double $ppp_1
 * @property double $ppp_2
 * @property double $ppp_3
 * @property double $ppp_4
 * @property double $ppp_5
 * @property double $ppp_6
 * @property double $pprice
 * @property double $saving
 * @property integer $iva
 * @property string $currency
 * @property string $duration
 * @property integer $send
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Evaluation[] $evaluations
 * @property Project $project
 * @property Customerlegalentity $legalentity
 * @property Service $service
 * @property Status $status
 * @property User $user
 * @property Rateart[] $ratearts
 * @property Ratechangeart[] $ratechangearts
 * @property Ratecolortest[] $ratecolortests
 * @property Ratedistribution[] $ratedistributions
 * @property Rateitemdetailvalue[] $rateitemdetailvalues
 * @property Rateodc[] $rateodcs
 * @property Rateodp[] $rateodps
 * @property Rateportoprintinvoice[] $rateportoprintinvoices
 * @property Rateproduction[] $rateproductions
 * @property Rateservicedetail[] $rateservicedetails
 * @property Ratesupplier[] $ratesuppliers
 * @property Ratesupplierinvoice[] $ratesupplierinvoices
 * @property Ratewarehouse[] $ratewarehouses
 * @property Ratezerotest[] $ratezerotests
 */
class Rate extends CActiveRecord {

    public $lrateid;
    public $companyid;
    public $customerid;
    public $customerlegalid;
    public $brandid;
    public $branddsc;
    public $projectdsc;
    public $servicedsc;
    public $userdsc;
    public $customerdsc;
    public $statusdsc;
    public $firstname;
    public $extraitems;
    public $whname;
    public $designagencydsc;
    public $name;
    public $legalentity;
    public $street;
    public $number;
    public $neighborhood;
    public $citydsc;
    public $statedsc;
    public $zipcode;
    public $phone1;
    public $entry;
    public $finalize;
    public $rateodpid;
    public $resto;
    public $supplierid;
    public $proveedor;
    public $usuario;
    public $areaid;
    public $ratebidsheet;
    

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Rate the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rate';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('projectid, serviceid, bundleid, ratetype, expiration, iva, userid, statusid, statustime, warehouseid, designagencyid, customerid, brandid, customercontactid, legalentityid, duration', 'required'),
            array('parentrateid, version, userid, bundleid, statusid, customercontactid, legalentityid, quantity_1, quantity_2, quantity_3, quantity_4, quantity_5, quantity_6, quantityselect, iva, send, active', 'numerical', 'integerOnly' => true),
            array('ppp_1, ppp_2, ppp_3, ppp_4, ppp_5, ppp_6, pprice, saving', 'numerical'),
            array('projectid', 'length', 'max' => 11),
            array('serviceid, warehouseid, designagencyid, currency', 'length', 'max' => 10),
            array('ratetype', 'length', 'max' => 20),
            array('image', 'length', 'max' => 100),
            array('ratedate, expiration, note, odptime, odctime', 'safe'),
            // The following rule is used by search().
// Please remove those attributes that should not be searched.
            array('rateid', 'safe', 'on' => 'dash'),
            array('rateid, parentrateid, version, projectid, customerid, projectdsc, customerdsc, branddsc, servicedsc, s5.serviceid, ucp.userid, entry, userdsc, firstname, statusdsc, serviceid, userid, statusid, statustime, warehouseid, designagencyid, customercontactid, legalentityid, ratedate, expiration, note, ratetype, image, quantity_1, quantity_2, quantity_3, quantity_4, quantity_5, quantity_6, odptime, odctime, quantityselect, ppp_1, ppp_2, ppp_3, ppp_4, ppp_5, ppp_6, pprice, saving, iva, currency, duration, send, active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array(
            'evaluations' => array(self::HAS_MANY, 'Evaluation', 'rateid'),
            'project' => array(self::BELONGS_TO, 'Project', 'projectid'),
            'legalentity' => array(self::BELONGS_TO, 'Customerlegalentity', 'legalentityid'),
            'entry' => array(self::BELONGS_TO, 'Service', 'entryid'),
            'service' => array(self::BELONGS_TO, 'Service', 'serviceid'),
            'status' => array(self::BELONGS_TO, 'Status', 'statusid'),
            'user' => array(self::BELONGS_TO, 'User', 'userid'),
            'ratearts' => array(self::HAS_MANY, 'Rateart', 'rateid'),
            'ratechangearts' => array(self::HAS_MANY, 'Ratechangeart', 'rateid'),
            'ratecolortests' => array(self::HAS_MANY, 'Ratecolortest', 'rateid'),
            'ratedistributions' => array(self::HAS_MANY, 'Ratedistribution', 'rateid'),
            'rateitemdetailvalues' => array(self::HAS_MANY, 'Rateitemdetailvalue', 'rateid'),
            'rateodcs' => array(self::HAS_MANY, 'Rateodc', 'rateid'),
            'rateodps' => array(self::HAS_MANY, 'Rateodp', 'rateid'),
            'rateportoprintinvoices' => array(self::HAS_MANY, 'Rateportoprintinvoice', 'rateid'),
            'rateproductions' => array(self::HAS_MANY, 'Rateproduction', 'rateid'),
            'rateservicedetails' => array(self::HAS_MANY, 'Rateservicedetail', 'rateid'),
            'ratesuppliers' => array(self::HAS_MANY, 'Ratesupplier', 'rateid'),
            'ratesupplierinvoices' => array(self::HAS_MANY, 'Ratesupplierinvoice', 'rateid'),
            'ratewarehouses' => array(self::HAS_MANY, 'Ratewarehouse', 'rateid'),
            'ratezerotests' => array(self::HAS_MANY, 'Ratezerotest', 'rateid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'rateid' => 'Cotización Item ID',
            'bundleid' => 'Cotización ID',
            'parentrateid' => 'Parentrateid',
            'version' => 'Versión',
            'projectid' => 'Proyecto',
            'entryid' => 'Categoria',
            'serviceid' => 'Item',
            'userid' => 'Userid',
            'statusid' => 'Statusid',
            'statustime' => 'Statustime',
            'warehouseid' => 'Bodega',
            'whname' => 'Bodega',
            'designagencyid' => 'Agencia de Diseño',
            'designagencydsc' => 'Agencia de Diseño',
            'customercontactid' => 'Contacto comercial',
            'name' => 'Contacto comercial',
            'legalentityid' => 'Razón social',
            'legalentity' => 'Razón social',
            'ratedate' => 'Fecha',
            'expiration' => 'Fecha de Entrega',
            'note' => 'Note',
            'ratetype' => 'Tipo de cotización',
            'image' => 'Image',
            'quantity_1' => 'Cantidad 1',
            'quantity_2' => 'Cantidad 2',
            'quantity_3' => 'Cantidad 3',
            'quantity_4' => 'Cantidad 4',
            'quantity_5' => 'Cantidad 5',
            'quantity_6' => 'Cantidad 6',
            'odptime' => 'Odptime',
            'odctime' => 'Odctime',
            'quantityselect' => 'Cantidad Seleccionada',
            'ppp_1' => 'Ppp 1',
            'ppp_2' => 'Ppp 2',
            'ppp_3' => 'Ppp 3',
            'ppp_4' => 'Ppp 4',
            'ppp_5' => 'Ppp 5',
            'ppp_6' => 'Ppp 6',
            'pprice' => 'Pprice',
            'saving' => 'Saving',
            'iva' => 'IVA',
            'currency' => 'Moneda',
            'duration' => 'Duración',
            'send' => 'Send',
            'active' => 'Active',
            'companyid' => 'Compania',
            'customerid' => 'Cliente',
            'brandid' => 'Marca',
            'customerlegalid' => 'Razon Social',
            'customerdsc' => 'Cliente',
            'branddsc' => 'Marca',
            'projectdsc' => 'Proyecto',
            'servicedsc' => 'Item',
            'userdsc' => 'Comprador',
            'statusdsc' => 'Estatus',
            'extraitems' => 'Items adicionales',
            'firstname' => 'Ejecutivo',
            'entry' => 'Rubro'
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

        $criteria->select = "LPAD(t.rateid,8,0) as rateid, LPAD(bundleid,8,0) as bundleid, DATE(t.ratedate) as ratedate,  LPAD(parentrateid,8,0) as parentrateid, version, customer.customerdsc as customerdsc, brand.branddsc as branddsc, project.projectdsc as projectdsc, service.servicedsc as servicedsc, s5.servicedsc as entry, concat(employeeuser.firstname, ' ', employeeuser.plastname ) as firstname, t.note, status.statusdsc as statusdsc";
        $criteria->join = "INNER JOIN project ON project.projectid = t.projectid
						   INNER JOIN brand ON brand.brandid = project.brandid
						   INNER JOIN service ON service.serviceid = t.serviceid
						   INNER JOIN employeeuser ON employeeuser.userid = t.userid 
						   INNER JOIN status ON status.statusid = t.statusid
						   INNER JOIN customer on customer.customerid = brand.customerid
						   INNER JOIN service s on s.serviceid = t.serviceid
						   INNER JOIN service s2 on s2.serviceid = s.serviceparentid
						   INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
						   INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
						   INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
						   INNER JOIN userservice  ON userservice.serviceid = s5.serviceid
						   INNER JOIN usercustomerpermission ucp ON ucp.customerid = customer.customerid   ";

        $criteria->compare('rateid', $this->rateid);
        $criteria->compare('bundleid', $this->bundleid);
        $criteria->compare('ratedate', $this->ratedate, true);
        $criteria->compare('customerdsc', $this->customerdsc, true);
        $criteria->compare('projectdsc', $this->projectdsc, true);
        $criteria->compare('branddsc', $this->branddsc, true);
        $criteria->compare('servicedsc', $this->servicedsc, true);
        $criteria->compare('s5.serviceid', $this->entry, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('statusdsc', $this->statusdsc, true);
        $criteria->compare('customer.companyid', Yii::app()->user->companyid);
        $criteria->compare('customer.customerid', $this->customerid);
        $criteria->compare('userservice.userid', Yii::app()->user->userid);
        $criteria->compare('ucp.userid', Yii::app()->user->userid);
        $criteria->compare('t.active', 1);
        $criteria->addCondition("t.statusid != 35");
        $criteria->order = "t.bundleid desc, t.parentrateid asc";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchDash() {
// Warning: Please modify the following code to remove attributes that
// should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = " rateid desc ";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function modelByUser($rateid, $userid) {
        $criteria = new CDbCriteria;
        $criteria->select = " LPAD(t.rateid,8,0) as rateid, LPAD(t.bundleid,8,0) as bundleid, t.entryid, t.warehouseid, t.designagencyid, c.customerid, b.brandid, t.customercontactid, t.legalentityid, t.serviceid,  s.servicedsc, t.statusid, st.statusdsc, " .
                "LPAD(t.parentrateid,8,0) as parentrateid, t.version, t.projectid, p.projectdsc, c.customerdsc, b.branddsc, s.servicedsc, concat(eu.firstname, ' ', eu.plastname ) as firstname, " .
                "t.statustime, wh.name as whname, da.designagencydsc, concat(cc.name,' ', cc.plastname) as name, t.ratedate, t.expiration, t.note, t.ratetype, t.image, " .
                "t.quantity_1, t.quantity_2, t.quantity_3, t.quantity_4, t.quantity_5, t.quantity_6, t.odptime, t.odctime, t.quantityselect, t.ppp_1, t.ppp_2, t.ppp_3, " .
                "t.ppp_4, t.ppp_5, t.ppp_6, t.pprice, t.saving, t.iva, t.currency, t.duration, t.send, cle.legalentity, cle.street, cle.number, cle.neighborhood, cy.citydsc, cy.cityid, sta.statedsc, cle.zipcode, cc.phone1, t.userid, ADDTIME(statustime,duration) as finalize";
        $criteria->join = "INNER JOIN project p ON p.projectid = t.projectid
						   INNER JOIN employeeuser eu on eu.userid = t.userid
						   INNER JOIN warehouse wh on wh.warehouseid = t.warehouseid
						   INNER JOIN designagency da on da.designagencyid = t.designagencyid
						   INNER JOIN customercontact cc on cc.contactid = t.customercontactid
						   INNER JOIN service s ON s.serviceid = t.serviceid
						   INNER JOIN status st ON st.statusid = t.statusid
						   INNER JOIN brand b ON b.brandid = p.brandid
						   INNER JOIN customer c on c.customerid = b.customerid
						   INNER JOIN customerlegalentity cle on t.legalentityid = cle.customerlegalentityid
						   INNER JOIN city cy on cy.cityid = cle.cityid
						   INNER JOIN state sta on sta.stateid = cy.stateid
						   INNER JOIN usercustomerpermission ucp ON ucp.customerid = c.customerid";
        $criteria->condition = " t.rateid = {$rateid} AND ucp.userid = {$userid} and t.active = 1";
        return $this->find($criteria);
    }

    public function modelByRateid($rateid) {
        $criteria = new CDbCriteria;
        $criteria->select = " LPAD(t.rateid,8,0) as rateid, LPAD(t.bundleid,8,0) as bundleid, t.warehouseid, t.designagencyid, c.customerid, b.brandid, t.customercontactid, t.legalentityid, t.serviceid,  s.servicedsc, t.statusid, st.statusdsc, " .
                "t.parentrateid, t.version, t.projectid, p.projectdsc, c.customerdsc, b.branddsc, s.servicedsc, concat(eu.firstname, ' ', eu.plastname ) as firstname, " .
                "t.statustime, wh.name as whname, da.designagencydsc, concat(cc.name,' ', cc.plastname) as name, t.ratebidsheet, t.ratedate, t.expiration, t.note, t.ratetype, t.image, " .
                "t.quantity_1, t.quantity_2, t.quantity_3, t.quantity_4, t.quantity_5, t.quantity_6, t.odptime, t.odctime, t.quantityselect, t.ppp_1, t.ppp_2, t.ppp_3, " .
                "t.ppp_4, t.ppp_5, t.ppp_6, t.pprice, t.saving, t.iva, t.currency, t.duration, t.send, cle.legalentity, cle.street, cle.number, cle.neighborhood, cy.citydsc, cy.cityid, sta.statedsc, cle.zipcode, cc.phone1, t.userid, ADDTIME(statustime,duration) as finalize";
        $criteria->join = "INNER JOIN project p ON p.projectid = t.projectid
						   INNER JOIN employeeuser eu on eu.userid = t.userid
						   INNER JOIN warehouse wh on wh.warehouseid = t.warehouseid
						   INNER JOIN designagency da on da.designagencyid = t.designagencyid
						   INNER JOIN customercontact cc on cc.contactid = t.customercontactid
						   INNER JOIN service s ON s.serviceid = t.serviceid
						   INNER JOIN status st ON st.statusid = t.statusid
						   INNER JOIN brand b ON b.brandid = p.brandid
						   INNER JOIN customer c on c.customerid = b.customerid
						   INNER JOIN customerlegalentity cle on t.legalentityid = cle.customerlegalentityid
						   INNER JOIN city cy on cy.cityid = cle.cityid
						   INNER JOIN state sta on sta.stateid = cy.stateid";
        $criteria->condition = " t.rateid = {$rateid} and t.active = 1";
        return $this->find($criteria);
    }

    public function bundleByUser($bundleid, $userid) {
        $criteria = new CDbCriteria;
        $criteria->select = "
            LPAD(t.rateid,8,0) as rateid, 
                            LPAD(t.bundleid,8,0) as bundleid, 
                            t.entryid, 
                            t.serviceid, 
                            s.servicedsc, 
                            t.statusid, 
                            st.statusdsc, 
                            LPAD( t.parentrateid ,8,0) as  parentrateid, 
                            t.version, 
                            t.projectid, 
                            p.projectdsc, 
                            c.customerid, 
                            c.customerdsc, 
                            b.branddsc, 
                            
                            concat(eu.firstname, ' ', eu.plastname ) as firstname, 
                            t.statustime, 
                            wh.name as whname, 
                            da.designagencydsc, 
                            concat(cc.name,' ', cc.plastname) as name, 
                            t.ratedate, 
                            t.expiration, 
                            t.note, 
                            t.ratetype, 
                            t.image, 
                            t.quantity_1, 
                            t.quantity_2, 
                            t.quantity_3, 
                            t.quantity_4, 
                            t.quantity_5, 
                            t.quantity_6, 
                            t.odptime, 
                            t.odctime, 
                            t.quantityselect, 
                            t.ppp_1, 
                            t.ppp_2, 
                            t.ppp_3, 
                            t.ppp_4, 
                            t.ppp_5, 
                            t.ppp_6, 
                            t.pprice, 
                            t.saving, 
                            t.iva, 
                            t.currency, 
                            t.duration, 
                            t.send, 
                            t.formula, 
                            t.raterenegotiate, 
                            ADDTIME(t.statustime,duration) as finalize, 
                            t.complete, 
                            t.probability,
                            IFNULL(r.rateodpid,0) as rateodpid,
                            IFNULL((SELECT t.quantityselect - SUM(cantidad) FROM evaluation WHERE rateid = t.rateid),t.quantityselect) as resto,
                            r.supplierid,ucp.userid";
        $criteria->join = "INNER JOIN project p ON p.projectid = t.projectid
						   INNER JOIN employeeuser eu on eu.userid = t.userid
						   LEFT JOIN warehouse wh on wh.warehouseid = t.warehouseid
						   LEFT JOIN designagency da on da.designagencyid = t.designagencyid
						   LEFT JOIN customercontact cc on cc.contactid = t.customercontactid
						   INNER JOIN service s ON s.serviceid = t.serviceid
						   INNER JOIN status st ON st.statusid = t.statusid
						   INNER JOIN brand b ON b.brandid = p.brandid
						   INNER JOIN customer c on c.customerid = b.customerid
						   INNER JOIN service s2 on s2.serviceid = s.serviceparentid
						   INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
						   INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
						   INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
						   INNER JOIN userservice  ON userservice.serviceid = s5.serviceid
						   INNER JOIN usercustomerpermission ucp ON ucp.customerid = c.customerid
                                                   
                                                   LEFT  JOIN rateodp r ON r.rateid = t.rateid";
        $criteria->condition = " t.bundleid = {$bundleid} AND ucp.userid = {$userid} and userservice.userid = {$userid} and t.active = 1";
        $criteria->group = "t.rateid";
        $criteria->order = "t.ratedate desc";
        return $this->findAll($criteria);
    }

    public function bundleByRate($bundleid, $userid, $rateid) {
        $criteria = new CDbCriteria;
        $criteria->select = "su.firstname as proveedor, 
                    LPAD(t.rateid,8,0) as rateid,
                    s.servicedsc,
                    concat(eu.firstname, ' ', eu.plastname ) as usuario, 
                            LPAD(t.bundleid,8,0) as bundleid, 
                            t.entryid, 
                            t.serviceid, 
                            s.servicedsc, 
                            t.statusid, 
                            st.statusdsc, 
                            LPAD( t.parentrateid ,8,0) as  parentrateid, 
                            t.version, 
                            t.projectid, 
                            p.projectdsc, 
                            c.customerid, 
                            c.customerdsc, 
                            b.branddsc, 
                            
                            
                            t.statustime, 
                            wh.name as whname, 
                            da.designagencydsc, 
                            concat(cc.name,' ', cc.plastname) as name, 
                            t.ratedate, 
                            t.expiration, 
                            t.note, 
                            t.ratetype, 
                            t.image, 
                            t.quantity_1, 
                            t.quantity_2, 
                            t.quantity_3, 
                            t.quantity_4, 
                            t.quantity_5, 
                            t.quantity_6, 
                            t.odptime, 
                            t.odctime, 
                            t.quantityselect, 
                            t.ppp_1, 
                            t.ppp_2, 
                            t.ppp_3, 
                            t.ppp_4, 
                            t.ppp_5, 
                            t.ppp_6, 
                            t.pprice, 
                            t.saving, 
                            t.iva, 
                            t.currency, 
                            t.duration, 
                            t.send, 
                            
                            ADDTIME(t.statustime,duration) as finalize, 
                            t.complete, 
                            t.probability,
                            IFNULL(r.rateodpid,0) as rateodpid,
                            IFNULL((SELECT t.quantityselect - SUM(cantidad) FROM evaluation WHERE rateid = t.rateid),t.quantityselect) as resto,
                            r.supplierid,ucp.userid";
        $criteria->join = "INNER JOIN project p ON p.projectid = t.projectid
						   INNER JOIN employeeuser eu on eu.userid = t.userid
						   INNER JOIN warehouse wh on wh.warehouseid = t.warehouseid
						   INNER JOIN designagency da on da.designagencyid = t.designagencyid
						   INNER JOIN customercontact cc on cc.contactid = t.customercontactid
						   INNER JOIN service s ON s.serviceid = t.serviceid
						   INNER JOIN status st ON st.statusid = t.statusid
						   INNER JOIN brand b ON b.brandid = p.brandid
						   INNER JOIN customer c on c.customerid = b.customerid
						   INNER JOIN service s2 on s2.serviceid = s.serviceparentid
						   INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
						   INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
						   INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
						   INNER JOIN userservice  ON userservice.serviceid = s5.serviceid
						   INNER JOIN usercustomerpermission ucp ON ucp.customerid = c.customerid
                                                   LEFT  JOIN rateodp r ON r.rateid = t.rateid
                                                   LEFT JOIN supplieruser su ON su.supplierid=r.supplierid";
        $criteria->condition = " t.bundleid = {$bundleid} AND ucp.userid = {$userid} and userservice.userid = {$userid} and t.active = 1 and t.rateid = {$rateid}";
        $criteria->order = "t.ratedate desc";
        return $this->findAll($criteria);
    }

    public function bundle($bundleid) {
        $criteria = new CDbCriteria;
        $criteria->select = " LPAD(t.rateid,8,0) as rateid, LPAD(t.bundleid,8,0) as bundleid, t.serviceid, s.servicedsc, t.statusid, st.statusdsc, " .
                "t.parentrateid, t.version, t.projectid, p.projectdsc, c.customerid, c.customerdsc, b.branddsc, s.servicedsc, concat(eu.firstname, ' ', eu.plastname ) as firstname, " .
                "t.statustime, wh.name as whname, da.designagencydsc, concat(cc.name,' ', cc.plastname) as name, t.ratedate, t.expiration, t.note, t.ratetype, t.image, " .
                "t.quantity_1, t.quantity_2, t.quantity_3, t.quantity_4, t.quantity_5, t.quantity_6, t.odptime, t.odctime, t.quantityselect, t.ppp_1, t.ppp_2, t.ppp_3, " .
                "t.ppp_4, t.ppp_5, t.ppp_6, t.pprice, t.saving, t.iva, t.currency, t.duration, t.send, t.formula, ADDTIME(statustime,duration) as finalize, t.complete";
        $criteria->join = "INNER JOIN project p ON p.projectid = t.projectid
						   INNER JOIN employeeuser eu on eu.userid = t.userid
						   INNER JOIN warehouse wh on wh.warehouseid = t.warehouseid
						   INNER JOIN designagency da on da.designagencyid = t.designagencyid
						   INNER JOIN customercontact cc on cc.contactid = t.customercontactid
						   INNER JOIN service s ON s.serviceid = t.serviceid
						   INNER JOIN status st ON st.statusid = t.statusid
						   INNER JOIN brand b ON b.brandid = p.brandid
						   INNER JOIN customer c on c.customerid = b.customerid
						   INNER JOIN service s2 on s2.serviceid = s.serviceparentid
						   INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
						   INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
						   INNER JOIN service s5 on s5.serviceid = s4.serviceparentid";
        $criteria->condition = " t.bundleid = {$bundleid}  and t.complete=1 and t.active = 1";
        $criteria->order = "t.ratedate desc";
        return $this->findAll($criteria);
    }

    public function bundle_pdf($bundleid) {
        $criteria = new CDbCriteria;
        $criteria->select = " LPAD(t.rateid,8,0) as rateid, LPAD(t.bundleid,8,0) as bundleid, t.serviceid, s.servicedsc, t.statusid, st.statusdsc,"
                . "t.parentrateid, t.version, t.projectid, p.projectdsc, c.customerid, c.customerdsc, b.branddsc, s.servicedsc, concat(eu.firstname, ' ', eu.plastname ) as firstname,  "
                . "t.statustime, concat(cc.name,' ', cc.plastname) as name, t.ratedate, t.expiration, t.note, t.ratetype, t.image, " .
                "t.quantity_1, t.quantity_2, t.quantity_3, t.quantity_4, t.quantity_5, t.quantity_6, t.odptime, t.odctime, t.quantityselect, t.ppp_1, t.ppp_2, t.ppp_3, " .
                "t.ppp_4, t.ppp_5, t.ppp_6, t.pprice, t.saving, t.iva, t.currency, t.duration, t.send, t.formula, ADDTIME(statustime,duration) as finalize, t.complete, cl.*,"
                . "cty.citydsc, stt.statedsc, cc.phone1 ";
        $criteria->join = "inner join customerlegalentity cl on cl.customerlegalentityid= t.legalentityid
                                    inner join customercontact cc on cc.contactid=t.customercontactid
                                    inner join user u on u.userid=t.userid
                                    inner join employeeuser eu on eu.userid=t.userid
                                    inner join project p on p.projectid=t.projectid
                                    INNER JOIN service s ON s.serviceid = t.serviceid
                                    INNER JOIN status st ON st.statusid = t.statusid
                                    INNER JOIN brand b ON b.brandid = p.brandid
                                    INNER JOIN customer c on c.customerid = b.customerid
                                    INNER JOIN city cty on cty.cityid=cl.cityid
                                    INNER JOIN state stt on stt.stateid=cty.stateid";
        $criteria->condition = " t.bundleid = {$bundleid}  and t.complete=1 and t.active = 1";
        $criteria->group = "t.bundleid";
        $criteria->order = "t.ratedate desc";
        return $this->findAll($criteria);
    }

    public function rate_pdf($bundleid) {
        $criteria = new CDbCriteria;
        $criteria->select = " LPAD(t.rateid,8,0) as rateid, LPAD(t.bundleid,8,0) as bundleid, t.serviceid, s.servicedsc, t.statusid, st.statusdsc,"
                . "t.parentrateid, t.version, t.projectid, p.projectdsc, c.customerid, c.customerdsc, b.branddsc, s.servicedsc, concat(eu.firstname, ' ', eu.plastname ) as firstname,  "
                . "t.statustime, concat(cc.name,' ', cc.plastname) as name, t.ratedate, t.expiration, t.note, t.ratetype, t.image, " .
                "t.quantity_1, t.quantity_2, t.quantity_3, t.quantity_4, t.quantity_5, t.quantity_6, t.odptime, t.odctime, t.quantityselect, t.ppp_1, t.ppp_2, t.ppp_3, " .
                "t.ppp_4, t.ppp_5, t.ppp_6, t.pprice, t.saving, t.iva, t.currency, t.duration, t.send, t.formula, ADDTIME(statustime,duration) as finalize, t.complete, cl.*";
        $criteria->join = "inner join customerlegalentity cl on cl.customerlegalentityid= t.legalentityid
                                    inner join customercontact cc on cc.contactid=t.customercontactid
                                    inner join user u on u.userid=t.userid
                                    inner join employeeuser eu on eu.userid=t.userid
                                    inner join project p on p.projectid=t.projectid
                                    INNER JOIN service s ON s.serviceid = t.serviceid
                                    INNER JOIN status st ON st.statusid = t.statusid
                                    INNER JOIN brand b ON b.brandid = p.brandid
                                    INNER JOIN customer c on c.customerid = b.customerid";
        $criteria->condition = " t.bundleid = {$bundleid}  and t.complete=1 and t.active = 1";
        $criteria->order = "t.ratedate desc";
        return $this->findAll($criteria);
    }

    public function bundle_pdf2($bundleid, $rates) {
        $criteria = new CDbCriteria;
        $criteria->select = " LPAD(t.rateid,8,0) as rateid, LPAD(t.bundleid,8,0) as bundleid, t.serviceid, s.servicedsc, t.statusid, st.statusdsc,"
                . "t.parentrateid, t.version, t.projectid, p.projectdsc, c.customerid, c.customerdsc, b.branddsc, s.servicedsc, concat(eu.firstname, ' ', eu.plastname ) as firstname,  "
                . "t.statustime, concat(cc.name,' ', cc.plastname) as name, t.ratedate, t.expiration, t.note, t.ratetype, t.image, " .
                "t.quantity_1, t.quantity_2, t.quantity_3, t.quantity_4, t.quantity_5, t.quantity_6, t.odptime, t.odctime, t.quantityselect, t.ppp_1, t.ppp_2, t.ppp_3, " .
                "t.ppp_4, t.ppp_5, t.ppp_6, t.pprice, t.saving, t.iva, t.currency, t.duration, t.send, t.formula, ADDTIME(statustime,duration) as finalize, t.complete, cl.*,"
                . "cty.citydsc, stt.statedsc, cc.phone1 ";
        $criteria->join = "inner join customerlegalentity cl on cl.customerlegalentityid= t.legalentityid
                                    inner join customercontact cc on cc.contactid=t.customercontactid
                                    inner join user u on u.userid=t.userid
                                    inner join employeeuser eu on eu.userid=t.userid
                                    inner join project p on p.projectid=t.projectid
                                    INNER JOIN service s ON s.serviceid = t.serviceid
                                    INNER JOIN status st ON st.statusid = t.statusid
                                    INNER JOIN brand b ON b.brandid = p.brandid
                                    INNER JOIN customer c on c.customerid = b.customerid
                                    INNER JOIN city cty on cty.cityid=cl.cityid
                                    INNER JOIN state stt on stt.stateid=cty.stateid";
        $crates = ($rates == "") ? '' : ' and t.rateid IN (' . $rates . ')';
        $criteria->condition = " t.bundleid = {$bundleid}  and t.complete=1 and t.active = 1" . $crates;
        $criteria->group = "t.bundleid";
        $criteria->order = "t.ratedate desc";
        return $this->findAll($criteria);
    }

    public function rate_pdf2($bundleid, $rates) {
        $criteria = new CDbCriteria;
        $criteria->select = " LPAD(t.rateid,8,0) as rateid, LPAD(t.bundleid,8,0) as bundleid, t.serviceid, s.servicedsc, t.statusid, st.statusdsc,"
                . "t.parentrateid, t.version, t.projectid, p.projectdsc, c.customerid, c.customerdsc, b.branddsc, s.servicedsc, concat(eu.firstname, ' ', eu.plastname ) as firstname,  "
                . "t.statustime, concat(cc.name,' ', cc.plastname) as name, t.ratedate, t.expiration, t.note, t.ratetype, t.image, " .
                "t.quantity_1, t.quantity_2, t.quantity_3, t.quantity_4, t.quantity_5, t.quantity_6, t.odptime, t.odctime, t.quantityselect, t.ppp_1, t.ppp_2, t.ppp_3, " .
                "t.ppp_4, t.ppp_5, t.ppp_6, t.pprice, t.saving, t.iva, t.currency, t.duration, t.send, t.formula, ADDTIME(statustime,duration) as finalize, t.complete, cl.*";
        $criteria->join = "inner join customerlegalentity cl on cl.customerlegalentityid= t.legalentityid
                                    inner join customercontact cc on cc.contactid=t.customercontactid
                                    inner join user u on u.userid=t.userid
                                    inner join employeeuser eu on eu.userid=t.userid
                                    inner join project p on p.projectid=t.projectid
                                    INNER JOIN service s ON s.serviceid = t.serviceid
                                    INNER JOIN status st ON st.statusid = t.statusid
                                    INNER JOIN brand b ON b.brandid = p.brandid
                                    INNER JOIN customer c on c.customerid = b.customerid";
        $crates = ($rates == "") ? '' : ' and t.rateid IN (' . $rates . ')';
        $criteria->condition = " t.bundleid = {$bundleid}  and t.complete=1 and t.active = 1" . $crates;
        $criteria->order = "t.ratedate desc";
        return $this->findAll($criteria);
    }

    public function searchRates($get) {

        $aColumns = array('t.bundleid', 't.ratedate', 'customer.customerdsc', 'brand.branddsc', 'project.projectdsc', 's.servicedsc');

        $sLimit = "";
        if (isset($get['iDisplayStart']) && $get['iDisplayLength'] != '-1') {
            $sLimit = ( $get['iDisplayStart'] ) . ", " . ( $get['iDisplayLength'] );
        }


        if ($get['iSortCol_0']) {
            $sOrder = "  ";
            for ($i = 0; $i < intval($get['iSortingCols']); $i++) {
                if ($get['bSortable_' . intval($get['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($get['iSortCol_' . $i])] . " " . ( $get['sSortDir_' . $i] ) . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
        } else if ($get['sEcho'] == 1)
            $sOrder .= 'bundleid desc';
        else
            $sOrder .= $aColumns[intval($get['iSortCol_0'])] . " " . ( $get['sSortDir_0'] );


        $sWhere = "";
        if ($get['sSearch'] != "") {
            $sWhere = " AND (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . ( $get['sSearch'] ) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ' OR t.rateid = "' . $get['sSearch'] . '")';
        }


        for ($i = 0; $i < count($aColumns); $i++) {
            if ($get['bSearchable_' . $i] == "true" && $get['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = " ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . ($get['sSearch_' . $i]) . "%' ";
            }
        }


        $criteria = new CDbCriteria;

        $criteria->select = "LPAD(t.rateid,8,0) as rateid, LPAD(bundleid,8,0) as bundleid, DATE(t.ratedate) as ratedate,  LPAD(parentrateid,8,0) as parentrateid," .
                " version, customer.customerdsc as customerdsc, brand.branddsc as branddsc, project.projectdsc as projectdsc, GROUP_CONCAT(concat('<strong>',LPAD(t.rateid,8,0),' ',service.servicedsc,'</strong> <i>',status.statusdsc,'</i>') SEPARATOR '<br />') as servicedsc, " .
                " s5.servicedsc as entry, concat(employeeuser.firstname, ' ', employeeuser.plastname ) as firstname, t.note, status.statusdsc as statusdsc";
        $criteria->join = "INNER JOIN project ON project.projectid = t.projectid
						   INNER JOIN brand ON brand.brandid = project.brandid
						   INNER JOIN service ON service.serviceid = t.serviceid
						   INNER JOIN employeeuser ON employeeuser.userid = t.userid 
						   INNER JOIN status ON status.statusid = t.statusid
						   INNER JOIN customer on customer.customerid = brand.customerid
						   INNER JOIN service s on s.serviceid = t.serviceid
						   INNER JOIN service s2 on s2.serviceid = s.serviceparentid
						   INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
						   INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
						   INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
						   INNER JOIN userservice  ON userservice.serviceid = s5.serviceid
						   INNER JOIN usercustomerpermission ucp ON ucp.customerid = customer.customerid   ";

        $criteria->compare('customer.companyid', Yii::app()->user->companyid);
        $criteria->compare('customer.customerid', $this->customerid);
        $criteria->compare('userservice.userid', Yii::app()->user->userid);
        $criteria->compare('ucp.userid', Yii::app()->user->userid);
        $criteria->compare('t.active', 1);
        $criteria->group = 'bundleid';
        $criteria->order = $sOrder;
//$criteria->limit = 10;
        $page = 0;
        if ($get['iDisplayStart'] > 0)
            $page = ($get['iDisplayStart'] / $get['iDisplayLength']) + 1;
        $result = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $get['iDisplayLength'],
                'currentPage' => $page,
            ),
        ));
        $results = $result->getData();
        $iFilteredTotal = 1; //$aResultFilterTotal[0];
        $iTotal = 1;
        $output = array(
            "sEcho" => intval($get['sEcho']),
            "iTotalRecords" => $result->getTotalItemCount(),
            "iTotalDisplayRecords" => $result->getTotalItemCount(),
            "aaData" => array()
        );

        foreach ($results as $row) {
            $row = array('<a class="btn bg-color-orange txt-color-white" href="#index.php?r=portoprint/rate/price/id/' . Utils::encrypt($row->bundleid, 'rate') . '">' . $row->bundleid . '</a>', $row->ratedate, $row->customerdsc, $row->branddsc, $row->projectdsc, $row->servicedsc);
            $output['aaData'][] = $row;
        }
        return $output;
    }

    public function searchRates2($get) {

        $criteria = new CDbCriteria;

        $criteria->select = "LPAD(t.rateid,8,0) as rateid,
                             LPAD(bundleid,8,0) as bundleid, 
                             DATE(t.ratedate) as ratedate,  
                             LPAD(parentrateid,8,0) as parentrateid, 
                             version, 
                             customer.customerdsc as customerdsc, 
                             brand.branddsc as branddsc, 
                             project.projectdsc as projectdsc, 
                             GROUP_CONCAT(concat(
                                LPAD(t.rateid,8,0),' ',service.servicedsc,'|',
                                status.statusdsc,'|',
                                IF(odptime,'ODP generada','ODP no generada'),'|',
                                IF(odctime,'ODC generada','ODC no generada')
                                )SEPARATOR '¬' ) as servicedsc,
                             s5.servicedsc as entry, 
                             concat(employeeuser.firstname, ' ', employeeuser.plastname ) as firstname, 
                             t.note, 
                             status.statusdsc as statusdsc";
        $criteria->join = "INNER JOIN project ON project.projectid = t.projectid
						   INNER JOIN brand ON brand.brandid = project.brandid
						   INNER JOIN service ON service.serviceid = t.serviceid
						   INNER JOIN employeeuser ON employeeuser.userid = t.userid 
						   INNER JOIN status ON status.statusid = t.statusid
						   INNER JOIN customer on customer.customerid = brand.customerid
						   INNER JOIN service s on s.serviceid = t.serviceid
						   INNER JOIN service s2 on s2.serviceid = s.serviceparentid
						   INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
						   INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
						   INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
						   INNER JOIN userservice  ON userservice.serviceid = s5.serviceid
						   INNER JOIN usercustomerpermission ucp ON ucp.customerid = customer.customerid   ";
        $criteria->condition = " customer.companyid = " . Yii::app()->user->companyid . " AND " .
                " userservice.userid = " . Yii::app()->user->userid . " AND " .
                " ucp.userid = " . Yii::app()->user->userid . " AND t.active = 1  AND " .
                " DATE(t.ratedate) BETWEEN '" . $get['start'] . "' AND '" . $get['end'] . "'";
        if (isset($get['customer']) and $get['customer'] != 0)
            $criteria->condition .=" AND brand.customerid = {$get['customer']} ";
        $criteria->group = 't.bundleid';
        $criteria->order = 't.bundleid desc';
//$criteria->limit = 60;
        $results = $this->findAll($criteria);
        $cont = 0;
        if (count($results) > 0) {
            foreach ($results as $row) {
                $output[$cont]['bundleid'] = '<a class="btn btn-info  txt-color-white" href="index.php?r=portoprint/default#' . Yii::app()->createUrl('/portoprint/rate/price/', array("id" => Utils::encrypt($row->bundleid, 'rate'), "start" => Utils::encrypt($get['start'], 'rate'), "end" => Utils::encrypt($get['end'], 'rate'), "customer" => Utils::encrypt($get['customer'], 'rate'), "add" => Utils::encrypt($get['add'], 'rate'), "edt" => Utils::encrypt($get['edt'], 'rate'), "del" => Utils::encrypt($get['del'], 'rate'), "menu" => Utils::encrypt($get['menu'], 'rate'))) . '"  >' . $row->bundleid . '</a>';
                $output[$cont]['rateid'] = $row->rateid;
                $output[$cont]['ratedate'] = $row->ratedate;
                $output[$cont]['parentrateid'] = $row->parentrateid;
                $output[$cont]['version'] = $row->version;
                $output[$cont]['customerdsc'] = $row->customerdsc;
                $output[$cont]['branddsc'] = $row->branddsc;
                $output[$cont]['projectdsc'] = $row->projectdsc;
                $output[$cont]['servicedsc'] = $row->servicedsc;
                $output[$cont]['entry'] = $row->entry;
                $output[$cont]['firstname'] = $row->firstname;
                $output[$cont]['note'] = $row->note;
                $output[$cont]['statusdsc'] = $row->statusdsc;
                $cont = $cont + 1;
            }
        } else {
            $output = 0;
        }
        $output = array('aaData' => $output);

        return $output;
    }

    public function searchRates4($get) {

        $criteria = new CDbCriteria;

        $criteria->select = "LPAD(t.rateid,8,0) as rateid,
                             LPAD(bundleid,8,0) as bundleid, 
                             DATE(t.ratedate) as ratedate,  
                             LPAD(parentrateid,8,0) as parentrateid, 
                             version, 
                             customer.customerdsc as customerdsc, 
                             brand.branddsc as branddsc, 
                             project.projectdsc as projectdsc, 
                             GROUP_CONCAT(concat('<strong>',LPAD(t.rateid,8,0),' ',service.servicedsc,'</strong> <i>',status.statusdsc,'</i>') SEPARATOR '<br />') as servicedsc, 
                             s5.servicedsc as entry, 
                             concat(employeeuser.firstname, ' ', employeeuser.plastname ) as firstname, 
                             t.note, 
                             status.statusdsc as statusdsc";
        $criteria->join = "INNER JOIN project ON project.projectid = t.projectid
						   INNER JOIN brand ON brand.brandid = project.brandid
						   INNER JOIN service ON service.serviceid = t.serviceid
						   INNER JOIN employeeuser ON employeeuser.userid = t.userid 
						   INNER JOIN status ON status.statusid = t.statusid
						   INNER JOIN customer on customer.customerid = brand.customerid
						   INNER JOIN service s on s.serviceid = t.serviceid
						   INNER JOIN service s2 on s2.serviceid = s.serviceparentid
						   INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
						   INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
						   INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
						   INNER JOIN userservice  ON userservice.serviceid = s5.serviceid
						   INNER JOIN usercustomerpermission ucp ON ucp.customerid = customer.customerid   ";
        $criteria->condition = " customer.companyid = " . Yii::app()->user->companyid . " AND " .
                " userservice.userid = " . Yii::app()->user->userid . " AND " .
                " ucp.userid = " . Yii::app()->user->userid . " AND t.active = 1  AND " .
                " DATE(t.ratedate) BETWEEN '" . $get['start'] . "' AND '" . $get['end'] . "'";
        if (isset($get['customer']) and $get['customer'] != 0)
            $criteria->condition .=" AND brand.customerid = {$get['customer']} ";
        $criteria->group = 't.bundleid';
        $criteria->order = 't.bundleid desc';
//$criteria->limit = 60;
        $results = $this->findAll($criteria);
        $cont = 0;
        if (count($results) > 0) {
            foreach ($results as $row) {
                $output[$cont]['bundleid'] = '<a class="btn btn-info  txt-color-white" href="index.php?r=portoprint/default#' . Yii::app()->createUrl('/portoprint/rate/price2/', array("id" => Utils::encrypt($row->bundleid, 'rate'), "start" => Utils::encrypt($get['start'], 'rate'), "end" => Utils::encrypt($get['end'], 'rate'), "customer" => Utils::encrypt($get['customer'], 'rate'), "add" => Utils::encrypt($get['add'], 'rate'), "edt" => Utils::encrypt($get['edt'], 'rate'), "del" => Utils::encrypt($get['del'], 'rate'), "menu" => Utils::encrypt($get['menu'], 'rate'))) . '"  >' . $row->bundleid . '</a>';
                $output[$cont]['rateid'] = $row->rateid;
                $output[$cont]['ratedate'] = $row->ratedate;
                $output[$cont]['parentrateid'] = $row->parentrateid;
                $output[$cont]['version'] = $row->version;
                $output[$cont]['customerdsc'] = $row->customerdsc;
                $output[$cont]['branddsc'] = $row->branddsc;
                $output[$cont]['projectdsc'] = $row->projectdsc;
                $output[$cont]['servicedsc'] = $row->servicedsc;
                $output[$cont]['entry'] = $row->entry;
                $output[$cont]['firstname'] = $row->firstname;
                $output[$cont]['note'] = $row->note;
                $output[$cont]['statusdsc'] = $row->statusdsc;
                $cont = $cont + 1;
            }
        } else {
            $output = 0;
        }
        $output = array('aaData' => $output);

        return $output;
    }

    public function quantityselected($qx) {
        $txt = "";
        if ($qx == 0)
            $txt = ' disabled="disabled" ';
        else if ($this->quantityselect == $qx)
            $txt = ' checked="checked" ';


        return $txt;
    }

    public function getprice() {
        $price = 0;
        switch ($this->quantityselect) {
            case $this->quantity_1:
                $price = $this->ppp_1;
                break;
            case $this->quantity_2:
                $price = $this->ppp_2;
                break;
            case $this->quantity_3:
                $price = $this->ppp_3;
                break;
            case $this->quantity_4:
                $price = $this->ppp_4;
                break;
            case $this->quantity_5:
                $price = $this->ppp_5;
                break;
            case $this->quantity_6:
                $price = $this->ppp_6;
                break;
        }
        return $price;
    }

    public function getprice1($ts) {
        $price = 0;
        switch ($ts) {
            case $this->quantity_1:
                $price = $this->ppp_1;
                break;
            case $this->quantity_2:
                $price = $this->ppp_2;
                break;
            case $this->quantity_3:
                $price = $this->ppp_3;
                break;
            case $this->quantity_4:
                $price = $this->ppp_4;
                break;
            case $this->quantity_5:
                $price = $this->ppp_5;
                break;
            case $this->quantity_6:
                $price = $this->ppp_6;
                break;
        }
        return $price;
    }

    public function getquantityselected() {
        $qx = '';
        switch ($this->quantityselect) {
            case $this->quantity_1:
                $qx = 'quantity_1';
                break;
            case $this->quantity_2:
                $qx = 'quantity_2';
                break;
            case $this->quantity_3:
                $qx = 'quantity_3';
                break;
            case $this->quantity_4:
                $qx = 'quantity_4';
                break;
            case $this->quantity_5:
                $qx = 'quantity_5';
                break;
            case $this->quantity_6:
                $qx = 'quantity_6';
                break;
        }
        return $qx;
    }

    public function quantityselectedicon($qx) {
        $txt = "";
        if ($this->quantityselect == $qx)
            $txt = ' <i style="color:#5BB75B;" class="glyphicon glyphicon-ok" name="'.$qx.'"></i><br /> ';


        return $txt;
    }

    public function idVersion() {
        $txt = $this->parentrateid;
        if ($this->version != 0)
            $txt .= '-' . $this->version;
        return $txt;
    }

    public function quantityselectedcell($qx, $compare) {
        $txt = "";
        if ($this->quantityselect == $qx && $compare)
            $txt.=' font-weight:bold; ';

        return $txt;
    }

    public function getAllRates() {
        $criteria = new CDbCriteria;

        $criteria->select = "t.rateid, LPAD(t.rateid,8,0) as lrateid, LPAD(bundleid,8,0) as bundleid, DATE(t.ratedate) as ratedate,  LPAD(parentrateid,8,0) as parentrateid," .
                " version, customer.customerdsc as customerdsc, brand.branddsc as branddsc, project.projectdsc as projectdsc, service.servicedsc, " .
                " s5.servicedsc as entry, concat(employeeuser.firstname, ' ', employeeuser.plastname ) as firstname, t.note, status.statusdsc as statusdsc";
        $criteria->join = "INNER JOIN project ON project.projectid = t.projectid
						   INNER JOIN brand ON brand.brandid = project.brandid
						   INNER JOIN service ON service.serviceid = t.serviceid
						   INNER JOIN employeeuser ON employeeuser.userid = t.userid 
						   INNER JOIN status ON status.statusid = t.statusid
						   INNER JOIN customer on customer.customerid = brand.customerid
						   INNER JOIN service s on s.serviceid = t.serviceid
						   INNER JOIN service s2 on s2.serviceid = s.serviceparentid
						   INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
						   INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
						   INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
						   INNER JOIN userservice  ON userservice.serviceid = s5.serviceid
						   INNER JOIN usercustomerpermission ucp ON ucp.customerid = customer.customerid   ";

        $criteria->compare('customer.companyid', Yii::app()->user->companyid);
        $criteria->compare('customer.customerid', $this->customerid);
        $criteria->compare('userservice.userid', Yii::app()->user->userid);
        $criteria->compare('ucp.userid', Yii::app()->user->userid);
        $criteria->compare('t.active', 1);
//$criteria->group = 'bundleid';	
        $criteria->order = 'bundleid desc';

        return $this->findAll($criteria);
    }

    public function getAllRatesbyDate($fecha) {
        $criteria = new CDbCriteria;

        $separa = explode(" ", $fecha);
        $fecha1 = date($separa[0]);
        $nuevafecha = strtotime('-1 day', strtotime($fecha1));
        $nuevafecha = date('Y-m-j', $nuevafecha);

        $criteria->select = "t.* ,s.servicedsc, project.projectdsc as projectdsc,customer.customerdsc as customerdsc,status.statusdsc";
        $criteria->join = "INNER JOIN status ON status.statusid = t.statusid
                                    INNER JOIN project ON project.projectid = t.projectid
                                    INNER JOIN brand ON brand.brandid = project.brandid
                                    INNER JOIN service s on s.serviceid = t.serviceid
                                    INNER JOIN customer on customer.customerid = brand.customerid ";

        $criteria->condition = " t.ratedate BETWEEN '" . $nuevafecha . " 00:00' AND '" . $fecha . "' AND t.statusid in (2,3,4)";


        return $this->findAll($criteria);
    }

    public function getRatesCompleted($id) {
        $criteria = new CDbCriteria;
        $criteria->select = "t.statusid, concat(LPAD(t.parentrateid,8,0),if(t.version,concat('-',t.version),''),' ',s2.servicedsc) as servicedsc, if(s3.serviceid = 0, 'Por_Asignar', s3.servicedsc) as entry, t.quantity_1, t.quantity_2, t.quantity_3, t.quantity_4, t.quantity_5, t.quantity_6, 
 							if(t.complete,t.ppp_1,0) as ppp_1, if(t.complete,t.ppp_2,0) as ppp_2, if(t.complete,t.ppp_3,0) as ppp_3, if(t.complete,t.ppp_4,0) as ppp_4, 
 							if(t.complete,t.ppp_5,0) as ppp_5, if(t.complete,t.ppp_6,0) as ppp_6, t.quantityselect, if(t.complete,t.pprice,0) as pprice, t.iva, t.complete";
        $criteria->join = "INNER JOIN service s ON s.serviceid = t.entryid
						   INNER JOIN service s2 ON s2.serviceid = t.serviceid 
						   INNER JOIN service s3 ON s3.serviceid = s.serviceparentid";
        $criteria->compare('t.bundleid', $id);
        $criteria->compare('t.active', 1);
        $criteria->order = 's2.servicedsc, s.servicedsc';
        return $this->findAll($criteria);
    }

    public function getLimitRates() {
        $criteria = new CDbCriteria;
        $criteria->select = "t.rateid";
        $criteria->order = 't.rateid DESC';
        $criteria->limit = '1';
        return $this->findAll($criteria);
    }

    public function getareaid($rateid) {
        $criteria = new CDbCriteria;
        
        $criteria->select = "a.areaid";
        $criteria->join = "INNER JOIN service s on s.serviceid = t.serviceid
        INNER JOIN service s2 on s2.serviceid = s.serviceparentid
        INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
        INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
        INNER JOIN service s5 on s5.serviceid = s4.serviceparentid
        INNER JOIN todoarea a on a.serviceid = s5.serviceid";
        $criteria->condition ="t.rateid = ".$rateid;
        
        $result = $this->findAll($criteria);
        foreach ($result as $row) {
            $areaid = $row->areaid;
        }
        return $areaid;
    }
       public function getserviceid($rateid) {
        $criteria = new CDbCriteria;
        
        $criteria->select = "s5.servicedsc";
        $criteria->join = "INNER JOIN service s on s.serviceid = t.serviceid
        INNER JOIN service s2 on s2.serviceid = s.serviceparentid
        INNER JOIN service s3 on s3.serviceid = s2.serviceparentid
        INNER JOIN service s4 on s4.serviceid = s3.serviceparentid
        INNER JOIN service s5 on s5.serviceid = s4.serviceparentid";
        $criteria->condition ="t.rateid = ".$rateid;
        
        $result = $this->findAll($criteria);
        foreach ($result as $row) {
            $servicedsc = $row->servicedsc;
        }
        return $servicedsc;
    }
    public function getcustomerid($rateid) {
        $criteria = new CDbCriteria;
        
        $criteria->select = "b.customerid";
        $criteria->join = "inner join bundleproject b on b.bundleid = t.bundleid";
        $criteria->condition ="t.rateid = ".$rateid;
        
        $result = $this->findAll($criteria);
        foreach ($result as $row) {
            $customerid = $row->customerid;
        }
        return $customerid;
    }

}
