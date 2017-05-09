<?php
/* @var $this CriteresNotationEntrepriseController */
/* @var $model CriteresNotationEntreprise */

$this->breadcrumbs=array(
	'Criteres Notation Entreprises'=>array('index'),
	$model->id_critere_entreprise,
);

$this->menu=array(
	array('label'=>'List CriteresNotationEntreprise', 'url'=>array('index')),
	array('label'=>'Create CriteresNotationEntreprise', 'url'=>array('create')),
	array('label'=>'Update CriteresNotationEntreprise', 'url'=>array('update', 'id'=>$model->id_critere_entreprise)),
	array('label'=>'Delete CriteresNotationEntreprise', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_critere_entreprise),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CriteresNotationEntreprise', 'url'=>array('admin')),
);
?>

<h1>View CriteresNotationEntreprise #<?php echo $model->id_critere_entreprise; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_critere_entreprise',
		'nom_critere_entreprise',
		'critere_note',
		'description_critere',
	),
)); ?>
