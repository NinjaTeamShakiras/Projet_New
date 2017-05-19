<?php
/* @var $this EntrepriseController */
/* @var $dataProvider CActiveDataProvider */

//Récupération de l'utilisateur
$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));
$employeConnecte = false;

?>
<div id='div-accueil-entreprise'>

	<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png',
	      'Image accueil');
	 
	      echo CHtml::link($image,array('site/index')); ?>

	<?php
	if($utilisateur != null)
	{
			?>
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
					<li role="separator" class="divider"></li>
					<li>
						<a href="index.php?r=entreprise/Deconnexion" title="Déconnexion">
						Déconnexion
						</a>
					</li>
				</ul>
				</div>

			<?php

	}
	else
	{ // Si non connecté


		?>
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
					<a href="index.php?r=site/inscriptionEntreprise" title="Inscription">
					Inscription
					</a>
				</li>
			</ul>
			</div>

		<?php
	}
	?>



	<div class='filtre-vert'>


		<?php 
		echo Yii::app()->user->getFlash('logout_ok');
		echo Yii::app()->user->getFlash('succes_modif_paramco'); 
		?>




		<h3 id='titre'>Rechercher un CV : </h3>

		<?php 
			$tabEmploye = employe::model()->FindAll();

			$nombreEmploye = sizeof($tabEmploye);

			print("<p id='div-infos-comp'> Trouver le candidat que vous rechercher parmis ".$nombreEmploye." CV.</p>"); 
		?>


		<!-- FORMAULAIRE DE RECHERCHE DE CV-->
		<div class="form">

			<?php
				//Début du form
				$form=$this->beginWidget('CActiveForm',
					array(
						'action'=>Yii::app()->createUrl('entreprise/Search'),
					)
				);
			?>

			<!-- Recherche par niveau de compétence (textfield + bouton submit) -->
			<div id="div-champs-recherche">
				<?php
					//Recherche par COMPETENCE
					$competence = competence::model();
					echo $form->textField(
						$competence,'intitule_competence', array(	
							'class' => 'champs-recherche autocomplete-find-entreprise',
							'url_data_auto' => Yii::app()->createUrl('entreprise/GetAllCompetenceJSON'),
							'size' => 45,
							'maxlength' => 45,
							'placeholder' => 'Rechercher par compétence',
						)
					);
				?>
			</div>

			<div class="row" id='div-infos-comp'>
				<?php
					//Recherche par NIVEAU de COMPETENCE
					echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5','Sans importance'),array('separator' => ' '));
				?>
			</div>

			<div id='div-btn-rechercher'>	
				<?php
					// Button d'envoi
					echo CHtml::submitButton('Rechercher',array('class'=>'btn_rechercher btn btn-success'));
				?>
			</div>

			<?php $this->endWidget(); ?>

		</div>

	</div><!-- Fermeture de la div du filtre -->	
</div> <!--Fermture de la div de l'arrière plan -->	




<div id='div-infos'>

	<div id='div-info-margin-leger'>
		<h4>Payez uniquement pour vos besoins !  </h4>
	</div>

	<div class='filtre-vert' id='div-info-padding'>
		<h4>Payez 10 euros pour obtenir les coordonnées d’un candidat </h4>
		<h4>Prozzl a comme objectif de faciliter l’accès à l’emploi et baisser le coût du recrutement </h4>
	</div>

</div>