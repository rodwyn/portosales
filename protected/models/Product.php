<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $productid
 * @property integer $categoryid
 * @property string $name
 * @property string $description
 * @property string $barcode
 * @property string $sku
 * @property string $image
 * @property string $listprice
 * @property string $auctionprice
 * @property string $state
 * @property string $reference
 * @property string $createdate
 * @property integer $creator
 * @property string $editdate
 * @property integer $editor
 * @property integer $corporateid
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Corporate $corporate
 * @property User $editor0
 * @property User $creator0
 * @property Sales[] $sales
 * @property Company[] $companies
 * @property Transfer[] $transfers
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, barcode, listprice, corporateid', 'required'),
			array('categoryid, creator, editor, corporateid, active', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('description', 'length', 'max'=>140),
			array('barcode, sku', 'length', 'max'=>16),
			array('image', 'length', 'max'=>128),
			array('listprice, auctionprice', 'length', 'max'=>9),
			array('state', 'length', 'max'=>1),
			array('reference', 'length', 'max'=>19),
			array('createdate, editdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productid, categoryid, name, description, barcode, sku, image, listprice, auctionprice, state, reference, createdate, creator, editdate, editor, corporateid, active', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'categoryid'),
			'corporate' => array(self::BELONGS_TO, 'Corporate', 'corporateid'),
			'editor0' => array(self::BELONGS_TO, 'User', 'editor'),
			'creator0' => array(self::BELONGS_TO, 'User', 'creator'),
			'sales' => array(self::MANY_MANY, 'Sales', 'saleproduct(productid, salesid)'),
			'companies' => array(self::MANY_MANY, 'Company', 'stock(productid, companyid)'),
			'transfers' => array(self::MANY_MANY, 'Transfer', 'transferproduct(productid, transferid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productid' => 'Productid',
			'categoryid' => 'Categoryid',
			'name' => 'Name',
			'description' => 'Description',
			'barcode' => 'Barcode',
			'sku' => 'Sku',
			'image' => 'Image',
			'listprice' => 'Listprice',
			'auctionprice' => 'Auctionprice',
			'state' => 'State',
			'reference' => 'Reference',
			'createdate' => 'Createdate',
			'creator' => 'Creator',
			'editdate' => 'Editdate',
			'editor' => 'Editor',
			'corporateid' => 'Corporateid',
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

		$criteria->compare('productid',$this->productid);
		$criteria->compare('categoryid',$this->categoryid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('listprice',$this->listprice,true);
		$criteria->compare('auctionprice',$this->auctionprice,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('creator',$this->creator);
		$criteria->compare('editdate',$this->editdate,true);
		$criteria->compare('editor',$this->editor);
		$criteria->compare('corporateid',$this->corporateid);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}