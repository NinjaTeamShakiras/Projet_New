<h1>Competences</h1>

<div class="from">
<?php

	$competence= competence::model();

	$form=$this->beginWidget('CActiveForm',array(
	'id'=>'competence-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		),
	));
?>

	<div class="row">
		<?php echo $form->labelEx($competence,'intitule_competence'); ?>
		<?php echo $form->textfield($competence,'intitule_competence'); ?>
		<?php echo $form->error($competence,'intitule_competence'); ?>
	</div>


	<div class="row">
		<?php echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5'),array('separator' => ' ')); ?>
		<?php echo $form->error($competence,'niveau_competence'); ?>
	</div>

	<div class="row buttons">
	<?php echo CHtml::submitbutton("Ajouter une competence",array('name' => 'btnajoutcompetence')); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitbutton("Entrer les competences",array('name' => 'btninserercompetence')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
