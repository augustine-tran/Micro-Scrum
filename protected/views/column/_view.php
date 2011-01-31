<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('column_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->column_id), array('view', 'id'=>$data->column_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>