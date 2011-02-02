<?php
/**
 * SprintIssueForm class.
 * SprintIssueForm is the data structure for keeping
 * the form data related to adding an existing user to a project. It is used by the 'Adduser' action of 'ProjectController'.
 */
class SprintIssueForm extends CFormModel
{
	/**
	 * @var object sprint
	 */
	public $sprint;
	
	/**
	 * @var object project
	 */
	public $project; 
	
	/**
	 * @var string itemId has format task-(\d+)
	 */ 
	public $itemId;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated using the verify() method
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('itemId', 'required'),
			// password needs to be authenticated
			//array('username', 'verify'),
			array('itemId', 'verify'),
		);
	}

	
	/**
	 * Authenticates the existence of the user in the system.
	 * If valid, it will also make the association between the user, role and project
	 * This is the 'verify' validator as declared in rules().
	 */
	public function verify($attribute,$params)
	{
		if(!$this->hasErrors())  // we only want to authenticate when no other input errors are present
		{
			$taskId = $this->parseTaskId();
			$task = Issue::model()->findByPk($taskId);
			$task->sprint_id = $this->sprint == null ? null : $this->sprint->id;
			$task->save();
		}
	}
	
	public function parseTaskId() {
		$matches = array();
		if (preg_match('/task-(\d+)/', $this->itemId, $matches)) {
			return $matches[1];
		}
		throw new Excetpion('Can not find taskId from this text: ' . $this->itemId);
	}
}
