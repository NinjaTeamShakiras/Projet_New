<?php
/* @var $this EntrepriseController */
/* @var $dataProvider CActiveDataProvider */

//Récupération de l'utilisateur
$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));
$employeConnecte = false;


if($utilisateur != null)
{
	if(Utilisateur::est_employe(Yii::app()->user->role) )
	{// EMPLOYE
		$employeConnecte = true;
		?>
			<h1>Vous n'êtes pas autorisé à .</h1>
			<p>Utilisée le logo du site pour retourner à l'accueil.</p>
		<?php
	}
	else if(!Utilisateur::est_employe(Yii::app()->user->role) )
	{// ENTREPRISE
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

		<?php

	}
}
else
{ // Si non connecté


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
				<a href="index.php?r=site/inscriptionEntreprise" title="Inscription">
				Inscription
				</a>
			</li>
		</ul>
		</div>

	<?php
}
?>




<?php 
echo Yii::app()->user->getFlash('logout_ok');
echo Yii::app()->user->getFlash('succes_modif_paramco'); 
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






<!-- sur fond blanc-->
	<h4 id=''>Payez uniquement pour vos besoins !  </h4>
	<!-- encadré vert -->
		<h4 id=''>Payez 10 euros pour obtenir les coordonnées d’un candidat </h4>
		<h4 id=''>Prozzl a comme objectif de faciliter l’accès à l’emploi et baisser le coût du recrutement </h4>
	<!-- FIN encadré vert -->
<!-- FIN sur fond blanc-->