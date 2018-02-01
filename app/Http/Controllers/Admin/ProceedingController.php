<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProceedingsRepository;
use App\Repositories\SubjectsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProceedingController extends Controller
{
	protected $repository;

    function __construct(ProceedingsRepository $repository)
    {
    	$this->repository = $repository;
    }

    public function index(SubjectsRepository $subjects)
    {
        $this->repository->query = [
            'keyword' => request('keyword'),
            'page' => request('page'),
            'status' => request('tab'),
            'subject' => request('subject'),
            'sort' => request('sort') ?: 'updated_at.desc',
        ];

    	$proceedings = $this->repository->get();
        $subjects = Cache::remember('subjects.list', 1200, function () use ($subjects)
        {
            return $subjects->get()->data;
        });

    	return view('dashboard.proceeding.index', compact('proceedings', 'subjects'));
    }

    public function show($proceeding)
    {
        $proceeding = $this->repository->find($proceeding);

        return view('dashboard.proceeding.detail', compact('proceeding'));
    }

    public function create()
    {
        return view('dashboard.proceeding.create');
    }

    public function store()
    {
        $request = request()->validate([
            'name' => 'required|string',
            'alias' => 'required|string',
            'organizer' => 'required|string',
            'location' => 'string',
            'conference_start' => 'required|date',
            'conference_end' => 'date',
        ]);

        $proceeding = $this->repository->store($request);

        return redirect(route('proceeding.show', ['proceeding' => $proceeding->id]));
    }
}
