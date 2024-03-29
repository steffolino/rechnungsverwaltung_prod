<!-- HEAD -->
<!--div class=row>
	<p>Test head</p>
</div-->

<!-- MAIN -->
<div class=row>
		<div class="col-md-10 col-md-offset-1">
			<div class=jumbotron>
				<div class=row>
					<div id="jvaListContainer" class="col-md-5">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-heading">Liste aller JVAs</h3>
							</div>
							<div class="panel-content">
								<?php
								foreach ($jvaListAR as $jva) {
									echo "<div style='margin-left:20px; font-size:1.2em;' class='radio'><label><input class='jvaListItem' type='radio' name='jvaRadios' value='".$jva->jvaDataId."'>".$jva->jvaName ." ".$jva->jvaNameExt."</label></div>";
								}
								?>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12">
										<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
											<a role=button class="btn btn-danger" data-toggle="modal" data-target="#deactivateModal"><i class='fa fa-minus' > JVA entfernen</i></a>								
											<a role=button class="btn btn-success"><i class='fa fa-plus' id="buttonAddJva"> JVA hinzuf&uuml;gen</i></a>
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
							<div class="panel-content">
								<!--dl class="dl-horizontal"-->								
										<div id="jvaDetailsEditContent" class="col-md-12">
										   <?php $this->renderPartial('_jvaEditForm', array('jvaEditFormModel'=>$jvaEditFormModel,'colNames'=>$colNames)); ?>
										</div>	
									<div id="jvaDetailsAddContent">
										   <?php $this->renderPartial('_jvaAddForm', array('jvaAddFormModel'=>$jvaAddFormModel,'colNames'=>$colNames)); ?>
										</div>	

<?php										
/*											foreach ($jvaListAR as $jva) {
												echo "<dt style='margin-bottom: 5px;'>Name</dt><dd>".$jva->jvaName."</dd><dt>Adresse</dt><dd>".$jva->jvaAddress."</dd><dt>Grussformel</dt><dd>".$jva->jvaFooter."</dd>";
											}
*/										
							?>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12">
										<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
											<a role=button id="resetButt" class="btn btn-warning" ><i class='fa fa-close'> Änderungen Verwerfen</i></a>								
											<a role=button class="btn btn-info" id ='changeJva'><i class='fa fa-check'> Änderungen übernehmen</i></a>
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
        <p>Möchten Sie die selektierte JVA wirklich deaktivieren? </p>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" id="deactivateJVA" data-dismiss="modal" >Ja</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Nein</button>
      </div>
    </div>

  </div>
</div>
<!-- FOOT -->
<div class=row>
</div>

<script>
//TODO: put in extra file
	$(document).ready(function () {
<<<<<<< HEAD
		
		$("#resetButt").on('click', function (e) {
			e.preventDefault();
			$("#jvaAddForm")[0].reset();
			$("#jvaEditForm")[0].reset();
		});
		
=======
			$("#jvaDetailsAddContent").hide();	
>>>>>>> origin/beautify-jva-edit-form
			changeJvaNameHeader();
			
			$(".jvaListItem").on('click', function () {
				changeJvaNameHeader();
				console.log("clicked " + $(this).val());
				$("#jvaDetailsAddContent").hide();
				$("#jvaDetailsEditContent").show();
				changeJvaNameHeader();
				submitJVAId($(this).val());
			});
			
			$("#buttonAddJva").on('click', function(){
				
				console.log("add");
				$("#jvaDetailsEditContent").hide();
				
				$("#jvaDetailsAddContent").show();
				changeJvaNameHeader();
			});
			
			$('#deactivateJVA').on('click',function(){
				var jvaId = $(".jvaListItem:checked").val();
				
			});
			
			$("#changeJva").on('click', function(){
					saveJvaData();
			});	
	});
	
	function deactivateJVA(jvaId){
		$.ajax({
		  method: "POST",
		  url: "index.php?r=jva/deactivateJVAById",
		  data: { jvaID: jvaID}
		})
		  .done(function( data ) {
			console.log( "Jva deactivated : " + data );
			
			changeJvaNameHeader();
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
			$.ajax({
				method: "POST",
				url: "index.php?r=jva/saveJVAEditForm",
				data: {data: jvaDataArray}
			})
			.done(function( data ) {
				alert("data saved");			
			  });
		}else{
			jvaDataArray.push($('#JvaAddModel_jvaName').val());
			jvaDataArray.push($('#JvaAddModel_jvaNameExt').val());
			jvaDataArray.push($('#JvaAddModel_jvaCustNum').val());
			jvaDataArray.push($('#JvaAddModel_jvaCustNumDesc').val());
			jvaDataArray.push($('#JvaAddModel_jvaFooter').val());
			jvaDataArray.push($('#JvaAddModel_cvaAddress').val());
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
				alert("data saved");			
			  });
			
		}
		
	}
	
	function changeJvaNameHeader(){
			if($("#jvaName").val() != ""){
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