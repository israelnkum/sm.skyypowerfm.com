<?php

namespace App\Http\Controllers;

use App\Agency;
use App\RadioStation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resources
     * @return Response
     */
    public function index()
    {
        $radio_stations = RadioStation::all();
        return view('agencies.agencies',compact('radio_stations'));
    }

    public function all_agencies(){
        $agencies = Agency::with('radio_station')->get();
        $radio_stations = RadioStation::all();
        return view('agencies.agencies',compact('agencies','radio_stations'));
    }


    public function delete_agencies(Request $request){

        $selected_id = explode(',',$request->input('selected_agencies'));;
        foreach ($selected_id as $value){
            $level = Agency::find($value);
            $level->delete();
        }

        toastr()->success(count($selected_id).' Agencies Deleted');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $agency = new Agency();
        $agency->agency_name = $request->input('agency_name');
        $agency->radio_station_id = $request->input('radio_station_id');
        $agency->address = $request->input('address');
        $agency->fax = $request->input('fax');
        $agency->email = $request->input('email');
        $agency->phone_number = $request->input('phone_number');
        $agency->discount = $request->input('discount');
        $agency->contact_person = $request->input('contact_person');

        $agency->save();

        toastr()->success('Agency Added');
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $agency = Agency::find($id);
        $agency->agency_name = $request->input('agency_name');
        $agency->radio_station_id = $request->input('radio_station_id');
        $agency->address = $request->input('address');
        $agency->fax = $request->input('fax');
        $agency->email = $request->input('email');
        $agency->phone_number = $request->input('phone_number');
        $agency->discount = $request->input('discount');
        $agency->contact_person = $request->input('contact_person');

        $agency->save();

        toastr()->success('Agency Info Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
