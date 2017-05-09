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

		if($user->getState('type') == 'entreprise')
		{
			return array(
				array('allow',
					  'actions'=>['index','view', 'update'],
					),
				array('deny',
					  'actions'=>['admin', 'delete'],
					),
			);
		}

		if($user->getState('type') == 'employe')
		{

			return array(
					array('allow',
						  'actions'=>['view', 'index'],
						),
					array('deny',
						  'actions'=>['update','admin'],
						),
			);
		}	

		if($user->getState('type') == NULL)
		{
			return array(
					array('allow',
						  'actions'=>['index', 'view'],
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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

	/*	Fonction pour récupérer l'identifiant de l'employé après la connexion
		Paramètres : L'identifiant de l'utilisateur 
		Return : Un identifiant (Integer) 		*/
	protected function get_id_utilisateur_connexion($login_str)
	{
		return Utilisateur::model()->findByAttributes(array( "login" => $login_str ))->id_entreprise;
	}

	
	/*	Fonction qui recherche une ou plusieurs entreprises dans la base en fonction 
			des infos entrées par l'utilisateur 
	*/		
	public function actionSearch()
	{
		//On récupère la liste des entreprises par rapport au nom entré
		$nom_entreprise = $_POST['Entreprise']['nom_entreprise'];
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
