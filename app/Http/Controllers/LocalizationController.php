<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class LocalizationController extends Controller
{
    //set language method
    public function setLang($locale){
        App::setLocale($locale);
        //set selected language to session
        Session::put("locale",$locale);
        return redirect()->back();
    }
}
