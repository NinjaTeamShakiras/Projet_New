<?php
/* @var $this CriteresNotationEntrepriseController */
/* @var $data CriteresNotationEntreprise */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_critere_entreprise')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_critere_entreprise), array('view', 'id'=>$data->id_critere_entreprise)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nom_critere_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->nom_critere_entreprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('critere_note')); ?>:</b>
	<?php echo CHtml::encode($data->critere_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_critere')); ?>:</b>
	<?php echo CHtml::encode($data->description_critere); ?>
	<br />


</div>