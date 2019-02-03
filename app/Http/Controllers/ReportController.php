<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use JasperPHP\JasperPHP;

use OrionMedical\Models\OPD;
use OrionMedical\Models\Customer;

use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Carbon\Carbon;


class ReportController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function medicalreports()
    {
        return view('reporting.index');
    }

     public function patientlist()
    {
        $providers = OPD::groupBy('care_provider')->distinct()->get();
        return view('reporting.patient.patient_form',compact('providers'));
    }

    public function rptPatientList(Request $request)
   {


        $from    =  Carbon::createFromFormat('d/m/Y', $request->input('datefrom'))->format('Y-m-d');
        $to      =  Carbon::createFromFormat('d/m/Y', $request->input('dateto'))->format('Y-m-d');

        $datefrom = $from;
        $dateto   = $to;

        $customerlists = Customer::whereBetween('created_at',array($from." 00:00:00",$to." 23:59:59"))->orderBy('created_at','desc')->get();
      //dd($bills);
    return view('reporting.patient.patient_report', compact('customerlists','datefrom','dateto'));

    }


    public function formPatientVisit()
    {
       $providers = OPD::groupBy('care_provider')->distinct()->get();
        return view('reporting.patient.patient_visit_form',compact('providers'));

    }


 public function rptPatientVisit(Request $request)
    {
       $from    =  Carbon::createFromFormat('d/m/Y', $request->input('datefrom'))->format('Y-m-d');
        $to      =  Carbon::createFromFormat('d/m/Y', $request->input('dateto'))->format('Y-m-d');

        $provider =  $request->input('care_provider');
        $datefrom = $from;
        $dateto   = $to;

        if($provider=="All")
        {
           $patients = OPD::whereBetween('created_on',array($from." 00:00:00",$to." 23:59:59"))->orderBy('created_on','desc')->get();
        }
        else
        {
          $patients = OPD::where('care_provider',$provider)->whereBetween('created_on',array($from." 00:00:00",$to." 23:59:59"))->orderBy('created_on','desc')->get(); 
        }
       
        return view('reporting.patient.patient_visit_report',compact('patients','datefrom','dateto'));
    }

 




     public function summaryConsultation()
    {
        return view('reporting.billing.summary_consultation');
    }


      public function locumsheet()
    {
        return view('reporting.billing.locum');
    }



     public function summarydepartment()
    {
        return view('reporting.billing.summary_department');
    }


     public function summarydepartmentall()
    {
        return view('reporting.billing.summary_department_all');
    }


     public function summarydepartmentcount()
    {
        return view('reporting.billing.summary_department_count');
    }

     public function summarydoctors()
    {
        return view('reporting.billing.summary_doctors');
    }

     public function summarypharmacy()
    {
        return view('reporting.billing.summary_pharmacy');
    }
 
      public function billlisting()
    {
        return view('reporting.billing.bill_listing');
    }

     public function collectionsummary()
    {
        return view('reporting.billing.collection_summary');
    }
 



  public function patientdoctorratio()
    {
        return view('reporting.medical.patienttodoctor');
    }

     public function vitaltemperature()
    {
        return view('reporting.medical.temp');
    }

     public function vitalbloodpressure()
    {
        return view('reporting.medical.bp');
    }
 
      public function vitalbmi()
    {
        return view('reporting.medical.bmi');
    }

     public function morbidityassessment()
    {
        return view('reporting.medical.morbidity');
    }

   
 

 
 
    
}
