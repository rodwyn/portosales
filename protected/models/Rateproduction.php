<?php

/**
 * This is the model class for table "rateproduction".
 *
 * The followings are the available columns in table 'rateproduction':
 * @property string $rateproductionid
 * @property string $rateid
 * @property string $authorizationdate
 * @property string $authorized
 * @property string $datetimeproduction
 * @property string $filetype
 * @property integer $color
 * @property integer $record
 * @property integer $piojos
 * @property integer $banded
 * @property string $quantity
 * @property integer $font
 * @property integer $text
 * @property integer $uvrecord
 * @property integer $uvcake
 * @property integer $splice
 * @property integer $laminate
 * @property integer $measures
 * @property integer $reline
 * @property integer $suaje
 * @property integer $paste
 * @property integer $refine
 * @property integer $fold
 * @property integer $images
 * @property integer $inks
 * @property integer $staple
 * @property integer $hotmelt
 * @property integer $maquilas
 * @property string $printing
 * @property string $revisedsamples
 * @property string $authorizationproduccion
 * @property string $authorizationdate2
 * @property string $comments
 *
 * The followings are the available model relations:
 * @property Rate $rate
 */
class Rateproduction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rateproduction the static model class
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
		return 'rateproduction';
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
			array('color, record, piojos, banded, font, text, uvrecord, uvcake, splice, laminate, measures, reline, suaje, paste, refine, fold, images, inks, staple, hotmelt, maquilas', 'numerical', 'integerOnly'=>true),
			array('rateid', 'length', 'max'=>11),
			array('authorized, datetimeproduction, filetype, quantity, printing, revisedsamples, authorizationproduccion, comments', 'length', 'max'=>100),
			array('authorizationdate, authorizationdate2', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rateproductionid, rateid, authorizationdate, authorized, datetimeproduction, filetype, color, record, piojos, banded, quantity, font, text, uvrecord, uvcake, splice, laminate, measures, reline, suaje, paste, refine, fold, images, inks, staple, hotmelt, maquilas, printing, revisedsamples, authorizationproduccion, authorizationdate2, comments', 'safe', 'on'=>'search'),
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
			'rateproductionid' => 'Rateproductionid',
			'rateid' => 'Rateid',
			'authorizationdate' => 'Authorizationdate',
			'authorized' => 'Authorized',
			'datetimeproduction' => 'Datetimeproduction',
			'filetype' => 'Filetype',
			'color' => 'Color',
			'record' => 'Record',
			'piojos' => 'Piojos',
			'banded' => 'Banded',
			'quantity' => 'Quantity',
			'font' => 'Font',
			'text' => 'Text',
			'uvrecord' => 'Uvrecord',
			'uvcake' => 'Uvcake',
			'splice' => 'Splice',
			'laminate' => 'Laminate',
			'measures' => 'Measures',
			'reline' => 'Reline',
			'suaje' => 'Suaje',
			'paste' => 'Paste',
			'refine' => 'Refine',
			'fold' => 'Fold',
			'images' => 'Images',
			'inks' => 'Inks',
			'staple' => 'Staple',
			'hotmelt' => 'Hotmelt',
			'maquilas' => 'Maquilas',
			'printing' => 'Printing',
			'revisedsamples' => 'Revisedsamples',
			'authorizationproduccion' => 'Authorizationproduccion',
			'authorizationdate2' => 'Authorizationdate2',
			'comments' => 'Comments',
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

		$criteria->compare('rateproductionid',$this->rateproductionid,true);
		$criteria->compare('rateid',$this->rateid,true);
		$criteria->compare('authorizationdate',$this->authorizationdate,true);
		$criteria->compare('authorized',$this->authorized,true);
		$criteria->compare('datetimeproduction',$this->datetimeproduction,true);
		$criteria->compare('filetype',$this->filetype,true);
		$criteria->compare('color',$this->color);
		$criteria->compare('record',$this->record);
		$criteria->compare('piojos',$this->piojos);
		$criteria->compare('banded',$this->banded);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('font',$this->font);
		$criteria->compare('text',$this->text);
		$criteria->compare('uvrecord',$this->uvrecord);
		$criteria->compare('uvcake',$this->uvcake);
		$criteria->compare('splice',$this->splice);
		$criteria->compare('laminate',$this->laminate);
		$criteria->compare('measures',$this->measures);
		$criteria->compare('reline',$this->reline);
		$criteria->compare('suaje',$this->suaje);
		$criteria->compare('paste',$this->paste);
		$criteria->compare('refine',$this->refine);
		$criteria->compare('fold',$this->fold);
		$criteria->compare('images',$this->images);
		$criteria->compare('inks',$this->inks);
		$criteria->compare('staple',$this->staple);
		$criteria->compare('hotmelt',$this->hotmelt);
		$criteria->compare('maquilas',$this->maquilas);
		$criteria->compare('printing',$this->printing,true);
		$criteria->compare('revisedsamples',$this->revisedsamples,true);
		$criteria->compare('authorizationproduccion',$this->authorizationproduccion,true);
		$criteria->compare('authorizationdate2',$this->authorizationdate2,true);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}