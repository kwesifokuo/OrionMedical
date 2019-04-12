<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use OrionMedical\Models\Customer;
use OrionMedical\Models\User;
use OrionMedical\Models\Consumables;
use OrionMedical\Models\Bill;
use OrionMedical\Models\Payments;
use OrionMedical\Models\Company;
use OrionMedical\Models\Event;
use OrionMedical\Models\OPD;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
         $company = Company::get()->first();


        $corporate     = Customer::where('accounttype', 'Corporate')->where('status','Active')->count();
        $private       = Customer::where('accounttype', 'Private')->where('status','Active')->count();
        $insurance     = Customer::where('accounttype', 'Health Insurance')->where('status','Active')->count();
        $expatraite    = Customer::where('accounttype', 'Gratis')->where('status','Active')->count();
        $gratis        = Customer::where('accounttype', 'Gratis')->where('status','Active')->count();
        $total         = Customer::where('status','Active')->count();
       
         //dd($pharmacy);
         $corporate    = $corporate/$total * 100;
         $private      = $private/$total * 100;
         $insurance    = $insurance/$total * 100;
         $expatraite   = $expatraite/$total * 100;
         $gratis       = $gratis/$total * 100;



       $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('doughnut')
        ->size(['width' => 1000, 'height' => 300])
        ->labels(['Corporate', 'Private','Health Insurance','Gratis','Gratis'])
        ->datasets([
            [
                'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(255, 159, 64)', 'rgb(255, 206, 86)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)'],
                'hoverBackgroundColor' => ['rgb(255, 99, 132)', 'rgb(255, 159, 64)', 'rgb(255, 206, 86)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)'],
                'data' => [ $corporate , $private , $insurance , $expatraite, $gratis ]
                
            ]
        ])
        ->options([]);


       
       $views = OPD::where('payercode','Private')->whereRaw("created_on >= last_day(now()) + interval 1 day - interval 1 month")->groupBy(DB::raw('DATE(admissions.created_on)'))->orderby('created_on','asc')->limit(30)->get([DB::raw("count(*) as no_of_visits,0"),DB::raw("DATE_FORMAT(created_on,'%d-%M') as day_of_month")]);
       $views2 = OPD::where('payercode','Corporate')->whereRaw("created_on >= last_day(now()) + interval 1 day - interval 1 month")->groupBy(DB::raw('DATE(admissions.created_on)'))->orderby('created_on','asc')->limit(30)->get([DB::raw("count(*) as no_of_visits,0"),DB::raw("DATE_FORMAT(created_on,'%d-%M') as day_of_month")]);
       $views3 = OPD::where('payercode','Health Insurance')->whereRaw("created_on >= last_day(now()) + interval 1 day - interval 1 month")->groupBy(DB::raw('DATE(admissions.created_on)'))->orderby('created_on','asc')->limit(30)->get([DB::raw("count(*) as no_of_visits,0"),DB::raw("DATE_FORMAT(created_on,'%d-%M') as day_of_month")]);
       


      
        
         $labels = array();
         $visits = array();

         $labels2 = array();
         $visits2 = array();

         $labels3 = array();
         $visits3 = array();

        foreach ($views as $view) {

            array_push($labels, $view->day_of_month);
            array_push($visits, $view->no_of_visits);
        }


        foreach ($views2 as $view2) {

            array_push($labels2, $view2->day_of_month);
            array_push($visits2, $view2->no_of_visits);
        }


        foreach ($views3 as $view3) {

            array_push($labels3, $view3->day_of_month);
            array_push($visits3, $view3->no_of_visits);
        }
        //dd($commentDataset);
    
        $dayscharts = app()->chartjs
        ->name('visitdays')
        ->type('line')
        ->size(['width' => 1000, 'height' => 300])
        ->labels($labels)
        ->datasets([
            [
               // labels: [$labels],
                "label" => "Visits (Walk In)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $visits,
                'spanGaps' => "false",
            ],
            [
               "label" => "Visits (Corporate)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $visits2,
                'spanGaps' => "false",
            ],
            [
                "label" => "Visits (Insurance)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(153, 102, 255, 0.31)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                "pointBorderColor" => "rgba(153, 102, 255, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $visits3,
                'spanGaps' => "false",
            ]

            
        ])
        ->options([]);



       $views = Bill::where('payercode','Private')->whereRaw("date >= last_day(now()) + interval 1 day - interval 1 month")->groupBy(DB::raw('DATE(bills.date)'))->orderby('date','asc')->limit(30)->get([DB::raw("sum(quantity*rate) as billamount"),DB::raw("DATE_FORMAT(date,'%d-%M') as day_of_month")]);
       $views2 = Bill::where('payercode','Corporate')->whereRaw("date >= last_day(now()) + interval 1 day - interval 1 month")->groupBy(DB::raw('DATE(bills.date)'))->orderby('date','asc')->limit(30)->get([DB::raw("sum(quantity*rate) as billamount"),DB::raw("DATE_FORMAT(date,'%d-%M') as day_of_month")]);
       $views3 = Bill::where('payercode','Health Insurance')->whereRaw("date >= last_day(now()) + interval 1 day - interval 1 month")->groupBy(DB::raw('DATE(bills.date)'))->orderby('date','asc')->limit(30)->get([DB::raw("sum(quantity*rate) as billamount"),DB::raw("DATE_FORMAT(date,'%d-%M') as day_of_month")]);
       
        
        $labels = array();
        $billamount = array();

        $labels2 = array();
        $billamount2 = array();

        $labels3 = array();
        $billamount3 = array();

        foreach ($views as $view) {

            array_push($labels, $view->day_of_month);
            array_push($billamount, $view->billamount);
          
        }

         foreach ($views2 as $view2) {

            array_push($labels2, $view2->day_of_month);
            array_push($billamount2, $view2->billamount);
          
        }

         foreach ($views3 as $view3) {

            array_push($labels3, $view3->day_of_month);
            array_push($billamount3, $view3->billamount);
          
        }
        
        //dd(,$labels);
    
        $billscharts = app()->chartjs
        ->name('billamount')
        ->type('line')
        ->size(['width' => 900, 'height' => 300])
        ->labels($labels)
        ->datasets([
            
            [
               // labels: [$labels],
                "label" => "Bills by Days (Walk In)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $billamount,
                'spanGaps' => "false",
            ],
            [
               "label" => "Bills by Days (Corporate)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $billamount2,
                'spanGaps' => "false",
            ],
            [
                "label" => "Bills by Days (Insurance)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(153, 102, 255, 0.31)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                "pointBorderColor" => "rgba(153, 102, 255, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $billamount3,
                'spanGaps' => "false",
            ]
            
        ])
        ->options([]);
















        // Services sources chart
             $views21 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%d-%M') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','Dental')
           ->whereRaw("date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('date','asc')
             ->limit(60)
             ->get();

           

            $views23 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%d-%M') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','Pharmacy')
              ->whereRaw("date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

            $views24 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%d-%M') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','OPD')
             ->whereRaw("date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

               $views25 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%d-%M') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','IPD')
              ->whereRaw("date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

               $views26 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%d-%M') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','Eye')
            ->whereRaw("date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

                $views27 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%d-%M') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','Laboratory')
             ->whereRaw("date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

              


        $categoryname1 = array();
        $categoryamount1 = array();


        $categoryname3 = array();
        $categoryamount3 = array();

        $categoryname4 = array();
        $categoryamount4 = array();

        $categoryname5 = array();
        $categoryamount5 = array();

        $categoryname6 = array();
        $categoryamount6 = array();

        $categoryname7 = array();
        $categoryamount7 = array();

       

        foreach ($views21 as $view21) {
            array_push($categoryname1, $view21->day_of_month);
            array_push($categoryamount1, $view21->billamount);
        }

      

        foreach ($views23 as $view23) {
            array_push($categoryname3, $view23->day_of_month);
            array_push($categoryamount3, $view23->billamount);
        }


        foreach ($views24 as $view24) {
            array_push($categoryname4, $view24->day_of_month);
            array_push($categoryamount4, $view24->billamount);
        }


        foreach ($views25 as $view25) {
            array_push($categoryname5, $view25->day_of_month);
            array_push($categoryamount5, $view25->billamount);
        }


        foreach ($views26 as $view26) {
            array_push($categoryname6, $view26->day_of_month);
            array_push($categoryamount6, $view26->billamount);
        }


        foreach ($views27 as $view27) {
            array_push($categoryname7, $view27->day_of_month);
            array_push($categoryamount7, $view27->billamount);
        }

      
  
       
        
        //dd(,$labels);
    
        $categorycharts = app()->chartjs
        ->name('categoryname3')
        ->type('line')
        ->size(['width' => 900, 'height' => 300])
        ->labels($categoryamount3)
        ->datasets([
            
            [
               // labels: [$labels],
                "label" => "Dental",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $categoryamount1,
                'spanGaps' => "false",
            ],
           
            [
                "label" => "Pharmacy",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(241, 196, 15, 0.31)",
                'borderColor' => "rgba(241, 196, 15, 0.7)",
                "pointBorderColor" => "rgba(241, 196, 15, 0.7)",
                "pointBackgroundColor" => "rgba(241, 196, 15, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(241, 196, 15,1)",
                'data' => $categoryamount3,
                'spanGaps' => "false",
            ],
            [
                "label" => "OPD",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(231, 76, 60, 0.31)",
                'borderColor' => "rgba(231, 76, 60, 0.7)",
                "pointBorderColor" => "rgba(231, 76, 60, 0.7)",
                "pointBackgroundColor" => "rgba(231, 76, 60, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(231, 76, 60,1)",
                'data' => $categoryamount4,
                'spanGaps' => "false",
            ],
            [
                "label" => "IPD",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(240, 178, 122, 0.31)",
                'borderColor' => "rgba(240, 178, 122, 0.7)",
                "pointBorderColor" => "rgba(240, 178, 122, 0.7)",
                "pointBackgroundColor" => "rgba(240, 178, 122, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(240, 178, 122,1)",
                'data' => $categoryamount5,
                'spanGaps' => "false",
            ],
            [
                "label" => "Eye",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(174, 214, 241, 0.31)",
                'borderColor' => "rgba(174, 214, 241, 0.7)",
                "pointBorderColor" => "rgba(174, 214, 241, 0.7)",
                "pointBackgroundColor" => "rgba(174, 214, 241, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(174, 214, 241,1)",
                'data' => $categoryamount6,
                'spanGaps' => "false",
            ],
            [
                "label" => "Laboratory",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(125, 60, 152, 0.31)",
                'borderColor' => "rgba(125, 60, 152, 0.7)",
                "pointBorderColor" => "rgba(125, 60, 152, 0.7)",
                "pointBackgroundColor" => "rgba(125, 60, 152, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(125, 60, 152,1)",
                'data' => $categoryamount7,
                'spanGaps' => "false",
            ]
            
            
        ])
        ->options([]);







          $medicalviews = DB::table('prescriptions')
             ->select(DB::raw('drug_name as drug'), DB::raw('count(drug_name) as drugs_no'))
             ->where('status','Dispensed')
               ->whereRaw("date_dispensed >= last_day(now()) + interval 1 day - interval 3 month")
             ->groupBy('drug')
             ->orderBy('drugs_no', 'DESC')
             ->limit(10)
             ->get();
        
        $medicallabels = array();
        $medicalviewDataset = array();
        $medicalcommentDataset = array();

        foreach ($medicalviews as $medicalview) {

            array_push($medicallabels, $medicalview->drug);
            
            array_push($medicalcommentDataset, $medicalview->drugs_no);
        }
        //dd($commentDataset);
    
        $medicalchartjs = app()->chartjs
        ->name('drugstop10')
        ->type('horizontalBar')
        ->size(['width' => 600, 'height' => 300])
        ->labels($medicallabels)
        ->datasets([
            [
               
                "label" => "Top 10 Drugs Dispensed",
                "labelLength" => 5,
                 'suggestedMin' => 0,
                'beginAtZero' => "true",
                'responsive' => true,
                'backgroundColor' => "rgba(206, 147, 216, 0.7)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $medicalcommentDataset,
            ]
            
        ])
        ->options([]);
      


          $diagnosisviews = DB::table('patient_diagnosis')
             ->select(DB::raw('diagnosis as diagnosis'), DB::raw('count(*) as diagnosis_no'))
              ->whereRaw("date >= last_day(now()) + interval 1 day - interval 3 month")
             ->groupBy('diagnosis')
             ->orderBy('diagnosis_no', 'DESC')
             ->limit(10)
             ->get();
        
        $diagnosislabels = array();
        $diagnosiscommentDataset = array();

        foreach ($diagnosisviews as $diagnosisview) {

            array_push($diagnosislabels, $diagnosisview->diagnosis);
            
            array_push($diagnosiscommentDataset, $diagnosisview->diagnosis_no);
        }
        //dd($commentDataset);
    
        $diagnosischartjs = app()->chartjs
        ->name('diagnosistop20')
        ->type('horizontalBar')
        ->size(['width' => 700, 'height' => 300])
        ->labels($diagnosislabels)
        ->datasets([
            [
               
                "label" => "Top 10 Diagnosis",
                'suggestedMin' => 0,
                'beginAtZero' => "true",
                'responsive' => true,
                'backgroundColor' => "rgba(255, 171, 145, 0.7)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $diagnosiscommentDataset,
            ]
            
        ])
        ->options([]);





        // Services sources chart
             $views217 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%M-%Y') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','Dental')
             ->groupBy('day_of_month')
             ->orderby('date','asc')
             ->limit(60)
             ->get();

           

            $views237 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%M-%Y') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','Pharmacy')
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

            $views247 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%M-%Y') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','OPD')
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

               $views257 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%M-%Y') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','IPD')
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

               $views267 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%M-%Y') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','Eye')
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

                $views277 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%M-%Y') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('category','Laboratory')
             ->groupBy('day_of_month')
             ->orderby('date','asc')
              ->limit(60)
             ->get();

             //dd($views277);

              


        $categoryname17 = array();
        $categoryamount17 = array();


        $categoryname37 = array();
        $categoryamount37 = array();

        $categoryname47 = array();
        $categoryamount47 = array();

        $categoryname57 = array();
        $categoryamount57 = array();

        $categoryname67 = array();
        $categoryamount67 = array();

        $categoryname77 = array();
        $categoryamount77 = array();

       

        foreach ($views217 as $view217) {
            array_push($categoryname17, $view217->day_of_month);
            array_push($categoryamount17, $view217->billamount);
        }

      

        foreach ($views237 as $view237) {
            array_push($categoryname37, $view237->day_of_month);
            array_push($categoryamount37, $view237->billamount);
        }


        foreach ($views247 as $view247) {
            array_push($categoryname47, $view247->day_of_month);
            array_push($categoryamount47, $view247->billamount);
        }


        foreach ($views257 as $view257) {
            array_push($categoryname57, $view257->day_of_month);
            array_push($categoryamount57, $view257->billamount);
        }


        foreach ($views267 as $view267) {
            array_push($categoryname67, $view267->day_of_month);
            array_push($categoryamount67, $view267->billamount);
        }


        foreach ($views277 as $view277) {
            array_push($categoryname77, $view277->day_of_month);
            array_push($categoryamount77, $view277->billamount);
        }

      


        
       
        
        //dd(,$labels);
    
        $categorychartsutilization = app()->chartjs
        ->name('categoryname17')
        ->type('line')
        ->size(['width' => 1000, 'height' => 600])
        ->labels($categoryname17)
        ->datasets([
            
            [
               // labels: [$labels],
                "label" => "Dental",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $categoryamount17,
                'spanGaps' => "false",
            ],
           
            [
                "label" => "Pharmacy",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(241, 196, 15, 0.31)",
                'borderColor' => "rgba(241, 196, 15, 0.7)",
                "pointBorderColor" => "rgba(241, 196, 15, 0.7)",
                "pointBackgroundColor" => "rgba(241, 196, 15, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(241, 196, 15,1)",
                'data' => $categoryamount37,
                'spanGaps' => "false",
            ],
            [
                "label" => "OPD",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(231, 76, 60, 0.31)",
                'borderColor' => "rgba(231, 76, 60, 0.7)",
                "pointBorderColor" => "rgba(231, 76, 60, 0.7)",
                "pointBackgroundColor" => "rgba(231, 76, 60, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(231, 76, 60,1)",
                'data' => $categoryamount47,
                'spanGaps' => "false",
            ],
            [
                "label" => "IPD",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(240, 178, 122, 0.31)",
                'borderColor' => "rgba(240, 178, 122, 0.7)",
                "pointBorderColor" => "rgba(240, 178, 122, 0.7)",
                "pointBackgroundColor" => "rgba(240, 178, 122, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(240, 178, 122,1)",
                'data' => $categoryamount57,
                'spanGaps' => "false",
            ],
            [
                "label" => "Eye",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(174, 214, 241, 0.31)",
                'borderColor' => "rgba(174, 214, 241, 0.7)",
                "pointBorderColor" => "rgba(174, 214, 241, 0.7)",
                "pointBackgroundColor" => "rgba(174, 214, 241, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(174, 214, 241,1)",
                'data' => $categoryamount67,
                'spanGaps' => "false",
            ],
            [
                "label" => "Laboratory",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(125, 60, 152, 0.31)",
                'borderColor' => "rgba(125, 60, 152, 0.7)",
                "pointBorderColor" => "rgba(125, 60, 152, 0.7)",
                "pointBackgroundColor" => "rgba(125, 60, 152, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(125, 60, 152,1)",
                'data' => $categoryamount77,
                'spanGaps' => "false",
            ]
            
            
        ])
        ->options([]);





        //Monthly sources 

       $payersource1 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%M-%Y') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('payercode','Private')
             ->groupBy('day_of_month')
             ->orderby('date','asc')
             ->limit(60)
             ->get();
       $payersource2 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%M-%Y') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('payercode','Corporate')
             ->groupBy('day_of_month')
             ->orderby('date','asc')
             ->limit(60)
             ->get();
       $payersource3 = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(date,'%M-%Y') as day_of_month"), DB::raw("sum(quantity*rate) as billamount"))
            ->where('payercode','Health Insurance')
             ->groupBy('day_of_month')
             ->orderby('date','asc')
             ->limit(60)
             ->get();
       
        
        $sourcelabels1 = array();
        $sourceamount1 = array();

        $sourcelabels2 = array();
        $sourceamount2 = array();

        $sourcelabels3 = array();
        $sourceamount3 = array();

        foreach ($payersource1 as $payersource1) {

            array_push($sourcelabels1, $payersource1->day_of_month);
            array_push($sourceamount1, $payersource1->billamount);
          
        }

         foreach ($payersource2 as $payersource2) {

            array_push($sourcelabels2, $payersource2->day_of_month);
            array_push($sourceamount2, $payersource2->billamount);
          
        }
        foreach ($payersource3 as $payersource3) {

            array_push($sourcelabels3, $payersource3->day_of_month);
            array_push($sourceamount3, $payersource3->billamount);
          
        }
        
        //dd(,$labels);
    
        $businesssourcecharts = app()->chartjs
        ->name('sourceamount1')
        ->type('line')
        ->size(['width' => 900, 'height' => 300])
        ->labels($sourcelabels1)
        ->datasets([
            
            [
               // labels: [$labels],
                "label" => "Bills by Days (Walk In)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $sourceamount1,
                'spanGaps' => "false",
            ],
            [
               "label" => "Bills by Days (Corporate)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $sourceamount2,
                'spanGaps' => "false",
            ],
            [
                "label" => "Bills by Days (Insurance)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(153, 102, 255, 0.31)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                "pointBorderColor" => "rgba(153, 102, 255, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $sourceamount3,
                'spanGaps' => "false",
            ]
            
        ])
        ->options([]);





        //Payments collected graph


        $paymentsource1 = DB::table('collection_summary_master')
             ->select(DB::raw("DATE_FORMAT(Payday,'%M-%Y') as day_of_month"), DB::raw("sum(AmountReceived) as billamount"))
            ->where('payercode','Private')
             ->groupBy('day_of_month')
             ->orderby('Payday','asc')
             ->limit(60)
             ->get();
       $paymentsource2 = DB::table('collection_summary_master')
             ->select(DB::raw("DATE_FORMAT(Payday,'%M-%Y') as day_of_month"), DB::raw("sum(AmountReceived) as billamount"))
            ->where('payercode','Corporate')
             ->groupBy('day_of_month')
             ->orderby('Payday','asc')
             ->limit(60)
             ->get();
       $paymentsource3 = DB::table('collection_summary_master')
             ->select(DB::raw("DATE_FORMAT(Payday,'%M-%Y') as day_of_month"), DB::raw("sum(AmountReceived) as billamount"))
            ->where('payercode','Health Insurance')
             ->groupBy('day_of_month')
             ->orderby('Payday','asc')
             ->limit(60)
             ->get();
       
        
        $paymentlabels1 = array();
        $paymentamount1 = array();

        $paymentlabels2 = array();
        $paymentamount2 = array();

        $paymentlabels3 = array();
        $paymentamount3 = array();

        foreach ($paymentsource1 as $paymentsource1) {

            array_push($paymentlabels1, $paymentsource1->day_of_month);
            array_push($paymentamount1, $paymentsource1->billamount);
          
        }

         foreach ($paymentsource2 as $paymentsource2) {

            array_push($paymentlabels2, $paymentsource2->day_of_month);
            array_push($paymentamount2, $paymentsource2->billamount);
          
        }

         foreach ($paymentsource3 as $paymentsource3) {

            array_push($paymentlabels3, $paymentsource3->day_of_month);
            array_push($paymentamount3, $paymentsource3->billamount);
          
        }
        
        //dd(,$labels);
    
        $paymentsourcecharts = app()->chartjs
        ->name('paymentamount1')
        ->type('line')
        ->size(['width' => 900, 'height' => 300])
        ->labels($paymentlabels1)
        ->datasets([
            
            [
               // labels: [$labels],
                "label" => "Bills by Days (Walk In)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $paymentamount1,
                'spanGaps' => "false",
            ],
            [
               "label" => "Bills by Days (Corporate)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $paymentamount2,
                'spanGaps' => "false",
            ],
            [
                "label" => "Bills by Days (Insurance)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(153, 102, 255, 0.31)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                "pointBorderColor" => "rgba(153, 102, 255, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $paymentamount3,
                'spanGaps' => "false",
            ]
            
        ])
        ->options([]);

        
       










        $visitrate = 0;
        $customercount=Customer::count();

        //$getactivities  = DB::table('activity_log')->limit(5)->orderBy('created_at','desc')->get();
        $today          = Carbon::today()->format('Y-m-d'); //Carbon::now()->format('Y-m-d').'%';
        $events         = Event::orderBy('start_time','DESC')->where('start_time', 'like', $today)->get();
        
        //dd($today." 23:59:59");

        $patients       = Customer::orderBy('created_at','DESC')->take(5)->get();
        $patientnumber  = Customer::count();
        $visits         = OPD::where('created_on','>', $today)->count();
        $myvisits       = OPD::where('created_on', '>', $today)->get();

        $visitrate      = (int)($visits/ $patientnumber) * 100;

        $mybills          = Bill::whereBetween('date',array($today." 00:00:00",$today." 23:59:59"))->get();
        $mypharmacybills  = Bill::where('category','Pharmacy')->whereBetween('date',array($today." 00:00:00",$today." 23:59:59"))->get();
        $mylabbills       = Bill::where('category','Laboratory')->whereBetween('date',array($today." 00:00:00",$today." 23:59:59"))->get();
        $myopdbills       = Bill::where('category','OPD')->whereBetween('date',array($today." 00:00:00",$today." 23:59:59"))->get();
        $myimagingbills   = Bill::where('category','Radiotherapy')->whereBetween('date',array($today." 00:00:00",$today." 23:59:59"))->get();


         $mycollections   = Payments::whereBetween('CreateDate',array($today." 00:00:00",$today." 23:59:59"))->get();



       //dd($today);
        $bills=0;
        $pharmacybills=0;
        $labbills=0;
        $opdbills=0;
        $imagingbills=0;

        $payments=0;



         foreach($mycollections as $collections)
       {
            $payments += $collections->AmountReceived;
       }

        foreach($mybills as $bill)
       {
            $bills += ($bill->rate * $bill->quantity);
       }

       foreach($mypharmacybills as $pharmacy)
       {
            $pharmacybills += ($pharmacy->rate * $pharmacy->quantity);
       }

       foreach($mylabbills as $lab)
       {
            $labbills += ($lab->rate * $lab->quantity);
       }

       foreach($myopdbills as $opd)
       {
            $opdbills  += ($opd->rate * $opd->quantity);
       }

        foreach($myimagingbills as $imaging)
       {
            $imagingbills  += ($imaging->rate * $imaging->quantity);
       }

        $assignees =    User::get();
        $drugs      =  Consumables::where('is_Active','Active')->orderBy('name', 'ASC')->get();


        $birthdays = Customer::where('accounttype','Private')->whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(date_of_birth) AND DAYOFYEAR(curdate()) >=  dayofyear(date_of_birth)')->get();

        return View('pages.dashboard', compact('assignees','birthdays','payments','paymentsourcecharts','businesssourcecharts','drugs','categorychartsutilization','categorycharts','billscharts','myvisits','company','bills','opdbills','chartjs','dayscharts','diagnosischartjs','medicalchartjs','imagingbills','customercount','events','patients','visits','visitrate','pharmacybills','labbills'));
    }


    public function getTotals()
    {


        

    }

      public function accounttype()
    {
        $corporate       = Customer::where('accounttype', 'Corporate')->where('status','Active')->count();
        $private         = Customer::where('accounttype', 'Private')->where('status','Active')->count();
        $insurance       = Customer::where('accounttype', 'Health Insurance')->where('status','Active')->count();
        $expatraite      = Customer::where('accounttype', 'Gratis')->where('status','Active')->count();
        $gratis          = Customer::where('accounttype', 'Gratis')->where('status','Active')->count();
        $total           = Customer::where('status','Active')->count();
       
         //dd($pharmacy);
         $corporate = $corporate/$total * 100;
         $private = $private/$total * 100;
         $insurance = $insurance/$total * 100;
         $expatraite = $expatraite/$total * 100;
         $gratis = $gratis/$total * 100;



       $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('doughnut')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Male', 'Female'])
        ->datasets([
            [
                'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
                'hoverBackgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 70, 235)', 'rgb(167, 162, 235)', 'rgb(54, 162, 48)', 'rgb(54, 12, 123)'],
                'data' => [ $corporate , $private , $insurance , $expatraite, $gratis ]
                
            ]
        ])
        ->options([]);

        return view('charts.account', compact('chartjs'));
    }
    




}