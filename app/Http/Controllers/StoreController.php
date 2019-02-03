<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;

use OrionMedical\Models\Requisition;
use Response;
use Input;
use Cache;
use Carbon\Carbon;
use Datetime;
use Auth;
use Excel;

class StoreController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
       // $this->middleware('role:Pharmacist|System Admin|Doctor|Dentist|Specialist|Pharmacy Technician|Dental Nurse|Ophthalmologist');
       
    }



     public function index()
    {

        if(Auth::user()->getRole()=="System Admin")
        {
        
        $requisitions = Requisition::orderby('created_at','desc')->paginate(30);
        
        }

        else
        {
            $requisitions = Requisition::where('created_by',Auth::user()->getNameOrUsername())->orderby('created_at','desc')->paginate(30);

        }

        return view('stores.index',compact('requisitions'));
    }




    public function deleteRequisition()

    {

        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

            $item = Requisition::where('id', $ID)->delete();

            if($item > 0)

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
}
