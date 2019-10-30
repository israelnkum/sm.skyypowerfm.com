<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Agency;
use App\Order;
use App\RadioStation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransmissionCertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $radio_stations = RadioStation::all();

        if(Auth::user()->role == "Admin"){
            $agency = Agency::all();
        }else{
            $agency = Agency::where('radio_station_id', Auth::user()->radio_station_id)->get();
        }

        return view('tc-invoice.tc',compact('radio_stations','agency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $selected_agency = Agency::with('radio_station')->find($request->input('agency_id'));
        $tcs = \App\TransmissionCertificate::with('order','advert')
            ->where('order_number',$request->input('order_number'))
            ->get()->groupBy('advert_id');
        if(Auth::user()->role == "Admin"){
            $agency = Agency::all();
        }else{
            $agency = Agency::where('radio_station_id', Auth::user()->radio_station_id)->get();
        }

        $radio_stations = RadioStation::all();
        $agency_id =$request->input('agency_id');

        $orders = Order::where('agency_id',$agency_id)->get()->unique('order_number');


        return view('tc-invoice.tc',
            compact('radio_stations','agency','tcs','selected_agency','orders','agency_id'));

    }

    /**
     * @param Request $request
     *
     * Filter orders based on selected agency
     * @return Factory|View
     */
    public function filterOrders(Request $request){
        $agency_id =$request->input('agency_id');
        $selected_agency = Agency::with('radio_station')->find($request->input('agency_id'));

        $orders = Order::where('agency_id',$agency_id)->get()->unique('order_number');

        if (count($orders)==0){
            toastr()->error('No Order Found');
            return back();
        }
        if(Auth::user()->role == "Admin"){
            $agency = Agency::all();
        }else{
            $agency = Agency::where('radio_station_id', Auth::user()->radio_station_id)->get();
        }

        return view('tc-invoice.tc', compact('orders','agency','agency_id'));

        /* if ($request->ajax()){
             $data = Order::where('agency_id',$request->agency_id)->get()->unique('order_number');

             echo json_encode($data);
         }*/
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
