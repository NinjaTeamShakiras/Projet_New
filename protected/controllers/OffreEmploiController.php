<?php

class OffreEmploiController extends Controller
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

		// Si employe on donne acces a la liste d'offre, à une ofre en particulier et à la possibilité de candidater
		if($user->getState('type') == 'employe')
		{
			return array(
				array('allow',
					  'actions'=>['index','view', 'employePostule'],
					),
				array('deny',
					  'actions'=>['admin'],
					),
			);
		}

		// Si employe on donne acces a la liste d'offre, à une ofre en particulier à la modification d'une offre et à la suppression
		if($user->getState('type') == 'entreprise')
		{
			return array(
					array('allow',
						  'actions'=>['view', 'index', 'delete', 'update'],
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
		$model=new OffreEmploi;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OffreEmploi']))
		{
			$model->attributes=$_POST['OffreEmploi'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_offre_emploi));
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

		if(isset($_POST['OffreEmploi']))
		{
			$model->attributes=$_POST['OffreEmploi'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_offre_emploi));
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
		// On récupère les candidatures de l'offre
		$candidatures = Postuler::model()->FindAll("id_offre_emploi LIKE '$id'");
		
		
		// Suppression des candidatures de l'offre si il y en a
		if($candidatures != null)
		{
			foreach($candidatures as $candidature)
			{
				$candidature->delete();
			}
		}
		

		// Récupération de l'offre
		$offre = OffreEmploi::model()->FindByAttributes(array('id_offre_emploi'=>$id));

		// Suppression de l'offre
		$offre->delete();

		//$this->loadModel($id)->delete();
		$this->redirect('index.php?r=offreEmploi/index');

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}




	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('OffreEmploi');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new OffreEmploi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OffreEmploi']))
			$model->attributes=$_GET['OffreEmploi'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}



	/* Fonction qui change la date au formatr Américain pour la BDD */
	protected function changeDateBDD($date)
	{
		$result = NULL;
		$day = 0;
		$month = 0;
		$year = 0;

		//On récupère chaque valeur grâce a substr
		$year = substr($date, 6, 4);
		$month = substr($date, 3, 2);
		$day = substr($date, 0, 2);

		$result = $year."-".$month."-".$day;

		return $result;
	}




	/*	Fonction qui change la date au format français*/
	protected function changeDateNaissance($date)
	{
		$result = NULL;
		$day = 0;
		$month = 0;
		$year = 0;

		//On récupère chaque valeur grâce a substr
		$year = substr($date, 0, 4);
		$month = substr($date, 5, 2);
		$day = substr($date, 8, 2);

		$result = $day."/".$month."/".$year;

		return $result;

	}




	/**
	 * Permet de postuler à une offre d'emploie
	 * @param id_offre : c'est l'id de l'offre d'emploie en question
	 */
	public function actionPostule( $id_offre )
	{
		// On récupere l'id_employe
		$idemploye = Utilisateur::model()->FindByAttributes(array('mail' => Yii::app()->user->getId()))->id_employe;

		// Boolléen qui vérifiera si l'employer à déjà postuler
		$employeAPostuler = false;

		// On récupère la table Postuler
		$tablePostuler = Postuler::model()->FindAll();

		// On vérifie si un champs comprend l'id de l'employé et l'id de l'offre. Si c'est le cas, l'employé à déjà postuler
		foreach($tablePostuler as $postuler){
			if($postuler->id_employe == $idemploye && $postuler->id_offre_emploi == $id_offre){
				$employeAPostuler = true;
			}
		}

		if(!$employeAPostuler)
		{ // Si l'employé n'avais pas postuler
			$date = (new \DateTime())->format('Y-m-d H:i:s'); // On récupère la date actuelle
			$postuler = new Postuler; // On créer une nouvelle table Postuler que l'on remplie

			// On remplie le nouveau champs
			$postuler->id_employe = $idemploye; 
			$postuler->id_offre_emploi = $id_offre;
			$postuler->date_postule = $date;
			$postuler->save();
		}

		if($postuler->save())
		{ // Si la sauvegarde fonctionne
			$this->redirect(array('view','id'=>$id_offre));
		}
		else
		{ // Si erreur de sauvegarde

		}
		
	
	}




	/**
	 * Lists all models postuler.
	 */
	public function actionMesOffres()
	{
		$dataProvider=new CActiveDataProvider('OffreEmploi');
		$this->render('mesOffres',array(
			'dataProvider'=>$dataProvider,
		));
	}



	/**
	 * Permet de Dépostuler d'une offre d'emploie
	 * @param id_offre : c'est l'id de l'offre d'emploie en question
	 */
	public function actionDepostule( $id_offre )
	{
		// On récupere l'id_employe
		$employe = Utilisateur::model()->FindByAttributes(array('mail' => Yii::app()->user->getId()))->id_employe;

		// On récupère la table Postuler
		$tablePostuler = Postuler::model()->FindAll();

		// On vérifie si un champs comprend l'id de l'employé et l'id de l'offre. Si c'est le cas, l'employé à déjà postuler
		foreach($tablePostuler as $postuler){
			if($postuler->id_employe == $employe && $postuler->id_offre_emploi == $id_offre){
				$postuler->delete(); // On supprime la ligne concerné
			}
		}
		
		$this->redirect(array('view','id'=>$id_offre));
	
	}




	/*	Fonction qui recherche une ou plusieurs entreprises dans la base en fonction 
		des infos entrées par l'utilisateur 
	*/		
	public function actionSearch()
	{
		$model = OffreEmploi::model()->FindAll();

		$posteIsSet = false; // Le POSTE à été donné ou non dans le formulaire de recherche
		$typeIsSet = false; // Le TYPE à été donné ou non dans le formulaire de recherche
		$lieuIsSet = false; // Le LIEU à été donné ou non dans le formulaire de recherche
		$secteurIsSet = false; // Le SECTEUR à été donné ou non dans le formulaire de recherche
		$requete = ""; // Requète SQL de recherche des offre correspondante
		$tabOffre = array();


		// On récupère les données du formulaire
		if(isset($_POST['OffreEmploi']))
		{
			$poste_offre_emploi = $_POST['OffreEmploi']['poste_offre_emploi'];
			$type_offre_emploi = $_POST['OffreEmploi']['type_offre_emploi'];
			$lieu_offre_emploi = $_POST['Adresse']['ville'];
			$secteur_offre_emploi = $_POST['Entreprise']['secteur_activite_entreprise'];


			$tabOffre = OffreEmploi::model()->findAll(); // Tableau de résultat d'offre rechercher

			// Initialisation des varaiable temp
			$tabOffreTrouver = array(); // Tableau de stoquage des résultat d'une recherche brut
			$tabOffreTemp = array(); // Tableau de stoquage des résultat des recherches matché aux autres recherches
			$i=0;


			/**** 		RECHERCHE		****/

			/* 		Recherche par POSTE 		*/

			if($poste_offre_emploi != "" && ($tabOffre != null) )
			{ // Si le poste est donnée, on ajoute la requète et on déclare qu'il est donnée.
				$tabOffreTrouver = OffreEmploi::model()->findAll("poste_offre_emploi LIKE '%$poste_offre_emploi%'");
				foreach ($tabOffre as $offreDeCote) // Pour TOUTES les offres de coté
				{					
					foreach($tabOffreTrouver as $offre)
					{ // on parcours le tableau de nos offres rechercher
						if($offre->id_offre_emploi == $offreDeCote->id_offre_emploi)
						{ // Si l'une des offre à déjà été mise de coté, on peux la conserver
							$tabOffreTemp[$i] = $offreDeCote; // On stoque dans un tableau temporaire qui deviendra $tabOffre
							$i++;
						}
					}
				}
				$tabOffre = $tabOffreTemp; // On rétablis $tabOffre avec le nouveau résultat affiné
				
				// Réinitialisation des variable temporaire
				$tabOffreTrouver = array();
				$tabOffreTemp = array(); 
				$i=0;
			}





			/*		 Recherche par TYPE 		*/

			if($type_offre_emploi != "" && ($tabOffre != null) )
			{
				$tabOffreTrouver = OffreEmploi::model()->findAll("type_offre_emploi = '$type_offre_emploi'");
				foreach ($tabOffre as $offreDeCote) // Pour TOUTES les offres de coté
				{
					foreach($tabOffreTrouver as $offre)
					{ // on parcours le tableau de nos offres rechercher
						if($offre->id_offre_emploi == $offreDeCote->id_offre_emploi)
						{ // Si l'une des offre à déjà été mise de coté, on peux la conserver
							$tabOffreTemp[$i] = $offreDeCote; // On stoque dans un tableau temporaire qui deviendra $tabOffre
							$i++;
						}
					}
				}
				$tabOffre = $tabOffreTemp; // On rétablis $tabOffre avec le nouveau résultat affiné
				
				// Réinitialisation des variable temporaire
				$tabOffreTrouver = array();
				$tabOffreTemp = array(); 
				$i=0;
			}





			/*		 Recherche par LIEU  		*/

			if($lieu_offre_emploi != "" && ($tabOffre != null) )
			{
				$tabAdresseTrouver = adresse::model()->FindAll("ville LIKE '%$lieu_offre_emploi%'"); // On récupère toutes les adresses ressemblant à l'adresse données

				// On cherche quel offre propose la même adresse et on match avec les résultats précédent
				foreach ($tabOffre as $offreDeCote) // Pour TOUTES les offres de coté
				{
					$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offreDeCote->id_entreprise)); // On récupère l'entreprise qui propose l'offre
					// Pour récupéré l'adresse : 
					$userOffre = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
					$adresseOffre = adresse::model()->FindByAttributes(array("id_adresse"=>$userOffre->id_adresse)); // On récupère l'adresse de l'offre en question

					foreach($tabAdresseTrouver as $adresseTrouver)
					{ // On parcours les adresses trouvées
						
						if($adresseOffre->ville == $adresseTrouver->ville)
						{ // Si l'adresse de l'offre en question est la même que celle rendu par la recherche
							$tabOffreTemp[$i] = $offreDeCote; // On stoque dans un tableau temporaire qui deviendra $tabOffre
							$i++;
						}
					}
				}
				$tabOffre = $tabOffreTemp; // On rétablis $tabOffre avec le nouveau résultat affiné
				
				// Réinitialisation des variable temporaire
				$tabOffreTemp = array(); 
				$i=0;
			}




			/*		 Recherche par SECTEUR			*/

			if($secteur_offre_emploi != "" && ($tabOffre != null) ) 
			{ // Si le secteur à été remplis
				foreach ($tabOffre as $offreDeCote) // Pour TOUTES les offres ...
				{
					$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre
					
					if($secteur_offre_emploi == $entreprise->secteur_activite_entreprise)
					{ // Si le secteur rentré correspond au secteur de l'offre
						$tabOffreTemp[$i] = $offreDeCote; // On stoque dans un tableau temporaire qui deviendra $tabOffre
						$i++;
					}
				}
				$tabOffre = $tabOffreTemp; // On rétablis $tabOffre avec le nouveau résultat affiné
				
				// Réinitialisation des variable temporaire
				$tabOffreTemp = array(); 
				$i=0;
			}

			/**** 		FIN RECHERCHE 		****/

			$this->render('index_search', array('data'=>$tabOffre)); // On redirige avec le resultat.

		}
		else
		{
			echo "Vous n'avez rien remplis.";
			$this->render('index_search');
		}
		
	}






	/*		Fonction utilisée lors de l'auto-complétion de la recherche par Poste 		*/
	public function actionGetAllPosteJSON()
	{
		/*		Tableau pour sauvegarder les résultats*/
		$results_arr = array();

		foreach ( OffreEmploi::model()->findAll() as $key_int => $value_obj )
		{
			array_push( $results_arr, $value_obj->poste_offre_emploi );
		}

		echo json_encode($results_arr);
	}


	/*		Fonction utilisée lors de l'auto-complétion de la recherche par Lieu 		*/
	public function actionGetAllLieuJSON()
	{
		/*		Tableau pour sauvegarder les résultats*/
		$results_arr = array();

		foreach ( Adresse::model()->findAll() as $key_int => $value_obj )
		{
			array_push( $results_arr, $value_obj->ville );
		}

		echo json_encode($results_arr);
	}



	/**
	 * Lists all models postuler.
	 */
	public function actionRecherche()
	{
		$this->render('recherche');
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OffreEmploi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OffreEmploi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OffreEmploi $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='offre-emploi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}




}
