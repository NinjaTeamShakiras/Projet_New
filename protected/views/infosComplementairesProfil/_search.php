<?php
/* @var $this InfosComplementairesProfilController */
/* @var $model InfosComplementairesProfil */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_info'); ?>
		<?php echo $form->textField($model,'id_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nom_info'); ?>
		<?php echo $form->textField($model,'nom_info',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'personne_concernee'); ?>
		<?php echo $form->textField($model,'personne_concernee',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->