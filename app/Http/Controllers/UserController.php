<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\RadioStation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
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

//        return $radio_stations;
        return view('users.users',compact('radio_stations'));
    }

    /**U
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

        $radio = RadioStation::find($request->radio_station_id);
        $user = new User();
        $user->radio_station_id = $radio->id;
        $user->radio_name = $radio->name;
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->password = Hash::make('11111111');
        $user->role= $request->input('role');

        $user->save();

        toastr()->success('User Added');

        return back();
    }

    public function all_users(){
        $users = User::with('radio_station')->get();

        $radio_stations = RadioStation::all();
        return view('users.users',compact('users','radio_stations'));
    }

    public function search_users(Request $request){
        $users = User::with('radio_station')
            ->where('email', 'like', '%' . $request->input("search") . '%')
            ->orWhere('username', 'like', '%' . $request->input("search") . '%')
            ->orWhere('name', 'like', '%' . $request->input("search") . '%')
            ->orWhere('phone_number', 'like', '%' . $request->input("search") . '%')->get();
        $radio_stations = RadioStation::all();
        return view('users.users',compact('users','radio_stations'));
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

    public function export()
    {
        return Excel::download(new UserExport(), 'Users.xlsx');
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
        $radio = RadioStation::find($request->radio_station_id);
        $user =User::find($id);
        $user->radio_station_id = $radio->id;
        $user->radio_name = $radio->name;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->role= $request->input('role');

        $user->save();

        toastr()->success('User Info Updated');

        return back();
    }

    public function delete_users(Request $request){

        $selected_id = explode(',',$request->input('selected_ids'));;
        foreach ($selected_id as $value){
            $level = User::find($value);
            $level->delete();
        }

        toastr()->success(count($selected_id).' Users Deleted');
        return back();
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
