<?php
/***

ActiveRecord Class to represent JVAs

***/

class JvaData extends CActiveRecord {

	//MUST HAVE
	public static function model($className=__CLASS__) {
			return parent::model($className);
		}
	

	
	public function relations()
    {
		
		//EXAMPLE: 'VarName'=>array('RelationsTyp', 'KlassenName', 'FremdSchlüssel', ...Zusätzliche Optionen)
        return array(
			//'colDef' => array(self::HAS_ONE, 'ColDef', array('jvaColConfig'=>'colDefId')),
			'defaultColConfig' => array(self::HAS_ONE, 'DefaultColConfig', array('colConfigId'=>'jvaColConfig')),
			//'contacts' => array(self::HAS_MANY, 'UserContacts', array('userID'=>'userID')),
        );
    }

}

?>