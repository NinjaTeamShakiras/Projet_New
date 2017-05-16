<?php
/* @var $this EmployeController */
/* @var $dataProvider CActiveDataProvider */

?>

<?php
	$login = Yii::app()->user->getId();
	// Récupération de l'utilisateur
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login));
	$model = OffreEmploi::model();
	// Récupération de toutes les offres
	$tabOffre = OffreEmploi::model()->FindAll();
	// Récupération de toutes les entreprises
	$tabEntreprise = entreprise::model()->FindAll();

	$entreprise = entreprise::model();
	$adresse = adresse::model();

	$nombreOffre = sizeof($tabOffre); // Nombre d'offre total

?>
		
	
<!--  MENU 	-->
<?php
if($utilisateur != null)
{ // Si connecter
	if (Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si employe
		?>
		<div class="dropdown">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
			Menu
			<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li>
					<a href="index.php?r=employe/view&id=<?php echo $utilisateur->id_employe;?>" title="Mon profil">
					Mon Profil
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
					Liste des offres d'emplois
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/mesOffres" title="Mes candidatures">
					Mes candidatures
					</a>
				</li>
			</ul>
		</div>
		<?php
	}

}
else
{
	?>
		<div class="dropdown">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
			Menu
			<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li>
					<a href="index.php?r=site/inscriptionEmploye" title="Inscription">
					Inscription
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
					Liste des offres d'emplois
					</a>
				</li>
				<li>
					<a href="index.php?r=site/redirectInscriptionCV" title="Ajouter mon CV">
					Ajouter mon CV
					</a>
				</li>
			</ul>
		</div>
	<?php
}
?>





<div>
	<?php echo "<h3>Trouver les offres qui vous correspondent parmis ".$nombreOffre." offres ! </h3>"; ?>
</div>	



<!-- Formulaire de recherche d'une offre d'emploi -->
<div class="wide form">
	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('offreEmploi/Search'),
			)
		);
	?>

	<div class="row">
		<!-- Recherche d'un poste (textfield + dropdownlist+ bouton submit) -->	
		<?php
			//Recherche par POSTE
			echo $form->textField(
				$model,'poste_offre_emploi', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllPosteJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par poste',
				)
			);
		?>
	
		<?php
			//Recherche par TYPE DE CONTRAT (liste déroulante)
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_type = array('' => Yii::t('', 'Sélectionner le type de contrat'));
			$typeOffre = CHtml::listData($tabOffre,'type_offre_emploi', 'type_offre_emploi'); // On récupère tout les type d'offre existant
			echo $form->dropDownList($model,'type_offre_emploi',$static_type + $typeOffre); // On affiche une liste déroulante de toutes les offres
		?>
	</div>
	
	<div class="row">
		<?php
			//Recherche par LIEU
			echo $form->textField(
				$adresse,'ville', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllLieuJSON'),
					'size' => 37,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par lieu',
				)
			);
		?>
	
		<?php
			//Recherche par SECTEUR
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_secteur = array('' => Yii::t('', 'Sélectionner le secteur'));
			$secteurOffre = CHtml::listData($tabEntreprise,'secteur_activite_entreprise', 'secteur_activite_entreprise'); // On récupère tout les secteur d'offre existant
			echo $form->dropDownList($entreprise,'secteur_activite_entreprise',$static_secteur + $secteurOffre); // On affiche une liste déroulante de tout les secteur d'activité
		?>
	
		<?php
			// Button d'envoi
			echo CHtml::submitButton(' GO ');
		?>
	</div>

	<?php $this->endWidget(); ?>

</div>



	