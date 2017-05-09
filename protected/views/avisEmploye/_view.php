<?php
/* @var $this AvisEmployeController */
/* @var $data AvisEmploye */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_avis_employe')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_avis_employe), array('view', 'id'=>$data->id_avis_employe)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note_generale_avis_employe')); ?>:</b>
	<?php echo CHtml::encode($data->note_generale_avis_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_creation_avis_employe')); ?>:</b>
	<?php echo CHtml::encode($data->date_creation_avis_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nb_signalements_avis_employe')); ?>:</b>
	<?php echo CHtml::encode($data->nb_signalements_avis_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_utilisateur')); ?>:</b>
	<?php echo CHtml::encode($data->id_utilisateur); ?>
	<br />


</div>