<?php

namespace App\Http\Controllers;

use App\RadioStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RadioStationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $station = new RadioStation();
            $station->name = $request->input('name');
            $station->address = $request->input('address');
            $station->location = $request->input('location');
            $station->phone_number = $request->input('phone_number');
            $station->fax = $request->input('fax');
            $station->user_id = Auth::user()->id;

            //upload signature
            $signature = request()->file('signature');
            $signatureName ="";
            if ($signature != '') {

                $this->Validate($request, [
                    'signature'=>'image|mimes:jpeg,png,jpg|max:20000',
                ]);
                $file = request()->file('signature');
                $extension = $file->getClientOriginalExtension();
                $files = substr($file->getClientOriginalName(), 0, strpos($file->getClientOriginalName(), '.'));
                $signatureName = str_replace(' ','',$request->input('name')) .'_signature.' . $extension;

                $file->move('public/uploads', $signatureName);

            }

            //upload logo
            $signature = request()->file('logo');
            $logoName ="";
            if ($signature != '') {

                $this->Validate($request, [
                    'logo'=>'image|mimes:jpeg,png,jpg|max:20000',
                ]);
                $file = request()->file('logo');
                $extension = $file->getClientOriginalExtension();
                $files = substr($file->getClientOriginalName(), 0, strpos($file->getClientOriginalName(), '.'));
                $logoName = str_replace(' ','',$request->input('name')) .'_logo.' . $extension;

                $file->move('public/uploads', $logoName);

            }
            $station->ad_prefix = strtoupper($request->input('prefix'));
            $station->signature = $signatureName;
            $station->logo = $logoName;

            $station->save();
            DB::commit();
            toastr()->success('Radio Station Added');
            return back();
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->warning('Error while Saving! Please Try Again');
            return back();
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $station =  RadioStation::find($id);
            $station->name = $request->input('name');
            $station->address = $request->input('address');
            $station->location = $request->input('location');
            $station->phone_number = $request->input('phone_number');
            $station->fax = $request->input('fax');

            //upload signature
            $signature = request()->file('signature');
            if ($signature != '') {

                $this->Validate($request, [
                    'signature'=>'image|mimes:jpeg,png,jpg|max:20000',
                ]);
                $file = request()->file('signature');
                $extension = $file->getClientOriginalExtension();
                $files = substr($file->getClientOriginalName(), 0, strpos($file->getClientOriginalName(), '.'));
                $signatureName = str_replace(' ','',$request->input('name')) .'_signature.' . $extension;

                $file->move('public/uploads', $signatureName);
                $station->signature = $signatureName;
            }

            //upload logo
            $logo = request()->file('logo');
            if ($logo != '') {

                $this->Validate($request, [
                    'logo'=>'image|mimes:jpeg,png,jpg|max:20000',
                ]);
                $file = request()->file('logo');
                $extension = $file->getClientOriginalExtension();
                $files = substr($file->getClientOriginalName(), 0, strpos($file->getClientOriginalName(), '.'));
                $logoName = str_replace(' ','',$request->input('name')) .'_logo.' . $extension;

                $file->move('public/uploads', $logoName);
                $station->logo = $logoName;
            }

            $station->ad_prefix = strtoupper($request->input('prefix'));

            $station->save();
            DB::commit();
            toastr()->success('Radio Station Updated');
            return back();
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->warning('Error while Saving! Please Try Again');
            return back();
        }
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
