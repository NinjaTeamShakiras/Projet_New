
<?php

$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

?>


<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png',
      'Image accueil');
 
      echo CHtml::link($image,array('site/index','id'=> 'accueil')); ?>

<div class='arriere-plan-login'>
<div class='filtre-vert-clair'>

<h1 id=titre-inscription>Inscription</h1>

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

<div class="formulaire-inscriptionemploye">

	<div class="row div-label-champ">
		<?php echo $form->labelEx($employe,'nom_employe'); ?>
		<p class=champ><?php echo $form->textfield($employe,'nom_employe'); ?></p>
		<?php echo $form->error($employe,'nom_employe'); ?>
	</div>

	<div class="row div-label-champ">
		<?php echo $form->labelEx($employe,'prenom_employe'); ?>
		<p class=champ><?php echo $form->textfield($employe,'prenom_employe'); ?></p>
		<?php echo $form->error($employe,'prenom_employe'); ?>
	</div>

	<div class="row div-label-champ">
		<?php echo $form->labelEx($employe,'date_naissance_employe'); ?>
		<p class=champ><?php echo $form->textfield($employe,'date_naissance_employe'); ?></p>
		<?php echo $form->error($employe,'date_naissance_employe'); ?>
	</div>

	<div class="row div-label-champ">
		<?php echo $form->labelEx($utilisateur,'mail'); ?>
		<p class=champ><?php echo $form->textfield($utilisateur,'mail'); ?></p>
		<?php echo $form->error($utilisateur,'mail'); ?>
	</div>


	<div class="row div-label-champ">
		<?php echo $form->labelEx($model,'mot_de_passe'); ?>
		<p class=champ><?php echo $form->passwordfield($model,'mot_de_passe'); ?></p>
		<?php echo $form->error($model,'mot_de_passe'); ?>
	</div>

	<div class="row div-label-champ">
		<p><strong>Confirmer le mot de passe</strong><mark style="background-color: transparent; color:red;">*</mark></p>
		<p class=champ><input type="password" name="confirm_mdp" required/></p>
		<?php echo $form->error($model,'mot_de_passe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Inscription',array("class"=>"btnInscription btn")); ?>
	</div>

	<div class="row link">
		<p id=deja-inscrit><?php echo 'Vous possedez déjà un compte ? Cliquez '.CHtml::link('ici',array('site/login'),array('id'=>'url-connexion')); ?></p>
	</div>

</div>


<?php $this->endWidget(); ?>

	<div class="wide form">
		<p id=cv-pdf><strong>Vous avez un CV en format PDF? Créez votre compte directement à partir de votre CV!</strong></p>
		<?php
			$form=$this->beginWidget('CActiveForm',
				array(
					'action'=>Yii::app()->createUrl('site/redirectInscriptionCV'),
				)
			);
		?>
		<div class="row">
			<!-- Bouton d'ajout du CV -->
			<?php echo CHtml::submitButton('Créer mon compte à partir de mon CV',array('class'=>'cv-button btn')); ?>
		</div>
		<?php $this->endWidget(); ?>		
	</div>

</div>
</div>
</div>