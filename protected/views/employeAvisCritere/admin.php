<?php
/* @var $this EmployeAvisCritereController */
/* @var $model EmployeAvisCritere */

$this->breadcrumbs=array(
	'Employe Avis Criteres'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EmployeAvisCritere', 'url'=>array('index')),
	array('label'=>'Create EmployeAvisCritere', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#employe-avis-critere-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Employe Avis Criteres</h1>

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
	'id'=>'employe-avis-critere-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_employe_avis_critere',
		'note_employe_avis',
		'commentaire_evaluation_critere',
		'id_critere_notation_employe',
		'id_avis_employe',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
