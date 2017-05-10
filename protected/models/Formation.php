<?php

/**
 * This is the model class for table "formation".
 *
 * The followings are the available columns in table 'formation':
 * @property integer $id_formation
 * @property string $date_debut_formation
 * @property string $date_fin_formation
 * @property string $intitule_formation
 * @property string $etablissement_formation
 * @property string $diplome_formation
 * @property string $description_formation
 * @property integer $id_employe
 *
 * The followings are the available model relations:
 * @property Employe $idEmploye
 */
class Formation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'formation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_employe','required'),
			array('id_employe', 'numerical', 'integerOnly'=>true),
			array('intitule_formation, etablissement_formation, diplome_formation', 'length', 'max'=>45),
			array('description_formation', 'length', 'max'=>255),
			array('date_debut_formation, date_fin_formation', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_formation, date_debut_formation, date_fin_formation, intitule_formation, etablissement_formation, diplome_formation, description_formation, id_employe', 'safe', 'on'=>'search'),
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
			'idEmploye' => array(self::BELONGS_TO, 'Employe', 'id_employe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_formation' => 'Id Formation',
			'date_debut_formation' => 'Date Debut Formation',
			'date_fin_formation' => 'Date Fin Formation',
			'intitule_formation' => 'Nom de la formation',
			'etablissement_formation' => 'Lieu/Etablissement de la formation',
			'diplome_formation' => 'Diplome Obtenu',
			'description_formation' => 'Description de la Formation',
			'id_employe' => 'Id Employe',
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

		$criteria->compare('id_formation',$this->id_formation);
		$criteria->compare('date_debut_formation',$this->date_debut_formation,true);
		$criteria->compare('date_fin_formation',$this->date_fin_formation,true);
		$criteria->compare('intitule_formation',$this->intitule_formation,true);
		$criteria->compare('etablissement_formation',$this->etablissement_formation,true);
		$criteria->compare('diplome_formation',$this->diplome_formation,true);
		$criteria->compare('description_formation',$this->description_formation,true);
		$criteria->compare('id_employe',$this->id_employe);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Formation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
