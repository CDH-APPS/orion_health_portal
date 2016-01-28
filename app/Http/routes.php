<?php




/* Vetting Routes */

Route::get('/Vetting', array(
	'uses' => '\App\Http\Controllers\VettingController@login',
	'as' => 'Vetting',
	));

Route::get('/VettingLogin', array(
	'uses' => '\App\Http\Controllers\VettingController@doLogin',
	'as' => 'VettingLogin',
	));

Route::get('/ClaimsPool', array(
	'uses' => '\App\Http\Controllers\VettingController@claimspool',
	'as' => 'ClaimsPool',
	));

Route::get('/PendingClaims', array(
	'uses' => '\App\Http\Controllers\VettingController@pendingclaims',
	'as' => 'PendingClaims',
	));

Route::get('/LoadClaimsPool', array(
	'uses' => '\App\Http\Controllers\VettingController@loadclaimspool',
	'as' => 'LoadClaimsPool',
	));

Route::get('/AddClaimToPending', array(
	'uses' => '\App\Http\Controllers\VettingController@addtopending',
	'as' => 'AddClaimToPending',
	));


Route::get('/LoadPendingClaims', array(
	'uses' => '\App\Http\Controllers\VettingController@loadpendingclaims',
	'as' => 'LoadPendingClaims',
	));

Route::get('/VetClaim/{Id}', array(
	'uses' => '\App\Http\Controllers\VettingController@vetclaim',
	'as' => 'VetClaim',
	));

/* End Vetting */





/* Admin Routes */

Route::get('/Admin', array(
	'uses' => '\App\Http\Controllers\Admin@login',
	'as' => 'Admin',
	));

Route::get('/AdminLogin', array(
	'uses' => '\App\Http\Controllers\Admin@doLogin',
	'as' => 'AdminLogin',
	));

Route::get('/AdminUsers', array(
	'uses' => '\App\Http\Controllers\Admin@users',
	'as' => 'AdminUsers',
	));

Route::get('/SPManagement', array(
	'uses' => '\App\Http\Controllers\Admin@management',
	'as' => 'SPManagement',
	));


Route::get('/ViewSPUsers/{SPCODE}', array(
	'uses' => '\App\Http\Controllers\Admin@viewspusers',
	'as' => 'ViewSPUsers',
	));

Route::get('/ConfigSP/{SPCODE}', array(
	'uses' => '\App\Http\Controllers\Admin@configSP',
	'as' => 'ConfigSP',
	));


Route::get('/SaveSPUser', array(
	'uses' => '\App\Http\Controllers\Admin@saveSPUser',
	'as' => 'SaveUser',
	));

Route::get('/UpdateSPUser', array(
	'uses' => '\App\Http\Controllers\Admin@updateSPUser',
	'as' => 'UpdateSPUser',
	));

Route::post('/UpdateSPCred',array('as'=>'UpdateSPCred',
	'before'=>'csrf',
	'uses' => '\App\Http\Controllers\Admin@updatespcred'));


Route::post('/UpdateSPContact',array('as'=>'UpdateSPContact',
	'before'=>'csrf',
	'uses' => '\App\Http\Controllers\Admin@updatespcontact'));


Route::post('/UpdateSPInfo',array('as'=>'UpdateSPInfo',
	'before'=>'csrf',
	'uses' => '\App\Http\Controllers\Admin@updatespinfo'));


Route::post('/UploadTariff',array('as'=>'UploadTariff',
	'before'=>'csrf',
	'uses' => '\App\Http\Controllers\Admin@uploadtariff'));


Route::get('/ActivateUser', array(
	'uses' => '\App\Http\Controllers\Admin@activateuser',
	'as' => 'ActivateUser',
	));

Route::get('/DeactivateUser', array(
	'uses' => '\App\Http\Controllers\Admin@deactivateuser',
	'as' => 'DeactivateUser',
	));

Route::get('/EditSPUser', array(
	'uses' => '\App\Http\Controllers\Admin@editspuser',
	'as' => 'EditSPUser',
	));

Route::get('/ResetSPUserPwd', array(
	'uses' => '\App\Http\Controllers\Admin@resetSPUserPassword',
	'as' => 'ResetSPUserPwd',
	));



