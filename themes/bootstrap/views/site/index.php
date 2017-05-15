<?php
/* @var $this SiteController */

echo '<div class="titre"><img src="images/Prozzl.png" alt="Prozzl" /></div>';

//$this->renderPartial('./../entreprise/_search_accueil', array('model'=>Entreprise::model()));

echo "<div class='Recherche'>Vous recherchez <mark>?</mark></div>";

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('site/Accueil'),
)); 
?>
<div class="twobuttons row ">
<?php
echo CHtml::submitButton('Un emploi/Un stage', array('name' => 'btnemploi','class' => 'btnnoir btn btn-success col-md-offset-2 col-md-2 ')); 
echo CHtml::submitButton('Un salarié', array('name' => 'btnemploye','class' => 'btnnoir btn btn-success col-md-offset-4 col-md-2')); 
?>
</div>

<div class='connexion'>Déjà un compte? <?php echo CHtml::link('Connexion',array('site/login'),array('class'=>'btnredirect'));
?>
</div>
<?php
$this->endWidget(); 	
?>
