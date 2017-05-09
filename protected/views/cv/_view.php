<?php
/* @var $this CvController */
/* @var $data Cv */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_CV')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_CV), array('view', 'id'=>$data->id_CV)); ?>
	<br />


</div>