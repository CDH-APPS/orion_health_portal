<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Mail\Mailer;
use Input;
use App\Members;
use View;
use Response;
use Session;
use DB;

class VerificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make("Verification.index")
        ->with('verificationMessage','Please provide the id number of the member');
    }


    public function profile()
    {
        $member_id = Request::get('memberid');
        return View::make("Verification.memberProfile")
        ->with('member',Members::Where('Member_Reg_No','=',$member_id));
    }

    public static function get_Image($id)
    {
        $db = mysqli_connect(env('DB_HOST', 'localhost'),env('DB_USERNAME', 'forge'),env('DB_PASSWORD', ''),env('DB_DATABASE', 'forge')); //keep your db name
        $sql = "SELECT Member_Pic FROM tbl_partial_reg WHERE Member_Reg_No = $id";
        $sth = $db->query($sql);
        $result=mysqli_fetch_array($sth);

        //return  $result['Member_Pic'];
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['Member_Pic'] ).'" width="250" />';
     
    }



    public static function get_Dependant_Image($id)
    {
        $db = mysqli_connect(env('DB_HOST', 'localhost'),env('DB_USERNAME', 'forge'),env('DB_PASSWORD', ''),env('DB_DATABASE', 'forge')); //keep your db name
        $sql = "SELECT Member_Pic FROM tbl_dependants WHERE Id = $id";
        $sth = $db->query($sql);
        $result=mysqli_fetch_array($sth);

        //return  $result['Member_Pic'];
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['Member_Pic'] ).'" width="120" hieght="70" />';
     
    }

    public static function get_Dependant_Img($id)
    {
        $db = mysqli_connect(env('DB_HOST', 'localhost'),env('DB_USERNAME', 'forge'),env('DB_PASSWORD', ''),env('DB_DATABASE', 'forge')); //keep your db name
        $sql = "SELECT Member_Pic FROM tbl_dependants WHERE Dependant_ID = $id";
        $sth = $db->query($sql);
        $result=mysqli_fetch_array($sth);

        //return  $result['Member_Pic'];
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['Member_Pic'] ).'" width="120" hieght="70" />';
     
    }

    public function check_Member_Exists($id)
    {
        if (DB::table('tbl_partial_reg')->where('Member_Reg_No',[$id])->count() > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    
    }

    public function check_Dependant_Exists($id)
    {
        if (DB::table('tbl_dependants')->where('Dependant_ID',[$id])->count() > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    
    }


    public function verify(Request $request)
    {
        
        //$member_id = (Request::has('memberid')) ? $request->input('memberid') : '';
            
        if(Input::has('memberid'))
        {
            $member_id = $request->input('memberid');

            if(Members::where('Member_Reg_No',[$member_id])->exists())
            {                
                return View::make("Verification.memberProfile")
                ->with('member',DB::table('tbl_partial_reg')->where('Member_Reg_No',$member_id)->first())
                ->with('memberpic',new VerificationsController )
                ->with('dependants',DB::table('tbl_dependants')->where('Member_ID_Primary',[$member_id])->get())
                ->with('account',DB::table('tbl_account_entries')->where('Member_ID',$member_id)->first());
            }
            else
            {                
                return View::make("Verification.index")
                ->with('verificationMessage','An invalid member id was provided, please ensure that the correct id is provided.');  
            }
        }
        else
        {  
            return View::make("Verification.index")
            ->with('verificationMessage','Please provide the Membership ID in the textbox below.'); 
        }
    }

   
}

