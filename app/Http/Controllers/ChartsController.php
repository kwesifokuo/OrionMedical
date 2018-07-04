<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;

use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use OrionMedical\Models\Bill;
use DB;
use Charts;

use Carbon\Carbon;

class ChartsController extends Controller
{
   


    public function drugDispensed( ) 
    {
        
             $medicalviews = DB::table('prescriptions')
             ->select(DB::raw('drug_name as drug'), DB::raw('count(*) as drugs_no'))
             ->where('status','Dispensed')
             ->groupBy('drug')
             ->orderBy('drugs_no', 'ASC')
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
    
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('horizontalBar')
        ->size(['width' => 200, 'height' => 100])
        ->labels($medicallabels)
        ->datasets([
            [
                "label" => "Top 10 Drugs Dispensed",
                'beginAtZero' => "true",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
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
      
      
         return view('charts.pharmacy', compact('chartjs'));
    }

    public function customerType()
    {

        $chartjs = app()->chartjs
         ->database(Customer::all(),'bar','material')
         ->setResponsive(false)
          ->setWidth(10)
           ->options([]);

          return view('charts.pharmacy', compact('chartjs'));


    }

    

        public function VisitNoperDaytoMonth()
        {

            $views = DB::table('admissions')
             ->select(DB::raw("DATE_FORMAT(created_on,'%d-%M') as day_of_month"), DB::raw("count(*) as no_of_visits"))
             ->groupBy('day_of_month')
             ->get();
        
        $labels = array();
        $visits = array();

        foreach ($views as $view) {

            array_push($labels, $view->day_of_month);
            array_push($visits, $view->no_of_visits);
        }
        //dd($commentDataset);
    
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 200, 'height' => 100])
        ->labels($labels)
        ->datasets([
            [
                "label" => "Visit by Days",
                 //fill => false,
                'beginAtZero' => "true",
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
            ]
            
        ])
        ->options([]);
      
         return view('charts.visitsbyday', compact('chartjs'));
        }

        public function servicesMetrics()
        {

            $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
        ->datasets([
            [
                "label" => "My First dataset",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [65, 59, 80, 81, 56, 55, 40],
            ],
            [
                "label" => "My Second dataset",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [12, 33, 44, 44, 55, 23, 40],
            ]
        ])
        ->options([]);


         return view('charts.servicesbymonth', compact('chartjs'));
        }

        public function VisitsbyDoctor()
        {

            $views = DB::table('admissions')
             ->select(DB::raw("referal_doctor"), DB::raw("count(*) as no_of_visits"))
             ->groupBy('referal_doctor')
             ->get();
        
        $labels = array();
        $visits = array();

        foreach ($views as $view) {

            array_push($labels, $view->referal_doctor);
            array_push($visits, $view->no_of_visits);
        }
        //dd($commentDataset);
    
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('bar')
        ->size(['width' => 200, 'height' => 100])
        ->labels($labels)
        ->datasets([
            [
                "label" => "Visit by Doctor",
                 //fill => false,
                 'beginAtZero' => "true",
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
            ]
            
        ])
        ->options([]);
      
         return view('charts.visitsbydoctor', compact('chartjs'));
        }



        public function VisitsbyConsultation()
        {

             $views = DB::table('admissions')
             ->select(DB::raw("consultation_type"), DB::raw("count(*) as no_of_visits"))
             ->groupBy('consultation_type')
             ->get();
        
        $labels = array();
        $visits = array();

        foreach ($views as $view) {

            array_push($labels, $view->consultation_type);
            array_push($visits, $view->no_of_visits);
        }
        //dd($commentDataset);
    
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('bar')
        ->size(['width' => 200, 'height' => 100])
        ->labels($labels)
        ->datasets([
            [
                "label" => "Visit by Type per Day",
                 //fill => false,
                'beginAtZero' => "true",
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
            ]
            
        ])
        ->options([]);
      
         return view('charts.visitsbytype', compact('chartjs'));
        }




    public function index()
    {
        $bills              = Bill::where('date','>', Carbon::yesterday())->where('is_billable','True')->get();
        $pharmacybills      = Bill::where('category','Pharmacy')->where('is_billable','True')->where('date','>', Carbon::yesterday())->get();
        $labbills           = Bill::where('category','Laboratory')->where('is_billable','True')->where('date','>', Carbon::yesterday())->get();
        $opdbills           = Bill::where('category','OPD')->where('is_billable','True')->where('date','>', Carbon::yesterday())->get();
        $imagingbills       = Bill::where('category','Radiotherapy')->where('is_billable','True')->where('date','>', Carbon::yesterday())->get();

        $pharmacy =  ($pharmacybills->sum('amount')/$bills->sum('amount')) * 100 ;
        $lab =  ($labbills->sum('amount')/$bills->sum('amount')) * 100 ;
        $opd =  ($opdbills->sum('amount')/$bills->sum('amount')) * 100 ;
        $images =  ($imagingbills->sum('amount')/$bills->sum('amount')) * 100 ;

         //dd($pharmacy);


       $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('doughnut')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Pharmacy', 'Labs' , 'OPD' , 'Imaging','Consultation'])
        ->datasets([
            [
                'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)','rgb(255, 205, 86)','rgb(201, 203, 207)','rgb(75, 192, 192)'],
                'hoverBackgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)','rgb(255, 205, 86)','rgb(201, 203, 207)','rgb(75, 192, 192)'],
                //'data' => [69, 59, 20]
                'data' => [ $pharmacy , $lab , $opd , $images , 0]
                
               
                
            ]
        ])
        ->options([]);

        return view('charts.index', compact('chartjs','linejs','barjs'));
    }



    public function vitals()
    {

        //Vital Chart Graph
        $views = DB::table('patient_vitals')
             ->select(DB::raw("DATE_FORMAT(created_on,'%H:%i, %d-%M-%Y') as period"),DB::raw("visit_id,weight,height,temperature"))
             ->where('visit_id','V00161')
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
        ->size(['width' => 900, 'height' => 300])
        ->labels($labels)
        ->datasets([
            [
                "label" => "Temperature",
                 //fill => false,
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


          return view('charts.vitals', compact('vitalcharts'));

    }


    
}
