<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Customer;
use OrionMedical\Models\OPD;
use OrionMedical\Models\Bill;
use OrionMedical\Models\Serial;
use OrionMedical\Models\Prescription;
use OrionMedical\Models\Consultation;
use OrionMedical\Models\PatientCategory;
use OrionMedical\Models\Images;
use OrionMedical\Models\Doctor;
use OrionMedical\Models\ServiceType;
use OrionMedical\Models\Gender;
use OrionMedical\Models\InsuranceCompany;
use OrionMedical\Models\CivilStatus;
use OrionMedical\Models\BloodGroup;
use OrionMedical\Models\AccountType;
use OrionMedical\Models\Department;
use OrionMedical\Models\PatientTitle; 
use OrionMedical\Models\IdentificationType; 
use OrionMedical\Models\PatientVitals; 
use OrionMedical\Models\VisitType; 
use OrionMedical\Models\ServiceCharge;
use OrionMedical\Models\PatientDiagnosis;
use OrionMedical\Models\PatientProcedure;
use OrionMedical\Models\PatientInvestigation;
use OrionMedical\Models\AdmissionStatus;
use OrionMedical\Models\AdmissionLocation;
use OrionMedical\Models\PatientHistory;
use OrionMedical\Models\AuthorizationCode;
use OrionMedical\Models\Branch;
use OrionMedical\Models\Payments;
use OrionMedical\Models\PatientStatement;
use OrionMedical\Models\SMS;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Carbon\Carbon;
use Response;
use DB;
use Auth;
use Input;
use OneSignal;

