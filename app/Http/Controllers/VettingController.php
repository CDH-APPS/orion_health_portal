<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Spreadsheet_Excel_Reader;
use SplFixedArray;
use Response;
use Auth;
use DB;
use App\Sessions;
use App\Http\Controllers\VerificationsController;
use App\Http\Controllers\ClaimsController;
use Input;
use App\Diagnosis;
use App\Investigations;
use App\Medications;
use App\Procedures;
use App\Claims;
use App\ServiceProviders;
use App\SPUsers;
use Hash;
use notificationsController;



class VettingController extends Controller
{
     public function login()
    {
        return View::make("Vetting.login")
        ->with('verificationMessage','Please provide the id number of the member');

    }

    public function doLogin()
    {

        $no_facilities = DB::table('tbl_health_facility_info')
                        ->count();

        return View::make("Vetting.index")
        ->with('facilities',$no_facilities)
        ->with('verificationMessage','Please provide the id number of the member');

    }

    public function claimspool()
    {
        $claims = DB::table('tbl_claim_entries')
                        ->get();

        return View::make("Vetting.claimsPool")
        ->with('claims',$claims);
       
    }

    public function pendingclaims()
    {
        $claims = DB::table('tbl_claim_entries')
                        ->get();

        return View::make("Vetting.pendingClaims")
        ->with('claims',$claims);
       
    }

    private function callTotalCost($ID)
    {


              $consultation_cost = DB::table('tbl_claim_entries')
                              ->select(DB::raw('Consultation_Treatment_Charge as Cost'))
                              ->where('tbl_claim_entries.Claim_ID',[$ID])
                              ->first(); 

              $investigation_cost = DB::table('tbl_claim_investigations')
                              ->select(DB::raw('sum(Charge) as Cost'))
                              ->where('tbl_claim_investigations.Claim_ID',[$ID])
                              ->where('tbl_claim_investigations.Status',['0'])
                              ->first(); 

              $mediation_cost = DB::table('tbl_claim_medications')
                              ->select(DB::raw('sum(Charge) as Cost'))
                              ->where('tbl_claim_medications.Claim_ID',[$ID])
                              ->where('tbl_claim_medications.Status',['0'])
                              ->first();

              $procedure_cost = DB::table('tbl_claim_procedures')
                              ->select(DB::raw('sum(Charge) as Cost'))
                              ->where('tbl_claim_procedures.Claim_ID',[$ID])
                              ->where('tbl_claim_procedures.Status',['0'])
                              ->first();
            
              $total = $consultation_cost->Cost + $investigation_cost->Cost + $mediation_cost->Cost + $procedure_cost->Cost;

              
              $ini = array('ConCost' => $consultation_cost->Cost,'InvCost' => $investigation_cost->Cost, 'MedCost' => $mediation_cost->Cost, 'ProCost' => $procedure_cost->Cost, 'TotalCost' => $total);
              return  $ini;
    }

    public function vetclaim($id)
    {
        $claim = DB::table('tbl_claim_entries')
                        ->where('Claim_ID',[$id])
                        ->first();

        $member = DB::table('tbl_partial_reg')
                    ->where('Member_Reg_No',[$claim->Member_ID])
                    ->first();

       $dependant = DB::table('tbl_dependants')
                    ->where('Dependant_ID',[$claim->Member_ID])
                    ->first();

        
        $cost = $this->callTotalCost($id);

        return View::make("Vetting.vetClaim")
        ->with('claim',$claim)
        ->with('dependant',$dependant)
        ->with('cost',$cost)
        ->with('member',$member);
       
    }

    public function loadclaimspool()
    {
        $claims = DB::table('tbl_claim_entries')
                        ->where('Status',[4])
                        ->get();

         return  Response::json($claims);
       
    }

    public function loadpendingclaims()
    {
        $claims = DB::table('tbl_claim_entries')
                        ->where('Status',[5])
                        ->where('Vetted_By',[1])//Replace 1 with user id
                        ->get();

         return  Response::json($claims);
       
    }

    public function addtopending()
    {
             $claim_id = Input::get("CLAIM_ID");

             $affectedRows = Claims::where('Claim_ID', '=', $claim_id)
            ->update(array(
                           
                           'Vetted_By' => 1, //Set User 
                           'Status' => 5, 
                           'Updated_By' => 1, 
                           'Updated_At' => date('Y-m-d')));


            if($affectedRows > 0)
            {
                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
       
    }





















}
