<?php
/* @var $this EntrepriseAvisCritereController */
/* @var $model EntrepriseAvisCritere */

$this->breadcrumbs=array(
	'Entreprise Avis Criteres'=>array('index'),
	$model->id_entreprise_avis_critere=>array('view','id'=>$model->id_entreprise_avis_critere),
	'Update',
);

$this->menu=array(
	array('label'=>'List EntrepriseAvisCritere', 'url'=>array('index')),
	array('label'=>'Create EntrepriseAvisCritere', 'url'=>array('create')),
	array('label'=>'View EntrepriseAvisCritere', 'url'=>array('view', 'id'=>$model->id_entreprise_avis_critere)),
	array('label'=>'Manage EntrepriseAvisCritere', 'url'=>array('admin')),
);
?>

<h1>Update EntrepriseAvisCritere <?php echo $model->id_entreprise_avis_critere; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>