<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Articles;
use App\Article;
use App\Http\Resources\Subjects;
use App\Subject;
use App\Repositories\Api\SubjectsRepository as Repository;

class SubjectController extends Controller
{
    public function index(Repository $repository)
    {
    	return Subjects::collection($repository->getAll());
    }

    public function show(Repository $repository)
    {
    	$queries = request()->validate([
            'name' => 'string',
        ]);

    	return new Subjects($repository->getAll($queries)->first());
    }
    
} 
