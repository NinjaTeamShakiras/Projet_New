<?php
/* @var $this AvisEntrepriseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Avis Entreprises',
);

$this->menu=array(
	array('label'=>'Create AvisEntreprise', 'url'=>array('create')),
	array('label'=>'Manage AvisEntreprise', 'url'=>array('admin')),
);
?>

<h1>Avis Entreprises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
