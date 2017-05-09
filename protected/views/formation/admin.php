<?php
/* @var $this FormationController */
/* @var $model Formation */

$this->breadcrumbs=array(
	'Formations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Formation', 'url'=>array('index')),
	array('label'=>'Create Formation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#formation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Formations</h1>

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
	'id'=>'formation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_formation',
		'date_debut_formation',
		'date_fin_formation',
		'intitule_formation',
		'etablissement_formation',
		'diplome_formation',
		/*
		'description_formation',
		'id_employe',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
