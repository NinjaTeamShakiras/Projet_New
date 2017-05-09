<?php
/* @var $this TravailleController */
/* @var $data Travaille */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_travaille')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_travaille), array('view', 'id'=>$data->id_travaille)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_debut_contrat')); ?>:</b>
	<?php echo CHtml::encode($data->date_debut_contrat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_fin_contrat')); ?>:</b>
	<?php echo CHtml::encode($data->date_fin_contrat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duree_contrat')); ?>:</b>
	<?php echo CHtml::encode($data->duree_contrat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_entreprise')); ?>:</b>
	<?php echo CHtml::encode($data->id_entreprise); ?>
	<br />


</div>