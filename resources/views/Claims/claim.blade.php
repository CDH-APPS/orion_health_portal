@extends('main')

@section('content')





<div class="span9">
                    <div class="content">
                        <div class="module">
                            <div class="module-body">
                                <div class="profile-head media">
                                   


                                        
                                          
                                           <!-- Member Info -->
	                                           <div class=" unstyled span5">
	                                           		   <div class="pull-left" style="width:150px; hieght:100px;">
	                                           		   	@if($claim->Member_Type == "Account Holder"){{{ $memberpic->get_Image($claim->Member_ID) }}}@endif
	                                           		   	@if($claim->Member_Type == "Dependant"){{{ $memberpic->get_Dependant_Img($claim->Member_ID) }}}@endif
	                                           		   </div>
			                                           <div class="pull-left ">
			                                           <table class="table table-condensed" style="border:0px;">
				                                           	<tr><td>Member ID : <h5><div id="iniMemberID">{{ $claim->Member_ID }} [{{ $iniclaim->Member_Level }}]</div></h5></td></tr>
				                                           	<tr><td>Name : <h5>
				                                           		@if($claim->Member_Type == "Account Holder"){{{ $member->First_Name.' '.$member->Middle_Name.' '.$member->Last_Name }}}@endif
	                                           		   			@if($claim->Member_Type == "Dependant"){{{ $dependant->First_Name.' '.$dependant->Middle_Names.' '.$dependant->Last_Name }}}@endif
				                                           	</h5></td></tr>
				                                           	<tr><td>Gender : <h5>
				                                           		@if($claim->Member_Type == "Account Holder"){{{ $member->Gender }}}@endif
	                                           		   			@if($claim->Member_Type == "Dependant"){{{ $dependant->First_Name.' '.$dependant->Last_Name}}}@endif
				                                     
				                                           	</h5>
				                                           	</td></tr>
				                                           	<tr><td>Date of Birth : <h5>
				                                           		@if($claim->Member_Type == "Account Holder"){{{ $member->DOB }}}@endif
	                                           		   			@if($claim->Member_Type == "Dependant"){{{ $dependant->DOB }}}@endif
				                
				                                           	</h5></td></tr>
				                                           	<tr><td>Insurance Cover : <h5>

				                                           	{{ $iniaccount->Health_Plan }}
				                
				                                           	</h5></td></tr>
			                                           </table>
			                                           </div>
	                                           </div>
                                           <!-- End Member Info -->



                                            <!-- Claim Info -->
	                                           <div class="unstyled span3">
	                                           		   
			                                           <div class="pull-left ">
			                                           <table class="table " style="border:0px;">
				                                           	<tr><td>Claim ID : <h5><div id="iniClaimID">{{ $claim->Claim_No }}</div></h5></td></tr>
				                                           	<tr><td>Type of Service : <h5>{{ $claim->Service_Type }}</h5></td></tr>
				                                           	<tr>
				                                           	<td>
				                                           	Level of Care : 
				                                           	<div class="controls">
																<select name="levelofcare" id="levelofcare" tabindex="1" data-placeholder="Select here.." >
																	<option selected="" value="{{ $iniclaim->Level_of_Care }}">{{ $iniclaim->Level_of_Care }}</option>
																	<option value="GP">General Practice</option>
																	<option value="SP">Specialist Consultation</option>
																</select>
															</div>
				                                           	</td>
				                                           	</tr>
				                                           	<tr><td>
				                                           		Consultation : 
					                                           	<div class="controls">
																	<select  name="consultation" id="consultation" tabindex="1" data-placeholder="Select here.." >
																		<option selected="" value="{{ $iniclaim->Consultation_Type }}">{{ $iniclaim->Consultation_Type }}</option>
																		@foreach($iniconsultations as $consultation)
																		<option value="{{ $consultation['CHARGE'] }}">{{ $consultation['DESCRIPTION'] }}</option>
																		@endforeach
																	</select>
																</div>
				                                           	</td></tr>
				                                           	
			                                           </table>
			                                           </div>
	                                           </div>
                                           <!-- Claim Info -->
                            



                                </div>
                                <ul class="profile-tab nav nav-tabs">
                                	<li class="active"><a href="#diagnosis" data-toggle="tab"><h4>Diagnosis</h4></a></li>
                                    <li><a href="#investigations" data-toggle="tab"><h4>Investigations</h4></a></li>
                                    <li><a href="#medications" data-toggle="tab"><h4>Medications</h4></a></li>
                                    <li><a href="#procedures" data-toggle="tab"><h4>Procedures</h4></a></li>
                                    <li><a href="#summary" data-toggle="tab"><h4>Summary</h4></a></li>
                                </ul>
                                <div class="profile-tab-content tab-content">


                                	<!-- Diagnosis Tab -->
                                    <div class="tab-pane fade active in" id="diagnosis">

		                                    <div class="module-body table">

		                                    	<div><span class="pull-left" style="margin:10px; "><h4>Diagnosis</h4></span> <a class="btn  btn-primary pull-right" style="margin:10px;" data-toggle="modal" href="#addDiagnosis">Add Diagnosis</a></div>
												<table id="diagnosisTable" cellpadding="0" cellspacing="0" border="0" class=" table table-bordered 	 " width="100%">
													<thead>
														<tr class="headings">
															<th>No.</th>
															<th>Diagnosis</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														
													</tbody>
											
												</table>
											</div>

                                    </div>
                                    <!-- End Diagnosis -->


                                	<!-- Investigations Tab -->
                                    
                                        
                                      <div class="tab-pane fade" id="investigations">

		                                    <div class="module-body table">

		                                    	<div><span class="pull-left" style="margin:10px; "><h4>Investigations</h4></span> <a class="btn  btn-primary pull-right" style="margin:10px;" data-toggle="modal" href="#addInvestigation">Add Investigation</a></div>
												<table id="investigationsTable" cellpadding="0" cellspacing="0" border="0" class=" table table-bordered 	 " width="100%">
													<thead>
														<tr class="headings">
															<th>No.</th>
															<th>Investigation</th>
															<th>Cost</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														
													</tbody>
											
												</table>
											</div>

                                    </div>   
                           
                                    <!-- End Investigations -->



                                    <!-- Medications Tab -->
                                    <div class="tab-pane fade" id="medications">

                                    <div class="module-body table">

		                               <div><span class="pull-left" style="margin:10px; "><h4>Medications</h4></span> <a class="btn  btn-primary pull-right" style="margin:10px; " data-toggle="modal" href="#addMedication">Add Medication</a></div>
				
                                              
                                        <table id="medicationsTable" cellpadding="0" cellspacing="0" border="0" class=" table table-bordered 	 " width="100%">
													<thead>
														<tr class="headings">
															<th>No.</th>
															<th>Medication</th>
															<th>Unit Price</th>
															<th>Qty</th>
															<th>Total</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														
													</tbody>
											
												</table>                 
                                        </div>
                                    </div>
                                    <!-- End Medications -->



                                    <!-- Procedures Tab -->
                                    <div class="tab-pane fade" id="procedures">

                                    <div class="module-body table">

		                                    	<div><span class="pull-left" style="margin:10px; "><h4>Procedures</h4></span> <a class="btn  btn-primary pull-right" style="margin:10px; " data-toggle="modal" href="#addProcedure">Add Procedure</a></div>
				
                                              
                                        <table id="proceduresTable" cellpadding="0" cellspacing="0" border="0" class=" table table-bordered 	 " width="100%">
													<thead>
														<tr class="headings">
															<th>No.</th>
															<th>Procedure</th>
															<th>Unit Price</th>
															<th>Qty</th>
															<th>Total</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<tr class="even pointer">
															
														</tr>
													</tbody>
											
												</table>          
												</div>       
                                        
                                    </div>
                                    <!-- End Procedures -->



                                    <!-- Summary Tab -->
                                    <div class="tab-pane fade" id="summary">
                                              

                                    	 <div class="profile-head media">
                                   
	                                           <div class=" unstyled span4">
	                          

                                       				 <!-- Cost Summary -->

	                                           
	                                           		   <h3>Cost Summary</h3>
			                                           <table class="table table-condensed" style="border:0px;">
				                                           	<tr><td>Cost of Consultation : <h5><div id="consultationCost"></div></h5></td></tr>
				                                           	<tr><td>Cost of Investigation(s) : <h5><div id="investigationCost"></div></h5></td></tr>
				                                            <tr><td>Cost of Medication(s) : <h5><div id="medicationCost"></div></h5></td></tr>
				                                            <tr><td>Cost of Procedure(s) : <h5><div id="procedureCost"></div></h5></td></tr>     
			                                           </table>

                                           			<!-- End Cost Summary -->

                                           		</div>

                                           		<div class=" unstyled span4">
	                          

                                       				 <!-- Cost Summary -->

	                                           
	                                           		   <h3><div id="totalCost">Total Cost : GHC 200</div></h3>
			                                           <hr>
			                                           <a onclick="saveClaim()" class="btn btn-primary" >Save</a>
			                                           <a onclick="forwardClaim()" class="btn btn-success" >Forward Claim</a>
			                                           <a onclick="cancelClaim()" class="btn btn-danger" >Cancel Claim</a>

                                           			<!-- End Cost Summary -->

                                           		</div>
                                        </div>   			
 
                                        
                                    </div>
                                    <!-- End Summary -->



                                </div>
                            </div>
                            <!--/.module-body-->
                        </div>
                        <!--/.module-->
                    </div>
                    <!--/.content-->
                </div>



