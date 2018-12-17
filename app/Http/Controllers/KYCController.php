<?php

namespace OrionMedical\Http\Controllers;
use DB;
use Illuminate\Http\Request;


use OrionMedical\Models\Customer;
use OrionMedical\Models\Prescription;
use OrionMedical\Models\Consultation;
use OrionMedical\Models\Bill;
use OrionMedical\Models\PatientCategory;
use OrionMedical\Models\Images;
use OrionMedical\Models\Doctor;
use OrionMedical\Models\OPD;
use OrionMedical\Models\ServiceType;
use OrionMedical\Models\Gender;
use OrionMedical\Models\Department;
use OrionMedical\Models\Relationships;
use OrionMedical\Models\InsuranceCompany;
use OrionMedical\Models\RegisteredCompanies;
use OrionMedical\Models\CivilStatus;
use OrionMedical\Models\BloodGroup;
use OrionMedical\Models\AccountType;
use OrionMedical\Models\Serial;
use OrionMedical\Models\PatientTitle; 
use OrionMedical\Models\IdentificationType; 
use OrionMedical\Models\Nationality; 
use OrionMedical\Models\VisitType; 
use OrionMedical\Models\ServiceCharge;
use OrionMedical\Models\Branch;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Input;
use Response;
use Activity;
use Auth;
use OrionMedical\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Image;
use Carbon\Carbon;
use Cache;
use OneSignal;




class KYCController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth');
    }


 
   

   public function getPatientTimeline()
   {
     return view('patient.timeline');

   }


   public function registerWithtab()
   {

      $servicetype = ServiceCharge::orderBy('type', 'ASC')->get();  
      $images      = Images::get();
      $gender      = Gender::get();
      $bloodgroup  = BloodGroup::get();
      $accounttype = AccountType::get();
      $civilstatus = CivilStatus::get();
      $insurers    = InsuranceCompany::get();
      $companies   = RegisteredCompanies::get();
      $titles      = PatientTitle::get();
      $relationships  = Relationships::get();
      $identifications = IdentificationType::get();
      $branches = Branch::get();

      $nationalities = Nationality::get();
      $customerlists =  Customer::where('status','Active')->orderBy('created_at', 'DESC')->paginate(30);
      
    return view('patient.register', compact('customerlists','branches','nationalities','relationships'))
   
    ->with('accounttype',$accounttype)
    ->with('images',$images)
    ->with('gender',$gender)
    ->with('companies',$companies)
    ->with('insurers',$insurers)
     ->with('servicetype',$servicetype)
    ->with('bloodgroup',$bloodgroup)
     ->with('identifications',$identifications)
    ->with('titles',$titles)
    ->with('civilstatus',$civilstatus);

   }
     
    public function activepatients()
    {

       $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();
     

      $images      = Images::get();
      $gender      = Gender::get();
      $bloodgroup  = BloodGroup::get();
      $accounttype = AccountType::get();
      $civilstatus = CivilStatus::get();
      $insurers    = InsuranceCompany::get();
      $companies   = RegisteredCompanies::get();
      $titles      = PatientTitle::get();
      $relationships  = Relationships::get();
      $identifications = IdentificationType::get();
      $billingaccounts = AccountType::get();
      $branches = Branch::get();

      $nationalities = Nationality::get();
      $today =        Carbon::now()->format('Y-m-d').'%';
      $customerlists =  Customer::where('status','Active')->where('created_at', 'like', $today)->orderBy('created_at', 'DESC')->paginate(30);
      
    return view('patient.index', compact('customerlists','branches','billingaccounts','nationalities','relationships','departments','doctors','visittypes'))
   
    ->with('accounttype',$accounttype)
    ->with('images',$images)
    ->with('gender',$gender)
    ->with('companies',$companies)
    ->with('insurers',$insurers)
     ->with('servicetype',$servicetype)
    ->with('bloodgroup',$bloodgroup)
     ->with('identifications',$identifications)
    ->with('titles',$titles)
    ->with('civilstatus',$civilstatus);
    }

    public function inactivepatients()
    {
     
      $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();
    
      $images      = Images::get();
      $gender      = Gender::get();
      $bloodgroup  = BloodGroup::get();
      $accounttype = AccountType::get();
      $civilstatus = CivilStatus::get();
      $insurers    = InsuranceCompany::get();
      $companies   = RegisteredCompanies::get();
      $identifications = IdentificationType::get();
      $relationships  = Relationships::get();
      $titles      = PatientTitle::get();
      $nationalities = Nationality::get();
      $billingaccounts = AccountType::get();
      $branches = Branch::get();

      $customerlists =  Customer::where('status','Deactive')->orderBy('created_at', 'DESC')->paginate(30);
      //
    return view('patient.index', compact('customerlists','branches','billingaccounts','nationalities','relationships','departments','doctors','visittypes'))
   
    ->with('accounttype',$accounttype)
    ->with('images',$images)
    ->with('gender',$gender)
    ->with('servicetype',$servicetype)
    ->with('bloodgroup',$bloodgroup)
    ->with('companies',$companies)
    ->with('insurers',$insurers)
    ->with('identifications',$identifications)
    ->with('titles',$titles)
    ->with('civilstatus',$civilstatus);

    }

  
