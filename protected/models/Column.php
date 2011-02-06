<?php

/**
 * This is the model class for table "tbl_column".
 *
 * The followings are the available columns in table 'tbl_column':
 * @property string $id
 * @property string $name
 */
class Column extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Column the static model class
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
		return 'tbl_column';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'issues' => array(self::HAS_MANY, 'Issue', 'column_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTotalPoint($sprintId) {
		$sql = "SELECT sum(point) as p FROM tbl_issue WHERE column_id=:columnId AND sprint_id = :sprintId ";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":sprintId", $sprintId, PDO::PARAM_INT);
		$command->bindValue(":columnId", $this->id, PDO::PARAM_INT);
		$reader = $command->query();
		$result = $reader->read();
		return $result['p'];
	}
	
	public function getTasks($sprintId) {
		$dataProvider=new CActiveDataProvider('Issue', array(
			'criteria'=>array(
		 		'condition'=>'sprint_id=:sprintId AND column_id IS NULL ',
		 		'params'=>array(':sprintId'=>$this->id),
		 	), 
		));
		return $dataProvider->getData();
	}
}