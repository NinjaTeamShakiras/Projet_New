<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/
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
		{// On affiche toutes les offres correspondant à la recherche
			$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre


			print("<p> Proposé par : ".$entreprise->nom_entreprise."</p>");
			print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
			print("<p> Type de l'offre : ".$offre->type_offre_emploi."</p>");
			print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
			print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
			print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
			print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
			print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");

			// Bonus : si l'employé à postulé à l'offre en question, on affiche qu'il a postuler avec la date.
			foreach($tablePostuler as $postuler)
			{
				if($postuler->id_employe == $utilisateur->id_employe)
				{
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
