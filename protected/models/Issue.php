<?php

/**
 * This is the model class for table "tbl_issue".
 */
class Issue extends TrackStarActiveRecord
{
	
	const TYPE_BUG=0;
	const TYPE_STORY=1;
	const TYPE_TASK=2;
	
	const PRIORITY_MUST_HAVE = 0;
	const PRIORITY_SHOULD_HAVE = 1;
	const PRIORITY_WOULD_HAVE = 2;
	
	const STATUS_NOT_STARTED=0;
	const STATUS_STARTED=1;
	const STATUS_FINISHED=2;
	
	/**
	 * The followings are the available columns in table 'tbl_issue':
	 * @var integer $id
	 * @var string $name
	 * @var string $description
	 * @var integer $project_id
	 * @var integer $type_id
	 * @var integer $status_id
	 * @var integer $sprint_id
	 * @var integer $owner_id
	 * @var integer $requester_id
	 * @var integer $point
	 * @var string $create_time
	 * @var integer $create_user_id
	 * @var string $update_time
	 * @var integer $update_user_id
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Issue the static model class
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
		return 'tbl_issue';
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
			array('project_id, type_id, status_id, owner_id, requester_id, priority_id, create_user_id, update_user_id, point', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			array('description', 'length', 'max'=>2000),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, project_id, sprint_id, column_id, point, priority_id, type_id, status_id, owner_id, requester_id, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'Issue', 'parent_id'),
			'owner' => array(self::BELONGS_TO, 'User', 'owner_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'requester' => array(self::BELONGS_TO, 'User', 'requester_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'issue_id'),
			'tasks' => array(self::HAS_MANY, 'Issue', 'parent_id'),
			'commentCount' => array(self::STAT, 'Comment', 'issue_id'),
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
			'description' => 'Description',
			'project_id' => 'Project',
			'sprint_id' => 'Sprint',
			'priority_id' => 'Priority',
			'type_id' => 'Type',
			'status_id' => 'Status',
			'column_id' => 'Column',
			'point' => 'Business Point',
			'owner_id' => 'Owner',
			'requester_id' => 'Requester',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'parent_id' => 'Parent',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
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

		$criteria->compare('id',$this->id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('description',$this->description,true);

		$criteria->compare('type_id',$this->type_id);

		$criteria->compare('status_id',$this->status_id);

		$criteria->compare('owner_id',$this->owner_id);

		$criteria->compare('requester_id',$this->requester_id);

		$criteria->compare('create_time',$this->create_time,true);

		$criteria->compare('create_user_id',$this->create_user_id);

		$criteria->compare('update_time',$this->update_time,true);

		$criteria->compare('update_user_id',$this->update_user_id);
		
		$criteria->condition='project_id=:projectID';
		
		$criteria->params=array(':projectID'=>$this->project_id);
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * @return array issue type names indexed by type IDs
	 */
	public function getTypeOptions()
	{
		return array(
				self::TYPE_BUG=>'Bug',
				self::TYPE_STORY=>'Story',
				self::TYPE_TASK=>'Task',
		);
		
	}
	
	/**
	 * @return array issue status names indexed by status IDs
	 */
	public function getStatusOptions()
	{
		return array(  
			self::STATUS_NOT_STARTED=>'Not Yet Started',
			self::STATUS_STARTED=>'Started',
			self::STATUS_FINISHED=>'Finished',
		);
	}
	
	public function getPriorityOptions()
	{
		return array(  
			self::PRIORITY_MUST_HAVE => 'Must have',
			self::PRIORITY_SHOULD_HAVE => 'Should have',
			self::PRIORITY_WOULD_HAVE => 'Would have',
		);
	}
	
	/**
	 * @return string the status text display for the current issue
	 */ 
	public function getStatusText()
	{
		$statusOptions=$this->statusOptions;
		return isset($statusOptions[$this->status_id]) ? $statusOptions[$this->status_id] : "unknown status ({$this->status_id})";
	}
	
	public function getPriorityText()
	{
		$priorityOptions=$this->priorityOptions;
		return isset($priorityOptions[$this->priority_id]) ? $priorityOptions[$this->priority_id] : "unknown priority ({$this->priority_id})";
	}

	/**
	 * @return string the type text display for the current issue
	 */ 
	public function getTypeText()
	{
		$typeOptions=$this->typeOptions;
		return isset($typeOptions[$this->type_id]) ? $typeOptions[$this->type_id] : "unknown type ({$this->type_id})";
	}
	
	/**
	 * Adds a comment to this issue
	 */
	public function addComment($comment)
	{
		$comment->issue_id=$this->id;
		return $comment->save();
	}
	
	
	
}