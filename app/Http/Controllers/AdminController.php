<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\detail_Exitpss;
use App\Department;

class AdminController extends Controller
{
    public function getHome()
    {
       return view('hod.admin.admin_home');
    }
    public function getApprove(){
	if (Auth::user()->akun == "lost"){
	return redirect('admin/home');	
	} else {
        $date = date("Y-m-d");
        $tanggal = date("d-m-Y");
            $dataDepartPen = detail_Exitpss::select('*')
                                           ->where('hod_status','Pending')
                                           ->where('created_at','regexp', $date)
                                           ->orderBy('created_at','desc')
                                           ->get();

            $dataDepartNotApp = detail_Exitpss::select('*')
                                           ->where('hod_status','Not Approve')
                                           ->where('created_at','regexp', $date)
                                           ->orderBy('created_at','desc')
                                           ->get();

            $dataDepartApp = detail_Exitpss::select('*')
                                           ->where('hod_status','Approve')
                                           ->orderBy('created_at','desc')
                                           ->get();
        return view('hod.admin.admin_app', compact('dataDepartPen','dataDepartNotApp','dataDepartApp','tanggal'));
	}
    }
    public function getData(){
        if (Auth::user()->akun == "lost"){
	return redirect('admin/home');	
	} else {
        $detail_exitpass = detail_ExitPss::select('*')
                                        ->where('hod_status','Approve')
                                        ->get();

        return view('hod.admin.admin_data', compact('detail_exitpass'));
	}
    }
    //Register
    public function getRegister(){
	if (Auth::user()->akun == "lost"){
	return redirect('admin/home');	
	} else {
            $department=Department::all();
        return view('hod.admin.admin_register', compact('department'));
	}
    }

    //Register
    public function getUser(){
	if (Auth::user()->akun == "lost"){
	return redirect('admin/home');	
	} else {
        $idnya = Auth::user()->id;
            $users=User::select('*')
                    ->where('id', 'not like', $idnya)
		    ->where('name','not like','Test System')
                    ->where('level','not like','Admin SistemExitPass')
                    ->get();
        return view('hod.admin.admin_user',compact('users'));
	}
    }
    public function getEdit(){
        return view('hod.admin.admin_edit');
    }
     public function postRegisuser(Request $request)
    {
        $this->validate($request, array(
            'username'=>'required|max:5|min:5|unique:users',
            'level'=>'required',
            'depart'=>'required',
            'name'=>'required',
        ));
         
            $lev=$request->get('level');
            if ($lev == 'Manager'){
                $data=new User();
                $id=$request->get('username');
                $data->name=$request->get('name');
                $data->username=$id;
                $data->password=bcrypt($id);
		$data->crypt_token=encrypt($id);
                $data->depart="BGRC Management";
                $data->level=$lev;
                $data->save();
            }
            else{
                $data=new User();
                $id=$request->get('username');
                $data->name=$request->get('name');
                $data->username=$id;
                $data->password=bcrypt($id);
		$data->crypt_token=encrypt($id);
                $data->depart=$request->get('depart');
                $data->level=$lev;
                $data->save();
            }

        return redirect('admin/user');
    }
    public function postApp(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
        ));

        $tanggal = date("d-m-Y");
        $time = date("H:i:s");
        $idku=$request->get('id');
        
        $data=detail_Exitpss::find($idku);
        $data->apr_name="Admin";
        $data->hod_status = "Approve";
        $data->hod_date =$tanggal;
        $data->hod_time =$time; // untuk mencari datanya
        $data->save();

      //redirect to some page
        return redirect('admin/approve');
    }

    public function postNotapp(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
        ));

        $idku=$request->get('id');
        
        $data=User::find($idku);
        $data->hod_status = "Not Approve"; // untuk mencari datanya
        $data->save();

      //redirect to some page
        return redirect('admin/approve');
    }
    
    public function postUserdel(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
        ));

        //update the object
        $idku=$request->get('id'); //buat ngambil dari form
        $data = User::find($idku); // untuk mencari datanya
        $data->delete();

        //redirect to some page
        return redirect('admin/user');
    }
    public function postUserreset(Request $request){
        
        //validate
        $this->validate($request, array(
            'id'=>'required',
            'username'=>'required',
        ));

        //update the object
        $idku=$request->get('id'); //buat ngambil dari form
        $userku=$request->get('username');
        $data = User::find($idku); // untuk mencari datanya
        $data->password=bcrypt($userku);
	$data->crypt_token=encrypt($userku);
        $data->akun="admin";
        $data->save();

        //redirect to some page
        return redirect('admin/user');
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
            $dres=$request->get('address');
            if($pass != '' && $ic != '' && $pon != '' && $dres != ''){
                $data = User::find($idku); // untuk mencari datanya
                $data->password=bcrypt($pass);
		$data->crypt_token=encrypt($pass);  
                $data->ic=$ic;
                $data->telpon=$pon;
                $data->alamat=$dres;
                $data->akun="lengkap";
                $data->save();
            } else{
                $data = User::find($idku); // untuk mencari datanya
                $data->password=bcrypt($pass);
		$data->crypt_token=encrypt($pass);  
                $data->ic=$ic;
                $data->telpon=$pon;
                $data->alamat=$dres;
                $data->akun="lengkap";
                $data->save();
            }
            
    
            //redirect to some page
            return redirect('admin/home');
        }
}
