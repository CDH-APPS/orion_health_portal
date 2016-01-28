@extends('Vetting.main')

@section('content')





<div class="span9">
                    <div class="content">
                        <div class="module">
                            <div class="module-body">
                                <div class="profile-head media">
                                		   <div class="row" style="margin-left:30px; margin-right:40px;"><span class="pull-left" >SERVICE PROVIDER</span><span class="pull-right"> TOTAL COST</span></div>
                                          
                                           <div class="row" style="margin-left:30px; margin-right:40px;"><h3 class="pull-left" >{{ $claim->Service_Provider }}</h3><h3 class="pull-right"> GHC {{ $cost['TotalCost'] }}</h3></div>
                                           <!-- Member Info -->
	                                           <div class="unstyled span2">
	                                           		   
			                                           <div class="pull-left ">
			                                           <table class="table table-condensed" style="border:0px;">
				                                           	<tr><td>Member ID : <h5><div id="iniMemberID">{{ $claim->Member_ID }}</div></h5></td></tr>
				                                           	<tr><td>Member Type : 
				                                           	<h5>
				                                           		 {{ $claim->Member_Level }}
	                                                       	</h5>
	                                                       	</td></tr>
				                                           	<tr><td>Gender : <h5>
				                                           		@if($claim->Member_Level == "Account Holder"){{ $member->Gender or 'No Gender Found!' }} @endif
	                                           		   			@if($claim->Member_Level == "Dependant"){{ $dependant->Gender or 'No Gender Found!' }} @endif
				                                     
				                                           	</h5></td></tr>
				                                           	<tr><td>Date of Birth : <h5>
				                                           		@if($claim->Member_Level == "Account Holder"){{ $member->DOB or 'No Birth Date Found!'}}@endif
	                                           		   			@if($claim->Member_Level == "Dependant"){{ $dependant->DOB or 'No Birth Date Found!'}}@endif
				                
				                                           	</h5></td></tr>
			                                           </table>
			                                           </div>
	                                           </div>
                                           <!-- End Member Info -->



                                            <!-- Claim Info -->
	                                           <div class="unstyled span4">
	                                           		   
			                                           <div class="pull-left ">
			                                           <table class="table " style="border:0px;">
				                                           	<tr><td>Claim ID : <h5><div id="iniClaimID">{{ $claim->Claim_ID or 'No Claim ID Found!'}}</div></h5></td></tr>
				                                           	<tr><td>Type of Service : <h5>{{ $claim->Type_of_Service or 'No Service Type Found!'}}</h5></td></tr>
				                                           	<tr><td>Level of Care : <h5>{{ $claim->Level_of_Care or 'No Level of Care Found!'}}</h5></td></tr>
				                                           	<tr><td>Consultation : <h5>{{ $claim->Consultation_Type or 'No Consultation Found!'}} </h5></td></tr>
				                                           	
			                                           </table>
			                                           </div>
	                                           </div>
                                           <!-- Claim Info -->
                            
                            			    <!-- Cost Info -->

	                                           <div class="unstyled span2">
	                                           		   
			                                           <div class="pull-right ">
			                                           <table class="table " style="border:0px;">
				                                           	<tr><td><span class="pull-right">Consultation Cost</span> <h5 align="right">GHC <?php echo number_format( $cost['ConCost'] ,2) ?></h5></td></tr>
				                                           	<tr><td><span class="pull-right">Cost of Investigations</span><h5 align="right">GHC <?php echo number_format( $cost['InvCost'],2) ?></h5></td></tr>
				                                           	<tr><td><span class="pull-right">Cost of Medications</span><h5 align="right">GHC <?php echo number_format( $cost['MedCost'] ,2)  ?></h5></td></tr>
				                                            <tr><td><span class="pull-right">Cost of Procedures</span><h5 align="right">GHC <?php echo number_format( $cost['ProCost'] ,2) ?></h5></td></tr>	
				                                           	
			                                           </table>
			                                           </div>
	                                           </div>

                                           <!-- End Cost Info -->



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

		                                    

		                                    		<table id="diagnosisTable" cellpadding="0" cellspacing="0" border="0" class=" table table-bordered 	 " width="100%">
													<thead>
														<tr class="headings">
															<th>No.</th>
															<th>Diagnosis</th>
															
														</tr>
													</thead>
													<tbody>
														
													</tbody>
											
												</table>
											

                                    </div>
                                    <!-- End Diagnosis -->


                                	<!-- Investigations Tab -->
                                    
                                        
                                      <div class="tab-pane fade" id="investigations">

		                                   	
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
                           
                                    <!-- End Investigations -->



                                    <!-- Medications Tab -->
                                    <div class="tab-pane fade" id="medications">

                                   
                                              
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
                                    <!-- End Medications -->



                                    <!-- Procedures Tab -->
                                    <div class="tab-pane fade" id="procedures">

                                    
                     
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
                                    <!-- End Procedures -->



                                    <!-- Summary Tab -->
                                    <div class="tab-pane fade" id="summary">
                                              
                                        Summary  
                                        
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







