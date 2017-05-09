<?php
/* @var $this EntrepriseController */
/* @var $data Entreprise */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_entreprise')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_entreprise), array('view', 'id'=>$data->id_entreprise)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nom_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->nom_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_employes')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_employes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recherche_employes')); ?>:</b>
	<?php echo CHtml::encode($data->recherche_employes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->telephone_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('secteur_active_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->secteur_active_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anne_creation_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->anne_creation_entreprise); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('age_moyen_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->age_moyen_entreprise); ?>
	<br />

	*/ ?>

</div>