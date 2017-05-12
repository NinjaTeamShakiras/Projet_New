<?php
/* @var $this EntrepriseController */
/* @var $dataProvider CActiveDataProvider */

	if (!Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si entreprise
		$this->menu=array(
			array('label'=>'Déposer une annonce', 'url'=>array('/offreEmploi/create')), // On peut créer une offre d'emploi
			array('label'=>'Gérer mes annonce', 'url'=>array('/offreEmploi/index')), // Acces aux offres de l'entreprise
			array('label'=>'Candidats', 'url'=>array('to_candidatures')), // Acces aux candidatures de l'entreprise
		);

		$titre = "Mes offres d'emplois";

	}


?>

<h1>Rechercher un CV : </h1>

<?php 
	$tabEmploye = employe::model()->FindAll();

	$nombreEmploye = sizeof($tabEmploye);

	print("<p> Trouver le candidat que vous rechercher parmis ".$nombreEmploye." CV.</p>"); 
?>
<!-- FORMAULAIRE DE RECHERCHE DE CV-->
<div class="wide form">

	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('entreprise/Search'),
			)
		);
	?>

	<!-- Recherche par niveau de compétence (textfield + bouton submit) -->
	<div class="row">
		<?php
			//Recherche par COMPETENCE
			$competence = competence::model();
			echo $form->textField(
				$competence,'intitule_competence', array(	
					'class' => 'autocomplete-find-entreprise',
					'url_data_auto' => Yii::app()->createUrl('entreprise/GetAllCompetenceJSON'),
					'size' => 45,
					'maxlength' => 45,
					'placeholder' => 'Rechercher par compétence',
				)
			);
		?>
	</div>

	<div class="row">
		<?php
			//Recherche par NIVEAU de COMPETENCE
			echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5','Sans importance'),array('separator' => ' '));
		?>
	</div>

	<div class="row buttons">	
		<?php
			// Button d'envoi
			echo CHtml::submitButton('Rechercher');
		?>
	</div>

	
	<?php $this->endWidget(); ?>

</div>


<?php echo CHtml::button(CHtml::encode('Déposer une annonce'),array('to_create_offre')); ?>





<h1><strong>Voir avec le client pour le dernier formulaire, c'est pas clair</strong></h1>
