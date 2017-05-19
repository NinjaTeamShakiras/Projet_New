<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */
?>


<div id='div-accueil-entreprise-view'>

	<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/prozzl_logo.png',
	      'Image accueil');
	 
	      echo CHtml::link($image,array('entreprise/index')); ?>




	<!--	MENU 	-->
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
				<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
				Mes annonces
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
			<li>
				<a href="index.php?r=Entreprise/parametres" title="Parametres">
				Paramètres de mon compte
				</a>
			</li>
		</ul>
	</div>
	<!-- Fin MENU -->

	<div class='filtre-vert'>


		<h3 id='titre'>Mon profil</h3>

		<div id='div-infos-perso'>

			<?php

				$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

				$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$utilisateur->id_adresse));
				$nombreEmployes = $model->nombre_employes == null ? 'Non renseigné' : $model->nombre_employes;
				$rechercheEmployes = $model->recherche_employes == 0 ? 'Non' : 'Oui';
				$secteurActivite = $model->secteur_activite_entreprise == null ? 'Non renseigné' : $model->secteur_activite_entreprise;
				$anneeCreation = $model->annee_creation_entreprise == null ? 'Non renseignée' : $model->annee_creation_entreprise;
				$ageMoyen = $model->age_moyen_entreprise == null ? 'Non renseigné' : $model->age_moyen_entreprise;

				$code_postal = $adresse->code_postal == null ? 'Non renseigné' : $adresse->code_postal;
				$ville = $adresse->ville == null ? 'Non renseignée' : $adresse->ville;
				$rue = $adresse->rue == null ? 'Non renseignée' : $adresse->rue;

				$telephone = $utilisateur->telephone == null ? 'Non renseigné' : $this->afficheTelephone($utilisateur->telephone);
				$telephone2 = $utilisateur->telephone2 == null ? 'Non renseigné' : $this->afficheTelephone($utilisateur->telephone2);
				$siteWeb = $utilisateur->site_web == null ? 'Non renseigné' : $utilisateur->site_web;
				$mail = $utilisateur->mail == null ? 'Non renseignée' : $utilisateur->mail;



				echo Yii::app()->user->getFlash('success_update_entreprise');

			?><div class='form-infos-perso form'>
				<div class='row'>
					<?php

					print("<p> NOM DE MON ENTREPRISE : <label>".$model->nom_entreprise."</label></p>");
					print("<p> NOMBRE D'EMPLOYES : <label>".$nombreEmployes."</label></p>");
					print("<p> JE RECHERCHE DES EMPLOYES : <label>".$rechercheEmployes."</label></p>");
					print("<p> SECTEUR D'ACTIVITE : <label>".$secteurActivite."</label></p>");
					print("<p> ANNEE DE CREATION DE MON ENTREPRISE : <label>".$anneeCreation."</label></p>");
					print("<p> AGE MOYEN DES SALARIES : <label>".$ageMoyen."</label></p>");

					print("<p> CODE POSTAL : <label>".$code_postal."</label></p>");
					print("<p> VILLE : <label>".$ville."</label></p>");
					print("<p> RUE : <label>".$rue."</label></p>");

					print("<p> TELEPHONE : <label>".$telephone."</label></p>");
					print("<p> AUTRE TELEPHONE : <label>".$telephone2."</label></p>");
					print("<p> SITE WEB : <label>".$siteWeb."</label></p>");
					print("<p> ADRESSE MAIL : <label>".$mail."</label></p>");
					
					?>
				</div>
			</div>
		</div>


		<!-- Formulaire avec le bouton pour Modifier le profil -->
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
				<?php echo CHtml::submitButton('Modifier mon profil',array('class'=>'btn_rechercher btn')); ?>
			</div>

			<?php $this->endWidget(); ?>

		</div>
		<!-- Fin du formulaire de maj -->

	</div>
	<!-- Fermeture de la div du filtre -->	
</div>
<!--Fermture de la div de l'arrière plan -->
