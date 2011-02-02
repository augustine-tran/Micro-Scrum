<?php
$this->breadcrumbs=array(
	$project->name => array('project/' . $project->id),
	'Sprints'=>array('index'),
	'Scrum planning'
);
?>
<div id="sprint_planning" class="clearfix">

<div class="column">
	<div class="column-header">
		<h2>Product backlog</h2>
	</div>
	<div class="column-body" title="<?php echo $this->createUrl('project/moveTaskToBackLog', array('id' => $project->id))?>">
<?php
	foreach($project->getBacklogTasks() as $i=>$item):
?>
		<div class="task" id="task-<?php echo $item->id;?>">
			<div class="task-header">
				<div class="task-label">
					<div class="task-type"><?php echo CHtml::encode($item->getTypeText());?></div>
					<div class="task-time">5</div>
				</div>
 				<div class="task-user"><?php echo CHtml::encode($item->owner->username);?></div>
				<p class="task-title"><?php echo CHtml::encode($item->name);?></p>
				<div class="task-status">
					<div class="panel">
						<div class="task-priority">Low</div>
						<a href="#" class="button-toggler"></a>
					</div>
				</div>
			</div>
			<div class="task-body" style="display: none;">
				<div class="section"><?php echo CHtml::encode($item->description);?></div>
			</div>
		</div>
<?php 
	endforeach;
?>
	</div><!-- end div.column-body -->
</div><!-- end div.column -->

<!--  list of sprints -->
<?php
$sprints = $project->sprints;
foreach($sprints as $sprint):
?>
<div class="column">
	<div class="column-header">
		<h2><?php echo CHtml::encode($sprint->name);?></h2>
	</div>
	<div class="column-body" title="<?php echo $this->createUrl('sprint/assignTask', array('pid' => $project->id, 'id' => $sprint->id))?>">
	<?php foreach($sprint->getBacklogTasks() as $item):?>
		<div class="task" id="task-<?php echo $item->id;?>">
			<div class="task-header">
				<div class="task-label">
					<div class="task-type"><?php echo CHtml::encode($item->getTypeText());?></div>
					<div class="task-time">5</div>
				</div>
 				<div class="task-user"><?php echo CHtml::encode($item->owner->username);?></div>
				<p class="task-title"><?php echo CHtml::encode($item->name);?></p>
				<div class="task-status">
					<div class="panel">
						<div class="task-priority">Low</div>
						<a href="#" class="button-toggler"></a>
					</div>
				</div>
			</div>
			<div class="task-body" style="display: none;">
				<div class="section"><?php echo CHtml::encode($item->description);?></div>
			</div>
		</div>
	<?php endforeach;?>
	</div><!-- end div.column-body -->
</div><!-- end div.column -->
<?php 
endforeach; 
?>
</div><!-- end div#sprint_planning -->