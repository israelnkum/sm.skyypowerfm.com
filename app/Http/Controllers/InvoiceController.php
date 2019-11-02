<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Invoice;
use App\Order;
use App\RadioStation;
use App\Tax;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
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
        $radio_stations = RadioStation::all();

        if(Auth::user()->role == "Admin"){
            $agency = Agency::all();
        }else{
            $agency = Agency::where('radio_station_id', Auth::user()->radio_station_id)->get();
        }


        return view('tc-invoice.invoice',compact('radio_stations','agency'));

    }

    public function filterOrders(Request $request){
        $agency_id =$request->input('agency_id');
        $selected_agency = Agency::with('radio_station')->find($request->input('agency_id'));

        $orders = Order::where('agency_id',$agency_id)->get()->unique('order_number');

        if (count($orders)==0){
            toastr()->error('No Order Found');
            return back();
        }
        if(Auth::user()->role == "Admin"){
            $agency = Agency::all();
        }else{
            $agency = Agency::where('radio_station_id', Auth::user()->radio_station_id)->get();
        }

        $taxes = Tax::all();
        return view('tc-invoice.invoice',
            compact('orders','agency','agency_id','selected_agency','taxes'));

    }

    public function allInvoices(){
        $radio_stations = RadioStation::all();

        if(Auth::user()->role == "Admin"){
            $agency = Agency::all();
            $allInvoices = Invoice::with('radio_station','agency')->get();
        }else{
            $agency = Agency::where('radio_station_id', Auth::user()
                ->radio_station_id)->get();
            $allInvoices = Invoice::with('radio_station','agency')->where('radio_station_id', Auth::user()
                ->radio_station_id)->get();
        }
        return view('tc-invoice.invoice',compact('allInvoices','radio_stations','agency'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $agency_id =$request->input('agency_id');
        $selected_agency = Agency::with('radio_station')->find($request->input('agency_id'));

        $orders = Order::where('agency_id',$agency_id)->get()->unique('order_number');

        if (count($orders)==0){
            toastr()->error('No Order Found');
            return back();
        }
        if(Auth::user()->role == "Admin"){
            $agency = Agency::all();
        }else{
            $agency = Agency::where('radio_station_id', Auth::user()->radio_station_id)->get();
        }
        $data = Order::with('advert')->where('order_number',$request->order_number)->get();
        $taxes = Tax::all();

        return view('tc-invoice.invoice',
            compact('orders','agency','agency_id','selected_agency','taxes','data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $countAdverts = Invoice::where('radio_station_id',$request->input('radio_station_id'))->get()->count();
        if ($countAdverts == 0){
            $invoice_number=  "INV-".substr(date('Ymd-'),'2').'001';
        }else {
            $record = Invoice::where('radio_station_id',$request->input('radio_station_id'))->latest()->first();
            $expNum = $record->invoice_number;
            if ($expNum == '') {
                $invoice_number = "INV-". substr(date('Ymd'), '2') . '01';
            } else {

                $add_num = str_replace(['INV','-'],'',$expNum)+1;
                $advert_year= substr($expNum,4,2);
                $current_year = substr(date('Y'), 2);
                if ($advert_year == $current_year) {
                    $invoice_number = substr($expNum,0,6).date('md')."-".substr($add_num,6);
                } else {
                    $invoice_number = "INV-"."-".substr(date('Ymd-'),'2').'001';
                }
            }
        }
        DB::beginTransaction();
        try{
            $invoice = new Invoice();
            $invoice->radio_station_id = $request->radio_station_id;
            $invoice->agency_id = $request->agency_id;
            $invoice->invoice_number = $invoice_number;
            $invoice->description = $request->description;
            $invoice->qty = $request->qty;
            $invoice->vat = $request->vat;
            $invoice->vat_amount = $request->vat_amount;
            $invoice->nhil = $request->nhil;
            $invoice->nhil_amount = $request->nhil_amount;
            $invoice->getfund = $request->getfund;
            $invoice->getfund_amount = $request->getfund_amount;
            $invoice->unit_price = $request->unit_price;
            $invoice->total_price = $request->total_price;
            $invoice->taxable_amt = $request->taxable_amt;
            $invoice->final_amt_to_pay = $request->total_amt;

            $invoice->save();


            $printContent =$invoice->id;

            if ($printContent){
                DB::commit();
            }
            toastr()->success('Invoice Generated');
            return redirect()->route('print-invoice',$printContent);
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->warning('Something went wrong, Try Again');
            return back();
        }
    }


    public function printInvoice($printContent){
        $printContent= Invoice::with('radio_station','agency')->find($printContent);
        $radio_stations = RadioStation::all();

        if(Auth::user()->role == "Admin"){
            $agency = Agency::all();
            $allInvoices = Invoice::with('radio_station','agency')->get();
        }else{
            $agency = Agency::where('radio_station_id', Auth::user()->radio_station_id)->get();
            $allInvoices = Invoice::with('radio_station','agency')->where('radio_station_id', Auth::user()
                ->radio_station_id)->get();
        }

        return view('tc-invoice.invoice',compact('allInvoices','radio_stations','agency','printContent'));

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
