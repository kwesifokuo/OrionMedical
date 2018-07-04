<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use JasperPHP\JasperPHP;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;

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
        return view('reporting.patient.patient');
    }


 public function patientvisits()
    {
        return view('reporting.patient.patient_visits');
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
