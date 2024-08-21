<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function modulos()
    {
        return view('paginas.modulos');
    }

    public function modulo1()
    {
        return view('paginas.modulo-1');
    }

    public function homebanner()
    {
        return view('home-two');
    }
}