public function getSearchResults(Request $request)
    {
      $servicetype     = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->get();
        $departments     = Department::get();
        $doctors         = Doctor::get();
        $visittypes      = VisitType::get();
      $images      = Images::get();
      $gender      = Gender::get();
      $bloodgroup  = BloodGroup::get();
      $accounttype = AccountType::get();
      $civilstatus = CivilStatus::get();
      $insurers    = InsuranceCompany::get();
      $companies   = RegisteredCompanies::get();
      $identifications = IdentificationType::get();
      $titles      = PatientTitle::get();
      $nationalities = Nationality::get();
       $relationships  = Relationships::get();
       $billingaccounts = AccountType::get();
       $branches = Branch::get();


        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $customerlists = Customer::where('fullname', 'like', "%$search%")
            ->where('status','Active')
            ->orWhere('mobile_number', 'like', "%$search%")
            ->orWhere('patient_id', 'like', "%$search%")
            ->orWhere('date_of_birth', 'like', "%$search%")
            ->orWhere('company', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


           return view('patient.index', compact('customerlists','branches','billingaccounts','nationalities','relationships','departments','doctors','visittypes'))
    ->with('accounttype',$accounttype)
    ->with('images',$images)
    ->with('gender',$gender)
    ->with('servicetype',$servicetype)
    ->with('bloodgroup',$bloodgroup)
     ->with('companies',$companies)
    ->with('insurers',$insurers)
    ->with('identifications',$identifications)
    ->with('titles',$titles)
    ->with('civilstatus',$civilstatus);
    
    }


function generatePatientId($staffname)
{
    $words = explode(" ",$staffname);
        $acronym = "";

        foreach ($words as $w) 
        {
          $acronym .= $w[0];
        }

    $number = Serial::where('name','=','patient')->first();
    $number = $number->counter;
    $account = str_pad($number,4, '0', STR_PAD_LEFT);
    

    $myaccount=  $acronym.date('my').$account;
   // $myaccount=  'EWC'.$account.date('y');
    Serial::where('name','=','patient')->increment('counter',1);

    return  $myaccount;
}





 public function autoGenSerial($patient)
{
       
       
        $words = explode(" ",$patient);
        //dd($words);
        $acronym = "";
        foreach ($words as $w) 
        {
          $acronym .= $w[0];
          

        }
       //
        return $acronym;
}


public function doGenerateBulkID()
    {

       $patients = Customer::get()->value('fullname')->toArray();           //Employee::where('status','Active')->orderby('fullname','asc')->paginate(30);

        foreach( $patients as $patient)
        {
        $initials = $this->autoGenSerial($patient);

        $staffid = Customer::where('fullname',$patient)->value('patient_id');
        $staffid = substr($staffid, -4);

        Customer::where('fullname', '=', $patient)->update(array('ref_code' => $initials.date('mY').$staffid));
      }

    }
    
    public function postNewCustomer()
    {
        

       
           
              $filename  = 'avatar_default.jpg';

           
            $patient_number = $this->generatePatientId(ucwords(strtolower(Input::get('fullname'))));
            $transactionid = uniqid(20);
            

           $patient                      = new Customer;
           $patient->patient_id          = $patient_number;
           $patient->fullname            = ucwords(strtolower(Input::get('fullname')));
           $patient->accounttype         = Input::get('accounttype');
           $patient->blood_group         = Input::get('blood_group');
           $patient->postal_address      = ucwords(strtolower(Input::get('postal_address')));
           $patient->residential_address = ucwords(strtolower(Input::get('residential_address')));
           $patient->email               = strtolower(Input::get('email'));
           $patient->mobile_number       = Input::get('mobile_number');
           $patient->date_of_birth       = Carbon::createFromFormat('d/m/Y', Input::get('date_of_birth'));
           $patient->occupation          = ucwords(strtolower(Input::get('occupation')));
           $patient->place_of_birth      = ucwords(strtolower(Input::get('place_of_birth')));
           $patient->gender              = Input::get('gender');
           $patient->occupation          = ucwords(strtolower(Input::get('occupation')));
           $patient->insurance_company   = Input::get('insurance_company');
           $patient->company             = Input::get('company');
           $patient->nationality         = Input::get('nationality');
           $patient->insurance_id        = Input::get('insurance_id');
           $patient->civil_status        = Input::get('civil_status');
           $patient->id_type             = Input::get('id_type');
           $patient->id_number           = strtoupper(Input::get('id_number'));
           $patient->ref_code             = $patient_number;
           $patient->image               = $filename;
           $patient->created_by          = Auth::user()->getNameOrUsername();
           $patient->kin_name            = Input::get('kin_name');
           $patient->kin_phone           = Input::get('kin_phone');
           $patient->kin_relationship    = Input::get('kin_relationship');
           $patient->insurance_cover     = Input::get('insurance_cover');
           $patient->insurance_eligibility = Input::get('insurance_eligibility');
           $patient->parent_id = Input::get('parent_id');
           $patient->link_type = Input::get('link_type');
           $patient->expiry_date          = Carbon::createFromFormat('d/m/Y',Input::get('expiry_date'));
          

          
           switch(Input::get('accounttype')) 
                    {

                     case 'Health Insurance':

                      $savecopayer =  Input::get('insurance_company');
                      $myaccounttype = 'Health Insurance';

                     if(Input::get('insurance_company')=='Glico Health Care')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('glico');
                         
                       }

                       if(Input::get('insurance_company')=='Glico Tpa Barclays')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('glico');
                         
                       }

                       if(Input::get('insurance_company')=='Phoenix Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('phoenix');
                         
                       }

                       elseif(Input::get('insurance_company')=='Nationwide Mutual Insurance')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('nationwide');
                         
                       }

                       elseif(Input::get('insurance_company')=='Metropolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('metropolitan');
                         
                       }

                       elseif(Input::get('insurance_company')=='Premier Mutual Health')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('premier');
                         
                       }

                       elseif(Input::get('insurance_company')=='Acacia Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('acacia');
                         
                       }

                        elseif(Input::get('insurance_company')=='Universal Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('universal');
                         
                       }

                        elseif(Input::get('insurance_company')=='Apex Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('apex');
                         
                       }


                      elseif(Input::get('insurance_company')=='Cosmopolitan Health Insurance')
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('cosmopolitan');
                         
                       }
                       else
                       {
                         $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('insurance');
                       }

                       
                      
                            break;
                        case 'Corporate':
                             $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('corporate');
                             $savecopayer =  $mycopayer->company;
                             $myaccounttype = 'Corporate';
                            break;
                        case 'Private':
                             $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('walkin');
                             $savecopayer =  'Private';
                             $myaccounttype = 'Private';
                            break;
                        case 'Walkin':
                             $service_charge = 0;
                             $savecopayer =  'Private';
                             $myaccounttype = 'Private';
                            break;
                        case 'Gratis':
                             $service_charge = ServiceCharge::where('type','REGISTRATION OF PATIENT')->value('charge');
                             $savecopayer =  'Private';
                             $myaccounttype = 'Private';
                            break;
                          }
          
                         // dd($request->input('accounttype'));
                           $bill              = new Bill;
                           $bill->patient_id  = $patient_number;
                           $bill->visit_id    = 0;
                           $bill->fullname    = Input::get('fullname');
                           $bill->item_name   = 'REGISTRATION OF PATIENT';
                           $bill->quantity    = 1;
                           $bill->rate        = $service_charge;
                           $bill->amount      = $service_charge;
                           $bill->note        = 'Unpaid';
                           $bill->created_by  = Auth::user()->getNameOrUsername();
                           $bill->date        = Carbon::now();
                           $bill->category    = 'OPD';
                           $bill->copayer    = $savecopayer;
                           $bill->payercode  = $myaccounttype;
                           $bill->uuid        = $transactionid;
                           
           
           if($patient->save() & $bill->save())
          {


                    
 //dd($mycopayer);
                   
          
        // //dd($bill->save());
        //     if($bill->save())
        //   {

            
             $added_response = array('OK'=>'OK','ReferenceNumber'=>$patient_number);
             return  Response::json($added_response);
          }

          else
          {
            return redirect()
            ->route('active-patients')
            ->with('error','Account failed to create!');
          }



    }



   



    public function editCustomer(Request $request)
    {
      //dd(Input::get('patient_id'));
    $user_id = $request->input('patient_id');
    $user = Customer::find($user_id);
    $data = Array(
        'patient_id'          =>$user->patient_id,
        'fullname'            =>$user->fullname,
        'residential_address' =>$user->residential_address,
        'postal_address'      =>$user->postal_address,
        'date_of_birth'       =>$user->date_of_birth->format('d/m/Y'),
        'email'               =>$user->email,
        'occupation'          =>$user->occupation,
        'mobile_number'       =>$user->mobile_number,
        'blood_group'         =>$user->blood_group,
        'civil_status'        =>$user->civil_status,
        'nationality'         =>$user->nationality,
        'gender'              =>$user->gender,
        'place_of_birth'      =>$user->place_of_birth,
        'image'               =>$user->image,
        'accounttype'         =>$user->accounttype,
        'id_type'             =>$user->id_type,
        'id_number'           =>$user->id_number,
        'insurance_id'        =>$user->insurance_id,
        'insurance_company'   =>$user->insurance_company,
        'company'             =>$user->company,
        'kin_name'            =>$user->kin_name,
        'kin_relationship'    =>$user->kin_relationship,
        'kin_phone'           =>$user->kin_phone,
        'insurance_cover'            =>$user->insurance_cover,
        'insurance_eligibility'      =>$user->insurance_eligibility,
        'parent_id'      =>$user->parent_id,
        'link_type'      =>$user->link_type,
        'expiry_date'                =>$user->expiry_date->format('d/m/Y')
         

    );
    return Response::json($data);
    } 

    public function guestCustomer()
    {
      //dd(Input::get('patient_id'));
    $user_id = Input::get('patient_id');
    $user = Customer::where('patient_id',$user_id)->first();
    $data = Array(
        'patient_id'          =>$user->patient_id,
        'fullname'            =>$user->fullname,
        'residential_address' =>$user->residential_address,
        'postal_address'      =>$user->postal_address,
        'date_of_birth'       =>$user->date_of_birth->format('d/m/Y'),
        'email'               =>$user->email,
        'occupation'          =>$user->occupation,
        'mobile_number'       =>$user->mobile_number,
        'blood_group'         =>$user->blood_group,
        'civil_status'        =>$user->civil_status,
        'gender'              =>$user->gender,
        'place_of_birth'      =>$user->place_of_birth,
        'image'               =>$user->image,
         'accounttype'         =>$user->accounttype,
        'id_type'             =>$user->id_type,
        'id_number'           =>$user->id_number,
        'insurance_id'        =>$user->insurance_id,
        'insurance_company'   =>$user->insurance_company,
        'company'             =>$user->company,
        'kin_name'            =>$user->kin_name,
        'kin_relationship'    =>$user->kin_relationship,
        'kin_phone'           =>$user->kin_phone,
         'insurance_cover'            =>$user->insurance_cover,
        'insurance_eligibility'      =>$user->insurance_eligibility,
        'expiry_date'                =>$user->expiry_date
         

    );
    return Response::json($data);
    } 

    // public function getnotify()
    // {

    // $mess =  OneSignal::sendNotificationToUser("New patient has been registered", 'a8b5a446-3f6d-4e1d-8397-a0a24c521a85', $url = null, $data = null, $buttons = null, $schedule = null);
    // //dd($mess);
    // }

  public function activatePatient()
    {
       
         
            $userid = Input::get("ID");
            //OneSignal::sendNotificationToAll("Some Message", $url = null, $data = null, $buttons = null, $schedule = null);

            $affectedRows = Customer::where('id', '=', $userid)->update(array('status' => 'Active'));

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



    public function deactivatePatient()
    {
       
         
            $userid = Input::get("ID");

            $affectedRows = Customer::where('id', '=', $userid)->update(array('status' => 'Deactive'));

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

    public function deleteCustomer()
    {

      if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Customer::where('id', $ID)->delete();

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


     public function loadDocuments()
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


    public function updateCustomer(Request $request)
    {
      //dd($request->all());

      try {
        
           //dd($request->input("imagename"));
           
          if($request->hasFile("image"))
            {
           $image = $request->file("image");
           $profile= $request->input("patient_id");
           $filename = $profile. '.jpg';
           $path = public_path('images/' . $filename);
           Image::make($image->getRealPath())->resize(700, 500)->save($path); 
            }
            else
            {
              if($request->input("imagename")!='avatar_default.jpg')
                {
                   $profile= $request->input("patient_id");
                  $filename = $profile. '.jpg';
                }

                else
                {
              $filename  = 'avatar_default.jpg';
              }
            }
          

            $patient_id          = $request->input("patient_id");
            $accounttype         = $request->input("accounttype");
            $fullname            = $request->input("fullname");
            $blood_group         = $request->input("blood_group");
            $residential_address = $request->input("residential_address");
            $postal_address      = $request->input("postal_address");
            $email               = $request->input("email");
            $mobile_number       = $request->input("mobile_number");
            $occupation          = $request->input("occupation");
            $date_of_birth       = Carbon::createFromFormat('d/m/Y', $request->input('date_of_birth'));
            $place_of_birth      = $request->input('place_of_birth');
            $gender              = $request->input('gender');
            $nationality         = $request->input('nationality');
            $insurance_company   = $request->input('insurance_company');
            $insurance_id        = $request->input('insurance_id');
            $civil_status        = $request->input('civil_status');
            $id_type             = $request->input('id_type');
            $id_number           = $request->input('id_number');
            $company             = $request->input('company');
            $kin_name            = $request->input('kin_name');
            $kin_phone            = $request->input('kin_phone');
            $kin_relationship     = $request->input('kin_relationship');
            $insurance_eligibility = $request->input('insurance_eligibility');
            $parent_id = $request->input('parent_id');
            $link_type = $request->input('link_type');
            $insurance_cover      = $request->input('insurance_cover');
            $expiry_date          = $request->input('expiry_date');



             $affectedRows = Customer::where('patient_id', '=', $patient_id)
            ->update(array(
                          
                           'fullname'             => $fullname,
                           'residential_address'  => $residential_address, 
                           'postal_address'       => $postal_address, 
                           'email'                => $email, 
                           'accounttype'          => $accounttype,
                           'mobile_number'        => $mobile_number, 
                           'occupation'           => $occupation,
                           'date_of_birth'        => $date_of_birth,
                           'place_of_birth'       => $place_of_birth,
                           'gender'               => $gender,
                           'insurance_company'    => $insurance_company,
                           'insurance_id'         => $insurance_id,
                           'nationality'         => $nationality,
                           'civil_status'         => $civil_status,
                           'id_type'              => $id_type,
                           'company'              => $company,
                           'kin_name'             => $kin_name,
                           'kin_phone'            => $kin_phone,
                           'kin_relationship'     => $kin_relationship,
                           'id_number'            => $id_number,
                           'insurance_eligibility' => $insurance_eligibility,
                           'parent_id'       => $parent_id,
                           'link_type'       => $link_type,
                           'insurance_cover'       => $insurance_cover,
                           'expiry_date'          =>$expiry_date,
                           'id_number'            => $id_number,
                           'image'                => $filename));

            if($affectedRows > 0)
            {
          
          // Activity::log([
          // 'contentId'   =>  $patient_id,
          // 'contentType' => 'User',
          // 'action'      => 'Update',
          // 'description' => 'Updated details of '.$fullname,
          // 'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
          // ]);
        
             
            return redirect()
            ->back()
            ->with('success','Patient has successfully been updated!');
            }

            else
            {
            return redirect()
            ->back()
            ->with('error','Patient failed to update!');
            }
          }


    catch (\Exception $e) {
           
           echo $e->getMessage();
            
        }
           

    }



}
