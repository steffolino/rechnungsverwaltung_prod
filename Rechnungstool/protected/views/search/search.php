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
								'id' => 'headerForm',
								'type' => 'horizontal',
							)
						);
					?>
					<br/>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div class="input-group">
								  <input type="text" id="SearchFormModel_freeSearchTerm" class="form-control" placeholder="Freitextsuche, Rechnungsdetails, einzelne Posten" aria-describedby="basic-addon2">
									<div class="input-group-btn">
										<button id="headerResetBtn" class="btn btn-default" type=reset>Zur&uuml;cksetzen</button>
										<button id="headerSubmitBtn" class="btn btn-success" type=submit>Suchen</button>
									</div>
								 </div>
							</div>
						</div>
						<div class="row" id="filterToggle">
							<div class="col-md-12">
							<hr/>
							<h4>Zus&auml;tzliche Filter&nbsp;<i class="fa fa-plus"></i></h4>
							</div>
						</div>
						<div class="row" id="filterRow" style="display:none;">
								<div class="col-md-3">
									<label>Jva Name:<br/>
									<?php
										$this->widget(
											'booster.widgets.TbSelect2',
												array(
													'asDropDownList' => false,
													'name' => 'jvaName',
													'id' => 'jvaName',
													'options' => array(
														'width' => '220px',
														'minimumInputLength'=>'4',
														'placeholder' => 'JVA Name',
														'ajax'       => array(
																   'url'       => Yii::app()->controller->createUrl('jva/getJvaAsJson'),
																	'delay' => 300,
																   'dataType'  => 'json',
																   'data'      => 	'js:function(term, page) { return {jvaSearchTerm: term, page: page}; }',
																	'results'	=>  'js:function (data) {
																		return {
																			results: $.map(data, function (item) {
																				return {
																					text: item.jvaName + " | " + item.jvaNameExt,
																					value: item.jvaDataId,
																					id: item.jvaDataId
																				}
																			})
																		};
																	}'
															),
															'events' => array(
																//'select' => 'js:function () { console.log(item); }'
															),
													),
												)
										);
										?>
									</label>
								</div>
								<div class="col-md-5 col-md-offset-1">
									<label>Dokument Typ:<br/>
											<div id="docSelection">
												<div class="btn-group btn-group-sm" role=group>
													<button type="button" class="btn btn-default" id="Rechnung">Rechnung</button>
													<button type="button" class="btn btn-default" id="Sammelrechnung">Sammelrechnung</button>
													<button type="button" class="btn btn-default" id="Lieferschein">Lieferschein</button>
													<button type="button" class="btn btn-default" id="Gutschrift">Gutschrift</button>
												</div>
											</div>
									</label>
								</div>
							<div class="col-md-3">
								<label>Anfang:
								<?php     
									$this->widget(
										'booster.widgets.TbEditableField',
										array(
											'type' => 'date',
											'model' => $model,
											'attribute' => 'myattr',
											// 'url' => $endpoint, //url for submit data
											'placement' => 'right',
											'format' => 'dd-mm-yyyy',
											'viewformat' => 'dd.mm.yyyy',
											'options' => array(
											'datepicker' => array(
													'language' => 'de'
												)
											)
										)
									);
								?>
								</label>
								<br/>
								<label>Ende:&nbsp;&nbsp;&nbsp;
								<?php     
									$this->widget(
										'booster.widgets.TbEditableField',
										array(
											'type' => 'date',
											'model' => $model,
											'attribute' => 'myattr',
											// 'url' => $endpoint, //url for submit data
											'placement' => 'right',
											'format' => 'dd-mm-yyyy',
											'viewformat' => 'dd.mm.yyyy',
											'options' => array(
												'datepicker' => array(
													'language' => 'de'
												)
											)
										)
									);
								?>
								</label>
							</div>
					</div>
				</div>
					<?php
						$this->endWidget();
						unset($form);
					?>
			</div>
			<!-- BODY -->
			<div class="row panel-body" id="searchResults">
					<?php 
					
					$this->renderPartial('_searchResultsGrid'); 
					
					?>
			</div>
			<div class="row panel-footer">
					<!--div class="row">
						<div class="col-md-4 col-md-offset-8">
							<div class="btn-group btn-group btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
								<a role=button class="btn btn-danger"><i class="fa fa-close"id="cancelDoc"> Abbrechen</i></a>
								<a role=button class="btn btn-success"><i class="fa fa-check" id="writingDoc"> Schreiben</i></a>
							</div>
						</div>
					</div-->
			</div>
	</div>
</div>
	
<!-- FOOT -->
<div class=row>
</div>

<style>
	#filterToggle {
		cursor: pointer;
	}
</style>
<script>
	$(document).on("click", "#docSelection .btn-group .btn", function () {
			$(this).addClass('active');
			$(this).siblings('.btn').removeClass('active');
	});

	$(document).on("click", "#filterToggle", function () {
		//console.log("toggled");
		$("#filterRow").toggle('slow');
	});
	
	$(document).on("click", "#headerSubmitBtn", function (e) {
		e.preventDefault();
		var selectedDocType;
		$("#docSelection .btn").each(function() {
			if($(this).hasClass('active')) {
				selectedDocType = $(this).attr('id');
			}
		});
		//console.log(selectedDocType);
		var nameSet = $("#select2-chosen-1").text();
		//console.log(nameSet);
		var searchTerm = $("#SearchFormModel_freeSearchTerm").val();
		//console.log(searchTerm);
		var startDate = $(".editable").first().text();
		var endDate = $(".editable").last().text();
		//console.log(startDate + " " + endDate);
		var filtersEnabled = $("#filterRow").is(':visible');
	//	console.log(filtersEnabled);
		if(filtersEnabled) {
			$.ajax({
				method: "POST",
				type: "json",
				url: "index.php?r=search/search",
				data: { 
					searchTerm: searchTerm,	
					startDate: startDate,
					endDate : endDate,
					nameSet: nameSet,
					selectedDocType: selectedDocType,
					filtersEnabled: filtersEnabled
				}
			})
			.done(function(data) {
				$('#searchResults').html(data);
		  });
		} else {
			$.ajax({
				method: "POST",
				type: "json",
				url: "index.php?r=search/search",
				data: { 
					searchTerm: searchTerm,				
				}
			})
			.done(function(data) {
				$('#searchResults').html(data);
		  });
		}
		//DO AJAX SUBMIT FORM
		
	});
	
	$(document).on("mouseenter", "#docSelection .btn-group .btn", function () {
			$(this).addClass('btn-primary');
	});

	$(document).on("mouseleave", "#docSelection .btn-group .btn", function () {
			$(this).removeClass('btn-primary');
	});
	

</script>