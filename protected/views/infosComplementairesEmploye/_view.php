<?php
/* @var $this InfosComplementairesEmployeController */
/* @var $data InfosComplementairesEmploye */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_info_employe')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_info_employe), array('view', 'id'=>$data->id_info_employe)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_info')); ?>:</b>
	<?php echo CHtml::encode($data->description_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_info_profil')); ?>:</b>
	<?php echo CHtml::encode($data->id_info_profil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_employe); ?>
	<br />


</div>