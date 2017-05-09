<?php

class AvisEmployeController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array( 'create','update', 'delete', 'CreerAvisEmploye', 'UpdateAvisEmploye' ),
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
		$model=new AvisEmploye;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AvisEmploye']))
		{
			$model->attributes=$_POST['AvisEmploye'];

			var_dump( $_POST );
			//if($model->save())
				$this->redirect(array('view','id'=>$model->id_avis_employe));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/*		Fonction pour créer un avis à un employé avec tous les critères requis 		*/
	public function actionCreerAvisEmploye()
	{
		$avisEmploye = new AvisEmploye();
		$erreurCounter_int = 0;
		

		if( isset( $_POST['AvisEmploye'] ) )
		{
			/*		Définition du fuseau horaire GMT+1		*/
			date_default_timezone_set( 'Europe/Paris' );
			
			/*		Récupération de la date et l'heure actuelle 	*/
			$date = (new \DateTime())->format('Y-m-d H:i:s');

			/*		Variable pour le nombre d'éléments et la note globale 		*/
			$somme_double = 0;
			$nb_elements_int = 0;

			/*		Affectation sur la table Avis_Employe 		*/
			$avisEmploye->date_creation_avis_employe = $date;
			$avisEmploye->nb_signalements_avis_employe = 0;
			$avisEmploye->id_employe = $_POST['AvisEmploye']['id_employe'];
			$avisEmploye->id_utilisateur = Utilisateur::get_id_utilisateur_connexion( Yii::app()->user->getId() );
			
			/*		Boucle pour calculer la note moyenne 		*/
			foreach ( $_POST as $key => $value ) 
			{
				/*		Si c'est un critère noté on fait la somme	*/
				if ( strpos( $key, "_note" ) ) 
				{
					$somme_double += $value;
					$nb_elements_int++;
				}
			}


			$avisEmploye->note_generale_avis_employe = $somme_double / $nb_elements_int;

			if( !$avisEmploye->save() )
				$erreurCounter_int++;

			/*		Affectation sur la table Employe_Avis_Criteres 		*/
			foreach ( $_POST as $key => $value ) 
			{
				/*		On cherche que les paramètres POST qui sont notés ou avec un commentaire 		*/
				if( strpos( $key, "_text" ) )
				{
					$avisEmployeCriteres = new EmployeAvisCritere();
					$avisEmployeCriteres->commentaire_evaluation_critere = $value;
					$avisEmployeCriteres->id_critere_notation_employe = intval( str_replace( '_text', '', $key ) ); 
					$avisEmployeCriteres->id_avis_employe = $avisEmploye->id_avis_employe;
					
					if ( !$avisEmployeCriteres->save() )
						$erreurCounter_int++;
				}
				else if ( strpos( $key, "_note" ) )
				{
					$avisEmployeCriteres_note = new EmployeAvisCritere();
					$avisEmployeCriteres_note->note_employe_avis = $value;
					$avisEmployeCriteres_note->id_critere_notation_employe = intval( str_replace( '_note', '', $key ) );
					$avisEmployeCriteres_note->id_avis_employe = $avisEmploye->id_avis_employe;
					
					if ( !$avisEmployeCriteres_note->save() )
						$erreurCounter_int++;
				}
			}

			/*		On ajout un cookie pour faire l'affichage du dernier avis 		*/
			setcookie( "dernier-avis-employe", $avisEmploye->id_avis_employe, time() + 86400 );  /* expire dans 24 heures */

			/*		On redirige vers l'employé concerné 		*/
			$url =  $this->createUrl( 'employe/view', array( 	'id' => $avisEmploye->id_employe,
																'error' => $erreurCounter_int ) );
			$this->redirect( $url );
		
		}
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

		if(isset($_POST['AvisEmploye']))
		{
			$model->attributes=$_POST['AvisEmploye'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_avis_employe));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}



	/*		Action update pour modifier son avis 		*/
	public function actionUpdateAvisEmploye() 
	{
		if( isset( $_POST['AvisEmploye'] ) )
		{
			/*		Compteur pour déterminer si tout a bien été réalisé 	 	*/
			$erreurCounter_int = 0;
			/*		On récupère l'entrée avec l'identifiant 		*/
			$model=$this->loadModel( intval( $_POST['AvisEmploye']['id_avis_employe'] ) );
			/*		Somme pour calculer la note moyenne		*/
			$somme_double = 0;
			$nb_elements_int = 0;

			/*		On boucle sur chaque critère de notation 		*/
			foreach ( $_POST as $key_str => $value_str ) 
			{
				/*		On cherche que les paramètres POST qui sont notés ou avec un commentaire 		*/
				if( strpos( $key_str, "_text" ) )
				{
					$id_critere = intval( str_replace( '_text', '', $key_str ) );
					//var_dump( $id_critere );
					$critereModel_obj = EmployeAvisCritere::model()->findByAttributes( 
																		array( 
																				"id_critere_notation_employe" => $id_critere,
																				"id_avis_employe" => $model->id_avis_employe 
																		)
					);
					
					$critereModel_obj->commentaire_evaluation_critere = trim( $value_str );

					$succes_bool_1 = $critereModel_obj->save();
					
					if( !$succes_bool_1 )
						$erreurCounter_int++;

				}
				/*		Les paramètres qui sont notés 		*/
				else if ( strpos( $key_str, "_note" ) )
				{
					$id_critere = intval( str_replace( '_note', '', $key_str ) );
					$critereModel_obj = EmployeAvisCritere::model()->findByAttributes( 
																		array( 
																				"id_critere_notation_employe" => $id_critere,
																				"id_avis_employe" => $model->id_avis_employe 
																		)
					);
					
					$critereModel_obj->note_employe_avis = trim( $value_str );

					$succes_bool_2 = $critereModel_obj->save();
					
					if ( $succes_bool_2 )
					{
						$somme_double += $value_str;
						$nb_elements_int++;
					}
					else 
					{
						$erreurCounter_int++;
					}

				}
	
			}


			$model->note_generale_avis_employe = $somme_double / $nb_elements_int;
			$resultBool_bool = $model->save();
				
			if ( $resultBool_bool && $erreurCounter_int == 0 ) 
			{
				/*		On redirige vers l'employé concerné 		*/
				$url =  $this->createUrl( 'employe/view', array( 	'id' => $model->id_employe ,
																	'error' => $erreurCounter_int ,
																	'update' => 'true' ) );
				$this->redirect( $url );
			}
			else
			{
				$erreurCounter_int++;
				$url =  $this->createUrl( 'employe/view', array( 	'id' => $model->id_entreprise ,
																		'error' => $erreurCounter_int ,
																		'update' => 'true' ) );
				$this->redirect( $url );
			}
		}
		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		$avisEmploye_obj = $this->loadModel( intval( $_GET['id'] ) );
		$id_employe = intval( $_GET['id_employe'] );

		/*		Vérification pour savoir si la personne qui supprime est vraiment la proprietaire de l'avis 		*/
		if( $avisEmploye_obj->id_utilisateur == Utilisateur::get_id_utilisateur_connexion( Yii::app()->user->getId() ) )
		{
			//var_dump( $avisEmploye );
			$criteresNotation_arr = EmployeAvisCritere::model()->findAll( "id_avis_employe = " . $avisEmploye_obj->id_avis_employe );
			
			/*		Si le tableau qu'on récupère n'est pas vide 	*/
			if( sizeof( $criteresNotation_arr ) > 0 )
			{
				/*		On boucle sur chaque critere de notation de l'avis pour le supprimer 	*/
				foreach ( $criteresNotation_arr as $key => $value_obj )
				{
					/*		On supprime chaque critere 		*/
					$value_obj->delete();
				}
			}
			/*		On supprime l'avis 		*/
			$avisEmploye_obj->delete();

			if( isset( $_COOKIE['dernier-avis-employe'] ) )
				unset( $_COOKIE['dernier-avis-employe'] );

			/*		Rédirection vers la page d'accueil 		*/
			$url =  $this->createUrl( 'employe/view', array( 	'id' => $id_employe ,
																		'delete' => 'true' ) );
			$this->redirect( $url );
		}
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AvisEmploye');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AvisEmploye('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AvisEmploye']))
			$model->attributes=$_GET['AvisEmploye'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AvisEmploye the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AvisEmploye::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AvisEmploye $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='avis-employe-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
