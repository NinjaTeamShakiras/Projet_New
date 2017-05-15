<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/icone_prozzl.png',
      'Image accueil');
 
      echo CHtml::link($image,array('site/index','id'=> 'accueil')); ?>


<div class="form">


	<?php
		$formation= formation::model();


		$form=$this->beginWidget('CActiveForm',array(
			'id'=>'infos-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		));
	?>

	<h1 class='intitule'>Formations</h1>

	<div class="row div-field" id="nom-formation">
		<?php echo $form->labelEx($formation,'intitule_formation'); ?>
		<?php echo $form->textfield($formation,'intitule_formation',array('class'=>'champ-input')); ?>
		<?php echo $form->error($formation,'intitule_formation'); ?>
	</div>


	<div class="row div-field" id="lieu-formation">
		<?php echo $form->labelEx($formation,'etablissement_formation'); ?>
		<?php echo $form->textfield($formation,'etablissement_formation',array('class'=>'champ-input')); ?>
		<?php echo $form->error($formation,'etablissement_formation'); ?>
	</div>

	<div class="row div-field" id="diplome-obt">
		<?php echo $form->labelEx($formation,'diplome_formation'); ?>
		<?php echo $form->textfield($formation,'diplome_formation',array('class'=>'champ-input')); ?>
		<?php echo $form->error($formation,'diplome_formation'); ?>
	</div>

	<div class="row div-field" id="debut-formation">
		<?php echo $form->labelEx($formation,'date_debut_formation'); ?>
		<?php echo $form->textfield($formation,'date_debut_formation',array('class'=>'champ-input')); ?>
		<?php echo $form->error($formation,'date_debut_formation'); ?>
	</div>

	<div class="row div-field" id="fin-formation">
		<?php echo $form->labelEx($formation,'date_fin_formation'); ?>
		<?php echo $form->textfield($formation,'date_fin_formation',array('class'=>'champ-input')); ?>
		<?php echo $form->error($formation,'date_fin_formation'); ?>
	</div>

	<div class="row div-field" id="description-formation">
		<?php echo $form->labelEx($formation,'description_formation'); ?>
		<?php echo $form->textarea($formation,'description_formation',array('class'=>'champ-input champ-description')); ?>
		<?php echo $form->error($formation,'description_formation'); ?>
	</div>

	<div class="row buttons" id="champ-btn-formation">
		<?php echo CHtml::submitbutton("Ajouter une école / formation",array('name' => 'btnajoutformation','id'=>'btn-ajoutformation')); ?>
	</div>

	<?php $this->endWidget(); ?>


	</div>



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

	<div class="row div-field" id="intitule-experience">
		<?php echo $form->labelEx($experiencePro,'intitule_experience'); ?>
		<?php echo $form->textfield($experiencePro,'intitule_experience',array('class'=>'champ-input')); ?>
		<?php echo $form->error($experiencePro,'intitule_experience'); ?>
	</div>


	<div class="row div-field" id="entreprise-experience">
		<?php echo $form->labelEx($experiencePro,'entreprise_experience'); ?>
		<?php echo $form->textfield($experiencePro,'entreprise_experience',array('class'=>'champ-input')); ?>
		<?php echo $form->error($experiencePro,'entreprise_experience'); ?>
	</div>

	<div class="row div-field" id="debut-experience">
		<?php echo $form->labelEx($experiencePro,'date_debut_experience'); ?>
		<?php echo $form->textfield($experiencePro,'date_debut_experience',array('class'=>'champ-input')); ?>
		<?php echo $form->error($experiencePro,'date_debut_experience'); ?>
	</div>

	<div class="row div-field" id="fin-experience">
		<?php echo $form->labelEx($experiencePro,'date_fin_experience'); ?>
		<?php echo $form->textfield($experiencePro,'date_fin_experience',array('class'=>'champ-input')); ?>
		<?php echo $form->error($experiencePro,'date_fin_experience'); ?>
	</div>

	<div class="row div-field" id="description-experience">
		<?php echo $form->labelEx($experiencePro,'description_experience'); ?>
		<?php echo $form->textarea($experiencePro,'description_experience',array('class'=>'champ-input champ-description')); ?>
		<?php echo $form->error($experiencePro,'description_experience'); ?>
	</div>

	<div class="row" id="champ-btn-exp-pro">
		<?php echo CHtml::submitbutton("Ajouter une expérience professionnelle",array('name' => 'btnajoutexppro','id'=>'btn-ajoutexperience')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>	



<div>

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

		
	<div class="row div-field" id="competence">
		<?php echo $form->textfield($competence,'intitule_competence',array('placeholder'=>'Intitule de la competence', 'size'=>30)); ?>
		<?php echo $form->error($competence,'intitule_competence'); ?>
		

	<?php echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5'),array('separator' => ' ','class'=>'buttonlist'));?>
	<?php echo $form->error($competence,'niveau_competence'); ?>

	</div>

	<div class="row" id="champ-ajout-comp">
		<?php echo CHtml::submitbutton("Ajouter une competence",array('name' => 'btnajoutcompetence','id'=>'btn-ajoutcomp')); ?>
	</div>

	<div class="row" id="champ-valider">
		<?php echo CHtml::submitbutton("Valider",array('name' => 'valider','id'=>'btn-valider')); ?>
	</div>

	<div class="row" id="champ-back">
		<?php echo CHtml::submitbutton("Retour à la page précédente",array('name' => 'retour','id'=>'btn-back')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
