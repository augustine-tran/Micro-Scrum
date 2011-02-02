<?php
$this->breadcrumbs=array(
	'Sprints'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sprint', 'url'=>array('index')),
	array('label'=>'Create Sprint', 'url'=>array('create')),
	array('label'=>'View Sprint', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sprint', 'url'=>array('admin')),
);
?>

<h1>Update Sprint <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>