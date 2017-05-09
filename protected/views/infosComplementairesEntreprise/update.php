<?php
/* @var $this InfosComplementairesEntrepriseController */
/* @var $model InfosComplementairesEntreprise */

$this->breadcrumbs=array(
	'Infos Complementaires Entreprises'=>array('index'),
	$model->id_info_entreprise=>array('view','id'=>$model->id_info_entreprise),
	'Update',
);

$this->menu=array(
	array('label'=>'List InfosComplementairesEntreprise', 'url'=>array('index')),
	array('label'=>'Create InfosComplementairesEntreprise', 'url'=>array('create')),
	array('label'=>'View InfosComplementairesEntreprise', 'url'=>array('view', 'id'=>$model->id_info_entreprise)),
	array('label'=>'Manage InfosComplementairesEntreprise', 'url'=>array('admin')),
);
?>

<h1>Update InfosComplementairesEntreprise <?php echo $model->id_info_entreprise; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>