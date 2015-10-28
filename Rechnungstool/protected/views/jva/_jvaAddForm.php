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
			for($i=1;$i<13;$i++){
				echo $form->dropDownListGroup($jvaAddFormModel,'colName'.$i,array('widgetOptions'=>array('data'=>$colNames),'class'=>'col-sm-5','id'=>'addColName'.$i));
			}
			
		?>
		</fieldset>
		
		<?php
	
}else{
	echo "Huha";
	
} 
$this->endWidget();
?>