<script>
	
	
    $(document).ready(function() { 

    	//Load Vals
    	loadDiagnosis();
    	loadInvestigations();
    	loadMedications();
    	loadProcedures();

    });

   


    

    

   //Functions Load Diagnosis

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
	        		
				    $('#diagnosisTable tbody').append('<tr><td>1</td><td>'+ value['Diagnosis'] +'</td></tr>');
				});
	                                        
	        },'json');	   	
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
	        		var btnVals = '';	    
	        		if(value['Status'] == '1')
	        		{ btnVals = '<a onclick="excludeInvestigations(\''+ value['Id'] +'\')" class="btn btn-success pull-right">Exclude</a>'; }	
	        		else if(value['Status'] == '0')
	        		{ btnVals = '<a onclick="includeInvestigations(\''+ value['Id'] +'\')"  class="btn btn-danger pull-right">Include</a>'; }	

				    $('#investigationsTable tbody').append('<tr><td>1</td><td>'+ value['Investigation'] +'</td><td>'+ value['Charge'] +'</td><td>'+ btnVals +'</td></tr>');
				});
	                                        
	        },'json');
	   	
   }

   function includeInvestigation(id,name)
   {
   		if(confirm("The cost of "+name+" would be included to the total cost of investigations?"))
   		{
	   		$.get('/IncludeInvestigation',
	        {
	           "ID": id
	           
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ }
				    else{ alert("The cost of "+name+" was not included to the total cost of investigations."); }
				    loadInvestigations();
				});
	                                        
	        },'json');
	   	}
   }



   function excludeInvestigations(id,name)
   {

   		if(confirm("The cost of "+name+" would be excluded from the total cost of  investigations?"))
   		{
	   		$.get('/ExcludeInvestigations',
	        {
	           "ID": id
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ alert(name+" has been removed from investigations."); }
				    else{ alert(name+" was not removed from investigations."); }
				    loadInvestigations();
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
	        		var btnVals = '';	    
	        		if(value['Status'] == '1')
	        		{ btnVals = '<a onclick="excludeMedication(\''+ value['Id'] +'\')" class="btn btn-success pull-right">Exclude</a>'; }	
	        		else if(value['Status'] == '0')
	        		{ btnVals = '<a onclick="includeMedication(\''+ value['Id'] +'\')"  class="btn btn-danger pull-right">Include</a>'; }	

				    $('#medicationsTable tbody').append('<tr><td>1</td><td>'+ value['Medication'] +'</td><td>'+ value['Charge'] +'</td><td>'+ value['Charge'] +'</td><td>'+ value['Charge'] +'</td><td><a onclick="alert()" class="btn btn-danger pull-right">Remove</a></td></tr>');
				});
	                                        
	        },'json');
	   	
   }

   function includeMedication(id,name)
   {
   		
   		if(confirm("The cost of "+name+" would be included to the total cost of medications?"))
   		{
   			
	   		$.get('/IncludeMedication',
	        {
	           "ID": id
	           
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ }
				    else{ alert("The cost of "+name+" was not included to the total cost of medications."); }
				    loadMedications();
				});
	                                        
	        },'json');
	   	}
   }



   function exludeMedication(id,name)
   {
   		if(confirm("The cost of "+name+" would be excluded from the total cost of medications?"))
   		{
	   		$.get('/ExcludeMedications',
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
				});
	                                        
	        },'json');
	   	}
   }
    
  //End Functions for Investigations




//Functions Load Add Remove Procedure
   
   function loadProcedure()
   {
   			
	   		$.get('/GetProcedure',
	        {
	           "CLAIM_ID": $("#iniClaimID").text()
	        },
	        function(data)
	        { 
	        	$('#proceduresTable tbody').empty();
	        	$.each(data, function (key, value) 
	        	{				    
	        		var btnVals = '';	    
	        		if(value['Status'] == '1')
	        		{ btnVals = '<a onclick="excludeProcedure(\''+ value['Id'] +'\')" class="btn btn-success pull-right">Exclude</a>'; }	
	        		else if(value['Status'] == '0')
	        		{ btnVals = '<a onclick="includeProcedure(\''+ value['Id'] +'\')"  class="btn btn-danger pull-right">Include</a>'; }	

				    $('#proceduresTable tbody').append('<tr><td>1</td><td>'+ value['Procedure'] +'</td><td>'+ value['Charge'] +'</td><td><a onclick="alert()" class="btn btn-danger pull-right">Remove</a></td></tr>');
				});
	                                        
	        },'json');
	   	
   }

   function includeProcedure(name,charge)
   {
   		
   		if(confirm("Do you want to add "+name+" to the procedures?"))
   		{
   			var quantity = prompt("Please specify the quantity");
   			alert(quntiy);
	   		$.get('/AddProcedure',
	        {
	           "CLAIM_ID": $("#iniClaimID").text(),
	           "SP_CODE": $("#iniMemberID").text(),
	           "MEMBER_ID":$("#iniMemberID").text(),	           
	           "Procedure":name,
	           "QUANTITY":quantity,
	           "COST":charge
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ alert(name+" has been added to procedures"); }
				    else{ alert(name+" was not added to procedures"); }
				    loadProcedures();
				});
	                                        
	        },'json');
	   	}
   }



   function excludeProcedure(id,name)
   {
   		alert("YO");
   		if(confirm("Do you want to remove "+name+" from the procedure?"))
   		{
	   		$.get('/RemoveProcedure/id',
	        {
	           "CLAIM_ID": $("#iniClaimID").text(),
	           "ID": id 
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) 
	        	{
				    if(value == "OK"){ alert(name+" has been removed from procedure."); }
				    else{ alert(name+" was not removed from procedure."); }
				    loadDiagnosis();
				});
	                                        
	        },'json');
	   	}
   }
    
  //End Functions for Investigations




</script>





@stop