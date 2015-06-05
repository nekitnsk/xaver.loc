<?php
/* @var $this AdvController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Advs',
);

$this->menu=array(
	array('label'=>'Create Adv', 'url'=>array('create')),
	array('label'=>'Manage Adv', 'url'=>array('admin')),
);
?>

<h1>Advs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
