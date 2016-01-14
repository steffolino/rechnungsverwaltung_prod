<?php


class DocumentvaluesImplementierung extends Documentvalues
{
	public function getDocumentValuesByDocumentId($documentId){
		$docValues = Documentvalues::model()->findAll(
				'documentId=:documentId',
				array(':documentId'=>$documentId)
			);
			if($docValues !== NULL){
				return $docValues;
			}else{
				return NULL;
			}
		
	}
}
