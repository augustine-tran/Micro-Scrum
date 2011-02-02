<?php
$this->breadcrumbs=array(
	'Sprints'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Sprint', 'url'=>array('index')),
	array('label'=>'Create Sprint', 'url'=>array('create')),
	array('label'=>'Update Sprint', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sprint', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sprint', 'url'=>array('admin')),
);
?>

<h1>View Sprint #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'start_date',
		'end_date',
		'sort',
		'project_id',
		'status',
	),
)); ?>
