<?php
/* @var $this EntrepriseController */
/* @var $dataProvider CActiveDataProvider */

//Récupération de l'utilisateur
$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

?>


<!--	MENU 	-->
<div class="dropdown">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
		Menu 
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		<li>
			<a href="index.php?r=offreEmploi/create" title="Déposer une annonce">
			Déposer une annonce
			</a>
		</li>
		<li>
			<a href="index.php?r=entreprise/view&id=<?php echo $utilisateur->id_entreprise;?>" title="Mon profil">
			Mon profil
			</a>
		</li>
		<li>
			<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
			Mes annonces
			</a>
		</li>
		<li>
			<a href="index.php?r=entreprise/candidats" title="Mes candidats">
			Mes candidats
			</a>
		</li>
	</ul>
</div>






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



<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<h1><strong>Voir avec le client pour le dernier formulaire, c'est pas clair</strong></h1>
