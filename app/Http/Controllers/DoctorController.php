<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Customer;
use OrionMedical\Models\OPD;
use OrionMedical\Models\AccountType;
use OrionMedical\Models\Bill;
use OrionMedical\Models\Complaint;
use OrionMedical\Models\EyeExamination;
use OrionMedical\Models\ServiceCharge;
use OrionMedical\Models\Procedure;
use OrionMedical\Models\Investigation;
use OrionMedical\Models\SocialFamilyHistory;
use OrionMedical\Models\Diagnosis;
use OrionMedical\Models\Serial;
use OrionMedical\Models\Fetus;
use OrionMedical\Models\IPD;
use OrionMedical\Models\LabDocs;
use OrionMedical\Models\Prescription;
use OrionMedical\Models\Consultation;
use OrionMedical\Models\AntenatalChart;
use OrionMedical\Models\LensTreatment;
use OrionMedical\Models\LensTypes;
use OrionMedical\Http\Requests;
use OrionMedical\Models\GestationDays;
use OrionMedical\Models\GestationLie;
use OrionMedical\Models\GestationPostion;
use OrionMedical\Models\Presentation;
use OrionMedical\Models\InsuranceCompany;
use OrionMedical\Models\VisitType;
use OrionMedical\Models\Images;
use OrionMedical\Models\Doctor;
use OrionMedical\Models\ServiceType;
use OrionMedical\Models\Drug;
use OrionMedical\Models\DrugPeriod;
use OrionMedical\Models\DrugApplication;
use OrionMedical\Models\DrugDosage;
use OrionMedical\Models\DrugFrequency;
use OrionMedical\Models\Treatment;
use OrionMedical\Models\DentalCavity;
use OrionMedical\Models\SystemReview;
use OrionMedical\Models\Department;
use OrionMedical\Models\ROS;
use OrionMedical\Models\PatientComplaint;
use OrionMedical\Models\PatientProcedure;
use OrionMedical\Models\PatientFurtherPlan;
use OrionMedical\Models\PatientInvestigation;
use OrionMedical\Models\PatientDiagnosis;
use OrionMedical\Models\PatientHistory;
use OrionMedical\Models\PatientVitals;
use OrionMedical\Models\PatientAssessment;
use OrionMedical\Models\PatientPlan;
use OrionMedical\Models\PatientFluids;
use OrionMedical\Models\OcularExamination;
use OrionMedical\Models\PatientPE;
use OrionMedical\Models\Payments;
use OrionMedical\Models\Company;
use OrionMedical\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Auth;
use Activity;
use Input;
use Response;
use Datetime;
use OneSignal;



class DoctorController extends Controller
{
    
   // private $pdf;

    public function __construct()
    {
        //$this->pdf = $pdf;
        $this->middleware('auth');
        //$this->middleware('role:Doctor|Billing|Pharmacist|Pharmacy Technician|System Admin|Nurse|Dentist|Ophthalmologist|Dietian|Specialist|Dental Nurse|Nurse Assistant|Dental Receptionist');
        
    }

  


   public function loadAllDiagnosis()
    {
        try
        {
                $search = Input::get("search");
                $jobs = Diagnosis::where('type','like', "%$search%")->get();
                return  Response::json($jobs);        
        }

        catch (\Exception $e) 
        {
               echo $e->getMessage();
            
        }
    }

    public function getPatientProfile($id)
   {
    $servicetype   = ServiceCharge::orderBy('type', 'ASC')->get();          
    $departments   = Department::get();
    $doctors       = Doctor::get();  
    $visittypes    = VisitType::get();
    $medications   = Prescription::where('patientid','=',$id)->orderBy('created_on', 'DESC')->get();    
    $images        = Images::where('accountnumber','=',$id)->get();
    $patients      = Customer::where('patient_id' ,'=', $id)->first();
    $insurers      = InsuranceCompany::get();
    $consultations = OPD::where('patient_id' ,'=', $id)->orderBy('created_on', 'DESC')->get();
    $diagnosis     = PatientDiagnosis::where('patient_id' ,'=', $id)->orderBy('date', 'DESC')->get();
    $procedures    = PatientProcedure::where('patientid' ,'=', $id)->orderBy('created_on', 'DESC')->get();
    $investigations = PatientInvestigation::where('patientid' ,'=', $id)->orderBy('created_on', 'DESC')->get();
    $allergies     = PatientHistory::where('patientid' ,'=', $id)->orderBy('created_on', 'DESC')->get();

    $billingaccounts = AccountType::get();

    //dd($allergies);
       //Vital Chart Graph
        $views = DB::table('patient_vitals')
             ->select(DB::raw("DATE_FORMAT(created_on,'%H:%i, %d-%M-%Y') as period"),DB::raw("visit_id,weight,height,temperature"))
             ->where('patient_id',$id)
             //->groupBy('period')
             ->get();

           // dd($views); 
        
        $labels      = array();
        $weight      = array();
        $height      = array();
        $temperature = array();

        foreach ($views as $view) {

            array_push($labels, $view->period);
            array_push($weight, $view->weight);
            array_push($height, $view->height);
            array_push($temperature, $view->temperature);
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
                "label" => "Weight",
                 "fill" => false,
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $weight,
            ],
            [
                "label" => "Height",
                "fill" => false,
                'backgroundColor' => "rgba(153, 102, 255, 0.31)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                "pointBorderColor" => "rgba(153, 102, 255, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $height,
            ]


            
        ])
        ->options([]);