class OPDController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth');
    }


    public function loadAccount()
    {
            try
        {

                $id = Input::get("patient_id");
                $accounttype = Customer::where('patient_id',$id)->orwhere('patient_id','W0820170000')->orderby('accounttype','asc')->get();
                return  Response::json($accounttype);
        }

        catch (\Exception $e) 
        { 
               echo $e->getMessage();
            
        }
    }

    public function printticket($id)
    {
      $patient       = OPD::where('opd_number',$id)->first();
      return view ('opd.slip',compact('patient'));
    }
    
    public function index()
    {
        $today =        Carbon::now()->format('Y-m-d').'%';

        $discharged      = OPD::where('created_on', 'like', $today)->count();
        $checkedin       = Customer::where('created_at', 'like', $today)->count();
        $reviewing       = OPD::where('created_on', 'like', $today)->count();
        $billingaccounts = AccountType::orderby('id','desc')->get();

         $branches = Branch::get();
         $walkins  = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD-Walk In')->get();
        //$newadmissions   = OPD::where('status','Review')->count();

        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','IPD')->get();
        $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();
        $today           = Carbon::now()->format('Y-m-d').'%';
        $patients        = Customer::where('status','Active')->where('created_at', 'like', $today)->orderBy('created_at', 'asc')->paginate(30);
        return view('opd.index', compact('patients','walkins','billingaccounts','visittypes','branches','generalservices','discharged','checkedin','reviewing'))
        ->with('doctors',$doctors)
        ->with('servicetype',$servicetype)
        ->with('departments',$departments);
    }


    public function getPatientProfileOPD($id)
   {
    $servicetype   = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->get();          
    $departments   = Department::get();
    $accounttype = AccountType::get();
    $doctors       = Doctor::get();  
    $visittypes    = VisitType::get();
    $medications   = Prescription::where('patientid','=',$id)->orderBy('created_on', 'DESC')->get();    
    $images        = Images::where('accountnumber','=',$id)->where('source',null)->get();
    $patients      = Customer::where('patient_id' ,'=', $id)->first();
    $insurers      = InsuranceCompany::get();
    $consultations = OPD::where('patient_id' ,'=', $id)->orderBy('created_on', 'DESC')->get();
    $diagnosis     = PatientDiagnosis::where('patient_id' ,'=', $id)->orderBy('date', 'DESC')->get();
    $procedures    = PatientProcedure::where('patientid' ,'=', $id)->orderBy('created_on', 'DESC')->get();
    $investigations = PatientInvestigation::where('patientid' ,'=', $id)->orderBy('created_on', 'DESC')->get();
    $allergies     = PatientHistory::where('patientid' ,'=', $id)->orderBy('created_on', 'DESC')->get();
    $statement          = PatientStatement::where('patient_id' ,'=', $id)->orderBy('visit_id', 'asc')->get();
    $branches = Branch::get();

    $billingaccounts = AccountType::get();
    $stickers = AuthorizationCode::where('status','Unused')->get();


    $bills              = Bill::where('patient_id', $id)->orderBy('date', 'desc')->get();
    $paiditems          = Payments::where('PatientID', $id)->get();
    
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

    //dd($receivables);
       //Vital Chart Graph
        

    return view('patient.profile', compact('patients','stickers','statement','payables','receivables','outstanding','branches','accounttype','billingaccounts','allergies','diagnosis','procedures','investigations','bills','visittypes','consultations','images','departments','doctors','insurers','servicetype','medications'));

   }

    public function findPatientOPD(Request $request)
    {
         $today =        Carbon::now()->format('Y-m-d').'%';

        $discharged      = OPD::where('created_on', 'like', $today)->count();
        $checkedin       = Customer::where('created_at', 'like', $today)->count();
        $reviewing       = OPD::where('created_on', 'like', $today)->count();
        $billingaccounts = AccountType::orderby('id','desc')->get();
         $branches = Branch::get();

         $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','IPD')->get();
        $walkins  = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD-Walk In')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();


        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $patients = Customer::where('fullname', 'like', "%$search%")
            ->where('status','Active')
            ->orWhere('mobile_number', 'like', "%$search%")
            ->orWhere('date_of_birth', 'like', "%$search%")
            ->orWhere('patient_id', 'like', "%$search%")
            ->orWhere('company', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(150)
            ->appends(['search' => $search])
        ;
        
        return view('opd.index', compact('patients','branches','walkins','billingaccounts','visittypes','generalservices','discharged','checkedin','reviewing'))
        ->with('doctors',$doctors)
        ->with('servicetype',$servicetype)
        ->with('departments',$departments);
    }



    public function bookAppointment()
    {

       return view('opd.appointment');
      
    }


    public function getStickerCount()
    {

          if(Input::get("authorization_code"))
            {
                    $ID = Input::get("authorization_code");
                    $affectedRows = AuthorizationCode::where('card_number', $ID)->where('status','Unused')->count();

                    $stocklevel = $affectedRows;

                if($stocklevel == 1)
                {
                    $ini   = array('OK'=>'OK');
                    return  Response::json($ini);
                }
            
                 else
                {
                    $ini   = array('No Data' => $ID);
                    return  Response::json($ini);
                }
            }
                else
               {
                    $ini   = array('No Data'=>'No Data');
                    return  Response::json($ini);
                }
    }



    public function getWhatsappMessagestoSend()
    {

      $messages = SMS::where('status','Unsent')->paginate(30);
      return view('notifications.whatsapp',compact('messages'));
    }


     public function getLoyaltyMessages()
    {

      $messages = AuthorizationCode::paginate(30);
      return view('notifications.loyalty',compact('messages'));
    }



    public function updateWhatsAppStatus()
    {


         $id = Input::get("id");
        
            $affectedRows = SMS::where('id', $id)->update(array('status' => 'Sent'));

          

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



    public function findVisitHistory(Request $request)
    {
         $today =        Carbon::now()->format('Y-m-d').'%';

        $discharged      = OPD::where('created_on', 'like', $today)->count();
        $checkedin       = Customer::where('created_at', 'like', $today)->count();
        $reviewing       = OPD::where('created_on', 'like', $today)->count();

         $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','IPD')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();
        $billingaccounts = AccountType::get();
        $branches = Branch::get();

        // $this->validate($request, [
        //     'search' => 'required'
        // ]);

        $search = $request->get('search');
        $time   = explode(" - ", Input::get('review_period')); 
        

        if(!$search=="")
        {
        $patients = OPD::where('name', 'like', "%$search%")
             ->orWhere('opd_number', 'like', "%$search%")
            ->orWhere('consultation_type', 'like', "%$search%")
            ->orWhere('referal_doctor', 'like', "%$search%")
            ->orWhere('visit_type', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search])
        ;
        }
        else
        {
            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

            //dd($from);

            $patients = OPD::whereBetween('updated_on',array($from." 00:00:00",$to." 23:59:59"))
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search])
        ;
        }

        
        return view('opd.checkedin', compact('patients','branches','billingaccounts','visittypes','generalservices','discharged','checkedin','reviewing'))
        ->with('doctors',$doctors)
        ->with('servicetype',$servicetype)
        ->with('departments',$departments);
    }


    public function findNurseFolder(Request $request)
    {
         $today =        Carbon::now()->format('Y-m-d').'%';

        $discharged      = OPD::where('created_on', 'like', $today)->count();
        $checkedin       = Customer::where('created_at', 'like', $today)->count();
        $reviewing       = OPD::where('created_on', 'like', $today)->count();
        $branches = Branch::get();

         $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','IPD')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();
        $statuses   =   AdmissionStatus::get();
        $locations  =   AdmissionLocation::get();

        // $this->validate($request, [
        //     'search' => 'required'
        // ]);

        $search = $request->get('search');
        $time   = explode(" - ", Input::get('review_period')); 
        

        if(!$search=="")
        {
        $patients = OPD::where('name', 'like', "%$search%")
            ->where('consultation_type','<>', "Pharmacy Walk In")
             ->orWhere('opd_number', 'like', "%$search%")
            ->orWhere('consultation_type', 'like', "%$search%")
            ->orWhere('referal_doctor', 'like', "%$search%")
            ->orWhere('visit_type', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search])
        ;
        }
        else
        {
            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

            //dd($from);

            $patients = OPD::whereBetween('updated_on',array($from." 00:00:00",$to." 23:59:59"))
            ->where('consultation_type','<>', "Pharmacy Walk In")
            ->orderBy('created_on','desc')
            ->paginate(150)
            ->appends(['search' => $search])
        ;
        }

        
        return view('nurse.index', compact('patients','branches','statuses','locations','visittypes','generalservices','discharged','checkedin','reviewing'))
        ->with('doctors',$doctors)
        ->with('servicetype',$servicetype)
        ->with('departments',$departments);
    }

     


    public function getCheckedIn()
    {
          $today =        Carbon::now()->format('Y-m-d').'%';

        $discharged      = OPD::where('created_on', 'like', $today)->count();
        $checkedin       = Customer::where('created_at', 'like', $today)->count();
        $reviewing       = OPD::where('created_on', 'like', $today)->count();
        $branches = Branch::get();

        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','IPD')->get();
        $departments    = Department::get();
        $doctors        = Doctor::get();
         $visittypes    = VisitType::get();
         $billingaccounts = AccountType::get();

       
        $patients         = OPD::where('created_on', 'like', $today)->orderBy('created_on', 'DESC')->paginate(30);
       
        return view('opd.checkedin', compact('patients','branches','billingaccounts','visittypes','discharged','checkedin','reviewing'))
        ->with('doctors',$doctors)
        ->with('servicetype',$servicetype)
        ->with('departments',$departments);
    }

    public function getReview()
    {
         $discharged      = OPD::where('status','Discharged')->count();
        $checkedin       = OPD::where('status','Checked-In')->count();
        $reviewing       = OPD::where('status','Review')->count();
        $branches = Branch::get();
        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','IPD')->get();
        $departments    = Department::get();
        $doctors        = Doctor::get();
         $visittypes      = VisitType::get();
        $patients       = OPD::where('status','Review')->orderBy('created_on', 'asc')->paginate(30);
        return view('opd.checkedin', compact('patients','branches','visittypes','discharged','checkedin','reviewing'))
        ->with('doctors',$doctors)
        ->with('servicetype',$servicetype)
        ->with('departments',$departments);
    }

    public function getDischarged()
    {
         $discharged      = OPD::where('status','Discharged')->count();
        $checkedin       = OPD::where('status','Checked-In')->count();
        $reviewing       = OPD::where('status','Review')->count();
        $branches = Branch::get();

        $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Specialist')->orwhere('department','IPD')->get();
        $departments    = Department::get();
        $doctors        = Doctor::get();
         $visittypes      = VisitType::get();
        $patients       = OPD::where('status','Discharged')->orderBy('created_on', 'asc')->paginate(30);
        return view('opd.checkedin', compact('patients','branches','visittypes','discharged','checkedin','reviewing'))
        ->with('doctors',$doctors)
        ->with('servicetype',$servicetype)
        ->with('departments',$departments);
    }


    public function generateStaffID()
{

    $prefix = '';
    if(Input::get('location') == 'Kanda (House of Balm)' )
    {
        $prefix = 'GMK';
    }
    elseif(Input::get('location') == 'Avenor (City of God)' )
    {
        $prefix = 'GMA';
    }
    else
    {
         $prefix = 'GMK';
    }

    $number = Serial::where('name','=','visit')->first();
    $number = $number->counter;
    $account = str_pad($number,5, '0', STR_PAD_LEFT);
    $myaccount=  $prefix.date('ymd').$account;
    Serial::where('name','=','visit')->increment('counter',1);
    return  $myaccount;
}
    
    public function createOPD(Request $request)
    {
        
        $provider = Customer::where('patient_id',$request->input('patient_id'))->first();
        
        $care_provider = '';
        $myaccounttype = 'Private';

        if($request->input('accounttype')=='Corporate') 
        {
          $care_provider = $provider->company; 
          $myaccounttype = 'Corporate';
        }
        if($request->input('accounttype')=='Health Insurance') 
        {
          $care_provider = $provider->insurance_company;
          $myaccounttype = 'Health Insurance'; 
        }
        if($request->input('accounttype')=='Private') 
        {
          $care_provider = 'Private'; 
          $myaccounttype = 'Private';
        }

        if($request->input('accounttype')=='Walkin') 
        {
          $care_provider = 'Private';
          $myaccounttype = 'Private'; 
        }

        if($request->input('accounttype')=='Gratis') 
        {
          $care_provider = 'Gratis';
          $myaccounttype = 'Gratis'; 
        }
       
       //dd($request->input('accounttype'));

       // echo 'true';
        if(!empty($care_provider))
        {
          $visit_id = $this->generateStaffID(10);
          $transactionid = uniqid(20);
         



           $patient                    = new OPD;
           $patient->opd_number        = $visit_id;
           $patient->patient_id        = $request->input('patient_id');
           $patient->name              = $request->input('fullname');
           $patient->referal_doctor    = $request->input('referal_doctor');
           $patient->department        = 'OPD';
           $patient->visit_type        = $request->input('visit_type');
           $patient->consultation_type = $request->input('consultation_type');
           $patient->payercode         = $myaccounttype;
           $patient->care_provider     =  $care_provider;
           $patient->created_on        =  Carbon::now();
           $patient->created_by        =  Auth::user()->getNameOrUsername();
           $patient->updated_on        =  Carbon::now();
           $patient->updated_by        =  Auth::user()->getNameOrUsername();
           $patient->uuid              =  $transactionid;
           $patient->branch            =  $request->input('location');
           $patient->authorization_code =  $request->input('authorization_code');
    

           if($patient->save()) 
          {


             $affectedRows = Customer::where('patient_id',Input::get('patient_id'))->update(array('created_at' => Carbon::yesterday()));

             $updateauthcodes = AuthorizationCode::where('card_number',Input::get('authorization_code'))->update(array('status' => 'Used','assigned_to'=>Input::get('fullname'),'created_on'=>Carbon::now(),'created_by'=>Auth::user()->getNameOrUsername(),'assigned_on'=>Carbon::now(),'reference_number'=>Input::get('patient_id')));
            
             
             $category = ServiceCharge::where('type',$request->input('consultation_type'))->value('department');
             $mycopayer = Customer::where('patient_id',Input::get('patient_id'))->first();

            switch($request->input('accounttype')) 
            {
         
                case 'Health Insurance':


                    if($care_provider=='Glico Health Care')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('glico');
                         
                       }

                     elseif($care_provider=='Glico Tpa Barclays')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('glico');
                         
                       }

                    elseif($care_provider=='Cosmopolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('cosmopolitan');
                         
                       }


                     elseif($care_provider=='Premier Mutual Health')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('premier');
                         
                       }


                     elseif($care_provider=='Acacia Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('acacia');
                         
                       }

                        elseif($care_provider=='Apex Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('apex');
                         
                       }

                      elseif($care_provider=='Metropolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('metropolitan');
                         
                       }

                       elseif($care_provider=='Nationwide Mutual Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('nationwide');
                         
                       }

                        elseif($care_provider=='Universal Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('universal');
                         
                       }


                       elseif($care_provider=='Phoenix Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('phoenix');
                         
                       }

                       else
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('insurance');
                          
                       }

                       $savecopayer  =  $mycopayer->insurance_company;
                       
                      
                    break;
                
                case 'Corporate':
                     $service_charge  = ServiceCharge::where('type',$request->input('consultation_type'))->value('corporate');
                      $savecopayer    =  $mycopayer->company;
                      
                    break;
                case 'Private':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('walkin');
                      $savecopayer =  'Private';
                       
                    break;
                case 'Walkin':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('walkin');
                      $savecopayer =  'Private';
                      
                case 'Gratis':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('charge');
                      $savecopayer =  'Private';
                    
                    break;
           }



         
          
           $bill                       = new Bill;
           $bill->patient_id           = $request->input('patient_id');
           $bill->visit_id             = $visit_id;
           $bill->fullname             = $request->input('fullname');
           $bill->item_name            = $request->input('consultation_type');
           $bill->quantity             = 1;
           $bill->rate                 = $service_charge;
           $bill->amount               = $service_charge;
           $bill->category             = $category;
           $bill->note                 = 'Unpaid';
           $bill->uuid                 = $transactionid;
           $bill->copayer              = $savecopayer;
           $bill->payercode            = $myaccounttype;
           $bill->created_by           = Auth::user()->getNameOrUsername();
           $bill->date                 = Carbon::now();
           $bill->save(); 

           //
           $affectedRows2 = Bill::where('patient_id',Input::get('patient_id'))->where('item_name','REGISTRATION OF PATIENT')->where('visit_id','0')->update(array('visit_id' => $visit_id));
            OneSignal::sendNotificationToAll($request->input('fullname')." has been checked in for ".$request->input('consultation_type'), $url = null, $data = null, $buttons = null, $schedule = null);
           

           if($request->input('consultation_type')=="WALK-IN PHARMACY")
           {
             return redirect()
           ->route('walkin-service',$visit_id)
           ->with('info','Patient has successfully been added to OPD !');
           }
            
           elseif($request->input('consultation_type')=="WALK-IN LAB")
           {
             return redirect()
           ->route('walkin-service',$visit_id)
           ->with('info','Patient has successfully been added to OPD !');
           }

           elseif($request->input('consultation_type')=="WALK-IN DIAGNOSTIC")
           {
             return redirect()
           ->route('walkin-service',$visit_id)
           ->with('info','Patient has successfully been added to OPD !');
           }

           if($request->input('consultation_type')=="WALK-IN SCAN")
           {
             return redirect()
           ->route('walkin-service',$visit_id)
           ->with('info','Patient has successfully been added to OPD !');
           }

           else
           {
           return redirect()
           ->route('waiting-opd')
           ->with('info','Patient has successfully been added to OPD !');
           }

         }
         
         else
         {
           return redirect()
           ->back()
           ->with('error','OPD registration failed! Ensure Company name or Insurance details details have been correctly filled');

         }
       }

         else
         {
           return redirect()
           ->back()
           ->with('error','OPD registration failed! Ensure Company name or Insurance details details have been correctly filled' );

         }
     }


     public function createIPDfromOPD(Request $request)
    {
        
        $provider = Customer::where('patient_id',$request->input('patient_id'))->first();
        
        $care_provider = '';
        $myaccounttype = 'Private';

        if($request->input('ipd_accounttype')=='Corporate') 
        {
          $care_provider = $provider->company; 
          $myaccounttype = 'Corporate';
        }
        if($request->input('ipd_accounttype')=='Health Insurance') 
        {
          $care_provider = $provider->insurance_company;
          $myaccounttype = 'Health Insurance'; 
        }
        if($request->input('ipd_accounttype')=='Private') 
        {
          $care_provider = 'Private'; 
          $myaccounttype = 'Private';
        }

        if($request->input('ipd_accounttype')=='Walkin') 
        {
          $care_provider = 'Private';
          $myaccounttype = 'Private'; 
        }

        if($request->input('ipd_accounttype')=='Gratis') 
        {
          $care_provider = 'Gratis';
          $myaccounttype = 'Gratis'; 
        }
       
       //dd($request->input('accounttype'));

       // echo 'true';
        if(!empty($care_provider))
        {
          $visit_id = $this->generateStaffID(10);
          $transactionid = uniqid(20);
         



           $patient                    = new OPD;
           $patient->opd_number        = $visit_id;
           $patient->patient_id        = $request->input('patient_id');
           $patient->name              = $request->input('fullname');
           $patient->referal_doctor    = Auth::user()->getNameOrUsername();
           $patient->department        = 'IPD';
           $patient->visit_type        = $request->input('visit_type');
           $patient->consultation_type = $request->input('consultation_type');
           $patient->payercode         = $myaccounttype;
           $patient->care_provider     =  $care_provider;
           $patient->created_on        =  Carbon::now();
           $patient->created_by        =  Auth::user()->getNameOrUsername();
           $patient->updated_on        =  Carbon::now();
           $patient->updated_by        =  Auth::user()->getNameOrUsername();
           $patient->uuid              =  $transactionid;
           $patient->branch            =  $request->input('location');
           $patient->authorization_code =  $request->input('authorization_code');
    

           if($patient->save()) 
          {


             $affectedRows = Customer::where('patient_id',Input::get('patient_id'))->update(array('created_at' => Carbon::yesterday()));
            
             $category = ServiceCharge::where('type',$request->input('consultation_type'))->value('department');

             $mycopayer = Customer::where('patient_id',Input::get('patient_id'))->first();

            switch($request->input('ipd_accounttype')) 
            {
         
                case 'Health Insurance':


                    if($care_provider=='Glico Health Care')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('glico');
                         
                       }

                     elseif($care_provider=='Glico Tpa Barclays')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('glico');
                         
                       }

                    elseif($care_provider=='Cosmopolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('cosmopolitan');
                         
                       }


                     elseif($care_provider=='Premier Mutual Health')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('premier');
                         
                       }


                     elseif($care_provider=='Acacia Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('acacia');
                         
                       }

                        elseif($care_provider=='Apex Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('apex');
                         
                       }

                      elseif($care_provider=='Metropolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('metropolitan');
                         
                       }

                       elseif($care_provider=='Nationwide Mutual Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('nationwide');
                         
                       }

                        elseif($care_provider=='Universal Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('universal');
                         
                       }


                       elseif($care_provider=='Phoenix Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('phoenix');
                         
                       }

                       else
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('insurance');
                          
                       }

                       $savecopayer  =  $mycopayer->insurance_company;
                       
                      
                    break;
                
                case 'Corporate':
                     $service_charge  = ServiceCharge::where('type',$request->input('consultation_type'))->value('corporate');
                      $savecopayer    =  $mycopayer->company;
                      
                    break;
                case 'Private':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('walkin');
                      $savecopayer =  'Private';
                       
                    break;
                case 'Walkin':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('walkin');
                      $savecopayer =  'Private';
                      
                case 'Gratis':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('charge');
                      $savecopayer =  'Private';
                    
                    break;
           }



         
          
           $bill                       = new Bill;
           $bill->patient_id           = $request->input('patient_id');
           $bill->visit_id             = $visit_id;
           $bill->fullname             = $request->input('fullname');
           $bill->item_name            = $request->input('consultation_type');
           $bill->quantity             = 1;
           $bill->rate                 = $service_charge;
           $bill->amount               = $service_charge;
           $bill->category             = $category;
           $bill->note                 = 'Unpaid';
           $bill->uuid                 = $transactionid;
           $bill->copayer              = $savecopayer;
           $bill->payercode            = $myaccounttype;
           $bill->created_by           = Auth::user()->getNameOrUsername();
           $bill->date                 = Carbon::now();
           $bill->save(); 

           //
           $affectedRows2 = Bill::where('patient_id',Input::get('patient_id'))->where('item_name','REGISTRATION OF PATIENT')->where('visit_id','0')->update(array('visit_id' => $visit_id));
            OneSignal::sendNotificationToAll($request->input('fullname')." has been checked in for ".$request->input('consultation_type'), $url = null, $data = null, $buttons = null, $schedule = null);
           

           if($request->input('consultation_type')=="WALK-IN PHARMACY")
           {
             return redirect()
           ->route('walkin-service',$visit_id)
           ->with('info','Patient has successfully been added to OPD !');
           }
            
           elseif($request->input('consultation_type')=="WALK-IN LAB")
           {
             return redirect()
           ->route('walkin-service',$visit_id)
           ->with('info','Patient has successfully been added to OPD !');
           }

           elseif($request->input('consultation_type')=="WALK-IN DIAGNOSTIC")
           {
             return redirect()
           ->route('walkin-service',$visit_id)
           ->with('info','Patient has successfully been added to OPD !');
           }

           if($request->input('consultation_type')=="WALK-IN SCAN")
           {
             return redirect()
           ->route('walkin-service',$visit_id)
           ->with('info','Patient has successfully been added to OPD !');
           }

           else
           {
           return redirect()
           ->route('ipd-consultation')
           ->with('info','Patient has successfully been added to OPD !');
           }

         }
         
         else
         {
           return redirect()
           ->back()
           ->with('error','OPD registration failed! Ensure Company name or Insurance details details have been correctly filled');

         }
       }

         else
         {
           return redirect()
           ->back()
           ->with('error','OPD registration failed! Ensure Company name or Insurance details details have been correctly filled' );

         }
     }



     public function createOPDWalkIn(Request $request)
    {
        
        $provider = Customer::where('patient_id',$request->input('patient_id'))->first();
        
       $care_provider = '';
        $myaccounttype = 'Private';

        if($request->input('accounttype')=='Corporate') 
        {
          $care_provider = $provider->company; 
          $myaccounttype = 'Corporate';
        }
        if($request->input('accounttype')=='Health Insurance') 
        {
          $care_provider = $provider->insurance_company;
          $myaccounttype = 'Health Insurance'; 
        }
        if($request->input('accounttype')=='Private') 
        {
          $care_provider = 'Private'; 
          $myaccounttype = 'Private';
        }

        if($request->input('accounttype')=='Walkin') 
        {
          $care_provider = 'Private';
          $myaccounttype = 'Private'; 
        }

        if($request->input('accounttype')=='Gratis') 
        {
          $care_provider = 'Gratis';
          $myaccounttype = 'Gratis'; 
        }
       
       
       //dd($request->input('accounttype'));

       // echo 'true';
        if(!empty($care_provider))
        {
          $visit_id = $this->generateStaffID(10);
          $transactionid = uniqid(20);

           $patient                    = new OPD;
           $patient->opd_number        = $visit_id;
           $patient->patient_id        = $request->input('patient_id');
           $patient->name              = $request->input('fullname');
           $patient->referal_doctor    = $request->input('referal_doctor');
           $patient->department        = 'OPD';
           $patient->visit_type        = $request->input('visit_type');
           $patient->consultation_type = $request->input('consultation_type2');
           $patient->payercode         = $request->input('accounttype');
           $patient->care_provider     =  $care_provider;
           $patient->created_on        =  Carbon::now();
           $patient->created_by        =  Auth::user()->getNameOrUsername();
           $patient->updated_on        =  Carbon::now();
           $patient->updated_by        =  Auth::user()->getNameOrUsername();
           $patient->uuid              =  $transactionid;
    

           if($patient->save()) 
          {


             $affectedRows = Customer::where('patient_id',Input::get('patient_id'))->update(array('created_at' => Carbon::yesterday()));
            
             $category = ServiceCharge::where('type',$request->input('consultation_type2'))->value('department');

             $mycopayer = Customer::where('patient_id',Input::get('patient_id'))->first();

            switch($request->input('accounttype')) 
            {
         
                case 'Health Insurance':


                    if($care_provider=='Glico Health Care')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('glico');
                         
                       }

                     elseif($care_provider=='Glico Tpa Barclays')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('glico');
                         
                       }

                    elseif($care_provider=='Cosmopolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('cosmopolitan');
                         
                       }


                     elseif($care_provider=='Premier Mutual Health')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('premier');
                         
                       }


                     elseif($care_provider=='Acacia Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('acacia');
                         
                       }

                        elseif($care_provider=='Apex Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('apex');
                         
                       }

                      elseif($care_provider=='Metropolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('metropolitan');
                         
                       }

                       elseif($care_provider=='Nationwide Mutual Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('nationwide');
                         
                       }

                        elseif($care_provider=='Universal Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('universal');
                         
                       }


                       elseif($care_provider=='Phoenix Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('phoenix');
                         
                       }

                       else
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('insurance');
                          
                       }

                       $savecopayer =  $mycopayer->insurance_company;
                      
                    break;
                case 'Corporate':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('corporate');
                      $savecopayer =  $mycopayer->company;
                    break;
                case 'Private':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('walkin');
                      $savecopayer =  'Private';
                    break;
                case 'Gratis':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('charge');
                      $savecopayer =  'Private';
                    break;
           }



         
          
           $bill                       = new Bill;
           $bill->patient_id           = $request->input('patient_id');
           $bill->visit_id             = $visit_id;
           $bill->fullname             = $request->input('fullname');
           $bill->item_name            = $request->input('consultation_type2');
           $bill->quantity             = 1;
           $bill->rate                 = $service_charge;
           $bill->amount               = $service_charge;
           $bill->category             = $category;
           $bill->note                 = 'Unpaid';
           $bill->uuid                 = $transactionid;
           $bill->copayer              = $savecopayer;
           $bill->payercode            = $request->input('accounttype');
           $bill->created_by           = Auth::user()->getNameOrUsername();
           $bill->date                 = Carbon::now();
           $bill->save(); 

           //
           
            OneSignal::sendNotificationToAll($request->input('fullname')." has been checked in for ".$request->input('consultation_type'), $url = null, $data = null, $buttons = null, $schedule = null);
           
           return redirect()
            ->route('walkin-service',$visit_id)
           ->with('info','Patient has successfully been added to OPD !');


            
         }
         
         else
         {
           return redirect()
           ->back()
           ->with('error','OPD registration failed! Ensure account details have been correctly filled, *Company name/ Insurance details');

         }
       }

         else
         {
           return redirect()
           ->back()
           ->with('error','OPD registration failed! Ensure account details have been correctly filled, *Company name/ Insurance details' );

         }
     }
     
     

    


    public function updateOPD(Request $request)
    {   

            $provider = Customer::where('patient_id',$request->input('patient_id'))->first();
        
            $care_provider = '';
        $myaccounttype = 'Private';

        if($request->input('accounttype')=='Corporate') 
        {
          $care_provider = $provider->company; 
          $myaccounttype = 'Corporate';
        }
        if($request->input('accounttype')=='Health Insurance') 
        {
          $care_provider = $provider->insurance_company;
          $myaccounttype = 'Health Insurance'; 
        }
        if($request->input('accounttype')=='Private') 
        {
          $care_provider = 'Private'; 
          $myaccounttype = 'Private';
        }

        if($request->input('accounttype')=='Walkin') 
        {
          $care_provider = 'Private';
          $myaccounttype = 'Private'; 
        }

        if($request->input('accounttype')=='Gratis') 
        {
          $care_provider = 'Gratis';
          $myaccounttype = 'Gratis'; 
        }
       
       

             if(!empty($care_provider))
        {

            $affectedRows = OPD::where('opd_number',  $request->input('opd_number'))
            ->update(array(

           'name'                => $request->input('fullname'),
           'referal_doctor'      => $request->input('referal_doctor'),
           'visit_type'          => $request->input('visit_type'),
           'authorization_code'   => $request->input('authorization_code'),
           'consultation_type'   => $request->input('consultation_type'),
           'care_provider'       => $care_provider,
           'payercode'           => $request->input('accounttype')));


             $category = ServiceCharge::where('type',$request->input('consultation_type'))->value('department');

            $updateauthcodes = AuthorizationCode::where('card_number',Input::get('authorization_code'))->update(array('status' => 'Used','assigned_to'=>Input::get('fullname'),'created_on'=>Carbon::now(),'created_by'=>Auth::user()->getNameOrUsername(),'assigned_on'=>Carbon::now(),'reference_number'=>Input::get('patient_id')));
            
             

             $mycopayer = Customer::where('patient_id',Input::get('patient_id'))->first();

            switch($request->input('accounttype')) 
            {
         
                 case 'Health Insurance':


                    if($care_provider=='Glico Health Care')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('glico');
                         
                       }

                     elseif($care_provider=='Glico Tpa Barclays')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('glico');
                         
                       }

                    elseif($care_provider=='Cosmopolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('cosmopolitan');
                         
                       }


                     elseif($care_provider=='Premier Mutual Health')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('premier');
                         
                       }


                     elseif($care_provider=='Acacia Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('acacia');
                         
                       }

                        elseif($care_provider=='Apex Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('apex');
                         
                       }

                      elseif($care_provider=='Metropolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('metropolitan');
                         
                       }

                       elseif($care_provider=='Nationwide Mutual Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('nationwide');
                         
                       }

                        elseif($care_provider=='Universal Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('universal');
                         
                       }

                       elseif($care_provider=='Phoenix Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('phoenix');
                         
                       }

                       else
                       {
                         $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('insurance');
                          
                       }

                       $savecopayer =  $mycopayer->insurance_company;
                      
                    break;
                case 'Corporate':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('corporate');
                      $savecopayer =  $mycopayer->company;
                    break;
                case 'Private':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('walkin');
                      $savecopayer =  'Private';
                    break;
                case 'Walkin':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('walkin');
                      $savecopayer =  'Private';
                    break;
                case 'Gratis':
                     $service_charge = ServiceCharge::where('type',$request->input('consultation_type'))->value('charge');
                      $savecopayer =  'Private';
                    break;
           }

             $affectedRows2 = Bill::where('uuid',  $request->input('uuid'))
            ->update(array(

                       'item_name'   => $request->input('consultation_type'),
                       'rate'        => $service_charge,
                       'copayer'     => $savecopayer,
                       'payercode'   => $request->input('accounttype'),
                       'amount'      => $service_charge));



                          
            if($affectedRows > 0)
            {
             
            return redirect()
            ->back()
            ->with('info','OPD Details has successfully been updated!');
            }

            else
            {
            return redirect()
            ->back()
            ->with('error','OPD Details did not update!');
            }

        }

         else
         {
           return redirect()
           ->back()
           ->with('error','OPD registration failed! Ensure account details have been correctly filled, *Company name/ Insurance details' );

         }



    }


    public function createReferral(Request $request)
    {
        
       //  $provider = Customer::where('patient_id',$request->input('ref_patient_id'))->first();
        
       //  $care_provider = '';

       //  if($provider->accounttype=='Corporate') 
       //  {
       //    $care_provider = $provider->company; 
       //  }
       //  if($provider->accounttype=='Health Insurance') 
       //  {
       //    $care_provider = $provider->insurance_company; 
       //  }
       //  if($provider->accounttype=='Private') 
       //  {
       //    $care_provider = 'Private'; 
       //  }
       //  if($provider->accounttype=='Gratis') 
       //  {
       //    $care_provider = 'Gratis'; 
       //  }
       

       
       //  if(!empty( $request->input('ref_consultation_type')))
       //  {
       //    $visit_id = $this->generateStaffID(10);
       //    $transactionid = uniqid(20);

       //     $patient                    = new OPD;
       //     $patient->opd_number        = $visit_id;
       //     $patient->patient_id        = $request->input('ref_patient_id');
       //     $patient->name              = $request->input('ref_fullname');
       //     $patient->referal_doctor    = $request->input('ref_referal_doctor');
       //     $patient->department        = 'OPD';
       //     $patient->visit_type        = $request->input('ref_visit_type');
       //     $patient->consultation_type = $request->input('ref_consultation_type');
       //     $patient->payercode         = $request->input('ref_accounttype');
       //     $patient->care_provider     =  $care_provider;
       //     $patient->created_on        =  Carbon::now();
       //     $patient->created_by        =  Auth::user()->getNameOrUsername();
       //     $patient->updated_on        =  Carbon::now();
       //     $patient->updated_by        =  Auth::user()->getNameOrUsername();
       //     $patient->uuid              =  $transactionid;
    

       //     if($patient->save()) 
       //    {

            
           
       //      $category = ServiceCharge::where('type',$request->input('ref_consultation_type'))->value('department');
       //      switch($request->input('ref_accounttype')) 
       //      {
         
       //  case 'Health Insurance':
       //        $service_charge = ServiceCharge::where('type',$request->input('ref_consultation_type'))->value('insurance');
       //      break;
       //  case 'Corporate':
       //       $service_charge = ServiceCharge::where('type',$request->input('ref_consultation_type'))->value('corporate');
       //      break;
       //  case 'Private':
       //       $service_charge = ServiceCharge::where('type',$request->input('ref_consultation_type'))->value('walkin');
       //      break;
       //  case 'Gratis':
       //       $service_charge = ServiceCharge::where('type',$request->input('ref_consultation_type'))->value('charge');
       //      break;
       //     }
         
          
       //     $bill                       = new Bill;
       //     $bill->patient_id           = $request->input('ref_patient_id');
       //     $bill->visit_id             = $visit_id;
       //     $bill->fullname             = $request->input('ref_fullname');
       //     $bill->item_name            = $request->input('ref_consultation_type');
       //     $bill->quantity             = 1;
       //     $bill->rate                 = $service_charge;
       //     $bill->amount               = $service_charge;
       //     $bill->category             = $category;
       //     $bill->note                 = 'Unpaid';
       //     $bill->uuid                  = $transactionid;
       //     $bill->created_by           = Auth::user()->getNameOrUsername();
       //     $bill->date                 = Carbon::now();
       //     $bill->save(); 

       //     return redirect()
       //     ->back()
       //     ->with('info','Patient has successfully been added to OPD !');
       //   }
         
       //   else
       //   {
       //     return redirect()
       //     ->back()
       //     ->with('error','OPD registration failed!');

       //   }
       // }

       //   else
       //   {
       //     return redirect()
       //     ->back()
       //     ->with('error','OPD registration failed!');

       //   }
    }

    public function searchbyVisitID()
    {

      if(Input::get('id')=="")
      {

        $visitid = $this->generateStaffID(10);

        $details = Customer::where('patient_id','W0820170000')->first();
        $data = Array(
        'ID'=>$details->id,
        'AccountType'=>$details->accounttype,
        'PatientID'=>$details->patient_id,
        'VisitID'=>$visitid,
        'PatientName'=>$details->fullname,
        );

         $patient                    = new OPD;
         $patient->opd_number        = $visitid;
         $patient->patient_id        = $details->patient_id;
         $patient->name              = 'Walk In';
         $patient->referal_doctor    = 'Non Assigned';
         $patient->department        = 'OPD';
         $patient->visit_type        = 'New Patient Visit';
         $patient->consultation_type = 'Walk In';
         $patient->payercode         = $details->accounttype;
         $patient->care_provider     = 'Walk In';
         $patient->created_on        =  Carbon::now();
         $patient->created_by        =  Auth::user()->getNameOrUsername();
         $patient->updated_on        =  Carbon::now();
         $patient->updated_by        =  Auth::user()->getNameOrUsername();
         $patient->save();


        
        
        return Response::json($data);

      }

      else {
       
      
        $visitid = Input::get('id');
        $details = OPD::where('opd_number',$visitid)->first();
        $data = Array(
        'ID'=>$details->id,
        'AccountType'=>$details->payercode,
        'PatientID'=>$details->patient_id,
        'VisitID'=>$details->opd_number,
        'PatientName'=>$details->name,
        );
        
        return Response::json($data);

        }
    }


        public function getLabWalkInVisit()
    {

      if(Input::get('id')=="")
      {

        $visitid = $this->generateStaffID(10);

        $details = Customer::where('patient_id','W0820170000')->first();
        $data = Array(
        'ID'=>$details->id,
        'AccountType'=>$details->accounttype,
        'PatientID'=>$details->patient_id,
        'VisitID'=>$visitid,
        //'PatientName'=>$details->fullname,
        );

         $patient                    = new OPD;
         $patient->opd_number        = $visitid;
         $patient->patient_id        = $details->patient_id;
         $patient->name              = Input::get('fullname');
         $patient->referal_doctor    = 'Non Assigned';
         $patient->department        = 'OPD';
         $patient->visit_type        = 'New Patient Visit';
         $patient->consultation_type = 'WALK-IN DIAGNOSTIC';
         $patient->payercode         =  $details->accounttype;
         $patient->care_provider     = 'Walk In';
         $patient->created_on        =  Carbon::now();
         $patient->created_by        =  Auth::user()->getNameOrUsername();
         $patient->updated_on        =  Carbon::now();
         $patient->updated_by        =  Auth::user()->getNameOrUsername();
         $patient->save();


        
        
        return Response::json($data);

      }

      else {
       
      
        $visitid = Input::get('id');
        $details = OPD::where('opd_number',$visitid)->first();
        $data = Array(
        'ID'=>$details->id,
        'AccountType'=>$details->payercode,
        'PatientID'=>$details->patient_id,
        'VisitID'=>$details->opd_number,
        'PatientName'=>$details->name,
        );
        
        return Response::json($data);

        }
    }


    public function getPharmacyWalkInVisit()
    {

      if(Input::get('id')=="")
      {

        $visitid = $this->generateStaffID(10);

        $details = Customer::where('patient_id','W0820170000')->first();
        $data = Array(
        'ID'=>$details->id,
        'AccountType'=>$details->accounttype,
        'PatientID'=>$details->patient_id,
        'VisitID'=>$visitid,
        //'PatientName'=>$details->fullname,
        );

         $patient                    = new OPD;
         $patient->opd_number        = $visitid;
         $patient->patient_id        = $details->patient_id;
         $patient->name              = Input::get('fullname');
         $patient->referal_doctor    = 'External Prescriber';
         $patient->department        = 'OPD';
         $patient->visit_type        = 'New Patient Visit';
         $patient->consultation_type = 'WALK-IN PHARMACY';
         $patient->payercode         =  $details->accounttype;
         $patient->care_provider     = 'Walk In';
         $patient->created_on        =  Carbon::now();
         $patient->created_by        =  Auth::user()->getNameOrUsername();
         $patient->updated_on        =  Carbon::now();
         $patient->updated_by        =  Auth::user()->getNameOrUsername();
         $patient->save();


        
        
        return Response::json($data);

      }

      else {
       
      
        $visitid = Input::get('id');
        $details = OPD::where('opd_number',$visitid)->first();
        $data = Array(
        'ID'=>$details->id,
        'AccountType'=>$details->payercode,
        'PatientID'=>$details->patient_id,
        'VisitID'=>$details->opd_number,
        'PatientName'=>$details->name,
        );
        
        return Response::json($data);

        }
    }

 public function getImagingWalkInVisit()
    {

      if(Input::get('id')=="")
      {

        $visitid = $this->generateStaffID(10);

        $details = Customer::where('patient_id','W0820170000')->first();
        $data = Array(
        'ID'=>$details->id,
        'AccountType'=>$details->accounttype,
        'PatientID'=>$details->patient_id,
        'VisitID'=>$visitid,
        'PatientName'=>$details->fullname,
        );

         $patient                    = new OPD;
         $patient->opd_number        = $visitid;
         $patient->patient_id        = $details->patient_id;
         $patient->name              = 'Imaging Walk In';
         $patient->referal_doctor    = 'Non Assigned';
         $patient->department        = 'OPD';
         $patient->visit_type        = 'New Patient Visit';
         $patient->consultation_type = 'Imaging Walk In';
         $patient->payercode         =  $details->accounttype;
         $patient->care_provider     = 'Walk In';
         $patient->created_on        =  Carbon::now();
         $patient->created_by        =  Auth::user()->getNameOrUsername();
         $patient->updated_on        =  Carbon::now();
         $patient->updated_by        =  Auth::user()->getNameOrUsername();
         $patient->save();


        
        
        return Response::json($data);

      }

      else {
       
      
        $visitid = Input::get('id');
        $details = OPD::where('opd_number',$visitid)->first();
        $data = Array(
        'ID'=>$details->id,
        'AccountType'=>$details->payercode,
        'PatientID'=>$details->patient_id,
        'VisitID'=>$details->opd_number,
        'PatientName'=>$details->name,
        );
        
        return Response::json($data);

        }
    }



