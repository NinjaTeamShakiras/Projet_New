<?php
/* @var $this AvisEntrepriseController */
/* @var $model AvisEntreprise */

/*$this->breadcrumbs=array(
	'Avis Entreprises'=>array('index'),
	$model->id_avis_entreprise,
);*/

$this->menu=array(
	array('label'=>'List AvisEntreprise', 'url'=>array('index')),
	array('label'=>'Create AvisEntreprise', 'url'=>array('create')),
	array('label'=>'Update AvisEntreprise', 'url'=>array('update', 'id'=>$model->id_avis_entreprise)),
	array('label'=>'Delete AvisEntreprise', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_avis_entreprise),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AvisEntreprise', 'url'=>array('admin')),
);
?>

<h1>View AvisEntreprise #<?php echo $model->id_avis_entreprise; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_avis_entreprise',
		'note_generale_avis_entreprise',
		'commentaire_avis_entreprise',
		'id_entreprise',
		'id_utilisateur',
	),
)); ?>
