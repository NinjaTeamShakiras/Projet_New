<?php
/* @var $this UtilisateurController */
/* @var $model Utilisateur */

$this->breadcrumbs=array(
	'Utilisateurs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Utilisateur', 'url'=>array('index')),
	array('label'=>'Manage Utilisateur', 'url'=>array('admin')),
);
?>

<h1>Create Utilisateur</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>