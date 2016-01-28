<?php


class CollectiveinvoiceImplementierung extends Collectiveinvoice
{
	public function insertNewCollectiveInvoice($arrayOfDocuments){
		$counter = 0;
		$newId;
		foreach($arrayOfDocuments as $document){
			if($counter === 0){
				$newColl = new Collectiveinvoice;
				$newColl->collectInvoiceId = $this->getNextCollectiveId();
				$newId = $newColl->collectInvoiceId;
				$newColl->deliveryNoteId = $document;
				$newColl->save();
			}else{
				$newColl = new Collectiveinvoice;
				$newColl->collectInvoiceId = $newId;
				$newColl->deliveryNoteId = $document;
				$newColl->save();
			}
			$counter++;	
			
		}
		return $newId;
	}
	
	public function getLastCollectiveId(){
		$CollLast = Collectiveinvoice::model()->find('1 = 1 ORDER BY collectInvoiceId DESC');
		if(!empty($CollLast) && $CollLast->collectInvoiceId != 0 ){
			return $CollLast->collectInvoiceId;
		}else{
			return 0;
		}
		
	}
	
	public function getNextCollectiveId(){
		$lastId = $this->getLastCollectiveId();
		
			return ++$lastId;
		
		
	}
	
	public function deleteCollectiveInvoicePerId($collectiveId){
		// $coll=Collectiveinvoice::model()->findAll('collectInvoiceId=:collectiveId',array('collectiveId'=>$collectiveId)); 
		// $coll->delete();
		 Yii::app()->db->createCommand()->delete('collectiveinvoice','collectInvoiceId=:collectiveId',array('collectiveId'=>$collectiveId));
		
	}
}
