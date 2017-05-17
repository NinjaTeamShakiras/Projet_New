<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->menu=array(
	array('label'=>'Delete Entreprise', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_entreprise),'confirm'=>'Are you sure you want to delete this item?')),
);



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
			<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
			Mes annonces
			</a>
		</li>
		<li>
			<a href="index.php?r=entreprise/candidats" title="Mes candidats">
			Mes candidats
			</a>
			<li>
				<a href="index.php?r=entreprise/index" title="Rechercher un CV">
				Rechercher un CV
				</a>
			</li>
		</li>
	</ul>
</div>



<h1>Mon profil</h1>

<?php

	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

	$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$utilisateur->id_adresse));
	$nombreEmployes = $model->nombre_employes == null ? 'Non renseignée' : $model->nombre_employes;
	$rechercheEmployes = $model->recherche_employes == 0 ? 'Non' : 'Oui';
	$secteurActivite = $model->secteur_activite_entreprise == null ? 'Non renseignée' : $model->secteur_activite_entreprise;
	$anneeCreation = $model->annee_creation_entreprise == null ? 'Non renseignée' : $model->annee_creation_entreprise;
	$ageMoyen = $model->age_moyen_entreprise == null ? 'Non renseignée' : $model->age_moyen_entreprise;

	$code_postal = $adresse->code_postal == null ? 'Non renseignée' : $adresse->code_postal;
	$ville = $adresse->ville == null ? 'Non renseignée' : $adresse->ville;
	$rue = $adresse->rue == null ? 'Non renseignée' : $adresse->rue;

	$telephone = $utilisateur->telephone == null ? 'Non renseignée' : $this->afficheTelephone($utilisateur->telephone);
	$telephone2 = $utilisateur->telephone2 == null ? 'Non renseignée' : $this->afficheTelephone($utilisateur->telephone2);
	$siteWeb = $utilisateur->site_web == null ? 'Non renseignée' : $utilisateur->site_web;
	$mail = $utilisateur->mail == null ? 'Non renseignée' : $utilisateur->mail;



	echo Yii::app()->user->getFlash('success_update_entreprise');



	print("<p> Nom de mon entreprise : ".$model->nom_entreprise."</p>");
	print("<p> Nombres d'employés de l'entreprise : ".$nombreEmployes."</p>");
	print("<p> Je recherche des employés : ".$rechercheEmployes."</p>");
	print("<p> Mon secteur d'activité de mon entreprise : ".$secteurActivite."</p>");
	print("<p> Année de création de mon entreprise : ".$anneeCreation."</p>");
	print("<p> Age moyen de mon entreprise : ".$ageMoyen."</p>");

	print("<p> Code postale : ".$code_postal."</p>");
	print("<p> Ville : ".$ville."</p>");
	print("<p> Rue : ".$rue."</p>");

	print("<p> Téléphones principal : ".$telephone."</p>");
	print("<p> Téléphones secondaire : ".$telephone2."</p>");
	print("<p> Site web : ".$siteWeb."</p>");
	print("<p> Adresse mail de mon entreprise : ".$mail."</p>");
	
?>


<!-- Formulaire avec le bouton pour Mes candidats -->
<div class="wide form">
	<?php
	//Début du form
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('/entreprise/update',array('id'=>$model->id_entreprise)),
		)
	);
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Modifier mon profil'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>

<div class="wide form">
	<?php
	//Début du form
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('/entreprise/delete', array('id'=>$model->id_entreprise)),
		)
	);
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Supprimer mon profil'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
