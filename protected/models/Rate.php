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
 * @property string $bundleid
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
 * @property Rateservice[] $rateservices
 * @property Ratesupplier[] $ratesuppliers
 * @property Ratesupplierinvoice[] $ratesupplierinvoices
 * @property Ratewarehouse[] $ratewarehouses
 * @property Ratezerotest[] $ratezerotests
 */
class Rate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rate the static model class
	 */
     public $companydsc;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('projectid, serviceid, bundleid, userid, statusid, statustime, warehouseid, designagencyid, customercontactid, legalentityid, duration', 'required'),
			array('parentrateid, version, userid, statusid, customercontactid, legalentityid, quantity_1, quantity_2, quantity_3, quantity_4, quantity_5, quantity_6, quantityselect, iva, send, active', 'numerical', 'integerOnly'=>true),
			array('ppp_1, ppp_2, ppp_3, ppp_4, ppp_5, ppp_6, pprice, saving', 'numerical'),
			array('projectid, bundleid', 'length', 'max'=>11),
			array('serviceid, warehouseid, designagencyid, currency', 'length', 'max'=>10),
			array('ratetype', 'length', 'max'=>20),
			array('image', 'length', 'max'=>100),
			array('ratedate, expiration, note, odptime, odctime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rateid, parentrateid, version, projectid, serviceid, bundleid, userid, statusid, statustime, warehouseid, designagencyid, customercontactid, legalentityid, ratedate, expiration, note, ratetype, image, quantity_1, quantity_2, quantity_3, quantity_4, quantity_5, quantity_6, odptime, odctime, quantityselect, ppp_1, ppp_2, ppp_3, ppp_4, ppp_5, ppp_6, pprice, saving, iva, currency, duration, send, active', 'safe', 'on'=>'search'),
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
			'evaluations' => array(self::HAS_MANY, 'Evaluation', 'rateid'),
			'project' => array(self::BELONGS_TO, 'Project', 'projectid'),
			'legalentity' => array(self::BELONGS_TO, 'Customerlegalentity', 'legalentityid'),
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
			'rateservices' => array(self::HAS_MANY, 'Rateservice', 'rateid'),
			'ratesuppliers' => array(self::HAS_MANY, 'Ratesupplier', 'rateid'),
			'ratesupplierinvoices' => array(self::HAS_MANY, 'Ratesupplierinvoice', 'rateid'),
			'ratewarehouses' => array(self::HAS_MANY, 'Ratewarehouse', 'rateid'),
			'ratezerotests' => array(self::HAS_MANY, 'Ratezerotest', 'rateid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rateid' => 'Rateid',
			'parentrateid' => 'Parentrateid',
			'version' => 'Version',
			'projectid' => 'Projectid',
			'serviceid' => 'Serviceid',
			'bundleid' => 'Bundleid',
			'userid' => 'Userid',
			'statusid' => 'Statusid',
			'statustime' => 'Statustime',
			'warehouseid' => 'Warehouseid',
			'designagencyid' => 'Designagencyid',
			'customercontactid' => 'Customercontactid',
			'legalentityid' => 'Legalentityid',
			'ratedate' => 'Ratedate',
			'expiration' => 'Expiration',
			'note' => 'Note',
			'ratetype' => 'Ratetype',
			'image' => 'Image',
			'quantity_1' => 'Quantity 1',
			'quantity_2' => 'Quantity 2',
			'quantity_3' => 'Quantity 3',
			'quantity_4' => 'Quantity 4',
			'quantity_5' => 'Quantity 5',
			'quantity_6' => 'Quantity 6',
			'odptime' => 'Odptime',
			'odctime' => 'Odctime',
			'quantityselect' => 'Quantityselect',
			'ppp_1' => 'Ppp 1',
			'ppp_2' => 'Ppp 2',
			'ppp_3' => 'Ppp 3',
			'ppp_4' => 'Ppp 4',
			'ppp_5' => 'Ppp 5',
			'ppp_6' => 'Ppp 6',
			'pprice' => 'Pprice',
			'saving' => 'Saving',
			'iva' => 'Iva',
			'currency' => 'Currency',
			'duration' => 'Duration',
			'send' => 'Send',
			'active' => 'Active',
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

		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('parentrateid',$this->parentrateid);
		$criteria->compare('version',$this->version);
		$criteria->compare('projectid',$this->projectid,true);
		$criteria->compare('serviceid',$this->serviceid,true);
		$criteria->compare('bundleid',$this->bundleid,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('statusid',$this->statusid);
		$criteria->compare('statustime',$this->statustime,true);
		$criteria->compare('warehouseid',$this->warehouseid,true);
		$criteria->compare('designagencyid',$this->designagencyid,true);
		$criteria->compare('customercontactid',$this->customercontactid);
		$criteria->compare('legalentityid',$this->legalentityid);
		$criteria->compare('ratedate',$this->ratedate,true);
		$criteria->compare('expiration',$this->expiration,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('ratetype',$this->ratetype,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('quantity_1',$this->quantity_1);
		$criteria->compare('quantity_2',$this->quantity_2);
		$criteria->compare('quantity_3',$this->quantity_3);
		$criteria->compare('quantity_4',$this->quantity_4);
		$criteria->compare('quantity_5',$this->quantity_5);
		$criteria->compare('quantity_6',$this->quantity_6);
		$criteria->compare('odptime',$this->odptime,true);
		$criteria->compare('odctime',$this->odctime,true);
		$criteria->compare('quantityselect',$this->quantityselect);
		$criteria->compare('ppp_1',$this->ppp_1);
		$criteria->compare('ppp_2',$this->ppp_2);
		$criteria->compare('ppp_3',$this->ppp_3);
		$criteria->compare('ppp_4',$this->ppp_4);
		$criteria->compare('ppp_5',$this->ppp_5);
		$criteria->compare('ppp_6',$this->ppp_6);
		$criteria->compare('pprice',$this->pprice);
		$criteria->compare('saving',$this->saving);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('send',$this->send);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}