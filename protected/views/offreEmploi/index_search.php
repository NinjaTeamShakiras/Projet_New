<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/

	$this->menu=array(
		array('label'=>'Liste des offres d\'emplois', 'url'=>array('/offreEmploi/index')), // Voir toutes les offres d'emplois
		array('label'=>'Nouvelle recherche d\'offres d\'emplois', 'url'=>array('/offreEmploi/recherche')), // Rechercher des offres d'emplois
	);

?>

<h1>Résultat de votre recherche : </h1>


<?php
	$login = Yii::app()->user->getId();
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); // Récupération de l'utilisateur


	$tablePostuler = Postuler::model()->FindAll(); // On récupère la table postuler
	$nombreOffre = sizeof($data); // Nombre d'offre total


	if($nombreOffre>0)
	{// Si il y a des offres on affiche leurs nombres
		print("<p> ".$nombreOffre." correspondent à votre recherche.</p>");


		foreach($data as $offre)
		{ // On affiche toutes les offres correspondant à la recherche
			$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

			// Pour récupéré l'adresse : 
			$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
			$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));


			print("<p> Proposé par : ".$entreprise->nom_entreprise."</p>");
			print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
			print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
			print("<p> Type de l'offre : ".$offre->type_offre_emploi."</p>");
			print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
			print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
			print("<p> Lieu : ".$adresse->ville." </p>");
			print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
			print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
			print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");

			// Bonus : si l'employé à postulé à l'offre en question, on affiche qu'il a postuler avec la date.
			foreach($tablePostuler as $postuler)
			{
				if( ($postuler->id_offre_emploi == $offre->id_offre_emploi) && ($postuler->id_employe == $utilisateur->id_employe) )
				{ // Si l'offre de la table postuler concerne l'offre en question et quel concerne l'employé :
					print("<p> Vous avez postuler à cette offre le : ".$this->changeDateNaissance($postuler->date_postule)."</p>");
				}
			}

			echo CHtml::link('Voir cette offre' ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));
			echo "<hr/>";
		}

	}
	else
	{// Sinon, on dit simplement qu'il n'y en a pas
		print("<p> Aucune offre ne correspondent à votre recherche.</p>");
	}
	
?>
