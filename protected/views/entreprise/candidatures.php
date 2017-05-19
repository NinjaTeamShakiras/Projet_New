<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/

$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

?>


<div id='div-accueil-entreprise-candidature'>

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





	<div class='filtre-vert'>
		<div id='div-accueil-entreprise-search'>
			<h3 id='titre'>Mes candidats : </h3>



			<div id=div-annonce>

				<?php
					//Début du form
					$form=$this->beginWidget('CActiveForm',
						array(
							'action'=>Yii::app()->createUrl('entreprise/Candidatures'),
						)
					);
				?>

				<div id="div-champs-selection">	
					<?php
						$modelOffre = OffreEmploi::model();
						$Offres = OffreEmploi::model()->FindAll("id_entreprise =".$utilisateur->id_entreprise);
						$tabOffres = array();

						foreach ($Offres as $key=>$offre) {
							$num = $key + 1;
							$entreprise = Entreprise::model()->FindByAttributes(array('id_entreprise'=>$offre->id_entreprise));
							$tabOffresPersonnalise[] = "Annonce ".$num." - ".$offre->type_offre_emploi." - ".$offre->poste_offre_emploi;
						}

						//Afficher candidats par anonce
						//-->On ajoute l'option "Sélectionner pour la liste"
						$static = array('' => Yii::t('', 'Sélectionner une annonce ...'));
						//$posteOffre = CHtml::listData($tabOffresPersonnalise,'id_offre_emploi','poste_offre_emploi'); // On récupère tout les type d'offre existant
						echo $form->dropDownList($modelOffre,'id_offre_emploi',$static + $tabOffresPersonnalise, array('class'=>'menu_roulant-selection')); // On affiche une liste déroulante de toutes les offres

					?>
				</div>

				<div class="row" id='div-btn-rechercher'>	
					<?php
						// Button d'envoi
						echo CHtml::submitButton('Actualiser',array('class'=>'btn_rechercher btn btn-success'));
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
					print("<p id='div-infos-comp'> Vous n'avez pas séléctionné de paramètre.</p>");
				}
				else
				{
					// Candidats chercher et rendu
					if($data == null)
					{
						print("<p id='div-infos-comp'> Vous n'avez aucun candidat à cette offre.</p>");
					}
					else
					{
						if(sizeof($data) == 1)
						{
							print("<p id='div-infos-comp'> Vous avez ".(sizeof($data))." candidat qui a postulé à cette annonce :</p>");
						}
						else
						{
							print("<p id='div-infos-comp'> Vous avez ".(sizeof($data))." candidats qui ont postulé à cette annonce :</p>");
						}
						
						foreach($data as $key=>$employe)
						{
							$nomLien = "<p id='lien'> Le candidat ".$employe->id_employe." a postulé à votre offre </p>";
							echo CHtml::link($nomLien ,array('employe/view', 'id'=>$employe->id_employe));
							if(sizeof($data)-$key > 1)
							{
								echo "<div class=separation-blanche></div>";
							}
						}
					}
				
				}
			?>
		</div>
	</div><!-- Fermeture de la div du filtre -->
</div><!--Fermture de la div de l'arrière plan -->




