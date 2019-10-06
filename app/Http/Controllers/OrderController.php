<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Agency;
use App\Order;
use App\RadioStation;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        $agencies = Agency::all();
        $adverts = Advert::all();
        $orders = Order::all();
        $radio_stations = RadioStation::all();
        return view('orders.orders',compact('orders','agencies','adverts','radio_stations'));
    }

    public function filterAdverts(Request $request){
        if ($request->ajax()){
            $data = Advert::where('agency_id',$request->id)->get();
            echo json_encode($data);
        }
    }

    public function filterAgencies(Request $request){

        if ($request->ajax()){
            $data = Agency::where('radio_station_id',$request->id)->get();
            echo json_encode($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $radio_station = RadioStation::find($request->input('radio_station_id'));

        $countAdverts = Order::where('radio_station_id',$request->input('radio_station_id'))->get()->count();

        if ($countAdverts == 0){
            $order_number=  $radio_station->ad_prefix."-".substr(date('Ymd-'),'2').'001';
        }else {
            $record = Order::where('radio_station_id',$request->input('radio_station_id'))->latest()->first();
            $expNum = $record->order_number;
//            return $expNum;
            if ($expNum == '') {
                $order_number = $radio_station->ad_prefix."-". substr(date('Ymd'), '2') . '01';
            } else {
                $add_num = str_replace([$radio_station->ad_prefix,'-'],'',$expNum)+1;
                $advert_year= substr($add_num,0,2);
                $current_year = substr(date('Y'), 2);


                if ($advert_year == $current_year) {

                    $order_number = $radio_station->ad_prefix."-".substr(($add_num),0,2).date('m')."-".substr(($add_num),4);

                    // return $order_number;

                } else {
                    $order_number = $radio_station->ad_prefix."-".substr(date('Ymd-'),'2').'001';
//

                }
            }
        }
        return $order_number;
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
