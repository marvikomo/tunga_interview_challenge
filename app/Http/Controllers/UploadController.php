<?php
namespace App\Http\Controllers;

use App\Helper\ProcessFile\ProcessFactory;
use App\Helper\ValidateInput;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller{
    public function upload(Request $request){
        $file =   $request->csv;

        dd($this->is_base64($file));
        dd(base64_decode($file));
        dd( $file_data = json_decode(file_get_contents(base64_decode($file)), true));
        $process = new ProcessFactory();  //initialize process factory
        $process = $process->initialize('json'); //pass file type. default is json
        $process->process($file);

    }

    function is_base64($s)
    {
        // Check if there are valid base64 characters
        if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s)) return false;

        // Decode the string in strict mode and check the results
        $decoded = base64_decode($s, true);
        if(false === $decoded) return false;

        // if string returned contains not printable chars
        if (0 < preg_match('/((?![[:graph:]])(?!\s)(?!\p{L}))./', $decoded, $matched)) return false;

        // Encode the string again
        if(base64_encode($decoded) != $s) return false;

        return true;
    }
}
