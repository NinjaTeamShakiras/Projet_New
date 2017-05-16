<?php
/* @var $this EmployeController */
/* @var $model Employe */


/* -- Override de jquery avec la version 3.0 -- */
$cs = Yii::app()->clientScript;
$cs->scriptMap = array(
'jquery.js' => Yii::app()->request->baseUrl.'/js/jquery.js',
);
$cs->registerCoreScript('jquery');
/* -- Utilisation du script -- */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/employe_view.js');
?>


<?php

	//On récupère les infos de l'employé qu'on consulte
	$employe = Utilisateur::model()->FindByAttributes(array('id_employe'=>$model->id_employe));
	//On récupère l'utilisateur qui visite la page
	$user  = Utilisateur::model()->FindByAttributes(array('mail'=>Yii::app()->user->getID()));
	//On récupère l'adresse correspondant à l'employé
	$adresse = Adresse::model()->FindByAttributes(array('id_adresse'=>$employe->id_adresse));
?>

<!-- MENU 	-->
<div class="dropdown">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
	Menu 
	<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		<li>
			<a href="index.php?r=offreEmploi/mesOffres&id=<?php echo $user->id_employe;?>" title="Mon profil">
			Mes Candidatures
			</a>
		</li>
		<li>
			<a href="index.php?r=offreEmploi/recherche&id=<?php echo $user->id_employe;?>" title="Mon profil">
			Rechercher une offre
			</a>
		</li>
		<li>
			<a href="index.php?r=Employe/parametres" title="Parametres">
			Paramètres de mon compte
			</a>
		</li>
	</ul>
</div>


<!-- Affichage des infos persos -->
<?php 
//Si l'adresse est nulle on dit qu'elle n'est pas renseignée
	if($adresse == null){
		$adresse = "Non renseignée";
	}
	//Sinon, on définit une variable adresse récupérée depuis model Adresse
	else
	{
		$adresse = $adresse->rue.", ".$adresse->code_postal." ".$adresse->ville;
	}

	//On fait pareil pour le site Web
	if($employe->site_web == null)
	{
		$employe->site_web = "Non renseigné";
	}

	//On fait pareil pour les téléphones
	if($employe->telephone == null)
	{
		$employe->telephone = "Non renseigné";
	}

	if($employe->telephone2 == null)
	{
		$employe->telephone2 = "Non renseigné";
	}

	//On définit si l'employé cherche un travail ou non
	if($model->employe_travaille == null)
	{
		$model->employe_travaille = "Non renseigné";
	}
	else if($model->employe_travaille == 1)
	{
		$model->employe_travaille = "Non";
	}
	else if($model->employe_travaille == 0)
	{
		$model->employe_travaille = "Oui";
	}
?>


<!-- Affichage des infos persos -->
<?php

//Si l'utilisateur consulte sa page on affiche les infos persos
//Sinon, si l'utilisateur consulte les infos de quelqu'un d'autre, on affiche pas les infos persos
if($user->id_employe == $_GET['id'])
{	
	echo "<h3>Mes informations personnelles</h3>";

	echo "<div class='form'>";		

		//Début du formulaire de vue des infos persos
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/update', array('id'=>$model->id_employe)),
			)
		);

		//On affiche toutes les infos persos de l'employé
		echo "<div class='row'>";
			echo Yii::app()->user->getFlash('success_maj_infos_persos');
			echo "<p>Nom : ".$model->nom_employe." ".$model->prenom_employe."</p>";
			echo "<p>Date de naissance : ".$this->changeDateNaissance($model->date_naissance_employe)."</p>";
			echo "<p>Adressse : ".$adresse."</p>";
			echo "<p>Téléphone : ".$employe->telephone."</p>";
			echo "<p>Autre téléphone : ".$employe->telephone2."</p>";
			echo "<p>Adresse mail : ".$employe->mail."</p>";
			echo "<p>Site WEB : ".$employe->site_web."</p>";
			echo "<p>Recherche un travail : ".$model->employe_travaille."</p>";
		echo "</div>";

		//Bouton de mise à jour des infos persos
		echo "<div class='row'>";
			echo Chtml::submitButton('Mettre à jour mes informations personelles');
		echo "</div>";

	$this->endWidget();	

	echo "</div>";
}
?>	
<!-- Fin des infos persos -->



<!-- Début des infos complémentaires -->
<?php
//Le titre change en fonction de si on consulte sa propre page ou celle de quelqu'un d'autre
if($user->id_employe == $_GET['id'])
{
	echo "<h3>Mes informations complémentaires</h3>";
}
else
{
	echo "<h3>Informations complémentaires</h3>";
}
?>

