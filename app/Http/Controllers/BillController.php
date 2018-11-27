<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Bill;
use OrionMedical\Models\BillMaster;
use OrionMedical\Models\Customer;
use OrionMedical\Models\Prescription;
use OrionMedical\Models\Consultation;
use OrionMedical\Models\PatientDiagnosis;
use OrionMedical\Models\Payments;
use OrionMedical\Models\OPD;
use OrionMedical\Models\Company;
use OrionMedical\Models\BalanceSheet;
use OrionMedical\Models\Ledger;
use OrionMedical\Models\ServiceCharge;
use OrionMedical\Http\Requests;
use DB;
use OrionMedical\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Input;
use Response;
use Carbon\Carbon;
use Auth;
use PDF;

use Smsgh;
use BasicAuth;
use ApiHost;
use MessagingApi;
use Message;

require 'Smsgh/Api.php';



class BillController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware('role:Billing|System Admin|Pharmacist');
        
    }

    public function patientEnquiry()
    {

        return view('errors.503');
    }



    public function momopay($id)
    {

        $bills              = Bill::where('visit_id', $id)->orderBy('date', 'desc')->get();
        $paiditems          = Payments::where('EventID', $id)->get();
    
    $payables = 0;
    $receivables = 0;

        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       foreach($paiditems as $paiditem)
       {
            $receivables += ($paiditem->AmountReceived);
       }

      $outstanding = ($payables - $receivables);
        return view('billing.momo',compact('outstanding','bills'));
    }



    public function getPatientOutstanding()
    {

      $id = Input::get("patient_id");

      $bills          = Bill::where('patient_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
      $payables       = 0;
      $mylastvisit    = $bills[0]->date;
    

        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       $added_response = array('myoutstanding'=>$payables,'mylastvisit'=>$mylastvisit);
       return  Response::json($added_response);
    }



    public function getPatientBill($id)
   {


    $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
    $patientid=Bill::where('visit_id' ,'=', $id)->value('patient_id');
    $patients =  Customer::where('patient_id' ,'=', $patientid)->first();
    $visitdetails   = OPD::where('opd_number' , $id)->first();

    //$balances       = BalanceSheet::where('patient_id' ,'=', $patientid)->where('note', 'Unpaid')->get();
    //dd($balances);
    $bills              = Bill::where('visit_id', $id)->orderBy('date', 'desc')->get();
    $paiditems          = Payments::where('EventID', $id)->get();
    
    $payables = 0;
    $receivables = 0;

        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       foreach($paiditems as $paiditem)
       {
            $receivables += ($paiditem->AmountReceived);
       }

      $outstanding = ($payables - $receivables);
    $receiptmodes   = DB::table('receipt_mode')->get();
    $services       = ServiceCharge::where('status','Active')->get();
    return view('billing.invoice', compact('patients','visitdetails','bills','receiptmodes','balances','services','outstanding','payables','receivables','generalservices'));
}

 public function printBill($id)
   {

    
    $company = Company::get()->first();
    $patientid=Bill::where('visit_id' ,'=', $id)->value('patient_id');
    $patients =  Customer::where('patient_id' ,'=', $patientid)->get();
    $bills=Bill::where('visit_id' ,'=', $id)->orderBy('date', 'desc')->get();
    $paiditems          = Payments::where('EventID', $id)->get();

    $payables = 0;
     $receivables = 0;

    foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       foreach($paiditems as $paiditem)
       {
            $receivables += ($paiditem->AmountReceived);
       }

    return view('billing.print', compact('patients','bills','company','payables','receivables'));

    }

    public function printClaimBill($id)
   {

     $visits  =  OPD::with('patient')
    ->with('diagonsis')
    ->with('bills')
    ->with('payments')
    ->where('opd_number',$id)->get();

    return view('billing.claimform', compact('visits'));

    }


   
    public function provider()
    {

      $providers = OPD::groupBy('care_provider')->distinct()->get();

      //dd($providers);
      return view('claims.provider', compact('providers'));
    }


     public function providerPayments()
    {

      $providers = OPD::groupBy('care_provider')->distinct()->get();

      //dd($providers);
      return view('billing.report', compact('providers'));
    }




    public function printClaimBillBulk(Request $request)
   {

    //dd();
   
   
    $company = Company::get()->first();
    $from    =  Carbon::createFromFormat('d/m/Y',  Input::get('datefrom'))->format('Y-m-d ');
    $to      =  Carbon::createFromFormat('d/m/Y', Input::get('dateto'))->format('Y-m-d');

    $visits  =  OPD::with('patient')
    ->with('diagonsis')
    ->with('bills')
    ->with('payments')
    ->whereBetween('created_on',array($from." 00:00:00",$to." 23:59:59"))
    ->where('care_provider',Input::get('care_provider'))
    ->where('payercode','<>','Private')->get();

    

    $totalbill = 0;

    foreach($visits as $visit)
    {
      foreach ($visit->bills as $item) 
      {
         $totalbill += $item->amount * $item->quantity;
      }
     
    }


     $totalpayments = 0;

    foreach($visits as $visit)
    {
      foreach ($visit->payments as $item) 
      {
         $totalpayments += $item->total_price ;
      }
     
    }

    //dd($totalpayments);
    
   
   
 //dd($total);

    return view('claims.claimformbulk', compact('visits','totalbill','totalpayments','from','to'));

    }

    public function emailBill($id)
   {

     $company  = Company::get()->first();
    $patientid = Bill::where('visit_id' ,'=', $id)->value('patient_id');
    $patients  =  Customer::where('patient_id' ,'=', $patientid)->get();
    $bills=Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
    return view('billing.invoice', compact('patients','bills','company'));

    }


public function index()
   {
    $company = Company::get()->first();
    //$bills   = Bill::where('note', 'Unpaid')->orderBy('date', 'DESC')->paginate(30);
    $bills = Ledger::with('payments')
    ->where('payercode','=','Private')
    ->orderBy('date','desc')
    ->paginate(30);
    //dd($bills);
    $billcount = Bill::where('note', 'Unpaid')->count();
    $receiptcount = Bill::where('note', 'Paid')->count();
    $receiptmodes=DB::table('receipt_mode')->get();
     
      //dd($bills);
    return view('billing.index', compact('bills','receiptmodes','receiptcount','billcount','company'));

    }



  public function insuranceportal()
   {

    $bills = Ledger::with('payments')->where('note','Unpaid')
                     ->where('claimstatus','<>','Vetted')
                     ->where('payercode','<>','Private')
                     ->orderBy('date','asc')
                    ->paginate(30);

      //$url = $bills->url($bills->currentPage());
      $vetted =0;              
      $vetted = Ledger::with('payments')->where('note','Unpaid')->where('payercode','<>','Private')->paginate(30);
      //dd($vetted->total());   

    return view('claims.index', compact('bills','vetted'));

    }



    public function printClaimBillSummary(Request $request)
    {


         $from    =  Carbon::createFromFormat('d/m/Y', $request->input('datefrom'))->format('Y-m-d');
        $to      =  Carbon::createFromFormat('d/m/Y', $request->input('dateto'))->format('Y-m-d');


        $datefrom = $from;
        $dateto   = $to;

       $bills = Ledger::with('payments')->whereBetween('date',array($from." 00:00:00",$to." 23:59:59"))
                     ->where('claimstatus','<>','Vetted')
                      ->where('copayer',Input::get('care_provider'))
                     ->where('payercode','<>','Private')
                     ->orderBy('date','asc')
                    ->paginate(30);

        //dd($bills);

        return view('claims.summary', compact('bills', 'datefrom','dateto'));

    }

     public function vettedclaims()
   {

   $bills = Ledger::with('payments')->where('note','Unpaid')
                     ->where('claimstatus','Vetted')
                     ->where('payercode','<>','Private')
                     ->orderBy('date','asc')->paginate(30);;

     //$url = $bills->url($bills->currentPage());
    $vetted =0;              
    $vetted = BillMaster::where('claimstatus','Vetted')->where('note','Unpaid')->where('payercode','<>','Private')->groupBy('visit_id')->paginate(30);
    return view('claims.index', compact('bills','vetted'));

    }


     public function vetClaim($id)
   {

    $url='';
    $urlstatus = Bill::where('visit_id',$id)->first();
    if(!$urlstatus->url)
    {
     $url = url()->previous();
     $affectedRows = Bill::where('visit_id',$id)->update(array('url' => $url));
   }
   else
   {
     //dd($url);
   }

    $generalservices = ServiceCharge::orderBy('type', 'ASC')->where('department','OPD')->orwhere('department','Radiology')->orwhere('department','Laboratory')->get();
    $patientid=Bill::where('visit_id' ,'=', $id)->value('patient_id');
    $patients =  Customer::where('patient_id' ,'=', $patientid)->first();
    $visitdetails   = OPD::where('opd_number' , $id)->first();

     $mydiagnosis = PatientDiagnosis::where('visitid' , $id)->get();
   
    $bills              = Bill::where('visit_id', $id)->orderBy('date', 'desc')->get();
    $paiditems          = Payments::where('EventID', $id)->get();
    
    $payables = 0;
    $receivables = 0;

        foreach($bills as $bill)
       {
            $payables += ($bill->rate * $bill->quantity);
       }

       foreach($paiditems as $paiditem)
       {
            $receivables += ($paiditem->AmountReceived);
       }

      $outstanding = ($payables - $receivables);
    $receiptmodes   = DB::table('receipt_mode')->get();
    $services       = ServiceCharge::where('status','Active')->get();
    return view('claims.vet', compact('url','patients','visitdetails','bills','mydiagnosis','receiptmodes','balances','services','outstanding','payables','receivables','generalservices'));
}




    public function receipt($id)
   {
    
     $bills  =  Payments::with('items')->where('PaymentID',$id)->get();
    
      
      $paiditems          = Payments::where('EventID', $bills[0]->EventID)->get();
      $receivables =0;
    
       foreach($paiditems as $paiditem)
       {
            $receivables += ($paiditem->AmountReceived);
       }

    return view('billing.receipt', compact('bills','receivables'));
  
    }

    public function payments()
   {

    $bills = Payments::with('invoices')
                     ->groupBy('paymentid')
                     ->orderBy('createdate','desc')
                    ->paginate(30);

    $billcount = BillMaster::where('note', 'Unpaid')->count();
    $receiptcount = BillMaster::where('note', 'Paid')->count();
    $receiptmodes=DB::table('receipt_mode')->get();


      

      //dd($bills);
    return view('billing.payments', compact('bills','receiptmodes','receiptcount','billcount'));

    }


    public function printPaymentSummary(Request $request)
   {



        $from    =  Carbon::createFromFormat('d/m/Y', $request->input('datefrom'))->format('Y-m-d');
        $to      =  Carbon::createFromFormat('d/m/Y', $request->input('dateto'))->format('Y-m-d');


        $datefrom = $from;
        $dateto   = $to;

        $bills = Payments::with('invoices')->whereBetween('createdate',array($from." 00:00:00",$to." 23:59:59"))
                     ->groupBy('paymentid')
                     ->orderBy('createdate','desc')
                    ->get();
      //dd($bills);
    return view('billing.paymentsummary', compact('bills','datefrom','dateto'));

    }




      public function insurance()
   {

              $bills = Ledger::with('payments')
                     ->where('note','Unpaid')
                     ->where('payercode','<>','Private')
                     ->groupBy('visit_id')
                     ->orderBy('date','desc')
                    ->paginate(30);

    $billcount = BillMaster::where('note', 'Unpaid')->count();
    $receiptcount = BillMaster::where('note', 'Paid')->count();
    $receiptmodes=DB::table('receipt_mode')->get();
      
    return view('billing.insurance', compact('bills','receiptmodes','receiptcount','billcount'));

    }

    public function downloadpendinginvoices(Request $request)
    {
        $bills=Bill::where('note', 'Unpaid')->orderBy('date', 'DESC')->get();
        $receiptmodes=DB::table('receipt_mode')->get();

       // $items = DB::table("items")->get();
       

        return view('billing.index', compact('bills','receiptmodes'));
    }


public function dashboard()
   {

    $bills=Bill::orderBy('date', 'DESC')->paginate(30);
      
    return view('billing.dashboard', compact('bills'));

    }


    public function getBillitems(Request $request)
    {
    try
    {

            $opd_number = Input::get("opd_number");
            $bills=Bill::where('visit_id' , $opd_number)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
            return  Response::json($bills);        
    }

    catch (\Exception $e) 
    {
           echo $e->getMessage();
        
    }
    }

    public function fetchbilldetails()
    {
      //dd($opd_id);
    $id = Input::get('id');
    $user = Bill::find($id);
    $data = Array(
        'patient_id'=>$user->patient_id,
        'visit_id'=>$user->visit_id,
        'fullname'=>$user->fullname,
      
    );
        return Response::json($data);
    }

    function generatePin($number) 
      {
        $alpha = array();
    for ($u = 65; $u <= 90; $u++) {
        // Uppercase Char
        array_push($alpha, chr($u));
    }

  

    // Get random alpha character
    $rand_alpha_key = array_rand($alpha);
    $rand_alpha = $alpha[$rand_alpha_key];

    // Add the other missing integers
    $rand = array($rand_alpha);
    for ($c = 0; $c < $number - 1; $c++) {
        array_push($rand, mt_rand(0, 9));
        shuffle($rand);
    }

    return implode('', $rand);
    }


    
    public function doVetting(Request $request)
    {
      //dd($request->input('url'));

          $lasturl = Bill::where('visit_id',$request->input('visit_id'))->first();

         $affectedRows = Bill::where('visit_id',$request->input('visit_id'))
                    ->update(array(
                                   'claimstatus' => 'Vetted'
                                   ));

        if($affectedRows > 0)
            {
               
            return redirect($lasturl->url)
            ->with('success','Claim has successfully been vetted');

            }
            else
            {
                return redirect()
            ->back()
            ->with('error','Vetting processing failed!');
            }

    }


      public function approveclaim()
    {     
         

             $lasturl = Bill::where('visit_id',Input::get("opd_number"))->first();

             $affectedRows = Bill::where('visit_id',Input::get("opd_number"))
                    ->update(array(
                                   'claimstatus' => 'Vetted',
                                   'vetting_remark' => Input::get("vetting_remark")
                                   ));

    

            if($affectedRows > 0)
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

     public function queryclaim()
    {     
         

             $lasturl = Bill::where('visit_id',Input::get("opd_number"))->first();

             $affectedRows = Bill::where('visit_id',Input::get("opd_number"))
                    ->update(array(
                                   'claimstatus' => 'Queried',
                                   'vetting_remark' => Input::get("vetting_remark")
                                   ));

    

            if($affectedRows > 0)
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

     public function rejectclaim()
    {     
         

             $lasturl = Bill::where('visit_id',Input::get("opd_number"))->first();

             $affectedRows = Bill::where('visit_id',Input::get("opd_number"))
                    ->update(array(
                                   'claimstatus' => 'Rejected',
                                   'vetting_remark' => Input::get("vetting_remark")
                                   ));

    

            if($affectedRows > 0)
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

    public function doPayment(Request $request)
    {


//ZOLMITRIPTAN 2.5MG  2.5 MG STAT AT THE ONSET OF THE HEADACHE, REPEAT AFTER 2HRS IF THE HEADACHE DOES NOT SUBSIDE. NOT TO

      if($request->input('amountreceived') != 0)

      {
        
       $id = $request->input('visit_id');
       $authorizebill = Bill::where('quantity',0)->where('visit_id', $id)->count();

       //dd($authorizebill);

       if($authorizebill > 0 )

       {

         return redirect()
            ->route('billing-index')
            ->with('error','Some items on the bill have zero quantity. Please ensure all items have quantities!');

       }  

       else
       {

        $paymentid = $this->generatePin(15);

        $payments = new Payments();
        $payments->PaymentID =  $paymentid;
        $payments->PatientID =  $request->input('patient_id');
        $payments->EventID=$request->input('visit_id');
        $payments->AmountReceived =  $request->input('amountreceived');
        $payments->Currency =  'GHS';
        $payments->Narration =  'Medical Bill Payments';
        $payments->PaymentMethod= $request->input('paymentmethod');
        $payments->RefNumber= $request->input('referencenumber');
        $payments->CreateDate= Carbon::now();
        $payments->CreatedBy = Auth::user()->getNameOrUsername();
        $payments->LastModifiedTime =  Carbon::now();

     

        $visitid   = $request->input('visit_id');
        $paymentid = $this->generatePin(15);

        $payments = new Payments();
        $payments->PaymentID =  $paymentid;
        $payments->PatientID =  $request->input('patient_id');
        $payments->EventID=$request->input('visit_id');
        $payments->AmountReceived =  $request->input('amountreceived');
        $payments->Currency =  'GHS';
        $payments->Narration =  'Medical Bill Payments';
        $payments->PaymentMethod= $request->input('paymentmethod');
        $payments->RefNumber= $request->input('referencenumber');
        $payments->CreateDate= Carbon::now();
        $payments->CreatedBy = Auth::user()->getNameOrUsername();
        $payments->LastModifiedTime =  Carbon::now();
        
        if($payments->save())
        {
            $item_checked = $request->input('item');   

            //edd($item_checked );

            if(is_array($item_checked))
            {
              foreach($item_checked as $item_checked)
              {
                    $affectedRows = Bill::where('uuid', '=',$item_checked)
                    ->update(array(
                                   'note' => 'Paid','paymentid'=>$paymentid
                                   ));

                     $affectedRows2 = Prescription::where('uuid', '=',$item_checked)
                    ->update(array(
                                   'pay_status' => 'Paid','receipt_number'=>$paymentid
                                   ));

              }
            }

            //“Your lab tests have just come in. You will be seeing the doctor soon. We wish you the best of health, *Gilead*”


            $sms = 'Dear '.$request->input('yourname').', we received an amount of GHS '.$request->input('amountreceived').' as payment of your bill. Thank You. We wish you the best of health. Gilead!';
            $this->SendSMS($sms,$request->input('yourphone'));

             return redirect()
            ->route('receipt', $paymentid)
            ->with('info','Payment has successfully been processed!');
           
        }

        else
        {

              return redirect()
            ->route('billing-index')
            ->with('warning','Error processing payments!');

        } 

      }

    }

    else
    {

        return redirect()
            ->back()
            ->with('error','Error processing payments!');
    }

    
    
    }

    public function excludeBillItem()
    {
                
            try
            {

            $id = Input::get("ID");

            $affectedRows = Bill::where('id', $id)->delete();

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

        catch (Exception $e) 

            {
                   echo 'Leave rejected but email connection error, please go back and refresh!';
            }  
    }

    public function getSearchResults(Request $request)
    {
    
     

        $search = $request->get('search');
        $billcount = BillMaster::where('note', 'Unpaid')->count();
        $receiptcount = BillMaster::where('note', 'Paid')->count();
        $receiptmodes=DB::table('receipt_mode')->get();
        
        $search = $request->get('search');
        $time   = explode(" - ", Input::get('review_period')); 
        


        if(!$search=="")
        {


           $bills = Ledger::with('payments')->where('fullname', 'like', "%$search%")
                     ->orWhere('patient_id', 'like', "%$search%")
                      ->orWhere('copayer', 'like', "%$search%")
                      ->orWhere('note', 'like', "%$search%")
                      ->Where('payercode', 'Private')
                      ->Where('total_cost', '>', 0)
                     ->groupBy('visit_id')
                     ->orderBy('date','desc')
                      ->paginate(30)
                      ->appends(['search' => $search]);
   
 
        }

        else
        {
            //dd($time);

            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

           

            $bills = Ledger::with('payments')->where('fullname', 'like', "%$search%")
            ->whereBetween('date',array($from." 00:00:00",$to." 23:59:59"))
            ->where('note', 'Unpaid')
            ->groupBy('visit_id')
            ->orderBy('date','desc')
            ->paginate(200)
            ->appends(['search' => $search]);
        }


         return view('billing.index', compact('bills','receiptmodes','billcount','receiptcount'));


    
    }



    


    public function getSearchPayments(Request $request)
    {
    
     

        $search = $request->get('search');
        
        $billcount = BillMaster::where('note', 'Unpaid')->count();
        $receiptcount = BillMaster::where('note', 'Paid')->count();
        $receiptmodes=DB::table('receipt_mode')->get();
        
        $search = $request->get('search');
        $time   = explode(" - ", Input::get('review_period')); 
        


        if(!$search=="")
        {


          $bills = Payments::with('bills')->where('EventID', 'like', "%$search%")
                     ->groupBy('paymentid')
                     ->orderBy('createdate','desc')
                     ->paginate(30);
 
        }

        else
        {
            

            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

          // dd($from);

           $bills = Payments::whereBetween('CreateDate',array($from." 00:00:00",$to." 23:59:59"))
                     ->paginate(200)
                    ->appends(['search' => $search]);

           dd($bills);
        }


         return view('billing.payments', compact('bills','receiptmodes','billcount','receiptcount'));


    
    }



    public function getSearchResultsClaim(Request $request)
    {
    
     

        $search = $request->get('search');
        $billcount = BillMaster::where('note', 'Unpaid')->count();
        $receiptcount = BillMaster::where('note', 'Paid')->count();
        $receiptmodes=DB::table('receipt_mode')->get();
        
        $search = $request->get('search');
        $time   = explode(" - ", Input::get('review_period')); 
        


        if(!$search=="")
        {
         $bills = Ledger::with('payments')->where('fullname', 'like', "%$search%")
                  ->orWhere('patient_id', 'like', "%$search%")
                  ->orWhere('copayer', 'like', "%$search%")
                     ->orderBy('date','desc')
                    ->paginate(30)
                    ->appends(['search' => $search]);

        }

        else
        {
            //dd($time);

            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

           

             $bills = Ledger::with('payments')->where('note','Unpaid')->where('fullname', 'like', "%$search%")
             ->whereBetween('date',array($from." 00:00:00",$to." 23:59:59"))
             ->where('note', 'Unpaid')
             ->where('payercode' ,'<>', 'Private')
            ->orderBy('date','desc')
            ->paginate(30)
            ->appends(Input::except('page'));
        }

        $vetted =$bills;
         return view('claims.index', compact('bills','receiptmodes','billcount','receiptcount','vetted'));


    
    }

    

    public function doEnquiry(Request $request)
    {
    
     
   

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');
        $receiptmodes=DB::table('receipt_mode')->get();
        $bills = Bill::where('note', 'Unpaid')->where('fullname', 'like', "%$search%")
            ->orWhere('patient_id', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

            return view('billing.index', compact('bills','receiptmodes'));
    
    }

    public function SendSMS($content,$phone)
    {

    $messages = $content;

    // Here we assume the user is using the combination of his clientId and clientSecret as credentials
    $auth = new BasicAuth("ciiihqvu", "vjhfjgrv");

    // instance of ApiHost
    $apiHost = new ApiHost($auth);
    $enableConsoleLog = TRUE;
    $messagingApi = new MessagingApi($apiHost, $enableConsoleLog);

  
    try 
    {
        // Default Approach
        $mesg = new Message();
        $mesg->setContent($messages);
        $mesg->setTo($phone);
        $mesg->setFrom("Gilead");
        $mesg->setRegisteredDelivery(true);

        $messageResponse = $messagingApi->sendMessage($mesg);

        //$response_code = SMS::where('id', '=', $message->id)->update(array('status' => 'Sent'));

    
    } 
    catch (Exception $ex) 
    {
        //echo $ex->getTraceAsString();
    }
}




}
