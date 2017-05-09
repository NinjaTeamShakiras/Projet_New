<?php

/**
 * This is the model class for table "infos_complementaires_profil".
 *
 * The followings are the available columns in table 'infos_complementaires_profil':
 * @property integer $id_info
 * @property string $nom_info
 * @property string $personne_concernee
 *
 * The followings are the available model relations:
 * @property InfosComplementairesEmploye[] $infosComplementairesEmployes
 * @property InfosComplementairesEntreprise[] $infosComplementairesEntreprises
 */
class InfosComplementairesProfil extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'infos_complementaires_profil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom_info, personne_concernee', 'required'),
			array('nom_info', 'length', 'max'=>150),
			array('personne_concernee', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_info, nom_info, personne_concernee', 'safe', 'on'=>'search'),
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
			'infosComplementairesEmployes' => array(self::HAS_MANY, 'InfosComplementairesEmploye', 'id_info_profil'),
			'infosComplementairesEntreprises' => array(self::HAS_MANY, 'InfosComplementairesEntreprise', 'id_info_profil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_info' => 'Id Info',
			'nom_info' => 'Nom Info',
			'personne_concernee' => 'Personne Concernee',
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

		$criteria->compare('id_info',$this->id_info);
		$criteria->compare('nom_info',$this->nom_info,true);
		$criteria->compare('personne_concernee',$this->personne_concernee,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InfosComplementairesProfil the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
