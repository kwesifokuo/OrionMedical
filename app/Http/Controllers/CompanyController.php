<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Company;
use OrionMedical\Models\ServiceCharge;  
use OrionMedical\Models\ServiceType;
use OrionMedical\Models\Gender;
use OrionMedical\Models\Doctor;
use OrionMedical\Models\Department;
use OrionMedical\Models\InsuranceCompany;
use OrionMedical\Models\RegisteredCompanies;
use OrionMedical\Models\CivilStatus;
use OrionMedical\Models\BloodGroup;
use OrionMedical\Models\Complaint;
use OrionMedical\Models\SocialFamilyHistory;
use OrionMedical\Models\Drug;
use OrionMedical\Models\AccountType;
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

class CompanyController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       $departments = Department::get();
        $companydetails =  Company::paginate(1);
        return view('company.index',compact('companydetails','departments'));
    }

    public function getItems()
    {
         $departments = Department::get();
        $companydetails =  Company::paginate(1);
        return view('company.items',compact('companydetails','departments'));
    }

    public function getdirectory()
    {
       $departments = Department::get();
        $companydetails =  Company::paginate(1);
        $contacts       =  Doctor::orderby('name','asc')->get();
        return view('company.directory',compact('companydetails','contacts','departments'));
    }


     public function servicecharges()
    {

        $departments = Department::get();
        $items = ServiceCharge::orderby('type','asc')->paginate(30); 
        return view('settings.tariff',compact('items','departments'));
    }

    public function healthinsurance()
    {
       $departments = Department::get();
        $items = InsuranceCompany::paginate(30); 
        return view('settings.insurance',compact('items','departments'));
    }

    public function companies()
    {
         $departments = Department::get();
        $items = RegisteredCompanies::paginate(30); 
        return view('settings.corporate',compact('items','departments'));
    }

     public function department()
    {
         $departments = Department::get();
        $items = Department::paginate(30); 
        return view('settings.department',compact('items','departments'));
    }

    public function complaint()
    {
       $departments = Department::get();
        $items = Complaint::orderby('type','asc')->paginate(30); 
        return view('settings.complaint',compact('items','departments'));
    }

    public function getservicesearch(Request $request)
    {
      


        $this->validate($request, [
            'search' => 'required'
        ]);
        $departments = Department::get();
        $search = $request->get('search');

        $items = ServiceCharge::where('type', 'like', "%$search%")
            ->where('status','Active')
            ->orWhere('department', 'like', "%$search%")
            ->orWhere('serial', 'like', "%$search%")
            ->orderBy('type')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

  return view('settings.tariff',compact('items','departments'));
    }


 public function deleteService()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = ServiceCharge::where('id', '=', $ID)->delete();

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

    public function addNewService(Request $request)
    {

    
    
           $service = new ServiceCharge;
           $service->serial = uniqid();
           $service->type = strtoupper($request->input('service'));
           $service->remark = $request->input('description');
           $service->charge = $request->input('charge');
           
           $service->walkin = $request->input('charge');
           $service->corporate = $request->input('corporate_margin');
           $service->insurance = $request->input('insurance_margin');
           $service->phoenix = $request->input('insurance_margin');
           $service->glico = $request->input('glico_margin');
           $service->cosmopolitan = $request->input('cosmopolitan_margin');
           $service->premier = $request->input('premier_margin');
           $service->metropolitan = $request->input('metropolitan_margin');
           $service->apex = $request->input('apex_margin');
           $service->acacia = $request->input('acacia_margin');
           $service->universal = $request->input('universal_margin');
           $service->nationwide = $request->input('nationwide_margin');
           



           $service->department = $request->input('department');
           $service->status = 'Active';
           $service->created_on  = Carbon::now();
           $service->created_by  = Auth::user()->getNameOrUsername();

           if($service->save())
          {

            return redirect()
            ->back()
            ->with('info','Item has successfully been saved!');
          }

          else
          {

             return redirect()
            ->back()
            ->with('warning','Item failed to create!');
          }

}


 public function editService()
    {
      //dd(Input::get('patient_id'));
      $itemid = Input::get('id');
   
    $user = ServiceCharge::find($itemid);
    $data = Array(
        
        'myoldid'             =>$user->id,
        'service'             =>$user->type,
        'remark'              =>$user->remark,
        'charge'              =>$user->walkin,
        'corporate_margin'    =>$user->corporate,
        'insurance_margin'    =>$user->insurance,
        'glico_margin'        =>$user->glico,
        'apex_margin'         =>$user->apex,
        'cosmopolitan_margin' =>$user->cosmopolitan,
        'metropolitan_margin' =>$user->metropolitan,
        'acacia_margin'       =>$user->acacia,
        'premier_margin'      =>$user->premier,
        'nationwide_margin'   =>$user->nationwide,
        'universal_margin'    =>$user->universal,
        'department'          =>$user->department,
    );
    return Response::json($data);

    }


  public function updateService()
    {     
         
             $affectedRows = ServiceCharge::where('id', Input::get('myoldid'))
            ->update(array(
                          'department'          => Input::get('department'),
                           'type'               => Input::get('service'),
                           'remark'             => Input::get('remark'), 
                           'charge'             => Input::get('charge'), 
                           'walkin'             => Input::get('walk_margin'),
                           'corporate'          => Input::get('corporate_margin'), 
                           'insurance'          => Input::get('insurance_margin'),
                           'premier'            => Input::get('premier_margin'),
                           'cosmopolitan'       => Input::get('cosmopolitan_margin'),
                           'glico'              => Input::get('glico_margin'),
                           'apex'               => Input::get('apex_margin'),
                           'universal'          => Input::get('universal_margin'),
                           'nationwide'         => Input::get('nationwide_margin'),
                           'metropolitan'       => Input::get('metropolitan_margin'),
                           'acacia'             => Input::get('acacia_margin'),
                           'updated_by'         => Auth::user()->getNameOrUsername(),
                           'updated_on'         => Carbon::now()

                           ));

            if($affectedRows > 0)
            {
          
            return redirect()
            ->back()
            ->with('success','Service has successfully been updated!');
            }

            else
            {
            return redirect()
            ->back()
            ->with('error','Service failed to update!');
            }
          

    }



 public function addInsuranceCompany(Request $request)
    {

    
    
           $detials = new InsuranceCompany;
         
           $detials->name = ucwords(strtolower($request->input('insurance_company')));
           $detials->address = ucwords(strtolower($request->input('address')));
           $detials->phone = ucwords(strtolower($request->input('phone')));
           $detials->contactperson =  ucwords(strtolower($request->input('contactperson')));
           $detials->created_on  = Carbon::now();
           $detials->created_by  = Auth::user()->getNameOrUsername();

           if($detials->save())
          {

            return redirect()
            ->back()
            ->with('info','Insurance details has successfully been saved!');
          }

          else
          {

             return redirect()
            ->back()
            ->with('warning','Insurance details failed to create!');
          }

}


 public function addCompany(Request $request)
    {

    
    
           $detials = new RegisteredCompanies;
         
           $detials->name = ucwords(strtolower($request->input('insurance_company')));
           $detials->address = ucwords(strtolower($request->input('address')));
           $detials->phone = ucwords(strtolower($request->input('phone')));
           $detials->contactperson =  ucwords(strtolower($request->input('contactperson')));
           $detials->created_on  = Carbon::now();
           $detials->created_by  = Auth::user()->getNameOrUsername();

           if($detials->save())
          {
            return redirect()
            ->back()
            ->with('info','Company details has successfully been saved!');
          }

          else
          {
             return redirect()
            ->back()
            ->with('warning','Company details failed to create!');
          }

}

public function deleteInsurance()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = InsuranceCompany::where('id', '=', $ID)->delete();

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


   public function deleteCompany()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = RegisteredCompanies::where('id', '=', $ID)->delete();

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
