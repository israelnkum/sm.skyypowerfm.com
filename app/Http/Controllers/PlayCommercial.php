<?php

namespace App\Http\Controllers;

use App\Commercial;
use App\Order;
use App\RadioStation;
use Illuminate\Http\Request;

class PlayCommercial extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $commercials = Commercial::with('program','advert')
            ->where('radio_station_id',$request->input('radio_station_id'))
            ->whereDate('date',date('Y-m-d'))
            ->orderBy('time')
            ->get()->groupBy('program_id');


        if (count($commercials) == 0){
            $commercials =0;
        }
        $radio_stations = RadioStation::all();
        return view('welcome',compact('commercials','radio_stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $radio_stations = RadioStation::all();
        return view('radio',compact('radio_stations'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            $order = Order::find($request->input('order_id'));
            $tc = new \App\TransmissionCertificate();
            $tc->order_id = $request->input('order_id');
            $tc->advert_id = $request->input('advert_id');
            $tc->agency_id = $request->input('agency_id');
            $tc->date_time = date('Y-m-d h:i A');
            $tc->order_number = $order->order_number;
            $tc->save();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
