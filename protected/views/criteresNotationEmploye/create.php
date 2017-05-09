<?php
/* @var $this CriteresNotationEmployeController */
/* @var $model CriteresNotationEmploye */

$this->breadcrumbs=array(
	'Criteres Notation Employes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CriteresNotationEmploye', 'url'=>array('index')),
	array('label'=>'Manage CriteresNotationEmploye', 'url'=>array('admin')),
);
?>

<h1>Create CriteresNotationEmploye</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>