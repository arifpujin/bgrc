<?php


//    *****DON'T CHANGE ANYTHING, PLEASE CALL THE CREATOR**********

//=========================================================//
//         //\\       ||====    ||      ||==========       //
//        //  \\      ||  //    ||      ||                 //
//       //    \\     || //     ||      ||========         //
//      //======\\    || \\     ||      ||                 //
//     //        \\   ||  \\    ||      ||                 //
//    //          \\  ||   \\   ||      ||                 //
//                                                         //
//        Created By Arif Puji Nugroho (Indonesia)         //
//     Website    : https://arifpn.id/                     //
//     Facebook   : https://facebook.com/arifpn            //
//     Instagram  : https://instagram.com/reallifeapn      //
//     Whatsapp   : +6285885994505                         //
//     Email      : arifpujinugroho@gmail.com              //
//=========================================================//

//    *****Electronic Exit Pass Bukit Gambang Resort City 2018**********
//        *****Proyek Praktek Industri UNY Ke Malaysia 2018**********
//               *****3 July 2018 - 20 Agustus 2018**********














//middleware memeriksa session CSRF dan Karnel HTTP
Route::group(['middleware'=>'web'], function(){
    Route::auth();
});


Route::group(['middleware'=>['auth']], function(){
    //Route::get('/home','HomeController@index');
    Route::get('/',function(){

        if (Auth::user()->level == 'HOD'){
            if(Auth::user()->depart == 'Human Resources'){
                return redirect('/hod-hr/home');
            }
            elseif(Auth::user()->depart == 'Polis Bantuan'){
                return redirect('/hod-police/home');
            }
            else {
                return redirect('/hod/home');
            }
        }
        elseif(Auth::user()->level == 'Employee'){
            if(Auth::user()->depart == 'Human Resources'){
                return redirect('/employ-hr/home');
            }
            elseif(Auth::user()->depart == 'Polis Bantuan'){
                return redirect('/employ-police/home');
            } else {
                return redirect('/employ/home');
            }
        }
        elseif(Auth::user()->level == 'Admin SistemExitPass'){
            return redirect('/admin/home');
        }
        elseif(Auth::user()->level == 'Manager'){
            return redirect('/manager/home');
        }
        else {
            return redirect('/employ/home');
        }
    });
});


//url ini hanya bisa diaksses oleh yang sudah login sebagai Admin
Route::group(['middleware'=> ['auth','admin']],function(){
    Route::controller('admin','AdminController');
    Route::get('register','Auth\AuthController@showRegistrationForm');
    Route::post('register','Auth\AuthController@register');
    Route::get('log-files', [
    'as' => 'log-files.index', 
    'uses' => 'LogController@index'
    ]);
    
    // Route melihat isi File
    Route::get('log-files/{filename}', [
        'as' => 'log-files.show', 
        'uses' => 'LogController@show'
    ]);
    
    // Route Download File
    Route::get('log-files/{filename}/download', [
        'as' => 'log-files.download', 
        'uses' => 'LogController@download'
    ]);
});
//url ini hanya bisa diaksses oleh yang sudah login sebagai Admin
Route::group(['middleware'=> ['auth','manager']],function(){
    Route::controller('manager','ManController');
});

//--------------------------- HOD --------------------------
//url ini hanya bisa diaksses oleh yang sudah login sebagai Hod                 
Route::group(['middleware'=> ['auth','ishod']],function(){
    Route::controller('hod','HController');
});
//url ini hanya bisa diaksses oleh yang sudah login sebagai Hod HR              
Route::group(['middleware'=> ['auth','ishodhr']],function(){
  Route::controller('hod-hr','HODHrController');
});
//url ini hanya bisa diaksses oleh yang sudah login sebagai Hod Police          
Route::group(['middleware'=> ['auth','ishodpolice']],function(){
    Route::controller('hod-police','HODPolController');  
});


//-------------- EMPLOY ----------------------------------
//url ini hanya bisa diaksses oleh yang sudah login sebagai employ             
Route::group(['middleware'=> ['auth','isemploy']],function(){
    Route::controller('employ','EmployController');   
});
//url ini hanya bisa diaksses oleh yang sudah login sebagai employ HR          
Route::group(['middleware'=> ['auth','isemployhr']],function(){
    Route::controller('employ-hr','EmployHrController');
});
//url ini hanya bisa diaksses oleh yang sudah login sebagai employ Police       
Route::group(['middleware'=> ['auth','isemploypolice']],function(){
    Route::controller('employ-police','EmployPolController');
});
//config utama system
Route::get('authFirst','Auth\AuthController@showRegistrationForm');
Route::post('auth','Auth\AuthController@register');
Route::controller('system','PageController');








//url untuk employee
//Route::resource('employ','EmployController');
//Route::get('employee/status','StatusController@getEmployExit');

//elseif(Auth::user()->depart == 'IT'){
//    return redirect('/admin');
//}

//url ini hanya bisa diaksses oleh yang sudah login sebagai Hod
//Route::group(['middleware'=> ['web','auth','ishod']],function(){
//    Route::resource('hod','HODController');
//    Route::controller('hodlist','AppController');
//    Route::get('hod-status','StatusController@getHODExit');
//});
//url ini hanya bisa diaksses oleh yang sudah login sebagai Hod HR
//Route::group(['middleware'=> ['web','auth','ishodhr']],function(){
//  Route::controller('hod-hr','HODHrController');
//});
//url ini hanya bisa diaksses oleh yang sudah login sebagai Hod Police
//Route::group(['middleware'=> ['web','auth','ishodpolice']],function(){
//    Route::controller('hod-police','HODPolController');  
//});


//-------------- EMPLOY ----------------------------------
//url ini hanya bisa diaksses oleh yang sudah login sebagai employ
//Route::group(['middleware'=> ['web','auth','isemploy']],function(){
//    Route::get('hr','HRcontroller@index');
//    Route::get('hr/data','HRcontroller@getDataExitpass');
//    Route::get('hr/regis','HRcontroller@regisUser');
//    Route::get('hr/user','HRcontroller@dataUser');
//    Route::post('hr/register','HRcontroller@postHrRegister');   
//});
//url ini hanya bisa diaksses oleh yang sudah login sebagai employ HR
//Route::group(['middleware'=> ['web','auth','isemployhr']],function(){
//    Route::controller('employ-hr','EmployHrController');
//});
//url ini hanya bisa diaksses oleh yang sudah login sebagai employ Police
//Route::group(['middleware'=> ['web','auth','isemploypolice']],function(){
//    Route::controller('employ-police','EmployPolController');
//});

//url untuk employee
//Route::resource('employ','EmployController');
//Route::get('employee/status','StatusController@getEmployExit');