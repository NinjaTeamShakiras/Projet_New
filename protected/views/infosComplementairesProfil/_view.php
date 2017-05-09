<?php
/* @var $this InfosComplementairesProfilController */
/* @var $data InfosComplementairesProfil */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_info')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_info), array('view', 'id'=>$data->id_info)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nom_info')); ?>:</b>
	<?php echo CHtml::encode($data->nom_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personne_concernee')); ?>:</b>
	<?php echo CHtml::encode($data->personne_concernee); ?>
	<br />


</div>