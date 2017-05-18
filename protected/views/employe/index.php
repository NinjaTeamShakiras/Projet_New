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

<div>

	<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/prozzl_logo.png',
	      'Image accueil');
	 
	      echo CHtml::link($image,array('employe/index')); ?>


	<!--  MENU 	-->
	<?php
	//Si l'utilisateur est connecté
	if($utilisateur != null)
	{
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
					<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
					Liste des offres d'emplois
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/mesOffres" title="Mes candidatures">
					Mes candidatures
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
	}
	else
	{
		?>
		<div class="btn-group" style="float: right;">
			<button type="button" class="btn-menu btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

		<?php 
			echo Yii::app()->user->getFlash('logout_ok');
			echo Yii::app()->user->getFlash('succes_modif_paramco'); 
		?>
			
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
					echo CHtml::submitButton('Rechercher',array('class'=>'btn_rechercher btn btn-success'));

				$this->endWidget();
		 		?>
		 	</div>

		</div>

		<?php
		/*
		<!-- Fomulaire avec le bouton de l'ajout du CV -->
		<div class="row">
			<?php
				//Début du form
				$form=$this->beginWidget('CActiveForm',
					array(
						'action'=>Yii::app()->createUrl('employe/choixAjoutCV'),
					)
				);
				//Début du form
				$form=$this->beginWidget('CActiveForm',
					array(
						'action'=>Yii::app()->createUrl('offreEmploi/recherche') ,
					)
				);
			?>

				<!-- Bouton d'ajout du CV -->
				<?php echo CHtml::submitButton('Ajouter mon CV',array('class'=>'btn btn-success ','id'=>'btn_cv'));
				?>
				<!-- Bouton pour postuler -->
				<?php echo CHtml::submitButton('Postuler à une annonce en un seul click !',array('class'=>'btn btn-success','id'=>'btn_postuler')); ?>

			<?php 
			$this->endWidget(); 
			$this->endWidget(); ?>
		</div>	

		<?php

		?>
		</div>*/
		?>
		
	<!-- Fermeture de la div du filtre -->	
	</div>
<!--Fermture de la div de l'arrière plan -->	
</div>







<!-- sur fond blanc-->
	<h4 id=''>Créez votre profil pour postuler à des annonces !</h4>
	<!-- encadré vert -->
		<h4 id=''>Entrez en 1 clic votre CV au format PDF grace au bouton 'ajoutez votre CV' dans le menu</h4>
	<!-- FIN encadré vert -->
<!-- FIN sur fond blanc-->


<!-- sur fond vert-->
	<h4 id=''>Postulez en 1 clic à l’entreprise qui vous correspond </h4>
<!-- FIN sur fond vert-->


<!-- sur fond blanc-->
	<h4 id=''>Un poste vous intéresse ?  </h4>
	<!-- encadré vert -->
		<h4 id=''>Postulez en 1 clic à leur annonce ! </h4>
		<h4 id=''>Votre profil sera envoyé directement au recruteur </h4>
	<!-- FIN encadré vert -->


	<h4 id=''>PROZZL lutte contre les inégalités ! </h4>
<!-- FIN sur fond blanc-->

<!-- sur fond vert-->
	<h4 id=''>Nous avons à cœur d’offrir à chacun la même chance  </h4>
	<!-- encadré ROSE ?? -->
		<h4 id=''>Pour éviter toute discrimination de genre, nationalité, religion, âge…Les profils des candidats sont envoyés sans leurs nom, coordonnées, âge  </h4>
	<!-- FIN encadré ROSE ?? -->
<!-- FIN sur fond vert-->

	