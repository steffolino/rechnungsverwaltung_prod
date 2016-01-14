<div class="panel panel-warning">
							<div class="panel-heading">
								<h3 class="panel-heading">Search Results</h3>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
									<?php if(isset($gridDataProvider) && !empty($gridDataProvider)){
										//var_dump($gridDataProvider);
											
											//cf. http://yiibooster.clevertech.biz/extendedGridView
												$this->widget('booster.widgets.TbExtendedGridView', array(
													'id'=>'documentIdSearch',
													'type' => 'striped bordered',
													'dataProvider' => $gridDataProvider,
													'template' => "{items}",
													'selectableRows' => 2,
													'bulkActions' => array(
													'actionButtons' => array(
														array(
															'buttonType' => 'button',
															'context' => 'primary',
															'size' => 'small',
															'label' => 'Action auf alle anwenden',
															//'click' => 'js:function(values){alert(values);}',
															'id'=>'documentIdAction'
															)
														),
														// if grid doesn't have a checkbox column type, it will attach
														// one and this configuration will be part of it
														'checkBoxColumnConfig' => array(
															
															'name' => 'CheckId'
														),
													),
													'columns' => $gridColumns,
												));
											}
											?>
									</div>
								</div>
							</div>
							
						</div>