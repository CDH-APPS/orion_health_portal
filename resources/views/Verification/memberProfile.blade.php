@extends('main')

@section('content')




<div class="module">

                            <div class="module-head">
								<h3>Membership Verification</h3>
							</div>

                <div class="btn-box-row row-fluid">

                                    <div class="span8">
                               
                                    	
                                        <div class="row-fluid">
                                           <div class="btn-box big span12" style="padding:20px;">
                                           <!-- Member Info -->

	                                           <div class="widget widget-usage unstyled span5">

                                                     {{ $memberpic->get_Image($member->Member_Reg_No) }}
                                                                     
                                               </div>

	                                           <div class=" unstyled span7">
	                                           			
			                                           <table class="table table-condensed">	
                                                            <tr><td>Account No. : <h5>{{ $account->Account_No }}</h5></td></tr>                                           		
				                                           	<tr><td>Member ID : <h5>{{ $member->Member_Reg_No }}</h5></td></tr>
				                                           	<tr><td>Name of Member : <h5><div id="holdername">{{ $member->First_Name.' '.$member->Middle_Name.' '.$member->Last_Name }}</div></h5></td></tr>
				                                           	<tr><td>Gender : <h5>{{ $member->Gender }}</h5></td></tr>
				                                           	<tr><td>Date of Birth : <h5>{{ $member->DOB }}</h5></td></tr>   	
			                                           </table>
			                                           
	                                           </div>

	                                      
	                                           <div class=" unstyled span12 pull-right">
	                                           <hr>
	                                           <span class="pull-left">Status : <code>Active</code></span>

	                                           <div id="holdersession" name="holdersession" onclick="wirteHolderID('{{ $member->Member_Reg_No }}','{{ $member->First_Name.' '.$member->Middle_Name.' '.$member->Last_Name }}')" ><a class="btn btn-large btn-success pull-right" data-toggle="modal" href="#static">Create Session</a></div>
	                                           <a  class="btn btn-large btn-danger pull-right" style="margin-right:20px;" href="/CreateNewClaim">Cancel Session</a>
	                                           </div>
												

                                               
											  
                                           <!-- End Member Info -->
                                    	   </div>
                                        </div>   






                                        <div class="row-fluid">
											
                                           <div class="btn-box big span12" style="padding:20px;">
                                           <!-- Member Info -->
												<h2 style="margin-left:15px;" class="pull-left">Dependant Info</h2>
	                                           <div class="unstyled span12">


                                               <table class="table table-condensed">

                                                    @if($dependants)
                                                        @foreach($dependants as $dependant)
                                                        <tr><td>{{ $memberpic->get_Dependant_Image($dependant->Id) }} </td><td>ID : {{ $dependant->Dependant_ID }} <br> Gender : {{ $dependant->Gender }} <br> Date of Birth : {{ $dependant->DOB }}<h4><div id="dependantname">{{ $dependant->First_Name.' '.$dependant->Middle_Names.' '.$dependant->Last_Name }}</div></h4> </td><td><div onclick="wirteDependantID('{{ $dependant->Dependant_ID }}','{{ $dependant->First_Name.' '.$dependant->Middle_Names.' '.$dependant->Last_Name }}')"><a class="btn btn-success pull-right" data-toggle="modal" href="#static">Create Session</a></div></td></tr>  
                                                        @endforeach
                                                    @else
                                                        <tr><td>No Dependants Found!</td></tr>
                                                    @endif  
                                                            
                                               </table>
			                                           
	                                           </div>

	           
                                           <!-- End Member Info -->
                                    	   </div>
                                        </div>   





                                    </div>







                                   <!-- Limit Indicators --> 
									
                                    <ul class="widget widget-usage unstyled span4">

                                        <li>
                                            <p>
                                                <strong>Out-Patient</strong> <span class="pull-right small muted">78%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar" style="width: 78%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>In-Patient</strong> <span class="pull-right small muted">56%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-success" style="width: 56%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Dental</strong> <span class="pull-right small muted">44%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-warning" style="width: 44%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Optical</strong> <span class="pull-right small muted">67%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: 67%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Specialist</strong> <span class="pull-right small muted">67%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: 67%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Maternity</strong> <span class="pull-right small muted">50%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: 50%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Scan</strong> <span class="pull-right small muted">23%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: 23%;">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- End Limit Indicators -->

                                </div>
			</div>

