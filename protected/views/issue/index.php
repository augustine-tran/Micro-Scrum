<?php
$this->breadcrumbs=array(
	'Issues',
);

$this->menu=array(
	array('label'=>'Create Issue', 'url'=>array('create', 'pid'=>$this->getProject()->id)),
	array('label'=>'Manage Issue', 'url'=>array('admin', 'pid'=>$this->getProject()->id)),
);
?>
<?php 
//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//	'cssFile' => false
//)); 
?>
<div class="column">
	<div class="column-header">
		<h2>Back log</h2>
	</div>
	<div class="column-body">
<?php
$data = $dataProvider->getData();
if(count($data)>0):
	foreach($data as $i=>$item):
?>
		<div class="task">
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
endif;
?>
	</div><!-- end div.column-body -->
</div><!-- end div.column -->
		<div class="column">
			<div class="column-header">
				<h2>Done</h2>
			</div>
			<div class="column-body">
				<div class="task">
					<div class="task-header">
						<div class="task-label">
							<div class="task-type">Story</div>
							<div class="task-time">5</div>
						</div>
 						<div class="task-user">Khanh</div>
						<p class="task-title">Lorem Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
						<div class="task-status">
							<div class="panel">
								<div class="task-priority">Low</div>
								<a href="#" class="button-toggler"></a>
							</div>
						</div>
					</div>
					<div class="task-body" style="display: none;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis facilisis varius. Donec non odio vel enim imperdiet venenatis a eu nibh. Nulla sodales magna faucibus leo tempor adipiscing. Sed euismod hendrerit est eu aliquam.</div>
				</div>
				<div class="task">
					<div class="task-header">
						<div class="task-label">
							<div class="task-type">Story</div>
							<div class="task-time">5</div>
						</div>
 						<div class="task-user">Khanh</div>
						<p class="task-title">Lorem Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
						<div class="task-status">
							<div class="panel">
								<div class="task-priority">Low</div>
								<a href="#" class="button-toggler"></a>
							</div>
						</div>
					</div>
					<div class="task-body" style="display: none;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis facilisis varius. Donec non odio vel enim imperdiet venenatis a eu nibh. Nulla sodales magna faucibus leo tempor adipiscing. Sed euismod hendrerit est eu aliquam.</div>
				</div>
				<div class="task">
					<div class="task-header">
						<div class="task-label">
							<div class="task-type">Story</div>
							<div class="task-time">5</div>
						</div>
 						<div class="task-user">Khanh</div>
						<p class="task-title">Lorem Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
						<div class="task-status">
							<div class="panel">
								<div class="task-priority">Low</div>
								<a href="#" class="button-toggler"></a>
							</div>
						</div>
					</div>
					<div class="task-body" style="display: none;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis facilisis varius. Donec non odio vel enim imperdiet venenatis a eu nibh. Nulla sodales magna faucibus leo tempor adipiscing. Sed euismod hendrerit est eu aliquam.</div>
				</div>
			</div>
		</div>
		<div class="column">
			<div class="column-header">
				<h2>In progress</h2>
			</div>
			<div class="column-body">
			</div>
		</div>
		<div class="column">
			<div class="column-header">
				<h2>Done</h2>
			</div>
			<div class="column-body"></div>
		</div>
		<div class="column">
			<div class="column-header">
				<h2>Done</h2>
			</div>
			<div class="column-body">
				<div class="task">
					<div class="task-header">
						<div class="task-label">
							<div class="task-type">Story</div>
							<div class="task-time">5</div>
						</div>
 						<div class="task-user">Khanh</div>
						<p class="task-title">Lorem Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
						<div class="task-status">
							<div class="panel">
								<div class="task-priority">Low</div>
								<a href="#" class="button-toggler"></a>
							</div>
						</div>
					</div>
					<div class="task-body" style="display: none;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis facilisis varius. Donec non odio vel enim imperdiet venenatis a eu nibh. Nulla sodales magna faucibus leo tempor adipiscing. Sed euismod hendrerit est eu aliquam.</div>
				</div>
				<div class="task">
					<div class="task-header">
						<div class="task-label">
							<div class="task-type">Story</div>
							<div class="task-time">5</div>
						</div>
 						<div class="task-user">Khanh</div>
						<p class="task-title">Lorem Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
						<div class="task-status">
							<div class="panel">
								<div class="task-priority">Low</div>
								<a href="#" class="button-toggler"></a>
							</div>
						</div>
					</div>
					<div class="task-body" style="display: none;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis facilisis varius. Donec non odio vel enim imperdiet venenatis a eu nibh. Nulla sodales magna faucibus leo tempor adipiscing. Sed euismod hendrerit est eu aliquam.</div>
				</div>
				<div class="task">
					<div class="task-header">
						<div class="task-label">
							<div class="task-type">Story</div>
							<div class="task-time">5</div>
						</div>
 						<div class="task-user">Khanh</div>
						<p class="task-title">Lorem Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
						<div class="task-status">
							<div class="panel">
								<div class="task-priority">Low</div>
								<a href="#" class="button-toggler"></a>
							</div>
						</div>
					</div>
					<div class="task-body" style="display: none;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis facilisis varius. Donec non odio vel enim imperdiet venenatis a eu nibh. Nulla sodales magna faucibus leo tempor adipiscing. Sed euismod hendrerit est eu aliquam.</div>
		</div>
	</div>
</div>