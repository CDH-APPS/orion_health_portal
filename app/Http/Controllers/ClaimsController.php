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



class ClaimsController extends Controller
{
   
   
    public function claim($Id)
    {

          $claim = DB::table('tbl_sessions')
                ->where('Claim_No',$Id)
                ->first();

          $veri = new VerificationsController;

          if($claim->Member_Type == "Account Holder")
          {
              if($veri->check_Member_Exists($claim->Member_ID))
              {
                return View::make("Claims.claim")
                ->with('member',DB::table('tbl_partial_reg')->where('Member_Reg_No',$claim->Member_ID)->first())
                ->with('memberpic',new VerificationsController)
                ->with('claim',DB::table('tbl_sessions')->where('Claim_No',$Id)->first())
                ->with('iniclaim',DB::table('tbl_claim_entries')->where('Claim_ID',$Id)->first())
                ->with('iniaccount',DB::table('tbl_account_entries')->where('Account_No',$claim->Account_No)->first())
                ->with('iniDiagnosis', $this->getDiagnosis())
                ->with('iniInvestigations', $this->getInvestigations())
                ->with('iniMedications', $this->getMedications())
                ->with('iniProcedures',$this->getProcedures())
                ->with('iniconsultations',$this->getConsultations());
       
              }
              else
              {
                dd("Sorry, details of member could not be verified.");
              }
          }
          elseif($claim->Member_Type == "Dependant")
          {
              if($veri->check_Dependant_Exists($claim->Dependant_Code))
              {
                return View::make("Claims.claim")
                ->with('dependant',DB::table('tbl_dependants')->where('Dependant_ID',$claim->Member_ID)->first())
                ->with('memberpic',new VerificationsController)
                ->with('claim',DB::table('tbl_sessions')->where('Claim_No',$Id)->first())
                ->with('iniclaim',DB::table('tbl_claim_entries')->where('Claim_ID',$Id)->first())
                ->with('iniaccount',DB::table('tbl_account_entries')->where('Account_No',$claim->Account_No)->first())
                ->with('iniDiagnosis', $this->getDiagnosis())
                ->with('iniInvestigations', $this->getInvestigations())
                ->with('iniMedications', $this->getMedications())
                ->with('iniProcedures',$this->getProcedures())
                ->with('iniconsultations',$this->getConsultations());
              }
              else
              {
                dd("Sorry, details of member could not be verified.");
              } 

          }


         return View::make("Claims.claim")
         ->with('success_message','Please provide the id number of the member');
    }

    

   public function getConsultations()
   {
        if($_COOKIE['SPCode'])
        {
            require_once 'helpers/excel_reader2.php';
            $data = new Spreadsheet_Excel_Reader("docs/".$_COOKIE['SPCode'].".xls",true);
            $ini = $this-> getExcelArray($data,'CONSULTATION',1);
           
            return  $ini;
        }
        else
        {
            $res   = array('No Data'=>'No Data');
            return  Response::json($res);
        }
   }


   //DIAGNOSIS FUNCTIONS

   public function getDiagnosis()
   {
        if($_COOKIE['SPCode'])
        {
            $ini = DB::table('ICD_10')
                        ->get();
            return  $ini;
        }
        else
        {
            $res   = array('No Data');
            return  $res;
        }

   }

   public function loadDiagnosis()
   {
        if(Input::get("CLAIM_ID"))
        {
            $claim_id = Input::get("CLAIM_ID");
            $ini = DB::table('tbl_claim_diagnosis')
                        ->where('tbl_claim_diagnosis.Claim_ID','=',$claim_id)
                        ->get();
          
            return  Response::json($ini);
        }
        else
        {
            $ini   = array('No Data'=>'No Data');
            return  Response::json($ini);
        }

   }

