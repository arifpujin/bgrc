<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crypt;
use App\Http\Requests;
use Auth;
use User;
use App\detail_Exitpss;

class HodController extends Controller
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
        //
        return view('hod.hod_home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('hod.hod_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validate
    $this->validate($request, array(
        'tipe'=>'required',
        'purpose'=>'required|max:15',
    ));

    $user=Auth::user()->name;
    $date=date("d-m-Y");
    $time = date("H:i:s");
    $hodstatus="Approve";
    //store the object
    $data=new detail_Exitpss();
    $data->name=$user;
    $data->hod_status=$hodstatus;
    $data->hod_date=$date;
    $data->hod_time=$time;
    $data->depart=$request->get('depart');
    $data->tipe=$request->get('tipe');
    $data->purpose=$request->get('purpose');
    $data->save();

    //redirect to some page
    return redirect('hod-status');
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
        //
    }
}
