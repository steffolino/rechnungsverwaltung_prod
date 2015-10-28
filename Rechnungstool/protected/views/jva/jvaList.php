<!-- HEAD -->
<!--div class=row>
	<p>Test head</p>
</div-->
<?php
	echo '
	<div class="row col-md-10 col-md-offset-1" style="position:fixed; z-index:5; top:50px;">
		<div id="successAlert" class="col-md-12 col-md-offset-0 alert alert-success" style="display:none; text-align:center;">
			<button type="button" class="customClose" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 style="margin-top: 10px; margin-bottom:10px;" id="successAlertContent"></h4>
		</div>
	</div>
	<div class="row col-md-10 col-md-offset-1" style="position:fixed; z-index:5; top:50px;">
		<div id="errorAlert" class="col-md-12 col-md-offset-0 alert alert-danger" style="display:none; text-align:center;">
			<button type="button" class="customClose" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 style="margin-top:10px; margin-bottom:10px;" id="errorAlertContent"></h4>
		</div>
	</div>';
?>
<div class="row col-md-1 col-md-offset-11" style="position:fixed; z-index:6; bottom: 40px;">
	<div class="pull-right">
		<a id="scrollUpa" style="cursor:pointer; "><i alt="Scroll Top" class="fa fa-2x fa-angle-double-up"></i></a>
	</div>
</div>
<!-- MAIN -->
<div class=row>
		<div class="col-md-12">
			<div class=jumbotron>
				<div class=row>
					<div id="jvaListContainer" class="col-md-5">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-heading">Liste aller JVAs</h3>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12">
										<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
											<a role=button class="btn btn-danger buttonDeactivateJva"><i class="fa fa-minus"> JVA deaktivieren</i></a>
											<a role=button class="btn btn-success buttonAddJva"><i class="fa fa-plus"> JVA hinzuf&uuml;gen</i></a>
										</div>
									</div>
								</div>
							</div>
							<div id="jvaListContent" class="panel-content">
								<?php $this->renderPartial('_jvaList', array('jvaListModel'=>$jvaListModel)); ?>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12">
										<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
											<a role=button class="btn btn-danger buttonDeactivateJva"><i class="fa fa-minus"> JVA deaktivieren</i></a>
											<a role=button class="btn btn-success buttonAddJva"><i class="fa fa-plus"> JVA hinzuf&uuml;gen</i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="jvaDetailsContainer" class="col-md-7">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-heading">Details zu <span id ="jvaNameHeading"></span></h3>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12">
										<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
											<a role=button class="btn btn-warning resetButt" ><i class='fa fa-close'> Änderungen Verwerfen</i></a>								
											<a role=button class="btn btn-info changeJva"><i class='fa fa-check'> Änderungen übernehmen</i></a>
											</div>
									</div>
								</div>
							</div>
							<div class="panel-content">
								<!--dl class="dl-horizontal"-->								
										<div id="jvaDetailsEditContent" class="col-md-12">
										   <?php $this->renderPartial('_jvaEditForm', array('jvaEditFormModel'=>$jvaEditFormModel,'colNames'=>$colNames)); ?>
										</div>	
									<div id="jvaDetailsAddContent">
										   <?php $this->renderPartial('_jvaAddForm', array('jvaAddFormModel'=>$jvaAddFormModel,'colNames'=>$colNames)); ?>
										</div>	
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12">
										<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
											<a role=button class="btn btn-warning resetButt" ><i class='fa fa-close'> Änderungen Verwerfen</i></a>								
											<a role=button class="btn btn-info changeJva"><i class='fa fa-check'> Änderungen übernehmen</i></a>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
/*						if(isset($jvaListAR)) {
							echo "<pre>";
							var_dump($jvaListAR);
							echo "</pre>";
						} else {
							echo "jva list not set";
						}
	*/				?>
			</div>
		</div>
</div>
<!-- Modal -->
<div id="deactivateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Deaktivieren einer Jva </h4>
      </div>
      <div class="modal-body">
        <p>Möchten Sie die JVA <em><span class="warning" id="deactivateModalJvaName"></span></em> wirklich deaktivieren? </p>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-primary" id="confirmDeactivateJVA" data-dismiss="modal" >Ja</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Nein</button>
      </div>
    </div>

  </div>
</div>
<!-- FOOT -->
<div class=row>
</div>

<script>

	$(document).on("click", ".jvaListItem", function () {
				changeJvaNameHeader();
				//console.log("clicked " + $(this).val());
				$("#jvaDetailsAddContent").hide();
				$("#jvaDetailsEditContent").show();
				changeJvaNameHeader();
				submitJVAId($(this).val());		
	});

	$(document).on("click", "#scrollUpa", function () {
			var body = $("html, body");
			body.stop().animate({scrollTop:0}, '1000', 'swing', function() { 
		});
	});

