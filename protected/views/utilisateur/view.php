<?php
/* @var $this UtilisateurController */
/* @var $model Utilisateur */

$this->breadcrumbs=array(
	'Utilisateurs'=>array('index'),
	$model->id_utilisateur,
);

$this->menu=array(
	array('label'=>'List Utilisateur', 'url'=>array('index')),
	array('label'=>'Create Utilisateur', 'url'=>array('create')),
	array('label'=>'Update Utilisateur', 'url'=>array('update', 'id'=>$model->id_utilisateur)),
	array('label'=>'Delete Utilisateur', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_utilisateur),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Utilisateur', 'url'=>array('admin')),
);
?>

<h1>View Utilisateur #<?php echo $model->id_utilisateur; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_utilisateur',
		'login',
		'mot_de_passe',
		'role',
		'date_creation_utilisateur',
		'date_derniere_connexion',
		'mail',
		'id_employe',
		'id_entreprise',
	),
)); ?>
