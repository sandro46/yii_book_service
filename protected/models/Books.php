<?php

/**
 * This is the model class for table "books".
 *
 * The followings are the available columns in table 'books':
 * @property integer $id_b
 * @property string $title_b
 * @property string $desc_b
 * @property string $isbn_b
 * @property string $author_b
 * @property integer $col_pages_b
 */
class Books extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'books';
	}
	
	public function getAll()
	{
		return $this->findAll();
	}
	
	public function booksByPk($ids)
	{
		return $this->findAllByPk($ids);
	}
	
	public function searchB($title, $author)
	{
		if($title!=''){
			$sql = "SELECT * FROM books WHERE ";
			$sql .= " title_b LIKE '%".$_GET["title_b"]."%'";
			return $this->findAllBySql($sql);
		}elseif($author!=''){
			$sql = "SELECT * FROM books WHERE ";
			$sql .= " author_b LIKE '%".$_GET["author_b"]."%'";
			return $this->findAllBySql($sql);
		}else return $this->getAll();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('col_pages_b', 'numerical', 'integerOnly'=>true),
			array('title_b, isbn_b, author_b', 'length', 'max'=>255),
			array('desc_b', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_b, title_b, desc_b, isbn_b, author_b, col_pages_b', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_b' => 'Id B',
			'title_b' => 'Title B',
			'desc_b' => 'Desc B',
			'isbn_b' => 'Isbn B',
			'author_b' => 'Author B',
			'col_pages_b' => 'Col Pages B',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_b',$this->id_b);
		$criteria->compare('title_b',$this->title_b,true);
		$criteria->compare('desc_b',$this->desc_b,true);
		$criteria->compare('isbn_b',$this->isbn_b,true);
		$criteria->compare('author_b',$this->author_b,true);
		$criteria->compare('col_pages_b',$this->col_pages_b);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Books the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
