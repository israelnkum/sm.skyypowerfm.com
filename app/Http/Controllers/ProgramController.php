<?php

namespace App\Http\Controllers;

use App\Commercial;
use App\Imports\ProgramsImport;
use App\Program;
use App\RadioStation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProgramController extends Controller
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
        return view('programs.programs',compact('radio_stations'));
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

    public function allPrograms(){
        $radio_stations = RadioStation::all();
        if (Auth::user()->role =="Admin"){
            $programs = Program::with('radio_station')->get()
                ->groupBy('program_name','radio_station_id');
        }else{
            $programs = Program::with('radio_station')
                ->where('radio_station_id',Auth::user()->radio_station_id)
                ->get()
                ->groupBy('program_name','radio_station_id');
        }

        return view('programs.programs',compact('radio_stations','programs'));
    }

    public function filterPrograms(Request $request){
        $radio_stations = RadioStation::all();
        $programs = Program::with('radio_station')
            ->where('radio_station_id',$request->input('filter_programs'))->get()
            ->groupBy('program_name','radio_station_id');

        return view('programs.programs',compact('radio_stations','programs'));
    }
    public function deletePrograms(Request $request){


        DB::beginTransaction();
        try{
            foreach ($request->input('programs_ids') as $value){
                $program = Program::find($value);
                $program->delete();


                $commercial = Commercial::where('program_id', $value)->first();
                if (!empty($commercial)){
                    $commercial->delete();
                }
            }

            DB::commit();
            toastr()->success($program->program_name.' Deleted For all Days');
        }catch (\Exception $exception){

            DB::rollBack();
            toastr()->warning('Something went wrong! Please try again');
        }
        return back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->input('day_of_week') as $day){
                $program = new Program();
                $program->program_name = strtoupper($request->input('program_name'));
                $program->radio_station_id = $request->input('radio_station_id');
                $program->day = $day;
                $program->start_time = $request->input('start_time');
                $program->end_time = $request->input('end_time');

                //calculate duration in HOurs
                $start_time = Carbon::parse($request->input('start_time'));
                $end_time = Carbon::parse($request->input('end_time'));
                //end calculation

                $duration = round($end_time->diffInMinutes($start_time) / 60);
                $program->duration = $duration;
                $program->presenter = $request->input('presenter');
                $program->user_id = Auth::user()->id;

                $program->save();
            }
            DB::commit();
            toastr()->success('New Program Created');
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->warning('Something went wrong! Try again');
        }

        return back();
    }

    public function searchPrograms(Request $request){
        $programs = Program::with('radio_station')
            ->where('program_name', 'like', '%' . $request->input("search") . '%')
            ->orWhere('day', 'like', '%' . $request->input("search") . '%')
            ->where('radio_station_id',Auth::user()->radio_station_id)
            ->get()->groupBy('program_name','radio_station_id');

//        return $programs
        $radio_stations = RadioStation::all();
        return view('programs.programs',compact('radio_stations','programs'));
    }

    public function uploadPrograms(Request $request)
    {
//        dd(request()->file('file'));
        $programs=   Excel::toCollection(new ProgramsImport(), request()->file('file'));

        foreach ($programs[0] as $program => $value){

            //calculate duration in HOurs
            $start_time = Carbon::parse($program['start_time']);
            $end_time = Carbon::parse($program['end_time']);
            //end calculation

            $user= Program::updateOrCreate(
                [
                    'program_name' => $program['program_name'],
                    'day'=>$program['day'],
                    'radio_station_id'=>$request->input('radio_station_id')
                ],
                [
                    'start_time' => $program['start_time'],
                    'end_time' => $program['end_time'],
                    'duration'=>round($end_time->diffInMinutes($start_time) / 60),
                    'presenter'=>$program['presenter'],
                    'user_id'=> Auth::user()->id,
                ]);

        }
        toastr()->success(count($programs[0]).' Candidate Uploaded Successfully');
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

//    return $program;
        DB::beginTransaction();
        try{
            $program = Program::find($id);
            $program->delete();

            $commercials = Commercial::where('program_id', $id)->get();
            foreach ($commercials as $commercial){
                $commercial->delete();
            }

            DB::commit();
            toastr()->success($program->program_name.' Deleted Successfully for '.$program->day);
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->success('Something went wrong! Try Again');
        }

        return back();
    }
}
