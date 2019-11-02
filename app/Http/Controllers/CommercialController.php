<?php

namespace App\Http\Controllers;

use App\Commercial;
use App\Order;
use App\Program;
use App\RadioStation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommercialController extends Controller
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
        return  view('commercials.commercials');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dayOfWeek = $request->input('day_of_week');
        $hasPrograms = "No";
        $radio_station = RadioStation::all();
        if ($request->has('radio-station') && $request->has('day_of_week')){
            $programs = Program::with('radio_station','commercials.advert')
                ->where('radio_station_id',$request->input('radio-station'))
                ->where('day',$request->input('day_of_week'))
//                ->orderBy('start_time')
                ->get();

//            return $programs[0]->commercials;
            $hasPrograms ="Yes";

            $orders = Order::with('advert')
                ->where('radio_station_id',$request->input('radio-station'))
//                ->whereDate('start_date','>=', date('Y-m-d'))
                ->whereDate('start_date', '<=', Carbon::today()->startOfDay())
                ->whereDate('end_date', '>=', Carbon::today()->startOfDay())
                ->get();

//            return  $programs;
            if (count($programs) == 0){
                toastr()->error('No Programs Found');
                return back();
            }
            return view('commercials.add-commercial',
                compact('radio_station','programs','hasPrograms','orders','dayOfWeek'));
        }else{
            return view('commercials.add-commercial',
                compact('radio_station','hasPrograms'));
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= explode(',',$request->input('data'));
        DB::beginTransaction();
        try{
            $checkCommercial = Commercial::where('order_id',$data[0])
                ->where('advert_id',$data[1])
                ->where('agency_id',$data[2])
                ->where('date',$request->input('date'))
                ->where('time',$request->input('time'))
                ->first();
//            return $request;
            if (!empty($checkCommercial)){
                toastr()->error('Commercial Already Exist');
                return back();
            }
            $commercial = new Commercial();
            $commercial->order_id= $data[0];
            $commercial->advert_id= $data[1];
            $commercial->agency_id= $data[2];
            $commercial->radio_station_id = $request->input('radio_station_id');
            $commercial->program_id= $request->input('program_id');
            $commercial->date= $request->input('date');
            $commercial->time= $request->input('time');
            $commercial->save();


            DB::commit();
            toastr()->success('Commercial Created');
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->error('Something went wrong! Try again');
        }

        return back();
    }

    public function allCommercials(Request $request){
//        $todayMinusOneWeekAgo = \Carbon\Carbon::today()->subWeek();

        if (Auth::user()->role == "Admin"){
            $commercials = Commercial::with('program','agency','order','advert','radio_station')
                ->whereBetween('date', [$request->input('from'), $request->input('to')])->get();
        }else{
            $commercials = Commercial::with('program','agency','order','advert','radio_station')
                ->whereBetween('date', [$request->input('from'), $request->input('to')])
                ->where('radio_station_id',Auth::user()->radio_station_id)->get();
        }


        if (count($commercials) == 0){
            toastr()->error('No Commercials Found');
            return back();
        }else{
            return view('commercials.commercials',compact('commercials'));
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
        $comm = Commercial::find($id);
        $comm->delete();
        toastr()->success('Commercial Deleted');

        return back();
    }
}
