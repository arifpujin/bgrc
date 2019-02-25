<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\detail_Exitpss;
use App\Department;

class EmployHrController extends Controller
{
//----view------
    //home
    public function getHome(){
        return view('employ.hr.hrem_home');
    }

    //form
    public function getForm(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-hr/home');
       } else {
        return view('employ.hr.hrem_form');
       }
    }

    //status
    public function getStatus(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-hr/home');
       } else {
        $user = Auth::user()->name;
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
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
        return view('employ.hr.hrem_status', compact('data_employ','data_employ2','user','tanggal'));
       }
    }

    //data
    public function getData(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-hr/home');
       } else {
        
        $detail_exitpass = detail_ExitPss::select('*')
                                        ->where('hod_status','Approve')
                                        ->get();

        return view('employ.hr.hrem_data', compact('detail_exitpass'));
       }
    }

    //Register
    public function getRegister(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-hr/home');
       } else {
            $department=Department::all();
        return view('employ.hr.hrem_register',compact('department'));
       }
    }

    //Register
    public function getUser(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-hr/home');
       } else {
        $department=Department::all();
        $idnya = Auth::user()->id;
        $departnya = Auth::user()->depart;        
        $users=User::select('*')
                ->where('depart', 'not like', $departnya)
                ->where('level','not like','Admin SistemExitPass')
		->where('name','not like','Test System')
                ->where('level','not like','HOD')
                ->where('level','not like','Manager')
                ->get();
        return view('employ.hr.hrem_user',compact('users','department'));
       }
    }
    public function getUserdetail(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('employ-hr/home');
       } else {
        $idnya = Auth::user()->id;
        $departnya = Auth::user()->depart;        
        $users=User::select('*')
                ->where('level','not like','Admin SistemExitPass')
		->where('name','not like','Test System')
                ->get();
        return view('employ.hr.hrem_userdetail',compact('users'));
       }
    }
    
    public function getEdit(){
        return view('employ.hr.hrem_edit');
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
        return redirect('employ-hr/status');
    }

    public function postRegisuser(Request $request)
    {
        $this->validate($request, array(
            'username'=>'required|max:5|min:5|unique:users',
            'level'=>'required',
            'depart'=>'required',
            'name'=>'required',
        ));
        

        //store the object bcrypt
            $data=new User();
            $id=$request->get('username');
            $data->name=$request->get('name');
            $data->username=$id;
            $data->password=bcrypt($id);
	    $data->crypt_token=encrypt($id);
            $data->depart=$request->get('depart');
            $data->level=$request->get('level');
            $data->save();

        return redirect('employ-hr/user');
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
        return redirect('employ-hr/home');
    }
     
    public function postUserdel(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
        ));

        //update the object
        $id=$request->get('id'); //buat ngambil dari form
        $data = User::find($id)->first(); // untuk mencari datanya
        $data->delete();

        //redirect to some page
        return redirect('employ-hr/user');
    }
    public function postUseredit(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
            'depart'=> 'required',
            'level' =>'required',
        ));

        //update the object
        $idku=$request->get('id'); //buat ngambil dari form
        $data = User::find($idku); // untuk mencari datanya
        $data->level=$request->get('level');
        $data->depart=$request->get('depart');
        $data->save();
        
        //redirect to some page
        return redirect('employ-hr/user');
    }


}
