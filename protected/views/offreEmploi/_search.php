		<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php
	/*
	<div class="row">
		<?php echo $form->label($model,'id_offre_emploi'); ?>
		<?php echo $form->textField($model,'id_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_creation_offre_emploi'); ?>
		<?php echo $form->textField($model,'date_creation_offre_emploi'); ?>
	</div>

	*/
	?>

	<div class="row">
		<?php echo $form->label($model,'poste_offre_emploi'); ?>
		<?php echo $form->textField($model,'poste_offre_emploi',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_offre_emploi'); ?>
		<?php
			// Liste déroulante pour le choix du type d'offre
			echo $form->dropDownList($model, 'type_offre_emploi', array('CDD'=>'CDD', 'CDI'=>'CDI', 'STAGE'=>'STAGE', 'ALTERNANCE'=>'ALTERNANCE', 'EXTRA'=>'EXTRA'));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_debut_offre_emploi'); ?>
		<?php echo $form->textField($model,'date_debut_offre_emploi'); ?>
	</div>


	<?php
	/*
	<div class="row">
		<?php echo $form->label($model,'salaire_offre_emploi'); ?>
		<?php echo $form->textField($model,'salaire_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'experience_offre_emploi'); ?>
		<?php echo $form->textField($model,'experience_offre_emploi',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_offre_emploi'); ?>
		<?php echo $form->textField($model,'description_offre_emploi',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_entreprise'); ?>
		<?php echo $form->textField($model,'id_entreprise'); ?>
	</div>
	*/
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->