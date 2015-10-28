<?php

class LastusedcounterImplementierung extends Lastusedcounter
{
	public function getLastUsedCounterById($counterId){
		$lastUsedCounter = Lastusedcounter::model()->findByPK($counterId);
		return $lastUsedCounter;
	}
	
	public function getLastUsedCounterByName($counterName){
		$lastUsedCounter = Lastusedcounter::model()->find(
				'lastUsedCounterName=:lastUsedCounterName',
				array(':lastUsedCounterName'=>$counterName)
			);
			if($lastUsedCounter !== NULL){
				return $lastUsedCounter;
			}else{
				return NULL;
			}
	}
	
	public function incrementCounter($counterTypeId){
		$lastUsedCounter = $this-> getLastUsedCounterById($counterTypeId);
		$lastUsedCounter->lastUsedCounterStatus = $lastUsedCounter->lastUsedCounterStatus +1;
		$lastUsedCounter->save();
		
	}
}
