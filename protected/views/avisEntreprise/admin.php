<?php
/* @var $this AvisEntrepriseController */
/* @var $model AvisEntreprise */

$this->breadcrumbs=array(
	'Avis Entreprises'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AvisEntreprise', 'url'=>array('index')),
	array('label'=>'Create AvisEntreprise', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#avis-entreprise-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Avis Entreprises</h1>

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
	'id'=>'avis-entreprise-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_avis_entreprise',
		'note_generale_avis_entreprise',
		'commentaire_avis_entreprise',
		'id_entreprise',
		'id_utilisateur',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
