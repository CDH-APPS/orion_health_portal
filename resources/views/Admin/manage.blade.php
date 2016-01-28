@extends('Admin.index')

@section('content')


					<div class="module">
							<div class="module-head">
								<h3>Service Provider Management</h3>

							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr class="headings">
										
											<th>SP CODE</th>
											<th>SERVICE PROVIDER</th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									
										@foreach($sps as $sp)
										<tr>
											
											<td>{{ $sp->Facility_Reg_No }}</td>
											<td>{{ $sp->Facility_Name }}</td>
											<td>
												<a onclick="callUsers('{{ $sp->Facility_Reg_No }}','{{ $sp->Facility_Name }}')"  class="btn btn-primary pull-right" data-toggle="modal" href="ViewSPUsers/{{ $sp->Facility_Reg_No }}"><i class="icon-user"></i>Users</a>
											</td>
											<td>
												<a onclick="config('{{ $sp->Facility_Reg_No }}','{{ $sp->Facility_Name }}')"  class="btn btn-primary pull-right" data-toggle="modal" href="ConfigSP/{{ $sp->Facility_Reg_No }}"><i class="icon-cog"></i>Config</a>
											</td>
											<td>
												@if(file_exists('docs/'.$sp->Facility_Reg_No.'.xls'))
												<a onclick="doUploadTarrif('{{ $sp->Facility_Reg_No }}','{{ $sp->Facility_Name }}')"  class="btn btn-success pull-right" data-toggle="modal" href="#uploadTariff"><i class="icon-upload "></i>Upload</a>
												@else
												<a onclick="doUploadTarrif('{{ $sp->Facility_Reg_No }}','{{ $sp->Facility_Name }}')"  class="btn pull-right" data-toggle="modal" href="#uploadTariff"><i class="icon-upload shaded"></i>Upload</a>
												@endif
											</td>
										</tr>
										@endforeach
									</tbody>
								
								</table>
							</div>
						</div>








 





<!-- Upload Tariff -->

 <form  id="frmUpload" class="form-horizontal row-fluid" action="/UploadTariff" method="post" enctype="multipart/form-data">
    <div id="uploadTariff" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
      <div class="modal-header">
        <button id="close_session" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Upload Tariff for </h3><div id="uploadspname"></div>
      
      </div>
        <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">SP Code:</label>
                                            <div class="controls">
                                                <input type="text" name="uploadspcode" id="uploadspcode" disabled="">
                                            </div>
                                        </div>

                                         <div class="control-group">
                                            <label class="control-label" for="basicinput">Browse for File :</label>
                                            <div class="controls">
                                                <input type="file" name="uploadfile" id="uploadfile" accept="application/vnd.ms-excel" />
                                            </div>
                                        </div>
       </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-large btn-danger">Cancel</button>
        <button id="sendUpload" type="button" onclick="doUpload()" class="btn btn-large btn-primary">Save File</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
    </div>
  </form>
<!-- End Upload Tariff-->





<script type="text/javascript">
	
	$(document).ready(function() { 



 	});

 	function callUsers(facility_no,facility_name)
 	{

  		$("#spName").text(facility_name);

 		//Load Users
    	$.get('/GetSPUsers',
        {
           "SPCODE": facility_no                       
        },
        function(data)
        { 
        	
        	$.each(data, function (key, value) {
			  $('#tblSPUsers tbody').append('<tr><td>'+ value['Name'] +'</td><td>'+ value['Email'] +'</td><td><a onclick="alert()" class="btn btn-danger pull-right">Remove</a></td><td><a onclick="alert()" class="btn btn-danger pull-right">Remove</a></td></tr>');
			});

                                        
        },'json');

        $('#tblSPUsers').DataTable();
 	}


 

 	function doUploadTarrif(facility_no,facility_name)
 	{	
 		$("#uploadspname").text(facility_name);
 		$("#uploadspcode").val(facility_no); 		
	
 	}



 	function doUpload()
 	{
 		if(tariffExist($("#uploadspcode").val()))
 		{

	    	if(confirm("File already exists, do you want to overwriete file?"))
 			{
 				
 				if($("#uploadfile").val() != "") 
	 			{
	 				if($("#uploadspcode").val() != ""){ $("#frmUpload").submit(); }
	 				else{ alert("No SP Code was found for this upload!"); }					
				}
				else{ alert("Please select the tariff file!"); }
 				
 			}
 			else
 			{
				$("#close_session").click();
 				return false;
 			}

 		}
 		else
 		{
 			if($("#uploadfile").val() != "") 
 			{
 				if($("#uploadspcode").val() != "")
 				{
 					
 					var input = $("<input>").attr("text", "hidden").attr("name", "uploadspcode").val($("#uploadspcode").val());
					$('#frmUpload').append($(input));
					$("#frmUpload").submit(); 
 				}
 				else{ alert("No SP Code was found for this upload!"); }				
			}
			else{ alert("Please select the tariff file!"); }
 		}
 	}




 	function tariffExist(facility_no)
 	{

	    var url = "docs/"+facility_no+".xls";
	   
	    
	    $.get(url).done(function() { 

 			return true;

	    }).fail(function() { 
	    	return false; 
	    });

	}

</script>
 

@stop