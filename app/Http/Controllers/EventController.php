<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Event;
use OrionMedical\Models\Customer;
use OrionMedical\Models\Doctor;
use OrionMedical\Models\Gender;
use OrionMedical\Models\ServiceCharge;
use OrionMedical\Models\VisitType;
use OrionMedical\Models\AccountType;
use OrionMedical\Models\AppointmentStatus;
use OrionMedical\Models\Branch;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use DateTime;
use Input;
use Response;
use DB;
use Carbon\Carbon;
use Auth;

class EventController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function print($id)
    {
      $patient       = Event::where('id',$id)->first();
      return view ('event.slip',compact('patient'));
    }
    
    public function index()
    {
       $patients = Customer::get();
       $doctors = Doctor::get();
       $statuses = AppointmentStatus::get();
       $servicetype = ServiceCharge::where('department','OPD')->orwhere('department','Specialist')->orderby('type','asc')->get(); 
       $visittypes  = VisitType::get();
       $billingaccounts = AccountType::get();
       $branches = Branch::get();


        $today = Carbon::now()->format('Y-m-d').'%';
        $yesterday = Carbon::yesterday();
        $tomorrow = Carbon::tomorrow();
         $events  = Event::where('doctor','not like','%Nurse%')->where('start_time','>',$today)->orderBy('start_time','asc')->paginate(30);
        return view('event/list', compact('events','branches','billingaccounts','servicetype','doctors','visittypes','patients','statuses'));
    }

     public function calendar()
    {

       $patients = Customer::get();
       $doctors = Doctor::get();
       $servicetype = ServiceCharge::where('department','OPD')->orwhere('department','Specialist')->orderby('type','asc')->get(); 
       $doctorevents  = Event::orderBy('start_time')->get();
       $visittypes      = VisitType::get();
       $branches = Branch::get();
       //dd($doctorevents->doctor);

       return view('event/calendar', compact('doctorevents','branches','doctors','servicetype','patients','visittypes'))
           ->with('doctors',$doctors)
            ->with('servicetype',$servicetype);
    }

    public function Nursecalendar()
    {

       $patients = Customer::get();
       $doctors = Doctor::where('speciality','Nurse')->get();
        $servicetype = ServiceCharge::where('department','OPD')->orwhere('department','Specialist')->orderby('type','asc')->get(); 
       $doctorevents  = Event::orderBy('start_time')->get();
       $visittypes      = VisitType::get();
       $branches = Branch::get();
       //dd($doctorevents->doctor);

       return view('event/nurse', compact('doctorevents','branches','doctors','servicetype','patients','visittypes'))
           ->with('doctors',$doctors)
            ->with('servicetype',$servicetype);
    }

    public function myappointment()
    {
         $patients = Customer::get();
       $doctors     = Doctor::get();
        $servicetype = ServiceCharge::where('department','OPD')->orwhere('department','Specialist')->orderby('type','asc')->get(); 
       $genders  = Gender::get();
       $branches = Branch::get();
       $visittypes      = VisitType::get();

        return view('event/appointment',compact('doctors','branches','servicetype','genders','patients','visittypes'));
    }

    public function doctorappointment($id)

    {
         $patients = Customer::get();
       $result = $id;
       $doctors     = Doctor::get();
       $servicetype = ServiceCharge::where('department','OPD')->orwhere('department','Specialist')->orderby('type','asc')->get();  
       $doctorevents  = Event::orderBy('start_time')->get();
       $visittypes      = VisitType::get();
       $branches = Branch::get();
       //dd($doctorevents->doctor);

       return view('event/doctor', compact('doctorevents','branches','doctors','servicetype','result','patients','visittypes'))
           ->with('doctors',$doctors)
            ->with('servicetype',$servicetype);
    }
   
    
    
    public function store(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'name'  => 'required',
            'title' => 'required',
            'time'  => 'required'
        ]);

        $appointee = Customer::where('id',$request->input('name'))->first();

        $event                  = new Event;
        $event->name            = $appointee->fullname;
        $event->mobile_number   = $appointee->mobile_number;
        $event->patient_id      = $appointee->id;
        $event->title           = $request->input('title');
        $event->start_time      = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('time'));
        $event->end_time        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('time'))->addMinutes(15);
        $event->doctor          = $request->input('referal_doctor');
        $event->created_on      = Carbon::now();
        $event->created_by      = Auth::user()->getNameOrUsername();

        if($event->save())
        {

            return redirect()
            ->back()
            ->with('info','The event was successfully saved!');

        }

        else
        {
             return redirect()
            ->back()
            ->with('info','The event failed to save!');

        }
        
         
    }

    public function storeNoCustomer(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'name'  => 'required',
            'title' => 'required',
            'time'  => 'required'
        ]);

        //$appointee = Customer::where('id',$request->input('name'))->first();

        $event                  = new Event;
        $event->name            = $request->input('name');;
        $event->mobile_number   = $request->input('phonenumber');;
        $event->patient_id      = uniqid();
        $event->title           = $request->input('title');
        $event->start_time      = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('time'));
        $event->end_time        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('time'))->addMinutes(15);
        $event->doctor          = $request->input('referal_doctor');
        $event->created_on      = Carbon::now();
        $event->created_by      = Auth::user()->getNameOrUsername();

        if($event->save())
        {

            return redirect()
            ->route('event-list')
            ->with('info','The event was successfully saved!');

        }

        else
        {
             return redirect()
            ->route('event-list')
            ->with('info','The event failed to save!');

        }
        
         
    }



    public function NurseNote(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'title' => 'required',
            'time'  => 'required'
        ]);

        $event                  = new Event;
        $event->name            = $request->input('referal_doctor');
        $event->mobile_number   = 0;
        $event->patient_id      = 0;
        $event->title           = $request->input('title');
        $event->start_time      = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('time'));
        $event->end_time        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('time'))->addMinutes(15);
        $event->doctor          = $request->input('referal_doctor');
        $event->created_on      = Carbon::now();
        $event->created_by      = Auth::user()->getNameOrUsername();

        if($event->save())
        {

            return redirect()
            ->back()
            ->with('info','The event was successfully saved!');

        }

        else
        {
             return redirect()
            ->back()
            ->with('info','The event failed to save!');

        }
        
         
    }

   
    public function show($id)
    {
        $event = Event::findOrFail($id);
        
        $first_date = new DateTime($event->start_time);
        $second_date = new DateTime($event->end_time);
        $difference = $first_date->diff($second_date);

        $data = [
            'page_title'    => $event->title,
            'event'         => $event,
            'duration'      => $this->format_interval($difference)
        ];
        
        return view('event/view', $data);
    }

   
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $event->start_time =  $this->change_date_format_fullcalendar($event->start_time);
        $event->end_time =  $this->change_date_format_fullcalendar($event->end_time);
        
        $data = [
            'page_title'    => 'Edit '.$event->title,
            'event'         => $event,
        ];
        
        return view('event/edit', $data);
    }

 
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required|min:5|max:15',
            'title' => 'required|min:5|max:100',
            'time'  => 'required|available|duration'
        ]);
        
        $time = explode(" - ", $request->input('time'));
        
        $event                  = Event::findOrFail($id);
        $event->name            = $request->input('name');
        $event->title           = $request->input('title');
        $event->start_time      = $this->change_date_format($time[0]);
        $event->end_time        = $this->change_date_format($time[1]);
        $event->doctor          = $request->input('referal_doctor');
        $event->save();
        
        return redirect('events');
    }


    public function deleteappointmentfromevent()
    {
            if(Input::get("ID"))
            {
                    $ID = Input::get("ID");
                    $affectedRows = Event::where('id', '=', $ID)->delete();

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
        $time = DateTime::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }
    
    public function change_date_format_fullcalendar($date)
    {
        $time = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $time->format('d/m/Y H:i:s');
    }
    
    public function format_interval(\DateInterval $interval)
    {
        $result = "";
        if ($interval->y) { $result .= $interval->format("%y year(s) "); }
        if ($interval->m) { $result .= $interval->format("%m month(s) "); }
        if ($interval->d) { $result .= $interval->format("%d day(s) "); }
        if ($interval->h) { $result .= $interval->format("%h hour(s) "); }
        if ($interval->i) { $result .= $interval->format("%i minute(s) "); }
        if ($interval->s) { $result .= $interval->format("%s second(s) "); }
        
        return $result;
    }


     public function appointmentcalendar()
    {

    $events = DB::table('appointments')->select('id', 'name', 'title', 'start_time as start', 'end_time as end','doctor','status')->where('doctor','not like','%Nurse%')->get();
    foreach($events as $event)
    {
        $service = $event->status;
        $event->title = $event->title . ' ('.$event->doctor.') ' .' - ' .$event->name;


        if($service == 'Pending Arrival')
        {
            $event->color = '#bebebe';
        }
        elseif ($service == 'Patient has arrived') 
        {
            $event->color = '#8ec165';
        }

        elseif ($service == 'Arrived Late') 
        {
            $event->color = '#4cc0c1';
        }

         elseif ($service == 'Appointment Confirmed') 
        {
            $event->color = '#2e3e4e';
        }

         elseif ($service == 'Rescheduled') 
        {
            $event->color = '#ffc333';
        }

        elseif ($service == 'No Show') 
        {
            $event->color = '#fb6b5b';
        }

        elseif ($service == 'Cancelled') 
        {
            $event->color = '#fb6b5b';
        }

        elseif ($service == 'Reminder Sent') 
        {
            $event->color = '#2e3e4e';
        }

     
        
        else
        {
            $event->color = '#bebebe';
        }

        $event->url = url('events/' . $event->id);
    }
    return $events;
    }


 public function appointmentNurse()
    {

    $events = DB::table('appointments')->select('id', 'name', 'title', 'start_time as start', 'end_time as end','doctor')->where('doctor','like','%Nurse%')->get();
    foreach($events as $event)
    {
        $service = $event->title;
        $event->title = $event->title . ' ('.$event->doctor.') ' .' - ' .$event->name;


        if($service == 'GP CONSULTATION')
        {
            $event->color = '#4cc0c1';
        }
        elseif ($service == 'OPHTHALMOLOGY CONSULTATION') 
        {
            $event->color = '#65bd77';
        }
        elseif ($service == 'DENTAL CONSULTATION') 
        {
            $event->color = '#fb6b5b';
        }
        elseif ($service == 'ENT CONSULTATION') 
        {
            $event->color = '#ffc333';
        }

        elseif ($service == 'SPECIALIST CONSULTATION') 
        {
            $event->color = '#2e3e4e';
        }
        
        else
        {
            $event->color = '#a8adb5';
        }

        $event->url = url('events/' . $event->id);
    }
    return $events;
    }


 public function doctor($id)
    {

    $events = DB::table('appointments')->select('id', 'name', 'title', 'start_time as start', 'end_time as end','doctor')->where('doctor',$id)->get();
    foreach($events as $event)
    {
        $service = $event->title;
        $event->title = $event->title . ' ('.$event->doctor.') ' .' - ' .$event->name;


        if($service == 'GP CONSULTATION')
        {
            $event->color = '#4cc0c1';
        }
        elseif ($service == 'OPHTHALMOLOGY CONSULTATION') 
        {
            $event->color = '#65bd77';
        }
        elseif ($service == 'DENTAL CONSULTATION') 
        {
            $event->color = '#fb6b5b';
        }
        elseif ($service == 'ENT CONSULTATION') 
        {
            $event->color = '#ffc333';
        }

        elseif ($service == 'SPECIALIST CONSULTATION') 
        {
            $event->color = '#2e3e4e';
        }
        
        else
        {
            $event->color = '#fc8174';
        }

        $event->url = url('events/' . $event->id);
    }
    return $events;
    }



    public function findAppointment(Request $request)
    {
        $patients = Customer::get();
       $doctors = Doctor::get();
       $statuses = AppointmentStatus::get();
        $servicetype = ServiceCharge::where('department','OPD')->orwhere('department','Specialist')->orderby('type','asc')->get(); 
       $visittypes      = VisitType::get();
       $billingaccounts = AccountType::get();
       $branches = Branch::get();



       $search = $request->get('search');
        $time   = explode(" - ", Input::get('review_period')); 
        

        //dd()

        if(!$search=="")
        {


           $events  = Event::where('name', 'like', "%$search%")->orWhere('title', 'like', "%$search%")->orWhere('doctor', 'like', "%$search%")->orWhere('status', 'like', "%$search%")->orderBy('start_time','DESC')->paginate(30)->appends(['search' => $search]);
       
   
 
        }

        else
        {


            //dd($time);

            //$date_from = Carbon::parse($request->input('date_from'))->startOfDay();
            //$date_to = Carbon::parse($request->input('date_to'))->endOfDay();

          
            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

           

            $events = Event::whereDate('start_time','>=',$from)->whereDate('start_time', '<=', $to)
            ->orderBy('start_time','desc')
            ->paginate(200)
            ->appends(['search' => $search]);

           // dd($from);
        }



       return view('event/list', compact('events','billingaccounts','servicetype','doctors','patients','statuses','visittypes'));


    }

    public function updateAppointment()
    {


         $appointmentid = Input::get("id");
         $appointmenstatus = Input::get("status");

            $affectedRows = Event::where('id', $appointmentid)->update(array('status' => $appointmenstatus));

             

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
