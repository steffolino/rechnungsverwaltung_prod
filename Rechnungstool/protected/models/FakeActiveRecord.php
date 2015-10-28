<?php

    class FakeActiveRecord
    {
        public $isNewRecord = false;
        public $primaryKey = 'myid';
        public $myid;
        public $myattr;
     
        public function isAttributeSafe()
        {
            return true;
        }
     
        public function getAttributeLabel()
        {
            return 'Datum';
        }
        
        public function getScenario() {
        	return 'update';
        }
    }
     
?>