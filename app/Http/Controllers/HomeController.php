<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('service');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function service()
    {
        // Create a client with a base URI
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://onli.dev/api/']);
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', 'proceedings')->getBody();

        return json_decode($response, true);
    }

    public function apiService(UsersRepository $repo)
    {
        return $repo->getUser();
    }
}
