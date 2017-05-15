<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/icone_prozzl.png',
      'Image accueil');
 
      echo CHtml::link($image,array('site/index','id'=> 'accueil')); ?>

<h1 class='intitule'>Formations</h1>

<div class="from">
	<?php

	$formation= formation::model();
	$competence= competence::model();
	$experiencePro= experiencePro::model();

	$form=$this->beginWidget('CActiveForm',array(
		'id'=>'infos-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			),
		));
		?>
		<div class="rat" id="nom-formation">
			<?php echo $form->labelEx($formation,'intitule_formation'); ?>
			<?php echo $form->textfield($formation,'intitule_formation',array('class'=>'champ-input')); ?>
			<?php echo $form->error($formation,'intitule_formation'); ?>
		</div>


		<div class="rat" id="lieu-formation">
			<?php echo $form->labelEx($formation,'etablissement_formation'); ?>
			<?php echo $form->textfield($formation,'etablissement_formation',array('class'=>'champ-input')); ?>
			<?php echo $form->error($formation,'etablissement_formation'); ?>
		</div>

		<div class="rat" id="diplome-obt">
			<?php echo $form->labelEx($formation,'diplome_formation'); ?>
			<?php echo $form->textfield($formation,'diplome_formation',array('class'=>'champ-input')); ?>
			<?php echo $form->error($formation,'diplome_formation'); ?>
		</div>

		<div class="rat" id="debut-formation">
			<?php echo $form->labelEx($formation,'date_debut_formation'); ?>
			<?php echo $form->textfield($formation,'date_debut_formation',array('class'=>'champ-input')); ?>
			<?php echo $form->error($formation,'date_debut_formation'); ?>
		</div>

		<div class="rat" id="fin-formation">
			<?php echo $form->labelEx($formation,'date_fin_formation'); ?>
			<?php echo $form->textfield($formation,'date_fin_formation',array('class'=>'champ-input')); ?>
			<?php echo $form->error($formation,'date_fin_formation'); ?>
		</div>

		<div class="rat" id="description-formation">
			<?php echo $form->labelEx($formation,'description_formation'); ?>
			<?php echo $form->textarea($formation,'description_formation',array('class'=>'champ-input champ-description')); ?>
			<?php echo $form->error($formation,'description_formation'); ?>
		</div>

		<h1 class='intitule'>Experiences Professionnelles</h1>

		<div class="rat" id="intitule-experience">
			<?php echo $form->labelEx($experiencePro,'intitule_experience'); ?>
			<?php echo $form->textfield($experiencePro,'intitule_experience',array('class'=>'champ-input')); ?>
			<?php echo $form->error($experiencePro,'intitule_experience'); ?>
		</div>


		<div class="rat" id="entreprise-experience">
			<?php echo $form->labelEx($experiencePro,'entreprise_experience'); ?>
			<?php echo $form->textfield($experiencePro,'entreprise_experience',array('class'=>'champ-input')); ?>
			<?php echo $form->error($experiencePro,'entreprise_experience'); ?>
		</div>

		<div class="rat" id="debut-experience">
			<?php echo $form->labelEx($experiencePro,'date_debut_experience'); ?>
			<?php echo $form->textfield($experiencePro,'date_debut_experience',array('class'=>'champ-input')); ?>
			<?php echo $form->error($experiencePro,'date_debut_experience'); ?>
		</div>

		<div class="rat" id="fin-experience">
			<?php echo $form->labelEx($experiencePro,'date_fin_experience'); ?>
			<?php echo $form->textfield($experiencePro,'date_fin_experience',array('class'=>'champ-input')); ?>
			<?php echo $form->error($experiencePro,'date_fin_experience'); ?>
		</div>

		<div class="rat" id="description-experience">
			<?php echo $form->labelEx($experiencePro,'description_experience'); ?>
			<?php echo $form->textarea($experiencePro,'description_experience',array('class'=>'champ-input champ-description')); ?>
			<?php echo $form->error($experiencePro,'description_experience'); ?>
		</div>


		<h1 class='intitule'>Competences</h1>
		
		<div class="rat" id="intitule-competence">
			<?php echo $form->labelEx($competence,'intitule_competence'); ?>
			<?php echo $form->textfield($competence,'intitule_competence',array('class'=>'champ-input')); ?>
			<?php echo $form->error($competence,'intitule_competence'); ?>
		</div>


		<div class="rat" id="niveau-competence">
			<?php echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5'),array('separator' => ' ','type'=>'radio')); ?>
			<?php echo $form->error($competence,'niveau_competence'); ?>
		</div>
		<div class="rat buttons">
			<?php echo CHtml::submitbutton("Ajouter une competence",array('name' => 'btnajoutcompetence')); ?>
		</div>

		<div class="rat buttons">
			<?php echo CHtml::submitbutton("Valider",array('name' => 'valider')); ?>
		</div>

		<?php $this->endWidget(); ?>
	</div>
