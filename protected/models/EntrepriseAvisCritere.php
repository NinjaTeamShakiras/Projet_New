<?php

/**
 * This is the model class for table "entreprise_avis_critere".
 *
 * The followings are the available columns in table 'entreprise_avis_critere':
 * @property integer $id_entreprise_avis
 * @property integer $note_entreprise_avis
 * @property integer $id_critere_notation_entreprise
 * @property integer $id_avis_entreprise
 * @property string $commentaire_evaluation_critere
 *
 * The followings are the available model relations:
 * @property CriteresNotationEntreprise $idCritereNotationEntreprise
 * @property AvisEntreprise $idAvisEntreprise
 */
class EntrepriseAvisCritere extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entreprise_avis_critere';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_critere_notation_entreprise, id_avis_entreprise', 'required'),
			array('note_entreprise_avis, id_critere_notation_entreprise, id_avis_entreprise', 'numerical', 'integerOnly'=>true),
			array('commentaire_evaluation_critere', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_entreprise_avis, note_entreprise_avis, id_critere_notation_entreprise, id_avis_entreprise, commentaire_evaluation_critere', 'safe', 'on'=>'search'),
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
			'idCritereNotationEntreprise' => array(self::BELONGS_TO, 'CriteresNotationEntreprise', 'id_critere_notation_entreprise'),
			'idAvisEntreprise' => array(self::BELONGS_TO, 'AvisEntreprise', 'id_avis_entreprise'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_entreprise_avis' => 'Id Entreprise Avis',
			'note_entreprise_avis' => 'Note Entreprise Critere',
			'id_critere_notation_entreprise' => 'Id Critere Notation Entreprise',
			'id_avis_entreprise' => 'Id Avis Entreprise',
			'commentaire_evaluation_critere' => 'Commentaire Evaluation Critere',
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

		$criteria->compare('id_entreprise_avis',$this->id_entreprise_avis);
		$criteria->compare('note_entreprise_avis',$this->note_entreprise_avis);
		$criteria->compare('id_critere_notation_entreprise',$this->id_critere_notation_entreprise);
		$criteria->compare('id_avis_entreprise',$this->id_avis_entreprise);
		$criteria->compare('commentaire_evaluation_critere',$this->commentaire_evaluation_critere,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EntrepriseAvisCritere the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
