<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Agency;
use App\Order;
use App\RadioStation;
use App\TransmissionCertificate;
use App\User;
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
        $users = User::all();
        $todayMinusOneWeekAgo = \Carbon\Carbon::today()->subWeek();
        if (Auth::user()->role == "Admin"){
            $orders = Order::with('radio_station','agency','advert')
                ->where('received_date','>=',substr($todayMinusOneWeekAgo,0,10))
                ->get()->groupBy('order_number');
        }else{
            $orders = Order::with('radio_station','agency','advert')
                ->where('radio_station_id',Auth::user()->radio_station_id)
                ->where('received_date','>=',substr($todayMinusOneWeekAgo,0,10))
                ->get()->groupBy('order_number');
        }

        $radio_stations = RadioStation::all();
        return view('orders.orders',compact('orders','users','agencies','adverts','radio_stations'));
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


    public function searchOrders(Request $request){
        $agencies = Agency::all();
        $adverts = Advert::all();
        $users = User::all();

        $radio_stations = RadioStation::all();

        if (Auth::user()->role == "Admin"){
            $orders = Order::with('agency','advert','radio_station')
                ->whereBetween('received_date', [$request->input('from'), $request->input('to')])
                ->get()->groupBy('order_number');
        }else{
            $orders = Order::with('agency','advert','radio_station')
                ->whereBetween('received_date', [$request->input('from'), $request->input('to')])
                ->where('radio_station_id',Auth::user()->radio_station_id)
                ->get()->groupBy('order_number');
        }
        if (count($orders) == 0){
            toastr()->error('No Orders Found');
            return back();
        }else{
            return view('orders.orders',compact('orders','users','agencies','adverts','radio_stations'));

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
            if ($expNum == '') {
                $order_number = $radio_station->ad_prefix."-". substr(date('Ymd'), '2') . '01';
            } else {
                $add_num = str_replace([$radio_station->ad_prefix,'-'],'',$expNum)+1;
                $advert_year= substr($add_num,0,2);
                $current_year = substr(date('Y'), 2);
                if ($advert_year == $current_year) {

                    $order_number = $radio_station->ad_prefix."-".substr($add_num,0,2).date('md')."-".substr($add_num,6);
                } else {
                    $order_number = $radio_station->ad_prefix."-".substr(date('Ymd-'),'2').'001';
                }
            }
        }

        for ($i=0; $i<count($request->input('advert_id')); $i++){

            DB::beginTransaction();
            try{
                $checkOrder = Order::where('radio_station_id',$request->input('radio_station_id'))
                    ->where('agency_id',$request->input('agency_id'))
                    ->where('advert_id',$request->input('advert_id')[$i])
                    ->first();
                $order = new Order();
                $order->radio_station_id = $request->input('radio_station_id');
                $order->order_number = $order_number;
                $order->agency_id = $request->input('agency_id');
                $order->advert_id = $request->input('advert_id')[$i];
                $order->received_date = $request->input('received_date');
                $order->start_date = $request->input('start_date');
                $order->end_date = $request->input('end_date');
                $order->user_id = Auth::user()->id;
                $order->save();

                if (!empty($checkOrder)){ // if Order already Exist
                    if (strtotime($request->input('start_date')) < strtotime($checkOrder->end_date)){
                        DB::rollBack();
                        toastr()->error('Order Detail Already Exist, Try Update');
                        return back();
                    }else{
                        DB::commit();
                        toastr()->success('Order Created');
                    }
                }else{//if Order is Empty
                    DB::commit();
                    toastr()->success('Order Created');
                }
            }catch (\Exception $exception){
                DB::rollBack();
                toastr()->warning('Something Went wrong! Try again');
            }
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
    {$checkTc = TransmissionCertificate::where('advert_id', $id)->first();

        if (!empty($checkTc)){
            toastr()->warning('Advert cannot be deleted because it has been played');
            return back();
        }else{
            $order =  Order::where('advert_id', $id)->first();
            $order->delete();
            toastr()->success('Order Deleted');
            return back();
        }
    }
}
