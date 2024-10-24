<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;

Route::get('/_bladestyler/view/{view}',function($view){
    return view('bladestyler::' . $view);
});

Route::post('/_bladestyler/test',function(){
    $blade = request()->input('blade');
    return Blade::render($blade);
    
});