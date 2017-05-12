<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>

<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/icone_prozzl.png',
      'Image accueil');
 
      echo CHtml::link($image,array('site/index','id'=> 'accueil	')); ?>


<h1 class="Titre">Connexion</h1>

<div class="form-horizontal">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div id="row-login_1" class="row-login">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div id="row-login_2" class="row-login">
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
		<?php echo CHtml::submitButton('Connexion',array('class'=>'btnConnexion btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
