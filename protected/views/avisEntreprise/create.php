<?php
/* @var $this AvisEntrepriseController */
/* @var $model AvisEntreprise */

$this->breadcrumbs=array(
	'Avis Entreprises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AvisEntreprise', 'url'=>array('index')),
	array('label'=>'Manage AvisEntreprise', 'url'=>array('admin')),
);
?>

<h1>Create AvisEntreprise</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>