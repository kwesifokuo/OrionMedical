<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Drug;
use OrionMedical\Models\Prescription;
use OrionMedical\Models\Customer;
use OrionMedical\Models\OPD;
use OrionMedical\Models\DrugPeriod;
use OrionMedical\Models\PatientComplaint;
use OrionMedical\Models\PatientDiagnosis;
use OrionMedical\Models\DrugApplication;
use OrionMedical\Models\Company;
use OrionMedical\Models\Consumables;
use OrionMedical\Models\DrugDosage;
use OrionMedical\Models\Supplier;
use OrionMedical\Models\mPharma;
use OrionMedical\Models\DrugFrequency;
use OrionMedical\Models\DrugCategory;
use OrionMedical\Models\Treatment;
use OrionMedical\Models\DrugStore;
use OrionMedical\Models\DrugStock;
use OrionMedical\Models\DrugExclusions;
use OrionMedical\Models\ConsumableRequisition;
use OrionMedical\Models\Bill;
use OrionMedical\Models\Payments;
use OrionMedical\Models\User;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use DB;
use Response;
use Input;
use Cache;
use Carbon\Carbon;
use Datetime;
use Auth;
use Excel;

class DrugController extends Controller
{

   
	public function __construct()
    {
         $this->middleware('auth');
        $this->middleware('role:Pharmacist|System Admin|Doctor|Nurse|Nurse Assistant|Dentist|Laboratory|Pharmacy Technician|Dental Nurse|Ophthalmologist|Special Admin');
       
    }
    
    public function index()
    {

        $dispensed =    Prescription::where('status','Dispensed')->count();
        $requested =    Prescription::where('status','Request Pending')->count();
        $suppliers =    Supplier::get();
        $drugcategories = DrugCategory::where('scope','Pharmacy')->orderBy('category', 'ASC')->get();
        $application    = DrugDosage::get();

        $brands      = Drug::groupby('brand')->get();
        $drugcost    = Drug::where('is_Active','Active')->get();
        $drugs       = Drug::where('is_Active','Active')->orderBy('Name', 'ASC')->paginate(30);
        //$totalcost = DB::select(DB::raw("select sum(drug_quantity_default * unit_price) as total_price from drugs where is_Active='Active'"));
       
        $totalcost = 0;

        foreach($drugcost as $drugcost)
       {
            $totalcost += ($drugcost->stock * $drugcost->unit_price);
       }


        return view('pharmacy.drugs',compact('drugs','drugcategories','brands','suppliers','dispensed','requested','totalcost','application'));
    }


    public function pendingApproval()
    {
         $suppliers =    Supplier::get();
         $drugs =  Drug::where('is_Active','Pending Approval')->orderBy('Name', 'ASC')->paginate(20);
         //$items = DrugStock::groupby('invoice_number')->paginate(30);

         $stockitems = DrugStock::paginate(30);
         //$myitems = DrugStock::groupby('invoice_number')->paginate(30);

            $payables = 0;
         foreach($drugs as $item)
       {
            $payables += ($item->stock * $item->unit_price);
       }


        return view('pharmacy.approve',compact('drugs','suppliers','items','payables'));

    }

    public function getDrugCount()
    {

          if(Input::get("medication"))
            {
                    $ID = Input::get("medication");
                    $affectedRows = Drug::where('id', $ID)->first();

                    $stocklevel = $affectedRows->stock;

                if($stocklevel < 1)
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


    public function consumables()
    {

        $dispensed      =    Prescription::where('status','Dispensed')->count();
        $requested      =    Prescription::where('status','Request Pending')->count();
        $suppliers      =    Supplier::get();
        $drugcategories =    DrugCategory::where('scope','Consumables')->orderBy('category', 'ASC')->get();
        $application    =    DrugDosage::get();
        $assignees =    User::get();
        $brands      = Consumables::groupby('brand')->get();
        $drugs      =  Consumables::where('is_Active','Active')->orderBy('name', 'ASC')->paginate(30);
        $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }

        return view('pharmacy.consumables',compact('drugs','assignees','drugcategories','brands','suppliers','dispensed','requested','totalcost','application'));
    }




    public function expired()
    {

        $dispensed =    Prescription::where('status','Dispensed')->count();
        $requested =    Prescription::where('status','Request Pending')->count();
        $suppliers =    Supplier::get();
        $drugcategories = DrugCategory::orderBy('category', 'ASC')->get();
        $drugs =  DrugStore::where('status','Stock Expired')->paginate(30);
        $totalcost = 0;
        $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock_balance * $drug->unit_price);
       }
        return view('pharmacy.expired',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost'));
    }


     public function flaggedExpired()
    {

        $dispensed =    Prescription::where('status','Dispensed')->count();
        $requested =    Prescription::where('status','Request Pending')->count();
        $suppliers =    Supplier::get();
        $drugcategories = DrugCategory::orderBy('category', 'ASC')->get();
        $drugs =  Drug::whereRaw("expiry_date <= now() + interval 1 month")->orderBy('name', 'ASC')->paginate(30);

        $totalcost = 0;
        $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }
        return view('pharmacy.system_expired',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost'));
    }


      public function flaggedLowStock()
    {

        $dispensed =    Prescription::where('status','Dispensed')->count();
        $requested =    Prescription::where('status','Request Pending')->count();
        $suppliers =    Supplier::get();
        $drugcategories = DrugCategory::orderBy('category', 'ASC')->get();
        $drugs =  Drug::where('stock', '<=','stock_alert')->orWhere('stock',0)->orderBy('name', 'ASC')->paginate(30);

        $totalcost = 0;
        $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }
        return view('pharmacy.system_low_stock',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost'));
    }

    public function exportFlagged()
    {
      $items = Drug::select('name','stock','unit_price')->where('stock', '<=','stock_alert')->orWhere('stock',0)->orderBy('name', 'ASC')->get();
      Excel::create('lowstock_'.Carbon::now(), function($excel) use($items) {
          $excel->sheet('Drug Low Stock', function($sheet) use($items) {
              $sheet->fromArray($items);
          });
      })->export('xls');
    }

