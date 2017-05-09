<?php
/* @var $this CriteresNotationEmployeController */
/* @var $model CriteresNotationEmploye */

$this->breadcrumbs=array(
	'Criteres Notation Employes'=>array('index'),
	$model->id_critere_employe,
);

$this->menu=array(
	array('label'=>'List CriteresNotationEmploye', 'url'=>array('index')),
	array('label'=>'Create CriteresNotationEmploye', 'url'=>array('create')),
	array('label'=>'Update CriteresNotationEmploye', 'url'=>array('update', 'id'=>$model->id_critere_employe)),
	array('label'=>'Delete CriteresNotationEmploye', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_critere_employe),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CriteresNotationEmploye', 'url'=>array('admin')),
);
?>

<h1>View CriteresNotationEmploye #<?php echo $model->id_critere_employe; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_critere_employe',
		'nom_critere_employe',
		'critere_note',
		'description_critere',
	),
)); ?>
