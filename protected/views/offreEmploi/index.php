<?php
/* @var $this OffreEmploiController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Offre Emplois',
);
*/
	$titre ="";

	$login = Yii::app()->user->getId();
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); // Récupération de l'utilisateur
	$model = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres
	$tablePostuler = Postuler::model()->FindAll();
	
	$image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png','Image accueil');
	echo CHtml::link($image,array('employe/index','id'=> $utilisateur->id_employe)); 
	

if($utilisateur != null)
{ // Si connecter
	if (!Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si entreprise
		?>

		<!-- 	MENU 	-->
<div class="btn-group" style="float: right;">
		<button type="button" class="btn-menu btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Menu
	   	<span class="caret"></span>
	   	</button>
		<ul class="dropdown-menu dropdown-menu-right">
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
					<a href="index.php?r=entreprise/candidats" title="Mes candidats">
					Mes candidats
					</a>
				</li>
				<li>
					<a href="index.php?r=entreprise/index" title="Rechercher un CV">
					Rechercher un CV
					</a>
				</li>
				<li role="separator" class="divider"></li>
				<li>
					<a href="index.php?r=entreprise/Deconnexion" title="Déconnexion">
					Déconnexion
					</a>
				</li>
			</ul>
		</div>

		<?php

		$titre = "Mes annonces";
		echo Yii::app()->user->getFlash('success_delete_offre');


	}	/* 		EMPLOYE 	*/
	else if( Utilisateur::est_employe(Yii::app()->user->role))  
	{  // Si employé

		?>

		<!--	MENU 	-->
<div class="btn-group" style="float: right;">
		<button type="button" class="btn-menu btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Menu
	   	<span class="caret"></span>
	   	</button>
		<ul class="dropdown-menu dropdown-menu-right">
				<li>
					<a href="index.php?r=employe/view&id=<?php echo $utilisateur->id_employe;?>" title="Mon profil">
					Mon profil
					</a>
				</li>
				<li>
					<a href="index.php?r=site/redirectInscriptionCV" title="Ajouter mon CV">
					Ajouter mon CV
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/mesOffres" title="Mes candidatures">
					Mes candidatures
					</a>
				</li>
				<li>
					<a href="index.php?r=employe/index" title="Rechercher une offre">
					Rechercher une offre
					</a>
				</li>
				<li role="separator" class="divider"></li>
				<li>
					<a href="index.php?r=employe/Deconnexion" title="Déconnexion">
					Déconnexion
					</a>
				</li>
			</ul>
		</div>

		<?php
		$titre = "Liste des offres d'emplois";

	}
}
else
{
	?>
<div class="btn-group" style="float: right;">
		<button type="button" class="btn-menu btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Menu
	   	<span class="caret"></span>
	   	</button>
		<ul class="dropdown-menu dropdown-menu-right">
			<li>
				<a href="index.php?r=site/redirectInscriptionCV" title="Ajouter mon CV">
				Ajouter mon CV
				</a>
			</li>
			<li>
				<a href="index.php?r=employe/index" title="Rechercher une offre">
				Rechercher une offre
				</a>
			</li>
		</ul>
	</div>
	<?php

	$titre = "Liste des offres d'emplois";
}

?>



