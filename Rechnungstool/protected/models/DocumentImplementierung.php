<?php


class DocumentImplementierung extends Document
{
	
	public function insertNewDocument($docType,$jvaId,$contactPerson,$arrayOfValuesAndHeaders,$counterType){
		$newDoc = new Document;
		$newDoc->contact_person = $contactPerson;
		$newDoc->jva = $jvaId;
		$newDoc->jvaId = $jvaId;
		$docTypeImpl = new DoctypeImplementierung;
		$docTypeId = $docTypeImpl->getDocIdByName($docType);	
		$newDoc->docType = $docTypeId;
		$newDoc->docTypeId = $docTypeId;
		$lastUsedCounterImpl = new LastusedcounterImplementierung;
		$lastUsedCounter = $lastUsedCounterImpl->getLastUsedCounterByName(strtoupper($counterType));
		$counterTypeId = $lastUsedCounter->lastUsedCounterId;
		$counterName = $lastUsedCounter->lastUsedCounterName;
		$counterStatus = $lastUsedCounter->lastUsedCounterStatus;
		$lastUsedCounterImpl->incrementCounter($counterTypeId);
		$newDoc->counter = $counterName . " " . $counterStatus;
		$newDoc->yearCounter = yearcounter::model()->findByPK(1)->yearCounterId;
		$newDoc->save();
		 
		$docId = $newDoc->documentId;
		foreach($arrayOfValuesAndHeaders as $row){
			$newDocumentRow = new Documentvalues;
			$newDocumentRow->documentId = $docId;
			$newDocumentRow->value1 = $row[0];
			$newDocumentRow->value2 = $row[1];
			$newDocumentRow->value3 = $row[2];
			$newDocumentRow->value4 = $row[3];
			$newDocumentRow->value5 = $row[4];
			$newDocumentRow->value6 = $row[5];
			$newDocumentRow->value7 = $row[6];
			$newDocumentRow->value8 = $row[7];
			$newDocumentRow->value9 = $row[8];
			$newDocumentRow->value10 = $row[9];
			$newDocumentRow->value11 = $row[10];
			$newDocumentRow->value12 = $row[11];
			
			$newDocumentRow->header1 = $row[12];
			$newDocumentRow->header2 = $row[13];
			$newDocumentRow->header3 = $row[14];
			$newDocumentRow->header4 = $row[15];
			$newDocumentRow->header5 = $row[16];
			$newDocumentRow->header6 = $row[17];
			$newDocumentRow->header7 = $row[18];
			$newDocumentRow->header8 = $row[19];
			$newDocumentRow->header9 = $row[20];
			$newDocumentRow->header10 = $row[21];
			$newDocumentRow->header11 = $row[22];
			$newDocumentRow->header12 = $row[23];
			
			$newDocumentRow->save();
		}
		
		$this->createPdfOutOfDocument($docId);
		return $newDoc;
	}
	
	
	
	public function createPdfOutOfDocument($documentId){
		//TODO: create PDF from Form
		$document = $this->getDocumentWithId($documentId);
		
		//TODO:use correct link
		$pdfLocation = "Auf der Platte";
		$document->pdf_location = $pdfLocation;
		$document->save();
		
	}
	
	public function getColumnValuesPerSelectedJva($jvaId){
		$jva = new JvaModel;
		$jva = $jva->getJvaById($jvaId);
		return $jva;
	}
	
	
	public function getLastUsedDocumentValues($jvaName,$jvaNameExt){
		
		
	}
	
	public function getDocumentWithId($docId){
		return $document = Document::model()->findByPK($docId);
		
	}
	
	
	
	
	
}

?>