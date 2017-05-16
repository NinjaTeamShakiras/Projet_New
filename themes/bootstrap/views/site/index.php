<?php
/* @var $this SiteController */
echo '<div class=arriere-plan>';
echo '<div class=filtre-vert>';
echo '<div class="logo"><img src="images/Prozzl.png" alt="Prozzl"/></div>';

//$this->renderPartial('./../entreprise/_search_accueil', array('model'=>Entreprise::model()));

echo "<div class='Recherche'>Vous recherchez ? </div>";

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('site/Accueil'),
)); 
?>
<div class="twobuttons row ">
<?php
echo CHtml::submitButton('Un emploi/Un stage', array('name' => 'btnemploi','class' => 'btn-emploi')); 
echo CHtml::submitButton('Un salarié', array('name' => 'btnemploye','class' => 'btn-employe')); 
?>
</div>

<div class='connexion'>Déjà un compte? <?php echo CHtml::link('Connexion',array('site/login'),array('class'=>'btnredirect'));
?>
</div>	
</div>
</div>
<?php
$this->endWidget(); 	
?>
