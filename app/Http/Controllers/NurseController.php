<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Customer;
use OrionMedical\Models\OPD;
use OrionMedical\Models\DrugPeriod;
use OrionMedical\Models\Complaint;
use OrionMedical\Models\Images;
use OrionMedical\Models\ServiceCharge;
use OrionMedical\Models\DrugApplication;
use OrionMedical\Models\DrugFrequency;
use OrionMedical\Models\AdmissionStatus;
use OrionMedical\Models\AdmissionLocation;
use OrionMedical\Models\DrugDosage;
use OrionMedical\Models\Drug;
use OrionMedical\Models\Treatment;
use OrionMedical\Models\SocialFamilyHistory;
use OrionMedical\Models\PatientComplaint;
use OrionMedical\Models\ROS;
use OrionMedical\Models\PatientPE;
use OrionMedical\Models\PatientInvestigation;      
use OrionMedical\Models\PatientAssessment;
use OrionMedical\Models\Bill;
use OrionMedical\Models\Payments;
use OrionMedical\Models\PatientDiagnosis;
use OrionMedical\Models\PatientHistory;
use OrionMedical\Models\Diagnosis;
use OrionMedical\Models\Doctor;
use OrionMedical\Models\Prescription;
use OrionMedical\Models\PatientVitals;
use OrionMedical\Models\PatientTreatmentSheet;

use OrionMedical\Models\NursePlan;
use OrionMedical\Models\NurseNote;

use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use OrionMedical\Models\LabDocs;
use DateTime;
use Input;
use Carbon\Carbon;
use DB;
use Auth;
use Response;


