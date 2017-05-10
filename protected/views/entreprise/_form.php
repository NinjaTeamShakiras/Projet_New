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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

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
		<?php echo $form->labelEx($model,'secteur_active_entreprise'); ?>
		<?php echo $form->textField($model,'secteur_active_entreprise',array('size'=>45,'maxlength'=>45)); ?>
		<?php
			// Liste déroulante pour le choix du secteur d'activité
			echo $form->dropDownList($model, 'secteur_active_entreprise', array('Touristique'=>'Touristique', 'Camping'=>'Camping', 'Restauration'=>'Restauration', 'Brasserie'=>'Brasserie'));
		?>
		<?php echo $form->error($model,'secteur_active_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anne_creation_entreprise'); ?>
		<?php echo $form->textField($model,'anne_creation_entreprise'); ?>
		<?php echo $form->error($model,'anne_creation_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'age_moyen_entreprise'); ?>
		<?php echo $form->textField($model,'age_moyen_entreprise'); ?>
		<?php echo $form->error($model,'age_moyen_entreprise'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->