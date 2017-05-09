<?php
/* @var $this AvisEmployeController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Avis Employes',
);

$this->menu=array(
	array('label'=>'Create AvisEmploye', 'url'=>array('create')),
	array('label'=>'Manage AvisEmploye', 'url'=>array('admin')),
);*/
?>

<h1>Avis Employes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
