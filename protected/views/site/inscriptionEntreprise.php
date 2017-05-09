<?php
$form=$this->beginWidget('CActiveForm',array(
	'id'=>'inscription-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));

$entreprise = Entreprise::model();
?>

	<h1>Inscription</h1>


		<div class="row" id="nom_ent">
			<?php echo $form->textfield($entreprise,'nom_entreprise', array('placeholder'=>'Nom de votre entreprise', 'size'=>50)); ?>
			<?php echo $form->error($entreprise,'nom_entreprise')."</p>"; ?>
		</div>

		<div class="row" id="login">
			<?php echo "<p>".$form->textfield($model,'mail', array('placeholder'=>'Adresse mail', 'size'=>50)); ?>
			<?php echo $form->error($model,'mail')."</p>"; ?>
		</div>

		<div class="row" id="mdp">
			<?php echo "<p>".$form->passwordfield($model,'mot_de_passe', array('placeholder'=>'Mot de passe', 'size'=>25)); ?>
			<?php echo $form->error($model,'mot_de_passe')."</p>"; ?>
		</div>

		<div class="row" id="confirm_mdp">
			<p><input id="Utilisateur_confirm_mdp" type="password" name="confirm_mdp" placeholder="Confirmer le mot de passe" size="25"/></p>
		</div>

		<div class="row buttons" id="bouton_valid">
			<?php echo "<p>".CHtml::submitButton('Inscription')."</p>"; ?>
		</div>

		<div class="row">
			<?php echo "<p>Vous êtes dêjà inscrit sur le site?".Chtml::link('Cliquez ici pour vous connectez', array('site/login'))."</p>"; ?>
		</div>	 

    
<?php $this->endWidget(); ?>
