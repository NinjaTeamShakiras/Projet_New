<?php
/* @var $this SiteController */
unset(Yii::app()->session['login']);
?>

<div class=arriere-plan>
	<div class=filtre-vert-clair>
		<div class="logo"><img src="images/Prozzl.png" alt="Prozzl"/></div>

		<?php
		echo Yii::app()->user->getFlash('suppr_compte');

		echo "<div class='Recherche'>Vous recherchez ? </div>";

		$form=$this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl('site/Accueil'),
		));

		// Message d'acces refusé
		echo Yii::app()->user->getFlash('access_denied'); 
		?>

		<div class="twobuttons row ">
			<?php
			echo CHtml::submitButton('Un emploi/Un stage', array('name' => 'btnemploye','class' => 'btn btn-emploi col-md-offset-3 col-md-2 col-xs-offset-1 col-xs-2')); 
			echo CHtml::submitButton('Un salarié', array('name' => 'btnentreprise','class' => 'btn btn-employe col-md-offset-2 col-xs-offset-2 '));  
			?>
		</div>

		<?php
		if(Yii::app()->user->isGuest)
		{
     		echo "<div class='connexion'>Déjà un compte? <?php echo CHtml::link('Connexion',array('site/login'),array('class'=>'btnredirect'));?></div>";
    	}

		 $this->endWidget();
		?>

	</div>
</div>

