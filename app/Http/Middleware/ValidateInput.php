<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$values)
    {
        $validate_input = [];

        foreach ($values as $v){

            $validate_input[$v] = 'required';
        }
        $validate = Validator::make($request->all(),$validate_input);

        $fails = $validate->fails();
        $error = $validate->errors()->all();
        $msg = '';

        foreach($error as $message)
        {
            $msg .= $message.', ';
        }
        if($fails){
            $response['message'] = $msg;
            return response()->json($response, 400);
        }
        return $next($request);
    }
}
