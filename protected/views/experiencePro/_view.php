<?php
/* @var $this ExperienceProController */
/* @var $data ExperiencePro */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_experience')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_experience), array('view', 'id'=>$data->id_experience)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_debut_experience')); ?>:</b>
	<?php echo CHtml::encode($data->date_debut_experience); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_fin_experience')); ?>:</b>
	<?php echo CHtml::encode($data->date_fin_experience); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intitule_experience')); ?>:</b>
	<?php echo CHtml::encode($data->intitule_experience); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entreprise_experience')); ?>:</b>
	<?php echo CHtml::encode($data->entreprise_experience); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_experience')); ?>:</b>
	<?php echo CHtml::encode($data->description_experience); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_employe); ?>
	<br />


</div>