<?php
/* @var $this AdvController */
/* @var $model Adv */

$this->breadcrumbs=array(
	'Advs'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Adv', 'url'=>array('index')),
	array('label'=>'Create Adv', 'url'=>array('create')),
	array('label'=>'View Adv', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Adv', 'url'=>array('admin')),
);
?>

<h1>Update Adv <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>