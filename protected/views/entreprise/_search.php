<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_entreprise'); ?>
		<?php echo $form->textField($model,'id_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nom_entreprise'); ?>
		<?php echo $form->textField($model,'nom_entreprise',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_employes'); ?>
		<?php echo $form->textField($model,'nombre_employes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recherche_employes'); ?>
		<?php echo $form->textField($model,'recherche_employes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secteur_active_entreprise'); ?>
		<?php echo $form->textField($model,'secteur_active_entreprise',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'anne_creation_entreprise'); ?>
		<?php echo $form->textField($model,'anne_creation_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'age_moyen_entreprise'); ?>
		<?php echo $form->textField($model,'age_moyen_entreprise'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->