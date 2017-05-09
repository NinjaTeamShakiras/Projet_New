<?php
/* @var $this UtilisateurController */
/* @var $model Utilisateur */

$this->breadcrumbs=array(
	'Utilisateurs'=>array('index'),
	$model->id_utilisateur=>array('view','id'=>$model->id_utilisateur),
	'Update',
);

$this->menu=array(
	array('label'=>'List Utilisateur', 'url'=>array('index')),
	array('label'=>'Create Utilisateur', 'url'=>array('create')),
	array('label'=>'View Utilisateur', 'url'=>array('view', 'id'=>$model->id_utilisateur)),
	array('label'=>'Manage Utilisateur', 'url'=>array('admin')),
);
?>

<h1>Update Utilisateur <?php echo $model->id_utilisateur; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>