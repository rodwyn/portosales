<?php

/**
 * This is the model class for table "evaluation".
 *
 * The followings are the available columns in table 'evaluation':
 * @property string $evaluationid
 * @property string $rateid
 * @property string $supplierid
 * @property integer $cotizacion
 * @property integer $resolucionproblemas
 * @property integer $impresion
 * @property integer $acabados
 * @property integer $empaque
 * @property integer $distribucion
 * @property integer $cumplimiento
 * @property integer $enviodocumentacion
 * @property integer $enviomuestras
 * @property integer $comunicacion
 * @property integer $disponibilidad
 * @property integer $status
 * @property double $promedioservicio
 *
 * The followings are the available model relations:
 * @property Rate $rate
 * @property Supplier $supplier
 */
class Evaluation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Evaluation the static model class
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
		return 'evaluation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rateid, supplierid', 'required'),
			array('cotizacion, resolucionproblemas, impresion, acabados, empaque, distribucion, cumplimiento, enviodocumentacion, enviomuestras, comunicacion, disponibilidad, status', 'numerical', 'integerOnly'=>true),
			array('promedioservicio', 'numerical'),
			array('rateid', 'length', 'max'=>11),
			array('supplierid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('evaluationid, rateid, supplierid, cotizacion, resolucionproblemas, impresion, acabados, empaque, distribucion, cumplimiento, enviodocumentacion, enviomuestras, comunicacion, disponibilidad, status, promedioservicio', 'safe', 'on'=>'search'),
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
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplierid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'evaluationid' => 'Evaluationid',
			'rateid' => 'Rateid',
			'supplierid' => 'Supplierid',
			'cotizacion' => 'Cotizacion',
			'resolucionproblemas' => 'Resolucionproblemas',
			'impresion' => 'Impresion',
			'acabados' => 'Acabados',
			'empaque' => 'Empaque',
			'distribucion' => 'Distribucion',
			'cumplimiento' => 'Cumplimiento',
			'enviodocumentacion' => 'Enviodocumentacion',
			'enviomuestras' => 'Enviomuestras',
			'comunicacion' => 'Comunicacion',
			'disponibilidad' => 'Disponibilidad',
			'status' => 'Status',
			'promedioservicio' => 'Promedioservicio',
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

		$criteria->compare('evaluationid',$this->evaluationid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('supplierid',$this->supplierid,true);
		$criteria->compare('cotizacion',$this->cotizacion);
		$criteria->compare('resolucionproblemas',$this->resolucionproblemas);
		$criteria->compare('impresion',$this->impresion);
		$criteria->compare('acabados',$this->acabados);
		$criteria->compare('empaque',$this->empaque);
		$criteria->compare('distribucion',$this->distribucion);
		$criteria->compare('cumplimiento',$this->cumplimiento);
		$criteria->compare('enviodocumentacion',$this->enviodocumentacion);
		$criteria->compare('enviomuestras',$this->enviomuestras);
		$criteria->compare('comunicacion',$this->comunicacion);
		$criteria->compare('disponibilidad',$this->disponibilidad);
		$criteria->compare('status',$this->status);
		$criteria->compare('promedioservicio',$this->promedioservicio);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}