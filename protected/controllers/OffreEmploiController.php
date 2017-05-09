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
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
		$employe = Utilisateur::model()->FindByAttributes(array('mail' => Yii::app()->user->getId()))->id_employe;

		// Boolléen qui vérifiera si l'employer à déjà postuler
		$employeAPostuler = false;

		// On récupère la table Postuler
		$tablePostuler = Postuler::model()->FindAll();

		// On vérifie si un champs comprend l'id de l'employé et l'id de l'offre. Si c'est le cas, l'employé à déjà postuler
		foreach($tablePostuler as $postuler){
			if($postuler->id_employe == $employe && $postuler->id_offre_emploi == $id_offre){
				$employeAPostuler = true;
			}
		}

		if($employeAPostuler)
		{ // Si l'employé à déjà postuler à cette offre d'emploi on refuse
			echo "Vous avez déjà postuler à cette offre";
		}
		else
		{
			$postuler = new Postuler; // On créer une nouvelle table Postuler que l'on remplie
			$postuler->id_employe = $employe;
			$postuler->id_offre_emploi = $id_offre;
			echo "Vous venez de postuler à cette offre";
		}
		
		//var_dump( $postuler );
		if($postuler->save())
			$this->redirect(array('view','id'=>$id_offre));
	
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
		//On récupère la liste des offres d'emplois par rapport au type entré
		$type_offre = $_POST['Entreprise']['nom_entreprise'];
		$entreprises = Entreprise::model()->FindAll("nom_entreprise LIKE '%$nom_entreprise%'");

		$this->render('index_search', array('data'=>$entreprises));
	}

	/*		Fonction utilisée lors de l'auto-complétion de la page d'accueil pour envoyer les entreprises 		*/
	public function actionGetAllEntreprisesJSON()
	{
		/*		Tableau pour sauvegarder les résultats*/
		$results_arr = array();

		foreach ( Entreprise::model()->findAll() as $key_int => $value_obj ) {
			array_push( $results_arr, $value_obj->nom_entreprise );
		}

		echo json_encode($results_arr);
	}
}
