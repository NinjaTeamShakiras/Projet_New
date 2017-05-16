<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'entreprise-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Les champs avec <span class="required">*</span> doivent être remplis.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nom_entreprise'); ?>
		<?php echo $form->textField($model,'nom_entreprise',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nom_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_employes'); ?>
		<?php echo $form->textField($model,'nombre_employes'); ?>
		<?php echo $form->error($model,'nombre_employes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recherche_employes'); ?>
		<?php echo $form->textField($model,'recherche_employes'); ?>
		<?php echo $form->error($model,'recherche_employes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'secteur_activite_entreprise'); ?>
		<?php //echo $form->textField($model,'secteur_activite_entreprise',array('size'=>45,'maxlength'=>45)); ?>
		<?php
			// Liste déroulante pour le choix du secteur d'activité
			echo $form->dropDownList($model, 'secteur_activite_entreprise', array('Touristique'=>'Touristique', 'Camping'=>'Camping', 'Restauration'=>'Restauration', 'Brasserie'=>'Brasserie'));
		?>
		<?php echo $form->error($model,'secteur_activite_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'annee_creation_entreprise'); ?>
		<?php echo $form->textField($model,'annee_creation_entreprise'); ?>
		<?php echo $form->error($model,'annee_creation_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'age_moyen_entreprise'); ?>
		<?php echo $form->textField($model,'age_moyen_entreprise'); ?>
		<?php echo $form->error($model,'age_moyen_entreprise'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Mettre à jour'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->