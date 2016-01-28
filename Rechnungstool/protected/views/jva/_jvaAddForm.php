<?php
if(isset($jvaAddFormModel)){
	
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'type' => 'horizontal',
			'id'=>'jvaAddForm',
			'htmlOptions' => array(
				'class' => 'well'
			),
		)
	); ?>
		
		<fieldset>
		<br/>
		<?php
	//		echo $form->labelEx($jvaAddFormModel, 'jvaName');
			echo $form->textFieldGroup($jvaAddFormModel,'jvaName');
			echo $form->textFieldGroup($jvaAddFormModel,'jvaNameExt');
			echo $form->textFieldGroup($jvaAddFormModel,'jvaFooter');
			echo $form->textAreaGroup($jvaAddFormModel,'jvaAddress');
			echo $form->textFieldGroup($jvaAddFormModel,'jvaCustNum');
			echo $form->textFieldGroup($jvaAddFormModel,'jvaCustNumDesc');
			//TODO: doesnt work like this --> cf. jvaEditForm - labelEx
			$tabs = array(
				array('label' => 'IK', 'content' => '<br/>'),
				array('label' => 'Logistik Memmelsdorf', 'content' => '<br/>'),
				array('label' => 'Logistik Löhne', 'content' => '<br/>'),
				array('label' => 'Wittekindshof', 'content' => '<br/>'),
				// array('label' => 'Sammelrechnung', 'content' => '<br/>'),
			);
			
			array_splice($colNames, -3);
			
			// echo "<pre>";
			// var_dump($jvaAddFormModel);
			// echo "</pre>";
			//var_dump($colNames);			
			//Awesome C like fix
			foreach($tabs as &$tab) {
				for($i=1;$i<11;$i++){
					if($tab['label'] == 'IK'){
						$idTab = "-Ik";
					}else if($tab['label'] == 'Logistik Memmelsdorf'){
						$idTab = "-Memmel";
					}else if($tab['label'] == 'Logistik Löhne'){
						$idTab = "-Loehne";
					}else{
						$idTab = "-Witte";
					}
					//ADD PRE-DEFINED COLUMNS
					$tab['content'] .= $form->dropDownListGroup($jvaAddFormModel,'colName'.$i, array('widgetOptions'=>array('data'=>$colNames,'htmlOptions' => array('id'=>   'addColName'.$i .$idTab)),'class'=>'col-sm-5', 'label' => 'Spalte '.$i));
					if($i == 10){
						$tab['content'] .= $form->textFieldGroup($jvaAddFormModel,'printAmount',array('widgetOptions'=>array('htmlOptions' => array('id'=>   'printAmount'.$idTab))));
					}
				}
				
			}
		    echo "<br/>";
			$this->widget(
				'booster.widgets.TbTabs',
				array(
					'type' => 'pills',
					'justified' => true,
					'tabs' => $tabs
				)
			); 
		
		?>
		</fieldset>
		
		<?php
	
}else{
	echo "There was an error. Please try again.";
	
} 
$this->endWidget();
?>