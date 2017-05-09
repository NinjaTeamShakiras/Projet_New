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
			
			$utilisateur = Utilisateur::model()->FindByAttributes(array('login' => Yii::app()->user->getId())); 
			$model->attributes=$_POST['OffreEmploi'];
			$model->id_entreprise = $utilisateur->id_entreprise;

			// On fournis la date de créationde l'offre
			date_default_timezone_set('Europe/Paris');
			$model->date_creation_offre_emploi = (new \DateTime())->format('Y-m-d H:i:s');


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
		$postuler = Postuler::model()->FindAll("id_offre_emploi =".$id);

		//Dans la table Postuler, pour chaque occurence ou le numero d'offre == offfre actuelle, on supprime
		foreach($postuler as $un_postuler){

			$un_postuler->delete();
		}	

		//On supprime l'offre d'emploi
		$this->loadModel($id)->delete();

		//Redirection vers la liste de mes offres
		$this->redirect(array('index'));
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
		$employe = Utilisateur::model()->FindByAttributes(array('login' => Yii::app()->user->getId()))->id_employe;

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
		$employe = Utilisateur::model()->FindByAttributes(array('login' => Yii::app()->user->getId()))->id_employe;

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

}
