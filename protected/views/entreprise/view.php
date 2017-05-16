<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->menu=array(
	array('label'=>'List Entreprise', 'url'=>array('index')),
	array('label'=>'Create Entreprise', 'url'=>array('create')),
	array('label'=>'Update Entreprise', 'url'=>array('update', 'id'=>$model->id_entreprise)),
	array('label'=>'Delete Entreprise', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_entreprise),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Entreprise', 'url'=>array('admin')),
);
?>

<!--	MENU 	-->
<div class="dropdown">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
		Menu 
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
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
			<li>
				<a href="index.php?r=entreprise/index" title="Rechercher un CV">
				Rechercher un CV
				</a>
			</li>
		</li>
	</ul>
</div>



<h1>View Entreprise #<?php echo $model->id_entreprise; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_entreprise',
		'nom_entreprise',
		'nombre_employes',
		'recherche_employes',
		'secteur_activite_entreprise',
		'annee_creation_entreprise',
		'age_moyen_entreprise',
	),
));
?>


<!-- Formulaire avec le bouton pour Mes candidats -->
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
		<?php echo CHtml::submitButton('Modifier mon profil'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>

<div class="wide form">
	<?php
	//Début du form
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('/entreprise/delete', array('id'=>$model->id_entreprise)),
		)
	);
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Supprimer mon profil'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
