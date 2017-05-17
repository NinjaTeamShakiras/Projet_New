<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>
<div class='arriere-plan-login'>
<div class='filtre-blanc'>
<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png',
      'Image accueil');
 
      echo CHtml::link($image,array('site/index','id'=> 'accueil')); ?>


<h1 class="titre-connexion">Connexion</h1>

<div class="form-horizontal">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div id="div-adresse-mail">
		<p id=label-mail><?php echo $form->labelEx($model,'username'); ?></p>
		<p id=champ-mail><?php echo $form->textField($model,'username',array("placeholder"=>"Entrez votre adresse Mail")); ?></p>
		<p><?php echo $form->error($model,'username'); ?></p>
	</div>

	<div id="div-password" class="row-login">
		<p id=label-pass><?php echo $form->labelEx($model,'password'); ?></p>
		<p id=champ-pass><?php echo $form->passwordField($model,'password',array("placeholder"=>"XXX")); ?></p>
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

	<?php 
	if(Yii::app()->session['login'] == 'employe')
	{
		echo "<div>
				<p id='pas-inscrit'>Vous n'êtes pas encore inscrit ? ".Chtml::link('Inscrivez-vous ici', array('site/inscriptionEmploye'),array('id'=>'url-inscription'))."</p>
			 </div>";
	}
	else if(Yii::app()->session['login'] == 'entreprise')
	{
		echo "<div>
				<p id='pas-inscrit'>Vous n'êtes pas encore inscrit ? ".Chtml::link(' Inscrivez-vous ici', array('site/inscriptionEntreprise'),array('id'=>'url-inscription'))."</p>
			 </div>";	
	}
	?>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
