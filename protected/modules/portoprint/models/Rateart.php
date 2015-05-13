<?php

/**
 * This is the model class for table "rateart".
 *
 * The followings are the available columns in table 'rateart':
 * @property string $rateartid
 * @property string $rateid
 * @property string $receptiondate
 * @property integer $filerevision1
 * @property integer $filerevision2
 * @property integer $filerevision3
 * @property integer $filerevision4
 * @property integer $changes
 * @property string $specifiedobservation
 * @property string $receivemethod
 * @property string $authorization
 * @property string $designhead
 * @property string $receipt
 * @property string $filetype
 * @property string $changestype
 * @property string $senddate
 * @property string $authorizationdate
 * @property string $authorizationmethod
 * @property string $sendmethod
 *
 * The followings are the available model relations:
 * @property Rate $rate
 */
class Rateart extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rateart the static model class
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
		return 'rateart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid', 'required'),
			array('filerevision1, filerevision2, filerevision3, filerevision4, changes', 'numerical', 'integerOnly'=>true),
			array('rateid', 'length', 'max'=>11),
			array('specifiedobservation', 'length', 'max'=>200),
			array('receivemethod, authorization, designhead, receipt, filetype, changestype, authorizationmethod, sendmethod', 'length', 'max'=>100),
			array('receptiondate, senddate, authorizationdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rateartid, rateid, receptiondate, filerevision1, filerevision2, filerevision3, filerevision4, changes, specifiedobservation, receivemethod, authorization, designhead, receipt, filetype, changestype, senddate, authorizationdate, authorizationmethod, sendmethod', 'safe', 'on'=>'search'),
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
			'rate' => array(self::BELONGS_TO, 'Rate', 'rateid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rateartid' => 'Rateartid',
			'rateid' => 'Rateid',
			'receptiondate' => 'Fecha de Recepción',
			'filerevision1' => 'Overprint',
			'filerevision2' => 'Fuentes',
			'filerevision3' => 'Imagenes CMYK',
			'filerevision4' => 'Resolución',
			'changes' => 'Modificaciones',
			'specifiedobservation' => 'Observación especifica',
			'receivemethod' => 'Método de Recepción',
			'authorization' => 'Quien autoriza la modificación',
			'designhead' => 'Responsable de diseño',
			'receipt' => 'Recibido de',
			'filetype' => 'Tipo de archivo / versión',
			'changestype' => 'Tipo de modificaciones',
			'senddate' => 'Fecha de envio de modificación',
			'authorizationdate' => 'Fecha de autorización de modificación',
			'authorizationmethod' => 'Metodo de autorización',
			'sendmethod' => 'Método de envío',
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

		$criteria->compare('rateartid',$this->rateartid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('receptiondate',$this->receptiondate,true);
		$criteria->compare('filerevision1',$this->filerevision1);
		$criteria->compare('filerevision2',$this->filerevision2);
		$criteria->compare('filerevision3',$this->filerevision3);
		$criteria->compare('filerevision4',$this->filerevision4);
		$criteria->compare('changes',$this->changes);
		$criteria->compare('specifiedobservation',$this->specifiedobservation,true);
		$criteria->compare('receivemethod',$this->receivemethod,true);
		$criteria->compare('authorization',$this->authorization,true);
		$criteria->compare('designhead',$this->designhead,true);
		$criteria->compare('receipt',$this->receipt,true);
		$criteria->compare('filetype',$this->filetype,true);
		$criteria->compare('changestype',$this->changestype,true);
		$criteria->compare('senddate',$this->senddate,true);
		$criteria->compare('authorizationdate',$this->authorizationdate,true);
		$criteria->compare('authorizationmethod',$this->authorizationmethod,true);
		$criteria->compare('sendmethod',$this->sendmethod,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}