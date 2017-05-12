<?php
/* @var $this OffreEmploiController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs=array(
//	'Offre Emplois',
//);


	$this->menu=array(
		array('label'=>'Liste des offres d\'emplois', 'url'=>array('/offreEmploi/index')), // Voir toutes les offres d'emplois
	);

?>



<h1>Rechercher une offre : </h1> <!-- Titre page -->



<?php
	$login = Yii::app()->user->getId();
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); // Récupération de l'utilisateur
	$model = OffreEmploi::model();
	$tabOffre = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres
	$tabEntreprise = entreprise::model()->FindAll(); // Récupération de toutes les entreprises

	$entreprise = entreprise::model();
	$adresse = adresse::model();


	$nombreOffre = sizeof($tabOffre); // Nombre d'offre total

	print("<p> Trouver les offres qui vous correspondes parmis ".$nombreOffre." offres.</p>");
?>



<div class="wide form">

	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('offreEmploi/Search'),
			)
		);
	?>

	<div class="row">
		<!-- Recherche d'un poste (textfield + dropdownlist+ bouton submit) -->	
		<?php


			/****		Recherche par POSTE 		****/

			echo $form->textField(
				$model,'poste_offre_emploi', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllPosteJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par poste',
				)
			);

			?><br/><?php



			/****		 Recherche par TYPE (liste déroulante )		****/

			$typeOffre = CHtml::listData($tabOffre,'type_offre_emploi', 'type_offre_emploi'); // On récupère tout les type d'offre existant
			echo $form->dropDownList($model,'type_offre_emploi',$typeOffre); // On affiche une liste déroulante de toutes les offres

			// // Version manuel
			// echo $form->dropDownList($model, 'type_offre_emploi', array(''=>'Sélectionner...','CDD'=>'CDD','XXXX'=>'Test type inexistant',));

			?><br/><?php




			/****		 Recherche par LIEU 		****/

			echo $form->textField(
				$adresse,'ville', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllLieuJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par lieu',
				)
			);

			?><br/><?php





			/**** 			Recherche par SECTEUR 			****/

			$secteurOffre = CHtml::listData($tabEntreprise,'secteur_activite_entreprise', 'secteur_activite_entreprise'); // On récupère tout les secteur d'offre existant
			echo $form->dropDownList($entreprise,'secteur_activite_entreprise',$secteurOffre); // On affiche une liste déroulante de tout les secteur d'activité

			?><br/><?php



			// Button d'envoi
			echo CHtml::submitButton('Rechercher');
		?>

	</div>

	<div class="row buttons">
	</div>

	<?php $this->endWidget(); ?>

</div>





	<!-- Autocomplétion : -->


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript">
	var autocomplete_class = ".autocomplete-find-offreEmploi"; 
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

