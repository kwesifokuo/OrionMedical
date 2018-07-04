<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;

use OrionMedical\Models\Requisition;
use Response;
use Input;
use Cache;
use Carbon\Carbon;
use Datetime;
use Auth;
use Excel;

class StoreController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
        $this->middleware('role:Pharmacist|System Admin|Doctor|Dentist|Specialist|Pharmacy Technician|Dental Nurse|Ophthalmologist');
       
    }



     public function index()
    {

        $requisitions =    Requisition::paginate(30);
        return view('stores.index',compact('requisitions'));
    }
}
