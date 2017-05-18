<h1>Modification des informations de connexion</h1>
<h2>Veuillez confirmer votre mot de passe, même si vous ne souhaitez pas en changer</h2>

<!-- Debut du formulaire -->
<div class="form">	

	<?php

	//Début du formulaire de vue des infos persos
	$form=$this->beginWidget('CActiveForm',
	array(
		'action'=>Yii::app()->createUrl('site/ModifParamCo'),
		)
	);

	$utilisateur = Utilisateur::model()->FindByAttributes(array('mail'=>Yii::app()->user->getID()));
	?>

	<div class="row div-label-champ">
		<?php echo $form->labelEx($utilisateur,'mail'); ?>
		<p class=champ><?php echo $form->textfield($utilisateur,'mail'); ?></p>
		<?php echo $form->error($utilisateur,'mail'); ?>
	</div>


	<div class="row div-label-champ">
		<?php echo $form->labelEx($utilisateur,'mot_de_passe'); ?>
		<p class=champ><?php echo $form->passwordfield($utilisateur,'mot_de_passe'); ?></p>
		<?php echo $form->error($utilisateur,'mot_de_passe'); ?>
	</div>

	<div class="row div-label-champ">
		<p><strong>Confirmer le mot de passe</strong><mark style="background-color: transparent; color:red;">*</mark></p>
		<p class=champ><input type="password" name="confirm_mdp" required/></p>
		<?php echo $form->error($utilisateur,'mot_de_passe'); ?>
	</div>


	<?php 
	echo Chtml::submitbutton('Valider', array('name'=>'btnmodifco'));
	echo CHtml::submitbutton('Annuler', array('name'=>'retour'));

	$this->endWidget();	

	?>
</div>
<!-- Fin du form -->	