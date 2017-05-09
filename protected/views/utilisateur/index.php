<?php
/* @var $this UtilisateurController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Utilisateurs',
);

$this->menu=array(
	array('label'=>'Create Utilisateur', 'url'=>array('create')),
	array('label'=>'Manage Utilisateur', 'url'=>array('admin')),
);
?>

<h1>Utilisateurs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
