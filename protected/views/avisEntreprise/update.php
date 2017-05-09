<?php
/* @var $this AvisEntrepriseController */
/* @var $model AvisEntreprise */

$this->breadcrumbs=array(
	'Avis Entreprises'=>array('index'),
	$model->id_avis_entreprise=>array('view','id'=>$model->id_avis_entreprise),
	'Update',
);

$this->menu=array(
	array('label'=>'List AvisEntreprise', 'url'=>array('index')),
	array('label'=>'Create AvisEntreprise', 'url'=>array('create')),
	array('label'=>'View AvisEntreprise', 'url'=>array('view', 'id'=>$model->id_avis_entreprise)),
	array('label'=>'Manage AvisEntreprise', 'url'=>array('admin')),
);
?>

<h1>Update AvisEntreprise <?php echo $model->id_avis_entreprise; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>