<!-- New Diagnosis -->

    <div id="addDiagnosis" class="modal hide fade" tabindex="-1" data-focus-on="input:first" style="width:800px;">
      <div class="modal-header module-head">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>New Diagnosis</h3>
      </div>
        <div class="modal-body">



        <!-- Inner Table -->
        									
												
												<div class="module-body table">
													<table id="tblDiagnosis"  cellpadding="0" cellspacing="0" border="0" class="display datatable-1 table table-bordered table-striped ">
														<thead>
															<tr class="headings">
															
																<th>Diagnosis</th>
																<th></th>
															</tr>
														</thead>
														<tbody >
														@foreach($iniDiagnosis as $diagnosis)
														<tr>
														<td>{{ $diagnosis->C }}</td>
														<td><a onclick="addDiagnosis('{{ $diagnosis->C }}')" href="#" class="btn btn-success pull-right">Add</a></td>
														</tr>
														@endforeach													
														</tbody>
														
													</table>
												</div>
											

        <!-- End Inner Table -->


        </div>
     </div>
 
<!-- End Diagnosis -->


<!-- New Investigation -->
<form class="form-horizontal row-fluid" action="/CreateSession" method="post">
    <div id="addInvestigation" class="modal hide fade" tabindex="-1" data-focus-on="input:first" style="width:800px;">
      <div class="modal-header module-head">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>New Investigation</h3>
      </div>
      <div class="modal-body">


        <!-- Inner Table -->
        									
												<div class="module-body table">
													<table id="tblInvestigations" cellpadding="0" cellspacing="0" border="0" class="display datatable-1 table table-bordered table-striped" >
														<thead>
															<tr class="headings">
									
																<th>Investigation</th>
																<th>Unit Cost</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
														
									
																@foreach($iniInvestigations as $investigation)
																<tr>
																<td>{{ $investigation["INVESTIGATION"] }}</td>
																<td>{{ $investigation["CHARGE"] }}</td>
																<td><a onclick="addInvestigation('{{ $investigation['INVESTIGATION'] }}','{{ $investigation['CHARGE'] }}')" class="btn btn-success pull-right">Add</a></td>
																</tr>
																@endforeach
																												
														</tbody>
														
													</table>
												</div>
										

        <!-- End Inner Table -->
        </div>
     </div>
