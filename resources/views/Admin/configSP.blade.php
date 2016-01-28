@extends('Admin.index')

@section('content')

	



                    <div class="content">
                        <div class="module">
                            <div class="module-body">
                                <div class="profile-head media">
                                    
                                    <div class="media-body">
                                        <h4>
                                            {{ $sps[0]->Facility_Name }}
                                        </h4> <hr>
                                    </div>

                                </div>
                                <ul class="profile-tab nav nav-tabs">
                                    <li class="active"><a href="#info" data-toggle="tab">Service Provider Info</a></li>
                                    <li><a href="#contact" data-toggle="tab">Contact Info</a></li>
                                    <li><a href="#config" data-toggle="tab">Setup Info</a></li>
                                </ul>
                                <div class="profile-tab-content tab-content">

                                <!-- SP Info -->
                                    <div class="tab-pane fade active in" id="info">
                                    
                                    	<form action="/UpdateSPInfo" method="post" class="form-horizontal row-fluid">
										<div class="control-group">
											<label class="control-label" for="basicinput">Service Provider Code :</label>
											<div class="controls">
												<input type="text" id="serviceprovidercode" placeholder="SPCode" class="span5" value="{{ $sps[0]->Facility_Reg_No }}" readonly="">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Service Provider Name :</label>
											<div class="controls">
												<input type="text" id="serviceprovidername" placeholder="" class="span8" value="{{ $sps[0]->Facility_Name }}">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Type of Facility :</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span8">
													<option value="{{ $sps[0]->Facility_Type }}">{{ $sps[0]->Facility_Type }}</option>
													@foreach($types as $type)
													<option value="{{ $type->description }}">{{ $type->description }}</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Business Reg No. :</label>
											<div class="controls">
												
													<input class="span5" type="text" value="{{ $sps[0]->Facility_Bus_Reg_No }}">       
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Date Registered :</label>
											<div class="controls">
													<input type="text"  class="span5" value="{{ $sps[0]->Facility_Date_Registered }}">			
											</div>
										</div>

										


										

										<br>
										 <div class="modal-footer">
									       
									        <button id="sendUpload" type="button" onclick="doUpload()" class="btn btn-large btn-primary">Update Changes</button>
									        <input type="hidden" name="_token" value="{{ csrf_token() }}">
									     </div>
							</form>

                           </div>
                         <!-- End SP Info -->



                         <!-- Contact Info -->
                           		<div class="tab-pane fade  in" id="contact">

                                    
                                <form action="/UpdateSPContact" method="post" class="form-horizontal row-fluid">

										<div class="control-group">
											<label class="control-label" for="basicinput">Contact No :</label>
											<div class="controls">
											<div class="input-prepend">
												<span class="add-on">Lan</span><input type="text"  class="span8" value="{{ $sps[0]->Facility_Direct_Line }}">
											</div>
											<div class="input-prepend">	
												<span class="add-on">Mob</span><input type="text"  class="span8" value="{{ $sps[0]->Facility_Mobile }}">		
											</div>	
											<div class="input-prepend">	
												<span class="add-on">Fax</span><input type="text"  class="span8" value="{{ $sps[0]->Facility_Fax }}">		
											</div>	
											</div>
											
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Email :</label>
											<div class="controls">
													<input type="text"  class="span6" value="{{ $sps[0]->Facility_Email }}">			
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Website :</label>
											<div class="controls">
													<input type="text"  class="span6" value="{{ $sps[0]->Facility_Website }}">			
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Postal Address :</label>
											<div class="controls">
													<textarea rows="3" >{{ $sps[0]->Facility_Postal_Address }}</textarea>			
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Residential Address :</label>
											<div class="controls">						
													<textarea rows="3" >{{ $sps[0]->Facility_Residential_Add }}</textarea>		
											</div>
										</div>

										<br>
										<div class="modal-footer">
									       
									        <button id="sendUpload" type="button" onclick="doUpload()" class="btn btn-large btn-primary">Update Changes</button>
									        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
									    </div>
							</form>
                           	</div>
                         <!-- End Contact Info -->		



                         <!-- Config Info -->
                           		<div class="tab-pane fade  in" id="config">

                                    
                                    	<form action="/UpdateSPCred" method="post" class="form-horizontal row-fluid">
										<div class="control-group">
											<label class="control-label" for="basicinput">SP Code :</label>
											<div class="controls">
												<input type="text" id="serviceprovidercode" value="{{ $sps[0]->Facility_Reg_No }}" readonly="" class="span5">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Admin Email :</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="" class="span5">
												<span class="help-inline" style="color:red;" >Email to recieve service provider user credentials</span>
											</div>
										</div>


										<div class="control-group">
											<label class="control-label">Stand-Alone USSD Service :</label>
											<div class="controls">

												<div class="input-prepend">	
												<span class="add-on">Fax</span><input type="text"  class="span8" value="{{ $sps[0]->Facility_Fax }}">		
												</div>	
												
											</div>
										</div>

										
										<br>
										 <div class="modal-footer">
									       
									        <button id="sendUpload" type="button" onclick="doUpload()" class="btn btn-large btn-primary">Update Changes</button>
									        <input type="hidden" name="_token" value="{{ csrf_token() }}">
									     </div>
										</form>
                           		</div>
                         <!-- End Config Info -->		


                           		</div>
                            </div>
                            <!--/.module-body-->
                        </div>
                        <!--/.module-->
                    </div>
                    <!--/.content-->
   







@stop




 