    public function exportExpired()
    {
      $items = Drug::select('expiry_date','name','stock','unit_price')->whereRaw("expiry_date <= now() + interval 1 month")->orderBy('name', 'ASC')->get();
      Excel::create('expired_drugs_'.Carbon::now(), function($excel) use($items) {
          $excel->sheet('Drug Expired', function($sheet) use($items) {
              $sheet->fromArray($items);
          });
      })->export('xls');
    }





     public function stockaudit()
    {

        $dispensed =    Prescription::where('status','Dispensed')->count();
        $requested =    Prescription::where('status','Request Pending')->count();
        $suppliers =    Supplier::get();
        $drugcategories=DrugCategory::orderBy('category', 'ASC')->get();

        $drugs =  DrugStore::paginate(30);
       $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }
        return view('pharmacy.stock_audit',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost'));
    }




    public function reportDispensed()
    {

        $dispensed =    Prescription::where('status','Dispensed')->count();
        $requested =    Prescription::where('status','Request Pending')->count();
        $suppliers =    Supplier::get();
        $drugcategories =DrugCategory::orderBy('category', 'ASC')->get();
        $drugs     =  Prescription::where('status','Dispensed')->orderBy('date_dispensed', 'ASC')->paginate(30);
       $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->drug_quantity * $drug->drug_cost);
       }
        return view('pharmacy.dispensed',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost'));
    }


    public function reportmPharma()
    {

        $dispensed =    mPharma::count();
        $requested =    mPharma::count();
        $suppliers =    Supplier::get();
        $drugcategories =DrugCategory::orderBy('category', 'ASC')->get();
        $drugs     =  mPharma::where('Source','mPharma')->orderBy('DateDispensed', 'ASC')->paginate(30);
        $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->QuantityDispensed * $drug->SalePrice);
       }
        return view('pharmacy.mpharma',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost'));
    }



     public function damaged()
    {

        $dispensed      = Prescription::where('status','Dispensed')->count();
        $requested      = Prescription::where('status','Request Pending')->count();
        $suppliers      = Supplier::get();
        $drugcategories = DrugCategory::orderBy('category', 'ASC')->get();
        $drugs          = DrugStore::where('status','Stock Damaged')->paginate(30);
       $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }
        return view('pharmacy.damaged',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost','mydrugs'));
    }



     public function reportedExpire()
    {

        $dispensed      = Prescription::where('status','Dispensed')->count();
        $requested      = Prescription::where('status','Request Pending')->count();
        $suppliers      = Supplier::get();
        $drugcategories = DrugCategory::orderBy('category', 'ASC')->get();
        $drugs          = DrugStore::where('status','Stock Expired')->paginate(30);
       $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }
        return view('pharmacy.expirednotice',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost','mydrugs'));
    }


    public function reportedTransfer()
    {

        $dispensed      = Prescription::where('status','Dispensed')->count();
        $requested      = Prescription::where('status','Request Pending')->count();
        $suppliers      = Supplier::get();
        $drugcategories = DrugCategory::orderBy('category', 'ASC')->get();
        $drugs          = DrugStore::where('status','Stock Transfered')->paginate(30);
        $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }
        return view('pharmacy.transfer',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost','mydrugs'));
    }


    public function reportedRetun()
    {

        $dispensed      = Prescription::where('status','Dispensed')->count();
        $requested      = Prescription::where('status','Request Pending')->count();
        $suppliers      = Supplier::get();
        $drugcategories = DrugCategory::orderBy('category', 'ASC')->get();
        $drugs          = DrugStore::where('status','Stock Returned')->paginate(30);
        $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }
        return view('pharmacy.transfer',compact('drugs','drugcategories','suppliers','dispensed','requested','totalcost','mydrugs'));
    }










     public function reports()
    {
        return view('pharmacy.report');

    }

    public function setting()
    {
        return view('pharmacy.setting');

    }

      public function supplier()
    {
        $items      = Supplier::get();
        return view('pharmacy.supplier',compact('items'));

    }


    public function fetchInvoice(Request $request)
    {

    try
    {

            $invoice_number = Input::get("invoice_number");
            $drugcart = DrugStock::where('invoice_number','=',$invoice_number)->orderby('created_on','desc')->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
    }

     public function fetchInvoiceConsumable(Request $request)
    {

    try
    {

            $invoice_number = Input::get("consumable_invoice_number");
            $drugcart = DrugStock::where('invoice_number','=',$invoice_number)->orderby('created_on','desc')->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
    }

     public function fetchInvoiceforupload(Request $request)
    {

    try
    {

            $invoice_number = Input::get("invoice_number");
            $drugcart = DrugStock::where('invoice_number','=',$invoice_number)->where('upload_state','<>','Uploaded')->orderby('created_on','desc')->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
    }


     


    public function addInvoices()
    {   
            $getdrug =  Drug::where('id',Input::get("medication"))->first();

            $drug = new DrugStock;
            $drug->invoice_number   = Input::get("invoice_number");
            $drug->invoice_date     = $this->change_date_format(Input::get('invoice_date')); 
            $drug->name             = Input::get("medication");
            $drug->description      = $getdrug->name;

            $drug->unit_price       = Input::get("unit_price");
            $drug->quantity         = Input::get("quantity");
            $drug->supplier         = Input::get("supplier");
                
            $drug->cost_price       = Input::get("cost_price");
            $drug->sale_price       = Input::get("sale_price");

            $drug->note       = Input::get("invoice_description");
            $drug->remark       = Input::get("invoice_remark");
            $drug->category       = 'Drugs';

            $drug->created_on  = Carbon::now();
            $drug->created_by  = Auth::user()->getNameOrUsername();

             if($drug->save())
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


    public function addInvoicesConsumable()
    {   
            $getdrug =  Consumables::where('id',Input::get("consumable"))->first();

            $drug = new DrugStock;
            $drug->invoice_number   = Input::get("consumable_invoice_number");
            $drug->invoice_date     = $this->change_date_format(Input::get('consumable_invoice_date')); 
            $drug->name             = Input::get("consumable");
            $drug->description      = $getdrug->name;

            $drug->unit_price       = Input::get("consumable_unit_price");
            $drug->quantity         = Input::get("consumable_quantity");
            $drug->supplier         = Input::get("consumable_supplier");
                
            $drug->cost_price       = Input::get("consumable_cost_price");
            $drug->sale_price       = Input::get("consumable_sale_price");

            $drug->note       = Input::get("consumable_invoice_description");
            $drug->remark       = Input::get("consumable_invoice_remark");
            $drug->category       = 'Consumables';

            $drug->created_on  = Carbon::now();
            $drug->created_by  = Auth::user()->getNameOrUsername();

             if($drug->save())
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



    public function getInvoiceDetails()
    {
      //dd(Input::get('id'));
    $drugid = Input::get('id');
    $drug = DrugStock::where('invoice_number',$drugid)->first();
    $data = Array(
        'invoice_number'   =>$drug->invoice_number,
        'invoice_date'     =>$drug->invoice_date->format('d/m/Y'),
        'supplier'         =>$drug->supplier,
        'remark'           =>$drug->remark,
        'note'             =>$drug->note,

    );
        return Response::json($data);
    } 


    public function getInvoiceDetailsConsumable()
    {
      //dd(Input::get('id'));
    $drugid = Input::get('id');
    $drug = DrugStock::where('invoice_number',$drugid)->first();
    $data = Array(
        'consumable_invoice_number'   =>$drug->invoice_number,
        'consumable_invoice_date'     =>$drug->invoice_date->format('d/m/Y'),
        'consumable_supplier'         =>$drug->supplier,
        'consumable_remark'           =>$drug->remark,
        'consumable_note'             =>$drug->note,

    );
        return Response::json($data);
    } 





    public function deleteInvoice()
    {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

            $removefrombill = DrugStock::where('invoice_number', $ID)->delete();

            if($removefrombill > 0)

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

    public function approveInvoice()
    {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

           $affectedRows = DrugStock::where('invoice_number', $ID)->update(array('status' => 'Approved'));
            $affectedRows = DrugStock::where('invoice_number', $ID)->update(array('approved_by' => Auth::user()->getNameOrUsername()));
             $affectedRows = DrugStock::where('invoice_number', $ID)->update(array('approved_on' => Carbon::now()));

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



    public function approveRequisition()
    {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

           $affectedRows = ConsumableRequisition::where('id', $ID)->update(array('status' => 'Approved','quantity_approved'=>Input::get("approved_quantity"),'approved_by'=>Auth::user()->getNameOrUsername(),'approved_on'=> Carbon::now() ));
           

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
 



    public function supplierbills()
    {
        $suppliers =    Supplier::get();
        $drugcategories = DrugCategory::where('scope','Pharmacy')->orderBy('category', 'asc')->get();
        $application    = DrugDosage::get();
        $brands      = Drug::groupby('brand')->get();

         
         $drugs =  Drug::where('is_Active','Active')->orderBy('Name', 'asc')->get();
         $consumables  =  Consumables::orderBy('name', 'asc')->get();
         $items = DrugStock::groupby('invoice_number')->paginate(30);

          $items = DB::table('stocks')
                     ->select(DB::raw('invoice_number,invoice_date,supplier,sum(unit_price*quantity) as cost,category,created_on,created_by,status,upload_state,approved_by'))
                     ->wherenull('deleted_at')
                     ->groupBy('invoice_number')
                     ->groupBy('upload_state')
                     ->orderBy('created_on','desc')
                    ->paginate(30);


        return view('pharmacy.bills',compact('drugs','consumables','suppliers','items','payables','drugcategories','application','brands'));

    }

     public function supplierpurchases()
    {
        return view('pharmacy.purchases');

    }
    public function supplierpayments()
    {
        return view('pharmacy.payments');

    }





    public function categories()
    {
       $dispensed =    Prescription::where('status','Dispensed')->count();
        $requested =    Prescription::where('status','Request Pending')->count();

        $drugs     =    DrugCategory::orderBy('category', 'ASC')->paginate(20);
        return view('pharmacy.category',compact('drugs','dispensed','requested'));
    }



    public function dashboard()
   {

     $drugs =  Drug::where('is_active','Active')->orderBy('name', 'ASC')->paginate(30);
    return view('pharmacy.dashboard',compact('drugs'));

    }


    public function printPrescription($id)
    {

    try
    {

     $company = Company::get()->first();

    $patientid      =   Prescription::where('VisitID' ,'=', $id)->value('PatientID');
    $patients       =   Customer::where('patient_id' ,'=', $patientid)->first();
    $bills          =   Prescription::where('VisitID' ,'=', $id)->get();
    $totalcost = DB::select(DB::raw("select sum(drug_quantity * drug_cost) as total_price from prescriptions WHERE visitid = '$id'"));
    
    //dd($patients);

    return view('pharmacy.print', compact('patients','bills','totalcost','company'));

    }

    catch (\Exception $e) 
    {
           
           echo $e->getMessage();
            return redirect()
            ->route('404');
    }

    }



    public function getPrescriptions()
    {
        //$company = Company::get()->first();
        $dispensed =    Prescription::where('status','Dispensed')->count();
        $requested =    Prescription::where('status','Request Pending')->count();

        $drugs=Drug::orderBy('name', 'ASC')->get();
        $periods=DrugPeriod::orderBy('type', 'ASC')->get();
        $application=DrugApplication::get();
        $frequency=DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage=DrugDosage::get();


         $prescriptions = DB::table('prescriptions')
                     ->select(DB::raw('id,visitid,patientid,patient_name,created_by,GROUP_CONCAT(drug_name) as drug_name,created_on,status'))
                     ->where('status','<>','Dispensed')
                     ->groupBy('visitid')
                     ->orderBy('created_on','desc')
                    ->paginate(30);



    	//$prescriptions=Prescription::where('status','<>','Dispensed')->orderBy('created_on', 'desc')->paginate(30);


    	return view('pharmacy.prescriptions',compact('company','prescriptions','drugs','periods','application','dosage','frequency','dispensed','requested'));
    }

     public function getPrescriptionsDispensed()
    {
       $dispensed =    Prescription::where('status','Dispensed')->count();
        $requested =    Prescription::where('status','Request Pending')->count();

        $drugs=Drug::orderBy('name', 'ASC')->get();
        $periods=DrugPeriod::orderBy('type', 'ASC')->get();
        $application=DrugApplication::get();
        $frequency=DrugFrequency::orderBy('type', 'ASC')->get();
        $dosage=DrugDosage::get();
        $prescriptions=Prescription::where('status','Dispensed')->orderBy('created_on', 'DESC')->paginate(30);
        return view('pharmacy.prescriptions',compact('drugs','prescriptions','periods','application','dosage','frequency','dispensed','requested'));
    }

    public function getPendingMedication($id)
    {
         //$company = Company::get()->first();


        $mydiagnosis    =   PatientDiagnosis::where('visitid',$id)->get();
        $mycomplaints   =   PatientComplaint::where('visitid',$id)->get();

        $visit_details  =   OPD::where('opd_number' ,'=', $id)->first();
        $patientid  =   Prescription::where('visitid' ,'=', $id)->value('patientid');
        $patients   =   Customer::where('patient_id' ,'=', $patientid)->first();
        $prescriptions =   Prescription::where('visitid' ,'=', $id)->first();
        $dispensed =    Prescription::where('visitid' ,'=', $id)->where('status','Dispensed')->get();
        $drugs      =   Prescription::where('visitid' ,'=', $id)->where('status','Request Pending')->get();//Prescription::where('VisitID' ,'=', $id)->get();
        $exclusions = DrugExclusions::where('category','Pharmacy')->where('entity',$visit_details->care_provider)->get();

        $totalcost = 0;
        $totaldispensed = 0;
        foreach($drugs as $drug)
        {
            $totalcost += ($drug->drug_cost * $drug->drug_quantity);
        }

         foreach($dispensed as $dispensed)
        {
            $totaldispensed += ($dispensed->drug_cost * $dispensed->drug_quantity);
        }


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
      
        //dd($totalcost);
        return view('pharmacy.dispense',compact('company','payables','receivables','outstanding','mydiagnosis','mycomplaints','totaldispensed','exclusions','patientid','visit_details','patients','prescriptions','dispensed','drugs','totalcost'));

    }

    public function getdrugPending()
{

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = Prescription::where('VisitID','=',$opd_number)->where('status','Request Pending')->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}
    

    public function getPendingPrescription()
    {
      //dd(Input::get('id'));
    $prescriptionid = Input::get('id');
    $prescription = Prescription::find($prescriptionid);
    $data = Array(
        'ID'=>$prescription->id,
        'PatientID'=>$prescription->patientid,
        'VisitID'=>$prescription->visitid,
        'DrugName'=>$prescription->drug_name,
        'DrugQuantity'=>$prescription->drug_quantity,
        'DrugDosage'=>$prescription->drug_dosage,
        'DrugApplication'=>$prescription->drug_application,
        'DrugFrequency'=>$prescription->drug_frequency,
        'Refills'=>$prescription->refills,
        'PatientName'=>$prescription->patient_name,

    );
        return Response::json($data);
    } 

    public function dispenseMedication(Request $request)
    {

       


         $drug_checked = $request->input('drug');
         $visitid = $request->input('opd_number');
   //dd($drug_checked);

        if(is_array($drug_checked))
        {
          foreach($drug_checked as $drug_checked)
          {


                 $affectedRows = Prescription::where('id',$drug_checked)->first();
                   if($affectedRows->drug_quantity == 0)
                   {

                    return redirect()->back()->with('error',$affectedRows->drug_name. ' has no quantity! Please ensure quantity is stated before dispensing medication');
            
                   }

                   else
                   {
                $affectedRows = Prescription::where('id', $drug_checked)
                ->update(array(
                           
                            'status'=>'Dispensed',
                            'date_dispensed' => Carbon::now(),
                            'dispensed_by' => Auth::user()->getNameOrUsername()
                            ));

                $drug = Prescription::where('id', $drug_checked)->first();
                $stocks = Drug::where('name', '=', $drug->drug_name)->decrement('stock',$drug->drug_quantity);
              }
          }

           return redirect()
            ->route('prescriptions-pending')
            ->with('info','Drug dispensed successfully!');

        }

        else
        {

           return redirect()
            ->back()
            ->with('error','Drug did not dispense!');

        }

        
    }

    public function assignConsumables()
    {

      //dd(Input::get("item_requested"));
         if(Input::get('quantity_requested'))
         {
          
            $requistion = new ConsumableRequisition;
            $requistion->consumable = Input::get("item_requested");
            $requistion->assigned_to = Input::get("requested_by");
            $requistion->quantity = Input::get("quantity_requested");
            $requistion->cost = Input::get("item_price");
            $requistion->created_at  = Carbon::now();
            $requistion->created_by  = Auth::user()->getNameOrUsername();
            $requistion->save();

            return redirect()
            ->back()
            ->with('info','Item has successfully been requested!');

          }

          else

          {

             return redirect()
            ->back()
            ->with('error','Item request failed, please enter quantity needed!');
          }



    }

    public function approveAssignedConsumables(Request $request)
    {

      $items = ConsumableRequisition::where(status,'Request Pending')->get();

      return view('pharmacy.requestedcomsu',compact('items'));

             
    }

    public function returnMedication(Request $request)
    {

         $this->validate($request, [
            'drug' => 'required'
        ]);

         $drug_checked = $request->input('drug');
         $visitid = $request->input('opd_number');

        if(is_array($drug_checked))
        {
          foreach($drug_checked as $drug_checked)
          {
                $affectedRows = Prescription::where('id', $drug_checked)
                ->update(array(
                           
                            'status'=>'Returned',
                            'date_dispensed' => Carbon::now(),
                            'dispensed_by' => Auth::user()->getNameOrUsername()
                            ));

                $drug = Prescription::where('id', $drug_checked)->first();
                //dd($drug);
                 //dd($drug);
                $updatebillstoreturn = Bill::where('uuid',$drug->uuid)->update(array('quantity' => $drug->drug_quantity));
                $updatedrugquantity = Prescription::where('uuid',$drug->uuid)->update(array('drug_quantity' => $drug->drug_quantity));

                $stocks = Drug::where('name', '=', $drug->drug_name)->increment('stock',$drug->drug_quantity);
          }

        }

         return redirect()
            ->route('prescriptions-pending')
            ->with('info','Drug successfully been returned!');
    }



    public function getMedicationtoDispense(Request $request)
    {

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = Prescription::where('VisitID','=',$opd_number)->where('status','<>','Dispensed')->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


 public function getDispensedMedication(Request $request)
{

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = Prescription::where('VisitID','=',$opd_number)->where('status','Dispensed')->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


public function getReturnedMedication(Request $request)
{

    try
    {

            $opd_number = Input::get("opd_number");
            $drugcart = Prescription::where('VisitID','=',$opd_number)->where('status','Returned')->get();
              return  Response::json($drugcart);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}

    public function findDrug(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

            $search  = $request->get('search');
        $brands      = Drug::groupby('brand')->get();
        $application      = DrugDosage::get();
        $dispensed = Prescription::where('status','Administered')->count();
        $requested =  Prescription::where('status','Requested')->count();
        $suppliers =    Supplier::get();
        $drugcategories=DrugCategory::orderBy('category', 'ASC')->get();
        
       

        $drugs = Drug::where('name', 'like', "%$search%")
            ->where('is_active', 'Active')
             ->orwhere('classification', 'like', "%$search%")
              ->orwhere('brand', 'like', "%$search%")
               ->orwhere('supplier', 'like', "%$search%")
                ->orwhere('generic_name', 'like', "%$search%")
            ->where('is_active','Active')
            ->orderBy('name')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

         $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }

        return view('pharmacy.drugs',compact('drugs','brands','application','drugcategories','dispensed','requested','suppliers','totalcost'));
    
    }

    public function findConsumable(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

            $search  = $request->get('search');
        $brands      = Consumables::groupby('brand')->get();
        $application = DrugDosage::get();
        $dispensed   = Prescription::where('status','Administered')->count();
        $requested   =  Prescription::where('status','Requested')->count();
        $suppliers   =    Supplier::get();
        $drugcategories=DrugCategory::orderBy('category', 'ASC')->get();
         $assignees =    User::get();
       

        $drugs = Consumables::where('name', 'like', "%$search%")
             ->orwhere('classification', 'like', "%$search%")
              ->orwhere('brand', 'like', "%$search%")
               ->orwhere('supplier', 'like', "%$search%")
            ->where('is_active','Active')
            ->orderBy('name')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

         $totalcost = 0;

        foreach($drugs as $drug)
       {
            $totalcost += ($drug->stock * $drug->unit_price);
       }

        return view('pharmacy.consumables',compact('drugs','assignees','brands','application','drugcategories','dispensed','requested','suppliers','totalcost'));
    
    }


    public function findPrescription(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

            $dispensed =    Prescription::where('status','Dispensed')->count();
            $requested =    Prescription::where('status','Request Pending')->count();

            $brands      = Drug::groupby('brand')->get();
            $search    = $request->get('search');
            $drugs     = Drug::get();
            $periods  = DrugPeriod::orderBy('type', 'ASC')->get();
            $application   = DrugApplication::get();
            $frequency     = DrugFrequency::orderBy('type', 'ASC')->get();
            $dosage=DrugDosage::get();
            $prescriptions = Prescription::where('visitid', 'like', "%$search%")
            ->orWhere('patient_name', 'like', "%$search%")
            ->orWhere('drug_name', 'like', "%$search%")
            ->orderBy('visitid')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

        return view('pharmacy.prescriptions',compact('prescriptions','brands','drugs','application','frequency','dosage','dispensed','requested'));
    
    }



        public function deletedrugfromstore()

        {
            if(Input::get("ID"))
            {
                    $ID = Input::get("ID");
                    $affectedRows = Drug::where('ID', '=', $ID)->delete();

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


        public function deleteconsumablefromstore()

        {
            if(Input::get("ID"))
            {
                    $ID = Input::get("ID");
                    $affectedRows = Consumables::where('ID', '=', $ID)->delete();

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


 public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y', $date);
        return $time->format('Y-m-d');
    }



public function getStockDetails()
    {
      //dd(Input::get('id'));
    $drugid = Input::get('id');
    $drug = Drug::find($drugid);
    $data = Array(
        'drugid'            =>$drug->id,
        'drug_number'       =>$drug->barcode,
        'drug_name'         =>$drug->name,
        'generic_name'      =>$drug->generic_name,
        'brand'             =>$drug->brand,
        'drug_form'         =>$drug->drug_application_default,
        'classification'    =>$drug->classification,
        'stock'             =>$drug->stock,
        'supplier'          =>$drug->supplier,
        'store_box'         =>$drug->store_box,
        'buy_price'         =>$drug->buy_price,
        'sale_price'        =>$drug->sale_price,
        'unit_price'        =>$drug->unit_price,
        'pack_size'         =>$drug->drug_quantity_default,
        'expiry_date'       =>$drug->expiry_date->format('d/m/Y'),
        'stock_alert'       =>$drug->stock_alert,
        'walk_margin'       =>$drug->walk_margin,
        'insurance_margin'  =>$drug->insurance_margin,
    
    );
        return Response::json($data);
    } 


    public function getConusmableDetails()
    {
      //dd(Input::get('id'));
    $drugid = Input::get('id');
    $drug = Consumables::find($drugid);
    $data = Array(
        'drugid'            =>$drug->id,
        'drug_number'       =>$drug->barcode,
        'drug_name'         =>$drug->name,
        'brand'             =>$drug->brand,
        'classification'    =>$drug->classification,
        'stock'             =>$drug->stock,
        'supplier'          =>$drug->supplier,
        'store_box'         =>$drug->store_box,
        'buy_price'         =>$drug->buy_price,
        'sale_price'        =>$drug->sale_price,
        'unit_price'        =>$drug->unit_price,
        'pack_size'         =>$drug->pack_size,
        'expiry_date'       =>$drug->expiry_date->format('d/m/Y'),
        'stock_alert'       =>$drug->stock_alert,
       
        

    );
        return Response::json($data);
    } 

    

   

    public function getDrugInfo()
    {
      //dd(Input::get('id'));
    $drugid = Input::get('medication');
    $drug = Drug::find($drugid);
    $data = Array(
        'drug_dosage'=>$drug->drug_dosage_default,
        'drug_form'=>$drug->drug_application_default,
        'drug_pack_size'=>$drug->drug_quantity_default,
        'drug_generic'=>$drug->generic_name,
        'unit_price'=>$drug->unit_price,

    );
        return Response::json($data);
    }




     public function getConsumableInfo()
    {
      //dd(Input::get('id'));
    $drugid = Input::get('consumable');
    $drug = Consumables::find($drugid);
    $data = Array(
        
        'unit_price'=>$drug->unit_price,

    );
        return Response::json($data);
    } 

    public function updateMedication()
    {   


            //dd(Input::get('drugid'));
            $stock_balance = Drug::where('id',  Input::get('drugid'))->first();

            $balance = $stock_balance->stock;
            $drug = new DrugStore;
            $drug->item_code = Input::get('drugid');
            $drug->item_name = Input::get('drug_name');
            $drug->stock_added = Input::get('stock');
            $drug->stock_balance = $balance;  
            $drug->supplier = Input::get('supplier');
            $drug->status = 'Stock Updated';
            $drug->expiry_date = $this->change_date_format(Input::get('expiry_date'));  
            $drug->created_on  = Carbon::now();
            $drug->created_by  = Auth::user()->getNameOrUsername();
            $drug->save();



            $affectedRows = Drug::where('id',  Input::get('drugid'))
            ->update(array(

           'name'           => Input::get('drug_name'),
           'stock'          => Input::get('stock'),
           'buy_price'      => Input::get('buy_price'),
           'sale_price'     => Input::get('sale_price'),  
           'unit_price'     => Input::get('unit_price'),  
           'brand'          => Input::get('brand'),  
           'stock_alert'    => Input::get('stock_alert'),  
           'drug_application_default' => Input::get('drug_form'),  
           'drug_quantity_default'    => Input::get('pack_size'),  
           'tax'            => Input::get('drug_tax'),
           'expiry_date'    => $this->change_date_format(Input::get('expiry_date')),
           'generic_name'   => Input::get('generic_name'),
           'supplier'       => Input::get('supplier'),

           'insurance_margin'  => Input::get('insurance_margin'),
           'walk_margin'       => Input::get('walk_margin'),


           'classification'     => Input::get('classification'),
            'last_updated_on'   => Carbon::now(),
           'last_updated_by'    => Auth::user()->getNameOrUsername(),
           'store_box'      => Input::get('store_box')));

                          
            if($affectedRows > 0)
            {
             

            return redirect()
            ->back()
            ->with('info','Drug has successfully been updated!');
            }

            else
            {
            return redirect()
            ->back()
            ->with('error','Drug did not update!');
            }

    }


    public function updateMedicationStockLevel()
    {   


            //dd(Input::get('drugid'));
            $stock_balance = Drug::where('id',  Input::get('drugid'))->first();

            $balance = $stock_balance->stock;
            $new_stock_level = $balance + Input::get('new_stock');

            $drug = new DrugStore;
            $drug->item_code = Input::get('drugid');
            $drug->item_name = Input::get('drug_name');
            $drug->stock_added = Input::get('new_stock');
            $drug->stock_balance = $balance;  
            $drug->supplier = Input::get('supplier');
            $drug->status = 'Stock Updated';
            $drug->expiry_date = $this->change_date_format(Input::get('expiry_date'));  
            $drug->created_on  = Carbon::now();
            $drug->created_by  = Auth::user()->getNameOrUsername();
            $drug->save();



            $affectedRows = Drug::where('id',  Input::get('drugid'))
            ->update(array(

           'name'           => Input::get('drug_name'),
           'stock'          => $new_stock_level,
           'buy_price'      => Input::get('buy_price'),
           'sale_price'     => Input::get('sale_price'),  
           'unit_price'     => Input::get('unit_price'),  
           'brand'          => Input::get('brand'),  
           'stock_alert'    => Input::get('stock_alert'),  
           'drug_application_default' => Input::get('drug_form'),  
           'drug_quantity_default'    => Input::get('pack_size'),  
           'tax'            => Input::get('drug_tax'),
           'expiry_date'    => $this->change_date_format(Input::get('expiry_date')),
           'generic_name'   => Input::get('generic_name'),
           'supplier'       => Input::get('supplier'),
           'classification'     => Input::get('classification'),
            'last_updated_on'   => Carbon::now(),
           'last_updated_by'    => Auth::user()->getNameOrUsername(),
           'store_box'      => Input::get('store_box')));

                          
            if($affectedRows > 0)
            {
             
            return redirect()
            ->back()
            ->with('info','Drug has successfully been updated!');
            }

            else
            {
            return redirect()
            ->back()
            ->with('error','Drug did not update!');
            }

    }

     public function updateMedicationRequestQuantity()
    {
            $affectedRows = Prescription::where('id',  Input::get('ID'))->update(array('drug_quantity'=> Input::get('drug_quantity')));

            $getdruguuid = Prescription::where('id',  Input::get('ID'))->value('uuid');

            $affectedRows2 = Bill::where('uuid',  $getdruguuid)->update(array('quantity'  => Input::get('drug_quantity')));


           if($affectedRows2 > 0)
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


     public function returnMedicationRequestQuantity()
    {
            $affectedRows = Prescription::where('id',  Input::get('ID'))->decrement('drug_quantity' ,Input::get('drug_quantity'));

            $getdruguuid = Prescription::where('id',  Input::get('ID'))->value('uuid');

            $affectedRows2 = Bill::where('uuid',  $getdruguuid)->decrement('quantity' , Input::get('drug_quantity'));

            $affectedRows2 = Drug::where('name', '=', $getdruguuid->drug_name)->increment('stock',$drug->drug_quantity);


           if($affectedRows2 > 0)
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



    public function addNewMedication(Request $request)
    {

            try
        {

            $this->validate($request, [
            //'patient_id'=> 'required|unique:patient|max:50',
            'drug_name'=> 'required',
            'buy_price'=> 'required',
            'sale_price'=> 'required',
            'unit_price'=> 'required',
            'stock'=> 'required',

            ]); 

      

            
           // dd( $request->all());

           $drug = new Drug;
           $drug->barcode = $request->input('drug_number');
           $drug->name =  strtoupper($request->input('drug_name'));
           $drug->generic_name = strtoupper($request->input('generic_name'));
           $drug->stock = $request->input('stock');
           $drug->stock_alert = $request->input('stock_alert');
           $drug->classification = $request->input('classification');
           $drug->sale_price = $request->input('sale_price');
           $drug->buy_price = $request->input('buy_price'); 
           $drug->unit_price = $request->input('unit_price'); 
           $drug->drug_dosage_default = $request->input('drug_dosage');
           $drug->drug_application_default = $request->input('drug_form'); 
           $drug->drug_quantity_default = $request->input('pack_size');  
           $drug->expiry_date = $this->change_date_format($request->input('expiry_date'));  
           
           $drug->supplier = $request->input('supplier'); 
           $drug->brand = $request->input('brand'); 

           $drug->walk_margin = $request->input('walk_margin'); 
           $drug->insurance_margin = $request->input('insurance_margin'); 

           $drug->reorder_status = 1;    
           $drug->store_box = $request->input('store_box'); 
           $drug->created_on  = Carbon::now();
           $drug->created_by  = Auth::user()->getNameOrUsername();

           if($drug->save())
          {

            return redirect()
            ->back()
            ->with('info','Drug has successfully been saved!');
          }

          else
          {

             return redirect()
            ->back()
            ->with('error','Drug failed to create!');
          }

}

    catch (\Exception $e) {
           
           echo $e->getMessage();
            return redirect()
            ->route('list-of-drugs-avaliable')
            ->with('warning','Drug failed to create!',$e->getMessage());
        }



    }


    public function addNewConsumable(Request $request)
    {

            try
        {
            
            //dd($request->all());

           $drug = new Consumables;
           $drug->barcode = $request->input('drug_number');
           $drug->name = $request->input('drug_name');
           $drug->stock = $request->input('stock');
           $drug->stock_alert = $request->input('stock_alert');
           $drug->classification = $request->input('classification');
           $drug->sale_price = $request->input('sale_price');
           $drug->buy_price = $request->input('buy_price'); 
           $drug->unit_price = $request->input('unit_price');  
           $drug->pack_size = $request->input('pack_size');  
           $drug->expiry_date = $this->change_date_format($request->input('expiry_date'));  
           $drug->supplier = $request->input('supplier'); 
           $drug->brand = $request->input('brand'); 
           $drug->reorder_status = 1;    
           $drug->store_box = $request->input('store_box'); 
           $drug->created_on  = Carbon::now();
           $drug->created_by  = Auth::user()->getNameOrUsername();

           if($drug->save())
          {

            return redirect()
            ->back('consumables-list')
            ->with('info','Consumable has successfully been saved!');
          }

          else
          {

             return redirect()
            ->route('consumables-list')
            ->with('error','Consumable failed to create!');
          }

}

    catch (\Exception $e) {
           
           echo $e->getMessage();
            return redirect()
            ->route('consumables-list')
            ->with('warning','Consumable failed to create!',$e->getMessage());
        }



    }


    public function updateConsumable()
    {   


            //dd(Input::get('drugid'));
            $stock_balance = Consumables::where('id',  Input::get('drugid'))->first();

            $balance = $stock_balance->stock;
            $drug = new DrugStore;
            $drug->item_code = Input::get('drugid');
            $drug->item_name = Input::get('drug_name');
            $drug->stock_added = Input::get('stock');
            $drug->stock_balance = $balance;  
            $drug->supplier = Input::get('supplier');
            $drug->expiry_date = $this->change_date_format(Input::get('expiry_date'));  
            $drug->created_on  = Carbon::now();
            $drug->created_by  = Auth::user()->getNameOrUsername();
            $drug->save();



            $affectedRows = Consumables::where('id',  Input::get('drugid'))
            ->update(array(

           'name'           => Input::get('drug_name'),
           'stock'          => Input::get('stock'),
           'buy_price'      => Input::get('buy_price'),
           'sale_price'     => Input::get('sale_price'),  
           'unit_price'     => Input::get('unit_price'),  
           'brand'          => Input::get('brand'),  
           'stock_alert'    => Input::get('stock_alert'),  
           'pack_size'      => Input::get('pack_size'),  
           'tax'            => Input::get('drug_tax'),
           'expiry_date'    => $this->change_date_format(Input::get('expiry_date')),
           'supplier'       => Input::get('supplier'),
           'classification'     => Input::get('classification'),
            'last_updated_on'   => Carbon::now(),
           'last_updated_by'    => Auth::user()->getNameOrUsername(),
           'store_box'      => Input::get('store_box')));

                          
            if($affectedRows > 0)
            {
             
            return redirect()
            ->back()
            ->with('info','Consumable has successfully been updated!');
            }

            else
            {
            return redirect()
            ->back()
            ->with('error','Consumable did not update!');
            }

    }


     public function addDamagedDrug()
    {   
            //dd(Input::get('drugid'));

             if(Input::get('stock') >= Input::get('damaged_stock'))
            {

            $stock_balance = Drug::where('id',  Input::get('drugid'))->first();
            
            $balance     = $stock_balance->stock;
            $supplier    = $stock_balance->supplier;
            $expiry_date = $stock_balance->expiry_date;
            $unit_price  = $stock_balance->unit_price;
            $drugname    = $stock_balance->name;  

            $drug = new DrugStore;
            $drug->item_code = Input::get('drugid');
            $drug->item_name = $drugname;
            $drug->stock_added = Input::get('damaged_stock');
            $drug->stock_balance = $balance;  
            $drug->supplier = $supplier;
            $drug->expiry_date = $expiry_date;  
            $drug->status = Input::get('damaged_status');
            $drug->unit_price = $unit_price;
            $drug->comments = Input::get('remark');
            $drug->created_on  = Carbon::now();
            $drug->created_by  = Auth::user()->getNameOrUsername();
            $drug->save();



            $affectedRows = Drug::where('id',  Input::get('drugid'))->decrement('stock',Input::get('damaged_stock'));

                          
            if($affectedRows > 0)
            {
             
            return redirect()
            ->back()
            ->with('info','Drug has successfully been recorded as damaged!');
            }

            else
            {
            return redirect()
            ->back()
            ->with('error','Drug status did not update!');
            }

          }

             else
            {
            return redirect()
            ->back()
            ->with('error','Drug status did not update!');
            }


    }


   

    public function addExpiredDrug()
    {   
            //dd(Input::get('drugid'));

            if(Input::get('stock') >= Input::get('expired_stock'))
            {
            
            $stock_balance = Drug::where('id',  Input::get('drugid'))->first();
            
            $balance     = $stock_balance->stock;
            $supplier    = $stock_balance->supplier;
            $expiry_date = $stock_balance->expiry_date;
            $unit_price  = $stock_balance->unit_price;
            $drugname    = $stock_balance->name;   
            $drug = new DrugStore;
            $drug->item_code = Input::get('drugid');
            $drug->item_name = $drugname;
            $drug->stock_added = Input::get('expired_stock');
            $drug->stock_balance = $balance-Input::get('expired_stock');  
            $drug->supplier = $supplier;
            $drug->expiry_date = $expiry_date;  
            $drug->status = 'Stock Expired';  
            $drug->unit_price = $unit_price;
            $drug->comments = Input::get('remark');
            $drug->created_on  = Carbon::now();
            $drug->created_by  = Auth::user()->getNameOrUsername();
            $drug->save();


            $ExpiredRows    = Drug::where('id',  Input::get('drugid'))->decrement('stock',Input::get('expired_stock'));
           // $affectedRows   = Drug::where('id',  Input::get('drugid'))->update(array('is_active' => 'Expired'));

                          
            if($ExpiredRows > 0)
            {
             
            return redirect()
            ->back()
            ->with('info','Drug has successfully been recorded as expired!');
            }

            else
            {
            return redirect()
            ->back()
            ->with('error','Drug status did not update!');
            }

          }

          else
            {
            return redirect()
            ->back()
            ->with('error','Drug status did not update!');
            }

    }


    public function dobulkApproval(Request $request)
    {
        $drug_checked = $request->input('drug');

        //dd($drug_checked);

        if(is_array($drug_checked))
    {
      foreach($drug_checked as $drug_checked)
      {
        $affectedRows   = Drug::where('id',  $drug_checked)->update(array('is_active' => 'Active'));    
        
      }

    }

     return redirect()
            ->route('drugs-pending-approval')
            ->with('success','Selected drug(s) approved!');
    }



    public function dobulkUpload()
    {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");

           $getuploaddetails =  DrugStock::where('id',$ID)->get();


            if($getuploaddetails[0]->category == 'Drugs')
            {


            if($getuploaddetails)

            {
                foreach ($getuploaddetails as $value) 
                    {

                        $affectedRows1   = Drug::where('id', $value->name)->increment('stock',$value->quantity);  
                        $affectedRows2   = Drug::where('id', $value->name)->update(array('unit_price' => $value->unit_price));   
                        $affectedRows2  = Drug::where('id', $value->name)->update(array('supplier' => $value->supplier));

                        $affectedRows3   = DrugStock::where('id', $value->id)->update(array('upload_state' => 'Uploaded'));
                        $affectedRows3   = DrugStock::where('id', $value->id)->update(array('uploaded_on' => Carbon::now()));
                        $affectedRows3   = DrugStock::where('id', $value->id)->update(array('uploaded_by' => Auth::user()->getNameOrUsername()));

                    }

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

                if($getuploaddetails)

            {
                foreach ($getuploaddetails as $value) 
                    {

                        $affectedRows1   = Consumables::where('id', $value->name)->increment('stock',$value->quantity);  
                        $affectedRows2   = Consumables::where('id', $value->name)->update(array('unit_price' => $value->unit_price));   
                        $affectedRows2   = Consumables::where('id', $value->name)->update(array('supplier' => $value->supplier));

                        $affectedRows3   = DrugStock::where('id', $value->id)->update(array('upload_state' => 'Uploaded'));
                        $affectedRows3   = DrugStock::where('id', $value->id)->update(array('uploaded_on' => Carbon::now()));
                        $affectedRows3   = DrugStock::where('id', $value->id)->update(array('uploaded_by' => Auth::user()->getNameOrUsername()));

                    }

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


     public function deleteBulkInvoice()

        {
            if(Input::get("ID"))
            {
                    $ID = Input::get("ID");
                    $affectedRows = DrugStock::where('invoice_number', $ID)->delete();

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


        public function deleteInvoiceItem()

        {
            if(Input::get("ID"))
            {
                    $ID = Input::get("ID");
                    $affectedRows = DrugStock::where('id', $ID)->delete();

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


        public function printVoucher($id)
    {

    try
    {
        //dd($id);

        $items = DrugStock::where('invoice_number',$id)->orderby('description','asc')->get();
        return view('pharmacy.received_voucher', compact('items'));

    }

    catch (\Exception $e) 
    {
           
           echo $e->getMessage();
            return redirect()
            ->route('404');
    }

    }




    public function getSearchInvoice(Request $request)
    {
    
     

        $search = $request->get('search');
        

        $suppliers =    Supplier::get();
        $drugcategories = DrugCategory::where('scope','Pharmacy')->orderBy('category', 'asc')->get();
        $application    = DrugDosage::get();
        $brands      = Drug::groupby('brand')->get();

         
         $drugs =  Drug::where('is_Active','Active')->orderBy('Name', 'asc')->get();
         $consumables  =  Consumables::orderBy('name', 'asc')->get();
         

        
        $search = $request->get('search');
        $time   = explode(" - ", Input::get('invoice_period')); 
        


        if(!$search=="")
        {


           $items = DrugStock::where('description', 'like', "%$search%")
                     ->orWhere('invoice_number', 'like', "%$search%")
                      ->orWhere('supplier', 'like', "%$search%")
                     ->groupBy('invoice_number')
                     ->orderBy('date','desc')
                      ->paginate(30);
   
 
        }

        else
        {
            //dd($time);

            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

           

            $items = DrugStock::where('invoice_number', 'like', "%$search%")
            ->whereBetween('invoice_date',array($from,$to))
            ->groupBy('invoice_number')
            ->orderBy('created_on','desc')
            ->paginate(200)
            ->appends(['search' => $search]);
        }


         return view('pharmacy.bills', compact('drugs','consumables','suppliers','items','payables','drugcategories','application','brands'));


    
    }

    


}
