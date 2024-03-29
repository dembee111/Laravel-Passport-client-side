<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;
use GuzzleHttp\Client as Guzzle;

class HomeController extends Controller
{
    protected $client;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guzzle $client)
    {
        $this->middleware('auth');
        $this->client = $client;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $tweets = collect();

        if ($request->user()->token) {

            if ($request->user()->token->hasExpired()) {
                dd('expired');
            }
            $response = $this->client->get('http://vuetest.test/api/tweets', [
                'headers' => [

                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $request->user()->token->access_token
                ]                
            ]);

            $tweets = collect(json_decode($response->getBody()));
        }

        return view('home')->with([
             'tweets' => $tweets,
        ]);
       
    }
}