</form>   
<!-- End Investigation -->




<!-- New Medication -->

    <div id="addMedication" class="modal hide fade" style="width:800px;">
      <div class="modal-header module-head">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>New Medication</h3>
      </div>
        <div class="modal-body">



        <!-- Inner Table -->
        									
												
												<div class="module-body table">
													<table id="tblMedications"  cellpadding="0" cellspacing="0" border="0" class="display datatable-2 table table-bordered table-striped" >
														<thead>
															<tr class="headings">
															
																<th>Medications</th>
																<th>Unit Cost</th>
																<th></th>
															</tr>
														</thead>
														<tbody >
														@foreach($iniMedications as $medication)
														<tr>
														<td>{{ $medication["DESCRIPTION"] }}</td>
														<td>{{ $medication["COST"] }}</td>
														<td><a onclick="addMedication('{{ $medication['DESCRIPTION'] }}','{{ $medication['COST'] }}')" href="#" class="btn btn-success pull-right">Add</a></td>
														</tr>
														@endforeach													
														</tbody>
														
													</table>
												</div>
											

        <!-- End Inner Table -->


        </div>
     </div>
 
<!-- End Medications -->








<!-- New Procedure -->
<form class="form-horizontal row-fluid" action="/CreateSession" method="post">
    <div id="addProcedure" class="modal hide fade" tabindex="-1" data-focus-on="input:first" style="width:800px;">
      <div class="modal-header module-head">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>New Procedure</h3>
      </div>
        <div class="modal-body">



        	<!-- Inner Table -->
        									
												<div class="module-body table">
													<table id="tblProcedures" cellpadding="0" cellspacing="0" border="0" class="display datatable-1 table table-bordered table-striped">
														<thead>
															<tr class="headings">
																
																<th>Procedure</th>
																<th>Unit Cost</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
														
																@foreach($iniProcedures as $procedure)
																<tr>
																<td>{{ $procedure["PROCEDURE"] }}</td>
																<td>{{ $procedure["CHARGE"] }}</td>
																<td><a onclick="addProcedure('{{ $procedure['PROCEDURE']}}','{{ $procedure['CHARGE'] }}')" class="btn btn-success pull-right">Add</a></td>
																</tr>
																@endforeach													
														</tbody>
														
													</table>
												</div>
											

        <!-- End Inner Table -->


        </div>
     </div>
