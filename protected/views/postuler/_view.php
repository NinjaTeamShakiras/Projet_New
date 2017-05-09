<?php
/* @var $this PostulerController */
/* @var $data Postuler */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_postuler')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_postuler), array('view', 'id'=>$data->id_postuler)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_offre_emploi')); ?>:</b>
	<?php echo CHtml::encode($data->id_offre_emploi); ?>
	<br />


</div>