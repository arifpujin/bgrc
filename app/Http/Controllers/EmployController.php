<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\detail_Exitpss;
use App\User;

class EmployController extends Controller
{
    //----view------
    //home
    public function getHome(){
        return view('employ.em_home');
    }

    //form
    public function getForm(){
       if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ/home');
       } else {
           return view('employ.em_form');
       }
    }
    //status
    public function getStatus(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ/home');
       } else {
        $user = Auth::user()->name;
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
//        $time = date("H:i:s");
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
        return view('employ.em_status', compact('data_employ','data_employ2','user','tanggal'));
       }
    }
    
    public function getEdit(){
        return view('employ.em_edit');
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
        return redirect('employ/status');
        }

        public function postEdit(Request $request){
        
            //validate
            $this->validate($request, array(
                'id'=>'required',
                'password'=>'required|min:5|confirmed',
            ));
    
            //update the object
            $idku=$request->get('id'); 
            $pass=$request->get('password'); 
            $ic=$request->get('idca');
            $pon=$request->get('telpon');
            $emel=$request->get('email');
            $dres=$request->get('address');
            if($pass != '' && $ic != '' && $pon != '' && $emel != '' && $dres != ''){
                $data = User::find($idku); 
                $data->password=bcrypt($pass);
		$data->crypt_token=encrypt($pass);  
                $data->ic=$ic;
                $data->telpon=$pon;
                $data->email=$emel;
                $data->alamat=$dres;
                $data->akun="lengkap";
                $data->save();
            } else{
                $data = User::find($idku); 
                $data->password=bcrypt($pass);
		$data->crypt_token=encrypt($pass);  
                $data->ic=$ic;
                $data->telpon=$pon;
                $data->email=$emel;
                $data->alamat=$dres;
                $data->akun="onlypas";
                $data->save();
            }
            
    
            //redirect to some page
            return redirect('employ/home');
        }
}
