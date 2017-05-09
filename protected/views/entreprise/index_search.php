<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

$this->breadcrumbs=array(
	'Entreprises',
);

?>

<h1>Entreprises qui correspondent à votre recherche</h1>

<?php 

	echo "<hr/>";

/*Affichage des infos pour chaque entreprise*/
foreach ($data as $entreprise){

	echo "<p>Nom de l'entreprise : ".CHtml::link($entreprise->nom_entreprise.'</p>',array('entreprise/view', 'id'=>$entreprise->id_entreprise));
	echo "<p>Téléphone de l'entreprise : ".$entreprise->telephone_entreprise."</p>";
	echo "<p>Ville de l'entreprise : ".$entreprise->Adresse->ville."</p>";
	echo "<hr/>";
}

 ?>