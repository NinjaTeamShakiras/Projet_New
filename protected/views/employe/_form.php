<?php
/* @var $this EmployeController */
/* @var $model Employe */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employe-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	)); 

	$adresse = Adresse::model()->FindByAttributes(array('id_adresse'=>$model->id_adresse));
	$utilisateur = Utilisateur::model()->FindByAttributes(array('id_employe'=>$model->id_employe));

?>

	<!--<p class="note"><span class="required">*</span> Champs à remplir obligatoirement.</p>-->
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nom_employe'); ?>
		<?php echo $form->textField($model,'nom_employe',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nom_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prenom_employe'); ?>
		<?php echo $form->textField($model,'prenom_employe',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'prenom_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_naissance_employe'); ?>
		<?php echo $form->textField($model,'date_naissance_employe',
			array('maxlength'=>10, 
				  'placeholder'=>'JJ/MM/AAAA', 
				  'value'=>$this->changeDateNaissance($model->date_naissance_employe))); ?>
		<?php echo $form->error($model,'date_naissance_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employe_travaille'); ?>
		<?php 
		//0 : Ne travailles donc OUI car recherche du travail
		//Le contraire pour 1
		echo $form->dropDownList($model, 'employe_travaille', array('0'=>'Oui', '1'=>'Non')); ?>
		<?php echo $form->error($model,'employe_travaille'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($utilisateur,'mail'); ?>
		<?php echo $form->textField($utilisateur,'mail',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($utilisateur,'mail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone_employe'); ?>
		<?php echo $form->textField($model,'telephone_employe',
			array('size'=>15,
				  'maxlength'=>10,
				  'placeholder'=>'0605040302')); ?>
		<?php echo $form->error($model,'telephone_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($adresse,'rue'); ?>
		<?php echo $form->textField($adresse, 'rue', array('placeholder'=>'10 rue du Général De Gaulles', 'size'=>45)); ?>
		<?php echo $form->error($adresse,'rue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($adresse,'code_postal'); ?>
		<?php echo $form->textField($adresse, 'code_postal', array('placeholder'=>'75000')); ?>
		<?php echo $form->error($adresse,'code_postal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($adresse,'ville'); ?>
		<?php echo $form->textField($adresse, 'ville', array('placeholder'=>'Paris')); ?>
		<?php echo $form->error($adresse,'ville'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Sauvegarder'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->