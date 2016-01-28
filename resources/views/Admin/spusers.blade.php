

@extends('Admin.index')

@section('content')


<!-- Manage Users-->

					<div class="module">
							<div class="module-head">
					
								<h4>USER MANAGEMENT - {{ $sp[0]->Facility_Name }}</h4>
								<hr><div style="margin-bottom:10px;"><b>SERVICE PROVIDER CODE : </b><code>{{ $sp[0]->Facility_Reg_No }}</code>
								<a onclick="addUsers('{{ $sp[0]->Facility_Reg_No }}','{{ $sp[0]->Facility_Name }}')"  class="btn btn-primary pull-right" data-toggle="modal" href="#userDetails"><i class="icon-plus"></i>Add New User</a>
								</div>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
									<thead>
										<tr class="headings">
										
											<th>Name of User</th>
											<th>User Email/Login</th>
											<th>User Type</th>
											
											<th>Edit</th>
											<th>Password</th>
											<th>Status</th>
		
										</tr>
									</thead>
									
										@foreach($sp_users as $ini_user)
										<tr>
											<td>{{ $ini_user->Name }}</td>
											<td>{{ $ini_user->Email }}</td>
											<td>{{ $ini_user->User_Type }}</td>
											
											<td>
												<a onclick="editUser('{{ $ini_user->Id }}','{{ $sp[0]->Facility_Name }}')"  class="btn btn-primary pull-right" data-toggle="modal" href="#userDetails"><i class="icon-edit"></i>Edit</a>
											</td>
											<td>
												<a onclick="resetPassword('{{ $ini_user->Id }}','{{ $sp[0]->Facility_Name }}','{{ $ini_user->Name }}')"  class="btn btn-primary pull-right" data-toggle="modal" href="#"><i class="icon-key"></i>Reset</a>
											</td>
											<td>
												@if($ini_user->Status == 1)
													<a onclick="deactivate('{{ $ini_user->Id }}')"  class="btn btn-success pull-right" style="width:50px;" data-toggle="modal" >Active</a>
												@else
													<a onclick="activate('{{ $ini_user->Id }}')"  class="btn btn-danger pull-right" style="width:50px;" data-toggle="modal" >Blocked</a>
												@endif
											</td>
										</tr>
										@endforeach

									</tbody>
								
								</table>
							</div>
						</div>
 
<!-- End Manage Users -->





<!-- User Form-->

 <form class="form-horizontal row-fluid"  method="post">
    <div id="userDetails" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
      <div class="modal-header">
        <button id="close_session" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>User details for </h3><span id="userSpName"></span>
        <span id="membername"></span>
      </div>
        <div class="modal-body">

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">SP Code:</label>
                                            <div class="controls">
                                                <input type="text" name="userspcode" id="userspcode" disabled="">
                                            </div>
                                        </div>

                                         <div class="control-group">
                                            <label class="control-label" for="basicinput">Name of User :</label>
                                            <div class="controls">
                                                <input type="text" name="name" id="name" >
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Email :</label>
                                            <div class="controls">
                                                <input type="email" name="email" id="email" >
                                            </div>
                                        </div>
                                       
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Mobile No. :</label>
                                            <div class="controls">
                                                <input type="text" name="contactno" id="contactno" >
                                            </div>
                                        </div>
                                        


                                        <div class="control-group">
                                            <label class="control-label">User Type :</label>
                                            <div class="controls">
                                            <select  name="usertype" id="usertype" tabindex="1" data-placeholder="Select here.." >
                                                <option value="Admin">Admin</option>
                                                <option value="Claims Officer">Claims Officer</option>
                                                <option value="Authorizer">Authorizer</option>
                
                                            </select>
                                            </div>
                                        </div>

       </div>
      <div class="modal-footer">
        <button id="btnCancelUser" type="button" data-dismiss="modal" class="btn btn-large btn-danger">Cancel</button>
        <button id="btnSaveUser" type="button" onclick="saveUser()" class="btn btn-large btn-primary">Save User</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
    </div>
  </form>
<!-- End New User Form-->




<script type="text/javascript">
	
	function activate(user_id)
 	{

 		$.get('/ActivateUser',
        {
          "USER_ID": user_id                      
        },
        function(data)
        { 
        	
        	$.each(data, function (key, value) {
			  if(data["OK"])
			  {
			  	alert("User Activated!");
			  }
			  else
			  {
			  	alert("User was not activated!");
			  }
			});
                                        
        },'json');
 	}


 	function addUsers(facility_no,facility_name)
 	{
 		$("#userSpName").text(facility_name);
 		$("#userspcode").val(facility_no);
 		$("#btnSaveUser").text("Save User");

 		$("#name").val('');
        $("#email").val('');
        $("#contactno").val('');
        $("#usertype").val('');  

 	}

 	function saveUser()
 	{
 		if($("#btnSaveUser").text() == "Save User")
 		{

	 		$.get('/SaveSPUser',
	        {
	          "SPCODE": $("#userspcode").val(),
	          "NAME": $("#name").val(),
	          "EMAIL": $("#email").val(),
	          "CONTACTNO": $("#contactno").val(),
	          "USERTYPE": $("#usertype").val()                        
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) {
				  if(data["OK"])
				  {
				  	alert("User Created!");
				  	$("#btnCancelUser").click();
				  }
				  else
				  {
				  	alert("User was not created!");
				  }
				});
	                                        
	        },'json');

	    }
	    else if($("#btnSaveUser").text() == "Update User")
	    {

	    	$.get('/UpdateSPUser',
	        {
	          "USER_ID": $("#userspcode").val(),
	          "NAME": $("#name").val(),
	          "EMAIL": $("#email").val(),
	          "CONTACTNO": $("#contactno").val(),
	          "USERTYPE": $("#usertype").val()                        
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) {
				  if(data["OK"])
				  {
				  	alert("User Updated!");
				  	$("#btnCancelUser").click();
				  }
				  else
				  {
				  	alert("User was not Updated!");
				  }
				});
	                                        
	        },'json');

	    }
 	}


 	function deactivate(user_id)
 	{

 		$.get('/DeactivateUser',
        {
          "USER_ID": user_id                      
        },
        function(data)
        { 
        	
        	$.each(data, function (key, value) {
			  if(data["OK"])
			  {
			  	alert("User Deactivated!");
			  }
			  else
			  {
			  	alert("User was not deactivated!");
			  }
			});
                                        
        },'json');
 	}



 	function editUser(user_id,facility_name)
 	{
 		$("#userSpName").text(facility_name);
 		$("#btnSaveUser").text("Update User");

 		$.get('/EditSPUser',
        {
          "USER_ID": user_id                      
        },
        function(data)
        { 
        	
        	$("#userspcode").val(data['User_ID']);

          	$("#name").val(data['Name']);
            $("#email").val(data['Email']);
            $("#contactno").val(data['Contact_No']);
            $("#usertype").val(data['User_Type']);  
                                        
        },'json');
 	}

 	function resetPassword(user_id,facility_name, name)
 	{

 		if(confirm("You are about to reset the password for "+name+", please click ok to proceed."))
 		{
 			$.get('/ResetSPUserPwd',
	        {
	          "USERID": user_id                      
	        },
	        function(data)
	        { 
	        	
	        	$.each(data, function (key, value) {
				  if(data["OK"])
				  {
				  	alert("User password reset notification will be sent to "+data['Email']);
				  }
				  else
				  {
				  	alert("User password reset failed.");
				  }
				});
                                        
        },'json');
 		}

 	}


</script>

@stop
