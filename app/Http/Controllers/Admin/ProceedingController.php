<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProceedingsRepository;
use Illuminate\Http\Request;

class ProceedingController extends Controller
{
	protected $repository;

    function __construct(ProceedingsRepository $repository)
    {
    	$this->repository = $repository;
    }

    public function index()
    {
    	$proceedings = $this->repository->get();

    	return view('dashboard.proceeding.index', compact('proceedings'));
    }

    public function show($proceeding)
    {
        $proceeding = $this->repository->find($proceeding);

        return $proceeding;
    }
}
