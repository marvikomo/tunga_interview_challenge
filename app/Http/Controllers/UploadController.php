<?php
namespace App\Http\Controllers;

use App\Helper\StreamingParser\StreamingParserFactory;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessFile;
use App\Jobs\UploadFile;
use App\Libraries\ReadFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class UploadController extends Controller{
    public function upload(Request $request){
        $file = public_path()."/files/challenge__1_.json";
        ProcessFile::dispatch($file,ReadFile::getFileType($file));
        $response['message'] = 'done';
        return response()->json($response, 200);
    }
}
