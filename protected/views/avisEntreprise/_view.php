<?php
/* @var $this AvisEntrepriseController */
/* @var $data AvisEntreprise */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_avis_entreprise')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_avis_entreprise), array('view', 'id'=>$data->id_avis_entreprise)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note_generale_avis_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->note_generale_avis_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commentaire_avis_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->commentaire_avis_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->id_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_utilisateur')); ?>:</b>
	<?php echo CHtml::encode($data->id_utilisateur); ?>
	<br />


</div>