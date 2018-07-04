<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\OPD;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;

class DietianController extends Controller
{

	public function __construct()
    {

        $this->middleware('auth');
    }
    
    public function index()
    {
        $patients = OPD::where('department','=','Nutrition and dietetics')->paginate(30);

        return view('dietian.index',compact('patients'));
    }


    public function computeHarrisBenedictMale()
    {
    	//Varibales
    	$weight = 83.5;
    	$height = 174;
    	$age = 34;
    	$activity_factor = 1.2;
    	$BMI = $weight/($height/100 * $height/100);

    	//Constants
    	$C1 = 66.5;
    	$C2 = 13.75; 
    	$C3 = 5.003;
    	$C4 = 6.775;

    	$P1 = $weight * $C2;
    	$P2 = $height * $C3;
    	$P3 = $age * $C4;

    	$BMR = $C1 + $P1 + $P2 - $P3;

    	$calories = $BMR * $activity_factor;

    	$IBW_range_upper = ($weight * 18)/$BMI;
    	$IBW_range_lower = ($weight * 25)/$BMI;

    	return [$calories,$IBW_range_upper,$IBW_range_lower,$BMI];
    }


    public function computeHarrisBenedictFemale()
    {
    	//Varibales
    	$weight = 83.5;
    	$height = 174;
    	$age = 34;
    	$activity_factor = 1.2;
    	$BMI = $weight/($height/100 * $height/100);

    	//Constants
    	$C1 = 665;
    	$C2 = 9.563; 
    	$C3 = 1.85;
    	$C4 = 4.676;

    	$P1 = $weight * $C2;
    	$P2 = $height * $C3;
    	$P3 = $age * $C4;

    	$BMR = $C1 + $P1 + $P2 - $P3;

    	$calories = $BMR * $activity_factor;

    	$IBW_range_upper = ($weight * 18)/$BMI;
    	$IBW_range_lower = ($weight * 25)/$BMI;

    	return [$calories,$IBW_range_upper,$IBW_range_lower,$BMI];
    }

    public function computeBMI()
    {

    	$weight = null;
    	$height = null;

    	$bmi = $weight/($height * $height);

    	$target_weight = ($weight * 25)/ $bmi;

    	return [$bmi,$target_weight];
    }

    public function computeWHR()
    {
    	$waist = null;
    	$hip = null;
    	$whr = $waist/$hip;

    	return $whr;

    }


    
}
