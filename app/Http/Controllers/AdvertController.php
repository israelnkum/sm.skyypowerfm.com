<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Agency;
use App\RadioStation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdvertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $agencies = Agency::all();
        $recent_schedules = Advert::all();
        $radio_stations = RadioStation::all();

        return view('adverts.adverts',
            compact('agencies','recent_schedules','radio_stations'));
    }

    public function all_Adverts(){
        $agencies = Agency::all();
        $adverts = Advert::with('radio_station','agency')->get();
        $radio_stations = RadioStation::all();

//        return $adverts;
        return view('adverts.adverts',compact('adverts','agencies','radio_stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $advert = new Advert();
        $file = $request->file('audio_file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('audio_files'), $fileName);

        $radio_station = RadioStation::find($request->input('radio_station_id'));

        $countAdverts = Advert::where('radio_station_id',$request->input('radio_station_id'))->get()->count();

        if ($countAdverts == 0){
            $advert_number=  $radio_station->ad_prefix."-".substr(date('Ym-'),'2').'001';
        }else {
            $record = Advert::latest('id')->first();
            $expNum = $record->advert_number;
//            return $expNum;
            if ($expNum == '') {
                $advert_number = $radio_station->ad_prefix."-". substr(date('Ym'), '2') . '01';
            } else {
                $add_num = str_replace([$radio_station->ad_prefix,'-'],'',$expNum)+1;
                $advert_year= substr($add_num,0,2);
                $current_year = substr(date('Y'), 2);


                if ($advert_year == $current_year) {

                    $advert_number = $radio_station->ad_prefix."-".substr(($add_num),0,2).date('m')."-".substr(($add_num),4);

                   // return $advert_number;

                } else {
                    $advert_number = $radio_station->ad_prefix."-".substr(date('Ym-'),'2').'001';
//                return $advert_number;

                }
            }
        }
//        return $advert_number;
        $advert->agency_id = $request->input('agencies_id');
        $advert->radio_station_id = $request->input('radio_station_id');
        $advert->advert_number = $advert_number;
        $advert->name = $request->input('name');
        $advert->audio_file = $fileName;
        $advert->save();

        toastr()->success('Advert Added');
        return redirect()->route('adverts.index');
    }

    public function delete_Advert(Request $request){

        $selected_id = $request->input('customer_ids');

        foreach ($selected_id as $value){
            $level = Agency::find($value);
            $level->delete();
        }

        toastr()->success(count($selected_id).' Customers Deleted');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
