<?php

/**
 * This is the model class for table "document".
 *
 * The followings are the available columns in table 'document':
 * @property integer $documentId
 * @property string $counter
 * @property integer $yearCounter
 * @property integer $jvaId
 * @property integer $docTypeId
 * @property string $pdf_location
 * @property string $contact_person
 * @property string $printed
 * @property string $timeStamp
 *
 * The followings are the available model relations:
 * @property Collectiveinvoice[] $collectiveinvoices
 * @property Doctype $docType
 * @property Jvadata $jva
 * @property Yearcounter $yearCounter0
 * @property Documentvalues[] $documentvalues
 */
class Document extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'document';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('counter, yearCounter, jvaId, docTypeId', 'required'),
			// array('yearCounter, jvaId, docTypeId', 'numerical', 'integerOnly'=>true),
			// array('counter', 'length', 'max'=>45),
			// array('pdf_location, contact_person', 'length', 'max'=>255),
			// array('printed', 'length', 'max'=>1),
			// array('timeStamp', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('documentId, counter, yearCounter, jvaId, docTypeId, pdf_location, contact_person, printed, timeStamp', 'safe', 'on'=>'search'),
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
			'collectiveinvoices' => array(self::HAS_MANY, 'Collectiveinvoice', 'deliveryNoteId'),
			'docType' => array(self::BELONGS_TO, 'Doctype', 'docTypeId'),
			'jva' => array(self::BELONGS_TO, 'Jvadata', 'jvaId'),
			'yearCounter0' => array(self::BELONGS_TO, 'Yearcounter', 'yearCounter'),
			'documentvalues' => array(self::HAS_MANY, 'Documentvalues', 'documentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentId' => 'Document',
			'counter' => 'Counter',
			'yearCounter' => 'Year Counter',
			'jvaId' => 'Jva',
			'docTypeId' => 'Doc Type',
			'pdf_location' => 'Pdf Location',
			'contact_person' => 'Contact Person',
			'printed' => 'Printed',
			'timeStamp' => 'Time Stamp',
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

		$criteria->compare('documentId',$this->documentId);
		$criteria->compare('counter',$this->counter,true);
		$criteria->compare('yearCounter',$this->yearCounter);
		$criteria->compare('jvaId',$this->jvaId);
		$criteria->compare('docTypeId',$this->docTypeId);
		$criteria->compare('pdf_location',$this->pdf_location,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('printed',$this->printed,true);
		$criteria->compare('timeStamp',$this->timeStamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Document the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
