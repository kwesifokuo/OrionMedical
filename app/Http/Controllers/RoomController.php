<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Customer;
use OrionMedical\Models\Room;
use DB;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Input;
use Response;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $rooms =  Room::paginate(30);
       return view('room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $addroom = new Room;
           $addroom->ward_no  = $request->input('ward_number');
           $addroom->ward_type  = $request->input('ward_name');
           $addroom->total_beds = $request->input('total_beds');
            $addroom->occupied_beds = 0;
             $addroom->unoccupied_beds = $request->input('total_beds');
           $addroom->status = 'Active';
           $addroom->floor = $request->input('ward_location');
           $addroom->cost = $request->input('ward_rate');;
            
            if($addroom->save())
            {
            return redirect()
            ->route('available-rooms')
            ->with('info','Ward was added succefully !');

            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
         

    $wardid = Input::get('ID');

    $ward = Room::find($wardid);

    $data = Array(
        'ward_number'=>$ward->ward_no,
        'ward_name'=>$ward->ward_type,
        'total_beds'=>$ward->total_beds,
        'ward_location'=>$ward->floor,
        'ward_rate'=>$ward->cost,
    );

        return Response::json($data);

        
    } 
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
            $ward_number = Input::get("ward_number");
            $ward_name = Input::get("ward_name");
            $ward_rate = Input::get("ward_rate");
            $ward_location = Input::get("ward_location");
            $total_beds = Input::get("total_beds");
   

             $affectedRows = Room::where('ward_no', '=', $ward_number)
            ->update(array(
                           'ward_type' => $ward_name,
                           'floor' =>  $ward_location,
                           'total_beds' =>  $total_beds,
                           'cost' => $ward_rate));


            if($affectedRows > 0)
            {
             
              return redirect()
            ->route('available-rooms')
            ->with('info','Ward has successfully been updated!');
            }
            else
            {
               return redirect() 
            ->route('available-rooms')
            ->with('danger','Ward details failed to update!');
            }
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
