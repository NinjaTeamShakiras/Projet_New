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
			'postOnly + delete', // we only allow deletion via POST request
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
		$model=new Entreprise;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Entreprise']))
		{
			$model->attributes=$_POST['Entreprise'];
			if($model->save())
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Entreprise']))
		{
			$model->attributes=$_POST['Entreprise'];
			if($model->save())
				Yii::app()->user->setFlash('success_update_entreprise', "<p style = color:blue;>Votre profil à bien été mis à jour !</p>");
				$this->redirect(array('view','id'=>$model->id_entreprise));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			Yii::app()->user->setFlash('success_delete_entreprise', "<p style = color:blue;>Votre profil à bien été supprimer !</p>");
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		unset(Yii::app()->session['login']);
		Yii::app()->session['login'] = 'entreprise';

		$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));
		
		if($user == null)
		{
			Yii::app()->user->loginRequired();
		}

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
			echo "Vous n'avez rien remplis.";
			$this->render('index_search');
		}

	}


	public function actionCandidats()
	{
		$this->render('candidatures',array('data'=>-2));
	}



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



}
