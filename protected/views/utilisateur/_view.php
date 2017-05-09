<?php
/* @var $this UtilisateurController */
/* @var $data Utilisateur */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_utilisateur')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_utilisateur), array('view', 'id'=>$data->id_utilisateur)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mail')); ?>:</b>
	<?php echo CHtml::encode($data->mail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mot_de_passe')); ?>:</b>
	<?php echo CHtml::encode($data->mot_de_passe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role')); ?>:</b>
	<?php echo CHtml::encode($data->role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_creation_utilisateur')); ?>:</b>
	<?php echo CHtml::encode($data->date_creation_utilisateur); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_derniere_connexion')); ?>:</b>
	<?php echo CHtml::encode($data->date_derniere_connexion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
	<?php echo CHtml::encode($data->telephone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone2')); ?>:</b>
	<?php echo CHtml::encode($data->telephone2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->id_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_web')); ?>:</b>
	<?php echo CHtml::encode($data->site_web); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_adresse')); ?>:</b>
	<?php echo CHtml::encode($data->id_adresse); ?>
	<br />

	*/ ?>

</div>