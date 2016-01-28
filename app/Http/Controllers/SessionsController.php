<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Response;
use Validator;
use Input;
use DB;
use App\Sessions;
use App\Claims;
use Auth;



class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $spCode = $_COOKIE['SPCode'];
        $ini_sessions = DB::table('tbl_sessions')
                        ->where('tbl_sessions.Status',['Pending'])
                        ->where('tbl_sessions.Terminal_ID',[$spCode])
                        ->get();


        return View::make("Claims.sessions")
        ->with('success_message','Please provide the id number of the member')
        ->with('sessions',$ini_sessions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    private function getClaimID($iniDate)
    {
        $spCode = $_COOKIE['SPCode'];
        $iniDate = date_create($iniDate);
        $period = date_format($iniDate,'Ym');
        $ref = date_format($iniDate,'M Y');

        $code = DB::table('tbl_claim_entries')
                        ->where('Ref','=',$ref)
                        ->count();

        $code = str_pad($code, 4, '0', STR_PAD_LEFT);
                        
        return $spCode.$period.$code;

        
    }

    public function createSession(Request $request)
    {
            $spCode = $_COOKIE['SPCode'];
           
            $rules = array(
                        'Account_No' => 'required',
                        'Member_Id' => 'required',
                        'Visit_Date' => 'required',
                        'Service_Type' => 'required',
                        'Member_Type' => 'required',
                        'Member_Name' => 'required'
                        );

             $validation = Validator::make(Input::all(),$rules);

            if($validation->fails())
            {
                $data   = array('Response' => $validation->errors()->first());
                return  Response::json($data);
            }
            else
            {
               $iniClaimID  = $this->getClaimID(Input::get('Visit_Date'));
               $iniDate     = date_create(Input::get('Visit_Date'));
               $ref         = date_format($iniDate,'M Y');
               try
               {
               $session = new Sessions;
               $session->Date_Created = date('Y-m-d');
               $session->Expiry_Date = date('Y-m-d', time() + (21 * 24 * 60 * 60));
               $session->Account_No = Input::get('Account_No');
               $session->Member_ID = Input::get('Member_Id');
               $session->Member_Type = Input::get('Member_Type');
               $session->Dependant_Code = Input::get('Member_Id');
               $session->Name_Of_Member = Input::get('Member_Name');
               $session->Terminal_ID = $spCode;
               $session->Service_Type = Input::get('Service_Type');
               $session->Hosp_Folder_No = Input::get('Folder_Number');
               $session->Status = 'Pending';
               //$session->Out_Patient_Limit = Input::get('Account_No');
               //$session->In_Patient_Limit = Input::get('Account_No');
               //$session->Optical_Limit = Input::get('Account_No');
               //$session->Dental_Limit = Input::get('Account_No');
               $session->Claim_No = $iniClaimID;
               //$session->Created_By = Auth::user()->get_user_id();
               if($session->save())
               {
                    //Create Claim
                    $claim = new Claims;
                    $claim->Claim_ID = $iniClaimID;
                    $claim->SP_Code = $_COOKIE['SPCode'];
                    $claim->Service_Provider = $_COOKIE['SPName'];
                    $claim->Account_No = Input::get('Account_No');
                    $claim->Member_ID = Input::get('Member_Id');
                    $claim->Dependant_ID = Input::get('Member_Id');
                    $claim->Member_Level = Input::get('Member_Type');
                    $claim->Date_Filed = Input::get('Visit_Date');
                    //$claim->SP_User_ID = Auth::user()->get_user_id();
                    $claim->Type_of_Service = Input::get('Service_Type');
                    $claim->Ref = $ref;
                    $claim->Status = 1;
                    //$claim->Terminal = Auth::user()->get_user_id();
                    //$claim->Created_By = Auth::user()->get_user_id();
                    if($claim->save())
                    {
                        $data = array('OK' => 'OK','Claim_No' => $iniClaimID, 'Account_No' => Input::get('Account_No'));
                        return  Response::json($data);
                    }
                    else
                    {   
                        $data = array('Response' => 'Claim could not be created.');
                        return  Response::json($data);
                    }
               }

                }
                catch(Exception $e){
                
                   $data = array('Response' => $e->getMessage());
                   return  Response::json($data);
                }



               
            }
    }


}
