<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */

//$this->breadcrumbs=array(
//	'Offre Emplois'=>array('index'),
//	'Create',
//);

$this->menu=array(
	array('label'=>'Liste de mes offres d\'emploi', 'url'=>array('index')),
);
?>

<h1>Créer une offre d'emploi</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>