</form>   
<!-- End Procedure -->





<script>
	
	
    $(document).ready(function() { 

    	
		//Initialize tables
    	//$('#tblDiagnosis').DataTable();
    	//$('#tblInvestigations').DataTable();
	    //$('#tblMedications').DataTable();
	    //$('#tblProcedures').DataTable();


	    //Save Consultation
	    $("#consultation").change(function() 
	    {
	    		alert("Work");
			    $.get('/SaveConsultation',
		        {
		           "CLAIM_ID":$("#iniClaimID").text(),
		           "CONSULTATION":$("#consultation option:selected").text(),
		           "COST":$("#consultation option:selected").val()                      
		        },
		        function(data)
		        { 
		        	
		        	if(data['OK'] == "OK"){ }else{alert("Consultation was not saved!");}
		                                        
		        },'json');
		});
	    

	    //Save Level of Care
	    $("#levelofcare").change(function() 
	    {
			    $.get('/SaveLevelOfCare',
		        {
		           "CLAIM_ID":$("#iniClaimID").text(),
		           "LEVELOFCARE":$("#levelofcare option:selected").text()
		                    
		        },
		        function(data)
		        { 
		        	
		        	if(data['OK'] == "OK"){  }else{alert("Level of care was not saved!");}
		                                        
		        },'json');
	    });


    	

		
    	//Load Vals
    	loadDiagnosis();
    	loadInvestigations();
    	loadMedications();
    	loadProcedures(); 
    	getTotalCost();
    

 

    });

    

   //Functions Load Add Remove Diagnosis

   function loadDiagnosis()
   {
   			
	   		$.get('/GetDiagnosis',
	        {
	           "CLAIM_ID": $("#iniClaimID").text()
	        },
	        function(data)
	        { 
	        	$('#diagnosisTable tbody').empty();
	        	$.each(data, function (key, value) 
	        	{				    
				    $('#diagnosisTable tbody').append('<tr><td>1</td><td>'+ value['Diagnosis'] +'</td><td><a onclick="removeDiagnosis(\''+ value['Id'] +'\',\''+ value['Diagnosis'] +'\')" class="btn btn-danger pull-right">Remove</a></td></tr>');
				});
	                                        
	        },'json');	   	
   }


  function addDiagnosis(name)
   {
   		if(confirm("Do you want to add "+name+" to the diagnosis?"))
   		{
	   		$.get('/AddDiagnosis',
	        {
	           "CLAIM_ID": $("#iniClaimID").text(),
	           "SP_CODE": $("#iniMemberID").text(),
	           "MEMBER_ID":$("#iniMemberID").text(),
	           "DIAGNOSIS":name
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ }
				    else{ alert(name+" was not added to diagnosis"); }
				    loadDiagnosis();
				    getTotalCost();
				});
	                                        
	        },'json');
	   	}
   }



   function removeDiagnosis(id,name)
   {

   		if(confirm("Do you want to remove "+name+" from the selected diagnosis?"))
   		{
	   		$.get('/RemoveDiagnosis',
	        {
	           "ID": id 
	        },
	        function(data)
	        { 
	        
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ }
				    else{ alert(name+" was not removed from diagnosis."); }
				    loadDiagnosis();
				    getTotalCost();
				});
	                                        
	        },'json');
	   	}
   }
    
  //End Functions for Diagnosis 



  //Functions Load Add Remove Investigation
   
   function loadInvestigations()
   {
   			
	   		$.get('/GetInvestigations',
	        {
	           "CLAIM_ID": $("#iniClaimID").text()
	        },
	        function(data)
	        { 
	        	$('#investigationsTable tbody').empty();
	        	$.each(data, function (key, value) 
	        	{				    
				    $('#investigationsTable tbody').append('<tr><td>1</td><td>'+ value['Investigation'] +'</td><td>'+ value['Charge'] +'</td><td><a onclick="removeInvestigation(\''+value['Id']+'\',\''+value['Investigation']+'\')" class="btn btn-danger pull-right">Remove</a></td></tr>');
				});
	                                        
	        },'json');
	   	
   }

   function addInvestigation(name,charge)
   {
   		if(confirm("Do you want to add "+name+" to the diagnosis?"))
   		{
	   		$.get('/AddInvestigation',
	        {
	           "CLAIM_ID": $("#iniClaimID").text(),
	           "SP_CODE": $("#iniMemberID").text(),
	           "MEMBER_ID":$("#iniMemberID").text(),
	           "INVESTIGATION":name,
	           "COST":charge
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){  }
				    else{ alert(name+" was not added to investigations"); }
				    loadInvestigations();
				    getTotalCost();
				});
	                                        
	        },'json');
	   	}
   }



   function removeInvestigation(id,name)
   {
   
   		if(confirm("Do you want to remove "+name+" from the investigation?"))
   		{
	   		$.get('/RemoveInvestigation',
	        {
	           "ID": id 
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ }
				    else{ alert(name+" was not removed from investigations."); }
				    loadInvestigations();
				    getTotalCost();
				});
	                                        
	        },'json');
	   	}
   }
    
  //End Functions for Investigations





  //Functions Load Add Remove Medications
   
   function loadMedications()
   {
   			
	   		$.get('/GetMedications',
	        {
	           "CLAIM_ID": $("#iniClaimID").text()
	        },
	        function(data)
	        { 
	        	$('#medicationsTable tbody').empty();
	        	$.each(data, function (key, value) 
	        	{				    
				    $('#medicationsTable tbody').append('<tr><td>1</td><td>'+ value['Medication'] +'</td><td>'+ value['Unit_Price'] +'</td><td>'+ value['Quantity'] +'</td><td>'+ value['Charge'] +'</td><td><a onclick="removeMedication(\''+value['Id']+'\',\''+value['Medication']+'\')" class="btn btn-danger pull-right">Remove</a></td></tr>');
				});
	                                        
	        },'json');
	   	
   }

   function addMedication(name,charge)
   {
   		


   		if(confirm("Do you want to add "+name+" to the medications?"))
   		{
   			var quantity = prompt("Please specify the quantity.");
   		
	   		$.get('/AddMedication',
	        {
	           "CLAIM_ID": $("#iniClaimID").text(),
	           "SP_CODE": $("#iniMemberID").text(),
	           "MEMBER_ID":$("#iniMemberID").text(),	           
	           "MEDICATION":name,
	           "QUANTITY":quantity,
	           "COST":charge
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ }
				    else{ alert(name+" was not added to medications"); }
				    loadMedications();
				    getTotalCost();
				});
	                                        
	        },'json');
	   	}
   }



   function removeMedication(id,name)
   {
   		if(confirm("Do you want to remove "+name+" from the medications?"))
   		{
	   		$.get('/RemoveMedication',
	        {
	           "ID": id 
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ }
				    else{ alert(name+" was not removed from medications."); }
				    loadMedications();
				    getTotalCost();
				});
	                                        
	        },'json');
	   	}
   }
    
  //End Functions for Investigations




