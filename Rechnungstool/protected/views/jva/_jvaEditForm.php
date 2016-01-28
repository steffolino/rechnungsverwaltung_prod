<script>

	// $(document).on("click", "#colTypeSelection .btn-group .btn", function (e) {
			// //console.log("clicked");
			// e.preventDefault();
			// $(this).addClass('active');
			// $(this).siblings('.btn').removeClass('active');
			// showCorrectColContent();
	// });

	$(document).on("click", "#jvaDetailsEditContent #colTypeSelection .btn-group .btn", function (e) {
			console.log("clicked coltypeselection");
			$(this).addClass('active');
			$(this).siblings('.btn').removeClass('active');
			showCorrectColContent();
	});

	function showCorrectColContent(){
			var radio = "empty";
			$("#colTypeSelection .btn-group .btn").each(function() {
				if($(this).hasClass('active')) {
					radio = $(this).attr('id');
				}
			});
			console.log(radio);
			switch(radio){
					case "ikSelected":
						$("#WitteEditForm").hide();
						$("#MemmelEditForm").hide();
						$("#IkEditForm").show();
						$("#LoehneEditForm").hide();
						break;
					case "memmelSelected":
						$("#WitteEditForm").hide();
						$("#MemmelEditForm").show();
						$("#IkEditForm").hide();
						$("#LoehneEditForm").hide();
						break;
					case "loehneSelected":
						$("#WitteEditForm").hide();
						$("#MemmelEditForm").hide();
						$("#IkEditForm").hide();
						$("#LoehneEditForm").show();
						break;
					case "witteSelected":
						$("#WitteEditForm").show();
						$("#MemmelEditForm").hide();
						$("#IkEditForm").hide();
						$("#LoehneEditForm").hide();
						break;
					default:
						break;
			}
		}
$(document).ready(function () {
		$("#WitteEditForm").hide();
		$("#MemmelEditForm").hide();
		$("#IkEditForm").hide();
		$("#LoehneEditForm").hide();
		
});
</script>
<?php 
if(isset($jvaEditFormModel) && !empty($jvaEditFormModel) && $jvaEditFormModel !== ""){
	
	array_splice($colNames, -3);
	
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
		);?>
	<br/>
	<div id="colTypeSelection" class="col-sm-12">
		<form >
			<?php 
			// $this->widget(
				// 'booster.widgets.TbTabs',
				// array(
					// 'type' => 'pills',
					// 'justified' => true,
					// 'tabs' =>  array (
						// array('label' => 'IK', 'content' => '<br/>', 'itemOptions' => array('id' => 'ikSelected')),
						// array('label' => 'Logistik Memmelsdorf', 'content' => '<br/>', 'itemOptions' => array('id' => 'memmelSelected')),
						// array('label' => 'Logistik Löhne', 'content' => '<br/>',  'itemOptions' => array('id' => 'loehneSelected')),
						// array('label' => 'Wittekindshof', 'content' => '<br/>', 'itemOptions' => array('id' => 'witteSelected')),
					// ),
				// )
			// ); 
			?>
			<div class="btn-group btn-group-sm" role=group>
				<button type="button" class="btn btn-default" id="ikSelected">IK</button>
				<button type="button" class="btn btn-default" id="memmelSelected">Logistik Memmeldsdorf</button>
				<button type="button" class="btn btn-default" id="loehneSelected">Logistik Löhne</button>
				<button type="button" class="btn btn-default" id="witteSelected">Wittekindshof</button>
			</div>
		</form>
	</div>
	<br/><br/><br/>
	<?php
