<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */

/*$this->breadcrumbs=array(
	'Offre Emplois'=>array('index'),
	$model->id_offre_emploi,
);
*/

$titre ="";
$utilisateur = Utilisateur::model()->FindByAttributes(array("login"=> Yii::app()->user->getId()));

if (!Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si entreprise on affiche la possibilité de maj/suppr l'offre en question
		$this->menu=array(
			//array('label'=>'Créer une offre', 'url'=>array('create')),
			array('label'=>'Modifier ', 'url'=>array('update', 'id'=>$model->id_offre_emploi)),
			//Marche pas
			//array('label'=>'Supprimer', 'url'=>array('delete','id'=>$model->id_offre_emploi)),
			//array('label'=>'Supprimer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_offre_emploi),'confirm'=>'Vous êtes sur le point de supprimer, voulez vous continuer ?')),
		);
		$titre = "Mon offre d'emploi";


	}
	else if( Utilisateur::est_employe(Yii::app()->user->role))  
	{  // Si employé on affiche la possibilité de postuler à l'offre en question
		$tablePostuler = Postuler::model()->FindAll();
		$aPostuler = false;
		foreach($tablePostuler as $postuler)
		{
			if($postuler->id_offre_emploi == $model->id_offre_emploi && $postuler->id_employe == $utilisateur->id_employe )
			{
				$aPostuler = true;
			}
		}

		if($aPostuler)
		{
			$this->menu=array(
				array('label'=>'Dépostuler', 'url'=>array('depostule', 'id_offre'=>$model->id_offre_emploi)), 
			);
		}
		else
		{
			$this->menu=array(
				array('label'=>'Postuler', 'url'=>array('postule', 'id_offre'=>$model->id_offre_emploi)), 
			);
		}
		$titre = "Offre d'emploi";
		
	}
	else 
	{ // Si autre on affiche toutes les possibilité
		$this->menu=array(
			array('label'=>'Postuler', 'url'=>array('index')),
			array('label'=>'Créer une offre', 'url'=>array('create')),
			array('label'=>'Modifier', 'url'=>array('update', 'id'=>$model->id_offre_emploi)),
			//Marche pas
			//array('label'=>'Supprimer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_offre_emploi),'confirm'=>'Vous êtes sur le point de supprimer, voulez vous continuer ?')),
		);

	}

?>

<h1><?php echo $titre ?> (offre <?php echo $model->id_offre_emploi; ?>)</h1>

<?php
	$date_creation = $this->changeDateNaissance($model->date_creation_offre_emploi);
	$date_debut = $this->changeDateNaissance($model->date_debut_offre_emploi);

	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_offre_emploi',
		'poste_offre_emploi',
		'type_offre_emploi',
		array(
			'label'=>'Date de début de l\'offre',
			'value'=>$model->date_debut_offre_emploi != NULL ? $date_debut : "Non renseignée",
			),
		'salaire_offre_emploi',
		'experience_offre_emploi',
		'description_offre_emploi',
		'id_entreprise',
		array(
			'label'=>'Date de création de l\'offre',
			'value'=>$model->date_creation_offre_emploi != NULL ? $date_creation : "Non renseignée",
			),
		),
	));

	if (!Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si entreprise on affiche les candidatures éventuelle
		$nombreCandidature = 0;
		$tabIdEmploye=array();
		$candidats = Postuler::model()->FindAll("id_offre_emploi =".$model->id_offre_emploi); // On récupère tout les candidats à l'offre

		// Recherche du nombre de candidature et des candidat
		foreach($candidats as $candidat) // Pour chaque candidat
		{ // On stoque tout les id des employé qui on candidaté dans un tableau
			$tabIdEmploye[$nombreCandidature] = $candidat->id_employe;
			$nombreCandidature++;
		}
		

		// Affichage des candidats ou non
		if($nombreCandidature > 0) // Si il y a des candidats
		{ // On affiche le nombre de candidat, puis un lien vers les candidats
			print("<p> Vous avez ".$nombreCandidature." candidature pour cette offre : </p>");

			for($i=0; $i<$nombreCandidature; $i++)
			{ // On affiche un lien pour chacun des candidat
				echo CHtml::link("<p> Voir la candidature $i </p>",array('employe/view', 'id'=>$tabIdEmploye[$i]));
			}
		}
		else
		{
			print("<p> Vous n'avez aucune candidature à cette offre </p>");
		}

	}


	if (!Utilisateur::est_employe(Yii::app()->user->role) )
	{
		echo CHtml::link('Supprimer cette offre', array('offreEmploi/delete', 'id'=>$model->id_offre_emploi), array('confirm'=> 'Etes-vous sur de vouloir supprimer cette offre ?'));
	}

	// !!!! NE MARCHE PAS !!!
	/*		Message de postulation	*/
	if( Yii::app()->request->getParam( 'postule' ) != NULL && Yii::app()->request->getParam( 'postule' ) == "true" ) 
		echo '<div class="success-avis-employe" style="margin : 2% 0%; color : blue; border: solid 2px blue; padding : 2%;" >Vous avez bien postuler à cette offre</div>';

?>



