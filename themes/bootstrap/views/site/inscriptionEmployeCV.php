<h3>Veuillez vérifier vos informations</h3>

<div class="form">
<?php
	$employe = Employe::model();
	$utilisateur = Utilisateur::model();
	$adresse =  Adresse::model();

  	/* -- On assigne les informations trouvées par l'algorithme -- */
  	$employe->nom_employe = $informations_arr['Nom'] !== NOT_FOUND_TERM ? $informations_arr['Nom'] : EMPTY_STR;
	$employe->prenom_employe = $informations_arr['Prénom'] !== NOT_FOUND_TERM ? $informations_arr['Prénom'] : EMPTY_STR;
	$employe->date_naissance_employe = $informations_arr['Date-de-naissance'] !== NOT_FOUND_TERM ? $informations_arr['Date-de-naissance'] : EMPTY_STR;
	$utilisateur->mail = $informations_arr['Mail'] !== NOT_FOUND_TERM ? $informations_arr['Mail'] : EMPTY_STR;
	$utilisateur->telephone = $informations_arr['Téléphone'] !== NOT_FOUND_TERM ? $informations_arr['Téléphone'] : EMPTY_STR;
	$utilisateur->site_web = $informations_arr['Site-web'] !== NOT_FOUND_TERM ? $informations_arr['Site-web'] : EMPTY_STR;
	$adresse->rue = $informations_arr['Adresse'] !== NOT_FOUND_TERM ? $informations_arr['Adresse'] : EMPTY_STR;

	$form=$this->beginWidget('CActiveForm',array(
		'id'=>'inscription-cv-form',
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
		<?php echo $form->labelEx($utilisateur,'telephone'); ?>
		<?php echo $form->textfield($utilisateur,'telephone'); ?>
		<?php echo $form->error($utilisateur,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($utilisateur,'site_web'); ?>
		<?php echo $form->textfield($utilisateur,'site_web'); ?>
		<?php echo $form->error($utilisateur,'site_web'); ?>
	</div>

	<div class="row">
		<p>Adresse : </p>
		<textarea><?php print( $adresse->rue ); ?></textarea>
	</div>

<?php 	
	if( sizeof( $informations_arr[ 'Expériences' ] ) > 0 ) :
?>
		<p>Veuillez vérifier vos expériences professionnelles</p>
<?php
		foreach ( $informations_arr['Expériences'] as $key => $value_str ) :  
?>
			<textarea><?php print($value_str); ?></textarea>
<?php 	
		endforeach;
	endif;
?>

<?php 	
	if( sizeof( $informations_arr[ 'Formation' ] ) > 0 ) :
?>
		<p>Veuillez vérifier votre parcours</p>
<?php
		foreach ( $informations_arr['Formation'] as $key => $value_str ) :  
?>
			<textarea><?php print($value_str); ?></textarea>
<?php 	
		endforeach;
	endif;
?>

	<div class="row">
		<?php echo $form->labelEx($utilisateur,'mot_de_passe'); ?>
		<?php echo $form->passwordfield($utilisateur,'mot_de_passe'); ?>
		<?php echo $form->error($utilisateur,'mot_de_passe'); ?>
	</div>

	<div class="row">
		<p>Confirmer le mot de passe</p>
		<p><input type="password" name="confirm_mdp" required/></p>
		<?php echo $form->error($utilisateur,'mot_de_passe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Créer mon compte'); ?>
	</div>


<?php $this->endWidget(); ?>

</div>