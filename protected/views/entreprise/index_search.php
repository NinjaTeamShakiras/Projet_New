<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/

//Récupération de l'utilisateur
$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));
?>



<div id='div-accueil-entreprise-search'>

	<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/prozzl_logo.png',
	      'Image accueil');
	 
	      echo CHtml::link($image,array('entreprise/index')); ?>



	<?php
	if($utilisateur != null)
	{
		if(!Utilisateur::est_employe(Yii::app()->user->role) )
		{// ENTREPRISE
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
		<div id='div-accueil-entreprise-search'>

			<h3 id='titre'>Nouvelle recherche : </h3>

<<<<<<< HEAD


			print("<p id='div-infos-comp'> Trouver le CV que vous recherchez parmis ".$nombreEmploye." CV.</p>"); 
		?>
			<?php
				// On récupère tous les employé
				$tabEmploye = employe::model()->FindAll();

=======
			<?php
				// On récupère tous les employé
				$tabEmploye = employe::model()->FindAll();
>>>>>>> 35d73e4a17d2f61204fb042c306af46d8f3955fe

				// On récupère le nombre total d'employe
				$nombreEmploye = sizeof($tabEmploye);

				print("<p id='div-infos-comp'> Trouver le CV que vous rechercher parmis ".$nombreEmploye." CV.</p>"); 
			?>




			<!-- FORMAULAIRE DE RECHERCHE DE CV-->
			<div class="wide form">

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
								'class' => 'champs-recherche autocomplete-find-offreEmploi',
								'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllCompetenceJSON'),
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
						echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5'),array('separator' => ' '));
					?>
				</div>

				<div class="row buttons">	
					<?php
						// Button d'envoi
						echo CHtml::submitButton('Rechercher',array('class'=>'btn_rechercher btn btn-success'));
					?>
				</div>

				
				<?php $this->endWidget(); ?>

			</div>






			<h3 id='titre'>Résultat de votre recherche : </h3>


			<?php
				// On récupère le nombre d'employé matché
				$nombreEmploye = sizeof($data);


				// AFFICHAGE DES EMPLOYES
				if($nombreEmploye>0)
				{// Si le nombre d'employé matché est positif
					if($aRechercher)
					{// Si une recherche à été faite
						if($nombreEmploye == 1)
						{
							print("<p id='div-infos-comp'> Vous avez 1 candidat correspondant à votre recherche :</p>");
						}
						else
						{
							print("<p id='div-infos-comp'> Vous avez ".$nombreEmploye." candidats correspondants à votre recherche :</p>");
						}

						foreach($data as $employe)
						{// On affiche chaque employé matché
							$nomLien = "<p id='lien'> Le candidat ".$employe->id_employe." : </p>";
							echo CHtml::link($nomLien ,array('employe/view', 'id'=>$employe->id_employe),array('class'=>'lien'));
							?>
							<ul>
								<?php
									foreach($competences as $competence)
									{// Avec ces competences correspondantes
										if($employe->id_employe == $competence->id_employe)
										{
											print("<li><p id='div-infos-comp'> ".$competence->intitule_competence." - niveau ".$competence->niveau_competence."</p></li>");
										}
									}
								?>
							</ul>
						<?php
						}
					}
					else
					{// Si aucune recherche n'a été faite on affiche tout les employés
						print("<p id='div-infos-comp'> Votre recherche était vide, à défaut, voici les ".$nombreEmploye." candidats présent sur prozzl.</p>");

						foreach($data as $employe)
						{
							$nomLien = "<p id='lien'> Candidat ".$employe->id_employe."</p>";
							echo CHtml::link($nomLien ,array('offreEmploi/view', 'id'=>$employe->id_employe));
						}
					}
					

				}
				else
				{// Si aucun résultat ne ressort de la recherche
					print("<p id='div-infos-comp'> Aucun candidat ne corresponds à votre recherche.</p>");

				}

			?>
		</div>
	</div><!-- Fermeture de la div du filtre -->
</div><!--Fermture de la div de l'arrière plan -->





