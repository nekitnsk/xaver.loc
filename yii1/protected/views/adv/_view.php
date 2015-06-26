<?php
/* @var $this AdvController */
/* @var $data Adv */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Номер')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Название')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Описание')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />


</div>