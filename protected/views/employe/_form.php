<?php
/* @var $this EmployeController */
/* @var $model Employe */
/* @var $form CActiveForm */
?>

<div class="form div-infos-persos">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employe-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	)); 

	$utilisateur = Utilisateur::model()->FindByAttributes(array('id_employe'=>$model->id_employe));
	$adresse = Adresse::model()->FindByAttributes(array('id_adresse'=>$utilisateur->id_adresse));

	if($adresse == null)
	{
		$adresse = Adresse::model();
	}

?>

	<!--<p class="note"><span class="required">*</span> Champs à remplir obligatoirement.</p>-->
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row div-field">
		<?php echo $form->labelEx($model,'nom_employe'); ?>
		<?php echo $form->textField($model,'nom_employe',array('size'=>45,'maxlength'=>45,'class'=>'champ-input')); ?>
		<?php echo $form->error($model,'nom_employe'); ?>
	</div>

	<div class="row div-field">
		<?php echo $form->labelEx($model,'prenom_employe'); ?>
		<?php echo $form->textField($model,'prenom_employe',array('size'=>45,'maxlength'=>45,'class'=>'champ-input')); ?>
		<?php echo $form->error($model,'prenom_employe'); ?>
	</div>

	<div class="row div-field">
		<?php echo $form->labelEx($model,'date_naissance_employe'); ?>
		<?php echo $form->textField($model,'date_naissance_employe',
			array('maxlength'=>10, 
				  'placeholder'=>'JJ/MM/AAAA', 
				  'value'=>$this->changeDateNaissance($model->date_naissance_employe),'class'=>'champ-input')); ?>
		<?php echo $form->error($model,'date_naissance_employe'); ?>
	</div>

	<div class="row div-field">
		<?php echo $form->labelEx($model,'employe_travaille'); ?>
		<?php 
		//0 : Ne travailles donc OUI car recherche du travail
		//Le contraire pour 1
		echo $form->dropDownList($model, 'employe_travaille', array('0'=>'Oui', '1'=>'Non'),array('class'=>'champ-input')); ?>
		<?php echo $form->error($model,'employe_travaille'); ?>
	</div>

	<div class="row div-field">
		<?php echo $form->labelEx($utilisateur,'site_web'); ?>
		<?php echo $form->textField($utilisateur,'site_web',array('size'=>45,'maxlength'=>45, 'placeholder'=>'www.monsite.fr','class'=>'champ-input')); ?>
		<?php echo $form->error($utilisateur,'site_web'); ?>
	</div>	

	<div class="row div-field">
		<?php echo $form->labelEx($utilisateur,'telephone'); ?>
		<?php echo $form->textField($utilisateur,'telephone',
			array('size'=>15,
				  'maxlength'=>10,
				  'placeholder'=>'0605040302','class'=>'champ-input')); ?>
		<?php echo $form->error($utilisateur,'telephone'); ?>
	</div>

	<div class="row div-field">
		<?php echo $form->labelEx($utilisateur,'telephone2'); ?>
		<?php echo $form->textField($utilisateur,'telephone2',
			array('size'=>15,
				  'maxlength'=>10,
				  'placeholder'=>'0605040302','class'=>'champ-input')); ?>
		<?php echo $form->error($utilisateur,'telephone2'); ?>
	</div>

	<div class="row div-field">
		<?php echo $form->labelEx($adresse,'rue'); ?>
		<?php echo $form->textField($adresse, 'rue', array('placeholder'=>'10 rue du Général De Gaulles', 'size'=>45,'class'=>'champ-input')); ?>
		<?php echo $form->error($adresse,'rue'); ?>
	</div>

	<div class="row div-field">
		<?php echo $form->labelEx($adresse,'code_postal'); ?>
		<?php echo $form->textField($adresse, 'code_postal', array('placeholder'=>'75000','class'=>'champ-input')); ?>
		<?php echo $form->error($adresse,'code_postal'); ?>
	</div>

	<div class="row div-field">
		<?php echo $form->labelEx($adresse,'ville'); ?>
		<?php echo $form->textField($adresse, 'ville', array('placeholder'=>'Paris','class'=>'champ-input')); ?>
		<?php echo $form->error($adresse,'ville'); ?>
	</div>

	<div class="row div-field">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Mettre à jour',array('class'=>'btn-maj')); 
			  echo CHtml::submitButton('Retour', array('name'=>'btnretour','class'=>'btn-maj'));?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->