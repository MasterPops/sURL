<?php

namespace App\Http\Controllers;
use App\logs;
use App\urls;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\URL;
class UrlController extends Controller
{
/**
*  @SWG\Get
*  (
*   path="/{url}",
*   summary="Get record from database",
*   tags={"/"},
*   @ SWG\Parameter
*   (
*     name="url",
*     in="path",
*     description="full url",
*     required=true,
*     type="string",
*   ),
*   @SWG\Response
*   (
*     response=302,
*     description="Redirect",
*   ),
*   @SWG\Response
*   (
*     response=404,
*     description="Url not found",
*   ),
* ),
*
* )
*/
  public function getUrl(Request $request,$url)
  {
      $URL = \App\urls::where('surl', $url)
               ->first();
      $log = new logs;
      $log->ip = $request->ip();
      if (!empty($URL))
      {
        $redir = urldecode($URL->url);
        \App\urls::where('surl', $url)->update(['hits' => $URL->hits+1]);
        $log->Action = "The user has made the transition to " . urlencode($redir) . " via " . url('/'.$url.'');
        $log->status = 200;
        $log->save();
        return redirect($redir);
      }
      else
      {
          $log->Action = "The user attempted to navigate to ". url('/'.$url.'');
          $log->status = 404;
          $log->save();
          abort(404);
      }



  }
  /**
  *  @SWG\Post
  *  (
  *   path="/",
  *   summary="Add record in database",
  *   tags={"/"},
  *   @ SWG\Parameter
  *   (
  *     name="url",
  *     in="path",
  *     description="full url",
  *     required=true,
  *     type="string",
  *   ),
  *   @SWG\Response
  *   (
  *     response=200,
  *     description="successful operation",
  *   ),
  * ),
  *
  * )
  */
  public function setUrl(Request $request)
  {
      $url = $request->input('url');
      $log = new logs;
      $log->ip = $request->ip();
      if (empty($url))
      {
        $log->Action = "The user tried to create an empty link";
        $log->status = 406;
        $log->save();
        return view('welcome')->with('count', \App\urls::count())->with('res',2);
      }
      else
      {
        if (strpos($url, 'http') === false)
        {
          $url = 'http://' . $url;
        }
        $url = urlencode($url);
        $user_id = $request->input('user_id');
        $lId = DB::table('information_schema.TABLES')->SELECT('AUTO_INCREMENT')->WHERE('TABLE_NAME', '=', 'urls')->get();
        $lId = preg_replace('/[^0-9]/','', $lId);
        $surl = gmp_strval($lId,62);
        $setUrl = new urls;
        $setUrl->url = $url;
        $setUrl->surl = $surl;
        $setUrl->user_id = $user_id;
        $setUrl->save();
        $log->Action = "The user added a link ". $url . "to the database";
        $log->status = 200;
        $log->save();
        return view('welcome')->with('count', \App\urls::count())->with('res',1)->with('ssurl', $surl);
      }
  }
  /**
  *  @SWG\Delete
  *  (
  *   path="/{id}",
  *   summary="Del record from database",
  *   tags={"/"},
  *   @ SWG\Parameter
  *   (
  *     name="id",
  *     in="path",
  *     description="ID of the url that needs to be deleted",
  *     required=true,
  *     type="integer",
  *   ),
  *   @SWG\Response
  *   (
  *     response=200,
  *     description="OK",
  *   ),
  *   @SWG\Response
  *   (
  *     response=404,
  *     description="Order not found",
  *   ),
  * ),
  *
  * )
  */
  public function delUrl(Request $request, $id)
  {
      DB::delete('delete from urls where id = ?',[$id]);
      $log = new logs;
      $log->ip = $request->ip();
      $log->Action = "The user has removed the link id ".$id;
      $log->status = 200;
      $log->save();
      return view('home');
  }
}
