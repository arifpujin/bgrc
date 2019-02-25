<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LogController extends Controller
{
    public function index(){
        if (!file_exists(storage_path('logs'))) {
            return [];
        }

        $logFiles = \File::allFiles(storage_path('logs'));

        // Sort files by modified time DESC
        usort($logFiles, function ($a, $b) {
            return -1 * strcmp($a->getMTime(), $b->getMTime());
        });

        return view('hod.admin.admin_log', compact('logFiles'));
    }
    
    public function show($fileName)
    {
        if (file_exists(storage_path('logs/'.$fileName))) {
            $path = storage_path('logs/'.$fileName);

            return response()->file($path, ['content-type' => 'text/plain']);
        }

        return 'Invalid file name.';
    }
    public function download($fileName)
    {
        if (file_exists(storage_path('logs/'.$fileName))) {
            $path = storage_path('logs/'.$fileName);
            $downloadFileName = env('APP_ENV').'.'.$fileName;

            return response()->download($path, $downloadFileName);
        }

        return 'Invalid file name.';
    }
}
