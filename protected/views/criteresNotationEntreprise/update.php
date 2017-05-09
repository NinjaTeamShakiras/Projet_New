<?php
/* @var $this CriteresNotationEntrepriseController */
/* @var $model CriteresNotationEntreprise */

$this->breadcrumbs=array(
	'Criteres Notation Entreprises'=>array('index'),
	$model->id_critere_entreprise=>array('view','id'=>$model->id_critere_entreprise),
	'Update',
);

$this->menu=array(
	array('label'=>'List CriteresNotationEntreprise', 'url'=>array('index')),
	array('label'=>'Create CriteresNotationEntreprise', 'url'=>array('create')),
	array('label'=>'View CriteresNotationEntreprise', 'url'=>array('view', 'id'=>$model->id_critere_entreprise)),
	array('label'=>'Manage CriteresNotationEntreprise', 'url'=>array('admin')),
);
?>

<h1>Update CriteresNotationEntreprise <?php echo $model->id_critere_entreprise; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>