    return view('patient.profile', compact('patients','billingaccounts','allergies','vitalcharts','diagnosis','procedures','investigations','visittypes','consultations','images','departments','doctors','insurers','servicetype','medications'));

   }

    public function opd()
    {   
        $waiting  =    OPD::where('status','Waiting to be seen')->get();
        $reviewed =    OPD::where('status','Review')->get();
        $discharged =    OPD::where('status','Discharged')->get();
        $admission =    OPD::where('visit_type','Admission')->get();

        $today =        Carbon::now()->format('Y-m-d').'%';
        $patients         = OPD::where('location','like','Consult%')->where('referal_doctor',Auth::user()->getNameOrUsername())->where('consultation_type','<>','DENTAL CONSULTATION')->where('created_on', 'like', $today)->orderBy('created_on', 'DESC')->paginate(30);
        $complaintperiods = range( date("D") , 30 );
       return view('doctor.opd', compact('patients','discharged','complaintperiods','waiting','reviewed','admission'));
    }

     public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y', $date);
        return $time->format('Y-m-d');
    }



    public function findPatientFolder(Request $request)
    {
        $waiting  =    OPD::where('status','Checked-In')->get();
        $reviewed =    OPD::where('status','Review')->get();
        $discharged =    OPD::where('status','Discharged')->get();
        $admission =    OPD::where('visit_type','Admission')->get();

        
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        $histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();
        //$diagnosis        = Diagnosis::orderBy('category', 'ASC')->distinct()->get(['category']);
        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $departments      = Department::get();
        $doctors          = Doctor::get();
        $complaintperiods = range( date("D") , 30 );



        // $this->validate($request, [
        //     'search' => 'required'
        // ]);

        $search = $request->get('search');
        $time   = explode(" - ", Input::get('review_period')); 
        
        //dd($time,$search);
        //$from = $this->change_date_format($time[0]);
        //$to   = $this->change_date_format($time[1]);

        //dd($time[0]);

        if(!$search=="")
        {

            if(Auth::user()->getRole()=="System Admin")
            {
             $patients = OPD::where('name', 'like', "%$search%")
            ->where('consultation_type','<>', "DENTAL CONSULTATION")
            ->where('consultation_type','<>', "Pharmacy Walk In")
            ->orWhere('referal_doctor', 'like', "%$search%")
            ->orWhere('opd_number', 'like', "%$search%")
            ->orWhere('consultation_type', 'like', "%$search%")
            ->orWhere('visit_type', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(30)
            ->appends(['search' => $search]);
            }

            else
            {

           
              $patients = OPD::where('name', 'like', "%$search%")
            ->where('consultation_type','<>', "DENTAL CONSULTATION")
            ->where('consultation_type','<>', "Pharmacy Walk In")
            ->orWhere('referal_doctor', 'like', "%$search%")
            ->orWhere('opd_number', 'like', "%$search%")
            ->orWhere('consultation_type', 'like', "%$search%")
            ->orWhere('visit_type', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(30)
            ->appends(['search' => $search]);
            
            
            // $patients = OPD::where('name', 'like', "%$search%")
            // ->where('consultation_type','<>', "DENTAL CONSULTATION")
            // ->where('consultation_type','<>', "Pharmacy Walk In")
            // ->where('referal_doctor', 'like', "%".Auth::user()->getNameOrUsername()."%")
            // ->orWhere('consultation_type', 'like', "%$search%")
            // ->orWhere('opd_number', 'like', "%$search%")
            // ->orWhere('visit_type', 'like', "%$search%")
            // ->orderBy('created_on','desc')
            // ->paginate(30)
            // ->appends(['search' => $search]);
            
               
            }
        }
        else
        {

            //dd(Auth::user()->getRole());

            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

            //dd($from);
            if(Auth::user()->getRole()=="System Admin")
            {
            $patients = OPD::whereBetween('updated_on',array($from,$to))
             ->where('consultation_type','<>', "Pharmacy Walk In")
             ->where('consultation_type','<>', "DENTAL CONSULTATION")
            ->orderBy('created_on','desc')
            ->paginate(200)
            ->appends(['search' => $search]);
             }
             
             else
             {
                 $patients = OPD::whereBetween('updated_on',array($from,$to))
                  ->Where('referal_doctor', 'like', "%".Auth::user()->getNameOrUsername()."%")
                   ->where('consultation_type','<>', "Pharmacy Walk In")
                   ->where('consultation_type','not like', "%DENTAL CONSULTATION%")
            ->orderBy('created_on','desc')
            ->paginate(200)
            ->appends(['search' => $search]);

             }

        }
        
       return view('doctor.opd', compact('patients','discharged','complaintperiods','waiting','reviewed','admission'))
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
        ->with('application',$application)
        ->with('histories',$histories)
        ->with('departments',$departments);
    }


    public function findDentistFolder(Request $request)
    {
        $waiting          = OPD::where('status','Checked-In')->get();
        $reviewed         = OPD::where('status','Review')->get();
        $discharged       = OPD::where('status','Discharged')->get();
        $admission        = OPD::where('visit_type','Admission')->get();

        
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','Dental')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        $histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();
        //$diagnosis        = Diagnosis::orderBy('category', 'ASC')->distinct()->get(['category']);
        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $departments      = Department::get();
        $doctors          = Doctor::get();
        $complaintperiods = range( date("D") , 30 );

        $search           = $request->get('search');
        $time             = explode(" - ", Input::get('review_period')); 
        
        
       
        if(!$search=="")
        {

            if(Auth::user()->getRole()=="System Admin")
            {
             $patients = OPD::Where('consultation_type', 'like', "%DENTAL%")
             ->where('name', 'like', "%$search%")
            
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search]);
            }

            else
            {
            $patients = OPD::Where('consultation_type', 'like', "%DENTAL%")
            ->where('name', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search]);
            }
        }
        else
        {

            //dd(Auth::user()->getRole());

            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

            //dd($from,$to);
            if(Auth::user()->getRole()=="System Admin")
            {
                $patients = OPD::whereBetween('updated_on',array($from,$to))
            ->where('consultation_type','like', "%DENTAL%")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search]);
             }
             
             else
             {
                 $patients = OPD::whereBetween('updated_on',array($from,$to))
            ->where('consultation_type','like', "%DENTAL%")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search]);

             }

        }
        
      return view('dentist.index', compact('patients','discharged','complaintperiods','waiting','reviewed','admission'));
    }


    public function findEyeFolder(Request $request)
    {
        $waiting          = OPD::where('status','Checked-In')->get();
        $reviewed         = OPD::where('status','Review')->get();
        $discharged       = OPD::where('status','Discharged')->get();
        $admission        = OPD::where('visit_type','Admission')->get();

        
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','Dental')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        $histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();
        //$diagnosis        = Diagnosis::orderBy('category', 'ASC')->distinct()->get(['category']);
        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $departments      = Department::get();
        $doctors          = Doctor::get();
        $complaintperiods = range( date("D") , 30 );

        $search           = $request->get('search');
        $time             = explode(" - ", Input::get('review_period')); 
        
        
       
        if(!$search=="")
        {

            if(Auth::user()->getRole()=="System Admin")
            {
             $patients = OPD::Where('consultation_type', 'like', "%EYE%")
             ->where('name', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search]);
            }

            else
            {
            $patients = OPD::Where('consultation_type', 'like', "%EYE%")
            ->where('name', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search]);
            }
        }
        else
        {

            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

            //dd($from,$to);
            if(Auth::user()->getRole()=="System Admin")
            {
                $patients = OPD::whereBetween('updated_on',array($from,$to))
            ->where('consultation_type','like', "%EYE%")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search]);
             }
             
             else
             {
                 $patients = OPD::whereBetween('updated_on',array($from,$to))
            ->where('consultation_type','like', "%EYE%")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search]);

             }

        }
        
      return view('optometry.index', compact('patients','discharged','complaintperiods','waiting','reviewed','admission'));
    }


    public function dietianConsultation($id)
    {   
       $visit_details     = OPD::where('opd_number' ,'=', $id)->first();
        $patients         = Customer::where('patient_id' ,'=', $visit_details->patient_id)->get();
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::where('accountnumber' , $visit_details->patient_id)->where('source','<>','null')->get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        //$histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();

        $pastmedicalhx   = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $familyhx        = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $socialhx        = SocialFamilyHistory::where('category','Social')->orderBy('type', 'ASC')->get();
        $vacinnationhx   = SocialFamilyHistory::where('category','Vaccination')->orderBy('type', 'ASC')->get();
        $medicationhx    = SocialFamilyHistory::where('category','Medication')->orderBy('type', 'ASC')->get();
        $surgicalhx      = SocialFamilyHistory::where('category','Surgical')->orderBy('type', 'ASC')->get();
        $reproductivehx  = SocialFamilyHistory::where('category','Reproductive')->orderBy('type', 'ASC')->get();
        $allergichx      = SocialFamilyHistory::where('category','Allergy')->orderBy('type', 'ASC')->get();

        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $doctors          = Doctor::get();
        $triage           = PatientVitals::where('patient_id' ,'=', $visit_details->patient_id)->first();
        $complaintperiods = range( date("D") , 30 );
        $servicetype = ServiceCharge::where('type','like','%Follow up%')->orderby('type','asc')->get(); 
        

         //Review of systems
        $ros_constitutional      = SystemReview::where('system','General')->where('description','Review of System')->get();
        $ros_skin                = SystemReview::where('system','Skin')->where('description','Review of System')->get();
        $ros_head         = SystemReview::where('system','Head')->where('description','Review of System')->get();
        $ros_throat       = SystemReview::where('system','Throat')->where('description','Review of System')->get();
        $ros_nose         = SystemReview::where('system','Nose')->where('description','Review of System')->get();
        $ros_ears         = SystemReview::where('system','Ears')->where('description','Review of System')->get();
        $ros_eyes         = SystemReview::where('system','Eyes')->where('description','Review of System')->get();
        $ros_respiratory       = SystemReview::where('system','Respiratory')->where('description','Review of System')->get();
        $ros_cardiovasular       = SystemReview::where('system','Cardiovascular')->where('description','Review of System')->get();
        $ros_gastro      = SystemReview::where('system','Gastrointestinal')->where('description','Review of System')->get();
        $ros_gynecology       = SystemReview::where('system','gynecologic')->where('description','Review of System')->get();
        $ros_genitourinary       = SystemReview::where('system','genitourinary')->where('description','Review of System')->get();
        $ros_endocrine      = SystemReview::where('system','Endocrine')->where('description','Review of System')->get();
        $ros_musculoskeletal       = SystemReview::where('system','Musculoskeletal')->where('description','Review of System')->get();
        $ros_peripheral_vascular       = SystemReview::where('system','Peripheral vascular')->where('description','Review of System')->get();
        $ros_hematology       = SystemReview::where('system','Hematology')->where('description','Review of System')->get();
        $ros_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->where('description','Review of System')->get();

        //Physical Exam
        $pe_constitutional     = SystemReview::where('system','General')->where('description','Physical Examination')->get();
        $pe_neck               = SystemReview::where('system','Neck')->where('description','Physical Examination')->get();
        $pe_HEENT              = SystemReview::where('system','Nose')->orwhere('system','Head')->orwhere('system','Eyes')->orwhere('system','Ears')->orwhere('system','Throat')->where('description','Physical Examination')->get();
        $pe_respiratory        = SystemReview::where('system','Respiratory')->where('description','Physical Examination')->get();
        $pe_heart              = SystemReview::where('system','Cardiovascular')->where('description','Physical Examination')->get();
        $pe_gastro             = SystemReview::where('system','Gastrointestinal')->where('description','Physical Examination')->get();
        $pe_gynecology         = SystemReview::where('system','Gynecologic')->where('description','Physical Examination')->get();
        $pe_musculoskeletal    = SystemReview::where('system','Musculoskeletal')->where('description','Physical Examination')->get();
        $pe_abdominal          = SystemReview::where('system','Abdominal')->where('description','Physical Examination')->get();
        $pe_psychological      = SystemReview::where('system','Psychological')->where('description','Physical Examination')->get();
        $pe_extremities        = SystemReview::where('system','Extremities')->where('description','Physical Examination')->get();
        $pe_neuropsychiatric   = SystemReview::where('system','Neuropsychiatric')->where('description','Physical Examination')->get();

        //pe_constitutional,pe_neck,pe_head,ros_throat

        //Timeline
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('visitid' ,'=', $id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mype = PatientPE::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();
        

        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->get();
        $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();


        $bills              = Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
        $payables = 0;


        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       return view('dietian.review', compact('mype','pe_constitutional','pe_heart','pe_neck','pe_psychological','pe_neuropsychiatric','pe_musculoskeletal','pe_extremities','pe_gynecology','pe_abdominal','pe_genitourinary','pe_gastro','pe_HEENT','pe_respiratory','patients','bills','payables','visittypes','servicetype','pastmedicalhx','familyhx','allergichx','reproductivehx','surgicalhx','medicationhx','vacinnationhx','socialhx','mydiagnosis','myvitals','myhistories','mylabs','mydrugs','myros','mycomplaints','triage','complaintperiods','visit_details','ros_throat','ros_eyes','ros_ears','ros_nose','ros_skin','ros_head','ros_constitutional','ros_respiratory','ros_cardiovasular','ros_gastro','ros_gynecology','ros_genitourinary','ros_endocrine','ros_musculoskeletal','ros_peripheral_vascular','ros_hematology','ros_neuropsychiatric'))
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
        ->with('application',$application);
    }

    public function doConsulation($id)
    {   

        $visit_details  =   OPD::where('opd_number' ,'=', $id)->first();
        $patients        =   Customer::where('patient_id' ,'=', $visit_details->patient_id)->get();
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::where('accountnumber' , $visit_details->patient_id)->get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        //$histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();

        $pastmedicalhx   = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $familyhx        = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $socialhx        = SocialFamilyHistory::where('category','Social')->orderBy('type', 'ASC')->get();
        $vacinnationhx   = SocialFamilyHistory::where('category','Vaccination')->orderBy('type', 'ASC')->get();
        $medicationhx    = SocialFamilyHistory::where('category','Medication')->orderBy('type', 'ASC')->get();
        $surgicalhx      = SocialFamilyHistory::where('category','Surgical')->orderBy('type', 'ASC')->get();
        $reproductivehx  = SocialFamilyHistory::where('category','Reproductive')->orderBy('type', 'ASC')->get();
        $allergichx      = SocialFamilyHistory::where('category','Allergy')->orderBy('type', 'ASC')->get();

        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $doctors          = Doctor::get();
        $triage           = PatientVitals::where('patient_id' ,'=', $visit_details->patient_id)->first();
        $complaintperiods = range( date("D") , 30 );
        $servicetype = ServiceCharge::where('type','like','%Follow up%')->orderby('type','asc')->get(); 
        

         //Review of systems
        $ros_constitutional      = SystemReview::where('system','General')->where('description','Review of System')->get();
        $ros_skin                = SystemReview::where('system','Skin')->where('description','Review of System')->get();
        $ros_head       = SystemReview::where('system','Head')->where('description','Review of System')->get();
        $ros_throat       = SystemReview::where('system','Throat')->where('description','Review of System')->get();
        $ros_nose         = SystemReview::where('system','Nose')->where('description','Review of System')->get();
        $ros_ears         = SystemReview::where('system','Ears')->where('description','Review of System')->get();
        $ros_eyes         = SystemReview::where('system','Eyes')->where('description','Review of System')->get();
        $ros_respiratory       = SystemReview::where('system','Respiratory')->where('description','Review of System')->get();
        $ros_cardiovasular       = SystemReview::where('system','Cardiovascular')->where('description','Review of System')->get();
        $ros_gastro      = SystemReview::where('system','Gastrointestinal')->where('description','Review of System')->get();
        $ros_gynecology       = SystemReview::where('system','gynecologic')->where('description','Review of System')->get();
        $ros_genitourinary       = SystemReview::where('system','genitourinary')->where('description','Review of System')->get();
        $ros_endocrine      = SystemReview::where('system','Endocrine')->where('description','Review of System')->get();
        $ros_musculoskeletal       = SystemReview::where('system','Musculoskeletal')->where('description','Review of System')->get();
        $ros_peripheral_vascular       = SystemReview::where('system','Peripheral vascular')->where('description','Review of System')->get();
        $ros_hematology       = SystemReview::where('system','Hematology')->where('description','Review of System')->get();
        $ros_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->where('description','Review of System')->get();

        //Physical Exam
        $pe_constitutional     = SystemReview::where('system','General')->where('description','Physical Examination')->get();
        $pe_neck               = SystemReview::where('system','Neck')->where('description','Physical Examination')->get();
        $pe_HEENT              = SystemReview::where('system','Nose')->orwhere('system','Head')->orwhere('system','Eyes')->orwhere('system','Ears')->orwhere('system','Throat')->where('description','Physical Examination')->get();
        $pe_respiratory        = SystemReview::where('system','Respiratory')->where('description','Physical Examination')->get();
        $pe_heart              = SystemReview::where('system','Cardiovascular')->where('description','Physical Examination')->get();
        $pe_gastro             = SystemReview::where('system','Gastrointestinal')->where('description','Physical Examination')->get();
        $pe_gynecology         = SystemReview::where('system','Gynecologic')->where('description','Physical Examination')->get();
        $pe_musculoskeletal    = SystemReview::where('system','Musculoskeletal')->where('description','Physical Examination')->get();
        $pe_abdominal          = SystemReview::where('system','Abdominal')->where('description','Physical Examination')->get();
        $pe_psychological      = SystemReview::where('system','Psychological')->where('description','Physical Examination')->get();
        $pe_extremities        = SystemReview::where('system','Extremities')->where('description','Physical Examination')->get();
        $pe_neuropsychiatric   = SystemReview::where('system','Neuropsychiatric')->where('description','Physical Examination')->get();
        $pe_breast      = SystemReview::where('system','Breast')->where('description','Physical Examination')->get();
        //pe_constitutional,pe_neck,pe_head,ros_throat

        //Timeline
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('patientid' ,'=', $visit_details->patient_id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mype = PatientPE::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myplan = PatientAssessment::where('visit_id' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();

       

       // dd($expcomplaints);


        $oldvisits  =   OPD::where('patient_id' ,'=', $visit_details->patient_id)->get();
        

        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->get();
        $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();


        $bills              = Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
        $payables = 0;


        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       return view('doctor.review', compact('mype','expcomplaints','expdirectquestion','myplan','pe_constitutional','oldvisits','pe_heart','pe_neck','pe_breast','pe_psychological','pe_neuropsychiatric','pe_musculoskeletal','pe_extremities','pe_gynecology','pe_abdominal','pe_genitourinary','pe_gastro','pe_HEENT','pe_respiratory','patients','bills','payables','visittypes','servicetype','pastmedicalhx','familyhx','allergichx','reproductivehx','surgicalhx','medicationhx','vacinnationhx','socialhx','mydiagnosis','myvitals','myhistories','mylabs','mydrugs','myros','mycomplaints','triage','complaintperiods','visit_details','ros_throat','ros_eyes','ros_ears','ros_nose','ros_skin','ros_head','ros_constitutional','ros_respiratory','ros_cardiovasular','ros_gastro','ros_gynecology','ros_genitourinary','ros_endocrine','ros_musculoskeletal','ros_peripheral_vascular','ros_hematology','ros_neuropsychiatric'))
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
        ->with('application',$application);
    }



    public function psychoConsulation($id)
    {   

        $visit_details  =   OPD::where('opd_number' ,'=', $id)->first();
        $patients        =   Customer::where('patient_id' ,'=', $visit_details->patient_id)->get();
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::where('accountnumber' , $visit_details->patient_id)->get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        //$histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();

        $pastmedicalhx   = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $familyhx        = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $socialhx        = SocialFamilyHistory::where('category','Social')->orderBy('type', 'ASC')->get();
        $vacinnationhx   = SocialFamilyHistory::where('category','Vaccination')->orderBy('type', 'ASC')->get();
        $medicationhx    = SocialFamilyHistory::where('category','Medication')->orderBy('type', 'ASC')->get();
        $surgicalhx      = SocialFamilyHistory::where('category','Surgical')->orderBy('type', 'ASC')->get();
        $reproductivehx  = SocialFamilyHistory::where('category','Reproductive')->orderBy('type', 'ASC')->get();
        $allergichx      = SocialFamilyHistory::where('category','Allergy')->orderBy('type', 'ASC')->get();

        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $doctors          = Doctor::get();
        $triage           = PatientVitals::where('patient_id' ,'=', $visit_details->patient_id)->first();
        $complaintperiods = range( date("D") , 30 );
        $servicetype = ServiceCharge::where('type','like','%Follow up%')->orderby('type','asc')->get(); 
        

         //Review of systems
        $ros_constitutional      = SystemReview::where('system','General')->where('description','Review of System')->get();
        $ros_skin                = SystemReview::where('system','Skin')->where('description','Review of System')->get();
        $ros_head       = SystemReview::where('system','Head')->where('description','Review of System')->get();
        $ros_throat       = SystemReview::where('system','Throat')->where('description','Review of System')->get();
        $ros_nose         = SystemReview::where('system','Nose')->where('description','Review of System')->get();
        $ros_ears         = SystemReview::where('system','Ears')->where('description','Review of System')->get();
        $ros_eyes         = SystemReview::where('system','Eyes')->where('description','Review of System')->get();
        $ros_respiratory       = SystemReview::where('system','Respiratory')->where('description','Review of System')->get();
        $ros_cardiovasular       = SystemReview::where('system','Cardiovascular')->where('description','Review of System')->get();
        $ros_gastro      = SystemReview::where('system','Gastrointestinal')->where('description','Review of System')->get();
        $ros_gynecology       = SystemReview::where('system','gynecologic')->where('description','Review of System')->get();
        $ros_genitourinary       = SystemReview::where('system','genitourinary')->where('description','Review of System')->get();
        $ros_endocrine      = SystemReview::where('system','Endocrine')->where('description','Review of System')->get();
        $ros_musculoskeletal       = SystemReview::where('system','Musculoskeletal')->where('description','Review of System')->get();
        $ros_peripheral_vascular       = SystemReview::where('system','Peripheral vascular')->where('description','Review of System')->get();
        $ros_hematology       = SystemReview::where('system','Hematology')->where('description','Review of System')->get();
        $ros_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->where('description','Review of System')->get();

        //Physical Exam
        $pe_constitutional     = SystemReview::where('system','General')->where('description','Physical Examination')->get();
        $pe_neck               = SystemReview::where('system','Neck')->where('description','Physical Examination')->get();
        $pe_HEENT              = SystemReview::where('system','Nose')->orwhere('system','Head')->orwhere('system','Eyes')->orwhere('system','Ears')->orwhere('system','Throat')->where('description','Physical Examination')->get();
        $pe_respiratory        = SystemReview::where('system','Respiratory')->where('description','Physical Examination')->get();
        $pe_heart              = SystemReview::where('system','Cardiovascular')->where('description','Physical Examination')->get();
        $pe_gastro             = SystemReview::where('system','Gastrointestinal')->where('description','Physical Examination')->get();
        $pe_gynecology         = SystemReview::where('system','Gynecologic')->where('description','Physical Examination')->get();
        $pe_musculoskeletal    = SystemReview::where('system','Musculoskeletal')->where('description','Physical Examination')->get();
        $pe_abdominal          = SystemReview::where('system','Abdominal')->where('description','Physical Examination')->get();
        $pe_psychological      = SystemReview::where('system','Psychological')->where('description','Physical Examination')->get();
        $pe_extremities        = SystemReview::where('system','Extremities')->where('description','Physical Examination')->get();
        $pe_neuropsychiatric   = SystemReview::where('system','Neuropsychiatric')->where('description','Physical Examination')->get();
        $pe_breast      = SystemReview::where('system','Breast')->where('description','Physical Examination')->get();
        //pe_constitutional,pe_neck,pe_head,ros_throat

        //Timeline
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('patientid' ,'=', $visit_details->patient_id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mype = PatientPE::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myplan = PatientAssessment::where('visit_id' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();

       

       // dd($expcomplaints);


        $oldvisits  =   OPD::where('patient_id' ,'=', $visit_details->patient_id)->get();
        

        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->get();
        $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();


        $bills              = Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
        $payables = 0;


        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       return view('doctor.psycho', compact('mype','expcomplaints','expdirectquestion','myplan','pe_constitutional','oldvisits','pe_heart','pe_neck','pe_breast','pe_psychological','pe_neuropsychiatric','pe_musculoskeletal','pe_extremities','pe_gynecology','pe_abdominal','pe_genitourinary','pe_gastro','pe_HEENT','pe_respiratory','patients','bills','payables','visittypes','servicetype','pastmedicalhx','familyhx','allergichx','reproductivehx','surgicalhx','medicationhx','vacinnationhx','socialhx','mydiagnosis','myvitals','myhistories','mylabs','mydrugs','myros','mycomplaints','triage','complaintperiods','visit_details','ros_throat','ros_eyes','ros_ears','ros_nose','ros_skin','ros_head','ros_constitutional','ros_respiratory','ros_cardiovasular','ros_gastro','ros_gynecology','ros_genitourinary','ros_endocrine','ros_musculoskeletal','ros_peripheral_vascular','ros_hematology','ros_neuropsychiatric'))
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
        ->with('application',$application);
    }



    public function doConsulationWalkin($id)
    {   

        $visit_details  =   OPD::where('opd_number' ,'=', $id)->first();
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::where('accountnumber' , $visit_details->patient_id)->get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        //$histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();

       
        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $doctors          = Doctor::get();
        $triage           = PatientVitals::where('patient_id' ,'=', $visit_details->patient_id)->first();
        $complaintperiods = range( date("D") , 30 );
        $servicetype = ServiceCharge::where('type','like','%Follow up%')->orderby('type','asc')->get(); 
        

       
        //Timeline
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('patientid' ,'=', $visit_details->patient_id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mype = PatientPE::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myplan = PatientAssessment::where('visit_id' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();

       

       // dd($expcomplaints);


        $oldvisits  =   OPD::where('patient_id' ,'=', $visit_details->patient_id)->get();
        

        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->get();
        $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();


        $bills              = Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
        $payables = 0;


        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       return view('doctor.walkin', compact('bills','payables','visittypes','servicetype','pastmedicalhx','familyhx','allergichx','reproductivehx','surgicalhx','medicationhx','vacinnationhx','socialhx','mydiagnosis','myvitals','myhistories','mylabs','mydrugs','myros','mycomplaints','triage','complaintperiods','visit_details','ros_throat','ros_eyes','ros_ears','ros_nose','ros_skin','ros_head','ros_constitutional','ros_respiratory','ros_cardiovasular','ros_gastro','ros_gynecology','ros_genitourinary','ros_endocrine','ros_musculoskeletal','ros_peripheral_vascular','ros_hematology','ros_neuropsychiatric'))
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
        ->with('application',$application);
    }

    public function doConsulationIPD($id)
    {   

        $visit_details  =   OPD::where('opd_number' ,'=', $id)->first();
        $patients        =   Customer::where('patient_id' ,'=', $visit_details->patient_id)->get();
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::where('accountnumber' ,'=', $visit_details->patient_id)->get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        $histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();
        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $doctors          = Doctor::get();
        $triage           = PatientVitals::where('patient_id' ,'=', $visit_details->patient_id)->first();
        $complaintperiods = range( date("D") , 30 );
        $servicetype = ServiceCharge::where('type','like','%Follow up%')->orderby('type','asc')->get(); 
        

        //Review of systems
        $ros_constitutional      = SystemReview::where('system','General')->where('description','Review of System')->get();
        $ros_skin                = SystemReview::where('system','Skin')->where('description','Review of System')->get();
        $ros_head       = SystemReview::where('system','Head')->where('description','Review of System')->get();
        $ros_throat       = SystemReview::where('system','Throat')->where('description','Review of System')->get();
        $ros_nose         = SystemReview::where('system','Nose')->where('description','Review of System')->get();
        $ros_ears         = SystemReview::where('system','Ears')->where('description','Review of System')->get();
        $ros_eyes         = SystemReview::where('system','Eyes')->where('description','Review of System')->get();
        $ros_respiratory       = SystemReview::where('system','Respiratory')->where('description','Review of System')->get();
        $ros_cardiovasular       = SystemReview::where('system','Cardiovascular')->where('description','Review of System')->get();
        $ros_gastro      = SystemReview::where('system','Gastrointestinal')->where('description','Review of System')->get();
        $ros_gynecology       = SystemReview::where('system','gynecologic')->where('description','Review of System')->get();
        $ros_genitourinary       = SystemReview::where('system','genitourinary')->where('description','Review of System')->get();
        $ros_endocrine      = SystemReview::where('system','Endocrine')->where('description','Review of System')->get();
        $ros_musculoskeletal       = SystemReview::where('system','Musculoskeletal')->where('description','Review of System')->get();
        $ros_peripheral_vascular       = SystemReview::where('system','Peripheral vascular')->where('description','Review of System')->get();
        $ros_hematology       = SystemReview::where('system','Hematology')->where('description','Review of System')->get();
        $ros_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->where('description','Review of System')->get();

        //Physical Exam
        $ros_constitutional      = SystemReview::where('system','General')->get();
        $pe_neck       = SystemReview::where('system','Neck')->get();
        $pe_head       = SystemReview::where('system','Head')->get();
        $ros_throat       = SystemReview::where('system','Throat')->get();
        $pe_nose         = SystemReview::where('system','Nose')->get();
        $pe_ears         = SystemReview::where('system','Ears')->get();
        $pe_eyes         = SystemReview::where('system','Eyes')->get();
        $ros_chest       = SystemReview::where('system','Respiratory')->get();
        $pe_heart       = SystemReview::where('system','Cardiovascular')->get();
        $pe_gastro      = SystemReview::where('system','Gastrointestinal')->get();
        $pe_gynecology       = SystemReview::where('system','Gynecologic')->get();
        $pe_genitourinary       = SystemReview::where('system','Genitourinary')->get();
        $pe_abdominal       = SystemReview::where('system','Abdominal')->get();
        $pe_pelvic       = SystemReview::where('system','Pelvic')->get();
        $pe_extremities       = SystemReview::where('system','Musculoskeletal')->get();
        $pe_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->get();


        $pastmedicalhx   = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $familyhx        = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $socialhx        = SocialFamilyHistory::where('category','Social')->orderBy('type', 'ASC')->get();
        $vacinnationhx        = SocialFamilyHistory::where('category','Vaccination')->orderBy('type', 'ASC')->get();
        $medicationhx        = SocialFamilyHistory::where('category','Medication')->orderBy('type', 'ASC')->get();
        $surgicalhx        = SocialFamilyHistory::where('category','Surgical')->orderBy('type', 'ASC')->get();
        $reproductivehx        = SocialFamilyHistory::where('category','Reproductive')->orderBy('type', 'ASC')->get();
        $allergichx        = SocialFamilyHistory::where('category','Allergy')->orderBy('type', 'ASC')->get();


        //Timeline
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('visitid' ,'=', $id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->get();


        
         //Vital Chart Graph
        $views = DB::table('patient_vitals')
             ->select(DB::raw("DATE_FORMAT(created_on,'%H:%i, %d-%M-%Y') as period"),DB::raw("visit_id,weight,height,temperature"))
             ->where('visit_id',$id)
             //->groupBy('period')
             ->get();

           // dd($views); 
        
        $labels      = array();
        $weight      = array();
        $height      = array();
        $temperature = array();

        foreach ($views as $view) {

            array_push($labels, $view->period);
            array_push($weight, $view->weight);
            array_push($height, $view->height);
            array_push($temperature, $view->temperature);
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
                "label" => "Weight",
                 "fill" => false,
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $weight,
            ],
            [
                "label" => "Height",
                "fill" => false,
                'backgroundColor' => "rgba(153, 102, 255, 0.31)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                "pointBorderColor" => "rgba(153, 102, 255, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $height,
            ]


            
        ])
        ->options([]);

       return view('ipd.review', compact('patients','vitalcharts','servicetype','pastmedicalhx','familyhx','allergichx','reproductivehx','surgicalhx','medicationhx','vacinnationhx','socialhx','mydiagnosis','myvitals','myhistories','mylabs','mydrugs','myros','mycomplaints','triage','complaintperiods','visit_details','ros_throat','ros_eyes','ros_ears','ros_nose','ros_skin','ros_head','ros_constitutional','ros_respiratory','ros_cardiovasular','ros_gastro','ros_gynecology','ros_genitourinary','ros_endocrine','ros_musculoskeletal','ros_peripheral_vascular','ros_hematology','ros_neuropsychiatric'))
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

      public function dental()
    {   

        $waiting   =   OPD::where('status','Checked-In')->where('consultation_type','DENTAL CONSULTATION')->get();
        $reviewed  =   OPD::where('status','Review')->where('consultation_type','DENTAL CONSULTATION')->get();
        $admission =   OPD::where('visit_type','Admission')->get();

        $today     = Carbon::now()->format('Y-m-d').'%';
        $patients  = OPD::where('consultation_type','like','%DENTAL%')->where('created_on', 'like', $today)->orderBy('created_on', 'DESC')->paginate(30);


        $complaintperiods = range( date("D") , 30 );
         return view('dentist.index', compact('patients','discharged','complaintperiods','waiting','reviewed','admission'));
    }

     public function dentalReviewed()
    {   

       //   $waiting  =    OPD::where('status','Checked-In')->where('consultation_type','DENTAL CONSULTATION')->get();
       //  $reviewed =    OPD::where('status','Review')->where('consultation_type','DENTAL CONSULTATION')->get();
       //  $admission =    OPD::where('visit_type','Admission')->get();

       //  $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
       //  $images           = Images::get();
       //  $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
       //  $complaints       = Complaint::orderBy('type', 'ASC')->get();
       //  $application      = DrugApplication::get();
       //  $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
       //  $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
       //  $drugs            = Drug::orderBy('name', 'ASC')->get();
       //  $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
       //  $histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();
       //  //$diagnosis        = Diagnosis::orderBy('category', 'ASC')->distinct()->get(['category']);
       //   $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
       //  $departments      = Department::get();
       //  $doctors          = Doctor::get();
       //  $patients         = OPD::where('status','Review')->where('consultation_type','DENTAL CONSULTATION')->orderBy('created_on', 'DESC')->paginate(30);
       //  $complaintperiods = range( date("D") , 30 );
       
       // return view('dentist.index', compact('patients','complaintperiods','waiting','reviewed','admission'))
       //  ->with('doctors',$doctors)
       //  ->with('diagnosis',$diagnosis)
       //  ->with('treatments',$treatments)
       //  ->with('drugs',$drugs)
       //  ->with('dosage',$dosage)
       //  ->with('periods',$periods)
       //  ->with('images',$images)
       //  ->with('complaints',$complaints)
       //  ->with('investigations',$investigations)
       //  ->with('frequency',$frequency)
       //  ->with('application',$application)
       //  ->with('histories',$histories)xx
       //  ->with('departments',$departments);
    }

     public function doDentalReview($id)
    {   

        $visit_details    = OPD::where('opd_number' ,'=', $id)->first();
        $patients         = Customer::where('patient_id' ,'=', $visit_details->patient_id)->get();
        $tooths            = DentalCavity::get();
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::where('accountnumber' ,'=', $visit_details->patient_id)->get();
        $investigations   = ServiceCharge::where('department','Dental-Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','Dental')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','dental')->orderBy('type', 'ASC')->get();
        $histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();
        //$diagnosis        = Diagnosis::orderBy('category', 'ASC')->distinct()->get(['category']);
        $diagnosis        = Diagnosis::where('speciality','Dental')->orderBy('type', 'ASC')->get();
        $doctors          = Doctor::get();
        $triage           = PatientVitals::where('patient_id' ,'=', $visit_details->patient_id)->first();
        $complaintperiods = range(date("D") , 30 );


         //Review of systems
        $ros_constitutional      = SystemReview::where('system','General')->where('description','Review of System')->get();
        $ros_skin                = SystemReview::where('system','Skin')->where('description','Review of System')->get();
        $ros_head       = SystemReview::where('system','Head')->where('description','Review of System')->get();
        $ros_throat       = SystemReview::where('system','Throat')->where('description','Review of System')->get();
        $ros_nose         = SystemReview::where('system','Nose')->where('description','Review of System')->get();
        $ros_ears         = SystemReview::where('system','Ears')->where('description','Review of System')->get();
        $ros_eyes         = SystemReview::where('system','Eyes')->where('description','Review of System')->get();
        $ros_respiratory       = SystemReview::where('system','Respiratory')->where('description','Review of System')->get();
        $ros_cardiovasular       = SystemReview::where('system','Cardiovascular')->where('description','Review of System')->get();
        $ros_gastro      = SystemReview::where('system','Gastrointestinal')->where('description','Review of System')->get();
        $ros_gynecology       = SystemReview::where('system','gynecologic')->where('description','Review of System')->get();
        $ros_genitourinary       = SystemReview::where('system','genitourinary')->where('description','Review of System')->get();
        $ros_endocrine      = SystemReview::where('system','Endocrine')->where('description','Review of System')->get();
        $ros_musculoskeletal       = SystemReview::where('system','Musculoskeletal')->where('description','Review of System')->get();
        $ros_peripheral_vascular       = SystemReview::where('system','Peripheral vascular')->where('description','Review of System')->get();
        $ros_hematology       = SystemReview::where('system','Hematology')->where('description','Review of System')->get();
        $ros_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->where('description','Review of System')->get();

        //Physical Exam
        $ros_constitutional      = SystemReview::where('system','General')->get();
        $pe_neck       = SystemReview::where('system','Neck')->get();
        $pe_head       = SystemReview::where('system','Head')->get();
        $ros_throat       = SystemReview::where('system','Throat')->get();
        $pe_nose         = SystemReview::where('system','Nose')->get();
        $pe_ears         = SystemReview::where('system','Ears')->get();
        $pe_eyes         = SystemReview::where('system','Eyes')->get();
        $ros_chest       = SystemReview::where('system','Respiratory')->get();
        $pe_heart       = SystemReview::where('system','Cardiovascular')->get();
        $pe_gastro      = SystemReview::where('system','Gastrointestinal')->get();
        $pe_gynecology       = SystemReview::where('system','Gynecologic')->get();
        $pe_genitourinary       = SystemReview::where('system','Genitourinary')->get();
        $pe_abdominal       = SystemReview::where('system','Abdominal')->get();
        $pe_pelvic       = SystemReview::where('system','Pelvic')->get();
        $pe_extremities       = SystemReview::where('system','Extremities')->get();
        $pe_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->get();

        $pastmedicalhx   = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $familyhx        = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $socialhx        = SocialFamilyHistory::where('category','Social')->orderBy('type', 'ASC')->get();
        $vacinnationhx   = SocialFamilyHistory::where('category','Vaccination')->orderBy('type', 'ASC')->get();
        $medicationhx    = SocialFamilyHistory::where('category','Medication')->orderBy('type', 'ASC')->get();
        $surgicalhx      = SocialFamilyHistory::where('category','Surgical')->orderBy('type', 'ASC')->get();
        $reproductivehx  = SocialFamilyHistory::where('category','Reproductive')->orderBy('type', 'ASC')->get();
        $allergichx      = SocialFamilyHistory::where('category','Allergy')->orderBy('type', 'ASC')->get();

        //Timeline
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('visitid' ,'=', $id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->get();

        //dd($visit_details->patient_id);

       //dd($eyefindings);
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
      

        return view('dentist.review', compact('patients','payables','receivables','outstanding','bills','payables','servicetype','pastmedicalhx','familyhx','allergichx','reproductivehx','surgicalhx','medicationhx','vacinnationhx','socialhx','tooths','mydiagnosis','myvitals','myhistories','mylabs','mydrugs','myros','mycomplaints','triage','complaintperiods','visit_details','ros_throat','ros_eyes','ros_ears','ros_nose','ros_skin','ros_head','ros_constitutional','ros_respiratory','ros_cardiovasular','ros_gastro','ros_gynecology','ros_genitourinary','ros_endocrine','ros_musculoskeletal','ros_peripheral_vascular','ros_hematology','ros_neuropsychiatric'))
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



    public function doantenatalReview($id)
    {   

       $visit_details  =   OPD::where('opd_number' ,'=', $id)->first();
        $patients        =   Customer::where('patient_id' ,'=', $visit_details->patient_id)->get();
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::where('accountnumber' ,'=', $visit_details->patient_id)->get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        $histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();

        $pastmedicalhx   = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $familyhx        = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $socialhx        = SocialFamilyHistory::where('category','Social')->orderBy('type', 'ASC')->get();
        $vacinnationhx        = SocialFamilyHistory::where('category','Vaccination')->orderBy('type', 'ASC')->get();
        $medicationhx        = SocialFamilyHistory::where('category','Medication')->orderBy('type', 'ASC')->get();
        $surgicalhx        = SocialFamilyHistory::where('category','Surgical')->orderBy('type', 'ASC')->get();
        $reproductivehx        = SocialFamilyHistory::where('category','Reproductive')->orderBy('type', 'ASC')->get();
        $allergichx        = SocialFamilyHistory::where('category','Allergy')->orderBy('type', 'ASC')->get();

        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $doctors          = Doctor::get();
        $triage           = PatientVitals::where('patient_id' ,'=', $visit_details->patient_id)->first();
        $complaintperiods = range( date("D") , 30 );
        $servicetype = ServiceCharge::where('type','like','%Follow up%')->orderby('type','asc')->get(); 
        
         $oldvisits  =   OPD::where('patient_id' ,'=', $visit_details->patient_id)->get();

         //Review of systems
        $ros_constitutional      = SystemReview::where('system','General')->where('description','Review of System')->get();
        $ros_skin                = SystemReview::where('system','Skin')->where('description','Review of System')->get();
        $ros_head       = SystemReview::where('system','Head')->where('description','Review of System')->get();
        $ros_throat       = SystemReview::where('system','Throat')->where('description','Review of System')->get();
        $ros_nose         = SystemReview::where('system','Nose')->where('description','Review of System')->get();
        $ros_ears         = SystemReview::where('system','Ears')->where('description','Review of System')->get();
        $ros_eyes         = SystemReview::where('system','Eyes')->where('description','Review of System')->get();
        $ros_respiratory       = SystemReview::where('system','Respiratory')->where('description','Review of System')->get();
        $ros_cardiovasular       = SystemReview::where('system','Cardiovascular')->where('description','Review of System')->get();
        $ros_gastro      = SystemReview::where('system','Gastrointestinal')->where('description','Review of System')->get();
        $ros_gynecology       = SystemReview::where('system','gynecologic')->where('description','Review of System')->get();
        $ros_genitourinary       = SystemReview::where('system','genitourinary')->where('description','Review of System')->get();
        $ros_endocrine      = SystemReview::where('system','Endocrine')->where('description','Review of System')->get();
        $ros_musculoskeletal       = SystemReview::where('system','Musculoskeletal')->where('description','Review of System')->get();
        $ros_peripheral_vascular       = SystemReview::where('system','Peripheral vascular')->where('description','Review of System')->get();
        $ros_hematology       = SystemReview::where('system','Hematology')->where('description','Review of System')->get();
        $ros_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->where('description','Review of System')->get();

        //Physical Exam
        $pe_constitutional     = SystemReview::where('system','General')->where('description','Physical Examination')->get();
        $pe_neck               = SystemReview::where('system','Neck')->where('description','Physical Examination')->get();
        $pe_HEENT              = SystemReview::where('system','Nose')->orwhere('system','Head')->orwhere('system','Eyes')->orwhere('system','Ears')->orwhere('system','Throat')->where('description','Physical Examination')->get();
        $pe_respiratory        = SystemReview::where('system','Respiratory')->where('description','Physical Examination')->get();
        $pe_heart              = SystemReview::where('system','Cardiovascular')->where('description','Physical Examination')->get();
        $pe_gastro             = SystemReview::where('system','Gastrointestinal')->where('description','Physical Examination')->get();
        $pe_gynecology         = SystemReview::where('system','Gynecologic')->where('description','Physical Examination')->get();
        $pe_musculoskeletal    = SystemReview::where('system','Musculoskeletal')->where('description','Physical Examination')->get();
        $pe_abdominal          = SystemReview::where('system','Abdominal')->where('description','Physical Examination')->get();
        $pe_psychological      = SystemReview::where('system','Psychological')->where('description','Physical Examination')->get();
        $pe_breast             = SystemReview::where('system','Breast')->where('description','Physical Examination')->get();
        $pe_extremities        = SystemReview::where('system','Extremities')->where('description','Physical Examination')->get();
        $pe_neuropsychiatric   = SystemReview::where('system','Neuropsychiatric')->where('description','Physical Examination')->get();
        $pe_breast   = SystemReview::where('system','Breast')->where('description','Physical Examination')->get();

        //pe_constitutional,pe_neck,pe_head,ros_throat

        //Timeline
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('visitid' ,'=', $id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mype = PatientPE::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
         $myplan = PatientAssessment::where('visit_id' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();
        

        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->get();
        $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();

        $gestationperiods = GestationDays::get();
        $presentations    = Presentation::get();
        $fetus            = Fetus::get();
        $lie              = GestationLie::get();
        $position         = GestationPostion::get();
       



        $bills              = Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
        $payables = 0;


        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       return view('antenatal.review', compact('mype','gestationperiods','myplan','oldvisits','pe_breast','presentations','fetus','position','lie','pe_constitutional','pe_heart','pe_neck','pe_psychological','pe_neuropsychiatric','pe_musculoskeletal','pe_extremities','pe_gynecology','pe_abdominal','pe_genitourinary','pe_gastro','pe_HEENT','pe_respiratory','patients','bills','payables','visittypes','servicetype','pastmedicalhx','familyhx','allergichx','reproductivehx','surgicalhx','medicationhx','vacinnationhx','socialhx','mydiagnosis','myvitals','myhistories','mylabs','mydrugs','myros','mycomplaints','triage','complaintperiods','visit_details','ros_throat','ros_eyes','ros_ears','ros_nose','ros_skin','ros_head','ros_constitutional','ros_respiratory','ros_cardiovasular','ros_gastro','ros_gynecology','ros_genitourinary','ros_endocrine','ros_musculoskeletal','ros_peripheral_vascular','ros_hematology','ros_neuropsychiatric'))
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



    public function addAntenatalRecords()
    {

            if(Input::get("presentation")){$presentation =  implode(", ", Input::get("presentation"));} else {$presentation = null;}
            if(Input::get("engagement")){$engagement =  implode(", ", Input::get("engagement"));} else {$engagement = null;}
            if(Input::get("position")){$position =  implode(", ", Input::get("position"));} else {$position = null;}
            if(Input::get("lie")){$lie =  implode(", ", Input::get("lie"));} else {$lie = null;}
            //if(Input::get("oedema")){$oedema =  implode(", ", Input::get("oedema"));} else {$oedema = null;}


           $record                      = new AntenatalChart;
           $record->visit_id            = Input::get("opd_number");
           $record->review_date         = Input::get("review_date");
           $record->gestation_by_date   = Input::get("gestation_by_date");
           $record->fetus               = Input::get("fetus");       
           $record->presentation        = $presentation;
           $record->engagement          = $engagement;
           $record->fh_fm               = Input::get("fh_fm");
           $record->position            = $position;
           $record->lie                 = $lie;
           $record->oedema              = Input::get("oedema");
           $record->urine_sugar         = Input::get("urine_sugar");       
           $record->urine_protein       = Input::get("urine_sugar"); 
           $record->edd                 = Input::get("edd"); 
           $record->bloodtype           = Input::get("bloodtype");
           $record->g6pd                = Input::get("g6pd"); 
           $record->tt                  = Input::get("tt"); 
           $record->sp                  = Input::get("sp");
           $record->fetal_heart_tone    = Input::get("fetal_heart_tone");




         
           $record->remarks             = Input::get("antenatal_remarks");
           $record->created_on          = Carbon::now();
           $record->created_by          = Auth::user()->getNameOrUsername();

            if($record->save())
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


    public function ophthalmology()
    {   

         $waiting   =   OPD::where('status','Checked-In')->where('consultation_type','like','%EYE%')->get();
        $reviewed  =   OPD::where('status','Review')->where('consultation_type','like','%EYE%')->get();
        $admission =   OPD::where('visit_type','Admission')->get();

        $today     = Carbon::now()->format('Y-m-d').'%';
        $patients  = OPD::where('consultation_type','like','%EYE%')->where('created_on', 'like', $today)->orderBy('created_on', 'DESC')->paginate(30);


        $complaintperiods = range( date("D") , 30 );
         return view('optometry.index', compact('patients','discharged','complaintperiods','waiting','reviewed','admission'));

        
    }

     public function ophthalmologyReviewed()
    {   

        //add code
    }

     public function doOphthalmologyReview($id)
    {   

        $visit_details    = OPD::where('opd_number' ,'=', $id)->first();
        $patients         = Customer::where('patient_id' ,'=', $visit_details->patient_id)->get();
        $tooth            = DentalCavity::get();
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::where('accountnumber' ,'=', $visit_details->patient_id)->get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','Eye')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','like','%eye%')->orderBy('type', 'ASC')->get();
        $histories        = SocialFamilyHistory::orderBy('type', 'ASC')->get();
        //$diagnosis        = Diagnosis::orderBy('category', 'ASC')->distinct()->get(['category']);
        $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $doctors          = Doctor::get();
        $triage           = PatientVitals::where('patient_id' ,'=', $visit_details->patient_id)->first();
        $complaintperiods = range( date("D") , 30 );


         //Review of systems
        $ros_constitutional      = SystemReview::where('system','General')->where('description','Review of System')->get();
        $ros_skin                = SystemReview::where('system','Skin')->where('description','Review of System')->get();
        $ros_head       = SystemReview::where('system','Head')->where('description','Review of System')->get();
        $ros_throat       = SystemReview::where('system','Throat')->where('description','Review of System')->get();
        $ros_nose         = SystemReview::where('system','Nose')->where('description','Review of System')->get();
        $ros_ears         = SystemReview::where('system','Ears')->where('description','Review of System')->get();
        $ros_eyes         = SystemReview::where('system','Eyes')->where('description','Review of System')->get();
        $ros_respiratory       = SystemReview::where('system','Respiratory')->where('description','Review of System')->get();
        $ros_cardiovasular       = SystemReview::where('system','Cardiovascular')->where('description','Review of System')->get();
        $ros_gastro      = SystemReview::where('system','Gastrointestinal')->where('description','Review of System')->get();
        $ros_gynecology       = SystemReview::where('system','gynecologic')->where('description','Review of System')->get();
        $ros_genitourinary       = SystemReview::where('system','genitourinary')->where('description','Review of System')->get();
        $ros_endocrine      = SystemReview::where('system','Endocrine')->where('description','Review of System')->get();
        $ros_musculoskeletal       = SystemReview::where('system','Musculoskeletal')->where('description','Review of System')->get();
        $ros_peripheral_vascular       = SystemReview::where('system','Peripheral vascular')->where('description','Review of System')->get();
        $ros_hematology       = SystemReview::where('system','Hematology')->where('description','Review of System')->get();
        $ros_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->where('description','Review of System')->get();

        //Physical Exam
        $ros_constitutional      = SystemReview::where('system','General')->get();
        $pe_neck       = SystemReview::where('system','Neck')->get();
        $pe_head       = SystemReview::where('system','Head')->get();
        $ros_throat       = SystemReview::where('system','Throat')->get();
        $pe_nose         = SystemReview::where('system','Nose')->get();
        $pe_ears         = SystemReview::where('system','Ears')->get();
        $pe_eyes         = SystemReview::where('system','Eyes')->get();
        $ros_chest       = SystemReview::where('system','Respiratory')->get();
        $pe_heart       = SystemReview::where('system','Cardiovascular')->get();
        $pe_gastro      = SystemReview::where('system','Gastrointestinal')->get();
        $pe_gynecology       = SystemReview::where('system','Gynecologic')->get();
        $pe_genitourinary       = SystemReview::where('system','Genitourinary')->get();
        $pe_abdominal       = SystemReview::where('system','Abdominal')->get();
        $pe_pelvic       = SystemReview::where('system','Pelvic')->get();
        $pe_extremities       = SystemReview::where('system','Extremities')->get();
        $pe_neuropsychiatric       = SystemReview::where('system','Neuropsychiatric')->get();

        $pastmedicalhx   = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $familyhx        = SocialFamilyHistory::where('category','Past Medical')->orderBy('type', 'ASC')->get();
        $socialhx        = SocialFamilyHistory::where('category','Social')->orderBy('type', 'ASC')->get();
        $vacinnationhx   = SocialFamilyHistory::where('category','Vaccination')->orderBy('type', 'ASC')->get();
        $medicationhx    = SocialFamilyHistory::where('category','Medication')->orderBy('type', 'ASC')->get();
        $surgicalhx      = SocialFamilyHistory::where('category','Surgical')->orderBy('type', 'ASC')->get();
        $reproductivehx  = SocialFamilyHistory::where('category','Reproductive')->orderBy('type', 'ASC')->get();
        $allergichx      = SocialFamilyHistory::where('category','Allergy')->orderBy('type', 'ASC')->get();

        //Timeline
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('visitid' ,'=', $id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->get();

        $lenstypes      = LensTypes::get();
        $lenstreatments = LensTreatment::get();

        $eyefindings = EyeExamination::where('visit_id',$id)->first();
        $ocularfindings = OcularExamination::where('visit_id',$id)->first();

        //dd($eyefindings);
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

      

        return view('optometry.review', compact('patients','outstanding','payables','receivables','eyefindings','ocularfindings','bills','payables','servicetype','pastmedicalhx','familyhx','allergichx','reproductivehx','surgicalhx','medicationhx','vacinnationhx','socialhx','tooth','mydiagnosis','myvitals','myhistories','mylabs','mydrugs','myros','mycomplaints','triage','complaintperiods','visit_details','ros_throat','ros_eyes','ros_ears','ros_nose','ros_skin','ros_head','ros_constitutional','ros_respiratory','ros_cardiovasular','ros_gastro','ros_gynecology','ros_genitourinary','ros_endocrine','ros_musculoskeletal','ros_peripheral_vascular','ros_hematology','ros_neuropsychiatric'))
        ->with('diagnosis',$diagnosis)
        ->with('treatments',$treatments)
        ->with('drugs',$drugs)
        ->with('dosage',$dosage)
        ->with('lenstreatments',$lenstreatments)
        ->with('lenstypes',$lenstypes)
        ->with('periods',$periods)
        ->with('images',$images)
        ->with('complaints',$complaints)
        ->with('investigations',$investigations)
        ->with('frequency',$frequency)
        ->with('histories',$histories)
        ->with('application',$application);
    }


public function laboratory()
    {   
        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        $histories       = SocialFamilyHistory::orderBy('type', 'ASC')->get();
        //$diagnosis        = Diagnosis::orderBy('category', 'ASC')->distinct()->get(['category']);
         $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $departments      = Department::get();
        $doctors          = Doctor::get();
        //$labs            = OPD::where('status','Checked-In')->where('department','=','Laboratory')->get();
        $patients         = OPD::where('status','Checked-In')->where('department','=','Laboratory')->orderBy('created_on', 'DESC')->paginate(30);
        $complaintperiods = range( date("D") , 30 );


       return view('doctor.opd', compact('patients','complaintperiods','labs'))
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
        ->with('application',$application)
        ->with('departments',$departments);


    }


       public function ipd()
    {
        $waiting  =    OPD::where('status','Checked-In')->get();
        $reviewed =    OPD::where('status','Review')->get();
        $admission =    OPD::where('visit_type','Admission')->get();
        $discharged =    OPD::where('status','Discharged')->get();

        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        //$diagnosis        = Diagnosis::orderBy('type', 'ASC')->limit(1000)->get();
         $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $departments      = Department::get();
        $doctors          = Doctor::get();
        $patients         =  OPD::where('visit_type','Admission')->orderBy('created_on', 'DESC')->paginate(30);
       return view('doctor.ipd', compact('patients','discharged','waiting','reviewed','admission'))
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
        ->with('application',$application)
        ->with('departments',$departments);

    }

   

   public function getPendingReview()
   {
        $company = Company::get()->first();
        $patients = Customer::get();
         
        $investigations = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $today =        Carbon::now()->format('Y-m-d').'%';
        $myrequests = DB::table('patient_investigation')
                     ->select(DB::raw('uuid,patientid,patient_name,GROUP_CONCAT(investigation) as investigation,visitid,created_by,created_on,status,type'))
                     ->where('created_by',Auth::user()->getNameOrUsername())
                     ->where('type','Laboratory')
                     ->groupBy('visitid')
                     ->orderBy('created_on','desc')
                    ->paginate(30);

        // $myrequests = PatientInvestigation::where('type','Laboratory')->orderby('created_on','desc')->groupby('visitid')->paginate(10);

         return view('doctor.investigation',compact('myrequests','investigations','patients','company'));
   }

    public function getDischarged()
   {
        $waiting  =    OPD::where('status','Checked-In')->get();
        $reviewed =    OPD::where('status','Review')->get();
        $admission =    OPD::where('visit_type','Admission')->get();
        $discharged =    OPD::where('status','Discharged')->get();

        $periods          = DrugPeriod::orderBy('type', 'ASC')->get();
        $images           = Images::get();
        $investigations   = ServiceCharge::where('department','Laboratory')->orwhere('department','Radiology')->orderBy('type', 'ASC')->get();
        $complaints       = Complaint::where('speciality','General')->orderBy('type', 'ASC')->get();
        $application      = DrugApplication::get();
        $frequency        = DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage           = DrugDosage::orderBy('type', 'ASC')->get();
        $drugs            = Drug::orderBy('name', 'ASC')->get();
        $treatments       = Treatment::where('department','procedures')->orderBy('type', 'ASC')->get();
        $histories       = SocialFamilyHistory::orderBy('type', 'ASC')->get();
        //$diagnosis        = Diagnosis::orderBy('category', 'ASC')->distinct()->get(['category']);
         $diagnosis        = Diagnosis::orderBy('type', 'ASC')->get();
        $departments      = Department::get();
        $doctors          = Doctor::get();
        $patients         = OPD::where('status','Discharged')->orderBy('created_on', 'DESC')->paginate(30);
        $complaintperiods = range( date("D") , 30 );
       return view('doctor.opd', compact('patients','discharged','complaintperiods','waiting','reviewed','admission'))
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
        ->with('application',$application)
        ->with('departments',$departments);
   }

 


    public function addMedication()
    {     
            $drug =  Drug::where('id',Input::get("medication"))->first();
            $diagnosis   =  PatientDiagnosis::where('visitid',Input::get("opd_number"))->first();
            $transactionid = uniqid(20);


            //dd()

            $getpatientstatus = OPD::where('opd_number',Input::get("opd_number"))->first();
            
            $margin = 1;
            $walkinmargin = 1.45;
            $insurancemargin = 1.50;

            $walkinmargin = $drug->walk_margin;
            $insurancemargin = $drug->insurance_margin;

            if ($getpatientstatus->payercode == 'Private') 
            {
                $margin = $walkinmargin;
            }
            else
            {

                $margin = $insurancemargin;
            }

             if($diagnosis)
            {  
                 $mydiagnosis = $diagnosis->diagnosis;
            }
            {
                 $mydiagnosis = 'No Diagnosis';
            }
           


           $prescription              = new Prescription;
           $prescription->patientid   = Input::get("patient_id");
           $prescription->visitid     = Input::get("opd_number");
           $prescription->expiry_date = Carbon::now()->addDays(7);
           $prescription->drug_name   = $drug->name;
           $prescription->source      = $drug->supplier;
           $prescription->drug_cost   = $drug->unit_price * $margin;
           $prescription->drug_ini_cost   = $drug->unit_price;
           $prescription->drug_quantity    = 0;
           $prescription->drug_dosage      = Input::get("drug_dosage");
           $prescription->drug_application = Input::get("drug_application").' for '.Input::get("drug_quantity").' days';
           $prescription->drug_frequency   = Input::get("drug_frequency");
           $prescription->drug_days   = Input::get("drug_days");
           $prescription->drug_span   = Input::get("drug_span");
           $prescription->refills     = 1;
           $prescription->created_on  = Carbon::now();
           $prescription->created_by  = Auth::user()->getNameOrUsername();
           $prescription->patient_name= Input::get("fullname");
           $prescription->diagnosis = $mydiagnosis;
           $prescription->uuid = $transactionid;
          

            if($prescription->save())
            {

           $bill                    = new Bill;
           $bill->patient_id        = Input::get("patient_id");
           $bill->visit_id          = Input::get("opd_number");
           $bill->fullname          = Input::get("fullname");
           $bill->item_name         = $drug->name;
           $bill->quantity          = 0;
           $bill->rate              = $drug->unit_price * $margin;
           $bill->amount            = $drug->unit_price * $margin;
           $bill->note              = 'Unpaid';
           $bill->category          = 'Pharmacy';
           $bill->uuid              = $transactionid;
           $bill->copayer           = $getpatientstatus->care_provider;
           $bill->payercode         = $getpatientstatus->payercode;
           $bill->created_by        = Auth::user()->getNameOrUsername();
           $bill->date              = Carbon::now();
           $bill->save(); 
              
            OneSignal::sendNotificationToUser($drug->name."(Medication) has been requested from ".Auth::user()->getNameOrUsername(), 'a8b5a446-3f6d-4e1d-8397-a0a24c521a85', $url = null, $data = null, $buttons = null, $schedule = null);
            OneSignal::sendNotificationToUser($drug->name."(Medication) has been requested from ".Auth::user()->getNameOrUsername(), '32c9a576-9e3d-45cf-ada8-16559b181477', $url = null, $data = null, $buttons = null, $schedule = null);

                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }


    public function addMedicationNoStock()
    {     
           $transactionid = uniqid(20);
           $prescription              = new Prescription;
           $prescription->patientid   = Input::get("patient_id");
           $prescription->visitid     = Input::get("opd_number");
           $prescription->expiry_date = Carbon::now()->addDays(7);
           $prescription->drug_name   = Input::get("medication");
           $prescription->drug_application = Input::get("drug_application").' for '.Input::get("drug_quantity").' days';
           $prescription->drug_quantity   = 1;
           $prescription->drug_cost   = 0;
           $prescription->created_on  = Carbon::now();
           $prescription->created_by  = Auth::user()->getNameOrUsername();
           $prescription->patient_name= Input::get("fullname");
            $prescription->uuid = $transactionid;
            

            if($prescription->save())
            {

           // $bill                    = new Bill;
           // $bill->patient_id        = Input::get("patient_id");
           // $bill->visit_id          = Input::get("opd_number");
           // $bill->fullname          = Input::get("fullname");
           // $bill->item_name         = $drug->name;
           // $bill->quantity          = 0;
           // $bill->rate              = $drug->unit_price * $margin;
           // $bill->amount            = $drug->unit_price * $margin;
           // $bill->note              = 'Unpaid';
           // $bill->category          = 'Pharmacy';
           // $bill->uuid              = $transactionid;
           // $bill->created_by        = Auth::user()->getNameOrUsername();
           // $bill->date              = Carbon::now();
           // $bill->save(); 

                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }


public function generateStaffID()
{
    $number = Serial::where('name','=','visit')->first();
    $number = $number->counter;
    $account = str_pad($number,5, '0', STR_PAD_LEFT);
    $myaccount= 'V'.$account;
    Serial::where('name','=','visit')->increment('counter',1);
    return  $myaccount;
}

    private function addWalkInService()
    {

          $servicecharge = ServiceCharge::where('type',Input::get("investigation"))->value('walkin');
         
            if(Input::get("opd_number")== "")
            {
                $visit_id = $this->generateStaffID(10);
            }    
          
          $getpatientstatus = OPD::where('opd_number',Input::get("opd_number"))->first();

            $patient = Input::get("fullname");
            $insurance = 'Not Assigned';
            $transactionid = uniqid(20);
          //dd($patient);

           $investigation                  = new PatientInvestigation;
           $investigation->patientid       = Input::get("patient_id");
           $investigation->visitid         = Input::get("opd_number");
           $investigation->investigation   = Input::get("investigation");
           $investigation->remark          = Input::get("remark");
           $investigation->cost            = $servicecharge;
           $investigation->is_billable     = 1;
           $investigation->patient_name     = $patient;
           $investigation->insurance_scheme = $patient->insurance_company;
           $investigation->created_on      = Carbon::now();
           $investigation->created_by      = Auth::user()->getNameOrUsername();
            $investigation->uuid           = $transactionid;

            

            if($investigation->save())
            {

           $bill                    = new Bill;
           $bill->patient_id        = Input::get("patient_id");
           $bill->visit_id          = Input::get("opd_number");
           $bill->fullname          = Input::get("fullname");
           $bill->item_name         = Input::get("investigation");
           $bill->quantity          = 1;
           $bill->rate              = $servicecharge;
           $bill->amount            = $servicecharge;
           $bill->note              = 'Unpaid';
           $bill->category          = 'Laboratory';
           $bill->copayer           = $getpatientstatus->care_provider;
           $bill->payercode         = $getpatientstatus->payercode;
           $bill->created_by        = Auth::user()->getNameOrUsername();
           $bill->date              = Carbon::now();
           $bill->uuid              = $transactionid;
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




    public function addInvestigation()
    {     
             $getpatientstatus = OPD::where('opd_number',Input::get("opd_number"))->first();

            switch(Input::get('accounttype')) 
            {
         
        case 'Health Insurance':
                    if($getpatientstatus->care_provider=='Glico Health Care')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('glico');
                         
                       }

                    elseif($getpatientstatus->care_provider=='Cosmopolitan Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('cosmopolitan');
                         
                       }

                     elseif($getpatientstatus->care_provider=='Premier Mutual Health')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('premier');
                       }


                     elseif($getpatientstatus->care_provider=='Acacia Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('acacia');
                       }


                     elseif($getpatientstatus->care_provider=='Apex Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('apex');
                       }



                     elseif($getpatientstatus->care_provider=='Metropolitan Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('metropolitan');
                       }

                       else
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('insurance');
                          
                       }
            break;
        case 'Corporate':
             $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('corporate');
            break;
        case 'Private':
             $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('walkin');
            break;
        case 'Non-Ghanaian':
             $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('charge');
            break;
           }
          
          $getpatientstatus = OPD::where('opd_number',Input::get("opd_number"))->first();

          $patient                         = Customer::where('patient_id',Input::get("patient_id"))->first();
          $investigationtype               = ServiceCharge::where('type',Input::get("investigation"))->value('department');  
          $transactionid                   = uniqid(20);
         

           $investigation                  = new PatientInvestigation;
           $investigation->patientid       = Input::get("patient_id");
           $investigation->visitid         = Input::get("opd_number");
           $investigation->investigation   = Input::get("investigation");
           $investigation->remark          = Input::get("remark");
           $investigation->cost            = $investigation_amount;
           $investigation->is_billable     = 1;
           $investigation->patient_name     = Input::get("fullname");
           $investigation->insurance_scheme = $patient->insurance_company;
           $investigation->created_on      = Carbon::now();
           $investigation->created_by      = Auth::user()->getNameOrUsername();
           $investigation->uuid            = $transactionid;
           $investigation->type            = $investigationtype;
            

            if($investigation->save())
            {

             

           $bill                    = new Bill;
           $bill->patient_id        = Input::get("patient_id");
           $bill->visit_id          = Input::get("opd_number");
           $bill->fullname          = Input::get("fullname");
           $bill->item_name         = Input::get("investigation");
           $bill->quantity          = 1;
           $bill->rate              = $investigation_amount;
           $bill->amount            = $investigation_amount;
           $bill->note              = 'Unpaid';
           $bill->category          =  $investigationtype;   
           $bill->copayer           = $getpatientstatus->care_provider;
           $bill->payercode         = $getpatientstatus->payercode;
           $bill->created_by        = Auth::user()->getNameOrUsername();
           $bill->date              = Carbon::now();
           $bill->uuid              = $transactionid;
           $bill->save(); 

           if($investigationtype == 'Laboratory')
           {
            OneSignal::sendNotificationToUser(Input::get("investigation")."(Lab) has been requested from ".Auth::user()->getNameOrUsername(), 'a6558cdc-8eae-45f8-8f61-101736d29262', $url = null, $data = null, $buttons = null, $schedule = null);
           }
           else
           {
            OneSignal::sendNotificationToUser(Input::get("investigation")."(Radiology) has been requested from ".Auth::user()->getNameOrUsername(), '5697df5c-bdf6-40c0-adf7-df0ddc9f3b39', $url = null, $data = null, $buttons = null, $schedule = null);
           }
            
              
                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }

    public function addInvestigationWalkin()
    {     
             $getpatientstatus = OPD::where('opd_number',Input::get("opd_number"))->first();

            switch(Input::get('accounttype')) 
            {
         
        case 'Health Insurance':
               if($getpatientstatus->care_provider=='Glico Health Care')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('glico');
                         
                       }

                    elseif($getpatientstatus->care_provider=='Cosmopolitan Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('cosmopolitan');
                         
                       }

                     elseif($getpatientstatus->care_provider=='Premier Mutual Health')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('premier');
                       }

                       elseif($getpatientstatus->care_provider=='Acacia Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('acacia');
                       }


                     elseif($getpatientstatus->care_provider=='Apex Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('apex');
                       }



                     elseif($getpatientstatus->care_provider=='Metropolitan Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('metropolitan');
                       }

                       else
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('insurance');
                          
                       }
            break;
        case 'Corporate':
             $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('corporate');
            break;
        case 'Private':
             $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('walkin');
            break;
        case 'Non-Ghanaian':
             $investigation_amount = ServiceCharge::where('type',Input::get("investigation"))->value('charge');
            break;
           }
          
          $getpatientstatus = OPD::where('opd_number',Input::get("opd_number"))->first();

          $patient                         = Customer::where('patient_id','W0820170000')->first();
          $investigationtype               = ServiceCharge::where('type',Input::get("investigation"))->value('department');  
          $transactionid                   = uniqid(20);
         

           $investigation                  = new PatientInvestigation;
           $investigation->patientid       = Input::get("patient_id");
           $investigation->visitid         = Input::get("opd_number");
           $investigation->investigation   = Input::get("investigation");
           $investigation->remark          = Input::get("remark");
           $investigation->cost            = $investigation_amount;
           $investigation->is_billable     = 1;
           $investigation->patient_name     = Input::get("fullname");
           $investigation->insurance_scheme = $patient->insurance_company;
           $investigation->created_on      = Carbon::now();
           $investigation->created_by      = Auth::user()->getNameOrUsername();
           $investigation->uuid            = $transactionid;
           $investigation->type            = $investigationtype;
            

            if($investigation->save())
            {

             

           $bill                    = new Bill;
           $bill->patient_id        = Input::get("patient_id");
           $bill->visit_id          = Input::get("opd_number");
           $bill->fullname          = Input::get("fullname");
           $bill->item_name         = Input::get("investigation");
           $bill->quantity          = 1;
           $bill->rate              = $investigation_amount;
           $bill->amount            = $investigation_amount;
           $bill->note              = 'Unpaid';
           $bill->category          =  $investigationtype;   
           $bill->copayer           = $getpatientstatus->care_provider;
           $bill->payercode         = $getpatientstatus->payercode;
           $bill->created_by        = Auth::user()->getNameOrUsername();
           $bill->date              = Carbon::now();
           $bill->uuid              = $transactionid;
           $bill->save(); 

           if($investigationtype == 'Laboratory')
           {
            OneSignal::sendNotificationToUser(Input::get("investigation")."(Lab) has been requested from ".Auth::user()->getNameOrUsername(), 'a6558cdc-8eae-45f8-8f61-101736d29262', $url = null, $data = null, $buttons = null, $schedule = null);
           }
           else
           {
            OneSignal::sendNotificationToUser(Input::get("investigation")."(Radiology) has been requested from ".Auth::user()->getNameOrUsername(), '5697df5c-bdf6-40c0-adf7-df0ddc9f3b39', $url = null, $data = null, $buttons = null, $schedule = null);
           }
            
              
                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }


    public function addProcedureNurse()
    {     
         

            $category           = ServiceCharge::where('type',Input::get("procedure"))->value('department');
             $transactionid     = uniqid(20);
             $getpatientstatus = OPD::where('opd_number',Input::get("opd_number"))->first();


            switch(Input::get('accounttype')) 
            {
         
        case 'Health Insurance':
              if($getpatientstatus->care_provider=='Glico Health Care')
                       {
                         $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('glico');
                         
                       }

                    elseif($getpatientstatus->care_provider=='Cosmopolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('cosmopolitan');
                         
                       }

                     elseif($getpatientstatus->care_provider=='Premier Mutual Health')
                       {
                         $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('premier');
                         
                       }

                       elseif($getpatientstatus->care_provider=='Acacia Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("procedure"))->value('acacia');
                       }


                     elseif($getpatientstatus->care_provider=='Apex Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("procedure"))->value('apex');
                       }

                     elseif($getpatientstatus->care_provider=='Metropolitan Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("procedure"))->value('metropolitan');
                       }

                       else
                       {
                         $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('insurance');
                          
                       }
            break;
        case 'Corporate':
             $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('corporate');
            break;
        case 'Private':
             $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('walkin');
            break;
        case 'Non-Ghanaian':
             $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('charge');
            break;
           }

           $quantity = Input::get("procedure_quanity");


           $procedures                  = new PatientProcedure;
           $procedures->patientid       = Input::get("patient_id");
           $procedures->visitid         = Input::get("opd_number");
           $procedures->procedure       = Input::get("procedure");
           $procedures->remark_2        = Input::get("tooth");
           $procedures->remark          = Input::get("remark");
           $procedures->cost            = $service_charge * $quantity;
           $procedures->is_billable     = 1;
           $procedures->created_on      = Carbon::now();
           $procedures->created_by      = Auth::user()->getNameOrUsername();
           $procedures->uuid            = $transactionid;

            

            if($procedures->save())
            {

           $bill                    = new Bill;
           $bill->patient_id        = Input::get("patient_id");
           $bill->visit_id          = Input::get("opd_number");
           $bill->fullname          = Input::get("fullname");
           $bill->item_name         = Input::get("procedure");
           $bill->quantity          = Input::get("procedure_quanity");
           $bill->rate              = $service_charge;
           $bill->amount            = $service_charge;
           $bill->category          = $category;
           $bill->note              = 'Unpaid';
            $bill->copayer           = $getpatientstatus->care_provider;
           $bill->payercode         = $getpatientstatus->payercode;
           $bill->created_by        = Auth::user()->getNameOrUsername();
           $bill->date              = Carbon::now();
           $bill->uuid              =  $transactionid;
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
    public function addProcedure()
    {     
         

            $category           = ServiceCharge::where('type',Input::get("procedure"))->value('department');
             $transactionid     = uniqid(20);

             $getpatientstatus = OPD::where('opd_number',Input::get("opd_number"))->first();

            switch(Input::get('accounttype')) 
            {
         
        case 'Health Insurance':
              if($getpatientstatus->care_provider=='Glico Health Care')
                       {
                         $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('glico');
                         
                       }

                    elseif($getpatientstatus->care_provider=='Cosmopolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('cosmopolitan');
                         
                       }

                     elseif($getpatientstatus->care_provider=='Premier Mutual Health')
                       {
                         $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('premier');
                         
                       }

                       elseif($getpatientstatus->care_provider=='Acacia Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("procedure"))->value('acacia');
                       }

                     elseif($getpatientstatus->care_provider=='Apex Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("procedure"))->value('apex');
                       }

                     elseif($getpatientstatus->care_provider=='Metropolitan Health Insurance')
                       {
                         $investigation_amount = ServiceCharge::where('type',Input::get("procedure"))->value('metropolitan');
                       }

                       else
                       {
                         $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('insurance');
                          
                       }
            break;
        case 'Corporate':
             $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('corporate');
            break;
        case 'Private':
             $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('walkin');
            break;
        case 'Non-Ghanaian':
             $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('charge');
            break;
           }

          //$quantity = Input::get("procedure_quanity");

            if(Input::get("tooth")){$tooth =  implode(", ", Input::get("tooth"));} else {$tooth = null;}


           $procedures                  = new PatientProcedure;
           $procedures->patientid       = Input::get("patient_id");
           $procedures->visitid         = Input::get("opd_number");
           $procedures->procedure       = Input::get("procedure");
           $procedures->remark_2        = $tooth;
           $procedures->remark          = Input::get("remark");
           $procedures->cost            = $service_charge;
           $procedures->is_billable     = Input::get("quantity");
           $procedures->created_on      = Carbon::now();
           $procedures->created_by      = Auth::user()->getNameOrUsername();
           $procedures->uuid            = $transactionid;

            

            if($procedures->save())
            {

           $bill                    = new Bill;
           $bill->patient_id        = Input::get("patient_id");
           $bill->visit_id          = Input::get("opd_number");
           $bill->fullname          = Input::get("fullname");
           $bill->item_name         = Input::get("procedure");
           $bill->quantity          = Input::get("quantity");
           $bill->rate              = $service_charge;
           $bill->amount            = $service_charge;
           $bill->category          = $category;
           $bill->note              = 'Unpaid';
            $bill->copayer           = $getpatientstatus->care_provider;
           $bill->payercode         = $getpatientstatus->payercode;
           $bill->created_by        = Auth::user()->getNameOrUsername();
           $bill->date              = Carbon::now();
           $bill->uuid              =  $transactionid;
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

    public function addFutureProcedure()
    {     
         
         if(Input::get("tooth")){$tooth =  implode(", ", Input::get("tooth"));} else {$tooth = null;}
           
             $transactionid     = uniqid(20);
            switch(Input::get('accounttype')) 
            {
         
        case 'Health Insurance':
              $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('insurance');
            break;
        case 'Corporate':
             $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('corporate');
            break;
        case 'Private':
             $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('walkin');
            break;
        case 'Non-Ghanaian':
             $service_charge = ServiceCharge::where('type',Input::get("procedure"))->value('charge');
            break;
           }

           //$getpatientstatus = OPD::where('opd_number',Input::get("opd_number"))->first();


           $procedures                  = new PatientFurtherPlan;
           $procedures->patientid       = Input::get("patient_id");
           $procedures->visitid         = Input::get("opd_number");
           $procedures->procedure       = Input::get("procedure");
           $procedures->remark_2        = $tooth;
           $procedures->remark          = $tooth;
           $procedures->procedure_quantity  = Input::get("procedure_quantity");
           $procedures->cost            = $service_charge;
           $procedures->is_billable     = 1;
           $procedures->created_on      = Carbon::now();
           $procedures->created_by      = Auth::user()->getNameOrUsername();
           $procedures->uuid            = $transactionid;

            

            if($procedures->save())
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


    public function addDiagnosis()
    {     
          if(Input::get("diagnosis")){$mydiagnosis =  implode(", ", Input::get("diagnosis"));} else {$mydiagnosis = null;}

           $diagnosis                  = new PatientDiagnosis;
           $diagnosis->visitid         = Input::get("opd_number");
           $diagnosis->diagnosis       = $mydiagnosis;
           $diagnosis->date            = Carbon::now();
           $diagnosis->created_by      = Auth::user()->getNameOrUsername();


            

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

    public function addDiagnosisICD()
    {     
          
           $diagnosis                  = new PatientDiagnosis;
           $diagnosis->visitid         = Input::get("opd_number");
           $diagnosis->diagnosis       = Input::get("diagnosis");
           $diagnosis->date            = Carbon::now();
           $diagnosis->created_by      = Auth::user()->getNameOrUsername();


            

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


    public function addFluids()
    {     
         
           $fluids                 = new PatientFluids;
           $fluids->patient_id     = Input::get("patient_id");
           $fluids->visit_id       = Input::get("opd_number");
           $fluids->ivf            = Input::get("ivf");
           $fluids->oral           = Input::get("oral");
           $fluids->urine           = Input::get("urine");
           $fluids->ngt             = Input::get("ngt");
           $fluids->vomit_drains    = Input::get("drains");
           $fluids->remarks         = Input::get("remarks");
           $fluids->fluid_time   = Carbon::createFromFormat('d/m/Y H:i:s', Input::get('fluid_time'));
           $fluids->created_by      = Auth::user()->getNameOrUsername();
           $fluids->created_on      = Carbon::now();


            

            if($fluids->save())
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


     public function addEyeFinding()
    {     

           if(Input::get("lens_treatment")){$treatment =  implode(", ", Input::get("lens_treatment"));} else {$treatment = null;}
           if(Input::get("lens_style")){$lens_style =  implode(", ", Input::get("lens_style"));} else {$lens_style = null;}
           if(Input::get("lens_color")){$lens_color =  implode(", ", Input::get("lens_color"));} else {$lens_color = null;}

           if(Input::get("lens_power")){$lens_power = implode(", ", Input::get("lens_power"));} else {$lens_power = null;}
           if(Input::get("rim_type")){$rim_type =  implode(", ", Input::get("rim_type"));} else {$rim_type = null;}
           if(Input::get("lens_index")){$lens_index =  implode(", ", Input::get("lens_index"));} else {$lens_index = null;}
           if(Input::get("lens_type")){$lens_type =  implode(", ", Input::get("lens_type"));} else {$lens_type = null;}

         
           $refraction              = new EyeExamination;
           $refraction->visit_id    = Input::get("opd_number");
           $refraction->patient_id    = Input::get("patient_id");
           $refraction->examination_type = Input::get("examination_type");
           
           $refraction->od_sphere   = Input::get("od_sphere");
           $refraction->od_cylinder = Input::get("od_cylinder");
           $refraction->od_axis    = Input::get("od_axis");
          
           $refraction->od_h_prism = Input::get("od_h_prism");
           $refraction->od_v_prism = Input::get("od_v_prism");

           $refraction->od_h_add   = Input::get("od_h_add");
           $refraction->od_v_add   = Input::get("od_v_add");
           
           $refraction->od_h_pd    = Input::get("od_h_pd");
           $refraction->od_v_pd    = Input::get("od_v_pd");

           $refraction->os_sphere   = Input::get("os_sphere");
           $refraction->os_cylinder = Input::get("os_cylinder");
           $refraction->os_axis     = Input::get("os_axis");

           $refraction->os_h_prism  = Input::get("os_h_prism");
           $refraction->os_v_prism  = Input::get("os_v_prism");

           $refraction->os_h_add    = Input::get("os_h_add");
           $refraction->os_v_add    = Input::get("os_v_add");

           $refraction->os_h_pd     = Input::get("os_h_pd");
           $refraction->os_v_pd     = Input::get("os_v_pd");

           $refraction->vr_visual_ascuity = Input::get("vr_visual_ascuity");
           $refraction->vl_visual_ascuity = Input::get("vl_visual_ascuity");

           $refraction->od_sphere_auto   = Input::get("od_sphere_auto");
           $refraction->od_cylinder_auto = Input::get("od_cylinder_auto");

           $refraction->od_axis_auto     = Input::get("od_axis_auto");
           $refraction->od_h_prism_auto  = Input::get("od_h_prism_auto");

           $refraction->os_h_prism_auto  = Input::get("os_h_prism_auto");
           $refraction->os_sphere_auto   = Input::get("os_sphere_auto");

           $refraction->os_cylinder_auto = Input::get("os_cylinder_auto");
           $refraction->os_axis_auto     = Input::get("os_axis_auto");

           $refraction->os_conjunctiva_sclera = Input::get("os_conjunctiva_sclera");
           $refraction->od_conjunctiva_sclera = Input::get("od_conjunctiva_sclera");

            $refraction->remarks        = Input::get("lens_remark");
            $refraction->lens_power     = $lens_power;
            $refraction->rim_type       = $rim_type;
            $refraction->lens_index     = $lens_index;
            $refraction->color          = $lens_color;
            $refraction->lens_type      = $lens_type;
            $refraction->style          = $lens_style;
            $refraction->lens_treatment = $treatment;
     
        
           $refraction->created_by      = Auth::user()->getNameOrUsername();
           $refraction->created_on      = Carbon::now();

           EyeExamination::where('visit_id',  Input::get("opd_number"))->delete();


            if($refraction->save())
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


 public function addOcularFinding()
    {     

            if(Input::get("od_ocular_adnexae")){$od_ocular_adnexae =  implode(", ", Input::get("od_ocular_adnexae"));} else {$od_ocular_adnexae = null;}
            if(Input::get("os_ocular_adnexae")){$os_ocular_adnexae =  implode(", ", Input::get("os_ocular_adnexae"));} else {$os_ocular_adnexae = null;}
            if(Input::get("od_cornea")){$od_cornea =  implode(", ", Input::get("od_cornea"));} else {$od_cornea = null;}
            if(Input::get("os_cornea")){$os_cornea =  implode(", ", Input::get("os_cornea"));} else {$os_cornea = null;}
            if(Input::get("od_pupil_lens")){$od_pupil_lens =  implode(", ", Input::get("od_pupil_lens"));} else {$od_pupil_lens = null;}
            if(Input::get("os_pupil_lens")){$os_pupil_lens =  implode(", ", Input::get("os_pupil_lens"));} else {$os_pupil_lens = null;}
            if(Input::get("os_virteous")){$os_virteous =  implode(", ", Input::get("os_virteous"));} else {$os_virteous = null;}
            if(Input::get("od_virteous")){$od_virteous =  implode(", ", Input::get("od_virteous"));} else {$od_virteous = null;}
            if(Input::get("od_c_d_ratio")){$od_c_d_ratio =  implode(", ", Input::get("od_c_d_ratio"));} else {$od_c_d_ratio = null;}
            if(Input::get("os_c_d_ratio")){$os_c_d_ratio =  implode(", ", Input::get("os_c_d_ratio"));} else {$os_c_d_ratio = null;}
            if(Input::get("od_retina")){$od_retina =  implode(", ", Input::get("od_retina"));} else {$od_retina = null;}
            if(Input::get("os_retina")){$os_retina =  implode(", ", Input::get("os_retina"));} else {$os_retina = null;}
            if(Input::get("od_others")){$od_others =  implode(", ", Input::get("od_others"));} else {$od_others = null;}
            if(Input::get("os_others")){$os_others =  implode(", ", Input::get("os_others"));} else {$os_others = null;}
            if(Input::get("od_ac_lens")){$od_ac_lens =  implode(", ", Input::get("od_ac_lens"));} else {$od_ac_lens = null;}
            if(Input::get("os_ac_lens")){$os_ac_lens =  implode(", ", Input::get("os_ac_lens"));} else {$os_ac_lens = null;}
            if(Input::get("od_ocular_lens")){$od_ocular_lens =  implode(", ", Input::get("od_ocular_lens"));} else {$od_ocular_lens = null;}
            if(Input::get("os_ocular_lens")){$os_ocular_lens =  implode(", ", Input::get("os_ocular_lens"));} else {$os_ocular_lens = null;}
            if(Input::get("od_iop")){$od_iop =  implode(", ", Input::get("od_iop"));} else {$od_iop = null;}
            if(Input::get("os_iop")){$os_iop =  implode(", ", Input::get("os_iop"));} else {$os_iop = null;}

            if(Input::get("od_visual_ascuity")){$od_visual_ascuity =  implode(", ", Input::get("od_visual_ascuity"));} else {$od_visual_ascuity = null;}
            if(Input::get("os_visual_ascuity")){$os_visual_ascuity =  implode(", ", Input::get("os_visual_ascuity"));} else {$os_visual_ascuity = null;}

            if(Input::get("os_conjunctiva_sclera")){$os_conjunctiva_sclera =  implode(", ", Input::get("os_conjunctiva_sclera"));} else {$os_conjunctiva_sclera = null;}
            if(Input::get("od_conjunctiva_sclera")){$od_conjunctiva_sclera =  implode(", ", Input::get("od_conjunctiva_sclera"));} else {$od_conjunctiva_sclera = null;}

         
           $ocular              = new OcularExamination;
           $ocular->visit_id    = Input::get("opd_number");
           $ocular->patient_id = Input::get("patient_id");
           $ocular->od_c_d_ratio    = $od_c_d_ratio;
           $ocular->os_c_d_ratio  = $os_c_d_ratio;
           $ocular->od_retina = $od_retina;
           $ocular->os_retina     = $os_retina;
           $ocular->od_others  = $od_others;
           $ocular->os_others  = $os_others;
           $ocular->od_ac_lens = $od_ac_lens;
           $ocular->os_ac_lens   = $os_ac_lens;
           $ocular->od_ocular_lens = $od_ocular_lens;
           $ocular->os_ocular_lens   = $os_ocular_lens;
           $ocular->od_iop = $od_iop;
           $ocular->os_iop   = $os_iop;
           $ocular->od_ocular_adnexae   = $od_ocular_adnexae;
           $ocular->os_ocular_adnexae = $os_ocular_adnexae;
           $ocular->od_cornea    = $od_cornea;
           $ocular->os_cornea = $os_cornea;
           $ocular->od_pupil_lens = $od_pupil_lens;
           $ocular->os_pupil_lens   = $os_pupil_lens;
           $ocular->os_virteous   = $os_virteous;
           $ocular->od_virteous    = $od_virteous;

           $ocular->os_visual_ascuity   = $os_visual_ascuity;
           $ocular->od_visual_ascuity    = $od_visual_ascuity;

           $ocular->os_conjunctiva_sclera   = $os_conjunctiva_sclera;
           $ocular->od_conjunctiva_sclera    = $od_conjunctiva_sclera;


           $ocular->created_by      = Auth::user()->getNameOrUsername();
           $ocular->created_on      = Carbon::now();


            OcularExamination::where('visit_id',   Input::get("opd_number"))->delete();
            
            if($ocular->save())
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


     public function addAssessment()
    {     
         
           $assessment                  = new PatientAssessment;
           $assessment->visit_id         = Input::get("opd_number");
           $assessment->assessment       = Input::get("assessment");
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

    public function addPlan()
    {     
         
           $plan                  = new PatientPlan;
           $plan->visitid         = Input::get("opd_number");
           $plan->plan            = Input::get("treament_plan");
           $plan->action          = Input::get("treament_plan_action");
           $plan->date            = Carbon::now();
           $plan->created_by      = Auth::user()->getNameOrUsername();


            

            if($plan->save())
            {
            
              $affectedRows = OPD::where('opd_number',Input::get("opd_number"))->update(array('status' => 'Discharged'));
              $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }

    public function addHistory()
    {     
         
            if(Input::get("medical_history")){$medical =  implode(", ", Input::get("medical_history"));} else {$medical = null;}
            if(Input::get("family_history")){$family =  implode(", ", Input::get("family_history"));} else {$family = null;}
            if(Input::get("social_history")){$social =  implode(", ", Input::get("social_history"));} else {$social = null;}
            if(Input::get("vaccinations_history")){$vacinnation =  implode(", ", Input::get("vaccinations_history"));} else {$vacinnation = null;}
            



           $history                             = new PatientHistory;
           $history->patientid                  = Input::get("patient_id");
           $history->visitid                    = Input::get("opd_number");
           $history->medical_history            = $medical; //implode(',', Input::get("medical_history"));
           $history->family_history             = $family;//implode(', ', Input::get("family_history"));
           $history->social_history             = $social;//implode(',', Input::get("social_history"));
           $history->vaccinations_history       = $vacinnation;//implode(',', Input::get("vaccinations_history"));
           $history->created_on                 = Carbon::now();
           $history->created_by                 = Auth::user()->getNameOrUsername();


           

            if($history->save())
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


    public function addComplaint()
    {     


        // $affectedRows = PatientComplaint::where('visitid', Input::get("opd_number"))->delete();

        if(Input::get("complaint")){$complaint =  implode(", ", Input::get("complaint"));} else {$medical = null;}

           $complaints                  = new PatientComplaint;
           $complaints->visitid         = Input::get("opd_number");
           $complaints->complaint       = $complaint;
           $complaints->period          = Input::get("com_period");
           $complaints->span            = Input::get("com_span");
           $complaints->remark          = Input::get("com_remark");
           $complaints->presenting      = Input::get("presentingcomplaint");
           $complaints->directquestion  = Input::get("directquestion");
           $complaints->date            = Carbon::now();
           $complaints->created_by      = Auth::user()->getNameOrUsername();


            

            if($complaints->save())
            {


              $affectedRows = OPD::where('opd_number',Input::get("opd_number"))->update(array('chief_complaint' => $complaint));

                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }


    public function addNote()
    {     
         
            if(Input::get("complaint")){$complaint =  implode(", ", Input::get("complaint"));} else {$complaint = null;}
            if(Input::get("directquestion")){$directquestion =  implode(", ", Input::get("directquestion"));} else {$directquestion = null;}
            if(Input::get("medical_history")){$medical =  implode(", ", Input::get("medical_history"));} else {$medical = null;}
            if(Input::get("family_history")){$family =  implode(", ", Input::get("family_history"));} else {$family = null;}
            if(Input::get("social_history")){$social =  implode(", ", Input::get("social_history"));} else {$social = null;}
            if(Input::get("vaccinations_history")){$vacinnation =  implode(", ", Input::get("vaccinations_history"));} else {$vacinnation = null;}
            if(Input::get("surgical_history")){$surgical =  implode(", ", Input::get("surgical_history"));} else {$surgical = null;}
            if(Input::get("drug_history")){$drugs =  implode(", ", Input::get("drug_history"));} else {$drugs = null;}
            if(Input::get("reproductive_history")){$reproduction =  implode(", ", Input::get("reproductive_history"));} else {$reproduction = null;}
            if(Input::get("allergy")){$allergy =  implode(", ", Input::get("allergy"));} else {$allergy = null;}


            if(Input::get("ros_constitutional")){$general =  implode(", ", Input::get("ros_constitutional"));} else {$general = null;}
            if(Input::get("ros_skin")){$skin =  implode(", ", Input::get("ros_skin"));} else {$skin = null;}
            if(Input::get("ros_head")){$head =  implode(", ", Input::get("ros_head"));} else {$head = null;}
            if(Input::get("ros_eyes")){$eyes =  implode(", ", Input::get("ros_eyes"));} else {$eyes = null;}
            if(Input::get("ros_ears")){$ears =  implode(", ", Input::get("ros_ears"));} else {$ears = null;}
            if(Input::get("ros_nose")){$nose =  implode(", ", Input::get("ros_nose"));} else {$nose = null;}
            if(Input::get("ros_throat")){$throat =  implode(", ", Input::get("ros_throat"));} else {$throat = null;}
            if(Input::get("ros_respiratory")){$respiratory =  implode(", ", Input::get("ros_respiratory"));} else {$respiratory = null;}
            if(Input::get("ros_cardiovasular")){$cardiovascular =  implode(", ", Input::get("ros_cardiovasular"));} else {$cardiovascular = null;}
             if(Input::get("ros_gastro")){$gastrointestinal =  implode(", ", Input::get("ros_gastro"));} else {$gastrointestinal = null;}
            if(Input::get("ros_gynecology")){$gynecologic =  implode(", ", Input::get("ros_gynecology"));} else {$gynecologic = null;}
            if(Input::get("ros_genitourinary")){$genitourinary =  implode(", ", Input::get("ros_genitourinary"));} else {$genitourinary = null;}
            if(Input::get("ros_endocrine")){$endocrine =  implode(", ", Input::get("ros_endocrine"));} else {$endocrine = null;}
            if(Input::get("ros_musculoskeletal")){$musculoskeletal =  implode(", ", Input::get("ros_musculoskeletal"));} else {$musculoskeletal = null;}
            if(Input::get("ros_peripheral_vascular")){$peripheral_vascular =  implode(", ", Input::get("ros_peripheral_vascular"));} else {$peripheral_vascular = null;}
            if(Input::get("ros_hematology")){$hematology =  implode(", ", Input::get("ros_hematology"));} else {$hematology = null;}
            if(Input::get("ros_neuropsychiatric")){$neuro =  implode(", ", Input::get("ros_neuropsychiatric"));} else {$neuro = null;}



            if(Input::get("pe_general")){$pe_general =  implode(", ", Input::get("pe_general"));} else {$pe_general = null;}
            if(Input::get("pe_HEENT")){$pe_HEENT =  implode(", ", Input::get("pe_HEENT"));} else {$pe_HEENT = null;}
            if(Input::get("pe_neck")){$pe_neck =  implode(", ", Input::get("pe_neck"));} else {$pe_neck = null;}
            if(Input::get("pe_respiratory")){$pe_respiratory =  implode(", ", Input::get("pe_respiratory"));} else {$pe_respiratory = null;}
            if(Input::get("pe_heart")){$pe_heart =  implode(", ", Input::get("pe_heart"));} else {$pe_heart = null;}
            if(Input::get("pe_abdominal")){$pe_abdominal =  implode(", ", Input::get("pe_abdominal"));} else {$pe_abdominal = null;}
            if(Input::get("pe_extremities")){$pe_extremities =  implode(", ", Input::get("pe_extremities"));} else {$pe_extremities = null;}
            if(Input::get("pe_cns")){$pe_cns =  implode(", ", Input::get("pe_cns"));} else {$pe_cns = null;}
            if(Input::get("pe_musculoskeletal")){$pe_musculoskeletal =  implode(", ", Input::get("pe_musculoskeletal"));} else {$pe_musculoskeletal = null;}
            if(Input::get("pe_psychological")){$pe_psychological =  implode(", ", Input::get("pe_psychological"));} else {$pe_psychological = null;}
            if(Input::get("pe_breast")){$pe_breast =  implode(", ", Input::get("pe_breast"));} else {$pe_breast = null;}


            //Antenal Histories & Physical Exam
            if(Input::get("pe_vulva")){$pe_vulva =  implode(", ", Input::get("pe_vulva"));} else {$pe_vulva = null;}
            if(Input::get("pe_vagina")){$pe_vagina =  implode(", ", Input::get("pe_vagina"));} else {$pe_vagina = null;}
            if(Input::get("pe_adnexa")){$pe_adnexa =  implode(", ", Input::get("pe_adnexa"));} else {$pe_adnexa = null;}
            if(Input::get("pe_ext_genitalia")){$pe_ext_genitalia =  implode(", ", Input::get("pe_ext_genitalia"));} else {$pe_ext_genitalia = null;}
            if(Input::get("pe_pelvic")){$pe_pelvic =  implode(", ", Input::get("pe_pelvic"));} else {$pe_pelvic = null;}

            if(Input::get("pe_cervix")){$pe_cervix =  implode(", ", Input::get("pe_cervix"));} else {$pe_cervix = null;}
            if(Input::get("pe_uterus")){$pe_uterus =  implode(", ", Input::get("pe_uterus"));} else {$pe_uterus = null;}
            
            if(Input::get("gravida")){$gravida =  implode(", ", Input::get("gravida"));} else {$gravida = null;}
            if(Input::get("parity")){$parity =  implode(", ", Input::get("parity"));} else {$parity = null;}
            if(Input::get("living")){$living =  implode(", ", Input::get("living"));} else {$living = null;}
            if(Input::get("hospitalization_history")){$hospitalization_history =  implode(", ", Input::get("hospitalization_history"));} else {$hospitalization_history = null;}
            if(Input::get("gynae_history")){$gynae_history =  implode(", ", Input::get("gynae_history"));} else {$gynae_history = null;}
            if(Input::get("developmental_history")){$developmental_history =  implode(", ", Input::get("developmental_history"));} else {$developmental_history = null;}
            if(Input::get("obs_history")){$obs_history =  implode(", ", Input::get("obs_history"));} else {$obs_history = null;}




            if(Input::get("sex_history")){$sex_history =  implode(", ", Input::get("sex_history"));} else {$sex_history = null;}
            if(Input::get("abuse_history")){$abuse_history =  implode(", ", Input::get("abuse_history"));} else {$abuse_history = null;}
            if(Input::get("psychiatric_history")){$psychiatric_history =  implode(", ", Input::get("psychiatric_history"));} else {$psychiatric_history = null;}
            //if(Input::get("pe_pelvic")){$pe_pelvic =  implode(", ", Input::get("pe_pelvic"));} else {$pe_pelvic = null;}



            $deleteid = Input::get("opd_number");
            PatientComplaint::where('visitid',  $deleteid)->delete();
            PatientHistory::where('visitid',  $deleteid)->delete();
            ROS::where('visit_id',  $deleteid)->delete();
            PatientPE::where('visit_id',  $deleteid)->delete();
            
           $complaints                  = new PatientComplaint;
           $complaints->visitid         = Input::get("opd_number");
           $complaints->complaint       = $complaint;
           $complaints->period          = Input::get("com_period");
           $complaints->span            = Input::get("com_span");
           $complaints->remark          = Input::get("com_remark");
           $complaints->presenting      = Input::get("presentingcomplaint");
           $complaints->doctors_note    = Input::get("doctors_note");
           $complaints->patients_note   = Input::get("patients_note");
           $complaints->directquestion  = $directquestion;
           $complaints->date            = Carbon::now();
           $complaints->created_by      = Auth::user()->getNameOrUsername();


           $history                             = new PatientHistory;
           $history->visitid                    = Input::get("opd_number");
           $history->patientid                  = Input::get("patient_id");
           $history->medical_history            = $medical; //implode(',', Input::get("medical_history"));
           $history->family_history             = $family;//implode(', ', Input::get("family_history"));
           $history->social_history             = $social;//implode(',', Input::get("social_history"));
           $history->vaccinations_history       = $vacinnation;//implode(',', Input::get("vaccinations_history"));
           $history->drug_history               = $drugs;//implode(',', Input::get("vaccinations_history"));
           $history->surgical_history           = $surgical;//implode(',', Input::get("vaccinations_history"));
           $history->reproductive_history       = $reproduction;//implode(',', Input::get("vaccinations_history"));
           $history->allergy                    = $allergy;//implode(',', Input::get("vaccinations_history"));

           $history->gravida                    = $gravida;//implode(',', Input::get("social_history"));
           $history->parity                     = $parity;//implode(',', Input::get("vaccinations_history"));
           $history->living                     = $living;//implode(',', Input::get("vaccinations_history"));
           $history->hospitalization_history    = $hospitalization_history;//implode(',', Input::get("vaccinations_history"));
           $history->gynae_history              = $gynae_history;//implode(',', Input::get("vaccinations_history"));
           $history->developmental_history      = $developmental_history;//implode(',', Input::get("vaccinations_history"));
           $history->obs_history                = $obs_history;//implode(',', Input::get("vaccinations_history"));
           $history->sex_history                = $sex_history;//implode(',', Input::get("vaccinations_history"));
           $history->psychiatric_history        = $psychiatric_history;//implode(',', Input::get("vaccinations_history"));
           $history->abuse_history              = $abuse_history;//implode(',', Input::get("vaccinations_history"));
           $history->created_on                 = Carbon::now();
           $history->created_by                 = Auth::user()->getNameOrUsername();


            $ros                    = new ROS;
            $ros->general           = $general;
            $ros->skin              = $skin;
            $ros->head              = $head;
            $ros->eyes              = $eyes;
            $ros->ears              = $ears;
            $ros->nose              = $nose;
            $ros->throat            = $throat;
            $ros->respiratory       = $respiratory;
            $ros->cardiovascular    = $cardiovascular;
            $ros->gastrointestinal  = $gastrointestinal;
            $ros->gynecologic       = $gynecologic;
            $ros->genitourinary     = $genitourinary;
            $ros->endocrine         = $endocrine;
            $ros->musculoskeletal   = $musculoskeletal;
            $ros->peripheral_vascular = $peripheral_vascular;
            $ros->hematology          = $hematology;
            $ros->neuro             = $neuro;

            $ros->visit_id          = Input::get("opd_number");
            $ros->patient_id        = Input::get("patient_id");
            $ros->created_by        = Auth::user()->getNameOrUsername();
            $ros->created_on        = Carbon::now();
           

            $patientpe                      = new PatientPE;
            $patientpe->pe_general          = $pe_general;
            $patientpe->pe_HEENT            = $pe_HEENT;
            $patientpe->pe_neck             = $pe_neck;
            $patientpe->pe_respiratory      = $pe_respiratory;
            $patientpe->pe_heart            = $pe_heart;
            $patientpe->pe_abdominal        = $pe_abdominal;
            $patientpe->pe_extremities      = $pe_extremities;
            $patientpe->pe_cns              = $pe_cns;
            $patientpe->pe_musculoskeletal  = $pe_musculoskeletal;
            $patientpe->pe_psychological    = $pe_psychological;
            $patientpe->pe_breast           = $pe_breast;

            $patientpe->pe_vulva            = $pe_vulva;
            $patientpe->pe_vagina           = $pe_vagina;
            $patientpe->pe_adnexa           = $pe_adnexa;
            $patientpe->pe_ext_genitalia    = $pe_ext_genitalia;
            $patientpe->pe_pelvic           = $pe_pelvic;

            $patientpe->pe_uterus           = $pe_uterus;
             $patientpe->pe_cervix          = $pe_cervix;


            $patientpe->visit_id          = Input::get("opd_number");
            $patientpe->patient_id        = Input::get("patient_id");
            $patientpe->created_by        = Auth::user()->getNameOrUsername();
            $patientpe->created_on        = Carbon::now();
           

         

            if($complaints->save())
            {

              //$vitals->save();
              $history->save();
              $ros->save();  
              $patientpe->save();

              $affectedRows = OPD::where('opd_number',Input::get("opd_number"))->update(array('chief_complaint' => $complaint,'location'=>'Consulting Room'));

                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }


    public function addNoteForEye()
    {     
         
            if(Input::get("complaint")){$complaint =  implode(", ", Input::get("complaint"));} else {$complaint = null;}
            if(Input::get("directquestion")){$directquestion =  implode(", ", Input::get("directquestion"));} else {$directquestion = null;}
            if(Input::get("medical_history")){$medical =  implode(", ", Input::get("medical_history"));} else {$medical = null;}
            if(Input::get("family_history")){$family =  implode(", ", Input::get("family_history"));} else {$family = null;}
            if(Input::get("social_history")){$social =  implode(", ", Input::get("social_history"));} else {$social = null;}
            if(Input::get("vaccinations_history")){$vacinnation =  implode(", ", Input::get("vaccinations_history"));} else {$vacinnation = null;}
            if(Input::get("surgical_history")){$surgical =  implode(", ", Input::get("surgical_history"));} else {$surgical = null;}
            if(Input::get("drug_history")){$drugs =  implode(", ", Input::get("drug_history"));} else {$drugs = null;}
            if(Input::get("reproductive_history")){$reproduction =  implode(", ", Input::get("reproductive_history"));} else {$reproduction = null;}
            if(Input::get("allergy")){$allergy =  implode(", ", Input::get("allergy"));} else {$allergy = null;}


            if(Input::get("ros_constitutional")){$general =  implode(", ", Input::get("ros_constitutional"));} else {$general = null;}
            if(Input::get("ros_skin")){$skin =  implode(", ", Input::get("ros_skin"));} else {$skin = null;}
            if(Input::get("ros_head")){$head =  implode(", ", Input::get("ros_head"));} else {$head = null;}
            if(Input::get("ros_eyes")){$eyes =  implode(", ", Input::get("ros_eyes"));} else {$eyes = null;}
            if(Input::get("ros_ears")){$ears =  implode(", ", Input::get("ros_ears"));} else {$ears = null;}
            if(Input::get("ros_nose")){$nose =  implode(", ", Input::get("ros_nose"));} else {$nose = null;}
            if(Input::get("ros_throat")){$throat =  implode(", ", Input::get("ros_throat"));} else {$throat = null;}
            if(Input::get("ros_respiratory")){$respiratory =  implode(", ", Input::get("ros_respiratory"));} else {$respiratory = null;}
            if(Input::get("ros_cardiovasular")){$cardiovascular =  implode(", ", Input::get("ros_cardiovasular"));} else {$cardiovascular = null;}
             if(Input::get("ros_gastro")){$gastrointestinal =  implode(", ", Input::get("ros_gastro"));} else {$gastrointestinal = null;}
            if(Input::get("ros_gynecology")){$gynecologic =  implode(", ", Input::get("ros_gynecology"));} else {$gynecologic = null;}
            if(Input::get("ros_genitourinary")){$genitourinary =  implode(", ", Input::get("ros_genitourinary"));} else {$genitourinary = null;}
            if(Input::get("ros_endocrine")){$endocrine =  implode(", ", Input::get("ros_endocrine"));} else {$endocrine = null;}
            if(Input::get("ros_musculoskeletal")){$musculoskeletal =  implode(", ", Input::get("ros_musculoskeletal"));} else {$musculoskeletal = null;}
            if(Input::get("ros_peripheral_vascular")){$peripheral_vascular =  implode(", ", Input::get("ros_peripheral_vascular"));} else {$peripheral_vascular = null;}
            if(Input::get("ros_hematology")){$hematology =  implode(", ", Input::get("ros_hematology"));} else {$hematology = null;}
            if(Input::get("ros_neuropsychiatric")){$neuro =  implode(", ", Input::get("ros_neuropsychiatric"));} else {$neuro = null;}



            if(Input::get("pe_general")){$pe_general =  implode(", ", Input::get("pe_general"));} else {$pe_general = null;}
            if(Input::get("pe_HEENT")){$pe_HEENT =  implode(", ", Input::get("pe_HEENT"));} else {$pe_HEENT = null;}
            if(Input::get("pe_neck")){$pe_neck =  implode(", ", Input::get("pe_neck"));} else {$pe_neck = null;}
            if(Input::get("pe_respiratory")){$pe_respiratory =  implode(", ", Input::get("pe_respiratory"));} else {$pe_respiratory = null;}
            if(Input::get("pe_heart")){$pe_heart =  implode(", ", Input::get("pe_heart"));} else {$pe_heart = null;}
            if(Input::get("pe_abdominal")){$pe_abdominal =  implode(", ", Input::get("pe_abdominal"));} else {$pe_abdominal = null;}
            if(Input::get("pe_extremities")){$pe_extremities =  implode(", ", Input::get("pe_extremities"));} else {$pe_extremities = null;}
            if(Input::get("pe_cns")){$pe_cns =  implode(", ", Input::get("pe_cns"));} else {$pe_cns = null;}
            if(Input::get("pe_musculoskeletal")){$pe_musculoskeletal =  implode(", ", Input::get("pe_musculoskeletal"));} else {$pe_musculoskeletal = null;}
            if(Input::get("pe_psychological")){$pe_psychological =  implode(", ", Input::get("pe_psychological"));} else {$pe_psychological = null;}
            if(Input::get("pe_breast")){$pe_breast =  implode(", ", Input::get("pe_breast"));} else {$pe_breast = null;}


            //Antenal Histories & Physical Exam
            if(Input::get("pe_vulva")){$pe_vulva =  implode(", ", Input::get("pe_vulva"));} else {$pe_vulva = null;}
            if(Input::get("pe_vagina")){$pe_vagina =  implode(", ", Input::get("pe_vagina"));} else {$pe_vagina = null;}
            if(Input::get("pe_adnexa")){$pe_adnexa =  implode(", ", Input::get("pe_adnexa"));} else {$pe_adnexa = null;}
            if(Input::get("pe_ext_genitalia")){$pe_ext_genitalia =  implode(", ", Input::get("pe_ext_genitalia"));} else {$pe_ext_genitalia = null;}
            if(Input::get("pe_pelvic")){$pe_pelvic =  implode(", ", Input::get("pe_pelvic"));} else {$pe_pelvic = null;}

            if(Input::get("pe_cervix")){$pe_cervix =  implode(", ", Input::get("pe_cervix"));} else {$pe_cervix = null;}
            if(Input::get("pe_uterus")){$pe_uterus =  implode(", ", Input::get("pe_uterus"));} else {$pe_uterus = null;}
            
            if(Input::get("gravida")){$gravida =  implode(", ", Input::get("gravida"));} else {$gravida = null;}
            if(Input::get("parity")){$parity =  implode(", ", Input::get("parity"));} else {$parity = null;}
            if(Input::get("living")){$living =  implode(", ", Input::get("living"));} else {$living = null;}
            if(Input::get("hospitalization_history")){$hospitalization_history =  implode(", ", Input::get("hospitalization_history"));} else {$hospitalization_history = null;}
            if(Input::get("gynae_history")){$gynae_history =  implode(", ", Input::get("gynae_history"));} else {$gynae_history = null;}
            if(Input::get("developmental_history")){$developmental_history =  implode(", ", Input::get("developmental_history"));} else {$developmental_history = null;}
            if(Input::get("obs_history")){$obs_history =  implode(", ", Input::get("obs_history"));} else {$obs_history = null;}


            
           $complaints                  = new PatientComplaint;
           $complaints->visitid         = Input::get("opd_number");
           $complaints->complaint       = $complaint;
           $complaints->period          = Input::get("com_period");
           $complaints->span            = Input::get("com_span");
           $complaints->remark          = Input::get("com_remark");
           $complaints->presenting      = Input::get("presentingcomplaint");
           $complaints->directquestion  = $directquestion;
           $complaints->date            = Carbon::now();
           $complaints->created_by      = Auth::user()->getNameOrUsername();


           $history                             = new PatientHistory;
           $history->visitid                    = Input::get("opd_number");
           $history->patientid                  = Input::get("patient_id");
           $history->medical_history            = $medical; //implode(',', Input::get("medical_history"));
           $history->family_history             = $family;//implode(', ', Input::get("family_history"));
           $history->social_history             = $social;//implode(',', Input::get("social_history"));
           $history->vaccinations_history       = $vacinnation;//implode(',', Input::get("vaccinations_history"));
           $history->drug_history               = $drugs;//implode(',', Input::get("vaccinations_history"));
           $history->surgical_history           = $surgical;//implode(',', Input::get("vaccinations_history"));
           $history->reproductive_history       = $reproduction;//implode(',', Input::get("vaccinations_history"));
           $history->allergy                    = $allergy;//implode(',', Input::get("vaccinations_history"));

           $history->gravida                    = $gravida;//implode(',', Input::get("social_history"));
           $history->parity                     = $parity;//implode(',', Input::get("vaccinations_history"));
           $history->living                     = $living;//implode(',', Input::get("vaccinations_history"));
           $history->hospitalization_history    = $hospitalization_history;//implode(',', Input::get("vaccinations_history"));
           $history->gynae_history              = $gynae_history;//implode(',', Input::get("vaccinations_history"));
           $history->developmental_history      = $developmental_history;//implode(',', Input::get("vaccinations_history"));
           $history->obs_history                = $obs_history;//implode(',', Input::get("vaccinations_history"));
           $history->created_on                 = Carbon::now();
           $history->created_by                 = Auth::user()->getNameOrUsername();


            $ros                    = new ROS;
            $ros->general           = $general;
            $ros->skin              = $skin;
            $ros->head              = $head;
            $ros->eyes              = $eyes;
            $ros->ears              = $ears;
            $ros->nose              = $nose;
            $ros->throat            = $throat;
            $ros->respiratory       = $respiratory;
            $ros->cardiovascular    = $cardiovascular;
            $ros->gastrointestinal  = $gastrointestinal;
            $ros->gynecologic       = $gynecologic;
            $ros->genitourinary     = $genitourinary;
            $ros->endocrine         = $endocrine;
            $ros->musculoskeletal   = $musculoskeletal;
            $ros->peripheral_vascular = $peripheral_vascular;
            $ros->hematology          = $hematology;
            $ros->neuro             = $neuro;

            $ros->visit_id          = Input::get("opd_number");
            $ros->patient_id        = Input::get("patient_id");
            $ros->created_by        = Auth::user()->getNameOrUsername();
            $ros->created_on        = Carbon::now();
           

            $patientpe                      = new PatientPE;
            $patientpe->pe_general          = $pe_general;
            $patientpe->pe_HEENT            = $pe_HEENT;
            $patientpe->pe_neck             = $pe_neck;
            $patientpe->pe_respiratory      = $pe_respiratory;
            $patientpe->pe_heart            = $pe_heart;
            $patientpe->pe_abdominal        = $pe_abdominal;
            $patientpe->pe_extremities      = $pe_extremities;
            $patientpe->pe_cns              = $pe_cns;
            $patientpe->pe_musculoskeletal  = $pe_musculoskeletal;
            $patientpe->pe_psychological    = $pe_psychological;
            $patientpe->pe_breast           = $pe_breast;

            $patientpe->pe_vulva            = $pe_vulva;
            $patientpe->pe_vagina           = $pe_vagina;
            $patientpe->pe_adnexa           = $pe_adnexa;
            $patientpe->pe_ext_genitalia    = $pe_ext_genitalia;
            $patientpe->pe_pelvic           = $pe_pelvic;

            $patientpe->pe_uterus           = $pe_uterus;
             $patientpe->pe_cervix          = $pe_cervix;


            $patientpe->visit_id          = Input::get("opd_number");
            $patientpe->patient_id        = Input::get("patient_id");
            $patientpe->created_by        = Auth::user()->getNameOrUsername();
            $patientpe->created_on        = Carbon::now();
           

         

            if($complaints->save())
            {

              //$vitals->save();
              $history->save();
              $ros->save();  
              $patientpe->save();

              $affectedRows = OPD::where('opd_number',Input::get("opd_number"))->update(array('chief_complaint' => $complaint,'location'=>'Consulting Room'));

                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }



public function addNoteForDental()
    {     
         
            if(Input::get("complaint")){$complaint =  implode(", ", Input::get("complaint"));} else {$complaint = null;}
            if(Input::get("directquestion")){$directquestion =  implode(", ", Input::get("directquestion"));} else {$directquestion = null;}
            if(Input::get("medical_history")){$medical =  implode(", ", Input::get("medical_history"));} else {$medical = null;}
            if(Input::get("family_history")){$family =  implode(", ", Input::get("family_history"));} else {$family = null;}
            if(Input::get("social_history")){$social =  implode(", ", Input::get("social_history"));} else {$social = null;}
            if(Input::get("vaccinations_history")){$vacinnation =  implode(", ", Input::get("vaccinations_history"));} else {$vacinnation = null;}
            if(Input::get("surgical_history")){$surgical =  implode(", ", Input::get("surgical_history"));} else {$surgical = null;}
            if(Input::get("drug_history")){$drugs =  implode(", ", Input::get("drug_history"));} else {$drugs = null;}
            if(Input::get("reproductive_history")){$reproduction =  implode(", ", Input::get("reproductive_history"));} else {$reproduction = null;}
            if(Input::get("allergy")){$allergy =  implode(", ", Input::get("allergy"));} else {$allergy = null;}


            if(Input::get("ros_constitutional")){$general =  implode(", ", Input::get("ros_constitutional"));} else {$general = null;}
            if(Input::get("ros_skin")){$skin =  implode(", ", Input::get("ros_skin"));} else {$skin = null;}
            if(Input::get("ros_head")){$head =  implode(", ", Input::get("ros_head"));} else {$head = null;}
            if(Input::get("ros_eyes")){$eyes =  implode(", ", Input::get("ros_eyes"));} else {$eyes = null;}
            if(Input::get("ros_ears")){$ears =  implode(", ", Input::get("ros_ears"));} else {$ears = null;}
            if(Input::get("ros_nose")){$nose =  implode(", ", Input::get("ros_nose"));} else {$nose = null;}
            if(Input::get("ros_throat")){$throat =  implode(", ", Input::get("ros_throat"));} else {$throat = null;}
            if(Input::get("ros_respiratory")){$respiratory =  implode(", ", Input::get("ros_respiratory"));} else {$respiratory = null;}
            if(Input::get("ros_cardiovasular")){$cardiovascular =  implode(", ", Input::get("ros_cardiovasular"));} else {$cardiovascular = null;}
             if(Input::get("ros_gastro")){$gastrointestinal =  implode(", ", Input::get("ros_gastro"));} else {$gastrointestinal = null;}
            if(Input::get("ros_gynecology")){$gynecologic =  implode(", ", Input::get("ros_gynecology"));} else {$gynecologic = null;}
            if(Input::get("ros_genitourinary")){$genitourinary =  implode(", ", Input::get("ros_genitourinary"));} else {$genitourinary = null;}
            if(Input::get("ros_endocrine")){$endocrine =  implode(", ", Input::get("ros_endocrine"));} else {$endocrine = null;}
            if(Input::get("ros_musculoskeletal")){$musculoskeletal =  implode(", ", Input::get("ros_musculoskeletal"));} else {$musculoskeletal = null;}
            if(Input::get("ros_peripheral_vascular")){$peripheral_vascular =  implode(", ", Input::get("ros_peripheral_vascular"));} else {$peripheral_vascular = null;}
            if(Input::get("ros_hematology")){$hematology =  implode(", ", Input::get("ros_hematology"));} else {$hematology = null;}
            if(Input::get("ros_neuropsychiatric")){$neuro =  implode(", ", Input::get("ros_neuropsychiatric"));} else {$neuro = null;}



            if(Input::get("pe_general")){$pe_general =  implode(", ", Input::get("pe_general"));} else {$pe_general = null;}
            if(Input::get("pe_HEENT")){$pe_HEENT =  implode(", ", Input::get("pe_HEENT"));} else {$pe_HEENT = null;}
            if(Input::get("pe_neck")){$pe_neck =  implode(", ", Input::get("pe_neck"));} else {$pe_neck = null;}
            if(Input::get("pe_respiratory")){$pe_respiratory =  implode(", ", Input::get("pe_respiratory"));} else {$pe_respiratory = null;}
            if(Input::get("pe_heart")){$pe_heart =  implode(", ", Input::get("pe_heart"));} else {$pe_heart = null;}
            if(Input::get("pe_abdominal")){$pe_abdominal =  implode(", ", Input::get("pe_abdominal"));} else {$pe_abdominal = null;}
            if(Input::get("pe_extremities")){$pe_extremities =  implode(", ", Input::get("pe_extremities"));} else {$pe_extremities = null;}
            if(Input::get("pe_cns")){$pe_cns =  implode(", ", Input::get("pe_cns"));} else {$pe_cns = null;}
            if(Input::get("pe_musculoskeletal")){$pe_musculoskeletal =  implode(", ", Input::get("pe_musculoskeletal"));} else {$pe_musculoskeletal = null;}
            if(Input::get("pe_psychological")){$pe_psychological =  implode(", ", Input::get("pe_psychological"));} else {$pe_psychological = null;}
            if(Input::get("pe_breast")){$pe_breast =  implode(", ", Input::get("pe_breast"));} else {$pe_breast = null;}


            //Antenal Histories & Physical Exam
            if(Input::get("pe_vulva")){$pe_vulva =  implode(", ", Input::get("pe_vulva"));} else {$pe_vulva = null;}
            if(Input::get("pe_vagina")){$pe_vagina =  implode(", ", Input::get("pe_vagina"));} else {$pe_vagina = null;}
            if(Input::get("pe_adnexa")){$pe_adnexa =  implode(", ", Input::get("pe_adnexa"));} else {$pe_adnexa = null;}
            if(Input::get("pe_ext_genitalia")){$pe_ext_genitalia =  implode(", ", Input::get("pe_ext_genitalia"));} else {$pe_ext_genitalia = null;}
            if(Input::get("pe_pelvic")){$pe_pelvic =  implode(", ", Input::get("pe_pelvic"));} else {$pe_pelvic = null;}

            if(Input::get("pe_cervix")){$pe_cervix =  implode(", ", Input::get("pe_cervix"));} else {$pe_cervix = null;}
            if(Input::get("pe_uterus")){$pe_uterus =  implode(", ", Input::get("pe_uterus"));} else {$pe_uterus = null;}
            
            if(Input::get("gravida")){$gravida =  implode(", ", Input::get("gravida"));} else {$gravida = null;}
            if(Input::get("parity")){$parity =  implode(", ", Input::get("parity"));} else {$parity = null;}
            if(Input::get("living")){$living =  implode(", ", Input::get("living"));} else {$living = null;}
            if(Input::get("hospitalization_history")){$hospitalization_history =  implode(", ", Input::get("hospitalization_history"));} else {$hospitalization_history = null;}
            if(Input::get("gynae_history")){$gynae_history =  implode(", ", Input::get("gynae_history"));} else {$gynae_history = null;}
            if(Input::get("developmental_history")){$developmental_history =  implode(", ", Input::get("developmental_history"));} else {$developmental_history = null;}
            if(Input::get("obs_history")){$obs_history =  implode(", ", Input::get("obs_history"));} else {$obs_history = null;}


            
           $complaints                  = new PatientComplaint;
           $complaints->visitid         = Input::get("opd_number");
           $complaints->complaint       = $complaint;
           $complaints->period          = Input::get("com_period");
           $complaints->span            = Input::get("com_span");
           $complaints->remark          = Input::get("com_remark");
           $complaints->presenting      = Input::get("presentingcomplaint");
           $complaints->directquestion  = $directquestion;
           $complaints->date            = Carbon::now();
           $complaints->created_by      = Auth::user()->getNameOrUsername();


           $history                             = new PatientHistory;
           $history->visitid                    = Input::get("opd_number");
           $history->patientid                  = Input::get("patient_id");
           $history->medical_history            = $medical; //implode(',', Input::get("medical_history"));
           $history->family_history             = $family;//implode(', ', Input::get("family_history"));
           $history->social_history             = $social;//implode(',', Input::get("social_history"));
           $history->vaccinations_history       = $vacinnation;//implode(',', Input::get("vaccinations_history"));
           $history->drug_history               = $drugs;//implode(',', Input::get("vaccinations_history"));
           $history->surgical_history           = $surgical;//implode(',', Input::get("vaccinations_history"));
           $history->reproductive_history       = $reproduction;//implode(',', Input::get("vaccinations_history"));
           $history->allergy                    = $allergy;//implode(',', Input::get("vaccinations_history"));

           $history->gravida                    = $gravida;//implode(',', Input::get("social_history"));
           $history->parity                     = $parity;//implode(',', Input::get("vaccinations_history"));
           $history->living                     = $living;//implode(',', Input::get("vaccinations_history"));
           $history->hospitalization_history    = $hospitalization_history;//implode(',', Input::get("vaccinations_history"));
           $history->gynae_history              = $gynae_history;//implode(',', Input::get("vaccinations_history"));
           $history->developmental_history      = $developmental_history;//implode(',', Input::get("vaccinations_history"));
           $history->obs_history                = $obs_history;//implode(',', Input::get("vaccinations_history"));
           $history->created_on                 = Carbon::now();
           $history->created_by                 = Auth::user()->getNameOrUsername();


            $ros                    = new ROS;
            $ros->general           = $general;
            $ros->skin              = $skin;
            $ros->head              = $head;
            $ros->eyes              = $eyes;
            $ros->ears              = $ears;
            $ros->nose              = $nose;
            $ros->throat            = $throat;
            $ros->respiratory       = $respiratory;
            $ros->cardiovascular    = $cardiovascular;
            $ros->gastrointestinal  = $gastrointestinal;
            $ros->gynecologic       = $gynecologic;
            $ros->genitourinary     = $genitourinary;
            $ros->endocrine         = $endocrine;
            $ros->musculoskeletal   = $musculoskeletal;
            $ros->peripheral_vascular = $peripheral_vascular;
            $ros->hematology          = $hematology;
            $ros->neuro             = $neuro;

            $ros->visit_id          = Input::get("opd_number");
            $ros->patient_id        = Input::get("patient_id");
            $ros->created_by        = Auth::user()->getNameOrUsername();
            $ros->created_on        = Carbon::now();
           

            $patientpe                      = new PatientPE;
            $patientpe->pe_general          = $pe_general;
            $patientpe->pe_HEENT            = $pe_HEENT;
            $patientpe->pe_neck             = $pe_neck;
            $patientpe->pe_respiratory      = $pe_respiratory;
            $patientpe->pe_heart            = $pe_heart;
            $patientpe->pe_abdominal        = $pe_abdominal;
            $patientpe->pe_extremities      = $pe_extremities;
            $patientpe->pe_cns              = $pe_cns;
            $patientpe->pe_musculoskeletal  = $pe_musculoskeletal;
            $patientpe->pe_psychological    = $pe_psychological;
            $patientpe->pe_breast           = $pe_breast;

            $patientpe->pe_vulva            = $pe_vulva;
            $patientpe->pe_vagina           = $pe_vagina;
            $patientpe->pe_adnexa           = $pe_adnexa;
            $patientpe->pe_ext_genitalia    = $pe_ext_genitalia;
            $patientpe->pe_pelvic           = $pe_pelvic;

            $patientpe->pe_uterus           = $pe_uterus;
             $patientpe->pe_cervix          = $pe_cervix;


            $patientpe->visit_id          = Input::get("opd_number");
            $patientpe->patient_id        = Input::get("patient_id");
            $patientpe->created_by        = Auth::user()->getNameOrUsername();
            $patientpe->created_on        = Carbon::now();
           

         

            if($complaints->save())
            {

              //$vitals->save();
              $history->save();
              $ros->save();  
              $patientpe->save();

              $affectedRows = OPD::where('opd_number',Input::get("opd_number"))->update(array('chief_complaint' => $complaint,'location'=>'Consulting Room'));

                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }



    function computeBPRange($systolic,$diastolic)
    {

        // $systolic = 120;
        // $diastolic = 80;
        

        $sysresult = 0;
        $diaresult = 0 ;
        $range = 0 ;
        $pressure = 'Unable to compute range';

       if($systolic < 120) 
       {
         $sysresult = 1;
       }

       if($systolic >= 120 && $systolic <= 139) 
       {
         $sysresult = 2;
       }

       if($systolic >= 140 && $systolic <= 159) 
       {
         $sysresult = 3;
       }

       if($systolic > 159) 
       {
         $sysresult = 4;
       }

       if($diastolic < 80) 
       {
         $diaresult = 1;
       }

       if($diastolic >= 80 && $diastolic <=89) 
       {
         $diaresult = 2;
       }

        if($diastolic >= 90 && $diastolic <=99) 
       {
         $diaresult = 3;
       }

        if($diastolic > 99) 
       {
         $diaresult = 4;
       }

       if($sysresult - $diaresult = 0)
       {
            $range = $sysresult; 
       }

        if($sysresult - $diaresult < 0)
       {
            $range = $diaresult; 
       }

        if($sysresult - $diaresult > 0)
       {
            $range = $sysresult; 
       }

       if($range == 1)
       {
           $pressure = 'Normal';
       }

       if($range == 2)
       {
           $pressure = 'Prehypertension';
       }

        if($range == 3)
       {
           $pressure = 'Stage 1 Hypertension';
       }

        if($range == 4)
       {
           $pressure = 'Stage 2 Hypertension';
       }

      return $pressure;
    

    }


    function computeBMIRange($weight,$height)
    {

        if($weight)

        {
        $bmi = ($weight/($height*$height));
        $status = 'Undetermined';



       if($bmi < 18.5) 
       {
         $status = 'Underweight';
       }

       if($bmi >= 18.5 && $bmi <= 24.9) 
       {
        $status = 'Normal';
       }

       if($bmi >= 25 && $bmi <= 29.9) 
       {
         $status = 'Overweight';
       }

       if($bmi >= 30) 
       {
         $status = 'Obese';
       }

       return $status;
   }

    }

     function computeTemperatureRange($reading)
    {

        $temperature = $reading;
        $status = 'Undetermined';



       if($temperature < 35) 
       {
         $status = 'Hypothermia';
       }

       if($temperature >= 35.5 && $temperature <= 37.5) 
       {

        $status = 'Normal';
       }

       if($temperature >= 37.6 && $temperature <= 38.3) 
       {
         $status = 'Hyperthermia';
       }

       if($temperature > 38.3) 
       {
         $status = 'Hyperpyrexia';
       }

       return $status;

    }

    Public function AddVitals()
    {

        $patient = Customer::where('patient_id',Input::get("patient_id"))->first();
        $mypatientage =  $patient->date_of_birth->age;
        $mypatientgender =  $patient->gender;

        $BMI = 0;
        $calories = 0;
        $BMR = 0;
        $IBW_range_upper = 0;
        $IBW_range_lower = 0;
        $weight = 0;
        $height = 0;
        if(Input::get("weight"))
        {
        $weight = Input::get("weight");
        $height = Input::get("height");
        $BMI = 1;
        $age = $mypatientage;
        $activity_factor = 1.2;
        
        $BMI = $weight/($height * $height);
      

        //Constants
        $C1 = 66.5;
        $C2 = 13.75; 
        $C3 = 5.003;
        $C4 = 6.775;

        $P1 = $weight * $C2;
        $P2 = ($height*100) * $C3;
        $P3 = $age * $C4;

        $BMR = $C1 + $P1 + $P2 - $P3;
        $calories = $BMR * $activity_factor;
        $IBW_range_upper = ($weight * 18)/$BMI;
        $IBW_range_lower = ($weight * 25)/$BMI;

        }

        
           $vitals                  = new PatientVitals;
           $vitals->patient_id      = Input::get("patient_id");
           $vitals->visit_id        = Input::get("opd_number");
           $vitals->weight          = Input::get("weight");
           $vitals->height          = Input::get("height");
           $vitals->waist_circumference = Input::get("waist_circumference");
           $vitals->hip_circumference   = Input::get("hip_circumference");
           $vitals->frame           = Input::get("frame");
           $vitals->b_fat           = Input::get("b_fat");
           $vitals->v_fat           = Input::get("v_fat");
           $vitals->pulse_rate      = Input::get("pulse_rate");
           $vitals->blood_pressure  = Input::get("blood_pressure");
           $vitals->respiration     = Input::get("respiration");
           $vitals->temperature     = Input::get("temperature");
           $vitals->sbp             = Input::get("systolic");
           $vitals->dbp             = Input::get("diastolic");

           $vitals->bp_status     = $this->computeBPRange(Input::get("systolic"),Input::get("diastolic"));
           $vitals->bmi_status    = $this->computeBMIRange(Input::get("weight"),Input::get("height"));
           $vitals->temp_status   = $this->computeTemperatureRange(Input::get("temperature"));

           $vitals->fbs             = Input::get("fbs");
           $vitals->rbs             = Input::get("rbs");
           $vitals->spo2            = Input::get("spo2");

           $vitals->bmi             = $BMI;
           $vitals->calories        = $calories;
           $vitals->bmr             = $BMR;
           $vitals->IBW_range_upper = $IBW_range_upper;
           $vitals->IBW_range_lower = $IBW_range_lower;

           $vitals->created_on      = Carbon::now();
           $vitals->created_by      = Auth::user()->getNameOrUsername();


            if($vitals->save())

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

public function getPhoto()
{

   
       $id = Input::get("patient_id");
       
        $user = Customer::where('patient_id','=',$id)->get();
 

         $data = Array(
        'image'=>$user->image,
      
    );
        return Response::json($data);
   
}

public function getMedication()
{

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = Prescription::where('VisitID','=',$opd_number)->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


public function getFluids()
{

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = PatientFluids::where('visit_id','=',$opd_number)->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


public function getAntenatalRecords()
{

    try
    {

            $opd_number = Input::get("visit_id");
            $records = AntenatalChart::where('visit_id','=',$opd_number)->get();
              return  Response::json($records);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}



public function getAssessment()
{

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = PatientAssessment::where('visit_id','=',$opd_number)->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


public function getPlan()
{

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = PatientPlan::where('visitid','=',$opd_number)->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}



public function getVitals()
{

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = PatientVitals::where('visit_id','=',$opd_number)->orderby('created_on','desc')->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


public function getVitalsAll()
{

    try
    {

            $patient_id = Input::get("patient_id");
            $drugcart = PatientVitals::where('patient_id','=',$patient_id)->orderby('created_on','desc')->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}




public function getHistory()
{

    try
    {

            $opd_number = Input::get("opd_number");
            $history = PatientHistory::where('visitid','=',$opd_number)->get();
              return  Response::json($history);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}

public function getPatientImages()
{

    try
    {

            $patient_id = Input::get("patient_id");
            $images = Images::where('accountnumber','=',$patient_id)->get();
              return  Response::json($images);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}



public function getInvestigation()
{
    try
    {
            $opd_number = Input::get("opd_number");
            $investigations = PatientInvestigation::where('visitid','=',$opd_number)->get();
            return  Response::json($investigations);        
    }

    catch (\Exception $e) 
    {
           echo $e->getMessage();
        
    }
}


public function getComplaint()
{
    try
    {

            $opd_number = Input::get("opd_number");
            $complaints = PatientComplaint::where('visitid','=',$opd_number)->orderby('date','desc')->get();
            return  Response::json($complaints);        
    }

    catch (\Exception $e) 
    {
           echo $e->getMessage();
        
    }
}

public function getProcedure()
{
    try
    {

            $opd_number = Input::get("opd_number");
            $procedures = PatientProcedure::where('visitid','=',$opd_number)->orderby('created_on','desc')->get();
            return  Response::json($procedures);        
    }

    catch (\Exception $e) 
    {
           echo $e->getMessage();
        
    }
}

public function getFurtherPlan()
{
    try
    {

            $opd_number = Input::get("opd_number");
            $procedures = PatientFurtherPlan::where('patientid','=',$opd_number)->orderby('created_on','desc')->get();
            return  Response::json($procedures);        
    }

    catch (\Exception $e) 
    {
           echo $e->getMessage();
        
    }
}


public function getDiagnosis()
{
    try
    {

            $opd_number =  Input::get("opd_number");
            $diagnosis  =  PatientDiagnosis::where('visitid','=',$opd_number)->orderby('date','desc')->get();
            return  Response::json($diagnosis);        
    }

    catch (\Exception $e) 
    {
           echo $e->getMessage();
        
    }
}












public function excludeMedication()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

            $uuid = Prescription::where('id',$ID)->value('uuid');

            $removefrombill = Bill::where('uuid',  $uuid)->where('note','Unpaid')->delete();

            if($removefrombill > 0)

            {

                $affectedRows = Prescription::where('id', '=', $ID)->where('pay_status','Unpaid')->delete();
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
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }


   public function excludeAntenatalRecord()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = AntenatalChart::where('id', '=', $ID)->delete();

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

   public function excludePlan()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PatientPlan::where('id', '=', $ID)->delete();

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

   public function excludeFluids()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PatientFluids::where('id', '=', $ID)->delete();

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

    public function excludeAssessment()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PatientAssessment::where('id', $ID)->delete();

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


   public function excludeProcedurePlan()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PatientFurtherPlan::where('id', $ID)->delete();

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



public function excludeComplain()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PatientComplaint::where('id',$ID)->delete();

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

   public function excludeProcedure()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $uuid = PatientProcedure::where('id',$ID)->value('uuid');

           
            $removefrombill = Bill::where('uuid',  $uuid)->where('note','Unpaid')->delete();

            if($removefrombill > 0)
             {
                  $affectedRows = PatientProcedure::where('id', '=', $ID)->delete();

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
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }

      public function excludeInvestigation()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $uuid = PatientInvestigation::where('id',$ID)->value('uuid');

             $removefrombill = Bill::where('uuid',  $uuid)->where('note','Unpaid')->delete();

             if($removefrombill)
             {
                     $affectedRows = PatientInvestigation::where('id', $ID)->delete();
                   
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
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }

   public function excludeDiagnosis()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PatientDiagnosis::where('id', '=', $ID)->delete();

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


   public function excludeHistory()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PatientHistory::where('id', '=', $ID)->delete();

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


   public function excludeVital()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PatientVitals::where('id', '=', $ID)->delete();

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







    public function postConsultation(Request $request)
    {
        
           $patient = new Consultation;
           $patient->patientid  = $request->input('patient_id');
           $patient->fullname = $request->input('fullname');
           $patient->opdnumber = $request->input('opd_number');
           $patient->consultation_type = $request->input('consultation_title');
           $patient->recommendation = $request->input('recommendation');
           $patient->doctorid = Auth::user()->getNameOrUsername();
           $patient->date = Carbon::now();
           $patient->save(); 


            $affectedRows = OPD::where('opd_number', '=', $request->input('opd_number'))
            ->update(array(
                           'status' => 'Review'));
            if($affectedRows > 0)
            {
                Activity::log([
          'contentId'   =>  $request->input('patient_id'),
          'contentType' => 'User',
          'action'      => 'Update',
          'description' => Auth::user()->getNameOrUsername().' reviewing patient '.$request->input('fullname'),
          'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
          ]);
        
              return redirect()
            ->route('opd-consultation')
            ->with('info','Patient has successfully been reviewed!');
            }
            else
            {
               return redirect()
            ->route('opd-consultation')
            ->with('info','Patient status failed to update!');
            }
    }


    public function dischargePatient()
    {

            $id = Input::get("ID");
            $dischargeComment = Input::get("comment");


            $affectedRows = OPD::where('id', '=', $id)->update(array('status' => 'Discharged','checkout_time' => Carbon::now() ));

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

   public function editReview()
    {
      //dd($opd_id);
    $opd_id = Input::get('id');


    $user = Consultation::find($opd_id);
 

    $data = Array(
        'patientid'=>$user->patientid,
        'fullname'=>$user->fullname,
        'opdnumber'=>$user->opdnumber,
        'consultation_title'=>$user->consultation_type,
      
    );
        return Response::json($data);
    } 


    public function getAgeOccupation()
    {
      $id = Input::get('id');
      $patient = Customer::where('patient_id',$id)->first();

      $age= $patient->date_of_birth->age;
      $occupation = $patient->occupation;
      $accounttype = $patient->accounttype;


      $added_response = array('age'=>$age,'occupation'=>$occupation,'accounttype'=>$accounttype);
      return  Response::json($added_response);

    }


    public function printAfterDentalSurgery($id)
    {

    try
    {
        //dd($id);

        $company = Company::get()->first();
        $patients       =   Customer::where('patient_id' , $id)->first();
      
        return view('dentist.print_after_dental_surgery', compact('patients','company'));

    }

    catch (\Exception $e) 
    {
           
           echo $e->getMessage();
            return redirect()
            ->route('404');
    }

    }


    public function printAfterDenture($id)
    {

    try
    {
        //dd($id);
       // \Event::fire(new SomeEvent($id));
       //dd(Pusher::trigger('my-channel', 'my-event', ['message' => 'A']));

        $company = Company::get()->first();
        $patients       =   Customer::where('patient_id' , $id)->first();
      
        return view('dentist.print_after_denture', compact('patients','company'));

    }

    catch (\Exception $e) 
    {
           
           echo $e->getMessage();
            return redirect()
            ->route('404');
    }

    }



    public function printDentalConsent($id)
    {

    try
    {
        //dd($id);
       // \Event::fire(new SomeEvent($id));
       //dd(Pusher::trigger('my-channel', 'my-event', ['message' => 'A']));

        $company = Company::get()->first();


        $procedures   = PatientProcedure::where('visitid' , $id)->first();

        $pid = $procedures->patientid;
        $vid = $procedures->visitid;

        //dd($vid);

        $patients       = Customer::where('patient_id' , $pid)->first();
        $visitdetails   = OPD::where('opd_number' , $vid)->first();

      
        return view('dentist.consent_form', compact('patients','company','visitdetails','procedures'));

    }

    catch (\Exception $e) 
    {
           
           echo $e->getMessage();
            return redirect()
            ->route('404');
    }

    }



    public function printExcuseDuty($id)
    {

    try
    {
        $company = Company::get()->first();
        $admission   = OPD::where('opd_number' , $id)->orderby('created_on','desc')->first();
      
        return view('doctor.excuse', compact('admission','company'));

    }

    catch (\Exception $e) 
    {
           
           echo $e->getMessage();
            return redirect()
            ->route('404');
    }

    }

    public function printRefusal($id)
    {

    try
    {
        $company = Company::get()->first();
        $admission   = OPD::where('opd_number' , $id)->first();
      
        return view('doctor.refuse_treatment', compact('admission','company'));

    }

    catch (\Exception $e) 
    {
           
           echo $e->getMessage();
            return redirect()
            ->route('404');
    }

    }


    public function printDentalTreatmentPlan($id)
    {

    try
    {
        $company = Company::get()->first();
        $admission   = PatientFurtherPlan::where('visitid' , $id)->get();
        $patients   = Customer::where('patient_id' , $admission[0]->patientid)->first();

        $payables = 0;
        foreach($admission as $bill)
       {
            $payables += ($bill->cost * $bill->procedure_quantity);
       }


      
        return view('dentist.print_plan', compact('admission','company','payables','patients'));

    }

    catch (\Exception $e) 
    {
           
           echo $e->getMessage();
           
    }

    }


    public function printEyeTreatmentPlan($id)
    {

    try
    {
        $company = Company::get()->first();
        $admission   = EyeExamination::where('visit_id' , $id)->first();
        $patients   = Customer::where('patient_id' , $admission->patient_id)->first();

        

      
        return view('optometry.print', compact('admission','company','patients'));

    }

    catch (\Exception $e) 
    {
           
           echo $e->getMessage();
           
    }

    }




    public function printVisitSummary($id)
    {
         //Timeline
        $admission   = OPD::where('opd_number' , $id)->first();
        $patients    = Customer::where('patient_id' , $admission->patient_id)->first();
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('visitid' ,'=', $id)->groupby('visitid')->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mype = PatientPE::where('visit_id' ,'=', $id)->groupby('visit_id')->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $myoralassessment = PatientAssessment::where('visit_id' ,'=', $id)->where('created_by','Dr. Cindy Tagoe')->get();
        $myplans = PatientPlan::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();
        $eyefindings = PatientDiagnosis::where('visitid' ,'=', $id)->where('created_by','Dr Hakeem Afful')->get();


        return view('doctor.summary', compact('admission','eyefindings','myoralassessment','myplans','patients','mycomplaints','myhistories','myros','mype','mydrugs','mylabs','mydiagnosis','myvitals'));
    }

     public function printExecutiveCover($id)
    {
         //Timeline
        $admission   = OPD::where('opd_number' , $id)->first();
        $patients    = Customer::where('patient_id' , $admission->patient_id)->first();
       

        return view('doctor.executive_cover', compact('admission','patients'));
    }

    public function printReferalLetter($id)
    {

        $admission   = OPD::where('opd_number' , $id)->first();
        $patients   = Customer::where('patient_id' , $admission->patient_id)->first();
        $mycomplaints = PatientComplaint::where('visitid' ,'=', $id)->get();
        $myhistories = PatientHistory::where('visitid' ,'=', $id)->get();
        $myros = ROS::where('visit_id' ,'=', $id)->get();
        $mype = PatientPE::where('visit_id' ,'=', $id)->get();
        $mydrugs = Prescription::where('visitid' ,'=', $id)->get();
        $mylabs = PatientInvestigation::where('visitid' ,'=', $id)->get();
        $mydiagnosis = PatientDiagnosis::where('visitid' ,'=', $id)->get();
         $myplan = PatientAssessment::where('visit_id' ,'=', $id)->get();
        $myvitals = PatientVitals::where('visit_id' ,'=', $id)->orderby('created_on','desc')->get();

        return view('doctor.referal', compact('admission','myplan','patients','mycomplaints','myhistories','myros','mype','mydrugs','mylabs','mydiagnosis','myvitals'));
        

    }


     public function updateInvestigationComment()
    {
           // $ID = Input::get('id');
            $affectedRows = PatientInvestigation::where('id', Input::get('id'))->update(array('remark'=> Input::get('drug_quantity')));

          
           if($affectedRows > 0)
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



    
}
