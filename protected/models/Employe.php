<?php

/**
 * This is the model class for table "employe".
 *
 * The followings are the available columns in table 'employe':
 * @property integer $id_employe
 * @property string $nom_employe
 * @property string $prenom_employe
 * @property string $date_naissance_employe
 * @property integer $employe_travaille
 * @property string $telephone_employe
 * @property integer $id_adresse
 *
 * The followings are the available model relations:
 * @property AvisEmploye[] $avisEmployes
 * @property CvEmploye[] $cvEmployes
 * @property Adresse $idAdresse
 * @property InfosComplementairesEmploye[] $infosComplementairesEmployes
 * @property Travaille[] $travailles
 * @property Utilisateur[] $utilisateurs
 */
class Employe extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('nom_employe, prenom_employe', 'required'),*/
			array('employe_travaille, id_adresse', 'numerical', 'integerOnly'=>true),
			array('nom_employe, prenom_employe', 'length', 'max'=>45),
			array('telephone_employe', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_employe, nom_employe, prenom_employe, date_naissance_employe, employe_travaille, telephone_employe, id_adresse', 'safe', 'on'=>'search'),
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
			'AvisEmploye' => array(self::HAS_MANY, 'AvisEmploye', 'id_employe'),
			'CVEmploye' => array(self::HAS_MANY, 'CvEmploye', 'id_employe'),
			'Adresse' => array(self::BELONGS_TO, 'Adresse', 'id_adresse'),
			'InfosComplementairesEmploye' => array(self::HAS_MANY, 'InfosComplementairesEmploye', 'id_employe'),
			'Travaille' => array(self::HAS_MANY, 'Travaille', 'id_employe'),
			'Utilisateur' => array(self::BELONGS_TO, 'Utilisateur', 'id_employe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_employe' => 'Id Employe',
			'nom_employe' => 'Nom de famille',
			'prenom_employe' => 'Prénom',
			'date_naissance_employe' => 'Date de naissance',
			'employe_travaille' => 'Recherche un travail',
			'telephone_employe' => 'Numéro de téléphone',
			'id_adresse' => 'Adresse',
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

		$criteria->compare('id_employe',$this->id_employe);
		$criteria->compare('nom_employe',$this->nom_employe,true);
		$criteria->compare('prenom_employe',$this->prenom_employe,true);
		$criteria->compare('date_naissance_employe',$this->date_naissance_employe,true);
		$criteria->compare('employe_travaille',$this->employe_travaille);
		$criteria->compare('telephone_employe',$this->telephone_employe,true);
		$criteria->compare('id_adresse',$this->id_adresse);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/*
		Fonction qui retourne l'employe à partir de l'identifiant d'un utilisateur
		Paramètres : l'identifiant de l'utilisateur
		Return : Un employe(Objet Employe) ou false si rien n'a été trouvé		*/

	public static function get_employe_by_id_utilisateur($id_int)
	{

		$utilisateur_obj = Utilisateur::model()->findByAttributes( array( "id_utilisateur" => $id_int ) );

		if( is_null($utilisateur_obj) )
			return null;
		else 
		{
			return Employe::model()->findByAttributes( array("id_employe" => $utilisateur_obj->id_employe ) );
		}
	}







}
