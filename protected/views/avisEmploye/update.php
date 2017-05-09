<?php
/* @var $this AvisEmployeController */
/* @var $model AvisEmploye */

$this->breadcrumbs=array(
	'Avis Employes'=>array('index'),
	$model->id_avis_employe=>array('view','id'=>$model->id_avis_employe),
	'Update',
);

$this->menu=array(
	array('label'=>'List AvisEmploye', 'url'=>array('index')),
	array('label'=>'Create AvisEmploye', 'url'=>array('create')),
	array('label'=>'View AvisEmploye', 'url'=>array('view', 'id'=>$model->id_avis_employe)),
	array('label'=>'Manage AvisEmploye', 'url'=>array('admin')),
);
?>

<h1>Update AvisEmploye <?php echo $model->id_avis_employe; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>