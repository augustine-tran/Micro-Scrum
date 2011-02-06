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
		<div class="sprint-point" title="<?php echo $this->createUrl('project/refreshPoint', array('id' => $sprint->id))?>"><span class="backlog-point"><?php echo CHtml::encode($project->getProductBacklogPoint());?></span></div>
	</div>
	<div class="column-body" title="<?php echo $this->createUrl('project/moveTaskToBackLog', array('id' => $project->id))?>">
<?php
	foreach($project->getBacklogTasks() as $i=>$item):
?>
		<div class="task" id="task-<?php echo $item->id;?>">
			<div class="task-header">
				<div class="task-label">
					<div id="priority_id-<?php echo $item->id;?>" class="task-priority priority-<?php echo $item->priority_id?>"><?php echo CHtml::encode($item->getPriorityText());?></div>
					<div class="task-time"><?php echo CHtml::encode($item->point);?></div>
				</div>
 				<div class="task-user"><?php echo CHtml::encode($item->owner->username);?></div>
				<p id="name-<?php echo $item->id;?>" class="task-title"><?php echo nl2br(CHtml::encode($item->name));?></p>
				<div class="task-status">
					<div class="panel">
						<div class="task-tag"></div>
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
		<div class="sprint-point" title="<?php echo $this->createUrl('sprint/refreshPoint', array('id' => $sprint->id))?>"><a href="<?php echo $this->createUrl('sprint/burnDownChart', array('id' => $sprint->id))?>" rel="#overlay" class="ajaxLoad finished-point"><span ><?php echo CHtml::encode($sprint->getFinishedPoint());?></span></a>/<span class="backlog-point"><?php echo CHtml::encode($sprint->getBacklogPoint());?></span></div>
	</div>
	<div class="column-body" title="<?php echo $this->createUrl('sprint/assignTask', array('pid' => $project->id, 'id' => $sprint->id))?>">
	<?php foreach($sprint->getBacklogTasks() as $item):?>
		<div class="task" id="task-<?php echo $item->id;?>">
			<div class="task-header">
				<div class="task-label">
					<div id="priority_id-<?php echo $item->id;?>" class="task-priority priority-<?php echo $item->priority_id?>"><?php echo CHtml::encode($item->getPriorityText());?></div>
					<div id="point-<?php echo $item->id;?>" class="task-time" title="<?php echo $this->createUrl('issue/quickUpdate', array('id' => $item->id))?>"><?php echo CHtml::encode($item->point);?></div>
				</div>
 				<div class="task-user"><?php echo CHtml::encode($item->owner->username);?></div>
				<p id="name-<?php echo $item->id;?>" class="task-title"><?php echo nl2br(CHtml::encode($item->name));?></p>
				<div class="task-status">
					<div class="pane">
						<div class="task-tag"></div>
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