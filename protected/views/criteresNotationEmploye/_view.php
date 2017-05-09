<?php
/* @var $this CriteresNotationEmployeController */
/* @var $data CriteresNotationEmploye */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_critere_employe')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_critere_employe), array('view', 'id'=>$data->id_critere_employe)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nom_critere_employe')); ?>:</b>
	<?php echo CHtml::encode($data->nom_critere_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('critere_note')); ?>:</b>
	<?php echo CHtml::encode($data->critere_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_critere')); ?>:</b>
	<?php echo CHtml::encode($data->description_critere); ?>
	<br />


</div>