class NurseController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');

         $this->middleware('role:System Admin|Nurse|Dental Nurse|Nurse Assistant|Special Admin');
        
    }

    
    public function index()
    { 
         $waiting   =    OPD::where('status','Waiting to be seen')->get();
        $reviewed   =    OPD::where('status','Review')->get();
        $discharged =    OPD::where('status','Discharged')->get();
        $admission  =    OPD::where('visit_type','Admission')->get();
        $statuses   =   AdmissionStatus::get();
        $locations  =   AdmissionLocation::get();
        $doctors          = Doctor::get();

        $today =        Carbon::now()->format('Y-m-d').'%';
        $patients         = OPD::where('created_on', 'like', $today)->where('referal_doctor','<>','External Rx')->orderBy('created_on', 'DESC')->paginate(30);
        return view('nurse.index', compact('patients','statuses','locations','doctors'));
       
    }

     public function nurseIPD()
    { 
         $waiting   =    OPD::where('status','Waiting to be seen')->get();
        $reviewed   =    OPD::where('status','Review')->get();
        $discharged =    OPD::where('status','Discharged')->get();
        $admission  =    OPD::where('visit_type','Admission')->get();
        $statuses   =   AdmissionStatus::get();
        $locations  =   AdmissionLocation::get();
        $doctors          = Doctor::get();

        $today =        Carbon::now()->format('Y-m-d').'%';
        $patients   = OPD::where('ward_admission_type','Admission')->orderBy('created_on', 'DESC')->paginate(30);
       
        return view('nurse.ipd', compact('patients','statuses','locations','doctors'));
       
    }

    public function nursereview($id)
    {

        $visit_details    = OPD::where('opd_number' ,'=', $id)->first();
        $patients         = Customer::where('patient_id' ,'=', $visit_details->patient_id)->get();
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::where('accountnumber' ,'=', $visit_details->patient_id)->get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Prescription::where('visitid', $id)->get();
        $availabledrugs   = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','Nursing Procedure')->orwhere('department','Consumables')->orwhere('department','Procedures')->orderBy('type', 'ASC')->get();
        $histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();
        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $doctors          = Doctor::get();
        $triage           = PatientVitals::where('patient_id' ,'=', $visit_details->patient_id)->first();
        $complaintperiods = range( date("D") , 30 );

        
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('visitid' ,'=', $id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mype = PatientPE::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myplan = PatientAssessment::where('visit_id' ,'=', $id)->get();

        $mynursenotes = NurseNote::where('visit_id' ,'=', $id)->first() ?: new NurseNote;
        $mynurseplan = NursePlan::where('visit_id' ,'=', $id)->first() ?: new NursePlan;
        $mydoctorplan = PatientAssessment::where('visit_id' ,'=', $id)->first() ?: new PatientAssessment;

        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();
        $oldvisits  =   OPD::where('patient_id' ,'=', $visit_details->patient_id)->get();

        $defaultheight = 0;
        if ($triage) 
        {
            $defaultheight = $triage->height;
        } 
        else {
                $defaultheight = 0;
        }

         //Vital Chart Graph
        $views = DB::table('patient_vitals')
             ->select(DB::raw("DATE_FORMAT(created_on,'%H:%i, %d-%M-%Y') as period"),DB::raw("visit_id,temperature,pulse_rate,respiration,sbp,dbp,weight"))
             ->where('patient_id' ,'=', $visit_details->patient_id)
             //->groupBy('period')
             ->get();

           // dd($views); 
        
        $labels      = array();
        $temperature = array();
        $pulse_rate  = array();
        $respiration  = array();
        $sbp  = array();
        $dbp  = array();
        $weight  = array();

        foreach ($views as $view) {

            array_push($labels, $view->period);
            array_push($temperature, $view->temperature);
            array_push($pulse_rate, $view->pulse_rate);
            array_push($respiration, $view->respiration);
            array_push($sbp, $view->sbp);
             array_push($weight, $view->weight);
            $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('visitid' ,'=', $id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mype = PatientPE::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myplan = PatientAssessment::where('visit_id' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();
            array_push($dbp, $view->dbp);
        }
        //dd($commentDataset);
    
        $vitalcharts = app()->chartjs
        ->name('vitals')
        ->type('line')
        ->size(['width' => 1000, 'height' => 300])
        ->labels($labels)
        ->datasets([
            [
                "label" => "Temperature",
                'beginAtZero' => "true",
                 "fill" => false,
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $temperature,
            ],
            [
                "label" => "Pulse Rate",
                 "fill" => false,
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $pulse_rate,
            ],
            [
                "label" => "Respiration",
                "fill" => false,
                'backgroundColor' => "rgba(153, 102, 255, 0.31)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                "pointBorderColor" => "rgba(153, 102, 255, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $respiration,
            ]
            ,
            [
                "label" => "Systolic",
                "fill" => false,
                'backgroundColor' => "rgba(220, 231, 117, 0.31)",
                'borderColor' => "rgba(220, 231, 117, 0.7)",
                "pointBorderColor" => "rgba(220, 231, 117, 0.7)",
                "pointBackgroundColor" => "rgba(220, 231, 117, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220, 231, 117,1)",
                'data' => $sbp,
            ]
            ,
            [
                "label" => "Diastolic",
                "fill" => false,
                'backgroundColor' => "rgba(0, 188, 212, 0.31)",
                'borderColor' => "rgba(0, 188, 212, 0.7)",
                "pointBorderColor" => "rgba(0, 188, 212, 0.7)",
                "pointBackgroundColor" => "rgba(0, 188, 212, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(0, 188, 212,1)",
                'data' => $dbp,
            ],
             [
                "label" => "Weight",
                "fill" => false,
                'backgroundColor' => "rgba(0, 188, 212, 0.31)",
                'borderColor' => "rgba(26, 82, 118, 0.7)",
                "pointBorderColor" => "rgba(26, 82, 118, 0.7)",
                "pointBackgroundColor" => "rgba(26, 82, 118, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(26, 82, 118,1)",
                'data' => $weight,
            ]


            
        ])
        ->options([]);


        $bills              = Bill::where('visit_id', $id)->orderBy('date', 'desc')->get();
        $paiditems          = Payments::where('EventID', $id)->get();
    
        $payables = 0;
        $receivables = 0;
        $outstanding=0;

        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       foreach($paiditems as $paiditem)
       {
            $receivables += ($paiditem->AmountReceived);
       }

        $outstanding = ($payables - $receivables);





       return view('nurse.review', compact('patients','payables','receivables','outstanding','mydoctorplan','availabledrugs','mynurseplan','mynursenotes','myplan','oldvisits','mype','mycomplaints','defaultheight','mydiagnosis','myvitals','myhistories','mylabs','mydrugs','myros','mycomplaints','triage','complaintperiods','vitalcharts','review_skin','review_neuro','review_gynae','review_nutrition','review_cardio','review_gastro','visit_details','review_ent','review_respiratory'))
        ->with('doctors',$doctors)
        ->with('diagnosis',$diagnosis)
        ->with('treatments',$treatments)
        ->with('drugs',$drugs)
        ->with('dosage',$dosage)
        ->with('periods',$periods)
        ->with('images',$images)
        ->with('complaints',$complaints)
        ->with('investigations',$investigations)
        ->with('frequency',$frequency)
        ->with('histories',$histories)
        ->with('application',$application);
    }


     public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }

      public function addTreatmentSheet()
    {     
         // if(Input::get("medication")){$medication =  implode(", ", } else {$medication = null;}

           $diagnosis                   = new PatientTreatmentSheet;
           $diagnosis->visit_id         = Input::get("opd_number");
           $diagnosis->treatment_name   = Input::get("medication");
           $diagnosis->time_given   = Carbon::createFromFormat('d/m/Y H:i:s', Input::get('medication_time'));
           $diagnosis->remark           = Input::get("medication_plan");
           $diagnosis->created_on       = Carbon::now();
           $diagnosis->created_by       = Auth::user()->getNameOrUsername();


            

            if($diagnosis->save())
            {
    
              $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }

    public function getTreatment()
{
    try
    {

            $opd_number =  Input::get("opd_number");
            $diagnosis  =  PatientTreatmentSheet::where('visit_id','=',$opd_number)->orderby('created_on','desc')->get();
            return  Response::json($diagnosis);        
    }

    catch (\Exception $e) 
    {
           echo $e->getMessage();
        
    }
}



   public function addNurseNote()
    {     
         
          $ID = Input::get("opd_number");
          $affectedRows = NurseNote::where('visit_id', '=', $ID)->delete();

           $assessment                  = new NurseNote;
           $assessment->visit_id        = Input::get("opd_number");
           $assessment->patient_id      = Input::get("patient_id");
           $assessment->content         = Input::get("nurse_note");
           $assessment->created_on      = Carbon::now();
           $assessment->created_by      = Auth::user()->getNameOrUsername();


            

            if($assessment->save())
            {
    
              $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }


       public function addNursePlan()
    {     
         
          $ID = Input::get("opd_number");
          $affectedRows = NursePlan::where('visit_id', '=', $ID)->delete();

           $assessment                  = new NursePlan;
           $assessment->visit_id        = Input::get("opd_number");
           $assessment->patient_id      = Input::get("patient_id");
           $assessment->content         = Input::get("nurse_plan");
           $assessment->created_on      = Carbon::now();
           $assessment->created_by      = Auth::user()->getNameOrUsername();


            

            if($assessment->save())
            {
    
              $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }

     public function excludeTreatment()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PatientTreatmentSheet::where('id', '=', $ID)->delete();

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




    public function addComplaint()
    {     
         
        if(Input::get("complaint")){$mycomplaint =  implode(", ", Input::get("complaint"));} else {$mycomplaint = null;}

           $complaints                  = new PatientComplaint;
           $complaints->visitid         = Input::get("opd_number");
           $complaints->complaint       = $mycomplaint;
           $complaints->period          = Input::get("com_period");
           $complaints->span            = Input::get("com_span");
           $complaints->remark          = Input::get("com_remark");
           $complaints->presenting      = Input::get("presentingcomplaint");
           $complaints->directquestion  = Input::get("directquestion");
           $complaints->date            = Carbon::now();
           $complaints->created_by      = Auth::user()->getNameOrUsername();


            

            if($complaints->save())
            {


              $affectedRows = OPD::where('opd_number',Input::get("opd_number"))->update(array('chief_complaint' => $mycomplaint,'location' => 'Triage Room'));

                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }


    public function addNurseHandingNote()
    {
        
        
    }



     public function newMedication()
    {
        $myrequest = LabDocs::where('id',17)->get();
         return view('nurse.progress',compact('myrequest'));
    }

    public function newIntakeOutput()
    {
        $myrequest = LabDocs::where('id',20)->get();
         return view('nurse.progress',compact('myrequest'));
    }

    public function newNurseProgess()
    {
        $myrequest = LabDocs::where('id',40)->get();
         return view('nurse.progress',compact('myrequest'));
    }

     public function newVitalSign()
    {
        $myrequest = LabDocs::where('id',14)->get();
         return view('nurse.progress',compact('myrequest'));
    }

     public function newHistory()
    {
        $myrequest = LabDocs::where('id',41)->get();
         return view('nurse.progress',compact('myrequest'));
    }

      public function newTemperature()
    {
        $myrequest = LabDocs::where('id',11)->get();
         return view('nurse.progress',compact('myrequest'));
    }


    public function newDischargeSummary()
    {
        $myrequest = LabDocs::where('id',38)->get();
         return view('nurse.progress',compact('myrequest'));
    }

    public function newAntenatalAdmission()
    {
        $myrequest = LabDocs::where('id',19)->get();
         return view('nurse.progress',compact('myrequest'));
    }

    public function newAntenatalAttendance()
    {
        $myrequest = LabDocs::where('id',22)->get();
         return view('nurse.progress',compact('myrequest'));
    }

    public function newPuerperium()
    {
        $myrequest = LabDocs::where('id',21)->get();
         return view('nurse.progress',compact('myrequest'));
    }

    public function newRecordofLabour()
    {
        $myrequest = LabDocs::where('id',23)->get();
         return view('nurse.progress',compact('myrequest'));
    }





   
}
