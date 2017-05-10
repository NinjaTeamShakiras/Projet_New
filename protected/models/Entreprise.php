<?php

/**
 * This is the model class for table "entreprise".
 *
 * The followings are the available columns in table 'entreprise':
 * @property integer $id_entreprise
 * @property string $nom_entreprise
 * @property integer $nombre_employes
 * @property integer $recherche_employes
 * @property string $secteur_active_entreprise
 * @property integer $anne_creation_entreprise
 * @property integer $age_moyen_entreprise
 *
 * The followings are the available model relations:
 * @property AvisEntreprise[] $avisEntreprises
 * @property Job[] $jobs
 * @property OffreEmploi[] $offreEmplois
 * @property Utilisateur[] $utilisateurs
 */
class Entreprise extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entreprise';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom_entreprise', 'required'),
			array('nombre_employes, recherche_employes, anne_creation_entreprise, age_moyen_entreprise', 'numerical', 'integerOnly'=>true),
			array('nom_entreprise, secteur_activite_entreprise', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_entreprise, nom_entreprise, nombre_employes, recherche_employes, secteur_activite_entreprise, anne_creation_entreprise, age_moyen_entreprise', 'safe', 'on'=>'search'),
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
			'avisEntreprises' => array(self::HAS_MANY, 'AvisEntreprise', 'id_entreprise'),
			'jobs' => array(self::HAS_MANY, 'Job', 'id_entreprise'),
			'offreEmplois' => array(self::HAS_MANY, 'OffreEmploi', 'id_entreprise'),
			'utilisateurs' => array(self::HAS_MANY, 'Utilisateur', 'id_entreprise'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_entreprise' => 'Id Entreprise',
			'nom_entreprise' => 'Nom Entreprise',
			'nombre_employes' => 'Nombre Employes',
			'recherche_employes' => 'Recherche Employes',
			'secteur_activite_entreprise' => 'Secteur Active Entreprise',
			'anne_creation_entreprise' => 'Anne Creation Entreprise',
			'age_moyen_entreprise' => 'Age Moyen Entreprise',
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

		$criteria->compare('id_entreprise',$this->id_entreprise);
		$criteria->compare('nom_entreprise',$this->nom_entreprise,true);
		$criteria->compare('nombre_employes',$this->nombre_employes);
		$criteria->compare('recherche_employes',$this->recherche_employes);
		$criteria->compare('secteur_activite_entreprise',$this->secteur_active_entreprise,true);
		$criteria->compare('anne_creation_entreprise',$this->anne_creation_entreprise);
		$criteria->compare('age_moyen_entreprise',$this->age_moyen_entreprise);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Entreprise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
