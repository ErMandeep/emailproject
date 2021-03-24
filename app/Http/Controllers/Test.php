<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;


class Test extends Controller
{
    //

    public function gitpull(){
        $data['output'] = shell_exec( '(cd '. base_path() .' && git pull origin master)' );
        dd( $data );
    }



}
