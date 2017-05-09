<?php
/* @var $this EntrepriseAvisCritereController */
/* @var $model EntrepriseAvisCritere */

$this->breadcrumbs=array(
	'Entreprise Avis Criteres'=>array('index'),
	$model->id_entreprise_avis,
);

$this->menu=array(
	array('label'=>'List EntrepriseAvisCritere', 'url'=>array('index')),
	array('label'=>'Create EntrepriseAvisCritere', 'url'=>array('create')),
	array('label'=>'Update EntrepriseAvisCritere', 'url'=>array('update', 'id'=>$model->id_entreprise_avis)),
	array('label'=>'Delete EntrepriseAvisCritere', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_entreprise_avis),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EntrepriseAvisCritere', 'url'=>array('admin')),
);
?>

<h1>View EntrepriseAvisCritere #<?php echo $model->id_entreprise_avis; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_entreprise_avis',
		'note_entreprise_critere',
		'id_critere_notation_entreprise',
		'id_avis_entreprise',
		'commentaire_evaluation_critere',
	),
)); ?>
