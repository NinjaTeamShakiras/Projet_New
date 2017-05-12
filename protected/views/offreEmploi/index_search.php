<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/

	$this->menu=array(
		array('label'=>'Liste des offres d\'emplois', 'url'=>array('/offreEmploi/index')), // Voir toutes les offres d'emplois
		//array('label'=>'Nouvelle recherche d\'offres d\'emplois', 'url'=>array('/offreEmploi/recherche')), // Rechercher des offres d'emplois
	);

?>



<h1>Nouvelle recherche : </h1>

<?php
	$login = Yii::app()->user->getId();
	// Récupération de l'utilisateur
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login));
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








<h1>Résultat de votre recherche : </h1>


<?php
	$login = Yii::app()->user->getId();
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); // Récupération de l'utilisateur

	$tablePostuler = Postuler::model()->FindAll(); // On récupère la table postuler
	$nombreOffre = sizeof($data); // Nombre d'offre total


	if($nombreOffre>0)
	{// Si il y a des offres on affiche leurs nombres
		print("<p> ".$nombreOffre." correspondent à votre recherche.</p>");


		foreach($data as $offre)
		{ // On affiche toutes les offres correspondant à la recherche
			$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

			// Pour récupéré l'adresse : 
			$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
			$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));


			print("<p> Proposé par : ".$entreprise->nom_entreprise."</p>");
			print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
			print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
			print("<p> Type de l'offre : ".$offre->type_offre_emploi."</p>");
			print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
			print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
			print("<p> Lieu : ".$adresse->ville." </p>");
			print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
			print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
			print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");

			// Bonus : si un employé est connecté et a postulé à l'offre en question, on affiche qu'il a postuler avec la date.
			if($utilisateur != null)
			{
				foreach($tablePostuler as $postuler)
				{
				 	if( ($postuler->id_offre_emploi == $offre->id_offre_emploi) && ($postuler->id_employe == $utilisateur->id_employe) )
				 	{ // Si l'offre de la table postuler concerne l'offre en question et quel concerne l'employé :
				 		print("<p> Vous avez postuler à cette offre le : ".$this->changeDateNaissance($postuler->date_postule)."</p>");
				 	}
				}
			}
			

			echo CHtml::link('Voir cette offre' ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));
			echo "<hr/>";
		}

	}
	else
	{// Sinon, on dit simplement qu'il n'y en a pas
		print("<p> Aucune offre ne correspondent à votre recherche.</p>");
	}
	
?>
