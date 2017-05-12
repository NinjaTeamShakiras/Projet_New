<?php
/* @var $this EmployeController */
/* @var $model Employe */
?>

<h1>Comment souhaiter vous ajouter votre CV</h1>	

<?php

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('employe/choixCV'),
)); 

echo "<p>".CHtml::submitButton('Télécharger mon CV sur le site', array('name' => 'upload'))."</p>"; 
echo "<p>".CHtml::submitButton('Renseigner mes informations personnelles et générer mon CV', array('name'=> 'infos_persos'))."</p>"; 
$this->endWidget(); 

?>