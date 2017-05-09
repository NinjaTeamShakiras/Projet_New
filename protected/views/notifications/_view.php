<?php
/* @var $this NotificationsController */
/* @var $data Notifications */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_notifcation')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_notifcation), array('view', 'id'=>$data->id_notifcation)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('texte_descriptif')); ?>:</b>
	<?php echo CHtml::encode($data->texte_descriptif); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_utilisateur')); ?>:</b>
	<?php echo CHtml::encode($data->id_utilisateur); ?>
	<br />


</div>