//TODO: put in extra file
	$(document).ready(function () {
		
		$(".customClose").on('click', function (e) {
			console.log("closing");
			e.preventDefault();
			parent = $(this).closest('.alert');
			parent.slideUp('fast');
		})
		
		
		
		var selectedJva;
	
		$(".resetButt").on('click', function (e) {
			e.preventDefault();
			$("#jvaAddForm")[0].reset();
			$("#jvaEditForm")[0].reset();
		});
		
			$("#jvaDetailsAddContent").hide();	
			changeJvaNameHeader();

			$(".buttonAddJva").on('click', function(){				
				//console.log("add");
				$("#jvaDetailsEditContent").hide();
				$("#jvaDetailsAddContent").show();
				changeJvaNameHeader();
			});
			
			$("#confirmDeactivateJVA").on('click',function(e){
				//console.log("confirmed deact");
				deactivateJva(selectedJva.val());
			});

			$(".buttonDeactivateJva").on('click',function(e){
				e.preventDefault();
				selectedJva = $(".jvaListItem:checked");
				if(selectedJva.val() !== undefined) {
					//get values from list
					var jvaId = selectedJva.val();
					var jvaName = selectedJva.parent().text();
					//console.log(jvaId);
					//console.log(jvaName);
					//hide alert anyway
					$("#errorAlert").slideUp('fast');
					//Set name and show modal
					$("#deactivateModalJvaName").html(jvaName);
					$("#deactivateModal").modal('show');
				} else {
					//show: please select a jva
					$("#errorAlertContent").html('Bitte w&auml;hlen Sie zuerst eine JVA.');
					$("#errorAlert").slideDown('fast');
				}
				
			});
			
			$(".changeJva").on('click', function(){
					saveJvaData();
			});	
			
			$("#JvaAddModel_jvaName").on('input',function(){
				if($('#JvaAddModel_jvaName').val()!== ""){
					$("#jvaNameHeading").text($('#JvaAddModel_jvaName').val());
				}else{
					$("#jvaNameHeading").text("JVA ...");
				}
			});
	});
	
	function deactivateJva(jvaID){
		// console.log("calling controller");
		// console.log("jvaID "+jvaID);
		$.ajax({
		  method: "POST",
		  url: "index.php?r=jva/deactivateJVAById",
		  data: { jvaID: jvaID}
		})
		  .done(function( data ) {
			// console.log( "Jva deactivated : " + data );
			$("#jvaListContent").empty();
			$("#jvaListContent").html(data);
			$("#successAlertContent").html('JVA erfolgreich deaktiviert.')
			$("#successAlert").slideDown('fast');
			$("#jvaDetailsAddContent").hide();
			$("#jvaDetailsEditContent").hide();
			$("#jvaNameHeading").html('...');
		  });
		
		
	}
	
	function submitJVAId (jvaID) {
		$.ajax({
		  method: "POST",
		  url: "index.php?r=jva/loadJVAEditForm",
		  data: { jvaID: jvaID}
		})
		  .done(function( data ) {
			//console.log( "Data Saved: " + data );
			$("#jvaDetailsEditContent").html(data);
			changeJvaNameHeader();
		  });
	}
 
	function saveJvaData(){
		var  jvaDataArray =[];		
				
		if($("#jvaDetailsEditContent").is(":visible")){	
		console.log("is visibe");
		jvaDataArray.push($('#jvaName').val());
		jvaDataArray.push($('#jvaNameExt').val());
		jvaDataArray.push($('#jvaCustNum').val());
		jvaDataArray.push($('#jvaCustNumDesc').val());
		jvaDataArray.push($('#jvaFooter').val());
		jvaDataArray.push($('#jvaAddress').val());
		jvaDataArray.push($('#colName1 option:selected').text());
		jvaDataArray.push($('#colName2 option:selected').text());
		jvaDataArray.push($('#colName3 option:selected').text());
		jvaDataArray.push($('#colName4 option:selected').text());
		jvaDataArray.push($('#colName5 option:selected').text());
		jvaDataArray.push($('#colName6 option:selected').text());
		jvaDataArray.push($('#colName7 option:selected').text());
		jvaDataArray.push($('#colName8 option:selected').text());
		jvaDataArray.push($('#colName9 option:selected').text());
		jvaDataArray.push($('#colName10 option:selected').text());
		jvaDataArray.push($('#colName11 option:selected').text());
		jvaDataArray.push($('#colName12 option:selected').text());
		console.log(jvaDataArray);
			$.ajax({
				method: "POST",
				url: "index.php?r=jva/saveJVAEditForm",
				dataType: 'html',
				data: {data: jvaDataArray}
			})
			.done(function( data ) {
				console.log("success");
				$("#successAlertContent").html('JVA erfolgreich bearbeitet.')
				$("#successAlert").slideDown('fast');
			  });
		}else{
			jvaDataArray.push($('#JvaAddModel_jvaName').val());
			jvaDataArray.push($('#JvaAddModel_jvaNameExt').val());
			jvaDataArray.push($('#JvaAddModel_jvaCustNum').val());
			jvaDataArray.push($('#JvaAddModel_jvaCustNumDesc').val());
			jvaDataArray.push($('#JvaAddModel_jvaFooter').val());
			jvaDataArray.push($('#JvaAddModel_jvaAddress').val());
			jvaDataArray.push($('#JvaAddModel_colName1 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName2 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName3 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName4 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName5 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName6 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName7 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName8 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName9 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName10 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName11 option:selected').text());
			jvaDataArray.push($('#JvaAddModel_colName12 option:selected').text());
			
			$.ajax({
				method: "POST",
				url: "index.php?r=jva/saveJVAAddForm",
				data: {data: jvaDataArray}
			})
			.done(function( data ) {
				// console.log("success");
				$("#successAlertContent").html('Neue JVA erfolgreich hinzugefügt')
				$("#successAlert").fadeIn('fast');
				$("#jvaListContent").empty();
				$("#jvaDetailsAddContent").empty();
				$("#jvaListContent").html(data);
				$("#jvaNameHeading").html('...');
			});
		}
		
	}
	
	function changeJvaNameHeader(){
			if($("#jvaName").val() !== ""){
				if($("#jvaDetailsEditContent").is(":visible")){
					$("#jvaNameHeading").text($('#jvaName').val());
				}else{
					$("#jvaNameHeading").text("JVA ...");
				}
			}else{
				$("#jvaNameHeading").text("JVA ...");
			}
		
	}
</script>