//		echo "<h1>Ey oida ".var_dump($jvaEditFormModel->jvaColIk->colDef1) ."</h1>";
//		echo "<h1>Ey oida ".$jvaEditFormModel->jvaColIk->colDef2->colId."</h1>";
	?><div id="IkEditForm"><?php
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef1,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 1',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColIk->colDef1->colDefId => array('selected' => true)),
						'id' => 'colName1-Ik',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef2,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 2',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColIk->colDef2->colDefId => array('selected' => true)),
						'id' => 'colName2-Ik',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef3,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 3',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColIk->colDef3->colDefId => array('selected' => true)),
						'id' => 'colName3-Ik',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef4,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 4',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColIk->colDef4->colDefId => array('selected' => true)),
						'id' => 'colName4-Ik',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef5,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 5',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColIk->colDef5->colDefId => array('selected' => true)),
						'id' => 'colName5-Ik',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef6,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 6',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColIk->colDef6->colDefId => array('selected' => true)),
						'id' => 'colName6-Ik',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef7,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 7',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColIk->colDef7->colDefId => array('selected' => true)),
						'id' => 'colName7-Ik',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef8,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 8',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColIk->colDef8->colDefId => array('selected' => true)),
						'id' => 'colName8-Ik',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef9,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 9',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColIk->colDef9->colDefId => array('selected' => true)),
						'id' => 'colName9-Ik',
					)
				),
			)
		);
		echo $form->textFieldGroup($jvaEditFormModel->jvaColIk,
			'printAmount',
			array(
				'class'=>'col-sm-5',
				'label' => 'Anzahl Druck',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'id' => 'Druck-Ik',
					)
				)
			)
		);
		?></div>
		<div id="MemmelEditForm"><?php
	echo $form->dropDownListGroup($jvaEditFormModel->jvaColMemmel->colDef1,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 1',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColMemmel->colDef1->colDefId => array('selected' => true)),
						'id' => 'colName1-Memmel',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColMemmel->colDef2,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 2',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColMemmel->colDef2->colDefId => array('selected' => true)),
						'id' => 'colName2-Memmel',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColMemmel->colDef3,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 3',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColMemmel->colDef3->colDefId => array('selected' => true)),
						'id' => 'colName3-Memmel',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColMemmel->colDef4,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 4',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColMemmel->colDef4->colDefId => array('selected' => true)),
						'id' => 'colName4-Memmel',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColMemmel->colDef5,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 5',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColMemmel->colDef5->colDefId => array('selected' => true)),
						'id' => 'colName5-Memmel',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColMemmel->colDef6,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 6',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColMemmel->colDef6->colDefId => array('selected' => true)),
						'id' => 'colName6-Memmel',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColMemmel->colDef7,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 7',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColMemmel->colDef7->colDefId => array('selected' => true)),
						'id' => 'colName7-Memmel',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColMemmel->colDef8,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 8',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColMemmel->colDef8->colDefId => array('selected' => true)),
						'id' => 'colName8-Memmel',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColMemmel->colDef9,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 9',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColMemmel->colDef9->colDefId => array('selected' => true)),
						'id' => 'colName9-Memmel',
					)
				),
			)
		);
		echo $form->textFieldGroup($jvaEditFormModel->jvaColMemmel,
			'printAmount',
			array(
				'class'=>'col-md-5',
				'label' => 'Anzahl Druck',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'id' => 'Druck-Memmel',
					)
				)
			)
		);
		?></div>
		<div id="LoehneEditForm"><?php
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColLoehne->colDef1,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 1',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColLoehne->colDef1->colDefId => array('selected' => true)),
						'id' => 'colName1-Loehne',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColLoehne->colDef2,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 2',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColLoehne->colDef2->colDefId => array('selected' => true)),
						'id' => 'colName2-Loehne',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColLoehne->colDef3,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 3',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColLoehne->colDef3->colDefId => array('selected' => true)),
						'id' => 'colName3-Loehne',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColLoehne->colDef4,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 4',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColLoehne->colDef4->colDefId => array('selected' => true)),
						'id' => 'colName4-Loehne',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColLoehne->colDef5,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 5',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColLoehne->colDef5->colDefId => array('selected' => true)),
						'id' => 'colName5-Loehne',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColLoehne->colDef6,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 6',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColLoehne->colDef6->colDefId => array('selected' => true)),
						'id' => 'colName6-Loehne',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColLoehne->colDef7,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 7',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColLoehne->colDef7->colDefId => array('selected' => true)),
						'id' => 'colName7-Loehne',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColLoehne->colDef8,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 8',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColLoehne->colDef8->colDefId => array('selected' => true)),
						'id' => 'colName8-Loehne',
					)
				),
			)
		);
		echo $form->dropDownListGroup($jvaEditFormModel->jvaColLoehne->colDef9,
			'colName',
			array(
				'class'=>'col-sm-5',
				'label' => 'Spalte 9',
				'widgetOptions' => array(
					'data'=>$colNames, 
					'htmlOptions' => array(
						'options' => array($jvaEditFormModel->jvaColLoehne->colDef9->colDefId => array('selected' => true)),
						'id' => 'colName9-Loehne',
					)
				),
			)
		);
		echo $form->textFieldGroup($jvaEditFormModel->jvaColLoehne,
			'printAmount',
			array(
				'class'=>'col-md-5',
					'label' => 'Anzahl Druck',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'id' => 'Druck-Loehne',
					)
				)
			)
		);
		?></div>
		<div id="WitteEditForm"><?php
			echo $form->dropDownListGroup($jvaEditFormModel->jvaColWitte->colDef1,
				'colName',
				array(
					'class'=>'col-sm-5',
					'label' => 'Spalte 1',
					'widgetOptions' => array(
						'data'=>$colNames, 
						'htmlOptions' => array(
							'options' => array($jvaEditFormModel->jvaColWitte->colDef1->colDefId => array('selected' => true)),
							'id' => 'colName1-Witte',
						)
					),
				)
			);
			echo $form->dropDownListGroup($jvaEditFormModel->jvaColWitte->colDef2,
				'colName',
				array(
					'class'=>'col-sm-5',
					'label' => 'Spalte 2',
					'widgetOptions' => array(
						'data'=>$colNames, 
						'htmlOptions' => array(
							'options' => array($jvaEditFormModel->jvaColWitte->colDef2->colDefId => array('selected' => true)),
							'id' => 'colName2-Witte',
						)
					),
				)
			);
			echo $form->dropDownListGroup($jvaEditFormModel->jvaColWitte->colDef3,
				'colName',
				array(
					'class'=>'col-sm-5',
					'label' => 'Spalte 3',
					'widgetOptions' => array(
						'data'=>$colNames, 
						'htmlOptions' => array(
							'options' => array($jvaEditFormModel->jvaColWitte->colDef3->colDefId => array('selected' => true)),
							'id' => 'colName3-Witte',
						)
					),
				)
			);
			echo $form->dropDownListGroup($jvaEditFormModel->jvaColWitte->colDef4,
				'colName',
				array(
					'class'=>'col-sm-5',
					'label' => 'Spalte 4',
					'widgetOptions' => array(
						'data'=>$colNames, 
						'htmlOptions' => array(
							'options' => array($jvaEditFormModel->jvaColWitte->colDef4->colDefId => array('selected' => true)),
							'id' => 'colName4-Witte',
						)
					),
				)
			);
			echo $form->dropDownListGroup($jvaEditFormModel->jvaColWitte->colDef5,
				'colName',
				array(
					'class'=>'col-sm-5',
					'label' => 'Spalte 5',
					'widgetOptions' => array(
						'data'=>$colNames, 
						'htmlOptions' => array(
							'options' => array($jvaEditFormModel->jvaColWitte->colDef5->colDefId => array('selected' => true)),
							'id' => 'colName5-Witte',
						)
					),
				)
			);
			echo $form->dropDownListGroup($jvaEditFormModel->jvaColWitte->colDef6,
				'colName',
				array(
					'class'=>'col-sm-5',
					'label' => 'Spalte 6',
					'widgetOptions' => array(
						'data'=>$colNames, 
						'htmlOptions' => array(
							'options' => array($jvaEditFormModel->jvaColWitte->colDef6->colDefId => array('selected' => true)),
							'id' => 'colName6-Witte',
						)
					),
				)
			);
			echo $form->dropDownListGroup($jvaEditFormModel->jvaColWitte->colDef7,
				'colName',
				array(
					'class'=>'col-sm-5',
					'label' => 'Spalte 7',
					'widgetOptions' => array(
						'data'=>$colNames, 
						'htmlOptions' => array(
							'options' => array($jvaEditFormModel->jvaColWitte->colDef7->colDefId => array('selected' => true)),
							'id' => 'colName7-Witte',
						)
					),
				)
			);
			echo $form->dropDownListGroup($jvaEditFormModel->jvaColWitte->colDef8,
				'colName',
				array(
					'class'=>'col-sm-5',
					'label' => 'Spalte 8',
					'widgetOptions' => array(
						'data'=>$colNames, 
						'htmlOptions' => array(
							'options' => array($jvaEditFormModel->jvaColWitte->colDef8->colDefId => array('selected' => true)),
							'id' => 'colName8-Witte',
						)
					),
				)
			);
			echo $form->dropDownListGroup($jvaEditFormModel->jvaColWitte->colDef9,
				'colName',
				array(
					'class'=>'col-sm-5',
					'label' => 'Spalte 9',
					'widgetOptions' => array(
						'data'=>$colNames, 
						'htmlOptions' => array(
							'options' => array($jvaEditFormModel->jvaColWitte->colDef9->colDefId => array('selected' => true)),
							'id' => 'colName9-Witte',
						)
					),
				)
			);
		echo $form->textFieldGroup($jvaEditFormModel->jvaColWitte,
			'printAmount',
			array(
				'class'=>'col-md-5',
					'label' => 'Anzahl Druck',
				'widgetOptions' => array(
					'htmlOptions' => array(
						'id' => 'Druck-Witte',
					)
				)
			)
		);
		?></div><?php


		// echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef10,
			// 'colName',
			// array(
				// 'class'=>'col-sm-5',
				// 'label' => 'Spalte 10',
				// 'widgetOptions' => array(
					// 'data'=>$colNames, 
					// 'htmlOptions' => array(
						// 'options' => array($jvaEditFormModel->jvaColIk->colDef10->colDefId => array('selected' => true)),
						// 'id' => 'colName10',
					// )
				// ),
			// )
		// );
		// echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef11,
			// 'colName',
			// array(
				// 'class'=>'col-sm-5',
				// 'label' => 'Spalte 11',
				// 'widgetOptions' => array(
					// 'data'=>$colNames, 
					// 'label' => 'DeiMudda',
					// 'htmlOptions' => array(
						// 'options' => array($jvaEditFormModel->jvaColIk->colDef11->colDefId => array('selected' => true)),
						// 'id' => 'colName11',
					// )
				// ),
			// )
		// );
		// echo $form->dropDownListGroup($jvaEditFormModel->jvaColIk->colDef12,
			// 'colName',
			// array(
				// 'class'=>'col-sm-5',
				// 'label' => 'Spalte 12',
				// 'widgetOptions' => array(
					// 'data'=> CHtml::listData(ColDef::model()->findAll(), 'colDefId', 'colName'),//$colNames, 
					// 'htmlOptions' => array(
						// 'id' => 'colName12-Witte',
						// 'options' => array($jvaEditFormModel->jvaColIk->colDef12->colDefId => array('selected' => true)),
					// )
				// ),
			// )
		// );
	?>
	</fieldset>
	<?php
	$this->endWidget();
}else{
	?>
	<br/>
	<div class="hero-unit"><b>Bitte wählen Sie eine Aktion aus!</b></div>
	<br/>
	<?php
}
?>