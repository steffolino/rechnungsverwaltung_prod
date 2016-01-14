<?php
class SearchFormModel extends CFormModel
{
   public $freeSearchTerm;
   
   
   public $jvaName;
   public $docType;
   public $startDate;
   public $endDate;
   
   	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'freeSearchTerm'	=>	'Freitext-Suche',
			'docType'	=>	'Dokument-Typ',
			'dateRange'	=>	'Zeitraum',
		);
	}
	
	public function searchWithFilter(){
		$singleEscape = array(" ","_","?","&");
		$multiEscape = array("*","%");
		$searchTerm = $this->freeSearchTerm ;
		$searchTerm = str_replace($singleEscape,'?',$searchTerm);
		$searchTerm = str_replace($multiEscape,'%',$searchTerm);
		$searchTerm = "%". $searchTerm ."%";
		if(isset($this->jvaName)&& !isset($this->docType) && !isset($this->startDate) && !isset($this->endDate)){
			// $document = Document::model()->with('jva','docType','jva.jvaColIk','jva.jvaColMemmel','documentvalues','jva.jvaColLoehne','jva.jvaColWitte')->findAll('jvaName=:jvaName AND (contact_person=:searchTerm OR  value1=:searchTerm OR value2=:searchTerm OR value3=:searchTerm OR value4=:searchTerm OR value5=:searchTerm OR value6=:searchTerm OR value7=:searchTerm OR value8=:searchTerm  OR value9=:searchTerm  OR value10=:searchTerm  OR value11=:searchTerm  OR value12=:searchTerm OR counter=:searchTerm)', array(':searchTerm'=>"%$searchTerm%",':jvaName'=>$this->jvaName));
			$document = Yii::app()->db->createCommand()
					->select()
					->from('document, docType, jvaData, documentvalues')
					->where('document.docTypeId = docType.docTypeId AND document.jvaId=:jvaId and documentvalues.documentId = document.documentId',array(':jvaId'=>$this->jvaName))	
					->andWhere('contact_person  LIKE :searchTerm OR jvaName LIKE :searchTerm OR value1 LIKE :searchTerm OR value2 LIKE :searchTerm OR value3 LIKE :searchTerm OR value4 LIKE :searchTerm OR value5 LIKE :searchTerm OR value6 LIKE :searchTerm OR value7 LIKE :searchTerm OR value8 LIKE :searchTerm  OR value9 LIKE :searchTerm  OR value10 LIKE :searchTerm  OR value11 LIKE :searchTerm  OR value12 LIKE :searchTerm OR counter LIKE :searchTerm', array(':searchTerm' =>$searchTerm))
					->group('document.documentId')
					->queryAll();
		}else if(!isset($this->jvaName)&& isset($this->docType) && !isset($this->startDate) && !isset($this->endDate)){
			//$document = Document::model()->with('jva','docType','jva.jvaColIk','jva.jvaColMemmel','documentvalues','jva.jvaColLoehne','jva.jvaColWitte')->findAll('(contact_person=:searchTerm OR jvaName=:searchTerm OR value1=:searchTerm OR value2=:searchTerm OR value3=:searchTerm OR value4=:searchTerm OR value5=:searchTerm OR value6=:searchTerm OR value7=:searchTerm OR value8=:searchTerm  OR value9=:searchTerm  OR value10=:searchTerm  OR value11=:searchTerm  OR value12=:searchTerm OR counter=:searchTerm) AND docTypeName=:docType', array(':searchTerm'=>"%$searchTerm%",':docType'=>$this->docType));	
			$document = Yii::app()->db->createCommand()
					->select()
					->from('document, docType, jvaData, documentvalues')
					->where('document.docTypeId = docType.docTypeId AND document.jvaId=:jvaId and documentvalues.documentId = document.documentId')	
					->andWhere('docTypeName =:docType',array(':docType'=>$this->docType))
					->andWhere('contact_person  LIKE :searchTerm OR jvaName LIKE :searchTerm OR value1 LIKE :searchTerm OR value2 LIKE :searchTerm OR value3 LIKE :searchTerm OR value4 LIKE :searchTerm OR value5 LIKE :searchTerm OR value6 LIKE :searchTerm OR value7 LIKE :searchTerm OR value8 LIKE :searchTerm  OR value9 LIKE :searchTerm  OR value10 LIKE :searchTerm  OR value11 LIKE :searchTerm  OR value12 LIKE :searchTerm OR counter LIKE :searchTerm', array(':searchTerm' =>$searchTerm))
					->group('document.documentId')
					->queryAll();
		}else if(!isset($this->jvaName)&& !isset($this->docType) && isset($this->startDate) && isset($this->endDate)){
			//$document = Document::model()->with('jva','docType','jva.jvaColIk','jva.jvaColMemmel','documentvalues','jva.jvaColLoehne','jva.jvaColWitte')->findAll('timestamp>:startDate AND timestamp <:endDate  AND(contact_person=:searchTerm OR  value1=:searchTerm OR value2=:searchTerm OR value3=:searchTerm OR value4=:searchTerm OR value5=:searchTerm OR value6=:searchTerm OR value7=:searchTerm OR value8=:searchTerm  OR value9=:searchTerm  OR value10=:searchTerm  OR value11=:searchTerm  OR value12=:searchTerm OR counter=:searchTerm)', array(':searchTerm'=>"%$searchTerm%",':startDate'=>$this->startDate,'endDate'=>$this->endDate));
			$document = Yii::app()->db->createCommand()
					->select()
					->from('document, docType, jvaData, documentvalues')
					->where('document.docTypeId = docType.docTypeId AND document.jvaId=:jvaId and documentvalues.documentId = document.documentId')	
					->andWhere('timestamp>:startDate AND timestamp <:endDate',array(':startDate'=>$this->startDate, ':endDate'=>$this->endDate))
					->andWhere('contact_person  LIKE :searchTerm OR jvaName LIKE :searchTerm OR value1 LIKE :searchTerm OR value2 LIKE :searchTerm OR value3 LIKE :searchTerm OR value4 LIKE :searchTerm OR value5 LIKE :searchTerm OR value6 LIKE :searchTerm OR value7 LIKE :searchTerm OR value8 LIKE :searchTerm  OR value9 LIKE :searchTerm  OR value10 LIKE :searchTerm  OR value11 LIKE :searchTerm  OR value12 LIKE :searchTerm OR counter LIKE :searchTerm', array(':searchTerm' =>$searchTerm))
					->group('document.documentId')
					->queryAll();
		}else if(!isset($this->jvaName)&& isset($this->docType) && isset($this->startDate) && isset($this->endDate)){
			//$document = Document::model()->with('jva','docType','jva.jvaColIk','jva.jvaColMemmel','documentvalues','jva.jvaColLoehne','jva.jvaColWitte')->findAll('timestamp>:startDate AND timestamp <:endDate  AND docTypeName=:docType AND (contact_person=:searchTerm OR  value1=:searchTerm OR value2=:searchTerm OR value3=:searchTerm OR value4=:searchTerm OR value5=:searchTerm OR value6=:searchTerm OR value7=:searchTerm OR value8=:searchTerm  OR value9=:searchTerm  OR value10=:searchTerm  OR value11=:searchTerm  OR value12=:searchTerm OR counter=:searchTerm)', array(':searchTerm'=>"%$searchTerm%",':docType'=>$this->docType,':startDate'=>$this->startDate,'endDate'=>$this->endDate));
			$document = Yii::app()->db->createCommand()
					->select()
					->from('document, docType, jvaData, documentvalues')
					->where('document.docTypeId = docType.docTypeId AND document.jvaId=:jvaId and documentvalues.documentId = document.documentId')	
					->andWhere('timestamp>:startDate AND timestamp <:endDate',array(':startDate'=>$this->startDate, ':endDate'=>$this->endDate))
					->andWhere('docTypeName =:docType',array(':docType'=>$this->docType))
					->andWhere('contact_person  LIKE :searchTerm OR jvaName LIKE :searchTerm OR value1 LIKE :searchTerm OR value2 LIKE :searchTerm OR value3 LIKE :searchTerm OR value4 LIKE :searchTerm OR value5 LIKE :searchTerm OR value6 LIKE :searchTerm OR value7 LIKE :searchTerm OR value8 LIKE :searchTerm  OR value9 LIKE :searchTerm  OR value10 LIKE :searchTerm  OR value11 LIKE :searchTerm  OR value12 LIKE :searchTerm OR counter LIKE :searchTerm', array(':searchTerm' =>$searchTerm))
					->group('document.documentId')
					->queryAll();
		
		}else if(isset($this->jvaName)&& isset($this->docType) && !isset($this->startDate) && !isset($this->endDate)){
			//$document = Document::model()->with('jva','docType','jva.jvaColIk','jva.jvaColMemmel','documentvalues','jva.jvaColLoehne','jva.jvaColWitte')->findAll('jvaName=:jvaName AND docTypeName=:docType AND(contact_person=:searchTerm OR  value1=:searchTerm OR value2=:searchTerm OR value3=:searchTerm OR value4=:searchTerm OR value5=:searchTerm OR value6=:searchTerm OR value7=:searchTerm OR value8=:searchTerm  OR value9=:searchTerm  OR value10=:searchTerm  OR value11=:searchTerm  OR value12=:searchTerm OR counter=:searchTerm)', array(':searchTerm'=>"%$searchTerm%",':docType'=>$this->docType,':jvaName'=>$this->jvaName));
			$document = Yii::app()->db->createCommand()
					->select()
					->from('document, docType, jvaData, documentvalues')
					->where('document.docTypeId = docType.docTypeId AND document.jvaId=:jvaId and documentvalues.documentId = document.documentId',array(':jvaId'=>$this->jvaName))
					->andWhere('docTypeName =:docType',array(':docType'=>$this->docType))
					->andWhere('contact_person  LIKE :searchTerm OR jvaName LIKE :searchTerm OR value1 LIKE :searchTerm OR value2 LIKE :searchTerm OR value3 LIKE :searchTerm OR value4 LIKE :searchTerm OR value5 LIKE :searchTerm OR value6 LIKE :searchTerm OR value7 LIKE :searchTerm OR value8 LIKE :searchTerm  OR value9 LIKE :searchTerm  OR value10 LIKE :searchTerm  OR value11 LIKE :searchTerm  OR value12 LIKE :searchTerm OR counter LIKE :searchTerm', array(':searchTerm' =>$searchTerm))
					->group('document.documentId')
					->queryAll();
		}else if(isset($this->jvaName)&& isset($this->docType) && isset($this->startDate) && isset($this->endDate)){
			//$document = Document::model()->with('jva','docType','jva.jvaColIk','jva.jvaColMemmel','documentvalues','jva.jvaColLoehne','jva.jvaColWitte')->findAll('timestamp>:startDate AND timestamp <:endDate  AND(contact_person=:searchTerm OR  value1=:searchTerm OR value2=:searchTerm OR value3=:searchTerm OR value4=:searchTerm OR value5=:searchTerm OR value6=:searchTerm OR value7=:searchTerm OR value8=:searchTerm  OR value9=:searchTerm  OR value10=:searchTerm  OR value11=:searchTerm  OR value12=:searchTerm OR counter=:searchTerm)', array(':searchTerm'=>"%$searchTerm%",':startDate'=>$this->startDate,'endDate'=>$this->endDate,':docType'=>$this->docType,':jvaName'=>$this->jvaName));
			$document = Yii::app()->db->createCommand()
					->select()
					->from('document, docType, jvaData, documentvalues')
					->where('document.docTypeId = docType.docTypeId AND document.jvaId=:jvaId and documentvalues.documentId = document.documentId',array(':jvaId'=>$this->jvaName))
					->andWhere('timestamp>:startDate AND timestamp <:endDate',array(':startDate'=>$this->startDate, ':endDate'=>$this->endDate))
					->andWhere('docTypeName =:docType',array(':docType'=>$this->docType))
					->andWhere('(contact_person  LIKE :searchTerm OR jvaName LIKE :searchTerm OR value1 LIKE :searchTerm OR value2 LIKE :searchTerm OR value3 LIKE :searchTerm OR value4 LIKE :searchTerm OR value5 LIKE :searchTerm OR value6 LIKE :searchTerm OR value7 LIKE :searchTerm OR value8 LIKE :searchTerm  OR value9 LIKE :searchTerm  OR value10 LIKE :searchTerm  OR value11 LIKE :searchTerm  OR value12 LIKE :searchTerm OR counter LIKE :searchTerm)', array(':searchTerm' =>$searchTerm))
					->group('document.documentId')
					->queryAll();
		}else{
			//$document = Document::model()->with('jva','docType','jva.jvaColIk','jva.jvaColMemmel','documentvalues','jva.jvaColLoehne','jva.jvaColWitte')->findAll('contact_person=:searchTerm OR jvaName=:searchTerm OR value1=:searchTerm OR value2=:searchTerm OR value3=:searchTerm OR value4=:searchTerm OR value5=:searchTerm OR value6=:searchTerm OR value7=:searchTerm OR value8=:searchTerm  OR value9=:searchTerm  OR value10=:searchTerm  OR value11=:searchTerm  OR value12=:searchTerm OR counter=:searchTerm', array(':searchTerm'=>"%$searchTerm%"));
			$document = Yii::app()->db->createCommand()
					->select()
					->from('document, docType, jvaData, documentvalues')
					->where('document.docTypeId = docType.docTypeId AND document.jvaId=jvaDataId and documentvalues.documentId = document.documentId')	
					->andWhere('(contact_person  LIKE :searchTerm OR jvaName LIKE :searchTerm OR value1 LIKE :searchTerm OR value2 LIKE :searchTerm OR value3 LIKE :searchTerm OR value4 LIKE :searchTerm OR value5 LIKE :searchTerm OR value6 LIKE :searchTerm OR value7 LIKE :searchTerm OR value8 LIKE :searchTerm  OR value9 LIKE :searchTerm  OR value10 LIKE :searchTerm  OR value11 LIKE :searchTerm  OR value12 LIKE :searchTerm OR counter LIKE :searchTerm)', array(':searchTerm' =>$searchTerm))
					->group('document.documentId')
					->queryAll();
		}
		return $document;
		
	}
	
	public function searchWithoutFilter(){
		$singleEscape = array(" ","_","?","&");
		$multiEscape = array("*","%");
		$searchTerm = $this->freeSearchTerm ;
		$searchTerm = str_replace($singleEscape,'?',$searchTerm);
		$searchTerm = str_replace($multiEscape,'%',$searchTerm);
		$searchTerm = "%". $searchTerm ."%";
		
		//$document = Document::model()->with('jva','docType','jva.jvaColIk','jva.jvaColMemmel','documentvalues','jva.jvaColLoehne','jva.jvaColWitte')->findAll('contact_person=:searchTerm OR jvaName=:searchTerm OR value1=:searchTerm OR value2=:searchTerm OR value3=:searchTerm OR value4=:searchTerm OR value5=:searchTerm OR value6=:searchTerm OR value7=:searchTerm OR value8=:searchTerm  OR value9=:searchTerm  OR value10=:searchTerm  OR value11=:searchTerm  OR value12=:searchTerm OR counter=:searchTerm', array(':searchTerm'=>"%$searchTerm%"));
		$document = Yii::app()->db->createCommand()
					->select()
					->from('document, docType, jvaData, documentvalues')
					->where('document.docTypeId = docType.docTypeId AND document.jvaId=jvaDataId and documentvalues.documentId = document.documentId')	
					->andWhere('(contact_person  LIKE :searchTerm OR jvaName LIKE :searchTerm OR value1 LIKE :searchTerm OR value2 LIKE :searchTerm OR value3 LIKE :searchTerm OR value4 LIKE :searchTerm OR value5 LIKE :searchTerm OR value6 LIKE :searchTerm OR value7 LIKE :searchTerm OR value8 LIKE :searchTerm  OR value9 LIKE :searchTerm  OR value10 LIKE :searchTerm  OR value11 LIKE :searchTerm  OR value12 LIKE :searchTerm OR counter LIKE :searchTerm)', array(':searchTerm' =>$searchTerm))
					->group('document.documentId')
					->queryAll();
		return $document;
		
	}

	
}