<div class='filtre-blanc'>


	<div class='titre-listes-offres'>

	<h1><?php echo $titre?></h1> <!-- Titre page -->

	</div>


	<div id=div-annonce>

	<?php

		if($utilisateur != null)
		{ // Si connecter
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




				?>
				<div class="wide form">

					<?php
						//Début du form
						$form=$this->beginWidget('CActiveForm',
							array(
								'action'=>Yii::app()->createUrl('offreEmploi/AnnoncesEntreprise'),
							)
						);
					?>

					<div class="row">	
						<?php
							$modelOffre = OffreEmploi::model();
							$tabOffre = OffreEmploi::model()->FindAll("id_entreprise =".$utilisateur->id_entreprise);


							//Afficher candidats par anonce
							//-->On ajoute l'option "Sélectionner pour la liste"
							$static = array('' => Yii::t('', 'Sélectionner une annonce ...'));
							$posteOffre = CHtml::listData($tabOffre,'poste_offre_emploi','poste_offre_emploi'); // On récupère tout les type d'offre existant
							echo $form->dropDownList($modelOffre,'poste_offre_emploi',$static + $posteOffre); // On affiche une liste déroulante de toutes les offres

						?>
					</div>

					<div class="row buttons">	
						<?php
							// Button d'envoi
							echo CHtml::submitButton('Actualiser');
						?>
					</div>

					<?php $this->endWidget(); ?>

				</div>
				<?php







				if($data == -2)
				{
					// Uniquement lorsqu'on viens d'une autre page
				}
				else if($data == -1)
				{
					// Pas de paramètre selectionné
					print("<p> Vous n'avez pas séléctionné de paramètre </p>");
				}
				else
				{
					// Candidats chercher et rendu
					if($data == null)
					{
						print("<p> Vous n'avez aucune annonce </p>");
					}
					else
					{
						if(sizeof($data) == 1)
						{
							print("<p> Vous avez posté 1 offre au poste de '".$data[0]->poste_offre_emploi."'</p>");
						}
						else
						{
							print("<p> Vous avez posté ".(sizeof($data))." offre au poste de '".$data[0]->poste_offre_emploi."'' </p>");
						}
						

						$annonceN = 0;

						foreach($data as $offre)
						{
							$annonceN++;
							$nomLien = "Annonce ".$annonceN." - ".$offre->type_offre_emploi." - ".$offre->poste_offre_emploi." - créée le ".$this->changeDateNaissance($offre->date_creation_offre_emploi);
							echo CHtml::link($nomLien ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));
							$candidats = Postuler::model()->FindAll("id_offre_emploi =".$offre->id_offre_emploi);

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
				
				}

		/*
				foreach ($model as $key => $offre ) // Pour chaque offre
				{
					// Si l'offre appartient à l'entreprise
					if($offre->id_entreprise == $utilisateur->id_entreprise)
					{
						$nombreOffreEntreprise++;
					}
				}

				print("<p>Vous avez posté ".$nombreOffreEntreprise." offres.</p>");

				$annonceN = 0;
				foreach ($model as $key => $offre ) // Pour chaque offre ...
				{
					$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

					// Pour récupéré l'adresse : 
					$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
					$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));

					// On affiche les offres de l'entreprise
					if($offre->id_entreprise == $utilisateur->id_entreprise) // Si l'offre appartient à l'entreprise
					{
						$annonceN++;
						//print("<p> ID entreprise : ".$offre->id_entreprise."</p>");
						//print("<p> ID offre : ".$offre->id_offre_emploi."</p>");
						//print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
						// - print("<p> Annonce ".$annonceN." : Poste : ".$offre->poste_offre_emploi."</p>");
						// - print("<p> Type de contrat : ".$offre->type_offre_emploi."</p>");
						//print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
						//print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
						//print("<p> Lieu : ".$adresse->ville." </p>");
						//print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
						//print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
						// - print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");

						$nomLien = "Annonce ".$annonceN." - ".$offre->type_offre_emploi." - ".$offre->poste_offre_emploi." - créée le ".$this->changeDateNaissance($offre->date_creation_offre_emploi);

						echo CHtml::link($nomLien ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));

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
		*/



			} /*			EMPLOYE 			*/
			else if( Utilisateur::est_employe(Yii::app()->user->role))
			{  // Si employé on affiche toutes les offres d'emploi







				?>
				<?php
				$tabOffre = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres
				$nombreTotalOffre = sizeof($tabOffre); // Nombre d'offre total

				$annonceN = 0;

				print("<p><strong> Postulez ou consultez </strong>".$nombreTotalOffre." offres proposées par des entreprises.</p>");



				foreach ($model as $key => $offre ) //  Pour chaque offre on affiche :
				{

					$annonceN++;

					$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

					// Pour récupéré l'adresse : 
					$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
					$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));

					//print("<p> ID entreprise : ".$offre->id_entreprise."</p>");
					//print("<p> ID offre : ".$offre->id_offre_emploi."</p>");
					// - print("<p> Proposé par : ".$entreprise->nom_entreprise."</p>");
					// - print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
					// - print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
					// - print("<p> Type de contrat : ".$offre->type_offre_emploi."</p>");
					// - print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
					// - print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
					// - print("<p> Lieu : ".$adresse->ville." </p>");
					// - print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
					// - print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
					// - print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");


					$nomLien = "Annonce ".$annonceN." - ".$offre->type_offre_emploi." - ".$offre->poste_offre_emploi." - créée le ".$this->changeDateNaissance($offre->date_creation_offre_emploi);
					foreach($tablePostuler as $postuler)
					{
						if($postuler->id_employe == $utilisateur->id_employe && $postuler->id_offre_emploi == $offre->id_offre_emploi )
						{
							//print("<p> Vous avez postuler à cette offre le : ".$this->changeDateNaissance($postuler->date_postule)."</p>");
							$nomLien .= " --- Vous avez postuler à cette annonce le ".$this->changeDateNaissance($postuler->date_postule);
							break;
						}
					}

					
					echo CHtml::link($nomLien ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));
					?>
					<div class=separation-blanche></div>
					<?php
				}

			}

		}
		else 
		{ // Si employe non connecté toutes les offres d'emploi

			$tabOffre = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres
			$nombreTotalOffre = sizeof($tabOffre); // Nombre d'offre total

			$annonceN = 0;

			print("<p> Postulez ou consultez ".$nombreTotalOffre." offres proposées par des entreprises.</p>");


			foreach ($model as $key => $offre ) //  Pour chaque offre on affiche :
			{
				$annonceN++;

				$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

				// Pour récupéré l'adresse : 
				$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
				$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));

				//print("<p> ID entreprise : ".$offre->id_entreprise."</p>");
				//print("<p> ID offre : ".$offre->id_offre_emploi."</p>");
				// - print("<p> Proposé par : ".$entreprise->nom_entreprise."</p>");
				// - print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
				// - print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
				// - print("<p> Type de contrat : ".$offre->type_offre_emploi."</p>");
				// - print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
				// - print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
				// - print("<p> Lieu : ".$adresse->ville." </p>");
				// - print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
				// - print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
				// - print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");

				$nomLien = "Annonce ".$annonceN." - ".$offre->type_offre_emploi." - ".$offre->poste_offre_emploi." - créée le ".$this->changeDateNaissance($offre->date_creation_offre_emploi);
				
				echo CHtml::link($nomLien ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));

				echo "<hr/>";
			}

		}
		?>
	</div>
</div>