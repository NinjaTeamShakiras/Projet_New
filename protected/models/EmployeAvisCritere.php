<?php

/**
 * This is the model class for table "employe_avis_critere".
 *
 * The followings are the available columns in table 'employe_avis_critere':
 * @property integer $id_employe_avis
 * @property integer $note_employe_avis
 * @property string $commentaire_evaluation_critere
 * @property integer $id_critere_notation_employe
 * @property integer $id_avis_employe
 *
 * The followings are the available model relations:
 * @property CriteresNotationEmploye $idCritereNotationEmploye
 * @property AvisEmploye $idAvisEmploye
 */
class EmployeAvisCritere extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employe_avis_critere';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_critere_notation_employe, id_avis_employe', 'required'),
			array('note_employe_avis, id_critere_notation_employe, id_avis_employe', 'numerical', 'integerOnly'=>true),
			array('commentaire_evaluation_critere', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_employe_avis, note_employe_avis, commentaire_evaluation_critere, id_critere_notation_employe, id_avis_employe', 'safe', 'on'=>'search'),
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
			'idCritereNotationEmploye' => array(self::BELONGS_TO, 'CriteresNotationEmploye', 'id_critere_notation_employe'),
			'idAvisEmploye' => array(self::BELONGS_TO, 'AvisEmploye', 'id_avis_employe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_employe_avis' => 'Id Employe Avis',
			'note_employe_avis' => 'Note Employe Critere',
			'commentaire_evaluation_critere' => 'Commentaire Evaluation Critere',
			'id_critere_notation_employe' => 'Id Critere Notation Employe',
			'id_avis_employe' => 'Id Avis Employe',
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

		$criteria->compare('id_employe_avis',$this->id_employe_avis);
		$criteria->compare('note_employe_avis',$this->note_employe_avis);
		$criteria->compare('commentaire_evaluation_critere',$this->commentaire_evaluation_critere,true);
		$criteria->compare('id_critere_notation_employe',$this->id_critere_notation_employe);
		$criteria->compare('id_avis_employe',$this->id_avis_employe);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmployeAvisCritere the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
