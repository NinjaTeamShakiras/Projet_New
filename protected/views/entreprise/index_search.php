<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/

	$this->menu=array(
		array('label'=>'Retour index', 'url'=>array('/entreprise/index')), // Voir toutes les offres d'emplois
		//array('label'=>'Nouvelle recherche d\'offres d\'emplois', 'url'=>array('/offreEmploi/recherche')), // Rechercher des offres d'emplois
	);

?>



<h1>Nouvelle recherche : </h1>

<?php 
	$tabEmploye = employe::model()->FindAll();

	$nombreEmploye = sizeof($tabEmploye);

	print("<p> Trouver le CV que vous rechercher parmis ".$nombreEmploye." CV.</p>"); 
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
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllCompetenceJSON'),
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
			echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5'),array('separator' => ' '));
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





<h1>Résultat de votre recherche : </h1>

<?php
	
	$nombreEmploye = sizeof($data); // Nombre de employe matché

	if($nombreEmploye>0)
	{
		print("<p> ".$nombreEmploye." employe correspondent à votre recherche.</p>");

		foreach($data as $employe)
		{
			print("<p> L'employe : ".$employe->id_employe." (id)</p>");
		}

	}
	else
	{// Sinon, on dit simplement qu'il n'y en a pas
		print("<p> Aucun candidat ne correspondent à votre recherche.</p>");
	}

?>





