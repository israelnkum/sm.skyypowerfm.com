<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Agency;
use App\Order;
use App\RadioStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $orders = Order::with('radio_station','agency','advert')->get();

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

//                return $add_num;

                if ($advert_year == $current_year) {

                    $order_number = $radio_station->ad_prefix."-".substr($add_num,0,2).date('md')."-".substr($add_num,6);

                    // return $order_number;

                } else {
                    $order_number = $radio_station->ad_prefix."-".substr(date('Ymd-'),'2').'001';
//               return $order_number;
                }
            }
        }

//        return "yes";
        DB::beginTransaction();
        try{
            $order = new Order();
            $order->radio_station_id = $request->input('radio_station_id');
            $order->order_number = $order_number;
            $order->agency_id = $request->input('agency_id');
            $order->advert_id = $request->input('advert_id');
            $order->received_date = str_replace('/','-',$request->input('received_date'));
            $order->start_date = str_replace('/','-',$request->input('start_date'));
            $order->end_date = str_replace('/','-',$request->input('end_date'));
            $order->user_id = Auth::user()->id;
            $order->save();

            DB::commit();
            toastr()->success('Order Created');
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->warning('Something Went wrong! Try again');
        }

        return back();
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
