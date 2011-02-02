<?php

/**
 * This is the model class for table "tbl_sprint".
 *
 * The followings are the available columns in table 'tbl_sprint':
 * @property string $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property integer $sort
 * @property integer $project_id
 * @property integer $status
 */
class Sprint extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Sprint the static model class
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
		return 'tbl_sprint';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, project_id', 'required'),
			array('sort, project_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('start_date, end_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, start_date, end_date, sort, project_id, status', 'safe', 'on'=>'search'),
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
			'issues' => array(self::HAS_MANY, 'Issue', 'sprint_id'),
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
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'sort' => 'Sort',
			'project_id' => 'Project',
			'status' => 'Status',
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
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function getBacklogTasks() {
		$dataProvider=new CActiveDataProvider('Issue', array(
			'criteria'=>array(
		 		'condition'=>'sprint_id=:sprintId AND column_id IS NULL ',
		 		'params'=>array(':sprintId'=>$this->id),
		 	), 
		));
		return $dataProvider->getData();
	}
}