<?php
/* @var $this SiteController */

echo "<h1>Prozzl</h1>";
echo "<h1>Recruteur de l'industrie touristique</h1>";

//$this->renderPartial('./../entreprise/_search_accueil', array('model'=>Entreprise::model()));

echo "<h2>Vous recherchez ?<h2>";

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('site/Accueil'),
)); 
echo CHtml::submitButton('Un emploi/Un stage', array('name' => 'btnemploi')); 
echo CHtml::submitButton('Un salarié', array('name' => 'btnemploye')); 
$this->endWidget(); 	
?>
