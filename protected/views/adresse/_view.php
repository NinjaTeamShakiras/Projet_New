<?php
/* @var $this AdresseController */
/* @var $data Adresse */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_adresse')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_adresse), array('view', 'id'=>$data->id_adresse)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rue')); ?>:</b>
	<?php echo CHtml::encode($data->rue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ville')); ?>:</b>
	<?php echo CHtml::encode($data->ville); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code_postal')); ?>:</b>
	<?php echo CHtml::encode($data->code_postal); ?>
	<br />


</div>