   public function addDiagnosis()
   {
        if(Input::get("CLAIM_ID"))
        {
            $claim_id = Input::get("CLAIM_ID");
            $ini_diagnosis = Input::get("DIAGNOSIS");
            $member_id = Input::get("MEMBER_ID");

           

            $diagnosis = new Diagnosis;   
            $diagnosis->Claim_ID = $claim_id;
            $diagnosis->SP_Code = $_COOKIE['SPCode'];
            $diagnosis->Member_ID = $member_id;
            $diagnosis->Diagnosis = $ini_diagnosis;
            $diagnosis->Status = 1;
            $diagnosis->Date_Issued = date("Y-m-d");
            $diagnosis->Date_Recorded = date("Y-m-d");
            //$diagnosis->Created_By = ;
            
            if($diagnosis->save())
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }

   public function removeDiagnosis()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

            $affectedRows = Diagnosis::where('Id', '=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }


   //END DIAGNOSIS FUNCTIONS


   //INVESTIGATIONS FUNCTIONS

   public function getInvestigations()
   {
        if($_COOKIE['SPCode'])
        {
            require_once 'helpers/excel_reader2.php';
            $data = new Spreadsheet_Excel_Reader("docs/".$_COOKIE['SPCode'].".xls",true);
            $ini = $this-> getExcelArray($data,'INVESTIGATION',1);
           
            return  $ini;
        }
        else
        {
            $res   = array('No Data');
            return  $res;
        }

   }

   public function loadInvestigations()
   {
        if(Input::get("CLAIM_ID"))
        {
            $claim_id = Input::get("CLAIM_ID");
            $ini = DB::table('tbl_claim_investigations')
                        ->where('tbl_claim_investigations.Claim_ID',[$claim_id])
                        ->get();

            return  Response::json($ini);
        }
        else
        {
            $res   = array('No Data');
            return  Response::json($ini);
        }

   }


   public function addInvestigation()
   {
        if(Input::get("CLAIM_ID"))
        {
            $claim_id = Input::get("CLAIM_ID");
            $ini_investigation = Input::get("INVESTIGATION");
            $ini_cost = Input::get("COST");
            $member_id = Input::get("MEMBER_ID");

           

            $investigation = new Investigations;   
            $investigation->Claim_ID = $claim_id;
            $investigation->SP_Code = $_COOKIE['SPCode'];
            $investigation->Member_ID = $member_id;
            $investigation->investigation = $ini_investigation;
            $investigation->Charge = $ini_cost;
            $investigation->Status = 1;
            $investigation->Date_Issued = date("Y-m-d");
            $investigation->Date_Recorded = date("Y-m-d");
            //$diagnosis->Created_By = ;
            
            if($investigation->save())
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
        else
        {
           $ini = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }


   public function removeInvestigation()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

            $affectedRows = Investigations::where('Id', '=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }


   //END INVESTIGATIONS FUNCTIONS



   //MEDICATIONS FUNCTIONS

   public function getMedications()
   {
        if($_COOKIE['SPCode'])
        {
            require_once 'helpers/excel_reader2.php';
            $data = new Spreadsheet_Excel_Reader("docs/".$_COOKIE['SPCode'].".xls",true);
            $ini = $this-> getExcelArray($data,'MEDICATION',1);
           
            return  $ini;
        }
        else
        {
            $res   = array('DESCRIPTION' => 'No Data');
            return  $res;
        }

   }


   public function loadMedications()
   {
        if(Input::get("CLAIM_ID"))
        {
            $claim_id = Input::get("CLAIM_ID");
            $ini = DB::table('tbl_claim_medications')
                        ->where('tbl_claim_medications.Claim_ID',[$claim_id])
                        ->get();

            return  Response::json($ini);
        }
        else
        {
            $ini   = array('No Data');
            return  Response::json($ini);
        }

   }

   public function addMedication()
   {
        if(Input::get("CLAIM_ID"))
        {
            $claim_id = Input::get("CLAIM_ID");
            $ini_medication = Input::get("MEDICATION");
            $ini_cost = Input::get("COST");
            $ini_quantity = Input::get("QUANTITY");
            $member_id = Input::get("MEMBER_ID");

           

            $medication = new Medications;   
            $medication->Claim_ID = $claim_id;
            $medication->SP_Code = $_COOKIE['SPCode'];
            $medication->Member_ID = $member_id;
            $medication->Medication = $ini_medication;
            $medication->Quantity = $ini_quantity;
            $medication->Unit_Price = $ini_cost;
            $medication->Charge = ($ini_cost * $ini_quantity);
            $medication->Status = 1;
            $medication->Date_Issued = date("Y-m-d");
            $medication->Date_Recorded = date("Y-m-d");
            //$diagnosis->Created_By = ;
            
            if($medication->save())
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
        else
        {
           $ini = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }

   public function removeMedication()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

            $affectedRows = Medications::where('Id', '=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }


   //END MEDICATION FUNCTIONS



   //PROCEDURES FUNCTIONS

   public function getProcedures()
   {
        if($_COOKIE['SPCode'])
        {
            require_once 'helpers/excel_reader2.php';
            $data = new Spreadsheet_Excel_Reader("docs/".$_COOKIE['SPCode'].".xls",true);
            $ini = $this-> getExcelArray($data,'PROCEDURES',1);
           
            return  $ini;
        }
        else
        {
            $res   = array('No Data');
            return  $res;
        }

   }

   public function loadProcedures()
   {
        if(Input::get("CLAIM_ID"))
        {
            $claim_id = Input::get("CLAIM_ID"); 
            $ini = DB::table('tbl_claim_procedures')
                        ->where('tbl_claim_procedures.Claim_ID',[$claim_id])
                        ->get();

            return  Response::json($ini);
        }
        else
        {
            $ini   = array('No Data');
            return  Response::json($ini);
        }

   }

   public function addProcedure()
   {
        if(Input::get("CLAIM_ID"))
        {
            $claim_id = Input::get("CLAIM_ID");
            $ini_procedure = Input::get("PROCEDURE");
            $ini_cost = Input::get("COST");
            $ini_quantity = Input::get("QUANTITY");
            $member_id = Input::get("MEMBER_ID");


          
           

            $procedure = new Procedures;   
            $procedure->Claim_ID = $claim_id;
            $procedure->SP_Code = $_COOKIE['SPCode'];
            $procedure->Member_ID = $member_id;
            $procedure->Treatment = $ini_procedure;
            $procedure->Quantity = $ini_quantity;
            $procedure->Unit_Price = $ini_cost;
            $procedure->Charge = ($ini_cost * $ini_quantity);
            $procedure->Date_Issued = date("Y-m-d");
            $procedure->Date_Recorded = date("Y-m-d");
            $procedure->Status = 1;
            //$diagnosis->Created_By = ;
            
            if($procedure->save())
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
       else
       {
           $ini = array('No Data'=>'No Data');
           return  Response::json($ini);
       }

   }

   public function removeProcedure()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

            $affectedRows = Procedures::where('Id','=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }


// END PROCEDURE FUNCTIONS



//SAVE CONSULTATION 

public function saveConsultation()
{

      $ID = Input::get("CLAIM_ID");
      $Consulation = Input::get("CONSULTATION");
      $Cost = Input::get("COST");

      $affectedRows = Claims::where('Claim_ID', '=', $ID)
                ->update(array('Consultation_Type' => $Consulation,
                               'Consultation_Treatment_Charge' => $Cost, 
                               'Updated_By' => 1, 
                               'Updated_At' => date('Y-m-d')));

      if($affectedRows > 0)
      {
          $ini   = array('OK'=>'OK');
          return  Response::json($ini);
      }
      else
      {
          $ini   = array('No Data'=>$ID);
          return  Response::json($ini);
      }

}


public function saveLevelOfCare()
{

      $ID = Input::get("CLAIM_ID");
      $Level_of_Care = Input::get("LEVELOFCARE");


      $affectedRows = Claims::where('Claim_ID', '=', $ID)
                ->update(array('Level_of_Care' => $Level_of_Care,
                               'Updated_By' => 1, 
                               'Updated_At' => date('Y-m-d')));

      if($affectedRows > 0)
      {
          $ini   = array('OK'=>'OK');
          return  Response::json($ini);
      }
      else
      {
          $ini   = array('No Data'=>$ID);
          return  Response::json($ini);
      }

}



public function forwardClaim()
{

      $ID = Input::get("CLAIM_ID");


      $affectedRows = Claims::where('Claim_ID', '=', $ID)
                ->update(array('Status' => 3,
                               'Updated_By' => 1, 
                               'Updated_At' => date('Y-m-d')));

      if($affectedRows > 0)
      {
                $affectedRows1 = Sessions::where('Claim_No', '=', $ID)
                ->update(array('Status' => 'Forwarded',
                               'Updated_By' => 1, 
                               'Updated_At' => date('Y-m-d')));

                      if($affectedRows1 > 0)
                      {
                        $ini   = array('OK'=>'OK');
                        return  Response::json($ini);
                      }  
      }
      else
      {
          $ini   = array('No Data'=>$ID);
          return  Response::json($ini);
      }

}

public function cancelClaim()
{

      $ID = Input::get("CLAIM_ID");


      $affectedRows = Claims::where('Claim_ID', '=', $ID)
                ->update(array('Status' => 2,
                               'Updated_By' => 1, 
                               'Updated_At' => date('Y-m-d')));

      if($affectedRows > 0)
      {
                $affectedRows1 = Sessions::where('Claim_No', '=', $ID)
                ->update(array('Status' => 'Canceled',
                               'Updated_By' => 1, 
                               'Updated_At' => date('Y-m-d')));

                      if($affectedRows1 > 0)
                      {
                        $ini   = array('OK'=>'OK');
                        return  Response::json($ini);
                      }  
                      else
                      {
                          $ini   = array('No Data'=>$ID);
                          return  Response::json($ini);
                      }
      }
      else
      {
          $ini   = array('No Data'=>$ID);
          return  Response::json($ini);
      }

}

public function getClaimTotalCost()
{

        if(Input::get("CLAIM_ID"))
        {

              $ID = Input::get("CLAIM_ID");


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
              return  Response::json($ini);
              

        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

}





   function getExcelArray(Spreadsheet_Excel_Reader $reader, $iniSheet, $startRow = 1)
   {

        $cols = array();
        $data = array();
        $count = 1;


        // We don't have an instance with data
        $sheetIndex = $reader->getSheetIndex($iniSheet);
      
        if(!isset($reader->sheets[$sheetIndex]['cells']) )
                return $data;
        foreach($reader->sheets[$sheetIndex]['cells'] as $row)
        {
                if($count == $startRow)
                        $cols = $row;
                //elseif(count($cols) && count($cols) == count($row))
                    //$data[] = array_combine($cols,$row);
                else
                    $data[] = array_combine(array_intersect_key($cols,$row),array_intersect_key($row,$cols));
        
                ++$count;                       
        }
        
        return $data;   
   }

       
}
