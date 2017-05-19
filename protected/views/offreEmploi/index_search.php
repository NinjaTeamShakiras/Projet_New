<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId())); 
		$model = OffreEmploi::model();
		// Récupération de toutes les offres
		$tabOffre = OffreEmploi::model()->FindAll();
		// Récupération de toutes les entreprises
		$tabEntreprise = entreprise::model()->FindAll();

		$entreprise = entreprise::model();
		$adresse = adresse::model();

		// Nombre d'offre total
		$nombreOffre = sizeof($tabOffre);
	?>

<div>


	<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/prozzl_logo.png',
	      'Image accueil');
	 
	      echo CHtml::link($image,array('employe/index')); ?>
	<?php
	/*	 	MENU 		*/
	if($utilisateur != null)
	{ // Si connecter
		if (Utilisateur::est_employe(Yii::app()->user->role) )
		{ // Si employe

			?>
			<div class="btn-group" style="float: right;">
				<button type="button" class="btn-menu btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu
			   	<span class="caret"></span>
			   	</button>
				<ul class="dropdown-menu dropdown-menu-right">
					<li>
						<a href="index.php?r=employe/view&id=<?php echo $utilisateur->id_employe;?>" title="Mon profil">
						Mon Profil
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
						<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
						Liste des offres d'emplois
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
					<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
					Liste des offres d'emplois
					</a>
				</li>
			</ul>
		</div>
		<?php
	}

	?>


	<div class='filtre-blanc'>

		<h1 id="titre-nvlle-recherche">NOUVELLE RECHERCHE : </h1>


		<?php echo Yii::app()->user->getFlash('logout_ok'); ?>
			
		<!-- Formulaire de recherche d'une offre d'emploi -->
		<div class='row'>
			<?php echo "<h3 id='phrase-nb-offres'>Trouver les offres qui vous correspondent parmis ".$nombreOffre." offres</h3>"; ?>
		</div>	

		<div class="form">

			<?php
				//Début du form
				$form=$this->beginWidget('CActiveForm',
					array(
						'action'=>Yii::app()->createUrl('offreEmploi/Search'),
					)
				);
			?>

			<div id="div-champs-recherche">
					<!-- Recherche d'un poste (textfield + dropdownlist+ bouton submit) -->	
					<?php
						//Recherche par POSTE
						echo $form->textField(
							$model,'poste_offre_emploi', array(	
								'class' => 'champs-recherche autocomplete-find-offreEmploi',
								'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllPosteJSON'),
								'size' => 45,
								'maxlength' => 30,
								'placeholder' => 'Rechercher par poste',
							)
						);
					?>
			
				<?php
					//Recherche par LIEU
					echo $form->textField(
						$adresse,'ville', array(	
							'class' => 'champs-recherche autocomplete-find-offreEmploi',
							'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllLieuJSON'),
							'size' => 45,
							'maxlength' => 30,
							'placeholder' => 'Rechercher par lieu',
						)
					);
				?>
			</div>
			
			<div id="div-champs-selection">
				<?php
					//Recherche par TYPE DE CONTRAT (liste déroulante)
					//-->On ajoute l'option "Sélectionner pour la liste"
					$static_type = array('' => Yii::t('', 'Sélectionner le type de contrat'));
					$typeOffre = CHtml::listData($tabOffre,'type_offre_emploi', 'type_offre_emploi'); // On récupère tout les type d'offre existant
					echo $form->dropDownList($model,'type_offre_emploi',$static_type + $typeOffre, array('class'=>'menu_roulant-selection')); // On affiche une liste déroulante de toutes les offres
				?>
			
				<?php
					//Recherche par SECTEUR
					//-->On ajoute l'option "Sélectionner pour la liste"
					$static_secteur = array('' => Yii::t('', 'Sélectionner le secteur'));
					$secteurOffre = CHtml::listData($tabEntreprise,'secteur_activite_entreprise', 'secteur_activite_entreprise'); // On récupère tout les secteur d'offre existant
					echo $form->dropDownList($entreprise,'secteur_activite_entreprise',$static_secteur + $secteurOffre, array('class'=>'menu_roulant-selection')); // On affiche une liste déroulante de tout les secteur d'activité
				?>
			
			</div>
			<div id='div-btn-rechercher'>
				<?php
					// Button d'envoi
					echo CHtml::submitButton('Rechercher',array('class'=>'btn_rechercher btn'));

				$this->endWidget();
		 		?>
		 	</div>

		</div>


			<!-- Autocomplétion : -->


		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

		<script type="text/javascript">
			var autocomplete_class = ".autocomplete-find-offreEmploi"; 
			var url_data = $(autocomplete_class).attr('url_data_auto');

			$.ajax({
				type: "POST",
				dataType: "text",
				url: url_data,
				data: {  },
				success: function( response ) 
			    {
					autocomplete( response );
				},
				error: function( error )
				{
					console.log("Error récupération des données");
				}
			});

			function autocomplete( test )
			{
				var list_json = JSON.parse( test.substring(1, test.length) );
				$( autocomplete_class ).autocomplete({
				      source: list_json
			    });
			}

		</script>


			<div class='bande-blanche'></div>

			<h1 id='titre-nvlle-recherche'>RESULTAT DE VOTRE RECHERCHE : </h1>

		<div id=div-lien-offre>
			<?php
				$login = Yii::app()->user->getId();
				$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); // Récupération de l'utilisateur

				$tablePostuler = Postuler::model()->FindAll(); // On récupère la table postuler
				$nombreOffre = sizeof($data); // Nombre d'offre total


				if($nombreOffre>0)
				{// Si il y a des offres on affiche leurs nombres
					print("<p id='phrase-nb-offres'> ".$nombreOffre." offres correspondent à votre recherche.</p>");

					foreach($data as $offre)
					{ // On affiche toutes les offres correspondant à la recherche
						$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

						// Pour récupéré l'adresse : 
						$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
						$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));


						//print("<p> Proposé par : ".$entreprise->nom_entreprise."</p>");
						//print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
						//print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
						//print("<p> Type de l'offre : ".$offre->type_offre_emploi."</p>");
						//print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
						//print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
						//print("<p> Lieu : ".$adresse->ville." </p>");
						//print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
						//print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
						//print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");


						$nomLien = $offre->type_offre_emploi." - ".$entreprise->nom_entreprise." - ".$adresse->ville." - ".$offre->poste_offre_emploi;
						
						// si un employé est connecté et a postulé à l'offre en question, on affiche qu'il a postuler avec la date.
						if($utilisateur != null)
						{
							foreach($tablePostuler as $postuler)
							{
							 	if( ($postuler->id_offre_emploi == $offre->id_offre_emploi) && ($postuler->id_employe == $utilisateur->id_employe) )
							 	{ // Si l'offre de la table postuler concerne l'offre en question et quel concerne l'employé :
							 		$nomLien .=" --- Vous avez postuler à cette offre le ".$this->changeDateNaissance($postuler->date_postule);
							 		break;
							 	}
							}
						}
						
						echo CHtml::link($nomLien ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));

						echo "<div class=separation-blanche></div>";
					}

				}
				else
				{// Sinon, on dit simplement qu'il n'y en a pas
					print("<p> Aucune offre ne correspondent à votre recherche.</p>");
				}	
			?>
		</div>
	</div>
	<!--Fermeture du filtre-vert -->
</div>
	<!-- Fermeture de la div du filtre -->	