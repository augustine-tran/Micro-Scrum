<?php
$this->breadcrumbs=array(
	'Columns'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Column', 'url'=>array('index')),
	array('label'=>'Manage Column', 'url'=>array('admin')),
);
?>

<h1>Create Column</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>