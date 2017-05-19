<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */

/*
$this->breadcrumbs=array(
	'Offre Emplois'=>array('index'),
	$model->id_offre_emploi=>array('view','id'=>$model->id_offre_emploi),
	'Update',
);

$this->menu=array(
	array('label'=>'List OffreEmploi', 'url'=>array('index')),
	array('label'=>'Create OffreEmploi', 'url'=>array('create')),
	array('label'=>'View OffreEmploi', 'url'=>array('view', 'id'=>$model->id_offre_emploi)),
	array('label'=>'Manage OffreEmploi', 'url'=>array('admin')),
);
*/

$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));


	$image = CHtml::image(Yii::app()->request->baseUrl.'/images/prozzl_logo.png',
	      'Image accueil');
	 
	      echo CHtml::link($image,array('entreprise/index'));
	?>

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

	<h1 class=intitule>Modifier votre offre </h1>

	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>