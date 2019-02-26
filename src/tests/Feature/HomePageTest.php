<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DB;

class HomePageTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testHomeGet()
     {
       $response = $this->get('/');
       $response->assertStatus(200);
     }
     public function testPost()
     {
       $response = $this->call('POST', '/',['url' => 'http://google.com']);
       $this->assertEquals(200, $response->status());
     }
     public function testGetUrl()
     {
       $this->call('POST', '/',['url' => 'http://google.com']);
       $returnValue = DB::table('urls')
                          ->first();
       $response = $this->get('/'.$returnValue->surl);
       $response->assertStatus(302);
       $response->assertLocation(urldecode($returnValue->url));
     }
     public function testDelUrl()
     {
       $this->call('POST', '/',['url' => 'http://google.com']);
       $returnValue = DB::table('urls')
                          ->first();
      $response = $this->call('POST', '/',['id'=>'15521'], ['_method=DELETE']);
      $this->assertEquals(200, $response->getStatusCode());
     }

}
