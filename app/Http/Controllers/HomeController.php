<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (date('Y-m-d') >= '2019-12-15'){
            return view('welcome1');
        }else{

            $activeOrders = Order::where('end_date','>=',date('Y-m-d'))
                ->get()->unique('order_number')->count();
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
            return view('home',compact('orders'));
        }

    }
}
