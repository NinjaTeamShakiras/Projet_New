<?php
/* @var $this CompetencesCvController */
/* @var $data CompetencesCv */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_competence')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_competence), array('view', 'id'=>$data->id_competence)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nom_competence')); ?>:</b>
	<?php echo CHtml::encode($data->nom_competence); ?>
	<br />


</div>