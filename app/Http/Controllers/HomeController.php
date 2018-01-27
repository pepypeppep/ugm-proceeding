<?php

namespace App\Http\Controllers;

use App\Repositories\ProceedingsRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

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
        $repo->getUser();
        return $repo->data;
    }

    public function findUser($user, UsersRepository $repo)
    {
        return $repo->find($user)->data;
    }

    public function proceedings(ProceedingsRepository $repo)
    {
       return $repo->get()->data;
    }

    public function findProceeding($proceeding, ProceedingsRepository $repo)
    {
        return $repo->find($proceeding)->articles->first();
    }

    public function storeProceeding(ProceedingsRepository $repo)
    {
        return $repo->store();
    }
}
