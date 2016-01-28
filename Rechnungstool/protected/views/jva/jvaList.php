<?php
	echo '
	<div class="row col-md-9 col-md-offset-1" style="position:fixed; z-index:5; top:50px;">
		<div id="successAlert" class="col-md-11 col-md-offset-0 alert alert-success" style="display:none; text-align:center;">
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
<div id="infoBarContainer" class="row col-md-2 col-md-offset-10" style="position:fixed; z-index:6; bottom: 440px;">
	<div class="well-sm">
		<span id="infoBar">JVA Editieren</span>
	</div>
</div>
<div class="row col-md-1 col-md-offset-10" style="position:fixed; z-index:6; bottom: 40px;">
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
										<div class="btn-group btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
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
										<div class="btn-group btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
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
										<div class="btn-group btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
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
										<div class="btn-group btn-group-justified" role="group" aria-label="JVA Liste bearbeiten">
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
				// changeJvaNameHeader();
				//console.log("clicked " + $(this).val());
				$("#jvaDetailsAddContent").hide();
				$("#jvaDetailsEditContent").show();
				changeJvaNameHeader();
				submitJVAId($(this).val());
				$("#infoBar").html('JVA editieren');
				$("#infoBarContainer").removeClass('alert-info').addClass('alert-success').show();
	});

	$(document).on("click", "#scrollUpa", function () {
			var body = $("html, body");
			body.stop().animate({scrollTop:0}, '1000', 'swing', function() { 
		});
	});
	
	// $(document).on("click", "#jvaAddForm .nav li a", function (e) {
			// e.preventDefault();
			// console.log("clicking nav");
			// $(this).addClass('active');
			// $(this).siblings().removeClass('active');

			// var indy = $("#jvaAddForm .nav li a").index(this);
			// console.log("index: " + indy);
			// $(".tab-content").children().fadeOut('fast');
			// var showTab = $(".tab-content").children().eq(indy);
			// console.log(showTab);
			// showTab.fadeIn('fast');
	// });
	
		// $("#jvaAddForm .nav li a").on('click', function(e) {
			// e.preventDefault();
			// console.log("clicking nav");
			// $(this).addClass('active');
			// $(this).siblings().removeClass('active');

			// var index = $("#jvaAddForm .nav li a").index(this);
			
			// $(".tab-content").index(index).fadeIn('fast');
			
		// });
	

