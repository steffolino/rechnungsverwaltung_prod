<?php
/***

ActiveRecord Class to represent JVAs

***/

class ColDef extends CActiveRecord {

	//MUST HAVE
	public static function model($className=__CLASS__) {
			return parent::model($className);
		}

	public function relations()
    {
		
		//EXAMPLE: 'VarName'=>array('RelationsTyp', 'KlassenName', 'FremdSchlüssel', ...Zusätzliche Optionen)
        return array(
			//'defColConf' => array(self::BELONGS_TO, 'DefaultColConfig', 'colDefId'),
			//'columDefinitions' => array(self::HAS_ONE, 'Colum_Definitons', array('jvaColConfig'=>'colDefId')),
			//'contacts' => array(self::HAS_MANY, 'UserContacts', array('userID'=>'userID')),
        );
    }

}

?>