//Functions Load Add Remove Procedure
   
   function loadProcedures()
   {
   			
	   		$.get('/GetProcedures',
	        {
	           "CLAIM_ID": $("#iniClaimID").text()
	        },
	        function(data)
	        { 
	        	$('#proceduresTable tbody').empty();
	        	$.each(data, function (key, value) 
	        	{
	        	 	$('#proceduresTable tbody').append('<tr><td>1</td><td>'+ value['Treatment'] +'</td><td>'+ value['Unit_Price'] +'</td><td>'+ value['Quantity'] +'</td><td>'+ value['Charge'] +'</td><td><a onclick="removeProcedure(\''+value['Id']+'\',\''+value['Treatment']+'\')" class="btn btn-danger pull-right">Remove</a></td></tr>');				
	        	});
	                                        
	        },'json');
	   	
   }

   function addProcedure(name,charge)
   {
   		
   		if(confirm("Do you want to add "+name+" to the procedures?"))
   		{
   			var quantity = prompt("Please specify the quantity");
   			
	   		$.get('/AddProcedure',
	        {
	           "CLAIM_ID": $("#iniClaimID").text(),
	           "SP_CODE": $("#iniMemberID").text(),
	           "MEMBER_ID":$("#iniMemberID").text(),	           
	           "PROCEDURE":name,
	           "QUANTITY":quantity,
	           "COST":charge
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ }
				    else{ alert(name+" was not added to procedures"); }
				    loadProcedures();
				    getTotalCost();
				});
	                                        
	        },'json');
	   	}
   }



   function removeProcedure(id,name)
   {
   		if(confirm("Do you want to remove "+name+" from the procedure?"))
   		{
	   		$.get('/RemoveProcedure',
	        {
	           "ID": id 
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ }
				    else{ alert(name+" was not removed from procedure."); }
				    loadProcedures();
				    getTotalCost();
				});
	                                        
	        },'json');
	   	}
   }

   //End Functions for Investigations


   function getTotalCost()
   {
   		
	   		$.get('/GetTotalCost',
	        {
	           "CLAIM_ID": $("#iniClaimID").text()
	        },
	        function(data)
	        { 

	        	$("#consultationCost").text('GHC '+data['ConCost']);
	        	$("#investigationCost").text('GHC '+data['InvCost']);
	        	$("#medicationCost").text('GHC '+data['MedCost']);
	        	$("#procedureCost").text('GHC '+data['ProCost']);
	        	$("#totalCost").text('Total Cost GHC '+(data['TotalCost']));
                               
	        },'json');
	   	
   }
    
  //Save Claim
  function saveClaim()
  {
  		if(confirm("Do you wish to save and continue this claim later?"))
  		{
  			window.location.href = "/PendingSessions";
  		}
  }

  function forwardClaim()
  {
  		if(confirm("Do you wish to forward this claim?"))
  		{
  			$.get('/ForwardClaim',
	        {
	           "CLAIM_ID": $("#iniClaimID").text()
	        },
	        function(data)
	        { 

	        	if(data['OK']){ alert('Claim has been forwarded successfully.'); window.location.href = "/PendingSessions"; }
	        	else{ alert('The claim was not forwarded due to some technical challenges, please contact the system administrator.'); }
                               
	        },'json');
  		}

  }

  function cancelClaim()
  {
  		if(confirm("Do you wish to cancel this claim?"))
  		{
  			$.get('/CancelClaim',
	        {
	           "CLAIM_ID": $("#iniClaimID").text()
	        },
	        function(data)
	        { 

	        	if(data['OK']){ alert('Claim has been canceled.'); window.location.href = "/PendingSessions"; }
	        	else{ alert('The claim was not canceled due to some technical challenges, please contact the system administrator.'); }
                               
	        },'json');
  		}
  }


</script>





@stop