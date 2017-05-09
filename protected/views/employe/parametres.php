<?php
/*
	@var $model id recup de view
*/
?>	


<h1>Paramètres de mon compte</h1>
<?php 

//Liens pour maj et supression compte
echo CHtml::link('Modifier mon compte',array('update', 'id'=>$model->id));
echo CHtml::link('Suprimer mon compte',array('delete', 'id'=>$model->id));

$utilisateur = Utilisateur::model()->FindByAttributes(array('id_employe' => $model->id_employe));

echo 'Date de création du compte'.$utilisateur->date_creation_utilisateur;
echo 'Date de dernière connexion'.$utilisateur->date_derniere_connexion;

?>