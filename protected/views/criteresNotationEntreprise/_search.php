<?php
/* @var $this CriteresNotationEntrepriseController */
/* @var $model CriteresNotationEntreprise */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_critere_entreprise'); ?>
		<?php echo $form->textField($model,'id_critere_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nom_critere_entreprise'); ?>
		<?php echo $form->textField($model,'nom_critere_entreprise',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'critere_note'); ?>
		<?php echo $form->textField($model,'critere_note'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_critere'); ?>
		<?php echo $form->textField($model,'description_critere',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->