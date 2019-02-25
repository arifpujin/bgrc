<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Artisan;


class PageController extends Controller
{
 
public function getJancuk(){

        try {
            Artisan::call('down');
            echo'Good Job';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
   
}
