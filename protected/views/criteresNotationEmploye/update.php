<?php
/* @var $this CriteresNotationEmployeController */
/* @var $model CriteresNotationEmploye */

$this->breadcrumbs=array(
	'Criteres Notation Employes'=>array('index'),
	$model->id_critere_employe=>array('view','id'=>$model->id_critere_employe),
	'Update',
);

$this->menu=array(
	array('label'=>'List CriteresNotationEmploye', 'url'=>array('index')),
	array('label'=>'Create CriteresNotationEmploye', 'url'=>array('create')),
	array('label'=>'View CriteresNotationEmploye', 'url'=>array('view', 'id'=>$model->id_critere_employe)),
	array('label'=>'Manage CriteresNotationEmploye', 'url'=>array('admin')),
);
?>

<h1>Update CriteresNotationEmploye <?php echo $model->id_critere_employe; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>