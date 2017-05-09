		<?php

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
					//'postOnly + delete', // we only allow deletion via POST request
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
							  'actions'=>['index','view', 'update', 'delete'],
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
				$adresse = Adresse::model()->findByAttributes(array('id_adresse'=>$model->id_adresse));
				$utilisateur = Utilisateur::model()->findByAttributes(array('id_employe'=>$model->id_employe));

				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);

				if(isset($_POST['Employe']) && isset($_POST['Adresse']) && isset($_POST['Utilisateur']))
				{

					//Transormation de la date puisque en Anglais dans la base en français dans le site
					$model->date_naissance_employe = $this->changeDateBDD($_POST['Employe']['date_naissance_employe']);
					//On enregistre les nouvelles données dans les modèles
					$model->attributes = $_POST['Employe'];
					$adresse->attributes = $_POST['Adresse'];
					$utilisateur->mail = $_POST['Utilisateur']['mail'];

					//On enregistre le modèle et on redirige
					if($model->save() && $adresse->save() && $utilisateur->save())
						$this->redirect(array('view','id'=>$model->id_employe));

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
				$utilisateur = Utilisateur::model()->FindByAttributes(array('id_employe'=>$id));

				/*Pour toutes les classes suivantes, on supprime soit l'occurence en entier, soit le champ
				  id_utilisateur est mis a null dans l'occurence */

				$avis = AvisEmploye::model()->FindAll();

				foreach ($avis as $a)
				{
					if($a->id_employe == $utilisateur->id_employe)
					{
						$a->delete();
					}
				}

				$avisentreprise = AvisEntreprise::model()->FindAll("id_utilisateur =".$utilisateur->id_utilisateur);

				foreach ($avisentreprise as $ae)
				{

						$ae->id_utilisateur = NULL;
						$ae->save();
					
				}

				$travaille = Travaille::model()->FindAll();

				foreach ($travaille as $ab)
				{
					if($ab->id_employe == $utilisateur->id_employe)
					$ab->delete();
				}

				$cvemploye = CvEmploye::model()->FindAll();

				foreach ($cvemploye as $cve)
				{
					if($cve->id_employe == $utilisateur->id_employe)
					$cve->delete();
				}

				$postule = Postuler::model()->FindAll();

				foreach ($postule as $post)
				{
					if($post->id_employe == $utilisateur->id_employe)
					$post->delete();
				}

				Yii::app()->user->logout();
				$utilisateur->delete();
					

				$model=$this->loadModel($id);
				$model->delete();

				$this->redirect('index.php');

				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				/*if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/

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

			/*	Fonction pour récupérer l'identifiant de l'employé après la connexion
				Paramètres : L'identifiant de l'utilisateur 
				Return : Un identifiant (Integer) 		*/
			protected function get_id_utilisateur_connexion($login_str)
			{
				return Utilisateur::model()->findByAttributes(array( "login" => $login_str ))->id_employe;
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

			/* Fonction qui change la date au format Américain pour la BDD */
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

			
			/**
				* AfficheTelephone : Place un caractère (carEspacement) tout les 2 chiffres.
				* @tel : numéro de téléphone de l'entreprise
				* @carEspacement : caractère à placer entre chaque 2 chiffres
				* return : une chaine de caractère (res) contenant le numéro de téléphone près à être
				* 			affiché
			*/
			protected function AfficheTelephone($tel,$carEspacement=" ")
			{

				$res ="";

				for($i=0; $i<=10; $i++)
				{
					// On ajoute "carEspacement" tous les 2 chiffres.
					if($i%2==0)
					{
						$res .= substr($tel, $i, 2);
						$res .= $carEspacement;
					}
				}
				$res = substr($res, 0, -2); // Suppression de l'espace ajouté à la fin de la boucle

				return($res);
			}
			
		}
