<?php
/* @var $this CvEmployeController */
/* @var $model CvEmploye */

$this->breadcrumbs=array(
	'Cv Employes'=>array('index'),
	$model->id_cv_employe=>array('view','id'=>$model->id_cv_employe),
	'Update',
);

$this->menu=array(
	array('label'=>'List CvEmploye', 'url'=>array('index')),
	array('label'=>'Create CvEmploye', 'url'=>array('create')),
	array('label'=>'View CvEmploye', 'url'=>array('view', 'id'=>$model->id_cv_employe)),
	array('label'=>'Manage CvEmploye', 'url'=>array('admin')),
);
?>

<h1>Update CvEmploye <?php echo $model->id_cv_employe; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>