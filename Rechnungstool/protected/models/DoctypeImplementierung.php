<?php


class DoctypeImplementierung extends Doctype
{
	public function getDocIdByName($docTypeName){
		$docType = DocType::model()->find(
				'docTypeName=:docTypeName',
				array(':docTypeName'=>$docTypeName)
			);
			if($docType !== NULL){
				return intval($docType->docTypeId);
			}else{
				return NULL;
			}
		
		
	}
}
