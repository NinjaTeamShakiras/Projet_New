<?php
/* @var $this UtilisateurController */
/* @var $model Utilisateur */

$this->breadcrumbs=array(
	'Utilisateurs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Utilisateur', 'url'=>array('index')),
	array('label'=>'Create Utilisateur', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#utilisateur-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Utilisateurs</h1>

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
	'id'=>'utilisateur-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_utilisateur',
		'login',
		'mot_de_passe',
		'role',
		/*
		'date_creation_utilisateur',
		'date_derniere_connexion',
		'mail',
		*/
		'id_employe',
		'id_entreprise',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
