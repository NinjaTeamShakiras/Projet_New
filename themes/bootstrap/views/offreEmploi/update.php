<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */

/*
$this->breadcrumbs=array(
	'Offre Emplois'=>array('index'),
	$model->id_offre_emploi=>array('view','id'=>$model->id_offre_emploi),
	'Update',
);

$this->menu=array(
	array('label'=>'List OffreEmploi', 'url'=>array('index')),
	array('label'=>'Create OffreEmploi', 'url'=>array('create')),
	array('label'=>'View OffreEmploi', 'url'=>array('view', 'id'=>$model->id_offre_emploi)),
	array('label'=>'Manage OffreEmploi', 'url'=>array('admin')),
);
*/
?>

<h1>Modifier votre offre </h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>