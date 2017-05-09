<?php
/* @var $this InfosComplementairesEntrepriseController */
/* @var $data InfosComplementairesEntreprise */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_info_entreprise')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_info_entreprise), array('view', 'id'=>$data->id_info_entreprise)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_info')); ?>:</b>
	<?php echo CHtml::encode($data->description_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_info_profil')); ?>:</b>
	<?php echo CHtml::encode($data->id_info_profil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->id_entreprise); ?>
	<br />


</div>