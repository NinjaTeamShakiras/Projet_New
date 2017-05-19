<?php

$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

$image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png',
      'Image accueil');
      echo CHtml::link($image,array('site/index','id'=> 'accueil')); 
?>


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

<div class='arriere-plan-login'>
<div class='filtre-vert-clair'>

	<h1 id=titre-inscription>Inscription</h1>

	<div class="formulaire-inscriptionemploye">
		<div class="row div-label-champ">
			<?php echo $form->labelEx($entreprise,'nom_entreprise'); ?>
			<p class=champ><?php echo $form->textfield($entreprise,'nom_entreprise'); ?>
			<?php echo $form->error($entreprise,'nom_entreprise'); ?>
		</div>

		<div class="row div-label-champ">
			<?php echo $form->labelEx($model,'mail'); ?>
			<p class=champ><?php echo $form->textfield($model,'mail'); ?>
			<?php echo $form->error($model,'mail'); ?>
		</div>

		<div class="row div-label-champ">
			<?php echo $form->labelEx($model,'mot_de_passe'); ?>
			<p class=champ><?php echo $form->passwordfield($model,'mot_de_passe'); ?>
			<?php echo $form->error($model,'mot_de_passe'); ?>
		</div>

		<div class="row div-label-champ">
			<p>Confirmer le mot de passe<mark style="background-color: transparent; color:black;">*</mark></p>
			<p class=champ><input type="password" name="confirm_mdp" required/></p>
			<?php echo $form->error($model,'mot_de_passe'); ?>
		</div>

		<div class="row buttons" id="bouton_valid">
			<?php echo "<p>".CHtml::submitButton('Inscription',array("class"=>"btnInscription btn"))."</p>"; ?>
		</div> 

    
<?php $this->endWidget(); ?>
</div>
</div>
