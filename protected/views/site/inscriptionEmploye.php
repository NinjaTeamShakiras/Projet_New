<h1>Inscription</h1>

<div class="form">
<?php

	$employe = Employe::model();
	$utilisateur = Utilisateur::model();
	
	$form=$this->beginWidget('CActiveForm',array(
		'id'=>'inscription-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	));
?>

	<div class="row">
		<?php echo $form->labelEx($employe,'nom_employe'); ?>
		<?php echo $form->textfield($employe,'nom_employe'); ?>
		<?php echo $form->error($employe,'nom_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($employe,'prenom_employe'); ?>
		<?php echo $form->textfield($employe,'prenom_employe'); ?>
		<?php echo $form->error($employe,'prenom_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($employe,'date_naissance_employe'); ?>
		<?php echo $form->textfield($employe,'date_naissance_employe'); ?>
		<?php echo $form->error($employe,'date_naissance_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($utilisateur,'mail'); ?>
		<?php echo $form->textfield($utilisateur,'mail'); ?>
		<?php echo $form->error($utilisateur,'mail'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'mot_de_passe'); ?>
		<?php echo $form->passwordfield($model,'mot_de_passe'); ?>
		<?php echo $form->error($model,'mot_de_passe'); ?>
	</div>

	<div class="row">
		<p>Confirmer le mot de passe</p>
		<p><input type="password" name="confirm_mdp" required/></p>
		<?php echo $form->error($model,'mot_de_passe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Inscription'); ?>
	</div>

	<div class="row link">
		<?php echo 'Vous possedez déjà un compte ? Cliquez '.CHtml::link('ici',array('site/login')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>