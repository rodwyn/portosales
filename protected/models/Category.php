<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $categoryid
 * @property string $name
 * @property integer $parentid
 * @property string $createdate
 * @property integer $creator
 * @property string $editdate
 * @property integer $editor
 * @property integer $active
 * @property integer $corporateid
 *
 * The followings are the available model relations:
 * @property User $creator0
 * @property User $editor0
 * @property Corporate $corporate
 * @property Product[] $products
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, corporateid', 'required'),
			array('parentid, creator, editor, active, corporateid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('createdate, editdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('categoryid, name, parentid, createdate, creator, editdate, editor, active, corporateid', 'safe', 'on'=>'search'),
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
			'creator0' => array(self::BELONGS_TO, 'User', 'creator'),
			'editor0' => array(self::BELONGS_TO, 'User', 'editor'),
			'corporate' => array(self::BELONGS_TO, 'Corporate', 'corporateid'),
			'products' => array(self::HAS_MANY, 'Product', 'categoryid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'categoryid' => 'Categoryid',
			'name' => 'Name',
			'parentid' => 'Parentid',
			'createdate' => 'Createdate',
			'creator' => 'Creator',
			'editdate' => 'Editdate',
			'editor' => 'Editor',
			'active' => 'Active',
			'corporateid' => 'Corporateid',
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

		$criteria->compare('categoryid',$this->categoryid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('parentid',$this->parentid);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('creator',$this->creator);
		$criteria->compare('editdate',$this->editdate,true);
		$criteria->compare('editor',$this->editor);
		$criteria->compare('active',$this->active);
		$criteria->compare('corporateid',$this->corporateid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}