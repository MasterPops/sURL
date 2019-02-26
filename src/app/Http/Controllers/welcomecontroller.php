<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class welcomecontroller extends Controller
{
  public function getCout()
  {
      return view('welcome')->with('count', \App\urls::count())->with('res',0);;
  }
}