public function deleteOPD()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

            $myvisitid = OPD::where('id',$ID)->first();


            $affectedRows = OPD::where('id', '=', $ID)->delete();

            if($affectedRows > 0)
            {

                Bill::where('visit_id', '=', $myvisitid->opd_number)->delete();
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
    

    public function viewOPD()
    {

            $opd_id = Input::get('opd_number');
           
          
            $user = OPD::where('opd_number',$opd_id)->first();

            $data = Array(
                'patient_id'        =>$user->patient_id,
                'fullname'          =>$user->name,
                'opd_number'        =>$user->opd_number,
                'department'        =>$user->department,
                'referal_doctor'    =>$user->referal_doctor,
                'consultation_type'   =>$user->consultation_type,
                'accounttype'       =>$user->payercode,
                'image'             =>$user->image,
                'branch'             =>$user->branch,
                 'uuid'       =>$user->uuid,
       
            );


                return Response::json($data);

        
    } 



     public function updatevisitState()
    {     
         
           $plan                  = new OPD;
           $plan->visitid         = Input::get("opd_number");
           $plan->plan            = Input::get("treament_plan");
           $plan->action          = Input::get("treament_plan_action");
           $plan->date      = Carbon::now();
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




     public function updateLocationStatus()
    {


         $id = Input::get("id");
         $status = Input::get("status");

            $affectedRows = OPD::where('id', $id)->update(array('location' => $status));

            $patient =  OPD::where('id', $id)->first();

          

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

    public function assignDoctor()
    {


         $id = Input::get("id");
         $doctor = Input::get("doctor");

            $affectedRows = OPD::where('id', $id)->update(array('referal_doctor' => $doctor , 'location' => 'Consulting Room' ));

            $patient =  OPD::where('id', $id)->first();

           OneSignal::sendNotificationToAll($patient->name." is ready to see ".$patient->referal_doctor, $url = null, $data = null, $buttons = null, $schedule = null);

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

     public function updateCareStatus()
    {


          $id = Input::get("id");
         $status = Input::get("status");

            $affectedRows = OPD::where('id', $id)->update(array('status' => $status));


             

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


}
