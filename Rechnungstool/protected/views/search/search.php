<?php
/* @var $this SearchController */
?>
<!-- MAIN -->
<div class="row">
		<div class="col-md-12 panel panel-primary">
				<div class="row panel-heading ">
					<?php
						$form = $this->beginWidget(
							'booster.widgets.TbActiveForm',
							array(
								'id' => 'horizontalForm',
								'type' => 'horizontal',
							)
						);
					?>

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<h3>Freie Textsuche: </h3>
								<?php
								echo $form->textFieldGroup(
										$formModel,
										'freeSearchTerm',
										array(
											'wrapperHtmlOptions' => array(
												'class' => 'col-sm-5',
											),
											'hint' => 'Hier k&ouml;nnen Sie auch nach Rechnungsdetails und einzelnen Posten suchen'
										)
									);
								?>
							</div>
						</div>
						<div class="row">
						</div>
						<div class="row">
							<div class="col-md-12">
							<h3>Filter: </h3>
							</div>
						</div>
						<div class="row">
								<div class="col-md-3">
									<?php
									echo $form->select2Group (
											$formModel,
											'jvaName',
											array(
												'asDropDownList' => false,
												'name' => 'jvaName',
												'id' => 'jvaName',
												'widgetOptions' => array(
													'options' => array(
														'width' => '260px',
														'minimumInputLength'=>'4',
														'placeholder' => 'JVA Name',
													),
													'events' => array(
															'select' => 'js:function () { console.log(item); }'
													),
												),
											)
									);
									?>
								</div>
								<div class="col-md-5 col-md-offset-1">
									<label>Dokument Typ:
											<div id="docSelection">
												<div class="btn-group btn-group-sm" role=group>
													<button type="button" class="btn btn-default" id="newInvoiceRadio">Rechnung</button>
													<button type="button" class="btn btn-default" id="newCollectiveInvoiceRadio">Sammelrechnung</button>
													<button type="button" class="btn btn-default" id="newDeliveryNoticeRadio">Lieferschein</button>
													<button type="button" class="btn btn-default" id="newCreditNoteRadio">Gutschrift</button>
												</div>
											</div>
									</label>
								</div>
								<div class="col-md-2 ">
									<?php echo $form->dateRangeGroup(
												$formModel,
												'startDate',
												array(
													'widgetOptions' => array(
														'callback' => 'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}'
													), 
													'wrapperHtmlOptions' => array(
														'class' => 'col-md-12',
													),
													'hint' => 'Bitte w&auml;hlen Sie eine Zeitspanne',
													'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
												)
											); 
									?>
							</div>
						</div>
					<div class="row">
						<?php
							// $this->widget(
								// 'booster.widgets.TbButton',
								// array(
									// 'label' => 'Suchen',
									// 'context' => 'primary',
								// )
							// ); 
						?>
					</div>
				</div>
					<?php
						$this->endWidget();
						unset($form);
					?>
			</div>
			<!-- BODY -->
			<div class="row panel-body">
					<?php $this->renderPartial('_searchResultsGrid'); ?>
			</div>
		</div>
		<div class="row panel-footer">
					<div class="row">
						<div class="col-md-4 col-md-offset-8">
							<div class="btn-group btn-group btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
								<a role=button class="btn btn-danger"><i class="fa fa-close"id="cancelDoc"> Abbrechen</i></a>
								<a role=button class="btn btn-success"><i class="fa fa-check" id="writingDoc"> Schreiben</i></a>
							</div>
						</div>
					</div>
		</div>
</div>
	
<!-- FOOT -->
<div class=row>
</div>


<script>
	$(document).on("click", "#docSelection .btn-group .btn", function () {
			$(this).addClass('active');
			$(this).siblings('.btn').removeClass('active');
	});
	
	$(document).on("mouseenter", "#docSelection .btn-group .btn", function () {
			$(this).addClass('btn-primary');
	});

	$(document).on("mouseleave", "#docSelection .btn-group .btn", function () {
			$(this).removeClass('btn-primary');
	});
	
	$(document).ready(function () {
		$("#jvaName").select2({
				ajax: {
					'url' : "/massaki/rechnungstool/index.php?r=jva/getJvaAsJson",
					'delay' : 300,
					'dataType' : 'json',
  					data : function(term, page) { return {jvaSearchTerm: term, page: page}; },

				},
				results :  function (data) {
						 return {
							 results: $.map(data, function (item) {
								 return {
									 text: item.jvaName + " | " + item.jvaNameExt,
									 value: item.jvaDataId,
									 id: item.jvaDataId
								 }
							 })
						 };
				}
			})	
		});


</script>