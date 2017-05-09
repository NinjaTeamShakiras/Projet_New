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

	<b><?php echo CHtml::encode($data->getAttributeLabel('recherche_employes')); ?>:</b>
	<?php echo CHtml::encode($data->recherche_employes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->telephone_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_adresse')); ?>:</b>
	<?php echo CHtml::encode($data->id_adresse); ?>
	<br />


</div>