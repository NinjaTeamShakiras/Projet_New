<?php

/**
 * This is the model class for table "travaille".
 *
 * The followings are the available columns in table 'travaille':
 * @property integer $id_travaille
 * @property string $date_debut_contrat
 * @property string $date_fin_contrat
 * @property integer $duree_contrat
 * @property integer $id_employe
 * @property integer $id_entreprise
 *
 * The followings are the available model relations:
 * @property Employe $idEmploye
 * @property Entreprise $idEntreprise
 */
class Travaille extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'travaille';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('duree_contrat, id_employe, id_entreprise', 'numerical', 'integerOnly'=>true),
			array('date_debut_contrat, date_fin_contrat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_travaille, date_debut_contrat, date_fin_contrat, duree_contrat, id_employe, id_entreprise', 'safe', 'on'=>'search'),
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
			'Employe' => array(self::BELONGS_TO, 'Employe', 'id_employe'),
			'Entreprise' => array(self::BELONGS_TO, 'Entreprise', 'id_entreprise'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_travaille' => 'Id Travaille',
			'date_debut_contrat' => 'Date Debut Contrat',
			'date_fin_contrat' => 'Date Fin Contrat',
			'duree_contrat' => 'Duree Contrat',
			'id_employe' => 'Id Employe',
			'id_entreprise' => 'Id Entreprise',
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

		$criteria->compare('id_travaille',$this->id_travaille);
		$criteria->compare('date_debut_contrat',$this->date_debut_contrat,true);
		$criteria->compare('date_fin_contrat',$this->date_fin_contrat,true);
		$criteria->compare('duree_contrat',$this->duree_contrat);
		$criteria->compare('id_employe',$this->id_employe);
		$criteria->compare('id_entreprise',$this->id_entreprise);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Travaille the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
