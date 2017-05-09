<?php
/* @var $this CvEmployeController */
/* @var $data CvEmploye */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cv_employe')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_cv_employe), array('view', 'id'=>$data->id_cv_employe)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('niveau_competence')); ?>:</b>
	<?php echo CHtml::encode($data->niveau_competence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employe')); ?>:</b>
	<?php echo CHtml::encode($data->id_employe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_competence')); ?>:</b>
	<?php echo CHtml::encode($data->id_competence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cv')); ?>:</b>
	<?php echo CHtml::encode($data->id_cv); ?>
	<br />


</div>