<?php
/* @var $this OffreEmploiController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Offre Emplois',
);
*/

	$titre ="";

	if (!Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si entreprise
		$this->menu=array(
			array('label'=>'Déposer une annonce', 'url'=>array('create')), // On peut créer une offre d'emploi
			
		);

		$titre = "Mes offres d'emplois";

	}
	else if( Utilisateur::est_employe(Yii::app()->user->role))  
	{  // Si employé
		$this->menu=array(
			array('label'=>'Voir mes candidatures', 'url'=>array('/offreEmploi/mesOffres')), // Voir les offres d'emplois au quel l'employé à postulé
			array('label'=>'Rechercher des offres d\'emplois', 'url'=>array('/offreEmploi/recherche')), // Rechercher des offres d'emplois
		);
		$titre = "Liste des offres d'emplois";

	}
	else 
	{ // Si autre
		$this->menu=array(
			array('label'=>'Créer une offre', 'url'=>array('create')), // On peut créer et postuler à une offre d'emploie
		);

		$titre = "Liste des offres d'emplois";
	}

?>




<h1><?php echo $titre?></h1> <!-- Titre page -->




<?php
	$login = Yii::app()->user->getId();
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); // Récupération de l'utilisateur
	$model = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres
	$tablePostuler = Postuler::model()->FindAll();


	/*		ENTREPRISE 			*/
	if (!Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si entreprise on affiche les offres d'emploi de l'entreprise
		$nombreCandidature = 0; // Nombre de candidature a l'offre en question
		$tabIdEmploye=array(); // Tableau des employe qui ont postuler à l'offre

		$tabOffre = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres
		$nombreOffreEntreprise = 0; // Nombre d'offre total

		foreach ($model as $key => $offre ) // Pour chaque offre
		{
			// Si l'offre appartient à l'entreprise
			if($offre->id_entreprise == $utilisateur->id_entreprise)
			{
				$nombreOffreEntreprise++;
			}
		}

		print("<p>Vous avez posté ".$nombreOffreEntreprise." offres.</p>");
		
		foreach ($model as $key => $offre ) // Pour chaque offre ...
		{
			$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

			// Pour récupéré l'adresse : 
			$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
			$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));

			// On affiche les offres de l'entreprise
			if($offre->id_entreprise == $utilisateur->id_entreprise) // Si l'offre appartient à l'entreprise
			{
				$nombreOffreEntreprise++;
				//print("<p> ID entreprise : ".$offre->id_entreprise."</p>");
				//print("<p> ID offre : ".$offre->id_offre_emploi."</p>");
				print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
				print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
				print("<p> Type de contrat : ".$offre->type_offre_emploi."</p>");
				print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
				print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
				print("<p> Lieu : ".$adresse->ville." </p>");
				print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
				print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
				print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");
				echo CHtml::link('Voir cette offre' ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));
	
				$candidats = Postuler::model()->FindAll("id_offre_emploi =".$offre->id_offre_emploi); // On récupère tout les candidats à l'offre

				// Recherche du nombre de candidature et des candidat
				foreach($candidats as $candidat) // Pour chaque candidat
				{ // On stoque tout les id des employé qui on candidaté dans un tableau
					$tabIdEmploye[$nombreCandidature] = $candidat->id_employe;
					$nombreCandidature++;
				}
				

				// Affichage des candidats ou non
				if($nombreCandidature > 0) // Si il y a des candidats
				{ // On affiche le nombre de candidat, puis un lien vers les candidats
					print("<p> Vous avez ".$nombreCandidature." candidature pour cette offre</p>");
				}
				else
				{
					print("<p> Aucune candidature à cette offre </p>");
				}

				$nombreCandidature = 0;
				$tabIdEmploye=array();
				echo "<hr/>";
			}
		}

		// Si l'entreprise n'as pas d'offres, il faut bien afficher quelque chose
		if($nombreOffreEntreprise ==0)
		{// Si il n'y a pas d'offre correspondante
			print("<p> Aucune offre d'emploie </p>");
		}

		// Bouton de retour vers index
		echo CHtml::button(CHtml::encode('Retour profil'),array('/Entreprise/index'));




	} /*			EMPLOYE 			*/
	else if( Utilisateur::est_employe(Yii::app()->user->role))
	{  // Si employé on affiche toutes les offres d'emploi

		$tabOffre = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres
		$nombreTotalOffre = sizeof($tabOffre); // Nombre d'offre total

		print("<p> Postulez ou consultez ".$nombreTotalOffre." offres proposées par des entreprises.</p>");


		foreach ($model as $key => $offre ) //  Pour chaque offre on affiche :
		{
			$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

			// Pour récupéré l'adresse : 
			$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
			$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));

			//print("<p> ID entreprise : ".$offre->id_entreprise."</p>");
			//print("<p> ID offre : ".$offre->id_offre_emploi."</p>");
			print("<p> Proposé par : ".$entreprise->nom_entreprise."</p>");
			print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
			print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
			print("<p> Type de contrat : ".$offre->type_offre_emploi."</p>");
			print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
			print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
			print("<p> Lieu : ".$adresse->ville." </p>");
			print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
			print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
			print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");
			foreach($tablePostuler as $postuler)
			{
				if($postuler->id_employe == $utilisateur->id_employe && $postuler->id_offre_emploi == $offre->id_offre_emploi )
				{
					print("<p> Vous avez postuler à cette offre le : ".$this->changeDateNaissance($postuler->date_postule)."</p>");
				}
			}
			echo CHtml::link('Voir cette offre' ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));
			echo "<hr/>";
		}

	}
	else 
	{ // Si autre on affiche toutes les offres d'emploi
		$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		));

	}
