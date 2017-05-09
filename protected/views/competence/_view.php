<?php
/* @var $this CompetenceController */
/* @var $data Competence */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_competence')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_competence), array('view', 'id'=>$data->id_competence)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intitule_competance')); ?>:</b>
	<?php echo CHtml::encode($data->intitule_competance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('niveau_competence')); ?>:</b>
	<?php echo CHtml::encode($data->niveau_competence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_employe); ?>
	<br />


</div>