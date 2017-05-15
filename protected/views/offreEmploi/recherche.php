<?php
/* @var $this OffreEmploiController */
/* @var $dataProvider CActiveDataProvider */


$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

?>


<!--	MENU 	-->
		<!-- Formulaire avec le bouton pour voir mon profil -->
		<div class="wide form">
			<?php
			//Début du form
			$form=$this->beginWidget('CActiveForm',
				array(
					'action'=>Yii::app()->createUrl('/employe/view',array('id'=>$utilisateur->id_employe)),
				)
			);
			?>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Mon profil'); ?>
			</div>

			<?php $this->endWidget(); ?>
		
		</div>




		<!-- Formulaire avec le bouton pour voir mes candidatures -->
		<div class="wide form">
			<?php
				//Début du form
				$form=$this->beginWidget('CActiveForm',
					array(
						'action'=>Yii::app()->createUrl('offreEmploi/mesOffres') ,
					)
				);
			?>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Mes candidatures'); ?>
			</div>

			<?php $this->endWidget(); ?>
				
		</div>




<!-- Titre page -->
<h1>Rechercher une offre : </h1>

<?php
	$model = OffreEmploi::model();
	// Récupération de toutes les offres
	$tabOffre = OffreEmploi::model()->FindAll();
	// Récupération de toutes les entreprises
	$tabEntreprise = entreprise::model()->FindAll();

	$entreprise = entreprise::model();
	$adresse = adresse::model();

	// Nombre d'offre total
	$nombreOffre = sizeof($tabOffre); 

	print("<p> Trouver les offres qui vous correspondent parmis ".$nombreOffre." offres.</p>");
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
			//Recherche par POSTE
			echo $form->textField(
				$model,'poste_offre_emploi', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllPosteJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par poste',
				)
			);
		?>
	</div>
	
	<div class="row">	
		<?php
			//Recherche par TYPE DE CONTRAT (liste déroulante)
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_type = array('' => Yii::t('', 'Sélectionner...'));
			$typeOffre = CHtml::listData($tabOffre,'type_offre_emploi', 'type_offre_emploi'); // On récupère tout les type d'offre existant
			echo $form->dropDownList($model,'type_offre_emploi',$static_type + $typeOffre); // On affiche une liste déroulante de toutes les offres
		?>
	</div>
	
	<div class="row">
		<?php
			//Recherche par LIEU
			echo $form->textField(
				$adresse,'ville', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllLieuJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par lieu',
				)
			);
		?>
	</div>
	
	<div class="row">	
		<?php
			//Recherche par SECTEUR
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_secteur = array('' => Yii::t('', 'Sélectionner...'));
			$secteurOffre = CHtml::listData($tabEntreprise,'secteur_activite_entreprise', 'secteur_activite_entreprise'); // On récupère tout les secteur d'offre existant
			echo $form->dropDownList($entreprise,'secteur_activite_entreprise',$static_secteur + $secteurOffre); // On affiche une liste déroulante de tout les secteur d'activité
		?>
	</div>
	
	<div class="row buttons">	
		<?php
			// Button d'envoi
			echo CHtml::submitButton('Rechercher');
		?>
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

