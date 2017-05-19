<?php

$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

?>


<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png',
      'Image accueil');
 
      echo CHtml::link($image,array('site/index','id'=> 'accueil')); ?>

<div class='arriere-plan-login'>
	<div class='filtre-vert-clair'>

		<h1 id='titre-modifparam'>Modification des informations de connexion</h1>
		<h2 id='veuillez-confirmer'>Veuillez confirmer votre mot de passe, même si vous ne souhaitez pas en changer</h2>

		<!-- Debut du formulaire -->
		<div class="form formulaire-modifparam">	

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

		</div>
		<div class="row two-buttons">

			<?php 
				echo Chtml::submitbutton('Valider', array('name'=>'btnmodifco','class'=>'btnvalider btn'));
				echo CHtml::submitbutton('Annuler', array('name'=>'retour','class'=>'btnannuler btn'));

			$this->endWidget();	

			?>
		</div>
		<!-- Fin du form -->
	</div>
	<!--Fin du filtre vert -->
</div>	
<!--Fin de l'arriere plan -->