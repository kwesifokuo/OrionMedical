<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Pacs;
use OrionMedical\Models\ImagingRequest;
use OrionMedical\Models\Images;
use OrionMedical\Models\Company;
use OrionMedical\Models\Bill;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use OrionMedical\Models\Doctor;
use OrionMedical\Models\OPD;
use OrionMedical\Models\Customer;
use OrionMedical\Models\PatientVitals;
use OrionMedical\Models\PatientInvestigation;
use Input;
use Response;
use Activity;
use Auth;
use OrionMedical\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Image;
use Carbon\Carbon;
use Cache;

class PacsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Company::get()->first();
        $doctors         = Doctor::get();
        $patients        = Customer::where('status','Active')->get();
        $imaging         = Pacs::orderby('type','asc')->get();
        $today =        Carbon::now()->format('Y-m-d').'%';
        $imagerequests   = PatientInvestigation::where('type','Radiology')->where('investigation','not like','%XRAY%')->orderby('created_on','desc')->paginate(25);
        return view('pacs.index',compact('imaging','doctors','patients','imagerequests','company'));
    }



    public function gallery($id)
    {    
        $visitdetails     =    OPD::where('opd_number' ,'=', $id)->first();
        $images           =    Images::where('accountnumber' ,'=', $visitdetails->patient_id)->where('source','Radiology')->get();
        $patients         =    Customer::where('patient_id' ,'=', $visitdetails->patient_id)->first();
         $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();
         $tests         = PatientInvestigation::where('type','Radiology')->where('visitid' ,'=', $id)->get();

        return view('pacs.gallery',compact('patients','visitdetails','images','myvitals','tests'));
    }

    public function getImagingRequest(Request $request)
  {

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = PatientInvestigation::where('visitid','=',$opd_number)->get();
            return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


  public function imagerequestslip($id)
    {
       $company = Company::get()->first();


        $patientid = PatientInvestigation::where('id',$id)->first();

        if($patientid->type=='Dental-Radiology')
        {
          $patients = Customer::where('patient_id',$patientid->patientid)->first();
          $imagerequest = PatientInvestigation::where('visitid',$patientid->visitid)->get();
        }

        else

        {

          //dd('fails'.$patientid->type);
          $patients = Customer::where('patient_id',$patientid->patientid)->first();
          $imagerequest = PatientInvestigation::where('id',$id)->get();
        }

        

        //dd($patients);
        return view('pacs.slip',compact('patients','imagerequest','company'));
    }


    public function findImageRequest(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

            $search  = $request->get('search');
         $company = Company::get()->first();
        $doctors         = Doctor::get();
        $patients        = Customer::where('status','Active')->get();
        $imaging         = Pacs::orderby('type','asc')->get();
       

        $imagerequests = PatientInvestigation::where('patient_name','like', "%$search%")->where('type','Radiology')->where('investigation','not like','%XRAY%')->orderby('created_on','desc')
            ->paginate(30)
            ->appends(['search' => $search])
        ;
      return view('pacs.index',compact('imaging','doctors','patients','imagerequests','company'));
    
    }


    public function addImagesRequest()
    {     
           $scancharge = Pacs::where('type',Input::get("scan_type"))->pluck('charge');

           $imagerequest                  = new ImagingRequest;
           $imagerequest->doctor          = Input::get("scan_doctor");
           $imagerequest->patient_id      = Input::get("scan_patient");
           $imagerequest->visit_id        = Input::get("opd_number");
           $imagerequest->type            = Input::get("scan_type");
           $imagerequest->cost            = $scancharge;
           $imagerequest->status          = 'Pending';
           $imagerequest->created_on      = Carbon::now();
           $imagerequest->created_by      = Auth::user()->getNameOrUsername();


            

            if($imagerequest->save())
            {

             

           $bill                    = new Bill;
           $bill->patient_id        = Input::get("patient_id");
           $bill->visit_id          = Input::get("opd_number");
           $bill->fullname          = Input::get("fullname");
           $bill->item_name         = Input::get("scan_type");
           $bill->quantity          = 1;
           $bill->rate              = $scancharge;
           $bill->amount            = $scancharge;
           $bill->note              = 'Unpaid';
           $bill->created_by        = Auth::user()->getNameOrUsername();
           $bill->date              = Carbon::now();
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

     public function deleteImage()
    {
            if(Input::get("ID"))
            {
                    $ID = Input::get("ID");
                    $affectedRows = Images::where('id', '=', $ID)->delete();

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
}


