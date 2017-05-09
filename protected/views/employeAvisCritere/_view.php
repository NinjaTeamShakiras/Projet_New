<?php
/* @var $this EmployeAvisCritereController */
/* @var $data EmployeAvisCritere */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe_avis')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_employe_avis), array('view', 'id'=>$data->id_employe_avis)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note_employe_avis')); ?>:</b>
	<?php echo CHtml::encode($data->note_employe_avis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->id_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_critere_notation_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_critere_notation_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_avis_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_avis_employe); ?>
	<br />


</div>