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

    public function index()
    {
        $proceedings = $this->repository->get();

    	return view('dashboard.proceeding.index', compact('proceedings'));
    }

    public function show($proceeding, SubjectsRepository $subjects)
    {
        $proceeding = $this->repository->find($proceeding);
        $subjects = $subjects->get()->data->reject(function ($item) use ($proceeding)
        {
            return str_contains($item['id'], $proceeding->subjects->pluck('id')->all());
        });

        return view('dashboard.proceeding.show', compact('proceeding', 'subjects'));
    }

    public function create()
    {
        return view('dashboard.proceeding.create');
    }

    public function store()
    {
        $proceeding = $this->repository->store(request()->all());

        return redirect(route('proceeding.show', ['proceeding' => $proceeding->id]));
    }

    public function edit($proceeding)
    {
        $proceeding = $this->repository->find($proceeding);
        $issn = optional($proceeding->identifiers->where('type', 'issn')->first())['id'];
        $isbn = optional($proceeding->identifiers->where('type', 'isbn')->first())['id'];

        return view('dashboard.proceeding.edit', compact('proceeding', 'isbn', 'issn'));
    }

    public function update($proceeding)
    {
        $proceeding = $this->repository->update(request()->all(), $proceeding);

        return redirect(route('proceeding.show', [$proceeding->id, 'tab' => 'details']));
    }

    public function updateSubjects($proceeding)
    {
        $proceeding = $this->repository->updateSubjects(request()->all(), $proceeding);

        return redirect(route('proceeding.show', [$proceeding->id, 'tab' => 'details']));
    }

    public function updateCover($proceeding)
    {
        $proceeding = $this->repository->updateCover(request()->file('front_cover'), $proceeding);

        return redirect(route('proceeding.show', [$proceeding->id, 'tab' => 'details']));
    }
}
