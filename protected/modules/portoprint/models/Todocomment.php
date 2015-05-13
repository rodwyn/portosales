<?php

/**
 * This is the model class for table "todocomment".
 *
 * The followings are the available columns in table 'todocomment':
 * @property integer $commentid
 * @property integer $todoid
 * @property integer $userid
 * @property string $comment
 * @property string $cdate
 *
 * The followings are the available model relations:
 * @property Todo $todo
 * @property User $user
 */
class Todocomment extends CActiveRecord {
    public $responsable;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Todocomment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'todocomment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('todoid, userid, comment', 'required'),
            array('todoid, userid', 'numerical', 'integerOnly' => true),
            array('comment', 'length', 'max' => 256),
            array('cdate', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('commentid, todoid, userid, comment, cdate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'todo' => array(self::BELONGS_TO, 'Todo', 'todoid'),
            'user' => array(self::BELONGS_TO, 'User', 'userid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'commentid' => 'Commentid',
            'todoid' => 'Todoid',
            'userid' => 'Userid',
            'comment' => 'Comment',
            'cdate' => 'Cdate',
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

        $criteria->compare('commentid', $this->commentid);
        $criteria->compare('todoid', $this->todoid);
        $criteria->compare('userid', $this->userid);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('cdate', $this->cdate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function hcomment($todoid) {
        $criteria = new CDbCriteria();

        $criteria->select = "t.cdate,t.comment,
        CONCAT(
        if(eu.firstname is null,if(cu.firstname is null,if(su.firstname is null,'',su.firstname),cu.firstname),eu.firstname),' ',
        if(eu.plastname is null,if(cu.plastname is null,if(su.plastname is null,'',su.plastname),cu.plastname),eu.plastname),' ',
        if(eu.mlastname is null,if(cu.mlastname is null,if(su.mlastname is null,'',su.mlastname),cu.mlastname),eu.mlastname))as responsable";
        $criteria->join = "left join employeeuser eu on eu.userid = t.userid
        left join customeruser cu on cu.userid = t.userid
        left join supplieruser su on su.userid = t.userid ";

        $criteria->condition = "todoid = " . $todoid;

        $result = $this->findAll($criteria);
        $cont = 0;
        if (count($result) > 0) {
            foreach ($result as $row) {
                $output[$cont]['dat'] = $row->cdate;
                $output[$cont]['usr'] = $row->responsable;
                $output[$cont]['com'] = $row->comment;

                $cont = $cont + 1;
            }
        } else {
            $output = 0;
        }
        $output = array('aaData' => $output);

        return $output;
    }

}