<?php
	//Récupération des modèles d'informations complémentaires
	$competences = Competence::model()->FindAll("id_employe =".$model->id_employe);
	$formations = Formation::model()->FindAll("id_employe =".$model->id_employe);
	$exp_pros = ExperiencePro::model()->FindAll("id_employe =".$model->id_employe);
?>

<div class="wide form">

	<?php
	//Début du formulaire de vue des infos complémentaires
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/ajoutInfos'),
			)
		);
	?>	

	<?php
		//Le titre change en fonction de si on consulte sa propre page ou celle de quelqu'un d'autre
		if($user->id_employe == $_GET['id'])
		{
			echo "<h4>Mes formations / Parcours scolaire</h4>";
		}
		else
		{
			echo "<h4>Formations / Parcours scolaire</h4>";
		}
	?>

	<div class="row">
		<?php
			//Pour chaque formation, on affiche les infos de cette formation
			foreach($formations as $formation)
			{
				echo Yii::app()->user->getFlash('success_maj_formation');
				echo Yii::app()->user->getFlash('success_sup_formation');
				echo "<p><strong>Formation à ".$formation->etablissement_formation." du ".$this->changeDateNaissance($formation->date_debut_formation)." au ".$this->changeDateNaissance($formation->date_fin_formation)." : </strong></p>";
				echo "<ul>";
				echo "<li>Intitulé de la formation : ".$formation->intitule_formation."</li>";
				echo "<li>Diplome obtenu : ".$formation->diplome_formation."</li>";
				echo "<li>Description de la formation : ".$formation->description_formation."</li>";
				echo "</ul>";
				echo CHtml::link('Mettre à jour cette formation',array('Formation/update', 'id'=>$formation->id_formation));
				echo " ";
				echo CHtml::link('Supprimer cette formation',array('Formation/delete', 'id'=>$formation->id_formation)); 
			}
		?>
	</div>
	
	<?php
	//Le titre change en fonction de si on consulte sa propre page ou celle de quelqu'un d'autre
	if($user->id_employe == $_GET['id'])
	{
		echo "<h4>Mes expériences professionnelles</h4>";
	}
	else
	{
		echo "<h4>Expériences professionnelles</h4>";
	}
	?>

	<div class="row">
		<?php
			//Pour chque experience pro, on affiche les infos de l'experience
			foreach($exp_pros as $exp_pro)
			{
				echo Yii::app()->user->getFlash('success_maj_exp');
				echo Yii::app()->user->getFlash('success_sup_exp');
				echo "<p><strong>".$exp_pro->intitule_experience." du ".$this->changeDateNaissance($exp_pro->date_debut_experience)." au ".$this->changeDateNaissance($exp_pro->date_fin_experience)."</strong></p>";
				echo "<ul>";	
				echo "<li>Entreprise dans laquelle vous êtiez salarié : ".$exp_pro->entreprise_experience."</li>";
				echo "<li>Description de l'expérience pro : ".$exp_pro->description_experience."</li>";
				echo "</ul>";
				echo CHtml::link('Mettre à jour cette expérience',array('ExperiencePro/update', 'id'=>$exp_pro->id_experience));
				echo " ";
				echo CHtml::link('Supprimer cette expérience',array('ExperiencePro/delete', 'id'=>$exp_pro->id_experience)); 
			}
		?>	
	</div>

	<?php
	//Le titre change en fonction de si on consulte sa propre page ou celle de quelqu'un d'autre
	if($user->id_employe == $_GET['id'])
	{
		echo "<h4>Mes compétences</h4>";
	}
	else
	{
		echo "<h4>Compétences</h4>";
	}
	?>

	<div class="row">
		<ul>
		<?php
			//Pour chaque compétence, on affiche les infos de la compétence
			foreach($competences as $competence)
			{
				echo Yii::app()->user->getFlash('success_maj_competence');
				echo Yii::app()->user->getFlash('success_sup_competence');
				echo "<li>".$competence->intitule_competence.", Niveau ".$competence->niveau_competence."/5</li>";
				echo CHtml::link('Mettre à jour cette compétence',array('Competence/update', 'id'=>$competence->id_competence));
				echo " ";
				echo CHtml::link('Supprimer cette compétence',array('Competence/delete', 'id'=>$competence->id_competence)); 
			}
		?>
		</ul>
	</div>

	<div class="row">
		<?php echo CHtml::submitButton('Ajouter de nouvelles informations complémentaires', array('name'=>'btnajout')); ?>

	</div>	

	<?php $this->endWidget();?>	
</div>


<?php 

	/* --- Page pour traiter le pdf --- */
	$this->renderPartial( 'cv_edit', array( 'model' => $model ) );
?>
