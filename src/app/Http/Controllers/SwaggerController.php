<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SwaggerController extends Controller
{
  public function doc()
  {
      $swagger = \Swagger\scan(realpath(__DIR__.'/../../'));
      return response()->json($swagger);
  }
}