</div>




<!-- Create New Session Modal -->
<form class="form-horizontal row-fluid" action="/CreateSession" method="post">
    <div id="static" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
      <div class="modal-header">
        <button id="close_session" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Session Details for <span id="membertype"></span></h3>
        <span id="membername"></span>
      </div>
        <div class="modal-body">
        

        <!-- Create Session Form -->

        
                                        

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Account No. :</label>
                                            <div class="controls">
                                                <input type="text" name="accountno" id="accountno" value="{{ $account->Account_No }}"  disabled>
                                            </div>
                                        </div>

                                         <div class="control-group">
                                            <label class="control-label" for="basicinput">Member ID. :</label>
                                            <div class="controls">
                                                <input type="text" name="memberid" id="memberid" disabled>
                                            </div>
                                        </div>
                                        

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Date of Visit :</label>
                                            <div class="controls">
                                                <div class="input-prepend">
                                                    <input type="date" name="visitdate" id="visitdate" value="{{ date('Y-m-d') }}" placeholder="yyyy/mm/dd">     
                                                </div>
                                            </div>
                                        </div>

                                         <div class="control-group">
                                            <label class="control-label" for="basicinput">Hospital Folder No. :</label>
                                            <div class="controls">
                                                <div class="input-prepend">
                                                    <span class="add-on">#</span><input  name="foldernumber" id="foldernumber" type="text" placeholder="Folder Number">       
                                                </div>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label">Type of Service</label>
                                            <div class="controls">
                                            <select  name="servicetype" id="servicetype" tabindex="1" data-placeholder="Select here.." >
                                                <option value="Out-Patient">Out-Patient</option>
                                                <option value="In-Patient">In-Patient</option>
                                                <option value="Optical Service">Optical Service</option>
                                                <option value="Dental Service">Dental Service</option>
                                                <option value="Maternity">Maternity</option>
                                                <option value="Scan/Lab">Scan/Lab</option>
                                                <option value="Pharmacy">Pharmacy</option>
                                            </select>
                                            </div>
                                        </div>

                                      

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Comment :</label>
                                            <div class="controls">
                                                <textarea name="comment" id="comment" srows="3"></textarea>
                                            </div>
                                        </div>

                                        
                                  

        

       </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-large btn-danger">Cancel</button>
        <button type="button" onclick="createSession()" class="btn btn-large btn-primary">Create Session</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
    </div>
  </form>
<!-- Session End Form -->



<!-- End New Session Modal -->    
<script type="text/javascript">
 


    function wirteHolderID(member_id,name)
    {        
        memberid.value = member_id;      
        document.getElementById("membertype").innerHTML = "Account Holder";  
        document.getElementById("membername").innerHTML = name;
    }

    function wirteDependantID(member_id,name)
    {        
        memberid.value = member_id;      
        document.getElementById("membertype").innerHTML = "Dependant";  
        document.getElementById("membername").innerHTML = name;
    }

    
    function createSession()
    {                  
            
            $.get('/CreateSession',
            {
                'Account_No': $('#accountno').val(),
                'Member_Id': $('#memberid').val(),
                'Visit_Date': $('#visitdate').val(),
                'Service_Type': $('#servicetype').val(),
                'Member_Type': $("#membertype").text(),
                'Member_Name': $("#membername").text(),
                'Folder_Number': $("#foldernumber").val()  
                                               
            },
            function(data)
            { 
                if(data['Response'])
                {  
                    alert(data['Response']);
                }
                else if(data['OK'])
                {
                    alert('Session created.');
                    $("#close_session").click();
                    
                }


            },'json');                                
                                                                   
    }


</script>



                                                 

@stop

