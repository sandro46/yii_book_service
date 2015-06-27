<?php

/**
 * This is the model class for table "zakazy".
 *
 * The followings are the available columns in table 'zakazy':
 * @property integer $id_z
 * @property integer $id_tovara_z
 * @property integer $col_tovara_z
 * @property integer $status_z
 */
class Zakazy extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'zakazy';
	}
	
	public function add($arrZak)
	{
		$transaction=$this->dbConnection->beginTransaction();
		foreach($arrZak as $id_b=>$col_b){
			try
			{
				// поиск и сохранение — шаги, между которыми могут быть выполнены другие запросы,
				// поэтому мы используем транзакцию, чтобы удостовериться в целостности данных
				
				Yii::app()->db->createCommand()
				->insert('zakazy', array('id_tovara_z'=>$id_b, "col_tovara_z"=>$col_b, "status_z"=>3));
				}
			catch(Exception $e)
			{
				$transaction->rollback();
				throw $e;
			}
		}
		$transaction->commit();
	}
	
	public function getAll()
	{
		// $sql = "SELECT title_b, id_b, isbn_b, prise_b, title_s, col_tovara_z, id_z 
		// FROM books 
		// JOIN zakazy ON id_tovara_z=id_b
		// JOIN statusy ON status_z=id_s";
		return Yii::app()->db->createCommand()
			->select("title_b, id_b, isbn_b, prise_b, title_s, col_tovara_z, id_z ")
			->from("books")
			->join('zakazy', 'id_tovara_z=id_b')
			->join('statusy', 'status_z=id_s')
			->queryAll();
	}
	
	public function oform($ids)
	{
		$transaction=$this->dbConnection->beginTransaction();
		foreach($ids as $id_z=>$col_b){
			try{
				Yii::app()->db->createCommand()
				->update('zakazy', array(
					'status_z'=>2,
				), 'id_z=:id', array(':id'=>$id_z));
			}
			catch(Exception $e)
			{
				$transaction->rollback();
				throw $e;
			}
		}
		$transaction->commit();
	}
	
	public function cancel($ids)
	{
		$transaction=$this->dbConnection->beginTransaction();
		foreach($ids as $id_z=>$col_b){
			try{
				Yii::app()->db->createCommand()
				->update('zakazy', array(
					'status_z'=>1,
				), 'id_z=:id', array(':id'=>$id_z));
			}
			catch(Exception $e)
			{
				$transaction->rollback();
				throw $e;
			}
		}
		$transaction->commit();
	}
	
	public function del($ids)
	{
		$transaction=$this->dbConnection->beginTransaction();
		foreach($ids as $id_z=>$col_b){
			try{
				Yii::app()->db->createCommand()
				->delete('zakazy', 'id_z=:id', array(':id'=>$id_z));
			}
			catch(Exception $e)
			{
				$transaction->rollback();
				throw $e;
			}
		}
		$transaction->commit();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tovara_z, col_tovara_z, status_z', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_z, id_tovara_z, col_tovara_z, status_z', 'safe', 'on'=>'search'),
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
			'id_z' => 'Id Z',
			'id_tovara_z' => 'Id Tovara Z',
			'col_tovara_z' => 'Col Tovara Z',
			'status_z' => 'Status Z',
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

		$criteria->compare('id_z',$this->id_z);
		$criteria->compare('id_tovara_z',$this->id_tovara_z);
		$criteria->compare('col_tovara_z',$this->col_tovara_z);
		$criteria->compare('status_z',$this->status_z);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Zakazy the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
