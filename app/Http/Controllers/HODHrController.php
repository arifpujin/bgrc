<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\detail_Exitpss;
use App\Department;

class HODHrController extends Controller
{


    public function getHome(){
        return view('hod.hr.hrhod_home');
    }


    public function getForm(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-hr/home');
       } else {
        return view('hod.hr.hrhod_form');
       }
    }

    public function getStatus(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-hr/home');
       } else {
        $user = Auth::user()->name;
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
       
            $data_hod = detail_Exitpss::select('*')
                                      ->where('name','like', $user)
                                      ->where('created_at','regexp', $date)
                                      ->orderBy('created_at','desc')
                                      ->get();
            $data_hod2 = detail_Exitpss::select('*')
                                       ->where('name', $user)
                                       ->orderBy('created_at','desc')
                                       ->get();      
        return view('hod.hr.hrhod_status', compact('data_hod','data_hod2','user','tanggal'));
       }
    }

    public function getApprove(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-hr/home');
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
                                           
        return view('hod.hr.hrhod_app', compact('dataDepartPen','dataDepartNotApp','dataDepartApp','tanggal'));
       }
    }
    //data
    public function getData(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-hr/home');
       } else {
        
        $detail_exitpass = detail_ExitPss::select('*')
                                        ->where('hod_status','Approve')
                                        ->get();

        return view('hod.hr.hrhod_data', compact('detail_exitpass'));
       }
    }

    //Register
    public function getRegister(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-hr/home');
       } else {
            $department=Department::all();
        return view('hod.hr.hrhod_register', compact('department'));
       }
    }

    //User
    public function getUser(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-hr/home');
       } else {
        $department=Department::all();
        $idnya = Auth::user()->id;
            $users=User::select('*')
                    ->where('id', 'not like', $idnya)
		    ->where('name','not like','Test System')
                    ->where('level','not like','Admin SistemExitPass')
                    ->where('level','not like','Manager')
                    ->get();
        return view('hod.hr.hrhod_user',compact('users','department'));
       }
    }
    public function getDepartment(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-hr/home');
       } else {
        $department=Department::all();
        
        return view('hod.hr.hrhod_depart',compact('department'));
       }
    }
    public function getUserdetail(){
        if (Auth::user()->akun == "belum" || Auth::user()->akun == "admin" || Auth::user()->akun == "lost"){
           return redirect('hod-hr/home');
       } else {
        $idnya = Auth::user()->id;
            $users=User::select('*')
                    ->where('level','not like','Admin SistemExitPass')
		    ->where('name','not like','Test System')
                    ->get();
        return view('hod.hr.hrhod_userdetail',compact('users'));
       }
    }
    public function getEdit(){
        return view('hod.hr.hrhod_edit');
    }

    public function postFormexit(Request $request){
        
        $id=Auth::user()->username;
        $user=Auth::user()->name;
        $depart=Auth::user()->depart;
        $tanggal = date("d-m-Y");
        $time = date("H:i:s");
        //validate
        $this->validate($request, array(
            'tipe'=>'required',
            'purpose'=>'required',
        ));

        //store the object
        $data=new detail_Exitpss();
        $data->noem=$id;
        $data->name=$user;
        $data->apr_name="System";
        $data->hod_status="Approve";
        $data->hod_date=$tanggal;
        $data->hod_time=$time;
        $data->depart=$depart;
        $data->tipe=$request->get('tipe');
        $data->purpose=$request->get('purpose');
        $data->save();

        //redirect to some page
        return redirect('hod-hr/status');
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

        return redirect('hod-hr/user');
    }
    public function postNewdep(Request $request)
    {
        $this->validate($request, array(
            'name'=>'required|max:50',
        ));
        
            $data=new Department();
            $data->name=$request->get('name');
            $data->timestamps = false;
            $data->save();

        return redirect('hod-hr/department');
    }
    public function postDepedit(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
            'name'=>'required|max:50'
        ));
        $idku=$request->get('id');
        $depart=$request->get('name');
        
        if ($idku == '3'){
            $data=Department::find($idku);
            $data->name="Polis Bantuan";
            $data->timestamps = false;
            $data->save();
        }
        elseif($idku == '2'){
            $data=Department::find($idku);
            $data->name="Human Resources";
            $data->timestamps = false;
            $data->save();
        }else{
            $data=Department::find($idku);
            $data->name=$depart;
            $data->timestamps = false;
            $data->save();
        }
        
      //redirect to some page
        return redirect('hod-hr/department');
    }
    public function postDepdel(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
        ));
        $idku=$request->get('id');
        
        if ($idku == '3'){
            $data=Department::find($idku);
            $data->name="Polis Bantuan";
            $data->timestamps = false;
            $data->save();
        }
        elseif($idku == '2'){
            $data=Department::find($idku);
            $data->name="Human Resources";
            $data->timestamps = false;
            $data->save();
        }else{
            $data=Department::find($idku);
            $data->delete();
        }
        
      //redirect to some page
        return redirect('hod-hr/department');
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
                $data->akun="onlypas";
                $data->save();
            }

        //redirect to some page
        return redirect('hod-hr/home');
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
        $data->hod_time =$time; 
        $data->save();

      //redirect to some page
        return redirect('hod-hr/approve');
    }

    public function postNotapp(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
        ));

        $idku=$request->get('id');
        
        $data=detail_Exitpss::find($idku);
        $data->hod_status = "Not Approve"; 
        $data->save();

      //redirect to some page
        return redirect('hod-hr/approve');
    }
    
    public function postUserdel(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
        ));

        //update the object
        $idku=$request->get('id'); 
        $data = User::find($idku); 
        $data->delete();

        //redirect to some page
        return redirect('hod-hr/user');
    }
    
    public function postUseredit(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
            'depart'=> 'required',
            'level' =>'required',
        ));

        //update the object
        $idku=$request->get('id'); 
        $data = User::find($idku); 
        $data->level=$request->get('level');
        $data->depart=$request->get('depart');
        $data->save();

        //redirect to some page
        return redirect('hod-hr/user');
    }
}
