<?php
/* @var $this FormationController */
/* @var $data Formation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_formation')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_formation), array('view', 'id'=>$data->id_formation)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_debut_formation')); ?>:</b>
	<?php echo CHtml::encode($data->date_debut_formation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_fin_formation')); ?>:</b>
	<?php echo CHtml::encode($data->date_fin_formation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intitule_formation')); ?>:</b>
	<?php echo CHtml::encode($data->intitule_formation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etablissement_formation')); ?>:</b>
	<?php echo CHtml::encode($data->etablissement_formation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diplome_formation')); ?>:</b>
	<?php echo CHtml::encode($data->diplome_formation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_formation')); ?>:</b>
	<?php echo CHtml::encode($data->description_formation); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_employe); ?>
	<br />

	*/ ?>

</div>