/* End Admin Routes */





Route::get('/', array(
	'uses' => '\App\Http\Controllers\AuthController@login',
	'as' => '/',
	));

Route::post('/',array('as'=>'/',
	'before'=>'csrf',
	'uses'=>'\App\Http\Controllers\AuthController@authenticate'));

Route::get('/Home', array(
	'uses' => '\App\Http\Controllers\AuthController@home',
	'as' => '/Home',
	));


/* Claim Routes */

	Route::get('/CreateNewClaim', array(
	'uses' => '\App\Http\Controllers\VerificationsController@index',
	'as' => 'CreateNewClaim',
	));

	Route::post('/CreateSession',array('as'=>'CreateSession',
	'before'=>'csrf',
	'uses' => '\App\Http\Controllers\SessionsController@createSession'));

	Route::get('/Claim/{Id}', array(
	'uses' => '\App\Http\Controllers\ClaimsController@claim',
	'as' => 'Claim',
	));

	Route::post('/VerifyMember',array('as'=>'VerifyMember',
	'before'=>'csrf',
	'uses'=>'\App\Http\Controllers\VerificationsController@verify'));


	Route::get('/MemberProfile', array(
	'uses' => '\App\Http\Controllers\VerificationsController@profile',
	'as' => 'MemberProfile',
	));


	Route::get('/PendingSessions', array(
	'uses' => '\App\Http\Controllers\SessionsController@index',
	'as' => 'PendingSessions',
	));

	Route::get('/ReadExcel', array(
	'uses' => '\App\Http\Controllers\ClaimsController@readProviderDocument',
	'as' => 'ReadExcel',
	));


	Route::get('/PriorAuthorizations', array(
	'uses' => '\App\Http\Controllers\PriorAuthController@index',
	'as' => 'PriorAuthorizations',
	));

/* End Claim Routes */



/* Ajax Routes */
	
	Route::get('/CreateSession', '\App\Http\Controllers\SessionsController@createSession');

	//get consultations
	Route::get('/GetConsultations', '\App\Http\Controllers\ClaimsController@getConsultations');


	//load add remove diagnosis
	Route::get('/GetDiagnosis', '\App\Http\Controllers\ClaimsController@loadDiagnosis');
	Route::get('/AddDiagnosis', '\App\Http\Controllers\ClaimsController@addDiagnosis');
	Route::get('/RemoveDiagnosis', '\App\Http\Controllers\ClaimsController@removeDiagnosis');


	//load add remove investigations
	Route::get('/GetInvestigations', '\App\Http\Controllers\ClaimsController@loadInvestigations');
	Route::get('/AddInvestigation', '\App\Http\Controllers\ClaimsController@addInvestigation');
	Route::get('/RemoveInvestigation', '\App\Http\Controllers\ClaimsController@removeInvestigation');


	//load add remove medications
	Route::get('/GetMedications', '\App\Http\Controllers\ClaimsController@loadMedications');
	Route::get('/AddMedication', '\App\Http\Controllers\ClaimsController@addMedication');
	Route::get('/RemoveMedication', '\App\Http\Controllers\ClaimsController@removeMedication');

	//load add remove procedures
	Route::get('/GetProcedures', '\App\Http\Controllers\ClaimsController@loadProcedures');
	Route::get('/AddProcedure', '\App\Http\Controllers\ClaimsController@addProcedure');
	Route::get('/RemoveProcedure', '\App\Http\Controllers\ClaimsController@removeProcedure');

	//Get total cost
	Route::get('/GetTotalCost', '\App\Http\Controllers\ClaimsController@getClaimTotalCost');

	//Save Consultation and Level of Care
	Route::get('/SaveConsultation', '\App\Http\Controllers\ClaimsController@saveConsultation');
	Route::get('/SaveLevelOfCare', '\App\Http\Controllers\ClaimsController@saveLevelOfCare');

	//Forward Claim
	Route::get('/ForwardClaim', '\App\Http\Controllers\ClaimsController@forwardClaim');
	
	//Cancel Claim
	Route::get('/CancelClaim', '\App\Http\Controllers\ClaimsController@cancelClaim');

	


/* End Ajax Routes */
