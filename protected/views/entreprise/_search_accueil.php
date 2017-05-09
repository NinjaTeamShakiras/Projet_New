<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php 

$adresse = Adresse::model()->findAll();

//Lorsqu'on clique sur le bouton sumbit, le formulaire renvoie vers actionSearch de EntrepriseController
$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('Entreprise/Search'),
)); ?>

	<div class="row" align='center'>
	<!-- Recherche d'une entreprise (textfield + bouton submit) -->	
		<?php echo $form->textField($model,'nom_entreprise', array(		'class' => 'autocomplete-find-entreprise',
																		'url_data_auto' => Yii::app()->createUrl('Entreprise/GetAllEntreprisesJSON'),
																		'size' => 45,
																		'maxlength' => 45,
																		'placeholder' => 'Rechercher une entreprise'		) ); ?>
		<?php echo CHtml::submitButton('Rechercher'); ?>
	</div>

	<div class="row buttons">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript">
	var autocomplete_class = ".autocomplete-find-entreprise"; 
	var url_data = $(autocomplete_class).attr('url_data_auto');

	$.ajax({
		type: "POST",
		dataType: "text",
		url: url_data,
		data: {  },
		success: function( response ) 
	    {
			autocomplete( response );
		},
		error: function( error )
		{
			console.log("Error récupération des données");
		}
	});

	function autocomplete( test )
	{
		var list_json = JSON.parse( test.substring(1, test.length) );
		$( autocomplete_class ).autocomplete({
		      source: list_json
	    });
	}

</script>