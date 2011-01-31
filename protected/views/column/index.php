<?php
$this->breadcrumbs=array(
	'Columns',
);

$this->menu=array(
	array('label'=>'Create Column', 'url'=>array('create')),
	array('label'=>'Manage Column', 'url'=>array('admin')),
);
?>

<h1>Columns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
