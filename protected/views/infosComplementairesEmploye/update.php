<?php
/* @var $this InfosComplementairesEmployeController */
/* @var $model InfosComplementairesEmploye */

$this->breadcrumbs=array(
	'Infos Complementaires Employes'=>array('index'),
	$model->id_info_employe=>array('view','id'=>$model->id_info_employe),
	'Update',
);

$this->menu=array(
	array('label'=>'List InfosComplementairesEmploye', 'url'=>array('index')),
	array('label'=>'Create InfosComplementairesEmploye', 'url'=>array('create')),
	array('label'=>'View InfosComplementairesEmploye', 'url'=>array('view', 'id'=>$model->id_info_employe)),
	array('label'=>'Manage InfosComplementairesEmploye', 'url'=>array('admin')),
);
?>

<h1>Update InfosComplementairesEmploye <?php echo $model->id_info_employe; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>