//TODO: put in extra file
	$(document).ready(function () {
		//pre-fill colnames in jvaAddForm
		setDefaultColConfigs();
		
		$("#infoBarContainer").hide();
		
		$(".customClose").on('click', function (e) {
			console.log("closing");
			e.preventDefault();
			parent = $(this).closest('.alert');
			parent.slideUp('fast');
		})
		
		var selectedJva;
	
		$(".resetButt").on('click', function (e) {
			e.preventDefault();
			if($("#jvaEditForm").is(':visible')){
				$("#jvaEditForm")[0].reset();
				changeJvaNameHeader();
			}else{
				$("#jvaAddForm")[0].reset();
				changeJvaNameHeader();
			}
		});
		
		$("#jvaDetailsAddContent").hide();	
		changeJvaNameHeader();

		$(".buttonAddJva").on('click', function(){
			console.log("add");
			$("#jvaListContent").children('input:radio').each(function() { 
				$(this).prop('checked', false).checkboxradio("refresh");
				console.log($(this));
			});
			$("#jvaDetailsEditContent").hide();
			$("#jvaDetailsAddContent").show();
			changeJvaNameHeader();
			$("#infoBar").html('JVA erstellen');
			$("#infoBarContainer").removeClass('alert-success').addClass('alert-info').show();
		});
		
		$("#confirmDeactivateJVA").on('click',function(e){
			//console.log("confirmed deact");
			deactivateJva(selectedJva.val());
			$("#infoBarContainer").hide();
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
				$("#infoBarContainer").hide();
		});	
		
		$("#JvaAddModel_jvaName").on('input',function(){
			if($('#JvaAddModel_jvaName').val()!== ""){
				$("#jvaNameHeading").text($('#JvaAddModel_jvaName').val());
			}else{
				$("#jvaNameHeading").text("JVA ...");
			}
		});
	});
	
	function setDefaultColConfigs(){
		//default values...
		$("#addColName1-Ik option:eq(1)").attr('selected', true);
		$("#addColName2-Ik option:eq(2)").attr('selected', true);
		$("#addColName3-Ik option:eq(3)").attr('selected', true);
		$("#addColName4-Ik option:eq(4)").attr('selected', true);
		
		$("#addColName1-Memmel option:eq(5)").attr('selected', true);
		$("#addColName2-Memmel option:eq(7)").attr('selected', true);
		
		$("#addColName1-Loehne option:eq(5)").attr('selected', true);
		$("#addColName2-Loehne option:eq(7)").attr('selected', true);
		
		$("#addColName1-Witte option:eq(4)").attr('selected', true);
		
		//...empty all others
		$("#addColName5-Ik option:eq(0)").attr('selected', true);
		$("#addColName6-Ik option:eq(0)").attr('selected', true);
		$("#addColName7-Ik option:eq(0)").attr('selected', true);
		$("#addColName8-Ik option:eq(0)").attr('selected', true);
		$("#addColName9-Ik option:eq(0)").attr('selected', true);
		
		$("#addColName3-Memmel option:eq(0)").attr('selected', true);
		$("#addColName4-Memmel option:eq(0)").attr('selected', true);
		$("#addColName5-Memmel option:eq(0)").attr('selected', true);
		$("#addColName6-Memmel option:eq(0)").attr('selected', true);
		$("#addColName7-Memmel option:eq(0)").attr('selected', true);
		$("#addColName8-Memmel option:eq(0)").attr('selected', true);
		$("#addColName9-Memmel option:eq(0)").attr('selected', true);
		
		$("#addColName3-Loehne option:eq(0)").attr('selected', true);
		$("#addColName4-Loehne option:eq(0)").attr('selected', true);
		$("#addColName5-Loehne option:eq(0)").attr('selected', true);
		$("#addColName6-Loehne option:eq(0)").attr('selected', true);
		$("#addColName7-Loehne option:eq(0)").attr('selected', true);
		$("#addColName8-Loehne option:eq(0)").attr('selected', true);
		$("#addColName9-Loehne option:eq(0)").attr('selected', true);
		
		$("#addColName2-Witte option:eq(0)").attr('selected', true);
		$("#addColName3-Witte option:eq(0)").attr('selected', true);
		$("#addColName4-Witte option:eq(0)").attr('selected', true);
		$("#addColName5-Witte option:eq(0)").attr('selected', true);
		$("#addColName6-Witte option:eq(0)").attr('selected', true);
		$("#addColName7-Witte option:eq(0)").attr('selected', true);
		$("#addColName8-Witte option:eq(0)").attr('selected', true);
		$("#addColName9-Witte option:eq(0)").attr('selected', true);
		
	}
	
	function deactivateJva(jvaID){
		// console.log("calling controller");
		console.log("jvaID "+jvaID);
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
		jvaDataArray.push($('#colName1-Ik option:selected').text());
		jvaDataArray.push($('#colName2-Ik option:selected').text());
		jvaDataArray.push($('#colName3-Ik option:selected').text());
		jvaDataArray.push($('#colName4-Ik option:selected').text());
		jvaDataArray.push($('#colName5-Ik option:selected').text());
		jvaDataArray.push($('#colName6-Ik option:selected').text());
		jvaDataArray.push($('#colName7-Ik option:selected').text());
		jvaDataArray.push($('#colName8-Ik option:selected').text());
		jvaDataArray.push($('#colName9-Ik option:selected').text());
		
		jvaDataArray.push($('#colName1-Memmel option:selected').text());
		jvaDataArray.push($('#colName2-Memmel option:selected').text());
		jvaDataArray.push($('#colName3-Memmel option:selected').text());
		jvaDataArray.push($('#colName4-Memmel option:selected').text());
		jvaDataArray.push($('#colName5-Memmel option:selected').text());
		jvaDataArray.push($('#colName6-Memmel option:selected').text());
		jvaDataArray.push($('#colName7-Memmel option:selected').text());
		jvaDataArray.push($('#colName8-Memmel option:selected').text());
		jvaDataArray.push($('#colName9-Memmel option:selected').text());
		
		jvaDataArray.push($('#colName1-Loehne option:selected').text());
		jvaDataArray.push($('#colName2-Loehne option:selected').text());
		jvaDataArray.push($('#colName3-Loehne option:selected').text());
		jvaDataArray.push($('#colName4-Loehne option:selected').text());
		jvaDataArray.push($('#colName5-Loehne option:selected').text());
		jvaDataArray.push($('#colName6-Loehne option:selected').text());
		jvaDataArray.push($('#colName7-Loehne option:selected').text());
		jvaDataArray.push($('#colName8-Loehne option:selected').text());
		jvaDataArray.push($('#colName9-Loehne option:selected').text());
		
		jvaDataArray.push($('#colName1-Witte option:selected').text());
		jvaDataArray.push($('#colName2-Witte option:selected').text());
		jvaDataArray.push($('#colName3-Witte option:selected').text());
		jvaDataArray.push($('#colName4-Witte option:selected').text());
		jvaDataArray.push($('#colName5-Witte option:selected').text());
		jvaDataArray.push($('#colName6-Witte option:selected').text());
		jvaDataArray.push($('#colName7-Witte option:selected').text());
		jvaDataArray.push($('#colName8-Witte option:selected').text());
		jvaDataArray.push($('#colName9-Witte option:selected').text());
		jvaDataArray.push($('#Druck-Ik').val());
		jvaDataArray.push($('#Druck-Memmel').val());
		jvaDataArray.push($('#Druck-Loehne').val());
		jvaDataArray.push($('#Druck-Witte').val());
		// jvaDataArray.push($('#colName10 option:selected').text());
		// jvaDataArray.push($('#colName11 option:selected').text());
		// jvaDataArray.push($('#colName12 option:selected').text());
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
		//ADD JVA
		}else{
			jvaDataArray.push($('#JvaAddModel_jvaName').val());
			jvaDataArray.push($('#JvaAddModel_jvaNameExt').val());
			jvaDataArray.push($('#JvaAddModel_jvaCustNum').val());
			jvaDataArray.push($('#JvaAddModel_jvaCustNumDesc').val());
			jvaDataArray.push($('#JvaAddModel_jvaFooter').val());
			jvaDataArray.push($('#JvaAddModel_jvaAddress').val());
			jvaDataArray.push($('#addColName1-Ik option:selected').text());
			jvaDataArray.push($('#addColName2-Ik option:selected').text());
			jvaDataArray.push($('#addColName3-Ik option:selected').text());
			jvaDataArray.push($('#addColName4-Ik option:selected').text());
			jvaDataArray.push($('#addColName5-Ik option:selected').text());
			jvaDataArray.push($('#addColName6-Ik option:selected').text());
			jvaDataArray.push($('#addColName7-Ik option:selected').text());
			jvaDataArray.push($('#addColName8-Ik option:selected').text());
			jvaDataArray.push($('#addColName9-Ik option:selected').text());
			
			jvaDataArray.push($('#addColName1-Memmel option:selected').text());
			jvaDataArray.push($('#addColName2-Memmel option:selected').text());
			jvaDataArray.push($('#addColName3-Memmel option:selected').text());
			jvaDataArray.push($('#addColName4-Memmel option:selected').text());
			jvaDataArray.push($('#addColName5-Memmel option:selected').text());
			jvaDataArray.push($('#addColName6-Memmel option:selected').text());
			jvaDataArray.push($('#addColName7-Memmel option:selected').text());
			jvaDataArray.push($('#addColName8-Memmel option:selected').text());
			jvaDataArray.push($('#addColName9-Memmel option:selected').text());
			
			jvaDataArray.push($('#addColName1-Loehne option:selected').text());
			jvaDataArray.push($('#addColName2-Loehne option:selected').text());
			jvaDataArray.push($('#addColName3-Loehne option:selected').text());
			jvaDataArray.push($('#addColName4-Loehne option:selected').text());
			jvaDataArray.push($('#addColName5-Loehne option:selected').text());
			jvaDataArray.push($('#addColName6-Loehne option:selected').text());
			jvaDataArray.push($('#addColName7-Loehne option:selected').text());
			jvaDataArray.push($('#addColName8-Loehne option:selected').text());
			jvaDataArray.push($('#addColName9-Loehne option:selected').text());
			
			jvaDataArray.push($('#addColName1-Witte option:selected').text());
			jvaDataArray.push($('#addColName2-Witte option:selected').text());
			jvaDataArray.push($('#addColName3-Witte option:selected').text());
			jvaDataArray.push($('#addColName4-Witte option:selected').text());
			jvaDataArray.push($('#addColName5-Witte option:selected').text());
			jvaDataArray.push($('#addColName6-Witte option:selected').text());
			jvaDataArray.push($('#addColName7-Witte option:selected').text());
			jvaDataArray.push($('#addColName8-Witte option:selected').text());
			jvaDataArray.push($('#addColName9-Witte option:selected').text());
			jvaDataArray.push($('#printAmount-Ik').val());
			jvaDataArray.push($('#printAmount-Memmel').val());
			jvaDataArray.push($('#printAmount-Loehne').val());
			jvaDataArray.push($('#printAmount-Witte').val());
			// jvaDataArray.push($('#JvaAddModel_colName10 option:selected').text());
			// jvaDataArray.push($('#JvaAddModel_colName11 option:selected').text());
			// jvaDataArray.push($('#JvaAddModel_colName12 option:selected').text());
			
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
				$('#JvaAddModel_jvaName').val('');
				$('#JvaAddModel_jvaNameExt').val('');
				$('#JvaAddModel_jvaCustNum').val('');
				$('#JvaAddModel_jvaCustNumDesc').val('');
				$('#JvaAddModel_jvaFooter').val('');
				$('#JvaAddModel_jvaAddress').val('');
				
				setDefaultColConfigs();
				$("#jvaListContent").html(data);
				$("#jvaNameHeading").html('...');
				
			});
		}
		
	}
	
	function changeJvaNameHeader(){
			console.log("changing header");
			var t = setTimeout(function () {
				if(($("#jvaName").val() !== "") && typeof($('#jvaName').val()) !== 'undefined'){
					if($("#jvaDetailsEditContent").is(":visible")){
						$("#jvaNameHeading").text($('#jvaName').val() +" | "+$("#jvaNameExt").val());
						console.log($('#jvaName').val() +" | "+$("#jvaNameExt").val());
					}else{
						$("#jvaNameHeading").text("JVA ...");
					}
				}else{
					$("#jvaNameHeading").text("JVA ...");
				}
			}, 300);
	}
	
	
</script>