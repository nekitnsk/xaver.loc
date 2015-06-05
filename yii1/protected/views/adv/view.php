<?php
/* @var $this AdvController */
/* @var $model Adv */

$this->breadcrumbs=array(
	'Advs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Adv', 'url'=>array('index')),
	array('label'=>'Create Adv', 'url'=>array('create')),
	array('label'=>'Update Adv', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Adv', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Adv', 'url'=>array('admin')),
);
?>

<h1>View Adv #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'text',
	),
)); ?>
