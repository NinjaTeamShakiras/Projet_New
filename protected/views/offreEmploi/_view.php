<?php
/* @var $this OffreEmploiController */
/* @var $data OffreEmploi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_offre_emploi')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_offre_emploi), array('view', 'id'=>$data->id_offre_emploi)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_creation_offre_emploi')); ?>:</b>
	<?php echo CHtml::encode($data->date_creation_offre_emploi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_offre_emploi')); ?>:</b>
	<?php echo CHtml::encode($data->type_offre_emploi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salaire_offre_emploi')); ?>:</b>
	<?php echo CHtml::encode($data->salaire_offre_emploi . ' €'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('experience_offre_emploi')); ?>:</b>
	<?php echo CHtml::encode($data->experience_offre_emploi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_offre_emploi')); ?>:</b>
	<?php echo CHtml::encode($data->description_offre_emploi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->id_entreprise); ?>
	<br />


</div>