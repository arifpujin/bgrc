<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\detail_Exitpss;
use App\User;

class ManController extends Controller
{
    //----view------
    //home
    public function getHome(){
        return view('employ.manager.home');
    }

    //status
    public function getStatus(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('manager/home');
       } else {
        $user = Auth::user()->name;
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
//        $time = date("H:i:s");
        $data_employ2 = detail_Exitpss::select('*')
                                     ->where('hod_status','not like','Pending')
                                     ->orderBy('created_at','desc')
                                     ->get();      
        return view('employ.manager.status', compact('data_employ2','user','tanggal'));
       }
    }
    public function getUserdetail(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('manager/home');
       } else {
        $idnya = Auth::user()->id;
            $users=User::select('*')
                    ->where('id', 'not like', $idnya)
		    ->where('name','not like','Test System')
                    ->where('level','not like','Admin SistemExitPass')
                    ->get();
        return view('employ.manager.userdetail',compact('users'));
       }
    }
    
    public function getEdit(){
        return view('employ.manager.edit');
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
                $data->ic=$ic;
                $data->telpon=$pon;
                $data->email=$emel;
                $data->alamat=$dres;
                $data->akun="onlypas";
                $data->save();
            }
            
    
            //redirect to some page
            return redirect('manager/home');
        }
}
