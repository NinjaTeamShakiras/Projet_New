<?php
/* @var $this CriteresNotationEntrepriseController */
/* @var $model CriteresNotationEntreprise */

$this->breadcrumbs=array(
	'Criteres Notation Entreprises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CriteresNotationEntreprise', 'url'=>array('index')),
	array('label'=>'Manage CriteresNotationEntreprise', 'url'=>array('admin')),
);
?>

<h1>Create CriteresNotationEntreprise</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>