<?php

class EmployeController extends Controller
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

		//Si c'est un employe :
			//Il a accès à la supression, a l'index, à la vue et la maj
			//Il n'a pas accès à la partie admin
		if($user->getState('type') == 'employe')
		{
			return array(
				array('allow',
					  'actions'=>['index','view', 'update', 'delete','formulaireInsereInfos'],
					),
				array('deny',
					  'actions'=>['admin'],
					),
			);
		}

		//Si c'est une entreprise :
			//Il a accès à la vue et à l'index
			//Il n'a pas accès à la maj, à la supression et à la partie admin
		if($user->getState('type') == 'entreprise')
		{

			return array(
					array('allow',
						  'actions'=>['view', 'index'],
						),
					array('deny',
						  'actions'=>['update','admin', 'delete'],
						),
			);
		}	

		//Si c'est un utilisateur non connecté
			//Il a juste accès à l'index et à la vues
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
		$model=new Employe;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employe']))
		{
			$model->attributes=$_POST['Employe'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_employe));
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

		if(isset($_POST['Employe']))
		{
			$model->attributes=$_POST['Employe'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_employe));
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
		$dataProvider=new CActiveDataProvider('Employe');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Employe('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employe']))
			$model->attributes=$_GET['Employe'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/*Fonction qui affiche la page choixAjoutCV*/
	public function actionChoixAjoutCV()
	{
		if (Yii::app()->user->getState('type') == null)
		{
			$this->redirect(array('site/login'));
		}
		else
		{
			$this->render('choixAjoutCV');
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Employe the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Employe::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Employe $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employe-form')
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


	public function actionFormulaireInsereInfos()
	{
		$formation = new Formation;
		$experiencePro = new ExperiencePro;
		$competence = new Competence;
		$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));

		if(isset($_POST['Competence']) && isset($_POST['ExperiencePro']) && isset($_POST['Competence']))
		{
			//On attributs les valeurs entrés par l'utilisateur dans le model Formation
			$formation->attributes = $_POST['Formation'];
			$formation->date_debut_formation = $this->changeDateBDD($_POST['Formation']['date_debut_formation']);
			$formation->date_fin_formation = $this->changeDateBDD($_POST['Formation']['date_fin_formation']);
			$formation->id_employe = $user->id_employe;

			//On save le model formation
			$formation->save();

			//On attributs les valeurs entrés par l'utilisateur dans le model experience
			$experiencePro->attributes = $_POST['ExperiencePro'];
			$experiencePro->date_debut_experience = $this->changeDateBDD($_POST['ExperiencePro']['date_debut_experience']);
			$experiencePro->date_fin_experience = $this->changeDateBDD($_POST['ExperiencePro']['date_fin_experience']);
			$experiencePro->id_employe = $user->id_employe;
			
			//On save le model experience
			$experiencePro->save();

			//On attributs les valeurs entrés par l'utilisateur dans le model competence
			$competence->attributes = $_POST['Competence'];
			$competence->id_employe = $user->id_employe;

			//On save le model competence 
			$competence->save();

		}
			//Sinon on renvoie la page inscription car les champs ne sont pas valides
			$this->render('ajoutinfos', array('model'=>$user)); 
	}


}
