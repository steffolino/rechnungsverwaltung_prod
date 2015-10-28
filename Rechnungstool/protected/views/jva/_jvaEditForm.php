<?php 
if(isset($jvaEditFormModel) && !empty($jvaEditFormModel) && $jvaEditFormModel !== ""){
	$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'jvaEditForm',
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
	//'enableAjaxValidation'=>true,
	//'focus'=>array($jvaEditFormModel,'jvaName'),
	)); 
	
	//TODO: create Form
	?>
	<fieldset>	
	<br>
	<?php
		//echo $form->labelEx($jvaEditFormModel,'jvaName');	
		echo $form->textFieldGroup($jvaEditFormModel,
			'jvaName',
			array(
				'class'=>'col-md-12',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'disabled' => true,
						'id' => 'jvaName',
					)
				)
			)
		);
		echo $form->textFieldGroup($jvaEditFormModel,'jvaNameExt',
			array(
				'class'=>'col-md-4',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'disabled' => true,
						'id' => 'jvaNameExt',
					)
				)
			)
		);
		
		echo $form->textFieldGroup($jvaEditFormModel,'jvaCustNumDesc',
			array(
				'class'=>'col-sm-5',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'id' => 'jvaCustNumDesc',
					)
				)
			)
		);
		
		echo $form->textFieldGroup($jvaEditFormModel,'jvaCustNum',
			array(
				'class'=>'col-sm-5',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'id' => 'jvaCustNum',
					)
				)
			)
		);	
		
		echo $form->textFieldGroup($jvaEditFormModel,'jvaFooter',
			array(
				'class'=>'col-sm-5',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'id' => 'jvaFooter',
					)
				)
			)
		);
	
		echo $form->textAreaGroup($jvaEditFormModel,
			'jvaAddress',
			array(
				'class'=>'col-sm-5',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'id' => 'jvaAddress',
					)
				)
			)
		);
	
//		echo "<h1>Ey oida ".var_dump($jvaEditFormModel->defaultColConfig->colDef1) ."</h1>";
//		echo "<h1>Ey oida ".$jvaEditFormModel->defaultColConfig->colDef2->colId."</h1>";
		
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef1,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 1',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef1->colDefId => array('selected' => true)),
						'id' => 'colName1',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef2,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 2',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef2->colDefId => array('selected' => true)),
						'id' => 'colName2',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef3,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 3',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef3->colDefId => array('selected' => true)),
						'id' => 'colName3',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef4,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 4',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef4->colDefId => array('selected' => true)),
						'id' => 'colName4',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef5,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 5',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef5->colDefId => array('selected' => true)),
						'id' => 'colName5',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef6,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 6',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef6->colDefId => array('selected' => true)),
						'id' => 'colName6',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef7,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 7',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef7->colDefId => array('selected' => true)),
						'id' => 'colName7',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef8,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 8',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef8->colDefId => array('selected' => true)),
						'id' => 'colName8',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef9,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 9',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef9->colDefId => array('selected' => true)),
						'id' => 'colName9',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef10,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 10',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef10->colDefId => array('selected' => true)),
						'id' => 'colName10',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef11,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 11',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'label' => 'DeiMudda',
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->defaultColConfig->colDef11->colDefId => array('selected' => true)),
						'id' => 'colName11',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->defaultColConfig->colDef12,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 12',
				'widgetOptions' => array(
					'data'=> CHtml::listData(ColDef::model()->findAll(), 'colDefId', 'colName'),//$colNames, 
					'htmlOptions' => array(
						'id' => 'colName12',
						'options' => array($jvaEditFormModel->defaultColConfig->colDef12->colDefId => array('selected' => true)),
					)
				),
			)
		);
	?>
	</fieldset>
	<?php
	$this->endWidget();
}else{
	?>
	<div class="hero-unit"><b>Bitte wählen Sie eine Aktion aus!</b></div>
	<?php
}
?>