<?php

class EntrepriseController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		$user = Yii::app()->user;

		// Si employe on donne acces a rien
		if($user->getState('type') == 'employe')
		{
			return array(
				array('allow',
					  'actions'=>[],
					),
				array('deny',
					  'actions'=>['admin'],
					),
			);
		}

		// Si employe on donne acces a la liste d'offre, à view, index, search, à delete et à update
		if($user->getState('type') == 'entreprise')
		{
			return array(
					array('allow',
						  'actions'=>['view', 'index', 'delete', 'update', 'search'],
						),
					array('deny',
						  'actions'=>['admin'],
						),
			);
		}	

		if($user->getState('type') == NULL)
		{
			return array(
					array('deny',
						  'actions'=>['*'],
						  ),
					);
		}	
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		if(isset($_POST['btnretour']))
		{ // annulation de l'action
			$this->redirect('site/index');
		}

		$model=new Entreprise;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Entreprise']))
		{
			$model->attributes=$_POST['Entreprise'];
			if($model->save())
				Yii::app()->user->setFlash('success_create_entreprise', "<p style = color:blue;>Votre profil à bien été créé !</p>");
				$this->redirect(array('view','id'=>$model->id_entreprise));

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}





	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		if(isset($_POST['btnretour']))
		{ // annulation de l'action
			$this->redirect(array('entreprise/view', 'id'=>$id));
		}

		$model=$this->loadModel($id);



		$utilisateur = Utilisateur::model()->findByAttributes(array('id_entreprise'=>$model->id_entreprise));		
		$adresse = Adresse::model()->findByAttributes(array('id_adresse'=>$utilisateur->id_adresse));

		if($adresse == null)
		{
			$adresse = new Adresse;
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Entreprise']) && isset($_POST['Adresse']) && isset($_POST['Utilisateur']))
		{

			//Transormation de la date puisque en Anglais dans la base en français dans le site
			//On enregistre les nouvelles données dans les modèles
			$model->attributes = $_POST['Entreprise'];
			
			$adresse->attributes = $_POST['Adresse'];
			$adresse->save();

			$utilisateur->id_adresse = $adresse->id_adresse;
			$utilisateur->telephone = $_POST['Utilisateur']['telephone'];
			$utilisateur->telephone2 = $_POST['Utilisateur']['telephone2'];
			$utilisateur->site_web = $_POST['Utilisateur']['site_web'];
			$utilisateur->mail = $_POST['Utilisateur']['mail'];

			//On enregistre le modèle et on redirige
			if($model->save() && $utilisateur->save())
			{
				Yii::app()->user->setFlash('success_update_entreprise', "<p style = color:blue;>Votre profil à bien été mise à jour !</p>");
				$this->redirect(array('view','id'=>$model->id_entreprise));
			}

		}

		$this->render('update',array(
			'model'=>$model, 'adresse'=>$adresse, 'utilisateur'=>$utilisateur,
		));

	}







	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		

		//On récupère l'utilisateur dans la base de données
		$utilisateur = Utilisateur::model()->FindByAttributes(array('id_entreprise'=>$id));

		/*Pour toutes les classes suivantes, on supprime soit l'occurence en entier, soit le champ
		id_utilisateur est mis a null dans l'occurence */

		// On récupère les offres concernant l'entreprise
		$offres = offreEmploi::model()->FindAll("id_entreprise = '$utilisateur->id_entreprise'");

		// On récupère toutes les candidatures
		$postules = postuler::model()->FindAll();
		foreach($offres as $offre)
		{ // Pour chaque offre on supprime les candidats à l'offre puis on supprime l'offre
			foreach($postules as $candidature)
			{
				if($candidature->id_offre_emploi == $offre->id_offre_emploi)
				{ // Si la candidature est sur l'offre en question, on supprime la candidature
					$candidature->delete();
				}
			}
			$offre->delete();
		}
		

		//On supprime l'utilisateur
		Yii::app()->user->logout(false);
		$utilisateur->delete();


		//On supprime l'entreprise
		$model=$this->loadModel($id)->delete();


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
		{
			//On créé un message flash pour l'utilisateur
			Yii::app()->user->setFlash('suppr_compte', "<p style = color:blue;>Votre profil à bien été supprimer !</p>");
			//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));	
		}
		$this->redirect('index.php');
	}




	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

		$dataProvider=new CActiveDataProvider('Entreprise');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Entreprise('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Entreprise']))
			$model->attributes=$_GET['Entreprise'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Entreprise the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Entreprise::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Entreprise $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='entreprise-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}




	/**
	 * Recherche de cv
	 */
	public function actionSearch()
	{

		$model = competence::model()->FindAll();
		$aRechercher = false;
		
		if(isset($_POST['Competence']))
		{
			// On récupère les données du formulaire
			$intitule_competence = $_POST['Competence']['intitule_competence'];
			$niveau_competence = $_POST['Competence']['niveau_competence'];

			// Tableau de résultat d'employe rechercher
			$tabEmploye = employe::model()->findAll();

			$intituleCompetenceIsSet = false;
			$niveauCompetenceIsSet = false;

			if($intitule_competence != null)
			{
				$intituleCompetenceIsSet = true;
			}
			if( ($niveau_competence != null) && ($niveau_competence != null) )
			{
				$niveauCompetenceIsSet = true;
			}

			// Initialisation des varaiable temp
			$tabTemp = array();
			$i = 0;
			


			/**** 		RECHERCHE		****/

			/* 		Recherche par Intitule et niveau de compétence		*/
			if( ($intituleCompetenceIsSet || $niveauCompetenceIsSet) && ($tabEmploye != null) )
			{
				$requete = "";
				if($intituleCompetenceIsSet && $niveauCompetenceIsSet)
				{
					$requete = "intitule_competence LIKE '%$intitule_competence%' AND niveau_competence LIKE '$niveau_competence'";
				}
				else if($intituleCompetenceIsSet)
				{
					$requete .= "intitule_competence LIKE '%$intitule_competence%'";
				}
				else if($niveauCompetenceIsSet)
				{
					$requete .= "niveau_competence LIKE '$niveau_competence'";
				}

				// On recherche toute les compétences ayant un intituler ressemblant à la recherche / et 
				// éventuellement avec un certain niveau
				$tabIntituleTrouver = competence::model()->findAll($requete);

				foreach($tabEmploye as $employe)
				{
					foreach($tabIntituleTrouver as $competence)
					{ // On parcours le tableau des intitulé de compétence trouvé
						if( ($competence->id_employe == $employe->id_employe) )
						{ // Si l'employe à déjà été mis de coté, on conserve
							$tabTemp[$i] = $employe;
							$i++;

							// Si on ajoute une fois l'employe, il sera dans le tableau ..
							// pas la peine de continuer le match pour cette employe
							// on passe au suivant
							break;
						}
					}
				}
				// On rétablis $tabEmploye avec le nouveau résultat affiné
				$tabEmploye = $tabTemp;

				// Réinitialisation des variable temporaire
				$tabTemp = array(); 
				$i=0;

				$aRechercher = true;
			}


			/**** 		FIN RECHERCHE 		****/
			
			// On redirige avec le resultat.
			$this->render('index_search', array('data'=>$tabEmploye,'aRechercher'=>$aRechercher)); 

		}
		else
		{
			echo "Vous n'avez rien rempli";
			$this->render('index_search');
		}

	}


	/**
	 * Lien de redirection
	 */
	public function actionCandidats()
	{
		$this->render('candidatures',array('data'=>-2));
	}


	/**
	 * Recherche de candidat
	 */
	public function actionCandidatures()
	{

		if($_POST['OffreEmploi']['id_offre_emploi'] != '')
		{
			// On récupère les données du formulaire
			$idOffre = $_POST['OffreEmploi']['id_offre_emploi'];

			$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));


			$offre = offreEmploi::model()->FindByAttributes(array("id_offre_emploi"=>$idOffre));

			$candidatures = postuler::model()->findAll("id_offre_emploi = '$idOffre'");

			$employes = array();

			foreach($candidatures as $candidature)
			{
				$employes[] = employe::model()->findByAttributes(array("id_employe"=>$candidature->id_employe));
			}


			$this->render('candidatures', array('data'=>$employes));

		}
		else
		{
			$this->render('candidatures',array('data'=>-1));
		}

	}





	/*Fonction qui change le numéro de téléphone pour un affichage avec des points tous les deux chiffres
	@params $telephone est le numéro de téléphone*/
	public function afficheTelephone($telephone)
	{
		$res = "";

		for($i = 0; $i<10; $i++)
		{
			//Tous les deux chiffres on ajoute un point
			if($i%2 == 0)
			{
				$num = substr($telephone, $i, 2);
				$res .= $num.".";
			}

			//On enlève le point en trop
			$res = substr($res, 0, 14);
		}

		return $res;
	}


	/*Fonction apellée dans ls paramètres du compte
	--> Soit on se déconnecte, soit on supprime le compte*/
	public function actionParametres()
	{
		//S'il cliques sur supression du compte, on apelle actionDelete de ce controller
		if(isset($_POST['btnsupcompte']))
		{
			$utilisateur = Utilisateur::model()->FindByAttributes(array('mail'=>Yii::app()->user->getID()));
			$this->redirect(array('entreprise/delete', 'id'=>$utilisateur->id_entreprise));
		}

		//Si il cliques sur modifier les paramètres de connexion
		if(isset($_POST['btnmodifco']))
		{
			$this->redirect(array('site/modifParamCo'));
		}

		//Si il cliques sur retour
		if(isset($_POST['btnretour']))
		{
			$utilisateur = Utilisateur::model()->FindByAttributes(array('mail'=>Yii::app()->user->getID()));
			$this->redirect(array('view', 'id'=>$utilisateur->id_entreprise));
		}

		$this->render('parametres');
	}

	
	/*Fonction de déconnexion */
	public function actionDeconnexion()
	{
		Yii::app()->user->logout(false);
		Yii::app()->user->setFlash('logout_ok', "<p style = color:blue;>Vous avez bien été déconnecté(e) !</p>");
		$this->redirect(array('entreprise/index'));
	}




}// END CONTROLLER
