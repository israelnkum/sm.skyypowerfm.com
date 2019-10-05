<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;

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
        foreach ($request->input('taxes') as $tax) {
            $new_tax = new Tax();
            $new_tax->name = strtoupper($tax['tax_name']);
            $new_tax->value = $tax['tax_value'];
            $new_tax->save();
        }
        toastr()->success('Tax Added');
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
        $new_tax =  Tax::find($id);
        $new_tax->name = strtoupper($request->input('tax_name'));
        $new_tax->value = $request->input('tax_value');
        $new_tax->save();


        toastr()->success('Tax Updated');
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
