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
			<?php echo $form->labelEx($entreprise,'nom_entreprise'); ?>
			<?php echo $form->textfield($entreprise,'nom_entreprise'); ?>
			<?php echo $form->error($entreprise,'nom_entreprise'); ?>
		</div>

		<div class="row" id="login">
			<?php echo $form->labelEx($model,'mail'); ?>
			<?php echo $form->textfield($model,'mail'); ?>
			<?php echo $form->error($model,'mail'); ?>
		</div>

		<div class="row" id="mdp">
			<?php echo $form->labelEx($model,'mot_de_passe'); ?>
			<?php echo $form->passwordfield($model,'mot_de_passe'); ?>
			<?php echo $form->error($model,'mot_de_passe'); ?>
		</div>

		<div class="row">
			<p>Confirmer le mot de passe</p>
			<p><input type="password" name="confirm_mdp" required/></p>
			<?php echo $form->error($model,'mot_de_passe'); ?>
		</div>

		<div class="row buttons" id="bouton_valid">
			<?php echo "<p>".CHtml::submitButton('Inscription')."</p>"; ?>
		</div> 

    
<?php $this->endWidget(); ?>
