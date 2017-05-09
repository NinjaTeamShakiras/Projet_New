<?php
/* @var $this AvisEmployeController */
/* @var $model AvisEmploye */

$this->breadcrumbs=array(
	'Avis Employes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AvisEmploye', 'url'=>array('index')),
	array('label'=>'Create AvisEmploye', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#avis-employe-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Avis Employes</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'avis-employe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_avis_employe',
		'note_generale_avis_employe',
		'date_creation',
		'nb_signalements',
		'id_employe',
		'id_utilisateur',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
