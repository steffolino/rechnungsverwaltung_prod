<?php

class DocumentImplementierung extends Document
{
	
	public function insertNewDocument($docType,$jvaId,$contactPerson,$arrayOfValuesAndHeaders,$counterType,$defaultDocument, $filePathName){
		$newDoc = new Document;
		$newDoc->contact_person = $contactPerson;
		$newDoc->jva = $jvaId;
		$newDoc->jvaId = $jvaId;
		$docTypeImpl = new DoctypeImplementierung;
		$docTypeId = $docTypeImpl->getDocIdByName($docType);	
		if($defaultDocument === "yes"){
			$newDoc->defaultDoc = "yes";
		}
		$newDoc->docType = $docTypeId;
		$newDoc->docTypeId = $docTypeId;

		$lastUsedCounterImpl = new LastusedcounterImplementierung;
		$lastUsedCounter = $lastUsedCounterImpl->getLastUsedCounterByName(strtoupper($counterType));
		$counterTypeId = $lastUsedCounter->lastUsedCounterId;
		$counterName = $lastUsedCounter->lastUsedCounterName;
		$counterStatus = $lastUsedCounter->lastUsedCounterStatus;
		$lastUsedCounterImpl->incrementCounter($counterTypeId);
		$newDoc->counter = $counterName . " " . $counterStatus;
		$newDoc->yearCounter0 =yearcounter::model()->findByPK(1)->yearCounterId;
		$newDoc->yearCounter = yearcounter::model()->findByPK(1)->yearCounterId;
		
		date_default_timezone_set('Europe/Berlin');
		$newDoc->timeStamp = date('Y-m-d H:m:s');

		$pdfLocation = $filePathName;
		$newDoc->pdf_location = $pdfLocation;
		$newDoc->save();
		 
		$docId = $newDoc->documentId;
		// echo "<pre>";
		// var_dump($arrayOfValuesAndHeaders);
		// echo "</pre>";
		
		foreach($arrayOfValuesAndHeaders as $row){
			$newDocumentRow = new Documentvalues;
			$newDocumentRow->documentId = $docId;
			if(isset($row[0])){
				$newDocumentRow->value1 = $row[0];
			}else{
				$newDocumentRow->value1 = NULL;
			}
			if(isset($row[1])){
				$newDocumentRow->value2 = $row[1];
			}else{
				$newDocumentRow->value2 =NULL;
			}
			if(isset($row[2])){
				$newDocumentRow->value3 = $row[2];
			}else{
				$newDocumentRow->value3 =NULL;
			}
			if(isset($row[3])){
				$newDocumentRow->value4 = $row[3];
			}else{
				$newDocumentRow->value4 =NULL;
			}
			if(isset($row[4])){
				$newDocumentRow->value5 = $row[4];
			}else{
				$newDocumentRow->value5 =NULL;
			}
			if(isset($row[5])){
				$newDocumentRow->value6 = $row[5];
			}else{
				$newDocumentRow->value6 =NULL;
			}
			if(isset($row[6])){
				$newDocumentRow->value7 = $row[6];
			}else{
				$newDocumentRow->value7 =NULL;
			}
			if(isset($row[7])){
				$newDocumentRow->value8 = $row[7];
			}else{
				$newDocumentRow->value8 =NULL;
			}
			if(isset($row[8])){
				$newDocumentRow->value9 = $row[8];
			}else{
				$newDocumentRow->value9 =NULL;
			}
			if(isset($row[9])){
				$newDocumentRow->value10 = $row[9];
			}else{
				$newDocumentRow->value10 =NULL;
			}
			if(isset($row[10])){
				$newDocumentRow->value11 = $row[10];
			}else{
				$newDocumentRow->value11 =NULL;
			}
			if(isset($row[11])){
				$newDocumentRow->value12 = $row[11];
			}else{
				$newDocumentRow->value12 =NULL;
			}
			
			
			if(isset($row[12])){
				$newDocumentRow->header1 = $row[12];
			}else{
				$newDocumentRow->header1 =NULL;
			}
			if(isset($row[13])){
				$newDocumentRow->header2 = $row[13];
			}else{
				$newDocumentRow->header2 =NULL;
			}
			if(isset($row[14])){
				$newDocumentRow->header3 = $row[14];
			}else{
				$newDocumentRow->header3 =NULL;
			}
			if(isset($row[15])){
				$newDocumentRow->header4 = $row[15];
			}else{
				$newDocumentRow->header4 =NULL;
			}
			if(isset($row[16])){
				$newDocumentRow->header5 = $row[16];
			}else{
				$newDocumentRow->header5 =NULL;
			}
			if(isset($row[17])){
				$newDocumentRow->header6 = $row[17];
			}else{
				$newDocumentRow->header6 =NULL;
			}
			if(isset($row[18])){
				$newDocumentRow->header7 = $row[18];
			}else{
				$newDocumentRow->header7 =NULL;
			}
			if(isset($row[19])){
				$newDocumentRow->header8 = $row[19];
			}else{
				$newDocumentRow->header8 =NULL;
			}
			if(isset($row[20])){
				$newDocumentRow->header9 = $row[20];
			}else{
				$newDocumentRow->header9 =NULL;
			}
			if(isset($row[21])){
				$newDocumentRow->header10 = $row[21];
			}else{
				$newDocumentRow->header10 =NULL;
			}
			if(isset($row[22])){
				$newDocumentRow->header11 = $row[22];
			}else{
				$newDocumentRow->header11 =NULL;
			}
			if(isset($row[23])){
				$newDocumentRow->header12 = $row[23];
			}else{
				$newDocumentRow->header12 =NULL;
			}
			
			
			$newDocumentRow->save();
		}
		
		//$this->createPdfOutOfDocument($docId);
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
	
	
	public function getLastUsedDocumentId($jvaName,$jvaNameExt,$docType,$counter){
		if($counter === "ik"){
				$counterName = "IK%";
		}else if($counter === "memmel"){
				$counterName = "Logistik Memmelsdorf%";
		}else if($counter === "loehne"){
				$counterName = "Logistik Loehne%";
		}else{
				$counterName = "Wittekindshof%";	
		}
		$jva = new JvaModel;
		$jvaObject = $jva->getJvaByName($jvaName, $jvaNameExt);
		$jvaId = $jvaObject->jvaDataId;
		$docId = Document::model()->find(
				'jvaId=:jvaId AND docTypeId=:docType AND defaultDoc = "yes" AND counter LIKE :counter ORDER BY documentId DESC',
				// 'jvaId=:jvaId AND docTypeId=:docType AND defaultDoc = "yes" AND counter LIKE :counter ORDER BY timeStamp DESC, documentId DESC',
				array(':jvaId'=>$jvaId,':docType'=>$docType,':counter'=>$counterName)
			);
			if($docId !== NULL){
				return $docId->documentId;
			}else{
				return NULL;
			}
		
	}
	
	
	
	public function getDocumentWithId($docId){
		return $document = Document::model()->findByPK($docId);
		
	}
	
	// public function getInvoicesDeliveryNotInCollective($jvaName,$jvaNameExt){	
	public function getInvoicesDeliveryNotInCollective($jvaName,$jvaNameExt,$numberCircle){
		$jva = new JvaModel;
		$jvaObject = $jva->getJvaByName(trim($jvaName), trim($jvaNameExt));
		$jvaId = $jvaObject->jvaDataId;
		if($numberCircle === "ik"){
				$number = "IK%";
			}else if($numberCircle === "memmel"){
				$number = "Logistik Memmelsdorf%";
			}else if($numberCircle === "loehne"){
				$number = "Logistik Loehne%";
			}else{
				$number ="Witte%";	
			}
		//Document::model()->with('docType')->findAll('jvaId=:jvaId AND documentId NOT IN collectiveinvoices.deliveryNoteId AND (docTypeName = "Rechnung" OR docTypeName = "Lieferschein")',array('jvaId'=>$jvaId));
		return $document = Yii::app()->db->createCommand()
					->select()
					->from('document, docType, jvaData')
					->where('document.docTypeId = docType.docTypeId AND document.jvaId=:jvaId ', array(':jvaId'=>$jvaId))
					->andWhere('docTypeName = "Rechnung" OR docTypeName = "Lieferschein"')
					->andWhere('document.documentId NOT IN (Select deliveryNoteId from collectiveinvoice)')
					->andWhere('document.jvaId = jvaData.jvaDataId')
					->andWhere('counter LIKE :counter',array(':counter'=>$number))
					->queryAll();
	}
	
	
	//TODO: change to AR
	//TODO2: update constraints to work properly - done
	//TODO3: enable updating filePath - done
	public function deleteDocumentByFilePath($filePath) {
		$filePath = "%".$filePath;
		$docToBeDeleted = Yii::app()->db->createCommand()
			->delete('document', 'pdf_location LIKE :filePath', array(':filePath'=>$filePath));
		return $docToBeDeleted;
	}
	
	public function updateFilePath($oldFilePath, $newFilePath) {
		$oldFilePath = "%".$oldFilePath;
		$docToBeDeleted = Yii::app()->db->createCommand()
			->update('document', array('pdf_location' => $newFilePath), 'pdf_location LIKE :oldFilePath', array(':oldFilePath' => $oldFilePath));
			// ->where(, array(':oldFilePath' => $oldFilePath));
				// ), 'pdf_location LIKE :oldFilePath', array(':newFilePath'=> $newFilePath, ':oldFilePath' => $oldFilePath));  
		return $docToBeDeleted;
	}

	public function revertCounter ($counterType) {
		$lastUsedCounterImpl = new LastusedcounterImplementierung;
		$lastUsedCounter = $lastUsedCounterImpl->getLastUsedCounterByName(strtoupper($counterType));
		$counterTypeId = $lastUsedCounter->lastUsedCounterId;
		$counterName = $lastUsedCounter->lastUsedCounterName;
		$counterStatus = $lastUsedCounter->lastUsedCounterStatus;
		$lastUsedCounterImplResult = $lastUsedCounterImpl->decrementCounter($counterTypeId);
		return $lastUsedCounterImplResult;
		// $newDoc->counter = $counterName . " " . $counterStatus;
		// $newDoc->yearCounter0 =yearcounter::model()->findByPK(1)->yearCounterId;
		// $newDoc->yearCounter = yearcounter::model()->findByPK(1)->yearCounterId;
	}
	
}

?>