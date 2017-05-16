<?php

class FormationController extends Controller
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
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','formulaireformation'),
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
		$model=new Formation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Formation']))
		{
			$model->attributes=$_POST['Formation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_formation));
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

		if(isset($_POST['Formation']))
		{
			$model->attributes=$_POST['Formation'];
			$model->date_debut_formation = $this->changeDateBDD($_POST['Formation']['date_debut_formation']);
			$model->date_fin_formation = $this->changeDateBDD($_POST['Formation']['date_fin_formation']);
			if($model->save())
				Yii::app()->user->setFlash('success_maj_formation', "<p style = color:blue;>La formation ".$model->intitule_formation." à bien été mise à jour !</p>");
				$this->redirect(array('employe/view', 'id'=>$model->id_employe));
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
		$model = $this->loadModel($id);
		//On récupère l'id employé pour a redirection
		$user = $model->id_employe;

		//On supprime la compétence
		if($model->delete())
		{
			//Si c'est OK, on affiche un message de supression
			Yii::app()->user->setFlash('success_sup_formation', "<p style = color:blue;>La formation ".$model->intitule_formation." à bien été supprimée !</p>");
		}

		$this->redirect(array('employe/view', 'id'=>$user));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Formation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Formation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Formation']))
			$model->attributes=$_GET['Formation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Formation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Formation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Formation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='formation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/* Fonction qui change la date au format Américain pour la BDD */
	public function changeDateBDD($date)
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


	/*	Fonction qui change la date au format français
	@param $date est une date récupérée depuis la BDD
	*/
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


	public function actionFormulaireformation()
	{
		$formation = new Formation;
		$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));

		if(isset($_POST['Formation']))
		{
			//On attributs les valeurs entrés par l'utilisateur dans le model Formation
			$formation->attributes = $_POST['Formation'];
			$formation->date_debut_formation = $this->changeDateBDD($_POST['Formation']['date_debut_formation']);
			$formation->date_fin_formation = $this->changeDateBDD($_POST['Formation']['date_fin_formation']);
			$formation->id_employe = $user->id_employe;
			
			//On save le model formation
			$formation->save();
		}
		$this->render('formulaireformation');
	}


}
