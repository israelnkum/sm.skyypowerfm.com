<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Tax::where('value',33.00)->get();
            echo json_encode($data);
        }
//        return $data;
    }

    public function delete_tax(Request $request){
        $selected_id = $request['selected'];
        foreach ($selected_id as $value){
            $tax = Tax::find($value);
            $tax->delete();
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
        DB::beginTransaction();
        try{
            foreach ($request->input('taxes') as $tax) {
                $new_tax = Tax::updateOrCreate(
                    ['name' => strtoupper($tax['tax_name'])],
                    [
                        'value' => $tax['tax_value'],
                        'user_id' => Auth::user()->id
                    ]
                );
                /*$new_tax = new Tax();
                $new_tax->name = strtoupper($tax['tax_name']);
                $new_tax->value = $tax['tax_value'];
                $new_tax->user_id = Auth::user()->id;
                $new_tax->save();*/
            }
            DB::commit();
            toastr()->success('Tax Added');
        }catch (\Exception $exception){
            DB::rollBack();
//            return $exception;
            toastr()->warning('Something Went Wrong! Please Try again');

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
        DB::beginTransaction();
        try{
        $new_tax =  Tax::find($id);
        $new_tax->name = strtoupper($request->input('tax_name'));
        $new_tax->value = $request->input('tax_value');
        $new_tax->save();

            DB::commit();
            toastr()->success('Tax Updated');
        }catch (\Exception $exception){
            DB::rollBack();
//            return $exception;
            toastr()->warning('Something Went Wrong! Please Try again');

        }
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
