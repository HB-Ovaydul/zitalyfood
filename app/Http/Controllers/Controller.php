<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use PhpParser\Node\Stmt\Return_;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Varify Valid Email 
     */
    // public function CheckEmial($email)
    // {
    //    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    //         return $email;
    //    }else{
    //         return false;
    //    }
    // }
}
