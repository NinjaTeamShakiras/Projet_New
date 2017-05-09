<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */

$this->breadcrumbs=array(
	'Offre Emplois'=>array('index'),
	$model->id_offre_emploi,
);

$this->menu=array(
	array('label'=>'List OffreEmploi', 'url'=>array('index')),
	array('label'=>'Create OffreEmploi', 'url'=>array('create')),
	array('label'=>'Update OffreEmploi', 'url'=>array('update', 'id'=>$model->id_offre_emploi)),
	array('label'=>'Delete OffreEmploi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_offre_emploi),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OffreEmploi', 'url'=>array('admin')),
);
?>

<h1>View OffreEmploi #<?php echo $model->id_offre_emploi; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_offre_emploi',
		'date_creation_offre_emploi',
		'poste_offre_emploi',
		'type_offre_emploi',
		'date_debut_offre_emploi',
		'salaire_offre_emploi',
		'experience_offre_emploi',
		'description_offre_emploi',
		'id_entreprise',
	),
)); ?>
