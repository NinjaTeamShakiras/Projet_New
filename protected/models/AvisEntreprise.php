<?php

/**
 * This is the model class for table "avis_entreprise".
 *
 * The followings are the available columns in table 'avis_entreprise':
 * @property integer $id_avis_entreprise
 * @property integer $note_generale_avis
 * @property datetime $date_creation
 * @property integer $nb_signalements_avis_entreprise
 * @property integer $id_entreprise
 * @property integer $id_utilisateur
 *
 * The followings are the available model relations:
 * @property Entreprise $idEntreprise
 * @property Utilisateur $idUtilisateur
 * @property EntrepriseAvisCritere[] $entrepriseAvisCriteres
 */
class AvisEntreprise extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'avis_entreprise';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('note_generale_avis_entreprise, date_creation_avis_entreprise, nb_signalements_avis_entreprise, id_entreprise', 'required'),
			array('nb_signalements_avis_entreprise, id_entreprise, id_utilisateur', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_avis_entreprise, note_generale_avis_entreprise, date_creation_avis_entreprise, nb_signalements_avis_entreprise, id_entreprise', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idEntreprise' => array(self::BELONGS_TO, 'Entreprise', 'id_entreprise'),
			'idUtilisateur' => array(self::BELONGS_TO, 'Utilisateur', 'id_utilisateur'),
			'entrepriseAvisCriteres' => array(self::HAS_MANY, 'EntrepriseAvisCritere', 'id_avis_entreprise'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_avis_entreprise' => 'Id Avis Entreprise',
			'note_generale_avis_entreprise' => 'Note Generale Avis',
			'date_creation_avis_entreprise' => 'Date Creation',
			'nb_signalements_avis_entreprise' => 'Nb Signalements',
			'id_entreprise' => 'Id Entreprise',
			'id_utilisateur' => 'Id Utilisateur',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_avis_entreprise',$this->id_avis_entreprise);
		$criteria->compare('note_generale_avis_entreprise',$this->note_generale_avis);
		$criteria->compare('date_creation_avis_entreprise',$this->date_creation_avis_entreprise,true);
		$criteria->compare('nb_signalements_avis_entreprise',$this->nb_signalements_avis_entreprise);
		$criteria->compare('id_entreprise',$this->id_entreprise);
		$criteria->compare('id_utilisateur',$this->id_utilisateur);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AvisEntreprise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/*		Fonction pour afficher les critères de notation d'une entreprise
			Paramètres : Aucun paramètre n'est requis
			Return : Void
	*/
	public static function afficher_criteres_notation_entreprise()
	{
		/*		Affichage des critères de notations 		*/
		foreach ( CriteresNotationEntreprise::model()->findAll() as $key => $value )
		{
			print(	'<div class="row">
						<div>' . $value->nom_critere_entreprise . '</div>' );
			if( $value->critere_note_entreprise )
				AvisEntreprise::afficher_barre_notation( $value->id_critere_notation_entreprise . '_note' );
			else
				AvisEntreprise::afficher_textearea( $value->id_critere_notation_entreprise .'_text' );
			print(	'</div>' );
		}
	}

	/*		Fonction pour afficher la barre de notation d'un avis entreprise 		*/
	public static function afficher_barre_notation( $nom_str )
	{
		print( '<div class="barre-notation-entreprise">' );
		for( $i = 0; $i <= 10; $i++ ) {
			print( '<input style="margin-left: 2%;" type="radio" name="' . $nom_str . '" value="' . $i . '" required> ' );
			print( '<label for="' . $nom_str . '_' . $i . '" style="display : inline-block;" >' . $i . '</label>' );
		}
		print( '</div>' );
		
	}

	/*		Fonction pour afficher un espace pour écrire l'avis 		*/
	public static function afficher_textearea( $nom_str )
	{
		print( '<textarea name="' . $nom_str . '" class="textarea-avis-entreprise" placeholder="Votre texte..." required></textarea>' );
	}


	/*		Fonction pour afficher les criteres de notation avec des paramètres pour l'update 	 	*/
	public static function afficher_criteres_notation_with_parameters( $contentCriteres_arr )
	{
		/*		Affichage des critères de notations 		*/
		foreach ( $contentCriteres_arr as $key => $value_obj )
		{
			/*		On récupère le critère concerné à partir de l'identifiant  		*/
			$critereConcerne_obj = CriteresNotationEntreprise::model()->findByAttributes( array( 	
									"id_critere_notation_entreprise" => $value_obj->id_critere_notation_entreprise
									)
			);

			print(	'<div class="row">' );

			/*		Si le résultat est correcte 		*/
			if( $critereConcerne_obj )
			{
					print(	'<div>' . $critereConcerne_obj->nom_critere_entreprise . '</div>' );
					if( $critereConcerne_obj->critere_note_entreprise )
						AvisEntreprise::afficher_barre_notation_with_param( $critereConcerne_obj->id_critere_notation_entreprise . '_note', $value_obj->note_entreprise_avis );
					
					else
						AvisEntreprise::afficher_textearea_with_param( $critereConcerne_obj->id_critere_notation_entreprise .'_text', $value_obj->commentaire_evaluation_critere );
			}
			
			print(	'</div>' );
		
		}
	
	}


	/*		Fonction pour afficher la barre de notation d'un avis entreprise 		*/
	public static function afficher_barre_notation_with_param( $nom_str, $note_int )
	{
		print( '<div class="barre-notation-entreprise">' );
		for( $i = 0; $i <= 10; $i++ ) {

			if( $note_int == $i )
				print( '<input style="margin-left: 2%;" type="radio" name="' . $nom_str . '" value="' . $i . '" checked="true" required>' );
			else
				print( '<input style="margin-left: 2%;" type="radio" name="' . $nom_str . '" value="' . $i . '" required> ' );
			
			print( '<label for="' . $nom_str . '_' . $i . '" style="display : inline-block;" >' . $i . '</label>' );
		}
		print( '</div>' );
		
	}

	/*		Fonction pour afficher un espace pour écrire l'avis 		*/
	public static function afficher_textearea_with_param( $nom_str, $value )
	{
		print( '<textarea name="' . $nom_str . '" class="textarea-avis-entreprise" placeholder="Votre texte..." required>' . $value . '</textarea>' );
	}


}
