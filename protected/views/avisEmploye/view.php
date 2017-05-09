<?php
/* @var $this AvisEmployeController */
/* @var $model AvisEmploye */

$this->breadcrumbs=array(
	'Avis Employes'=>array('index'),
	$model->id_avis_employe,
);

$this->menu=array(
	array('label'=>'List AvisEmploye', 'url'=>array('index')),
	array('label'=>'Create AvisEmploye', 'url'=>array('create')),
	array('label'=>'Update AvisEmploye', 'url'=>array('update', 'id'=>$model->id_avis_employe)),
	array('label'=>'Delete AvisEmploye', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_avis_employe),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AvisEmploye', 'url'=>array('admin')),
);
?>

<h1>View AvisEmploye #<?php echo $model->id_avis_employe; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_avis_employe',
		'note_generale_avis_employe',
		'date_creation',
		'nb_signalements',
		'id_employe',
		'id_utilisateur',
	),
)); ?>
