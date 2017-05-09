<?php
/* @var $this EntrepriseAvisCritereController */
/* @var $model EntrepriseAvisCritere */

$this->breadcrumbs=array(
	'Entreprise Avis Criteres'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EntrepriseAvisCritere', 'url'=>array('index')),
	array('label'=>'Manage EntrepriseAvisCritere', 'url'=>array('admin')),
);
?>

<h1>Create EntrepriseAvisCritere</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>