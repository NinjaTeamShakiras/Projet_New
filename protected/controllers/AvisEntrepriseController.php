<?php

class AvisEntrepriseController extends Controller
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
				'actions'=>array('create','update', 'delete'),
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
		$avisEntreprise = new AvisEntreprise();
		$erreurCounter_int = 0;

		if( isset( $_POST['AvisEntreprise'] ) )
		{
			/*		Définition du fuseau horaire GMT+1		*/
			date_default_timezone_set( 'Europe/Paris' );
			
			/*		Récupération de la date et l'heure actuelle 	*/
			$date = (new \DateTime())->format('Y-m-d H:i:s');

			/*		Variable pour le nombre d'éléments et la note globale 		*/
			$somme_double = 0;
			$nb_elements_int = 0;

			/*		Affectation sur la table Avis_Entreprise 		*/
			$avisEntreprise->date_creation_avis_entreprise = $date;
			$avisEntreprise->nb_signalements_avis_entreprise = 0;
			$avisEntreprise->id_entreprise = $_POST['AvisEntreprise']['id_entreprise'];
			$avisEntreprise->id_utilisateur = Utilisateur::get_id_utilisateur_connexion( Yii::app()->user->getId() );
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
			$avisEntreprise->note_generale_avis_entreprise = $somme_double / $nb_elements_int;
			
			if( !$avisEntreprise->save() )
				$erreurCounter_int++;

			/*		Affectation sur la table Entreprise_Avis_Criteres 		*/
			foreach ( $_POST as $key => $value ) 
			{
				/*		On cherche que les paramètres POST qui sont notés ou avec un commentaire 		*/
				if( strpos( $key, "_text" ) )
				{
					$avisEntrepriseCriteres = new EntrepriseAvisCritere();
					$avisEntrepriseCriteres->commentaire_evaluation_critere = $value;
					$avisEntrepriseCriteres->id_critere_notation_entreprise = intval( str_replace( '_text', '', $key ) ); 
					$avisEntrepriseCriteres->id_avis_entreprise = $avisEntreprise->id_avis_entreprise;
					$result_bool_1 = $avisEntrepriseCriteres->save();
					//var_dump( $avisEntreprise );
					if ( !$result_bool_1 )
						$erreurCounter_int++;
				
				}
				else if ( strpos( $key, "_note" ) )
				{
					$avisEntrepriseCriteres_note = new EntrepriseAvisCritere();
					$avisEntrepriseCriteres_note->note_entreprise_avis = $value;
					$avisEntrepriseCriteres_note->id_critere_notation_entreprise = intval( str_replace( '_note', '', $key ) );
					$avisEntrepriseCriteres_note->id_avis_entreprise = $avisEntreprise->id_avis_entreprise;
					$result_bool_2 = $avisEntrepriseCriteres_note->save();

					/*		On ajout un cookie pour faire l'affichage du dernier avis 		*/
					setcookie( "dernier-avis", $avisEntreprise->id_avis_entreprise, time()+ 86400 );  /* expire dans 24 heures */

					if ( !$result_bool_2 )
						$erreurCounter_int++;

				}
			}

			/*		On redirige vers l'employé concerné 		*/
			$url =  $this->createUrl( 'entreprise/view', array( 	'id' => $avisEntreprise->id_entreprise,
																	'error' => $erreurCounter_int ) );
			$this->redirect( $url );
		
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		if( isset( $_POST['AvisEntreprise'] ) )
		{
			/*		On récupère l'entrée avec l'identifiant 		*/
			$model=$this->loadModel( intval( $_POST['AvisEntreprise']['id_avis_entreprise'] ) );
			/*		Somme pour calculer la note moyenne		*/
			$somme_double = 0;
			$nb_elements_int = 0;
			/*		Variable utilisée pour regarder s'il y a des erreurs lors de l'insértion 		*/
			$erreurCounter_int = 0;

			/*		On boucle sur chaque critère de notation 		*/
			foreach ( $_POST as $key_str => $value_str ) 
			{
				/*		On cherche que les paramètres POST qui sont notés ou avec un commentaire 		*/
				if( strpos( $key_str, "_text" ) )
				{
					$id_critere = intval( str_replace( '_text', '', $key_str ) );
					//var_dump( $id_critere );
					$critereModel_obj = EntrepriseAvisCritere::model()->findByAttributes( 
																		array( 
																				"id_critere_notation_entreprise" => $id_critere,
																				"id_avis_entreprise" => $model->id_avis_entreprise 
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
					$critereModel_obj = EntrepriseAvisCritere::model()->findByAttributes( 
																		array( 
																				"id_critere_notation_entreprise" => $id_critere,
																				"id_avis_entreprise" => $model->id_avis_entreprise 
																		)
					);
					
					$critereModel_obj->note_entreprise_avis = trim( $value_str );

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

			$model->note_generale_avis_entreprise = $somme_double / $nb_elements_int;
			$resultBool_bool = $model->save();

			var_dump( $model );
			
			if ( $resultBool_bool && $erreurCounter_int == 0 ) 
			{
				/*		On redirige vers l'employé concerné 		*/
				$url =  $this->createUrl( 'entreprise/view', array( 	'id' => $model->id_entreprise ,
																		'error' => $erreurCounter_int ,
																		'update' => 'true' ) );
				$this->redirect( $url );			
			}
			else
			{
				$erreurCounter_int++;
				$url =  $this->createUrl( 'entreprise/view', array( 	'id' => $model->id_entreprise ,
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
		$avisEntreprise_obj = $this->loadModel( intval( $_GET['id'] ) );
		$id_entreprise = intval( $_GET['id_entreprise'] );

		/*		Vérification pour savoir si la personne qui supprime est vraiment la proprietaire de l'avis 		*/
		if( $avisEntreprise_obj->id_utilisateur == Utilisateur::get_id_utilisateur_connexion( Yii::app()->user->getId() ) )
		{
			//var_dump( $avisEntreprise );
			$criteresNotation_arr = EntrepriseAvisCritere::model()->findAll( "id_avis_entreprise = " . $avisEntreprise_obj->id_avis_entreprise );
			
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
			$avisEntreprise_obj->delete();
			/*		On efface le cookie pour savoir si c'est un avis récent s'il existe 		*/
			if( isset( $_COOKIE['dernier-avis'] ) )
				unset( $_COOKIE['dernier-avis'] );
			
			/*		Rédirection vers la page d'accueil 		*/
			$url =  $this->createUrl( 'entreprise/view', array( 	'id' => $id_entreprise ,
																		'delete' => 'true' ) );
			$this->redirect( $url );
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AvisEntreprise');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AvisEntreprise('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AvisEntreprise']))
			$model->attributes=$_GET['AvisEntreprise'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AvisEntreprise the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AvisEntreprise::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AvisEntreprise $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='avis-entreprise-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
