<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\detail_Exitpss;
use Auth;
use App\User;

class EmployPolController extends Controller
{
     //----view------
    //home
    public function getHome(){
        return view('employ.police.policeem_home');
    }

    //form
    public function getForm(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-police/home');
       } else {
        return view('employ.police.policeem_form');
       }
    }
    //status
    public function getStatus(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-police/home');
       } else {
        $user = Auth::user()->name;
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
//      $time = date("H:i:s");
        $data_employ = detail_Exitpss::select('*')
                                     ->where('name', $user)
                                     ->where('created_at','regexp', $date)
                                     ->orderBy('created_at','desc')
                                     ->get();  
        $data_employ2 = detail_Exitpss::select('*')
                                     ->where('name', $user)
                                     ->wherenotnull('hod_date')
                                     ->wherenotnull('hod_time')
                                     ->orderBy('created_at','desc')
                                     ->get();      
        return view('employ.police.policeem_status', compact('data_employ','data_employ2','user','tanggal'));
       }
    }
    public function getEdit(){
        return view('employ.police.policeem_edit');
    }
    public function getGate(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-police/home');
       } else {
        $user=Auth::user()->name;
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
        $gateout=detail_Exitpss::select('*')
                                ->where('hod_status','like','Approve')
                                ->where('name','not like',$user)
                                ->where('created_at','regexp', $date)
                                ->wherenull('name_police_out')
                                ->get();
        return view('employ.police.policeem_gate',compact('gateout','tanggal'));
       }
    }

    public function getGatein(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-police/home');
       } else {
        $user=Auth::user()->name;
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
        $gatein=detail_Exitpss::select('*')
                                ->where('hod_status','like','Approve')
                                ->where('name','not like',$user)
                                ->wherenotnull('name_police_out')
                                ->wherenull('name_police_in')
                                ->where('created_at','regexp', $date)
                                ->get();
        return view('employ.police.policeem_gatein',compact('gatein','tanggal'));
       }
    }

    //--- Upload-------
    //Post Exitpass
    public function postFormexit(Request $request){
        
        $id=Auth::user()->username;
        $user=Auth::user()->name;
        $depart=Auth::user()->depart;
        //validate
        $this->validate($request, array(
            'tipe'=>'required',
            'purpose'=>'required',
        ));

        //store the object
        $data=new detail_Exitpss();
        $data->noem=$id;
        $data->name=$user;
        $data->depart=$depart;
        $data->tipe=$request->get('tipe');
        $data->purpose=$request->get('purpose');
        $data->save();

        //redirect to some page
        return redirect('employ-police/status');
    }

    public function postEdit(Request $request){
        
        //validate
            $this->validate($request, array(
                'id'=>'required',
                'password'=>'required|min:5|confirmed',
            ));
    
            //update the object
            $idku=$request->get('id'); //buat ngambil dari form
            $pass=$request->get('password'); //buat diambil dari form
            $ic=$request->get('idca');
            $pon=$request->get('telpon');
            $emel=$request->get('email');
            $dres=$request->get('address');
            if($pass != '' && $ic != '' && $pon != '' && $emel != '' && $dres != ''){
                $data = User::find($idku); // untuk mencari datanya
                $data->password=bcrypt($pass);
		$data->crypt_token=encrypt($pass);  
                $data->ic=$ic;
                $data->telpon=$pon;
                $data->email=$emel;
                $data->alamat=$dres;
                $data->akun="lengkap";
                $data->save();
            } else{
                $data = User::find($idku); // untuk mencari datanya
                $data->password=bcrypt($pass);
		$data->crypt_token=encrypt($pass);
                $data->akun="onlypas";
                $data->save();
            }

        //redirect to some page
        return redirect('employ-police/home');
    }

    public function postGateout(Request $request){
        $idku=$request->get('id');
        $user=Auth::user()->name;
        $tanggal = date("d-m-Y");
        $time = date("H:i:s");
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
        ));

    $data = detail_Exitpss::find($idku); // untuk mencari datanya
        $data->name_police_out=$user;  
        $data->date_out=$tanggal;
        $data->time_out=$time;
        $data->save();

        return redirect('employ-police/gate');        
    }

    public function postGatein(Request $request){
        $idku=$request->get('id');
        $user=Auth::user()->name;
        $tanggal = date("d-m-Y");
        $time = date("H:i:s");
        //validate
        $this->validate($request, array(
            'id'=>'required',
        ));

        $data = detail_Exitpss::find($idku); // untuk mencari datanya
        $data->name_police_in=$user;  
        $data->date_in=$tanggal;
        $data->time_in=$time;
        $data->save();

        return redirect('employ-police/gatein');
    } 

}
