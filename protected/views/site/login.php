<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>

<h1>Connexion</h1>

<div class="form">
<?php

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Connexion'); ?>
	</div>

	<?php 
	if(Yii::app()->session['login'] == 'employe')
	{
		echo "<div>
				<p>Vous n'êtes pas encore inscrit?".Chtml::link('Inscrivez-vous ici', array('site/inscriptionEmploye'))."</p>
			 </div>";
	}
	else if(Yii::app()->session['login'] == 'entreprise')
	{
		echo "<div>
				<p>Vous n'êtes pas encore inscrit?".Chtml::link('Inscrivez-vous ici', array('site/inscriptionEntreprise'))."</p>
			 </div>";	
	}
	?>
		

<?php $this->endWidget(); ?>
</div><!-- form -->
