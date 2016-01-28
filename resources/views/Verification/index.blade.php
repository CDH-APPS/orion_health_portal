@extends('main2')

@section('content')




<div class="module">
							<div class="module-head" >
								<h3>Create New Claim [Step 1]</h3>
							</div>
							<div class="module-body" align="center">
									 <h2>Membership Verification</h2>
									 
									 	<p>
										
										Please provide the Member's ID in the textbox below. You can find the id on the <code>membership card</code>.
									
										<hr />
										
										
									
										<form class="form-horizontal row-fluid" method="post" action="/VerifyMember" >
											<div class="control-group">
												<!-- <label class="control-label" for="basicinput">Member ID : </label> -->
												<!-- <div class="controls"> -->
													<input style="font-size:20px; padding:30px;" type="text" name="memberid" id="memberid" placeholder="Type member's id here..." class="span8">	
												<!-- </div> -->
											</div>

											<div class="control-group">
											
													<button type="submit" class="btn btn-large btn-danger">Verify Member</button>
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
											
											</div>
											<p></p>

										</form>
									</p>
							</div>
</div>


@stop