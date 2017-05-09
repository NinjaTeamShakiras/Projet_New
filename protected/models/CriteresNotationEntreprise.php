<?php

/**
 * This is the model class for table "criteres_notation_entreprise".
 *
 * The followings are the available columns in table 'criteres_notation_entreprise':
 * @property integer $id_critere_entreprise
 * @property string(100) $nom_critere_entreprise
 * @property integer $critere_note
 * @property string(300) $description_critere
 *
 * The followings are the available model relations:
 * @property EntrepriseAvisCritere[] $entrepriseAvisCriteres
 */
class CriteresNotationEntreprise extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'criteres_notation_entreprise';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom_critere_entreprise, critere_note, description_critere', 'required'),
			array('critere_note', 'numerical', 'integerOnly'=>true),
			array('nom_critere_entreprise', 'length', 'max'=>30),
			array('description_critere', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_critere_entreprise, nom_critere_entreprise, critere_note, description_critere', 'safe', 'on'=>'search'),
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
			'entrepriseAvisCriteres' => array(self::HAS_MANY, 'EntrepriseAvisCritere', 'id_critere_notation_entreprise'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_critere_entreprise' => 'Id Critere Entreprise',
			'nom_critere_entreprise' => 'Nom Critere Entreprise',
			'critere_note' => 'Critere Note',
			'description_critere' => 'Description Critere',
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

		$criteria->compare('id_critere_entreprise',$this->id_critere_entreprise);
		$criteria->compare('nom_critere_entreprise',$this->nom_critere_entreprise,true);
		$criteria->compare('critere_note',$this->critere_note);
		$criteria->compare('description_critere',$this->description_critere,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CriteresNotationEntreprise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
