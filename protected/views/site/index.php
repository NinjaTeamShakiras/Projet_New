<?php
/* @var $this SiteController */


$this->pageTitle=Yii::app()->name;


echo "<h1 align='center'>Prozzl</h1>";
echo "<h1 align='center'>Recruteur de l'industrie touristique</h1>";

//$this->renderPartial('./../entreprise/_search_accueil', array('model'=>Entreprise::model()));

echo "<h2 align='center'>Vous recherchez ?<h2>";

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('site/accueil'),
)); 
echo CHtml::submitButton('Un emploi', array('name' => 'btnemploi')); 
echo CHtml::submitButton('Un employe', array('name' => 'btnemploye')); 
echo CHtml::submitButton('Ajouter formation', array('name' => 'btnAjoutFormation' ));
$this->endWidget(); 	
?>
