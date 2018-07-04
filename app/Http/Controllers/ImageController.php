<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Images;
use OrionMedical\Models\LabDocs;
use OrionMedical\Models\PatientInvestigation;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Response;
use Carbon\carbon;
use Auth;
use OneSignal;


class ImageController extends Controller
{

    public function getSavedDocuments()
    {

        $documents = LabDocs::paginate(15);
        return view('document.index',compact('documents')); 

    }


    public function uploadHosiptalDocs(Request $request)
    {


         try
        {
        
        $image = new LabDocs();
        $this->validate($request, [
            'image' => 'required',
            'filename' => 'required'
        ]);

        //dd(Input::file('image'));
        $image->filename = Input::get('filename');

        if($request->hasFile('image')) {
            $file = Input::file('image');

            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
           
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $image->filePath = $name;
            $image->mime = $file->getClientOriginalExtension();
            $image->created_by=Auth::user()->getNameOrUsername();
            $file = $file->move(public_path().'/uploads/images', $name);


            //Image::make($image->getRealPath())->resize(200, 200)->save($name); 
        }

        $image->save();

       return redirect()
            ->back()
            ->with('info','Document has successfully been uploaded!');
        }

    catch (\Exception $e) {
           
           echo $e->getMessage();
            // return redirect()
            // ->route('account.manage')
            // ->with('info','No document was added!',$e->getMessage());
        }
    

    }

    public function uploadMultiple(Request $request)
    {

         //$product = Product::create($request->all());
        foreach ($request->images as $photo) 
        {
            //$filename = $photo->store('/uploads/images');
            $file = $photo;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $fileextention = strtolower($file->getClientOriginalExtension());
            $file = $file->move(public_path().'/uploads/images', $name);

            Images::create([
                'accountnumber' => Input::get('selectedid'),
                'filename' => Input::get('filename'),
                'filepath' => $name,
                'mime' =>$fileextention,
                'created_by' => Auth::user()->getNameOrUsername(),
                'source' => 'Radiology'
            ]);
        }
         return redirect()
            ->back()
            ->with('info','Document has successfully been uploaded!');
        
    }



    public function postUpload(Request $request)
    {

         try
        {
        
        $image = new Images();
        $this->validate($request, [
            'image' => 'required',
            'filename' => 'required'
        ]);

        //dd(Input::file('image'));
    
        $image->accountnumber=Input::get('selectedid');
         $image->visit_number=Input::get('visitid');
        $image->filename = Input::get('filename');
         $image->source = Input::get('file_source');

        if($request->hasFile('image')) {
            $file = Input::file('image');

            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
           
            $name = $timestamp. '-' .$file->getClientOriginalName();
           
            $image->filePath = $name;
            $image->mime = $file->getClientOriginalExtension();
            $image->created_by=Auth::user()->getNameOrUsername();
            $file = $file->move(public_path().'/uploads/images', $name);


            //Image::make($image->getRealPath())->resize(200, 200)->save($name); 
        }

        $image->save();

        if(Input::get('file_source')=='Laboratory')
        {

            $getlabfullanme = PatientInvestigation::where('id',Input::get('labid'))->first();
            $updatelab = PatientInvestigation::where('patientid',Input::get('selectedid'))->update(array('status' => 'Ready'));

            OneSignal::sendNotificationToAll($getlabfullanme->patient_name." labs are ready to be viewed by ".$getlabfullanme->created_by, $url = null, $data = null, $buttons = null, $schedule = null);

          }

       return redirect()
            ->back()
            ->with('info','Document has successfully been uploaded!');
        }

    catch (\Exception $e) {
           
           echo $e->getMessage();
            // return redirect()
            // ->route('account.manage')
            // ->with('info','No document was added!',$e->getMessage());
        }
    }

   
}
