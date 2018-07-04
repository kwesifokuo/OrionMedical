<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Customer;
use OrionMedical\Models\IPD;
use OrionMedical\Models\OPD;
use OrionMedical\Models\Detention;
use OrionMedical\Models\Ward;
use OrionMedical\Models\Bill;
use OrionMedical\Models\VisitType;
use OrionMedical\Models\Doctor;
use OrionMedical\Models\ServiceType;
use OrionMedical\Models\Department;
use OrionMedical\Models\ServiceCharge;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use OrionMedical\Models\AdmissionStatus;
use OrionMedical\Models\AdmissionLocation;
use DB;
use Response;
use Input;
use Carbon\Carbon;
use Auth;


class IPDController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','IPD')->get();
        $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','IPD')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();
        $patients =  Customer::where('status','Active')->orderBy('created_at', 'DESC')->paginate(30);
       return view('ipd.index', compact('patients','visittypes'))
        ->with('doctors',$doctors)
        ->with('servicetype',$servicetype)
        ->with('departments',$departments);
    }

    public function getAdmitted()
    {

        $waiting   =     OPD::where('status','Waiting to be seen')->get();
        $reviewed   =    OPD::where('status','Review')->get();
        $discharged =    OPD::where('status','Discharged')->get();
        $admission  =    OPD::where('visit_type','Admission')->get();
        $statuses   =   AdmissionStatus::get();
        $locations  =   AdmissionLocation::get();
        $doctors          = Doctor::get();

        $today =        Carbon::now()->format('Y-m-d').'%';
        $patients         = Detention::where('referal_doctor','<>','External Rx')->orderBy('created_on', 'DESC')->paginate(30);
        return view('nurse.index', compact('patients','statuses','locations','doctors'));
    }

    public function doAssignPatientToWard()
    {

      
      
           $visit_id = 'IP'.uniqid();
           $patient                    = new OPD;
           $patient->opd_number        = $visit_id;
           $patient->patient_id        = Input::get('patient_id');
           $patient->name              = Input::get('fullname');
           $patient->referal_doctor    = Input::get('referal_doctor');
           $patient->department        = "IPD";
           $patient->visit_type        = Input::get('visit_type');
           $patient->consultation_type = Input::get('consultation_type');
           $patient->bed_id            = Input::get("bed_id");
           $patient->ward_id           = Input::get("ward_id");
            $patient->payercode        = Input::get('accounttype');
           $patient->created_on        = Carbon::now();
           $patient->created_by        = Auth::user()->getNameOrUsername();
           $patient->updated_on        = Carbon::now();
           $patient->updated_by        = Auth::user()->getNameOrUsername();

             if($patient->save())
            {
              $identifier=Input::get("ward_id");

              $affectedRows= Ward::where('ward_no',$identifier)->increment('occupied_beds',1);
              Ward::where('ward_no',$identifier)->decrement('unoccupied_beds',1);

            if($affectedRows > 0)
            {
               $ward_amount=Ward::where('ward_no',Input::get("ward_id"))->pluck('cost');
               $ward_name=Ward::where('ward_no',Input::get("ward_id"))->pluck('ward_type');
           
                 $bill = new Bill;
                 $bill->patient_id  = Input::get("patient_id");
                 $bill->visit_id = $visit_id;
                 $bill->fullname = Input::get("fullname");
                 $bill->item_name =$ward_name.' ( Room '.Input::get("ward_id").' - bed '.Input::get("bed_id").')'; 
                 $bill->quantity = 1;
                 $bill->rate = $ward_amount;
                 $bill->amount = $ward_amount;
                 $bill->note = 'Unpaid';
                 $bill->created_by = Auth::user()->getNameOrUsername();
                 $bill->date = Carbon::now();
                 $bill->save(); 

                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);
            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }
        }


    }

    public function removePatientFromWard()
    {


    }

    public function getAvailableBeds()
    {
         try
        {

            $wardlist = DB::table('wards')->where('unoccupied_beds' ,'<>',0)->get();
            return  Response::json($wardlist);
            
        }

        catch (\Exception $e) 
        {
           
           echo $e->getMessage();
        
        }

    }

     public function viewIPD()
    {
      
    $ipd_id = Input::get('ipd_id');
    $user = IPD::find($ipd_id);
    $data = Array(
        'patient_id'=>$user->patient_id,
        'fullname'=>$user->name,
        'ipd_number'=>$user->ipd_number,
        'department'=>$user->department,
        'referal_doctor'=>$user->referal_doctor
        //'consultant_doctor'=>$user->consultant_doctor

        
    );
        return Response::json($data);

        
    } 



   
}
