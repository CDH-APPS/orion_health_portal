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

require('notificationsController.php');

class Admin extends Controller
{
   
    public function login()
    {
        return View::make("Admin.login")
        ->with('verificationMessage','Please provide the id number of the member');

    }

    public function doLogin()
    {

        $no_facilities = DB::table('tbl_health_facility_info')
                        ->count();

        return View::make("Admin.index")
        ->with('facilities',$no_facilities)
        ->with('verificationMessage','Please provide the id number of the member');

    }

    public function users()
    {
        return View::make("Admin.users")
        ->with('verificationMessage','Please provide the id number of the member');

    }


    public function management()
    {
         $sps = DB::table('tbl_health_facility_info')
                        ->get();

        return View::make("Admin.manage")
        ->with('sps',$sps);

    }

     public function configSP($id)
    {
         $sps = DB::table('tbl_health_facility_info')
                        ->where('tbl_health_facility_info.Facility_Reg_No',[$id])
                        ->get();

         $get_types = DB::table('tbl_health_facility_type')
                        ->get();

        return View::make("Admin.configSP")
        ->with('sps',$sps)
        ->with('types',$get_types);

    }


    public function resetSPUserPassword()
    {
            $userid = Input::get("USERID");

            $hash_pwd = md5(date("Ydmshss"));
            $password = substr($hash_pwd,0,10);
            $ini_password = Hash::make($password);


            $ini = DB::table('tbl_sp_users')
                        ->where('tbl_sp_users.Id',[$userid])
                        ->get();

            $name = $ini[0]->Name;
            $email = $ini[0]->Email;

           
            $affectedRows = SPUsers::where('Id', '=', $userid)
            ->update(array('Password' => $password,
                           'Status' => 0, 
                           'Updated_By' => 1, 
                           'Updated_At' => date('Y-m-d')));


            if($affectedRows > 0)
            {
                $not = new notificationsController;
                $not->registerUserPasswordResetEmail(["Name"=>$name,"Email"=>$email,"Password"=>$password]);

             
                $ini = array('OK'=>'OK','Email'=>$email);
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }

    public function saveSPUser()
    {
       
            $hash_pwd = md5(Input::get("EMAIL").date("Ydmsh"));
            $ini_password = Hash::make(substr($hash_pwd,0,10));
            $sp_code = Input::get("SPCODE");
            $name = Input::get("NAME");
            $email = Input::get("EMAIL");
            $password = substr($hash_pwd,0,10);
            $contact_no = Input::get("CONTACTNO");
            $user_type = Input::get("USERTYPE");

                

            $spUsers = new SPUsers;   
            $spUsers->SP_Code = $sp_code;
            $spUsers->Email = $email;
            $spUsers->Password = $ini_password;
            $spUsers->Name = $name;
            $spUsers->Contact_No = $contact_no;
            $spUsers->User_Type = $user_type;
            $spUsers->Status = 0;
            $spUsers->Created_By = 1;

            if($spUsers->save())
            {
                $not = new notificationsController;
                $not->registerNewUserEmail(["Name"=>$name,"Email"=>$email,"Password"=>$password]);

                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }



    public function updateSPUser()
    {
            $user_id = Input::get("USER_ID");
            $name = Input::get("NAME");
            $email = Input::get("EMAIL");
            $contact_no = Input::get("CONTACTNO");
            $user_type = Input::get("USERTYPE");




            $affectedRows = SPUsers::where('Id', '=', $user_id)
            ->update(array('Name' => $name,
                           'Email' => $email,
                           'Contact_No' => $contact_no,
                           'User_Type' => $user_type,
                           'Status' => 0, 
                           'Updated_By' => 1, 
                           'Updated_At' => date('Y-m-d')));


            if($affectedRows > 0)
            {
                //SEND EMAIL 
                //SEND SMS
                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }


    public function updatespinfo()
    {
            $spcode = Input::get("USER_ID");
            $sp_name = Input::get("NAME");
            $facility_type = Input::get("EMAIL");
            $business_reg_no = Input::get("CONTACTNO");
            $date_reg = Input::get("USERTYPE");




            $affectedRows = ServiceProviders::where('Facility_Reg_No', '=', $spcode)
            ->update(array(
                           'Facility_Type' => $facility_type ,
                           'Facility_Name' => $sp_name,
                           'Facility_Bus_Reg_No' => $business_reg_no,
                           'Status' => 0, 
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



    public function updatespcred()
    {
            $user_id = Input::get("USER_ID");
            $name = Input::get("NAME");
            $email = Input::get("EMAIL");
            $contact_no = Input::get("CONTACTNO");
            $user_type = Input::get("USERTYPE");




            $affectedRows = SPUsers::where('Id', '=', $user_id)
            ->update(array('Name' => $name,
                           'Email' => $email,
                           'Contact_No' => $contact_no,
                           'User_Type' => $user_type,
                           'Status' => 0, 
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



    public function updatespcontact()
    {
            $spcode = Input::get("USER_ID");
            $mobile_no = Input::get("NAME");
            $email = Input::get("EMAIL");
            $website = Input::get("USERTYPE");
            $contact_no = Input::get("CONTACTNO");
            $postal_add = Input::get("USERTYPE");
            $residential_add = Input::get("USERTYPE");




             $affectedRows = ServiceProviders::where('Facility_Reg_No', '=', $spcode)
            ->update(array(
                           'Facility_Type' => $facility_type ,
                           'Facility_Name' => $sp_name,
                           'Facility_Bus_Reg_No' => $business_reg_no,
                           'Facility_Residential_Add' => $we,
                           'Facility_Postal_Address' => $op, 
                           'Status' => 0, 
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


    public function activateuser()
    {
       
         
            $userid = Input::get("USER_ID");

            $affectedRows = SPUsers::where('Id', '=', $userid)->update(array('Status' => 1, 'Updated_By' => 1, 'Updated_At' => date('Y-m-d')));

            if($affectedRows > 0)
            {
                //SEND EMAIL 
                //SEND SMS
                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }



    public function deactivateuser()
    {
       
         
            $userid = Input::get("USER_ID");

            $affectedRows = SPUsers::where('Id', '=', $userid)->update(array('Status' => 0, 'Updated_By' => 1, 'Updated_At' => date('Y-m-d')));

            if($affectedRows > 0)
            {
                //SEND EMAIL 
                //SEND SMS
                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }


    public function editspuser()
    {
       
         
            $userid = Input::get("USER_ID");
          

            $ini = DB::table('tbl_sp_users')
                        ->where('tbl_sp_users.Id',[$userid])
                        ->get();

            if($userid != "")
            {     
                $ini = array('OK'=>'OK','User_ID'=>$ini[0]->Id, 'Name' => $ini[0]->Name, 'Email'=>$ini[0]->Email, 'Contact_No' => $ini[0]->Contact_No, 'User_Type' => $ini[0]->User_Type);
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }


    public function viewspusers($ID)
    {

            $ini_sp_code = $ID;

            $ini = DB::table('tbl_sp_users')
                        ->where('tbl_sp_users.SP_Code',[$ini_sp_code])
                        ->get();

            $sp = DB::table('tbl_health_facility_info')
                        ->where('tbl_health_facility_info.Facility_Reg_No',[$ini_sp_code])
                        ->get();

            return View::make("Admin.spusers")
            ->with('sp_users',$ini)
            ->with('sp',$sp);  
    }


    public function uploadtariff()
    {
        $sp_code = basename($_FILES["uploadfile"]["name"]);
        $code = Input::get("uploadspcode");

        $target_dir = "docs/";
        $target_file = $target_dir.$code.".xls";
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file)) 
        {
            echo "The file ". basename( $_FILES["uploadfile"]["name"]). " has been uploaded.";
        } 
        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
   
}
