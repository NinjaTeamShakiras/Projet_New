<?php 
$login = Yii::app()->user->getId();
// Récupération de l'utilisateur
$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login));
?>
<div class='arriere-plan-employe'>
	<?php
	$image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png','Image accueil');
	echo CHtml::link($image,array('employe/index','id'=> $utilisateur->id_employe)); ?>

	<!-- On affiche les messages de confirmation d'ajout d'infos -->
	<?php echo Yii::app()->user->getFlash('success_ajout_formation'); ?>
	<?php echo Yii::app()->user->getFlash('success_ajout_competence'); ?>
	<?php echo Yii::app()->user->getFlash('success_ajout_exp'); ?>	

	<div class='filtre-blanc'>

		<div class="form">
			<?php
			$user = Utilisateur::model()->FindByAttributes(array("mail"=>Yii::app()->user->getID()));
			$formation= formation::model();

			$form=$this->beginWidget('CActiveForm',array(
				'id'=>'infos-form',
				'action'=>Yii::app()->createUrl('employe/ajoutFormation'),
				'enableClientValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			));
			?>

			<h1 class='intitule'>Formations</h1>

			<div class="row div-field">
				<?php echo $form->labelEx($formation,'intitule_formation'); ?>
				<?php echo $form->textfield($formation,'intitule_formation',array('class'=>'champ-input')); ?>
				<?php echo $form->error($formation,'intitule_formation'); ?>
			</div>


			<div class="row div-field">
				<?php echo $form->labelEx($formation,'etablissement_formation'); ?>
				<?php echo $form->textfield($formation,'etablissement_formation',array('class'=>'champ-input')); ?>
				<?php echo $form->error($formation,'etablissement_formation'); ?>
			</div>

			<div class="row div-field">
				<?php echo $form->labelEx($formation,'diplome_formation'); ?>
				<?php echo $form->textfield($formation,'diplome_formation',array('class'=>'champ-input')); ?>
				<?php echo $form->error($formation,'diplome_formation'); ?>
			</div>

			<div class="row div-field">
				<?php echo $form->labelEx($formation,'date_debut_formation'); ?>
				<?php echo $form->textfield($formation,'date_debut_formation',array('class'=>'champ-input', 'placeholder'=>'JJ/MM/AAAA')); ?>
				<?php echo $form->error($formation,'date_debut_formation'); ?>
			</div>

			<div class="row div-field">
				<?php echo $form->labelEx($formation,'date_fin_formation'); ?>
				<?php echo $form->textfield($formation,'date_fin_formation',array('class'=>'champ-input', 'placeholder'=>'JJ/MM/AAAA')); ?>
				<?php echo $form->error($formation,'date_fin_formation'); ?>
			</div>

			<div class="row div-field">
				<?php echo $form->labelEx($formation,'description_formation'); ?>
				<?php echo $form->textarea($formation,'description_formation',array('class'=>'champ-input champ-description')); ?>
				<?php echo $form->error($formation,'description_formation'); ?>
			</div>

			<div class="row buttons" id="champ-btn-formation">
				<?php echo CHtml::submitbutton("Ajouter une école / formation",array('name' => 'btnajoutformation','id'=>'btn-ajoutformation')); ?>
			</div>

			<?php $this->endWidget(); ?>

		</div>
		<!-- Fin de la div form -->


		<div class="form">
			<?php
				$experiencePro= ExperiencePro::model();

				$form=$this->beginWidget('CActiveForm',array(
					'id'=>'infos-form',
					'action'=>Yii::app()->createUrl('employe/ajoutExpPro'),
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				));
			?>

			<h1 class='intitule'>Experiences Professionnelles</h1>

			<div class="row div-field">
				<?php echo $form->labelEx($experiencePro,'intitule_experience'); ?>
				<?php echo $form->textfield($experiencePro,'intitule_experience',array('class'=>'champ-input')); ?>
				<?php echo $form->error($experiencePro,'intitule_experience'); ?>
			</div>


			<div class="row div-field">
				<?php echo $form->labelEx($experiencePro,'entreprise_experience'); ?>
				<?php echo $form->textfield($experiencePro,'entreprise_experience',array('class'=>'champ-input')); ?>
				<?php echo $form->error($experiencePro,'entreprise_experience'); ?>
			</div>

			<div class="row div-field">
				<?php echo $form->labelEx($experiencePro,'date_debut_experience'); ?>
				<?php echo $form->textfield($experiencePro,'date_debut_experience',array('class'=>'champ-input', 'placeholder'=>'JJ/MM/AAAA')); ?>
				<?php echo $form->error($experiencePro,'date_debut_experience'); ?>
			</div>

			<div class="row div-field">
				<?php echo $form->labelEx($experiencePro,'date_fin_experience'); ?>
				<?php echo $form->textfield($experiencePro,'date_fin_experience',array('class'=>'champ-input', 'placeholder'=>'JJ/MM/AAAA')); ?>
				<?php echo $form->error($experiencePro,'date_fin_experience'); ?>
			</div>

			<div class="row div-field">
				<?php echo $form->labelEx($experiencePro,'description_experience'); ?>
				<?php echo $form->textarea($experiencePro,'description_experience',array('class'=>'champ-input champ-description')); ?>
				<?php echo $form->error($experiencePro,'description_experience'); ?>
			</div>

			<div class="row" id="champ-btn-exp-pro">
				<?php echo CHtml::submitbutton("Ajouter une expérience professionnelle",array('name' => 'btnajoutexppro','id'=>'btn-ajoutexperience')); ?>
			</div>

			<?php $this->endWidget(); ?>

		</div>	
		<!-- Fin de la div form -->


		<div class='form'>

			<?php

				$competence= competence::model();

				$form=$this->beginWidget('CActiveForm',array(
					'id'=>'infos-form',
					'action'=>Yii::app()->createUrl('employe/ajoutCompetences'),
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				));
			?>		


			<h1 class='intitule'>Competences</h1>

				
			<div class="row div-competence" id="competence">
				<?php echo $form->textfield($competence,'intitule_competence',array('placeholder'=>'Intitule de la competence', 'size'=>30)); ?>
				<?php echo $form->error($competence,'intitule_competence'); ?>
				

			<?php echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5'),array('separator' => ' ','class'=>'buttonlist'));?>
			<?php echo $form->error($competence,'niveau_competence'); ?>

			</div>

			<div class="row" id="champ-ajout-comp">
				<?php echo CHtml::submitbutton("Ajouter une competence",array('name' => 'btnajoutcompetence','id'=>'btn-ajoutcomp')); ?>
			</div>

			<?php $this->endWidget(); ?>

		</div>
		<!-- Fin de la div form -->


		<div class="row" id="champ-back">
			<?php echo CHtml::link("Retour à la page précédente",array('employe/view','id'=>$user->id_employe),array('class'=>'link-back')); ?>
		</div>
	</div>
	<!-- Fin de la div fond blanc -->
</div>
<!-- Fin de la div arriere plan employe -->