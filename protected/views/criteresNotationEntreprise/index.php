<?php
/* @var $this CriteresNotationEntrepriseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Criteres Notation Entreprises',
);

$this->menu=array(
	array('label'=>'Create CriteresNotationEntreprise', 'url'=>array('create')),
	array('label'=>'Manage CriteresNotationEntreprise', 'url'=>array('admin')),
);
?>

<h1>Criteres Notation Entreprises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
