<?php

/**
 * This is the model class for table "avis_employe".
 *
 * The followings are the available columns in table 'avis_employe':
 * @property integer $id_avis_employe
 * @property integer $note_generale_avis_employe
 * @property string $date_creation_avis_employe
 * @property string $nb_signalements_avis_employe
 * @property integer $id_employe
 * @property integer $id_utilisateur
 *
 * The followings are the available model relations:
 * @property Employe $idEmploye
 * @property Utilisateur $idUtilisateur
 * @property EmployeAvisCritere[] $employeAvisCriteres
 */
class AvisEmploye extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'avis_employe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('note_generale_avis_employe, date_creation_avis_employe, nb_signalements_avis_employe, id_employe, id_utilisateur', 'required'),
			array('note_generale_avis_employe, id_employe, id_utilisateur', 'numerical', 'integerOnly'=>true),
			array('nb_signalements_avis_employe', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_avis_employe, note_generale_avis_employe, date_creation_avis_employe, nb_signalements_avis_employe, id_employe, id_utilisateur', 'safe', 'on'=>'search'),
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
			'idUtilisateur' => array(self::BELONGS_TO, 'Utilisateur', 'id_utilisateur'),
			'employeAvisCriteres' => array(self::HAS_MANY, 'EmployeAvisCritere', 'id_avis_employe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_avis_employe' => 'Id Avis Employe',
			'note_generale_avis_employe' => 'Note Generale Avis Employe',
			'date_creation_avis_employe' => 'Date Creation Avis Employe',
			'nb_signalements_avis_employe' => 'Nb Signalements Avis Employe',
			'id_employe' => 'Id Employe',
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

		$criteria->compare('id_avis_employe',$this->id_avis_employe);
		$criteria->compare('note_generale_avis_employe',$this->note_generale_avis_employe);
		$criteria->compare('date_creation_avis_employe',$this->date_creation_avis_employe,true);
		$criteria->compare('nb_signalements_avis_employe',$this->nb_signalements_avis_employe,true);
		$criteria->compare('id_employe',$this->id_employe);
		$criteria->compare('id_utilisateur',$this->id_utilisateur);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AvisEmploye the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
