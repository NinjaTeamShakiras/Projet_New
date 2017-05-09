<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */

$this->breadcrumbs=array(
	'Offre Emplois'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OffreEmploi', 'url'=>array('index')),
	array('label'=>'Manage OffreEmploi', 'url'=>array('admin')),
);
?>

<h1>Create OffreEmploi</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>