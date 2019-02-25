<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\detail_Exitpss;
use App\User;
use Auth;

class HODPolController extends Controller
{
    //----view------
    //home
    public function getHome(){
        return view('hod.police.pol_home');
    }

    //form
    public function getForm(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-police/home');
       } else {
        return view('hod.police.pol_form');
       }
    }
    //status
    public function getStatus(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-police/home');
       } else {
        $user = Auth::user()->name;
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
//        
            $data_hod = detail_Exitpss::select('*')
                                      ->where('name','like', $user)
                                      ->where('created_at','regexp', $date)
                                      ->orderBy('created_at','desc')
                                      ->get();
            $data_hod2 = detail_Exitpss::select('*')
                                       ->where('name', $user)
                                       ->orderBy('created_at','desc')
                                       ->get();      
        return view('hod.police.pol_status', compact('data_hod','data_hod2','user','tanggal'));
       }
    }

    public function getApprove(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-police/home');
       } else {
        $depart = Auth::user()->depart;
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
            $dataDepartPen = detail_Exitpss::select('*')
                                           ->where('depart','like', $depart)
                                           ->where('hod_status','Pending')
                                           ->where('created_at','regexp', $date)
                                           ->orderBy('created_at','desc')
                                           ->get();

            $dataDepartNotApp = detail_Exitpss::select('*')
                                           ->where('depart','like', $depart)
                                           ->where('hod_status','Not Approve')
                                           ->where('created_at','regexp', $date)
                                           ->orderBy('created_at','desc')
                                           ->get();

            $dataDepartApp = detail_Exitpss::select('*')
                                           ->where('depart','like', $depart)
                                           ->where('hod_status','Approve')
                                           ->orderBy('created_at','desc')
                                           ->get();

        return view('hod.police.pol_app', compact('dataDepartPen','dataDepartNotApp','dataDepartApp','tanggal'));
       }
    }

    public function getEdit(){
        return view('hod.police.pol_edit');
    }

    public function getGate(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-police/home');
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
        return view('hod.police.pol_gate',compact('gateout','tanggal'));
       }
    }

    public function getGatein(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-police/home');
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
        return view('hod.police.pol_gatein',compact('gatein','tanggal'));
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
        $data->hod_status="Approve";
        $data->apr_name="System";
        $data->tipe=$request->get('tipe');
        $data->purpose=$request->get('purpose');
        $data->save();

        //redirect to some page
        return redirect('hod-police/status');
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
            return redirect('hod-police/home');
        }

        public function postApp(Request $request){
        
            //validate
            $this->validate($request, array(
                'id'=>'required',
            ));
            $jeneng=Auth::user()->name;
            $tanggal = date("d-m-Y");
            $time = date("H:i:s");
            $idku=$request->get('id');
            
            $data=detail_Exitpss::find($idku);
            $data->apr_name = $jeneng;
            $data->hod_status = "Approve";
            $data->hod_date =$tanggal;
            $data->hod_time =$time; // untuk mencari datanya
            $data->save();
    
          //redirect to some page
            return redirect('hod-police/approve');
        }
    
        public function postNotapp(Request $request){
            
            //validate
            $this->validate($request, array(
                'id'=>'required',
            ));
    
            $idku=$request->get('id');
            
            $data=detail_Exitpss::find($idku);
            $data->hod_status = "Not Approve"; // untuk mencari datanya
            $data->save();
    
          //redirect to some page
            return redirect('hod-police/approve');
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
    
            return redirect('hod-police/gate');        
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
    
            return redirect('hod-police/gatein');
        } 
}
